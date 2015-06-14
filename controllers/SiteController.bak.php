<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Utils;
use yii\web\Authentication;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use yii\helpers\Url;
use himiklab\jqgrid\actions\JqGridActiveAction;
use yii\base\Exception;

class SiteController extends Controller
{
	
	private $LDAP_ENABLE = false;
	public $title = 'E-Warning System';
	public $breadcrumbs = [];
	
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],

        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
            //'jqgrid' => [
            //'class' => JqGridActiveAction::className(),
            //'model' => SiteController::className(),
           // 'columns' => ['title', 'author', 'language']
           // ],
        ];
    }

    public function actionIndex()
    {
    	
        return $this->render('index');
    }

    public function actionLogin()
    {
    	try{

    		if(Authentication::isLoggedIn()){
    			Yii::$app->getResponse()->redirect(['site']);
    		}
    		
    		$loginForm = Yii::$app->request->post('LoginForm');
    		$email = $loginForm['username'];
    		$password = $loginForm['password'];
    		
    		if(!Authentication::isLoggedIn() && empty($email)){
    			return $this->render('login');
    		}
    		
    		if($authenInfo = Authentication::authen($email, $password)){
    			//echo '<script type="text/javascript">alert("Success Login");</script>'; exit();
    			return $this->goBack();
    		}else{
    			//echo '<script type="text/javascript">alert("Faled Login");</script>'; exit();
    			// return $this->render('login');
    			return $this->render('login', ['msg' => 'ชื่อผู้ใช้ หรือรหัสผ่าน ไม่ถูกต้อง']);
    		}
    	}catch (Exception $e){
    		return $this->render('login', ['msg' => 'ชื่อผู้ใช้ หรือรหัสผ่าน ไม่ถูกต้อง']);
    	}
    }

    public function actionSignout()
    {
//         Yii::$app->user->logout();
//         return Yii::$app->getResponse()->redirect(\Yii::$app->getUser()->loginUrl);
		Authentication::signout();
		Yii::$app->getResponse()->redirect(['site/login']);
    }
    public function actionLogout()
    {
    	///Yii::$app->user->logout();
    	return $this->render('index');
    	//  return Yii::$app->getResponse()->redirect(\Yii::$app->getUser()->loginUrl);
    }
    public function actionJgrid()
    {
    	/*return [
    	'jqgrid' => [
    	'class' => JqGridActiveAction::className(),
    	'model' => Page::className(),
    	'columns' => ['title', 'author', 'language']
    	],
    	];*/
    }
    public function actionContact()
    {
      /*  $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        } else {
        	
            return $this->render('contact', [
                'model' => $model,
            ]);
        }*/
    	return $this->render('contact');
    }

    public function actionAbout()
    {
        return $this->render('about');
    }
    
    private function ldapAuthentication($sEmail, $sPwd){
    	
	    $results = array();
		try{
			 
			if(!empty($sEmail) && !empty($sPwd)){
				$dn_base = 'dc=dpe,dc=go,dc=th';
				$dn_host = 'ldap://192.168.2.7';
				$ds_port = 389;
				$ldapusers = 'd2FybmluZw==';
				$ldappasswd = 'ZHBlXmFkbWluIUAj';
				$txtUSER=$sEmail;//$_REQUEST['txtUSER'];
				$txtPWD=$sEmail; //$_REQUEST['txtPWD'];
	
				$ldapconn = ldap_connect($dn_host, $ds_port);
				if(!$ldapconn){ throw new Exception('Could not connect to LDAP Server'); }
	
	
				ldap_set_option($ldapconn, LDAP_OPT_PROTOCOL_VERSION, 3);
				ldap_set_option($ldapconn, LDAP_OPT_REFERRALS, 0);
	
				$ldapbind = ldap_bind($ldapconn ,base64_decode($ldapusers), base64_decode($ldappasswd));
				if(!$ldapbind){ throw new Exception('Users or Password Invalid'); }
	
				$filter = "(&(samaccountname=$txtUSER)(samaccountname=$txtUSER))";
				$result = ldap_search($ldapconn,$dn_base,$filter);
				$entries = ldap_count_entries($ldapconn,$result );
				$info = ldap_get_entries($ldapconn, $result );
				$results['info'] = $info;
				$results['email'] = $sEmail;
	
				for ($i=0; $i<$info["count"]; $i++){
					$ou = split(',',$info[$i]["distinguishedname"][0]);
					$count_ou=count($ou);
	
					$userAccount = $info[$i]["samaccountname"][0]; //เธ�เธทเน�เธญ เธฃเธซเธฑเธช
					$userFullName = iconv("UTF-8","TIS-620",$info[$i]["cn"][0]);
					$userOrgAndPosition = iconv("UTF-8","TIS-620",ereg_replace("OU=","",$ou[2])); // เธซเธ�เน�เธงเธขเธ�เธฒเธ�เน€เธ�เน�เธ�เธ•เธฑเธงเธขเน�เธญ เธซเธฃเธทเธญเน€เธ�เน�เธ�เธ•เธณเน�เธซเธ�เน�เธ�
					$userEmail = $info[$i]["userprincipalname"][0];
				}
	
				$results['userOrgAndPosition'] = $userOrgAndPosition;
				if($userOrgAndPosition){
					if( $txtUSER != $sPwd){
						//TODO: Authenticate invalidation.
						throw new Exception('Authenticate invalidation');
					}
				}
							
				switch ($userOrgAndPosition) {
				
					case 'DPE' : // กรมพลศึกษา
						$results['user_idx'] = '541000000001';
						break;
						// case 'RP': //กลุ่มบริหารงานทั่วไป สพก.ภูมิภาค ยกเลิกไม่ได้ใช้แล้ว
					case 'IP' : // กลุ่มพัฒนาการพลศึกษา กีฬา และนันทนาการภูมิภาค
						$results['user_idx'] = '540900000001';
						break;
				
					case 'AS' : // กลุ่มพัฒนาระบบบริหาร
						$results['user_idx'] = '541000000002';
						break;
					case 'AD' : // กองกลาง
						$results['user_idx'] = '541000000003';
						break;
				
					case 'IM' : // สถาบันอนุรักษ์ศิลปะมวยไทย
						$results['user_idx'] = '540900000004';
						break;
				
					case 'เจ้าหน้าที่พลศึกษา' :
						// echo 'test';
						// exit();
						$results['user_idx'] = 'NP';
						$userProvOrCostCenterName = iconv ( "UTF-8", "TIS-620", ereg_replace ( "OU=", "", $ou [1] ) ); // ปกติเป็นจังหวัด stakeholder เป็นชื่อหน่วยงาน
						$waProvince = null;
						if (! empty ( $userProvOrCostCenterName )) {
							$cn = null;
							$sExpError = null;
							//fnGetFldValue ( $sProvId, 'osrt_province', 'PROV_ID', 'PROV_NAME', $userProvOrCostCenterName, $cn, $sExpError );
							$waProvince = WA_PROVINCE::find()->where(['like', 'PROVINCE_NAME_TH', $userProvOrCostCenterName])->limit(1)->asArray()->all();
						}
						/*$userAmphur = iconv ( "UTF-8", "TIS-620", ereg_replace ( "OU=อำเภอ", "", $info [$i] ["description"] [0] ) );
						if (! empty ( $userAmphur ) && ! empty ( $sProvId )) {
							fnGetFldValue2Cond ( $sAmphurId, 'osrt_amphur', 'AMPHUR_ID', 'AMPHUR_NAME', $userAmphur, 'PROV_ID', $sProvId, $cn, $sExpError );
						}*/
							
						$results['waProvince'] = $waProvince;
							
						/*$amphur = iconv ( "UTF-8", "TIS-620", $info [0] ['givenname'] [0] );
						if ($amphur = fetch ( query ( "SELECT * FROM osrt_amphur WHERE amphur_name = '{$amphur}' AND prov_id = '{$sProvId}'" ) )) {
							$results['amphur_id'] = $amphur ['amphur_id'];
						} else {
							$results['amphur_id'] = '';
						}*/
						
						$waAmphoe = null;
						$amphur = iconv ( "UTF-8", "TIS-620", $info [0] ['givenname'] [0] );
						if (!empty($waProvince) && !empty( $amphur )) {
							$waAmphoe = WA_AMPHOE::find()->where(['and', ['=', 'PROVINCE_CODE', $waProvince[0]['PROVINCE_CODE']],['like', 'AMPHOE_NAME_TH', $amphur]])->limit(1)->asArray()->all();
						}
						
						$results['waAmphoe'] = $waAmphoe;
						// print_r($_SESSION);
						// exit();
						break;
					case 'มวยไทย' :
						$results['user_idx'] = '540900000005';
						$userInstTypeName = iconv ( "UTF-8", "TIS-620", ereg_replace ( "OU=", "", $ou [1] ) ); // ชื่อหน่วยงาน
						if ($userInstTypeName == 'สถาบันการพลศึกษา') {
							$userInstTypeName = 'สถาบันการพลศึกษาวิทยาเขต';
						}
						if ($userInstTypeName == 'โรงเรียนกีฬา') {
							$userInstTypeName = 'โรงเรียนกีฬาจังหวัด';
						}
						if ($userInstTypeName == 'ศูนย์อนุรักษ์มวย') {
							$userInstTypeName = 'ศูนย์อนุรักษ์มวยจังหวัด';
						}
							
						if (! empty ( $userInstTypeName )) {
							$cn = null;
							$sExpError = null;
							fnGetFldValue ( $sInstTypeIdx, 't_m_im_inst_type', 'inst_type_idx', 'inst_type_nm_th', $userInstTypeName, $cn, $sExpError );
						}
							
						$userProvName = ereg_replace ( "วิทยาเขต", "", $userFullName );
						$userProvName = ereg_replace ( "จังหวัด", "", $userProvName );
						if ($userProvName == 'กรุงเทพ') {
							$userProvName = 'กรุงเทพมหานคร';
						}
						// echo $userProvName; exit;
						$waProvince = null;
						if (! empty ( $userProvName )) {
							$cn = null;
							$sExpError = null;
							//fnGetFldValue ( $sProvId, 'osrt_province', 'PROV_ID', 'PROV_NAME', $userProvName, $cn, $sExpError );
							$waProvince = WA_PROVINCE::find()->where(['like', 'PROVINCE_NAME_TH', $userProvOrCostCenterName])->limit(1)->asArray()->all();
						}
							
						$results['waProvince'] = $waProvince;
							
						$results['inst_type_idx'] = $sInstTypeIdx;
							
						break;
					case 'SS' :
						$results['user_idx'] = '540900000006'; // สำนักวิทยาศาสตร์การกีฬา
						break;
					case 'SB' :
						$results['user_idx'] = 'SB'; // สำนักการกีฬา
						break;
					case 'RB' :
						$results['user_idx'] = 'RB'; // สำนักนันทนาการ
						break;
					case 'IT' :
						$results['user_idx'] = '540900000001'; // IT
						break;
				}
	
			}
		}catch (Exception $e){
			throw $e;
		}
		
		return $results;
    }
}

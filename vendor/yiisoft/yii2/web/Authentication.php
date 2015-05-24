<?php

namespace yii\web;

use Yii;
use yii\base\Exception;
use app\models\WA_USER;
use app\models\WA_PROVINCE;
use app\models\WA_AMPHOE;

Class Authentication{

	static public $authen_session_name = 'authentication';
	static public $is_enable_ldap = false;
	static public $is_test_ldap = false;
	
	public $IDENTITY;
	public $IS_LDAP_AUTHEN;
	public $USER_NAME_EN;
	public $EMAIL;
	public $LDAP_ORG_CODE;
	public $PROVINCE_CODE;
	public $AMPHOE_CODE;
	
	static public function authenViaDB($username, $password){
		$results;
		try{
			//echo $username;
			$waUser = WA_USER::findOne(['EMAIL' =>$username]);
			//print_r($waUser);
			if(md5($password)==$waUser['PASSWORD']){
				//TODO :: Mapping user detail to authenication model.
				$authenInfo = new Authentication();
				$authenInfo->IS_LDAP_AUTHEN = false;
				$authenInfo->IDENTITY = $waUser['WA_USER_ID'];
				$authenInfo->USER_NAME_EN = $waUser['USER_NAME_EN'];
				$authenInfo->EMAIL = $waUser['EMAIL'];
				
				$results = $authenInfo;
				
			}else{
				$results = null;
			}
		}catch(Exception $e){
			throw $e;
		}
		return $results;
	}
	
	static public function authenViaLDAP($username, $password){
		$results = array();
		$rtfailed = false;
		try{
		
			if(self::$is_test_ldap){
				$authenInfo = new Authentication();
				$authenInfo->IS_LDAP_AUTHEN = true;
				$authenInfo->USER_NAME_EN = 'LDAPTEST';
				$authenInfo->EMAIL = 'LDAPTEST';
				$authenInfo->LDAP_ORG_CODE = 'NPAMPHOE';
				$authenInfo->PROVINCE_CODE = '11';
				$authenInfo->AMPHOE_CODE = '1104';
// 				$authenInfo->LDAP_ORG_CODE = 'NPPROVINCE';
// 				$authenInfo->PROVINCE_CODE = '11';
// 				$authenInfo->AMPHOE_CODE = '';
					
				$results = $authenInfo;
			}else{
			
				if(!empty($username) && !empty($password)){
					$dn_base = 'dc=dpe,dc=go,dc=th';
					$dn_host = 'ldap://192.168.2.7';
					$ds_port = 389;
					$ldapusers = 'd2FybmluZw==';
					$ldappasswd = 'ZHBlXmFkbWluIUAj';
					$txtUSER=$username;//$_REQUEST['txtUSER'];
					$txtPWD=$username; //$_REQUEST['txtPWD'];
			
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
					$results['email'] = $username;
			
					$userOrgAndPosition = '';
					for ($i=0; $i<$info["count"]; $i++){
						$ou = split(',',$info[$i]["distinguishedname"][0]);
						$count_ou=count($ou);
			
						$userAccount = $info[$i]["samaccountname"][0]; //เธ�เธทเน�เธญ เธฃเธซเธฑเธช
// 						$userFullName = iconv("UTF-8","TIS-620",$info[$i]["cn"][0]);
						$userFullName = $info[$i]["cn"][0];
// 						$userOrgAndPosition = iconv("UTF-8","TIS-620",ereg_replace("OU=","",$ou[2])); // เธซเธ�เน�เธงเธขเธ�เธฒเธ�เน€เธ�เน�เธ�เธ•เธฑเธงเธขเน�เธญ เธซเธฃเธทเธญเน€เธ�เน�เธ�เธ•เธณเน�เธซเธ�เน�เธ�
						$userOrgAndPosition = ereg_replace("OU=","",$ou[2]);
						$userEmail = $info[$i]["userprincipalname"][0];
					}
			
					if($userOrgAndPosition){
						if( $txtUSER != $password){
							//TODO: Authenticate invalidation.
							//throw new Exception('Authenticate invalidation');
							return $rtfailed;
						}
					}else{
						return $rtfailed;
					}
					$results['userOrgAndPosition'] = $userOrgAndPosition;
					
					switch ($userOrgAndPosition) {
			
						case 'DPE' : // กรมพลศึกษา
							$results['user_idx'] = '541000000001';
							break;
							// case 'RP': //กลุ่มบริหารงานทั่วไป สพก.ภูมิภาค ยกเลิกไม่ได้ใช้แล้ว
						case 'IP' : // กลุ่มพัฒนาการพลศึกษา กีฬา และนันทนาการภูมิภาค
							$results['user_idx'] = 'IP' ;//540900000001';
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
							$results['user_idx'] = 'NPAMPHOE';
// 							$userProvOrCostCenterName = iconv ( "UTF-8", "TIS-620", ereg_replace ( "OU=", "", $ou [1] ) ); // ปกติเป็นจังหวัด stakeholder เป็นชื่อหน่วยงาน
							$userProvOrCostCenterName = ereg_replace ( "OU=", "", $ou [1] );
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
// 							$amphur = $info [0] ['givenname'] [0];
							
							$distinguishedname_cn = ereg_replace ( "CN=", "", $ou [0] );
							$cns = explode(" ", $distinguishedname_cn);
							if(count($cns)>1){
								//TODO: Amphoe role
								$amphur = trim($cns[0]);
								if (!empty($waProvince) && !empty( $amphur )) {
									$waAmphoe = WA_AMPHOE::find()->where(['and', ['=', 'PROVINCE_CODE', $waProvince[0]['PROVINCE_CODE']],['like', 'AMPHOE_NAME_TH', $amphur]])->limit(1)->asArray()->all();
								}
									
								$results['waAmphoe'] = $waAmphoe;
							}else{
								//TODO: Province role
								$results['user_idx'] = 'NPPROVINCE';
							}
							
// 							if(empty($waAmphoe)){
// 								$results['user_idx'] = 'NPPROVINCE';
// 							}
							// print_r($_SESSION);
							// exit();
							break;
						case 'มวยไทย' :
							$results['user_idx'] = '540900000005';
// 							$userInstTypeName = iconv ( "UTF-8", "TIS-620", ereg_replace ( "OU=", "", $ou [1] ) ); // ชื่อหน่วยงาน
							$userInstTypeName = ereg_replace ( "OU=", "", $ou [1] );
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
						default : 
							$results['user_idx'] = '';
							break;
					}
					
					$authenInfo = new Authentication();
					$authenInfo->IS_LDAP_AUTHEN = true;
					$authenInfo->USER_NAME_EN = $results['email'];
// 					$authenInfo->USER_NAME_EN = $results['email'].'-'.$userOrgAndPosition.'-'.$results['user_idx'];
					$authenInfo->EMAIL = $results['email'];
					$authenInfo->LDAP_ORG_CODE = $results['user_idx'];
					$authenInfo->PROVINCE_CODE = (isset($results['waProvince'][0]['PROVINCE_CODE'])?$results['waProvince'][0]['PROVINCE_CODE']:'');
					$authenInfo->AMPHOE_CODE = (isset($results['waAmphoe'][0]['AMPHOE_CODE'])?$results['waAmphoe'][0]['AMPHOE_CODE']:'');
					
					$results = $authenInfo;
				}else{
					throw new Exception('No Username or Password');
				}
			}
		}catch (Exception $e){
			throw $e;
		}
		
		return $results;
	}
	
    static public function authen($username, $password){
    	$authenInfo = null;
    	try{
    		if(self::$is_enable_ldap && $authenInfo = self::authenViaLDAP($username, $password)){
    			$session = new Session; $session->open();
    			$session['authentication'] = $authenInfo;
    		}else if($authenInfo = self::authenViaDB($username, $password)){
	    		$session = new Session; $session->open();
	    		$session['authentication'] = $authenInfo;
	    	}
    	}catch(Exception $e){
    		//echo '<script type="text/javascript">alert("Authen Exception");</script>'; //exit();
    		$authenInfo = null;
    	}
    	return $authenInfo;
    }
    
    static public function getAuthenInfo(){
    	$authenInfo = null;
    	try{
    		if(self::isLoggedIn()){
    			$session = new Session; $session->open();
    			$authenInfo = $session['authentication'];
    		}
    	}catch(Exception $e){
    		$authenInfo = null;
    	}
    	return $authenInfo;
    }
	
	static public function isLoggedIn(){
		$check = false;
	    try{
	    	$check = self::checkRequireData();
	    }catch (Exception $e){
	        $check = false;
	    }
	    return $check;
	}
	
	static public function checkRequireData(){
		$check = false;
		try{
			$session = new Session; $session->open();
			if(isset($session['authentication']) && !empty($session['authentication'])){
				if(!empty($session['authentication']->USER_NAME_EN)
						&& !empty($session['authentication']->EMAIL)
						)
					$check = true;
			}
		}catch (Exception $e){
			throw $e;
		}
		return $check;
	}
	
	static public function signout(){
		$session = new Session; $session->open();
		$session->remove('authentication');
	}
}
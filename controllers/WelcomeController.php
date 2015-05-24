<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\helpers\Url;
use yii\web\AppController;
use yii\web\Utils;
use yii\web\UploadedFile;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use himiklab\jqgrid\actions\JqGridActiveAction;
use himiklab\jqgrid\jqGridResponse;

class WelcomeController extends AppController
{
    public $title = 'Welcome';
    public $enableCsrfValidation = false;
    public $imagePath = 'images/welcome';
	
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
    public function actionIndex()
    {
    	
        return $this->render('index');
    }
    public function actionGridview()
    {
    	$request = Yii::$app->request;

		//Parameter from jqGrid
		$oper = $request->post('oper', ''); $oper = (empty($oper)?$request->get('oper', ''):$oper);
		$page = $request->post('page', ''); $page = (empty($page)?$request->get('page', ''):$page);
		$rows = $request->post('rows', ''); $rows = (empty($rows)?$request->get('rows', ''):$rows);
		$sidx = $request->post('sidx', ''); $sidx = (empty($sidx)?$request->get('sidx', ''):$sidx);
		$sord = $request->post('sord', ''); $sord = (empty($sord)?$request->get('sord', ''):$sord);
		$id = $request->post('id', ''); $id = (empty($id)?$request->get('id', ''):$id);
		$isSearch = $request->post('_search', ''); $isSearch = (empty($isSearch)?$request->get('_search', ''):$isSearch);
		$isSearch = filter_var($isSearch, FILTER_VALIDATE_BOOLEAN);
		$filters = $request->post('filters', ''); $filters = (empty($filters)?$request->get('filters', ''):$filters);

		//Input parameter from jqGrid Form.
		$fileToUpload = $request->post('taskNameTh');
// 		print_r($_FILES);
		$imagedescription = $request->post('imagedescription');
		$status = $request->post('status');
		
		//Parameter from another pages.
		$consttask = $request->post('consttask'); $consttask = (empty($consttask)?$request->get('consttask'):$consttask);
		
		//response parameter to jqGrid
        $result = '';
    	
    	switch($oper){
    		case 'request' :
    			$offset = ($page-1)*$rows;
    			
    			$where_causes = array();
    			$where = 'and';
    			array_push($where_causes, $where);
    			array_push($where_causes, 'CONST_TASK_ID='.$consttask);
    			if($isSearch){
    				$filters = json_decode($filters);
    				// print_r($filters);
    				switch($filters->groupOp){
    					case 'AND':
    						$where = 'and';
    						break;
    					case 'OR':
    						$where = 'or';
    						break;
    				}

    				foreach($filters->rules as $conditions){
    					array_push($where_causes, $conditions->field.$this->filtersOperand[$conditions->op]."'".$conditions->data."'" );
    				}
    			}
    			
    			$count = CONST_TASK_IMAGE::find()->where($where_causes)->count();
    			$result = CONST_TASK_IMAGE::find()->where($where_causes)->orderBy($sidx.' '.$sord)->offset($offset)->limit($rows)->asArray()->all();
    			
    			$response = new jqGridResponse();
    			$response->page = $page;
    			$response->total = intval(ceil($count/$rows));
    			$response->records = $count;
    			
				for($i=0; $i<count($result); $i++){
					array_push($response->rows, array('id'=>$result[$i]['CONST_TASK_IMAGE_ID'], 
													'cell'=>array($result[$i]['CONST_TASK_IMAGE_ID'],
																	$this->imagePath.'/'.$result[$i]['IMAGE_PATH'],
																	$this->imagePath.'/'.$result[$i]['IMAGE_PATH'],
																	$result[$i]['IMAGE_DESCRIPTION'],
																	$result[$i]['STATUS']
																	)));
				}
				
    			$result = json_encode($response);
    			
	    		break;
	    		
    		case 'edit' :
    			
    			//To update an existing customer record
				$constTaskImage = CONST_TASK_IMAGE::findOne($id);
				$constTaskImage->IMAGE_DESCRIPTION = $imagedescription ;
                $constTaskImage->STATUS = Utils::getStatus($status);                        
				$response = new jqGridResponse();
                
				$constTaskImage->LAST_UPD_USER_ID = '1';
				$constTaskImage->LAST_UPD_TIME = new \yii\db\Expression('SYSDATE');
                                
				if($constTaskImage->save()){  // equivalent to $customer->insert();
					$response->success();
				}else{
					$response->error($constTaskImage->getErrors());
				}
				$result = $response->response_encode();
    			break;
		
		case 'add':
			
				$constTaskImage = new CONST_TASK_IMAGE();
				$constTaskImage->CONST_TASK_IMAGE_ID = CONST_TASK_IMAGE::getNewID();
				$constTaskImage->CONST_TASK_ID = $consttask;
				$constTaskImage->IMAGE_PATH = 'no.jpg';
				$constTaskImage->IMAGE_DESCRIPTION = $imagedescription;
				$constTaskImage->STATUS = Utils::getStatus($status);
				$constTaskImage->CREATE_USER_ID = '1';
				$constTaskImage->CREATE_TIME = new \yii\db\Expression('SYSDATE');
				$constTaskImage->LAST_UPD_USER_ID = '1';
				$constTaskImage->LAST_UPD_TIME = new \yii\db\Expression('SYSDATE');
                
                $response = new jqGridResponse();
                
				if($constTaskImage->save()){  // equivalent to $customer->insert();
					// $result = '{"success":true, "id":'.$constTaskImage->CONST_TASK_IMAGE_ID.'}';
					$response->success(['id'=>$constTaskImage->CONST_TASK_IMAGE_ID]);
				}else{
					$response->error($constTaskImage->getErrors());
				}
				$result = $response->response_encode();
				break;
	
			case 'del':
		
				// to delete an existing customer record
				$constTaskImage = CONST_TASK_IMAGE::findOne($id);
				
				$response = new jqGridResponse();
				
				if($constTaskImage->delete()){
					$response->success();
				}else{
					$response->error($constTaskImage->getErrors());
				}
				$result = $response->response_encode();
				break;
    	}
    	
    	echo $result;

    }
    
    public function actionUploadfile(){
    	
    	$request = Yii::$app->request;
    	
        $directory = $this->imagePath;

		$fileName = $_FILES["fileToUpload"]["name"];
		$id = $request->post('id', ''); $id = (empty($id)?$request->get('id', ''):$id);
		
		$splitFileName = explode(".", $fileName);
		$extensionFile = ".".$splitFileName[count($splitFileName)-1];
		$fileName = $id.date('-Ymd-His').$extensionFile;
		
		Yii::trace('directory = '.$directory.'  fileName = '.$fileName);
		
		$response = new jqGridResponse();
	
		if ( Utils::checkDirectory($directory) ) {

			if ( move_uploaded_file($_FILES["fileToUpload"]["tmp_name"]	// temp_file
					, $directory."/".$fileName) ) {	// path file
					
					$constTaskImage = CONST_TASK_IMAGE::findOne($id);
    				$constTaskImage->IMAGE_PATH = $fileName;
    				if($constTaskImage->save()){
    				    $response->success();
    				}else{
    				    $response->error(); //3
    				}
			} else {
				$response->error(); //1
			}
			
		} else {
			$response->error(); //2
		}
		echo $response->response_encode();
    }
}

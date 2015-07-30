<?php

namespace app\controllers;

use Yii;
use yii\base\Exception;
use yii\web\NotFoundHttpException;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use app\components\FlashMessage;
use app\components\GlobalVariable;
use app\helpers\ErrorHelper;
use app\models\CttArticles;
use app\models\CttSequences;

/**
 * ArticlesController implements the CRUD actions for CttArticles model.
 */
class ArticlesController extends base\AppController
{

    /**
     * @inheritdoc
     *
     * See more
     *  http://www.yiiframework.com/forum/index.php/topic/60439-yii2-rbac-permissions-in-controller-behaviors/
     *  http://www.yiiframework.com/doc-2.0/yii-filters-accesscontrol.html
     *  http://www.yiiframework.com/doc-2.0/yii-filters-accessrule.html
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index'],
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['superadmin'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all CttArticles models.
     * @return mixed
     */
    public function actionIndex()
    {
        

        // GlobalVariable::fetchData();

        return $this->render('index');
    }

    public function actionPublicView($id)
    {

    	$connection = Yii::$app->db;
    	 
    	$data = $connection
    	->createCommand('SELECT ctt_articles.*, ctt_publishers.name as publisher FROM ctt_articles, ctt_publishers where ctt_articles.publisher_id=ctt_publishers.id and ctt_articles.status = :status and ctt_articles.id = :id',
    			[
    					'status' => 'A',
    					'id' => $id
    			])
    			->queryAll();
    	$this->setParameter('data', $data);
    	 
    	$references = $connection
    	->createCommand('SELECT * FROM `ctt_article_references` where status=:status and article_id=:id',
    			[
    					'status' => 'A',
    					'id' => $id
    			])->queryAll();
    			$this->setParameter('references', $references);
    			 
    	return $this->cRender('public_view');
    	
    }

    /**
     * Lists all CttArticles models in each name.
     * @return mixed
     */
    public function actionLangList()
    {
        
    	return $this->render('lang_list');
    }

    /**
     * Displays a single CttArticles model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id, $lang_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id, $lang_id),
        ]);
    }

    /**
     * Creates a new CttArticles model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        try {
            Yii::trace('OK', 'debug');
            // GlobalVariable::clearData();
            $model = new CttArticles();

            if (Yii::$app->request->post()) {
                $model->load(Yii::$app->request->post());
                $model->id = (Yii::$app->request->getQueryParam('id'))
                                ? Yii::$app->request->getQueryParam('id')
                                : $model->getId();

                if ($result = $model->save()) {
                    FlashMessage::showSuccess(['msg' => 'Saved successfully.']);
                    return $this->redirect(['lang-list', 'id' => $model->id]);
                } else {
                    // Handler error in here.
                    Yii::trace(print_r($model->errors, true), 'Debug');
                    Yii::$app->session->setFlash('kv-detail-error', 'Save failed.');
                    return $this->render('create', [
                        'model' => $model,
                    ]);
                }
            } else {
                return $this->render('create', [
                    'model' => $model,
                ]);
            }
        } catch (Exception $e) {
            ErrorHelper::showErrorForCU($e, ['create', 'id' => $model->id]);
        }
    }

    /**
     * Updates an existing CttArticles model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id, $lang_id)
    {
        $model = $this->findModel($id, $lang_id);

        if (Yii::$app->request->post()) {
            $model->load(Yii::$app->request->post());

            if ($model->save()) {
                FlashMessage::showSuccess(['msg' => 'Updated successfully.']);
                return $this->redirect(['lang-list', 'id' => $model->id]);
            } else {
                Yii::trace(print_r($model->errors, true), 'Debug');
                Yii::$app->session->setFlash('kv-detail-error', 'Update failed.');
                return $this->render('update', [
                    'model' => $model,
                ]);
            }
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing CttArticles model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id, $lang_id)
    {
        if ($this->findModel($id, $lang_id)->delete()) {
            FlashMessage::showSuccess(['msg' => 'Deleted successfully.']);
        } else {
            FlashMessage::showSuccess(['msg' => 'Delete failed.']);
        }

        return $this->redirect(['lang-list', 'id' => $id]);
    }

    /**
     * Finds the CttArticles model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return CttArticles the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id, $langId)
    {
        $model = CttArticles::find($id)
                    ->where(['id' => $id, 'lang_id' => $langId])
                    ->one();

        if ($model !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}

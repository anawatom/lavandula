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
use app\models\CttStaticdataSubjectarea;
use app\models\CttStaticdataSubjectareaSearch;
use app\models\CttStaticdataLanguages;

/**
 * CttStaticdataSubjectareaController implements the CRUD actions for CttStaticdataSubjectarea model.
 */
class StaticdataSubjectareaController extends base\AppController
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all CttStaticdataSubjectarea models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CttStaticdataSubjectareaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single CttStaticdataSubjectarea model.
     * @param integer $id
     * @param integer $lang_id
     * @return mixed
     */
    public function actionView($id, $lang_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id, $lang_id),
        ]);
    }

    public function actionPublicView($id)
    {

        return $this->render('public_view',
                            [
                                'model' => CttStaticdataSubjectarea::find()->where(['id' => $id])->all()
                            ]);
    }

    /**
     * Lists all CttStaticdataSubjectarea models in each name.
     * @return mixed
     */
    public function actionLangList()
    {
        $searchModel = new CttStaticdataSubjectareaSearch();
        $dataProvider = $searchModel->searchLangList(Yii::$app->request->queryParams);

        // GlobalVariable::fetchData();

        return $this->render('lang_list', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new CttStaticdataSubjectarea model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        try {
            $model = new CttStaticdataSubjectarea();
            $currentUser = \Yii::$app->user->getIdentity();
            $cttStaticdataLanguages = CttStaticdataLanguages::find()->orderBy('id')->asArray()->all();
            $renderParams = [
                                'model' => $model,
                                'currentUser' => $currentUser,
                                'cttStaticdataLanguages' => $cttStaticdataLanguages
                            ];

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
                    return $this->render('create', $renderParams);
                }
            } else {
                return $this->render('create', $renderParams);
            }
        } catch (Exception $e) {
            ErrorHelper::showErrorForCU($e, ['create', 'id' => $model->id]);
        }
    }

    /**
     * Updates an existing CttStaticdataSubjectarea model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @param integer $lang_id
     * @return mixed
     */
    public function actionUpdate($id, $lang_id)
    {
        $model = $this->findModel($id, $lang_id);
        $currentUser = \Yii::$app->user->getIdentity();
        $cttStaticdataLanguages = CttStaticdataLanguages::find()->orderBy('id')->asArray()->all();
        $renderParams = [
                            'model' => $model,
                            'currentUser' => $currentUser,
                            'cttStaticdataLanguages' => $cttStaticdataLanguages
                        ];

        if (Yii::$app->request->post()) {
            $model->load(Yii::$app->request->post());

            if ($model->save()) {
                FlashMessage::showSuccess(['msg' => 'Updated successfully.']);
                return $this->redirect(['lang-list', 'id' => $model->id]);
            } else {
                Yii::trace(print_r($model->errors, true), 'Debug');
                Yii::$app->session->setFlash('kv-detail-error', 'Update failed.');
                return $this->render('update', $renderParams);
            }
        } else {
            return $this->render('update', $renderParams);
        }
    }

    /**
     * Deletes an existing CttStaticdataSubjectarea model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @param integer $lang_id
     * @return mixed
     */
    public function actionDelete($id, $lang_id)
    {
        try {
            $this->findModel($id, $lang_id)->delete();
            FlashMessage::showSuccess(['msg' => 'Deleted successfully.']);
        } catch (Exception $e) {
            Yii::trace($e->getMessage(), 'debug');
            FlashMessage::showError(['msg' => $e->getMessage()]);
        }

        return $this->redirect(['lang-list', 'id' => $id]);
    }

    /**
     * Finds the CttStaticdataSubjectarea model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @param integer $lang_id
     * @return CttStaticdataSubjectarea the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id, $lang_id)
    {
        if (($model = CttStaticdataSubjectarea::findOne(['id' => $id, 'lang_id' => $lang_id])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}

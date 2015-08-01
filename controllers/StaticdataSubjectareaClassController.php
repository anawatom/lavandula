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
use app\models\CttStaticdataSubjectareaClass;
use app\models\CttStaticdataSubjectareaClassSearch;
use app\models\CttStaticdataLanguages;
use app\models\CttStaticdataSubjectarea;

/**
 * CttStaticdataSubjectareaClassController implements the CRUD actions for CttStaticdataSubjectareaClass model.
 */
class StaticdataSubjectareaClassController extends base\AppController
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
     * Lists all CttStaticdataSubjectareaClass models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CttStaticdataSubjectareaClassSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single CttStaticdataSubjectareaClass model.
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
                                'model' => CttStaticdataSubjectareaClass::find()->where(['id' => $id])->all()
                            ]);
    }

    /**
     * Lists all CttStaticdataSubjectareaClass models in each name.
     * @return mixed
     */
    public function actionLangList()
    {
        $searchModel = new CttStaticdataSubjectareaClassSearch();
        $dataProvider = $searchModel->searchLangList(Yii::$app->request->queryParams);

        // GlobalVariable::fetchData();

        return $this->render('lang_list', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new CttStaticdataSubjectareaClass model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        try {
            $model = new CttStaticdataSubjectareaClass();
            $currentUser = \Yii::$app->user->getIdentity();
            $cttStaticdataLanguages = CttStaticdataLanguages::find()->orderBy('id')->asArray()->all();
            $cttStaticdataSubjectareas = CttStaticdataSubjectarea::getSubjectareaList();
            $renderParams = [
                                'model' => $model,
                                'currentUser' => $currentUser,
                                'cttStaticdataLanguages' => $cttStaticdataLanguages,
                                'cttStaticdataSubjectareas' => $cttStaticdataSubjectareas
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
     * Updates an existing CttStaticdataSubjectareaClass model.
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
        $cttStaticdataSubjectareas = CttStaticdataSubjectarea::getSubjectareaList();
        $renderParams = [
                            'model' => $model,
                            'currentUser' => $currentUser,
                            'cttStaticdataLanguages' => $cttStaticdataLanguages,
                            'cttStaticdataSubjectareas' => $cttStaticdataSubjectareas
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
     * Deletes an existing CttStaticdataSubjectareaClass model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @param integer $lang_id
     * @return mixed
     */
    public function actionDelete($id, $lang_id)
    {
        try {
            $this->findModel($id, $lang_id)->delete();
            FlashMessage::showSuccess(['msg' => 'Updated successfully.']);
        } catch (Exception $e) {
            Yii::trace($e->getMessage(), 'debug');
            FlashMessage::showError(['msg' => $e->getMessage()]);
        }

        return $this->redirect(['lang-list', 'id' => $id]);
    }

    /**
     * Finds the CttStaticdataSubjectareaClass model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @param integer $lang_id
     * @return CttStaticdataSubjectareaClass the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id, $lang_id)
    {
        if (($model = CttStaticdataSubjectareaClass::findOne(['id' => $id, 'lang_id' => $lang_id])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}

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
use app\models\CttPublishers;
use app\models\CttPublishersSearch;
use app\models\CttPublishersRevs;
use app\models\CttStaticdataLanguages;
use app\models\CttStaticdataCountrys;

/**
 * CttPublishersController implements the CRUD actions for CttPublishers model.
 */
class PublisherController extends base\AppController
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
     * Lists all CttPublishers models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CttPublishersSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

     public function actionPublicView($id)
    {

        return $this->render('public_view',
                            [
                                'model' => CttPublishers::find()
                                            ->where(['id' => $id])
                                            ->orderBy('lang_id')
                                            ->all()
                            ]);
    }

    /**
     * Displays a single CttPublishers model.
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

    /**
     * Creates a new CttPublishers model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        try {
            $currentUser = Yii::$app->user->getIdentity();
            $model = new CttPublishers();
            $cttStaticdataLanguages = CttStaticdataLanguages::find()->orderBy('id')->all();
            $cttStaticdataCountrys = CttStaticdataCountrys::getCountryList();
            $renderParams = [
                                'model' => $model,
                                'currentUser' => $currentUser,
                                'cttStaticdataLanguages' => $cttStaticdataLanguages,
                                'cttStaticdataCountrys' => $cttStaticdataCountrys
                            ];

            if (Yii::$app->request->post()) {
                $model->load(Yii::$app->request->post());
                $model->id = (Yii::$app->request->getQueryParam('id'))
                                ? Yii::$app->request->getQueryParam('id')
                                : $model->getId();

                if ($result = $model->save()) {
                    FlashMessage::showSuccess(['msg' => 'Saved successfully.']);
                    return $this->redirect(['index', 'id' => $model->id]);
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
     * Updates an existing CttPublishers model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @param integer $lang_id
     * @return mixed
     */
    public function actionUpdate($id, $lang_id)
    {
        $currentUser = Yii::$app->user->getIdentity();
        $model = $this->findModel($id, $lang_id);
        $cttStaticdataLanguages = CttStaticdataLanguages::find()->orderBy('id')->all();
        $cttStaticdataCountrys = CttStaticdataCountrys::getCountryList();
        $renderParams = [
                            'model' => $model,
                            'currentUser' => $currentUser,
                            'cttStaticdataLanguages' => $cttStaticdataLanguages,
                            'cttStaticdataCountrys' => $cttStaticdataCountrys
                        ];

        if (Yii::$app->request->post()) {
            $model->load(Yii::$app->request->post());

            if ($model->save()) {
                // TODO: Add these data to ctt_publisher_revs table

                FlashMessage::showSuccess(['msg' => 'Updated successfully.']);
                return $this->redirect(['index', 'id' => $model->id]);
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
     * Deletes an existing CttPublishers model.
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

        return $this->redirect(['index', 'id' => $id]);
    }

    /**
     * Finds the CttPublishers model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @param integer $lang_id
     * @return CttPublishers the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id, $lang_id)
    {
        if (($model = CttPublishers::findOne(['id' => $id, 'lang_id' => $lang_id])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}

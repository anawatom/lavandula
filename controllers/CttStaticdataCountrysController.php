<?php

namespace app\controllers;

use Yii;
use app\components\FlashMessage;
use app\components\GlobalVariable;
use app\models\CttStaticdataCountrys;
use app\models\CttStaticdataCountrysSearch;
use app\models\CttSequences;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CttStaticdataCountrysController implements the CRUD actions for CttStaticdataCountrys model.
 */
class CttStaticdataCountrysController extends Controller
{
    public $layout = 'home';

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
     * Lists all CttStaticdataCountrys models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CttStaticdataCountrysSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        GlobalVariable::fetchData();

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single CttStaticdataCountrys model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new CttStaticdataCountrys model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        GlobalVariable::clearData();
        $model = new CttStaticdataCountrys();

        if (Yii::$app->request->post()) {
            $model->load(Yii::$app->request->post());
            $model->id = CttSequences::getValue('STATICDATA_COUNTRY_SEQ');

            if ($result = $model->save()) {
                FlashMessage::showSuccess(['msg' => 'Saved successfully.']);
                return $this->redirect(['index']);
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
    }

    /**
     * Updates an existing CttStaticdataCountrys model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if (Yii::$app->request->post()) {
            $model->load(Yii::$app->request->post());

            if ($model->save()) {
                FlashMessage::showSuccess(['msg' => 'Updated successfully.']);
                return $this->redirect(['index']);
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
     * Deletes an existing CttStaticdataCountrys model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        if ($this->findModel($id)->delete()) {
            FlashMessage::showSuccess(['msg' => 'Deleted successfully.']);
        } else {
            FlashMessage::showSuccess(['msg' => 'Delete failed.']);
        }

        return $this->redirect(['index']);
    }

    /**
     * Finds the CttStaticdataCountrys model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return CttStaticdataCountrys the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = CttStaticdataCountrys::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}

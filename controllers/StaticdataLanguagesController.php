<?php

namespace app\controllers;

use Yii;
use app\components\FlashMessage;
use app\models\CttStaticdataLanguages;
use app\models\CttStaticdataLanguagesSearch;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Json;

/**
 * StaticdataLanguagesController implements the CRUD actions for CttStaticdataLanguages model.
 */
class StaticdataLanguagesController extends base\AppController
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
     * Lists all CttStaticdataLanguages models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CttStaticdataLanguagesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single CttStaticdataLanguages model.
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
     * Creates a new CttStaticdataLanguages model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new CttStaticdataLanguages();

        if (Yii::$app->request->post()) {
            $model->load(Yii::$app->request->post());

            if ($model->save()) {
                // return $this->redirect(['view', 'id' => $model->id]);
                FlashMessage::showSuccess(['msg' => 'Saved successfully.']);
                return $this->redirect(['index']);
            } else {
                // Handler error in here.
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
     * Updates an existing CttStaticdataLanguages model.
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
                // return $this->redirect(['view', 'id' => $model->id]);
                FlashMessage::showSuccess(['msg' => 'Updated successfully.']);
                return $this->redirect(['index']);
            } else {
                // Handler error in here.
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
     * Deletes an existing CttStaticdataLanguages model.
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
     * Finds the CttStaticdataLanguages model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return CttStaticdataLanguages the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = CttStaticdataLanguages::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}

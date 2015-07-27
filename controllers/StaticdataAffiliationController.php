<?php

namespace app\controllers;

use Yii;
use app\models\CttStaticdataAffiliations;
use app\models\CttStaticdataAffiliationsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * StaticdataAffiliationController implements the CRUD actions for CttStaticdataAffiliations model.
 */
class StaticdataAffiliationController extends Controller
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
     * Lists all CttStaticdataAffiliations models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CttStaticdataAffiliationsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single CttStaticdataAffiliations model.
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
     * Creates a new CttStaticdataAffiliations model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new CttStaticdataAffiliations();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id, 'lang_id' => $model->lang_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing CttStaticdataAffiliations model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @param integer $lang_id
     * @return mixed
     */
    public function actionUpdate($id, $lang_id)
    {
        $model = $this->findModel($id, $lang_id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id, 'lang_id' => $model->lang_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing CttStaticdataAffiliations model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @param integer $lang_id
     * @return mixed
     */
    public function actionDelete($id, $lang_id)
    {
        $this->findModel($id, $lang_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the CttStaticdataAffiliations model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @param integer $lang_id
     * @return CttStaticdataAffiliations the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id, $lang_id)
    {
        if (($model = CttStaticdataAffiliations::findOne(['id' => $id, 'lang_id' => $lang_id])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}

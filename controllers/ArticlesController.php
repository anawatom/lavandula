<?php

namespace app\controllers;

use Yii;
use yii\base\Exception;
use yii\helpers\Json;
use yii\web\NotFoundHttpException;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use app\components\FlashMessage;
use app\components\GlobalVariable;
use app\helpers\ErrorHelper;
use app\models\CttArticles;
use app\models\CttSequences;
use app\models\CttJournals;
use app\models\ArticleImporter;
use app\models\CttStaticdataLanguages;
use app\models\CttStaticdataDocumenttypes;
use app\models\CttStaticdataDocsources;
use app\models\CttStaticdataAffiliations;
use app\models\CttStaticdataOrganizations;
use app\models\CttStaticdataSubjectareaClass;

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
            // 'access' => [
            //     'class' => AccessControl::className(),
            //     'only' => ['index'],
            //     'rules' => [
            //         [
            //             'allow' => true,
            //             'roles' => ['superadmin'],
            //         ],
            //     ],
            // ],
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
    	
    	$this->setParameter('languages', $this->getLanguages());
    	
    	$data = $connection
    	->createCommand('SELECT ctt_articles.*, ctt_publishers.name as publisher, ctt_publishers.address as publisher_address, ctt_issues.publish_date 
FROM ctt_articles, ctt_publishers, ctt_issues
where ctt_articles.publisher_id=ctt_publishers.id and ctt_articles.issue_id=ctt_issues.id and ctt_articles.status = :status and ctt_articles.id = :id',
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
    	 
    	$citeds = $connection
    	->createCommand('SELECT * FROM `ctt_article_references` where status=:status and ref_article_id=:id',
    			[
    					'status' => 'A',
    					'id' => $id
    			])->queryAll();
    	$this->setParameter('citeds', $citeds);
    			 
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
    
    public function actionMetadataExtractor(){
    	return $this->cRender('metadataextractor');
    }

    public function actionImporter()
    {
        try {
            $currentUser = Yii::$app->user->getIdentity();
            $postData = Yii::$app->request->post();
            $model = new ArticleImporter();
            $renderParams = [
                                'model' => $model,
                                'cttStaticdataLanguages' => CttStaticdataLanguages::find()->where(['NOT', ['name' => 'English']])->orderBy('id')->all(),
                                'cttStaticdataDocumenttypes' => CttStaticdataDocumenttypes::getDocumenttypeList(),
                                'cttStaticdataDocsources' => CttStaticdataDocsources::getDocsourceList(),
                                'cttStaticdataSubjectareaClass' => CttStaticdataSubjectareaClass::getSubjectareaClassList(),
                                'cttStaticdataOrganizations' => CttStaticdataOrganizations::getOrganizationList(),
                                'cttJournals' => CttJournals::getJournalList()
                            ];
            $transaction = Yii::$app->db->beginTransaction();

            // TODO: Need to refactor later
            if (isset($postData['action']) && $postData['action'] == 'metadataextractor') {

                $xml = simplexml_load_file('web/assets/29205-tag.xml');
                $model->docsource_id = ['1', '2'];
                $model->title_local = strip_tags($xml->metadata->{'title-local'});
                $model->title_en = strip_tags($xml->metadata->{'title-eng'});
                // authors
                $author_name_array = [];
                $authors = $xml->metadata->authors->children();
                $count_authors = count($authors);
                for ($i = 0; $i < $count_authors; $i++ ) {
                    $author_name_array[$i] = strip_tags((string) $authors[$i]);
                }
                // $model->authors['name'] =  $authors_array;
                /* ************** */
                // affiliations
                $organizations_array = [];
                $affiliations = $xml->metadata->affiliations->children();
                $count_affiliations = count($affiliations);
                for ($i = 0; $i < $count_affiliations; $i++ ) {
                    $affiliation_name = strip_tags((string) $affiliations[$i]);

                    // ctt_affiliations
                    $cttStaticdataAffiliations = CttStaticdataAffiliations::find()
                                                    ->where(['name' => $affiliation_name])
                                                    ->one();
                    if (empty($cttStaticdataAffiliations)) {
                        $cttStaticdataAffiliations = new CttStaticdataAffiliations();
                        $cttStaticdataAffiliations->id = $cttStaticdataAffiliations->getId();
                        $cttStaticdataAffiliations->lang_id = '1';
                        // TODO: Need to pull from database
                        $cttStaticdataAffiliations->lang = 'English';
                        $cttStaticdataAffiliations->name = $affiliation_name;
                        // TODO: Need to pull from database
                        $cttStaticdataAffiliations->status = 'A';
                        $cttStaticdataAffiliations->created_by = $currentUser->email;
                        $cttStaticdataAffiliations->modified_by = $currentUser->email;
                        if (!$cttStaticdataAffiliations->save()) {
                            ErrorHelper::throwActiveRecordError($cttStaticdataAffiliations->errors);
                        }
                    }

                    // ctt_organizations
                    $cttStaticdataOrganizations = CttStaticdataOrganizations::find()
                                                        ->where(['affiliation_id' => $cttStaticdataAffiliations->id])
                                                        ->one();
                    if (empty($cttStaticdataOrganizations)) {
                        $cttStaticdataOrganizations = new CttStaticdataOrganizations();
                        $cttStaticdataOrganizations->id = $cttStaticdataOrganizations->getId();
                        $cttStaticdataOrganizations->lang_id = '1';
                        // TODO: Need to pull from database
                        $cttStaticdataOrganizations->lang = 'English';
                        $cttStaticdataOrganizations->affiliation_id = $cttStaticdataAffiliations->id;
                        $cttStaticdataOrganizations->name = $affiliation_name;
                        $cttStaticdataOrganizations->name_full = $affiliation_name;
                        // TODO: Need to pull from database
                        $cttStaticdataOrganizations->status = 'A';
                        $cttStaticdataOrganizations->created_by = $currentUser->email;
                        $cttStaticdataOrganizations->modified_by = $currentUser->email;
                        if (!$cttStaticdataOrganizations->save()) {
                            ErrorHelper::throwActiveRecordError($cttStaticdataOrganizations->errors);
                        }
                    }

                    $organizations_array[$i] = $cttStaticdataOrganizations->id;
                }
                $transaction->commit();
                // $model->authors['org'] =  $organizations_array;
                /* ************** */
                // format data
                $format_author_data = [];
                $count_author_name = count($author_name_array);
                for ($i = 0; $i < $count_author_name; $i++) {
                    $format_author_data[$i]['name'] = $author_name_array[$i];
                    $organization = '';
                    if (isset($organizations_array[$i])) {
                        $organization = $organizations_array[$i];
                    }
                    $format_author_data[$i]['organization'] = $organization;
                }
                $model->authors = $format_author_data;
                /* ********************** */
                $model->abstract_local = strip_tags($xml->{'abstract-local'});
                $model->abstract_en = strip_tags($xml->{'abstract-eng'});
                $model->author_keyword_local = strip_tags($xml->{'keyword-local'});
                $model->author_keyword_en = strip_tags($xml->{'keyword-eng'});
                $renderParams['model'] = $model;
                // var_dump($renderParams['model']);

                return $this->render('importer', $renderParams);
            } else if ($postData) {
                $model->load($postData);
                $model->created_by = $currentUser->email;
                $model->saveData();

                $transaction->commit();
                FlashMessage::showSuccess(['msg' => 'Saved successfully.']);
                return $this->redirect(['public-view', 'id' => $model->id]);
            } else {
                return $this->render('importer', $renderParams);
            }
        }
        // TODO: Need for covering more exception like Database Exception – yii\db\Exception
        catch (Exception $e) {
            $transaction->rollback();
            ErrorHelper::handlerError($e, ['importer']);
        }
    }

    public function actionImporterSubmit(){
    	
    	return $this->cRender('importer');
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

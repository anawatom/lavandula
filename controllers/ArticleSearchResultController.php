<?php
namespace app\controllers;

use Yii;
use yii\db\Query;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
/**
 * Site controller
 */
class ArticleSearchResultController extends base\AppController
{

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index', 'view'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'index' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function actionIndex()
    {
        $keyword = Yii::$app->request->post('keyword');
        $connection = Yii::$app->db;

        $data = $connection
                ->createCommand('SELECT id, title, authors, journal, cited FROM ctt_articles
                                    WHERE status = :status
                                    AND lang_id=(SELECT min(lang_id)
                                                FROM ctt_articles t2
                                                WHERE t2.id=ctt_articles.id
                                                AND MATCH (title_fulltext, abstract_fulltext, author_keyword, auto_keyword) 
                                                AGAINST (:keyword) GROUP BY id) LIMIT 100',
                                [
                                    'status' => 'A',
                                    'keyword' => $keyword
                                ])
                ->queryAll();
        
        $this->setParameter('data', $data);
        $this->setParameter('keyword', $keyword);
        $this->setParameter('refineByYears', $this->getRefineByYears($keyword));

        return $this->cRender('index');
    }
    
    private function getRefineByYears($keyword){
    	$connection = Yii::$app->db;

        $data = $connection
                ->createCommand('
			    	SELECT ctt_issues.year, COUNT(1) as cnt FROM ctt_articles, ctt_issues
			    	WHERE ctt_articles.issue_id=ctt_issues.id AND ctt_articles.status = :status
			    			AND lang_id=(SELECT min(lang_id)
			    					FROM ctt_articles t2
			    					WHERE t2.id=ctt_articles.id
			    					AND MATCH (title_fulltext, abstract_fulltext, author_keyword, auto_keyword)
			    					AGAINST (:keyword) GROUP BY id) GROUP BY ctt_issues.year ORDER BY ctt_issues.year DESC',
                                [
                                    'status' => 'A',
                                    'keyword' => $keyword
                                ])
                ->queryAll();
        return $data;
    }
}
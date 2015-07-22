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
                        'actions' => ['index'],
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
                ->createCommand('SELECT * FROM ctt_articles
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

        return $this->render('index', ['data' => $data, 'keyword' => $keyword]);
    }
}
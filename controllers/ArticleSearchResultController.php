<?php
namespace app\controllers;

use Yii;
use yii\db\Query;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\data\Pagination;
use app\models\CttArticles;
use yii\web\Session;
/**
 * Site controller
 */
class ArticleSearchResultController extends base\AppController
{
	
	private $criteria = ['status'=>'A'];
	
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
                        'actions' => ['index', 'view', 'get-search-result', 'get-refine-by-years', 'advance-search', 'add-refine'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                 'index' => ['post'],
//                 	'get-search-result' => ['post', 'get'],
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
    	
    	$session = Yii::$app->session;
    	$session->open();
    	
        $type = Yii::$app->request->post('type');
        if(empty($type)) throw new Exception("Require parameter -> type");
        if($type=='basic'){
        	
        	$keyword = Yii::$app->request->post('keyword');
        	$this->setParameter('keyword', $keyword);
        	
        	$this->clearCriteria();
        	$this->setCriteria('', 'title', 'like', $keyword);
        	$this->setCriteria('OR', 'abstract', 'like', $keyword);
        	$this->setCriteria('OR', 'author_keyword', 'like', $keyword);
        	
        }else if($type=='advance'){
        	
        	$arr_cause = Yii::$app->request->post('cause');
        	$arr_operand = Yii::$app->request->post('operand');
        	$arr_keyword = Yii::$app->request->post('keyword'); 
        	$arr_field = Yii::$app->request->post('field');
        	$doctype = Yii::$app->request->post('doctype');
        	$year_start = Yii::$app->request->post('year_start');
        	$year_end = Yii::$app->request->post('year_end');
			
        	$this->clearCriteria();
        	//TODO: add Criteria
        	
        	$from = [];
        	
        	for($i=0; $i<count($arr_field); $i++){
//         		$this->setCriteria($arr_cause[$i], )
				switch($arr_field[$i]){
					case 'topic' :
						$this->setCriteria($arr_cause[$i], 'title', $arr_operand[$i], $arr_keyword[$i]);
						break;
					case 'author' :
						$from['ctt_article_authors'] = 'ctt_article_authors.article_id=ctt_articles.id';
						$from['ctt_authors'] = "ctt_article_authors.author_id=ctt_authors.id";
						$this->setCriteria($arr_cause[$i], 'ctt_authors.fname', $arr_operand[$i], $arr_keyword[$i]);
						break;
					case 'journal' :
						break;
					case 'affiliation' :
						break;
					case 'publisher' :
						break;
					case 'doi' :
						break;
					case 'year' :
						break;
					case 'citedauthor' :
						break;
						
					default :
				}
        	}
        	
        	$session['tables'] = $from;
        	
//         	$this->setCriteria($cause, $field, $operand, $value);
        	$this->setParameter('keyword', '**Advance Search**');
        }
        
        $this->setParameter('type', $type);

        return $this->cRender('index');
    }
    
    public function actionAdvanceSearch(){
    	
    	
    	return $this->cRender('advance-search-form');
    }
    
    public function addRefine(){
    	$this->layout='ajax';
    	$session = Yii::$app->session;
    	$session->open();
    	
    	$field = Yii::$app->request->post('field');
    	
    	$keyword = Yii::$app->request->post('keyword');
    	
    	$tmp_session = $session['refine'];
    	
    	
    	$session['refine'] = $tmp_session;
    }
    
    private function clearCriteria(){
    	$session = Yii::$app->session;
    	$session->open();
    	
    	$session['keyword'] = [];
    }
    
    private function setCriteria($cause, $field, $operand, $value){

    	$session = Yii::$app->session;
    	$session->open();
    	
    	if(!isset($session['keyword'])){
    		$session['keyword'] = [];
    	}
    	$tmp_session = $session['keyword'];
    	
    	if(!empty($field)){
//     		array_push($tmp_session, [$field=>['cause'=>$cause, 'operand'=>$operand, 'value'=>$value]]);
    		$tmp_session[$field] = ['cause'=>$cause, 'operand'=>$operand, 'value'=>$value];
    	}
    	
    	$session['keyword'] = $tmp_session;
    	
    }
    
    private function getWhere(&$where, &$arr_where){
    	$session = Yii::$app->session;
    	$session->open();
    	
    	$where = '';
    	$arr_where = ['status' => 'A'];
    	
    	foreach($session['keyword'] as $field=>$keyword){

    		$where.= " {$keyword['cause']} {$field} {$keyword['operand']} :".str_replace('.', '_', $field)."";
    		$arr_where[str_replace('.', '_', $field)] = $keyword['operand']=='like'?"%{$keyword['value']}%":$keyword['value'];
    	}
    	
    }
    
    private function getFrom($froms, &$tablex, &$onx){
    	$tablex = '';
    	$onx = '';
    	foreach($froms as $table=>$on){
    		$tablex .= ','.$table;
    		if(!empty($onx)) $onx .= ' AND '.$on;
    	}

//     	$tablex = rtrim($tablex, ",");
//     	$onx = rtrim($onx, " AND ");
    }
    
    private function countData($from=[]){
    	$fields = 'count(1) as cnt';
//     	$from = 'ctt_articles';
    	$where = '';
    	$arr_where = [];
    	 
    	$this->getWhere($where, $arr_where);
    	$this->getFrom($from, $table, $on);
    	
    	$sql = "SELECT {$fields}
		    	FROM ctt_articles
		    	WHERE ctt_articles.status = :status
		    			AND ctt_articles.lang_id=
		    			(SELECT min(t2.lang_id)
		    					FROM ctt_articles t2 {$table}
		    					WHERE t2.id=ctt_articles.id {$on}
		    					AND ctt_article_authors.article_id=t2.id
		    					AND ctt_article_authors.author_id=ctt_authors.id
		    					AND ({$where})
		    					GROUP BY t2.id)";
    	
//     	echo $sql;
//     	print_r($arr_where); exit();
    	 
    	 
    	$connection = Yii::$app->db;
//     	$connection->emulatePrepare = true;
//     	$connection->setAttribute(ATTR_EMULATE_PREPARES, TRUE);
    	$data = $connection->createCommand($sql, $arr_where)->queryAll();
    	return $data[0]['cnt'];
    }
    
    private function queryData($pages, $from=[]){
    	
    	$fields = 'id, title, authors, journal, cited';
//     	$from = 'ctt_articles';
    	$where = '1=1';
    	$arr_where = [];
    	$limit = 'LIMIT :offset, :limit';
    	
    	$this->getWhere($where, $arr_where);
    	$this->getFrom($from, $table, $on);

    	$arr_where['offset'] = $pages->offset;
    	$arr_where['limit'] = $pages->limit;
    	
    	$sql = "SELECT {$fields}
    	FROM ctt_articles
    	WHERE ctt_articles.status = :status
    			AND ctt_articles.lang_id=
    			(SELECT min(t2.lang_id)
    					FROM ctt_articles t2 {$table}
    					WHERE t2.id=ctt_articles.id {$on}
    					AND ctt_article_authors.article_id=t2.id
    					AND ctt_article_authors.author_id=ctt_authors.id
    					AND ({$where})
    					GROUP BY t2.id) {$limit}";
    	
//     	$sql = "SELECT {$fields} FROM {$table}
// 				WHERE status = :status {$on}
// 				AND lang_id=(SELECT min(lang_id)
// 				FROM ctt_articles t2
// 				WHERE t2.id=ctt_articles.id
// 				AND ({$where}) 
//     			GROUP BY id) {$limit}";
    	
    	
    	$connection = Yii::$app->db;
    	$data = $connection->createCommand($sql, $arr_where)->queryAll();
    	
    	return $data;
    }
    
    public function actionGetSearchResult(){
    	
    	$this->layout='ajax';
    	
    	$session = Yii::$app->session;
    	$session->open();
    	
    	$type = Yii::$app->request->post('type');
//     	$keyword = Yii::$app->request->post('keyword');
    	
    	if(empty($type)) throw Exception('Require parameter -> type');
    	
    	if($type='basic'){
//     		$this->clearCriteria();
//     		$this->setCriteria('', 'title', 'like', $keyword);
//     		$this->setCriteria('OR', 'abstract', 'like', $keyword);
//     		$this->setCriteria('OR', 'author_keyword', 'like', $keyword);
//     		print_r($session['keyword']);
//     		exit();
    		$count = $this->countData($session['tables']);
    		$pages = new Pagination(['totalCount' => $count, 'pageSize'=>10]);
    		$data = $this->queryData($pages, $session['tables']);
    		$this->setParameter('keyword', $session['keyword']);
    		
    	}else if($type='advance'){
//     		$this->clearCriteria();
    		$this->setParameter('keyword', '**Advance Searching**');
    	}
    	$this->setParameter('count', $count);
    	$this->setParameter('data', $data);
    	$this->setParameter('pages', $pages);
    	return $this->cRender('get-search-result');
    }
    
    public function actionGetSearchResultXX(){
    	$this->layout='ajax';
    	$session = Yii::$app->session;
    	$session->open();

    	$type = Yii::$app->request->post('type');
        $keyword = Yii::$app->request->post('keyword');
        
        if(isset($keyword)){
        	$session['keyword'] = $keyword;
        }
        
        $connection = Yii::$app->db;

//         $select_count= ' count(1) ';
//         $select_result= ' id, title, authors, journal, cited ';
//         $sql = "SELECT  FROM ctt_articles
//                                     WHERE status = :status
//                                     AND lang_id=(SELECT min(lang_id)
//                                                 FROM ctt_articles t2
//                                                 WHERE t2.id=ctt_articles.id
//                                                 AND (title like :keyword OR abstract like :keyword OR author_keyword like :keyword) GROUP BY id) LIMIT :offset, :limit";
//         $where = "title like :keyword OR abstract like :keyword OR author_keyword like :keyword";
//         $limit = " LIMIT :offset, :limit ";

        $count = $connection
        ->createCommand('SELECT count(1) as cnt FROM ctt_articles
                                    WHERE status = :status
                                    AND lang_id=(SELECT min(lang_id)
                                                FROM ctt_articles t2
                                                WHERE t2.id=ctt_articles.id
                                                AND (title like :keyword OR abstract like :keyword OR author_keyword like :keyword) GROUP BY id)',
        		[
        				'status' => 'A',
        				'keyword' => '%'.$session['keyword'].'%'
        		])
        		->queryAll();
        
		$count = $count[0]['cnt'];
        $pages = new Pagination(['totalCount' => $count, 'pageSize'=>10]);

        $data = $connection
        ->createCommand('SELECT id, title, authors, journal, cited FROM ctt_articles
                                    WHERE status = :status
                                    AND lang_id=(SELECT min(lang_id)
                                                FROM ctt_articles t2
                                                WHERE t2.id=ctt_articles.id
                                                AND (title like :keyword OR abstract like :keyword OR author_keyword like :keyword) GROUP BY id) LIMIT :offset, :limit',
        		[
        				'status' => 'A',
        				'keyword' => '%'.$session['keyword'].'%',
        				'offset' => $pages->offset,
        				'limit' => $pages->limit
        		])
        		->queryAll();

        $this->setParameter('count', $count);
        $this->setParameter('data', $data);
        $this->setParameter('pages', $pages);
        $this->setParameter('keyword', $session['keyword']);
//         $this->setParameter('refineByYears', $this->getRefineByYears($session['keyword']));

        return $this->cRender('get-search-result');
    }
    
    public function actionGetRefineByYears(){
    	$this->layout='ajax';
    	$keyword = Yii::$app->request->post('keyword');
    	$this->setParameter('refineByYears', $this->getRefineByYears($keyword));
    	
    	return $this->cRender('get-refine-by-year');
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
			    					AND (title like :keyword OR abstract like :keyword OR author_keyword like :keyword) GROUP BY id) GROUP BY ctt_issues.year ORDER BY ctt_issues.year DESC LIMIT 0, 5',
                                [
                                    'status' => 'A',
                                    'keyword' => '%'.$keyword.'%'
                                ])
                ->queryAll();
        return $data;
    }
}
<?php
	use yii\helpers\Html;
	use yii\helpers\Url;	
	
	function highlight_word( $str, $search, $color="orange" ) {
// 		if(empty($str)) return $str;
		$highlightcolor = "#daa732";
	    $occurrences = @substr_count(strtolower($str), strtolower($search));
	    $newstring = $str;
	    $match = array();
	 
	    for ($i=0;$i<$occurrences;$i++) {
	        $match[$i] = stripos($str, $search, $i);
	        $match[$i] = substr($str, $match[$i], strlen($search));
	        $newstring = str_replace($match[$i], '[#]'.$match[$i].'[@]', strip_tags($newstring));
	    }
	 
	    $newstring = str_replace('[#]', '<span style="color: '.$highlightcolor.';">', $newstring);
	    $newstring = str_replace('[@]', '</span>', $newstring);
	    return $newstring;
		
	}
?>


<div style="text-align:right;padding-right:20px;">
<?php 
	echo \yii\widgets\LinkPager::widget([
	    'pagination' => $pages,
	]);
?>
</div>
<ul class="nav nav-pills nav-stacked search-results">
	<?php if (!empty($data)) : ?>
	
	<?php foreach($data as $key=>$row):?>
	<li>
		<div class="row result-list">
			<div class="col-md-11">
				<a href="<?=Url::to(['/articles/public-view', 'id'=>$row['id']]);?>" target="_blank"><p class="title"><?=highlight_word($row['title'], $keyword['title']['value'])?></p></a>
				<p class="authors"> By 
				<?php 
					$authors = json_decode($row['authors']);
					$author_count = count($authors);
					$print_comma = false;
					for($i=0; $i<$author_count; $i++){
						foreach($authors[$i] as $author_id=>$author_row){
							if($print_comma){ echo ', '; }else{ $print_comma=true; }
							echo "<a href=\"#\">".highlight_word($author_row->name, $keyword['title']['value'])."</a>";
						}
					}
				?>
				</p>
				<a href="#"><p class="journal"><?=highlight_word($row['journal'], $keyword['title']['value'])?></p></a>
			</div>
			<div class="col-md-1"><p class="cited">Cited<br /><?=(empty($row['cited'])?'0':$row['cited'])?></p></div>
		</div>
	</li>
	<?php endforeach;?>
	
	<?php else: ?>
		<div class="col-md-1"></div>
		<div class="col-md-11">0 Found.</div>
	<?php endif;?>
</ul>
<div style="text-align:right;padding-right:20px;">
<?php 
	echo \yii\widgets\LinkPager::widget([
	    'pagination' => $pages,
	]);
?>
</div>

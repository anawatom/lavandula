<?php
	use yii\helpers\Html;
	use yii\helpers\Url;
?>

<style type="text/css">
.panel-body .row{
/* 	padding: 0 !important; */
	margin: 0;
}
.panel-body h2, .panel-body h3, .panel-body h4{
	padding:0;
	margin:0;
}
.tab-pane{
	padding:10px;
}
.padding-t1{
	padding-top:10px;
}
.padding-t2{
	padding-top:20px;
}
.row2{
	padding: 5px 0;
}
</style>

<?php 
	$isOneLanguage = count($data)<2;
?>

<div class="row content">
	<div class="col-md-12">
		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-warning dummy-data">
					<div class="panel-heading">
						<h3 class="panel-title">Metadata</h3>
					</div>
					<div class="panel-body search-result-contents">
						<div class="row">
							<a href="#"><?=$data[0]['publisher']?></a> <?=$data[0]['publisher_address']?> 
						</div>
						<div class="row">
							<a href="#"><?=$data[0]['journal']?></a> Volume <?=$data[0]['volume']?> <?=$data[0]['year']?>, p <?=$data[0]['page_start']?>
						</div>
						<div class="row padding-t1">
							<h2><?=$data[0]['title']?></h2>
							<?=$data[0]['doi']?'<a href="">DOI : '.$data[0]['doi'].'</a>':''?>
						</div>
						<div class="row" style="font-style:italic;">
							<?php 
								$authors = json_decode($data[0]['authors']);
								$author_count = count($authors);
								$print_comma = false;
								for($i=0; $i<$author_count; $i++){
									foreach($authors[$i] as $author_id=>$row){
										if($print_comma){ echo ', '; }else{ $print_comma=true; }
										echo "<a href=\"#\">{$row->name}</a>";
									}
								}
							?>
						</div>
						<div style="<?=$isOneLanguage?'':'padding-top:20px;'?>">
						  <?php if(!$isOneLanguage):?>
						  <!-- Nav tabs -->
						  <ul class="nav nav-tabs" role="tablist">
						  	<?php $isFirst = true; ?>
						  	<?php foreach($data as $row):?>
						  		<li role="presentation" class="<?php if($isFirst){ echo 'active'; $isFirst=false; } ?>">
						  			<a href="#lang-<?=$languages[$row['lang_id']]?>" aria-controls="lang-<?=$languages[$row['lang_id']]?>" role="tab" data-toggle="tab"><?=$languages[$row['lang_id']]?></a>
						  		</li>
						  	<?php endforeach;?>
						  </ul>
						  <?php endif;?>
						
						  <!-- Tab panes -->
						  <div class="tab-content">
						  	<?php $isFirst = true; ?>
						  	<?php foreach($data as $row):?>
						  		<div role="tabpanel" class="tab-pane fade<?php if($isFirst){ echo ' in active'; $isFirst=false; } ?>" id="lang-<?=$languages[$row['lang_id']]?>">
						  		<?php if(!$isOneLanguage):?>
						  			<div class="row2">
						  				<h3><?=$row['title']?></h3>
						  			</div>
						  			<div class="row2" style="font-style:italic;">
										<?php 
											if(!empty($row['authors'])){
												$authors = json_decode($row['authors']);
												$author_count = count($authors);
												$print_comma = false;
												for($i=0; $i<$author_count; $i++){
													foreach($authors[$i] as $author_id=>$row_1){
														if($print_comma){ echo ', '; }else{ $print_comma=true; }
														echo "<a href=\"#\">{$row_1->name}</a>";
													}
												}
											}
										?>
									</div>
						  			<div class="row2">
						  				<a href=""><?=$row['journal']?></a> Volume <?=$data[0]['volume']?> <?=$data[0]['year']?>, p <?=$data[0]['page_start']?>
						  			</div>
						  		<?php endif;?>
						  			<div class="row2">
						  				<b>Abstract</b> : <?=empty($row['abstract'])?'<i>Comming soon</i>':$row['abstract']?>
						  			</div>
						  			<div class="row2">
						  				<b>Keywords</b> : <?=empty($row['author_keyword'])?'<i>Comming soon</i>':$row['author_keyword']?>
						  			</div>
						  			<div class="row2">
						  				<b>Date of publication</b> : <?=empty($row['publish_date'])?'<i>Not found</i>':$row['publish_date']?>
						  			</div>
						  			<div class="row2">
						  				Link : <a href="<?=$row['link']?>"><?=$row['link']?></a>
						  			</div>
						  			<?php if(!empty($row['sponsors'])):?>
						  			<div class="row2">
						  				Sponsers : <?=$row['sponsors']?>
						  			</div>
						  			<?php endif;?>
						  			<?php if(!empty($row['doi']) || !empty($row['codenid']) || !empty($row['pubmedid'])):?>
						  			<div class="row2">
						  				<?php if(!empty($row['doi'])):?>
						  				<div class="col-md-4">
						  					DOI : <?=$row['doi']?>
						  				</div>
						  				<?php endif;?>
						  				<?php if(!empty($row['codenid'])):?>
						  				<div class="col-md-4">
						  					CODENID : <?=$row['codenid']?>
						  				</div>
						  				<?php endif;?>
						  				<?php if(!empty($row['pubmedid'])):?>
						  				<div class="col-md-4">
						  					PUBMEDID : <?=$row['pubmedid']?>
						  				</div>
						  				<?php endif;?>
						  			</div>
						  			<?php endif;?>
						  			<div class="row2">
						  				Subject Area :
						  			</div>
						  		</div>
						  	<?php endforeach;?>
						  </div>
						
						</div>
						
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-warning dummy-data">
					<div class="panel-heading">
						<h3 class="panel-title">Reference</h3>
					</div>
					<div class="panel-body search-result-contents">
						<?php if(!empty($references)) : ?>
						<?php foreach ($references as $reference_id => $reference) : ?>
							<div class="row2">
								<?=$reference['authors']?>, 
								Year <?=$reference['year']?>, 
								<?=$reference['topic']?>, 
								<?=$reference['journal']?> vol.<?=empty($reference['issue_no'])?'-':$reference['issue_no']?> p.<?=$reference['page_no']?>, 
								<?php if(!empty($reference['doi'])): ?>DOI:<?=$reference['doi']?> <?php endif;?>
							</div>
						<?php endforeach;?>
						<?php else :?>
							Not found.
						<?php endif;?>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-warning dummy-data">
					<div class="panel-heading">
						<h3 class="panel-title">Cited</h3>
					</div>
					<div class="panel-body search-result-contents">
						<?php if(!empty($citeds)) : ?>
						<?php foreach ($citeds as $reference_id => $reference) : ?>
							<div class="row2">
								<?=$reference['authors']?>, 
								Year <?=$reference['year']?>, 
								<?=$reference['topic']?>, 
								<?=$reference['journal']?> vol.<?=empty($reference['issue_no'])?'-':$reference['issue_no']?> p.<?=$reference['page_no']?>
								<?php if(!empty($reference['doi'])): ?>, DOI:<?=$reference['doi']?> <?php endif;?>
							</div>
						<?php endforeach;?>
						<?php else :?>
							No Cited.
						<?php endif;?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

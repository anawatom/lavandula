<?php
	use yii\helpers\Html;
	use yii\helpers\Url;
?>

<div style="height:10px;"></div>


<div class="page-header">
  <h1>View Article <br /><small>Title Name</small></h1>
</div>
<?php if (!empty($data)) : ?>
<h3>Publisher</h3>
<p><?=$data[0]['publisher']?></p>
<h3>Journal</h3>
<p><?=$data[0]['journal']?></p>
<h3>Title</h3>
<p><?=$data[0]['title']?></p>
<h3>Abstract</h3>
<p><?=$data[0]['abstract']?></p>
<div>
<?php if (\Yii::$app->user->can('ArticleManagement')) : ?>
	<?=Html::Button('Edit Article Details')?>
<?php endif ?>
</div>
<h3>References</h3>
	<?php if(!empty($references)) : ?>
		<table style="border-spacing: 10px;border-collapse: separate;">
			<tr><th>Topic</th>
			<th>Journal</th>
			<th>Authors</th>
			<th>Page No.</th>
			<th>Year</th>
			<th>Year No.</th></tr>
		<?php foreach ($references as $reference_id => $reference) : ?>
			<tr><td><?=$reference['topic']?></td>
			<td><?=$reference['journal']?></td>
			<td><?=$reference['authors']?></td>
			<td><?=$reference['page_no']?></td>
			<td><?=$reference['year']?></td>
			<td><?=$reference['year_no']?></td></tr>
		<?php endforeach ?>
		</table>
	<?php endif ?>

<?php else : ?>
	No data.
<?php endif ?>

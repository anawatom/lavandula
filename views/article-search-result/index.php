<?php
	use yii\helpers\Html;
	use yii\helpers\Url;
?>
<div class="page-header">
  <h1>Article Search Result <br /><small>Keyword: <?= $keyword ?></small></h1>
</div>
<?php if (!empty($data)) : ?>
	<table class="table table-responsive table-hover">
		<tr>
			<th style="width: 40%;">title</th>
			<th style="width: 15%;">authors</th>
			<th style="width: 15%;">year</th>
			<th style="width: 15%;">organization</th>
			<th style="width: 15%;">cited</th>
		<tr>
		<?php foreach ($data as $key => $value) : ?>
			<tr>
				<td><a href="?r=articles/public-view&id=<?= $value['id'] ?>"><?= $value['title'] ?></a></td>
				<td>
					<?php //echo $value['authors']; ?>
					<?php $authors = json_decode($value['authors'], true); ?>
					<?php if (!empty($authors)) : ?>
						<uL>
							<?php foreach ($authors as $authorsIdKey => $authorsIdValue) : ?>
								<?php foreach ($authorsIdValue as $authorsKey => $authorsValue) : ?>
									<li><?= $authorsValue['name']; ?></li>
								<?php endforeach ?>
							<?php endforeach ?>
						</ul>
					<?php endif ?>
				</td>
				<td><?= $value['year'] ?></td>
				<td><?= $value['organization'] ?></td>
				<td><?= $value['cited'] ?></td>
			</tr>
		<?php endforeach ?>
	</table>
<?php else : ?>
	No data.
<?php endif ?>

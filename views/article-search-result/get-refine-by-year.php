<table style="width:100%;">
<?php foreach($refineByYears as $year_row): ?>
	<tr>
		<td class="refine-name"><input type="checkbox" onclick="onclick_RefineBy('year', '<?=$year_row['year']?>')" /> <?=$year_row['year']?></td>
		<td class="refine-cnt">(<?=$year_row['cnt']?>)</td>
	</tr>
<?php endforeach; ?>
</table>
<div class="show-all">Show All</div>
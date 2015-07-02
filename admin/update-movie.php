<?php
include_once 'header.php';

/*
$desc = $db->query('DESC movies')->fetchAll();
foreach($desc as $key => $field) {
	echo $field['Field'].'<br>';
}
*/

$fields = array(
	'slug',
	'title',
	'year',
	'genres',
	'synopsis',
	'directors',
	'actors',
	'writers',
	'runtime',
	'mpaa',
	'rating',
	'popularity',
	'modified',
	'created',
	'poster_flag',
	'cover',
);
?>

<form class="form-horizontal" action="" method="POST" novalidate>

<?php
foreach($fields as $field) {

echo PHP_EOL;
?>
<div class="form-group">
	<label for="<?= $field ?>" class="col-sm-2 control-label"><?= $field ?></label>
	<div class="col-sm-3">
		<input type="text" id="<?= $field ?>" name="<?= $field ?>" class="form-control" placeholder="<?= $field ?>" value="">
	</div>
</div>
<?php } ?>

</form>

<?php include_once 'footer.php'; ?>
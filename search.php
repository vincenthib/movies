<?php
include_once 'header.php';

debug($_GET);

$min_max_year = $db->query('SELECT MIN(year) as min_year, MAX(year) as max_year FROM movies')->fetch();

$range_years = range($min_max_year['max_year'], $min_max_year['min_year']);

$movie_years = array();
$results = $db->query('SELECT DISTINCT(year) FROM movies ORDER BY year DESC')->fetchAll();
foreach($results as $result) {
	$movie_years[] = $result['year'];
}

$genres = $db->query('SELECT * FROM genres ORDER BY genre_name ASC')->fetchAll();

?>
<h1>Recherche</h1>

<hr>

<form class="form-inline" action="search.php" method="GET">
	<div class="form-group">
		<label for="title">Titre</label>
		<input type="text" id="title" name="title" class="form-control" placeholder="Star Wars" value="">
	</div>

	<div class="form-group">
		<label for="title">Genre</label>
		<select id="genre" name="genre" class="form-control">
			<option value="">...</option>
			<?php foreach($genres as $genre) { ?>
			<option value="<?= $genre['genre_label'] ?>"><?= $genre['genre_name'] ?></option>
			<?php } ?>
		</select>
	</div>

	<div class="form-group">
		<label for="title">Année</label>
		<select id="year" name="year" class="form-control">
			<option value="">...</option>
			<?php
			//for ($year = $current_year; $year >= 1900; $year--) {
			foreach($range_years as $year) {
				$inactive = '';
				if (!in_array($year, $movie_years)) {
					$inactive = ' disabled="disabled" class="disabled"';
				}
			?>
			<option value="<?= $year ?>"<?= $inactive ?>><?= $year ?></option>
			<?php } ?>
		</select>
	</div>

	<div class="form-group">
		<label for="title">Acteur</label>
		<input type="text" id="casting" name="casting" class="form-control" placeholder="Christopher Lloyd" value="">
	</div>

	<div class="form-group">
		<label for="title">Réalisateur</label>
		<input type="text" id="director" name="director" class="form-control" placeholder="Robert Zemeckis" value="">
	</div>

	<div class="form-group">
		<button type="submit" class="btn btn-default">
			<span class="glyphicon glyphicon-search" aria-hidden="true"></span> Rechercher
		</button>
	</div>
</form>

<?php

if (!empty($_GET)) {

	$count_results = 0;
	$search_results = array();

	if (!empty($_GET['search'])) {

		$search = $_GET['search'];

		$query = $db->prepare('SELECT * FROM movies WHERE title LIKE :search OR synopsis LIKE :search OR actors LIKE :search');
		$query->bindValue('search', '%'.$search.'%');
		$query->execute();
		$search_results = $query->fetchAll();

		//$count_results = count($search_results); // Count PHP
		$count_results = $query->rowCount(); // Count PDO plus rapide
	}
?>
<hr>

<h3><?= $count_results ?> résultat(s) pour la recherche <?= !empty($search) ? '"'.$search.'"' : '' ?></h3>

<br>

<div class="search-results list-group">

	<?php foreach($search_results as $movie) { ?>
	<a href="movie.php?id=<?= $movie['id'] ?>" class="list-group-item">
		<img height="80" width="60" class="movie-cover" src="<?= getCover($movie['id']) ?>" align="left">
		<h4 class="list-group-item-heading"><?= $movie['title'] ?> (<?= $movie['year'] ?>)</h4>
		<p class="list-group-item-text">
			<?= $movie['genres'] ?>
			<br>
			<?= $movie['actors'] ?>
		</p>
	</a>
	<?php } ?>

</div>
<?php } ?>

<?php include_once 'footer.php' ?>
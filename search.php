<?php
include_once 'header.php';

$min_max_year = $db->query('SELECT MIN(year) as min_year, MAX(year) as max_year FROM movies')->fetch();

$range_years = range($min_max_year['max_year'], $min_max_year['min_year']);

$movie_years = array();
$results = $db->query('SELECT DISTINCT(year) FROM movies ORDER BY year DESC')->fetchAll();
foreach($results as $result) {
	$movie_years[] = $result['year'];
}

$movie_genres = $db->query('SELECT * FROM genres ORDER BY genre_name ASC')->fetchAll();

$title = !empty($_GET['title']) ? $_GET['title'] : '';
$genre = !empty($_GET['genre']) ? $_GET['genre'] : '';
$year = !empty($_GET['year']) ? $_GET['year'] : '';
$actors = !empty($_GET['actors']) ? $_GET['actors'] : '';
$directors = !empty($_GET['directors']) ? $_GET['directors'] : '';

?>
<h1>Recherche</h1>

<hr>

<form class="form-inline" action="search.php" method="GET">
	<div class="form-group">
		<label for="title">Titre</label>
		<input type="text" id="title" name="title" class="form-control" placeholder="Star Wars" value="<?= $title ?>">
	</div>

	<div class="form-group">
		<label for="title">Genre</label>
		<select id="genre" name="genre" class="form-control">
			<option value="">...</option>
			<?php
			foreach($movie_genres as $movie_genre) {
				/*
				$selected = '';
				if ($movie_genre['genre_label'] == $genre) {
					$selected = ' selected="selected"';
				}
				*/
				$selected = $movie_genre['genre_label'] == $genre ? ' selected="selected"' : '';
			?>
			<option value="<?= $movie_genre['genre_label'] ?>"<?= $selected ?>><?= $movie_genre['genre_name'] ?></option>
			<?php } ?>
		</select>
	</div>

	<div class="form-group">
		<label for="title">Année</label>
		<select id="year" name="year" class="form-control">
			<option value="">...</option>
			<?php
			//for ($year = $current_year; $year >= 1900; $year--) {
			foreach($range_years as $movie_year) {
				$inactive = '';
				if (!in_array($movie_year, $movie_years)) {
					$inactive = ' disabled="disabled" class="disabled"';
				}
				/*
				$selected = '';
				if ($movie_year == $year) {
					$selected = ' selected="selected"';
				}
				*/
				$selected = $movie_year == $year ? ' selected="selected"' : '';
			?>
			<option value="<?= $movie_year ?>"<?= $inactive.$selected ?>><?= $movie_year ?></option>
			<?php } ?>
		</select>
	</div>

	<div class="form-group">
		<label for="title">Acteur</label>
		<input type="text" id="actors" name="actors" class="form-control" placeholder="Christopher Lloyd" value="<?= $actors ?>">
	</div>

	<div class="form-group">
		<label for="title">Réalisateur</label>
		<input type="text" id="directors" name="directors" class="form-control" placeholder="Robert Zemeckis" value="<?= $directors ?>">
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
	} else {

		$bindings = array();

		$sql = 'SELECT * FROM movies WHERE 1';

		if (!empty($title)) {
			$sql .= ' AND title LIKE :title';
			$bindings['title'] = '%'.$title.'%';
		}
		if (!empty($genre)) {
			$sql .= ' AND genres LIKE :genre';
			$bindings['genre'] = '%'.$genre.'%';
		}
		if (!empty($year)) {
			$sql .= ' AND year = :year';
			$bindings['year'] = $year;
		}
		if (!empty($actors)) {
			$sql .= ' AND actors LIKE :actors';
			$bindings['actors'] = '%'.$actors.'%';
		}
		if (!empty($directors)) {
			$sql .= ' AND directors LIKE :directors';
			$bindings['directors'] = '%'.$directors.'%';
		}

		if (!empty($bindings)) {

			$query = $db->prepare($sql);

			foreach($bindings as $key => $value) {
				$query->bindValue($key, $value);
			}

			$query->execute();
			$search_results = $query->fetchAll();
			$count_results = $query->rowCount();
		}
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
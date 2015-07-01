<?php

//debug($movie);

if (empty($movie)) {
	exit('Undefined movie');
}

// On récupère l'id du film sur lequel on se trouve
$id = $movie['id'];

// Si le tableau des films visités n'existe pas
if (!isset($_SESSION['movies'])) {
	// On initialise le tableau
	$_SESSION['movies'] = array();
}

// On ajoute en clé l'id du film et en valeur la date d'ajout en timestamp
$_SESSION['movies'][$id] = time();

// On tri le tableau par date d'ajout décroissant
arsort($_SESSION['movies']);

// On ne garde que les 4 derniers films visités en préservant les clés du tableau
$_SESSION['movies'] = array_slice($_SESSION['movies'], 0, 4, $preserve_keys = true);

$_movie_genres = $db->query('SELECT * FROM genres ORDER BY genre_name ASC')->fetchAll();

$movie_genres = array();
foreach($_movie_genres as $movie_genre) {
	$movie_genres[$movie_genre['genre_label']] = $movie_genre['genre_name'];
}

$genres = explode(', ', $movie['genres']);
$actors = explode(', ', $movie['actors']);
$directors = explode(', ', $movie['directors']);

$back_link = 'index.php';
if (!empty($_SERVER['HTTP_REFERER'])) {
	$back_link = $_SERVER['HTTP_REFERER'];
}
?>
<a href="<?= $back_link ?>" class="btn btn-default" role="button">&laquo; Retour</a>

<hr>

<div class="row movie-container">
	<div class="col-xs-12 col-sm-9">
		<div class="media">
			<div class="media-left">
				<img src="<?= getCover($movie['id']) ?>">
			</div>
			<div class="media-body">
				<h2><?= $movie['title'] ?></h2>
				<hr>
				<p><strong>Date de sortie :</strong> <a href="search.php?year=<?= $movie['year'] ?>"><?= $movie['year'] ?></a> (<?= getDuration($movie['runtime']) ?>)</p>
				<p>
					<strong>Genres :</strong>&nbsp;
					<?php
					foreach($genres as $genre) {
						$genre_label = strtolower($genre);
						$genre_name = $movie_genres[$genre_label];
					?>
					<a href="search.php?genre=<?= $genre_label ?>"><?= $genre_name ?></a>,&nbsp;
					<?php } ?>
				</p>
				<p>
					<strong>Acteurs :</strong>&nbsp;
					<?php foreach($actors as $actor) { ?>
					<a href="search.php?actors=<?= $actor ?>"><?= $actor ?></a>,&nbsp;
					<?php } ?>
				</p>
				<p>
					<strong>Réalisateurs :</strong>&nbsp;
					<?php foreach($directors as $director) { ?>
					<a href="search.php?directors=<?= $director ?>"><?= $director ?></a>,&nbsp;
					<?php } ?>
				</p>
				<hr>
				<blockquote>
					<p>
					<?= nl2br($movie['synopsis']) ?>
					</p>
				</blockquote>
			</div>
		</div>
	</div>

	<?php include 'sidebar-movie.php'; ?>

</div>

<?php include_once 'footer.php'; ?>
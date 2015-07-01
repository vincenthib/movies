<?php
include_once 'header.php';

if (!isset($_GET['id'])) {
	exit('Undefined param id');
}

$id = intval($_GET['id']);

if (empty($movies[$id])) {
	exit('Undefined movie');
}

$movie = $movies[$id];
?>
<a href="index.php" class="btn btn-default" role="button">&laquo; Retour</a>

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
				<p><strong>Date de sortie :</strong> <?= $movie['year'] ?> (<?= getDuration($movie['runtime']) ?>)</p>
				<p>
					<strong>Genres :</strong>&nbsp;
					<?= $movie['genres'] ?>
				</p>
				<p>
					<strong>Acteurs :</strong>&nbsp;
					<?= $movie['actors'] ?>
				</p>
				<p>
					<strong>Réalisateurs :</strong>&nbsp;
					<?= $movie['directors'] ?>
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

	<div class="col-xs-6 col-sm-3 sidebar-offcanvas" id="sidebar">

		<div class="panel panel-primary">
			<div class="panel-heading">Films des mêmes genres</div>
			<div class="list-group">
				<a href="#" class="list-group-item">1. Movie title</a>
				<a href="#" class="list-group-item">2. Movie title</a>
				<a href="#" class="list-group-item">3. Movie title</a>
				<a href="#" class="list-group-item">4. Movie title</a>
				<a href="#" class="list-group-item">5. Movie title</a>
			</div>
		</div>

		<div class="panel panel-info">
			<div class="panel-heading">Films des mêmes acteurs</div>
			<div class="list-group">
				<a href="#" class="list-group-item">1. Movie title</a>
				<a href="#" class="list-group-item">2. Movie title</a>
				<a href="#" class="list-group-item">3. Movie title</a>
				<a href="#" class="list-group-item">4. Movie title</a>
				<a href="#" class="list-group-item">5. Movie title</a>
			</div>
		</div>

		<div class="panel panel-default">
			<div class="panel-heading">Films des mêmes réalisateurs</div>
			<div class="list-group">
				<a href="#" class="list-group-item">1. Movie title</a>
				<a href="#" class="list-group-item">2. Movie title</a>
				<a href="#" class="list-group-item">3. Movie title</a>
				<a href="#" class="list-group-item">4. Movie title</a>
				<a href="#" class="list-group-item">5. Movie title</a>
			</div>
		</div>

	</div>

</div>

<?php include_once 'footer.php'; ?>
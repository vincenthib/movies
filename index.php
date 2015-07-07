<?php
require_once 'header.php';

//$top_movies = array_slice($movies, 0, 8);
//$top_movies = $db->query('SELECT * FROM movies ORDER BY year DESC LIMIT 8')->fetchAll();
//$rand_movies = $db->query('SELECT * FROM movies ORDER BY RAND() LIMIT 3')->fetchAll();

$top_movies = Movie::getList(8, 'year DESC');
$rand_movies = Movie::getList(3, 'RAND()');
?>
		<div class="row">

			<div class="col-xs-12 col-sm-9">

				<div class="jumbotron">
					<h1>Bienvenue sur Movies !</h1>
					<p>Le site n°1 du cinéma.<br />
						Découvrez notre <a href="search.php">recherche</a> de films et des <a href="news.php">actualités</a> sur le cinéma.
					</p>
				</div><!-- .jumbotron -->

				<div class="row marketing">

					<?php foreach ($rand_movies as $key => $movie) { ?>
					<!-- BLOCK RANDOM MOVIE -->
					<div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
						<img class="movie-thumbnail" src="<?= $movie->getCover() ?>" />
						<div class="caption">
							<h2><?= $movie->title ?></h2>
							<p><?= Utils::cutString($movie->synopsis, 100) ?></p>
							<p><a class="btn btn-default" href="movie.php?id=<?= $movie->id ?>" role="button">Voir la fiche du film &raquo;</a></p>
						</div>
					</div>
					<!-- END BLOCK RANDOM MOVIE -->
					<?php }	 ?>

				</div><!-- .marketing -->

				<?php
				if (!empty($_SESSION['movies'])) {

				$movie_ids_array = array_keys($_SESSION['movies']);
				$movie_ids = implode(', ', $movie_ids_array);
				$movie_ids_order = 'ORDER BY id = '.implode(' DESC, id = ', $movie_ids_array).' DESC';

				$visited_movies = $db->query('SELECT * FROM movies WHERE id IN ('.$movie_ids.') '.$movie_ids_order)->fetchAll();

				/*
				$result = $db->query('SELECT * FROM movies WHERE id IN ('.$movie_ids.')')->fetchAll();
				$visited_movies = $_SESSION['movies'];
				foreach($result as $key => $movie) {
					$visited_movies[$movie->id] = $movie;
				}
				*/
				?>
				<hr>

				<h1>Les derniers films visités</h1>

				<div id="visited-movies" class="row">

					<?php foreach ($visited_movies as $key => $movie) { ?>
					<!-- BLOCK VISITED MOVIE -->
					<div class="top-movie col-xs-12 col-sm-6 col-md-4 col-lg-3">
						<div class="thumbnail">
							<img src="<?= $movie->getCover() ?>" />
							<div class="caption">
								<h2><?= $movie->title ?></h2>
								<p><?= Utils::cutString($movie->synopsis, 100, '[...]') ?></p>
								<p><a class="btn btn-default" href="movie.php?id=<?= $movie->id ?>" role="button">Voir la fiche du film &raquo;</a></p>
							</div>
						</div>
					</div>
					<!-- END BLOCK VISITED MOVIE -->
					<?php } ?>

				</div><!-- #visited-movies -->
				<?php } ?>

				<hr>

				<div id="top-movies" class="row">

					<?php foreach ($top_movies as $key => $movie) { ?>
					<!-- BLOCK TOP MOVIE -->
					<div class="top-movie col-xs-12 col-sm-6 col-md-4 col-lg-3">
						<div class="thumbnail">
							<img src="<?= $movie->getCover($movie->id) ?>" />
							<div class="caption">
								<h2><?= $movie->title ?></h2>
								<p><?= Utils::cutString($movie->synopsis, 100, '[...]') ?></p>
								<p><a class="btn btn-default" href="movie.php?id=<?= $movie->id ?>" role="button">Voir la fiche du film &raquo;</a></p>
							</div>
						</div>
					</div>
					<!-- END BLOCK TOP MOVIE -->
					<?php } ?>

				</div><!-- #top-movies -->

			</div><!-- .col-xs-12.col-sm-9 -->

			<?php include 'sidebar.php'; ?>

		</div><!-- .row -->

<?php include_once 'footer.php'; ?>
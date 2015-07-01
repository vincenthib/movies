<?php
require_once 'header.php';

$top_movies = array_slice($movies, 0, 8);
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

					<?php
					for ($i = 0; $i < 3; $i++) {

						// On tire un nombre aléatoire entre 0 et le dernier élément du tableau (taille du tableau - 1)
						//$random_key = mt_rand(0, count($movies) - 1);
						// On va chercher une clé au hasard parmis les clés du tableau $movies
						$random_key = array_rand($movies);
						$movie = $movies[$random_key];
					?>
					<!-- BLOCK RANDOM MOVIE -->
					<div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
						<img class="movie-thumbnail" src="<?= getCover($movie['id']) ?>" />
						<div class="caption">
							<h2><?= $movie['title'] ?></h2>
							<p><?= cutString($movie['synopsis'], 100) ?></p>
							<p><a class="btn btn-default" href="movie.php?id=<?= $random_key ?>" role="button">Voir la fiche du film &raquo;</a></p>
						</div>
					</div>
					<!-- END BLOCK RANDOM MOVIE -->
					<?php }	 ?>

				</div><!-- .marketing -->

				<hr>

				<div id="top-movies" class="row">

					<?php foreach ($top_movies as $key => $movie) {
					?>
					<!-- BLOCK TOP MOVIE -->
					<div class="top-movie col-xs-12 col-sm-6 col-md-4 col-lg-3">
						<div class="thumbnail">
							<img src="<?= getCover($movie['id']) ?>" />
							<div class="caption">
								<h2><?= $movie['title'] ?></h2>
								<p><?= cutString($movie['synopsis'], 100, '[...]') ?></p>
								<p><a class="btn btn-default" href="movie.php?id=<?= $key ?>" role="button">Voir la fiche du film &raquo;</a></p>
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
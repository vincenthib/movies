<?php
$same_genres_movies = Movie::getSimilarMovies($movie, 'genres');
$same_actors_movies = Movie::getSimilarMovies($movie, 'actors');
$same_directors_movies = Movie::getSimilarMovies($movie, 'directors');
$same_writers_movies = Movie::getSimilarMovies($movie, 'writers');
?>
	<div class="col-xs-6 col-sm-3 sidebar-offcanvas" id="sidebar">

		<?php
		echo Utils::displayList($same_genres_movies, 'Films des mêmes genres', 'movie.php', 'primary');
		echo Utils::displayList($same_actors_movies, 'Films des mêmes acteurs', 'movie.php', 'info');
		echo Utils::displayList($same_directors_movies, 'Films des mêmes réalisateurs', 'movie.php', 'default');
		echo Utils::displayList($same_writers_movies, 'Films des mêmes auteurs', 'movie.php', 'warning');
		?>

	</div><!-- #sidebar -->
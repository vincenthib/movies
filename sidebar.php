			<?php
			$top_rating_movies = Movie::getList(5, 'rating DESC', 'id, title');
			$most_recent_movies = Movie::getList(5, 'year DESC', 'id, title');
			$random_movies = Movie::getList(5, 'RAND()', 'id, title');
			$result = $db->query('SELECT news_id as id, news_title as title FROM news ORDER BY news_date DESC LIMIT 5')->fetchAll();
			$last_news = json_decode (json_encode($result), false);
			?>

			<!-- SIDEBAR -->
			<div class="col-xs-6 col-sm-3 sidebar-offcanvas" id="sidebar">
				<?php
				echo Utils::displayList($top_rating_movies, 'Les 5 films les mieux notés', 'movie.php', 'primary');
				echo Utils::displayList($most_recent_movies, 'Les 5 films les plus récents', 'movie.php', 'info');
				echo Utils::displayList($random_movies, '5 films au hasard', 'movie.php', 'warning');
				echo Utils::displayList($last_news, 'Les dernières actualités', 'article.php');
				?>
			</div>
			<!-- END SIDEBAR -->
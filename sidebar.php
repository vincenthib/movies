			<!-- SIDEBAR -->
			<div class="col-xs-6 col-sm-3 sidebar-offcanvas" id="sidebar">
				<div class="panel panel-primary">
					<div class="panel-heading">Les 5 films les mieux notés</div>
					<div class="list-group">
						<?php
						$top_rating_movies = query('SELECT id, title FROM movies ORDER BY rating DESC LIMIT 5');

						foreach($top_rating_movies as $key => $top_rating_movie) {
						?>
						<a href="movie.php?id=<?= $top_rating_movie['id'] ?>" class="list-group-item"><?= ($key + 1).'. '.$top_rating_movie['title'] ?></a>
						<?php } ?>
					</div>
				</div>

				<div class="panel panel-default">
					<div class="panel-heading">Les 5 films les plus récents</div>
					<div class="list-group">
						<?php
						$most_recent_movies = query('SELECT id, title FROM movies ORDER BY year DESC LIMIT 5');

						foreach($most_recent_movies as $key => $most_recent_movie) {
						?>
						<a href="movie.php?id=<?= $most_recent_movie['id'] ?>" class="list-group-item"><?= ($key + 1).'. '.$most_recent_movie['title'] ?></a>
						<?php } ?>
					</div>
				</div>

				<div class="panel panel-default">
					<div class="panel-heading">Les dernières actualités</div>
					<div class="list-group">
						<?php
						$last_news = query('SELECT news_id, news_title FROM news ORDER BY news_date DESC LIMIT 5');

						foreach($last_news as $key => $article) {
						?>
						<a href="article.php?id=<?= $article['news_id'] ?>" class="list-group-item"><?= ucfirst($article['news_title']) ?></a>
						<?php } ?>
					</div>
				</div>
			</div>
			<!-- END SIDEBAR -->
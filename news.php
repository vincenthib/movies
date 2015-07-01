<?php
include_once 'header.php';
include_once 'inc/news_data.php';
?>
<div class="news-container">

	<div class="news-header">
		<h1>Actualités</h1>
		<p>Découvrez toute l'actualité du cinéma</p>
	</div>

	<div class="row">
		<div class="col-xs-12 col-sm-9">

			<?php foreach($news as $key => $article) { ?>
			<!-- NEWS POST -->
			<div class="news-post">

				<h2>
					<a href="article.php?id=<?= $key ?>"><?= ucfirst($article['news_title']) ?></a>
				</h2>
				<p><?= date('d/m/Y H:i:s', strtotime($article['news_date']))  ?></p>
				<hr>
				<blockquote>
					<p>
					<?= nl2br(cutString($article['news_text'], 100)) ?>
					</p>
				</blockquote>

				<a href="article.php?id=<?= $key ?>">
					Lire la suite
				</a>

			</div>
			<!-- END NEWS POST -->
			<?php } ?>

		</div>

		<?php include 'sidebar-news.php'; ?>

	</div>
</div>

<?php include_once 'footer.php'; ?>
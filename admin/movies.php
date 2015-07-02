<?php
include_once 'header.php';

$page = !empty($_GET['p']) ? intval($_GET['p']) : 1;
$page = $page > 0 ? $page : 1;

$nb_items_per_page = 20;

$result = $db->query('SELECT COUNT(*) as count_movies FROM movies')->fetch();
$count_movies = $result['count_movies'];

$nb_pages = ceil($count_movies / $nb_items_per_page);

$query = $db->prepare('SELECT * FROM movies ORDER BY modified DESC LIMIT :start, :nb_items');
$query->bindValue('start', ($page - 1) * $nb_items_per_page, PDO::PARAM_INT);
$query->bindValue('nb_items', $nb_items_per_page, PDO::PARAM_INT);
$query->execute();
$movies = $query->fetchAll();
?>
<h1>Liste des films</h1>

<h3><?= $count_movies ?> film(s)</h3>

<hr>

<a href="update-movie.php" class="btn btn-primary">Ajouter un film</a>

<hr>

<?php include '../pagination.php' ?>

<table class="table table-hover">
	<thead>
		<tr>
			<th>Id</th>
			<th>Cover</th>
			<th>Title</th>
			<th>Genres</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($movies as $movie) { ?>
		<tr>
			<td><?= $movie['id'] ?></td>
			<td><img height="30" src="<?= getCover($movie['id']) ?>"></td>
			<td><?= $movie['title'] ?></td>
			<td><?= $movie['genres'] ?></td>
			<td>
				<a href="update-movie.php?id=<?= $movie['id'] ?>&action=update"><span class="glyphicon glyphicon-pencil"></span></a>
				&nbsp;&nbsp;
				<a href="update-movie.php?id=<?= $movie['id'] ?>&action=delete" onclick="return false" data-title="<?= $movie['title'] ?>" class='btn-delete-movie'><span class="glyphicon glyphicon-remove"></span></a>
			</td>
		</tr>
		<?php } ?>
	</tbody>
</table>

<?php include '../pagination.php' ?>

<?php
include_once 'footer.php';
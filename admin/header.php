<?php
require_once '../inc/config.php';
require_once '../inc/func.php';
require_once '../inc/db.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	<link rel="icon" href="../../favicon.ico">

	<title>Espace d'administration</title>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
	<script src="js/holder.js"></script>
	<script src="js/admin.js"></script>
	<!--
	<script src="js/jquery.hotkeys.js"></script>
	<script src="js/bootstrap-wysiwyg.js"></script>
	-->

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
	<link href="css/styles.css" rel="stylesheet">
</head>

<body>

	<?php include_once 'navbar.php' ?>

	<div class="container-fluid">

		<div class="row">

			<?php include_once 'sidebar.php' ?>

			<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
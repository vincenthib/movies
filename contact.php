<?php include_once 'header.php' ?>

		<h1>Contact</h1>

		<form class="form-horizontal" action="<?= $_SERVER['PHP_SELF'] ?>" method="POST">
			<div class="form-group">
				<label for="email" class="col-sm-2 control-label">Nom</label>
				<div class="col-sm-3">
					<input type="text" id="lastname" name="lastname" class="form-control" placeholder="Nom">
				</div>
			</div>
			<div class="form-group">
				<label for="email" class="col-sm-2 control-label">Prénom</label>
				<div class="col-sm-3">
					<input type="text" id="firstname" name="firstname" class="form-control" placeholder="Prénom">
				</div>
			</div>
			<div class="form-group">
				<label for="email" class="col-sm-2 control-label">Email</label>
				<div class="col-sm-5">
					<input type="email" id="email" name="email" class="form-control" placeholder="Email">
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-offset-2 col-sm-10">
					<div class="checkbox">
						<label>
							<input type="checkbox" name="newsletter"> S'abonner à la newsletter
						</label>
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-offset-2 col-sm-10">
					<button type="submit" class="btn btn-default">Envoyer</button>
				</div>
			</div>
		</form>

<?php include_once 'footer.php' ?>
	<nav class="navbar navbar-inverse navbar-fixed-top">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
					<span class="sr-only">Navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="index.php">Backoffice Movies</a>
			</div>
			<div id="navbar" class="navbar-collapse collapse">
				<ul class="nav navbar-nav navbar-right">
					<?php
					foreach($admin_pages['navbar'] as $page_url => $page_name) {
						$active = '';
						if ($current_page == $page_url) {
							$active = ' class="active"';
						}
					?>
					<li<?= $active ?>><a href="<?= $page_url ?>"><?= $page_name ?></a></li>
					<?php } ?>
				</ul>
				<!--
				<form class="navbar-form navbar-right">
					<div class="input-group">
						<input type="text" class="form-control" placeholder="Search...">
						<span class="input-group-btn">
							<button class="btn btn-default" type="submit">
								<span class="glyphicon glyphicon-search" aria-hidden="true"></span>
							</button>
						</span>
					</div>
				</form>
				-->
			</div>
		</div>
	</nav>
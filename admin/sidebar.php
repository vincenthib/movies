			<div id="sidebar-left" class="col-sm-3 col-md-2 sidebar">
				<ul class="nav nav-sidebar">
					<?php
					foreach($admin_pages['sidebar'] as $page_url => $page_name) {
						$active = '';
						if ($current_page == $page_url) {
							$active = ' class="active"';
						}
					?>
					<li<?= $active ?>><a href="<?= $page_url ?>"><?= $page_name ?></a></li>
					<?php } ?>
				</ul>
			</div>

			<a id="btn-sidebar-collapse" href="javascript:void(0);">
				<span class="glyphicon glyphicon-chevron-left"></span>
			</a>
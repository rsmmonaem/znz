
				<div class="col-md-2">
					<a href="/message/compose" class="btn btn-warning btn-block md-trigger"><i class="fa fa-edit"></i> <?php echo trans('messages.compose'); ?></a>
					<div class="list-group menu-message">
					  <a href="/message" class="list-group-item active">
						<?php echo trans('messages.inbox'); ?> <strong>(<?php echo $count_inbox; ?>)</strong>
					  </a>
					  <a href="/message/sent" class="list-group-item"><?php echo trans('messages.sent_box'); ?> <strong>(<?php echo $count_sent; ?>)</strong></a>
					</div>
				</div>
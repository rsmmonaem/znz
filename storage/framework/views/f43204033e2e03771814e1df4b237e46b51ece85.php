
					
					<div class="table-responsive">
						<table class="table table-hover datatable" data-table-source="<?php echo e($table_info['source']); ?>" data-table-title="<?php echo e($table_info['title']); ?>" id="<?php echo e($table_info['id']); ?>" <?php echo array_key_exists('form',$table_info) ? 'data-form="'.$table_info['form'].'"' : ''; ?>>
							<thead>
								<tr>
									<?php foreach($col_heads as $col_head): ?>
									<?php if($col_head == 'Option'): ?>
									<th style="min-width:100px;"><?php echo $col_head; ?></th>
									<?php else: ?>
									<th><?php echo e($col_head); ?></th>
									<?php endif; ?>
									<?php endforeach; ?>
								</tr>
							</thead>
							<tbody>
							</tbody>
							<tfoot>
							</tfoot>
						</table>
					</div>
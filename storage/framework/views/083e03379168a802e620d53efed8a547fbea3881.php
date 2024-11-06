
			  <div class="form-group">
			    <?php echo Form::label('start',trans('messages.start'),[]); ?>

				<?php echo Form::input('text','start',isset($ip->start) ? $ip->start : '',['class'=>'form-control','placeholder'=>trans('messages.start')]); ?>

			  </div>
			  <div class="form-group">
			    <?php echo Form::label('end',trans('messages.end'),[]); ?>

				<?php echo Form::input('text','end',isset($ip->end) ? $ip->end : '',['class'=>'form-control','placeholder'=>trans('messages.end')]); ?>

			  </div>
			  	<?php echo Form::submit(isset($buttonText) ? $buttonText : trans('messages.save'),['class' => 'btn btn-primary pull-right']); ?>


	<?php echo HTML::script('assets/js/jquery-1.11.3.min.js'); ?>

	<?php echo HTML::script('assets/js/bootstrap.min.js'); ?> 
	<?php echo HTML::script('assets/js/jquery.validate.min.js'); ?>

	<?php echo HTML::script('assets/js/textAvatar.js'); ?>

	<?php echo HTML::script('assets/js/sidemenu.js'); ?>

	<?php echo HTML::script('assets/third/toastr/toastr.min.js'); ?>

	<?php echo HTML::script('assets/third/sortable/sortable.min.js'); ?>

	<?php echo HTML::script('assets/js/jquery.knob.min.js'); ?>

	<?php echo $__env->make('notification', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<?php echo HTML::script('assets/js/bootbox.js'); ?>

	<?php echo HTML::script('assets/third/slimscroll/jquery.slimscroll.min.js'); ?>

    <?php if(in_array('calendar',$assets)): ?>
	<?php echo HTML::script('assets/third/fullcalendar/moment.min.js'); ?>

	<?php echo HTML::script('assets/third/fullcalendar/fullcalendar.min.js'); ?>

	<?php echo HTML::script('assets/third/fullcalendar/lang-all.js'); ?>

	<?php endif; ?>
    <?php if(in_array('graph',$assets)): ?>
	<?php echo HTML::script('https://www.gstatic.com/charts/loader.js'); ?>

	<?php endif; ?>
    <?php if(in_array('rte',$assets)): ?>
	<?php echo HTML::script('assets/third/summernote/summernote.js'); ?>

	<?php endif; ?>
    <?php if(in_array('timepicker',$assets)): ?>
	<?php echo HTML::script('assets/third/timepicker/bootstrap-clockpicker.min.js'); ?>

	<?php endif; ?>
    <?php if(in_array('tour',$assets)): ?>
	<?php echo HTML::script('assets/third/bootstrap-tour/bootstrap-tour.min.js'); ?>

	<?php endif; ?>
	<?php echo HTML::script('assets/third/jquery-ui/jquery-ui.min.js'); ?>

	<?php echo HTML::script('assets/third/select2/js/select2.min.js'); ?>

	<?php echo HTML::script('assets/third/datatable/datatables.min.js'); ?>

	<?php echo HTML::script('assets/third/nifty-modal/js/classie.js'); ?>

	<?php echo HTML::script('assets/third/nifty-modal/js/modalEffects.js'); ?>

	<?php echo HTML::script('assets/third/select/bootstrap-select.min.js'); ?>

	<?php echo HTML::script('assets/third/input/bootstrap.file-input.js'); ?>

	<?php echo HTML::script('assets/third/datepicker/js/bootstrap-datepicker.js'); ?>

	<?php echo HTML::script('assets/third/icheck/icheck.min.js'); ?>


    <?php if(config('lang.'.session('lang').'.datepicker') != 'en'): ?>
	<?php echo HTML::script('assets/third/datepicker/locale/bootstrap-datepicker.'.config('lang.'.session('lang').'.datepicker').'.js',array('charset' => 'UTF-8')); ?>

    <?php endif; ?>

    <?php if(in_array('datetimepicker',$assets) || in_array('timepicker',$assets)): ?>
	<?php echo HTML::script('assets/third/datetimepicker/bootstrap-datetimepicker.js'); ?>

	<?php if(config('lang.'.session('lang').'.datetimepicker') != 'en'): ?>
	<?php echo HTML::script('assets/third/datetimepicker/locale/bootstrap-datetimepicker.'.config('lang.'.session('lang').'.datetimepicker').'.js',array('charset' => 'UTF-8')); ?>

	<?php endif; ?>
    <?php endif; ?>

    <?php if(config('lang.'.session('lang').'.validation') != 'en'): ?>
	<?php echo HTML::script('assets/js/validation-localization/messages_'.config('lang.'.session('lang').'.validation').'.js',array('charset' => 'UTF-8')); ?>

    <?php endif; ?>
	<?php echo HTML::script('assets/js/validation-form.js'); ?>

	

    <script>
    	$.ajaxSetup({
		   headers: { 'X-CSRF-Token' : $('meta[name=csrf-token]').attr('content') }
		});
		var datatable_language = "//cdn.datatables.net/plug-ins/1.10.9/i18n/<?php echo config('lang.'.session('lang').'.datatable'); ?>.json";
		var datetimepicker_language = "<?php echo e(config('lang.'.session('lang').'.datetimepicker')); ?>";
		var datepicker_language = "<?php echo e(config('lang.'.session('lang').'.datepicker')); ?>";
		var calendar_language = "<?php echo config('lang.'.session('lang').'.calendar'); ?>";
		var character_remaining = "<?php echo e(trans('messages.character_remaining')); ?>";
		var present_employee = "<?php echo trans('messages.present_employee'); ?>";
		var something_error_message = 'Bug: Something went wrong, Please try again.';
		var page_not_found = 'Bug: Page not found. Please contact your administrator.';
		var toastr_position = "<?php echo e(config('config.notification_position')); ?>";
		var assets = <?php echo json_encode($assets); ?>;
		<?php if(isset($events)): ?>
			var calendar_events = <?php echo json_encode($events); ?>;
		<?php endif; ?>
		<?php if(isset($daily_employee_attendance)): ?>
			var daily_employee_attendance_data = <?php echo json_encode($daily_employee_attendance); ?>;
		<?php endif; ?>
		<?php if(isset($employee_graph_data)): ?>
			var employee_graph_data = <?php echo json_encode($employee_graph_data); ?>;
		<?php endif; ?>
		<?php if(isset($month_holiday_count)): ?>
			var month_holiday_count = <?php echo json_encode($month_holiday_count); ?>;
		<?php endif; ?>
		<?php if(isset($leave_graph)): ?>
			var leave_graph = <?php echo json_encode($leave_graph); ?>;
		<?php endif; ?>
    	<?php if(in_array('graph',$assets)): ?>
    		var enable_graph = 1;
    	<?php else: ?>
    		var enable_graph = 0;
    	<?php endif; ?>
    	var availableDates = <?php echo json_encode($available_date); ?>;
    	

		<?php if(in_array('mail_config',$assets)): ?>
			$('.mail_config').hide();
			<?php if(config('mail.driver') == 'mail'): ?>
			$('#mail_configuration').show();
			<?php elseif(config('mail.driver') == 'sendmail'): ?>
			$('#sendmail_configuration').show();
			<?php elseif(config('mail.driver') == 'log'): ?>
			$('#log_configuration').show();
			<?php elseif(config('mail.driver') == 'smtp'): ?>
			$('#smtp_configuration').show();
			<?php elseif(config('mail.driver') == 'mandrill'): ?>
			$('#mandrill_configuration').show();
			<?php elseif(config('mail.driver') == 'mailgun'): ?>
			$('#mailgun_configuration').show();
			<?php endif; ?>
			$(document).on('change', '#mail_driver', function(){
				$('.mail_config').hide();
			 	var field = $('#mail_driver').val();
				if(field == 'smtp')
					$('#smtp_configuration').show();
				else if(field == 'mandrill')
					$('#mandrill_configuration').show();
				else if(field == 'mailgun')
					$('#mailgun_configuration').show();
				else if(field == 'mail')
					$('#mail_configuration').show();
				else if(field == 'sendmail')
					$('#sendmail_configuration').show();
				else if(field == 'log')
					$('#log_configuration').show();
			});
		<?php endif; ?>
	</script>
	<?php echo HTML::script('assets/js/wmlab.js'); ?>


	<?php if(!config('code.mode')): ?>
	<script type='text/javascript'>var fc_CSS=document.createElement('link');fc_CSS.setAttribute('rel','stylesheet');var fc_isSecured = (window.location && window.location.protocol == 'https:');var fc_lang = document.getElementsByTagName('html')[0].getAttribute('lang'); var fc_rtlLanguages = ['ar','he']; var fc_rtlSuffix = (fc_rtlLanguages.indexOf(fc_lang) >= 0) ? '-rtl' : '';fc_CSS.setAttribute('type','text/css');fc_CSS.setAttribute('href',((fc_isSecured)? 'https://d36mpcpuzc4ztk.cloudfront.net':'http://assets1.chat.freshdesk.com')+'/css/visitor'+fc_rtlSuffix+'.css');document.getElementsByTagName('head')[0].appendChild(fc_CSS);var fc_JS=document.createElement('script'); fc_JS.type='text/javascript'; fc_JS.defer=true;fc_JS.src=((fc_isSecured)?'https://d36mpcpuzc4ztk.cloudfront.net':'http://assets.chat.freshdesk.com')+'/js/visitor.js';(document.body?document.body:document.getElementsByTagName('head')[0]).appendChild(fc_JS);window.livechat_setting= 'eyJ3aWRnZXRfc2l0ZV91cmwiOiJ3bWxhYi5mcmVzaGRlc2suY29tIiwicHJvZHVjdF9pZCI6bnVsbCwibmFtZSI6IlN1cHBvcnQgUG9ydGFsIiwid2lkZ2V0X2V4dGVybmFsX2lkIjpudWxsLCJ3aWRnZXRfaWQiOiI0ODYxZjZhNS1lYzZjLTRiOTUtODc0Ny1jOTlhZjZmOTI0MDMiLCJzaG93X29uX3BvcnRhbCI6dHJ1ZSwicG9ydGFsX2xvZ2luX3JlcXVpcmVkIjpmYWxzZSwibGFuZ3VhZ2UiOiJlbiIsInRpbWV6b25lIjoiTmV3IERlbGhpIiwiaWQiOjE3MDAwMDExNzgxLCJtYWluX3dpZGdldCI6MSwiZmNfaWQiOiI4Mjc0YTVkYzQxZGNhOGVmNjNjYmVmNDE4ZjQ2NmExNCIsInNob3ciOjEsInJlcXVpcmVkIjoyLCJoZWxwZGVza25hbWUiOiJXTSBMYWIiLCJuYW1lX2xhYmVsIjoiTmFtZSIsIm1lc3NhZ2VfbGFiZWwiOiJNZXNzYWdlIiwicGhvbmVfbGFiZWwiOiJQaG9uZSIsInRleHRmaWVsZF9sYWJlbCI6IlRleHRmaWVsZCIsImRyb3Bkb3duX2xhYmVsIjoiRHJvcGRvd24iLCJ3ZWJ1cmwiOiJ3bWxhYi5mcmVzaGRlc2suY29tIiwibm9kZXVybCI6ImNoYXQuZnJlc2hkZXNrLmNvbSIsImRlYnVnIjoxLCJtZSI6Ik1lIiwiZXhwaXJ5IjoxNDcyNTM2MDAwMDAwLCJlbnZpcm9ubWVudCI6InByb2R1Y3Rpb24iLCJlbmRfY2hhdF90aGFua19tc2ciOiJUaGFuayB5b3UhISEiLCJlbmRfY2hhdF9lbmRfdGl0bGUiOiJFbmQiLCJlbmRfY2hhdF9jYW5jZWxfdGl0bGUiOiJDYW5jZWwiLCJzaXRlX2lkIjoiODI3NGE1ZGM0MWRjYThlZjYzY2JlZjQxOGY0NjZhMTQiLCJhY3RpdmUiOjEsInJvdXRpbmciOm51bGwsInByZWNoYXRfZm9ybSI6MSwiYnVzaW5lc3NfY2FsZW5kYXIiOm51bGwsInByb2FjdGl2ZV9jaGF0IjoxLCJwcm9hY3RpdmVfdGltZSI6MTA1LCJzaXRlX3VybCI6IndtbGFiLmZyZXNoZGVzay5jb20iLCJleHRlcm5hbF9pZCI6bnVsbCwiZGVsZXRlZCI6MCwibW9iaWxlIjoxLCJhY2NvdW50X2lkIjpudWxsLCJjcmVhdGVkX2F0IjoiMjAxNi0wOC0xNVQwNDoyNjozOS4wMDBaIiwidXBkYXRlZF9hdCI6IjIwMTYtMDgtMTVUMDU6NDk6NDAuMDAwWiIsImNiRGVmYXVsdE1lc3NhZ2VzIjp7ImNvYnJvd3Npbmdfc3RhcnRfbXNnIjoiWW91ciBzY3JlZW5zaGFyZSBzZXNzaW9uIGhhcyBzdGFydGVkIiwiY29icm93c2luZ19zdG9wX21zZyI6IllvdXIgc2NyZWVuc2hhcmluZyBzZXNzaW9uIGhhcyBlbmRlZCIsImNvYnJvd3NpbmdfZGVueV9tc2ciOiJZb3VyIHJlcXVlc3Qgd2FzIGRlY2xpbmVkIiwiY29icm93c2luZ192aWV3aW5nX3NjcmVlbiI6IllvdSBhcmUgdmlld2luZyB0aGUgdmlzaXRvcuKAmXMgc2NyZWVuIiwiY29icm93c2luZ19jb250cm9sbGluZ19zY3JlZW4iOiJZb3UgYXJlIGNvbnRyb2xsaW5nIHRoZSB2aXNpdG9y4oCZcyBzY3JlZW4iLCJjb2Jyb3dzaW5nX3JlcXVlc3RfY29udHJvbCI6IlJlcXVlc3QgdmlzaXRvciBmb3IgY29udHJvbCIsImNvYnJvd3Npbmdfc3RvcF9yZXF1ZXN0IjoiRW5kIHlvdXIgc2NyZWVuc2hhcmluZyBzZXNzaW9uIiwiY29icm93c2luZ19yZXF1ZXN0X2NvbnRyb2xfcmVqZWN0ZWQiOiJZb3VyIHJlcXVlc3Qgd2FzIGRlY2xpbmVkIiwiY29icm93c2luZ19jYW5jZWxfdmlzaXRvcl9tc2ciOiJTY3JlZW5zaGFyaW5nIGlzIGN1cnJlbnRseSB1bmF2YWlsYWJsZSIsImNiX3ZpZXdpbmdfc2NyZWVuX3ZpIjoiQWdlbnQgY2FuIHZpZXcgeW91ciBzY3JlZW4gIiwiY2JfY29udHJvbGxpbmdfc2NyZWVuX3ZpIjoiQWdlbnQgY2FuIGNvbnRyb2wgeW91ciBzY3JlZW4iLCJjYl9naXZlX2NvbnRyb2xfdmkiOiJBbGxvdyBhZ2VudCB0byBjb250cm9sIHlvdXIgc2NyZWVuIiwiY2JfdmlzaXRvcl9zZXNzaW9uX3JlcXVlc3QiOiJDYW4gYWdlbnQgY29udHJvbCB5b3VyIGN1cnJlbnQgc2NyZWVuPyJ9fQ==';</script>
	<?php endif; ?>
	<?php echo HTML::script('assets/js/custom.js'); ?>

	</body>
</html>
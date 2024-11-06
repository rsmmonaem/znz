/**
 * Pure javascript
 * Md.Ibrahim Khalil
 * 2020-11-25
 */

 var add_new_id=0;
 function add_new_task_field()
 {

  add_new_id=Number(add_new_id)+1;
  var html_data='';

  /* html_data+='<div id="field_1_'+add_new_id+'" class="form-group"><>';
  html_data+='<label for="" class="control-label">New Objective '+add_new_id+'*</label>';
  html_data+='<textarea form="update_task_form" class="form-control" name="objective[]" rows="2" required="required"></textarea>';
  html_data+='</div>';
  html_data+='<div id="field_2_'+add_new_id+'" class="form-group">';
  html_data+='<label for="" class="control-label">New Expected Result '+add_new_id+'*</label>';
  html_data+='<textarea form="update_task_form" class="form-control" name="expected_result[]" rows="2" required="required"></textarea>';
  html_data+='</div>'; */

  html_data+='<div id="field_3_'+add_new_id+'" class="form-group">';
	html_data+='<div class="row">';
	html_data+='<div class="col-md-7">';
	html_data+='<label for="" class="control-label">New Task Title '+add_new_id+'*</label>';
	html_data+='<input type="text" class="form-control" name="task[]" value="" required="required">';
	html_data+='</div>';
	html_data+='<div class="col-md-3">';
	html_data+='<label for="" class="control-label">Deadline*</label>';
	html_data+='<input type="date" class="form-control" name="date[]" required="required">';
	html_data+='</div>';
	html_data+='<div class="col-md-2">';
	html_data+='<label for="" class="control-label">Priority*</label>';
	html_data+='<select class="form-control" name="priority[]" required="required">';
  
	for(var i=0;i<=10;i++)
	{html_data+='<option value="'+i+'">'+i+'</option>';}
					
  html_data+='</select>';
	html_data+='<i title="Delete" class="btn btn-danger btn-xs fa fa-trash-o" style="position: absolute;top: 33px;right: -10px;border-radius: 50%;" onclick="remove_task_field(\''+add_new_id+'\')"></i>';
	html_data+='</div>';
	html_data+='</div>';

  document.getElementById('task_section').innerHTML=document.getElementById('task_section').innerHTML+html_data;


 }


 function add_new_task_field_2(form_id)
 {

  add_new_id=Number(add_new_id)+1;
  var html_data='';

  /* html_data+='<div id="field_1_'+add_new_id+'" class="form-group"><hr>';
  html_data+='<label for="" class="control-label">New Objective '+add_new_id+'*</label>';
  html_data+='<textarea form="'+form_id+'" form="update_task_form" class="form-control" name="objective[]" rows="2" required="required"></textarea>';
  html_data+='</div>';
  html_data+='<div id="field_2_'+add_new_id+'" class="form-group">';
  html_data+='<label for="" class="control-label">New Expected Result '+add_new_id+'*</label>';
  html_data+='<textarea form="'+form_id+'" form="update_task_form" class="form-control" name="expected_result[]" rows="2" required="required"></textarea>';
  html_data+='</div>'; */

  html_data+='<div id="field_3_'+add_new_id+'" class="form-group">';
	html_data+='<div class="row">';
	html_data+='<div class="col-md-7">';
	html_data+='<label for="" class="control-label">New Task Title '+add_new_id+'*</label>';
	html_data+='<input form="'+form_id+'" type="text" class="form-control" name="task[]" value="" required="required">';
	html_data+='</div>';
	html_data+='<div class="col-md-3">';
	html_data+='<label for="" class="control-label">Deadline</label>';
	html_data+='<input form="'+form_id+'" type="date" class="form-control" name="date[]" required="required">';
	html_data+='</div>';
	html_data+='<div class="col-md-2">';
	html_data+='<label for="" class="control-label">Priority</label>';
	html_data+='<select form="'+form_id+'" class="form-control" name="priority[]" required="required">';
  
	for(var i=0;i<=10;i++)
	{html_data+='<option value="'+i+'">'+i+'</option>';}
					
  html_data+='</select>';
	html_data+='<i title="Delete" class="btn btn-danger btn-xs fa fa-trash-o" style="position: absolute;top: 33px;right: -10px;border-radius: 50%;" onclick="remove_task_field(\''+add_new_id+'\')"></i>';
	html_data+='</div>';
	html_data+='</div>';

  document.getElementById('task_section').innerHTML=document.getElementById('task_section').innerHTML+html_data;


 }

 function remove_task_field(id)
 {
  /* document.getElementById('field_1_'+id).remove();
  document.getElementById('field_2_'+id).remove(); */
  document.getElementById('field_3_'+id).remove();
 }
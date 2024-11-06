

	<?php $__env->startSection('breadcrumb'); ?>
		<ul class="breadcrumb">
		    <li><a href="/dashboard"><?php echo trans('messages.dashboard'); ?></a></li>
		    <li class="active"><?php echo trans('messages.appraisal_rating_menu'); ?></li>
		</ul>
	<?php $__env->stopSection(); ?>
	
	<?php $__env->startSection('content'); ?>

  <?php
  
  $answer_1=$appraisal_array[0]['answer_1'];
  $answer_2=$appraisal_array[0]['answer_2'];
  $answer_3=$appraisal_array[0]['answer_3'];
  $answer_4=$appraisal_array[0]['answer_4'];
  $answer_5=$appraisal_array[0]['answer_5'];
  $answer_6=htmlentities($appraisal_array[0]['answer_6']);
  $answer_7=htmlentities($appraisal_array[0]['answer_7']);
  $answer_8=htmlentities($appraisal_array[0]['answer_8']);
  $answer_9=htmlentities($appraisal_array[0]['answer_9']);
  $answer_10=htmlentities($appraisal_array[0]['answer_10']);
  $answer_11=htmlentities($appraisal_array[0]['answer_11']);
  $answer_12=htmlentities($appraisal_array[0]['answer_12']);
  $answer_13=htmlentities($appraisal_array[0]['answer_13']);
  $answer_14=htmlentities($appraisal_array[0]['answer_14']);
  $answer_15=htmlentities($appraisal_array[0]['answer_15']);
  $answer_16=htmlentities($appraisal_array[0]['answer_16']);
  $answer_17=htmlentities($appraisal_array[0]['answer_17']);
  $answer_18=htmlentities($appraisal_array[0]['answer_18']);
  $answer_19=htmlentities($appraisal_array[0]['answer_19']);
  $answer_20=htmlentities($appraisal_array[0]['answer_20']);

  $check_1_yes='';  $check_1_no='';
  $check_2_yes='';  $check_2_no='';
  $check_3_yes='';  $check_3_no='';
  $check_4_yes='';  $check_4_no='';
  $check_5_yes='';  $check_5_no='';

  /* $button_1_disable='';
  $button_2_disable='';
  $button_3_disable='';

  $button_1_class='btn-primary';
  $button_2_class='btn-primary';
  $button_3_class='btn-primary';

  $button_1_type='submit';
  $button_2_type='submit';
  $button_3_type='submit';

  $section_2_class='';
  
  
  if($appraisal_array[0]['user_approve']==1){$button_1_disable='disable="disable"';$button_1_class=''; $button_1_type='button';}

  if($appraisal_array[0]['sup_approve']==1){$button_1_disable='disable="disable"';$button_2_disable='disable="disable"';$button_2_class='';$button_1_class='';$button_1_type='button'; $button_2_type='button';}

  if($appraisal_array[0]['user_approve']==1 and $appraisal_array[0]['sup_approve']==0 and $appraisal_array[0]['hr_approve']==0){$section_2_class='hide';} */

  if($answer_1==1){$check_1_yes='checked="checked"';  $check_1_no='';}else{$check_1_yes='';  $check_1_no='checked="checked"';}
  if($answer_2==1){$check_2_yes='checked="checked"';  $check_2_no='';}else{$check_2_yes='';  $check_2_no='checked="checked"';}
  if($answer_3==1){$check_3_yes='checked="checked"';  $check_3_no='';}else{$check_3_yes='';  $check_3_no='checked="checked"';}
  if($answer_4==1){$check_4_yes='checked="checked"';  $check_4_no='';}else{$check_4_yes='';  $check_4_no='checked="checked"';}
  if($answer_5==1){$check_5_yes='checked="checked"';  $check_5_no='';}else{$check_5_yes='';  $check_5_no='checked="checked"';}


  $disabled_0='';
  $disabled_8='';
  if($appraisal_array[0]['hr_approve']==1){$disabled_0='disabled';}

  if($appraisal_array[0]['sup_approve']==1){$disabled_8='disabled';$disabled_0='disabled';}


  for($i=1;$i<=7;$i++)
  {
    
    for($j=0;$j<=12;$j++)
    {
      $qn_n=$j+1;

      if(isset(${'comment_array_'.$i}[$j]['title'])){${'comment_title_'.$i.'_'.$qn_n}=${'comment_array_'.$i}[$j]['title'];}
      else{${'comment_title_'.$i.'_'.$qn_n}='';}

      if(isset(${'comment_array_'.$i}[$j]['comment'])){${'comment_'.$i.'_'.$qn_n}=${'comment_array_'.$i}[$j]['comment'];}
      else{${'comment_'.$i.'_'. $qn_n}='';}

      if(isset(${'comment_array_'.$i}[$j]['rating'])){${'rating_'.$i.'_'. $qn_n}=${'comment_array_'.$i}[$j]['rating'];}
      else{${'rating_'.$i.'_'. $qn_n}='';}


    }

    if($appraisal_array[0]['hr_approve']==1 or $appraisal_array[0]['sup_approve']==1){${'disabled_'.$i}='disabled';}
    else{${'disabled_'.$i}='';}
  }


  

  ?>

	<div class="row">
	<div class="col-sm-12">
	<div class="box-info full">
	<h2><strong><?php echo trans('messages.appraisal_rating_menu'); ?></strong>
	</h2>

<form id="appraisal_rating_edit_0" action="/appraisal_rating_edit_save" method="Post"></form>
<form id="appraisal_rating_edit_1" action="/appraisal_rating_edit_save" method="Post"></form>
<form id="appraisal_rating_edit_2" action="/appraisal_rating_edit_save" method="Post" ></form>
<form id="appraisal_rating_edit_3" action="/appraisal_rating_edit_save" method="Post" ></form>
<form id="appraisal_rating_edit_4" action="/appraisal_rating_edit_save" method="Post" ></form>
<form id="appraisal_rating_edit_5" action="/appraisal_rating_edit_save" method="Post" ></form>
<form id="appraisal_rating_edit_6" action="/appraisal_rating_edit_save" method="Post" ></form>
<form id="appraisal_rating_edit_7" action="/appraisal_rating_edit_save" method="Post" ></form>
<form id="appraisal_rating_edit_8" action="/appraisal_rating_edit_save" method="Post" ></form>
<form id="appraisal_rating_edit_9" action="/appraisal_rating_edit_save" method="Post" ></form>
<form id="appraisal_rating_edit_10" action="/appraisal_rating_edit_save" method="Post" ></form>


	<div class="col-md-12">
  <div class="col-md-12">

	<div class="row">
	<div class="col-sm-8">
	<table width="100%" border="1" cellspacing="2" cellpadding="5">
  <tr>
    <td class="text-right" style="background:lightblue; font-weight:bolder;width:25%;">FIRST NAME:</td>
    <td colspan="0"><?php echo $appraisal_array[0]['emp_first_name'];?></td>
    <td class="text-right" style="background:lightblue;width:25%;font-weight:bolder;">HR ID:</td>
    <td><?php echo $appraisal_array[0]['emp_id'];?></td>
  </tr>

  <tr>
    <td class="text-right" style="background:lightblue; font-weight:bolder;width:25%;">LAST NAME:</td>
    <td colspan="0"><?php echo $appraisal_array[0]['emp_last_name'];?></td>
    <td class="text-right" style="background:lightblue;width:25%;font-weight:bolder;">BASE:</td>
    <td><?php echo $appraisal_array[0]['emp_base'];?></td>
  </tr>

  <tr>
    <td class="text-right" style="background:lightblue; font-weight:bolder;width:25%;">DEPARTMENT:</td>
    <td colspan="0"><?php echo $appraisal_array[0]['emp_department'];?></td>
    <td class="text-right" style="background:lightblue;width:25%;font-weight:bolder;">SUB BASE:</td>
    <td><?php echo $appraisal_array[0]['emp_sub_base'];?></td>
  </tr>

  <tr>
    <td class="text-right" style="background:lightblue; font-weight:bolder;width:25%;">POSITION:</td>
    <td colspan="3"><?php echo $appraisal_array[0]['emp_designation'];?></td>
    
  </tr>

  <tr>
    <td class="text-right" style="background:lightblue; font-weight:bolder;width:25%;">JOIN DATE:</td>
    <td colspan="3"><?php echo $appraisal_array[0]['emp_joining_date'];?></td>
    
  </tr>

  <tr>
    <td class="text-right" style="background:lightblue; font-weight:bolder;width:25%;">LAST REVIEW DATE:</td>
    <td colspan="3"><?php echo $appraisal_array[0]['emp_review_date'];?></td>
  </tr>

  <tr>
    <td class="text-right" style="background:lightblue; font-weight:bolder;width:25%;">APPRAISAL PERIOD:</td>
    <td colspan="0"><?php echo $appraisal_array[0]['time_period'];?></td>
    <td class="text-right" style="background:lightblue;width:25%;font-weight:bolder;">DATE:</td>
    <td><?php echo $appraisal_array[0]['date'].' '.$appraisal_array[0]['time'];?></td>
  </tr>

  <tr>
    <td class="text-right" style="background:lightblue; font-weight:bolder;width:25%;" rowspan="2">NAME AND POSITION OF EVALUATOR (s):</td>
    <td colspan="3"><?php echo $appraisal_array[0]['sup_first_name'].' '.$appraisal_array[0]['sup_last_name'];?></td>
	
  </tr>

  <tr>
    <td colspan="3"><?php echo $appraisal_array[0]['sup_designation'];?></td>
  </tr>

  
	</table>
	</div>
	<div class="col-sm-4">
	<table width="100%" border="1" cellspacing="2" cellpadding="5">
  <tr>
    <td class="text-center" style="background:#eee;font-size:18px; font-weight:bolder;height:176px;">HR Only</td>
  </tr>
  </table>
	
	</div>
	</div>
	<br>
	</div>


	<div class="col-sm-12">
	<table width="100%" border="1" cellspacing="2" cellpadding="5">
  <tr>
    <td class="" colspan="4" style="color:#fff;background:#666666;font-size:18px; font-weight:bolder;width:25%;">EMPLOYEE SELF APPRAISAL</td>
  </tr>

  <tr>
    <td colspan="4" class="" style="font-weight:bolder;padding: 20px;">
	<p>The form has questions that might help you and your manager(s) to prepare for the Appraisal Meeting to enable you to discuss the job performance and your future. You shall complete this section 1 SELF APPRAISAL of this form and share with your line manager prior the performance appraisal interview.</p>

<p>The discussion should aim at a clearer understanding of:</p>
<p>• The main scope and purpose of your job (expectations/objectives/duties)</p>
<p>• Your performance accomplishment and area for improvement</p>
<p>• Agreements on your objectives and tasks for next year</p>
<p>• Your training and future prospects.</p>

	</td>
  </tr>

  <tr style="min-height:40px;">
    <td colspan="2" class="" style="background:lightblue; font-weight:bolder;width:80%;">
	1.1. TICK APPROPRIATE ANSWERS AND COMMENT BELOW:
	</td>
    <td class="text-center" style="background:lightblue;font-weight:bolder;width:10%;">Yes</td>
    <td class="text-center" style="background:lightblue; font-weight:bolder;width:10%;">No</td>
  </tr>

  <tr  style="height:30px;">
    <td colspan="2" class="" style="width:80%;">
	Do you have an up-to-date job description?
	</td>
    <td class="text-center" style="width:10%;"><input form="appraisal_edit_answer_1" type="radio" name="answer_1" value="1" <?php echo $check_1_yes;?>></td>
    <td class="text-center" style="width:10%;"><input form="appraisal_edit_answer_1" type="radio" name="answer_1" value="0" <?php echo $check_1_no;?> ></td>
  </tr>

  <tr style="height:30px;">
    <td colspan="2" class="" style="width:80%;">
	Do you have an up-to-date action plan?
	</td>
    <td class="text-center" style="width:10%;"><input form="appraisal_edit_answer_1" type="radio" name="answer_2" value="1" <?php echo $check_2_yes;?> ></td>
    <td class="text-center" style="width:10%;"><input form="appraisal_edit_answer_1" type="radio" name="answer_2" value="0" <?php echo $check_2_no;?>></td>
  </tr>

  <tr style="height:30px;">
    <td colspan="2" class="" style="width:80%;">
	Do you understand all the requirements of your job?
	</td>
    <td class="text-center" style="width:10%;"><input form="appraisal_edit_answer_1" type="radio" name="answer_3" value="1" <?php echo $check_3_yes;?>></td>
    <td class="text-center" style="width:10%;"><input form="appraisal_edit_answer_1" type="radio" name="answer_3" value="0" <?php echo $check_3_no;?>></td>
  </tr>

  <tr style="height:30px;">
    <td colspan="2" class="" style="width:80%;">
	Do you have regular opportunities to discuss your work, and action plans?
	</td>
    <td class="text-center" style="width:10%;"><input form="appraisal_edit_answer_1" type="radio" name="answer_4" value="1" <?php echo $check_4_yes;?>></td>
    <td class="text-center" style="width:10%;"><input form="appraisal_edit_answer_1" type="radio" name="answer_4" value="0" <?php echo $check_4_no;?>></td>
  </tr>

  <tr style="height:30px;">
    <td colspan="2" class="" style="width:80%;">
	Have you carried out the action plan / improvements agreed with your manager, which were made at the last Performance Appraisal Meeting?
	</td>
    <td class="text-center" style="width:10%;"><input form="appraisal_edit_answer_1" type="radio" name="answer_5" value="1" <?php echo $check_5_yes;?>></td>
    <td class="text-center" style="width:10%;"><input form="appraisal_edit_answer_1" type="radio" name="answer_5" value="0" <?php echo $check_5_no;?>></td>
  </tr>

  <tr class="text-right" style="height:50px;">
    <td colspan="4" class="" style="">

	</td>
  </table>


	<br>	<br>
	</div>
  </div>

  <div class="col-sm-12" style="">

<!--   <div class="col-sm-12">
	<table width="100%" border="1" cellspacing="2" cellpadding="5">
  <tr>
    <td class="" colspan="4" style="color:#fff;background:#666666; font-size:18px; font-weight:bolder;width:25%;">
    Please give the below answers in the last of the year. 
	</td>
  </tr>
  </table>
  <br>
  </div> -->



	

	<div class="col-sm-12">
	<table width="100%" border="1" cellspacing="2" cellpadding="5">
  <tr style="min-height:40px;">
    <td class="" colspan="4" style="background:lightblue; font-weight:bolder;width:25%;">
	1.2. What have you accomplished, over and above the minimum requirements of your job description; in the period under review (consider the early part of the period as well as more recent events)? Have you made any innovations? 
	</td>
  </tr>
  <tr>
    <td class="text-center" style="width:10%;">
	Answer:
	</td>
    <td colspan="3" class="text-center" style="width:90%;">
    <textarea form="appraisal_edit_answer_2" class="form-control" name="answer_6" rows="2" style="border: 0px solid #ccc;"><?php echo $answer_6;?></textarea>
    </td>
  </tr>

  

  </table>


	<br>
	</div>



  <div class="col-sm-12">

	<table width="100%" border="1" cellspacing="2" cellpadding="5">
  <tr style="min-height:40px;">
    <td class="" colspan="4" style="background:lightblue; font-weight:bolder;width:25%;">
    1.3. List any difficulties you have in carrying out your work. Were there any obstacles outside your own control which prevented you from performing effectively?
	</td>
  </tr>
  <tr>
    <td class="text-center" style="width:10%;">
	Answer:
	</td>
    <td colspan="3" class="text-center" style="width:90%;">
    <textarea form="appraisal_edit_answer_2" class="form-control" name="answer_7" rows="2" style="border: 0px solid #ccc;"><?php echo $answer_7;?></textarea>
    </td>
  </tr>

  

  </table>


	<br>
	</div>



  <div class="col-sm-12">
	<table width="100%" border="1" cellspacing="2" cellpadding="5">
  <tr style="min-height:40px;">
    <td class="" colspan="4" style="background:lightblue; font-weight:bolder;width:25%;">
    1.4. What parts of your job, do you….
	</td>
  </tr>
  <tr>
  <td class="" style="width:25%;background:lightblue;">
  (a) do best?
	</td>
  <td class="" style="width:25%;">
  <textarea form="appraisal_edit_answer_2" class="form-control" name="answer_8" rows="2" style="border: 0px solid #ccc;"><?php echo $answer_8;?></textarea>
	</td>
  <td class="" style="width:25%;background:lightblue;">
  (b) do less well?
	</td>
  <td class="" style="width:25%;">
  <textarea form="appraisal_edit_answer_2" class="form-control" name="answer_9" rows="2" style="border: 0px solid #ccc;"><?php echo $answer_9;?></textarea>
	</td>
  </tr>

  <tr>
  <td class="" style="width:25%;background:lightblue;">
  (c) have difficulty with?
	</td>
  <td class="" style="width:25%;">
  <textarea form="appraisal_edit_answer_2" class="form-control" name="answer_10" rows="2" style="border: 0px solid #ccc;"><?php echo $answer_10;?></textarea>
	</td>
  <td class="" style="width:25%;background:lightblue;">
  (d) fail to enjoy?
	</td>
  <td class="" style="width:25%;">
  <textarea form="appraisal_edit_answer_2" class="form-control" name="answer_11" rows="2" style="border: 0px solid #ccc;"><?php echo $answer_11;?></textarea>
	</td>
  </tr>

  

  </table>


	<br>
	</div>



  <div class="col-sm-12">
	<table width="100%" border="1" cellspacing="2" cellpadding="5">
  <tr style="min-height:40px;">
    <td class="" colspan="4" style="background:lightblue; font-weight:bolder;width:25%;">
    1.5. Have you any skills, aptitudes, or knowledge not fully utilized in your job? If so, what are they and how could they be used?
	</td>
  </tr>
  <tr>
    <td class="text-center" style="width:10%;">
	Answer:
	</td>
    <td colspan="3" class="text-center" style="width:90%;">
    <textarea form="appraisal_edit_answer_2" class="form-control" name="answer_12" rows="2" style="border: 0px solid #ccc;"><?php echo $answer_12;?></textarea>
    </td>
  </tr>

  

  </table>


	<br>
	</div>



  <div class="col-sm-12">
	<table width="100%" border="1" cellspacing="2" cellpadding="5">
  <tr style="min-height:40px;">
    <td class="" colspan="4" style="background:lightblue; font-weight:bolder;width:25%;">
    1.6. Can you suggest training which would help to improve your performance or development?
	</td>
  </tr>
  <tr>
    <td class="text-center" style="width:10%;">
	Answer:
	</td>
    <td colspan="3" class="text-center" style="width:90%;">
    <textarea form="appraisal_edit_answer_2" class="form-control" name="answer_13" rows="2" style="border: 0px solid #ccc;"><?php echo $answer_13;?></textarea>
    </td>
  </tr>

  

  </table>


	<br>
	</div>


  <div class="col-sm-12">
	<table width="100%" border="1" cellspacing="2" cellpadding="5">
  <tr style="min-height:40px;">
    <td class="" colspan="4" style="background:lightblue; font-weight:bolder;width:25%;">
    1.7.Additional remarks, notes, questions, or suggestions:
	</td>
  </tr>
  <tr>
    <td class="text-center" style="width:10%;">
	Answer:
	</td>
    <td colspan="3" class="text-center" style="width:90%;">
    <textarea form="appraisal_edit_answer_2" class="form-control" name="answer_14" rows="2" style="border: 0px solid #ccc;"><?php echo $answer_14;?></textarea>
    </td>
  </tr>

  

  </table>


	<br>
	</div>


  <div class="col-sm-12">
 

	</div>


	
	</div>

	

  <div class="col-sm-12">

<hr>

  <div class="col-sm-12">
	<table width="100%" border="1" cellspacing="2" cellpadding="5">
  <tr>
    <td class="" colspan="6" style="color:#fff;background:#666666;font-size:18px; font-weight:bolder;">
    PERFORMANCE REVIEW BY SUPERVISOR
    </td>
  </tr>
  <tr>
    <td class="" colspan="6" style="">
    The Line and Functional Manager (if any) shall list the Objectives set for the Appraisee in the agreed action plan for the period covered by current appraisal or the Job Description with the measure of standard achieved.
    <br><br>Score the performance using the following table:


    <table width="100%" border="1" cellspacing="2" cellpadding="5">
  <tr style="background:#fff4c6;font-weight:bolder;">
    <td class="text-center" style="width:40%;">LEVEL</td>
    <td class="text-center" style="width:50%;">DEFINITION</td>
    <td class="text-center"  style="width:10%;">RATING</td>
  </tr>
  <tr style="">
    <td class="" style="width:40%;">Outstanding performance</td>
    <td class="" style="width:50%;">Objectives exceeded and competencies more than fully demonstrated</td>
    <td class="text-center"  style="width:10%;">4</td>
  </tr>
  <tr style="">
    <td class="" style="width:40%;">Standard performance</td>
    <td class="" style="width:50%;">Objectives met and competencies fully demonstrated at required levels</td>
    <td class="text-center"  style="width:10%;">3</td>
  </tr>
  <tr style="">
    <td class="" style="width:40%;">Less than standard performance with development needs</td>
    <td class="" style="width:50%;">Most objectives met but development required to fully meet all objectives</td>
    <td class="text-center"  style="width:10%;">2</td>
  </tr>
  <tr style="">
    <td class="" style="width:40%;">Unsatisfactory performance</td>
    <td class="" style="width:50%;">Performance unacceptable; objectives not met and competencies not demonstrated</td>
    <td class="text-center"  style="width:10%;">1</td>
  </tr>
</table><br><br>


    </td>
  </tr>
</table>
<br>
</div>



  <div class="col-sm-12">
	<table width="100%" border="1" cellspacing="2" cellpadding="5">
  <tr>
    <td class="" colspan="6" style="color:#fff;background:#666666;font-size:18px; font-weight:bolder;">
    OBJECTIVE/ TARGETS FOR THE NEXT 12 MONTH
    </td>
  </tr>
  <tr style="min-height:40px;">
    <td class="text-center" style="background:lightblue; font-weight:bolder;width:15%;">
    OBJECTIVE
	</td>
  <td class="text-center" style="background:lightblue; font-weight:bolder;width:15%;">
  EXPECTED RESULT
	</td>
  <td class="text-center" style="background:lightblue; font-weight:bolder;width:40%;">
  ACTIONS TO BE CARRIED OUT
	</td>
  <td class="text-center" style="background:lightblue; font-weight:bolder;width:10%;">
  PRIORITY
	</td>
  <td class="text-center" style="background:lightblue; font-weight:bolder;width:10%;">
  DEADLINE
	</td>
	<td class="text-center" style="background:lightblue; font-weight:bolder;width:10%;">
  RATING
	</td>
  </tr>


  <?php

  $count=count($appraisal_task_array);
  for($i=0;$i<$count;$i++)
  {

	$uid=$appraisal_task_array[$i]['uid'];
    $task=$appraisal_task_array[$i]['task'];
    $deadline=$appraisal_task_array[$i]['deadline'];
	$priority=$appraisal_task_array[$i]['priority'];
	$rating=$appraisal_task_array[$i]['rating'];

    if($count<2)
    {
      echo '<tr style="min-height:50px;">
      <td class="text-center" style="15%;">
      <textarea class="form-control" rows="2" style="border: 0px solid #ccc;">'.$appraisal_array[0]['objective'].'</textarea>
    </td>
    <td class="text-center" style="width:15%;">
    <textarea class="form-control" rows="2" style="border: 0px solid #ccc;">'.$appraisal_array[0]['expected_result'].'</textarea>
    </td>
    <td class="" style="width:40%;">
    <textarea class="form-control" rows="2" style="border: 0px solid #ccc;">'.$task.'</textarea>
    </td>
    <td class="text-center" style="width:10%;">'.$priority.'</td>
	<td class="text-center" style="width:10%;">'.$deadline.'</td>
	<td class="text-center" style="width:10%;">
	<select class="form-control" form="appraisal_rating_edit_0" name="rating[]" class="">';
	
	for($j=1;$j<=10;$j++)
	{
		$selected='';

		if($rating==$j){$selected='selected="selected"';}

		echo '<option value="'.$j.'" '.$selected.'>'.$j.'</option>';
	}

	echo '</select>
	<input type="hidden" name="rating_uid[]" form="appraisal_rating_edit_0" value="'.$uid.'">
	</td>
    </tr>';

    }
    else{

      if($i==0)
      {

        echo '<tr style="min-height:50px;">
      <td rowspan="'.$count.'" class="text-center" style="15%;">
      <textarea class="form-control" rows="2" style="border: 0px solid #ccc;">'.$appraisal_array[0]['objective'].'</textarea>
    </td>
    <td rowspan="'.$count.'" class="text-center" style="width:15%;">
    <textarea class="form-control" rows="2" style="border: 0px solid #ccc;">'.$appraisal_array[0]['expected_result'].'</textarea>
    </td>
    <td class="" style="width:40%;">
    <textarea class="form-control" rows="2" style="border: 0px solid #ccc;">'.$task.'</textarea>
    </td>
    <td class="text-center" style="width:10%;">'.$priority.'</td>
	<td class="text-center" style="width:10%;">'.$deadline.'</td>
	<td class="text-center" style="width:10%;">
	<select class="form-control" form="appraisal_rating_edit_0" name="rating[]" class="">';
	
	for($j=1;$j<=10;$j++)
	{
		$selected='';

		if($rating==$j){$selected='selected="selected"';}

		echo '<option value="'.$j.'" '.$selected.'>'.$j.'</option>';
	}

	echo '</select>
	<input type="hidden" name="rating_uid[]" form="appraisal_rating_edit_0" value="'.$uid.'">
	</td>
    </tr>';


      }
      else
      {

        echo '
    <td class="" style="width:40%;">
    <textarea class="form-control" rows="2" style="border: 0px solid #ccc;" >'.$task.'</textarea>
    </td>
    <td class="text-center" style="width:10%;">'.$priority.'</td>
	<td class="text-center" style="width:10%;">'.$deadline.'</td>
	<td class="text-center" style="width:10%;">
	<select class="form-control" form="appraisal_rating_edit_0" name="rating[]" class="">';
	
	for($j=1;$j<=10;$j++)
	{
		$selected='';

		if($rating==$j){$selected='selected="selected"';}

		echo '<option value="'.$j.'" '.$selected.'>'.$j.'</option>';
	}

	echo '</select>
	<input type="hidden" name="rating_uid[]" form="appraisal_rating_edit_0" value="'.$uid.'">
	</td>
    </tr>';

      }


    }


  }

  ?>


  <tr class="text-right" style="height:50px;">
  <td colspan="6">
  <span style="float:left;">Note: For priority column 1=priority  2=important  3=desirable</span>
  <input form="appraisal_rating_edit_0" name="question_id" type="hidden" value="0">
  <input form="appraisal_rating_edit_0" name="uid" type="hidden" value="<?php echo $_REQUEST['uid'];?>">
<button id="appraisal_edit_button_0" form="appraisal_rating_edit_0" class="btn btn-primary"type="submit" name="button" value="save" <?php echo $disabled_0;?>>Save</button>
	</td>
  </tr>

  </table>
  <br><br>
  </div>



  <?php $question_id=1; ?>

  <div class="col-sm-12">
	<table width="100%" border="1" cellspacing="2" cellpadding="5">
  <tr style="min-height:40px;">
    <td class="" style="background:lightblue; font-weight:bolder;width:40%;">
    2.1. OBJECTIVE FROM ACTION PLAN OR JOB DESCRIPTION 
  </td>
  <td class="text-center" style="background:lightblue; font-weight:bolder;width:50%;">
  COMMENT
  </td>
  <td class="text-center" style="background:lightblue; font-weight:bolder;width:10%;">
  RATING
	</td>
  </tr>
  
  <tr style="min-height:40px;">
    <td class="" colspan="3" style="">
    Evaluate performance and achieved goals. Provide evidence to support your assessment  
	</td>
  </tr>

  <tr>
  <td class="text-center" style="width:40%;">
    <textarea form="appraisal_rating_edit_<?php echo $question_id;?>" class="form-control" name="comment_title[]" rows="2" style="border: 0px solid #ccc;"><?php echo ${'comment_title_'.$question_id.'_1'};?></textarea>
    </td>

  <td class="text-center" style="width:50%;">
    <textarea form="appraisal_rating_edit_<?php echo $question_id;?>" class="form-control" name="comment[]" rows="2" style="border: 0px solid #ccc;"><?php echo ${'comment_'.$question_id.'_1'};?></textarea>
    </td>
    <td class="text-center" style="width:10%;">
    <select form="appraisal_rating_edit_<?php echo $question_id;?>" name="comment_rating[]" class="form-control" style="border: 0px solid #ccc;">
    <?php 
    
    for($i=1;$i<=10;$i++)
    {
      $selected='';
      $rating=${'rating_'.$question_id.'_1'};
      if($rating==$i){$selected='selected="selected"';}
      echo '<option value="'.$i.'" '.$selected.'>'.$i.'</option>';

    }

    ?>
    </select>
    </td>
  </tr>



  <tr>
  <td class="text-center" style="width:40%;">
    <textarea form="appraisal_rating_edit_<?php echo $question_id; ?>" class="form-control" name="comment_title[]" rows="2" style="border: 0px solid #ccc;"><?php echo ${'comment_title_'.$question_id.'_2'}; ?></textarea>
    </td>

  <td class="text-center" style="width:50%;">
    <textarea form="appraisal_rating_edit_<?php echo $question_id;?>" class="form-control" name="comment[]" rows="2" style="border: 0px solid #ccc;"><?php echo ${'comment_'.$question_id.'_2'}; ?></textarea>
    </td>
    <td class="text-center" style="width:10%;">
    <select form="appraisal_rating_edit_<?php echo $question_id;?>" name="comment_rating[]" class="form-control" style="border: 0px solid #ccc;">
    <?php 
    
    for($i=1;$i<=10;$i++)
    {
      $selected='';
      $rating=${'rating_'.$question_id.'_2'};
      if($rating==$i){$selected='selected="selected"';}
      echo '<option value="'.$i.'" '.$selected.'>'.$i.'</option>';

    }

    ?>
    </select>
    </td>
  </tr>

  <tr>
  <td class="text-center" style="width:40%;">
    <textarea form="appraisal_rating_edit_<?php echo $question_id;?>" class="form-control" name="comment_title[]" rows="2" style="border: 0px solid #ccc;"><?php echo ${'comment_title_'.$question_id.'_3'};?></textarea>
    </td>

  <td class="text-center" style="width:50%;">
    <textarea form="appraisal_rating_edit_<?php echo $question_id;?>" class="form-control" name="comment[]" rows="2" style="border: 0px solid #ccc;"><?php echo ${'comment_'.$question_id.'_3'};?></textarea>
    </td>
    <td class="text-center" style="width:10%;">
    <select form="appraisal_rating_edit_<?php echo $question_id;?>" name="comment_rating[]" class="form-control" style="border: 0px solid #ccc;">
    <?php 
    
    for($i=1;$i<=10;$i++)
    {
      $selected='';
      $rating=${'rating_'.$question_id.'_3'};
      if($rating==$i){$selected='selected="selected"';}
      echo '<option value="'.$i.'" '.$selected.'>'.$i.'</option>';

    }

    ?>
    </select>
    </td>
  </tr>


  <tr>
  <td class="text-center" style="width:40%;">
    <textarea form="appraisal_rating_edit_<?php echo $question_id;?>" class="form-control" name="comment_title[]" rows="2" style="border: 0px solid #ccc;"><?php echo ${'comment_title_'.$question_id.'_4'};?></textarea>
    </td>

  <td class="text-center" style="width:50%;">
    <textarea form="appraisal_rating_edit_<?php echo $question_id;?>" class="form-control" name="comment[]" rows="2" style="border: 0px solid #ccc;"><?php echo ${'comment_'.$question_id.'_4'};?></textarea>
    </td>
    <td class="text-center" style="width:10%;">
    <select form="appraisal_rating_edit_<?php echo $question_id;?>" name="comment_rating[]" class="form-control" style="border: 0px solid #ccc;">
    <?php 
    
    for($i=1;$i<=10;$i++)
    {
      $selected='';
      $rating=${'rating_'.$question_id.'_4'};
      if($rating==$i){$selected='selected="selected"';}
      echo '<option value="'.$i.'" '.$selected.'>'.$i.'</option>';

    }

    ?>
    </select>
    </td>
  </tr>

  

  <tr>
  <td class="text-center" style="width:40%;">
    <textarea form="appraisal_rating_edit_<?php echo $question_id;?>" class="form-control" name="comment_title[]" rows="2" style="border: 0px solid #ccc;"><?php echo ${'comment_title_'.$question_id.'_5'};?></textarea>
    </td>

  <td class="text-center" style="width:50%;">
    <textarea form="appraisal_rating_edit_<?php echo $question_id;?>" class="form-control" name="comment[]" rows="2" style="border: 0px solid #ccc;"><?php echo ${'comment_'.$question_id.'_5'};?></textarea>
    </td>
    <td class="text-center" style="width:10%;">
    <select form="appraisal_rating_edit_<?php echo $question_id;?>" name="comment_rating[]" class="form-control" style="border: 0px solid #ccc;">
    <?php 
    
    for($i=1;$i<=10;$i++)
    {
      $selected='';
      $rating=${'rating_'.$question_id.'_5'};
      if($rating==$i){$selected='selected="selected"';}
      echo '<option value="'.$i.'" '.$selected.'>'.$i.'</option>';

    }

    ?>
    </select>
    </td>
  </tr>


  <tr>
  <td class="text-center" style="width:40%;">
    <textarea form="appraisal_rating_edit_<?php echo $question_id;?>" class="form-control" name="comment_title[]" rows="2" style="border: 0px solid #ccc;"><?php echo ${'comment_title_'.$question_id.'_6'};?></textarea>
    </td>

  <td class="text-center" style="width:50%;">
    <textarea form="appraisal_rating_edit_<?php echo $question_id;?>" class="form-control" name="comment[]" rows="2" style="border: 0px solid #ccc;"><?php echo ${'comment_'.$question_id.'_6'};?></textarea>
    </td>
    <td class="text-center" style="width:10%;">
    <select form="appraisal_rating_edit_<?php echo $question_id;?>" name="comment_rating[]" class="form-control" style="border: 0px solid #ccc;">
    <?php 
    
    for($i=1;$i<=10;$i++)
    {
      $selected='';
      $rating=${'rating_'.$question_id.'_6'};
      if($rating==$i){$selected='selected="selected"';}
      echo '<option value="'.$i.'" '.$selected.'>'.$i.'</option>';

    }

    ?>
    </select>
    </td>
  </tr>

  <tr style="height:50px;">
  <td colspan="3" class="text-right">
    <input form="appraisal_rating_edit_<?php echo $question_id;?>" name="question_id" type="hidden" value="<?php echo $question_id;?>">
    <input form="appraisal_rating_edit_<?php echo $question_id;?>" name="uid" type="hidden" value="<?php echo $_REQUEST['uid'];?>">
<button form="appraisal_rating_edit_<?php echo $question_id;?>" type="submit" class="btn btn-primary" name="button" value="save" <?php echo ${'disabled_'.$question_id};?>>Save</button>
    </td>
  </tr>

  </table>
	<br>
	</div>


  <?php $question_id=2; ?>

<div class="col-sm-12">
<table width="100%" border="1" cellspacing="2" cellpadding="5">
<tr style="min-height:40px;">
  <td class="" style="background:lightblue; font-weight:bolder;width:40%;">
  2.2. CAPABILITY, KNOWLEDGE AND SKILLS
</td>
<td class="text-center" style="background:lightblue; font-weight:bolder;width:50%;">
COMMENT
</td>
<td class="text-center" style="background:lightblue; font-weight:bolder;width:10%;">
RATING
</td>
</tr>

<tr style="min-height:40px;">
  <td class="" colspan="3" style="">
  Evaluate the capability, knowledge and skills in term of the current role requirement. 
</td>
</tr>

<tr>
<td class="text-center" style="width:40%;">
  <textarea form="appraisal_rating_edit_<?php echo $question_id;?>" class="form-control" name="comment_title[]" rows="2" style="border: 0px solid #ccc;"><?php echo ${'comment_title_'.$question_id.'_1'}; ?></textarea>
  </td>

<td class="text-center" style="width:50%;">
  <textarea form="appraisal_rating_edit_<?php echo $question_id;?>" class="form-control" name="comment[]" rows="2" style="border: 0px solid #ccc;"><?php echo ${'comment_'.$question_id.'_1'};?></textarea>
  </td>
  <td class="text-center" style="width:10%;">
  <select form="appraisal_rating_edit_<?php echo $question_id;?>" name="comment_rating[]" class="form-control" style="border: 0px solid #ccc;">
  <?php 
  
  for($i=1;$i<=10;$i++)
  {
    $selected='';
    $rating=${'rating_'.$question_id.'_1'};
    if($rating==$i){$selected='selected="selected"';}
    echo '<option value="'.$i.'" '.$selected.'>'.$i.'</option>';

  }

  ?>
  </select>
  </td>
</tr>



<tr>
<td class="text-center" style="width:40%;">
  <textarea form="appraisal_rating_edit_<?php echo $question_id;?>" class="form-control" name="comment_title[]" rows="2" style="border: 0px solid #ccc;"><?php echo ${'comment_title_'.$question_id.'_2'};?></textarea>
  </td>

<td class="text-center" style="width:50%;">
  <textarea form="appraisal_rating_edit_<?php echo $question_id;?>" class="form-control" name="comment[]" rows="2" style="border: 0px solid #ccc;"><?php echo ${'comment_'.$question_id.'_2'};?></textarea>
  </td>
  <td class="text-center" style="width:10%;">
  <select form="appraisal_rating_edit_<?php echo $question_id;?>" name="comment_rating[]" class="form-control" style="border: 0px solid #ccc;">
  <?php 
  
  for($i=1;$i<=10;$i++)
  {
    $selected='';
    $rating=${'rating_'.$question_id.'_2'};
    if($rating==$i){$selected='selected="selected"';}
    echo '<option value="'.$i.'" '.$selected.'>'.$i.'</option>';

  }

  ?>
  </select>
  </td>
</tr>

<tr>
<td class="text-center" style="width:40%;">
  <textarea form="appraisal_rating_edit_<?php echo $question_id;?>" class="form-control" name="comment_title[]" rows="2" style="border: 0px solid #ccc;"><?php echo ${'comment_title_'.$question_id.'_3'};?></textarea>
  </td>

<td class="text-center" style="width:50%;">
  <textarea form="appraisal_rating_edit_<?php echo $question_id;?>" class="form-control" name="comment[]" rows="2" style="border: 0px solid #ccc;"><?php echo ${'comment_'.$question_id.'_3'};?></textarea>
  </td>
  <td class="text-center" style="width:10%;">
  <select form="appraisal_rating_edit_<?php echo $question_id;?>" name="comment_rating[]" class="form-control" style="border: 0px solid #ccc;">
  <?php 
  
  for($i=1;$i<=10;$i++)
  {
    $selected='';
    $rating=${'rating_'.$question_id.'_3'};
    if($rating==$i){$selected='selected="selected"';}
    echo '<option value="'.$i.'" '.$selected.'>'.$i.'</option>';

  }

  ?>
  </select>
  </td>
</tr>


<tr>
<td class="text-center" style="width:40%;">
  <textarea form="appraisal_rating_edit_<?php echo $question_id;?>" class="form-control" name="comment_title[]" rows="2" style="border: 0px solid #ccc;"><?php echo ${'comment_title_'.$question_id.'_4'};?></textarea>
  </td>

<td class="text-center" style="width:50%;">
  <textarea form="appraisal_rating_edit_<?php echo $question_id;?>" class="form-control" name="comment[]" rows="2" style="border: 0px solid #ccc;"><?php echo ${'comment_'.$question_id.'_4'};?></textarea>
  </td>
  <td class="text-center" style="width:10%;">
  <select form="appraisal_rating_edit_<?php echo $question_id;?>" name="comment_rating[]" class="form-control" style="border: 0px solid #ccc;">
  <?php 
  
  for($i=1;$i<=10;$i++)
  {
    $selected='';
    $rating=${'rating_'.$question_id.'_4'};
    if($rating==$i){$selected='selected="selected"';}
    echo '<option value="'.$i.'" '.$selected.'>'.$i.'</option>';

  }

  ?>
  </select>
  </td>
</tr>



<tr>
<td class="text-center" style="width:40%;">
  <textarea form="appraisal_rating_edit_<?php echo $question_id;?>" class="form-control" name="comment_title[]" rows="2" style="border: 0px solid #ccc;"><?php echo ${'comment_title_'.$question_id.'_5'};?></textarea>
  </td>

<td class="text-center" style="width:50%;">
  <textarea form="appraisal_rating_edit_<?php echo $question_id;?>" class="form-control" name="comment[]" rows="2" style="border: 0px solid #ccc;"><?php echo ${'comment_'.$question_id.'_5'};?></textarea>
  </td>
  <td class="text-center" style="width:10%;">
  <select form="appraisal_rating_edit_<?php echo $question_id;?>" name="comment_rating[]" class="form-control" style="border: 0px solid #ccc;">
  <?php 
  
  for($i=1;$i<=10;$i++)
  {
    $selected='';
    $rating=${'rating_'.$question_id.'_5'};
    if($rating==$i){$selected='selected="selected"';}
    echo '<option value="'.$i.'" '.$selected.'>'.$i.'</option>';

  }

  ?>
  </select>
  </td>
</tr>


<tr>
<td class="text-center" style="width:40%;">
  <textarea form="appraisal_rating_edit_<?php echo $question_id;?>" class="form-control" name="comment_title[]" rows="2" style="border: 0px solid #ccc;"><?php echo ${'comment_title_'.$question_id.'_6'};?></textarea>
  </td>

<td class="text-center" style="width:50%;">
  <textarea form="appraisal_rating_edit_<?php echo $question_id;?>" class="form-control" name="comment[]" rows="2" style="border: 0px solid #ccc;"><?php echo ${'comment_'.$question_id.'_6'};?></textarea>
  </td>
  <td class="text-center" style="width:10%;">
  <select form="appraisal_rating_edit_<?php echo $question_id;?>" name="comment_rating[]" class="form-control" style="border: 0px solid #ccc;">
  <?php 
  
  for($i=1;$i<=10;$i++)
  {
    $selected='';
    $rating=${'rating_'.$question_id.'_6'};
    if($rating==$i){$selected='selected="selected"';}
    echo '<option value="'.$i.'" '.$selected.'>'.$i.'</option>';

  }

  ?>
  </select>
  </td>
</tr>

<tr style="height:50px;">
<td colspan="3" class="text-right">
  <input form="appraisal_rating_edit_<?php echo $question_id;?>" name="question_id" type="hidden" value="<?php echo $question_id;?>">
  <input form="appraisal_rating_edit_<?php echo $question_id;?>" name="uid" type="hidden" value="<?php echo $_REQUEST['uid'];?>">
<button form="appraisal_rating_edit_<?php echo $question_id;?>" type="submit" class="btn btn-primary" name="button" value="save" <?php echo ${'disabled_'.$question_id};?>>Save</button>
  </td>
</tr>

</table>
<br>
</div>





<?php $question_id=3; ?>

<div class="col-sm-12">
<table width="100%" border="1" cellspacing="2" cellpadding="5">
<tr style="min-height:40px;">
  <td class="" style="background:lightblue; font-weight:bolder;width:40%;">
  2.3 MANAGERIAL SKILLS:
</td>
<td class="text-center" style="background:lightblue; font-weight:bolder;width:50%;">
COMMENT
</td>
<td class="text-center" style="background:lightblue; font-weight:bolder;width:10%;">
RATING
</td>
</tr>

<tr style="min-height:40px;">
  <td class="" colspan="3" style="">
  Evaluate managerial skills if applicable (Required for all supervisors/managers). 
</td>
</tr>

<tr>
<td class="text-center" style="width:40%;">
  <textarea form="appraisal_rating_edit_<?php echo $question_id;?>" class="form-control" name="comment_title[]" rows="2" style="border: 0px solid #ccc;"><?php echo ${'comment_title_'.$question_id.'_1'};?></textarea>
  </td>

<td class="text-center" style="width:50%;">
  <textarea form="appraisal_rating_edit_<?php echo $question_id;?>" class="form-control" name="comment[]" rows="2" style="border: 0px solid #ccc;"><?php echo ${'comment_'.$question_id.'_1'};?></textarea>
  </td>
  <td class="text-center" style="width:10%;">
  <select form="appraisal_rating_edit_<?php echo $question_id;?>" name="comment_rating[]" class="form-control" style="border: 0px solid #ccc;">
  <?php 
  
  for($i=1;$i<=10;$i++)
  {
    $selected='';
    $rating=${'rating_'.$question_id.'_1'};
    if($rating==$i){$selected='selected="selected"';}
    echo '<option value="'.$i.'" '.$selected.'>'.$i.'</option>';

  }

  ?>
  </select>
  </td>
</tr>



<tr>
<td class="text-center" style="width:40%;">
  <textarea form="appraisal_rating_edit_<?php echo $question_id;?>" class="form-control" name="comment_title[]" rows="2" style="border: 0px solid #ccc;"><?php echo ${'comment_title_'.$question_id.'_2'};?></textarea>
  </td>

<td class="text-center" style="width:50%;">
  <textarea form="appraisal_rating_edit_<?php echo $question_id;?>" class="form-control" name="comment[]" rows="2" style="border: 0px solid #ccc;"><?php echo ${'comment_'.$question_id.'_2'};?></textarea>
  </td>
  <td class="text-center" style="width:10%;">
  <select form="appraisal_rating_edit_<?php echo $question_id;?>" name="comment_rating[]" class="form-control" style="border: 0px solid #ccc;">
  <?php 
  
  for($i=1;$i<=10;$i++)
  {
    $selected='';
    $rating=${'rating_'.$question_id.'_2'};
    if($rating==$i){$selected='selected="selected"';}
    echo '<option value="'.$i.'" '.$selected.'>'.$i.'</option>';

  }

  ?>
  </select>
  </td>
</tr>

<tr>
<td class="text-center" style="width:40%;">
  <textarea form="appraisal_rating_edit_<?php echo $question_id;?>" class="form-control" name="comment_title[]" rows="2" style="border: 0px solid #ccc;"><?php echo ${'comment_title_'.$question_id.'_3'};?></textarea>
  </td>

<td class="text-center" style="width:50%;">
  <textarea form="appraisal_rating_edit_<?php echo $question_id;?>" class="form-control" name="comment[]" rows="2" style="border: 0px solid #ccc;"><?php echo ${'comment_'.$question_id.'_3'};?></textarea>
  </td>
  <td class="text-center" style="width:10%;">
  <select form="appraisal_rating_edit_<?php echo $question_id;?>" name="comment_rating[]" class="form-control" style="border: 0px solid #ccc;">
  <?php 
  
  for($i=1;$i<=10;$i++)
  {
    $selected='';
    $rating=${'rating_'.$question_id.'_3'};
    if($rating==$i){$selected='selected="selected"';}
    echo '<option value="'.$i.'" '.$selected.'>'.$i.'</option>';

  }

  ?>
  </select>
  </td>
</tr>


<tr>
<td class="text-center" style="width:40%;">
  <textarea form="appraisal_rating_edit_<?php echo $question_id;?>" class="form-control" name="comment_title[]" rows="2" style="border: 0px solid #ccc;"><?php echo ${'comment_title_'.$question_id.'_4'};?></textarea>
  </td>

<td class="text-center" style="width:50%;">
  <textarea form="appraisal_rating_edit_<?php echo $question_id;?>" class="form-control" name="comment[]" rows="2" style="border: 0px solid #ccc;"><?php echo ${'comment_'.$question_id.'_4'};?></textarea>
  </td>
  <td class="text-center" style="width:10%;">
  <select form="appraisal_rating_edit_<?php echo $question_id;?>" name="comment_rating[]" class="form-control" style="border: 0px solid #ccc;">
  <?php 
  
  for($i=1;$i<=10;$i++)
  {
    $selected='';
    $rating=${'rating_'.$question_id.'_4'};
    if($rating==$i){$selected='selected="selected"';}
    echo '<option value="'.$i.'" '.$selected.'>'.$i.'</option>';

  }

  ?>
  </select>
  </td>
</tr>



<tr>
<td class="text-center" style="width:40%;">
  <textarea form="appraisal_rating_edit_<?php echo $question_id;?>" class="form-control" name="comment_title[]" rows="2" style="border: 0px solid #ccc;"><?php echo ${'comment_title_'.$question_id.'_5'};?></textarea>
  </td>

<td class="text-center" style="width:50%;">
  <textarea form="appraisal_rating_edit_<?php echo $question_id;?>" class="form-control" name="comment[]" rows="2" style="border: 0px solid #ccc;"><?php echo ${'comment_'.$question_id.'_5'};?></textarea>
  </td>
  <td class="text-center" style="width:10%;">
  <select form="appraisal_rating_edit_<?php echo $question_id;?>" name="comment_rating[]" class="form-control" style="border: 0px solid #ccc;">
  <?php 
  
  for($i=1;$i<=10;$i++)
  {
    $selected='';
    $rating=${'rating_'.$question_id.'_5'};
    if($rating==$i){$selected='selected="selected"';}
    echo '<option value="'.$i.'" '.$selected.'>'.$i.'</option>';

  }

  ?>
  </select>
  </td>
</tr>


<tr>
<td class="text-center" style="width:40%;">
  <textarea form="appraisal_rating_edit_<?php echo $question_id;?>" class="form-control" name="comment_title[]" rows="2" style="border: 0px solid #ccc;"><?php echo ${'comment_title_'.$question_id.'_6'};?></textarea>
  </td>

<td class="text-center" style="width:50%;">
  <textarea form="appraisal_rating_edit_<?php echo $question_id;?>" class="form-control" name="comment[]" rows="2" style="border: 0px solid #ccc;"><?php echo ${'comment_'.$question_id.'_6'};?></textarea>
  </td>
  <td class="text-center" style="width:10%;">
  <select form="appraisal_rating_edit_<?php echo $question_id;?>" name="comment_rating[]" class="form-control" style="border: 0px solid #ccc;">
  <?php 
  
  for($i=1;$i<=10;$i++)
  {
    $selected='';
    $rating=${'rating_'.$question_id.'_6'};
    if($rating==$i){$selected='selected="selected"';}
    echo '<option value="'.$i.'" '.$selected.'>'.$i.'</option>';

  }

  ?>
  </select>
  </td>
</tr>

<tr>
<td class="text-center" style="width:40%;">
  <textarea form="appraisal_rating_edit_<?php echo $question_id;?>" class="form-control" name="comment_title[]" rows="2" style="border: 0px solid #ccc;"><?php echo ${'comment_title_'.$question_id.'_7'};?></textarea>
  </td>

<td class="text-center" style="width:50%;">
  <textarea form="appraisal_rating_edit_<?php echo $question_id;?>" class="form-control" name="comment[]" rows="2" style="border: 0px solid #ccc;"><?php echo ${'comment_'.$question_id.'_7'};?></textarea>
  </td>
  <td class="text-center" style="width:10%;">
  <select form="appraisal_rating_edit_<?php echo $question_id;?>" name="comment_rating[]" class="form-control" style="border: 0px solid #ccc;">
  <?php 
  
  for($i=1;$i<=10;$i++)
  {
    $selected='';
    $rating=${'rating_'.$question_id.'_7'};
    if($rating==$i){$selected='selected="selected"';}
    echo '<option value="'.$i.'" '.$selected.'>'.$i.'</option>';

  }

  ?>
  </select>
  </td>
</tr>

<tr style="height:50px;">
<td colspan="3" class="text-right">
  <input form="appraisal_rating_edit_<?php echo $question_id;?>" name="question_id" type="hidden" value="<?php echo $question_id;?>">
  <input form="appraisal_rating_edit_<?php echo $question_id;?>" name="uid" type="hidden" value="<?php echo $_REQUEST['uid'];?>">
<button form="appraisal_rating_edit_<?php echo $question_id;?>" type="submit" class="btn btn-primary" name="button" value="save" <?php echo ${'disabled_'.$question_id};?>>Save</button>
  </td>
</tr>

</table>
<br>
</div>


<?php $question_id=4; ?>

<div class="col-sm-12">
<table width="100%" border="1" cellspacing="2" cellpadding="5">
<tr style="min-height:40px;">
  <td class="" style="background:lightblue; font-weight:bolder;width:40%;">
  2.4 BEHAVIOUR AND RELATIONSHIP
</td>
<td class="text-center" style="background:lightblue; font-weight:bolder;width:50%;">
COMMENT
</td>
<td class="text-center" style="background:lightblue; font-weight:bolder;width:10%;">
RATING
</td>
</tr>

<tr style="min-height:40px;">
  <td class="" colspan="3" style="">
  Evaluate the general behavior and relationship with colleagues, managers, subordinates etc. 
</td>
</tr>

<tr>
<td class="text-center" style="width:40%;">
  <textarea form="appraisal_rating_edit_<?php echo $question_id;?>" class="form-control" name="comment_title[]" rows="2" style="border: 0px solid #ccc;"><?php echo ${'comment_title_'.$question_id.'_1'};?></textarea>
  </td>

<td class="text-center" style="width:50%;">
  <textarea form="appraisal_rating_edit_<?php echo $question_id;?>" class="form-control" name="comment[]" rows="2" style="border: 0px solid #ccc;"><?php echo ${'comment_'.$question_id.'_1'};?></textarea>
  </td>
  <td class="text-center" style="width:10%;">
  <select form="appraisal_rating_edit_<?php echo $question_id;?>" name="comment_rating[]" class="form-control" style="border: 0px solid #ccc;">
  <?php 
  
  for($i=1;$i<=10;$i++)
  {
    $selected='';
    $rating=${'rating_'.$question_id.'_1'};
    if($rating==$i){$selected='selected="selected"';}
    echo '<option value="'.$i.'" '.$selected.'>'.$i.'</option>';

  }

  ?>
  </select>
  </td>
</tr>



<tr>
<td class="text-center" style="width:40%;">
  <textarea form="appraisal_rating_edit_<?php echo $question_id;?>" class="form-control" name="comment_title[]" rows="2" style="border: 0px solid #ccc;"><?php echo ${'comment_title_'.$question_id.'_2'};?></textarea>
  </td>

<td class="text-center" style="width:50%;">
  <textarea form="appraisal_rating_edit_<?php echo $question_id;?>" class="form-control" name="comment[]" rows="2" style="border: 0px solid #ccc;"><?php echo ${'comment_'.$question_id.'_2'};?></textarea>
  </td>
  <td class="text-center" style="width:10%;">
  <select form="appraisal_rating_edit_<?php echo $question_id;?>" name="comment_rating[]" class="form-control" style="border: 0px solid #ccc;">
  <?php 
  
  for($i=1;$i<=10;$i++)
  {
    $selected='';
    $rating=${'rating_'.$question_id.'_2'};
    if($rating==$i){$selected='selected="selected"';}
    echo '<option value="'.$i.'" '.$selected.'>'.$i.'</option>';

  }

  ?>
  </select>
  </td>
</tr>

<tr>
<td class="text-center" style="width:40%;">
  <textarea form="appraisal_rating_edit_<?php echo $question_id;?>" class="form-control" name="comment_title[]" rows="2" style="border: 0px solid #ccc;"><?php echo ${'comment_title_'.$question_id.'_3'};?></textarea>
  </td>

<td class="text-center" style="width:50%;">
  <textarea form="appraisal_rating_edit_<?php echo $question_id;?>" class="form-control" name="comment[]" rows="2" style="border: 0px solid #ccc;"><?php echo ${'comment_'.$question_id.'_3'};?></textarea>
  </td>
  <td class="text-center" style="width:10%;">
  <select form="appraisal_rating_edit_<?php echo $question_id;?>" name="comment_rating[]" class="form-control" style="border: 0px solid #ccc;">
  <?php 
  
  for($i=1;$i<=10;$i++)
  {
    $selected='';
    $rating=${'rating_'.$question_id.'_3'};
    if($rating==$i){$selected='selected="selected"';}
    echo '<option value="'.$i.'" '.$selected.'>'.$i.'</option>';

  }

  ?>
  </select>
  </td>
</tr>


<tr>
<td class="text-center" style="width:40%;">
  <textarea form="appraisal_rating_edit_<?php echo $question_id;?>" class="form-control" name="comment_title[]" rows="2" style="border: 0px solid #ccc;"><?php echo ${'comment_title_'.$question_id.'_4'};?></textarea>
  </td>

<td class="text-center" style="width:50%;">
  <textarea form="appraisal_rating_edit_<?php echo $question_id;?>" class="form-control" name="comment[]" rows="2" style="border: 0px solid #ccc;"><?php echo ${'comment_'.$question_id.'_4'};?></textarea>
  </td>
  <td class="text-center" style="width:10%;">
  <select form="appraisal_rating_edit_<?php echo $question_id;?>" name="comment_rating[]" class="form-control" style="border: 0px solid #ccc;">
  <?php 
  
  for($i=1;$i<=10;$i++)
  {
    $selected='';
    $rating=${'rating_'.$question_id.'_4'};
    if($rating==$i){$selected='selected="selected"';}
    echo '<option value="'.$i.'" '.$selected.'>'.$i.'</option>';

  }

  ?>
  </select>
  </td>
</tr>



<tr>
<td class="text-center" style="width:40%;">
  <textarea form="appraisal_rating_edit_<?php echo $question_id;?>" class="form-control" name="comment_title[]" rows="2" style="border: 0px solid #ccc;"><?php echo ${'comment_title_'.$question_id.'_5'};?></textarea>
  </td>

<td class="text-center" style="width:50%;">
  <textarea form="appraisal_rating_edit_<?php echo $question_id;?>" class="form-control" name="comment[]" rows="2" style="border: 0px solid #ccc;"><?php echo ${'comment_'.$question_id.'_5'};?></textarea>
  </td>
  <td class="text-center" style="width:10%;">
  <select form="appraisal_rating_edit_<?php echo $question_id;?>" name="comment_rating[]" class="form-control" style="border: 0px solid #ccc;">
  <?php 
  
  for($i=1;$i<=10;$i++)
  {
    $selected='';
    $rating=${'rating_'.$question_id.'_5'};
    if($rating==$i){$selected='selected="selected"';}
    echo '<option value="'.$i.'" '.$selected.'>'.$i.'</option>';

  }

  ?>
  </select>
  </td>
</tr>


<tr>
<td class="text-center" style="width:40%;">
  <textarea form="appraisal_rating_edit_<?php echo $question_id;?>" class="form-control" name="comment_title[]" rows="2" style="border: 0px solid #ccc;"><?php echo ${'comment_title_'.$question_id.'_6'};?></textarea>
  </td>

<td class="text-center" style="width:50%;">
  <textarea form="appraisal_rating_edit_<?php echo $question_id;?>" class="form-control" name="comment[]" rows="2" style="border: 0px solid #ccc;"><?php echo ${'comment_'.$question_id.'_6'};?></textarea>
  </td>
  <td class="text-center" style="width:10%;">
  <select form="appraisal_rating_edit_<?php echo $question_id;?>" name="comment_rating[]" class="form-control" style="border: 0px solid #ccc;">
  <?php 
  
  for($i=1;$i<=10;$i++)
  {
    $selected='';
    $rating=${'rating_'.$question_id.'_6'};
    if($rating==$i){$selected='selected="selected"';}
    echo '<option value="'.$i.'" '.$selected.'>'.$i.'</option>';

  }

  ?>
  </select>
  </td>
</tr>

<tr>
<td class="text-center" style="width:40%;">
  <textarea form="appraisal_rating_edit_<?php echo $question_id;?>" class="form-control" name="comment_title[]" rows="2" style="border: 0px solid #ccc;"><?php echo ${'comment_title_'.$question_id.'_7'};?></textarea>
  </td>

<td class="text-center" style="width:50%;">
  <textarea form="appraisal_rating_edit_<?php echo $question_id;?>" class="form-control" name="comment[]" rows="2" style="border: 0px solid #ccc;"><?php echo ${'comment_'.$question_id.'_7'};?></textarea>
  </td>
  <td class="text-center" style="width:10%;">
  <select form="appraisal_rating_edit_<?php echo $question_id;?>" name="comment_rating[]" class="form-control" style="border: 0px solid #ccc;">
  <?php 
  
  for($i=1;$i<=10;$i++)
  {
    $selected='';
    $rating=${'rating_'.$question_id.'_7'};
    if($rating==$i){$selected='selected="selected"';}
    echo '<option value="'.$i.'" '.$selected.'>'.$i.'</option>';

  }

  ?>
  </select>
  </td>
</tr>



<tr>
<td class="text-center" style="width:40%;">
  <textarea form="appraisal_rating_edit_<?php echo $question_id;?>" class="form-control" name="comment_title[]" rows="2" style="border: 0px solid #ccc;"><?php echo ${'comment_title_'.$question_id.'_8'};?></textarea>
  </td>

<td class="text-center" style="width:50%;">
  <textarea form="appraisal_rating_edit_<?php echo $question_id;?>" class="form-control" name="comment[]" rows="2" style="border: 0px solid #ccc;"><?php echo ${'comment_'.$question_id.'_8'};?></textarea>
  </td>
  <td class="text-center" style="width:10%;">
  <select form="appraisal_rating_edit_<?php echo $question_id;?>" name="comment_rating[]" class="form-control" style="border: 0px solid #ccc;">
  <?php 
  
  for($i=1;$i<=10;$i++)
  {
    $selected='';
    $rating=${'rating_'.$question_id.'_8'};
    if($rating==$i){$selected='selected="selected"';}
    echo '<option value="'.$i.'" '.$selected.'>'.$i.'</option>';

  }

  ?>
  </select>
  </td>
</tr>

<tr>
<td class="text-center" style="width:40%;">
  <textarea form="appraisal_rating_edit_<?php echo $question_id;?>" class="form-control" name="comment_title[]" rows="2" style="border: 0px solid #ccc;"><?php echo ${'comment_title_'.$question_id.'_9'};?></textarea>
  </td>

<td class="text-center" style="width:50%;">
  <textarea form="appraisal_rating_edit_<?php echo $question_id;?>" class="form-control" name="comment[]" rows="2" style="border: 0px solid #ccc;"><?php echo ${'comment_'.$question_id.'_9'};?></textarea>
  </td>
  <td class="text-center" style="width:10%;">
  <select form="appraisal_rating_edit_<?php echo $question_id;?>" name="comment_rating[]" class="form-control" style="border: 0px solid #ccc;">
  <?php 
  
  for($i=1;$i<=10;$i++)
  {
    $selected='';
    $rating=${'rating_'.$question_id.'_9'};
    if($rating==$i){$selected='selected="selected"';}
    echo '<option value="'.$i.'" '.$selected.'>'.$i.'</option>';

  }

  ?>
  </select>
  </td>
</tr>

<tr>
<td class="text-center" style="width:40%;">
  <textarea form="appraisal_rating_edit_<?php echo $question_id;?>" class="form-control" name="comment_title[]" rows="2" style="border: 0px solid #ccc;"><?php echo ${'comment_title_'.$question_id.'_10'};?></textarea>
  </td>

<td class="text-center" style="width:50%;">
  <textarea form="appraisal_rating_edit_<?php echo $question_id;?>" class="form-control" name="comment[]" rows="2" style="border: 0px solid #ccc;"><?php echo ${'comment_'.$question_id.'_10'};?></textarea>
  </td>
  <td class="text-center" style="width:10%;">
  <select form="appraisal_rating_edit_<?php echo $question_id;?>" name="comment_rating[]" class="form-control" style="border: 0px solid #ccc;">
  <?php 
  
  for($i=1;$i<=10;$i++)
  {
    $selected='';
    $rating=${'rating_'.$question_id.'_10'};
    if($rating==$i){$selected='selected="selected"';}
    echo '<option value="'.$i.'" '.$selected.'>'.$i.'</option>';

  }

  ?>
  </select>
  </td>
</tr>

<tr>
<td class="text-center" style="width:40%;">
  <textarea form="appraisal_rating_edit_<?php echo $question_id;?>" class="form-control" name="comment_title[]" rows="2" style="border: 0px solid #ccc;"><?php echo ${'comment_title_'.$question_id.'_11'};?></textarea>
  </td>

<td class="text-center" style="width:50%;">
  <textarea form="appraisal_rating_edit_<?php echo $question_id;?>" class="form-control" name="comment[]" rows="2" style="border: 0px solid #ccc;"><?php echo ${'comment_'.$question_id.'_11'};?></textarea>
  </td>
  <td class="text-center" style="width:10%;">
  <select form="appraisal_rating_edit_<?php echo $question_id;?>" name="comment_rating[]" class="form-control" style="border: 0px solid #ccc;">
  <?php 
  
  for($i=1;$i<=10;$i++)
  {
    $selected='';
    $rating=${'rating_'.$question_id.'_11'};
    if($rating==$i){$selected='selected="selected"';}
    echo '<option value="'.$i.'" '.$selected.'>'.$i.'</option>';

  }

  ?>
  </select>
  </td>
</tr>

<tr>
<td class="text-center" style="width:40%;">
  <textarea form="appraisal_rating_edit_<?php echo $question_id;?>" class="form-control" name="comment_title[]" rows="2" style="border: 0px solid #ccc;"><?php echo ${'comment_title_'.$question_id.'_12'};?></textarea>
  </td>

<td class="text-center" style="width:50%;">
  <textarea form="appraisal_rating_edit_<?php echo $question_id;?>" class="form-control" name="comment[]" rows="2" style="border: 0px solid #ccc;"><?php echo ${'comment_'.$question_id.'_12'};?></textarea>
  </td>
  <td class="text-center" style="width:10%;">
  <select form="appraisal_rating_edit_<?php echo $question_id;?>" name="comment_rating[]" class="form-control" style="border: 0px solid #ccc;">
  <?php 
  
  for($i=1;$i<=10;$i++)
  {
    $selected='';
    $rating=${'rating_'.$question_id.'_12'};
    if($rating==$i){$selected='selected="selected"';}
    echo '<option value="'.$i.'" '.$selected.'>'.$i.'</option>';

  }

  ?>
  </select>
  </td>
</tr>

<tr style="height:50px;">
<td colspan="3" class="text-right">
  <input form="appraisal_rating_edit_<?php echo $question_id;?>" name="question_id" type="hidden" value="<?php echo $question_id;?>">
  <input form="appraisal_rating_edit_<?php echo $question_id;?>" name="uid" type="hidden" value="<?php echo $_REQUEST['uid'];?>">
<button form="appraisal_rating_edit_<?php echo $question_id;?>" type="submit" class="btn btn-primary" name="button" value="save" <?php echo ${'disabled_'.$question_id};?>>Save</button>
  </td>
</tr>

</table>
<br>
</div>






<?php $question_id=5; ?>

<div class="col-sm-12">
<table width="100%" border="1" cellspacing="2" cellpadding="5">
<tr style="min-height:40px;">
  <td style="background:lightblue; font-weight:bolder;">
  2.5 TRAINING AND DEVELOPMENT
</td>
</tr>

<tr style="min-height:40px;">
  <td class="">
  Discuss and agree (as far as possible given budgetary availability and authorization considerations) the training and development support to be given to help the Appraise to meet the objective above.
</td>
</tr>

<tr >
<td>
  <textarea form="appraisal_rating_edit_<?php echo $question_id;?>" class="form-control" name="comment[]" rows="2" style="border: 0px solid #ccc;"><?php echo ${'comment_'.$question_id.'_1'};?></textarea>
  </td>
</tr>
<tr >
<td>
  <textarea form="appraisal_rating_edit_<?php echo $question_id;?>" class="form-control" name="comment[]" rows="2" style="border: 0px solid #ccc;"><?php echo ${'comment_'.$question_id.'_2'};?></textarea>
  </td>
</tr>


<tr style="height:50px;">
<td colspan="3" class="text-right">
  <input form="appraisal_rating_edit_<?php echo $question_id;?>" name="question_id" type="hidden" value="<?php echo $question_id;?>">
  <input form="appraisal_rating_edit_<?php echo $question_id;?>" name="uid" type="hidden" value="<?php echo $_REQUEST['uid'];?>">
<button form="appraisal_rating_edit_<?php echo $question_id;?>" type="submit" class="btn btn-primary" name="button" value="save" <?php echo ${'disabled_'.$question_id};?>>Save</button>
  </td>
</tr>

</table>
<br>
</div>



<?php $question_id=6; ?>

<div class="col-sm-12">
<table width="100%" border="1" cellspacing="2" cellpadding="5">
<tr style="min-height:40px;">
  <td style="background:lightblue; font-weight:bolder;">
  2.6 CAREER OPTIONS AND PROMOTION
</td>
</tr>

<tr style="min-height:40px;">
  <td class="">
  Discuss and agree Appraise career directions and wishes and readiness for the promotion, and compare with self-appraisal entry. 
</td>
</tr>

<tr >
<td>
  <textarea form="appraisal_rating_edit_<?php echo $question_id;?>" class="form-control" name="comment[]" rows="2" style="border: 0px solid #ccc;"><?php echo ${'comment_'.$question_id.'_1'};?></textarea>
  </td>
</tr>
<tr >
<td>
  <textarea form="appraisal_rating_edit_<?php echo $question_id;?>" class="form-control" name="comment[]" rows="2" style="border: 0px solid #ccc;"><?php echo ${'comment_'.$question_id.'_2'};?></textarea>
  </td>
</tr>


<tr style="height:50px;">
<td colspan="3" class="text-right">
  <input form="appraisal_rating_edit_<?php echo $question_id;?>" name="question_id" type="hidden" value="<?php echo $question_id;?>">
  <input form="appraisal_rating_edit_<?php echo $question_id;?>" name="uid" type="hidden" value="<?php echo $_REQUEST['uid'];?>">
<button form="appraisal_rating_edit_<?php echo $question_id;?>" type="submit" class="btn btn-primary" name="button" value="save" <?php echo ${'disabled_'.$question_id};?>>Save</button>
  </td>
</tr>

</table>
<br>
</div>



<?php $question_id=7; ?>

<div class="col-sm-12">
<table width="100%" border="1" cellspacing="2" cellpadding="5">
<tr style="min-height:40px;">
  <td style="background:lightblue; font-weight:bolder;">
  2.7 OTHER AREAS OF DISCUSSION
</td>
</tr>

<tr style="min-height:40px;">
  <td class="">
  Provide any additional feedback, thoughts, information
</td>
</tr>

<tr >
<td>
  <textarea form="appraisal_rating_edit_<?php echo $question_id;?>" class="form-control" name="comment[]" rows="2" style="border: 0px solid #ccc;"><?php echo ${'comment_'.$question_id.'_1'};?></textarea>
  </td>
</tr>



<tr style="height:50px;">
<td colspan="3" class="text-right">
  <input form="appraisal_rating_edit_<?php echo $question_id;?>" name="question_id" type="hidden" value="<?php echo $question_id;?>">
  <input form="appraisal_rating_edit_<?php echo $question_id;?>" name="uid" type="hidden" value="<?php echo $_REQUEST['uid'];?>">
<button form="appraisal_rating_edit_<?php echo $question_id;?>" type="submit" class="btn btn-primary" name="button" value="save" <?php echo ${'disabled_'.$question_id};?>>Save</button>
  </td>
</tr>

</table>
<br>
</div>




<?php $question_id=8; ?>

<div class="col-sm-12">
<table width="100%" border="1" cellspacing="2" cellpadding="5">


<tr style="min-height:40px;">
  <td class="text-center" style="color:#f00;min-height:40px;">
  <br>
  Please fill up all the above field and press the below button to HR review.<br><br>
Note: if you press the below button then you will not able to back
<br><br>
</td>
</tr>


<tr style="height:50px;">
<td colspan="3" class="text-center">
  <input form="appraisal_rating_edit_<?php echo $question_id;?>" name="question_id" type="hidden" value="<?php echo $question_id;?>">
  <input form="appraisal_rating_edit_<?php echo $question_id;?>" name="uid" type="hidden" value="<?php echo $_REQUEST['uid'];?>">
<button form="appraisal_rating_edit_<?php echo $question_id;?>" type="submit" class="btn btn-primary" name="button" value="save" <?php echo ${'disabled_'.$question_id};?>>HR Review Submit</button>
  </td>
</tr>

</table>
<br>
</div>




</div>




	</div>
	</div>
	</div>
		

	<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
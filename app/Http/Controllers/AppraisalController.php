<?php

namespace App\Http\Controllers;
use App\Classes\Objectclass;
use Auth;
use App\Template;


class AppraisalController extends Controller{
    use BasicController;

    var $obj;

    public function __construct()
   {
    
    $base_dir='';
    $db_data=include('../config/db.php');
    $hostname=$db_data['hostname'];
    $database=$db_data['database'];
    $username=$db_data['username'];
    $password=$db_data['password'];
    
    if(isset($db_data['basedir'])){$base_dir=$db_data['basedir'];}
    

    if (isset($_SERVER['REQUEST_SCHEME']) and $_SERVER['REQUEST_SCHEME']=='https')
	{$uri = 'https://';}
	else{$uri = 'http://';}
    $baseurl=$uri.$_SERVER['HTTP_HOST'].$base_dir;
	$key="sdwerokiqw7634875283746";
	
	$this->obj=new Objectclass();
    $this->obj->dataset($hostname,$database,$username,$password,$baseurl,$key);

    }

    public function index(){
    return view('appraisal.index',compact(''));

    }

    public function appraisal_user(){
        
        $this->obj->db_connect();
        $url=$this->obj->baseurl;
        $user =Auth::user();
        $user_id=$user->id;

        $column="*";
        $table="designations";
        $where="";
        $sort_by="id";
        $sort="ASC";
        $limit="";
        $start="";

        $designation_array=[];

        $designation_list=$this->obj->data_get($column,$table,$where,$sort_by,$sort,$limit,$start);
        for($i=0;$i<count($designation_list);$i++)
        {
            $designation_id=$designation_list[$i]['id'];
            $designation_name=$designation_list[$i]['name'];
            $designation_array[$designation_id]=$designation_name;

        }

        $column="*";
        $table="appraisal";
        $where="user_id='$user_id'";
        $sort_by="time_period";
        $sort="DESC";
        $limit="";
        $start="";
        $appraisal_list_array=[];

        $appraisal_list_data=$this->obj->data_get($column,$table,$where,$sort_by,$sort,$limit,$start);

        for($i=0;$i<count($appraisal_list_data);$i++)
        {
            $id=$appraisal_list_data[$i]['id'];
            $uid=$appraisal_list_data[$i]['uid'];
            $emp_id=$appraisal_list_data[$i]['user_id'];
            $sup_id=$appraisal_list_data[$i]['supervisor_id'];
            $sup_user_id=$appraisal_list_data[$i]['supervisor_user_id'];
            $time_period=$appraisal_list_data[$i]['time_period'];
            $user_approve=$appraisal_list_data[$i]['user_approve'];
            $sup_approve=$appraisal_list_data[$i]['supervisor_approve'];
            $hr_approve=$appraisal_list_data[$i]['hr_approve'];
            $status=$appraisal_list_data[$i]['status'];
            $date=$appraisal_list_data[$i]['date'];
            $time=$appraisal_list_data[$i]['time'];

            $sort_by="";
            $sort="";
            $table="users";
            $where="id='$emp_id'";
            $emp_data=$this->obj->data_get($column,$table,$where,$sort_by,$sort,$limit,$start);

            $where="id='$sup_user_id'";
            $sup_data=$this->obj->data_get($column,$table,$where,$sort_by,$sort,$limit,$start);

            $emp_username=$emp_data[0]['username'];
            $emp_first_name=$emp_data[0]['first_name'];
            $emp_last_name=$emp_data[0]['last_name'];
            $emp_designation=$designation_array[$emp_data[0]['designation_id']];

            $sup_username=$sup_data[0]['username'];
            $sup_first_name=$sup_data[0]['first_name'];
            $sup_last_name=$sup_data[0]['last_name'];
            $sup_designation=$designation_array[$sup_data[0]['designation_id']];

            $rating='4/5';

            $appraisal_list_array[]=array('id'=>$id,'uid'=>$uid,'emp_id'=>$emp_id,'emp_username'=>$emp_username,'emp_first_name'=>$emp_first_name,'emp_last_name'=>$emp_last_name,'emp_designation'=>$emp_designation,'sup_id'=>$sup_id,'sup_user_id'=>$sup_user_id,'sup_username'=>$sup_username,'sup_first_name'=>$sup_first_name,'sup_last_name'=>$sup_last_name,'sup_designation'=>$sup_designation,'time_period'=>$time_period,'user_approve'=>$user_approve,'sup_approve'=>$sup_approve,'hr_approve'=>$hr_approve,'status'=>$status,'rating'=>$rating,'date'=>$date,'time'=>$time);
            

            
        }



        $this->obj->db_close();

       return view('appraisal.appraisal_user')->with(['appraisal_list_array'=>$appraisal_list_array]);
       
    }


    public function appraisal_user_edit(){

        $this->obj->db_connect();
        $url=$this->obj->baseurl;
        $user =Auth::user();
        $user_id=$user->id;
        $uid='';

        if(isset($_REQUEST['uid']) and $_REQUEST['uid']!=''){$uid=$_REQUEST['uid'];}

        $column="*";
        $table="designations";
        $where="";
        $sort_by="id";
        $sort="ASC";
        $limit="";
        $start="";

        $designation_array=[];

        $designation_list=$this->obj->data_get($column,$table,$where,$sort_by,$sort,$limit,$start);
        for($i=0;$i<count($designation_list);$i++)
        {
            $designation_id=$designation_list[$i]['id'];
            $designation_name=$designation_list[$i]['name'];
            $designation_array[$designation_id]=$designation_name;

        }

        $column="*";
        $table="appraisal";
        $where="uid='$uid' and user_id='$user_id'";
        $sort_by="";
        $sort="";
        $limit="";
        $start="";
        $appraisal_array=[];

        $appraisal_list_data=$this->obj->data_get($column,$table,$where,$sort_by,$sort,$limit,$start);

        for($i=0;$i<count($appraisal_list_data);$i++)
        {
            $id=$appraisal_list_data[$i]['id'];
            $uid=$appraisal_list_data[$i]['uid'];
            $emp_id=$appraisal_list_data[$i]['user_id'];
            $sup_id=$appraisal_list_data[$i]['supervisor_id'];
            $sup_user_id=$appraisal_list_data[$i]['supervisor_user_id'];
            $time_period=$appraisal_list_data[$i]['time_period'];

            $objective=$appraisal_list_data[$i]['objective'];
            $expected_result=$appraisal_list_data[$i]['expected_result'];

            $user_approve=$appraisal_list_data[$i]['user_approve'];
            $sup_approve=$appraisal_list_data[$i]['supervisor_approve'];
            $hr_approve=$appraisal_list_data[$i]['hr_approve'];
            $hr_review_comment=$appraisal_list_data[$i]['hr_review_comment'];
            $status=$appraisal_list_data[$i]['status'];
            $date=$appraisal_list_data[$i]['date'];
            $time=$appraisal_list_data[$i]['time'];

            $answer_1=$appraisal_list_data[$i]['user_answer_1'];
            $answer_2=$appraisal_list_data[$i]['user_answer_2'];
            $answer_3=$appraisal_list_data[$i]['user_answer_3'];
            $answer_4=$appraisal_list_data[$i]['user_answer_4'];
            $answer_5=$appraisal_list_data[$i]['user_answer_5'];
            $answer_6=$appraisal_list_data[$i]['user_answer_6'];
            $answer_7=$appraisal_list_data[$i]['user_answer_7'];
            $answer_8=$appraisal_list_data[$i]['user_answer_8'];
            $answer_9=$appraisal_list_data[$i]['user_answer_9'];
            $answer_10=$appraisal_list_data[$i]['user_answer_10'];
            $answer_11=$appraisal_list_data[$i]['user_answer_11'];
            $answer_12=$appraisal_list_data[$i]['user_answer_12'];
            $answer_13=$appraisal_list_data[$i]['user_answer_13'];
            $answer_14=$appraisal_list_data[$i]['user_answer_14'];
            $answer_15=$appraisal_list_data[$i]['user_answer_15'];
            $answer_16=$appraisal_list_data[$i]['user_answer_16'];
            $answer_17=$appraisal_list_data[$i]['user_answer_17'];
            $answer_18=$appraisal_list_data[$i]['user_answer_18'];
            $answer_19=$appraisal_list_data[$i]['user_answer_19'];
            $answer_20=$appraisal_list_data[$i]['user_answer_20'];

            $table="users";
            $where="id='$emp_id'";
            $emp_data=$this->obj->data_get($column,$table,$where,$sort_by,$sort,$limit,$start);

            $emp_username=$emp_data[0]['username'];
            $emp_first_name=$emp_data[0]['first_name'];
            $emp_last_name=$emp_data[0]['last_name'];
            $emp_designation=$designation_array[$emp_data[0]['designation_id']];

            

            
            $emp_base='';
            $emp_sub_base='';
            $emp_review_date='';

            $where="id='$sup_user_id'";
            $sup_data=$this->obj->data_get($column,$table,$where,$sort_by,$sort,$limit,$start);

            $sup_username=$sup_data[0]['username'];
            $sup_first_name=$sup_data[0]['first_name'];
            $sup_last_name=$sup_data[0]['last_name'];
            $sup_designation=$designation_array[$sup_data[0]['designation_id']];

            $table="profile";
            $where="user_id='$emp_id'";
            $profile_data=$this->obj->data_get($column,$table,$where,$sort_by,$sort,$limit,$start);

            $emp_joining_date=$profile_data[0]['date_of_joining'];

            $table="role_user";
            $where="user_id='$emp_id'";
            $payroll_id_data=$this->obj->data_get($column,$table,$where,$sort_by,$sort,$limit,$start);
            
            $payroll_id=$payroll_id_data[0]['role_id'];

            $table="roles";
            $where="id='$payroll_id'";
            $payloll_data=$this->obj->data_get($column,$table,$where,$sort_by,$sort,$limit,$start);
            $emp_department=$payloll_data[0]['name'];

            $rating='4/5';

            

            $appraisal_array[]=array('id'=>$id,'uid'=>$uid,'emp_id'=>$emp_id,'emp_username'=>$emp_username,'emp_first_name'=>$emp_first_name,'emp_last_name'=>$emp_last_name,'emp_designation'=>$emp_designation,'emp_department'=>$emp_department,'emp_joining_date'=>$emp_joining_date,'emp_base'=>$emp_base,'emp_sub_base'=>$emp_sub_base,'emp_review_date'=>$emp_review_date,'sup_id'=>$sup_id,'sup_user_id'=>$sup_user_id,'sup_username'=>$sup_username,'sup_first_name'=>$sup_first_name,'sup_last_name'=>$sup_last_name,'sup_designation'=>$sup_designation,'time_period'=>$time_period,'objective'=>$objective,'expected_result'=>$expected_result,'user_approve'=>$user_approve,'sup_approve'=>$sup_approve,'hr_approve'=>$hr_approve,'hr_review_comment'=>$hr_review_comment,'answer_1'=>$answer_1,'answer_2'=>$answer_2,'answer_3'=>$answer_3,'answer_4'=>$answer_4,'answer_5'=>$answer_5,'answer_6'=>$answer_6,'answer_7'=>$answer_7,'answer_8'=>$answer_8,'answer_9'=>$answer_9,'answer_10'=>$answer_10,'answer_11'=>$answer_11,'answer_12'=>$answer_12,'answer_13'=>$answer_13,'answer_14'=>$answer_14,'answer_15'=>$answer_15,'answer_16'=>$answer_16,'answer_17'=>$answer_17,'answer_18'=>$answer_18,'answer_19'=>$answer_19,'answer_20'=>$answer_20,'status'=>$status,'rating'=>$rating,'date'=>$date,'time'=>$time);
            

            
        }

        $column="*";
        $table="appraisal_task";
        $where="appraisal_uid='$uid'";
        $sort_by="id";
        $sort="ASC";
        $limit="";
        $start="";
        $appraisal_task_array=[];

        $appraisal_task_data=$this->obj->data_get($column,$table,$where,$sort_by,$sort,$limit,$start);

        for($i=0;$i<count($appraisal_task_data);$i++)
        {
            $id=$appraisal_task_data[$i]['id'];
            $uid=$appraisal_task_data[$i]['uid'];
            $task=$appraisal_task_data[$i]['task_name'];
            $deadline=$appraisal_task_data[$i]['end_date'];
            $priority=$appraisal_task_data[$i]['priority'];

            $appraisal_task_array[]=array('id'=>$id,'uid'=>$uid,'task'=>$task,'deadline'=>$deadline,'priority'=>$priority);



        }

        return view('appraisal.appraisal_user_edit')->with(['appraisal_array'=>$appraisal_array,'appraisal_task_array'=>$appraisal_task_array]);
    }


    public function appraisal_user_view(){


        return view('appraisal.appraisal_user_view')->with(['appraisal_list_array'=>$appraisal_list_array]);
    }




    public function appraisal_user_edit_save(){

        $this->obj->db_connect();
        $url=$this->obj->baseurl;
        $user =Auth::user();
        $user_id=$user->id;

        $status=0;
        $success_message='';

        $uid='';
        $action=0;
        $request_method=$_SERVER['REQUEST_METHOD'];

        $answer_1=0;
        $answer_2=0;
        $answer_3=0;
        $answer_4=0;
        $answer_5=0;

        $answer_6='';$answer_7='';$answer_8='';$answer_9=''; $answer_10=''; 
        $answer_11=''; $answer_12=''; $answer_13='';$answer_14='';$answer_15='';
        $answer_16='';$answer_17='';$answer_18=''; $answer_19='';$answer_20='';

        if(isset($_REQUEST['uid']) and $_REQUEST['uid']!=''){$uid=$_REQUEST['uid'];}
        if(isset($_REQUEST['ac']) and $_REQUEST['ac']!=''){$action=$_REQUEST['ac'];}

        if(isset($_REQUEST['answer_1']) and $_REQUEST['answer_1']!=''){$answer_1=$_REQUEST['answer_1'];}
        if(isset($_REQUEST['answer_2']) and $_REQUEST['answer_2']!=''){$answer_2=$_REQUEST['answer_2'];}
        if(isset($_REQUEST['answer_3']) and $_REQUEST['answer_3']!=''){$answer_3=$_REQUEST['answer_3'];}
        if(isset($_REQUEST['answer_4']) and $_REQUEST['answer_4']!=''){$answer_4=$_REQUEST['answer_4'];}
        if(isset($_REQUEST['answer_5']) and $_REQUEST['answer_5']!=''){$answer_5=$_REQUEST['answer_5'];}
        if(isset($_REQUEST['answer_6']) and $_REQUEST['answer_6']!=''){$answer_6=$_REQUEST['answer_6'];}
        if(isset($_REQUEST['answer_7']) and $_REQUEST['answer_7']!=''){$answer_7=$_REQUEST['answer_7'];}
        if(isset($_REQUEST['answer_8']) and $_REQUEST['answer_8']!=''){$answer_8=$_REQUEST['answer_8'];}
        if(isset($_REQUEST['answer_9']) and $_REQUEST['answer_9']!=''){$answer_9=$_REQUEST['answer_9'];}
        if(isset($_REQUEST['answer_10']) and $_REQUEST['answer_10']!=''){$answer_10=$_REQUEST['answer_10'];}
        if(isset($_REQUEST['answer_11']) and $_REQUEST['answer_11']!=''){$answer_11=$_REQUEST['answer_11'];}
        if(isset($_REQUEST['answer_12']) and $_REQUEST['answer_12']!=''){$answer_12=$_REQUEST['answer_12'];}
        if(isset($_REQUEST['answer_13']) and $_REQUEST['answer_13']!=''){$answer_13=$_REQUEST['answer_13'];}
        if(isset($_REQUEST['answer_14']) and $_REQUEST['answer_14']!=''){$answer_14=$_REQUEST['answer_14'];}
        if(isset($_REQUEST['answer_15']) and $_REQUEST['answer_15']!=''){$answer_15=$_REQUEST['answer_15'];}
        if(isset($_REQUEST['answer_16']) and $_REQUEST['answer_16']!=''){$answer_16=$_REQUEST['answer_16'];}
        if(isset($_REQUEST['answer_17']) and $_REQUEST['answer_17']!=''){$answer_17=$_REQUEST['answer_17'];}
        if(isset($_REQUEST['answer_18']) and $_REQUEST['answer_18']!=''){$answer_18=$_REQUEST['answer_18'];}
        if(isset($_REQUEST['answer_19']) and $_REQUEST['answer_19']!=''){$answer_19=$_REQUEST['answer_19'];}
        if(isset($_REQUEST['answer_20']) and $_REQUEST['answer_20']!=''){$answer_20=$_REQUEST['answer_20'];}

        if($request_method=='POST' and $uid!='' and $action==1)
        {

            $check=$this->obj->data_get_num('*','appraisal',"uid='$uid' and user_id='$user_id' and user_approve=0");
            if($check==1)
            {
            $table='appraisal';
            $where="user_id='$user_id' and uid='$uid'";
            $values=array(
                'user_answer_1'=>$answer_1,
                'user_answer_2'=>$answer_2,
                'user_answer_3'=>$answer_3,
                'user_answer_4'=>$answer_4,
                'user_answer_5'=>$answer_5,
                'user_approve'=>1,
                'user_approve_date'=>date('Y-m-d'),
                'user_approve_time'=>date('h:i:s a')
            );

            if($this->obj->data_update($table,$values,$where)==1)
            {
                $status=1;
                $success_message='Submited successfully';
            }
            else
            {$success_message='Error, Try again';}
            }
            else
            {$success_message='You can\'t update this information';}
        }

        if($request_method=='POST' and $uid!='' and $action==2)
        {

            $check=$this->obj->data_get_num('*','appraisal',"uid='$uid' and user_id='$user_id' and user_approve=1 and supervisor_approve=0");
            if($check==1)
            {
            $table='appraisal';
            $where="user_id='$user_id' and uid='$uid'";
            $values=array(
                'user_answer_6'=>$answer_6,
                'user_answer_7'=>$answer_7,
                'user_answer_8'=>$answer_8,
                'user_answer_9'=>$answer_9,
                'user_answer_10'=>$answer_10,
                'user_answer_11'=>$answer_11,
                'user_answer_12'=>$answer_12,
                'user_answer_13'=>$answer_13,
                'user_answer_14'=>$answer_14,
                'user_answer_15'=>$answer_15,
                'user_answer_16'=>$answer_16,
                'user_answer_17'=>$answer_17,
                'user_answer_18'=>$answer_18,
                'user_answer_19'=>$answer_19,
                'user_answer_20'=>$answer_20
            );

            if($this->obj->data_update($table,$values,$where)==1)
            {
                $status=1;
                $success_message='Submited successfully';
            }
            else
            {$success_message='Error, Try again';}
            }
            else
            {$success_message='You can\'t update this information';}
        }
       

        if($status==1)
        {$response = ['message' => $success_message, 'status' => 'success']; }
        else
        {$response = ['message' => $success_message, 'status' => 'error']; }
        
        return response()->json($response, 200, array('Access-Controll-Allow-Origin' => '*'));
        return redirect()->back()->withSuccess($success_message);


    }

    public function appraisal_rating(){
        
        $this->obj->db_connect();
        $url=$this->obj->baseurl;
        $user =Auth::user();
        $user_id=$user->id;

        $column="*";
        $table="designations";
        $where="";
        $sort_by="id";
        $sort="ASC";
        $limit="";
        $start="";

        $designation_array=[];

        $designation_list=$this->obj->data_get($column,$table,$where,$sort_by,$sort,$limit,$start);
        for($i=0;$i<count($designation_list);$i++)
        {
            $designation_id=$designation_list[$i]['id'];
            $designation_name=$designation_list[$i]['name'];
            $designation_array[$designation_id]=$designation_name;

        }

        $column="*";
        $table="appraisal";
        $where="supervisor_user_id='$user_id'";
        $sort_by="time_period";
        $sort="DESC";
        $limit="";
        $start="";
        $appraisal_list_array=[];

        $appraisal_list_data=$this->obj->data_get($column,$table,$where,$sort_by,$sort,$limit,$start);

        for($i=0;$i<count($appraisal_list_data);$i++)
        {
            $id=$appraisal_list_data[$i]['id'];
            $uid=$appraisal_list_data[$i]['uid'];
            $emp_id=$appraisal_list_data[$i]['user_id'];
            $sup_id=$appraisal_list_data[$i]['supervisor_id'];
            $sup_user_id=$appraisal_list_data[$i]['supervisor_user_id'];
            $time_period=$appraisal_list_data[$i]['time_period'];
            $user_approve=$appraisal_list_data[$i]['user_approve'];
            $sup_approve=$appraisal_list_data[$i]['supervisor_approve'];
            $hr_approve=$appraisal_list_data[$i]['hr_approve'];
            $status=$appraisal_list_data[$i]['status'];
            $date=$appraisal_list_data[$i]['date'];
            $time=$appraisal_list_data[$i]['time'];

            $sort_by="";
            $sort="";
            $table="users";
            $where="id='$emp_id'";
            $emp_data=$this->obj->data_get($column,$table,$where,$sort_by,$sort,$limit,$start);

            $where="id='$sup_user_id'";
            $sup_data=$this->obj->data_get($column,$table,$where,$sort_by,$sort,$limit,$start);

            $emp_username=$emp_data[0]['username'];
            $emp_first_name=$emp_data[0]['first_name'];
            $emp_last_name=$emp_data[0]['last_name'];
            $emp_designation=$designation_array[$emp_data[0]['designation_id']];

            $sup_username=$sup_data[0]['username'];
            $sup_first_name=$sup_data[0]['first_name'];
            $sup_last_name=$sup_data[0]['last_name'];
            $sup_designation=$designation_array[$sup_data[0]['designation_id']];

            $rating='4/5';

            $appraisal_list_array[]=array('id'=>$id,'uid'=>$uid,'emp_id'=>$emp_id,'emp_username'=>$emp_username,'emp_first_name'=>$emp_first_name,'emp_last_name'=>$emp_last_name,'emp_designation'=>$emp_designation,'sup_id'=>$sup_id,'sup_user_id'=>$sup_user_id,'sup_username'=>$sup_username,'sup_first_name'=>$sup_first_name,'sup_last_name'=>$sup_last_name,'sup_designation'=>$sup_designation,'time_period'=>$time_period,'user_approve'=>$user_approve,'sup_approve'=>$sup_approve,'hr_approve'=>$hr_approve,'status'=>$status,'rating'=>$rating,'date'=>$date,'time'=>$time);
            

            
        }



        $this->obj->db_close();

       return view('appraisal_rating.appraisal_rating')->with(['appraisal_list_array'=>$appraisal_list_array]);
       
    }



     public function appraisal_rating_edit(){
        
        $this->obj->db_connect();
        $url=$this->obj->baseurl;
        $user =Auth::user();
        $user_id=$user->id;
        $uid='';
        

        if(isset($_REQUEST['uid']) and $_REQUEST['uid']!=''){$uid=$_REQUEST['uid'];}

        $apr_uid=$uid;

        $column="*";
        $table="designations";
        $where="";
        $sort_by="id";
        $sort="ASC";
        $limit="";
        $start="";

        $designation_array=[];

        $designation_list=$this->obj->data_get($column,$table,$where,$sort_by,$sort,$limit,$start);
        for($i=0;$i<count($designation_list);$i++)
        {
            $designation_id=$designation_list[$i]['id'];
            $designation_name=$designation_list[$i]['name'];
            $designation_array[$designation_id]=$designation_name;

        }

        $column="*";
        $table="appraisal";
        $where="uid='$uid' and supervisor_user_id='$user_id'";
        $sort_by="";
        $sort="";
        $limit="";
        $start="";
        $appraisal_array=[];

        $appraisal_list_data=$this->obj->data_get($column,$table,$where,$sort_by,$sort,$limit,$start);

        for($i=0;$i<count($appraisal_list_data);$i++)
        {
            $id=$appraisal_list_data[$i]['id'];
            $uid=$appraisal_list_data[$i]['uid'];
            $emp_id=$appraisal_list_data[$i]['user_id'];
            $sup_id=$appraisal_list_data[$i]['supervisor_id'];
            $sup_user_id=$appraisal_list_data[$i]['supervisor_user_id'];
            $time_period=$appraisal_list_data[$i]['time_period'];

            $objective=$appraisal_list_data[$i]['objective'];
            $expected_result=$appraisal_list_data[$i]['expected_result'];

            $user_approve=$appraisal_list_data[$i]['user_approve'];
            $sup_approve=$appraisal_list_data[$i]['supervisor_approve'];
            $hr_approve=$appraisal_list_data[$i]['hr_approve'];
            $hr_review_comment=$appraisal_list_data[$i]['hr_review_comment'];
            $status=$appraisal_list_data[$i]['status'];
            $date=$appraisal_list_data[$i]['date'];
            $time=$appraisal_list_data[$i]['time'];

            $answer_1=$appraisal_list_data[$i]['user_answer_1'];
            $answer_2=$appraisal_list_data[$i]['user_answer_2'];
            $answer_3=$appraisal_list_data[$i]['user_answer_3'];
            $answer_4=$appraisal_list_data[$i]['user_answer_4'];
            $answer_5=$appraisal_list_data[$i]['user_answer_5'];
            $answer_6=$appraisal_list_data[$i]['user_answer_6'];
            $answer_7=$appraisal_list_data[$i]['user_answer_7'];
            $answer_8=$appraisal_list_data[$i]['user_answer_8'];
            $answer_9=$appraisal_list_data[$i]['user_answer_9'];
            $answer_10=$appraisal_list_data[$i]['user_answer_10'];
            $answer_11=$appraisal_list_data[$i]['user_answer_11'];
            $answer_12=$appraisal_list_data[$i]['user_answer_12'];
            $answer_13=$appraisal_list_data[$i]['user_answer_13'];
            $answer_14=$appraisal_list_data[$i]['user_answer_14'];
            $answer_15=$appraisal_list_data[$i]['user_answer_15'];
            $answer_16=$appraisal_list_data[$i]['user_answer_16'];
            $answer_17=$appraisal_list_data[$i]['user_answer_17'];
            $answer_18=$appraisal_list_data[$i]['user_answer_18'];
            $answer_19=$appraisal_list_data[$i]['user_answer_19'];
            $answer_20=$appraisal_list_data[$i]['user_answer_20'];

            $table="users";
            $where="id='$emp_id'";
            $emp_data=$this->obj->data_get($column,$table,$where,$sort_by,$sort,$limit,$start);

            $emp_username=$emp_data[0]['username'];
            $emp_first_name=$emp_data[0]['first_name'];
            $emp_last_name=$emp_data[0]['last_name'];
            $emp_designation=$designation_array[$emp_data[0]['designation_id']];

            

            
            $emp_base='';
            $emp_sub_base='';
            $emp_review_date='';

            $where="id='$sup_user_id'";
            $sup_data=$this->obj->data_get($column,$table,$where,$sort_by,$sort,$limit,$start);

            $sup_username=$sup_data[0]['username'];
            $sup_first_name=$sup_data[0]['first_name'];
            $sup_last_name=$sup_data[0]['last_name'];
            $sup_designation=$designation_array[$sup_data[0]['designation_id']];

            $table="profile";
            $where="user_id='$emp_id'";
            $profile_data=$this->obj->data_get($column,$table,$where,$sort_by,$sort,$limit,$start);

            $emp_joining_date=$profile_data[0]['date_of_joining'];

            $table="role_user";
            $where="user_id='$emp_id'";
            $payroll_id_data=$this->obj->data_get($column,$table,$where,$sort_by,$sort,$limit,$start);
            
            $payroll_id=$payroll_id_data[0]['role_id'];

            $table="roles";
            $where="id='$payroll_id'";
            $payloll_data=$this->obj->data_get($column,$table,$where,$sort_by,$sort,$limit,$start);
            $emp_department=$payloll_data[0]['name'];

            $rating='4/5';

            

            $appraisal_array[]=array('id'=>$id,'uid'=>$uid,'emp_id'=>$emp_id,'emp_username'=>$emp_username,'emp_first_name'=>$emp_first_name,'emp_last_name'=>$emp_last_name,'emp_designation'=>$emp_designation,'emp_department'=>$emp_department,'emp_joining_date'=>$emp_joining_date,'emp_base'=>$emp_base,'emp_sub_base'=>$emp_sub_base,'emp_review_date'=>$emp_review_date,'sup_id'=>$sup_id,'sup_user_id'=>$sup_user_id,'sup_username'=>$sup_username,'sup_first_name'=>$sup_first_name,'sup_last_name'=>$sup_last_name,'sup_designation'=>$sup_designation,'time_period'=>$time_period,'objective'=>$objective,'expected_result'=>$expected_result,'user_approve'=>$user_approve,'sup_approve'=>$sup_approve,'hr_approve'=>$hr_approve,'hr_review_comment'=>$hr_review_comment,'answer_1'=>$answer_1,'answer_2'=>$answer_2,'answer_3'=>$answer_3,'answer_4'=>$answer_4,'answer_5'=>$answer_5,'answer_6'=>$answer_6,'answer_7'=>$answer_7,'answer_8'=>$answer_8,'answer_9'=>$answer_9,'answer_10'=>$answer_10,'answer_11'=>$answer_11,'answer_12'=>$answer_12,'answer_13'=>$answer_13,'answer_14'=>$answer_14,'answer_15'=>$answer_15,'answer_16'=>$answer_16,'answer_17'=>$answer_17,'answer_18'=>$answer_18,'answer_19'=>$answer_19,'answer_20'=>$answer_20,'status'=>$status,'rating'=>$rating,'date'=>$date,'time'=>$time);
            

            
        }

        $column="*";
        $table="appraisal_task";
        $where="appraisal_uid='$uid'";
        $sort_by="id";
        $sort="ASC";
        $limit="";
        $start="";
        $appraisal_task_array=[];

        $appraisal_task_data=$this->obj->data_get($column,$table,$where,$sort_by,$sort,$limit,$start);

        for($i=0;$i<count($appraisal_task_data);$i++)
        {
            $id=$appraisal_task_data[$i]['id'];
            $uid=$appraisal_task_data[$i]['uid'];
            $task=$appraisal_task_data[$i]['task_name'];
            $deadline=$appraisal_task_data[$i]['end_date'];
            $priority=$appraisal_task_data[$i]['priority'];
            $rating=$appraisal_task_data[$i]['rating'];

            $appraisal_task_array[]=array('id'=>$id,'uid'=>$uid,'task'=>$task,'deadline'=>$deadline,'priority'=>$priority,'rating'=>$rating);



        }

        
        $column="*";
        $table="appraisal_comment";
        $sort_by="";
        $sort="";
        $limit="";
        $start="";

        for($i=1;$i<=7;$i++)
        {

            $where="appraisal_uid='$apr_uid' and supervisor_user_id='$user_id' and question_id='$i'";
            $appraisal_comment_data=$this->obj->data_get($column,$table,$where,$sort_by,$sort,$limit,$start);
            ${'comment_array_'.$i}=[];
            for($j=0;$j<count($appraisal_comment_data);$j++)
            {
                $id=$appraisal_comment_data[$j]['id'];
                $uid=$appraisal_comment_data[$j]['uid'];
                $title=$appraisal_comment_data[$j]['title'];
                $comment=$appraisal_comment_data[$j]['comment'];
                $rating=$appraisal_comment_data[$j]['rating'];

                ${'comment_array_'.$i}[]=array('id'=>$id,'uid'=>$uid,'title'=>$title,'comment'=>$comment,'rating'=>$rating);
            }
            
        }



        return view('appraisal_rating.appraisal_rating_edit')->with(['appraisal_array'=>$appraisal_array,'appraisal_task_array'=>$appraisal_task_array,'comment_array_1'=>$comment_array_1,'comment_array_2'=>$comment_array_2,'comment_array_3'=>$comment_array_3,'comment_array_4'=>$comment_array_4,'comment_array_5'=>$comment_array_5,'comment_array_6'=>$comment_array_6,'comment_array_7'=>$comment_array_7]);
         
        
     }





     public function appraisal_rating_edit_save(){
        
        $this->obj->db_connect();
        $url=$this->obj->baseurl;
        $user =Auth::user();
        $user_id=$user->id;
        $uid='';
        $qid='';
        $status=0;
        $success_message='';
        

        if(isset($_REQUEST['uid']) and $_REQUEST['uid']!=''){$uid=$_REQUEST['uid'];}
        if(isset($_REQUEST['question_id']) and $_REQUEST['question_id']!=''){$qid=$_REQUEST['question_id'];}

        if($qid==0)
        {
            $rating='';
            $rating_uid='';

            if(isset($_REQUEST['rating']) and $_REQUEST['rating']!=''){$rating=$_REQUEST['rating'];}
            if(isset($_REQUEST['rating_uid']) and $_REQUEST['rating_uid']!=''){$rating_uid=$_REQUEST['rating_uid'];}

            $table='appraisal_task';
            
            for($i=0;$i<count($rating_uid);$i++)
            {
                $rate_uid=$rating_uid[$i];
                $task_rat=$rating[$i];

                $where="uid='$rate_uid' and appraisal_uid='$uid'";

                $values=array('rating'=>$task_rat);

                $this->obj->data_update($table,$values,$where);

            }
            $status=1;
            $success_message='Saved Successfully';

        }
        else if($qid!='' and $qid<8 and $qid>0)
        {
            $title='';
            $comment='';
            $rating='';

            if(isset($_REQUEST['comment_title']) and $_REQUEST['comment_title']!=''){$title=$_REQUEST['comment_title'];}
            if(isset($_REQUEST['comment']) and $_REQUEST['comment']!=''){$comment=$_REQUEST['comment'];}
            if(isset($_REQUEST['comment_rating']) and $_REQUEST['comment_rating']!=''){$rating=$_REQUEST['comment_rating'];}




            $table='appraisal_comment';
            $where="appraisal_uid='$uid' and question_id='$qid'";
            $this->obj->data_delete($table,$where);

            for($i=0;$i<12;$i++)
            {
                $set_title='';
                $set_comment='';
                $set_rating='';
                $quid=$i+1;

                if(isset($title[$i])){$set_title=$title[$i];}
                if(isset($comment[$i]) ){$set_comment=$comment[$i];}
                if(isset($rating[$i])){$set_rating=$rating[$i];}


                $values=array(
                    'uid'=>uniqid(),
                    'appraisal_uid'=>$uid,
                    'supervisor_user_id'=>$user_id,
                    'question_id'=>$qid,
                    'question_sn'=>$quid,
                    'title'=>$set_title,
                    'comment'=>$set_comment,
                    'rating'=>$set_rating,
                    'rating_by_id'=>$user_id,
                    'date'=>date('Y-m-d'),
                    'time'=>date('h:i:s a')
                );

                $this->obj->data_put($table,$values);
            }


            $status=1;
            $success_message='Saved Successfully';

        }
        else if($qid==8)
        {
            $table='appraisal';
            $where="uid='$uid'";
            $values=array('supervisor_approve'=>1);
            $this->obj->data_update($table,$values,$where);

            $status=1;
            $success_message='Submited Successfully';

        }
        

        if($status==1)
        {$response = ['message' => $success_message, 'status' => 'success']; }
        else
        {$response = ['message' => $success_message, 'status' => 'error']; }
        
        return response()->json($response, 200, array('Access-Controll-Allow-Origin' => '*'));
        return redirect()->back()->withSuccess($success_message);

     }



    public function appraisal_rating_view(){
   
        $this->obj->db_connect();
        $url=$this->obj->baseurl;
        $user =Auth::user();
        $user_id=$user->id;
        $uid='';

        if(isset($_REQUEST['uid']) and $_REQUEST['uid']!=''){$uid=$_REQUEST['uid'];}

        $column="*";
        $table="designations";
        $where="";
        $sort_by="id";
        $sort="ASC";
        $limit="";
        $start="";

        $designation_array=[];

        $designation_list=$this->obj->data_get($column,$table,$where,$sort_by,$sort,$limit,$start);
        for($i=0;$i<count($designation_list);$i++)
        {
            $designation_id=$designation_list[$i]['id'];
            $designation_name=$designation_list[$i]['name'];
            $designation_array[$designation_id]=$designation_name;

        }

        $column="*";
        $table="appraisal";
        $where="uid='$user_id'";
        $sort_by="";
        $sort="";
        $limit="";
        $start="";
        $appraisal_list_array=[];

        $appraisal_list_data=$this->obj->data_get($column,$table,$where,$sort_by,$sort,$limit,$start);

        for($i=0;$i<count($appraisal_list_data);$i++)
        {
            $id=$appraisal_list_data[$i]['id'];
            $uid=$appraisal_list_data[$i]['uid'];
            $emp_id=$appraisal_list_data[$i]['user_id'];
            $sup_id=$appraisal_list_data[$i]['supervisor_id'];
            $sup_user_id=$appraisal_list_data[$i]['supervisor_user_id'];
            $time_period=$appraisal_list_data[$i]['time_period'];
            $user_approve=$appraisal_list_data[$i]['user_approve'];
            $sup_approve=$appraisal_list_data[$i]['supervisor_approve'];
            $hr_approve=$appraisal_list_data[$i]['hr_approve'];
            $hr_review_comment=$appraisal_list_data[$i]['hr_review_comment'];
            $status=$appraisal_list_data[$i]['status'];
            $date=$appraisal_list_data[$i]['date'];
            $time=$appraisal_list_data[$i]['time'];

            $answer_1=$appraisal_list_data[$i]['user_answer_1'];
            $answer_2=$appraisal_list_data[$i]['user_answer_2'];
            $answer_3=$appraisal_list_data[$i]['user_answer_3'];
            $answer_4=$appraisal_list_data[$i]['user_answer_4'];
            $answer_5=$appraisal_list_data[$i]['user_answer_5'];
            $answer_6=$appraisal_list_data[$i]['user_answer_6'];
            $answer_7=$appraisal_list_data[$i]['user_answer_7'];
            $answer_8=$appraisal_list_data[$i]['user_answer_8'];
            $answer_9=$appraisal_list_data[$i]['user_answer_9'];
            $answer_10=$appraisal_list_data[$i]['user_answer_10'];
            $answer_11=$appraisal_list_data[$i]['user_answer_11'];
            $answer_12=$appraisal_list_data[$i]['user_answer_12'];
            $answer_13=$appraisal_list_data[$i]['user_answer_13'];
            $answer_14=$appraisal_list_data[$i]['user_answer_14'];
            $answer_15=$appraisal_list_data[$i]['user_answer_15'];
            $answer_16=$appraisal_list_data[$i]['user_answer_16'];
            $answer_17=$appraisal_list_data[$i]['user_answer_17'];
            $answer_18=$appraisal_list_data[$i]['user_answer_18'];
            $answer_19=$appraisal_list_data[$i]['user_answer_19'];
            $answer_20=$appraisal_list_data[$i]['user_answer_20'];

            $table="users";
            $where="id='$emp_id'";
            $emp_data=$this->obj->data_get($column,$table,$where,$sort_by,$sort,$limit,$start);

            $where="id='$sup_user_id'";
            $sup_data=$this->obj->data_get($column,$table,$where,$sort_by,$sort,$limit,$start);

            $emp_username=$emp_data[0]['username'];
            $emp_first_name=$emp_data[0]['first_name'];
            $emp_last_name=$emp_data[0]['last_name'];
            $emp_designation=$designation_array[$emp_data[0]['designation_id']];

            $sup_username=$sup_data[0]['username'];
            $sup_first_name=$sup_data[0]['first_name'];
            $sup_last_name=$sup_data[0]['last_name'];
            $sup_designation=$designation_array[$sup_data[0]['designation_id']];

            $rating='4/5';


            $appraisal_list_array[]=array('id'=>$id,'uid'=>$uid,'emp_id'=>$emp_id,'emp_username'=>$emp_username,'emp_first_name'=>$emp_first_name,'emp_last_name'=>$emp_last_name,'emp_designation'=>$emp_designation,'sup_id'=>$sup_id,'sup_user_id'=>$sup_user_id,'sup_username'=>$sup_username,'sup_first_name'=>$sup_first_name,'sup_last_name'=>$sup_last_name,'sup_designation'=>$sup_designation,'time_period'=>$time_period,'user_approve'=>$user_approve,'sup_approve'=>$sup_approve,'hr_approve'=>$hr_approve,'hr_review_comment'=>$hr_review_comment,'answer_1'=>$answer_1,'answer_2'=>$answer_2,'answer_3'=>$answer_3,'answer_4'=>$answer_4,'answer_5'=>$answer_5,'answer_6'=>$answer_6,'answer_7'=>$answer_7,'answer_8'=>$answer_8,'answer_9'=>$answer_9,'answer_10'=>$answer_10,'answer_11'=>$answer_11,'answer_12'=>$answer_12,'answer_13'=>$answer_13,'answer_14'=>$answer_14,'answer_15'=>$answer_15,'answer_16'=>$answer_16,'answer_17'=>$answer_17,'answer_18'=>$answer_18,'answer_19'=>$answer_19,'answer_20'=>$answer_20,'status'=>$status,'rating'=>$rating,'date'=>$date,'time'=>$time);
            

            
        }

        $column="*";
        $table="appraisal_task";
        $where="appraisal_uid='$uid'";
        $sort_by="id";
        $sort="ASC";
        $limit="";
        $start="";
        $appraisal_task_array=[];

        $appraisal_task_data=$this->obj->data_get($column,$table,$where,$sort_by,$sort,$limit,$start);

        for($i=0;$i<count($appraisal_task_data);$i++)
        {
            $id=$appraisal_task_data[$i]['id'];
            $uid=$appraisal_task_data[$i]['uid'];
            $task=$appraisal_task_data[$i]['task_name'];
            $deadline=$appraisal_task_data[$i]['end_date'];
            $priority=$appraisal_task_data[$i]['priority'];

            $appraisal_task_array[]=array('id'=>$id,'uid'=>$uid,'task'=>$task,'deadline'=>$deadline,'priority'=>$priority);



        }
        
         
       return view('appraisal_rating.appraisal_rating_view')->with(['user'=>$user_arr]);
       
    }


    public function appraisal_task_add(){
        
         $this->obj->db_connect();
         $url=$this->obj->baseurl;
         $user =Auth::user();
         $user_id=$user->id;
         
        $column="*";
        $table="designations";
        $where="";
        $sort_by="id";
        $sort="ASC";
        $limit="";
        $start="";

        $designation_array=[];

        $designation_list=$this->obj->data_get($column,$table,$where,$sort_by,$sort,$limit,$start);
        for($i=0;$i<count($designation_list);$i++)
        {
            $designation_id=$designation_list[$i]['id'];
            $designation_name=$designation_list[$i]['name'];
            $designation_array[$designation_id]=$designation_name;

        }

         $column="*";
         $table="supervisor";
         $where="user_id='$user_id'";
         $sort_by="";
         $sort="";
         $limit="";
         $start="";
         $supervisor_data=$this->obj->data_get($column,$table,$where,$sort_by,$sort,$limit,$start);

         $supervisor_id=$supervisor_data[0]['id'];
         $supervisor_user_id=$supervisor_data[0]['user_id'];

         $supervisor_data_array=array('supervisor_id'=>$supervisor_id,'supervisor_user_id'=>$supervisor_user_id);

         $table="supervisor_employee";
         $where="supervisor_id='$supervisor_id'";
         $supervisor_employee_array=[];
         $supervisor_employee_data=$this->obj->data_get($column,$table,$where,$sort_by,$sort,$limit,$start);

         for($i=0;$i<count($supervisor_employee_data);$i++)
         {
            $employee_id=$supervisor_employee_data[$i]['user_id'];

            $table="users";
            $where="id='$employee_id'";
            $employee_data_info=$this->obj->data_get($column,$table,$where,$sort_by,$sort,$limit,$start);

            $employee_id=$employee_data_info[0]['id'];
            $employee_username=$employee_data_info[0]['username'];
            $employee_first_name=$employee_data_info[0]['first_name'];
            $employee_last_name=$employee_data_info[0]['last_name'];
            $employee_designation=$designation_array[$employee_data_info[0]['designation_id']];
            
            $supervisor_employee_array[]=array('id'=>$employee_id,'username'=>$employee_username,'first_name'=>$employee_first_name,'last_name'=>$employee_last_name,'designation'=>$employee_designation);



         }

         
         $this->obj->db_close();
         
        return view('appraisal_rating.appraisal_task_add')->with(['supervisor_array'=>$supervisor_data_array,'employee_array'=>$supervisor_employee_array]);
        
     }



     public function appraisal_task_save(){
        
        $this->obj->db_connect();
        $status=0;
        $success_message='';
        $url=$this->obj->baseurl;
        $user =Auth::user();
        $user_id=$user->id;

        $request_method=$_SERVER['REQUEST_METHOD'];
        $button='';
        $time_period='';
        $emp_id='';
        $sup_id='';
        $sup_user_id='';
        $objective='';
        $expected_result='';
        $task='';
        $deadline='';
        $priority='';

        if(isset($_REQUEST['button']) and $_REQUEST['button']!=''){$button=$_REQUEST['button'];}
        if(isset($_REQUEST['time_period']) and $_REQUEST['time_period']!=''){$time_period=$_REQUEST['time_period'];}
        if(isset($_REQUEST['emp_id']) and $_REQUEST['emp_id']!=''){$emp_id=$_REQUEST['emp_id'];}
        if(isset($_REQUEST['sup_id']) and $_REQUEST['sup_id']!=''){$sup_id=$_REQUEST['sup_id'];}
        if(isset($_REQUEST['sup_user_id']) and $_REQUEST['sup_user_id']!=''){$sup_user_id=$_REQUEST['sup_user_id'];}
        if(isset($_REQUEST['objective']) and $_REQUEST['objective']!=''){$objective=$_REQUEST['objective'];}
        if(isset($_REQUEST['expected_result']) and $_REQUEST['expected_result']!=''){$expected_result=$_REQUEST['expected_result'];}
        if(isset($_REQUEST['task']) and $_REQUEST['task']!=''){$task=$_REQUEST['task'];}
        if(isset($_REQUEST['date']) and $_REQUEST['date']!=''){$deadline=$_REQUEST['date'];}
        if(isset($_REQUEST['priority']) and $_REQUEST['priority']!=''){$priority=$_REQUEST['priority'];}

        if($request_method=='POST')
        {
            if($time_period==''){$success_message='The time period is empty';}
            else if($emp_id==''){$success_message='The employee is empty';}
            else if($sup_id==''){$success_message='Supervisor id is empty';}
            else if($sup_user_id==''){$success_message='Supervisor user id is empty';}
            else if($objective==''){$success_message='The objective is empty';}
            else if($expected_result==''){$success_message='The expected result is empty';}
            else
            {
                /* $task_check= $this->obj->data_get_num("*","appraisal","user_id='$emp_id' and supervisor_id='$sup_id' and supervisor_user_id='$user_id' and time_period='$time_period'"); */

                $task_check=0;
                if($task_check==0)
                {
                    $table_1='appraisal';
                    $table_2='appraisal_task';
                    $date=date('Y-m-d');
                    $time=date('h:i:s a');
                    $uid=uniqid();

                    $values_1=array(
                        'uid'=>$uid,
                        'user_id'=>$emp_id,
                        'supervisor_id'=>$sup_id,
                        'supervisor_user_id'=>$sup_user_id,
                        'time_period'=>$time_period,
                        'objective'=>$objective,
                        'expected_result'=>$expected_result,
                        'date'=>$date,
                        'time'=>$time
                        
                    );

                    

                    if($this->obj->data_put($table_1,$values_1)==1)
                    {
                        for($i=0;$i<count($task);$i++)
                        {
                            $values_2=array(
                                'uid'=>uniqid(),
                                'appraisal_uid'=>$uid,
                                'task_name'=>$task[$i],
                                'start_date'=>'',
                                'end_date'=>$deadline[$i],
                                'comment'=>'',
                                'priority'=>$priority[$i],
                                'add_by_id'=>$user_id,
                                'date'=>$date,
                                'time'=>$time
                                
                            );

                            $this->obj->data_put($table_2,$values_2);
                        }

                        $status=1;
                        $success_message='Saved successfully';
                    }
                    else
                    {$success_message='Error, Try again';}
                }
                else
                {$success_message='The task already added for the employ to the time period';}

            }

        }


        
        $this->obj->db_close();
        
        if($status==1)
        {$response = ['message' => $success_message, 'status' => 'success']; }
        else
        {$response = ['message' => $success_message, 'status' => 'error']; }
        
        return response()->json($response, 200, array('Access-Controll-Allow-Origin' => '*'));
        return redirect()->back()->withSuccess($success_message);
       
    }


     public function appraisal_task_edit(){
        
        $this->obj->db_connect();
        $url=$this->obj->baseurl;
        $user =Auth::user();
        $user_id=$user->id;
        $appraisal_uid='';

        if(isset($_REQUEST['uid']) and $_REQUEST['uid']!=''){ $appraisal_uid=$_REQUEST['uid'];}

        $column="*";
        $table="designations";
        $where="";
        $sort_by="id";
        $sort="ASC";
        $limit="";
        $start="";

        $designation_array=[];

        $designation_list=$this->obj->data_get($column,$table,$where,$sort_by,$sort,$limit,$start);
        for($i=0;$i<count($designation_list);$i++)
        {
            $designation_id=$designation_list[$i]['id'];
            $designation_name=$designation_list[$i]['name'];
            $designation_array[$designation_id]=$designation_name;

        }

        $column="*";
        $table="appraisal";
        $where="uid='$appraisal_uid' and supervisor_user_id='$user_id'";
        $sort_by="";
        $sort="";
        $limit="";
        $start="";
        $appraisal_data_array=[];

        $appraisal_data=$this->obj->data_get($column,$table,$where,$sort_by,$sort,$limit,$start);

        for($i=0;$i<count($appraisal_data);$i++)
        {
            $id=$appraisal_data[$i]['id'];
            $uid=$appraisal_data[$i]['uid'];
            $objective=htmlentities($appraisal_data[$i]['objective']);
            $expected_result=htmlentities($appraisal_data[$i]['expected_result']);
            $emp_id=$appraisal_data[$i]['user_id'];
            $sup_id=$appraisal_data[$i]['supervisor_id'];
            $sup_user_id=$appraisal_data[$i]['supervisor_user_id'];
            $time_period=$appraisal_data[$i]['time_period'];
            $user_approve=$appraisal_data[$i]['user_approve'];
            $sup_approve=$appraisal_data[$i]['supervisor_approve'];
            $hr_approve=$appraisal_data[$i]['hr_approve'];
            $status=$appraisal_data[$i]['status'];
            $date=$appraisal_data[$i]['date'];
            $time=$appraisal_data[$i]['time'];

            $table="users";
            $where="id='$emp_id'";
            $emp_data=$this->obj->data_get($column,$table,$where,$sort_by,$sort,$limit,$start);

            $where="id='$sup_user_id'";
            $sup_data=$this->obj->data_get($column,$table,$where,$sort_by,$sort,$limit,$start);

            $emp_username=$emp_data[0]['username'];
            $emp_first_name=$emp_data[0]['first_name'];
            $emp_last_name=$emp_data[0]['last_name'];
            $emp_designation=$designation_array[$emp_data[0]['designation_id']];


            $appraisal_data_array[]=array('id'=>$id,'uid'=>$uid,'objective'=>$objective,'expected_result'=>$expected_result,'emp_id'=>$emp_id,'emp_username'=>$emp_username,'emp_first_name'=>$emp_first_name,'emp_last_name'=>$emp_last_name,'emp_designation'=>$emp_designation,'time_period'=>$time_period,'user_approve'=>$user_approve,'sup_approve'=>$sup_approve,'hr_approve'=>$hr_approve,'status'=>$status,'date'=>$date,'time'=>$time);
              
        }


        $column="*";
        $table="appraisal_task";
        $where="appraisal_uid='$uid'";
        $sort_by="id";
        $sort="ASC";
        $limit="";
        $start="";
        $appraisal_task_array=[];

        $appraisal_task_data=$this->obj->data_get($column,$table,$where,$sort_by,$sort,$limit,$start);

        for($i=0;$i<count($appraisal_task_data);$i++)
        {
            $id=$appraisal_task_data[$i]['id'];
            $uid=$appraisal_task_data[$i]['uid'];
            $task=$appraisal_task_data[$i]['task_name'];
            $deadline=$appraisal_task_data[$i]['end_date'];
            $priority=$appraisal_task_data[$i]['priority'];
            $objective=htmlentities($appraisal_task_data[$i]['objective']);
            $expected_result=htmlentities($appraisal_task_data[$i]['expected_result']);

            $appraisal_task_array[]=array('id'=>$id,'uid'=>$uid,'objective'=>$objective,'expected_result'=>$expected_result,'task'=>$task,'deadline'=>$deadline,'priority'=>$priority);



        }



        $this->obj->db_close();
         
        return view('appraisal_rating.appraisal_task_edit')->with(['appraisal_data_array'=>$appraisal_data_array,'appraisal_task_array'=>$appraisal_task_array]);
        
     }


     public function appraisal_task_update(){
       
        $this->obj->db_connect();
        $status=0;
        $success_message='';
        $url=$this->obj->baseurl;
        $user =Auth::user();
        $user_id=$user->id;

        $request_method=$_SERVER['REQUEST_METHOD'];
        $uid='';
        $time_period='';
        $objective='';
        $expected_result='';
        $task='';
        $deadline='';
        $priority='';

        $old_task='';
        $old_deadline='';
        $old_priority='';
        $old_task_uid='';
       

        if(isset($_REQUEST['appraisal_uid']) and $_REQUEST['appraisal_uid']!=''){$uid=$_REQUEST['appraisal_uid'];}
        if(isset($_REQUEST['time_period']) and $_REQUEST['time_period']!=''){$time_period=$_REQUEST['time_period'];}
        if(isset($_REQUEST['objective']) and $_REQUEST['objective']!=''){$objective=$_REQUEST['objective'];}
        if(isset($_REQUEST['expected_result']) and $_REQUEST['expected_result']!=''){$expected_result=$_REQUEST['expected_result'];}
        if(isset($_REQUEST['task']) and $_REQUEST['task']!=''){$task=$_REQUEST['task'];}
        if(isset($_REQUEST['date']) and $_REQUEST['date']!=''){$deadline=$_REQUEST['date'];}
        if(isset($_REQUEST['priority']) and $_REQUEST['priority']!=''){$priority=$_REQUEST['priority'];}

        if(isset($_REQUEST['old_task']) and $_REQUEST['old_task']!=''){$old_task=$_REQUEST['old_task'];}
        if(isset($_REQUEST['old_date']) and $_REQUEST['old_date']!=''){$old_deadline=$_REQUEST['old_date'];}
        if(isset($_REQUEST['old_priority']) and $_REQUEST['old_priority']!=''){$old_priority=$_REQUEST['old_priority'];}

        if(isset($_REQUEST['old_task_uid']) and $_REQUEST['old_task_uid']!=''){$old_task_uid=$_REQUEST['old_task_uid'];}

        if($request_method=='POST' and $uid!='')
        {
            if($time_period==''){$success_message='The time period is empty';}
            else if($objective==''){$success_message='The objective is empty';}
            else if($expected_result==''){$success_message='The expected result is empty';}
            else
            {
                $column="*";
                $table="appraisal_task";
                $where="appraisal_uid='$uid'";
                $sort_by="";
                $sort="";
                $limit="";
                $start="";
                
                $appraisal_task_data=$this->obj->data_get($column,$table,$where,$sort_by,$sort,$limit,$start);

                $task_check= $this->obj->data_get_num("*","appraisal","uid='$uid' and supervisor_user_id='$user_id'");

                if($task_check==1)
                {

                    $table_1='appraisal';
                    $table_2='appraisal_task';
                    $date=date('Y-m-d');
                    $time=date('h:i:s a');
                    

                    $where_1="uid='$uid'";

                    $values_1=array(
                        'time_period'=>$time_period,
                        'objective'=>$objective,
                        'expected_result'=>$expected_result,
                        'edit_by_id'=>$user_id,
                        'edit_date'=>$date,
                        'edit_time'=>$time
                        
                    );

                    

                    if($this->obj->data_update($table_1,$values_1,$where_1)==1)
                    {

                        $status=1;
                        $success_message='Update successfully';
                    }
                    else
                    {$success_message='Error, Try again';}

                    if($old_task_uid!=''){$old_task_uid=array_flip($old_task_uid);}
                    
                   
                        for($i=0;$i<count($appraisal_task_data);$i++)
                        {
                            $old_uid=$appraisal_task_data[$i]['uid'];
                            $where_3="uid='$old_uid'";
                            if(isset($old_task_uid[$old_uid])){
                            $values_3=array(
                                'task_name'=>$old_task[$i],
                                'start_date'=>'',
                                'end_date'=>$old_deadline[$i],
                                'comment'=>'',
                                'priority'=>$old_priority[$i],
                                'edit_by_id'=>$user_id,
                                'edit_date'=>$date,
                                'edit_time'=>$time
                                
                            );

                            $this->obj->data_update($table_2,$values_3,$where_3);
                        }
                        else
                        {$this->obj->data_delete($table_2,$where_3);}

                        }
                    




                    if($task!=''){
                        for($i=0;$i<count($task);$i++)
                        {
                            $values_2=array(
                                'uid'=>uniqid(),
                                'appraisal_uid'=>$uid,
                                'task_name'=>$task[$i],
                                'start_date'=>'',
                                'end_date'=>$deadline[$i],
                                'comment'=>'',
                                'priority'=>$priority[$i],
                                'add_by_id'=>$user_id,
                                'date'=>$date,
                                'time'=>$time
                                
                            );

                            $this->obj->data_put($table_2,$values_2);
                        }
                    }


                }
                else
                {$success_message='The appraisal not found';}

            }

        }


        
        $this->obj->db_close();
        
        if($status==1)
        {$response = ['message' => $success_message, 'status' => 'success']; }
        else
        {$response = ['message' => $success_message, 'status' => 'error']; }
        
        return response()->json($response, 200, array('Access-Controll-Allow-Origin' => '*'));
        return redirect()->back()->withSuccess($success_message);
     }


     public function appraisal_task_view(){
        
         $this->obj->db_connect();
         $user =Auth::user();
         $user_arr=$this->obj->data_get("*","users","id=1",'','','','');
         $url=$this->obj->baseurl;
         $this->obj->db_close();
         
        return view('appraisal_rating.appraisal_task_view')->with(['user'=>$user_arr]);
        
     }


     public function appraisal_review(){
        
        $this->obj->db_connect();
        $url=$this->obj->baseurl;
        $user =Auth::user();
        $user_id=$user->id;

        $column="*";
        $table="designations";
        $where="";
        $sort_by="id";
        $sort="ASC";
        $limit="";
        $start="";

        $designation_array=[];

        $designation_list=$this->obj->data_get($column,$table,$where,$sort_by,$sort,$limit,$start);
        for($i=0;$i<count($designation_list);$i++)
        {
            $designation_id=$designation_list[$i]['id'];
            $designation_name=$designation_list[$i]['name'];
            $designation_array[$designation_id]=$designation_name;

        }

        $column="*";
        $table="appraisal";
        $where="supervisor_approve=1";
        $sort_by="status";
        $sort="ASC";
        $limit="";
        $start="";
        $appraisal_list_array=[];

        $appraisal_list_data=$this->obj->data_get($column,$table,$where,$sort_by,$sort,$limit,$start);

        for($i=0;$i<count($appraisal_list_data);$i++)
        {
            $id=$appraisal_list_data[$i]['id'];
            $uid=$appraisal_list_data[$i]['uid'];
            $emp_id=$appraisal_list_data[$i]['user_id'];
            $sup_id=$appraisal_list_data[$i]['supervisor_id'];
            $sup_user_id=$appraisal_list_data[$i]['supervisor_user_id'];
            $time_period=$appraisal_list_data[$i]['time_period'];
            $user_approve=$appraisal_list_data[$i]['user_approve'];
            $sup_approve=$appraisal_list_data[$i]['supervisor_approve'];
            $hr_approve=$appraisal_list_data[$i]['hr_approve'];
            $status=$appraisal_list_data[$i]['status'];
            $date=$appraisal_list_data[$i]['date'];
            $time=$appraisal_list_data[$i]['time'];

            $sort_by="";
            $sort="";
            $table="users";
            $where="id='$emp_id'";
            $emp_data=$this->obj->data_get($column,$table,$where,$sort_by,$sort,$limit,$start);

            $where="id='$sup_user_id'";
            $sup_data=$this->obj->data_get($column,$table,$where,$sort_by,$sort,$limit,$start);

            $emp_username=$emp_data[0]['username'];
            $emp_first_name=$emp_data[0]['first_name'];
            $emp_last_name=$emp_data[0]['last_name'];
            $emp_designation=$designation_array[$emp_data[0]['designation_id']];

            $sup_username=$sup_data[0]['username'];
            $sup_first_name=$sup_data[0]['first_name'];
            $sup_last_name=$sup_data[0]['last_name'];
            $sup_designation=$designation_array[$sup_data[0]['designation_id']];

            $rating='4/5';

            $appraisal_list_array[]=array('id'=>$id,'uid'=>$uid,'emp_id'=>$emp_id,'emp_username'=>$emp_username,'emp_first_name'=>$emp_first_name,'emp_last_name'=>$emp_last_name,'emp_designation'=>$emp_designation,'sup_id'=>$sup_id,'sup_user_id'=>$sup_user_id,'sup_username'=>$sup_username,'sup_first_name'=>$sup_first_name,'sup_last_name'=>$sup_last_name,'sup_designation'=>$sup_designation,'time_period'=>$time_period,'user_approve'=>$user_approve,'sup_approve'=>$sup_approve,'hr_approve'=>$hr_approve,'status'=>$status,'rating'=>$rating,'date'=>$date,'time'=>$time);
            

            
        }



        $this->obj->db_close();

       return view('appraisal_review.appraisal_review')->with(['appraisal_list_array'=>$appraisal_list_array]);
       
    }


    public function appraisal_review_edit(){
        
        $this->obj->db_connect();
        $url=$this->obj->baseurl;
        $user =Auth::user();
        $user_id=$user->id;
        $uid='';
        

        if(isset($_REQUEST['uid']) and $_REQUEST['uid']!=''){$uid=$_REQUEST['uid'];}

        $apr_uid=$uid;

        $column="*";
        $table="designations";
        $where="";
        $sort_by="id";
        $sort="ASC";
        $limit="";
        $start="";

        $designation_array=[];

        $designation_list=$this->obj->data_get($column,$table,$where,$sort_by,$sort,$limit,$start);
        for($i=0;$i<count($designation_list);$i++)
        {
            $designation_id=$designation_list[$i]['id'];
            $designation_name=$designation_list[$i]['name'];
            $designation_array[$designation_id]=$designation_name;

        }

        $column="*";
        $table="appraisal";
        $where="uid='$uid'";
        $sort_by="";
        $sort="";
        $limit="";
        $start="";
        $appraisal_array=[];

        $appraisal_list_data=$this->obj->data_get($column,$table,$where,$sort_by,$sort,$limit,$start);

        for($i=0;$i<count($appraisal_list_data);$i++)
        {
            $id=$appraisal_list_data[$i]['id'];
            $uid=$appraisal_list_data[$i]['uid'];
            $emp_id=$appraisal_list_data[$i]['user_id'];
            $sup_id=$appraisal_list_data[$i]['supervisor_id'];
            $sup_user_id=$appraisal_list_data[$i]['supervisor_user_id'];
            $time_period=$appraisal_list_data[$i]['time_period'];

            $objective=$appraisal_list_data[$i]['objective'];
            $expected_result=$appraisal_list_data[$i]['expected_result'];

            $user_approve=$appraisal_list_data[$i]['user_approve'];
            $sup_approve=$appraisal_list_data[$i]['supervisor_approve'];
            $hr_approve=$appraisal_list_data[$i]['hr_approve'];
            $hr_review_comment=$appraisal_list_data[$i]['hr_review_comment'];
            $status=$appraisal_list_data[$i]['status'];
            $date=$appraisal_list_data[$i]['date'];
            $time=$appraisal_list_data[$i]['time'];

            $answer_1=$appraisal_list_data[$i]['user_answer_1'];
            $answer_2=$appraisal_list_data[$i]['user_answer_2'];
            $answer_3=$appraisal_list_data[$i]['user_answer_3'];
            $answer_4=$appraisal_list_data[$i]['user_answer_4'];
            $answer_5=$appraisal_list_data[$i]['user_answer_5'];
            $answer_6=$appraisal_list_data[$i]['user_answer_6'];
            $answer_7=$appraisal_list_data[$i]['user_answer_7'];
            $answer_8=$appraisal_list_data[$i]['user_answer_8'];
            $answer_9=$appraisal_list_data[$i]['user_answer_9'];
            $answer_10=$appraisal_list_data[$i]['user_answer_10'];
            $answer_11=$appraisal_list_data[$i]['user_answer_11'];
            $answer_12=$appraisal_list_data[$i]['user_answer_12'];
            $answer_13=$appraisal_list_data[$i]['user_answer_13'];
            $answer_14=$appraisal_list_data[$i]['user_answer_14'];
            $answer_15=$appraisal_list_data[$i]['user_answer_15'];
            $answer_16=$appraisal_list_data[$i]['user_answer_16'];
            $answer_17=$appraisal_list_data[$i]['user_answer_17'];
            $answer_18=$appraisal_list_data[$i]['user_answer_18'];
            $answer_19=$appraisal_list_data[$i]['user_answer_19'];
            $answer_20=$appraisal_list_data[$i]['user_answer_20'];

            $table="users";
            $where="id='$user_id'";
            $hr_data=$this->obj->data_get($column,$table,$where,$sort_by,$sort,$limit,$start);

            $hr_username=$hr_data[0]['username'];
            $hr_first_name=$hr_data[0]['first_name'];
            $hr_last_name=$hr_data[0]['last_name'];
            $hr_designation=$designation_array[$hr_data[0]['designation_id']];

            $where="id='$emp_id'";
            $emp_data=$this->obj->data_get($column,$table,$where,$sort_by,$sort,$limit,$start);

            $emp_username=$emp_data[0]['username'];
            $emp_first_name=$emp_data[0]['first_name'];
            $emp_last_name=$emp_data[0]['last_name'];
            $emp_designation=$designation_array[$emp_data[0]['designation_id']];

            

            
            $emp_base='';
            $emp_sub_base='';
            $emp_review_date='';

            $where="id='$sup_user_id'";
            $sup_data=$this->obj->data_get($column,$table,$where,$sort_by,$sort,$limit,$start);

            $sup_username=$sup_data[0]['username'];
            $sup_first_name=$sup_data[0]['first_name'];
            $sup_last_name=$sup_data[0]['last_name'];
            $sup_designation=$designation_array[$sup_data[0]['designation_id']];

            $table="profile";
            $where="user_id='$emp_id'";
            $profile_data=$this->obj->data_get($column,$table,$where,$sort_by,$sort,$limit,$start);

            $emp_joining_date=$profile_data[0]['date_of_joining'];

            $table="role_user";
            $where="user_id='$emp_id'";
            $payroll_id_data=$this->obj->data_get($column,$table,$where,$sort_by,$sort,$limit,$start);
            
            $payroll_id=$payroll_id_data[0]['role_id'];

            $table="roles";
            $where="id='$payroll_id'";
            $payloll_data=$this->obj->data_get($column,$table,$where,$sort_by,$sort,$limit,$start);
            $emp_department=$payloll_data[0]['name'];

            $rating='4/5';

            

            $appraisal_array[]=array('id'=>$id,'uid'=>$uid,'emp_id'=>$emp_id,'hr_username'=>$hr_username,'hr_first_name'=>$hr_first_name,'hr_last_name'=>$hr_last_name,'hr_designation'=>$hr_designation,'emp_username'=>$emp_username,'emp_first_name'=>$emp_first_name,'emp_last_name'=>$emp_last_name,'emp_designation'=>$emp_designation,'emp_department'=>$emp_department,'emp_joining_date'=>$emp_joining_date,'emp_base'=>$emp_base,'emp_sub_base'=>$emp_sub_base,'emp_review_date'=>$emp_review_date,'sup_id'=>$sup_id,'sup_user_id'=>$sup_user_id,'sup_username'=>$sup_username,'sup_first_name'=>$sup_first_name,'sup_last_name'=>$sup_last_name,'sup_designation'=>$sup_designation,'time_period'=>$time_period,'objective'=>$objective,'expected_result'=>$expected_result,'user_approve'=>$user_approve,'sup_approve'=>$sup_approve,'hr_approve'=>$hr_approve,'hr_review_comment'=>$hr_review_comment,'answer_1'=>$answer_1,'answer_2'=>$answer_2,'answer_3'=>$answer_3,'answer_4'=>$answer_4,'answer_5'=>$answer_5,'answer_6'=>$answer_6,'answer_7'=>$answer_7,'answer_8'=>$answer_8,'answer_9'=>$answer_9,'answer_10'=>$answer_10,'answer_11'=>$answer_11,'answer_12'=>$answer_12,'answer_13'=>$answer_13,'answer_14'=>$answer_14,'answer_15'=>$answer_15,'answer_16'=>$answer_16,'answer_17'=>$answer_17,'answer_18'=>$answer_18,'answer_19'=>$answer_19,'answer_20'=>$answer_20,'status'=>$status,'rating'=>$rating,'date'=>$date,'time'=>$time);
            

            
        }

        $column="*";
        $table="appraisal_task";
        $where="appraisal_uid='$uid'";
        $sort_by="id";
        $sort="ASC";
        $limit="";
        $start="";
        $appraisal_task_array=[];

        $appraisal_task_data=$this->obj->data_get($column,$table,$where,$sort_by,$sort,$limit,$start);

        for($i=0;$i<count($appraisal_task_data);$i++)
        {
            $id=$appraisal_task_data[$i]['id'];
            $uid=$appraisal_task_data[$i]['uid'];
            $task=$appraisal_task_data[$i]['task_name'];
            $deadline=$appraisal_task_data[$i]['end_date'];
            $priority=$appraisal_task_data[$i]['priority'];
            $rating=$appraisal_task_data[$i]['rating'];

            $appraisal_task_array[]=array('id'=>$id,'uid'=>$uid,'task'=>$task,'deadline'=>$deadline,'priority'=>$priority,'rating'=>$rating);



        }

        
        $column="*";
        $table="appraisal_comment";
        $sort_by="";
        $sort="";
        $limit="";
        $start="";

        for($i=1;$i<=7;$i++)
        {

            $where="appraisal_uid='$apr_uid' and supervisor_user_id='$user_id' and question_id='$i'";
            $appraisal_comment_data=$this->obj->data_get($column,$table,$where,$sort_by,$sort,$limit,$start);
            ${'comment_array_'.$i}=[];
            for($j=0;$j<count($appraisal_comment_data);$j++)
            {
                $id=$appraisal_comment_data[$j]['id'];
                $uid=$appraisal_comment_data[$j]['uid'];
                $title=$appraisal_comment_data[$j]['title'];
                $comment=$appraisal_comment_data[$j]['comment'];
                $rating=$appraisal_comment_data[$j]['rating'];

                ${'comment_array_'.$i}[]=array('id'=>$id,'uid'=>$uid,'title'=>$title,'comment'=>$comment,'rating'=>$rating);
            }
            
        }



        return view('appraisal_review.appraisal_review_edit')->with(['appraisal_array'=>$appraisal_array,'appraisal_task_array'=>$appraisal_task_array,'comment_array_1'=>$comment_array_1,'comment_array_2'=>$comment_array_2,'comment_array_3'=>$comment_array_3,'comment_array_4'=>$comment_array_4,'comment_array_5'=>$comment_array_5,'comment_array_6'=>$comment_array_6,'comment_array_7'=>$comment_array_7]);
         
        
    }


    public function appraisal_review_edit_save(){

        $this->obj->db_connect();
        $status=0;
        $success_message='';
        $url=$this->obj->baseurl;
        $user =Auth::user();
        $user_id=$user->id;
        $date=date('Y-m-d');
        $time=date('h:i:s a');

        $request_method=$_SERVER['REQUEST_METHOD'];
        $uid='';
        $comment='';
       

        if(isset($_REQUEST['uid']) and $_REQUEST['uid']!=''){$uid=$_REQUEST['uid'];}
        if(isset($_REQUEST['comment']) and $_REQUEST['comment']!=''){$comment=$_REQUEST['comment'];}

        if($request_method=='POST' and $uid!='')
        {

            $check=$this->obj->data_get_num('*','appraisal',"uid='$uid' and hr_approve=0");

            if($check==1)
            {
                $table="appraisal";
                $where="uid='$uid' and hr_approve=0";
                $values=array('hr_approve'=>1,'hr_approve_user_id'=>$user_id,'hr_review_comment'=>$comment,'hr_approve_date'=>$date,'hr_approve_time'=>$time,'status'=>1);

                if($this->obj->data_update($table,$values,$where)==1)
                {
                    $status=1;
                    $success_message='Submited Successfully';
                }
                else
                {$success_message='Error, Try again';}

            }
            else{$success_message='Appraisal not found';}

        }
        
       

        
        $this->obj->db_close();
        
        if($status==1)
        {$response = ['message' => $success_message, 'status' => 'success']; }
        else
        {$response = ['message' => $success_message, 'status' => 'error']; }
        
        return response()->json($response, 200, array('Access-Controll-Allow-Origin' => '*'));
        return redirect()->back()->withSuccess($success_message);

    }



    public function appraisal_view(){
        
        $this->obj->db_connect();
        $url=$this->obj->baseurl;
        $user =Auth::user();
        $user_id=$user->id;
        $uid='';
        

        if(isset($_REQUEST['uid']) and $_REQUEST['uid']!=''){$uid=$_REQUEST['uid'];}

        $apr_uid=$uid;

        $column="*";
        $table="designations";
        $where="";
        $sort_by="id";
        $sort="ASC";
        $limit="";
        $start="";

        $designation_array=[];

        $designation_list=$this->obj->data_get($column,$table,$where,$sort_by,$sort,$limit,$start);
        for($i=0;$i<count($designation_list);$i++)
        {
            $designation_id=$designation_list[$i]['id'];
            $designation_name=$designation_list[$i]['name'];
            $designation_array[$designation_id]=$designation_name;

        }

        $column="*";
        $table="appraisal";
        $where="uid='$uid'";
        $sort_by="";
        $sort="";
        $limit="";
        $start="";
        $appraisal_array=[];

        $appraisal_list_data=$this->obj->data_get($column,$table,$where,$sort_by,$sort,$limit,$start);

        for($i=0;$i<count($appraisal_list_data);$i++)
        {
            $id=$appraisal_list_data[$i]['id'];
            $uid=$appraisal_list_data[$i]['uid'];
            $emp_id=$appraisal_list_data[$i]['user_id'];
            $sup_id=$appraisal_list_data[$i]['supervisor_id'];
            $hr_id=$appraisal_list_data[$i]['hr_approve_user_id'];
            $sup_user_id=$appraisal_list_data[$i]['supervisor_user_id'];
            $time_period=$appraisal_list_data[$i]['time_period'];



            $objective=$appraisal_list_data[$i]['objective'];
            $expected_result=$appraisal_list_data[$i]['expected_result'];

            $user_approve=$appraisal_list_data[$i]['user_approve'];
            $sup_approve=$appraisal_list_data[$i]['supervisor_approve'];
            $hr_approve=$appraisal_list_data[$i]['hr_approve'];
            $hr_approve_date=$appraisal_list_data[$i]['hr_approve_date'];
            $hr_approve_time=$appraisal_list_data[$i]['hr_approve_time'];
            $hr_review_comment=$appraisal_list_data[$i]['hr_review_comment'];
            $status=$appraisal_list_data[$i]['status'];
            $date=$appraisal_list_data[$i]['date'];
            $time=$appraisal_list_data[$i]['time'];

            $answer_1=$appraisal_list_data[$i]['user_answer_1'];
            $answer_2=$appraisal_list_data[$i]['user_answer_2'];
            $answer_3=$appraisal_list_data[$i]['user_answer_3'];
            $answer_4=$appraisal_list_data[$i]['user_answer_4'];
            $answer_5=$appraisal_list_data[$i]['user_answer_5'];
            $answer_6=$appraisal_list_data[$i]['user_answer_6'];
            $answer_7=$appraisal_list_data[$i]['user_answer_7'];
            $answer_8=$appraisal_list_data[$i]['user_answer_8'];
            $answer_9=$appraisal_list_data[$i]['user_answer_9'];
            $answer_10=$appraisal_list_data[$i]['user_answer_10'];
            $answer_11=$appraisal_list_data[$i]['user_answer_11'];
            $answer_12=$appraisal_list_data[$i]['user_answer_12'];
            $answer_13=$appraisal_list_data[$i]['user_answer_13'];
            $answer_14=$appraisal_list_data[$i]['user_answer_14'];
            $answer_15=$appraisal_list_data[$i]['user_answer_15'];
            $answer_16=$appraisal_list_data[$i]['user_answer_16'];
            $answer_17=$appraisal_list_data[$i]['user_answer_17'];
            $answer_18=$appraisal_list_data[$i]['user_answer_18'];
            $answer_19=$appraisal_list_data[$i]['user_answer_19'];
            $answer_20=$appraisal_list_data[$i]['user_answer_20'];

            $table="users";
            $where="id='$hr_id'";
            $hr_data=$this->obj->data_get($column,$table,$where,$sort_by,$sort,$limit,$start);

            $hr_username=$hr_data[0]['username'];
            $hr_first_name=$hr_data[0]['first_name'];
            $hr_last_name=$hr_data[0]['last_name'];
            $hr_designation=$designation_array[$hr_data[0]['designation_id']];

            $where="id='$emp_id'";
            $emp_data=$this->obj->data_get($column,$table,$where,$sort_by,$sort,$limit,$start);

            $emp_username=$emp_data[0]['username'];
            $emp_first_name=$emp_data[0]['first_name'];
            $emp_last_name=$emp_data[0]['last_name'];
            $emp_designation=$designation_array[$emp_data[0]['designation_id']];

            

            
            $emp_base='';
            $emp_sub_base='';
            $emp_review_date='';

            $where="id='$sup_user_id'";
            $sup_data=$this->obj->data_get($column,$table,$where,$sort_by,$sort,$limit,$start);

            $sup_username=$sup_data[0]['username'];
            $sup_first_name=$sup_data[0]['first_name'];
            $sup_last_name=$sup_data[0]['last_name'];
            $sup_designation=$designation_array[$sup_data[0]['designation_id']];

            $table="profile";
            $where="user_id='$emp_id'";
            $profile_data=$this->obj->data_get($column,$table,$where,$sort_by,$sort,$limit,$start);

            $emp_joining_date=$profile_data[0]['date_of_joining'];

            $table="role_user";
            $where="user_id='$emp_id'";
            $payroll_id_data=$this->obj->data_get($column,$table,$where,$sort_by,$sort,$limit,$start);
            
            $payroll_id=$payroll_id_data[0]['role_id'];

            $table="roles";
            $where="id='$payroll_id'";
            $payloll_data=$this->obj->data_get($column,$table,$where,$sort_by,$sort,$limit,$start);
            $emp_department=$payloll_data[0]['name'];

            $rating='4/5';

            

            $appraisal_array[]=array('id'=>$id,'uid'=>$uid,'emp_id'=>$emp_id,'hr_username'=>$hr_username,'hr_first_name'=>$hr_first_name,'hr_last_name'=>$hr_last_name,'hr_designation'=>$hr_designation,'emp_username'=>$emp_username,'emp_first_name'=>$emp_first_name,'emp_last_name'=>$emp_last_name,'emp_designation'=>$emp_designation,'emp_department'=>$emp_department,'emp_joining_date'=>$emp_joining_date,'emp_base'=>$emp_base,'emp_sub_base'=>$emp_sub_base,'emp_review_date'=>$emp_review_date,'sup_id'=>$sup_id,'sup_user_id'=>$sup_user_id,'sup_username'=>$sup_username,'sup_first_name'=>$sup_first_name,'sup_last_name'=>$sup_last_name,'sup_designation'=>$sup_designation,'time_period'=>$time_period,'objective'=>$objective,'expected_result'=>$expected_result,'user_approve'=>$user_approve,'sup_approve'=>$sup_approve,'hr_approve'=>$hr_approve,'hr_review_comment'=>$hr_review_comment,'hr_approve_date'=>$hr_approve_date,'hr_approve_time'=>$hr_approve_time,'answer_1'=>$answer_1,'answer_2'=>$answer_2,'answer_3'=>$answer_3,'answer_4'=>$answer_4,'answer_5'=>$answer_5,'answer_6'=>$answer_6,'answer_7'=>$answer_7,'answer_8'=>$answer_8,'answer_9'=>$answer_9,'answer_10'=>$answer_10,'answer_11'=>$answer_11,'answer_12'=>$answer_12,'answer_13'=>$answer_13,'answer_14'=>$answer_14,'answer_15'=>$answer_15,'answer_16'=>$answer_16,'answer_17'=>$answer_17,'answer_18'=>$answer_18,'answer_19'=>$answer_19,'answer_20'=>$answer_20,'status'=>$status,'rating'=>$rating,'date'=>$date,'time'=>$time);
            

            
        }

        $column="*";
        $table="appraisal_task";
        $where="appraisal_uid='$uid'";
        $sort_by="id";
        $sort="ASC";
        $limit="";
        $start="";
        $appraisal_task_array=[];

        $appraisal_task_data=$this->obj->data_get($column,$table,$where,$sort_by,$sort,$limit,$start);

        for($i=0;$i<count($appraisal_task_data);$i++)
        {
            $id=$appraisal_task_data[$i]['id'];
            $uid=$appraisal_task_data[$i]['uid'];
            $task=$appraisal_task_data[$i]['task_name'];
            $deadline=$appraisal_task_data[$i]['end_date'];
            $priority=$appraisal_task_data[$i]['priority'];
            $rating=$appraisal_task_data[$i]['rating'];

            $appraisal_task_array[]=array('id'=>$id,'uid'=>$uid,'task'=>$task,'deadline'=>$deadline,'priority'=>$priority,'rating'=>$rating);



        }

        
        $column="*";
        $table="appraisal_comment";
        $sort_by="";
        $sort="";
        $limit="";
        $start="";

        for($i=1;$i<=7;$i++)
        {

            $where="appraisal_uid='$apr_uid' and supervisor_user_id='$user_id' and question_id='$i'";
            $appraisal_comment_data=$this->obj->data_get($column,$table,$where,$sort_by,$sort,$limit,$start);
            ${'comment_array_'.$i}=[];
            for($j=0;$j<count($appraisal_comment_data);$j++)
            {
                $id=$appraisal_comment_data[$j]['id'];
                $uid=$appraisal_comment_data[$j]['uid'];
                $title=$appraisal_comment_data[$j]['title'];
                $comment=$appraisal_comment_data[$j]['comment'];
                $rating=$appraisal_comment_data[$j]['rating'];

                ${'comment_array_'.$i}[]=array('id'=>$id,'uid'=>$uid,'title'=>$title,'comment'=>$comment,'rating'=>$rating);
            }
            
        }



        return view('appraisal.appraisal_view')->with(['appraisal_array'=>$appraisal_array,'appraisal_task_array'=>$appraisal_task_array,'comment_array_1'=>$comment_array_1,'comment_array_2'=>$comment_array_2,'comment_array_3'=>$comment_array_3,'comment_array_4'=>$comment_array_4,'comment_array_5'=>$comment_array_5,'comment_array_6'=>$comment_array_6,'comment_array_7'=>$comment_array_7]);
         
        
    }


   
}

   

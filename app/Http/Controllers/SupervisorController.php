<?php

namespace App\Http\Controllers;
use App\Classes\Objectclass;
use Auth;
use App\Template;


class SupervisorController extends Controller{
    use BasicController;

    var $obj;

    public function __construct()
   {
    
    $base_dir='';
    $db_data=$db_data=include('../config/db.php');
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
    return view('supervisor.index',compact(''));

    }

    public function supervisor_list(){
        
        $this->obj->db_connect();
        
        

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
        $table="users";
        $where="";
        $sort_by="username";
        $sort="ASC";
        $limit="";
        $start="";
        $user_list_array=[];
        $user_list=$this->obj->data_get($column,$table,$where,$sort_by,$sort,$limit,$start);
        $count=count($user_list);
		for($i=0;$i<$count;$i++)
		{
		    $user_id=$user_list[$i]['id'];
			$user_username=$user_list[$i]['username'];
			$user_first_name=$user_list[$i]['first_name'];
			$user_last_name=$user_list[$i]['last_name'];
			$designation=trim($user_list[$i]['designation_id']);

            $designation=$designation_array[$designation];
            
            $column="*";
            $table="supervisor";
            $where="user_id='$user_id'";
            
            $check_sup=$this->obj->data_get_num($column,$table,$where);
            if($check_sup==0){
            $user_list_array[]=array('id'=>$user_id,'username'=>$user_username,'first_name'=>$user_first_name,'last_name'=>$user_last_name,'designation'=>$designation);
            }

		}

        $column="*";
        $table="supervisor";
        $where="";
        $sort_by="id";
        $sort="DESC";
        $limit="";
        $start="";
        $supervis_list_array=[];
        $supervis_list=$this->obj->data_get($column,$table,$where,$sort_by,$sort,$limit,$start);
        
        for($i=0;$i<count($supervis_list);$i++)
        {
            $supervisor_id=$supervis_list[$i]['id'];
            $supervisor_uid=$supervis_list[$i]['uid'];
            $supervisor_user_id=$supervis_list[$i]['user_id'];
            $supervisor_status=$supervis_list[$i]['status'];
            $date=$supervis_list[$i]['date'];
            $time=$supervis_list[$i]['time'];

            $column="*";
            $table="users";
            $where="id='$supervisor_user_id'";
            $sort_by="";
            $sort="";
            $limit="";
            $start="";

            $user_list_data=$this->obj->data_get($column,$table,$where,$sort_by,$sort,$limit,$start);

            $user_id=$user_list_data[0]['id'];
            $user_username=$user_list_data[0]['username'];
            $user_first_name=$user_list_data[0]['first_name'];
            $user_last_name=$user_list_data[0]['last_name'];
            $user_mail=$user_list_data[0]['email'];
            $user_designation=$designation_array[$user_list_data[0]['designation_id']];

            $column="*";
            $table="supervisor_employee";
            $where="supervisor_id='$supervisor_id'";
            
            $total_employee=$this->obj->data_get_num($column,$table,$where);
           
            $supervis_list_array[]=array('id'=>$supervisor_id,'user_id'=>$user_id,'username'=>$user_username,'first_name'=>$user_first_name,'last_name'=>$user_last_name,'mail'=>$user_mail,'designation'=>$user_designation,'employee'=>$total_employee,'status'=>$supervisor_status,'date'=>$date,'time'=>$time);


        }



       

        $this->obj->db_close();

       return view('supervisor.supervisor_list')->with(['user_list'=>$user_list_array,'designation_array'=>$designation_array,'supervis_list'=>$supervis_list_array]);
        
    }


    public function supervisor_add(){


       $this->obj->db_connect();
        
       $user =Auth::user();
        $add_by_id=$user->id;
        $baseurl=$this->obj->baseurl;

        $request_method=$_SERVER['REQUEST_METHOD'];
        $uid='';
        $user_id='';
        $button='';
        $status=0;
        $success_message='';

        if(isset($_REQUEST['uid']) and $_REQUEST['uid']!=''){$uid=$_REQUEST['uid'];}
        if(isset($_REQUEST['user_id']) and $_REQUEST['user_id']!=''){$user_id=$_REQUEST['user_id'];}
        if(isset($_REQUEST['button']) and $_REQUEST['button']!=''){$button=$_REQUEST['button'];}

        if($request_method=='POST' and $button='add')
        {
            if($user_id==''){$success_message='User is empty';}
            else{
            $column="*";
            $table="supervisor";
            $where="user_id='$user_id'";
            $check=$this->obj->data_get_num($column,$table,$where);

            if($check==0)
            {
                $values=array(
                    'uid'=>uniqid(),
                    'user_id'=>$user_id,
                    'add_by_id'=>$add_by_id,
                    'date'=>date('Y-m-d'),
                    'time'=>date('h:i:s a')
                );

                if($this->obj->data_put($table,$values)==1)
                {
                    $status=1;
                    $success_message='Added Successfully';
                }
                else
                { $success_message='Try again';}

            }
            else
            {$success_message='Already added';}
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


    public function supervisor_delete(){

        $this->obj->db_connect();
        $request_method=$_SERVER['REQUEST_METHOD'];
        $id='';
        $status=0;
        $success_message='';

        if(isset($_REQUEST['id']) and $_REQUEST['id']!=''){$id=trim($_REQUEST['id']);}


        if($request_method=='POST' and $id!='')
        {
            $column="*";
            $table="supervisor";
            $where="id='$id'";
            $check=$this->obj->data_get_num($column,$table,$where);

            if($check==1)
            {
                
                if($this->obj->data_delete($table,$where)==1)
                {
                    $status=1;
                    $success_message='Deleted Successfully';
                }
                else
                { $success_message='Try again';}

            }
            else
            {$success_message='Something error';}

        }
        $this->obj->db_close();

        if($status==1)
        {$response = ['message' => $success_message, 'status' => 'success']; }
        else
        {$response = ['message' => $success_message, 'status' => 'error']; }
        
        return response()->json($response, 200, array('Access-Controll-Allow-Origin' => '*'));
        return redirect()->back()->withSuccess($success_message);
    }




     public function supervisor_employee(){
        
        
        $id='';
        $user_id='';

        if(isset($_REQUEST['id']) and $_REQUEST['id']!=''){$id=$_REQUEST['id'];}
        if(isset($_REQUEST['user_id']) and $_REQUEST['user_id']!=''){$user_id=$_REQUEST['user_id'];}

        $this->obj->db_connect();
         
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
        $table="users";
        $where="id='$user_id'";
        $sort_by="";
        $sort="";
        $limit="";
        $start="";

        $result_supervisor_data=$this->obj->data_get($column,$table,$where,$sort_by,$sort,$limit,$start);

        $supervisor_id=$result_supervisor_data[0]['id'];
        $supervisor_username=$result_supervisor_data[0]['username'];
        $supervisor_first_name=$result_supervisor_data[0]['first_name'];
        $supervisor_last_name=$result_supervisor_data[0]['last_name'];
        $supervisor_designation=$designation_array[$result_supervisor_data[0]['designation_id']];

        $supervisor_data=array('id'=>$supervisor_id,'username'=>$supervisor_username,'first_name'=>$supervisor_first_name,'last_name'=>$supervisor_last_name,'designation'=>$supervisor_designation);


            $column="*";
            $table="users";
            $where="";
            $sort_by="username";
            $sort="ASC";
            $limit="";
            $start="";

            $user_list_array=[];

            $user_list_data=$this->obj->data_get($column,$table,$where,$sort_by,$sort,$limit,$start);

            for($i=0;$i<count($user_list_data);$i++)
            {
                $user_id=$user_list_data[$i]['id'];
                $user_username=$user_list_data[$i]['username'];
                $user_first_name=$user_list_data[$i]['first_name'];
                $user_last_name=$user_list_data[$i]['last_name'];
                $user_mail=$user_list_data[$i]['email'];
                $user_designation=$designation_array[$user_list_data[$i]['designation_id']];

                $table="supervisor_employee";
                $where="supervisor_id='$id' and user_id='$user_id'";
                $check_emp=$this->obj->data_get_num($column,$table,$where);

                $user_list_array[]=array('id'=>$user_id,'username'=>$user_username,'first_name'=>$user_first_name,'last_name'=>$user_last_name,'designation'=>$user_designation,'check'=>$check_emp);
            }

         $this->obj->db_close();
         
        return view('supervisor.supervisor_employee')->with(['user_list'=>$user_list_array,'supervisor_data'=>$supervisor_data]);
        
     }

     public function supervisor_employee_add(){

        $this->obj->db_connect();
        $request_method=$_SERVER['REQUEST_METHOD'];
        $sup_id='';
        $emp_id='';
        $button='';
        $status=0;
        $success_message='';

        $user =Auth::user();
        $add_by_id=$user->id;

        if(isset($_REQUEST['sup_id']) and $_REQUEST['sup_id']!=''){$sup_id=$_REQUEST['sup_id'];}
        if(isset($_REQUEST['emp_id']) and $_REQUEST['emp_id']!=''){$emp_id=$_REQUEST['emp_id'];}
        if(isset($_REQUEST['button']) and $_REQUEST['button']!=''){$button=$_REQUEST['button'];}

        if($request_method=='POST' and $sup_id!='')
        {

            $table="supervisor_employee";
            $where="supervisor_id='$sup_id'";
            $this->obj->data_delete($table,$where);

            for($i=0;$i<count($emp_id);$i++)
            {
                $user_id='';
                if(isset($emp_id[$i])){$user_id=$emp_id[$i];}

                if($user_id!=''){
                $values=array(
                    'uid'=>uniqid(),
                    'supervisor_id'=>$sup_id,
                    'user_id'=>$user_id,
                    'add_by_id'=>$add_by_id,
                    'date'=>date('Y-m-d'),
                    'time'=>date('h:i:s a')
                );

                $this->obj->data_put($table,$values);
            }


            }

            $status=1;
            $success_message='Saved Successfully'; 

        }
        else
        {$success_message='Error'; }

        $this->obj->db_close();

        if($status==1)
            {$response = ['message' => $success_message, 'status' => 'success']; }
            else
            {$response = ['message' => $success_message, 'status' => 'error']; }
            
            return response()->json($response, 200, array('Access-Controll-Allow-Origin' => '*'));
            return redirect()->back()->withSuccess($success_message);           


     }

   
}

   

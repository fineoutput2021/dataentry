<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once(APPPATH . 'core/CI_finecontrol.php');
class assginment extends CI_finecontrol{
function __construct()
{
parent::__construct();
$this->load->model("login_model");
$this->load->model("admin/base_model");
$this->load->library('user_agent');
}

//========================== views====================================

public function View_assginment(){

if(!empty($this->session->userdata('admin_data'))){
$this->db->select('*');
$this->db->from('tbl_assginment');
//$this->db->where('id',$usr);
$data['assginment_data']= $this->db->get();


$this->load->view('admin/common/header_view',$data);
$this->load->view('admin/assginment/View_assginment');
$this->load->view('admin/common/footer_view');

}
else{

redirect("login/admin_login","refresh");
}
}
//========================== add users====================================

public function Add_assginment(){

if(!empty($this->session->userdata('admin_data'))){


$data['user_name']=$this->load->get_var('user_name');

// echo SITE_NAME;
// echo $this->session->userdata('image');
// echo $this->session->userdata('position');
// exit;
$this->db->select('*');
$this->db->from('tbl_student');
//$this->db->where('id',$usr);
$data['student_data']= $this->db->get();


$this->load->view('admin/common/header_view',$data);
$this->load->view('admin/assginment/Add_assginment');
$this->load->view('admin/common/footer_view');

}
else{

redirect("login/admin_login","refresh");
}

}//----end add function
//========================== insert users====================================

public function add_assginment_data($t,$iw="")

{

if(!empty($this->session->userdata('admin_data'))){


$this->load->helper(array('form', 'url'));
$this->load->library('form_validation');
$this->load->helper('security');
if($this->input->post())
{
// print_r($this->input->post());
$this->form_validation->set_rules('admin', 'admin', 'xss_clean|trim');
$this->form_validation->set_rules('student', 'student', 'xss_clean|trim');
$this->form_validation->set_rules('name', 'name', 'xss_clean|trim');

$student=$this->input->post('amount');
if($this->form_validation->run()== TRUE)
{
  $admin=$this->input->post('admin');
$student=$this->input->post('student');
$name=$this->input->post('name');

$price=$this->input->post('date');
//------insert image-----------


$ip = $this->input->ip_address();
date_default_timezone_set("Asia/Calcutta");
$cur_date=date("Y-m-d H:i:s");

$addedby=$this->session->userdata('admin_id');

$typ=base64_decode($t);
if($typ==1){

$data_insert = array(
'admin'=>$admin,
'student'=>$student,
'name'=>$name,


// 'ip' =>$ip,
'added_by' =>$addedby,
'is_active' =>1,
'date'=>$cur_date

);





$last_id=$this->base_model->insert_table("tbl_assginment",$data_insert,1) ;

}
if($typ==2){

$idw=base64_decode($iw);

// $this->db->select('*');
//     $this->db->from('tbl_minor_assginment');
//    $this->db->where('name',$name);
//     $damm= $this->db->get();
//    foreach($damm->result() as $da) {
//      $uid=$da->id;
// if($uid==$idw)
// {
//
//  }
// else{
//    echo "Multiple Entry of Same Name";
//       exit;
//  }
//     }

$data_insert = array(
'student'=>$student,
  'name'=>$name,


);




$this->db->where('id', $idw);
$last_id=$this->db->update('tbl_assginment', $data_insert);

}


if($last_id!=0){

$this->session->set_flashdata('smessage','Data inserted successfully');

redirect("dcadmin/assginment/View_assginment","refresh");

}

else

{

$this->session->set_flashdata('emessage','Sorry error occured');
redirect($_SERVER['HTTP_REFERER']);


}


}
else{

$this->session->set_flashdata('emessage',validation_errors());
redirect($_SERVER['HTTP_REFERER']);

}

}
else{

$this->session->set_flashdata('emessage','Please insert some data, No data available');
redirect($_SERVER['HTTP_REFERER']);

}
}
else{

redirect("login/admin_login","refresh");


}

}
//===================update start============================
public function Update_assginment($idd){
if(!empty($this->session->userdata('admin_data'))){


$data['user_name']=$this->load->get_var('user_name');

// echo SITE_NAME;
// echo $this->session->userdata('image');
// echo $this->session->userdata('position');
// exit;
$id=base64_decode($idd);
$data['id']=$idd;

$this->db->select('*');
$this->db->from('tbl_assginment');
$this->db->where('id',$id);
$dsa= $this->db->get();
$data['assginment_data']=$dsa->row();



$this->load->view('admin/common/header_view',$data);
$this->load->view('admin/assginment/Update_assginment');

$this->load->view('admin/common/footer_view');

}
else{

redirect("login/admin_login","refresh");
}

}
//===========delete=======
public function delete_assginment($idd){

if(!empty($this->session->userdata('admin_data'))){


$data['user_name']=$this->load->get_var('user_name');

// echo SITE_NAME;
// echo $this->session->userdata('image');
// echo $this->session->userdata('position');
// exit;
									 $id=base64_decode($idd);

if($this->load->get_var('position')=="Super Admin"){

        									 $zapak=$this->db->delete('tbl_assginment', array('id' => $id));
        									 if($zapak!=0){

        								 	redirect("dcadmin/assginment/View_assginment","refresh");
        								 					}
        								 					else
        								 					{
        								 						echo "Error";
        								 						exit;
        								 					}
      }
      else{
      $data['e']="Sorry You Don't Have Permission To Delete Anything.";
      	// exit;
      	$this->load->view('errors/error500admin',$data);
      }


}
else{

$this->load->view('admin/login/index');
}

}
//====================update status===========================


public function updateassginmentStatus($idd,$t){

     if(!empty($this->session->userdata('admin_data'))){


       $data['user_name']=$this->load->get_var('user_name');

       // echo SITE_NAME;
       // echo $this->session->userdata('image');
       // echo $this->session->userdata('position');
       // exit;
       $id=base64_decode($idd);

       if($t=="active"){

         $data_update = array(

     'is_active'=>1

     );

     $this->db->where('id', $id);
    $zapak=$this->db->update('tbl_assginment', $data_update);

         if($zapak!=0){
         redirect("dcadmin/assginment/View_assginment","refresh");
                 }
                 else
                 {
                   echo "Error";
                   exit;
                 }
       }
       if($t=="inactive"){
         $data_update = array(
      'is_active'=>0

      );

      $this->db->where('id', $id);
      $zapak=$this->db->update('tbl_assginment', $data_update);

          if($zapak!=0){
          redirect("dcadmin/assginment/View_assginment","refresh");
                  }
                  else
                  {

      $data['e']="Error Occured";
                      	// exit;
    	$this->load->view('errors/error500admin',$data);
                  }
       }



   }
   else{

       $this->load->view('admin/login/index');
   }

   }

	 public function getassginment($a){


	                 if(!empty($this->session->userdata('admin_data'))){


	        $this->db->select('*');
	        $this->db->from('tbl_assginment');
	        $this->db->where('student',$a);
	        $assginment= $this->db->get();
	        $check= $assginment->row();
	 if(!empty($check)){

	    foreach ($assginment->result() as  $c1) {

	     $arr[]=array(
	         'assginment_id'=>$c1->id,
	         'name'=>$c1->name,
	     );



	    }


			$res = array(
				'code'=>"200",
				'message'=>"success",
				'data'=>$arr
			);

	     echo json_encode($res);
	     exit;

	 }
	 else{
	     echo "NA";
	     exit;
	 }

	                }
	                else{



	                  redirect("login/admin_login","refresh");
	                }



	               }




}//======end of the class

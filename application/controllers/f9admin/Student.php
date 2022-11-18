<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once(APPPATH . 'core/CI_finecontrol.php');
class Student extends CI_finecontrol{
function __construct()
		{
			parent::__construct();
			$this->load->model("login_model");
			$this->load->model("admin/base_model");
			$this->load->library('user_agent');
		}


// view student Funcation

public function view_student(){


       if(!empty($this->session->userdata('admin_data'))){


         $data['user_name']=$this->load->get_var('user_name');


	$this->db->select('*');
$this->db->from('tbl_student');
//$this->db->where('id',$usr);
$data['student_data']= $this->db->get();

         $this->load->view('admin/common/header_view',$data);
         $this->load->view('admin/student/view_student');
				 // view page parth
         $this->load->view('admin/common/footer_view');

     }
     else{

        redirect("login/admin_login","refresh");
     }

     }

//  add student funcation
public function add_student(){

       if(!empty($this->session->userdata('admin_data'))){


         $data['user_name']=$this->load->get_var('user_name');

         // echo SITE_NAME;
         // echo $this->session->userdata('image');
         // echo $this->session->userdata('position');
         // exit;


         $this->load->view('admin/common/header_view',$data);
         $this->load->view('admin/student/add_student');
         $this->load->view('admin/common/footer_view');

     }
     else{

        redirect("login/admin_login","refresh");
     }

     }
		 //  add student data funncation

      			public function add_student_data($t,$iw="")

              {

                if(!empty($this->session->userdata('admin_data'))){


          	$this->load->helper(array('form', 'url'));
            $this->load->library('form_validation');
            $this->load->helper('security');
            if($this->input->post())
            {
              // print_r($this->input->post());
              // exit;
              $this->form_validation->set_rules('fname', 'full name', 'required|xss_clean');
							$this->form_validation->set_rules('mail', 'Email', 'required|xss_clean');
							$this->form_validation->set_rules('phone', 'Phone Number', 'required|xss_clean');
							$this->form_validation->set_rules('city', 'City', 'required|xss_clean');
							$this->form_validation->set_rules('state', 'State', 'required|xss_clean');
							$this->form_validation->set_rules('country', 'Country', 'required|xss_clean');



              if($this->form_validation->run()== TRUE)
              {
                $fname=$this->input->post('fname');
								$mail=$this->input->post('mail');
								$phone=$this->input->post('phone');
								$city=$this->input->post('city');
								$state=$this->input->post('state');
								$country=$this->input->post('country');


                  $ip = $this->input->ip_address();
          date_default_timezone_set("Asia/Calcutta");
                  $cur_date=date("Y-m-d H:i:s");

                  $addedby=$this->session->userdata('admin_id');

          $typ=base64_decode($t);
          if($typ==1){

          $data_insert = array('full_name'=>$fname,
                    'email'=>$mail,
                    'phone_number'=>$phone,
                    'city'=>$city,
										'state'=>$state,
										'country'=>$country,
                    'ip' =>$ip,
                    'added_by' =>$addedby,
                    'is_active' =>1,
                    // 'date'=>$cur_date
                    );

          $last_id=$this->base_model->insert_table("tbl_student",$data_insert,1) ;

          }
          if($typ==2){

   $idw=base64_decode($iw);

// $this->db->select('*');
//     $this->db->from('tbl_minor_category');
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

$data_insert = array('full_name'=>$fname,
					'email'=>$mail,
					'phone_number'=>$phone,
					'city'=>$city,
					'state'=>$state,
					'country'=>$country

                    );

          	$this->db->where('id', $idw);
            $last_id=$this->db->update('tbl_student', $data_insert);

          }


                              if($last_id!=0){

                              $this->session->set_flashdata('smessage','Data inserted successfully');

                              redirect("dcadmin/student/view_student","refresh");

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

// update student funncation

public function update_student($idd){

                 if(!empty($this->session->userdata('admin_data'))){


                   $data['user_name']=$this->load->get_var('user_name');

                   // echo SITE_NAME;
                   // echo $this->session->userdata('image');
                   // echo $this->session->userdata('position');
                   // exit;
									  $id=base64_decode($idd);
									 $data['id']=$idd;

									 $this->db->select('*');
									             $this->db->from('tbl_student');
									             $this->db->where('id',$id);
									             $dsa= $this->db->get();
									             $data['student']=$dsa->row();


                   $this->load->view('admin/common/header_view',$data);
                   $this->load->view('admin/student/update_student');
                   $this->load->view('admin/common/footer_view');

               }

               }

							 // delete student funcation

				public function delete_student($idd){

				       if(!empty($this->session->userdata('admin_data'))){


				         $data['user_name']=$this->load->get_var('user_name');

				         // echo SITE_NAME;
				         // echo $this->session->userdata('image');
				         // echo $this->session->userdata('position');
				         // exit;
				                 									 $id=base64_decode($idd);

				        if($this->load->get_var('position')=="Super Admin"){

				                         									 $zapak=$this->db->delete('tbl_student', array('id' => $id));
				                         									 if($zapak!=0){
				                   // $path = FCPATH . "assets/public/slider/".$img;
				                         										 // unlink($path);
				                         								 	redirect("dcadmin/student/view_student","refresh");
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
// update status funncation

public function updatestudentStatus($idd,$t){

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
        $zapak=$this->db->update('tbl_student', $data_update);

             if($zapak!=0){
             redirect("dcadmin/student/view_student","refresh");
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
          $zapak=$this->db->update('tbl_student', $data_update);

              if($zapak!=0){
              redirect("dcadmin/student/view_student","refresh");
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

}

<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once(APPPATH . 'core/CI_finecontrol.php');
class Assignment extends CI_finecontrol{
function __construct()
{
parent::__construct();
$this->load->model("login_model");
$this->load->model("admin/base_model");
$this->load->library('user_agent');
}

public function view_assignment(){



$this->db->select('*');
$this->db->from('tbl_assignment');
$this->db->where('is_active',1);
$data['assignment_data']= $this->db->get();


if(!empty($this->session->userdata('admin_data'))){


$data['user_name']=$this->load->get_var('user_name');

$this->load->view('admin/common/header_view',$data);
$this->load->view('admin/assignment/view_assignment');
$this->load->view('admin/common/footer_view');

}
else{

redirect("login/admin_login","refresh");
}

}

public function add_assignment(){

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
     $this->load->view('admin/assignment/add_assignment');
     $this->load->view('admin/common/footer_view');

 }
 else{

    redirect("login/admin_login","refresh");
 }

 }

    public function add_assignment_data($t,$iw="")

      {

        if(!empty($this->session->userdata('admin_data'))){


    $this->load->helper(array('form', 'url'));
    $this->load->library('form_validation');
    $this->load->helper('security');
    if($this->input->post())
    {
      // print_r($this->input->post());
      // exit;
      $this->form_validation->set_rules('fname', 'fname', 'required|xss_clean');
      $this->form_validation->set_rules('assignment', 'assignment', 'required|xss_clean');
      $this->form_validation->set_rules('date', 'date', 'required|xss_clean');
      $this->form_validation->set_rules('word', 'Word', 'required|xss_clean');
      $this->form_validation->set_rules('total', 'total', 'required|xss_clean');
      $this->form_validation->set_rules('paid', 'paid', 'required|xss_clean');
      $this->form_validation->set_rules('pending', 'pending', 'required|xss_clean');


      if($this->form_validation->run()== TRUE)
      {
        $fname=$this->input->post('fname');
        $assignment=$this->input->post('assignment');
        $date=$this->input->post('date');
        $word=$this->input->post('word');
        $total=$this->input->post('total');
        $paid=$this->input->post('paid');
        $pending=$this->input->post('pending');


        $digits = 4;
        $das =rand(pow(10, $digits-1), pow(10, $digits)-1);
          $ip = $this->input->ip_address();
  date_default_timezone_set("Asia/Calcutta");
          $cur_date=date("Y-m-d H:i:s");

          $addedby=$this->session->userdata('admin_id');

        $this->load->library('upload');
          $image="";
            $img1='image';

              $file_check=($_FILES['image']['error']);
              if($file_check!=4){
            	$image_upload_folder = FCPATH . "assets/uploads/team/";
          						if (!file_exists($image_upload_folder))
          						{
          							mkdir($image_upload_folder, DIR_WRITE_MODE, true);
          						}
          						$new_file_name="team".date("Ymdhms");
          						$this->upload_config = array(
          								'upload_path'   => $image_upload_folder,
          								'file_name' => $new_file_name,
          								'allowed_types' =>'jpg|jpeg|png',
          								'max_size'      => 25000
          						);
          						$this->upload->initialize($this->upload_config);
          						if (!$this->upload->do_upload($img1))
          						{
          							$upload_error = $this->upload->display_errors();
          							// echo json_encode($upload_error);
          							echo $upload_error;
          						}
          						else
          						{

          							$file_info = $this->upload->data();

          							$image = "assets/uploads/team/".$new_file_name.$file_info['file_ext'];
          							// $file_info['new_name']=$videoNAmePath;
          							// $this->step6_model->updateappIconImage($imageNAmePath,$appInfoId);
          							$nnnn=$file_info['file_name'];
          							// echo json_encode($file_info);
          						}
              }

  $typ=base64_decode($t);
  if($typ==1){

  $data_insert = array('student'=>$fname,
            'digit'=>$das,
            'assignment_name'=>$assignment,
            'date' =>$date,
            'word_count' =>$word,
            'total_auount' =>$total,
            'paid_amount' =>$paid,
            'pending_amount' =>$pending,
            'image' =>$image,
            'ip' =>$ip,
            'added_by' =>$addedby,
            'is_active' =>1,
            // 'date'=>$cur_date

            );





  $last_id=$this->base_model->insert_table("tbl_assignment",$data_insert,1) ;

  }
  if($typ==2){

$idw=base64_decode($iw);

$data_insert = array('student'=>$fname,
          'digit'=>$das,
          'assignment_name'=>$assignment,
          'date' =>$date,
          'word_count' =>$word,
          'total_auount' =>$total,
          'paid_amount' =>$paid,
          'pending_amount' =>$pending,
          'image' =>$image,


            );

    $this->db->where('id', $idw);
    $last_id=$this->db->update('tbl_assignment', $data_insert);

  }


                      if($last_id!=0){

                      $this->session->set_flashdata('smessage','Data inserted successfully');

                      redirect("dcadmin/assignment/view_assignment","refresh");

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

  public function update_assignment($idd){

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
                      $id=base64_decode($idd);
                     $data['id']=$idd;

                     $this->db->select('*');
                                 $this->db->from('tbl_assignment');
                                 $this->db->where('id',$id);
                                 $dsa= $this->db->get();
                                 $data["assignment"]=$dsa->row();

                     $this->load->view('admin/common/header_view',$data);
                     $this->load->view('admin/assignment/update_assignment');
                     $this->load->view('admin/common/footer_view');

                 }
                 else{

                    redirect("login/admin_login","refresh");
                 }

                 }

public function delete_assignment($idd){

       if(!empty($this->session->userdata('admin_data'))){


         $data['user_name']=$this->load->get_var('user_name');

         // echo SITE_NAME;
         // echo $this->session->userdata('image');
         // echo $this->session->userdata('position');
         // exit;
                 									 $id=base64_decode($idd);

        if($this->load->get_var('position')=="Super Admin"){



                         									 $zapak=$this->db->delete('tbl_assignment', array('id' => $id));
                         									 if($zapak!=0){
                   // $path = FCPATH . "assets/public/slider/".$img;
                         										 // unlink($path);
                         								 	redirect("dcadmin/assignment/view_assignment","refresh");
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


             public function updateassignmentStatus($idd,$t){

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
                     $zapak=$this->db->update('tbl_assignment', $data_update);

                          if($zapak!=0){
                          redirect("dcadmin/assignment/view_assignment","refresh");
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
                       $zapak=$this->db->update('tbl_assignment', $data_update);

                           if($zapak!=0){
                             redirect("dcadmin/assignment/view_assignment","refresh");
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



                    		public function view_complete_assignment(){

                    										 if(!empty($this->session->userdata('admin_data'))){


                    											 $data['user_name']=$this->load->get_var('user_name');

                    											 // echo SITE_NAME;
                    											 // echo $this->session->userdata('image');
                    											 // echo $this->session->userdata('position');
                    											 // exit;
                    																	 $this->db->select('*');
                    											 $this->db->from('tbl_assignment');
                    											 $this->db->where('is_active',0);
                    											 $data['assignment_data']= $this->db->get();


                    											 $this->load->view('admin/common/header_view',$data);
                    											 $this->load->view('admin/assignment/view_complete_assignment');
                    											 $this->load->view('admin/common/footer_view');

                    									 }
              									 else{

                    											redirect("login/admin_login","refresh");
                    									 }
                                     }


         public function add_image(){

                          if(!empty($this->session->userdata('admin_data'))){


                            $data['user_name']=$this->load->get_var('user_name');

                            // echo SITE_NAME;
                            // echo $this->session->userdata('image');
                            // echo $this->session->userdata('position');
                            // exit;


                            $this->load->view('admin/common/header_view',$data);
                            $this->load->view('admin/assignment/add_image');
                            $this->load->view('admin/common/footer_view');

                        }
                        else{

                           redirect("login/admin_login","refresh");
                        }

                        }


            public function add_image_data($t,$iw="")

              {

                if(!empty($this->session->userdata('admin_data'))){


            $this->load->helper(array('form', 'url'));
            $this->load->library('form_validation');
            $this->load->helper('security');
            if($this->input->post())
            {
              // print_r($this->input->post());
              // exit;
              $this->form_validation->set_rules('null', 'null', 'xss_clean');


              if($this->form_validation->run()== TRUE)
              {
                $null=$this->input->post('null');


                  $ip = $this->input->ip_address();
          date_default_timezone_set("Asia/Calcutta");
                  $cur_date=date("Y-m-d H:i:s");

                  $addedby=$this->session->userdata('admin_id');


                  $this->load->library('upload');
                  $img="";
                      $img1='img';

                        $file_check=($_FILES['img']['error']);
                        if($file_check!=4){
                      	$image_upload_folder = FCPATH . "assets/uploads/team/";
                    						if (!file_exists($image_upload_folder))
                    						{
                    							mkdir($image_upload_folder, DIR_WRITE_MODE, true);
                    						}
                    						$new_file_name="team".date("Ymdhms");
                    						$this->upload_config = array(
                    								'upload_path'   => $image_upload_folder,
                    								'file_name' => $new_file_name,
                    								'allowed_types' =>'xlsx|csv|xls|pdf|doc|docx|txt|jpg|jpeg|png',
                    								'max_size'      => 25000
                    						);
                    						$this->upload->initialize($this->upload_config);
                    						if (!$this->upload->do_upload($img1))
                    						{
                    							$upload_error = $this->upload->display_errors();
                    							// echo json_encode($upload_error);
                    							echo $upload_error;
                    						}
                    						else
                    						{

                    							$file_info = $this->upload->data();

                    							$img = "assets/uploads/team/".$new_file_name.$file_info['file_ext'];
                    							$file_info['new_name']=$img;
                    							// $this->step6_model->updateappIconImage($imageNAmePath,$appInfoId);
                    							$nnnn=$file_info['file_name'];
                    							// echo json_encode($file_info);
                    						}
                        }

          $typ=base64_decode($t);
          if($typ==1){

          $data_insert = array('images'=>$img,
                    'null'=>$null,


                    );





          $last_id=$this->base_model->insert_table("tbl_assignment",$data_insert,1) ;

          }



                              if($last_id!=0){

                              $this->session->set_flashdata('smessage','Data inserted successfully');

                              redirect("dcadmin/assignment/view_complete_assignment","refresh");

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

}

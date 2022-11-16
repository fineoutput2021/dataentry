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
public function view_student(){

                 if(!empty($this->session->userdata('admin_data'))){


                   $data['user_name']=$this->load->get_var('user_name');
                               $this->db->select('*');
                   $this->db->from('tbl_student');
                   //$this->db->where('id',$usr);
                   $data['student_data']= $this->db->get();

                   // echo SITE_NAME;
                   // echo $this->session->userdata('image');
                   // echo $this->session->userdata('position');
                   // exit;


                   $this->load->view('admin/common/header_view',$data);
                   $this->load->view('dcadmin/student/view_student');
                   $this->load->view('admin/common/footer_view');

               }
               else{

                  redirect("login/admin_login","refresh");
               }

               }


  }

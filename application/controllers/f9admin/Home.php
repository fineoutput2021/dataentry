<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once(APPPATH . 'core/CI_finecontrol.php');
class Home extends CI_finecontrol{
function __construct()
		{
			parent::__construct();
			$this->load->model("login_model");
			$this->load->model("admin/base_model");
			$this->load->library('user_agent');
		}

		function index(){


			if(!empty($this->session->userdata('admin_data'))){


				$data['user_name']=$this->load->get_var('user_name');

				// echo SITE_NAME;

				$this->db->select('*');
				$this->db->from('tbl_assignment');
				// $this->db->where('student_shift',$cvf);
				$a= $this->db->count_all_results();


				$data['team']=$a;

				// echo $this->session->userdata('image');
				// echo $this->session->userdata('position');
			// exit;

			$this->db->select('*');
			$this->db->from('tbl_student');
			// $this->db->where('student_shift',$cvf);
			$b= $this->db->count_all_results();


			$data['team2']=$b;




			      			$this->db->select('*');
			$this->db->from('tbl_team');
			//$this->db->where('id',$usr);
			$data['']= $this->db->get();


			$this->load->view('admin/common/header_view',$data);

				$this->load->view('admin/dash');
				$this->load->view('admin/common/footer_view');

		}
		else{

				$this->load->view('admin/login/index');
		}

		}



}

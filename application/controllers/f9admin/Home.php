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

				// echo ;

					// code...

				$this->db->select('*');
				$this->db->from('tbl_assignment');

				$a= $this->db->count_all_results();


				$data['tyy']=$a;

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
			$c= $this->db->count_all_results();
			$data['teams']= $c;

			$fu_date = date('Y-m-d', strtotime('+2 days'));
			$this->db->select('*');
			$this->db->from('tbl_assignment');
			$this->db->where('deadline_date',$fu_date);
			$this->db->where('is_active',0);
			$data['deadline_date']= $this->db->get();


			$this->load->view('admin/common/header_view',$data);

				$this->load->view('admin/dash');
				$this->load->view('admin/common/footer_view');

		}
		else{

				$this->load->view('admin/login/index');
		}

		}



}

<?php defined('BASEPATH') or exit('No direct script access allowed');

class Petugas extends CI_Controller
{

	function __construct(){
        parent::__construct();
        check_not_petugas();
        $this->load->library('form_validation');
    }

	public function petugasDashboard()
	{   
		// $data['data1'] = $this->data_m->get();
		$this->load->view('petugas/dashboard');
    }
      
	
}


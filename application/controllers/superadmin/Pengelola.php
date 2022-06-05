<?php defined('BASEPATH') or exit('No direct script access allowed');
class pengelola extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Pengelola_m');
        $this->load->helper(array('form','url'));
        $this->load->library(array('form_validation'));	
    }
    function index()
    {
        $data['title'] = 'pengelola';
     
        $this->load->view('pengelola/pengelolaData');
    }


    public function getPengelola(){
        $data = $this->Pengelola_m->get()->result();
 
        echo json_encode($data);             
    }

    public function getpengelolaID(){
        $getId = $this->input->get('id');
        $data = $this->Pengelola_m->get($getId)->row();
        echo json_encode($data);             
    }

    public function add(){
     
		$this->form_validation->set_rules('pengelolaNama', 'Nama', 'required');
		$this->form_validation->set_rules('pengelolaTelepon', 'Telepon', 'required');
		$this->form_validation->set_rules('pengelolaUsername', 'Username', 'required|min_length[5]|is_unique[tb_pengelola.pengelolaUsername]');
		$this->form_validation->set_rules('pengelolaPassword', 'Password', 'required|min_length[5]');
		$this->form_validation->set_rules('pengelolaAlamat', 'Alamat', 'required');

        $this->form_validation->set_message('required', '%s masih Kososng, atau belum di pilih Silahkan Di isi');
        $this->form_validation->set_message('min_length', '{field} minimal 5 karakter');
        $this->form_validation->set_message('is_unique', '{field} ini sudah dipakai, silahkan ganti');
 
        if($this->form_validation->run() == FALSE){
			$response = array(
                'status' 			 => 'error',
				'pengelolaNama' 	 => form_error('pengelolaNama'),
				'pengelolaTelepon'   => form_error('pengelolaTelepon'),
				'pengelolaUsername'  => form_error('pengelolaUsername'),
				'pengelolaPassword'  => form_error('pengelolaPassword'),
				'pengelolaAlamat'    => form_error('pengelolaAlamat')
				// 'message' => validation_errors()
			);
		} 
		else{
			$post = $this->input->post(null, TRUE);
			$data=$this->Pengelola_m->add($post);
			$response = array(
				'status' 	=> 'success',
				'message'   => "<h3>Success Message</h3>"
			);
		}

		$this->output
			->set_content_type('aplication/json')
			->set_output(json_encode($response));	
    }
    

    function edit(){

		$this->form_validation->set_rules('editpengelolaNama', 'Nama', 'required');
		$this->form_validation->set_rules('editpengelolaTelepon', 'Telepon', 'required');
		// $this->form_validation->set_rules('editpengelolaUsername', 'Username', 'required|min_length[5]|callback_username_check');
		$this->form_validation->set_rules('editpengelolaAlamat', 'Alamat', 'required');

		if($this->input->post('editpengelolaPassword')){
            $this->form_validation->set_rules('editpengelolaPassword', 'Password', 'min_length[5]');
            
        }
		
		$this->form_validation->set_message('required', '%s masih Kososng, Silahkan Di isi');
		$this->form_validation->set_message('min_length', '{field} minimal 5 karakter');
		$this->form_validation->set_message('is_unique', '{field} ini sudah dipakai, silahkan ganti');
		
		if($this->form_validation->run() == FALSE){
			$response = array(
                'status' 				=> 'error',
				'editpengelolaNama' 		=> form_error('editpengelolaNama'),
				'editpengelolaTelepon'   => form_error('editpengelolaTelepon'),
				'editpengelolaUsername'  => form_error('editpengelolaUsername'),
				'editpengelolaPassword'  => form_error('editpengelolaPassword'),
				'editpengelolaAlamat'    => form_error('editpengelolaAlamat')
				// 'message' => validation_errors()
			);  
        } else{
			$post = $this->input->post(null, TRUE);
        	$data=$this->Pengelola_m->edit($post);
			$response = array(
				'status' => 'success',
				'message' => "<h3>Success Message</h3>"
			);
		}
		$this->output
			->set_content_type('aplication/json')
			->set_output(json_encode($response));
    }

    function del(){
        $pengelolaID=$this->input->post('pengelolaID');
        $data=$this->Pengelola_m->del($pengelolaID);
        echo json_encode($data);
	}
    
}

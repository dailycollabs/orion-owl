<?php defined('BASEPATH') or exit('No direct script access allowed');
class Karyawan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model(['Bidang_m', 'Pengguna_m', 'Subbidang_m']);
        $this->load->helper(array('form','url'));
        $this->load->library(array('form_validation'));	
    }
    function index()
    {
        $data['title'] = 'Pengguna';
        $data['data'] = $this->Bidang_m->get();
        $this->load->view('superadmin/karyawan', $data);
    }

    public function cekSubbidang(){
        $bidangID = $this->input->get('id');
        $data = $this->Subbidang_m->getSubbidang($bidangID)->result();
        echo json_encode($data);
    }

    public function getPengguna(){
        $data = $this->Pengguna_m->getAll();
        $array = array();
        foreach($data->result() as $row){
            $rowBidang = $this->Bidang_m->get($row->bidangID)->row();

            $array[] = array(
                'penggunaID'          => $row->penggunaID,
                'penggunaNPWP'        => $row->penggunaNPWP,
                'penggunaNama'        => $row->penggunaNama,
                'penggunaUsername'    => $row->penggunaUsername,
                'penggunaPassword'    => $row->penggunaPassword,
                'penggunaGender'      => $row->penggunaGender,
                'penggunaNoTelepon'   => $row->penggunaNoTelepon,
                'penggunaAlamat'      => $row->penggunaAlamat,
                // 'subbidangPenggunaID' => $row->penggunaSubbidangID,
                // 'subbidangNama'       => $row->subbidangNama,
                'bidangID'            => $row->bidangID,
                'bidangNama'          => $rowBidang->bidangNama
            ); 
        }
        echo json_encode($array);             
    }

    public function getPenggunaID(){
        $getId = $this->input->get('id');
        $data = $this->Pengguna_m->getAll($getId)->row();
        echo json_encode($data);             
    }

    public function add(){
        $this->form_validation->set_rules('subbidang', 'Bidang', 'required');
        $this->form_validation->set_rules('penggunanpwp', 'NPWP', 'required');
		$this->form_validation->set_rules('penggunaNama', 'Nama', 'required');
		$this->form_validation->set_rules('penggunaTelepon', 'Telepon', 'required');
		$this->form_validation->set_rules('penggunaUsername', 'Username', 'required|min_length[5]|is_unique[tb_pengguna.penggunaUsername]');
		$this->form_validation->set_rules('penggunaPassword', 'Password', 'required|min_length[5]');
		$this->form_validation->set_rules('penggunaAlamat', 'Alamat', 'required');

        $this->form_validation->set_message('required', '%s masih Kososng, atau belum di pilih Silahkan Di isi');
        $this->form_validation->set_message('min_length', '{field} minimal 5 karakter');
        $this->form_validation->set_message('is_unique', '{field} ini sudah dipakai, silahkan ganti');
 
        if($this->form_validation->run() == FALSE){
			$response = array(
                'status' 			=> 'error',
                'subbidang' 		=> form_error('subbidang'),
                'penggunanpwp' 		        => form_error('penggunanpwp'),
				'penggunaNama' 		=> form_error('penggunaNama'),
				'penggunaTelepon'   => form_error('penggunaTelepon'),
				'penggunaUsername'  => form_error('penggunaUsername'),
				'penggunaPassword'  => form_error('penggunaPassword'),
				'penggunaAlamat'    => form_error('penggunaAlamat')
				// 'message' => validation_errors()
			);
		} 
		else{
			$post = $this->input->post(null, TRUE);
			$data=$this->Pengguna_m->add($post);
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
        $this->form_validation->set_rules('editSubbidang', 'Bidang', 'required');
        $this->form_validation->set_rules('editpenggunaNPWP', 'NPWP', 'required');
		$this->form_validation->set_rules('editpenggunaNama', 'Nama', 'required');
		$this->form_validation->set_rules('editpenggunaTelepon', 'Telepon', 'required');
		// $this->form_validation->set_rules('editpenggunaUsername', 'Username', 'required|min_length[5]|callback_username_check');
		$this->form_validation->set_rules('editpenggunaAlamat', 'Alamat', 'required');

		if($this->input->post('editpenggunaPassword')){
            $this->form_validation->set_rules('editpenggunaPassword', 'Password', 'min_length[5]');
            
        }
		
		$this->form_validation->set_message('required', '%s masih Kososng, Silahkan Di isi');
		$this->form_validation->set_message('min_length', '{field} minimal 5 karakter');
		$this->form_validation->set_message('is_unique', '{field} ini sudah dipakai, silahkan ganti');
		
		if($this->form_validation->run() == FALSE){
			$response = array(
                'status' 				=> 'error',
                'editSubbidang' 		=> form_error('editSubbidang'),
				'editpenggunaNama' 		=> form_error('editpenggunaNama'),
				'editpenggunaTelepon'   => form_error('editpenggunaTelepon'),
				'editpenggunaUsername'  => form_error('editpenggunaUsername'),
				'editpenggunaPassword'  => form_error('editpenggunaPassword'),
				'editpenggunaAlamat'    => form_error('editpenggunaAlamat')
				// 'message' => validation_errors()
			);  
        } else{
			$post = $this->input->post(null, TRUE);
        	$data=$this->Pengguna_m->edit($post);
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
        $penggunaID=$this->input->post('penggunaID');
        $data=$this->Pengguna_m->del($penggunaID);
        echo json_encode($data);
	}
    
}

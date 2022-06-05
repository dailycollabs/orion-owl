<?php defined('BASEPATH') or exit('No direct script access allowed');
class petugas extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model(['Bidang_m', 'Petugas_m', 'Subbidang_m']);
        $this->load->helper(array('form','url'));
        $this->load->library(array('form_validation'));	
    }
    function index()
    {
        $data['title'] = 'petugas';
        $data['data'] = $this->Bidang_m->get();
        $data['data1'] = $this->Subbidang_m->get();
        $this->load->view('pengelola/petugasData', $data);
    }

    public function cekSubbidang(){
        $bidangID = $this->input->get('id');
        $data = $this->Subbidang_m->getSubbidang($bidangID)->result();
        echo json_encode($data);
    }

    public function getpetugas(){
        $data = $this->Petugas_m->getAll();
        $array = array();
        foreach($data->result() as $row){
            $rowBidang = $this->Bidang_m->get($row->bidangID)->row();

            $array[] = array(
                'petugasID'          => $row->petugasID,
                'petugasNPWP'        => $row->petugasNPWP,
                'petugasNama'        => $row->petugasNama,
                'petugasUsername'    => $row->petugasUsername,
                'petugasPassword'    => $row->petugasPassword,
                'petugasGender'      => $row->petugasGender,
                'petugasTelepon'   => $row->petugasTelepon,
                'petugasAlamat'      => $row->petugasAlamat,
                // 'subbidangpetugasID' => $row->petugasSubbidangID,
                'subbidangNama'       => $row->subbidangNama,
                'subidangrules'  => $row->subidangrules,
                'bidangID'           => $row->bidangID,
                'bidangNama'         => $rowBidang->bidangNama
            ); 
        }
        echo json_encode($array);             
    }

    public function getpetugasID(){
        $getId = $this->input->get('id');
        $data = $this->Petugas_m->getAll($getId)->row();
        echo json_encode($data);             
    }

    public function add(){
        $this->form_validation->set_rules('subbidang', 'Bidang', 'required');
        $this->form_validation->set_rules('petugasnpwp', 'NPWP', 'required');
		$this->form_validation->set_rules('petugasNama', 'Nama', 'required');
		$this->form_validation->set_rules('petugasTelepon', 'Telepon', 'required');
		$this->form_validation->set_rules('petugasUsername', 'Username', 'required|min_length[5]|is_unique[tb_petugas.petugasUsername]');
		$this->form_validation->set_rules('petugasPassword', 'Password', 'required|min_length[5]');
		$this->form_validation->set_rules('petugasAlamat', 'Alamat', 'required');

        $this->form_validation->set_message('required', '%s masih Kososng, atau belum di pilih Silahkan Di isi');
        $this->form_validation->set_message('min_length', '{field} minimal 5 karakter');
        $this->form_validation->set_message('is_unique', '{field} ini sudah dipakai, silahkan ganti');
 
        if($this->form_validation->run() == FALSE){
			$response = array(
                'status' 			=> 'error',
                'subbidang' 		=> form_error('subbidang'),
                'petugasnpwp' 		        => form_error('petugasnpwp'),
				'petugasNama' 		=> form_error('petugasNama'),
				'petugasTelepon'   => form_error('petugasTelepon'),
				'petugasUsername'  => form_error('petugasUsername'),
				'petugasPassword'  => form_error('petugasPassword'),
				'petugasAlamat'    => form_error('petugasAlamat')
				// 'message' => validation_errors()
			);
		} 
		else{
			$post = $this->input->post(null, TRUE);
			$data=$this->Petugas_m->add($post);
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
        $this->form_validation->set_rules('editpetugasNPWP', 'NPWP', 'required');
		$this->form_validation->set_rules('editpetugasNama', 'Nama', 'required');
		$this->form_validation->set_rules('editpetugasTelepon', 'Telepon', 'required');
		// $this->form_validation->set_rules('editpetugasUsername', 'Username', 'required|min_length[5]|callback_username_check');
		$this->form_validation->set_rules('editpetugasAlamat', 'Alamat', 'required');

		if($this->input->post('editpetugasPassword')){
            $this->form_validation->set_rules('editpetugasPassword', 'Password', 'min_length[5]');
            
        }
		
		$this->form_validation->set_message('required', '%s masih Kososng, Silahkan Di isi');
		$this->form_validation->set_message('min_length', '{field} minimal 5 karakter');
		$this->form_validation->set_message('is_unique', '{field} ini sudah dipakai, silahkan ganti');
		
		if($this->form_validation->run() == FALSE){
			$response = array(
                'status' 				=> 'error',
                'editSubbidang' 		=> form_error('editSubbidang'),
				'editpetugasNama' 		=> form_error('editpetugasNama'),
				'editpetugasTelepon'   => form_error('editpetugasTelepon'),
				'editpetugasUsername'  => form_error('editpetugasUsername'),
				'editpetugasPassword'  => form_error('editpetugasPassword'),
				'editpetugasAlamat'    => form_error('editpetugasAlamat')
				// 'message' => validation_errors()
			);  
        } else{
			$post = $this->input->post(null, TRUE);
        	$data=$this->Petugas_m->edit($post);
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
        $petugasID=$this->input->post('petugasID');
        $data=$this->Petugas_m->del($petugasID);
        echo json_encode($data);
    }
    
    public function username_check(){
        $post = $this->input->post(null, TRUE);
        $query = $this->db->query("SELECT * FROM user WHERE username = '$post[username]' AND user_id != '$post[user_id]'");
        if($query->num_rows() > 0){
            $this->form_validation->set_message('username_check', '{field} ini sudah di pakai, silahkan ganti');
            return FALSE;

        }
        else{
            return TRUE;
        }
    }
    
}

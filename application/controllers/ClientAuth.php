<?php defined('BASEPATH') OR exit('No direct script access allowed');

class ClientAuth extends CI_Controller {
	
    //Menampilkan Halaman Login
	public function login(){
		check_already_login_client();
		$this->load->view('client/login');
	}

    //Proses Auth Login
	public function process(){
		$post = $this->input->post(null, TRUE);
		
		if(isset($post['login'])){
			$this->load->model('Client_m');
			$query = $this->Client_m->login($post);
			
			if($query->num_rows()>0){
				$row = $query->row();
				$params = array(
					'clientID' => $row->clientID,
					// 'hakAksesID'  => $row->hakAksesID
				);
				$this->session->set_userdata($params);
				echo "<script>
						alert('Selamat, Login Berhasil');
						window.location='".site_url('Client/clientDashboard')."';
					</script>";
			}
			else{
				echo "<script>
						alert('Login Gagal, Username/Password Salah');
						window.location='".site_url('ClientAuth/login')."';
					</script>";
			}
		}
	}

    //Logout Client
	public function logout(){
		$params = array('clientID');
		$this->session->unset_userdata($params);
		redirect('ClientAuth/login');

	}

	//Menampilkan Tampilan Registrasi
    public function registrasi(){
		$this->load->view('client/registrasi');
	}
    
    //Menampilkan Data Registrasi Client
    public function add(){
		// $post = $this->input->post(null, TRUE);
		$this->load->model(['Client_m']);
		$this->load->library('form_validation');
		$response = array();
        $this->form_validation->set_rules('npwp', 'npwp', 'required|is_unique[tb_client.clientNPWP]');
        $this->form_validation->set_rules('fullname', 'nama', 'required');
        $this->form_validation->set_rules('username', 'username', 'required|min_length[5]|is_unique[tb_client.clientUsername]');
        $this->form_validation->set_rules('password', 'password', 'required|min_length[5]');
		// $this->form_validation->set_rules('passconf', 'Konfirmasi Password', 'required|matches[password]');
		$this->form_validation->set_rules('tglLahir', 'tgl Lahir', 'required');
		$this->form_validation->set_rules('jenisKelamin', 'jenis Kelamin', 'required');
		$this->form_validation->set_rules('noTelepon', 'no Telepon', 'required');
		$this->form_validation->set_rules('email', 'email', 'required');

        $this->form_validation->set_message('required', '%s masih Kososng, Silahkan Di isi');
        $this->form_validation->set_message('min_length', '{field} minimal 5 karakter');
        $this->form_validation->set_message('is_unique', '{field} ini sudah dipakai, silahkan ganti');
        $this->form_validation->set_message('matches', '%s Tidak sesuai dengan passwordi');
        // // $this->form_validation->set_error_delimiters('<span class="help-block>', '</span>');

        if($this->form_validation->run() == FALSE){
            $response = array(
                'status' 			=> 'error',
                'npwp' 				=> form_error('npwp'),
                'fullname' 			=> form_error('fullname'),
				'username' 			=> form_error('username'),
				'password'   		=> form_error('password'),
				'tglLahir'  		=> form_error('tglLahir'),
				'jenisKelamin'  	=> form_error('jenisKelamin'),
				'noTelepon'  		=> form_error('noTelepon'),
				'email'    			=> form_error('email'),
			);
            
        }
        else{
			// $post = $this->input->post(null, TRUE);
			$npwp 			= $this->input->post('npwp');
			$fullname 		= $this->input->post('fullname');
			$username 		= $this->input->post('username');
			$password 		= $this->input->post('password');
			$tglLahir 		= $this->input->post('tglLahir');
			$jenisKelamin 	= $this->input->post('jenisKelamin');
			$noTelepon 		= $this->input->post('noTelepon');
			$email 			= $this->input->post('email');
			
			date_default_timezone_set("Asia/Jakarta");
			$date    	= date("Y-m-d");
			$npwpID    	= substr($npwp, 0, 3);
			$tahun   	= substr($date, 0, 2);
			$bulan   	= substr($date, 5, 2);
			$hari    	= substr($date, 8, 2);
			$client   	= $this->Client_m->getMax()->row(); 
			$clientID 	= (int) substr($client->clientID, 9, 4);
			$clientID++;
			$clientNewID = $tahun.$bulan.$hari.$npwpID.sprintf("%04s", $clientID);



			$postSend = array(
				'id'  					=> $clientNewID,
				'npwp'  				=> $npwp,
				'fullname'  			=> $fullname,
				'username'  			=> $username,
				'password'  			=> $password,
				'tglLahir'  			=> $tglLahir,
				'jenisKelamin'  		=> $jenisKelamin,
				'noTelepon'  			=> $noTelepon,
				'email'  				=> $email,
				'clientFoto'  			=> 'default.jpg',
			);
			

            $this->Client_m->add($postSend);
            if($this->db->affected_rows() > 0){
				$response = array(
					'status' 		=> 'success',
				);
            }
			
		}
		
		$this->output
			->set_content_type('aplication/json')
			->set_output(json_encode($response));	
        
    }
}

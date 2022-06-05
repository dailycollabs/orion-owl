<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function login(){
		// check_already_login();
		$this->load->view('pengelola/login');
	}

	public function process(){
		$post = $this->input->post(null, TRUE);
		
		if(isset($post['login'])){
            echo "Login Berhasil";
			$this->load->model('pengelola_m');
            $query = $this->pengelola_m->login($post);

            // echo json_encode($query);
            
			
			if($query->num_rows()>0){
				$row = $query->row();
				$params = array(
					'pengelolaID' => $row->pengelolaID,
					// 'hakAksesID'  => $row->hakAksesID
				);
				$this->session->set_userdata($params);
				echo "<script>
						alert('Selamat, Login Berhasil');
						window.location='".site_url('superadmin/dashboard')."';
					</script>";
			}
			else{
				echo "<script>
						alert('Login Gagal, Username/Password Salah');
						window.location='".site_url('auth/login')."';
					</script>";
			}
		}
	}

	public function logout(){
		$params = array('pengelolaID');
		$this->session->unset_userdata($params);
		redirect('superadmin/auth/login');

	}
}

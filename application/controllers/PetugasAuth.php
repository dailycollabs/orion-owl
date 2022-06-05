<?php defined('BASEPATH') OR exit('No direct script access allowed');

class PetugasAuth extends CI_Controller {

	public function login(){
		check_already_login_petugas();
		$this->load->view('petugas/login');
	}

	public function process(){
		$post = $this->input->post(null, TRUE);
		
		if(isset($post['login'])){
			$this->load->model('Petugas_m');
            $query = $this->Petugas_m->login($post);

			// echo json_encode($query);
		
			if($query->num_rows()>0){
				// echo "Login Berhasil";
				$row = $query->row();
				$params = array(
					'petugasID' => $row->petugasID,
					// 'hakAksesID'  => $row->hakAksesID
				);
				$this->session->set_userdata($params);
				echo "<script>
						alert('Selamat, Login Berhasil');
						window.location='".site_url('Petugas/petugasDashboard')."';
					</script>";
			}
			else{
				echo "<script>
						alert('Login Gagal, Username/Password Salah');
						window.location='".site_url('PetugasAuth/login')."';
					</script>";
			}
		}
	}

	public function logout(){
		$params = array('petugasID');
		$this->session->unset_userdata($params);
		redirect('PetugasAuth/login');

	}
}

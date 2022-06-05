<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Client extends CI_Controller {

    function __construct(){
        parent::__construct();
        check_not_login_client();
        $this->load->model(['Bidang_m', 'Client_m','ClientProject_m', 'InvoiceFinalClient_m']);
        $this->load->library('form_validation');
        $this->load->helper(array('form', 'url'));
    }

    //Menampilkan Tampilan Client Biodata
    public function clientDashboard(){
		$this->load->view('client/clientDashboard');
    }
    
   

	public function index(){        
        $data['row'] = $this->Client_m->get();
		// $this->template->load('template', 'client/registrasi', $data);
    }

    //Menampilkan Tampilan Client Biodata
    public function clientBiodata(){
		$this->load->view('client/clientBiodata');
	}
 
    //Menampilkan Tampilan Client Profil
    public function profil(){
        $this->load->view('client/profil');
    }

    //Menampilkan Tampilan Client Profil
    public function profilClient(){
        $this->load->view('client/profil');
    }

    //Edit Data Client
    public function edit(){
		$post = $this->input->post(null, TRUE);
		$response = array();
        $this->form_validation->set_rules('npwp', 'npwp', 'required');
        $this->form_validation->set_rules('fullname', 'fullname', 'required');
        $this->form_validation->set_rules('username', 'username', 'required|min_length[5]');
        $this->form_validation->set_rules('password', 'password', 'required|min_length[5]');
		$this->form_validation->set_rules('tglLahir', 'tgl Lahir', 'required');
		$this->form_validation->set_rules('jenisKelamin', 'jenis Kelamin', 'required');
		$this->form_validation->set_rules('noTelepon', 'no Telepon', 'required');
        $this->form_validation->set_rules('email', 'email', 'required');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required');
		$this->form_validation->set_rules('namaPerusahaan', 'Nama Perusahaan', 'required');
		$this->form_validation->set_rules('jabatanPerusahaan', 'Jabatan Perusahaan', 'required');
        $this->form_validation->set_rules('emailPerusahaan', 'Email Perusahaan', 'required');
        $this->form_validation->set_rules('teleponPerusahaan', 'Telepon Perusahaan', 'required');
		$this->form_validation->set_rules('alamatPerusahaan', 'Alamat Perusahaan', 'required');

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
                'alamat' 			=> form_error('alamat'),
                'namaPerusahaan' 	=> form_error('namaPerusahaan'),
				'jabatanPerusahaan' => form_error('jabatanPerusahaan'),
				'emailPerusahaan'   => form_error('emailPerusahaan'),
				'teleponPerusahaan' => form_error('teleponPerusahaan'),
				'alamatPerusahaan'  => form_error('alamatPerusahaan'),
			);
            
        }
        else{
            // $post = $this->input->post(null, TRUE);
            $clientID           = $this->input->post('clientID');
			$npwp 			    = $this->input->post('npwp');
			$fullname 		    = $this->input->post('fullname');
			$username 		    = $this->input->post('username');
			$password 		    = $this->input->post('password');
			$tglLahir 		    = $this->input->post('tglLahir');
			$jenisKelamin 	    = $this->input->post('jenisKelamin');
			$noTelepon 		    = $this->input->post('noTelepon');
            $email 			    = $this->input->post('email');
            $alamat 		    = $this->input->post('alamat');
            $fprofil_old 		= $this->input->post('fprofil_old');   
			$namaPerusahaan 	= $this->input->post('namaPerusahaan');
			$jabatanPerusahaan 	= $this->input->post('jabatanPerusahaan');
			$emailPerusahaan 	= $this->input->post('emailPerusahaan');
			$teleponPerusahaan 	= $this->input->post('teleponPerusahaan');
            $alamatPerusahaan 	= $this->input->post('alamatPerusahaan');

            if (!empty($_FILES["fprofil"]["name"])) {
                $file = $this->uploadImage();
                if($file['status'] == true){
                    if($file['name'] != null){
                        $clientFoto = $file['name']; 
                    } 
                } else{
                    $response = array(
                        'status' 	    => 'error-upload',
                        'quoFile'       => 'tidak Bisa Upload File, Silahkan Di cek Kembali Filenya'
                    );
                }
            } else {
                $clientFoto  = $fprofil_old;
            }

			$postSend = array(
                'clientID'  		    => $clientID,
				'npwp'  				=> $npwp,
				'fullname'  			=> $fullname,
                'username'  			=> $username,
                'password'  			=> $password,                
				'tglLahir'  			=> $tglLahir,
				'jenisKelamin'  		=> $jenisKelamin,
				'noTelepon'  			=> $noTelepon,
                'email'  				=> $email,
                'alamat'  			    => $alamat,
                'clientFoto'            => $clientFoto,
				'namaPerusahaan'  	    => $namaPerusahaan,
				'jabatanPerusahaan'  	=> $jabatanPerusahaan,
				'emailPerusahaan'  		=> $emailPerusahaan,
				'teleponPerusahaan'  	=> $teleponPerusahaan,
				'alamatPerusahaan'  	=> $alamatPerusahaan,
            );

            $this->Client_m->edit($postSend);
            if($this->db->affected_rows() > 0){
				$response = array(
					'status' 		=> 'success',
				);
            }	
		}
        echo json_encode($response);
        
    }

    //////////////////////Client Project/////////////////////////
    
    //Menampilkan Halaman Client Project
    public function clientProject(){
        $data['data'] = $this->Bidang_m->get();
		$this->load->view('client/clientProject', $data);
    }

    //Menampilkan Data Client Project
    public function getProjectClient(){
        $clientID = $this->fungsi->client_login()->clientID;  
        $data  = $this->ClientProject_m->getAllByClientID($clientID)->result();
        foreach($data as $row){
            if($row->status == 'success'){
                $xStatus = 'SUCCESS';
            }else{
                $xStatus = 'PROSES';
            }

            if($row->projectbidangID == 1){
                $bidangNama = 'Marine';
            }else{
                $bidangNama = 'Minerba';
            }

            $arrayData[] = array(
               'projectID'  => $row->projectID,
               'bidangID'   => $row->projectbidangID,
               'bidangNama' => $bidangNama,
               'statusID'   => $row->project_statusID,
               'statusAll'  => $xStatus,
               'projectID'  => $row->projectID,
               'waktu'      => $row->waktu,

            );
            
        }
		echo json_encode($arrayData);
    }

    //Menampilkan Detail Data Client Project
    public function viewDetailProject($id){
        $data['row']  = $this->ClientProject_m->getAllID($id)->row();

        if($data['row']->status == 'success'){
            $data['rowStatus'] = 'SUCCESS';
        }else{
            $data['rowStatus'] = 'PROSES';
        }

        if($data['row']->projectbidangID == 1){
            $data['rowBidang'] = 'Marine';
            $data['rowFinalClientProject'] = $this->InvoiceFinalClient_m->getAllMarineByclientProjectID($id)->row();
            if($data['rowFinalClientProject'] != null){
                if($data['rowFinalClientProject']->invMarStatusKonf != 'read'){
                    $dataQuoDetail['statusConf']   = 'read';
                    $dataQuoDetail['invMarFinalID']   = $data['rowFinalClientProject']->invMarFinalID;
                    $this->InvoiceFinalClient_m->setMarStatusKonf($dataQuoDetail);
                }  
            }
            
        }else if($data['row']->projectbidangID == 2){
            $data['rowBidang'] = 'Minerba';
            $data['rowFinalClientProject'] = $this->InvoiceFinalClient_m->getAllMinerbaByclientProjectID($id)->row();
            if($data['rowFinalClientProject'] != null){
                if($data['rowFinalClientProject']->invMinFStatusKonf != 'read'){
                    $dataQuoDetail['statusConf']   = 'read';
                    $dataQuoDetail['invMinFinalID']   = $data['rowFinalClientProject']->invMinFinalID;
                    $this->InvoiceFinalClient_m->setMinStatusKonf($dataQuoDetail);
                }
            }
        }
        $this->load->view('client/projectDetail', $data);
        // echo json_encode($data); 
    }

    //Menampilkan Halaman Client Project New
    public function viewClientProjectNew(){
        $this->load->view('client/project_new');
    }

    //Menampilkan Data Client Project New
    public function getClientProjectNew(){
        $arrayData = array();
        $clientID = $this->fungsi->client_login()->clientID;  
        $dataMarine = $this->InvoiceFinalClient_m->getAllNewMarine($clientID)->result();
        if($dataMarine != null){
            foreach($dataMarine as $row1){
                $arrayData[] = array(
                    'projectFinishID'  => $row1->invMarFinalID,
                    'projectID'        => $row1->invMarF_clientProjectID,
                    'bidang'           => 'Marine',
                    'status'           => 'Succcess',
                    'waktu'            => $row1->invMarFWaktu,
                );
                
            }
        }
        
        $dataMinerba = $this->InvoiceFinalClient_m->getAllNewMinerba($clientID)->result();
        if($dataMinerba != null){
            foreach($dataMinerba as $row2){
                $arrayData[] = array(
                    'projectFinishID'  => $row2->invMinFinalID,
                    'projectID'        => $row2->invMinF_clientProjectID,
                    'bidang'           => 'Minerba',
                    'status'           => 'Succcess',
                    'waktu'            => $row2->invMinFWaktu,
                );
                
            }
        }
        $this->output->set_content_type('application/json');
        echo json_encode($arrayData);

        
    }

    public function KonfClientProject($id){
        $this->load->view('client/project_new');
    }


    //Menampilkan Data Client Project Berdasarkan Bidang
    public function clientProjectBidang($id){
        $data['data'] = $this->Bidang_m->get($id)->row();
        if($data['data']->bidangID == 1 || $data['data']->bidangID == 2){
            $this->load->view('client/clientProjectUpload', $data);
        }else{
            echo "<script>
            alert('Maaf ID yang Di Masukan Salah');
            window.location='".site_url('Client/clientDashboard')."';
            </script>";
        }
		
    }

    //Menambahkan Data Client Project
    public function addProject(){
        $response = array(); 
        $this->form_validation->set_rules('bidangID', 'bidangID', 'required');
        if($this->input->post('projectFile')){
            $this->form_validation->set_rules('projectFile', 'projectFile', 'callback_file_selected_test');
        }
        $this->form_validation->set_message('required', '%s masih Kososng, atau belum di pilih Silahkan Di isi');
        if($this->form_validation->run() == FALSE){
            $response = array(
                'status' 	    => 'error',
                'bidangID' 		=> form_error('bidangID'),
                'projectFile' 	=> form_error('projectFile'),
            );   
        } 
        else{
    
            $post['bidangID'] = $this->input->post('bidangID');   
            $post['comment']  = $this->input->post('comment');  
            $post['clientID'] = $this->fungsi->client_login()->clientID;             
            $file             = $this->upload($post);
            
            if($file['status'] == true){
                $post['projectFile'] = $file['name']; 

                ////////////Create ID//////////
                date_default_timezone_set("Asia/Jakarta");
                if($this->input->post('bidangID') == 1){
                    $bidang = 'MAR';
                }else if($this->input->post('bidangID') == 2){
                    $bidang = 'MIN';
                }
                $char      = 'PRJ';
                $date      = date("Y-m-d");
                $tahun     = substr($date, 0, 2);
                $bulan     = substr($date, 5, 2);
                $hari      = substr($date, 8, 2);
                $clientID  = $this->ClientProject_m->getPrjMaxByBidang($bidang)->row();
                $projectID = (int) substr($clientID->projectID, 12, 4);
                $projectID++;
                $PROJID    = $char.$bidang.$tahun.$bulan.$hari.sprintf("%04s", $projectID);
                /////////////Create ID////////////

                $post1 = array(     
                    'id'          => $PROJID,
                    'clientID'    => $post['clientID'],
                    'bidangID'    => $post['bidangID'],
                    'projectFile' => $post['projectFile'],
                    'status'      => 'PR1',
                    'comment'     => $post['comment']
                );

                $this->ClientProject_m->addProject($post1);
                if($this->db->affected_rows()>0){ 
                    $response = array(
                        'status' 	    => 'success',
                    );
                }
            } else{
                $response = array(
                    'status' 	    => 'error-upload',
                    'projectFile'       => 'tidak Bisa Upload File, Silahkan Di cek Kembali Filenya'
                );
            }
        }
        $this->output->set_content_type('application/json');
        echo json_encode($response);  
       
    }

    function file_selected_test(){
        if(!empty($_FILES['projectFile']['name']) != null) {
            return TRUE;
        }
        else{
            $this->form_validation->set_message('file_selected_test', '%s masih Kososng, Silahkan Upload File Project');
            return FALSE;
        }
    }

    //Upload Document Client Project
    public function upload($post){
        if($post['bidangID'] == 1){
            $bidangNama = 'Marine';
        }else if($post['bidangID'] == 2){
            $bidangNama = 'Minerba';
        }
        $config['upload_path']     =  './uploads/clientFile/'.$bidangNama;
        $config['allowed_types']   = 'pdf';
        $config['max_size']        = 2048;
        $config['file_name']       = 'projectClient-'.date('ymd').'-'.substr(md5(rand()),0,10);

        $this->load->library('upload', $config);
        $post = $this->input->post(null, TRUE);
        if(isset($_FILES['projectFile']['name']) != null){
            if($this->upload->do_upload('projectFile')){
                $file_name = $this->upload->data('file_name');
                $data['name'] = $file_name;
                $data['status'] = TRUE;
                return $data;
            } else {
                $data['status'] = FALSE;
                $data['error'] = "data tidak masuk";
                return $data;
            }
        }      
    }

    //Upload Foto Profil Client
    public function uploadImage(){
        $config['upload_path']     = './uploads/clientFile/clientFoto/';
        $config['allowed_types']   = 'gif|jpg|png|jpeg';
        $config['max_size']        = 1000;
        $config['max_width']       = 1024;
        $config['max_height']      = 768;
        $config['file_name']       = 'profil-'.date('ymd').'-'.substr(md5(rand()),0,10);

        $this->load->library('upload', $config);
        $post = $this->input->post(null, TRUE);
        if(isset($_FILES['fprofil']['name']) != null){
            if($this->upload->do_upload('fprofil')){
                $file_name = $this->upload->data('file_name');
                $data['name'] = $file_name;
                $data['status'] = TRUE;
                return $data;
            } else {
                $data['status'] = FALSE;
                $data['error'] = "data tidak masuk";
                return $data;
            }
        }else{
            $data['status'] = TRUE;
            $data['name'] = null;
            return $data;
        }     
    }
  
}

<?php defined('BASEPATH') OR exit('No direct script access allowed');

class IntAdministrasi extends CI_Controller {

	function __construct(){
        parent::__construct();
        check_not_petugas();
        $this->load->model(['InternalAdministrasi_m', 'Subbidang_m']);
        $this->load->library('form_validation');
        
    }

    public function viewDataSuratMasuk(){
        $this->load->view('petugas/internal_administasi_umum/suratmasuk/suratmasuk_data');
    }
    // public function getDataAdministrasi(){
    //     $data = $this->InternalAdministrasi_m->getAllSuratMasuk()->result();
    //     echo json_encode($data);
    // }

    public function getDataAdministrasi(){
        $petugas  = $this->fungsi->petugas_login()->subbidangID;
        $data1 = $this->InternalPengadaan_m->getWorkflowPetugas($petugas)->result();
        foreach($data1 as $row1){
            $budgethonorID1[] = $row1->pattycashID;
        }

        $data2 = $this->InternalPengadaan_m->getAllBudgetHonorID($budgethonorID1)->result();
        foreach($data2 as $row2){

            $dataProses = $this->InternalPengadaan_m->getQuoDetailByQuoIDDESC($row2->pattycashNo)->row();
                if($dataProses->status == 'reject'){
                    $xproses = 'reject';
                }else if($dataProses->status == 'success'){
                    $xproses = 'success';
                }else{
                    $xproses = 'proses';
                }
    
                $arrayData[] = array(
                    'pattycashID'     => $row2->pattycashID,
                    'pattycashNo'     => $row2->pattycashNo,
                    'status'          => $row2->status,
                    'statusProses'    => $xproses,
                    'pengirim'        => $row2->pc_pengirimID,
                    'penerima'        => $row2->pc_penerimaID,
                    'waktu'           => $row2->pcWaktu
                );
            }

        echo json_encode($arrayData);
       
    }
    
    
    public function viewAddSuratMasuk(){
        $this->load->view('petugas/internal_administasi_umum/suratmasuk/suratmasuk_create');
    }

    public function addSuratMasuk(){
        $response = array();
        $post = array();
        // $post = $this->input->post(null, TRUE);
        if($this->input->post('smFile')){
            $this->form_validation->set_rules('smFile', 'smFile', 'callback_file_selected_test["smFile"]');
        }
        if($this->input->post('add')){
            $this->form_validation->set_rules('suratmasukNo', 'suratmasukNo', 'required|is_unique[tb_int_administrasi_suratmasuk.suratmasukNo]');
        }
        if($this->input->post('failed') || $this->input->post('revisi') || $this->input->post('success')){
            $this->form_validation->set_rules('suratmasukNo', 'suratmasukNo', 'required');
        }
      
        $this->form_validation->set_message('required', '%s masih Kososng, atau belum di pilih Silahkan Di isi');
        $this->form_validation->set_message('is_unique', '{field} ini sudah dipakai, silahkan ganti');
        
        if($this->form_validation->run() == FALSE){
            $response = array(
                'status' 	    => 'error',
                'suratmasukNo' => form_error('suratmasukNo'),
                'smFile' => form_error('smFile')
                
            );   
        } else{
            $post = $this->input->post(null, TRUE);
            $post['petugasID']     = $this->fungsi->petugas_login()->petugasID;
            $post['pengirimID']    = $this->fungsi->petugas_login()->subbidangID;
            $post['bidangNama']    = $this->Subbidang_m->getAll($post['pengirimID'])->row();
            if($this->input->post('send_up')){
                $post['penerimaID']    ='FM';
            }else if($this->input->post('send_down')){
                $post['penerimaID']    = 'HR';
            } 

            $jumlah               = $this->InternalAdministrasi_m->jumlahSuratMasuk($post);
            $status                = $this->InternalAdministrasi_m->statusSuratMasuk($post)->row();
            $post['statuskonf']    = 'send';   
            $post['status1'] = $status ;

            if($jumlah->num_rows() == 0 || $status->status != 'reject'){ 
                if($this->input->post('send_up')){
                    $data = $this->fungsi_statusjml->sendRecive($jumlah->num_rows());
                    $post['jumlah'] = $data['jumlah'];
                    $post['status'] = $data['status'];
                }
                else if($this->input->post('send_down')){
                    $data = $this->fungsi_statusjml->sendReciveRevisi($jumlah->num_rows());
                    $post['jumlah'] = $data['jumlah'];

                    if($this->input->post('success')){
                        $post['status'] = 'success'; 
                    }else if($this->input->post('failed')){
                        $post['status'] = $data['status']; 
                    }
                   
                }

                $data1 = 'smFile';
                $file = $this->upload($post, $data1);
                
                $response = array(
                    'status' 	    => 'success',
                );
                if($file['status'] == true){
                    if($file['name'] != null){
                        $post['smFile'] = $file['name']; 
                    } 
                    else{
                        $post['smFile'] =  $this->input->post('smFile_send');
                    }

                    

                    $post1 = array(     
                        'suratmasukNo'  => $post['suratmasukNo'],
                        'petugasID'     => $post['petugasID'],
                        'pengirimID'    => $post['pengirimID'],
                        'penerimaID'    => $post['penerimaID'],
                        'smFile'        => $post['smFile'],
                        'jumlah'        => $post['jumlah'],
                        'status'        => $post['status'],
                        'statuskonf'    => $post['statuskonf'],  
                    );
                
                    $this->InternalAdministrasi_m->addSuratMasuk($post1);
                    if($this->db->affected_rows()>0){ 
                        $response = array(
                            'status' 	    => 'success',
                        );
                    }
                } else{
                    $response = array(
                        'status' 	    => 'error-upload',
                        'file'       => 'tidak Bisa Upload File, Silahkan Di cek Kembali Filenya'
                    );
                }
            }else{
                $response = array(
                    'status' 	    => 'reject',
                    'message'       => 'Maaf Data Sudah Di reject'
                );
            }     
        }
           
        $this->output->set_content_type('application/json');
        echo json_encode($response);
    }

    public function viewNewSuratMasuk(){
        $this->load->view('petugas/internal_administasi_umum/suratmasuk/suratmasuk_new');
    }
    public function getNewSuratMasuk(){
        $data = $this->InternalAdministrasi_m->getAllSuratMasuk()->result();
        echo json_encode($data); 
    }

    public function konfSuratMasuk($id){
        $data['row'] = $this->InternalAdministrasi_m->getAllSuratMasukID($id)->row();
        $this->load->view('petugas/internal_administasi_umum/suratmasuk/suratmasuk_konf', $data);
    }

    public function viewFailedSuratMasuk(){
        $this->load->view('petugas/internal_administasi_umum/suratmasuk/suratmasuk_falid');
    }
    
    public function revisiSuratMasuk($id){
        $data['row'] = $this->InternalAdministrasi_m->getAllSuratMasukID($id)->row();
        $this->load->view('petugas/internal_administasi_umum/suratmasuk/suratmasuk_revisi', $data);
    }

    public function viewSuccessSuratMasuk(){
        $this->load->view('petugas/internal_administasi_umum/suratmasuk/suratmasuk_success');
    }

    public function konfSuccessSuratMasuk($id){
        $data['row'] = $this->InternalAdministrasi_m->getAllSuratMasukID($id)->row();
        $this->load->view('petugas/internal_administasi_umum/suratmasuk/suratmasuk_successkonf', $data);
    }



    ///////////////////////////////////////////////////////////////////////////////////////////////////

    public function viewAddSuratKeluar($id){
        $data['row'] = $this->InternalAdministrasi_m->getAllSuratMasukID($id)->row();
        $this->load->view('petugas/internal_administasi_umum/suratkeluar/suratkeluar_create', $data);
    }


    public function addSuratKeluar(){
        $response = array();
        $post = array();
        // $post = $this->input->post(null, TRUE);
        if($this->input->post('skFile')){
            $this->form_validation->set_rules('skFile', 'skFile', 'callback_file_selected_test["skFile"]');
        }
    
        $this->form_validation->set_rules('suratkeluarNo', 'suratkeluarNo', 'required');
    
      
      
        $this->form_validation->set_message('required', '%s masih Kososng, atau belum di pilih Silahkan Di isi');
        $this->form_validation->set_message('is_unique', '{field} ini sudah dipakai, silahkan ganti');
        
        if($this->form_validation->run() == FALSE){
            $response = array(
                'status' 	    => 'error',
                'suratkeluarNo' => form_error('suratkeluarNo'),
                'skFile' => form_error('skFile')
                
            );   
        } else{
            $post = $this->input->post(null, TRUE);
            $post['petugasID']     = $this->fungsi->petugas_login()->petugasID;
          
            $post['statuskonf']    = 'send';   
            $post['status'] = 'success' ;

  

            $data1 = 'skFile';
            $file = $this->upload($post, $data1);
            
            $response = array(
                'status' 	    => 'success',
            );
            if($file['status'] == true){
                if($file['name'] != null){
                    $post['skFile'] = $file['name']; 
                } 
                
            
                $this->InternalAdministrasi_m->addSuratKeluar($post);
                if($this->db->affected_rows()>0){ 
                    $response = array(
                        'status' 	    => 'success',
                    );
                }
            } else{
                $response = array(
                    'status' 	    => 'error-upload',
                    'quoFile'       => 'tidak Bisa Upload File, Silahkan Di cek Kembali Filenya'
                );
            }
               
        }
           
        $this->output->set_content_type('application/json');
        echo json_encode($post);
    }





    function file_selected_test($file){
        if(!empty($_FILES[$file]['name']) != null) {
            return TRUE;
        }
        else{
            $this->form_validation->set_message('file_selected_test', '%s masih Kososng, Silahkan Upload File Quotaion');
            return FALSE;
        }
    }

    public function upload($post, $data1){
        $config = array();
        $config['upload_path'] =  './uploads/draftCoba/';
        $config['allowed_types']   = 'pdf';
        $config['max_size']        = 2048;
        $config['file_name']       = $data1.'-'.$post['status'].'-'.date('ymd').'-'.substr(md5(rand()),0,10);
        $this->load->library('upload', $config, $data1); // Create custom object for cover upload
        $this->$data1->initialize($config);
       
        if(@$_FILES[$data1]['name'] != null){
            if($this->$data1->do_upload($data1)){
                $file_name = $this->$data1->data('file_name');
                $data['name'] = $file_name;
                $data['status'] = TRUE;
                return $data;
            } else {
                $data['status'] = FALSE;
                return $data;
            }
        } else{
            $data['name'] = null;
            $data['status'] = TRUE;
            return $data;
        }
    }
    
	
}
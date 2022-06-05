<?php defined('BASEPATH') OR exit('No direct script access allowed');

class WorkflowSpk extends CI_Controller {

    function __construct(){
        parent::__construct();
        $this->load->helper(array('form','url'));
        check_not_petugas();
        $this->load->model(['Spk_m', 'Jobdesc_m', 'Finalreport_m', 'Quotation_m']);
        $this->load->library('form_validation');
        $this->fungsi_waktu->timeWorkJobdesc();
    }
    
    //Menampilkan Halaman Create SPK
    public function viewCreatespk($id){
        $data['row']      = $this->Jobdesc_m->getJobdscDByID($id)->row();
        if($data['row']->jobdA_bidangID == 1){
            $data['rowBidang'] = 'Marine';
        }else if($data['row']->jobdA_bidangID == 2){
            $data['rowBidang'] = 'Minerba';
        }
        $data['rowQuo']   = $this->Quotation_m->getQuoDByID($data['row']->jobdA_quoDetailID)->row();
        $this->load->view('petugas/workflow_spk/spk_create', $data);
    }

    //fungsi untuk Menambakan data SPK Baru
    public function saveSpk(){  
        $post = array();
        $response = array(); 
        $this->form_validation->set_rules('jobdaDetailID', 'jobdaDetailID', 'required');
        $this->form_validation->set_rules('spkNo', 'spkNo', 'required|is_unique[tb_spk.spkNo]');
        if($this->input->post('fileSpk')){
            $this->form_validation->set_rules('fileSpk', 'fileSpk', 'callback_file_selected_test["fileSpk"]');
        }
        if($this->input->post('filebiayasurvey')){
            $this->form_validation->set_rules('filebiayasurvey', 'filebiayasurvey', 'callback_file_selected_test["filebiayasurvey"]');
        }
        $this->form_validation->set_message('required', '%s masih Kososng, atau belum di pilih Silahkan Di isi');
        $this->form_validation->set_message('is_unique', '{field} ini sudah dipakai, silahkan ganti');
        if($this->form_validation->run() == FALSE){
			$response = array(
                'status' 	        => 'error',
                'jobdaDetailID'     => form_error('jobdaDetailID'),
                'spkNo' 		    => form_error('spkNo'),
                'fileSpk' 		    => form_error('fileSpk'),
                'filebiayasurvey' 	=> form_error('filebiayasurvey'),
            );   
        } 
        else{
            $jobdetailID       = $this->input->post('jobdaDetailID');
            $spkNo             = $this->input->post('spkNo');  
            $petugasID         = $this->fungsi->petugas_login()->petugasID; 
            $data              = $this->Jobdesc_m->getJobdscDByID($jobdetailID)->row();
            

            

                //////////Create ID//////////
                date_default_timezone_set("Asia/Jakarta");
                if($data->jobdA_bidangID == 1){
                    $bidang = 'MAR';
                }else if($data->jobdA_bidangID == 2){
                    $bidang = 'MIN';
                }
                $char    = 'SPK';
                $date    = date("Y-m-d");
                $tahun   = substr($date, 0, 2);
                $bulan   = substr($date, 5, 2);
                $hari    = substr($date, 8, 2);
                $spk     = $this->Spk_m->getSpkMaxByBidang($bidang)->row(); 
                $spkID   = (int) substr($spk->spkID, 12, 4);
                $spkID++;
                $newspkID = $char.$bidang.$tahun.$bulan.$hari.sprintf("%04s", $spkID);
                /////////////End Create ID////////////

                $data1             = 'fileSpk';
                $data2             = 'filebiayasurvey';
                $file1 = $this->upload($data1, $data->jobdA_bidangID);
                $file2 = $this->upload($data2, $data->jobdA_bidangID);
                if($file1['status'] == TRUE && $file2['status'] == TRUE){
                    $fileSpk = $file1['name'];
                    $filebiayasurvey = $file2['name'];

                $postSend = array(
                    'id'              => $newspkID,
                    'spkNo'           => $spkNo,
                    'jobdaDetailID'   => $jobdetailID,
                    'quoDetailID'     => $data->jobdA_quoDetailID,
                    'orderID'         => $data->jobdA_orderID,
                    'petugasID'       => $petugasID,
                    'bidangID'        => $data->jobdA_bidangID,
                    'statusID'        => 'NW1',
                    'fileSpk'         => $fileSpk,
                    'filebiayasurvey' => $filebiayasurvey,
                    'statusKonf'      => 'send'
                );

                $this->Spk_m->addSpk($postSend);
                if($this->db->affected_rows()>0){ 
                    $post_kirim['status'] = 'SC1';//Success
                    $post_kirim['jobdaDetailID'] = $jobdetailID;
                    $this->Jobdesc_m->setJobdscDStatus($post_kirim);

                    $response = array(
                        'status' 	    => 'success',
                    );
                }
            }else{
                $response = array(
                    'status' 	    => 'gagal upload',
                );
            }
        }
        echo json_encode($response); 
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

    
    public function upload($data1, $bidangID){
        if($bidangID == 1){
            $bidangNama = 'Marine';
        }else if($bidangID == 2){
            $bidangNama = 'Minerba';
        }
        $config = array();
        $config['upload_path'] =  './uploads/spk/'.$bidangNama.'/'.$data1.'/';
        $config['allowed_types']   = 'pdf';
        $config['max_size']        = 2048;
        $config['file_name']       = $data1.'-'.$bidangNama.date('ymd').'-'.substr(md5(rand()),0,10);

        $this->load->library('upload', $config, $data1); // Create custom object for cover upload
        $this->$data1->initialize($config);
        $upload_cover = $this->$data1->do_upload($data1);
        if ($upload_cover) {
            $file_name      = $this->$data1->data('file_name');
            $data['name']   = $file_name;
            $data['status'] = TRUE;
            return $data;
        } 
        else{
            $data['status'] = FALSE;
            return $data;
        }       
    }


    //Menampilkan Halaman SPK Baru
    public function viewNewspk(){
        $this->load->view('petugas/workflow_spk/spk_new');
    }
    
    //Menampilkan Data Spk Baru
    public function getNewSpk(){
        $post['bidangID'] = $this->fungsi->petugas_login()->bidangID;
        $data = $this->Spk_m->getSpkByBidangID($post)->result();
        foreach($data as $row1){
            $row1->spk_jobdaDetailID;
            $dataJobdesc   = $this->Jobdesc_m->getJobdscDByDetailIDDesc($row1->spk_jobdaDetailID)->row();
            $dataQuotation = $this->Quotation_m->getQuoDByID($row1->spk_quoDetailID)->row();
            if($row1->spk_bidangID == 1){
                $bidangNama = 'Marine';
            }else if($row1->spk_bidangID == 2){
                $bidangNama = 'Minerba';
            }
            $arrayData[] = array(
                'spkID'          => $row1->spkID,
                'spkNo'          => $row1->spkNo,
                'jobdDetailID'   => $row1->spk_jobdaDetailID,
                'jobdNo'         => $dataJobdesc->jobdApprovNo,
                'quoDetailID'    => $row1->spk_quoDetailID,
                'quoNo'          => $dataQuotation->quoNo,
                'orderID'        => $row1->spk_orderID,
                'pengirim'       => $row1->subbidangID,
                'bidangNama'     => $bidangNama,
                'waktu'          => $row1->waktu,
            );
        }
        echo json_encode($arrayData);
    }

    public function viewDetailNewSpk($id){
        $bidangID = $this->fungsi->petugas_login()->bidangID;
        $frID = array();
        $data = array();
        $data['row'] = $this->Spk_m->getSpkByID($id)->row();
        $data['rowJobd'] = $this->Jobdesc_m->getJobdscDByID($data['row']->jobdaDetailID)->row();
        if($bidangID == 1){
            $data['rowBidang'] = 'Marine'; 
            $dataFR = $this->Finalreport_m->getFRMarMaxBySpkID($data['row']->spkID)->row();
            if($dataFR != null){
                $frID = $dataFR->frMarID;
                $data['rowFR'] = $frID;

                $dataFRD = $this->Finalreport_m->getFRDMarByFRID($frID)->result();
                    $data['rowFRD'] = $dataFRD;
            }
            
        }else if($bidangID == 2){
            $data['rowBidang'] = 'Minerba'; 
            $dataFR = $this->Finalreport_m->getFRMinBySpkID($data['row']->spkID)->row();
            if($dataFR != null){
                $frID = $dataFR->frMinID;
                $data['rowFR'] = $frID;
                $dataFRD = $this->Finalreport_m->getFRDMinByFRID($frID)->result();
                    $data['rowFRD'] = $dataFRD;
            }
        }
        
        $this->load->view('petugas/workflow_spk/spk_new_detail', $data); 
        // echo json_encode($data);
    }

    public function viewDetailSpk($id){
        $bidangID = $this->fungsi->petugas_login()->bidangID;
        $frID = array();
        $data = array();
        $data['row'] = $this->Spk_m->getSpkByID($id)->row();
        $data['rowJobd'] = $this->Jobdesc_m->getJobdscDByID($data['row']->jobdaDetailID)->row();
        if($bidangID == 1){
            $data['rowBidang'] = 'Marine'; 
            $dataFR = $this->Finalreport_m->getFRMarMaxBySpkID($data['row']->spkID)->row();
            if($dataFR != null){
                $data['rowFR'] = $dataFR;
                $dataFRD = $this->Finalreport_m->getFRDMarByFRID($data['rowFR']->frMarID)->result();
                    $data['rowFRD'] = $dataFRD;
            }
            
        }else if($bidangID == 2){
            $data['rowBidang'] = 'Minerba'; 
            $dataFR = $this->Finalreport_m->getFRMinBySpkID($data['row']->spkID)->row();
            if($dataFR != null){
                $data['rowFR'] = $dataFR;
                $dataFRD = $this->Finalreport_m->getFRDMinByFRID($data['rowFR']->frMinID)->result();
                    $data['rowFRD'] = $dataFRD;
            }
        }
        
        $this->load->view('petugas/workflow_spk/spk_detail', $data); 
        // echo json_encode($data);
    }

     
    
}
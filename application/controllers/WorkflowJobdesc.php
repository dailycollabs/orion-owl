<?php defined('BASEPATH') OR exit('No direct script access allowed');

class WorkflowJobdesc extends CI_Controller {

    function __construct(){
        parent::__construct();
        check_not_petugas();
        $this->load->model(['Order_m', 'Quotation_m', 'Jobdesc_m', 'Bidang_m']);
        $this->load->library('form_validation');
        $this->fungsi_waktu->timeWorkQuotation();
        $this->fungsi_waktu->timeWorkJobdesc();
    }
    
    //Menampilkan Halaman Create Jobdesc
    public function viewAddJobdescID($id){
        $data['row'] = $this->Quotation_m->getQuoDByID($id)->row();
        if($data['row']->quo_bidangID == 1){
            $data['rowBidang'] = 'Marine';
        }else if($data['row']->quo_bidangID == 2){
            $data['rowBidang'] = 'Minerba';
        }
        $data['rowJobd'] = $this->Jobdesc_m->getJobdscByQuoDID($data['row']->quoDetailID)->row();
        $this->load->view('petugas/workflow_jobdesc/approval_create_id', $data);
    }
    
    //Menambahkan Data JobdescID
    public function addJobDescID(){
        $response = array();
        $this->form_validation->set_rules('jobdNo', 'jobdNo', 'required|callback_check_jobdescno');
        $this->form_validation->set_rules('quoID', 'quoID', 'required');
        $this->form_validation->set_rules('quoDetailID', 'quoDetailID', 'required|is_unique[tb_jobd_aproval.jobdA_quoDetailID]');
        $this->form_validation->set_message('required', '%s masih Kososng, atau belum di pilih Silahkan Di isi');
        $this->form_validation->set_message('is_unique', '{field} ini sudah dipakai, silahkan ganti');
 
        if($this->form_validation->run() == FALSE){
			$response = array(
                'status' 	    => 'error',
                'jobdNo' 		=> form_error('jobdNo'),
                'quoID' 		=> form_error('quoID'),
                'quoDetailID'   => form_error('quoDetailID'),
            );
		} 
		else{
            $post             = array();
            $quoID            = $this->input->post('quoID');
            $quoDetailID      = $this->input->post('quoDetailID');
            $jobdNo           = $this->input->post('jobdNo');
            $data             = $this->Quotation_m->getQuoByID($quoID)->row();
            // $post['orderID']  = $row->quo_orderID;
             //////////Create ID//////////
             date_default_timezone_set("Asia/Jakarta");
             if($data->quo_bidangID == 1){
                 $bidang = 'MAR';
             }else if($data->quo_bidangID == 2){
                 $bidang = 'MIN';
             }
             $char    = 'JOB';
             $date    = date("Y-m-d");
             $tahun   = substr($date, 0, 2);
             $bulan   = substr($date, 5, 2);
             $hari    = substr($date, 8, 2);
             $jobdesc   = $this->Jobdesc_m->getJobdscMaxByBidang($bidang)->row(); 
             $jobdescID = (int) substr($jobdesc->jobdApprovID, 12, 4);
             $jobdescID++;
             $newjobID = $char.$bidang.$tahun.$bulan.$hari.sprintf("%04s", $jobdescID);
             /////////////End Create ID////////////
             
             $post = array(
                 'id'          => $newjobID,
                 'jobdNo'      => $jobdNo,
                 'quoDetailID' => $quoDetailID,
                 'orderID'     => $data->quo_orderID,
                 'bidangID'    => $data->quo_bidangID
             );

            $this->Jobdesc_m->addJobdesc($post);
            $quo_id = $quoDetailID;
            $jobDetailID = $this->Jobdesc_m->getJobdscByQuoDID($quo_id)->row();
            if($this->db->affected_rows()){
                $response = array(
                    'status' 	=> 'success',
                    'message'   => "<h3>Success Message</h3>",
                    'id'        => $jobDetailID->jobdApprovID
                );
            } 
        }
        $this->output->set_content_type('application/json');
        echo json_encode($response);
    }

    //Mengecek ID Jobdesc
    public function check_jobdescno(){
        $jobdNo = $this->input->post('jobdNo');
        $statusJobd = array();
        $jobdID = array();
        $jobdDetailID = array();
        $jobd = $this->Jobdesc_m->getJobdscByNoDesc($jobdNo)->row();
        if($jobd != null){ 
            $quoDetail = $this->Quotation_m->getQuoDByID($jobd->jobdA_quoDetailID)->result();
            foreach($quoDetail as $row1){
                $quoDetailID[] = $row1->quoDetailID;
                $statusQuo[] = $row1->status;
            }

            $jobdID = $jobd->jobdApprovID;
            $jobdDetail = $this->Jobdesc_m->getJobdscDByJobID($jobdID)->result();
            if($jobdDetail != null){ 
                foreach($jobdDetail as $row3){
                    $jobdDetailID[] = $row3->jobdaDetailID;
                    $statusJobd[] =  $row3->status;
                }
                if(in_array("success", $statusJobd)){
                    $this->form_validation->set_message('check_jobdescno', '{field} ini sudah di Gunakan, dan datanya sudah ada approval, silahkan di ganti');
                    return FALSE;     
                }else{   
                    if(in_array("reject", $statusJobd)){ 
                        return TRUE;    
                    }else{
                        $this->form_validation->set_message('check_jobdescno', '{field} ini Masih Di Proses');
                        return FALSE;    
                    }
                }
            }else{
                if(in_array("reject", $statusQuo)){ 
                    return TRUE;  
                }else{
                    $this->form_validation->set_message('check_quono', '{field} ini Masih Di Proses');
                    return FALSE;  
                }

            }
        }else{
            return TRUE;
        }
     }
    
    //Menambahkan Halaman Untuk Menambahkan Data Jobdesc
    public function viewUploadJobDesc($id){
        $data = $this->Jobdesc_m->getJobdscByID($id);
        if($data->num_rows() > 0){
            $row['row'] = $data->row();
            if($row['row']->jobdA_bidangID == 1){
                $row['rowbidang'] = 'Marine';
            }else if($row['row']->jobdA_bidangID == 2){
                $row['rowbidang'] = 'Minerba';
            }
            $cek        = $this->Jobdesc_m->getJobdscDByJobID($row['row']->jobdApprovID);
            if($cek->num_rows() > 0){
                echo "<script>
                    alert('Maaf, ID Sudah Mempunyai Approval');
                    window.location='".site_url('petugas/petugasDashboard')."';
                </script>";
            }else{
                $this->load->view('petugas/workflow_jobdesc/approval_upload', $row);
            } 
        } else{
            echo "<script>
                    alert('Maaf, ID atau Nomor Tidak Terdaftar');
                    window.location='".site_url('petugas/petugasDashboard')."';
                </script>";
        } 
    }

     //fungsi untuk Menambakan data Jobdesc Baru
     public function saveJobDescFile(){  
        $response = array(); 
        $this->form_validation->set_rules('jobdID', 'jobdID', 'required');
        if($this->input->post('jobdFile')){
            $this->form_validation->set_rules('jobdFile', 'jobdFile', 'callback_file_selected_test');
        }
        $this->form_validation->set_message('required', '%s masih Kososng, atau belum di pilih Silahkan Di isi');
        if($this->form_validation->run() == FALSE){
			$response = array(
                'status' 	    => 'error',
                'jobdID' 		=> form_error('jobdID'),
                'jobdFile' 		=> form_error('jobdFile'),
            );   
        } 
        else{
            $post['jobdID']        = $this->input->post('jobdID');                  
            $post['bidangID']      = $this->input->post('bidangID');                      
            $post['petugasID']     = $this->fungsi->petugas_login()->petugasID;
            $post['pengirimID']    = $this->fungsi->petugas_login()->subbidangID;
            $post['bidangNama']    = $this->Bidang_m->getID($post['bidangID'])->row();
            $post['penerimaID']    = $this->fungsi_send->sendreceiverRka2($post['bidangID']);
            $post['statuskonf']    = 'send';                    
            $post['status']        = "NW1";
            $file                  = $this->upload($post);
            
            if($file['status'] == true){
                if($file['name'] != null){
                    $post['jobdFile'] = $file['name']; 
                } else{
                    $post['jobdFile'] =  $this->input->post('jobdFile-kirim');
                }
            
                $this->Jobdesc_m->addJobdscDetail($post);
                if($this->db->affected_rows()>0){ 
                    $quoProses['quoProsesID'] = $this->input->post('quoDetailID');  
                    $quoProses['status']      = 'SC1';
                    $this->Quotation_m->setQuoDStatus($quoProses);
                    
                    $response = array(
                        'status' 	    => 'success',
                    );
                }
            } else{
                $response = array(
                    'status' 	    => 'error-upload',
                    'jobdFile'       => 'tidak Bisa Upload File, Silahkan Di cek Kembali Filenya'
                );
            }
        }
        $this->output->set_content_type('application/json');
        echo json_encode($response);  
    }

    function file_selected_test(){
        if(!empty($_FILES['jobdFile']['name']) != null) {
            return TRUE;
        }
        else{
            $this->form_validation->set_message('file_selected_test', '%s masih Kososng, Silahkan Upload File JOB DESC');
            return FALSE;
        }
    }

    
    public function upload($post){
        $config['upload_path']     =  './uploads/approval_jobd/'.$post['bidangNama']->bidangNama.'/';
        $config['allowed_types']   = 'pdf';
        $config['max_size']        = 2048;
        $config['file_name']       = 'JOBDFile-'.$post['bidangNama']->bidangNama.'-'.date('ymd').'-'.substr(md5(rand()),0,10);

        $this->load->library('upload', $config);
        $post = $this->input->post(null, TRUE);
        if(isset($_FILES['jobdFile']['name']) != null){
            if($this->upload->do_upload('jobdFile')){
                $file_name = $this->upload->data('file_name');
                $data['name'] = $file_name;
                $data['status'] = TRUE;
                return $data;
            } else {
                $data['status'] = FALSE;
                $data['error'] = "data tidak masuk";
                return $data;
            }
        } else{
            $data['name'] = null;
            $data['status'] = TRUE;
            return $data;
        }     
    }

    //Menampilkan Halaman Jobdesc Baru
    public function viewNewApproval(){
        $this->load->view('petugas/workflow_jobdesc/approval_new');
    }

    //Menampilkan Data Jobdesc Baru
    public function getNewApprovalJobDesc(){
        $array = array();
        $post['penerima'] = $this->fungsi->petugas_login()->subbidangID;
        $post['bidangID'] = $this->fungsi->petugas_login()->bidangID;
        $post['pengirim'] = $this->fungsi_send->sendreceiverRka1($post['bidangID']);
        $approval         = $this->Jobdesc_m->getJobdscDByPetugasIDNew($post)->result();
        foreach($approval as $row){
            $id        = $row->jobdA_quoDetailID;
            $quotation = $this->Quotation_m->getQuoDByID($id)->row();

            $array[] = array(
                'jobdaDetailID' => $row->jobdaDetailID,
                'jobdescID'     => $row->jobdaD_jobdApprovID,
                'jobdescNo'     => $row->jobdApprovNo,
                'quoID'         => $quotation->quoID,
                'quoNo'         => $quotation->quoNo,
                'pengirimNama'  => $row->petugasNama,
                'orderID'       => $row->jobdA_orderID,
                'file'          => $row->jobdaDFile,
                'status'        => $row->status,
                'waktu'         =>$row->waktu,
            );
        }
        echo json_encode($array); 
    }

    //Mengkonfirmasi Data Jobdesc
    public function konfApproval($id){
        $timeWork = $this->fungsi_timework->timework();
        date_default_timezone_set("Asia/Jakarta");
        $data_query  = $this->Jobdesc_m->getJobdscDByID($id)->row();
        $data['petugasLogin']   = $this->fungsi->petugas_login()->subbidangID;
        $data['waktusekarang']  = date('Y-m-d H:i:s');
        if($data_query->jobdA_bidangID == 1){
            $data['rowBidang'] = 'Marine';
        }else if($data_query->jobdA_bidangID == 2){
            $data['rowBidang'] = 'Minerba';
        }

        if($data['petugasLogin'] != $data_query->jobdaD_pengirimID){
            if($data_query->waktu_start == null && $data_query->waktu_end == null){
                $workApproval['statusConf']  = 'read';
                $workApproval['jobdID'] = $id;
                $workApproval['waktustart']   = date('Y-m-d H:i:s');
                $workApproval['waktuend']     = date('Y-m-d H:i:s',strtotime('+'.$timeWork.' minutes',strtotime($workApproval['waktustart'])));
                $this->Jobdesc_m->setJobdscDStatusKonf($workApproval);
               
            }
            $data['rowJobd'] = $this->Jobdesc_m->getJobdscDByID($id)->row();
            $data['rowQuo']   = $this->Quotation_m->getQuoDByID($data['rowJobd']->jobdA_quoDetailID)->row();
            $data['rowOrder'] = $this->Order_m->getAllByID($data['rowJobd']->jobdA_orderID)->row();
            $this->load->view('petugas/workflow_jobdesc/approval_konfirmasi', $data); 
        }else{
            $data['rowJobd'] = $this->Jobdesc_m->getJobdscDByID($id)->row();
            $data['rowQuo']   = $this->Quotation_m->getQuoDByID($data['rowJobd']->jobdA_quoDetailID)->row();
            $data['rowOrder'] = $this->Order_m->getAllByID($data['rowJobd']->jobdA_orderID)->row();
            $this->load->view('petugas/workflow_jobdesc/approval_konfirmasi', $data);
        } 
        // echo json_encode($data);
    }

    
    //Time-work Jobdesc
    public function timeViewMarine(){
        $this->timeWorkFinalReportMarine();
        $response = array();
        $xproses = array();
        $getID    = $this->input->get('id');
        $waktu_sekarang = date('Y-m-d H:i:s');
        $data_query = $this->Jobdesc_m->getJobdscDByDetailIDDesc($getID)->row();
        $dataFR = $this->Jobdesc_m->getJobdscDByJobID($data_query->jobdaD_jobdApprovID)->result();
        foreach($dataFR as $row){
            if($row->status == 'reject'){
                $xproses = 'reject';
            }else if($row->status == 'success'){
                $xproses = 'success';
            }else{
                $xproses = 'proses';
            }
        }

        if($data_query->waktu_end != null){
            $response = array(
                'statusAll' => $xproses,
                'status'    => $data_query->status,
                'waktuEnd'  => $data_query->waktu_end,
            ); 
        }
        echo json_encode($response);
    }


    public function checkPenerima(){
        $file = array();
        $subbidangPetugas = $this->fungsi->petugas_login()->subbidangID;
        $dataPenerimaDesc         = $this->Jobdesc_m->getJobdscDMaxBypenerimaID($subbidangPetugas)->result();
        if($dataPenerimaDesc != null){
            foreach($dataPenerimaDesc as $row){
                $frPenerimaID[] = $row->jobdaDetailID;
            }
            $dataPenerima     = $this->Jobdesc_m->getJobdscDByDetailIDDesc($frPenerimaID)->result();
            foreach($dataPenerima as $row1){
                $file[] = array(
                    'frDetailID' => $row1->jobdaDetailID,
                    'frID'       => $row1->jobdaD_jobdApprovID,
                );
            } 
        }
        return $file;
        // echo json_encode($file);
    }

    public function timeWorkFinalReportMarine(){   
        $file1          = array();
        $fileDetailID   = array();
        $detailID       = array();
        $post           = array();
        $petugasID      = $this->fungsi->petugas_login()->subbidangID;
        $dataPenerima   = $this->checkPenerima($petugasID);
        $waktu_sekarang = date('Y-m-d H:i:s');
        foreach($dataPenerima as $row){
            $detailID[] = $row['frDetailID'];
            $id[] = $row['frID']; 
        }

        $dataPengirimDesc = $this->Jobdesc_m->getJobdscDBypengirimJobdscID($id, $petugasID)->result();
        if($dataPengirimDesc != null){
            foreach($dataPengirimDesc as $row1){
                if(in_array($row1->jobdaD_jobdApprovID, $id)){
                    $file1[] = $row1->jobdaD_jobdApprovID; //Data Pengirim ADA 
                    $fileDetailID[] = $row1->jobdaDetailID; //Data Pengirim ADA 
                }
            }
        //////////////////////Jika Petugas Sudah Menerima Dan Mengirimkan FR ID////////////////////////////

        /////////////////////////////Jika Petugas hanya menerima FR ID////////////////////////////
            $pengirimNull     = array_diff($id, $file1); //Data Pengirim Tidak Ada
            if($pengirimNull != null){
                $dataPenerimaNull = $this->Jobdesc_m->getJobdscDByJobID($pengirimNull)->result();
                foreach($dataPenerimaNull as $row4){
                    $dataDetailCheck1 = $this->Jobdesc_m->getJobdscDMaxByPenerimaJobdscID($row4->jobdaD_jobdApprovID, $petugasID)->row();
                    $dataPenerimaCheck1 = $this->Jobdesc_m->getJobdscDByDetailIDDesc($dataDetailCheck1->jobdaDetailID)->row();
                    if($row4->jobdaD_jobdApprovID == $dataPenerimaCheck1->jobdaD_jobdApprovID){
                        $x1 = $row4->jobdaDetailID ;
                        $x = $dataPenerimaCheck1->jobdaD_jobdApprovID;
                       
                        $z = $row4->jobdaDetailID;
                        // $waktu1[] = $dataPenerimaCheck1->waktu_end;
                        if($dataPenerimaCheck1->waktu_end != null){
                            if($dataPenerimaCheck1->status != 'success'){
                                if($waktu_sekarang > $dataPenerimaCheck1->waktu_end){
                                    $frData              = $this->Jobdesc_m->getJobdscDByJobID($row4->jobdaD_jobdApprovID)->row();
                                    $post['orderID']      = $frData->jobdA_orderID;
                                    $post['status']      = 'RJ1';//Reject Waktu
                                    $post['jobdaDetailID'] = $dataPenerimaCheck1->jobdaDetailID;
                                    $this->Jobdesc_m->setJobdscDStatus($post);
                                    $this->Order_m->changeStatus($post);
                                }
                            }
                        }  
                    }
                }
            }
        }else{//Data Pertama sekali

            $dataPenerimax = $this->Jobdesc_m->getJobdscDByPenerimaJobdescID($id, $petugasID)->result();
            foreach($dataPenerimax as $rowx){
                $waktu[] = $rowx->waktu_end;
                if($rowx->waktu_end != null){
                    if($rowx->status != 'success'){
                        if($waktu_sekarang > $rowx->waktu_end){
                            $frData1              = $this->Jobdesc_m->getJobdscByID($rowx->jobdaD_jobdApprovID)->row();
                            $post['orderID']     = $frData1->jobdA_orderID;
                            $post['status']      = 'RJ1';//Reject Waktu
                            $post['jobdaDetailID'] = $rowx->jobdaDetailID;
                            $this->Order_m->changeStatus($post);
                            $this->Jobdesc_m->setJobdscDStatus($post);
                        }
                    }
                }
            }
        } 

        // echo json_encode($dataPenerimax); 
    }








   
    
}
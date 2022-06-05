<?php defined('BASEPATH') OR exit('No direct script access allowed');

class InvoicingFinalReport extends CI_Controller {
    public $dataUpload = array();
    public $data_jumlah = array();
    public $status = array();

    function __construct(){
        parent::__construct();
        check_not_petugas();
        $this->load->helper(array('form','url'));
        $this->load->model(['Spk_m', 'Subbidang_m', 'Finalreport_m', 'Jobdesc_m', 'Quotation_m']);
        $this->load->library('form_validation');
    }

    public function addFRID(){
        $lastID = array();
        $response = array();
        if($this->fungsi->petugas_login()->bidangID == 1){
            $this->form_validation->set_rules('spkID', 'spk', 'required');
        }else if($this->fungsi->petugas_login()->bidangID == 2){
            $this->form_validation->set_rules('spkID', 'spkID', 'required');
            $this->form_validation->set_rules('lhvNo', 'lhvNo', 'required');
        }
        
        $this->form_validation->set_message('required', '%s masih Kososng, Silahkan Di isi');
        $this->form_validation->set_message('is_unique', 'PERHATIAN!!!<br> Data {field} ini sudah dipakai, Tidak bisa di duplikasi, jika ingin mengupload data silahkan menuju di bagian Data Final Report');
 
        if($this->form_validation->run() == FALSE){
            if($this->fungsi->petugas_login()->bidangID == 1){
			$response = array(
                'status' 	    => 'error',
                'spkID' 		=> form_error('spkID'),
            );
            }else if($this->fungsi->petugas_login()->bidangID == 2){
                $response = array(
                    'status' 	    => 'error',
                    'spkID' 		=> form_error('spkID'),
                    'lhvNo' 		=> form_error('lhvNo'),
                );
            }
		} 
		else{
            $spkID = $this->input->post('spkID');
            $lhvNo = $this->input->post('lhvNo');
            $dataSpk = $this->Spk_m->getSpkByID($spkID)->row();

            //////////Create ID//////////
            date_default_timezone_set("Asia/Jakarta");
            if($dataSpk->spk_bidangID == 1){
                $bidang = 'MAR';
                $finalreport   = $this->Finalreport_m->getFRMarMaxID()->row(); 
                $frID = (int) substr($finalreport->frMarID, 12, 4);
                $frID++;
            }else if($dataSpk->spk_bidangID == 2){
                $bidang = 'MIN';
                $finalreport   = $this->Finalreport_m->getFRMinMaxID()->row(); 
                $frID = (int) substr($finalreport->frMinID, 12, 4);
                $frID++;
            }

            $char    = 'FRD';
            $date    = date("Y-m-d");
            $tahun   = substr($date, 0, 2);
            $bulan   = substr($date, 5, 2);
            $hari    = substr($date, 8, 2);
            
            $newfrID = $char.$bidang.$tahun.$bulan.$hari.sprintf("%04s", $frID);
            /////////////End Create ID////////////
            
            $post = array(
                'id'             => $newfrID,
                'fr_lhvNo'       => $lhvNo, //Jika bidangnya Minerba, maka Lhv di gunakan 
                'fr_spkID'       => $spkID,
                'fr_jobdescID'   => $dataSpk->spk_jobdaDetailID,
                'fr_quoDetailID' => $dataSpk->spk_quoDetailID,
                'fr_orderID'     => $dataSpk->spk_orderID,
                'fr_bidangID'    => $dataSpk->spk_bidangID
            );

            if($this->fungsi->petugas_login()->bidangID == 1){
                $this->Finalreport_m->addFRMar($post);
            } else if($this->fungsi->petugas_login()->bidangID == 2){
                $this->Finalreport_m->addFRMin($post);
            }

            if($this->db->affected_rows()){
                $spkChange['status'] = 'PR1';//Proses
                $spkChange['spkID'] = $spkID;
                $this->Spk_m->setSpkStatus($spkChange);
                if($this->fungsi->petugas_login()->bidangID == 1){
                    $datafrID = $this->Finalreport_m->getFRMarByID($newfrID)->row();
                    $fr_ID = $datafrID->frMarID;
            
                } else if($this->fungsi->petugas_login()->bidangID == 2){
                    $datafrID = $this->Finalreport_m->getFRMinByID($newfrID)->row();
                    $fr_ID = $datafrID->frMinID;
                }

                $response = array(
                    'status' 	=> 'success',
                    'message'   => "<h3>Success Message</h3>",
                    'id'        => $fr_ID,
                );
             } else{
                $response = array(
                    'status' 	=> 'gagal',
                    'message'   => "<h3>Gagal Message</h3>",
                    'id'        => $fr_ID,
                );
            }
        }

        $this->output->set_content_type('application/json');
        echo json_encode($response);
    }

    public function viewUploadFRFile($id){
        $data = array();
        if($this->fungsi->petugas_login()->bidangID == 1){
            $data['row'] = $this->Finalreport_m->getFRMarByID($id)->row();
        } else if($this->fungsi->petugas_login()->bidangID == 2){
            $data['row'] = $this->Finalreport_m->getFRMinByID($id)->row();
        }
        $this->load->view('petugas/invoicing_finalreport/finalreport_upload', $data);
    }

    public function viewNewFR(){
        $bidangID = $this->fungsi->petugas_login()->bidangID;
        $petugas = $this->fungsi->petugas_login()->subbidangID;
        if($bidangID == 1){
            $this->load->view('petugas/invoicing_finalreport/finalreport_marine_new');
        }else if($bidangID == 2 || $petugas == 'FM'){
            $this->load->view('petugas/invoicing_finalreport/finalreport_minerba_new');
        }
    }

    public function getNewFR(){
        $array = array();
        $bidangID = $this->fungsi->petugas_login()->bidangID;
        $post['petugasLogin']  = $this->fungsi->petugas_login()->subbidangID;
        
        if($bidangID == 1){
            $post['pengirim'] = $this->fungsi_send->sendreceiverRka2($bidangID);
            $array = $this->Finalreport_m->getFRDMarByPetugasIDNew($post)->result();
            foreach($array as $row1){
                $dataSPK = $this->Spk_m->getSpkByID($row1->frMar_spkID)->row();
                $dataJobDesc = $this->Jobdesc_m->getJobdscDByDetailIDDesc($row1->frMar_jobdaDetailID)->row();
                
                $arrayData[] = array(
                    'frDetailID' => $row1->frMarDetailID,
                    'frID'       => $row1->frMarD_frID,
                    'spkNo'      => $dataSPK->spkNo,
                    'jobdescNo'  => $dataJobDesc->jobdApprovNo,
                    'orderID'    => $row1->frMar_orderID,
                    'bidang'     => 'Marine',
                    'pengirim'   => $row1->petugasNama,
                    'status'     => $row1->status,
                    'waktu'      => $row1->waktu,
                );
            }
        }else if($bidangID == 2 || $post['petugasLogin']  == 'FM'){
            if($post['petugasLogin']  == 'FM'){
                $post['pengirim'] = 'MDM2';
            }else{
                $post['pengirim'] = $this->fungsi_send->sendreceiverRka2($bidangID);
            }
            
            $array = $this->Finalreport_m->getFRDMinByPetugasIDNew($post)->result();
            foreach($array as $row2){
                $dataSPK = $this->Spk_m->getSpkByID($row2->frMin_spkID)->row();
                $dataJobDesc = $this->Jobdesc_m->getJobdscDByDetailIDDesc($row2->frMin_jobdaDetailID)->row();
                
                $arrayData[] = array(
                    'frDetailID' => $row2->frMinDetailID,
                    'frID'       => $row2->frMinD_frID,
                    'frMinlhvNo' => $row2->frMinlhvNo,
                    'spkNo'      => $dataSPK->spkNo,
                    'jobdescNo'  => $dataJobDesc->jobdApprovNo,
                    'orderID'    => $row2->frMin_orderID,
                    'bidang'     => 'Marine',
                    'pengirim'   => $row2->petugasNama,
                    'status'     => $row2->status,
                    'waktu'      => $row2->waktu,
                );
            }
        }
       
        echo json_encode($arrayData); 
    }



    public function konfirmasiFR($id){
        $timeWork = $this->fungsi_timework->timework();
        date_default_timezone_set("Asia/Jakarta");
        if($id != null){
            $data                          = array();
            $data_query                    = array();
            $bidangID                      = $this->fungsi->petugas_login()->bidangID;
            $data['petugasLogin']          = $this->fungsi->petugas_login()->subbidangID;
            $data['waktusekarang']         = date('Y-m-d H:i:s');
            $dataQuoDetail['statusConf']   = 'read';
            $dataQuoDetail['frDetailID']   = $id;
            $dataQuoDetail['waktustart']   = date('Y-m-d H:i:s');
            $dataQuoDetail['waktuend']     = date('Y-m-d H:i:s',strtotime('+'.$timeWork.' minutes',strtotime($dataQuoDetail['waktustart'])));
            $petugas = array();

            if($bidangID == 1){
                $data_query         = $this->Finalreport_m->getFRDMarByIDDesc($id)->row();
                $data['rowSpk']     = $this->Spk_m->getSpkByID($data_query->frMar_spkID)->row();
                $data['rowJobdesc'] = $this->Jobdesc_m->getJobdscDByDetailIDDesc($data_query->frMar_jobdaDetailID)->row();
                $data['rowQuo']     = $this->Quotation_m->getQuoDByID($data_query->frMar_quoDetailID)->row();
                
                $data['rowBidang']  = 'Marine';
                $petugas            = $data_query->frMarD_penerimaID;

                if($data['petugasLogin']  == $petugas){
                    if($data_query->waktu_start == null && $data_query->waktu_end == null){
                        $this->Finalreport_m->setFRDMarStatusKonf($dataQuoDetail);
                    }
                    $data['rowMarFR']         = $this->Finalreport_m->getFRDMarByIDDesc($id)->row();
                    $this->load->view('petugas/invoicing_finalreport/finalreport_marine_konf', $data);  
                    
                }else{
                    $data['rowMarFR']         = $this->Finalreport_m->getFRDMarByIDDesc($id)->row();
                    $this->load->view('petugas/invoicing_finalreport/finalreport_marine_konf', $data); 
                } 
  

            }else if($bidangID == 2 || $data['petugasLogin']  == 'FM'){
                $data_query        = $this->Finalreport_m->getFRDMinByIDDesc($id)->row();
                $data['rowSpk']     = $this->Spk_m->getSpkByID($data_query->frMin_spkID)->row();
                $data['rowJobdesc'] = $this->Jobdesc_m->getJobdscDByDetailIDDesc($data_query->frMin_jobdaDetailID)->row();
                $data['rowQuo']     = $this->Quotation_m->getQuoDByID($data_query->frMin_quoDetailID)->row();
                $data['rowBidang']  = 'Minerba';
                $petugas           = $data_query->frMinD_penerimaID;

                if($data['petugasLogin']  == $petugas){
                    if($data_query->waktu_start == null && $data_query->waktu_end == null){  
                        $this->Finalreport_m->setFRDMinStatusKonf($dataQuoDetail);
                    }
                    $data['rowMinFR'] = $this->Finalreport_m->getFRDMinByIDDesc($id)->row();
                    $this->load->view('petugas/invoicing_finalreport/finalreport_minerba_konf', $data);
                }else{
                    $data['rowMinFR'] = $this->Finalreport_m->getFRDMinByIDDesc($id)->row();
                    $this->load->view('petugas/invoicing_finalreport/finalreport_minerba_konf', $data);
                }
            }
        }
    }



    public function viewDraftFRNewFailed(){
        $bidangID = $this->fungsi->petugas_login()->bidangID;
        if($bidangID == 1){
            $this->load->view('petugas/invoicing_finalreport/finalreport_marine_failed');
        }else if($bidangID == 2){
            $this->load->view('petugas/invoicing_finalreport/finalreport_minerba_failed');
        }
    }

  

    public function getDraftFRNewFailed(){
        $array = array();
        $bidangID = $this->fungsi->petugas_login()->bidangID;
        $post['petugasLogin']  = $this->fungsi->petugas_login()->subbidangID;

        if($bidangID == 1){
            $post['pengirim'] = $this->fungsi_send->sendreceiverRka1($bidangID);
            $array = $this->Finalreport_m->getFRDMarByPetugasIDNew($post)->result();
            foreach($array as $row1){
                $dataSPK = $this->Spk_m->getSpkByID($row1->frMar_spkID)->row();
                $dataJobDesc = $this->Jobdesc_m->getJobdscDByDetailIDDesc($row1->frMar_jobdaDetailID)->row();
                
                $arrayData[] = array(
                    'frDetailID'       => $row1->frMarDetailID,
                    'frID'       => $row1->frMarD_frID,
                    'spkNo'      => $dataSPK->spkNo,
                    'jobdescNo'  =>  $dataJobDesc->jobdApprovNo,
                    'orderID'    => $row1->frMar_orderID,
                    'bidang'     => 'Marine',
                    'pengirim'   => $row1->petugasNama,
                    'status'     => $row1->status,
                    'waktu'      => $row1->waktu,
                );
            }
        } 
        else if($bidangID == 2){
            
            $post['pengirim'] = $this->fungsi_send->sendreceiverRka1($bidangID);
            $array = $this->Finalreport_m->getFRDMinByPetugasFRIDNew($post)->result();
            foreach($array as $row2){
                $dataSPK = $this->Spk_m->getSpkByID($row2->frMin_spkID)->row();
                $dataJobDesc = $this->Jobdesc_m->getJobdscDByDetailIDDesc($row2->frMin_jobdaDetailID)->row();
                
                $arrayData[] = array(
                    'frDetailID' => $row2->frMinDetailID,
                    'frID'       => $row2->frMinD_frID,
                    'frMinlhvNo' => $row2->frMinlhvNo,
                    'spkNo'      => $dataSPK->spkNo,
                    'jobdescNo'  =>  $dataJobDesc->jobdApprovNo,
                    'orderID'    => $row2->frMin_orderID,
                    'bidang'     => 'Marine',
                    'pengirim'   => $row2->petugasNama,
                    'status'     => $row2->status,
                    'waktu'      => $row2->waktu,
                );
            }
        }
        echo json_encode($arrayData);
    }

  


    public function revisiDraftFR($id){
        $timeWork = $this->fungsi_timework->timework();
        $data                          = array();
        $data_query                    = array();
        $bidangID                      = $this->fungsi->petugas_login()->bidangID;
        $data['petugasLogin']          = $this->fungsi->petugas_login()->subbidangID;
        $data['waktusekarang']         = date('Y-m-d H:i:s');
        $dataQuoDetail['statusConf']   = 'read';
        $dataQuoDetail['frDetailID']   = $id;
        $dataQuoDetail['waktustart']   = date('Y-m-d H:i:s');
        $dataQuoDetail['waktuend']     = date('Y-m-d H:i:s',strtotime('+'.$timeWork.' minutes',strtotime($dataQuoDetail['waktustart'])));
        $petugas = array();

        if($bidangID == 1){
            $data_query         = $this->Finalreport_m->getFRDMarByIDDesc($id)->row();
            $data['rowSpk']     = $this->Spk_m->getSpkByID($data_query->frMar_spkID)->row();
            $data['rowJobdesc'] = $this->Jobdesc_m->getJobdscDByDetailIDDesc($data_query->frMar_jobdaDetailID)->row();
            $data['rowQuo']     = $this->Quotation_m->getQuoDByID($data_query->frMar_quoDetailID)->row();
            $data['rowBidang']  = 'Marine';
            $petugas            = $data_query->frMarD_pengirimID;

            if($data['petugasLogin']  != $petugas){
                if($data_query->waktu_start == null && $data_query->waktu_end == null){
                    $this->Finalreport_m->setFRDMarStatusKonf($dataQuoDetail);
                }
                $data['rowMarFR']         = $this->Finalreport_m->getFRDMarByIDDesc($id)->row();
                $this->load->view('petugas/invoicing_finalreport/finalreport_marine_revisi', $data);

            }else{
                $data['rowMarFR']         = $this->Finalreport_m->getFRDMarByIDDesc($id)->row();
                $this->load->view('petugas/invoicing_finalreport/finalreport_marine_revisi', $data);
            } 


        }else if($bidangID == 2){
            $data_query        = $this->Finalreport_m->getFRDMinByID($id)->row();
            $data['rowSpk']     = $this->Spk_m->getSpkByID($data_query->frMin_spkID)->row();
            $data['rowJobdesc'] = $this->Jobdesc_m->getJobdscDByDetailIDDesc($data_query->frMin_jobdaDetailID)->row();
            $data['rowQuo']     = $this->Quotation_m->getQuoDByID($data_query->frMin_quoDetailID)->row();
            $data['rowBidang']  = 'Minerba';
            $petugas           = $data_query->frMinD_pengirimID;

            if($data['petugasLogin']  != $petugas){
                if($data_query->waktu_start == null && $data_query->waktu_end == null){  
                    $this->Finalreport_m->setFRDMinStatusKonf($dataQuoDetail);
                }
                $data['rowMinFR']  = $this->Finalreport_m->getFRDMinByID($id)->row();
                $this->load->view('petugas/invoicing_finalreport/finalreport_minerba_revisi', $data);
            }else{
                $data['rowMinFR']  = $this->Finalreport_m->getFRDMinByID($id)->row();
                $this->load->view('petugas/invoicing_finalreport/finalreport_minerba_revisi', $data);
            }
        }
    }

   

    ////////////////////////////////// Fungsi Upload File Final Report /////////////////////////////////////////////
    ////////////////////////////////// Upload Final Report Marine //////////////////////////////////////////////////
    public function uploadFRFile(){  
        $frReject = array();
        $response = array(); 
        $post     = array();
        $post1    = $this->input->post(null, TRUE);
        $this->form_validation->set_rules('frID', 'frID', 'required');
        if($this->input->post('add')){
            if($this->input->post('fr_survey')){
                $this->form_validation->set_rules('fr_survey', 'fr_survey', 'callback_file_selected_test["fr_survey"]');  
            }
            if($this->input->post('fr_internal')){
                $this->form_validation->set_rules('fr_internal', 'fr_internal', 'callback_file_selected_test["fr_internal"]');
            }
        }else if($this->input->post('failed')){
            if($post1['check1'] == 'true' || $post1['check2'] =='true' ){
                if($post1['check1'] == 'true'){
                    if(!empty($_FILES['fr_internal']['name']) == null){
                        $this->form_validation->set_rules('fr_internal', 'fr_internal', 'callback_file_selected_test["fr_internal"]'); 
                    } 
                    
                } else if($post1['check2'] =='true'){
                    if(!empty($_FILES['fr_survey']['name']) == null){
                        $this->form_validation->set_rules('fr_survey', 'fr_survey', 'callback_file_selected_test["fr_survey"]'); 
                    }
                }
            }else{
                $this->form_validation->set_rules('check1', 'check1', 'callback_check["check1"]');
                $this->form_validation->set_rules('check2', 'check2', 'callback_check["check2"]');
            }    
        }else if($this->input->post('revisi')){
            if(!$this->input->post('fr_internal_send')){  
                if(!empty($_FILES['fr_internal']['name']) == null){
                    $this->form_validation->set_rules('fr_internal', 'fr_internal', 'callback_file_selected_test["fr_internal"]'); 
                }   
            } 
            if(!$this->input->post('fr_survey_send')){
                if(!empty($_FILES['fr_survey']['name']) == null){
                    $this->form_validation->set_rules('fr_survey', 'fr_survey', 'callback_file_selected_test["fr_survey"]'); 
                }  
            }      
        }
            
        $this->form_validation->set_message('required', '%s masih Kososng, atau belum di pilih Silahkan Di isi');
        if($this->form_validation->run() == FALSE){
            if($this->input->post('add')){
                $response  = array(
                    'status' 	    => 'error',
                    'frID' 		    => form_error('frID'),
                    'fr_internal'   => form_error('fr_internal'),
                    'fr_survey'     => form_error('fr_survey'),
                ); 
            } else if($this->input->post('failed')){
                $response  = array(
                    'status' 	    => 'error',
                    'frID' 		    => form_error('frID'),
                    'check1'        => form_error('check1'),
                    'check2'        => form_error('check2'),
                    'fr_internal'   => form_error('fr_internal'),
                    'fr_survey'     => form_error('fr_survey'),  
                );
            } else if($this->input->post('revisi')){
                $response  = array(
                    'status' 	    => 'error',
                    'frID' 		    => form_error('frID'),
                    'fr_internal'   => form_error('fr_internal'),
                    'fr_survey'     => form_error('fr_survey'),
                );
            }
        }
         else{
            $post['frID']          = $this->input->post('frID');         
            $post['bidangID']      = $this->input->post('bidangID'); 
            $post['comment']       = $this->input->post('frMarComment');                    
            $post['petugasID']     = $this->fungsi->petugas_login()->petugasID;
            $post['pengirimID']    = $this->fungsi->petugas_login()->subbidangID;
            $post['bidangNama']    = $this->Subbidang_m->getAll($post['pengirimID'])->row();
            $spkData               = $this->Finalreport_m->getFRMarByID($post['frID'])->row();

            if($this->input->post('send_up')){
                $post['penerimaID']    = $this->fungsi_send->sendreceiverRka1($post['bidangID']);
            } else if($this->input->post('send_down')){
                $post['penerimaID']    = $this->fungsi_send->sendreceiverRka2($post['bidangID']);  
            }

            $jumlah               = $this->Finalreport_m->getFRDMarJumlah($post);
            $frID                 = $post['frID'];
            $frStatus             = $this->Finalreport_m->getFRDMarByFRID($frID)->result();
            foreach($frStatus as $row){
                $frReject[] = $row->status;
            }
            $post['statuskonf']    = 'send';   
                           
            if($jumlah->num_rows() == 0 || !in_array('reject', $frReject)){   
                if($this->input->post('send_up')){
                    $data = $this->fungsi_statusjml->sendRecive($jumlah->num_rows());
                    $post['jumlah'] = $data['jumlah'];
                    $post['status'] = $data['status'];
                }else if($this->input->post('send_down')){
                    $data = $this->fungsi_statusjml->sendReciveRevisi($jumlah->num_rows());
                    $post['jumlah'] = $data['jumlah'];
                    $post['status'] = $data['status']; 
                }

                $data1 = 'fr_survey';
                $data2 = 'fr_internal';
                $file1 = $this->upload($post, $data1);
                $file2 = $this->upload($post, $data2);  

                if($file1['status'] == TRUE && $file2['status'] == TRUE){
                    if($file1['name'] != null){
                        $post['fr_survey'] = $file1['name'];   
                    } else{
                        $post['fr_survey'] = $this->input->post('fr_survey_send');
                    }
                    if($file2['name'] != null){
                        $post['fr_internal'] = $file2['name'];
                    } else{
                        $post['fr_internal'] = $this->input->post('fr_internal_send');
                    }

                    $postSend = array(     
                        'frID'        => $post['frID'],
                        'petugasID'   => $post['petugasID'],
                        'pengirimID'  => $post['pengirimID'],
                        'penerimaID'  => $post['penerimaID'],
                        'status'      => $post['status'],
                        'fr_internal' => $post['fr_internal'],
                        'fr_survey'   => $post['fr_survey'],
                        'jumlah'      => $post['jumlah'],
                        'statuskonf'  => $post['statuskonf'],  
                        'comment'     => $post['comment'],  
                    );


                    $id = $this->Finalreport_m->addFRDetailMar($postSend);
                    if($this->db->affected_rows()>0){ 

                        if($post['status'] == 'RJ2'){
                            $spkChange['status'] = 'RJ2';//Reject
                            $spkChange['spkID'] = $spkData->frMar_spkID;
                            $this->Spk_m->setSpkStatus($spkChange);
                        }

                        if($this->input->post('failed_invFrom')){
                            $frDetailIDINV = $this->input->post('frDetailID_invFrom');
                            $post['status']      = 'PR1';
                            $post['frDetailID']  = $frDetailIDINV;
                            $this->Finalreport_m->setFRDMarStatus($post);
                        }

                        if($this->fungsi->petugas_login()->subbidangID == 'MDM1'){
                            $response = array(
                                'status' 	    => 'success',
                                'id'            => $id
                            );
                        }else{
                            $response = array(
                                'status' 	    => 'success',
                            );
                        }
                    }
                } else{
                    $response  = array(
                        'status' 	    => 'gagal upload',
                        
                    );
                }
               
            }
        }
        $this->output->set_content_type('application/json');
        echo json_encode($response); 
    }

    ///////////////////////////////////////// End Upload Final Report Marine////////////////////////////////////////////

    ///////////////////////////////////////// Upload Final Report Minerba///////////////////////////////////////////////

    public function saveFRMinerbaFile(){  
        $response = array(); 
        $post = array();
        $post = $this->input->post(null, TRUE);
        $this->form_validation->set_rules('frID', 'frID', 'required');
        if($this->input->post('add')){
            if($this->input->post('fr_internal')){
                $this->form_validation->set_rules('fr_internal', 'fr_internal', 'callback_file_selected_test["fr_internal"]'); 
            }
            if($this->input->post('fr_lhv')){
                $this->form_validation->set_rules('fr_lhv', 'fr_lhv', 'callback_file_selected_test["fr_lhv"]'); 
            }
            if($this->input->post('fr_dsr')){
                $this->form_validation->set_rules('fr_dsr', 'fr_dsr', 'callback_file_selected_test["fr_dsr"]'); 
            }
            if($this->input->post('fr_coa')){
                $this->form_validation->set_rules('fr_coa', 'fr_coa', 'callback_file_selected_test["fr_coa"]'); 
            }
            if($this->input->post('fr_cow')){
                $this->form_validation->set_rules('fr_cow', 'fr_cow', 'callback_file_selected_test["fr_cow"]'); 
            }
            if($this->input->post('fr_cds')){
                $this->form_validation->set_rules('fr_cds', 'fr_cds', 'callback_file_selected_test["fr_cds"]'); 
            }
               
        }else if($this->input->post('failed')){
            if($post['check1'] == 'true' || $post['check2'] =='true' || $post['check3'] =='true' || $post['check4'] =='true' || $post['check5'] =='true' || $post['check6'] =='true'){
                if($post['check1'] == 'true'){
                    if(!empty($_FILES['fr_internal']['name']) == null){
                        $this->form_validation->set_rules('fr_internal', 'fr_internal', 'callback_file_selected_test["fr_internal"]'); 
                    }
                } 
                if($post['check2'] =='true'){
                    if(!empty($_FILES['fr_lhv']['name']) == null){
                        $this->form_validation->set_rules('fr_lhv', 'fr_lhv', 'callback_file_selected_test["fr_lhv"]'); 
                    }  
                }
                if($post['check3'] == 'true'){
                    if(!empty($_FILES['fr_dsr']['name']) == null){
                        $this->form_validation->set_rules('fr_dsr', 'fr_dsr', 'callback_file_selected_test["fr_dsr"]'); 
                    }
                } 
                if($post['check4'] =='true'){
                    if(!empty($_FILES['fr_coa']['name']) == null){
                        $this->form_validation->set_rules('fr_coa', 'fr_coa', 'callback_file_selected_test["fr_coa"]'); 
                    }  
                }
                if($post['check5'] == 'true'){
                    if(!empty($_FILES['fr_cow']['name']) == null){
                        $this->form_validation->set_rules('fr_cow', 'fr_cow', 'callback_file_selected_test["fr_cow"]'); 
                    }
                } 
                if($post['check6'] =='true'){
                    if(!empty($_FILES['fr_cds']['name']) == null){
                        $this->form_validation->set_rules('fr_cds', 'fr_cds', 'callback_file_selected_test["fr_cds"]'); 
                    }  
                }
            }else{
                $this->form_validation->set_rules('check1', 'check1', 'callback_check["check1"]');
                $this->form_validation->set_rules('check2', 'check2', 'callback_check["check2"]');
                $this->form_validation->set_rules('check3', 'check3', 'callback_check["check3"]');
                $this->form_validation->set_rules('check4', 'check4', 'callback_check["check4"]');
                $this->form_validation->set_rules('check5', 'check5', 'callback_check["check5"]');
                $this->form_validation->set_rules('check6', 'check6', 'callback_check["check6"]');
            }    
        }else if($this->input->post('revisi')){
            if(!$this->input->post('fr_internal_send')){  
                if(!empty($_FILES['fr_internal']['name']) == null){
                    $this->form_validation->set_rules('fr_internal', 'fr_internal', 'callback_file_selected_test["fr_internal"]'); 
                }   
            } 
            if(!$this->input->post('fr_lhv_send')){
                if(!empty($_FILES['fr_lhv']['name']) == null){
                    $this->form_validation->set_rules('fr_lhv', 'fr_lhv', 'callback_file_selected_test["fr_lhv"]'); 
                }  
            }
            if(!$this->input->post('fr_dsr_send')){
                if(!empty($_FILES['fr_dsr']['name']) == null){
                    $this->form_validation->set_rules('fr_dsr', 'fr_dsr', 'callback_file_selected_test["fr_dsr"]'); 
                }  
            }
            if(!$this->input->post('fr_coa_send')){
                if(!empty($_FILES['fr_coa']['name']) == null){
                    $this->form_validation->set_rules('fr_coa', 'fr_coa', 'callback_file_selected_test["fr_coa"]'); 
                }  
            }
            if(!$this->input->post('fr_cow_send')){
                if(!empty($_FILES['fr_cow']['name']) == null){
                    $this->form_validation->set_rules('fr_cow', 'fr_cow', 'callback_file_selected_test["fr_cow"]'); 
                }  
            }
            if(!$this->input->post('fr_cds_send')){
                if(!empty($_FILES['fr_cds']['name']) == null){
                    $this->form_validation->set_rules('fr_cds', 'fr_cds', 'callback_file_selected_test["fr_cds"]'); 
                }  
            }
        }
            
        $this->form_validation->set_message('required', '%s masih Kososng, atau belum di pilih Silahkan Di isi');
        if($this->form_validation->run() == FALSE){
            if($this->input->post('add')){
                $response  = array(
                    'status' 	    => 'error',
                    'frID' 		    => form_error('frID'),
                    'fr_internal'   => form_error('fr_internal'),
                    'fr_lhv'        => form_error('fr_lhv'),
                    'fr_dsr'        => form_error('fr_dsr'),
                    'fr_coa'        => form_error('fr_coa'),
                    'fr_cow'        => form_error('fr_cow'),
                    'fr_cds'        => form_error('fr_cds'),
                ); 
            } else if($this->input->post('failed')){
                $response  = array(
                    'status' 	    => 'error',
                    'frID' 		    => form_error('frID'),
                    'check1'        => form_error('check1'),
                    'check2'        => form_error('check2'),
                    'check3'        => form_error('check3'),
                    'check4'        => form_error('check4'),
                    'check5'        => form_error('check5'),
                    'check6'        => form_error('check6'),
                    'fr_internal'   => form_error('fr_internal'),
                    'fr_lhv'        => form_error('fr_lhv'),
                    'fr_dsr'        => form_error('fr_dsr'),
                    'fr_coa'        => form_error('fr_coa'),
                    'fr_cow'        => form_error('fr_cow'),
                    'fr_cds'        => form_error('fr_cds'),
                );
            } else if($this->input->post('revisi')){
                $response  = array(
                    'status' 	    => 'error',
                    'frID' 		    => form_error('frID'),
                    'fr_internal'   => form_error('fr_internal'),
                    'fr_lhv'        => form_error('fr_lhv'),
                    'fr_dsr'        => form_error('fr_dsr'),
                    'fr_coa'        => form_error('fr_coa'),
                    'fr_cow'        => form_error('fr_cow'),
                    'fr_cds'        => form_error('fr_cds'),
                ); 
            } 
        } else{
            $post['frID']          = $this->input->post('frID');                        
            $post['petugasID']     = $this->fungsi->petugas_login()->petugasID;
            $post['pengirimID']    = $this->fungsi->petugas_login()->subbidangID;
            $post['bidangNama']    = $this->Subbidang_m->getAll($post['pengirimID'])->row();
            $post['bidangID']      = $this->input->post('bidangID');  
            $post['comment']       = $this->input->post('frMinComment');   

            if($this->input->post('send_up')){
                $post['penerimaID']    = $this->fungsi_send->sendreceiverRka1($post['bidangID']);
            } else if($this->input->post('send_down')){
                $post['penerimaID']    = $this->fungsi_send->sendreceiverRka2($post['bidangID']);  
            }

            $jumlah                = $this->Finalreport_m->getFRDMinJumlah($post);
            $frID = $post['frID']; 
            $frStatus             = $this->Finalreport_m->getFRDMinByFRID($frID)->result();
            foreach($frStatus as $row){
                $frReject[] = $row->status;
            }
            $post['statuskonf']    = 'send';   
                           
            if($jumlah->num_rows() == 0 || !in_array('reject', $frReject)){   
                if($this->input->post('send_up')){
                    $data = $this->fungsi_statusjml->sendRecive($jumlah->num_rows());
                    $post['jumlah'] = $data['jumlah'];
                    $post['status'] = $data['status'];
                }else if($this->input->post('send_down')){
                    $data = $this->fungsi_statusjml->sendReciveRevisi($jumlah->num_rows());
                    $post['jumlah'] = $data['jumlah'];
                    $post['status'] = $data['status']; 
                }

                $data1 = 'fr_internal';
                $file1 = $this->upload($post, $data1);
                $data2 = 'fr_lhv';
                $file2 = $this->upload($post, $data2);  
                $data3 = 'fr_dsr';
                $file3 = $this->upload($post, $data3);  
                $data4 = 'fr_coa';
                $file4 = $this->upload($post, $data4);  
                $data5 = 'fr_cow';
                $file5 = $this->upload($post, $data5);  
                $data6 = 'fr_cds';
                $file6 = $this->upload($post, $data6);  
                
                if($file1['status'] == TRUE && $file2['status'] == TRUE && $file3['status'] == TRUE && $file4['status'] == TRUE && $file5['status'] == TRUE && $file6['status'] == TRUE){
                    if($file1['name'] != null){
                        $post['fr_internal'] = $file1['name'];   
                    } else{
                        $post['fr_internal'] = $this->input->post('fr_internal_send');
                    }
                    if($file2['name'] != null){
                        $post['fr_lhv'] = $file2['name'];
                    } else{
                        $post['fr_lhv'] = $this->input->post('fr_lhv_send');
                    }
                    if($file3['name'] != null){
                        $post['fr_dsr'] = $file3['name'];
                    } else{
                        $post['fr_dsr'] = $this->input->post('fr_dsr_send');
                    }
                    if($file4['name'] != null){
                        $post['fr_coa'] = $file4['name'];
                    } else{
                        $post['fr_coa'] = $this->input->post('fr_coa_send');
                    }
                    if($file5['name'] != null){
                        $post['fr_cow'] = $file5['name'];
                    } else{
                        $post['fr_cow'] = $this->input->post('fr_cow_send');
                    }
                    if($file6['name'] != null){
                        $post['fr_cds'] = $file6['name'];
                    } else{
                        $post['fr_cds'] = $this->input->post('fr_cds_send');
                    }
                   

                    $postSend = array(     
                        'frID'           => $post['frID'],
                        'petugasID'      => $post['petugasID'],
                        'pengirimID'     => $post['pengirimID'],
                        'penerimaID'     => $post['penerimaID'],
                        'status'         => $post['status'],
                        'fr_internal'    => $post['fr_internal'],
                        'fr_lhv'         => $post['fr_lhv'],
                        'fr_dsr'         => $post['fr_dsr'],
                        'fr_coa'         => $post['fr_coa'],
                        'fr_cow'         => $post['fr_cow'],
                        'fr_cds'         => $post['fr_cds'],
                        'jumlah'         => $post['jumlah'],
                        'statuskonf'     => $post['statuskonf'],  
                        'comment'        => $post['comment'],  
                    );


                    $id = $this->Finalreport_m->addFRDetailMin($postSend);
                    if($this->db->affected_rows()>0){ 
                        if($this->fungsi->petugas_login()->subbidangID == 'MDM1'){
                            $response = array(
                                'status' 	    => 'success',
                                'id'            => $id
                            );
                        }else{
                            $response = array(
                                'status' 	    => 'success',
                            );
                        }
                    }
                } else{
                    $response  = array(
                        'status' 	    => 'gagal upload',
                    );
                } 
            }
        }
        $this->output->set_content_type('application/json');
        echo json_encode($response); 
    }

    ///////////////////////////////////////// End Upload Final Report Marine////////////////////////////////////////////

    function file_selected_test($post){
        if(!empty($_FILES[$post]['name']) != null) {
            return TRUE;
        }else{
            $this->form_validation->set_message('file_selected_test', '%s masih Kososng, Silahkan Upload File Quotaion');
            return FALSE;
        }
    }

    function check($post){
        $bool = filter_var($post, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE);
        if($bool === 'TRUE') {
            return TRUE;
        }else{
            $this->form_validation->set_message('check', '%s masih Kososng, Silahkan Di Klik');
            return FALSE;
        }
    }

    public function upload($post, $data1){
        if($post['bidangID'] == 1){
            $bidangNama = 'Marine';
        }else if($post['bidangID'] == 2){
            $bidangNama = 'Minerba';
        }

        $config = array();
        $config['upload_path'] =  './uploads/finalreport/'.$bidangNama.'/'.$data1;
        $config['allowed_types']   = 'pdf';
        $config['max_size']        = 2048;
        $config['file_name']       = $data1.'-'.$post['status'].'-'.date('ymd').'-'.substr(md5(rand()),0,10);
        $this->load->library('upload', $config, $data1);
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

    public function timeViewMarine(){
        $this->timeWorkFinalReportMarine();
        $response = array();
        $xproses = array();
        $getID    = $this->input->get('id');
        $waktu_sekarang = date('Y-m-d H:i:s');
        $data_query = $this->Finalreport_m->getFRDMarByIDDesc($getID)->row();
        $dataQuoMax = $this->Finalreport_m->getFRDMarMaxByFRID($data_query->frMarD_frID)->row();
        if($dataQuoMax->frMarDetailID > $getID){
            $checkAllDetailID[] = 'success';
        }else{
            $checkAllDetailID[] = 'proses';
        }
        $dataFR = $this->Finalreport_m->getFRDMarByFRID($data_query->frMarD_frID)->result();
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
                'status'    => $checkAllDetailID,
                'statusAll' => $xproses,
                'waktuEnd'  => $data_query->waktu_end,
            ); 
        }
        echo json_encode($response);
    }


    public function checkPenerima($subbidangPetugas){
        $file = array();
        // $subbidangPetugas = $this->fungsi->petugas_login()->subbidangID;
        $dataPenerimaDesc         = $this->Finalreport_m->getFRDMarMaxByPengirimID($subbidangPetugas)->result();
        if($dataPenerimaDesc != null){
            foreach($dataPenerimaDesc as $row){
                $frPenerimaID[] = $row->frMarDetailID;
            }
            $dataPenerima     = $this->Finalreport_m->getFRDMarByIDDesc($frPenerimaID)->result();
            foreach($dataPenerima as $row1){
                $file[] = array(
                    'frDetailID' => $row1->frMarDetailID,
                    'frID'       => $row1->frMarD_frID,
                    'orderID'    => $row1->frMar_orderID
                );
            } 
        }
        return $file;
    }

    public function timeWorkFinalReportMarine(){   
        $file1          = array();
        $fileDetailID   = array();
        $detailID       = array();
        $post           = array();
        $response       = array();
        $petugasID      = $this->fungsi->petugas_login()->subbidangID;
        $dataPenerima   = $this->checkPenerima($petugasID);
        $waktu_sekarang = date('Y-m-d H:i:s');
        foreach($dataPenerima as $row){
            $detailID[] = $row['frDetailID'];
            $id[]       = $row['frID'];
            $orderID[]  = $row['orderID'];
        }

        $dataPengirimDesc = $this->Finalreport_m->getFRDMarBypengirimID($id, $petugasID)->result();
        if($dataPengirimDesc != null){
            foreach($dataPengirimDesc as $row1){
                if(in_array($row1->frMarD_frID, $id)){
                    $file1[] = $row1->frMarD_frID; //Data Pengirim ADA 
                    $fileDetailID[] = $row1->frMarDetailID; //Data Pengirim ADA 
                }
            }
        // //     //////////////////Jika Petugas Sudah Menerima Dan Mengirimkan FR ID////////////////////////////
            $dataFR = $this->Finalreport_m->getFRDMarMaxByPengirimFRID($file1, $petugasID)->result();
            foreach($dataFR as $row2){
                $frDetailIDDesc[] = $row2->frMarDetailID;
            }
            
            $dataPegirim = $this->Finalreport_m->getFRDMarByIDDesc($frDetailIDDesc)->result();
            foreach($dataPegirim as $row3){
                $dataDetailCheck = $this->Finalreport_m->getFRDMarMaxByPenerimaFRID($row3->frMarD_frID, $petugasID)->row();
                $dataPenerimaCheck = $this->Finalreport_m->getFRDMarByIDDesc($dataDetailCheck->frMarDetailID)->row();
                if($row3->frMarD_frID == $dataPenerimaCheck->frMarD_frID){
                    $file2[] = $row3->frMarD_frID; //Data Pengirim ADA 
                    if($dataDetailCheck->frMarDetailID > $row3->frMarDetailID){
                        $xid[] = $row3->frMarDetailID;
                        // $xd[] = " DetailID : ". $dataDetailCheck->frMarDetailID.">".$row3->frMarDetailID;//Exekusi TimeOut
                        $waktux[] = $row3->waktu_end;
                        if($dataPenerimaCheck->waktu_end != null){
                            if($dataPenerimaCheck->status != 'success'){
                                if($waktu_sekarang > $dataPenerimaCheck->waktu_end){
                                    $frData1              = $this->Finalreport_m->getFRMarByID($row3->frMarD_frID)->row();
                                    $post['spkID']       = $frData1->frMar_spkID;
                                    $post['status']      = 'RJ1';//Reject Waktu
                                    $post['frDetailID'] = $dataPenerimaCheck->frMarDetailID;
                                    $this->Spk_m->setSpkStatus($post);
                                    $this->Finalreport_m->setFRDMarStatus($post);
                                }
                            } 
                        }
                    }
                }
            }

        //     /////////////////////////////Jika Petugas hanya menerima FR ID////////////////////////////
            $pengirimNull     = array_diff($id, $file1); //Data Pengirim Tidak Ada
            if($pengirimNull != null){
                $dataPenerimaNull = $this->Finalreport_m->getFRDMarByFRID($pengirimNull)->result();
                foreach($dataPenerimaNull as $row4){
                    $dataDetailCheck1 = $this->Finalreport_m->getFRDMarMaxByPenerimaFRID($row4->frMarD_frID, $petugasID)->row();
                    $dataPenerimaCheck1 = $this->Finalreport_m->getFRDMarByIDDesc($dataDetailCheck1->frMarDetailID)->row();
                    if($row4->frMarD_frID == $dataPenerimaCheck1->frMarD_frID){
                        $x1 = $row4->frMarDetailID ;
                        // $x = $dataPenerimaCheck1->quoD_quoID;
                        // if($dataPenerimaCheck1->frMarDetailID > $row4->frMarDetailID){
                            $z = $row4->frMarDetailID;
                            // $waktu1[] = $dataPenerimaCheck1->waktu_end;
                            if($dataPenerimaCheck1->waktu_end != null){
                                if($dataPenerimaCheck1->status != 'success'){
                                    if($waktu_sekarang > $dataPenerimaCheck1->waktu_end){
                                        $frData2              = $this->Finalreport_m->getFRMarByID($row4->frMarD_frID)->row();
                                        $post['spkID']       = $frData2->frMar_spkID;
                                        $post['status']      = 'RJ1';//Reject Waktu
                                        $post['frDetailID'] = $dataPenerimaCheck1->frMarDetailID;
                                        $this->Spk_m->setSpkStatus($post);
                                        $this->Finalreport_m->setFRDMarStatus($post);
                                      
                                    }
                                }
                            }
                        // }
                    }
                }
            }
            
        }else{//Data Pertama sekali

            $dataPenerimax = $this->Finalreport_m->getFRDMarByPenerimaID($id, $petugasID)->result();
            foreach($dataPenerimax as $rowx){
                $waktu[] = $rowx->waktu_end;
                if($rowx->waktu_end != null){
                    if($rowx->status != 'success'){
                        if($waktu_sekarang > $rowx->waktu_end){
                            $frDatax              = $this->Finalreport_m->getFRMarByID($rowx->frMarD_frID)->row();
                            $post['spkID']     = $frDatax->frMar_spkID;
                            $post['status']      = 'RJ1';//Reject Waktu
                            $post['frDetailID'] = $rowx->frMarDetailID;
                            $this->Spk_m->setSpkStatus($post);
                            $this->Finalreport_m->setFRDMarStatus($post);
                           
                        }
                    }
                }
            }
        } 
    }



    ///////////////////////////////////////////////////////////

    public function timeViewMinerba(){
        $this->timeWorkFinalReportMinerba();
        $response = array();
        $xproses = array();
        $getID    = $this->input->get('id');
        $waktu_sekarang = date('Y-m-d H:i:s');
        $data_query = $this->Finalreport_m->getFRDMinByIDDesc($getID)->row();
        $dataQuoMax = $this->Finalreport_m->getFRDMinMaxByFRID($data_query->frMinD_frID)->row();
        if($dataQuoMax->frMinDetailID > $getID){
            $checkAllDetailID[] = 'success';
        }else{
            $checkAllDetailID[] = 'proses';
        }
        $dataFR = $this->Finalreport_m->getFRDMinByFRID($data_query->frMinD_frID)->result();
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
                'status'    => $checkAllDetailID,
                'statusAll' => $xproses,
                'waktuEnd'  => $data_query->waktu_end,
            ); 
        }
        echo json_encode($response);
    }


    public function checkPenerimaMinerba(){
        $file = array();
        $subbidangPetugas = $this->fungsi->petugas_login()->subbidangID;
        $dataPenerimaDesc         = $this->Finalreport_m->getFRDMinMaxByPenerimaID($subbidangPetugas)->result();
        if($dataPenerimaDesc != null){
            foreach($dataPenerimaDesc as $row){
                $frPenerimaID[] = $row->frMinDetailID;
            }
            $dataPenerima     = $this->Finalreport_m->getFRDMinByIDDesc($frPenerimaID)->result();
            foreach($dataPenerima as $row1){
                $file[] = array(
                    'frDetailID' => $row1->frMinDetailID,
                    'frID'       => $row1->frMinD_frID,
                    'orderID'    => $row1->frMin_orderID
                );
            } 
        }
        return $file;
        // echo json_encode($dataPenerima);
    }

    public function timeWorkFinalReportMinerba(){   
        $file1          = array();
        $fileDetailID   = array();
        $detailID       = array();
        $post           = array();
        $response       = array();
        $petugasID      = $this->fungsi->petugas_login()->subbidangID;
        $dataPenerima   = $this->checkPenerimaMinerba($petugasID);
        $waktu_sekarang = date('Y-m-d H:i:s');
        foreach($dataPenerima as $row){
            $detailID[] = $row['frDetailID'];
            $id[]       = $row['frID'];
            $orderID[]  = $row['orderID'];
        }

        $dataPengirimDesc = $this->Finalreport_m->getFRDMinByPengirimFRID($id, $petugasID)->result();
        if($dataPengirimDesc != null){
            foreach($dataPengirimDesc as $row1){
                if(in_array($row1->frMinD_frID, $id)){
                    $file1[] = $row1->frMinD_frID; //Data Pengirim ADA 
                    $fileDetailID[] = $row1->frMinDetailID; //Data Pengirim ADA 
                }
            }
        // //     //////////////////Jika Petugas Sudah Menerima Dan Mengirimkan FR ID////////////////////////////
            $dataFR = $this->Finalreport_m->getFRDMinMaxByPengirimFRID($file1, $petugasID)->result();
            foreach($dataFR as $row2){
                $frDetailIDDesc[] = $row2->frMinDetailID;
            }
            
            $dataPegirim = $this->Finalreport_m->getFRDMinByIDDesc($frDetailIDDesc)->result();
            foreach($dataPegirim as $row3){
                $dataDetailCheck = $this->Finalreport_m->getFRDMinMaxByPenerimaFRID($row3->frMinD_frID, $petugasID)->row();
                $dataPenerimaCheck = $this->Finalreport_m->getFRDMinByIDDesc($dataDetailCheck->frMinDetailID)->row();
                if($row3->frMinD_frID == $dataPenerimaCheck->frMinD_frID){
                    $file2[] = $row3->frMinD_frID; //Data Pengirim ADA 
                    if($dataDetailCheck->frMinDetailID > $row3->frMinDetailID){
                        $xid[] = $row3->frMinDetailID;
                        // $xd[] = " DetailID : ". $dataDetailCheck->frMinDetailID.">".$row3->frMinDetailID;//Exekusi TimeOut
                        $waktux[] = $row3->waktu_end;
                        if($dataPenerimaCheck->waktu_end != null){
                            if($dataPenerimaCheck->status != 'success'){
                                if($waktu_sekarang > $dataPenerimaCheck->waktu_end){
                                    $frData1              = $this->Finalreport_m->getFRMinByID($row3->frMinD_frID)->row();
                                    $post['spkID']       = $frData1->frMin_spkID;
                                    $post['status']      = 'RJ1';//Reject Waktu
                                    $post['frDetailID'] = $dataPenerimaCheck->frMinDetailID;
                                    $this->Spk_m->setSpkStatus($post);
                                    $this->Finalreport_m->setFRDMinStatus($post);
                                }
                            } 
                        }
                    }
                }
            }

        //     /////////////////////////////Jika Petugas hanya menerima FR ID////////////////////////////
            $pengirimNull     = array_diff($id, $file1); //Data Pengirim Tidak Ada
            if($pengirimNull != null){
                $dataPenerimaNull = $this->Finalreport_m->getFRDMinByFRID($pengirimNull)->result();
                foreach($dataPenerimaNull as $row4){
                    $dataDetailCheck1 = $this->Finalreport_m->getFRDMinMaxByPenerimaFRID($row4->frMinD_frID, $petugasID)->row();
                    $dataPenerimaCheck1 = $this->Finalreport_m->getFRDMinByIDDesc($dataDetailCheck1->frMinDetailID)->row();
                    if($row4->frMinD_frID == $dataPenerimaCheck1->frMinD_frID){
                        $x1 = $row4->frMinDetailID ;
                        // $x = $dataPenerimaCheck1->quoD_quoID;
                        // if($dataPenerimaCheck1->frMinDetailID > $row4->frMinDetailID){
                            $z = $row4->frMinDetailID;
                            // $waktu1[] = $dataPenerimaCheck1->waktu_end;
                            if($dataPenerimaCheck1->waktu_end != null){
                                if($dataPenerimaCheck1->status != 'success'){
                                    if($waktu_sekarang > $dataPenerimaCheck1->waktu_end){
                                        $frData2              = $this->Finalreport_m->getFRMinByID($row4->frMinD_frID)->row();
                                        $post['spkID']       = $frData2->frMin_spkID;
                                        $post['status']      = 'RJ1';//Reject Waktu
                                        $post['frDetailID'] = $dataPenerimaCheck1->frMinDetailID;
                                        $this->Spk_m->setSpkStatus($post);
                                        $this->Finalreport_m->setFRDMinStatus($post);
                                      
                                    }
                                }
                            }
                        // }
                    }
                }
            }
            
        }else{//Data Pertama sekali

            $dataPenerimax = $this->Finalreport_m->getFRDMinByPenerimaFRID($id, $petugasID)->result();
            foreach($dataPenerimax as $rowx){
                $waktu[] = $rowx->waktu_end;
                if($rowx->waktu_end != null){
                    if($rowx->status != 'success'){
                        if($waktu_sekarang > $rowx->waktu_end){
                            $frDatax              = $this->Finalreport_m->getFRMinByID($rowx->frMinD_frID)->row();
                            $post['spkID']     = $frDatax->frMin_spkID;
                            $post['status']      = 'RJ1';//Reject Waktu
                            $post['frDetailID'] = $rowx->frMinDetailID;
                            $this->Spk_m->setSpkStatus($post);
                            $this->Finalreport_m->setFRDMinStatus($post);
                           
                        }
                    }
                }
            }
        } 

        // echo json_encode($dataPengirimDesc);
    }




}
<?php defined('BASEPATH') OR exit('No direct script access allowed');

//Di Bagian Invoicing Hanya Bisa di akses oleh MD dan FM dan admin
class InvoicingDraft extends CI_Controller {

    function __construct(){
        parent::__construct();
        check_not_petugas();

        $this->load->model(['Finalreport_m', 'InvoicingApproval_m', 'Subbidang_m', 'Order_m', 'Spk_m', 'Jobdesc_m']);
        $this->load->library('form_validation');
    }

    //FUngsi ini untuk membuat ID Draft Invoicing, 
    //di bagian Marine yang membuat draft yaitu 'MDM1' sedangkan di bagian Minerba 'FM'
    public function viewAddInvID($id){
        $bidangID = $this->fungsi->petugas_login()->bidangID;
        $petugas = $this->fungsi->petugas_login()->subbidangID;
        if($bidangID == 1){
            $data['row'] = $this->Finalreport_m->getFRDMarByIDDesc($id)->row();
            $data['rowSPK'] = $this->Spk_m->getSpkByID($data['row']->frMar_spkID)->row();
            $data['rowJobDesc'] = $this->Jobdesc_m->getJobdscDByDetailIDDesc($data['row']->frMar_jobdaDetailID)->row();
            $data['rowBidang'] = 'Marine';
            $data['rowINV'] = $this->InvoicingApproval_m->getInvMarByFRID($data['row']->frMarDetailID)->row();
            if($data['rowINV'] != null){
                $data['rowInvDetail'] = $this->InvoicingApproval_m->getInvDMarByInvID($data['rowINV']->invMarID)->row();
            }
            $this->load->view('petugas/invoicing_draft/draftinv_marine_create', $data);
        }else if($petugas == 'FM'){ //Minerba
            $data['row'] = $this->Finalreport_m->getFRDMinByID($id)->row();
            $data['rowSPK'] = $this->Spk_m->getSpkByID($data['row']->frMin_spkID)->row();
            $data['rowJobDesc'] = $this->Jobdesc_m->getJobdscDByDetailIDDesc($data['row']->frMin_jobdaDetailID)->row();
            $data['rowBidang'] = 'Minerba';
            $data['rowINV'] = $this->InvoicingApproval_m->getInvMinByFRID($data['row']->frMinDetailID)->row();
            if($data['rowINV'] != null){
                $data['rowInvDetail'] = $this->InvoicingApproval_m->getInvDMinByInvID($data['rowINV']->invMinID)->row();
            }
            $this->load->view('petugas/invoicing_draft/draftInv_minerba_create', $data);
        }
        // echo json_encode($dataQuoDetail);
    }

    public function addInvID(){
        $response = array();
        $this->form_validation->set_rules('invNo', 'invNo', 'required|callback_check_invNo');
        $this->form_validation->set_rules('referencingNo', 'referencingNo', 'required');
        $this->form_validation->set_rules('frDetailID', 'frDetailID', 'required');
        $this->form_validation->set_rules('spkID', 'spkID', 'required');
        $this->form_validation->set_rules('orderID', 'orderID', 'required');
        
        $this->form_validation->set_message('required', '%s masih Kososng, atau belum di pilih Silahkan Di isi');
        $this->form_validation->set_message('is_unique', '{field} ini sudah dipakai, silahkan ganti');
 
        if($this->form_validation->run() == FALSE){
			$response = array(
                'status' 	       => 'error',
                'invNo' 		   => form_error('invNo'),
                'referencingNo'    => form_error('referencingNo'),
                'frDetailID'       => form_error('frDetailID'),
                'spkID'            => form_error('spkID'),
                'orderID'          => form_error('orderID'),
            );
		} 
		else{
            // $post = $this->input->post(null, TRUE);
            $invNo         = $this->input->post('invNo');
            $referencingNo = $this->input->post('referencingNo');
            $frDetailID    = $this->input->post('frDetailID');
            $spkID         = $this->input->post('spkID');
            $jobdescID     = $this->input->post('jobdescID');
            $quoDetailID     = $this->input->post('quoDetailID');
            $orderID       = $this->input->post('orderID');

            $bidangID = $this->fungsi->petugas_login()->bidangID;
            $petugas = $this->fungsi->petugas_login()->subbidangID;
            date_default_timezone_set("Asia/Jakarta");
            if($bidangID == 1){
                $bidang = 'MAR';
                $frData = $this->Finalreport_m->getFRDMarByIDDesc($frDetailID)->row();
                $frBidangID = $frData->frMar_bidangID;
                $invDraft   = $this->InvoicingApproval_m->getInvMarMax()->row(); 
                $invID = (int) substr($invDraft->invMarID, 12, 4);
                $invID++;
            }else if($petugas == 'FM'){
                $bidang = 'MIN';
                $frData = $this->Finalreport_m->getFRDMinByIDDesc($frDetailID)->row();
                $frBidangID = $frData->frMin_bidangID;
                $invDraft   = $this->InvoicingApproval_m->getInvMinMax()->row(); 
                $invID = (int) substr($invDraft->invMinID, 12, 4);
                $invID++;
            }
            //////////Create ID//////////
            $char    = 'INV';
            $date    = date("Y-m-d");
            $tahun   = substr($date, 0, 2);
            $bulan   = substr($date, 5, 2);
            $hari    = substr($date, 8, 2);
            
            $newInvID = $char.$bidang.$tahun.$bulan.$hari.sprintf("%04s", $invID);

            /////////////End Create ID////////////
            $postSend = array(     
                'invID'         => $newInvID,
                'invNo'         => $invNo,
                'invRefNo'      => $referencingNo,
                'frDetailID'    => $frDetailID,
                'spkID'         => $spkID,
                'jobdaDetailID' => $jobdescID,
                'quoDetailID'   => $quoDetailID,
                'orderID'       => $orderID,
                'bidangID'      => $frBidangID
            );

            if($bidangID == 1){
                $this->InvoicingApproval_m->addInvMar($postSend);

                if($this->db->affected_rows()>0){
                    
                    $response = array(
                        'status' 	    => 'success',
                        'id'            => $newInvID
                    );
                } 
            }
            else if($bidangID == 2 || $petugas == 'FM'){
                $this->InvoicingApproval_m->addInvMin($postSend);
                if($this->db->affected_rows()>0){
                    $response = array(
                        'status' 	    => 'success',
                        'id'            => $newInvID
                    );
                } 
            }
        }
        echo json_encode($response);
    }

    public function check_invNo(){
        // $jobdNo = "INV-MAR-001";
        $jobdNo = $this->input->post('invNo');
        $statusJobd = array();
        $jobdID = array();
        $jobdDetailID = array();

        $bidangID = $this->fungsi->petugas_login()->bidangID;
        $petugas = $this->fungsi->petugas_login()->subbidangID;

        if($bidangID == 1){
            $jobd = $this->InvoicingApproval_m->getInvMarByNoDesc($jobdNo)->row();
            if($jobd != null){ 
                $jobdID = $jobd->invMarID;
                $jobdDetail = $this->InvoicingApproval_m->getInvDMarByInvID($jobdID)->result();
                if($jobdDetail != null){
                    foreach($jobdDetail as $row3){
                        $jobdDetailID[] = $row3->invMarDetailID;
                        $statusJobd[] =  $row3->status;
                    }
                    if(in_array("success", $statusJobd)){
                        $this->form_validation->set_message('check_invNo', '{field} ini sudah di Gunakan, dan datanya sudah ada approval, silahkan di ganti');
                        // $data['proses1'] = 'proses1';
                        return FALSE;     
                    }else{   
                        if(in_array("reject", $statusJobd)){ 
                            // $data['proses2'] = 'proses2TRUE';
                            return TRUE;    
                        }else{
                            $this->form_validation->set_message('check_invNo', '{field} ini Masih Di Proses');
                            return FALSE;    
                            // $data['proses2'] = 'proses2FALSE';
                        }
                    }
                }else{
                    return TRUE;
                    // $data['proses3'] = 'proses3TRUE';
                }
                
            }else{
                return TRUE;
            }
            // echo json_encode($data);

        }else if($petugas == 'FM'){
            $jobd = $this->InvoicingApproval_m->getInvMinByNoDesc($jobdNo)->row();
            if($jobd != null){ 
                $jobdID = $jobd->invMinID;
                $jobdDetail = $this->InvoicingApproval_m->getInvDMinByInvID($jobdID)->result();
                if($jobdDetail != null){
                    foreach($jobdDetail as $row3){
                        $jobdDetailID[] = $row3->invMinDetailID;
                        $statusJobd[] =  $row3->status;
                    }
                    if(in_array("success", $statusJobd)){
                        $this->form_validation->set_message('check_invNo', '{field} ini sudah di Gunakan, dan datanya sudah ada approval, silahkan di ganti');
                        // $data['proses1'] = 'proses1';
                        return FALSE;     
                    }else{   
                        if(in_array("reject", $statusJobd)){ 
                            // $data['proses2'] = 'proses2TRUE';
                            return TRUE;    
                        }else{
                            $this->form_validation->set_message('check_invNo', '{field} ini Masih Di Proses');
                            return FALSE;    
                            // $data['proses2'] = 'proses2FALSE';
                        }
                    }
                }else{
                    return TRUE;
                    // $data['proses3'] = 'proses3TRUE';
                }



            }else{
                return TRUE;
            }
        }

        


     }

    public function viewNewDraftInv(){
        $post['penerima'] = $this->fungsi->petugas_login()->subbidangID;
        $bidangID = $this->fungsi->petugas_login()->bidangID;
        
        if($bidangID == 1 || $post['penerima'] == 'FM'){
            $this->load->view('petugas/invoicing_draft/draftInv_marine_new');
        }else if($bidangID == 2){
            $this->load->view('petugas/invoicing_draft/draftInv_minerba_new');
        }
    }
   
 

    public function konfirmasiInvMar($id){
        // $id = 66;
        $dataInvDetail['statusConf']  = 'read';
        $dataInvDetail['invDetailID'] = $id;
        $data['petugasLogin']         = $this->fungsi->petugas_login()->subbidangID;
        $bidangID                     = $this->fungsi->petugas_login()->bidangID;
        $data['waktusekarang']        = date('Y-m-d H:i:s');
        $petugas = array();
        $dataQuoDetail['statusConf']   = 'read';
        $dataQuoDetail['frDetailID']   = $id;
        $dataQuoDetail['waktustart']   = date('Y-m-d H:i:s');
        $dataQuoDetail['waktuend']     = date('Y-m-d H:i:s',strtotime('+30 minutes',strtotime($dataQuoDetail['waktustart'])));

        if($bidangID == 1 || $data['petugasLogin'] == 'FM'){
            $data_query                = $this->InvoicingApproval_m->getInvDMarByIDDesc($id)->row();
            $data['rowFR']             = $this->Finalreport_m->getFRDMarByIDDesc($data_query->invMar_frDetailID)->row();
            $data['rowSPK']            = $this->Spk_m->getSpkByID($data_query->invMar_spkID)->row();
            $data['rowJobdesc']        = $this->Jobdesc_m->getJobdscDByDetailIDDesc($data_query->invMar_jobdaDetailID)->row();
            $petugas                    = $data_query->invMarD_penerimaID;
            $data['rowBidang']        = 'Marine';

            if($data['petugasLogin']  == $petugas){
                if($data_query->waktu_start == null && $data_query->waktu_end == null){
                    $this->InvoicingApproval_m->setInvDMarStatusKonf($dataQuoDetail);
                }
                $data['rowINV'] = $this->InvoicingApproval_m->getInvDMarByIDDesc($id)->row();
                $data['rowClient'] = $this->Order_m->getAllByID($data['rowINV']->invMar_orderID)->row();
                $this->load->view('petugas/invoicing_draft/draftInv_marine_konfirmasi', $data);
            }
            else{
                $data['rowINV'] = $this->InvoicingApproval_m->getInvDMarByIDDesc($id)->row();
                $data['rowClient'] = $this->Order_m->getAllByID($data['rowINV']->invMar_orderID)->row();
                $this->load->view('petugas/invoicing_draft/draftInv_marine_konfirmasi', $data);
            } 

        }


         
        // echo json_encode($data);
    }

    public function konfirmasiInvMin($id){
        $timeWork = $this->fungsi_timework->timework();
        // $id = 66;
        $dataInvDetail['statusConf']  = 'read';
        $dataInvDetail['invDetailID'] = $id;
        $data['petugasLogin']         = $this->fungsi->petugas_login()->subbidangID;
        $bidangID                     = $this->fungsi->petugas_login()->bidangID;
        $data['waktusekarang']        = date('Y-m-d H:i:s');
        $petugas = array();
        $dataQuoDetail['statusConf']   = 'read';
        $dataQuoDetail['frDetailID']   = $id;
        $dataQuoDetail['waktustart']   = date('Y-m-d H:i:s');
        $dataQuoDetail['waktuend']     = date('Y-m-d H:i:s',strtotime('+'.$timeWork.' minutes',strtotime($dataQuoDetail['waktustart'])));

        if($bidangID == 2 || $data['petugasLogin'] == 'FM'){
            $data_query        = $this->InvoicingApproval_m->getInvDMinByIDDesc($id)->row();
            $data['rowFR']             = $this->Finalreport_m->getFRDMinByIDDesc($data_query->invMin_frDetailID)->row();
            $data['rowSPK']            = $this->Spk_m->getSpkByID($data_query->invMin_spkID)->row();
            $data['rowJobdesc']        = $this->Jobdesc_m->getJobdscDByDetailIDDesc($data_query->invMin_jobdaDetailID)->row();
            $data['rowBidang']        = 'Minerba';
            $petugas                     = $data_query->invMinD_pengirimID;

            if($data['petugasLogin']  != $petugas){
                if($data_query->waktu_start == null && $data_query->waktu_end == null){
                    $this->InvoicingApproval_m->setInvDMinStatusKonf($dataQuoDetail);
                }


                $data['rowINV'] = $this->InvoicingApproval_m->getInvDMinByIDDesc($id)->row();
                $data['rowClient'] = $this->Order_m->getAllByID($data['rowINV']->invMin_orderID)->row();
                $this->load->view('petugas/invoicing_draft/draftInv_minerba_konfirmasi', $data);
            }
            else{

                $data['rowINV'] = $this->InvoicingApproval_m->getInvDMinByIDDesc($id)->row();
                $data['rowClient'] = $this->Order_m->getAllByID($data['rowINV']->invMin_orderID)->row();
                $this->load->view('petugas/invoicing_draft/draftInv_minerba_konfirmasi', $data);
            } 

            
        }


         
        // echo json_encode($data);
    }


    /////////////////////////////////////////////MARINE/////////////////////////////////////////////////////////////////
    //viewfailedDraftInv, getNewFailedInv, revisiInv hanya di bagian Bidang Marine, sedangkan minerba tidak perlu

     //Bagian New getNewInv yang ini bisa di akses oleh Marine, karena datanya di buat dan dikirimkan oleh MDM1, 
    //sehingga Masih ada proses pengecekan dari FM apakah sudah sesuai atau belum,
    //sedangkan untuk MINERBA tidak perlu, karena langsung di approv oleh FM.
    public function getNewInv(){
        $bidangID = $this->fungsi->petugas_login()->bidangID;
        $post['penerima'] = $this->fungsi->petugas_login()->subbidangID;
        if($post['penerima'] == 'FM'){
            $post['pengirim'] = $this->fungsi_send->sendreceiverRka2(1);
            $data = $this->InvoicingApproval_m->getInvDMarByPetugasIDNew($post)->result();
            foreach($data as $row1){
                $dataFR = $this->Finalreport_m->getFRDMarByIDDesc($row1->invMar_frDetailID)->row();
                $dataSPK = $this->Spk_m->getSpkByID($row1->invMar_spkID)->row();
                $dataJobdesc = $this->Jobdesc_m->getJobdscDByDetailIDDesc($row1->invMar_jobdaDetailID)->row();
                $arrayData[] = array(
                    'invDetailID'    => $row1->invMarDetailID,
                    'invID'          => $row1->invMarD_invID,
                    'invNo'          => $row1->invMarNo,
                    'frID'           => $dataFR->frMarD_frID,
                    'jobdApprovNo'   => $dataJobdesc->jobdApprovNo,
                    'spkNo'          => $dataSPK->spkNo,
                    'petugas'        => $row1->petugasNama,
                    'status'         => $row1->status,
                    'waktu'          => $row1->waktu,

                );
            }
        }
        echo json_encode($arrayData);
    }

    public function viewfailedDraftInv(){
        $this->load->view('petugas/invoicing_draft/draftInv_marine_failed');
    }

    public function getNewFailedInv(){
        $post['penerima'] = $this->fungsi->petugas_login()->subbidangID;
        $post['pengirim'] = 'FM';
        $data = $this->InvoicingApproval_m->getInvDMarByPetugasIDNew($post)->result();
        foreach($data as $row1){
            $dataFR = $this->Finalreport_m->getFRDMarByIDDesc($row1->invMar_frDetailID)->row();
            $dataSPK = $this->Spk_m->getSpkByID($row1->invMar_spkID)->row();
            $dataJobdesc = $this->Jobdesc_m->getJobdscDByDetailIDDesc($row1->invMar_jobdaDetailID)->row();
            $arrayData[] = array(
                'invDetailID'    => $row1->invMarDetailID,
                'invID'          => $row1->invMarD_invID,
                'invNo'          => $row1->invMarNo,
                'frID'           => $dataFR->frMarD_frID,
                'jobdApprovNo'   => $dataJobdesc->jobdApprovNo,
                'spkNo'          => $dataSPK->spkNo,
                'petugas'        => $row1->petugasNama,
                'status'         => $row1->status,
                'waktu'          => $row1->waktu,

            );
        }
        echo json_encode($arrayData); 
    }

   

    public function revisiInv($id){
        $timeWork = $this->fungsi_timework->timework();
        $dataInvDetail['statusConf']  = 'read';
        $dataInvDetail['invDetailID'] = $id;
        $data['petugasLogin']         = $this->fungsi->petugas_login()->subbidangID;
        $bidangID                     = $this->fungsi->petugas_login()->bidangID;
        $data['waktusekarang']        = date('Y-m-d H:i:s');
        $petugas = array();
        $dataQuoDetail['statusConf']   = 'read';
        $dataQuoDetail['frDetailID']   = $id;
        $dataQuoDetail['waktustart']   = date('Y-m-d H:i:s');
        $dataQuoDetail['waktuend']     = date('Y-m-d H:i:s',strtotime('+'.$timeWork.' minutes',strtotime($dataQuoDetail['waktustart'])));


        if($bidangID == 1 || $data['petugasLogin'] == 'FM'){
            $data_query                = $this->InvoicingApproval_m->getInvDMarByIDDesc($id)->row();
            $data['rowFR']             = $this->Finalreport_m->getFRDMarByIDDesc($data_query->invMar_frDetailID)->row();
            $data['rowSPK']            = $this->Spk_m->getSpkByID($data_query->invMar_spkID)->row();
            $data['rowJobdesc']        = $this->Jobdesc_m->getJobdscDByDetailIDDesc($data_query->invMar_jobdaDetailID)->row();
            $petugas                    = $data_query->invMarD_pengirimID;
            $data['rowBidang']        = 'Marine';

            if($data['petugasLogin']  != $petugas){
                if($data_query->waktu_start == null && $data_query->waktu_end == null){
                    $this->InvoicingApproval_m->setInvDMarStatusKonf($dataQuoDetail);
                }
                $data['rowINV'] = $this->InvoicingApproval_m->getInvDMarByIDDesc($id)->row();
                $data['rowClient'] = $this->Order_m->getAllByID($data['rowINV']->invMar_orderID)->row();
                $this->load->view('petugas/invoicing_draft/draftInv_marine_revisi', $data);
            }
            else{
                $data['rowINV'] = $this->InvoicingApproval_m->getInvDMarByIDDesc($id)->row();
                $this->load->view('petugas/invoicing_draft/draftInv_marine_revisi', $data);
            } 

        }


       
    }


    

////////////////////////////////////////////MARINE AKSES////////////////////////////////////////////////////////////////////

    public function viewUploadInv($id){
        $bidangID = $this->fungsi->petugas_login()->bidangID;
        $petugas = $this->fungsi->petugas_login()->subbidangID;
        if($bidangID == 1){
            $data['rowBidang'] ='Marine';
            $data['row'] = $this->InvoicingApproval_m->getInvMarByID($id)->row();
            $this->load->view('petugas/invoicing_draft/draftInv_marine_upload', $data);
        }else if($bidangID == 2 || $petugas == 'FM'){
            $data['rowBidang'] ='Minerba';
            $data['row'] = $this->InvoicingApproval_m->getInvMinByID($id)->row();
            $this->load->view('petugas/invoicing_draft/draftInv_minerba_upload', $data);
        }

        // echo json_encode($data);
    }
//////////////////////////////////////Invoice Upload//////////////////////////////////////////////

////////////////////////////////////////////Upload File//////////////////////////////////////////
    public function saveMarInvFile(){  
        $response = array(); 
        $this->form_validation->set_rules('invID', 'invID', 'required');
        if($this->input->post('draftInvFile')){
            $this->form_validation->set_rules('draftInvFile', 'draftInvFile', 'callback_file_selected_test');
        }
        $this->form_validation->set_message('required', '%s masih Kososng, atau belum di pilih Silahkan Di isi');
        if($this->form_validation->run() == FALSE){
			$response = array(
                'status' 	    => 'error',
                'invID' 		=> form_error('invID'),
                'draftInvFile' 		=> form_error('draftInvFile'),
            );   
        } 
        else{
            $post['invID']         = $this->input->post('invID'); 
            $post['comentINV']     = $this->input->post('comentINV'); 
            $invID                 = $post['invID'];                   
            $post['petugasID']     = $this->fungsi->petugas_login()->petugasID;
            $post['pengirimID']    = $this->fungsi->petugas_login()->subbidangID;
            $post['bidangID']      = $this->input->post('bidangID');    
            $invData = $this->InvoicingApproval_m->getInvMarByID($invID)->row();
            if($this->input->post('send_up')){
                $post['penerimaID']    = $this->fungsi_send->sendreceiverRka1($post['bidangID']);
            } else if($this->input->post('send_down')){
                $post['penerimaID']    = $this->fungsi_send->sendreceiverRka2($post['bidangID']);  
            } else if($this->input->post('send_approval')){
                $post['penerimaID']    ='AM1';  
            }
            $jumlah                = $this->InvoicingApproval_m->getInvDMarJumlah($post);
            $invStatus             = $this->InvoicingApproval_m->getInvDMarByInvID($invID)->result();
            foreach($invStatus as $row){
                $invReject[] = $row->status;
            }
            $post['statuskonf']    = 'send';    
                            

            if($jumlah->num_rows() == 0 || !in_array('reject', $invReject)){ 
                if($this->input->post('send_up')){
                    $data = $this->fungsi_statusjml->sendRecive($jumlah->num_rows());
                    $post['jumlah'] = $data['jumlah'];
                    $post['status'] = $data['status'];
                }else if($this->input->post('send_down')){
                    $data = $this->fungsi_statusjml->sendReciveRevisi($jumlah->num_rows());
                    $post['jumlah'] = $data['jumlah'];
                    $post['status'] = $data['status']; 
                }
                else if($this->input->post('send_approval')){
                    $data = $this->fungsi_statusjml->sendReciveRevisi($jumlah->num_rows());
                    $post['jumlah'] = $data['jumlah'];
                    $post['status'] = "NW1"; 
                }
                $fileName = 'draftInvFile';
                $file  = $this->upload($post, $fileName);
                if($file['status'] == true){
                    if($file['name'] != null){
                        $post['draftInvFile'] = $file['name']; 
                    } else{
                        $post['draftInvFile'] =  $this->input->post('send_draftInvFile');
                    }

                    $postSend = array(     
                        'invID'         => $post['invID'],
                        'petugasID'     => $post['petugasID'],
                        'pengirimID'    => $post['pengirimID'],
                        'penerimaID'    => $post['penerimaID'],
                        'status'        => $post['status'],
                        'draftInvFile'  => $post['draftInvFile'],     
                        'jumlah'        => $post['jumlah'],
                        'statuskonf'    => $post['statuskonf'],
                        'comentINV'     => $post['comentINV'],
                        
                    );

                   
                
                    $this->InvoicingApproval_m->addInvDMar($postSend);
                    if($this->db->affected_rows()>0){ 
                        if($this->input->post('new_upload')){
                            $post['status']      = 'SC1';//Reject Waktu
                            $post['frDetailID'] = $invData->invMar_frDetailID;
                            $this->Finalreport_m->setFRDMarStatus($post);
                        }
                       

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


    function file_selected_test(){
        if(!empty($_FILES['draftInvFile']['name']) != null) {
            return TRUE;
        }
        else{
            $this->form_validation->set_message('file_selected_test', '%s masih Kososng, Silahkan Upload File Quotaion');
            return FALSE;
        }
    }


    ////////////////////////////////////////////End Upload File Minerba////////////////////////////////////////
    
    ///////////////////////////////////////////Upload File Minerba////////////////////////////////////////////
    public function saveInvMinFile(){  
        $response = array(); 
        $this->form_validation->set_rules('invID', 'invID', 'required');
        if($this->input->post('draftInvFile')){
            $this->form_validation->set_rules('draftInvFile', 'draftInvFile', 'callback_file_selected_test');
        }
        $this->form_validation->set_message('required', '%s masih Kososng, atau belum di pilih Silahkan Di isi');
        if($this->form_validation->run() == FALSE){
			$response = array(
                'status' 	    => 'error',
                'invID' 		=> form_error('invID'),
                'draftInvFile' 		=> form_error('draftInvFile'),
            );   
        } 
        else{
            // $post                  = $this->input->post(null, TRUE);             
            $post['invID']         = $this->input->post('invID');   
            $invID                 = $post['invID'];             
            $post['bidangID']      = $this->input->post('bidangID');                       
            $post['petugasID']     = $this->fungsi->petugas_login()->petugasID;
            $post['pengirimID']    = $this->fungsi->petugas_login()->subbidangID;
            $post['bidangNama']    = $this->Subbidang_m->getAll($post['pengirimID'])->row();
            $post['penerimaID']    = $this->fungsi_send->sendreceiverRka2($post['bidangID']);  
            $post['comment']       = $this->input->post('commentINVMIN');              
            $invData = $this->InvoicingApproval_m->getInvMinByID($invID)->row();
            // $jumlah                = $this->InvoicingApproval_m->getInvDMarJumlah($post);
            // $rkaStatus             = $this->InvoicingApproval_m->getInvDMarByInvIDWaktuDesc($post)->row();
            $post['statuskonf']    = 'send';
            $post['status']        = 'NW1';                    

            $fileName = 'draftInvFile';
            $file     = $this->upload($post, $fileName);
            if($file['status'] == true){
                if($file['name'] != null){
                    $post['draftInvFile'] = $file['name']; 
                } else{
                    $post['draftInvFile'] =  $this->input->post('draftInvFile_send');
                }
                
                $this->InvoicingApproval_m->addInvDMinerba($post);
                if($this->db->affected_rows()>0){ 
                    if($this->input->post('new_upload')){
                        $post['status']      = 'SC1';//Reject Waktu
                        $post['frDetailID'] = $invData->invMin_frDetailID;
                        $this->Finalreport_m->setFRDMinStatus($post);
                    }
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
        echo json_encode($response); 
    }



    public function upload($post, $data1){
        if($post['bidangID'] == 1){
            $bidangNama = 'Marine';
        }else if($post['bidangID'] == 2){
            $bidangNama = 'Minerba';
        }
        $config = array();
        $config['upload_path'] =  './uploads/invoicing/'.$bidangNama.'/';
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
    ///////////////////////////////////////////End Upload File Minerba////////////////////////////////////////////


    //////////////////////////////////////////APPROVAL//////////////////////////////////////////////////////////
    public function viewNewApprov(){
        $post['penerima'] = $this->fungsi->petugas_login()->subbidangID;
        $bidangID = $this->fungsi->petugas_login()->bidangID;
        if($bidangID == 1){
            $this->load->view('petugas/invoicing_draft/draftInv_marine_newapprov');
        }else if($bidangID == 2){
            $this->load->view('petugas/invoicing_draft/draftInv_minerba_newapprov');
        }
    }

    public function getNewInvApprov(){
        $bidangID = $this->fungsi->petugas_login()->bidangID;
        $post['penerima'] = $this->fungsi->petugas_login()->subbidangID;
        if($bidangID == 1){
            $post['pengirim'] = 'FM';
            $data = $this->InvoicingApproval_m->getInvDMarApprovByPetugasIDNew($post)->result();
            foreach($data as $row1){
                $dataFR = $this->Finalreport_m->getFRDMarByIDDesc($row1->invMar_frDetailID)->row();
                $dataSPK = $this->Spk_m->getSpkByID($row1->invMar_spkID)->row();
                $dataJobdesc = $this->Jobdesc_m->getJobdscDByDetailIDDesc($row1->invMar_jobdaDetailID)->row();
                $dataOrder = $this->Order_m->getAllByID($row1->invMar_orderID)->row();
                $arrayData[] = array(
                    'invDetailID'    => $row1->invMarDetailID,
                    'invID'          => $row1->invMarD_invID,
                    'invNo'          => $row1->invMarNo,
                    'frID'           => $dataFR->frMarD_frID,
                    'jobdApprovNo'   => $dataJobdesc->jobdApprovNo,
                    'spkNo'          => $dataSPK->spkNo,
                    'orderID'        => $row1->invMar_orderID,
                    'projectID'      => $dataOrder->order_projectID,
                    'petugas'        => $row1->petugasNama,
                    'status'         => $row1->status,
                    'waktu'          => $row1->waktu,

                );

            }
        }
        else if($bidangID == 2){
            $post['pengirim'] = $this->fungsi_send->sendreceiverRka1($bidangID);
            $data = $this->InvoicingApproval_m->getInvDMinApprovByPetugasIDNew($post)->result();
            foreach($data as $row2){
                $dataFR = $this->Finalreport_m->getFRDMinByIDDesc($row2->invMin_frDetailID)->row();
                $dataSPK = $this->Spk_m->getSpkByID($row2->invMin_spkID)->row();
                $dataJobdesc = $this->Jobdesc_m->getJobdscDByDetailIDDesc($row2->invMin_jobdaDetailID)->row();
                $dataOrder = $this->Order_m->getAllByID($row2->invMin_orderID)->row();
                $arrayData[] = array(
                    'invDetailID'    => $row2->invMinDetailID,
                    'invID'          => $row2->invMinD_invID,
                    'invNo'          => $row2->invMinNo,
                    'frID'           => $dataFR->frMinD_frID,
                    'frMinlhvNo'          => $dataFR->frMinlhvNo,
                    'jobdApprovNo'   => $dataJobdesc->jobdApprovNo,
                    'spkNo'          => $dataSPK->spkNo,
                    'orderID'        => $row2->invMin_orderID,
                    'projectID'      => $dataOrder->order_projectID,
                    'petugas'        => $row2->petugasNama,
                    'status'         => $row2->status,
                    'waktu'          => $row2->waktu,

                );

            }


        }
        echo json_encode($arrayData);
    }




    public function timeViewMarine(){
        $this->timeWorkFinalReportMarine();
        $response = array();
        $xproses = array();
        $getID    = $this->input->get('id');
        $waktu_sekarang = date('Y-m-d H:i:s');
        $data_query = $this->InvoicingApproval_m->getInvDMarByIDDesc($getID)->row();
        $dataQuoMax = $this->InvoicingApproval_m->getInvDMarMaxByInvID($data_query->invMarD_invID)->row();
        if($dataQuoMax->invMarDetailID > $getID){
            $checkAllDetailID[] = 'success';
        }else{
            $checkAllDetailID[] = 'proses';
        }
        $dataFR = $this->InvoicingApproval_m->getInvDMarByInvID($data_query->invMarD_invID)->result();
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
        $subbidangPetugas = $this->fungsi->petugas_login()->subbidangID;
        $dataPenerimaDesc         = $this->InvoicingApproval_m->getInvDMarMaxByPenerimaID($subbidangPetugas)->result();
        if($dataPenerimaDesc != null){
            foreach($dataPenerimaDesc as $row){
                $frPenerimaID[] = $row->invMarDetailID;
            }
            $dataPenerima     = $this->InvoicingApproval_m->getInvDMarByIDDesc($frPenerimaID)->result();
            foreach($dataPenerima as $row1){
                $file[] = array(
                    'frDetailID' => $row1->invMarDetailID,
                    'frID'       => $row1->invMarD_invID,
                    'orderID'    => $row1->invMar_orderID
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
        $response       = array();
        $petugasID      = $this->fungsi->petugas_login()->subbidangID;
        $dataPenerima   = $this->checkPenerima($petugasID);
        $waktu_sekarang = date('Y-m-d H:i:s');
        foreach($dataPenerima as $row){
            $detailID[] = $row['frDetailID'];
            $id[]       = $row['frID'];
            $orderID[]  = $row['orderID'];
        }

        $dataPengirimDesc = $this->InvoicingApproval_m->getInvDMarByPengirimInvID($id, $petugasID)->result();
        if($dataPengirimDesc != null){
            foreach($dataPengirimDesc as $row1){
                if(in_array($row1->invMarD_invID, $id)){
                    $file1[] = $row1->invMarD_invID; //Data Pengirim ADA 
                    $fileDetailID[] = $row1->invMarDetailID; //Data Pengirim ADA 
                }
            }
        // // //     //////////////////Jika Petugas Sudah Menerima Dan Mengirimkan FR ID////////////////////////////
            $dataFR = $this->InvoicingApproval_m->getInvDMarMaxByPengirimInvID($file1, $petugasID)->result();
            foreach($dataFR as $row2){
                $frDetailIDDesc[] = $row2->invMarDetailID;
            }
            
            $dataPegirim = $this->InvoicingApproval_m->getInvDMarByIDDesc($frDetailIDDesc)->result();
            foreach($dataPegirim as $row3){
                $dataDetailCheck = $this->InvoicingApproval_m->getInvDMarMaxByPenerimaInvID($row3->invMarD_invID, $petugasID)->row();
                $dataPenerimaCheck = $this->InvoicingApproval_m->getInvDMarByIDDesc($dataDetailCheck->invMarDetailID)->row();
                if($row3->invMarD_invID == $dataPenerimaCheck->invMarD_invID){
                    $file2[] = $row3->invMarD_invID; //Data Pengirim ADA 
                    if($dataDetailCheck->invMarDetailID > $row3->invMarDetailID){
                        $xid[] = $row3->invMarDetailID;
                        // $xd[] = " DetailID : ". $dataDetailCheck->invMarDetailID.">".$row3->invMarDetailID;//Exekusi TimeOut
                        $waktux[] = $row3->waktu_end;
                        if($dataPenerimaCheck->waktu_end != null){
                            if($dataPenerimaCheck->status != 'success'){
                                if($waktu_sekarang > $dataPenerimaCheck->waktu_end){
                                    $frData1              = $this->InvoicingApproval_m->getInvMarByID($row3->invMarD_invID)->row();
                                    $post['spkID']       = $frData1->invMar_spkID;
                                    $post['status']      = 'RJ1';//Reject Waktu
                                    $post['frDetailID'] = $dataPenerimaCheck->invMarDetailID;
                                    $this->Spk_m->setSpkStatus($post);
                                    $this->InvoicingApproval_m->setInvDMarStatus($post);
                                }
                            } 
                        }
                    }
                }
            }

        // //     /////////////////////////////Jika Petugas hanya menerima FR ID////////////////////////////
            $pengirimNull     = array_diff($id, $file1); //Data Pengirim Tidak Ada
            if($pengirimNull != null){
                $dataPenerimaNull = $this->InvoicingApproval_m->getInvDMarByInvID($pengirimNull)->result();
                foreach($dataPenerimaNull as $row4){
                    $dataDetailCheck1 = $this->InvoicingApproval_m->getInvDMarMaxByPenerimaInvID($row4->invMarD_invID, $petugasID)->row();
                    $dataPenerimaCheck1 = $this->InvoicingApproval_m->getInvDMarByIDDesc($dataDetailCheck1->invMarDetailID)->row();
                    if($row4->invMarD_invID == $dataPenerimaCheck1->invMarD_invID){
                        $x1 = $row4->invMarDetailID ;
                        // $x = $dataPenerimaCheck1->quoD_quoID;
                        // if($dataPenerimaCheck1->invMarDetailID > $row4->invMarDetailID){
                            $z = $row4->invMarDetailID;
                            // $waktu1[] = $dataPenerimaCheck1->waktu_end;
                            if($dataPenerimaCheck1->waktu_end != null){
                                if($dataPenerimaCheck1->status != 'success'){
                                    if($waktu_sekarang > $dataPenerimaCheck1->waktu_end){
                                        $frData2              = $this->InvoicingApproval_m->getInvMarByID($row4->invMarD_invID)->row();
                                        $post['spkID']       = $frData2->invMar_spkID;
                                        $post['status']      = 'RJ1';//Reject Waktu
                                        $post['frDetailID'] = $dataPenerimaCheck1->invMarDetailID;
                                        $this->Spk_m->setSpkStatus($post);
                                        $this->InvoicingApproval_m->setInvDMarStatus($post);
                                      
                                    }
                                }
                            }
                        // }
                    }
                }
            }
            
        }else{//Data Pertama sekali

            $dataPenerimax = $this->InvoicingApproval_m->getInvDMarByPenerimaInvID($id, $petugasID)->result();
            foreach($dataPenerimax as $rowx){
                $waktu[] = $rowx->waktu_end;
                if($rowx->waktu_end != null){
                    if($rowx->status != 'success'){
                        if($waktu_sekarang > $rowx->waktu_end){
                            $frDatax              = $this->InvoicingApproval_m->getInvMarByID($rowx->invMarD_invID)->row();
                            $post['spkID']     = $frDatax->invMar_spkID;
                            $post['status']      = 'RJ1';//Reject Waktu
                            $post['frDetailID'] = $rowx->invMarDetailID;
                            $this->Spk_m->setSpkStatus($post);
                            $this->InvoicingApproval_m->setInvDMarStatus($post);
                           
                        }
                    }
                }
            }
        } 
        // echo json_encode($dataPenerimaNull);
    }






    //////////////////////////////////MINERBA TIMEOUT////////////////////////

    public function timeViewMinerba(){
        $this->timeWorkFinalReportMinerba();
        $response = array();
        $xproses = array();
        $getID    = $this->input->get('id');
        $waktu_sekarang = date('Y-m-d H:i:s');
        $data_query = $this->InvoicingApproval_m->getInvDMinByIDDesc($getID)->row();
        $dataQuoMax = $this->InvoicingApproval_m->getInvDMinMaxByInvID($data_query->invMinD_invID)->row();
        if($dataQuoMax->invMinDetailID > $getID){
            $checkAllDetailID[] = 'success';
        }else{
            $checkAllDetailID[] = 'proses';
        }
        $dataFR = $this->InvoicingApproval_m->getInvDMinByInvID($data_query->invMinD_invID)->result();
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


    public function checkPenerimaMinerba($subbidangPetugas){
        $file = array();
        // $subbidangPetugas = $this->fungsi->petugas_login()->subbidangID;
        $dataPenerimaDesc         = $this->InvoicingApproval_m->getInvDMinMaxByPenerimaID($subbidangPetugas)->result();
        if($dataPenerimaDesc != null){
            foreach($dataPenerimaDesc as $row){
                $frPenerimaID[] = $row->invMinDetailID;
            }
            $dataPenerima     = $this->InvoicingApproval_m->getInvDMinByIDDesc($frPenerimaID)->result();
            foreach($dataPenerima as $row1){
                $file[] = array(
                    'frDetailID' => $row1->invMinDetailID,
                    'frID'       => $row1->invMinD_invID,
                    'orderID'    => $row1->invMin_orderID
                );
            } 
        }
        return $file;
        // echo json_encode($file);
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

        $dataPengirimDesc = $this->InvoicingApproval_m->getInvDMinByPengirimInvID($id, $petugasID)->result();
        if($dataPengirimDesc != null){
            foreach($dataPengirimDesc as $row1){
                if(in_array($row1->invMinD_invID, $id)){
                    $file1[] = $row1->invMinD_invID; //Data Pengirim ADA 
                    $fileDetailID[] = $row1->invMinDetailID; //Data Pengirim ADA 
                }
            }
        // // // //     //////////////////Jika Petugas Sudah Menerima Dan Mengirimkan FR ID////////////////////////////
        //     $dataFR = $this->InvoicingApproval_m->getInvDMarMaxByPengirimInvID($file1, $petugasID)->result();
        //     foreach($dataFR as $row2){
        //         $frDetailIDDesc[] = $row2->invMarDetailID;
        //     }
            
        //     $dataPegirim = $this->InvoicingApproval_m->getInvDMinByIDDesc($frDetailIDDesc)->result();
        //     foreach($dataPegirim as $row3){
        //         $dataDetailCheck = $this->InvoicingApproval_m->getInvDMinMaxByPenerimaInvID($row3->invMarD_invID, $petugasID)->row();
        //         $dataPenerimaCheck = $this->InvoicingApproval_m->getInvDMinByIDDesc($dataDetailCheck->invMarDetailID)->row();
        //         if($row3->invMarD_invID == $dataPenerimaCheck->invMarD_invID){
        //             $file2[] = $row3->invMarD_invID; //Data Pengirim ADA 
        //             if($dataDetailCheck->invMarDetailID > $row3->invMarDetailID){
        //                 $xid[] = $row3->invMarDetailID;
        //                 // $xd[] = " DetailID : ". $dataDetailCheck->invMarDetailID.">".$row3->invMarDetailID;//Exekusi TimeOut
        //                 $waktux[] = $row3->waktu_end;
        //                 if($dataPenerimaCheck->waktu_end != null){
        //                     if($dataPenerimaCheck->status != 'success'){
        //                         if($waktu_sekarang > $dataPenerimaCheck->waktu_end){
        //                             $frData1              = $this->InvoicingApproval_m->getInvMinByID($row3->invMarD_invID)->row();
        //                             $post['spkID']       = $frData1->invMar_spkID;
        //                             $post['status']      = 'RJ1';//Reject Waktu
        //                             $post['frDetailID'] = $dataPenerimaCheck->invMarDetailID;
        //                             $this->Spk_m->setSpkStatus($post);
        //                             $this->InvoicingApproval_m->setInvDMarStatus($post);
        //                         }
        //                     } 
        //                 }
        //             }
        //         }
        //     }

        // // //     /////////////////////////////Jika Petugas hanya menerima FR ID////////////////////////////
            $pengirimNull     = array_diff($id, $file1); //Data Pengirim Tidak Ada
            if($pengirimNull != null){
                $dataPenerimaNull = $this->InvoicingApproval_m->getInvDMinByInvID($pengirimNull)->result();
                foreach($dataPenerimaNull as $row4){
                    $dataDetailCheck1 = $this->InvoicingApproval_m->getInvDMinMaxByPenerimaInvID($row4->invMinD_invID, $petugasID)->row();
                    $dataPenerimaCheck1 = $this->InvoicingApproval_m->getInvDMinByIDDesc($dataDetailCheck1->invMinDetailID)->row();
                    if($row4->invMinD_invID == $dataPenerimaCheck1->invMinD_invID){
                        $x1 = $row4->invMinDetailID ;
                        // $x = $dataPenerimaCheck1->quoD_quoID;
                        // if($dataPenerimaCheck1->invMinDetailID > $row4->invMinDetailID){
                            $z = $row4->invMinDetailID;
                            // $waktu1[] = $dataPenerimaCheck1->waktu_end;
                            if($dataPenerimaCheck1->waktu_end != null){
                                if($dataPenerimaCheck1->status != 'success'){
                                    if($waktu_sekarang > $dataPenerimaCheck1->waktu_end){
                                        $frData2              = $this->InvoicingApproval_m->getInvMinByID($row4->invMinD_invID)->row();
                                        $post['spkID']       = $frData2->invMin_spkID;
                                        $post['status']      = 'RJ1';//Reject Waktu
                                        $post['frDetailID'] = $dataPenerimaCheck1->invMinDetailID;
                                        $this->Spk_m->setSpkStatus($post);
                                        $this->InvoicingApproval_m->setInvDMinStatus($post);
                                      
                                    }
                                }
                            }
                        // }
                    }
                }
            }
            
        }
        else{//Data Pertama sekali

            $dataPenerimax = $this->InvoicingApproval_m->getInvDMinByPenerimaInvID($id, $petugasID)->result();
            foreach($dataPenerimax as $rowx){
                $waktu[] = $rowx->waktu_end;
                if($rowx->waktu_end != null){
                    if($rowx->status != 'success'){
                        if($waktu_sekarang > $rowx->waktu_end){
                            $frDatax              = $this->InvoicingApproval_m->getInvMinByID($rowx->invMinD_invID)->row();
                            $post['spkID']     = $frDatax->invMin_spkID;
                            $post['status']      = 'RJ1';//Reject Waktu
                            $post['frDetailID'] = $rowx->invMinDetailID;
                            $this->Spk_m->setSpkStatus($post);
                            $this->InvoicingApproval_m->setInvDMinStatus($post);
                           
                        }
                    }
                }
            }
        } 
        // echo json_encode($dataPengirimDesc);
    }




    
   
    



   


}
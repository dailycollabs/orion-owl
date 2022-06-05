<?php defined('BASEPATH') OR exit('No direct script access allowed');

class IntHonorarium extends CI_Controller {

	function __construct(){
        parent::__construct();
        check_not_petugas();
        $this->load->model(['InternalHonorarium_m', 'Subbidang_m']);
        $this->load->library('form_validation');
    }

	 //Budget Honor
    public function viewDataBudgetHonor(){
        $this->load->view('petugas/internal_honorarium/budget_honor/budgethonor_data');
    }
    public function getDataBudgetHonor(){
        $petugas  = $this->fungsi->petugas_login()->subbidangID;
        $data1 = $this->InternalHonorarium_m->getWorkflowPetugas($petugas)->result();
        foreach($data1 as $row1){
            $budgethonorID1[] = $row1->budgethonorID;
        }

        $data2 = $this->InternalHonorarium_m->getAllBudgetHonorID($budgethonorID1)->result();
        foreach($data2 as $row2){

        $dataProses = $this->InternalHonorarium_m->getQuoDetailByQuoIDDESC($row2->budgethonorNo)->row();
            if($dataProses->status == 'reject'){
                $xproses = 'reject';
            }else if($dataProses->status == 'success'){
                $xproses = 'success';
            }else{
                $xproses = 'proses';
            }

            $arrayData[] = array(
                'budgetDetailID'  => $row2->budgethonorID,
                'budgetNo'        => $row2->budgethonorNo,
                'status'          => $row2->status,
                'statusProses'    => $xproses,
                'pengirim'        => $row2->budgetH_pengirimID,
                'penerima'        => $row2->budgetH_penerimaID,
                'waktu'           => $row2->budgetHWaktu
            );
        }
        echo json_encode($arrayData);
    }

    public function viewDetailDataBudgetHonor($id){
        $data['row'] = $this->InternalHonorarium_m->getQuoDetailByQuoIDDESC($id)->row();
        $this->load->view('petugas/internal_honorarium/budget_honor/budgethonor_detaildata',$data);
    }

    public function getDetailDataBudgetHonor(){
        $id = $this->input->get('id');
        $petugas  = $this->fungsi->petugas_login()->subbidangID;
        
        $data2 = $this->InternalHonorarium_m->getWorkflowPetugasID($petugas)->result();
        foreach($data2 as $row2){
            if($row2->budgethonorNo == $id){
                $dataProses = $this->InternalHonorarium_m->getQuoDetailByQuoIDDESC($row2->budgethonorNo)->row();
                if($dataProses->status == 'reject'){
                    $xproses = 'reject';
                }else if($dataProses->status == 'success'){
                    $xproses = 'success';
                }else{
                    $xproses = 'proses';
                }

                $arrayData[] = array(
                    'budgetDetailID'  => $row2->budgethonorID,
                    'budgetNo'        => $row2->budgethonorNo,
                    'status'          => $row2->status,
                    'statusProses'    => $xproses,
                    'pengirim'        => $row2->budgetH_pengirimID,
                    'penerima'        => $row2->budgetH_penerimaID,
                    'waktu'           => $row2->budgetHWaktu
                );
            }
        }
        echo json_encode($arrayData);
    }

    


    
    
    public function viewAddBudgetHonor(){
        $this->load->view('petugas/internal_honorarium/budget_honor/budgethonor_create');
    }


    public function addBudgetHonor(){
        $response = array();
        $post1 = array();
        $post = array();
        if(!empty($_FILES['budgetHFile']['name']) == null){
            $this->form_validation->set_rules('budgetHFile', 'budgetHFile', 'callback_file_selected_test["budgetHFile"]');
        }

        if($this->input->post('add_new')){
            $this->form_validation->set_rules('send_up', 'send_up', 'required');
        }

        if($this->input->post('add')){
            $this->form_validation->set_rules('budgethonorNo', 'budgethonorNo', 'required');
        }

        $this->form_validation->set_message('required', '%s masih Kososng, atau belum di pilih Silahkan Di isi');
        $this->form_validation->set_message('is_unique', '{field} ini sudah dipakai, silahkan ganti');
        
        if($this->form_validation->run() == FALSE){
            $response = array(
                'status' 	    => 'error',
                'budgetHFile' => form_error('budgetHFile')
            );   
        } else{

            $post['budgethonorNo'] = $this->input->post('budgethonorNo');
            $bdhID                 = $post['budgethonorNo'];
            $post['petugasID']     = $this->fungsi->petugas_login()->petugasID;
            $post['pengirimID']    = $this->fungsi->petugas_login()->subbidangID;
            $post['comment']       = $this->input->post('budgetComment');
            
            if($this->input->post('send_up')){
                $post['penerimaID']    ='FM';
            }else if($this->input->post('send_down')){
                $post['penerimaID']    = 'HR';
            } 

            
            if($bdhID == null){
                //////////Create ID//////////
                date_default_timezone_set("Asia/Jakarta");
                $char    = 'BDH';
                $date    = date("Y-m-d");
                $tahun   = substr($date, 0, 2);
                $bulan   = substr($date, 5, 2);
                $hari    = substr($date, 8, 2);
                $budgethonor   = $this->InternalHonorarium_m->getAllMax()->row(); 
                $budgethonorNo = (int) substr($budgethonor->budgethonorNo, 12, 4);
                $budgethonorNo++;
                $budgetHID = $char.$tahun.$bulan.$hari.sprintf("%04s", $budgethonorNo);
                ///////////End Create ID////////////
            }else{
                $budgetHID = $post['budgethonorNo'];
            }


            $jumlah                = $this->InternalHonorarium_m->jumlahBudgetHonor($post);
            $BDHStatus_reject      = $this->InternalHonorarium_m->getBudgetHonorbyID($bdhID)->result();
            foreach($BDHStatus_reject as $row){
                $rowReject[] = $row->status;
            }

            if($jumlah->num_rows() == 0 || !in_array('reject', $rowReject)){ 
                if($this->input->post('send_up')){
                    $data = $this->fungsi_statusjml->sendRecive($jumlah->num_rows());
                    $post['jumlah'] = $data['jumlah'];
                    $post['status'] = $data['status'];
                }
                else if($this->input->post('send_down')){
                    $data = $this->fungsi_statusjml->sendReciveRevisi($jumlah->num_rows());
                    $post['jumlah'] = $data['jumlah'];
                    $post['status'] = $data['status']; 
                }

                $data1 = 'budgetHFile';
                $urlPath = './uploads/honorarium/budgetHonor/';
                $file = $this->upload($post, $data1, $urlPath);
                
                if($file['status'] == true){
                    if($file['name'] != null){
                        $post['budgetHFile'] = $file['name']; 
                    } 
                    else{
                        $post['budgetHFile'] =  $this->input->post('quoFileSeuccess');
                    }
                        
                    $post1 = array(
                        'id'                => $budgetHID,
                        'petugasID'         => $post['petugasID'],
                        'pengirimID'        => $post['pengirimID'],
                        'penerimaID'        => $post['penerimaID'],
                        'statusID'          => $post['status'],
                        'budgetHFile'       => $post['budgetHFile'],
                        'jumlah'            => $post['jumlah'],
                        'statusKonfirmasi'  => 'send',
                        'comment'           => $post['comment'],
                    );


                    $this->InternalHonorarium_m->addBudgetHonor($post1);
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

   
    public function viewNewBudgetHonor(){
        $this->load->view('petugas/internal_honorarium/budget_honor/budgethonor_new');
    }
    public function getNewBudgetHonor(){
        $petugasLogin   = $this->fungsi->petugas_login()->subbidangID;
        $data = $this->InternalHonorarium_m->getNewAllBudgetHonor($petugasLogin)->result();
        echo json_encode($data); 
    }

    public function konfBudgetHonor($id){
        date_default_timezone_set("Asia/Jakarta");
        $data                   = array();
        $data_query             = $this->InternalHonorarium_m->getAllBudgetHonorID($id)->row();
        $data['petugasLogin']   = $this->fungsi->petugas_login()->subbidangID;
        $data['waktusekarang']  = date('Y-m-d H:i:s');

        if($data['petugasLogin'] != $data_query->budgetH_pengirimID){
            if($data_query->budgetHWaktu_start == null && $data_query->budgetHWaktu_end == null){
                $dataQuoDetail['statusConf']  = 'read';
                $dataQuoDetail['quoProsesID'] = $id;
                $this->InternalHonorarium_m->changeStatusQuoDetail($dataQuoDetail);
                $dataQuoDetail['waktustart']   = date('Y-m-d H:i:s');
                $dataQuoDetail['waktuend']     = date('Y-m-d H:i:s',strtotime('+20 minutes',strtotime($dataQuoDetail['waktustart'])));
                $this->InternalHonorarium_m->uploadTimeWork($dataQuoDetail);
            }
            $data['row'] = $this->InternalHonorarium_m->getAllBudgetHonorID($id)->row();
            $this->load->view('petugas/internal_honorarium/budget_honor/budgethonor_konf', $data);
        }else{
            $data['row'] = $this->InternalHonorarium_m->getAllBudgetHonorID($id)->row();
            $this->load->view('petugas/internal_honorarium/budget_honor/budgethonor_konf', $data);
        }

    }

    

    public function viewFailedBudgetHonor(){
        $this->load->view('petugas/internal_honorarium/budget_honor/budgethonor_falid');
    }
    
    public function revisiBudgetHonor($id){
        date_default_timezone_set("Asia/Jakarta");
        $data                   = array();
        $data_query             = $this->InternalHonorarium_m->getAllBudgetHonorID($id)->row();
        $data['petugasLogin']   = $this->fungsi->petugas_login()->subbidangID;
        $data['waktusekarang']  = date('Y-m-d H:i:s');
        if($data['petugasLogin'] != $data_query->budgetH_pengirimID){
            if($data_query->budgetHWaktu_start == null && $data_query->budgetHWaktu_end == null){
                $dataQuoDetail['statusConf']  = 'read';
                $dataQuoDetail['quoProsesID'] = $id;
                $this->InternalHonorarium_m->changeStatusQuoDetail($dataQuoDetail);
                $dataQuoDetail['waktustart']   = date('Y-m-d H:i:s');
                $dataQuoDetail['waktuend']     = date('Y-m-d H:i:s',strtotime('+20 minutes',strtotime($dataQuoDetail['waktustart'])));
                $this->InternalHonorarium_m->uploadTimeWork($dataQuoDetail);
            }
            $data['row'] = $this->InternalHonorarium_m->getAllBudgetHonorID($id)->row();
            $this->load->view('petugas/internal_honorarium/budget_honor/budgethonor_revisi', $data);
        }else{
            $data['row'] = $this->InternalHonorarium_m->getAllBudgetHonorID($id)->row();
            $this->load->view('petugas/internal_honorarium/budget_honor/budgethonor_revisi', $data);
        }

        // $data['row'] = $this->InternalHonorarium_m->getAllBudgetHonorID($id)->row();
        // $this->load->view('petugas/internal_honorarium/budget_honor/budgethonor_revisi', $data);
    }

 

    public function timeViewBudgetHonor(){
        $this->timeWorkBudgetHonor();
        $response = array();
        $xproses = array();
        $getID    = $this->input->get('id');
        // $getID    = 22;
        $waktu_sekarang = date('Y-m-d H:i:s');
        $data_query = $this->InternalHonorarium_m->getMarFRDByID($getID)->row();
        $dataQuoMax = $this->InternalHonorarium_m->getMarFRDByIDMax($data_query->budgethonorNo)->row();
        if($dataQuoMax->budgethonorID > $getID){
            $checkAllDetailID[] = 'success';
        }else{
            $checkAllDetailID[] = 'proses';
        }
        $dataFR = $this->InternalHonorarium_m->getMarFRDByFRID($data_query->budgethonorNo)->result();
        foreach($dataFR as $row){
            if($row->status == 'reject'){
                $xproses = 'reject';
            }else if($row->status == 'success'){
                $xproses = 'success';
            }else{
                $xproses = 'proses';
            }
        }

        if($data_query->budgetHWaktu_end != null){
            $response = array(
                'status'    => $checkAllDetailID,
                'statusAll' => $xproses,
                'waktuEnd'  => $data_query->budgetHWaktu_end,
            ); 
        }
        echo json_encode($response);
    }


    public function checkPenerima($subbidangPetugas){
        $file = array();
        // $subbidangPetugas      = $this->fungsi->petugas_login()->subbidangID;
        $dataPenerimaDesc         = $this->InternalHonorarium_m->getMarFRDByPenerimaIDMax($subbidangPetugas)->result();
        if($dataPenerimaDesc != null){
            foreach($dataPenerimaDesc as $row){
                $frPenerimaID[] = $row->budgethonorID;
            }
            $dataPenerima     = $this->InternalHonorarium_m->getMarFRDByID($frPenerimaID)->result();
            foreach($dataPenerima as $row1){
                $file[] = array(
                    'frDetailID' => $row1->budgethonorID,
                    'frID'       => $row1->budgethonorNo,
                );
            } 
        }
        return $file;
        // echo json_encode($file);
    }

    public function timeWorkBudgetHonor(){   
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
        }

        $dataPengirimDesc = $this->InternalHonorarium_m->getMarFRDByPengirimID($id, $petugasID)->result();
        if($dataPengirimDesc != null){
            foreach($dataPengirimDesc as $row1){
                if(in_array($row1->budgethonorNo, $id)){
                    $file1[] = $row1->budgethonorNo; //Data Pengirim ADA 
                    $fileDetailID[] = $row1->budgethonorID; //Data Pengirim ADA 
                }
            }
        // //     //////////////////Jika Petugas Sudah Menerima Dan Mengirimkan FR ID////////////////////////////
            $dataFR = $this->InternalHonorarium_m->getMarFRDByPengirimIDMax($file1, $petugasID)->result();
            foreach($dataFR as $row2){
                $frDetailIDDesc[] = $row2->budgethonorID;
            }
            
            $dataPegirim = $this->InternalHonorarium_m->getMarFRDByID($frDetailIDDesc)->result();
            foreach($dataPegirim as $row3){
                $dataDetailCheck = $this->InternalHonorarium_m->getMarFRDByPenerimaIDMaxID($row3->budgethonorNo, $petugasID)->row();
                $dataPenerimaCheck = $this->InternalHonorarium_m->getMarFRDByID($dataDetailCheck->budgethonorID)->row();
                if($row3->budgethonorNo == $dataPenerimaCheck->budgethonorNo){
                    $file2[] = $row3->budgethonorNo; //Data Pengirim ADA 
                    if($dataDetailCheck->budgethonorID > $row3->budgethonorID){
                        // $xd[] = " DetailID : ". $dataDetailCheck->budgethonorID.">".$row3->budgethonorID;//Exekusi TimeOut
                        $waktux[] = $row3->budgetHWaktu_end;
                        if($dataPenerimaCheck->budgetHWaktu_end != null){
                            if($dataPenerimaCheck->status != 'success'){
                                if($waktu_sekarang > $dataPenerimaCheck->budgetHWaktu_end){
                                  
                           
                                    $post['status']      = 'RJ1';//Reject Waktu
                                    $post['quoProsesID'] = $dataPenerimaCheck->budgethonorID;
                                    $this->InternalHonorarium_m->setMarFRDStatus($post);
                                   
                                    // $response[] = array(
                                    //     'status' => 'sukses',
                                    //     'message' => 'Prosess 1'
                                    // );
                                }
                            } 
                        }
                    }
                }
            }

            /////////////////////////////Jika Petugas hanya menerima FR ID////////////////////////////
            $pengirimNull     = array_diff($id, $file1); //Data Pengirim Tidak Ada
            if($pengirimNull != null){
                $dataPenerimaNull = $this->InternalHonorarium_m->getMarFRDByFRID($pengirimNull)->result();
                foreach($dataPenerimaNull as $row4){
                    $dataDetailCheck1 = $this->InternalHonorarium_m->getMarFRDByPenerimaIDMaxID($row4->budgethonorNo, $petugasID)->row();
                    $dataPenerimaCheck1 = $this->InternalHonorarium_m->getMarFRDByID($dataDetailCheck1->budgethonorID)->row();
                    if($row4->budgethonorNo == $dataPenerimaCheck1->budgethonorNo){
                        $x1 = $row4->budgethonorID ;
                        // $x = $dataPenerimaCheck1->budgethonorNo;
                        // if($dataPenerimaCheck1->budgethonorID > $row4->budgethonorID){
                            $z = $row4->budgethonorID;
                            // $waktu1[] = $dataPenerimaCheck1->budgetHWaktu_end;
                            if($dataPenerimaCheck1->budgetHWaktu_end != null){
                                if($dataPenerimaCheck1->status != 'success'){
                                    if($waktu_sekarang > $dataPenerimaCheck1->budgetHWaktu_end){
                                    
                                      
                                        $post['status']      = 'RJ1';//Reject Waktu
                                        $post['quoProsesID'] = $dataPenerimaCheck1->budgethonorID;
                                        $this->InternalHonorarium_m->setMarFRDStatus($post);
                                
                                        $response[] = array(
                                            'status' => 'sukses',
                                            'message' => 'Prosess 2'
                                        );
                                    }
                                }
                            }
                        // }
                    }
                }
            }
            
        }else{//Data Pertama sekali

            $dataPenerimax = $this->InternalHonorarium_m->getMarFRDByPenerimaID($id, $petugasID)->result();
            foreach($dataPenerimax as $rowx){
                $waktu[] = $rowx->budgetHWaktu_end;
                if($rowx->budgetHWaktu_end != null){
                    if($rowx->status != 'success'){
                        if($waktu_sekarang > $rowx->budgetHWaktu_end){
                           
                            $post['status']      = 'RJ1';//Reject Waktu
                            $post['quoProsesID'] = $rowx->budgethonorID;
                           
                            $this->InternalHonorarium_m->setMarFRDStatus($post);
                            $response[] = array(
                                'status' => 'sukses',
                                'message' => 'Prosess 3'
                            );
                        }
                    }
                }
            }
        } 

        // echo json_encode($dataPenerimax); 
    }











    //END Budget Honor


     /////////////////////////////////////////////////////////////
    //Approval (id/No Pengeluaran)

    public function viewAddApproval($id){
        $data['row'] = $this->InternalHonorarium_m->getAllBudgetHonorID($id)->row();
        $this->load->view('petugas/internal_honorarium/approval/approval_create', $data);
    }
    public function addApproval(){
        $response = array();
        $post = array();
        if($this->input->post('approvalFile')){
            $this->form_validation->set_rules('approvalFile', 'pbFile', 'callback_file_selected_test["approvalFile"]');
        }
        $this->form_validation->set_rules('refID', 'refID', 'required');
        $this->form_validation->set_rules('budgethonorID', 'budgethonorID', 'required');

        $this->form_validation->set_message('required', '%s masih Kososng, atau belum di pilih Silahkan Di isi');
        
        if($this->form_validation->run() == FALSE){
            $response = array(
                'status' 	    => 'error',
                'refID' => form_error('refID'),
                'budgethonorID' => form_error('budgethonorID'),
                'approvalFile' => form_error('approvalFile'),

            );   
        } else{
            // $post = $this->input->post(null, TRUE);
            
            $post['refID']         = $this->input->post('refID');
            $post['budgethonorID'] = $this->input->post('budgethonorID');
            $budgethonorID         =   $post['budgethonorID'];
            $post['petugasID']     = $this->fungsi->petugas_login()->petugasID;
            $post['pengirimID']    = $this->fungsi->petugas_login()->subbidangID;
            $post['bidangNama']    = $this->Subbidang_m->getAll($post['pengirimID'])->row();
            $post['comment']       = $this->input->post('approvalComment');
            $post['penerimaID']    = 'HR';
            $post['status']        = 'file';   

            $data1 = 'approvalFile';
            $urlPath = './uploads/honorarium/pencairanBudget/';
            $file1 = $this->upload($post, $data1, $urlPath);
 
            if($file1['status'] == true){
                if($file1['name'] != null){
                    $post['approvalFile'] = $file1['name']; 
                }
                $postSend = array(
                    'refID'         => $post['refID'],
                    'budgethonorID' => $post['budgethonorID'],
                    'petugasID'     => $post['petugasID'],
                    'pengirimID'    => $post['pengirimID'],
                    'penerimaID'    => $post['penerimaID'],
                    'statusID'      => 'NW1',
                    'approvalFile'  => $post['approvalFile'],
                    'statuskonf'    => 'send',
                    'comment'       => $post['comment'],
                );

                $this->InternalHonorarium_m->addApproval($postSend);
                if($this->db->affected_rows()>0){ 
                    if($this->input->post('add_new')){
                        $post['status']      = 'SC1';//Reject Waktu
                        $post['quoProsesID'] = $budgethonorID;
                        $this->InternalHonorarium_m->setMarFRDStatus($post);
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
    public function viewNewApproval(){
        $this->load->view('petugas/internal_honorarium/approval/approval_new');
    }

   
    public function getNewApproval(){
        $petugas = $this->fungsi->petugas_login()->subbidangID;
        $data = $this->InternalHonorarium_m->getAllNewApproval($petugas)->result();
        echo json_encode($data);
    }
    public function konfApproval($id){
        date_default_timezone_set("Asia/Jakarta");
        $data                   = array();
        $data_query             = $this->InternalHonorarium_m->getAllApprovalID($id)->row();
        $data['petugasLogin']   = $this->fungsi->petugas_login()->subbidangID;
        if($data['petugasLogin'] == $data_query->aproval_penerimaID){
           
            $dataQuoDetail['statusConf']  = 'read';
            $dataQuoDetail['quoProsesID'] = $id;
            $this->InternalHonorarium_m->changeStatusApproval($dataQuoDetail);
      
            $data['row'] = $this->InternalHonorarium_m->getAllApprovalID($id)->row();
            $this->load->view('petugas/internal_honorarium/approval/approval_konf', $data);
        }else{
            $data['row'] = $this->InternalHonorarium_m->getAllApprovalID($id)->row();
            $this->load->view('petugas/internal_honorarium/approval/approval_konf', $data);
        }


        // $data['row'] = $this->InternalHonorarium_m->getAllApprovalID($id)->row();
        // $this->load->view('petugas/internal_honorarium/approval/approval_konf', $data);
    }

    


    //END Approval (id/No Pengeluaran)
    /////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////


    //Inventaris Distribus Honor
    
   
    
    
    
    public function viewAddInventaris($id){
        $data['row'] = $this->InternalHonorarium_m->getAllApprovalID($id)->row();
        $this->load->view('petugas/internal_honorarium/inventaris_distribusi/inventaris_create', $data);
    }
    public function addInventarisID(){
        $response = array();
        $this->form_validation->set_rules('approvalID', 'approvalID', 'required');
        $this->form_validation->set_rules('budgethonorID', 'budgethonorID', 'required');

        $this->form_validation->set_message('required', '%s masih Kososng, atau belum di pilih Silahkan Di isi');
        $this->form_validation->set_message('is_unique', '{field} ini sudah dipakai, silahkan ganti');
 
        if($this->form_validation->run() == FALSE){
			$response = array(
                'status' 	    => 'error',
                'approvalID' 		=> form_error('approvalID'),
                'budgethonorID' 		=> form_error('budgethonorID'),
                
            );
		} 
		else{
            $post['approvalID']     = $this->input->post('approvalID');
            $post['budgethonorID']  = $this->input->post('budgethonorID');

            //////////Create ID//////////
            date_default_timezone_set("Asia/Jakarta");
            $char    = 'INVT';
            $date    = date("Y-m-d");
            $tahun   = substr($date, 0, 2);
            $bulan   = substr($date, 5, 2);
            $hari    = substr($date, 8, 2);
            $inventaris   = $this->InternalHonorarium_m->getAllMaxINVT()->row(); 
            $inventarisID = (int) substr($inventaris->inventarisID, 13, 4);
            $inventarisID++;
            $invtID = $char.$tahun.$bulan.$hari.sprintf("%04s", $inventarisID);
            ///////////End Create ID////////////

            $post1 = array(
               'id'                => $invtID,
               'approvDetailID'    => $post['approvalID'],
               'budgethonorID'     => $post['budgethonorID'],
           );

			$this->InternalHonorarium_m->addInventarisID($post1);
            
            if($this->db->affected_rows()){
                $response = array(
                    'status' 	=> 'success',
                    'message'   => "<h3>Success Message</h3>",
                    'id'        => $invtID
                );
            } 
        }
        $this->output->set_content_type('application/json');
        echo json_encode($response);
    }

    public function viewUploadInventaris($id){
        $data['row'] = $this->InternalHonorarium_m->getInventarisID($id)->row();
        $this->load->view('petugas/internal_honorarium/inventaris_distribusi/inventaris_upload', $data);
    }

    public function uploadInventaris(){
        $response = array();
        $post = array();
        // $post = $this->input->post(null, TRUE);
        if($this->input->post('inventarisFile')){
            $this->form_validation->set_rules('inventarisFile', 'inventarisFile', 'callback_file_selected_test["inventarisFile"]');
        }
        $this->form_validation->set_rules('inventarisID', 'inventarisID', 'required');
        $this->form_validation->set_message('required', '%s masih Kososng, atau belum di pilih Silahkan Di isi');
        
        if($this->form_validation->run() == FALSE){
            $response = array(
                'status' 	    => 'error',
                'inventarisID' => form_error('inventarisID'),
                'inventarisFile' => form_error('inventarisFile')
                
            );   
        } else{
            $post['inventarisID'] = $this->input->post('inventarisID');
            $inventarisID = $post['inventarisID'];
            $post['petugasID']     = $this->fungsi->petugas_login()->petugasID;
            $post['pengirimID']    = $this->fungsi->petugas_login()->subbidangID;
            $post['comment'] = $this->input->post('inventComment');

            
            if($this->input->post('send_up')){
                $post['penerimaID'] = 'FM';
            }else if($this->input->post('send_down')){
                $post['penerimaID'] = 'HR';
            } 
            
            $jumlah                = $this->InternalHonorarium_m->jumlahInventarisProses($post);
            $INVTStatus_reject      = $this->InternalHonorarium_m->getInventarisProsesID($inventarisID)->result();
            foreach($INVTStatus_reject as $row){
                $rowReject[] = $row->status;
            }

           

           
                if($jumlah->num_rows() == 0 || !in_array('reject', $rowReject)){ 
                    if($this->input->post('send_up')){
                        $data = $this->fungsi_statusjml->sendRecive($jumlah->num_rows());
                        $post['jumlah'] = $data['jumlah'];
                        $post['status'] = $data['status'];
                    }
                    else if($this->input->post('send_down')){
                        $data = $this->fungsi_statusjml->sendReciveRevisi($jumlah->num_rows());
                        $post['jumlah'] = $data['jumlah'];
                        $post['status'] = $data['status']; 
                    }
    
                    $data1 = 'inventarisFile';
                    $urlPath = './uploads/honorarium/inventarisDistibus/';
                    $file = $this->upload($post, $data1, $urlPath);
                    
                    $response = array(
                        'status' 	    => 'success',
                    );
                    if($file['status'] == true){
                        if($file['name'] != null){
                            $post['inventarisFile'] = $file['name']; 
                        } 

                        $postSend = array(     
                            'inventarisID'   => $post['inventarisID'],
                            'petugasID'      => $post['petugasID'],
                            'pengirimID'     => $post['pengirimID'],
                            'penerimaID'     => $post['penerimaID'],
                            'inventarisFile' => $post['inventarisFile'],
                            'jumlah'         => $post['jumlah'],
                            'status'         => $post['status'],
                            'statuskonf'     => 'send',
                            'comment'        => $post['comment'],
                        );
                       
                        $this->InternalHonorarium_m->addInventarisProses($postSend);
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

   

    public function viewNewInventaris(){
        $this->load->view('petugas/internal_honorarium/inventaris_distribusi/inventaris_new');
    }
    public function getNewInventaris(){
        $petugas  = $this->fungsi->petugas_login()->subbidangID;
        $data = $this->InternalHonorarium_m->getAllNewInventaris($petugas)->result();
        foreach($data as $row){
            $dataApproval = $this->InternalHonorarium_m->getAllApprovalID($row->invent_approvDetailID)->row();
            $dataBudget = $this->InternalHonorarium_m->getAllBudgetHonorID($row->invent_budgethonorID)->row();
            $arrayData[] = array(
                'inventarisdetailID' => $row->inventarisdetailID,
                'inventarisID'       => $row->inventD_inventarisID,
                'budgethonorNo'      => $dataBudget->budgethonorNo,
                'pengeluaranID'      => $dataApproval->pengeluaranID,
                'pengirimID'         => $row->inventD_pengirimID,
                'status'             => $row->status,
                'waktu'              => $row->inventDWaktu,
            );
        }
        echo json_encode($arrayData); 
    }

    public function konfInventaris($id){
        $data                   = array();
        $data_query             =  $this->InternalHonorarium_m->getAllInventarisID($id)->row();
        $data['petugasLogin']   = $this->fungsi->petugas_login()->subbidangID;
        $data['waktusekarang']  = date('Y-m-d H:i:s');

        if($data['petugasLogin'] != $data_query->inventD_pengirimID){
            if($data_query->inventDWaktu_start == null && $data_query->inventDWaktu_end == null){
                $dataQuoDetail['statusConf']  = 'read';
                $dataQuoDetail['quoProsesID'] = $id;
                $this->InternalHonorarium_m->changeStatusINVT($dataQuoDetail);
                $dataQuoDetail['waktustart']   = date('Y-m-d H:i:s');
                $dataQuoDetail['waktuend']     = date('Y-m-d H:i:s',strtotime('+19 minutes',strtotime($dataQuoDetail['waktustart'])));
                $this->InternalHonorarium_m->uploadTimeWorkINVT($dataQuoDetail);
            }
            $data['rowInv']    =  $this->InternalHonorarium_m->getAllInventarisID($id)->row();
            $data['rowApprov'] = $this->InternalHonorarium_m->getAllApprovalID($data['rowInv']->invent_approvDetailID)->row();
            $data['rowBudget'] = $this->InternalHonorarium_m->getAllBudgetHonorID($data['rowInv']->invent_budgethonorID)->row();
            $this->load->view('petugas/internal_honorarium/inventaris_distribusi/inventaris_konf', $data);
        }else{
            $data['rowInv']    =  $this->InternalHonorarium_m->getAllInventarisID($id)->row();
            $data['rowApprov'] = $this->InternalHonorarium_m->getAllApprovalID($data['rowInv']->invent_approvDetailID)->row();
            $data['rowBudget'] = $this->InternalHonorarium_m->getAllBudgetHonorID($data['rowInv']->invent_budgethonorID)->row();
            $this->load->view('petugas/internal_honorarium/inventaris_distribusi/inventaris_konf', $data);
        }



        // $data['row'] = $this->InternalHonorarium_m->getAllInventarisID($id)->row();
        // $this->load->view('petugas/internal_honorarium/inventaris_distribusi/inventaris_konf', $data);
    }

    



    public function viewFailedInventaris(){
        $this->load->view('petugas/internal_honorarium/inventaris_distribusi/inventaris_falid');
    }
    
    public function revisiInventaris($id){
        $data                   = array();
        $data_query             =  $this->InternalHonorarium_m->getAllInventarisID($id)->row();
        $data['petugasLogin']   = $this->fungsi->petugas_login()->subbidangID;
        $data['waktusekarang']  = date('Y-m-d H:i:s');

        if($data['petugasLogin'] != $data_query->inventD_pengirimID){
            if($data_query->inventDWaktu_start == null && $data_query->inventDWaktu_end == null){
                $dataQuoDetail['statusConf']  = 'read';
                $dataQuoDetail['quoProsesID'] = $id;
                $this->InternalHonorarium_m->changeStatusINVT($dataQuoDetail);
                $dataQuoDetail['waktustart']   = date('Y-m-d H:i:s');
                $dataQuoDetail['waktuend']     = date('Y-m-d H:i:s',strtotime('+19 minutes',strtotime($dataQuoDetail['waktustart'])));
                $this->InternalHonorarium_m->uploadTimeWorkINVT($dataQuoDetail);
            }
            $data['rowInv']    =  $this->InternalHonorarium_m->getAllInventarisID($id)->row();
            $data['rowApprov'] = $this->InternalHonorarium_m->getAllApprovalID($data['rowInv']->invent_approvDetailID)->row();
            $data['rowBudget'] = $this->InternalHonorarium_m->getAllBudgetHonorID($data['rowInv']->invent_budgethonorID)->row();
            $this->load->view('petugas/internal_honorarium/inventaris_distribusi/inventaris_revisi', $data);
        }else{
            $data['rowInv']    =  $this->InternalHonorarium_m->getAllInventarisID($id)->row();
            $data['rowApprov'] = $this->InternalHonorarium_m->getAllApprovalID($data['rowInv']->invent_approvDetailID)->row();
            $data['rowBudget'] = $this->InternalHonorarium_m->getAllBudgetHonorID($data['rowInv']->invent_budgethonorID)->row();
            $this->load->view('petugas/internal_honorarium/inventaris_distribusi/inventaris_revisi', $data);
        }
        // $data['row'] = $this->InternalHonorarium_m->getAllInventarisID($id)->row();
        // $this->load->view('petugas/internal_honorarium/inventaris_distribusi/inventaris_revisi', $data);
    }





    public function timeViewInventaris(){
        $this->timeWorkInventaris();
        $response = array();
        $xproses = array();
        $getID    = $this->input->get('id');
        // $getID    = 22;
        $waktu_sekarang = date('Y-m-d H:i:s');
        $data_query = $this->InternalHonorarium_m->getINVTByID($getID)->row();
        $dataQuoMax = $this->InternalHonorarium_m->getINVTByIDMax($data_query->inventD_inventarisID)->row();
        if($dataQuoMax->inventarisdetailID > $getID){
            $checkAllDetailID[] = 'success';
        }else{
            $checkAllDetailID[] = 'proses';
        }
        $dataFR = $this->InternalHonorarium_m->getINVTByFRID($data_query->inventD_inventarisID)->result();
        foreach($dataFR as $row){
            if($row->status == 'reject'){
                $xproses = 'reject';
            }else if($row->status == 'success'){
                $xproses = 'success';
            }else{
                $xproses = 'proses';
            }
        }

        if($data_query->inventDWaktu_end != null){
            $response = array(
                'status'    => $checkAllDetailID,
                'statusAll' => $xproses,
                'waktuEnd'  => $data_query->inventDWaktu_end,
            ); 
        }
        echo json_encode($response);
    }


    public function checkPenerimaInventaris($subbidangPetugas){
        $file = array();
        // $subbidangPetugas      = $this->fungsi->petugas_login()->subbidangID;
        $dataPenerimaDesc         = $this->InternalHonorarium_m->getINVTByPenerimaIDMax($subbidangPetugas)->result();
        if($dataPenerimaDesc != null){
            foreach($dataPenerimaDesc as $row){
                $frPenerimaID[] = $row->inventarisdetailID;
            }
            $dataPenerima     = $this->InternalHonorarium_m->getINVTByID($frPenerimaID)->result();
            foreach($dataPenerima as $row1){
                $file[] = array(
                    'frDetailID' => $row1->inventarisdetailID,
                    'frID'       => $row1->inventD_inventarisID,
                );
            } 
        }
        return $file;
        // echo json_encode($file);
    }

    public function timeWorkInventaris(){   
        $file1          = array();
        $fileDetailID   = array();
        $detailID       = array();
        $post           = array();
        $response       = array();
        $petugasID      = $this->fungsi->petugas_login()->subbidangID;
        $dataPenerima   = $this->checkPenerimaInventaris($petugasID);
        $waktu_sekarang = date('Y-m-d H:i:s');
        foreach($dataPenerima as $row){
            $detailID[] = $row['frDetailID'];
            $id[]       = $row['frID'];
        }

        $dataPengirimDesc = $this->InternalHonorarium_m->getINVTByPengirimID($id, $petugasID)->result();
        if($dataPengirimDesc != null){
            foreach($dataPengirimDesc as $row1){
                if(in_array($row1->inventD_inventarisID, $id)){
                    $file1[] = $row1->inventD_inventarisID; //Data Pengirim ADA 
                    $fileDetailID[] = $row1->inventarisdetailID; //Data Pengirim ADA 
                }
            }
        // // //     //////////////////Jika Petugas Sudah Menerima Dan Mengirimkan FR ID////////////////////////////
            $dataFR = $this->InternalHonorarium_m->getINVTByPengirimIDMax($file1, $petugasID)->result();
            foreach($dataFR as $row2){
                $frDetailIDDesc[] = $row2->inventarisdetailID;
            }
            
        //     $dataPegirim = $this->InternalHonorarium_m->getINVTByID($frDetailIDDesc)->result();
        //     foreach($dataPegirim as $row3){
        //         $dataDetailCheck = $this->InternalHonorarium_m->getMarFRDByPenerimaIDMaxID($row3->inventD_inventarisID, $petugasID)->row();
        //         $dataPenerimaCheck = $this->InternalHonorarium_m->getINVTByID($dataDetailCheck->inventarisdetailID)->row();
        //         if($row3->inventD_inventarisID == $dataPenerimaCheck->inventD_inventarisID){
        //             $file2[] = $row3->inventD_inventarisID; //Data Pengirim ADA 
        //             if($dataDetailCheck->inventarisdetailID > $row3->inventarisdetailID){
        //                 // $xd[] = " DetailID : ". $dataDetailCheck->inventarisdetailID.">".$row3->inventarisdetailID;//Exekusi TimeOut
        //                 $waktux[] = $row3->inventDWaktu_end;
        //                 if($dataPenerimaCheck->inventDWaktu_end != null){
        //                     if($dataPenerimaCheck->status != 'success'){
        //                         if($waktu_sekarang > $dataPenerimaCheck->inventDWaktu_end){
                                  
                           
        //                             $post['status']      = 'RJ1';//Reject Waktu
        //                             $post['quoProsesID'] = $dataPenerimaCheck->inventarisdetailID;
        //                             $this->InternalHonorarium_m->setINVTStatus($post);
                                   
        //                             // $response[] = array(
        //                             //     'status' => 'sukses',
        //                             //     'message' => 'Prosess 1'
        //                             // );
        //                         }
        //                     } 
        //                 }
        //             }
        //         }
        //     }

        //     /////////////////////////////Jika Petugas hanya menerima FR ID////////////////////////////
        //     $pengirimNull     = array_diff($id, $file1); //Data Pengirim Tidak Ada
        //     if($pengirimNull != null){
        //         $dataPenerimaNull = $this->InternalHonorarium_m->getINVTByFRID($pengirimNull)->result();
        //         foreach($dataPenerimaNull as $row4){
        //             $dataDetailCheck1 = $this->InternalHonorarium_m->getMarFRDByPenerimaIDMaxID($row4->inventD_inventarisID, $petugasID)->row();
        //             $dataPenerimaCheck1 = $this->InternalHonorarium_m->getINVTByID($dataDetailCheck1->inventarisdetailID)->row();
        //             if($row4->inventD_inventarisID == $dataPenerimaCheck1->inventD_inventarisID){
        //                 $x1 = $row4->inventarisdetailID ;
        //                 // $x = $dataPenerimaCheck1->inventD_inventarisID;
        //                 // if($dataPenerimaCheck1->inventarisdetailID > $row4->inventarisdetailID){
        //                     $z = $row4->inventarisdetailID;
        //                     // $waktu1[] = $dataPenerimaCheck1->inventDWaktu_end;
        //                     if($dataPenerimaCheck1->inventDWaktu_end != null){
        //                         if($dataPenerimaCheck1->status != 'success'){
        //                             if($waktu_sekarang > $dataPenerimaCheck1->inventDWaktu_end){
                                    
                                      
        //                                 $post['status']      = 'RJ1';//Reject Waktu
        //                                 $post['quoProsesID'] = $dataPenerimaCheck1->inventarisdetailID;
        //                                 $this->InternalHonorarium_m->setINVTStatus($post);
                                
        //                                 $response[] = array(
        //                                     'status' => 'sukses',
        //                                     'message' => 'Prosess 2'
        //                                 );
        //                             }
        //                         }
        //                     }
        //                 // }
        //             }
        //         }
        //     }
            
        }else{//Data Pertama sekali

            $dataPenerimax = $this->InternalHonorarium_m->getINVTByPenerimaID($id, $petugasID)->result();
            foreach($dataPenerimax as $rowx){
                $waktu[] = $rowx->inventDWaktu_end;
                if($rowx->inventDWaktu_end != null){
                    if($rowx->status != 'success'){
                        if($waktu_sekarang > $rowx->inventDWaktu_end){
                           
                            $post['status']      = 'RJ1';//Reject Waktu
                            $post['quoProsesID'] = $rowx->inventarisdetailID;
                           
                            $this->InternalHonorarium_m->setINVTStatus($post);
                            $response[] = array(
                                'status' => 'sukses',
                                'message' => 'Prosess 3'
                            );
                        }
                    }
                }
            }
        } 

        // echo json_encode($dataPenerimax); 
    }




    //END Budget Honor


     //////////////////////////Upload File /////////////////////////////
     function file_selected_test($file){
        if(!empty($_FILES[$file]['name']) != null) {
            return TRUE;
        }
        else{
            $this->form_validation->set_message('file_selected_test', '%s masih Kososng, Silahkan Upload File Quotaion');
            return FALSE;
        }
    }

    public function upload($post, $data1, $urlPath){
        $config = array();
        $config['upload_path'] =  $urlPath;
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
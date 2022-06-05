<?php defined('BASEPATH') OR exit('No direct script access allowed');

class IntPengadaanBarang extends CI_Controller {

	function __construct(){
        parent::__construct();
        check_not_petugas();
        $this->load->model(['InternalPengadaan_m']);
        $this->load->library('form_validation');
        $this->load->helper(array('form','url'));
        
    }

    /////////////////////////////////////////////////////////////

    //PATTY CASH
    public function viewDataPettyCash(){
        $this->load->view('petugas/internal_pengadaan_barang/draft_pattycash/draftPattycash_data');
    }
    public function getDataPettyCash(){
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

    public function viewDetailDataPettyCash($id){
        $data['row'] = $this->InternalPengadaan_m->getQuoDetailByQuoIDDESC($id)->row();
        $this->load->view('petugas/internal_pengadaan_barang/draft_pattycash/draftPattycash_detaildata', $data);
    }

    public function getDetailDataPettyCash(){
        $id = $this->input->get('id');
        $petugas  = $this->fungsi->petugas_login()->subbidangID;
        

        $data2 = $this->InternalPengadaan_m->getWorkflowPetugasID($petugas)->result();
        foreach($data2 as $row2){
            if($row2->pattycashNo == $id){
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
        }
        echo json_encode($arrayData);
    }


    public function viewAddPettyCash(){
        $bidang = $this->fungsi->petugas_login()->bidangID;
        if($bidang == 1){
            $data['rowBidang'] = 'Marine';
        }else if($bidang == 2){
            $data['rowBidang'] = 'Minerba';
        }
        $this->load->view('petugas/internal_pengadaan_barang/draft_pattycash/draftPattycash_create', $data);
    }
    public function addPettyCash(){
        $response = array();
        $post = array();
        // $post = $this->input->post(null, TRUE);
        if(!empty($_FILES['pattycashFile']['name']) == null){
            $this->form_validation->set_rules('pattycashFile', 'pattycashFile', 'callback_file_selected_test["pattycashFile"]');
        }
        $this->form_validation->set_rules('bidangID', 'bidangID', 'required');
        $this->form_validation->set_message('required', '%s masih Kososng, atau belum di pilih Silahkan Di isi');
        
        if($this->form_validation->run() == FALSE){
            $response = array(
                'status' 	    => 'error',
                'bidangID' => form_error('bidangID'),
                'pattycashFile' => form_error('pattycashFile')
                
            );   
        } else{
            $post['pattycashNo']   = $this->input->post('pattycashNo');
            // $post['pattycashFile']   = $this->input->post('pattycashFile');
            $ptcNoPost =  $post['pattycashNo'];
            $post['bidangID']      = $this->input->post('bidangID');
            $post['petugasID']     = $this->fungsi->petugas_login()->petugasID;
            $post['pengirimID']    = $this->fungsi->petugas_login()->subbidangID;
            
            $post['comment']      = $this->input->post('commentPatty');

            if($post['bidangID'] == 1){
                $post['bidangNama'] = 'Marine';
            }else if($post['bidangID'] == 2){
                $post['bidangNama'] = 'Minerba';
            }
            
            if($this->input->post('send_up')){
                $post['penerimaID']    = $this->fungsi_send->sendreceiver2();
            }else if($this->input->post('send_down')){
                $post['penerimaID']    = $this->fungsi_send->sendreceiver4($post['bidangID']);
            } 
            $jumlah                = $this->InternalPengadaan_m->jumlahPattycashProses($post);

            if($ptcNoPost == null){
                //////////Create ID//////////
                date_default_timezone_set("Asia/Jakarta");
                $char    = 'BDH';
                $date    = date("Y-m-d");
                $tahun   = substr($date, 0, 2);
                $bulan   = substr($date, 5, 2);
                $hari    = substr($date, 8, 2);
                $pattycash   = $this->InternalPengadaan_m->getAllMaxPattyCash()->row(); 
                $pattycashNo = (int) substr($pattycash->pattycashNo, 9, 4);
                $pattycashNo++;
                $ptcNo = $char.$tahun.$bulan.$hari.sprintf("%04s", $pattycashNo);
                ///////////End Create ID////////////
            }else{
                $ptcNo = $post['pattycashNo'];
                $status_reject         = $this->InternalPengadaan_m->getBudgetHonorbyID($ptcNoPost)->result();
                foreach($status_reject as $row){
                    $rowReject[] = $row->status;
                }
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

                $data1 = 'pattycashFile';
                
                $urlPath = './uploads/pengadaan/'.$post['bidangNama'].'/pattycash/';
                $file = $this->upload($post, $data1, $urlPath);
                
                $response = array(
                    'status' 	    => 'success',
                );
                if($file['status'] == true){
                    if($file['name'] != null){
                        $post['pattycashFile'] = $file['name']; 
                    } 
                    else{
                        $post['pattycashFile'] =  $this->input->post('quoFileSeuccess');
                    }

                    $postSend = array(
                        'id'               => $ptcNo,
                        'bidangID'         => $post['bidangID'],
                        'petugasID'        => $post['petugasID'],
                        'pengirimID'       => $post['pengirimID'],
                        'penerimaID'       => $post['penerimaID'],
                        'statusID'         => $post['status'],
                        'pattycashFile'    => $post['pattycashFile'],
                        'jumlah'           => $post['jumlah'],
                        'statusKonfirmasi' => 'send',
                        'comment'          => $post['comment'],
                    );

                    $this->InternalPengadaan_m->addPattycashProses($postSend);
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

   

    public function viewNewPettyCash(){
        $this->load->view('petugas/internal_pengadaan_barang/draft_pattycash/draftPattycash_new');
    }
    public function getNewPettyCash(){
        $petugas   = $this->fungsi->petugas_login()->subbidangID;
        $data = $this->InternalPengadaan_m->getAllPattyCashNew($petugas)->result();
        foreach($data as $row){
            if($row->pc_bidangID == 1){
                $bidangNama = 'Marine';
            }else if($row->pc_bidangID == 2){
                $bidangNama = 'Minerba';
            }
            $arrayData[] = array(
                'pattycashID' => $row->pattycashID,
                'pattycashNo' => $row->pattycashNo,
                'bidang'      => $bidangNama,
                'status'      => $row->status,
                'pengirim'    => $row->pc_pengirimID,
                'waktu'       => $row->pcWaktu,
            );   
        }
        echo json_encode($arrayData); 
    }

    public function konfPettyCash($id){
        $data                   = array();
        $data_query             = $this->InternalPengadaan_m->getAllPattyCashID($id)->row();
        $data['petugasLogin']   = $this->fungsi->petugas_login()->subbidangID;
        $data['waktusekarang']  = date('Y-m-d H:i:s');

        if($data_query->pc_bidangID == 1){
            $data['rowBidang'] = 'Marine';
        }else if($data_query->pc_bidangID == 2){
            $data['rowBidang'] = 'Minerba';
        }

        if($data['petugasLogin'] != $data_query->pc_pengirimID){
            if($data_query->pcWaktu_start == null && $data_query->pcWaktu_end == null){
                $dataQuoDetail['statusConf']  = 'read';
                $dataQuoDetail['quoProsesID'] = $id;
                $this->InternalPengadaan_m->changeStatusQuoDetail($dataQuoDetail);
                $dataQuoDetail['waktustart']   = date('Y-m-d H:i:s');
                $dataQuoDetail['waktuend']     = date('Y-m-d H:i:s',strtotime('+20 minutes',strtotime($dataQuoDetail['waktustart'])));
                $this->InternalPengadaan_m->uploadTimeWork($dataQuoDetail);
            }
            $data['rowPattycash']  = $this->InternalPengadaan_m->getAllPattyCashID($id)->row();
            $data['rowlistBelanja'] = $this->InternalPengadaan_m->getAlllistBelanjaByPattyID($data['rowPattycash']->pattycashID)->row();
            $this->load->view('petugas/internal_pengadaan_barang/draft_pattycash/draftPattycash_konf', $data);
        }else{
            $data['rowPattycash']  = $this->InternalPengadaan_m->getAllPattyCashID($id)->row();
            $data['rowlistBelanja'] = $this->InternalPengadaan_m->getAlllistBelanjaByPattyID($data['rowPattycash']->pattycashID)->row();
            $this->load->view('petugas/internal_pengadaan_barang/draft_pattycash/draftPattycash_konf', $data);
        }

    }

    public function viewFailedPettyCash(){
        $this->load->view('petugas/internal_pengadaan_barang/draft_pattycash/draftPattyCash_failed');
    }

   
    
    public function revisiPettyCash($id){
        $data                   = array();
        $data_query             = $this->InternalPengadaan_m->getAllPattyCashID($id)->row();
        $data['petugasLogin']   = $this->fungsi->petugas_login()->subbidangID;
        $data['waktusekarang']  = date('Y-m-d H:i:s');

        if($data_query->pc_bidangID == 1){
            $data['rowBidang'] = 'Marine';
        }else if($data_query->pc_bidangID == 2){
            $data['rowBidang'] = 'Minerba';
        }

        if($data['petugasLogin'] == $data_query->pc_penerimaID){
            if($data_query->pcWaktu_start == null && $data_query->pcWaktu_end == null){
                $dataQuoDetail['statusConf']  = 'read';
                $dataQuoDetail['quoProsesID'] = $id;
                $this->InternalPengadaan_m->changeStatusQuoDetail($dataQuoDetail);
                $dataQuoDetail['waktustart']   = date('Y-m-d H:i:s');
                $dataQuoDetail['waktuend']     = date('Y-m-d H:i:s',strtotime('+20 minutes',strtotime($dataQuoDetail['waktustart'])));
                $this->InternalPengadaan_m->uploadTimeWork($dataQuoDetail);
            }
            $data['rowPattycash']  = $this->InternalPengadaan_m->getAllPattyCashID($id)->row();
            $this->load->view('petugas/internal_pengadaan_barang/draft_pattycash/draftPattycash_revisi', $data);
        }else{
            $data['rowPattycash']  = $this->InternalPengadaan_m->getAllPattyCashID($id)->row();
            $this->load->view('petugas/internal_pengadaan_barang/draft_pattycash/draftPattycash_revisi', $data);
        }
    }


    //////////////////////TIMEOUT DRAFT PENGADAAN/PATTY CASH////////////////////////////////////


    public function timeViewPattyCash(){
        $this->timeWorkPattyCash();
        $response = array();
        $xproses = array();
        $getID    = $this->input->get('id');
        // $getID    = 22;
        $waktu_sekarang = date('Y-m-d H:i:s');
        $data_query = $this->InternalPengadaan_m->getMarFRDByID($getID)->row();
        $dataQuoMax = $this->InternalPengadaan_m->getMarFRDByIDMax($data_query->pattycashNo)->row();
        if($dataQuoMax->pattycashID > $getID){
            $checkAllDetailID[] = 'success';
        }else{
            $checkAllDetailID[] = 'proses';
        }
        $dataFR = $this->InternalPengadaan_m->getMarFRDByFRID($data_query->pattycashNo)->result();
        foreach($dataFR as $row){
            if($row->status == 'reject'){
                $xproses = 'reject';
            }else if($row->status == 'success'){
                $xproses = 'success';
            }else{
                $xproses = 'proses';
            }
        }

        if($data_query->pcWaktu_end != null){
            $response = array(
                'status'    => $checkAllDetailID,
                'statusAll' => $xproses,
                'waktuEnd'  => $data_query->pcWaktu_end,
            ); 
        }
        echo json_encode($response);
    }


    public function checkPenerima($subbidangPetugas){
        $file = array();
        // $subbidangPetugas      = $this->fungsi->petugas_login()->subbidangID;
        $dataPenerimaDesc         = $this->InternalPengadaan_m->getMarFRDByPenerimaIDMax($subbidangPetugas)->result();
        if($dataPenerimaDesc != null){
            foreach($dataPenerimaDesc as $row){
                $frPenerimaID[] = $row->pattycashID;
            }
            $dataPenerima     = $this->InternalPengadaan_m->getMarFRDByID($frPenerimaID)->result();
            foreach($dataPenerima as $row1){
                $file[] = array(
                    'frDetailID' => $row1->pattycashID,
                    'frID'       => $row1->pattycashNo,
                );
            } 
        }
        return $file;
        // echo json_encode($file);
    }

    public function timeWorkPattyCash(){   
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

        $dataPengirimDesc = $this->InternalPengadaan_m->getMarFRDByPengirimID($id, $petugasID)->result();
        if($dataPengirimDesc != null){
            foreach($dataPengirimDesc as $row1){
                if(in_array($row1->pattycashNo, $id)){
                    $file1[] = $row1->pattycashNo; //Data Pengirim ADA 
                    $fileDetailID[] = $row1->pattycashID; //Data Pengirim ADA 
                }
            }
        // // //     //////////////////Jika Petugas Sudah Menerima Dan Mengirimkan FR ID////////////////////////////
            $dataFR = $this->InternalPengadaan_m->getMarFRDByPengirimIDMax($file1, $petugasID)->result();
            foreach($dataFR as $row2){
                $frDetailIDDesc[] = $row2->pattycashID;
            }
            
            $dataPegirim = $this->InternalPengadaan_m->getMarFRDByID($frDetailIDDesc)->result();
            foreach($dataPegirim as $row3){
                $dataDetailCheck = $this->InternalPengadaan_m->getMarFRDByPenerimaIDMaxID($row3->pattycashNo, $petugasID)->row();
                $dataPenerimaCheck = $this->InternalPengadaan_m->getMarFRDByID($dataDetailCheck->pattycashID)->row();
                if($row3->pattycashNo == $dataPenerimaCheck->pattycashNo){
                    $file2[] = $row3->pattycashNo; //Data Pengirim ADA 
                    if($dataDetailCheck->pattycashID > $row3->pattycashID){
                        // $xd[] = " DetailID : ". $dataDetailCheck->pattycashID.">".$row3->pattycashID;//Exekusi TimeOut
                        $waktux[] = $row3->pcWaktu_end;
                        if($dataPenerimaCheck->pcWaktu_end != null){
                            if($dataPenerimaCheck->status != 'success'){
                                if($waktu_sekarang > $dataPenerimaCheck->pcWaktu_end){
                                  
                           
                                    $post['status']      = 'RJ1';//Reject Waktu
                                    $post['quoProsesID'] = $dataPenerimaCheck->pattycashID;
                                    $this->InternalPengadaan_m->setMarFRDStatus($post);
                                   
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

        //     /////////////////////////////Jika Petugas hanya menerima FR ID////////////////////////////
            $pengirimNull     = array_diff($id, $file1); //Data Pengirim Tidak Ada
            if($pengirimNull != null){
                $dataPenerimaNull = $this->InternalPengadaan_m->getMarFRDByFRID($pengirimNull)->result();
                foreach($dataPenerimaNull as $row4){
                    $dataDetailCheck1 = $this->InternalPengadaan_m->getMarFRDByPenerimaIDMaxID($row4->pattycashNo, $petugasID)->row();
                    $dataPenerimaCheck1 = $this->InternalPengadaan_m->getMarFRDByID($dataDetailCheck1->pattycashID)->row();
                    if($row4->pattycashNo == $dataPenerimaCheck1->pattycashNo){
                        $x1 = $row4->pattycashID ;
                        // $x = $dataPenerimaCheck1->pattycashNo;
                        // if($dataPenerimaCheck1->pattycashID > $row4->pattycashID){
                            $z = $row4->pattycashID;
                            // $waktu1[] = $dataPenerimaCheck1->waktu_end;
                            if($dataPenerimaCheck1->pcWaktu_end != null){
                                if($dataPenerimaCheck1->status != 'success'){
                                    if($waktu_sekarang > $dataPenerimaCheck1->pcWaktu_end){
                                    
                                      
                                        $post['status']      = 'RJ1';//Reject Waktu
                                        $post['quoProsesID'] = $dataPenerimaCheck1->pattycashID;
                                        $this->InternalPengadaan_m->setMarFRDStatus($post);
                                
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

            $dataPenerimax = $this->InternalPengadaan_m->getMarFRDByPenerimaID($id, $petugasID)->result();
            foreach($dataPenerimax as $rowx){
                $waktu[] = $rowx->pcWaktu_end;
                if($rowx->pcWaktu_end != null){
                    if($rowx->status != 'success'){
                        if($waktu_sekarang > $rowx->pcWaktu_end){
                           
                            $post['status']      = 'RJ1';//Reject Waktu
                            $post['quoProsesID'] = $rowx->pattycashID;
                           
                            $this->InternalPengadaan_m->setMarFRDStatus($post);
                            $response[] = array(
                                'status' => 'sukses',
                                'message' => 'Prosess 3'
                            );
                        }
                    }
                }
            }
        } 

        // echo json_encode($dataPegirim); 
    }

    //END PATTY CASH
    /////////////////////////////////////////////////////////////

    //LIST BELANJA (PERIODIC Dan INSIDENTIL)
    public function viewDataListBelanja(){
        $this->load->view('petugas/internal_pengadaan_barang/belanja_list/belanjalist_data');
    }

    public function getDataListBelanja(){
        $petugas  = $this->fungsi->petugas_login()->subbidangID;
        $data1 = $this->InternalPengadaan_m->getLBPbyPetugas($petugas)->result();
        foreach($data1 as $row1){
            $budgethonorID1[] = $row1->listbelanjaID;
        }

        $data2 = $this->InternalPengadaan_m->getAllLBPByID($budgethonorID1)->result();
        foreach($data2 as $row2){

            $dataProses = $this->InternalPengadaan_m->getLBPByNoDesc($row2->listbelanjaNo)->row();
                if($dataProses->status == 'reject'){
                    $xproses = 'reject';
                }else if($dataProses->status == 'success'){
                    $xproses = 'success';
                }else{
                    $xproses = 'proses';
                }
    
                $arrayData[] = array(
                    'listbelanjaID'     => $row2->listbelanjaID,
                    'listbelanjaNo'     => $row2->listbelanjaNo,
                    'pattycashNo'       => $row2->pattycashNo,
                    'status'            => $row2->status,
                    'statusProses'      => $xproses,
                    'pengirim'          => $row2->lb_pengirimID,
                    'penerima'          => $row2->lb_penerimaID,
                    'waktu'             => $row2->lbWaktu
                );
            }

        echo json_encode($arrayData);
       
    }

    public function viewAddListBelanja($id){
        $data['row'] = $this->InternalPengadaan_m->getAllPattyCashID($id)->row();
        if($data['row']->pc_bidangID == 1){
            $data['rowBidang'] = 'Marine';
        }else if($data['row']->pc_bidangID == 2){
            $data['rowBidang'] = 'Minerba';
        }
        $this->load->view('petugas/internal_pengadaan_barang/belanja_list/belanjalist_create', $data);
    }
    public function addListBelanja(){
        $response = array();
        $post = array();
        if(!empty($_FILES['filePeriodic']['name']) == null){
            $this->form_validation->set_rules('filePeriodic', 'filePeriodic', 'callback_file_selected_test["filePeriodic"]');
        }
        if(!empty($_FILES['fileInsidentil']['name']) == null){
            $this->form_validation->set_rules('fileInsidentil', 'fileInsidentil', 'callback_file_selected_test["fileInsidentil"]');
        }
        $this->form_validation->set_rules('pattycashID', 'pattycashID', 'required|is_unique[tb_int_pengadaan_listbelanja.lb_pattycashID]');
        $this->form_validation->set_rules('bidangID', 'bidangID', 'required');

        $this->form_validation->set_message('required', '%s masih Kososng, atau belum di pilih Silahkan Di isi');
        $this->form_validation->set_message('is_unique', '{field} ini sudah dipakai, silahkan ganti');
        
        if($this->form_validation->run() == FALSE){
            $response = array(
                'status' 	    => 'error',
                'pattycashID' => form_error('pattycashID'),
                'bidangID' => form_error('bidangID'),
                'filePeriodic' => form_error('filePeriodic'),
                'fileInsidentil' => form_error('fileInsidentil'), 
            );   
        }
         else{   
            $post['pattycashID']   = $this->input->post('pattycashID');
            $post['bidangID']      = $this->input->post('bidangID');
            $post['petugasID']     = $this->fungsi->petugas_login()->petugasID;
            $post['pengirimID']    = $this->fungsi->petugas_login()->subbidangID;
            $post['penerimaID']      = $this->fungsi_send->sendreceiver2();
            $post['comment']      = $this->input->post('commentBelanjaList');
            

            if($post['bidangID'] == 1){
                $post['bidangNama'] = 'Marine';
            }else if($post['bidangID'] == 2){
                $post['bidangNama'] = 'Minerba';
            }
            
            //////////Create ID//////////
            date_default_timezone_set("Asia/Jakarta");
            $char    = 'LBP';
            $date    = date("Y-m-d");
            $tahun   = substr($date, 0, 2);
            $bulan   = substr($date, 5, 2);
            $hari    = substr($date, 8, 2);
            $listbelanja   = $this->InternalPengadaan_m->getAllMaxLBPI()->row(); 
            $listbelanjaNo = (int) substr($listbelanja->listbelanjaNo, 12, 4);
            $listbelanjaNo++;
            $lbpi = $char.$tahun.$bulan.$hari.sprintf("%04s", $listbelanjaNo);
            ///////////End Create ID////////////
            
            $post['status'] = 'file';   
            $data1 = 'filePeriodic';
            $urlPath1 = './uploads/pengadaan/'.$post['bidangNama'].'/listBelanja/periodic/';
            $data2 = 'fileInsidentil';
            $urlPath2 = './uploads/pengadaan/'.$post['bidangNama'].'/listBelanja/insidentil/';
            $file1 = $this->upload($post, $data1, $urlPath1);
            $file2 = $this->upload($post, $data2, $urlPath2);

            
            if($file1['status'] == true && $file2['status'] == true ){
                if($file1['name'] != null){
                    $post['filePeriodic'] = $file1['name']; 
                }else{
                    $post['filePeriodic'] = $this->input->post('filePeriodic_send');
                } 
                if($file2['name'] != null){
                    $post['fileInsidentil'] = $file2['name']; 
                }else{
                    $post['fileInsidentil'] = $this->input->post('fileInsidentil_send');
                } 

                $postSend = array(    
                    'listbelanjaNo'    => $lbpi, 
                    'pattycashID'      => $post['pattycashID'],
                    'bidangID'         => $post['bidangID'],
                    'petugasID'        => $post['petugasID'],
                    'pengirimID'       => $post['pengirimID'],
                    'penerimaID'       => $post['penerimaID'],
                    'statusID'         => 'NW1',
                    'filePeriodic'     => $post['filePeriodic'],
                    'fileInsidentil'   => $post['fileInsidentil'],
                    'statusKonfirmasi' => 'send',
                    'comment'          => $post['comment']
                );
                
                $this->InternalPengadaan_m->addlistBelanjaProses($postSend);
                
                if($this->db->affected_rows()>0){ 
                    $postPattycash['status']      = 'SC1';//Reject Waktu
                    $postPattycash['quoProsesID'] = $post['pattycashID'];
                    $this->InternalPengadaan_m->setMarFRDStatus($postPattycash);

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
    public function viewNewListBelanja(){
        $this->load->view('petugas/internal_pengadaan_barang/belanja_list/belanjalist_new');
    }

    public function getNewListBelanja(){
        $petugas   = $this->fungsi->petugas_login()->subbidangID;
        $data = $this->InternalPengadaan_m->getAlllistBelanjaNew($petugas)->result();
        foreach($data as $row){
            if($row->lb_bidangID == 1){
                $bidangNama = 'Marine';
            }else if($row->lb_bidangID == 2){
                $bidangNama = 'Minerba';
            }
            $arrayData[] = array(
                'listbelanjaID' => $row->listbelanjaID,
                'listbelanjaNo' => $row->listbelanjaNo,
                'pattycashNo'   => $row->pattycashNo,
                'bidang'        => $bidangNama,
                'status'        => $row->status,
                'pengirim'      => $row->lb_pengirimID,
                'waktu'         => $row->lbWaktu,
            );   
        }
        echo json_encode($arrayData);
    }


    
    public function konfListBelanja($id){
        $data                   = array();
        $data1                  = array();
        $data_query             = $this->InternalPengadaan_m->getAlllistBelanjabyID($id)->row();
        $data['petugasLogin']   = $this->fungsi->petugas_login()->subbidangID;
        $data['waktusekarang']  = date('Y-m-d H:i:s');

        if($data_query->lb_bidangID == 1){
            $data['rowBidang'] = 'Marine';
        }else if($data_query->lb_bidangID == 2){
            $data['rowBidang'] = 'Minerba';
        }

        if($data['petugasLogin'] == $data_query->lb_penerimaID){
            if($data_query->lbWaktu_start == null && $data_query->lbWaktu_end == null){
                $dataQuoDetail['statusConf']  = 'read';
                $dataQuoDetail['quoProsesID'] = $id;
                $this->InternalPengadaan_m->changeStatusQuoDetailLBPI($dataQuoDetail);
                $dataQuoDetail['waktustart']  = date('Y-m-d H:i:s');
                $dataQuoDetail['waktuend']    = date('Y-m-d H:i:s',strtotime('+10 minutes',strtotime($dataQuoDetail['waktustart'])));
                $this->InternalPengadaan_m->uploadTimeWorkLBPI($dataQuoDetail);
            }

            $data['rowBelanjaList'] = $this->InternalPengadaan_m->getAlllistBelanjabyID($id)->row();
            $this->load->view('petugas/internal_pengadaan_barang/belanja_list/belanjalist_konf', $data);
            
        }else{
            $data['rowBelanjaList'] = $this->InternalPengadaan_m->getAlllistBelanjabyID($id)->row();
            $this->load->view('petugas/internal_pengadaan_barang/belanja_list/belanjalist_konf', $data);
        }
    }



    public function timeViewListBelanja(){
        $this->timeWorkListBelanja();
        $response = array();
        $xproses = array();
        $getID    = $this->input->get('id');
        // $getID    = 12;
        $waktu_sekarang = date('Y-m-d H:i:s');
        $data_query = $this->InternalPengadaan_m->getMarLBPIByID($getID)->row();
        $dataQuoMax = $this->InternalPengadaan_m->getMarLBPIByIDMax($data_query->listbelanjaNo)->row();
        if($dataQuoMax->listbelanjaID > $getID){
            $checkAllDetailID[] = 'success';
        }else{
            $checkAllDetailID[] = 'proses';
        }
        $dataFR = $this->InternalPengadaan_m->getMarLBPIByFRID($data_query->listbelanjaNo)->result();
        foreach($dataFR as $row){
            if($row->status == 'reject'){
                $xproses = 'reject';
            }else if($row->status == 'success'){
                $xproses = 'success';
            }else{
                $xproses = 'proses';
            }
        }

        if($data_query->lbWaktu_end != null){
            $response = array(
                'status'    => $checkAllDetailID,
                'statusAll' => $xproses,
                'waktuEnd'  => $data_query->lbWaktu_end,
            ); 
        }
        echo json_encode($response);
    }


    public function checkPenerimaListBelanja($subbidangPetugas){
        $file = array();
        // $subbidangPetugas      = $this->fungsi->petugas_login()->subbidangID;
        $dataPenerimaDesc         = $this->InternalPengadaan_m->getMarLBPIByPenerimaIDMax($subbidangPetugas)->result();
        if($dataPenerimaDesc != null){
            foreach($dataPenerimaDesc as $row){
                $frPenerimaID[] = $row->listbelanjaID;
            }
            $dataPenerima     = $this->InternalPengadaan_m->getMarLBPIByID($frPenerimaID)->result();
            foreach($dataPenerima as $row1){
                $file[] = array(
                    'frDetailID' => $row1->listbelanjaID,
                    'frID'       => $row1->listbelanjaNo,
                );
            } 
        }
        return $file;
        // echo json_encode($file);
    }

    public function timeWorkListBelanja(){   
        $file1          = array();
        $fileDetailID   = array();
        $detailID       = array();
        $post           = array();
        $response       = array();
        $petugasID      = $this->fungsi->petugas_login()->subbidangID;
        $dataPenerima   = $this->checkPenerimaListBelanja($petugasID);
        $waktu_sekarang = date('Y-m-d H:i:s');
        foreach($dataPenerima as $row){
            $detailID[] = $row['frDetailID'];
            $id[]       = $row['frID'];
        }

        $dataPenerimax = $this->InternalPengadaan_m->getMarLBPIByPenerimaID($id, $petugasID)->result();
        foreach($dataPenerimax as $rowx){

            $waktu[] = $rowx->lbWaktu_end;
            if($rowx->lbWaktu_end != null){
                if($rowx->status != 'success'){
                    if($waktu_sekarang > $rowx->lbWaktu_end){
                        $post['status']      = 'RJ1';//Reject Waktu
                        $post['quoProsesID'] = $rowx->listbelanjaID;
                        $this->InternalPengadaan_m->setMarLBPIStatus($post);
                        $response[] = array(
                            'status' => 'sukses',
                            'message' => 'Prosess 3'
                        );
                    }
                }
            }
        
        }
       

        // echo json_encode($dataPenerimax); 
    }

   


    //END LIST BELANJA (PERIODIC Dan INSIDENTIL)

    /////////////////////////////////////////////////////////////

    //Breakdown LIST Belanja

    public function viewDataBreakdown(){
        $this->load->view('petugas/internal_pengadaan_barang/belanja_list_breakdown/breakdownList_data');
    }

    public function getDataBreakdown(){
        $petugas  = $this->fungsi->petugas_login()->subbidangID;
        $data1 = $this->InternalPengadaan_m->getBreakdownPetugas($petugas)->result();
        foreach($data1 as $row1){
            $budgethonorID1[] = $row1->bdlDetailID;
        }

        $data2 = $this->InternalPengadaan_m->getAllBreakdownID($budgethonorID1)->result();
        foreach($data2 as $row2){
            $dataListBelanja = $this->InternalPengadaan_m->getAlllistBelanjabyID($row2->bdl_listbelanjaID)->row();
            $dataListPattyCash = $this->InternalPengadaan_m->getAllPattyCashID($row2->bdl_pattycashID)->row();

            $dataProses = $this->InternalPengadaan_m->getBreakdownByIDDesc($row2->bdlD_breakdownlistID)->row();
                if($dataProses->status == 'reject'){
                    $xproses = 'reject';
                }else if($dataProses->status == 'success'){
                    $xproses = 'success';
                }else{
                    $xproses = 'proses';
                }
    
                $arrayData[] = array(
                    'bdlDetailID'     => $row2->bdlDetailID,
                    'breakdownID'     => $row2->bdlD_breakdownlistID,
                    'listbelanjaNo'   => $dataListBelanja->listbelanjaNo,
                    'pattycashNo'     => $dataListPattyCash->pattycashNo,
                    'status'          => $row2->status,
                    'statusProses'    => $xproses,
                    'pengirim'        => $row2->bdlD_pengirimID,
                    'penerima'        => $row2->bdlD_penerimaID,
                    'waktu'           => $row2->bdlDWaktu
                );
            }

        echo json_encode($arrayData);
       
    }

    public function viewDetailDataBreakdown($id){
        $data['row'] = $this->InternalPengadaan_m->getBreakdownByIDDesc($id)->row();
        $this->load->view('petugas/internal_pengadaan_barang/belanja_list_breakdown/breakdownList_detaildata', $data);
    }

    public function getDetailDataBreakdown(){
        $id = $this->input->get('id');
        $petugas  = $this->fungsi->petugas_login()->subbidangID;
        

        $data2 = $this->InternalPengadaan_m->getBreakdownByPetugasID($petugas)->result();
        foreach($data2 as $row2){
            if($row2->bdlD_breakdownlistID == $id){
                $dataListBelanja = $this->InternalPengadaan_m->getAlllistBelanjabyID($row2->bdl_listbelanjaID)->row();
                $dataListPattyCash = $this->InternalPengadaan_m->getAllPattyCashID($row2->bdl_pattycashID)->row();
                $dataProses = $this->InternalPengadaan_m->getBreakdownByIDDesc($row2->bdlD_breakdownlistID)->row();
                if($dataProses->status == 'reject'){
                    $xproses = 'reject';
                }else if($dataProses->status == 'success'){
                    $xproses = 'success';
                }else{
                    $xproses = 'proses';
                }
    
                $arrayData[] = array(
                    'bdlDetailID'     => $row2->bdlDetailID,
                    'breakdownID'     => $row2->bdlD_breakdownlistID,
                    'listbelanjaNo'   => $dataListBelanja->listbelanjaNo,
                    'pattycashNo'     => $dataListPattyCash->pattycashNo,
                    'status'          => $row2->status,
                    'statusProses'    => $xproses,
                    'pengirim'        => $row2->bdlD_pengirimID,
                    'penerima'        => $row2->bdlD_penerimaID,
                    'waktu'           => $row2->bdlDWaktu
                );
            }
        }
        echo json_encode($arrayData);
    }

    public function viewAddBreakdown($id){
        $data['row'] = $this->InternalPengadaan_m->getAlllistBelanjabyID($id)->row();
        if($data['row']->lb_bidangID == 1){
            $data['rowBidang'] = 'Marine';
        }else if($data['row']->lb_bidangID == 2){
            $data['rowBidang'] = 'Minerba';
        }
        $this->load->view('petugas/internal_pengadaan_barang/belanja_list_breakdown/breakdownList_create', $data);
    }

    public function addBreakdownID(){
            $response = array();
            $this->form_validation->set_rules('bidangID', 'bidangID', 'required');
            $this->form_validation->set_rules('listbelanjaID', 'listbelanjaID', 'required|is_unique[tb_int_pengadaan_listbreakdown.bdl_listbelanjaID]');
    
            $this->form_validation->set_message('required', '%s masih Kososng, atau belum di pilih Silahkan Di isi');
            $this->form_validation->set_message('is_unique', '{field} ini sudah dipakai, silahkan ganti');
     
            if($this->form_validation->run() == FALSE){
                $response = array(
                    'status' 	    => 'error',
                    'bidangID' 		=> form_error('bidangID'),
                    'listbelanjaID' => form_error('listbelanjaID'),
                );
            } 
            else{
                $post                   = $this->input->post(null, TRUE);
                $post['listbelanjaID']  = $this->input->post('listbelanjaID');
                $post['bidangID']       = $this->input->post('bidangID');
                $dataListBelanja = $this->InternalPengadaan_m->getAlllistBelanjabyID($post['listbelanjaID'])->row();
              

                // //////////Create ID//////////
                date_default_timezone_set("Asia/Jakarta");
                $char    = 'BDL';
                $date    = date("Y-m-d");
                $tahun   = substr($date, 0, 2);
                $bulan   = substr($date, 5, 2);
                $hari    = substr($date, 8, 2);
                $breakdownlist   = $this->InternalPengadaan_m->getAllMaxLBDL()->row(); 
                $breakdownlistID = (int) substr($breakdownlist->breakdownlistID, 12, 4);
                $breakdownlistID++;
                $bdlID = $char.$tahun.$bulan.$hari.sprintf("%04s", $breakdownlistID);
                ///////////End Create ID////////////

                $post1 = array(    
                    'breakdownlistID'  => $bdlID, 
                    'listbelanjaID'    => $post['listbelanjaID'],
                    'pattycashID'      => $dataListBelanja->lb_pattycashID,
                    'bidangID'         => $post['bidangID'],
                );
                
                $this->InternalPengadaan_m->addlistBreakdown($post1);
          
                if($this->db->affected_rows()>0){ 
                        $response = array(
                            'status' 	=> 'success',
                            'message'   => "<h3>Success Message</h3>",
                            'id'        => $bdlID
                        );
                    
                    
                } 
            }
            $this->output->set_content_type('application/json');
            echo json_encode($response);
    
    }

    public function viewUploadBreakdown($id){
        $data['row'] = $this->InternalPengadaan_m->getBreakdownID($id)->row();
        if($data['row']->bdl_bidangID == 1){
            $data['rowBidang'] = 'Marine';
        }else if($data['row']->bdl_bidangID == 2){
            $data['rowBidang'] = 'Minerba';
        }
        $this->load->view('petugas/internal_pengadaan_barang/belanja_list_breakdown/breakdownList_upload', $data);
    }

    public function uploadBreakdown(){
        $response = array();
        $post = array();
        if($this->input->post('breakdownFile')){
            $this->form_validation->set_rules('breakdownFile', 'breakdownFile', 'callback_file_selected_test["breakdownFile"]');
        }
        $this->form_validation->set_rules('breakdownID', 'breakdownID', 'required');
        $this->form_validation->set_message('required', '%s masih Kososng, atau belum di pilih Silahkan Di isi');
        
        if($this->form_validation->run() == FALSE){
            $response = array(
                'status' 	    => 'error',
                'breakdownID' => form_error('breakdownID'),
                'breakdownFile' => form_error('breakdownFile')
                
            );   
        }else{
            // $post = $this->input->post(null, TRUE);
            $post['listbelanjaID']  = $this->input->post('listbelanjaID');
            $post['breakdownID']    = $this->input->post('breakdownID');
            $breakdownID            = $post['breakdownID'];
            $post['petugasID']      = $this->fungsi->petugas_login()->petugasID;
            $post['pengirimID']     = $this->fungsi->petugas_login()->subbidangID;
            $post['comment']        = $this->input->post('breakdownComment');
            $dataBreakdown = $this->InternalPengadaan_m->getBreakdownID($breakdownID)->row();
            
            if($this->input->post('send_up')){
                if($post['pengirimID'] == 'GA'){
                    $post['penerimaID'] = 'HR';
                }else if($post['pengirimID'] == 'HR'){
                    $post['penerimaID'] = 'FM';
                }
            }else if($this->input->post('send_down')){
                if($post['pengirimID'] == 'HR'){
                    $post['penerimaID'] = 'GA';
                }else if($post['pengirimID'] == 'FM'){
                    $post['penerimaID'] = 'HR';
                } 
            } 

            if($dataBreakdown->bdl_bidangID == 1){
                $post['bidangNama'] = 'Marine';
            } else if($dataBreakdown->bdl_bidangID == 2){
                $post['bidangNama'] = 'Minerba';
            }
            
            $jumlah                = $this->InternalPengadaan_m->jumlahBreakdownProses($post);
            $status_reject         = $this->InternalPengadaan_m->getBreakdownDetailbyID($breakdownID)->result();
            foreach($status_reject as $row){
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
    
                    $data1 = 'breakdownFile';
                    $urlPath = './uploads/pengadaan/'.$post['bidangNama'].'/breakdownList/';
                    $file = $this->upload($post, $data1, $urlPath);
                    
                    if($file['status'] == true){
                        if($file['name'] != null){
                            $post['breakdownFile'] = $file['name']; 
                        } 
                        else{
                            $post['breakdownFile'] =  $this->input->post('breakdownFile_send');
                        }

                        $postSend = array(    
                            'breakdownlistID'  => $post['breakdownID'],
                            'petugasID'        => $post['petugasID'],
                            'pengirimID'       => $post['pengirimID'],
                            'penerimaID'       => $post['penerimaID'],
                            'statusID'         => $post['status'],
                            'breakdownFile'    => $post['breakdownFile'],
                            'jumlah'           => $post['jumlah'],
                            'statusKonf'       => 'send',
                            'comment'          => $post['comment'],
                        );
                    
                        $this->InternalPengadaan_m->addBreakdownProses($postSend);

                        if($this->db->affected_rows()>0){ 
                            if($this->input->post('add_new')){
                                $post2['status']      = 'SC1';//Reject Waktu
                                $post2['quoProsesID'] = $post['listbelanjaID'];
                                $this->InternalPengadaan_m->setMarLBPIStatus($post2);
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
    public function viewNewBreakdown(){
        $this->load->view('petugas/internal_pengadaan_barang/belanja_list_breakdown/breakdownList_new');
    }
    public function getNewBreakdown(){
        $data             = array();
        $data2            = array();
        $post['penerima'] = $this->fungsi->petugas_login()->subbidangID;
        $post['pengirim'] = $this->fungsi_send->sendreceiver5();
       
        $data1 = $this->InternalPengadaan_m->getNewQuoDetailByPetugas($post)->result(); 
        foreach($data1 as $row1){
            $dataLB = $this->InternalPengadaan_m->getBreakdownID($row1->breakdownlistID)->row(); 
            $dataPC = $this->InternalPengadaan_m->getAllBudgetHonorID($row1->bdl_pattycashID)->row(); 
            if($row1->bdl_bidangID == 1){
                $bidangNama = 'Marine';
            }else if($row1->bdl_bidangID == 2){
                $bidangNama = 'Minerba';
            }
            $arrayData[] = array(
                'bdlDetailID'     =>  $row1->bdlDetailID,
                'breakdownlistID' => $row1->breakdownlistID,
                'listbelanjaNo'   => $dataLB->listbelanjaNo,
                'pattycashNo'     => $dataPC->pattycashNo,
                'bidang'          => $bidangNama,
                'status'          => $row1->status,
                'pengirimID'      => $row1->bdlD_pengirimID,
                'waktu'           => $row1->bdlDWaktu
            );   
        }
        echo json_encode($arrayData); 
    }


    public function konfBreakdown($id){
        $data                   = array();
        $data_query             = $this->InternalPengadaan_m->getAllBreakdownProsesID($id)->row();
        $data['petugasLogin']   = $this->fungsi->petugas_login()->subbidangID;

        if($data_query->bdl_bidangID == 1){
            $data['rowBidang']  = 'Marine';
        }else if($data_query->bdl_bidangID == 2){
            $data['rowBidang']  = 'Minerba';
        }
        
        if($data['petugasLogin'] != $data_query->bdlD_pengirimID){
            $dataQuoDetail['statusConf']  = 'read';
            $dataQuoDetail['quoProsesID'] = $id;
            $this->InternalPengadaan_m->changeStatusBreakdownDetail($dataQuoDetail);

            $data['rowBreakdown'] = $this->InternalPengadaan_m->getAllBreakdownProsesID($id)->row();
            $data['rowPatty'] = $this->InternalPengadaan_m->getAllPattyCashID($data['rowBreakdown']->bdl_pattycashID)->row();
            $data['rowListBelanja'] = $this->InternalPengadaan_m->getAlllistBelanjabyID($data['rowBreakdown']->bdl_listbelanjaID)->row();
            $this->load->view('petugas/internal_pengadaan_barang/belanja_list_breakdown/breakdownList_konf', $data);
        }else{
            $data['rowBreakdown'] = $this->InternalPengadaan_m->getAllBreakdownProsesID($id)->row();
            $data['rowPatty'] = $this->InternalPengadaan_m->getAllPattyCashID($data['rowBreakdown']->bdl_pattycashID)->row();
            $data['rowListBelanja'] = $this->InternalPengadaan_m->getAlllistBelanjabyID($data['rowBreakdown']->bdl_listbelanjaID)->row();
            $this->load->view('petugas/internal_pengadaan_barang/belanja_list_breakdown/breakdownList_konf', $data);
        }
    }

    

    
    public function viewFailedBreakdown(){
        $this->load->view('petugas/internal_pengadaan_barang/belanja_list_breakdown/breakdownList_failed');
    }

    public function getFailedBreakdown(){
        $post['penerima'] = $this->fungsi->petugas_login()->subbidangID;
        $bidangID = $this->fungsi->petugas_login()->bidangID;
        $post['pengirim'] = $this->fungsi_send->sendreceiver6();
        $data1 = $this->InternalPengadaan_m->getNewQuoDetailByPetugas($post)->result(); 
        foreach($data1 as $row1){
            $dataLB = $this->InternalPengadaan_m->getBreakdownID($row1->breakdownlistID)->row(); 
            $dataPC = $this->InternalPengadaan_m->getAllBudgetHonorID($row1->bdl_pattycashID)->row(); 
            $arrayData[] = array(
                'bdlDetailID'  =>  $row1->bdlDetailID,
                'breakdownlistID' => $row1->breakdownlistID,
                'listbelanjaNo' => $dataLB->listbelanjaNo,
                'pattycashNo' => $dataPC->pattycashNo,
                'bidang'       => $row1->bdl_bidangID,
                'status'       => $row1->status,
                'pengirimID'       => $row1->bdlD_pengirimID,
                'waktu'       => $row1->bdlDWaktu
            );
            
        }
        echo json_encode($arrayData); 
    }
    public function revisiBreakdown($id){
        $data                   = array();
        $data_query             = $this->InternalPengadaan_m->getAllBreakdownProsesID($id)->row();
        $data['petugasLogin']   = $this->fungsi->petugas_login()->subbidangID;

        if($data_query->bdl_bidangID == 1){
            $data['rowBidang']  = 'Marine';
        }else if($data_query->bdl_bidangID == 2){
            $data['rowBidang']  = 'Minerba';
        }
        
        
        if($data['petugasLogin'] != $data_query->bdlD_pengirimID){
           
                $dataQuoDetail['statusConf']  = 'read';
                $dataQuoDetail['quoProsesID'] = $id;
                $this->InternalPengadaan_m->changeStatusBreakdownDetail($dataQuoDetail);
               

           
                $data['rowBreakdown'] = $this->InternalPengadaan_m->getAllBreakdownProsesID($id)->row();
                $data['rowPatty'] = $this->InternalPengadaan_m->getAllPattyCashID($data['rowBreakdown']->bdl_pattycashID)->row();
                $data['rowListBelanja'] = $this->InternalPengadaan_m->getAlllistBelanjabyID($data['rowBreakdown']->bdl_listbelanjaID)->row();
            $this->load->view('petugas/internal_pengadaan_barang/belanja_list_breakdown/breakdownList_revisi', $data);
        }else{
            $data['rowBreakdown'] = $this->InternalPengadaan_m->getAllBreakdownProsesID($id)->row();
            $data['rowPatty'] = $this->InternalPengadaan_m->getAllPattyCashID($data['rowBreakdown']->bdl_pattycashID)->row();
            $data['rowListBelanja'] = $this->InternalPengadaan_m->getAlllistBelanjabyID($data['rowBreakdown']->bdl_listbelanjaID)->row();
            $this->load->view('petugas/internal_pengadaan_barang/belanja_list_breakdown/breakdownList_revisi', $data);
        }  

       
    }

    
    





    //END Breakdown LIST Belanja

    /////////////////////////////////////////////////////////////
    //Pencairan Budget (no Pengeluaran)
    public function viewDataPencairanBudget(){
        $this->load->view('petugas/internal_pengadaan_barang/pencairan_budget/pencairanBudget_data');
    }

    public function getDataPencairanBudget(){
        $petugas  = $this->fungsi->petugas_login()->subbidangID;
        $data1 = $this->InternalPengadaan_m->getPBudgetbyPetugas($petugas)->result();
        foreach($data1 as $row1){
            $budgethonorID1[] = $row1->pencairanbudgetID;
        }

        $data2 = $this->InternalPengadaan_m->getAllPBudgetByID($budgethonorID1)->result();
        foreach($data2 as $row2){

            $dataProses = $this->InternalPengadaan_m->getPBudgetByNoDesc($row2->pbPengeluaranNo)->row();
                if($dataProses->status == 'reject'){
                    $xproses = 'reject';
                }else if($dataProses->status == 'success'){
                    $xproses = 'success';
                }else{
                    $xproses = 'proses';
                }
    
                $arrayData[] = array(
                    'pencairanbudgetID' => $row2->pencairanbudgetID,
                    'pbPengeluaranNo'   => $row2->pbPengeluaranNo,
                    'breakdownlistID'   => $row2->bdlD_breakdownlistID,
                    'pattycashNo'       => $row2->pattycashNo,
                    'status'            => $row2->status,
                    'statusProses'      => $xproses,
                    'pengirim'          => $row2->pb_pengirimID,
                    'penerima'          => $row2->pb_penerimaID,
                    'waktu'             => $row2->pbWaktu
                );
            }

        echo json_encode($arrayData);
       
    }


    public function viewAddPencairanBudget($id){
        $data['row'] = $this->InternalPengadaan_m->getAllBreakdownProsesID($id)->row();
        if($data['row']->bdl_bidangID == 1){
            $data['rowBidang'] = 'Marine';
        }else if($data['row']->bdl_bidangID == 2){
            $data['rowBidang'] = 'Minerba';
        }
        $this->load->view('petugas/internal_pengadaan_barang/pencairan_budget/pencairanBudget_create', $data);
    }
    public function addPencairanBudget(){
        $response = array();
        $post = array();
        if($this->input->post('pbFile')){
            $this->form_validation->set_rules('pbFile', 'pbFile', 'callback_file_selected_test["pbFile"]');
        }
        $this->form_validation->set_rules('breakdowndetailID', 'breakdowndetailID', 'required|is_unique[tb_int_pengadaan_pencairanbudget.pb_bddetailID]');
        $this->form_validation->set_rules('pbPengeluaranNo', 'pbPengeluaranNo', 'required');
        $this->form_validation->set_rules('bidangID', 'bidangID', 'required');

        $this->form_validation->set_message('required', '%s masih Kososng, atau belum di pilih Silahkan Di isi');
        $this->form_validation->set_message('is_unique', '{field} ini sudah dipakai, silahkan ganti');
        
        if($this->form_validation->run() == FALSE){
            $response = array(
                'status' 	    => 'error',
                'breakdowndetailID' => form_error('breakdowndetailID'),
                'pbPengeluaranNo' => form_error('pbPengeluaranNo'),
                'bidangID' => form_error('bidangID'),
                'pbFile' => form_error('pbFile'),

            );   
        } else{
            $post['breakdowndetailID']      = $this->input->post('breakdowndetailID');
            $post['listbelanjaID']      = $this->input->post('listbelanjaID');
            $post['pattycashID']      = $this->input->post('pattycashID');
            $post['pbPengeluaranNo']      = $this->input->post('pbPengeluaranNo');
            $post['bidangID']      = $this->input->post('bidangID');
            $post['petugasID']     = $this->fungsi->petugas_login()->petugasID;
            $post['pengirimID']    = $this->fungsi->petugas_login()->subbidangID;

            $post['pbComment']      = $this->input->post('pbComment');

            $breakdown = $this->InternalPengadaan_m->getAllBreakdownProsesID($post['breakdowndetailID'])->row();
            
            $post['penerimaID']      = 'HR';
            $post['statuskonf']    = 'send'; 
            $post['status']        = 'file';  
            
            if($breakdown->bdl_bidangID == 1){
                $post['bidangNama'] = 'Marine';
            } else if($breakdown->bdl_bidangID == 2){
                $post['bidangNama'] = 'Minerba';
            }


            $data1 = 'pbFile';
            $urlPath = './uploads/pengadaan/'.$post['bidangNama'].'/pencairanBudget/';
            $file1 = $this->upload($post, $data1, $urlPath);
 
            
            $response = array(
                'status' 	    => 'success',
            );
            if($file1['status'] == true){
                if($file1['name'] != null){
                    $post['pbFile'] = $file1['name']; 
                }

                // //////////Create ID//////////
                date_default_timezone_set("Asia/Jakarta");
                $char    = 'PBG';
                $date    = date("Y-m-d");
                $tahun   = substr($date, 0, 2);
                $bulan   = substr($date, 5, 2);
                $hari    = substr($date, 8, 2);
                $pencairanbudget   = $this->InternalPengadaan_m->getAllMaxPB()->row(); 
                $pencairanbudgetID = (int) substr($pencairanbudget->pencairanbudgetID, 12, 4);
                $pencairanbudgetID++;
                $pbID = $char.$tahun.$bulan.$hari.sprintf("%04s", $pencairanbudgetID);
                ///////////End Create ID////////////

                $postSend = array(    
                    'pencairanbudgetID'  => $pbID, 
                    'pengeluaranNo'      => $post['pbPengeluaranNo'],
                    'bddetailID'         => $post['breakdowndetailID'],
                    'listbelanjaID'         => $post['listbelanjaID'],
                    'pattycashID'        => $post['pattycashID'],
                    'bidangID'           => $post['bidangID'],
                    'petugasID'          => $post['petugasID'],
                    'pengirimID'         => $post['pengirimID'],
                    'penerimaID'         => $post['penerimaID'],
                    'status'             => 'NW1',
                    'pbFile'             => $post['pbFile'],
                    'statusKonf'         => 'send',
                    'comment'            => $post['pbComment'] 
                );
              
                $this->InternalPengadaan_m->addPencairanBudget($postSend);
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
        echo json_encode($response);
    
    }
    public function viewNewPencairanBudget(){
        $this->load->view('petugas/internal_pengadaan_barang/pencairan_budget/pencairanBudget_new');
    }
    public function getNewPencairanBudget(){
        $petugas   = $this->fungsi->petugas_login()->subbidangID;
        $data = $this->InternalPengadaan_m->getAllPencairanBudgetNew($petugas)->result();
        echo json_encode($data);
    }

    public function konfPencairanBudget($id){
        $data                   = array();
        $data_query = $this->InternalPengadaan_m->getAllPencairanBudgetID($id)->row();
        $data['petugasLogin']   = $this->fungsi->petugas_login()->subbidangID;

        if($data_query->pb_bidangID == 1){
            $data['rowBidang'] = 'Marine';
        } else if($data_query->pb_bidangID == 2){
            $data['rowBidang'] = 'Minerba';
        }

        if($data['petugasLogin'] == $data_query->pb_penerimaID){
            $dataQuoDetail['statusConf']  = 'read';
            $dataQuoDetail['quoProsesID'] = $id;
            $this->InternalPengadaan_m->changeStatusPencairanBudget($dataQuoDetail);

            $data['row'] = $this->InternalPengadaan_m->getAllPencairanBudgetID($id)->row();
            // $data['rowPatty'] = $this->InternalPengadaan_m->getAllPattyCashID($data['rowBreakdown']->bdl_pattycashID)->row();
            // $data['rowListBelanja'] = $this->InternalPengadaan_m->getAlllistBelanjabyID($data['rowBreakdown']->bdl_listbelanjaID)->row();
            $this->load->view('petugas/internal_pengadaan_barang/pencairan_budget/pencairanBudget_konf', $data);
        }else{
            $data['row'] = $this->InternalPengadaan_m->getAllPencairanBudgetID($id)->row();
            // $data['rowPatty'] = $this->InternalPengadaan_m->getAllPattyCashID($data['rowBreakdown']->bdl_pattycashID)->row();
            // $data['rowListBelanja'] = $this->InternalPengadaan_m->getAlllistBelanjabyID($data['rowBreakdown']->bdl_listbelanjaID)->row();
            $this->load->view('petugas/internal_pengadaan_barang/pencairan_budget/pencairanBudget_konf', $data);
        }


        // $this->load->view('petugas/internal_pengadaan_barang/pencairan_budget/pencairanBudget_konf', $data);
    }

   


    //END Pencairan Budget
    /////////////////////////////////////////////////////////////

    //Nota Dinas

    public function viewDataNotaDinas(){
        $this->load->view('petugas/internal_pengadaan_barang/belanja_notadinas/notadinas_data');
    }

    public function getDataNotaDinas(){
        $petugas  = $this->fungsi->petugas_login()->subbidangID;
        $data1 = $this->InternalPengadaan_m->getNotaDinasbyPetugas($petugas)->result();
        foreach($data1 as $row1){
            $budgethonorID1[] = $row1->notadinasID;
        }

        $data2 = $this->InternalPengadaan_m->getAllNotaDinasByID($budgethonorID1)->result();
        foreach($data2 as $row2){

                if($row2->status == 'reject'){
                    $xproses = 'reject';
                }else if($row2->status == 'success'){
                    $xproses = 'success';
                }else{
                    $xproses = 'proses';
                }
    
                $arrayData[] = array(
                    'notadinasID'        => $row2->notadinasID,
                    'pbPengeluaranNo'   => $row2->pbPengeluaranNo,
                    'breakdownlistID'   => $row2->bdlD_breakdownlistID,
                    'pattycashNo'       => $row2->pattycashNo,
                    'status'            => $row2->status,
                    'statusProses'      => $xproses,
                    'pengirim'          => $row2->nd_pengirimID,
                    'penerima'          => $row2->nd_penerimaID,
                    'waktu'             => $row2->ndWaktu
                );
            }

        echo json_encode($arrayData);
       
    }

    public function viewAddNotaDinas($id){
        $data['row'] = $this->InternalPengadaan_m->getAllPencairanBudgetID($id)->row();
        if($data['row']->pb_bidangID == 1){
            $data['rowBidang'] = 'Marine';
        } else if($data['row']->pb_bidangID == 2){
            $data['rowBidang'] = 'Minerba';
        }
        $this->load->view('petugas/internal_pengadaan_barang/belanja_notadinas/notadinas_create', $data);
    }
    public function addNotaDinas(){
        $response = array();
        $post = array();
        if($this->input->post('ndFile')){
            $this->form_validation->set_rules('ndFile', 'ndFile', 'callback_file_selected_test["ndFile"]');
        }
        $this->form_validation->set_rules('pencairanbudgetID', 'pencairanbudgetID', 'required|is_unique[tb_int_pengadaan_notadinas.nd_pencairanbudgetID]');
        $this->form_validation->set_rules('bidangID', 'bidangID', 'required');

        $this->form_validation->set_message('required', '%s masih Kososng, atau belum di pilih Silahkan Di isi');
        $this->form_validation->set_message('is_unique', '{field} ini sudah dipakai, silahkan ganti');
        
        if($this->form_validation->run() == FALSE){
            $response = array(
                'status' 	    => 'error',
                'pencairanbudgetID' => form_error('pencairanbudgetID'),
                'bidangID' => form_error('bidangID'),
                'ndFile' => form_error('ndFile'),

            );   
        } else{
            // $post = $this->input->post(null, TRUE);
            $post['pencairanbudgetID']      = $this->input->post('pencairanbudgetID');
            $post['bidangID']      = $this->input->post('bidangID');
            $post['petugasID']     = $this->fungsi->petugas_login()->petugasID;
            $post['pengirimID']    = $this->fungsi->petugas_login()->subbidangID;
            $post['comment']       = $this->input->post('ndComment');

            $dataPencairanbudget     = $this->InternalPengadaan_m->getAllPencairanBudgetID($post['pencairanbudgetID'])->row();
            
            $post['penerimaID']      = 'GA';
            $post['status']        = 'file';   

            if($post['bidangID'] == 1){
                $post['bidangNama'] = 'Marine';
            }else if($post['bidangID'] == 2){
                $post['bidangNama'] = 'Minerba';
            }

            $data1 = 'ndFile';
            $urlPath = './uploads/pengadaan/'.$post['bidangNama'].'/notaDinas/';
            $file1 = $this->upload($post, $data1, $urlPath);

            
            if($file1['status'] == true){
                if($file1['name'] != null){
                    $post['ndFile'] = $file1['name']; 
                }

                 // //////////Create ID//////////
                 date_default_timezone_set("Asia/Jakarta");
                 $char    = 'NDP';
                 $date    = date("Y-m-d");
                 $tahun   = substr($date, 0, 2);
                 $bulan   = substr($date, 5, 2);
                 $hari    = substr($date, 8, 2);
                 $notadinas   = $this->InternalPengadaan_m->getAllMaxND()->row(); 
                 $notadinasID = (int) substr($notadinas->notadinasID, 12, 4);
                 $notadinasID++;
                 $ndID = $char.$tahun.$bulan.$hari.sprintf("%04s", $notadinasID);
                 ///////////End Create ID////////////
              
                
                $postSend = array(    
                    'notadinasID'        => $ndID, 
                    'pencairanbudgetID'  => $post['pencairanbudgetID'], 
                    'breakdownID'        => $dataPencairanbudget->pb_bddetailID, 
                    'listbelanjaID'      => $dataPencairanbudget->pb_listbelanjaID, 
                    'pattycashID'        => $dataPencairanbudget->pb_pattycashID, 
                    'bidangID'           => $post['bidangID'],
                    'petugasID'          => $post['petugasID'],
                    'pengirimID'         => $post['pengirimID'],
                    'penerimaID'         => $post['penerimaID'],
                    'ndFile'             => $post['ndFile'],
                    'status'             => 'NW1',
                    'statusKonf'         => 'send',
                    'comment'            => $post['comment'] 
                );

                $this->InternalPengadaan_m->addNotaDinas($postSend);
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
        echo json_encode($response);
    
    }
    public function viewNewNotaDinas(){
        $this->load->view('petugas/internal_pengadaan_barang/belanja_notadinas/notadinas_new');
    }

    public function getNewNotaDinas(){
        $petugas   = $this->fungsi->petugas_login()->subbidangID;
        $data = $this->InternalPengadaan_m->getAllNotaDinasNew($petugas)->result();
        
        echo json_encode($data);
    }
    public function konfNotaDinas($id){
        $data                   = array();
        $data_query = $this->InternalPengadaan_m->getAllNotaDinasID($id)->row();
        $data['petugasLogin']   = $this->fungsi->petugas_login()->subbidangID;
        if($data_query->nd_bidangID == 1){
            $data['rowBidang'] = 'Marine';
        } else if($data_query->nd_bidangID == 2){
            $data['rowBidang'] = 'Minerba';
        }

        if($data['petugasLogin'] == $data_query->nd_penerimaID){
            $dataQuoDetail['statusConf']  = 'read';
            $dataQuoDetail['quoProsesID'] = $id;
            $this->InternalPengadaan_m->changeStatusNotaDinas($dataQuoDetail);


            $data['row'] = $this->InternalPengadaan_m->getAllNotaDinasID($id)->row();
            // $data['rowPatty'] = $this->InternalPengadaan_m->getAllPattyCashID($data['rowBreakdown']->bdl_pattycashID)->row();
            // $data['rowListBelanja'] = $this->InternalPengadaan_m->getAlllistBelanjabyID($data['rowBreakdown']->bdl_listbelanjaID)->row();
            $this->load->view('petugas/internal_pengadaan_barang/belanja_notadinas/notadinas_konf', $data);

        }else{
            $data['row'] = $this->InternalPengadaan_m->getAllNotaDinasID($id)->row();
            // $data['rowPatty'] = $this->InternalPengadaan_m->getAllPattyCashID($data['rowBreakdown']->bdl_pattycashID)->row();
            // $data['rowListBelanja'] = $this->InternalPengadaan_m->getAlllistBelanjabyID($data['rowBreakdown']->bdl_listbelanjaID)->row();
            $this->load->view('petugas/internal_pengadaan_barang/belanja_notadinas/notadinas_konf', $data);
        }

    }

   



    //END Nota Dinas

    /////////////////////////////////////////////////////////////

    //Laporan Belanja (Nota dan Dokumen barang)
    //Masi Belum Selesai

    public function viewDataLaporanBelanja(){
        $this->load->view('petugas/internal_pengadaan_barang/belanja_laporan/laporan_data');
    }

    public function getDataLaporanBelanja(){
        $petugas  = $this->fungsi->petugas_login()->subbidangID;
        $data1 = $this->InternalPengadaan_m->getLaporanBelanjaPetugas($petugas)->result();
        foreach($data1 as $row1){
            $budgethonorID1[] = $row1->lbDetailID;
        }

        $data2 = $this->InternalPengadaan_m->getAllLaporanBelanjaID($budgethonorID1)->result();
        foreach($data2 as $row2){
            $dataNotaDinas       = $this->InternalPengadaan_m->getAllNotaDinasID($row2->laporanb_notadinasID)->row();
            $dataPencairanBudget = $this->InternalPengadaan_m->getAllPencairanBudgetID($row2->laporanb_pencairanbudgetID)->row();
            $dataBreakdown       = $this->InternalPengadaan_m->getAllBreakdownProsesID($row2->laporanb_bddetailID)->row();
            $dataListBelanja     = $this->InternalPengadaan_m->getAlllistBelanjabyID($row2->laporanb_listbelanjaID)->row();
            $dataListPattyCash   = $this->InternalPengadaan_m->getAllPattyCashID($row2->laporanb_pattycashID)->row();

            $dataProses = $this->InternalPengadaan_m->getLaporanBelanjaByIDDesc($row2->lbd_laporanbelanjaID)->row();
                if($dataProses->status == 'reject'){
                    $xproses = 'reject';
                }else if($dataProses->status == 'success'){
                    $xproses = 'success';
                }else{
                    $xproses = 'proses';
                }
    
                $arrayData[] = array(
                    'lbDetailID'        => $row2->lbDetailID,
                    'laporanbelanjaID'  => $row2->lbd_laporanbelanjaID,
                    'notadinasID'       => $dataNotaDinas->notadinasID,
                    'pengeluaranNo'     => $dataPencairanBudget->pbPengeluaranNo,
                    'breakdownNo'       => $dataBreakdown->bdlD_breakdownlistID,
                    'listbelanjaNo'     => $dataListBelanja->listbelanjaNo,
                    'pattycashNo'       => $dataListPattyCash->pattycashNo,
                    'status'            => $row2->status,
                    'statusProses'      => $xproses,
                    'pengirim'          => $row2->lbd_pengirimID,
                    'penerima'          => $row2->lbd_penerimaID,
                    'waktu'             => $row2->lbdWaktu
                );
            }

        echo json_encode($arrayData);
       
    }

    public function viewDetailDataLaporanBelanja($id){
        $data['row'] = $this->InternalPengadaan_m->getLaporanBelanjaByIDDesc($id)->row();
        $this->load->view('petugas/internal_pengadaan_barang/belanja_laporan/laporan_detaildata', $data);
    }

    public function getDetailDataLaporanBelanja(){
        $id = $this->input->get('id');
        $petugas  = $this->fungsi->petugas_login()->subbidangID;
        

        $data2 = $this->InternalPengadaan_m->getLaporanBelanjaByPetugasID($petugas)->result();
        foreach($data2 as $row2){
            if($row2->lbd_laporanbelanjaID == $id){

            $dataNotaDinas       = $this->InternalPengadaan_m->getAllNotaDinasID($row2->laporanb_notadinasID)->row();
            $dataPencairanBudget = $this->InternalPengadaan_m->getAllPencairanBudgetID($row2->laporanb_pencairanbudgetID)->row();
            $dataBreakdown       = $this->InternalPengadaan_m->getAllBreakdownProsesID($row2->laporanb_bddetailID)->row();
            $dataListBelanja     = $this->InternalPengadaan_m->getAlllistBelanjabyID($row2->laporanb_listbelanjaID)->row();
            $dataListPattyCash   = $this->InternalPengadaan_m->getAllPattyCashID($row2->laporanb_pattycashID)->row();

            $dataProses = $this->InternalPengadaan_m->getLaporanBelanjaByIDDesc($row2->lbd_laporanbelanjaID)->row();
                if($dataProses->status == 'reject'){
                    $xproses = 'reject';
                }else if($dataProses->status == 'success'){
                    $xproses = 'success';
                }else{
                    $xproses = 'proses';
                }
    
                $arrayData[] = array(
                    'lbDetailID'        => $row2->lbDetailID,
                    'laporanbelanjaID'  => $row2->lbd_laporanbelanjaID,
                    'notadinasID'       => $dataNotaDinas->notadinasID,
                    'pengeluaranNo'     => $dataPencairanBudget->pbPengeluaranNo,
                    'breakdownNo'       => $dataBreakdown->bdlD_breakdownlistID,
                    'listbelanjaNo'     => $dataListBelanja->listbelanjaNo,
                    'pattycashNo'       => $dataListPattyCash->pattycashNo,
                    'status'            => $row2->status,
                    'statusProses'      => $xproses,
                    'pengirim'          => $row2->lbd_pengirimID,
                    'penerima'          => $row2->lbd_penerimaID,
                    'waktu'             => $row2->lbdWaktu
                );


            }
        }
        echo json_encode($arrayData);
    }

    public function viewAddLaporanBelanja($id){
        
        $data['rowNotaDinas'] = $this->InternalPengadaan_m->getAllNotaDinasID($id)->row();

        if($data['rowNotaDinas']->nd_bidangID == 1){
            $data['rowBidang'] = 'Marine';
        } else if($data['rowNotaDinas']->nd_bidangID == 2){
            $data['rowBidang'] = 'Minerba';
        }
        // echo json_encode($data);
        $this->load->view('petugas/internal_pengadaan_barang/belanja_laporan/laporan_create', $data);
    }

    public function addLaporanBelanja(){
        $response = array();
            $this->form_validation->set_rules('bidangID', 'bidangID', 'required');
            $this->form_validation->set_rules('notadinasID', 'notadinasID', 'required|is_unique[tb_int_pengadaan_laporanbelanja.laporanb_notadinasID]');
    
            $this->form_validation->set_message('required', '%s masih Kososng, atau belum di pilih Silahkan Di isi');
            $this->form_validation->set_message('is_unique', '{field} ini sudah dipakai, silahkan ganti');
     
            if($this->form_validation->run() == FALSE){
                $response = array(
                    'status' 	    => 'error',
                    'bidangID' 		=> form_error('bidangID'),
                    'notadinasID' 		=> form_error('notadinasID'),
                );
            } 
            else{
                $post['bidangID']            = $this->input->post('bidangID');
                $post['notadinasID']         = $this->input->post('notadinasID');
                $post['pencairanbudgetID']   = $this->input->post('pencairanbudgetID');
                $post['bddetailID']          = $this->input->post('bddetailID');
                $post['pattycashID']         = $this->input->post('pattycashID');
                $post['listbelanjaID']         = $this->input->post('listbelanjaID');
                
                

                 //////////Create ID//////////
                 date_default_timezone_set("Asia/Jakarta");
                 $char    = 'PLB';
                 $date    = date("Y-m-d");
                 $tahun   = substr($date, 0, 2);
                 $bulan   = substr($date, 5, 2);
                 $hari    = substr($date, 8, 2);
                 $laporanbelanja   = $this->InternalPengadaan_m->getAllMaxPLB()->row(); 
                 $laporanbelanjaID = (int) substr($laporanbelanja->laporanbelanjaID, 12, 4);
                 $laporanbelanjaID++;
                 $plbID = $char.$tahun.$bulan.$hari.sprintf("%04s", $laporanbelanjaID);
                //  ///////////End Create ID////////////
 
                 $post1 = array(    
                     'laporanbelanjaID'  => $plbID, 
                     'notadinasID'       => $post['notadinasID'],
                     'pencairanbudgetID' => $post['pencairanbudgetID'],
                     'bddetailID'        => $post['bddetailID'],
                     'listbelanjaID'          => $post['listbelanjaID'],
                     'pattycashID'       => $post['pattycashID'],
                     'bidangID'          => $post['bidangID'],
                     
                 );
                
                $this->InternalPengadaan_m->addLaporanBelanja($post1);
                if($this->db->affected_rows()){
                    $response = array(
                        'status' 	=> 'success',
                        'message'   => "<h3>Success Message</h3>",
                        'id'        => $plbID
                    );
                } 
            }
            $this->output->set_content_type('application/json');
            echo json_encode($response);
    
    }

    public function viewUploadLaporanBelanja($id){
        $data['row'] = $this->InternalPengadaan_m->getLaporanBelanjaID($id)->row();
        if($data['row']->laporanb_bidangID == 1){
            $data['bidangNama'] = 'Marine';
        } else if($data['row']->laporanb_bidangID == 2){
            $data['bidangNama'] = 'Minerba';
        }
        $this->load->view('petugas/internal_pengadaan_barang/belanja_laporan/laporan_upload', $data);
    }

    public function uploadLaporanBelanja(){
        $response = array();
        $post = array();
        // $post = $this->input->post(null, TRUE);
        if($this->input->post('lbFile')){
            $this->form_validation->set_rules('lbFile', 'lbFile', 'callback_file_selected_test["lbFile"]');
        }
        $this->form_validation->set_rules('laporanbelanjaID', 'laporanbelanjaID', 'required');
        $this->form_validation->set_message('required', '%s masih Kososng, atau belum di pilih Silahkan Di isi');
        
        if($this->form_validation->run() == FALSE){
            $response = array(
                'status' 	    => 'error',
                'laporanbelanjaID' => form_error('laporanbelanjaID'),
                'lbFile' => form_error('lbFile')
                
            );   
        } else{
            $post['laporanbelanjaID']      = $this->input->post('laporanbelanjaID');
            $laporanbelanjaID = $post['laporanbelanjaID'];
            $post['bidangID']      = $this->input->post('bidangID');
            $post['petugasID']     = $this->fungsi->petugas_login()->petugasID;
            $post['pengirimID']    = $this->fungsi->petugas_login()->subbidangID;
            $post['comment']      = $this->input->post('lbComment');

            
            
            if($this->input->post('send_up')){
                if($post['pengirimID'] == 'GA'){
                    $post['penerimaID'] = 'HR';
                }else if($post['pengirimID'] == 'HR'){
                    $post['penerimaID'] = 'FM';
                }
            }else if($this->input->post('send_down')){
                if($post['pengirimID'] == 'HR'){
                    $post['penerimaID'] = 'GA';
                }else if($post['pengirimID'] == 'FM'){
                    $post['penerimaID'] = 'HR';
                } 
            } 

            if($post['bidangID'] == 1){
                $post['bidangNama'] = 'Marine';
            } else if($post['bidangID']== 2){
                $post['bidangNama'] = 'Minerba';
            }
            
            $jumlah                = $this->InternalPengadaan_m->jumlahLaporanBelanjaProses($post);
            $rkaStatus_reject      = $this->InternalPengadaan_m->getLaporanBelanjaByID($laporanbelanjaID)->result();
            foreach($rkaStatus_reject as $row){
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

                $data1 = 'lbFile';
                $urlPath = './uploads/pengadaan/'.$post['bidangNama'].'/laporanBelanja/';
                $file = $this->upload($post, $data1, $urlPath);
                
                
                if($file['status'] == true){
                    if($file['name'] != null){
                        $post['lbFile'] = $file['name']; 
                    } 
                    else{
                        $post['lbFile'] =  $this->input->post('lbFile_send');
                    }

                    $postSend = array(    
                        'laporanbelanjaID'  => $post['laporanbelanjaID'], 
                        'petugasID'         => $post['petugasID'],
                        'pengirimID'        => $post['pengirimID'],
                        'penerimaID'        => $post['penerimaID'],
                        'status'            => $post['status'],
                        'lbFile'            => $post['lbFile'],
                        'jumlah'            => $post['jumlah'],
                        'statusKonf'        => 'send',
                        'comment'           => $post['comment'],
                    );

                    $this->InternalPengadaan_m->addLaporanBelanjaProses($postSend);
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

    public function viewNewLaporanBelanja(){
        $this->load->view('petugas/internal_pengadaan_barang/belanja_laporan/laporan_new');
    }

    public function getNewLaporanBelanja(){
        $petugas   = $this->fungsi->petugas_login()->subbidangID;
        $data = $this->InternalPengadaan_m->getALaporanBelanjaProsesNew($petugas)->result();
        echo json_encode($data);
    }

    public function konfLaporanBelanja($id){
        $data                   = array();
        $data_query             = $this->InternalPengadaan_m->getLaporanBelanjaProsesID($id)->row();
        $data['petugasLogin']   = $this->fungsi->petugas_login()->subbidangID;
        $data['waktusekarang']  = date('Y-m-d H:i:s');

        if($data_query->laporanb_bidangID == 1){
            $data['rowBidang']  = 'Marine';
        }else if($data_query->laporanb_bidangID == 2){
            $data['rowBidang']  = 'Minerba';
        }

        if($data['petugasLogin'] != $data_query->lbd_pengirimID){
            if($data_query->lbdWaktu_start == null && $data_query->lbdWaktu_end == null){
                $dataQuoDetail['statusConf']  = 'read';
                $dataQuoDetail['quoProsesID'] = $id;
                $this->InternalPengadaan_m->changeStatusLBD($dataQuoDetail);
                $dataQuoDetail['waktustart']   = date('Y-m-d H:i:s');
                $dataQuoDetail['waktuend']     = date('Y-m-d H:i:s',strtotime('+50 minutes',strtotime($dataQuoDetail['waktustart'])));
                $this->InternalPengadaan_m->uploadTimeWorkLBD($dataQuoDetail);
            }
            $data['rowLaporanBelanja']       = $this->InternalPengadaan_m->getLaporanBelanjaProsesID($id)->row();
            $data['rowNotaDinas']            = $this->InternalPengadaan_m->getAllNotaDinasID($data['rowLaporanBelanja']->laporanb_notadinasID)->row();
            $data['rowPencairanBudget']      = $this->InternalPengadaan_m->getAllPencairanBudgetID($data['rowLaporanBelanja']->laporanb_pencairanbudgetID)->row();
            $data['rowBreakdown']            = $this->InternalPengadaan_m->getAllBreakdownProsesID($data['rowLaporanBelanja']->laporanb_bddetailID)->row();
            $data['rowListBelanja']          = $this->InternalPengadaan_m->getAlllistBelanjabyID($data['rowLaporanBelanja']->laporanb_listbelanjaID)->row();
            $data['rowPattycash']            = $this->InternalPengadaan_m->getAllPattyCashID($data['rowLaporanBelanja']->laporanb_pattycashID)->row();
            $this->load->view('petugas/internal_pengadaan_barang/belanja_laporan/laporan_konf', $data);
        }else{
            $data['rowLaporanBelanja']       = $this->InternalPengadaan_m->getLaporanBelanjaProsesID($id)->row();
            $data['rowNotaDinas']            = $this->InternalPengadaan_m->getAllNotaDinasID($data['rowLaporanBelanja']->laporanb_notadinasID)->row();
            $data['rowPencairanBudget']      = $this->InternalPengadaan_m->getAllPencairanBudgetID($data['rowLaporanBelanja']->laporanb_pencairanbudgetID)->row();
            $data['rowBreakdown']            = $this->InternalPengadaan_m->getAllBreakdownProsesID($data['rowLaporanBelanja']->laporanb_bddetailID)->row();
            $data['rowListBelanja']          = $this->InternalPengadaan_m->getAlllistBelanjabyID($data['rowLaporanBelanja']->laporanb_listbelanjaID)->row();
            $data['rowPattycash']            = $this->InternalPengadaan_m->getAllPattyCashID($data['rowLaporanBelanja']->laporanb_pattycashID)->row();
            $this->load->view('petugas/internal_pengadaan_barang/belanja_laporan/laporan_konf', $data);
        }

    }

    

    
    public function viewFailedLaporanBelanja(){
        $this->load->view('petugas/internal_pengadaan_barang/belanja_laporan/laporan_failed');
    }

    public function getNewFailedLaporanBelanja(){
        $post['penerima'] = $this->fungsi->petugas_login()->subbidangID;
        $bidangID = $this->fungsi->petugas_login()->bidangID;
        $post['pengirim'] = $this->fungsi_send->sendreceiver6();
        $array = $this->InternalPengadaan_m->getNewLBDByPetugas($post)->result();
        echo json_encode($array); 
    }

    public function revisiLaporanBelanja($id){
        $data                   = array();
        $data_query             = $this->InternalPengadaan_m->getLaporanBelanjaProsesID($id)->row();
        $data['petugasLogin']   = $this->fungsi->petugas_login()->subbidangID;
        $data['waktusekarang']  = date('Y-m-d H:i:s');

        if($data_query->laporanb_bidangID == 1){
            $data['rowBidang']  = 'Marine';
        }else if($data_query->laporanb_bidangID == 2){
            $data['rowBidang']  = 'Minerba';
        }

        if($data['petugasLogin'] != $data_query->lbd_pengirimID){
            if($data_query->lbdWaktu_start == null && $data_query->lbdWaktu_end == null){
                $dataQuoDetail['statusConf']  = 'read';
                $dataQuoDetail['quoProsesID'] = $id;
                $this->InternalPengadaan_m->changeStatusLBD($dataQuoDetail);
                $dataQuoDetail['waktustart']   = date('Y-m-d H:i:s');
                $dataQuoDetail['waktuend']     = date('Y-m-d H:i:s',strtotime('+20 minutes',strtotime($dataQuoDetail['waktustart'])));
                $this->InternalPengadaan_m->uploadTimeWorkLBD($dataQuoDetail);

            }
            $data['rowLaporanBelanja']       = $this->InternalPengadaan_m->getLaporanBelanjaProsesID($id)->row();
            $data['rowNotaDinas']            = $this->InternalPengadaan_m->getAllNotaDinasID($data['rowLaporanBelanja']->laporanb_notadinasID)->row();
            $data['rowPencairanBudget']      = $this->InternalPengadaan_m->getAllPencairanBudgetID($data['rowLaporanBelanja']->laporanb_pencairanbudgetID)->row();
            $data['rowBreakdown']            = $this->InternalPengadaan_m->getAllBreakdownProsesID($data['rowLaporanBelanja']->laporanb_bddetailID)->row();
            $data['rowListBelanja']          = $this->InternalPengadaan_m->getAlllistBelanjabyID($data['rowLaporanBelanja']->laporanb_listbelanjaID)->row();
            $data['rowPattycash']            = $this->InternalPengadaan_m->getAllPattyCashID($data['rowLaporanBelanja']->laporanb_pattycashID)->row();
            $this->load->view('petugas/internal_pengadaan_barang/belanja_laporan/laporan_revisi', $data);
        }else{
            $data['rowLaporanBelanja']       = $this->InternalPengadaan_m->getLaporanBelanjaProsesID($id)->row();
            $data['rowNotaDinas']            = $this->InternalPengadaan_m->getAllNotaDinasID($data['rowLaporanBelanja']->laporanb_notadinasID)->row();
            $data['rowPencairanBudget']      = $this->InternalPengadaan_m->getAllPencairanBudgetID($data['rowLaporanBelanja']->laporanb_pencairanbudgetID)->row();
            $data['rowBreakdown']            = $this->InternalPengadaan_m->getAllBreakdownProsesID($data['rowLaporanBelanja']->laporanb_bddetailID)->row();
            $data['rowListBelanja']          = $this->InternalPengadaan_m->getAlllistBelanjabyID($data['rowLaporanBelanja']->laporanb_listbelanjaID)->row();
            $data['rowPattycash']            = $this->InternalPengadaan_m->getAllPattyCashID($data['rowLaporanBelanja']->laporanb_pattycashID)->row();
            $this->load->view('petugas/internal_pengadaan_barang/belanja_laporan/laporan_revisi', $data);
        }
    }



     //////////////////////TIMEOUT DRAFT PENGADAAN/PATTY CASH////////////////////////////////////


     public function timeViewLaporanBelanja(){
        $this->timeWorkLaporanBelanja();
        $response = array();
        $xproses = array();
        $getID    = $this->input->get('id');
        // $getID    = 22;
        $waktu_sekarang = date('Y-m-d H:i:s');
        $data_query = $this->InternalPengadaan_m->getLBDByID($getID)->row();
        $dataQuoMax = $this->InternalPengadaan_m->getLBDByIDMax($data_query->lbd_laporanbelanjaID)->row();
        if($dataQuoMax->lbDetailID > $getID){
            $checkAllDetailID[] = 'success';
        }else{
            $checkAllDetailID[] = 'proses';
        }
        $dataFR = $this->InternalPengadaan_m->getLBDByFRID($data_query->lbd_laporanbelanjaID)->result();
        foreach($dataFR as $row){
            if($row->status == 'reject'){
                $xproses = 'reject';
            }else if($row->status == 'success'){
                $xproses = 'success';
            }else{
                $xproses = 'proses';
            }
        }

        if($data_query->lbdWaktu_end != null){
            $response = array(
                'status'    => $checkAllDetailID,
                'statusAll' => $xproses,
                'waktuEnd'  => $data_query->lbdWaktu_end,
            ); 
        }
        echo json_encode($response);
    }


    public function checkPenerimaLaporanBelanja($subbidangPetugas){
        $file = array();
        // $subbidangPetugas      = $this->fungsi->petugas_login()->subbidangID;
        $dataPenerimaDesc         = $this->InternalPengadaan_m->getLBDByPenerimaIDMax($subbidangPetugas)->result();
        if($dataPenerimaDesc != null){
            foreach($dataPenerimaDesc as $row){
                $frPenerimaID[] = $row->lbDetailID;
            }
            $dataPenerima     = $this->InternalPengadaan_m->getLBDByID($frPenerimaID)->result();
            foreach($dataPenerima as $row1){
                $file[] = array(
                    'frDetailID' => $row1->lbDetailID,
                    'frID'       => $row1->lbd_laporanbelanjaID,
                );
            } 
        }
        return $file;
        // echo json_encode($file);
    }

    public function timeWorkLaporanBelanja(){   
        $file1          = array();
        $fileDetailID   = array();
        $detailID       = array();
        $post           = array();
        $response       = array();
        $petugasID      = $this->fungsi->petugas_login()->subbidangID;
        $dataPenerima   = $this->checkPenerimaLaporanBelanja($petugasID);
        $waktu_sekarang = date('Y-m-d H:i:s');
        foreach($dataPenerima as $row){
            $detailID[] = $row['frDetailID'];
            $id[]       = $row['frID'];
        }

        $dataPengirimDesc = $this->InternalPengadaan_m->getLBDByPengirimID($id, $petugasID)->result();
        if($dataPengirimDesc != null){
            foreach($dataPengirimDesc as $row1){
                if(in_array($row1->lbd_laporanbelanjaID, $id)){
                    $file1[] = $row1->lbd_laporanbelanjaID; //Data Pengirim ADA 
                    $fileDetailID[] = $row1->lbDetailID; //Data Pengirim ADA 
                }
            }
        // // // //     //////////////////Jika Petugas Sudah Menerima Dan Mengirimkan FR ID////////////////////////////
            $dataFR = $this->InternalPengadaan_m->getLBDByPengirimIDMax($file1, $petugasID)->result();
            foreach($dataFR as $row2){
                $frDetailIDDesc[] = $row2->lbDetailID;
            }
            
            $dataPegirim = $this->InternalPengadaan_m->getLBDByID($frDetailIDDesc)->result();
            foreach($dataPegirim as $row3){
                $dataDetailCheck = $this->InternalPengadaan_m->getLBDByPenerimaIDMaxID($row3->lbd_laporanbelanjaID, $petugasID)->row();
                $dataPenerimaCheck = $this->InternalPengadaan_m->getLBDByID($dataDetailCheck->lbDetailID)->row();
                if($row3->lbd_laporanbelanjaID == $dataPenerimaCheck->lbd_laporanbelanjaID){
                    $file2[] = $row3->lbd_laporanbelanjaID; //Data Pengirim ADA 
                    if($dataDetailCheck->lbDetailID > $row3->lbDetailID){
                        // $xd[] = " DetailID : ". $dataDetailCheck->lbDetailID.">".$row3->lbDetailID;//Exekusi TimeOut
                        $waktux[] = $row3->lbdWaktu_end;
                        if($dataPenerimaCheck->lbdWaktu_end != null){
                            if($dataPenerimaCheck->status != 'success'){
                                if($waktu_sekarang > $dataPenerimaCheck->lbdWaktu_end){
                                  
                           
                                    $post['status']      = 'RJ1';//Reject Waktu
                                    $post['quoProsesID'] = $dataPenerimaCheck->lbDetailID;
                                    $this->InternalPengadaan_m->setLBDStatus($post);
                                   
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

        // //     /////////////////////////////Jika Petugas hanya menerima FR ID////////////////////////////
            $pengirimNull     = array_diff($id, $file1); //Data Pengirim Tidak Ada
            if($pengirimNull != null){
                $dataPenerimaNull = $this->InternalPengadaan_m->getMarFRDByFRID($pengirimNull)->result();
                foreach($dataPenerimaNull as $row4){
                    $dataDetailCheck1 = $this->InternalPengadaan_m->getLBDByPenerimaIDMaxID($row4->lbd_laporanbelanjaID, $petugasID)->row();
                    $dataPenerimaCheck1 = $this->InternalPengadaan_m->getLBDByID($dataDetailCheck1->lbDetailID)->row();
                    if($row4->lbd_laporanbelanjaID == $dataPenerimaCheck1->lbd_laporanbelanjaID){
                        $x1 = $row4->lbDetailID ;
                        // $x = $dataPenerimaCheck1->lbd_laporanbelanjaID;
                        // if($dataPenerimaCheck1->lbDetailID > $row4->lbDetailID){
                            $z = $row4->lbDetailID;
                            // $waktu1[] = $dataPenerimaCheck1->waktu_end;
                            if($dataPenerimaCheck1->lbdWaktu_end != null){
                                if($dataPenerimaCheck1->status != 'success'){
                                    if($waktu_sekarang > $dataPenerimaCheck1->lbdWaktu_end){
                                    
                                      
                                        $post['status']      = 'RJ1';//Reject Waktu
                                        $post['quoProsesID'] = $dataPenerimaCheck1->lbDetailID;
                                        $this->InternalPengadaan_m->setLBDStatus($post);
                                
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

            $dataPenerimax = $this->InternalPengadaan_m->getLBDByPenerimaID($id, $petugasID)->result();
            foreach($dataPenerimax as $rowx){
                $waktu[] = $rowx->lbdWaktu_end;
                if($rowx->lbdWaktu_end != null){
                    if($rowx->status != 'success'){
                        if($waktu_sekarang > $rowx->lbdWaktu_end){
                           
                            $post['status']      = 'RJ1';//Reject Waktu
                            $post['quoProsesID'] = $rowx->lbDetailID;
                           
                            $this->InternalPengadaan_m->setLBDStatus($post);
                            $response[] = array(
                                'status' => 'sukses',
                                'message' => 'Prosess 3'
                            );
                        }
                    }
                }
            }
        } 

        // echo json_encode($dataPengirimDesc); 
    }


    //Laporan Belanja (Nota dan Dokumen barang)

    /////////////////////////////////////////////////////////////

    //Finish Laporan Belanja (Laporan Belanja Masuk Database)

    public function viewDataPengadaanApprov(){
        $this->load->view('petugas/internal_pengadaan_barang/pengadaan_approvData');

    }

    public function getDataPengadaanApprov(){
        $petugas  = $this->fungsi->petugas_login()->subbidangID;
        $data1 = $this->InternalPengadaan_m->getLaporanBelanjaPetugas($petugas)->result();
        foreach($data1 as $row1){
            $budgethonorID1[] = $row1->lbDetailID;
        }

        $data2 = $this->InternalPengadaan_m->getAllLaporanBelanjaID($budgethonorID1)->result();
        foreach($data2 as $row2){
            $dataNotaDinas       = $this->InternalPengadaan_m->getAllNotaDinasID($row2->laporanb_notadinasID)->row();
            $dataPencairanBudget = $this->InternalPengadaan_m->getAllPencairanBudgetID($row2->laporanb_pencairanbudgetID)->row();
            $dataBreakdown       = $this->InternalPengadaan_m->getAllBreakdownProsesID($row2->laporanb_bddetailID)->row();
            $dataListBelanja     = $this->InternalPengadaan_m->getAlllistBelanjabyID($row2->laporanb_listbelanjaID)->row();
            $dataListPattyCash   = $this->InternalPengadaan_m->getAllPattyCashID($row2->laporanb_pattycashID)->row();

            $dataProses = $this->InternalPengadaan_m->getLaporanBelanjaByIDDesc($row2->lbd_laporanbelanjaID)->row();
                if($dataProses->status == 'reject'){
                    $xproses = 'reject';
                }else if($dataProses->status == 'success'){
                    $xproses = 'success';
                }else{
                    $xproses = 'proses';
                }
    
                $arrayData[] = array(
                    'lbDetailID'        => $row2->lbDetailID,
                    'laporanbelanjaID'  => $row2->lbd_laporanbelanjaID,
                    'notadinasID'       => $dataNotaDinas->notadinasID,
                    'pengeluaranNo'     => $dataPencairanBudget->pbPengeluaranNo,
                    'breakdownNo'       => $dataBreakdown->bdlD_breakdownlistID,
                    'listbelanjaNo'     => $dataListBelanja->listbelanjaNo,
                    'pattycashNo'       => $dataListPattyCash->pattycashNo,
                    'status'            => $row2->status,
                    'statusProses'      => $xproses,
                    'pengirim'          => $row2->lbd_pengirimID,
                    'penerima'          => $row2->lbd_penerimaID,
                    'waktu'             => $row2->lbdWaktu
                );
            }

        echo json_encode($arrayData);
       
    }

    public function viewAddApproval($id){
        $data['row'] = $this->InternalPengadaan_m->getLaporanBelanjaProsesID($id)->row();
        $this->load->view('petugas/internal_pengadaan_barang/pengadaan_approvAdd', $data); 
    }

    public function addApprovalPengadaan(){
       
        $response = array();
        $this->form_validation->set_rules('bidangID', 'bidangID', 'required');
       

        $this->form_validation->set_message('required', '%s masih Kososng, atau belum di pilih Silahkan Di isi');
        $this->form_validation->set_message('is_unique', '{field} ini sudah dipakai, silahkan ganti');
    
        if($this->form_validation->run() == FALSE){
            $response = array(
                'status' 	    => 'error',
                'bidangID' 		=> form_error('bidangID'),
              
            );
        } 
        else{
            $post['bidangID']       = $this->input->post('bidangID');
            $post['laporanbelanjaID']  = $this->input->post('laporanbelanjaID');
            $post['notadinasID']  = $this->input->post('notadinasID');
            $post['pencairanbudgetID']  = $this->input->post('pencairanbudgetID');
            $post['bddetailID']  = $this->input->post('bddetailID');
            $post['listbelanjaID']  = $this->input->post('listbelanjaID');
            $post['pattycashID']  = $this->input->post('pattycashID');
           
            $postSend = array(    
                'bidangID'          => $post['bidangID'],
                'laporanbelanjaID'  => $post['laporanbelanjaID'],
                'notadinasID'       => $post['notadinasID'] ,
                'pencairanbudgetID' => $post['pencairanbudgetID'],
                'bddetailID'        => $post['bddetailID'],
                'listbelanjaID'     => $post['listbelanjaID'],
                'pattycashID'       =>$post['pattycashID'] ,
            );
            
            $this->InternalPengadaan_m->addApprovalPengadaan($postSend);
        
            if($this->db->affected_rows()>0){ 
                $response = array(
                    'status' 	=> 'success',
                    'message'   => "<h3>Success Message</h3>",
                ); 
            } 
        }
        $this->output->set_content_type('application/json');
        echo json_encode($response);
    
    }



    //Finish Laporan Belanja (Laporan Belanja Masuk Database)






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
<?php defined('BASEPATH') OR exit('No direct script access allowed');

class WorkflowQuotation extends CI_Controller {

    function __construct(){
        parent::__construct();
        check_not_petugas();
        $this->load->model(['Order_m', 'Quotation_m', 'Bidang_m', 'Subbidang_m','Jobdesc_m','Pengaturan_m']);
        $this->load->library('form_validation');

    }
    
    //Menampilkan Halaman Crete Quotation
    public function viewAddQuoID($id){
        $data['row'] = $this->Order_m->getAllByID($id)->row();
        $this->load->view('petugas/workflow_quotation/quo_create_id', $data);
    }

    //Menambahkan ID Quotation
    public function addQuoID(){
        $response = array();
        $this->form_validation->set_rules('quoNo', 'quoNo', 'required|callback_check_quono');
        $this->form_validation->set_rules('orderID', 'orderID', 'required|is_unique[tb_quotation.quo_orderID]');
        $this->form_validation->set_message('required', '%s masih Kososng, atau belum di pilih Silahkan Di isi');
        $this->form_validation->set_message('is_unique', '{field} ini sudah dipakai, silahkan ganti');
        if($this->form_validation->run() == FALSE){
			$response = array(
                'status' 	    => 'error',
                'quoNo' 		=> form_error('quoNo'),
                'orderID' 		=> form_error('orderID'),
            );
        }
        else{
            $quoNo            = $this->input->post('quoNo');
            $orderID          = $this->input->post('orderID');
            $data              = $this->Order_m->getAllByID($orderID)->row();

            //////////Create ID//////////
            date_default_timezone_set("Asia/Jakarta");
            if($data->order_bidangID == 1){
                $bidang = 'MAR';
            }else if($data->order_bidangID == 2){
                $bidang = 'MIN';
            }
            $char    = 'QUO';
            $date    = date("Y-m-d");
            $tahun   = substr($date, 0, 2);
            $bulan   = substr($date, 5, 2);
            $hari    = substr($date, 8, 2);
            $quotation   = $this->Quotation_m->getQuoMaxByBidang($bidang)->row(); 
            $quoID = (int) substr($quotation->quoID, 12, 4);
            $quoID++;
            $newquoID = $char.$bidang.$tahun.$bulan.$hari.sprintf("%04s", $quoID);
            /////////////End Create ID////////////
            
            $post = array(
                'id'          => $newquoID,
                'quoNo'       => $quoNo,
                'orderID'     => $orderID,
                'bidangID'    => $data->order_bidangID
            );
			$this->Quotation_m->addQuoID($post);
            if($this->db->affected_rows()){
                $quotationID = $this->Quotation_m->getQuoByID($newquoID)->row();
                $response = array(
                    'status' 	=> 'success',
                    'id'        => $quotationID->quoID
                );
            }
        }
        $this->output->set_content_type('application/json');
        echo json_encode($response);
    }
    
    //Mengecek Jika ada ID Quotation yang sama
    public function check_quono(){
        $quoNo        = $this->input->post('quoNo');
        $statusQuo    = array();
        $statusJobd   = array();
        $quoID        = array();
        $jobdID       = array();
        $quoDetailID  = array();
        $jobdDetailID = array();

        $quo = $this->Quotation_m->getQuoByNoDesc($quoNo)->row();
        if($quo != null){
            $quoID = $quo->quoID;
            $quoDetail = $this->Quotation_m->getQuoDByQuoID($quoID)->result();
            if($quoDetail != null){
                foreach($quoDetail as $row1){
                    $quoDetailID[] = $row1->quoDetailID;
                    $statusQuo[] = $row1->status;
                }

                $jobd = $this->Jobdesc_m->getJobdscByQuoDID($quoDetailID)->result();
                if($jobd != null){ 
                    foreach($jobd as $row2){
                        $jobdID[] = $row2->jobdApprovID;
                    }

                    $jobdDetail = $this->Jobdesc_m->getJobdscDByJobID($jobdID)->result();
                    if($jobdDetail != null){
                        foreach($jobdDetail as $row3){
                            $jobdDetailID[] = $row3->jobdaDetailID;
                            $statusJobd[] =  $row3->status;
                        }

                        if(in_array("success", $statusJobd)){
                            $this->form_validation->set_message('check_quono', '{field} ini sudah di Gunakan, dan datanya sudah ada approval, silahkan di ganti');
                                return FALSE;   
                        }else{
                            if(in_array("reject", $statusJobd)){ 
                                return TRUE;  
                            }else{
                                $this->form_validation->set_message('check_quono', '{field} ini Masih Di Proses');
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
        }else{
            return TRUE; 
           
        }
        // echo json_encode($jobdDetail);
    }


    //Menampilkan Form untuk mengupload File Quotation
    public function viewUploadQuo($id){
        $data = $this->Quotation_m->getQuoByID($id)->row();
        if($data != null){
            $post['quoID']         = $id;
            $post['petugasID']     = $this->fungsi->petugas_login()->petugasID;
            $post['pengirimID']    = $this->fungsi->petugas_login()->subbidangID;
            $post['bidangNama']    = $this->Subbidang_m->getAll($post['pengirimID'])->row();
            $post['penerimaID']    = $this->fungsi_send->sendreceiverRka1($data->quo_bidangID);
            $jumlah                = $this->Quotation_m->jumlahQuoDetail($post);
            // $rkaStatus             = $this->Quotation_m->statusQuoDetail($post)->row();

            $row['row'] = $this->Quotation_m->getQuoByID($id)->row();
            $this->load->view('petugas/workflow_quotation/quo_upload_file', $row);
         
        } else{
            echo "<script>
                    alert('Maaf, ID atau Nomor Tidak Terdaftar');
                    window.location='".site_url('petugas/petugasDashboard')."';
                </script>";
        }
    }

    //fungsi untuk Menambakan/mengupload data File Quotation 
    public function saveQuoFile(){  
        $response = array(); 
        $rowReject = array();
        $this->form_validation->set_rules('quoID', 'quoID', 'required');
        if($this->input->post('quoFile')){
            $this->form_validation->set_rules('quoFile', 'quoFile', 'callback_file_selected_test');
        }
        $this->form_validation->set_message('required', '%s masih Kososng, atau belum di pilih Silahkan Di isi');
        if($this->form_validation->run() == FALSE){
			$response = array(
                'status' 	    => 'error',
                'quoID' 		=> form_error('quoID'),
                'quoFile' 		=> form_error('quoFile'),
            );   
        } else{
            $post['quoID']         = $this->input->post('quoID');
            $quoID                 =  $post['quoID'];
            $quoDetailID           = $this->input->post('quoDetailID');  
            $post['bidangID']      = $this->input->post('bidangID');  
            $post['comment']       = $this->input->post('quoComment');                       
            $post['petugasID']     = $this->fungsi->petugas_login()->petugasID;
            $post['pengirimID']    = $this->fungsi->petugas_login()->subbidangID;
            $post['bidangNama']    = $this->Bidang_m->get($post['bidangID'])->row();
            if($this->input->post('send_up')){
                $post['penerimaID']    = $this->fungsi_send->sendreceiverRka1($post['bidangID']);
            } else if($this->input->post('send_down')){
                $post['penerimaID']    = $this->fungsi_send->sendreceiverRka2($post['bidangID']);  
            }
            $jumlah                = $this->Quotation_m->jumlahQuoDetail($post);
            $rkaStatus_reject      = $this->Quotation_m->getQuoDByQuoID($quoID)->result();
            foreach($rkaStatus_reject as $row){
                $rowReject[] = $row->status;
            }
            $post['statuskonf']    = 'send';   
            $data_query = $this->Quotation_m->getQuoDByID($quoDetailID)->row();                 
            $data['waktusekarang']  = date('Y-m-d H:i:s');

                if($jumlah->num_rows() == 0 || !in_array('reject', $rowReject)){ 
                    if($this->input->post('send_up')){
                        $data = $this->fungsi_statusjml->sendRecive($jumlah->num_rows());
                        $post['jumlah'] = $data['jumlah'];
                        $post['status'] = $data['status'];
                    }else if($this->input->post('send_down')){
                        $data = $this->fungsi_statusjml->sendReciveRevisi($jumlah->num_rows());
                        $post['jumlah'] = $data['jumlah'];
                        $post['status'] = $data['status']; 
                    }
    
                    $file  = $this->upload($post);
                    if($file['status'] == true){
                        if($file['name'] != null){
                            $post['quoFile'] = $file['name']; 
                        } else{
                            $post['quoFile'] =  $this->input->post('quoFileSeuccess');
                        }

                        $post1 = array(     
                            'quoID'            => $post['quoID'],
                            'petugasID'        => $post['petugasID'],
                            'pengirimID'       => $post['pengirimID'],
                            'penerimaID'       => $post['penerimaID'],
                            'statusID'         => $post['status'],
                            'file'             => $post['quoFile'],     
                            'jumlah'           => $post['jumlah'],
                            'statuskonf'       => $post['statuskonf'],
                            'comment'          => $post['comment'],
                        );

                        $this->Quotation_m->addQuoDetail($post1);
                        if($this->db->affected_rows()>0){ 
                            //Rubah Status Menjadi Reject Jika Quo status == RJ2 Order Menjadi 
                            if($post['status'] == 'RJ2'){
                                $postOrder['orderID'] = $this->input->post('orderID');
                                $postOrder['status'] = 'RJ2';
                                $this->Order_m->changeStatus($postOrder);
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

    //Fungsi Untuk mengecek apakah file quotation di bagian form upload di upload atau tidak
    function file_selected_test(){
        if(!empty($_FILES['quoFile']['name']) != null) {
            return TRUE;
        } else{
            $this->form_validation->set_message('file_selected_test', '%s masih Kososng, Silahkan Upload File Quotaion');
            return FALSE;
        }
    }

    //Fungsi Menyimpan data file quotation dan mengembalikan nama file terbaru
    public function upload($post){
        if($post['status'] == 'NW1'){
            $status = 'new';
        }else if($post['status'] == 'FD1'){
            $status = 'failed';
        }else if($post['status'] == 'RJ1'){
            $status = 'reject';
        }else if($post['status'] == 'RJ2'){
            $status = 'reject';
        }else if($post['status'] == 'RV1'){
            $status = 'revisi';
        }else if($post['status'] == 'SC1'){
            $status = 'success';
        }

        $config = array();
        $config['upload_path']     = './uploads/quotation/'.$post['bidangNama']->bidangNama.'/';
        $config['allowed_types']   = 'pdf';
        $config['max_size']        = 2048;
        $config['file_name']       = 'quoFile-'.$status.'-'.date('ymd').'-'.substr(md5(rand()),0,10);

        $this->load->library('upload', $config); 
        $post = $this->input->post(null, TRUE);
        if(isset($_FILES['quoFile']['name']) != null){
            if($this->upload->do_upload('quoFile')){
                $file_name = $this->upload->data('file_name');
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

    //Menampilkan New Quotation
    public function viewNewQuo(){
        $this->load->view('petugas/workflow_quotation/quo_new');
    }
    
    //Mengambil data quotation yang di kirimkan oleh penggirim, dan di terima oleh petugas yang login
    public function getNewQuo(){
        $data             = array();
        $data2            = array();
        $post['penerima'] = $this->fungsi->petugas_login()->subbidangID;
        $bidangID         = $this->fungsi->petugas_login()->bidangID;
        $data             = $this->Quotation_m->getQuoDAll()->result();
        if($post['penerima'] != 'FM'){
            $post['pengirim'] = $this->fungsi_send->sendreceiverRka2($bidangID);
        }else{
            foreach($data as $row){
                $post['id'] = $row->quoD_quoID;  
                $post['pengirim'] = array('MDM1', 'MDM2');
            }
        }
        $data2 = $this->Quotation_m->getQuoDByPetugasIDNew($post)->result(); 
        echo json_encode($data2); 
    }

    //Mengkonfirmasi data quotation baru, dan menjalankan fungsi timeout untuk batas waktu pengerjaan
    public function konfQuo($id){
        
        $timeWork = $this->fungsi_timework->timework();
        
        date_default_timezone_set("Asia/Jakarta");
        $data                   = array();
        $data_query             = $this->Quotation_m->getQuoDByID($id)->row();
        $data['petugasLogin']   = $this->fungsi->petugas_login()->subbidangID;
        $data['waktusekarang']  = date('Y-m-d H:i:s');

        if($data_query->quo_bidangID == 1){
            $data['rowBidang'] = 'Marine';
        }else if($data_query->quo_bidangID == 2){
            $data['rowBidang'] = 'Minerba';
        }
        
        if($data['petugasLogin'] != $data_query->quoD_pengirimID){
            if($data_query->waktu_start == null && $data_query->waktu_end == null){
                $dataQuoDetail['statusConf']  = 'read';
                $dataQuoDetail['quoProsesID'] = $id;
                $dataQuoDetail['waktustart']   = date('Y-m-d H:i:s');
                $dataQuoDetail['waktuend']     = date('Y-m-d H:i:s',strtotime('+'.$timeWork.' minutes',strtotime($dataQuoDetail['waktustart'])));
                $this->Quotation_m->setQuoDStatusKonf($dataQuoDetail);
            }
            $data['rowQuo'] = $this->Quotation_m->getQuoDByID($id)->row();
            $data['rowOrder'] = $this->Order_m->getAllByID($data_query->quo_orderID)->row();
            $this->load->view('petugas/workflow_quotation/quo_konfirmasi', $data); 
        }else{
            $data['rowQuo'] = $this->Quotation_m->getQuoDByID($id)->row();
            $data['rowOrder'] = $this->Order_m->getAllByID($data_query->quo_orderID)->row();
            $this->load->view('petugas/workflow_quotation/quo_konfirmasi', $data); 
        }  
    }

    //Menampilkan data baru failed QUotation
    public function viewfailedquo(){
        $this->load->view('petugas/workflow_quotation/quo_failed');
    }

    //Mengambil data baru new Failed dari database
    public function getNewFailedQuo(){
        $post['penerima'] = $this->fungsi->petugas_login()->subbidangID;
        $bidangID = $this->fungsi->petugas_login()->bidangID;
        $post['pengirim'] = $this->fungsi_send->sendreceiverRka1($bidangID);
        $array = $this->Quotation_m->getQuoDByPetugasIDNew($post)->result();
        echo json_encode($array); 
    }

    //Mengkonfirmasi data Failed yang akan di revisi, dan menjalankan fungsi timeout untuk batas waktu pengerjaan
    public function revisiQuo($id){
        $timeWork = $this->fungsi_timework->timework();
        date_default_timezone_set("Asia/Jakarta");
        $data                   = array();
        $data_query             = $this->Quotation_m->getQuoDByID($id)->row();
        $data['petugasLogin']   = $this->fungsi->petugas_login()->subbidangID;

        $data['waktusekarang']  = date('Y-m-d H:i:s');

        if($data_query->quo_bidangID == 1){
            $data['rowBidang'] = 'Marine';
        }else if($data_query->quo_bidangID == 2){
            $data['rowBidang'] = 'Minerba';
        }
        
        if($data['petugasLogin'] != $data_query->quoD_pengirimID){
            if($data_query->waktu_start == null && $data_query->waktu_end == null){
                $dataQuoDetail['statusConf']  = 'read';
                $dataQuoDetail['quoProsesID'] = $id;
                $dataQuoDetail['waktustart']   = date('Y-m-d H:i:s');
                $dataQuoDetail['waktuend']     = date('Y-m-d H:i:s',strtotime('+'.$timeWork.' minutes',strtotime($dataQuoDetail['waktustart'])));
                $this->Quotation_m->setQuoDStatusKonf($dataQuoDetail);
            }
            $data['rowQuo'] = $this->Quotation_m->getQuoDByID($id)->row();
            // $data['rowOrder'] = $this->Order_m->getAllByID($data_query->quo_orderID)->row();
            $this->load->view('petugas/workflow_quotation/quo_revisi', $data); 
        }else{
            $data['rowQuo']  = $this->Quotation_m->getQuoDByID($id)->row();
            // $data['rowOrder'] = $this->Order_m->getAllByID($data_query->quo_orderID)->row();
            $this->load->view('petugas/workflow_quotation/quo_revisi', $data); 
        }  
    }

    
    //Fungsi Time-work
    public function timeViewMarine(){
        $this->timeWorkFinalReportMarine();
        $response = array();
        $xproses = array();
        $getID    = $this->input->get('id');
        $waktu_sekarang = date('Y-m-d H:i:s');
        $data_query = $this->Quotation_m->getQuoDByIDDesc($getID)->row();
        $dataQuoMax = $this->Quotation_m->getQuoDMaxByQuoID($data_query->quoD_quoID)->row();
        if($dataQuoMax->quoDetailID > $getID){
            $checkAllDetailID[] = 'success';
        }else{
            $checkAllDetailID[] = 'proses';
        }
        $dataFR = $this->Quotation_m->getQuoDByQuoID($data_query->quoD_quoID)->result();
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
        $dataPenerimaDesc         = $this->Quotation_m->getQuoDMaxByPenerimaID($subbidangPetugas)->result();
        if($dataPenerimaDesc != null){
            foreach($dataPenerimaDesc as $row){
                $frPenerimaID[] = $row->quoDetailID;
            }
            $dataPenerima     = $this->Quotation_m->getQuoDByIDDesc($frPenerimaID)->result();
            foreach($dataPenerima as $row1){
                $file[] = array(
                    'frDetailID' => $row1->quoDetailID,
                    'frID'       => $row1->quoD_quoID,
                    'orderID'    => $row1->quo_orderID
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

        $dataPengirimDesc = $this->Quotation_m->getQuoDByPengirimQuoID($id, $petugasID)->result();
        if($dataPengirimDesc != null){
            foreach($dataPengirimDesc as $row1){
                if(in_array($row1->quoD_quoID, $id)){
                    $file1[] = $row1->quoD_quoID; //Data Pengirim ADA 
                    $fileDetailID[] = $row1->quoDetailID; //Data Pengirim ADA 
                }
            }
        //     //////////////////Jika Petugas Sudah Menerima Dan Mengirimkan FR ID////////////////////////////
            $dataFR = $this->Quotation_m->getQuoDMaxByPengirimQuoID($file1, $petugasID)->result();
            foreach($dataFR as $row2){
                $frDetailIDDesc[] = $row2->quoDetailID;
            }
            
            $dataPegirim = $this->Quotation_m->getQuoDByIDDesc($frDetailIDDesc)->result();
            foreach($dataPegirim as $row3){
                $dataDetailCheck = $this->Quotation_m->getQuoDMaxByPenerimaQuoID($row3->quoD_quoID, $petugasID)->row();
                $dataPenerimaCheck = $this->Quotation_m->getQuoDByIDDesc($dataDetailCheck->quoDetailID)->row();
                if($row3->quoD_quoID == $dataPenerimaCheck->quoD_quoID){
                    $file2[] = $row3->quoD_quoID; //Data Pengirim ADA 
                    if($dataDetailCheck->quoDetailID > $row3->quoDetailID){
                        // $xd[] = " DetailID : ". $dataDetailCheck->quoDetailID.">".$row3->quoDetailID;//Exekusi TimeOut
                        $waktux[] = $row3->waktu_end;
                        if($dataPenerimaCheck->waktu_end != null){
                            if($dataPenerimaCheck->status != 'success'){
                                if($waktu_sekarang > $dataPenerimaCheck->waktu_end){
                                    $frData              = $this->Quotation_m->getQuoByID($row3->quoD_quoID)->row();
                                    $post['orderID']     = $frData->quo_orderID;
                                    $post['status']      = 'RJ1';//Reject Waktu
                                    $post['quoProsesID'] = $dataPenerimaCheck->quoDetailID;
                                    $this->Quotation_m->setQuoDStatus($post);
                                    $this->Order_m->changeStatus($post);
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
                $dataPenerimaNull = $this->Quotation_m->getQuoDByQuoID($pengirimNull)->result();
                foreach($dataPenerimaNull as $row4){
                    $dataDetailCheck1 = $this->Quotation_m->getQuoDMaxByPenerimaQuoID($row4->quoD_quoID, $petugasID)->row();
                    $dataPenerimaCheck1 = $this->Quotation_m->getQuoDByIDDesc($dataDetailCheck1->quoDetailID)->row();
                    if($row4->quoD_quoID == $dataPenerimaCheck1->quoD_quoID){
                        $x1 = $row4->quoDetailID ;
                        // $x = $dataPenerimaCheck1->quoD_quoID;
                        // if($dataPenerimaCheck1->quoDetailID > $row4->quoDetailID){
                            $z = $row4->quoDetailID;
                            // $waktu1[] = $dataPenerimaCheck1->waktu_end;
                            if($dataPenerimaCheck1->waktu_end != null){
                                if($dataPenerimaCheck1->status != 'success'){
                                    if($waktu_sekarang > $dataPenerimaCheck1->waktu_end){
                                        $frData              = $this->Quotation_m->getQuoByID($row4->quoD_quoID)->row();
                                        $post['orderID']     = $frData->quo_orderID;
                                        $post['status']      = 'RJ1';//Reject Waktu
                                        $post['quoProsesID'] = $dataPenerimaCheck1->quoDetailID;
                                        $this->Quotation_m->setQuoDStatus($post);
                                        $this->Order_m->changeStatus($post);
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

            $dataPenerimax = $this->Quotation_m->getQuoDByPenerimaQuoID($id, $petugasID)->result();
            foreach($dataPenerimax as $rowx){
                $waktu[] = $rowx->waktu_end;
                if($rowx->waktu_end != null){
                    if($rowx->status != 'success'){
                        if($waktu_sekarang > $rowx->waktu_end){
                            $frData              = $this->Quotation_m->getQuoByID($rowx->quoD_quoID)->row();
                            $post['orderID']     = $frData->quo_orderID;
                            $post['status']      = 'RJ1';//Reject Waktu
                            $post['quoProsesID'] = $rowx->quoDetailID;
                            $this->Order_m->changeStatus($post);
                            $this->Quotation_m->setQuoDStatus($post);
                            $response[] = array(
                                'status' => 'sukses',
                                'message' => 'Prosess 3'
                            );
                        }
                    }
                }
            }
        } 

        // echo json_encode($x1); 
    }




}

<?php

Class Fungsi_waktu {
    protected $ci;
    var $pengirim;
    var $subbidangID;
    var $startwaktu;
    var $value;

    function __construct(){
        $this->ci =& get_instance();
    }

 

    public function timeWorkOrder(){  
        $this->ci->load->model(['Petugas_m','Order_m', 'Quotation_m', 'ClientProject_m']);
        $waktu_sekarang  = date('Y-m-d H:i:s'); 
        $petugas_id      = $this->ci->session->userdata('petugasID');
        $petugas_data    = $this->ci->Petugas_m->getAll($petugas_id)->row();
        $bidangID        = $petugas_data->bidangID;
        $response = array();
        $orderID = array();
        $quoID   = array();
        $clientproject = $this->ci->ClientProject_m->getAllbyBidang($bidangID)->result();
        foreach($clientproject as $row){
            $projectID[] = $row->projectID;
        }

        $data = $this->ci->Order_m->getAllByProjectID($projectID)->result();
        if($data != null){
            foreach($data as $row1){
                $orderID[] = $row1->orderID;
            }
                $dataQuoID = $this->ci->Quotation_m->getQuoByOrderID($orderID)->result();
                if($dataQuoID != null){
                    foreach($dataQuoID as $row2){
                        $quoID[] = $row2->quoID;
                        $quo_orderID1[] = $row2->quo_orderID;
                    }

                    $dataNull1     = array_diff($orderID, $quo_orderID1); //Data Pengirim Tidak Ada
                    if($dataNull1 != null){
                        $dataQuo       = $this->ci->Order_m->getAllByID($dataNull1)->result();
                        foreach($dataQuo as $rowc){
                            if($waktu_sekarang > $rowc->waktu_end){
                                $post['orderID']     = $rowc->orderID;
                                $post['status']      = 'RJ1';//Reject Waktu
                                $this->ci->Order_m->changeStatus($post);
                            }  
                        }
                    }
                    


                    $dataquodetail = $this->ci->Quotation_m->getQuoDByQuoID($quoID)->result();
                    if($dataquodetail != null){
                        foreach($dataquodetail as $row3){
                            $quoDetailID[] = $row3->quoDetailID;
                            $quo_orderID2[] = $row3->quo_orderID;
                        }

                        $dataNull2     = array_diff($orderID, $quo_orderID2); //Data Pengirim Tidak Ada
                        if($dataNull2 != null){
                            $dataQuo2       = $this->ci->Order_m->getAllByID($dataNull2)->result();
                            foreach($dataQuo2 as $rowd){
                                if($waktu_sekarang > $rowd->waktu_end){
                                    $post['orderID']     = $rowd->orderID;
                                    $post['status']      = 'RJ1';//Reject Waktu
                                    $this->ci->Order_m->changeStatus($post);
                                }  
                            }
                        }
                                

                    }
                    else{
                        
                     
                            // Jalankan Fungsi TimeOut
                            $dataQuoNull2 = $this->ci->Order_m->getAllByID($orderID)->result();
                            foreach($dataQuoNull2 as $rowB){
                                if($waktu_sekarang > $rowB->waktu_end){
                                    $post['orderID']     = $rowB->orderID;
                                    $post['status']      = 'RJ1';//Reject Waktu
                                    $this->ci->Order_m->changeStatus($post);
                                }
                            }
                            // return "x";
                       
                         
                            // echo json_encode($dataQuoNull2);

                            
                    }
                }else{
                    
                   
                            // Jalankan Fungsi TimeOut
                            $dataQuoNull1 = $this->ci->Order_m->getAllByID($orderID)->result();
                            foreach($dataQuoNull1 as $rowA){
                                if($waktu_sekarang > $rowA->waktu_end){
                                    $post['orderID']     = $rowA->orderID;
                                    $post['status']      = 'RJ1';//Reject Waktu
                                    $this->ci->Order_m->changeStatus($post);
                                }  
                            } 
                            // return "x";
                       
                }

                

                

                

                
        }
        // return $data;
        
    }


    //////////////////Order TimeWork////////////////
    public function timeWorkJobdesc(){   
        $this->ci->load->model(['Petugas_m','jobdesc_m']);
        $post_kirim               = array();
        $petugas_id               = $this->ci->session->userdata('petugasID');
        $petugas_data             = $this->ci->Petugas_m->getAll($petugas_id)->row();
        $post['subbidangPetugas'] = $petugas_data->subbidangID;
        $data['penerima']         = $this->ci->jobdesc_m->getJobdscDByPenerimaID($post)->row();
        
		if($data['penerima'] != null){
			$post['jobdID']    = $data['penerima']->jobdaD_jobdApprovID;
			$data['pengirim'] = $this->ci->jobdesc_m->getJobdscDByPengirimID($post)->row();
  
            if($data['pengirim'] == null){
                if($data['penerima']->waktu_end != null){
                    if($data['penerima']->status == 'success'){

                    }else{
                        $waktu_end = $data['penerima']->waktu_end;
                        $waktu_sekarang = date('Y-m-d H:i:s');
                
                        if($waktu_sekarang > $waktu_end){    //Waktu Selesai, langsung di reject
                            $post_kirim['status'] = 'RJ1';//Reject Waktu
                            $post_kirim['jobdaDetailID'] = $data['penerima']->jobdaDetailID;
                            $this->ci->jobdesc_m->setJobdscDStatus($post_kirim);
                            return 'reject';
                        }else{
                            return 'proses';
                        }
                    }
					
				}
					
			}else{
				// if($data['penerima']->jobdaDetailID >  $data['pengirim']->jobdaDetailID){

				// 	if($data['penerima']->waktu_end != null){
                //         if($data['penerima']->status == 'success'){
                        
                //         }else{
                //             $waktu_end = $data['penerima']->waktu_end;
                //             $waktu_sekarang = date('Y-m-d H:i:s');
    
                //             if($waktu_sekarang > $waktu_end){  //Waktu Selesai, langsung di reject
                //                 $post_kirim['status'] = 'RJ1';
                //                 $post_kirim['jobdaDetailID'] = $data['penerima']->jobdaDetailID;
                //                 $this->ci->jobdesc_m->setJobdscDStatus($post_kirim);
                //                 return 'reject';
                                
                //             }else{
                //                 return 'proses';
                //             }
                //         }
						
				// 	}
                // }
			}
        }
    }



    public function timeWorkQuotation(){   
        $this->ci->load->model(['Petugas_m','Quotation_m']);
        $post_kirim               = array();
        $petugas_id               = $this->ci->session->userdata('petugasID');
        $petugas_data             = $this->ci->Petugas_m->getAll($petugas_id)->row();
        $post['subbidangPetugas'] = $petugas_data->subbidangID;
        $data['penerima']         = $this->ci->Quotation_m->getQuoDByPenerimaID($post)->row();
        
		if($data['penerima'] != null){
			$post['quoid']    = $data['penerima']->quoD_quoID;
			$data['pengirim'] = $this->ci->Quotation_m->getQuoDByPengirimID($post)->row();
  
            if($data['pengirim'] == null){
                if($data['penerima']->waktu_end != null){
                    if($data['penerima']->status == 'success'){

                    }else{
                        $waktu_end = $data['penerima']->waktu_end;
                        $waktu_sekarang = date('Y-m-d H:i:s');
                
                        if($waktu_sekarang > $waktu_end){    //Waktu Selesai, langsung di reject
                            $post_kirim['status'] = 'RJ1';//Reject Waktu
                            $post_kirim['quoProsesID'] = $data['penerima']->quoDetailID;
                            $this->ci->Quotation_m->setQuoDStatus($post_kirim);
                            return 'reject';
                        }else{
                            return 'proses';
                        }
                    }
					
				}
					
			}else{
				if($data['penerima']->quoDetailID >  $data['pengirim']->quoDetailID){

					if($data['penerima']->waktu_end != null){
                        if($data['penerima']->status == 'success'){
                        
                        }else{
                            $waktu_end = $data['penerima']->waktu_end;
                            $waktu_sekarang = date('Y-m-d H:i:s');
    
                            if($waktu_sekarang > $waktu_end){  //Waktu Selesai, langsung di reject
                                $post_kirim['status'] = 'RJ1';
                                $post_kirim['quoProsesID'] = $data['penerima']->quoDetailID;
                                $this->ci->Quotation_m->setQuoDStatus($post_kirim);
                                return 'reject';
                                
                            }else{
                                return 'proses';
                            }
                        }
						
					}
                }
			}
        }
    }





    
}
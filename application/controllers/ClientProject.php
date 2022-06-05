<?php defined('BASEPATH') or exit('No direct script access allowed');

class ClientProject extends CI_Controller
{

	function __construct(){
        parent::__construct();
        check_not_petugas();
        $this->load->model(['Client_m','ClientProject_m', 'Order_m', 'InvoiceFinalClient_m']);
        $this->load->library('form_validation');
    }

    
	public function petugasDashboard()
	{   
		$this->load->view('petugas/dashboard');
    }
    
  
     //Menampilkan Halaman New Project Dari Client
     public function viewNewProject(){
        $this->load->view('petugas/project_client');
    }

    //Menampilkan Data New Project Dari Client
    public function getNewProject(){
        $bidangID = $this->fungsi->petugas_login()->bidangID;    
        $data = $this->ClientProject_m->getAllbyBidang($bidangID)->result();
        echo json_encode($data);
     }

    //Menampilkan Detail Data New Project Dari Client
    public function viewDetilProjectID($id){
        $data = array();
        $quo = array();
        $this->fungsi_waktu->timeWorkOrder();
        $dataQuoDetail['statusConf']   = 'read';
        $dataQuoDetail['projectID']   = $id;
        $data['petugasLogin']   = $this->fungsi->petugas_login()->subbidangID;
        $data_query       = $this->ClientProject_m->getAllID($id)->row();
        if($data_query->projectbidangID == 1 && $data['petugasLogin'] == 'AM1'){
            $this->ClientProject_m->setMarFRDStatusKonf($dataQuoDetail);
            $data['row']       = $this->ClientProject_m->getAllID($id)->row();
            $data['rowOrder']  = $this->Order_m->getAllByProjectIDDESC($data['row']->projectID)->row();
            $this->load->view('petugas/project_detail', $data);
        }else if($data_query->projectbidangID == 2 && $data['petugasLogin'] == 'AM2'){
            $this->ClientProject_m->setMarFRDStatusKonf($dataQuoDetail);
            $data['row']       = $this->ClientProject_m->getAllID($id)->row();
            $data['rowOrder']  = $this->Order_m->getAllByProjectIDDESC($data['row']->projectID)->row();
            $this->load->view('petugas/project_detail', $data);
        }
 
       
    }



    //////////////////////////////////////////////Final Project Client////////////////////////////////////////////////////////////

    public function viewTransaksiData(){
        $data = $this->InvoiceFinalClient_m->getAllMarine();
        $this->load->view('petugas/project_transaksiData'); 
    }

    public function getTransaksiData(){
        $bidangID = $this->fungsi->petugas_login()->bidangID;
        if($bidangID == 1){
            $data = $this->ClientProject_m->getAllbyBidangSuccess($bidangID)->result();
        }else if($bidangID == 2){
            $data = $this->ClientProject_m->getAllbyBidangSuccess($bidangID)->result();
        }
        echo json_encode($data);
    }

    public function viewDetailDataTransaksi($id){
        $data['rowClientProject'] = $this->ClientProject_m->getAllID($id)->row();
        if($data['rowClientProject']->projectbidangID == 1){
            $data['rowBidang'] = 'Marine';
            $data['rowFinalClientProject'] = $this->InvoiceFinalClient_m->getAllMarineByclientProjectID($id)->row();
           
        }else if($data['rowClientProject']->projectbidangID == 2){
            $data['rowBidang'] = 'Minerba';
            $data['rowFinalClientProject'] = $this->InvoiceFinalClient_m->getAllMinerbaByclientProjectID($id)->row();
        }
        $this->load->view('petugas/project_transaksiDetail',$data); 
        // echo json_encode($data);
    }

    // public function getDetailDataTransaksi($id){
    //     $data['rowClientProject'] = $this->ClientProject_m->getAllID($id)->row();
    //     if($data['rowClientProject']->projectbidangID == 1){
    //         $data['rowBidang'] = 'Marine';
    //         $data['rowFinalClientProject'] = $this->InvoiceFinalClient_m->getAllMarineByclientProjectID($id)->row();


    //     }else if($data['rowClientProject']->projectbidangID == 2){
    //         $data['rowBidang'] = 'Minerba';
    //     }
    //     // $this->load->view('petugas/project_transaksiDetail',$data); 
    //     echo json_encode($data);
    // }



    public function saveFinalClient(){  
        $response  = array(); 
        // $post      = $this->input->post(null, TRUE);  
        $this->form_validation->set_rules('clientF_invDetailID', 'clientF_invDetailID', 'required');
        $this->form_validation->set_rules('clientF_clientID', 'clientF_clientID', 'required');

        $this->form_validation->set_message('required', '%s masih Kososng, atau belum di pilih Silahkan Di isi');
        if($this->form_validation->run() == FALSE){
			$response = array(
                'status' 	     => 'error',
                'clientF_invDetailID'    => form_error('clientF_invDetailID'),
                'clientF_clientID' 		 => form_error('clientF_clientID'),
                // 'referencingID'  => form_error('referencingID'),
            );   
        } 
        else{
            // $post               = $this->input->post(null, TRUE);       
            $post['invDetailID']            = $this->input->post("clientF_invDetailID");  
            $post['projectClientID']        = $this->input->post("clientF_projectClientID");  
            $projectID                      = $post['projectClientID'];
            $post['clientID']               = $this->input->post("clientF_clientID");  
            $post['frDetailID']             = $this->input->post("clientF_frDetailID");  
            $post['spkID']                  = $this->input->post("clientF_spkID");  
            $post['jobdaDetailID']          = $this->input->post("clientF_jobdaDetailID");  
            $post['quoDetailID']            = $this->input->post("clientF_quoDetailID");  
            $post['orderID']                = $this->input->post("clientF_orderID");  
            $post['petugasID']              = $this->fungsi->petugas_login()->petugasID;
            $post['bidangID']               = $this->input->post("clientF_bidangID");    
            $post['statusID']               = 'SC1';  
            $post['statusKonf']             = 'send';  
            $post['comment']                = $this->input->post("clientF_comment");  
            

            // date_default_timezone_set("Asia/Jakarta");

            if($post['bidangID'] == 1){
                $bidang = 'MAR';
                $invDraft   = $this->InvoiceFinalClient_m->getMarineAllMax()->row(); 
                $invID = (int) substr($invDraft->invMarFinalID, 12, 4);
                $invID++;
            }
            else if($post['bidangID'] == 2){
                $bidang = 'MIN';
                $invDraft   = $this->InvoiceFinalClient_m->getMinerbaAllMax()->row(); 
                $invID = (int) substr($invDraft->invMinFinalID, 12, 4);
                $invID++;
            }
            //////////Create ID//////////
            $char    = 'FCP';
            $date    = date("Y-m-d");
            $tahun   = substr($date, 0, 2);
            $bulan   = substr($date, 5, 2);
            $hari    = substr($date, 8, 2);
            
            $newFcpID = $char.$bidang.$tahun.$bulan.$hari.sprintf("%04s", $invID);

            $postSend = array(
                'id'                => $newFcpID,
                'invDetailID'       => $post['invDetailID'] ,
                'clientProjectID'   => $post['projectClientID'],
                'clientID'          => $post['clientID'],
                'frDetailID'        => $post['frDetailID'],
                'spkID'             => $post['spkID'],
                'jobdaDetailID'     => $post['jobdaDetailID'],
                'quoDetailID'       => $post['quoDetailID'],
                'orderID'           => $post['orderID'], 
                'petugasID'         => $post['petugasID'] ,
                'bidangID'          => $post['bidangID'],
                'statusID'          => $post['statusID'],
                'statusKonf'        => $post['statusKonf'],
                'comment'           => $post['comment'],
            );   

            if($this->fungsi->petugas_login()->bidangID == 1){
                $this->InvoiceFinalClient_m->addMarine($postSend);
                $postClient['projectID'] = $projectID;
                $postClient['status']    = 'SC1';
                $this->ClientProject_m->setStatus($postClient); 
                if($this->db->affected_rows()>0){
                    $response = array(
                        'status' => 'success',
                    );
                }
            }else if($this->fungsi->petugas_login()->bidangID == 2){
                $this->InvoiceFinalClient_m->addMinerba($postSend);
                $postClient['projectID'] = $projectID;
                $postClient['status']    = 'SC1';
                $this->ClientProject_m->setStatus($postClient); 
                if($this->db->affected_rows()>0){
                    $response = array(
                        'status' => 'success',           
                    );
                }
            }
        }
        $this->output->set_content_type('application/json');
        echo json_encode($response);
    }



    public function saveFinalMinClient(){  
        $response = array(); 
        $this->form_validation->set_rules('invDetailID', 'invDetailID', 'required');
        $this->form_validation->set_rules('clientID', 'clientID', 'required');

        $this->form_validation->set_message('required', '%s masih Kososng, atau belum di pilih Silahkan Di isi');
        if($this->form_validation->run() == FALSE){
			$response = array(
                'status' 	     => 'error',
                'invID'    => form_error('invID'),
                'clientID' 		 => form_error('clientID'),
                // 'referencingID'  => form_error('referencingID'),
            );   
        } 
        else{
            $post      = $this->input->post(null, TRUE);                       
            $post['petugasID']     = $this->fungsi->petugas_login()->petugasID;
            $post['statuskonf']    = 'send';  
            $this->InvoiceFinalClient_m->addMinerba($post);
            if($this->db->affected_rows()>0){
                $response = array(
                    'status' => 'sukses', 
                );
            }         
        }
        $this->output->set_content_type('application/json');
        echo json_encode($response);
    }
	
    
	
}


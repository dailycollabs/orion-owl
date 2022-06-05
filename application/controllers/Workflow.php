<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Workflow extends CI_Controller {
    public $xx = array();
    public $datax = array();
    public $idx = array();

    function __construct(){
        parent::__construct();
        check_not_petugas();
        $this->load->model(['Order_m', 'Quotation_m', 'Jobdesc_m', 'Spk_m']);
        $this->load->library('form_validation');
    }

    public function viewDataWorkflow(){
        $this->load->view('petugas/workflow/workflow_dataNo');  
    }

    public function getDataWorkflow(){
        $petugas  = $this->fungsi->petugas_login()->subbidangID;
        $bidangID = $this->fungsi->petugas_login()->bidangID;
        $quoNo    = array();
        $quoID    = array();
        if($petugas != 'FM'){
            $data1 = $this->Quotation_m->getQuoByBidangID($bidangID)->result();
            foreach($data1 as $row1){
                $quoNo[] = $row1->quoNo;
            }
        }else{
            $data1 = $this->Quotation_m->getQuoAll()->result();
            foreach($data1 as $row1){
                $quoNo[] = $row1->quoNo;
            }
        }
        

        $data2 = $this->Quotation_m->getQuoMaxByNo($quoNo)->result();
        foreach($data2 as $row2){
            $quoID[] = $row2->quoID;
        }
        $data3 = $this->Quotation_m->getQuoByID($quoID)->result();
        foreach($data3 as $row3){
            $quoIDx[] = $row3->quoID;
        }

        ///////////////////////////////////////////////////


        $data4 = $this->Quotation_m->getQuoDMaxByPetugasID($petugas)->result();
        foreach($data4 as $row){
            $id[] = $row->quoDetailID;
        }
        
        $dataQUo = $this->Quotation_m->getQuoDByIDDesc($id)->result();
        foreach($dataQUo as $rowx){
            if(in_array($rowx->quoD_quoID, $quoIDx)){

           
            $dataProses = $this->Quotation_m->getQuoDByQuoIDDesc($rowx->quoD_quoID)->row();
            if($dataProses->status == 'reject'){
                $xproses = 'reject';
            }else if($dataProses->status == 'success'){
                $xproses = 'success';
            }else{
                $xproses = 'proses';
            }

            $arrayData[] = array(
                'quoDetailID'  => $rowx->quoDetailID,
                'quoID'        => $rowx->quoD_quoID,
                'quoNo'        => $rowx->quoNo,
                'orderID'      => $rowx->quo_orderID,
                'status'       => $rowx->status,
                'statusProses' => $xproses,
                'pengirim'     => $rowx->quoD_pengirimID,
                'penerima'     => $rowx->quoD_penerimaID,
                'waktu'        => $rowx->waktu
            );
        }
    }




        echo json_encode($arrayData);
    }





    public function viewDataWorkflowbyNo($id){
        $data['row'] = $this->Quotation_m->getQuoByNoDesc($id)->row();
        $this->load->view('petugas/workflow/workflow_data', $data);
    }

    
    public function getDataWorkflowID(){
        $quoNo     = $this->input->get('id');
        // $quoNo     ="QUO-MAR-001";
        $petugas   = $this->fungsi->petugas_login()->subbidangID;
        $id        = array();
        $dataQUo   = array();
        $arrayData = array();
        $xproses   = array();

        $data = $this->Quotation_m->getQuoDMaxByPetugasID($petugas)->result();
        foreach($data as $row){
            $id[] = $row->quoDetailID;
        }
        
        $dataQUo = $this->Quotation_m->getQuoDByIDDesc($id)->result();
        foreach($dataQUo as $rowx){
            if($rowx->quoNo == $quoNo){
                $dataProses = $this->Quotation_m->getQuoDByQuoIDDesc($rowx->quoD_quoID)->row();
                if($dataProses->status == 'reject'){
                    $xproses = 'reject';
                }else if($dataProses->status == 'success'){
                    $xproses = 'success';
                }else{
                    $xproses = 'proses';
                }

                $arrayData[] = array(
                    'quoDetailID'  => $rowx->quoDetailID,
                    'quoID'        => $rowx->quoD_quoID,
                    'quoNo'        => $rowx->quoNo,
                    'orderID'      => $rowx->quo_orderID,
                    'status'       => $rowx->status,
                    'statusProses' => $xproses,
                    'pengirim'     => $rowx->quoD_pengirimID,
                    'penerima'     => $rowx->quoD_penerimaID,
                    'waktu'        => $rowx->waktu
                );
            }
        }

        echo json_encode($arrayData);
    }


    public function detailDataWorkflowID($id){
        $data['row'] = $this->Quotation_m->getQuoDByQuoID($id)->row();
        $data['rowOrder'] = $this->Order_m->getAllByID($data['row']->quo_orderID)->row();

        $quoDetail = $this->Quotation_m->getQuoDByQuoID($id)->result();
        foreach($quoDetail as $row1){
            $quoDetailID[] = $row1->quoDetailID;
        }

        $data['rowSpk']  = $this->Spk_m->getSpkByQuoDID($quoDetailID)->row();
        if($data['rowSpk'] != null){
            if($data['rowSpk']->spk_bidangID == 1){
                $data['rowSpkBidang'] = 'Marine';
            }else if($data['rowSpk']->spk_bidangID == 2){
                $data['rowSpkBidang'] = 'Minerba';
            }
        }
        
        $this->load->view('petugas/workflow/workflow_detail', $data);
    }

    public function getDetailDataWorkflow(){
        $array = array();
        $quoID = $this->input->get('quoID');
        $petugas = $this->fungsi->petugas_login()->subbidangID;

        $data = $this->Quotation_m->getQuoDByPetugasIDDesc($petugas)->result();
        foreach($data as $row){
            $id = $row->quoD_quoID;
            if ($quoID == $id){
                $array[] = array(
                    'quoDetailID' => $row->quoDetailID,
                    'quoID'       => $row->quoD_quoID,
                    'quoNo'       => $row->quoNo,
                    'orderID'     => $row->quo_orderID,
                    'status'      => $row->status,
                    'penerima'    => $row->quoD_penerimaID,
                    'pengirim'    => $row->quoD_pengirimID,
                    'waktu'       => $row->waktu
                );
            }else{
            }
        
        }
        echo json_encode($array);
    }

    public function getCheckAll(){
        $array = array();
        $quoID = $this->input->get('quoID');
        $data = $this->Quotation_m->getQuoDByQuoIDDesc($quoID)->row();
        // foreach($data as $row){
            if($data->status == 'reject'){
                $array = array(
                    'status' => 'reject',
                    'message' => 'Data ini sudah di reject'
                );
            }else if($data->status == 'success'){
                $array = array(
                    'status' => 'success',
                    'message' => 'Data ini sudah ada Approval'
                );
            }else{
                $array = array(
                    'status' => 'proses',
                    'message' => 'Data ini masih di proses'
                );
            }
           
           
        // }
        
        echo json_encode($array);
    }


    public function getWorkflowApproval(){
        $array = array();
        $id = array();
        $approvID = array();
        $petugas = $this->fungsi->petugas_login()->subbidangID;
        $quoID = $this->input->get('quoID');
        $dataQuo = $this->Quotation_m->getQuoDByQuoID($quoID)->result();
        foreach($dataQuo as $row1){
            $id[] = $row1->quoDetailID;
        }
        $xid = $this->Jobdesc_m->getJobdscByQuoDID($id)->row();
        $approvID = $xid->jobdApprovID;
        $post['bidangID'] = $this->fungsi->petugas_login()->bidangID;
        $approval             = $this->Jobdesc_m->getJobdscDByPetugasID($petugas)->result();
        foreach($approval as $approw){
            $approvDetailID[] = $approw->jobdaDetailID;
        }
        $approvalData         = $this->Jobdesc_m->getJobdscDByDetailID($approvDetailID, $approvID)->result();
        foreach($approvalData as $row){
            $id        = $row->jobdA_quoDetailID;
            $quotation = $this->Quotation_m->getQuoDByID($id)->row();

            $array[] = array(
                'jobdaDetailID' => $row->jobdaDetailID,
                'jobdescID'     => $row->jobdaD_jobdApprovID,
                'quoID'         => $xid->quoD_quoID,
                'quoNo'         => $quotation->quoNo,
                'penerima'      => $row->jobdaD_penerimaID,
                'pengirim'      => $row->jobdaD_pengirimID,
                'orderID'       => $row->jobdA_orderID,
                'file'          => $row->jobdaDFile,
                'status'        => $row->status,
                'waktu'         => $row->waktu,
            );
        }
        echo json_encode($array); 
    }

    public function cekDataSpk(){
        $id = $this->input->get('jobdaDetailID');
        
        echo json_encode($dataSPK); 
    }



  

  

   
}

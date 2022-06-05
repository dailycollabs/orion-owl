<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Invoicing extends CI_Controller {

    function __construct(){
        parent::__construct();
        check_not_petugas();
        $this->load->model(['InvoicingApproval_m', 'Invoicing_m', 'Spk_m','Finalreport_m', 'Jobdesc_m']);
        $this->load->library('form_validation');
    }


    public function viewDataInvoicing(){
        $bidangID = $this->fungsi->petugas_login()->bidangID;
        $petugas   = $this->fungsi->petugas_login()->subbidangID;
        if($bidangID == 1){
            $this->load->view('petugas/Invoicing/invoicing_marine_data');
        }else if($bidangID == 2 || $petugas == 'FM'){
            $this->load->view('petugas/Invoicing/invoicing_minerba_data');
        }
       
    }

    //Masih Bermasalah
    public function getDataINVFRMarine(){
        $petugas   = $this->fungsi->petugas_login()->subbidangID;
        $id        = array();
        $arrayData = array();
        $xproses   = array();
        $spkID   = array();

        $data1 = $this->Finalreport_m->getFRMarAll()->result(); 
        foreach($data1 as $row1){
            $spkID[] = $row1->frMar_spkID;
        }

        $data2 = $this->Finalreport_m->getFRMarBySpkID($spkID)->result();
        foreach($data2 as $row2){
            $frID[] = $row2->frMarID;
        }
        $data3 = $this->Finalreport_m->getFRMarByID($frID)->result();
        foreach($data3 as $row3){
            $frIDx[] = $row3->frMarID;
        }
        
        $data = $this->Finalreport_m->getFRDMarMaxByPetugasID($petugas)->result();
        foreach($data as $row){
            $id[] = $row->frMarDetailID;
        }

        $dataFRDetail = $this->Finalreport_m->getFRDMarByIDWaktuDesc($id)->result();
        foreach($dataFRDetail as $rowx){
            if(in_array($rowx->frMarD_frID, $frIDx)){
                $dataFR = $this->Finalreport_m->getFRMarBySpkID($rowx->frMar_spkID)->row();
                $datajobd = $this->Jobdesc_m->getJobdscDByID($rowx->frMar_jobdaDetailID)->row();
                $dataProses = $this->Finalreport_m->getFRDMarByFRIDDesc($rowx->frMarD_frID)->row();
                if($dataProses->status == 'reject'){
                    $xproses = 'reject';
                }else if($dataProses->status == 'success'){
                    $xproses = 'success';
                }else{
                    $xproses = 'proses';
                }
                $arrayData[] = array(
                    'frDetailID'   => $rowx->frMarDetailID,
                    'frID'         => $rowx->frMarD_frID,
                    'spkID'        => $rowx->frMar_spkID,
                    'spkNo'        => $dataFR->spkNo,
                    'jobdID'       => $rowx->frMar_jobdaDetailID,
                    'jobdNo'       => $datajobd->jobdApprovNo,
                    'orderID'      => $rowx->frMar_orderID,
                    'status'       => $rowx->status,
                    'statusProses' => $xproses,
                    'pengirim'     => $rowx->frMarD_pengirimID,
                    'penerima'     => $rowx->frMarD_penerimaID,
                    'waktu'        => $rowx->waktu
                );
            }
        }

        echo json_encode($arrayData);
    }

  
    public function viewDataInvoiceSpkIDMarine($id){
        $data['row'] = $this->Finalreport_m->getFRMarBySpkID($id)->row();
        $this->load->view('petugas/Invoicing/invoicing_marine_dataID', $data);
    }
    
    public function getDataInvoicingIDMarine(){
        $spkIDx      = $this->input->get('id');
        $petugas   = $this->fungsi->petugas_login()->subbidangID;
        $id        = array();
        $arrayData = array();
        $xproses   = array();
        
        $data = $this->Finalreport_m->getFRDMarMaxByPetugasID($petugas)->result();
        foreach($data as $row){
            $id[] = $row->frMarDetailID;
        }

        $dataFRDetail = $this->Finalreport_m->getFRDMarByIDWaktuDesc($id)->result();
        foreach($dataFRDetail as $rowx){
            if($rowx->frMar_spkID == $spkIDx){
                $dataFR = $this->Finalreport_m->getFRMarBySpkID($rowx->frMar_spkID)->row();
                $datajobd = $this->Jobdesc_m->getJobdscDByID($rowx->frMar_jobdaDetailID)->row();
                $dataProses = $this->Finalreport_m->getFRDMarByFRIDDesc($rowx->frMarD_frID)->row();
                if($dataProses->status == 'reject'){
                    $xproses = 'reject';
                }else if($dataProses->status == 'success'){
                    $xproses = 'success';
                }else{
                    $xproses = 'proses';
                }
                $arrayData[] = array(
                    'frDetailID'   => $rowx->frMarDetailID,
                    'frID'         => $rowx->frMarD_frID,
                    'frID'         => $rowx->frMarD_frID,
                    'spkID'        => $rowx->frMar_spkID,
                    'spkNo'        => $dataFR->spkNo,
                    'jobdID'       => $rowx->frMar_jobdaDetailID,
                    'jobdNo'       => $datajobd->jobdApprovNo,
                    'orderID'      => $rowx->frMar_orderID,
                    'status'       => $rowx->status,
                    'statusProses' => $xproses,
                    'pengirim'     => $rowx->frMarD_pengirimID,
                    'penerima'     => $rowx->frMarD_penerimaID,
                    'waktu'        => $rowx->waktu
                );
            }
        }

        echo json_encode($arrayData);
    }


    public function detailDataInvoicingIDMarine($id){
        $frID = array();
        $bidangID = $this->fungsi->petugas_login()->bidangID;

        $data['row'] = $this->Finalreport_m->getFRDMarByFRID($id)->row();
        $dataFRID = $this->Finalreport_m->getFRDMarByFRID($id)->result();
        foreach($dataFRID as $row){
            $frID[] = $row->frMarDetailID;
        }
        $invID = $this->InvoicingApproval_m->getInvMarByFRID($frID)->row();
        $data['rowInvID'] = $invID;
        if($invID != null){
            $data['rowInv'] = $this->InvoicingApproval_m->getInvDMarByInvID($invID->invMarID)->row();
        }

        $data['rowSpk'] = $this->Spk_m->getSpkByID($data['row']->frMar_spkID)->row();


        $this->load->view('petugas/Invoicing/invoicing_marine_detail', $data);       
    }



    public function getDataInvoicingFRDMarine(){
        $array = array();
        $frID = $this->input->get('frID');
        // $frID ="FRDMAR2012200001";
        $petugas = $this->fungsi->petugas_login()->subbidangID;

        $data = $this->Finalreport_m->getFRDMarByPetugasIDDesc($petugas, $frID)->result();
        foreach($data as $row){
            $id = $row->frMarD_frID;
            if ($frID == $id){
                $array[] = array(
                    'frDetailID' => $row->frMarDetailID,
                    'frID'       => $row->frMarD_frID,
                    'spkID'      => $row->frMar_spkID,
                    'jobID'      => $row->frMar_jobdaDetailID,
                    'status'     => $row->status,
                    'pengirim'   => $row->frMarD_pengirimID,
                    'penerima'   => $row->frMarD_penerimaID,
                    'waktu'      => $row->waktu
                );
            }else{
            }
        
        }
        echo json_encode($array);
    }

    public function getCheckAll(){
        $array = array();
        $frID = $this->input->get('frID');
        $data = $this->Finalreport_m->getFRDMarByFRIDDesc($frID)->row();
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
        echo json_encode($array);
    }

    public function getCheckAllMin(){
        $array = array();
        $frID = $this->input->get('frID');
        // $frID = "FRDMIN2012210001";
        $data = $this->Finalreport_m->getFRDMinByFRIDDesc($frID)->row();
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
        echo json_encode($array);
    }


    //////////////////////////////////////////////////////////////////////
    public function getDetailDataInvoicingMarine(){
        $array   = array();
        $frID    = $this->input->get('id');

        // $invID = "INVMAR2012130001";
        $petugas = $this->fungsi->petugas_login()->subbidangID;
        $data    = $this->InvoicingApproval_m->getInvDMarByPetugasIDDesc($petugas)->result();
        foreach($data as $row){
            $id = $row->invMarD_invID;
            
            if($frID = $id){
                
                $array[] = array(
                    'invDetailID' => $row->invMarDetailID,
                    'invID'       => $row->invMarD_invID,
                    'orderID'     => $row->invMar_orderID,
                    'status'      => $row->status,
                    'pengirim'    => $row->invMarD_pengirimID,
                    'penerima'    => $row->invMarD_penerimaID,
                    'waktu'       => $row->waktu
                );
            }else{
                
            }
        
        }
        echo json_encode($array);
    }


    /////////////////////////Marine FM///////////////////////////////////
    public function getDetailDataInvoicingMarineFM(){
        $array   = array();
        $invID    = $this->input->get('id');
        // $invID = "INVMAR2012130001";
        $petugas = $this->fungsi->petugas_login()->subbidangID;
        $data    = $this->InvoicingApproval_m->getInvDMarByPetugasID($petugas)->result();
        foreach($data as $row){
            if($invID == $row->invMarD_invID){
                $array[] = array(
                    'invDetailID' => $row->invMarDetailID,
                    'invID'       => $row->invMarD_invID,
                    'orderID'     => $row->invMar_orderID,
                    'status'      => $row->status,
                    'pengirim'    => $row->invMarD_pengirimID,
                    'penerima'    => $row->invMarD_penerimaID,
                    'waktu'       => $row->waktu
                );
            }else{
            }
        
        }
        echo json_encode($array);
    }
    public function viewDataInvoicingMarineFM(){
        $this->load->view('petugas/Invoicing/invoicing_marine_dataFM');
    }

    public function getDataInvoicingMarine(){
        $array = array();
        $bidangID = $this->fungsi->petugas_login()->bidangID;
        $petugas = $this->fungsi->petugas_login()->subbidangID;
        $rowDesc = $this->InvoicingApproval_m->getInvDMarMaxByPetugasID($petugas)->row();
        $data = $this->InvoicingApproval_m->getInvDMarByID($rowDesc->invMarDetailID)->result();
        foreach($data as $row){
            $dataProses = $this->InvoicingApproval_m->getInvDMarByInvIDDesc($row->invMarD_invID)->row();
            $dataInv = $this->InvoicingApproval_m->getInvMarByID($row->invMarD_invID)->row();
            if($dataProses->status == 'reject'){
                $xproses = 'reject';
            }else if($dataProses->status == 'success'){
                $xproses = 'success';
            }else{
                $xproses = 'proses';
            }
            $array[] = array(
                'invDetailID' => $row->invMarDetailID,
                'invID'   => $row->invMarD_invID,
                'invNo'   => $row->invMarNo,
                'orderID'    => $row->invMar_orderID,
                'spkID'       => $dataInv->invMar_spkID,
                'spkNo'       => $dataInv->spkNo,
                'jobdescNo'    => $dataInv->spk_jobdaDetailID,
                'status'     => $row->status,
                'statusProses' => $xproses,
                'pengirim'   => $row->invMarD_pengirimID,
                'penerima'   => $row->invMarD_penerimaID,
                'waktu'      => $row->waktu
            );
        }

        echo json_encode($array);
    }

    public function detailInvFMMarineNo($id){
        $data['row'] = $this->InvoicingApproval_m->getInvMarByNo($id)->row();
        $this->load->view('petugas/Invoicing/invoicing_marine_dataFMID', $data); 
        
    }

    public function getDataInvoicingDetailMarine(){
        $invID      = $this->input->get('id');
        $array = array();
        $bidangID = $this->fungsi->petugas_login()->bidangID;
        $petugas = $this->fungsi->petugas_login()->subbidangID;
        $rowDesc = $this->InvoicingApproval_m->getInvDMarMaxByPetugasID($petugas)->row();
        $data = $this->InvoicingApproval_m->getInvDMarByID($rowDesc->invMarDetailID)->result();
        foreach($data as $row){
            if($invID == $row->invMarD_invID){
                $dataProses = $this->InvoicingApproval_m->getInvDMarByInvIDDesc($row->invMarD_invID)->row();
                $dataInv = $this->InvoicingApproval_m->getInvMarByID($row->invMarD_invID)->row();
                if($dataProses->status == 'reject'){
                    $xproses = 'reject';
                }else if($dataProses->status == 'success'){
                    $xproses = 'success';
                }else{
                    $xproses = 'proses';
                }
                $array[] = array(
                    'invDetailID' => $row->invMarDetailID,
                    'invID'   => $row->invMarD_invID,
                    'invNo'   => $row->invMarNo,
                    'orderID'    => $row->invMar_orderID,
                    'spkID'       => $dataInv->invMar_spkID,
                    'spkNo'       => $dataInv->spkNo,
                    'jobdescNo'    => $dataInv->spk_jobdaDetailID,
                    'status'     => $row->status,
                    'statusProses' => $xproses,
                    'pengirim'   => $row->invMarD_pengirimID,
                    'penerima'   => $row->invMarD_penerimaID,
                    'waktu'      => $row->waktu
                );
            }
            
        }

        echo json_encode($array);
    }

    public function detailInvFMMarine($id){
        $data['rowInv'] = $this->InvoicingApproval_m->getInvDMarByInvID($id)->row();
        $data['rowFR'] = $this->Finalreport_m->getFRDMarByIDDesc($data['rowInv']->invMar_frDetailID)->row();
        $data['rowSPK'] = $this->Spk_m->getSpkByID($data['rowInv']->invMar_spkID)->row();
        $data['rowJOBDesc'] = $this->Jobdesc_m->getJobdscDByID($data['rowInv']->invMar_jobdaDetailID)->row();
        $this->load->view('petugas/Invoicing/invoicing_marine_detailFM', $data); 
        
    }


    ///////////////////////////MINERBA//////////////////////////////////
    
    public function getDataINVFRMinerba(){
        $petugas   = $this->fungsi->petugas_login()->subbidangID;
        $id        = array();
        $arrayData = array();
        $xproses   = array();
        $spkID    = array();

        $data1 = $this->Finalreport_m->getFRMinAll()->result(); 
        foreach($data1 as $row1){
            $spkID[] = $row1->frMin_spkID;
        }

        $data2 = $this->Finalreport_m->getFRMinMaxBySpkID($spkID)->result();
        foreach($data2 as $row2){
            $frID[] = $row2->frMinID;
        }
        $data3 = $this->Finalreport_m->getFRMinByID($frID)->result();
        foreach($data3 as $row3){
            $frIDx[] = $row3->frMinID;
        }


        $data4 = $this->Finalreport_m->getFRDMinMaxByPetugasID($petugas)->result();
        foreach($data4 as $row){
            $id[] = $row->frMinDetailID;
        }

        $dataFRDetail = $this->Finalreport_m->getFRDMinByID($id)->result();
        foreach($dataFRDetail as $rowx){
            if(in_array($rowx->frMinD_frID, $frIDx)){
                $dataFR = $this->Finalreport_m->getFRMinBySpkID($rowx->frMin_spkID)->row();
                $datajobd = $this->Jobdesc_m->getJobdscDByID($rowx->frMin_jobdaDetailID)->row();
                $dataProses = $this->Finalreport_m->getFRDMinByFRIDDesc($rowx->frMinD_frID)->row();
                if($dataProses->status == 'reject'){
                    $xproses = 'reject';
                }else if($dataProses->status == 'success'){
                    $xproses = 'success';
                }else{
                    $xproses = 'proses';
                }
                $arrayData[] = array(
                    'frDetailID'   => $rowx->frMinDetailID,
                    'frID'         => $rowx->frMinD_frID,
                    'spkID'        => $rowx->frMin_spkID,
                    'spkNo'        => $dataFR->spkNo,
                    'jobdID'       => $rowx->frMin_jobdaDetailID,
                    'jobdNo'       => $datajobd->jobdApprovNo,
                    'orderID'      => $rowx->frMin_orderID,
                    'status'       => $rowx->status,
                    'statusProses' => $xproses,
                    'pengirim'     => $rowx->frMinD_pengirimID,
                    'penerima'     => $rowx->frMinD_penerimaID,
                    'waktu'        => $rowx->waktu
                );
            }
        }

        echo json_encode($arrayData);
    }

   



    public function viewDataInvoiceSpkIDMinerba($id){
        $data['row'] = $this->Finalreport_m->getFRMinBySpkID($id)->row();
        $this->load->view('petugas/Invoicing/invoicing_minerba_dataID', $data);
    }

    public function getDataInvoicingIDMinerba(){
        $spkIDx      = $this->input->get('id');
        $petugas   = $this->fungsi->petugas_login()->subbidangID;
        $id        = array();
        $arrayData = array();
        $xproses   = array();
        
        $data = $this->Finalreport_m->getFRDMinMaxByPetugasID($petugas)->result();
        foreach($data as $row){
            $id[] = $row->frMinDetailID;
        }

        $dataFRDetail = $this->Finalreport_m->getFRDMinByID($id)->result();
        foreach($dataFRDetail as $rowx){
            if($rowx->frMin_spkID == $spkIDx){
                $dataFR = $this->Finalreport_m->getFRMinBySpkID($rowx->frMin_spkID)->row();
                $datajobd = $this->Jobdesc_m->getJobdscDByID($rowx->frMin_jobdaDetailID)->row();
                $dataProses = $this->Finalreport_m->getFRDMinByFRIDDesc($rowx->frMinD_frID)->row();
                if($dataProses->status == 'reject'){
                    $xproses = 'reject';
                }else if($dataProses->status == 'success'){
                    $xproses = 'success';
                }else{
                    $xproses = 'proses';
                }
                $arrayData[] = array(
                    'frDetailID'   => $rowx->frMinDetailID,
                    'frID'         => $rowx->frMinD_frID,
                    'spkID'        => $rowx->frMin_spkID,
                    'spkNo'        => $dataFR->spkNo,
                    'jobdID'       => $rowx->frMin_jobdaDetailID,
                    'jobdNo'       => $datajobd->jobdApprovNo,
                    'orderID'      => $rowx->frMin_orderID,
                    'status'       => $rowx->status,
                    'statusProses' => $xproses,
                    'pengirim'     => $rowx->frMinD_pengirimID,
                    'penerima'     => $rowx->frMinD_penerimaID,
                    'waktu'        => $rowx->waktu
                );
            }
        }

        echo json_encode($arrayData);
    }

    public function detailDataInvoicingIDMinerba($id){
        $frID = array();
        $bidangID = $this->fungsi->petugas_login()->bidangID;

        $data['row'] = $this->Finalreport_m->getFRDMinByFRID($id)->row();
        $dataFRID = $this->Finalreport_m->getFRDMinByFRID($id)->result();
        foreach($dataFRID as $row){
            $frID[] = $row->frMinDetailID;
        }
        $invID = $this->InvoicingApproval_m->getInvMinByFRID($frID)->row();
        $data['rowInvID'] = $invID;
        if($invID != null){
            $data['rowInv'] = $this->InvoicingApproval_m->getInvDMinByInvID($invID->invMinID)->row();
        }
        $data['rowSpk'] = $this->Spk_m->getSpkByID($data['row']->frMin_spkID)->row();
        $this->load->view('petugas/Invoicing/invoicing_minerba_detail', $data); 
        // echo json_encode($data);
       
    }


    public function getDataInvoicingFRDMinerba(){
        $array = array();
        $frID = $this->input->get('frID');
        $petugas = $this->fungsi->petugas_login()->subbidangID;

        $data = $this->Finalreport_m->getFRDMinByPetugasIDDesc($petugas, $frID)->result();
        foreach($data as $row){
            $id = $row->frMinD_frID;
            if ($frID == $id){
                $dataSPK = $this->Spk_m->getSpkByID($row->frMin_spkID)->row();
                $dataJobDesc = $this->Jobdesc_m->getJobdscDByDetailIDDesc($row->frMin_jobdaDetailID)->row();
                $array[] = array(
                    'frDetailID' => $row->frMinDetailID,
                    'frID'       => $row->frMinD_frID,
                    'spkID'      => $row->frMin_spkID,
                    'spkNo'      => $dataSPK->spkNo,
                    'jobID'      => $row->frMin_jobdaDetailID,
                    'jobNo'      => $dataJobDesc->jobdApprovNo,
                    'status'     => $row->status,
                    'pengirim'   => $row->frMinD_pengirimID,
                    'penerima'   => $row->frMinD_penerimaID,
                    'waktu'      => $row->waktu
                );
            }else{
            }
        
        }
        echo json_encode($array);
    }

    //////////////////////////////////////////////////////////////////////
    public function getDetailDataInvoicingMinerba(){
        $array   = array();
        $frID    = $this->input->get('invID');
        // $frID = "INVMIN2012130001";
        $petugas = $this->fungsi->petugas_login()->subbidangID;
        $data    = $this->InvoicingApproval_m->getInvDMinByPetugasID($petugas)->result();
        foreach($data as $row){
            $id = $row->invMinD_invID;
            if ($frID == $id){
                $array[] = array(
                    'invDetailID' => $row->invMinDetailID,
                    'invID'       => $row->invMinD_invID,
                    'orderID'     => $row->invMin_orderID,
                    'status'      => $row->status,
                    'pengirim'    => $row->invMinD_pengirimID,
                    'penerima'    => $row->invMinD_penerimaID,
                    'waktu'       => $row->waktu
                );
            }else{
            }
        
        }
        echo json_encode($array);
    }

     

    
  
    /////////////////////////////////FM//////////////////////////////
    ///////////////////////////Marine///////////////////////////////
    


    // //////////////////////////////Minerba///////////////////////////////

    // public function viewDataInvoicingMinerba(){
    //     $this->load->view('petugas/Invoicing/invoicing_minerba_dataFM');
    // }

    // public function detailInvFMMinerba($id){
    //     $data['row'] = $this->Finalreport_m->getFRDMarByFRID($id)->row();
    //     $this->load->view('petugas/Invoicing/invoicing_minerba_detailFM', $data); 
        
    // }


  

   
}

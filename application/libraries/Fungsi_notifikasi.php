<?php

Class Fungsi_notifikasi {
    protected $ci;
    var $pengirim;
    var $subbidangID;
    var $jumlah;

    function __construct(){
        $this->ci =& get_instance();
    }

  

    function notif_projectclient(){
        $this->ci->load->model(['ClientProject_m', 'Petugas_m']);
        $petugas_id = $this->ci->session->userdata('petugasID');
        $petugas_data = $this->ci->Petugas_m->getAll($petugas_id)->row();
        $notif = $this->ci->ClientProject_m->getAllNotif($petugas_data->bidangID);
        $jumlah = $notif->num_rows();
        return $jumlah;
    }

    function notif_quotationnew(){
        $this->ci->load->model(['Quotation_m', 'Petugas_m']);
        $arrayData = array();
        $petugas_id = $this->ci->session->userdata('petugasID');
        $petugas_data = $this->ci->Petugas_m->getAll($petugas_id)->row();
        $notif = $this->ci->Quotation_m->getQuoDNotifNew($petugas_data->subbidangID);
        $jumlah= $notif->num_rows();
        return $jumlah;
    }

    function notif_quotationnewFailed(){
        $this->ci->load->model(['Quotation_m', 'Petugas_m']);
        $arrayData = array();
        $petugas_id = $this->ci->session->userdata('petugasID');
        $petugas_data = $this->ci->Petugas_m->getAll($petugas_id)->row();
        $notif = $this->ci->Quotation_m->getQuoDNotifNewFailed($petugas_data->subbidangID);
        $jumlah= $notif->num_rows();
        return $jumlah;
    }

    function notif_jobdesc(){
        $this->ci->load->model(['Jobdesc_m', 'Petugas_m']);
        $arrayData = array();
        $petugas_id = $this->ci->session->userdata('petugasID');
        $petugas_data = $this->ci->Petugas_m->getAll($petugas_id)->row();
        $notif = $this->ci->Jobdesc_m->getJobdscDNotifNew($petugas_data->subbidangID);
        $jumlah= $notif->num_rows();
        return $jumlah;
    }

    function notif_spk(){
        $this->ci->load->model(['Spk_m', 'Petugas_m']);
        $arrayData = array();
        $petugas_id = $this->ci->session->userdata('petugasID');
        $petugas_data = $this->ci->Petugas_m->getAll($petugas_id)->row();
        $notif = $this->ci->Spk_m->getSpkNotifNew($petugas_data->bidangID);
        $jumlah= $notif->num_rows();
        return $jumlah;
    }

    function notif_frMarNew(){
        $this->ci->load->model(['Finalreport_m', 'Petugas_m']);
        $arrayData = array();
        $petugas_id = $this->ci->session->userdata('petugasID');
        $petugas_data = $this->ci->Petugas_m->getAll($petugas_id)->row();
        $notif = $this->ci->Finalreport_m->getFRDMarNotifNew($petugas_data->subbidangID);
        $jumlah= $notif->num_rows();
        return $jumlah;
    }

    function notif_frMarFailed(){
        $this->ci->load->model(['Finalreport_m', 'Petugas_m']);
        $arrayData = array();
        $petugas_id = $this->ci->session->userdata('petugasID');
        $petugas_data = $this->ci->Petugas_m->getAll($petugas_id)->row();
        $notif = $this->ci->Finalreport_m->getFRDMarNotifNewFailed($petugas_data->subbidangID);
        $jumlah= $notif->num_rows();
        return $jumlah;
    }

    function notif_frMinNew(){
        $this->ci->load->model(['Finalreport_m', 'Petugas_m']);
        $arrayData = array();
        $petugas_id = $this->ci->session->userdata('petugasID');
        $petugas_data = $this->ci->Petugas_m->getAll($petugas_id)->row();
        $notif = $this->ci->Finalreport_m->getFRDMinNotifNew($petugas_data->subbidangID);
        $jumlah= $notif->num_rows();
        return $jumlah;
    }

    function notif_frMinFailed(){
        $this->ci->load->model(['Finalreport_m', 'Petugas_m']);
        $arrayData = array();
        $petugas_id = $this->ci->session->userdata('petugasID');
        $petugas_data = $this->ci->Petugas_m->getAll($petugas_id)->row();
        $notif = $this->ci->Finalreport_m->getFRDMinNotifNewFailed($petugas_data->subbidangID);
        $jumlah= $notif->num_rows();
        return $jumlah;
    }

    function notif_InvMarNew(){
        $this->ci->load->model(['InvoicingApproval_m', 'Petugas_m']);
        $arrayData = array();
        $petugas_id = $this->ci->session->userdata('petugasID');
        $petugas_data = $this->ci->Petugas_m->getAll($petugas_id)->row();
        $notif = $this->ci->InvoicingApproval_m->getInvDMarNotifNew($petugas_data->subbidangID);
        $jumlah= $notif->num_rows();
        return $jumlah;
    }

    function notif_InvMarFailed(){
        $this->ci->load->model(['InvoicingApproval_m', 'Petugas_m']);
        $arrayData = array();
        $petugas_id = $this->ci->session->userdata('petugasID');
        $petugas_data = $this->ci->Petugas_m->getAll($petugas_id)->row();
        $notif = $this->ci->InvoicingApproval_m->getInvDMarNotifNewFailed($petugas_data->subbidangID);
        $jumlah= $notif->num_rows();
        return $jumlah;
    }

    function notif_InvMinNew(){
        $this->ci->load->model(['InvoicingApproval_m', 'Petugas_m']);
        $arrayData = array();
        $petugas_id = $this->ci->session->userdata('petugasID');
        $petugas_data = $this->ci->Petugas_m->getAll($petugas_id)->row();
        $notif = $this->ci->InvoicingApproval_m->getInvDMinNotifNew($petugas_data->subbidangID);
        $jumlah= $notif->num_rows();
        return $jumlah;
    }
    
    

    function notif_InvMinFailed(){
        $this->ci->load->model(['InvoicingApproval_m', 'Petugas_m']);
        $arrayData = array();
        $petugas_id = $this->ci->session->userdata('petugasID');
        $petugas_data = $this->ci->Petugas_m->getAll($petugas_id)->row();
        $notif = $this->ci->InvoicingApproval_m->getInvDMinNotifNewFailed($petugas_data->subbidangID);
        $jumlah= $notif->num_rows();
        return $jumlah;
    }


    function notif_clientFinalProjectNewMarine(){
        $this->ci->load->model(['Client_m', 'InvoiceFinalClient_m']);
        $arrayData = array();
        $client_id = $this->ci->session->userdata('clientID');
        $client_data = $this->ci->Client_m->get($client_id)->row();
        $notif = $this->ci->InvoiceFinalClient_m->getAllNotifMarine($client_data->clientID);
        $jumlah= $notif->num_rows();
        return $jumlah;
    }

    function notif_clientFinalProjectNewMinerba(){
        $this->ci->load->model(['Client_m', 'InvoiceFinalClient_m']);
        $arrayData = array();
        $client_id = $this->ci->session->userdata('clientID');
        $client_data = $this->ci->Client_m->get($client_id)->row();
        $notif = $this->ci->InvoiceFinalClient_m->getAllNotifMinerba($client_data->clientID);
        $jumlah= $notif->num_rows();
        return $jumlah;
    }

    




    

    

    

   

    
    
   

  



 


}
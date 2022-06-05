<?php

class InvoiceFinalClient_m extends CI_Model{

    public function getAllMarine(){
        $this->db->from('tb_marine_inv_finalclient');
        $query = $this->db->get();
        return $query;
    }

    public function getMarineAllMax(){
        $this->db->select_max('invMarFinalID');
        $this->db->from('tb_marine_inv_finalclient');
        $query = $this->db->get();
        return $query;
    }

    public function getAllMarineByclientProjectID($id){
        $this->db->from('tb_marine_inv_finalclient');
        $this->db->where('invMarF_clientProjectID', $id);
        $this->db->join('tb_marine_inv_draftdetail', 'tb_marine_inv_draftdetail.invMarDetailID = tb_marine_inv_finalclient.invMarF_invMarDetailID');
        $this->db->join('tb_quotationdetail', 'tb_quotationdetail.quoDetailID = tb_marine_inv_finalclient.invMarF_quoDetailID');
        $this->db->join('tb_jobd_approvaldetail', 'tb_jobd_approvaldetail.jobdaDetailID = tb_marine_inv_finalclient.invMarF_jobdaDetailID');
        $this->db->join('tb_spk', 'tb_spk.spkID = tb_marine_inv_finalclient.invMarF_spkID');
        $this->db->join('tb_marine_finalreportdetail', 'tb_marine_finalreportdetail.frMarDetailID = tb_marine_inv_finalclient.invMarF_frMarDetailID');
        $query = $this->db->get();
        return $query;
    }

    public function getAllNewMarine($id){
        $this->db->from('tb_marine_inv_finalclient');
        $this->db->where('invMarF_clientID', $id);
        $this->db->where('invMarStatusKonf', 'send');
        $this->db->join('tb_marine_inv_draftdetail', 'tb_marine_inv_draftdetail.invMarDetailID = tb_marine_inv_finalclient.invMarF_invMarDetailID');
        // $this->db->join('tb_quotationdetail', 'tb_quotationdetail.quoDetailID = tb_marine_inv_finalclient.invMarF_quoDetailID');
        // $this->db->join('tb_jobd_approvaldetail', 'tb_jobd_approvaldetail.jobdaDetailID = tb_marine_inv_finalclient.invMarF_jobdaDetailID');
        // $this->db->join('tb_spk', 'tb_spk.spkID = tb_marine_inv_finalclient.invMarF_spkID');
        // $this->db->join('tb_marine_finalreportdetail', 'tb_marine_finalreportdetail.frMarDetailID = tb_marine_inv_finalclient.invMarF_frMarDetailID');
        $query = $this->db->get();
        return $query;
    }

    public function addMarine($post){  
        $params = array(
            'invMarFinalID'             => $post['id'],
            'invMarF_clientProjectID'   => $post['clientProjectID'],
            'invMarF_clientID'          => $post['clientID'],
            'invMarF_invMarDetailID'    => $post['invDetailID'],
            'invMarF_frMarDetailID'     => $post['frDetailID'],
            'invMarF_spkID'             => $post['spkID'],
            'invMarF_jobdaDetailID'     => $post['jobdaDetailID'],
            'invMarF_quoDetailID'       => $post['quoDetailID'],
            'invMarF_orderID'           => $post['orderID'],
            'invMarF_petugasID'         => $post['petugasID'],
            'invMarF_bidangID'          => $post['bidangID'],
            'invMarF_statusID'          => $post['statusID'],
            'invMarStatusKonf'          => $post['statusKonf'],
            'invMarComment'             => $post['comment'],
        );     
        $query = $this->db->insert('tb_marine_inv_finalclient', $params);
        return $query;
    }

    //Merubah data FR Detail Marine status Konfirmasi dan menambahkan waktu start dan waktu End 
    public function setMarStatusKonf($post){
        $data = array(
            'invMarStatusKonf'   => $post['statusConf'],  
        );
        $this->db->where('invMarFinalID', $post['invMarFinalID']);
        $query = $this->db->update('tb_marine_inv_finalclient',$data);
    }

    public function getAllNotifMarine($client){
        $this->db->from('tb_marine_inv_finalclient');
        $this->db->where('invMarF_clientID', $client);
        $this->db->where('invMarStatusKonf', 'send');
        $query = $this->db->get();
        return $query;
    }


////////////////////////////////Minerba//////////////////////////////////////////////////


    public function getAllMinerba(){
        $this->db->from('tb_marine_inv_finalclient');
        $query = $this->db->get();
        return $query;
    }

    public function getMinerbaAllMax(){
        $this->db->select_max('invMinFinalID');
        $this->db->from('tb_minerba_inv_finalclient');
        $query = $this->db->get();
        return $query;
    }

    public function getAllMinerbaByclientProjectID($id){
        $this->db->from('tb_minerba_inv_finalclient');
        $this->db->where('invMinF_clientProjectID', $id);
        $this->db->join('tb_minerba_inv_draftdetail', 'tb_minerba_inv_draftdetail.invMinDetailID = tb_minerba_inv_finalclient.invMinF_invMinDetailID');
        $this->db->join('tb_quotationdetail', 'tb_quotationdetail.quoDetailID = tb_minerba_inv_finalclient.invMinF_quoDetailID');
        $this->db->join('tb_jobd_approvaldetail', 'tb_jobd_approvaldetail.jobdaDetailID = tb_minerba_inv_finalclient.invMinF_jobdaDetailID');
        $this->db->join('tb_spk', 'tb_spk.spkID = tb_minerba_inv_finalclient.invMinF_spkID');
        $this->db->join('tb_minerba_finalreportdetail', 'tb_minerba_finalreportdetail.frMinDetailID = tb_minerba_inv_finalclient.invMinF_frMinDetailID');
        $query = $this->db->get();
        return $query;
    }

    public function getAllNewMinerba($id){
        $this->db->from('tb_minerba_inv_finalclient');
        $this->db->where('invMinF_clientID', $id);
        $this->db->where('invMinFStatusKonf', 'send');
        $this->db->join('tb_minerba_inv_draftdetail', 'tb_minerba_inv_draftdetail.invMinDetailID = tb_minerba_inv_finalclient.invMinF_invMinDetailID');
        $this->db->join('tb_quotationdetail', 'tb_quotationdetail.quoDetailID = tb_minerba_inv_finalclient.invMinF_quoDetailID');
        $this->db->join('tb_jobd_approvaldetail', 'tb_jobd_approvaldetail.jobdaDetailID = tb_minerba_inv_finalclient.invMinF_jobdaDetailID');
        $this->db->join('tb_spk', 'tb_spk.spkID = tb_minerba_inv_finalclient.invMinF_spkID');
        $this->db->join('tb_minerba_finalreportdetail', 'tb_minerba_finalreportdetail.frMinDetailID = tb_minerba_inv_finalclient.invMinF_frMinDetailID');
        $query = $this->db->get();
        return $query;
    }



    public function addMinerba($post){
        $params = array(
            'invMinFinalID'             => $post['id'],
            'invMinF_clientProjectID'   => $post['clientProjectID'],
            'invMinF_clientID'          => $post['clientID'],
            'invMinF_invMinDetailID'    => $post['invDetailID'],
            'invMinF_frMinDetailID'     => $post['frDetailID'],
            'invMinF_spkID'             => $post['spkID'],
            'invMinF_jobdaDetailID'     => $post['jobdaDetailID'],
            'invMinF_quoDetailID'       => $post['quoDetailID'],
            'invMinF_orderID'           => $post['orderID'],
            'invMinF_petugasID'         => $post['petugasID'],
            'invMinF_bidangID'          => $post['bidangID'],
            'invMinF_statusID'          => $post['statusID'],
            'invMinFStatusKonf'         => $post['statusKonf'],
            'invMinFComment'            => $post['comment'],
        );     
        $query = $this->db->insert('tb_minerba_inv_finalclient', $params);
        return $query;
    }


    //Merubah data FR Detail Marine status Konfirmasi dan menambahkan waktu start dan waktu End 
    public function setMinStatusKonf($post){
        $data = array(
            'invMinFStatusKonf'   => $post['statusConf'],  
        );
        $this->db->where('invMinFinalID', $post['invMinFinalID']);
        $query = $this->db->update('tb_minerba_inv_finalclient',$data);
    }

    public function getAllNotifMinerba($client){
        $this->db->from('tb_minerba_inv_finalclient');
        $this->db->where('invMinF_clientID', $client);
        $this->db->where('invMinFStatusKonf', 'send');
        $query = $this->db->get();
        return $query;
    }

    


    


}
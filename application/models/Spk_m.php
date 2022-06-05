<?php

class Spk_m extends CI_Model{

////////////////////////////////////////////////////////////////////////////////

    public function getSpkByID($id){
        $this->db->from('tb_spk');
        $this->db->where('spkID', $id);
        $this->db->join('tb_bidang', 'tb_bidang.bidangID = tb_spk.spk_bidangID');
        $this->db->join('tb_petugas', 'tb_petugas.petugasID = tb_spk.spk_petugasID');
        $this->db->join('tb_jobd_approvaldetail', 'tb_jobd_approvaldetail.jobdaDetailID = tb_spk.spk_jobdaDetailID');
        $this->db->join('tb_status', 'tb_status.statusID = tb_spk.spk_statusID');
        $query = $this->db->get();
        return $query;
    }
////////////////////////////////////////////////////////////////////////////////

////////////////////////////////////////////////////////////////////////////////

    public function getSpkByQuoDID($id){
        $this->db->from('tb_spk');
        $this->db->where_in('spk_quoDetailID', $id);
        $this->db->join('tb_bidang', 'tb_bidang.bidangID = tb_spk.spk_bidangID');
        $this->db->join('tb_petugas', 'tb_petugas.petugasID = tb_spk.spk_petugasID');
        $query = $this->db->get();
        return $query;
    }
////////////////////////////////////////////////////////////////////////////////

////////////////////////////////////////////////////////////////////////////////


    public function getSpkNotifNew($bidangID){
        $this->db->from('tb_spk');
        $this->db->where('spk_bidangID', $bidangID);
        $this->db->where('statusKonfirmasi', 'send');
        $query = $this->db->get();
        return $query;
    }
////////////////////////////////////////////////////////////////////////////////

////////////////////////////////////////////////////////////////////////////////

    public function getSpkByBidangID($post){
        $this->db->from('tb_spk');
        $this->db->where('spk_bidangID', $post['bidangID']);
        $this->db->join('tb_bidang', 'tb_bidang.bidangID = tb_spk.spk_bidangID');
        $this->db->join('tb_petugas', 'tb_petugas.petugasID = tb_spk.spk_petugasID');
        $this->db->join('tb_status', 'tb_status.statusID = tb_spk.spk_statusID');
        $query = $this->db->get();
        return $query;
    }
////////////////////////////////////////////////////////////////////////////////

////////////////////////////////////////////////////////////////////////////////
    //Menampilkan quoID yang paling besar
    public function getSpkMaxByBidang($bidang){
        $this->db->select_max('spkID');
        $this->db->from('tb_spk');
        $this->db->like('spkID', $bidang, 'both'); 
        $query = $this->db->get();
        return $query;
    }
////////////////////////////////////////////////////////////////////////////////

////////////////////////////////////////////////////////////////////////////////  

    public function addSpk($post){
        $params = array(
            'spkID'                 => $post['id'],
            'spkNo'                 => $post['spkNo'],
            'spk_jobdaDetailID'     => $post['jobdaDetailID'],
            'spk_orderID'           => $post['orderID'],
            'spk_quoDetailID'       => $post['quoDetailID'],
            'spk_petugasID'         => $post['petugasID'],
            'spk_bidangID'          => $post['bidangID'],
            'spk_statusID'          => $post['statusID'],
            'fileSpk'               => $post['fileSpk'],
            'fileBiayaSurvey'       => $post['filebiayasurvey'],
            'statusKonfirmasi'      => $post['statusKonf'],
        );
        $query = $this->db->insert('tb_spk', $params);
        return $query;
    }


////////////////////////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////////////////////// 
  
    public function setSpkStatus($post){
        $params = array(     
            'spk_statusID'          => $post['status'],
        );
        $this->db->where('spkID', $post['spkID']);
        $query = $this->db->update('tb_spk', $params);
        return $query;
    }

////////////////////////////////////////////////////////////////////////////////


}
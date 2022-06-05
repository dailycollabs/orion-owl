<?php

class Subbidang_m extends CI_Model{
    
    public function get($id = null){
        $this->db->from('tb_subbidang');
        if($id != null){
            $this->db->where('subbidangID', $id);
        }
        $query = $this->db->get();
        return $query;
    }

    public function getAll($id = null){
        $this->db->from('tb_subbidang');
        if($id != null){
            $this->db->where('subbidangID', $id);
        }
        $this->db->join('tb_bidang', 'tb_bidang.bidangID = tb_subbidang.bidangID');
        $query = $this->db->get();
        return $query;
    }


    public function addSubbidang($post){
        $params = array(     
            'subbidangID'  => $post['subbidangID'],
            'subbidangNama' => $post['subbidang'],
            'bidangID' => $post['bidang'],
            'subidangrules' => $post['subbidangRule']
        );
        $query = $this->db->insert('tb_subbidang', $params);
        return $query;
    }

    public function editSubbidang($post){
        $params = array(     
            'subbidangNama' => $post['editsubbidangNama'],
            'bidangID' => $post['editbidang'],
            'subidangrules' => $post['editsubbidangRule']
        );
        $this->db->where('subbidangID', $post['editsubbidangID']);
        $query = $this->db->update('tb_subbidang',$params);
        return $query;
    }

    public function deleteSubbidang($id){
        $this->db->where('subbidangID', $id);
        $query = $this->db->delete('tb_subbidang');
        return $query;
    }

    public function getSubbidang($bidangID){
        $this->db->from('tb_subbidang');
        $this->db->where('bidangID', $bidangID);
        $query = $this->db->get();
        return $query;
    }

}
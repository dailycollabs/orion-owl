<?php

class Bidang_m extends CI_Model{
    
    public function get($id = null){
        $this->db->from('tb_bidang');
        if($id != null){
            $this->db->where('bidangID', $id);
        }
        $query = $this->db->get();
        return $query;
    }

    public function getID($id){
        $this->db->from('tb_bidang');
        $this->db->where('bidangID', $id);
        $query = $this->db->get();
        return $query;
    }

    public function addBidang($bidangNama){
        $params = array(     
            'bidangNama' => $bidangNama
        );
        $query = $this->db->insert('tb_bidang', $params);
        return $query;
    }

    public function editBidang($post){
        $params = array(     
            'bidangNama' => $post['bidangEditNama'],
        );
        $this->db->where('bidangID', $post['bidangEditID']);
        $query = $this->db->update('tb_bidang',$params);
        return $query;
    }

    public function deleteBidang($id){
        $this->db->where('bidangID', $id);
        $query = $this->db->delete('tb_bidang');
        return $query;
    }

}

<?php

class Pengaturan_m extends CI_Model{
    
    public function getAll(){
        $this->db->select('*');
        $this->db->from('tb_pengaturan');
        $query = $this->db->get();
        return $query;
    }
    
    
    // public function getID($id){
    //     $this->db->from('tb_pengaturan');
    //     $this->db->where('pengaturanID', $id);
    //     $query = $this->db->get();
    //     return $query;
    // }

    // public function addWaktu($bidangNama){
    //     $params = array(     
    //         'waktu' => $bidangNama
    //     );
    //     $query = $this->db->insert('tb_pengaturan', $params);
    //     return $query;
    // }

    // public function editWaktu($post){
    //     $params = array(     
    //         'waktu' => $post['waktu'],
    //     );
    //     $this->db->where('pengaturanID', $post['pengaturanEditID']);
    //     $query = $this->db->update('tb_pengaturan',$params);
    //     return $query;
    // }

    // public function deleteWaktu($id){
    //     $this->db->where('pengaturanID', $id);
    //     $query = $this->db->delete('tb_pengaturan');
    //     return $query;
    // }
}

<?php defined('BASEPATH') OR exit('No direct script access allowed');

class petugas_m extends CI_Model {

    public function get($id = null){
        $this->db->from('tb_petugas');
        if($id != null){
            $this->db->where('petugasID', $id);
        }
        $query = $this->db->get();
        return $query;
    }

    public function getAll($id = null){
        
        $this->db->from('tb_petugas');
        if($id != null){
            $this->db->where('petugasID', $id);
        }
        $this->db->join('tb_subbidang', 'tb_subbidang.subbidangID = tb_petugas.subbidangID');
        $query = $this->db->get();
        return $query;
    }

    public function getOrder(){
        
    }

    public function login($post){
        $this->db->select('*');
        $this->db->from('tb_petugas');
        $this->db->where('petugasUsername', $post['username']);
        $this->db->where('petugasPassword', $post['password']);
        $query = $this->db->get();
        return $query;
    }

    public function add($post){
        $data = array(
                'subbidangID'   => $post['subbidang'], 
                'petugasNPWP'          => $post['petugasnpwp'], 
                'petugasNama'          => $post['petugasNama'],
                'petugasUsername'      => $post['petugasUsername'],
                'petugasPassword'      => $post['petugasPassword'],  
                'petugasEmail'         => $post['petugasEmail'],
                'petugasTelepon'     => $post['petugasTelepon'],
                'petugasGender'        => $post['petugasGender'],
                'petugasAlamat'        => $post['petugasAlamat'],
               
            );
        $this->db->insert('tb_petugas',$data);
    }

    public function edit($post){
        $data = array(
                'subbidangID'   => $post['editSubbidang'], 
                'petugasNPWP'          => $post['editpetugasNPWP'], 
                'petugasNama'          => $post['editpetugasNama'], 
                'petugasUsername'      => $post['editpetugasUsername'],
                'petugasEmail'         => $post['editpetugasEmail'],
                'petugasTelepon'     => $post['editpetugasTelepon'],
                'petugasGender'        => $post['editpetugasGender'],
                'petugasAlamat'        => $post['editpetugasAlamat'],
               
            );
            if(!empty($post['editpetugasPassword'])){
                $data['petugasPassword'] = $post['editpetugasPassword'];
            }
        
        $this->db->where('petugasID', $post['editpetugasID']);
        $query = $this->db->update('tb_petugas',$data);
    }

    public function del($id){
        $this->db->where('petugasID', $id);
        $this->db->delete('tb_petugas');
    }
}
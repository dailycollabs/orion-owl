<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Pengelola_m extends CI_Model {

    public function get($id = null){
        $this->db->from('tb_pengelola');
        if($id != null){
            $this->db->where('pengelolaID', $id);
        }
        $query = $this->db->get();
        return $query;
    }

    public function login($post){
        $this->db->select('*');
        $this->db->from('tb_pengelola');
        $this->db->where('pengelolaUsername', $post['username']);
        $this->db->where('pengelolaPassword', $post['password']);
        $query = $this->db->get();
        return $query;
    }

    public function add($post){
        $data = array(
                'pengelolaNama'          => $post['pengelolaNama'],
                'pengelolaUsername'      => $post['pengelolaUsername'],
                'pengelolaPassword'      => $post['pengelolaPassword'],  
                'pengelolaEmail'         => $post['pengelolaEmail'],
                'pengelolaTelepon'       => $post['pengelolaTelepon'],
                'pengelolaGender'        => $post['pengelolaGender'],
                'pengelolaAlamat'        => $post['pengelolaAlamat'],
               
            );
        $this->db->insert('tb_pengelola',$data);
    }

    public function edit($post){
        $data = array(

                'pengelolaNama'          => $post['editpengelolaNama'], 
                'pengelolaUsername'      => $post['editpengelolaUsername'],
                'pengelolaEmail'         => $post['editpengelolaEmail'],
                'pengelolaTelepon'     => $post['editpengelolaTelepon'],
                'pengelolaGender'        => $post['editpengelolaGender'],
                'pengelolaAlamat'        => $post['editpengelolaAlamat'],
               
            );
            if(!empty($post['editpengelolaPassword'])){
                $data['pengelolaPassword'] = $post['editpengelolaPassword'];
            }
        
        $this->db->where('pengelolaID', $post['editpengelolaID']);
        $query = $this->db->update('tb_pengelola',$data);
    }

    public function del($id){
        $this->db->where('pengelolaID', $id);
        $this->db->delete('tb_pengelola');
    }
}
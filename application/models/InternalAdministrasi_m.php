<?php

class InternalAdministrasi_m extends CI_Model{

//Surat Masuk


    public function getAllSuratMasuk(){
        $this->db->select('*');
        $this->db->from('tb_int_administrasi_suratmasuk');
        $this->db->join('tb_petugas', 'tb_petugas.petugasID = tb_int_administrasi_suratmasuk.sm_petugasID');
        $query = $this->db->get();
        return $query;
    }

    public function getAllSuratMasukByPetugasID(){
        $this->db->select('*');
        $this->db->from('tb_int_administrasi_suratmasuk');
        $this->db->where('suratmasukNo', $post['suratmasukNo']);
        $this->db->join('tb_petugas', 'tb_petugas.petugasID = tb_int_administrasi_suratmasuk.sm_petugasID');
        $query = $this->db->get();
        return $query;
    }

    public function getAllSuratMasukID($id){
        $this->db->select('*');
        $this->db->from('tb_int_administrasi_suratmasuk');
        $this->db->where('smID', $id);
        $this->db->join('tb_petugas', 'tb_petugas.petugasID = tb_int_administrasi_suratmasuk.sm_petugasID');
        $query = $this->db->get();
        return $query;
    }


    public function jumlahSuratMasuk($post){
        $this->db->select('*');
        $this->db->from('tb_int_administrasi_suratmasuk');
        $this->db->where('suratmasukNo', $post['suratmasukNo']);
        $this->db->where('sm_pengirimID', $post['pengirimID']);
        $this->db->where('sm_penerimaID', $post['penerimaID']);
        $query = $this->db->get();
        return $query;

    }
    public function statusSuratMasuk($post){
        $this->db->from('tb_int_administrasi_suratmasuk');
        $this->db->where('suratmasukNo', $post['suratmasukNo']);
        $this->db->order_by('waktu', 'DESC');
        $query = $this->db->get();
        return $query;
    }

    public function addSuratMasuk($post){
        $params = array(     
            'suratmasukNo'      => $post['suratmasukNo'],
            'sm_petugasID'      => $post['petugasID'],
            'sm_pengirimID'     => $post['pengirimID'],
            'sm_penerimaID'     => $post['penerimaID'],
            'suratmasukFile'    => $post['smFile'],
            'jumlah'            => $post['jumlah'],
            'sm_statusID'       => $post['status'],
            'statusKonfirmasi'  => $post['statuskonf'],  
        );
        $query = $this->db->insert('tb_int_administrasi_suratmasuk', $params);
        return $query;
    }


    ////////////////////////////////SURAT KELUAR//////////////////////////////////////////
    public function addSuratKeluar($post){
        $params = array(     
            'suratkeluarNo' => $post['suratkeluarNo'],
            'sk_smID'       => $post['smID'],
            'sk_petugasID'  => $post['petugasID'],
            'file'          => $post['skFile'],
            
        );
        $query = $this->db->insert('tb_int_administrasi_suratkeluar', $params);
        return $query;
    }
}
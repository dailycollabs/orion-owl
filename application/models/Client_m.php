<?php
class Client_m extends CI_Model
{

    public function get($id = null)
    {
        $this->db->from('tb_client');
        if ($id != null) {
            $this->db->where('clientID', $id);
        }
        $query = $this->db->get();
        return $query;
    }

    public function getID($id)
    {
        $this->db->from('tb_client');
        $this->db->where('clientID', $id);
        $query = $this->db->get();
        return $query;
    }

    public function login($post)
    {
        $this->db->select('*');
        $this->db->from('tb_client');
        $this->db->where('clientUsername', $post['username']);
        $this->db->where('clientPassword', sha1($post['password']));
        $query = $this->db->get();
        return $query;
    }

    public function getMax(){
        $this->db->select_max('clientID');
        $this->db->from('tb_client');
        $query = $this->db->get();
        return $query;
    }

    public function add($post){
        $params = array(
            'clientID'              => $post['id'],
            'clientNPWP'            => $post['npwp'],
            'clientNama'            => $post['fullname'],
            'clientUsername'        => $post['username'],
            'clientPassword'        => sha1($post['password']),
            'clientTglLahir'        => $post['tglLahir'],
            'clientJenisKelamin'    => $post['jenisKelamin'],
            'clientTelepon'         => $post['noTelepon'],
            'clientEmail'           => $post['email'],
            'clientFotoProfil'      => $post['clientFoto'],
        );
        $query = $this->db->insert('tb_client', $params);
        return $query;
    }

    public function edit($post, $postPass = null){
        $params = array(
            'clientNPWP'                => $post['npwp'],
            'clientNama'                => $post['fullname'],
            'clientUsername'            => $post['username'],
            'clientPassword'            => $post['password'],
            'clientTglLahir'            => $post['tglLahir'],
            'clientJenisKelamin'        => $post['jenisKelamin'],
            'clientTelepon'             => $post['noTelepon'],
            'clientEmail'               => $post['email'],
            'clientAlamat'              => $post['alamat'],
            'clientFotoProfil'          => $post['clientFoto'],
            'clientPerusahaan_nama'     => $post['namaPerusahaan'],
            'clientPerusahaan_jabatan'  => $post['jabatanPerusahaan'],
            'clientPerusahaan_email'    => $post['emailPerusahaan'],
            'clientPerusahaan_telepon'  => $post['teleponPerusahaan'],
            'clientPerusahaan_alamat'   => $post['alamatPerusahaan'],
        );
        $this->db->where('clientID', $post['clientID']);
        $query = $this->db->update('tb_client',$params);
    }

    public function checkkBiodata($id){
        $this->db->select('*');
        $this->db->from('tb_client');
        $this->db->where('clientUsername !=', null);
        $this->db->where('clientPassword !=', null);
        $this->db->where('clientPerusahaan !=', null);
        $this->db->where('clientEmail !=', null);
        $this->db->where('clientTelepon !=', null);
        $query = $this->db->get();
        return $query;
    }
}

<?php
class ClientProject_m extends CI_Model{

    public function getAllID($id){
        $this->db->from('tb_clientproject');
        $this->db->where('projectID', $id);
        $this->db->join('tb_bidang', 'tb_bidang.bidangID = tb_clientproject.projectbidangID');
        $this->db->join('tb_client', 'tb_client.clientID = tb_clientproject.projectclientID');
        $this->db->join('tb_status', 'tb_status.statusID = tb_clientproject.project_statusID');
        $query = $this->db->get();
        return $query;
    }
    public function getAllByClientID($id){
        $this->db->from('tb_clientproject');
        $this->db->where('projectclientID', $id);
        $this->db->join('tb_bidang', 'tb_bidang.bidangID = tb_clientproject.projectbidangID');
        $this->db->join('tb_client', 'tb_client.clientID = tb_clientproject.projectclientID');
        $this->db->join('tb_status', 'tb_status.statusID = tb_clientproject.project_statusID');
        $this->db->order_by('waktu', 'DESC');
        $query = $this->db->get();
        return $query;
    }

    public function getAllNotif($bidangID){
        $this->db->from('tb_clientproject');
        $this->db->where('projectbidangID', $bidangID);
        $this->db->where('projectStatusKonf', 'send');
        $query = $this->db->get();
        return $query;
    }

    public function getAllMax(){
        $this->db->select_max('projectID');
        $this->db->from('tb_clientproject');
        $this->db->join('tb_bidang', 'tb_bidang.bidangID = tb_clientproject.projectbidangID');
        $this->db->join('tb_client', 'tb_client.clientID = tb_clientproject.projectclientID');
        $query = $this->db->get();
        $this->db->order_by('projectID', 'DESC');
        return $query;
    }

    //Menampilkan quoID yang paling besar
    public function getPrjMaxByBidang($bidang){
        $this->db->select_max('projectID');
        $this->db->from('tb_clientproject');
        $this->db->like('projectID', $bidang, 'both'); 
        $query = $this->db->get();
        return $query;
    }

    // public function getAllMaxData(){
    //     $this->db->select_max('projectID');
    //     $this->db->from('tb_clientproject');
    //     $query = $this->db->get();
    //     return $query;
    // }

    public function getAllbyBidang($bidang){
        $this->db->from('tb_clientproject');
        $this->db->where('projectbidangID', $bidang);
        $this->db->where_not_in('project_statusID', 'SC1');
        $query = $this->db->get();
        return $query;
    }

    public function getAllbyBidangSuccess($bidang){
        $this->db->from('tb_clientproject');
        $this->db->where('projectbidangID', $bidang);
        $this->db->where('project_statusID', 'SC1');
        $query = $this->db->get();
        return $query;
    }


    public function addProject($post){
        $params = array(     
            'projectID'         => $post['id'],
            'projectclientID'   => $post['clientID'],
            'projectbidangID'   => $post['bidangID'],
            'projectFile'       => $post['projectFile'],
            'project_statusID'  => $post['status'],
            'projectStatusKonf' => 'send',
            'komentar'          => $post['comment']
        );
        $query = $this->db->insert('tb_clientproject', $params);
        return $query;
    }

    public function setStatus($post){
        $params = array(     
            'project_statusID'          => $post['status'],
        );
        $this->db->where('projectID', $post['projectID']);
        $query = $this->db->update('tb_clientproject', $params);
        return $query;
    }

     //Merubah data FR Detail Marine status Konfirmasi dan menambahkan waktu start dan waktu End 
     public function setMarFRDStatusKonf($post){
        $data = array(
            'projectStatusKonf'   => $post['statusConf'],  
        );
        $this->db->where('projectID', $post['projectID']);
        $query = $this->db->update('tb_clientproject',$data);
    }

}
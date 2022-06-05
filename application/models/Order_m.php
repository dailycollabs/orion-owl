<?php

// Order/Project
class Order_m extends CI_Model{
    

    public function getAllMaxLike($bidang){
        $this->db->select_max('orderID');
        $this->db->from('tb_order');
        $this->db->like('orderID', $bidang, 'both'); 
        $query = $this->db->get();
        return $query;
    }


    public function getAllByID($id){
        $this->db->from('tb_order');
        $this->db->where_in('orderID', $id);
        $this->db->join('tb_clientproject', 'tb_clientproject.projectID = tb_order.order_projectID');
        $this->db->join('tb_bidang', 'tb_bidang.bidangID = tb_order.order_bidangID');
        $this->db->join('tb_client', 'tb_client.clientID = tb_order.order_clientID');
        $this->db->join('tb_status', 'tb_status.statusID = tb_order.order_statusID');
        $query = $this->db->get();
        return $query;
    }

    public function getAllByProjectID($id){
        $this->db->from('tb_order');
        $this->db->where_in('order_projectID', $id);
        $this->db->join('tb_clientproject', 'tb_clientproject.projectID = tb_order.order_projectID');
        $this->db->join('tb_bidang', 'tb_bidang.bidangID = tb_order.order_bidangID');
        $this->db->join('tb_client', 'tb_client.clientID = tb_order.order_clientID');
        $this->db->join('tb_status', 'tb_status.statusID = tb_order.order_statusID');
        $query = $this->db->get();
        return $query;
    }

    public function getAllByProjectIDDESC($id){
        $this->db->from('tb_order');
        $this->db->where_in('order_projectID', $id);
        $this->db->join('tb_clientproject', 'tb_clientproject.projectID = tb_order.order_projectID');
        $this->db->join('tb_bidang', 'tb_bidang.bidangID = tb_order.order_bidangID');
        $this->db->join('tb_client', 'tb_client.clientID = tb_order.order_clientID');
        $this->db->join('tb_status', 'tb_status.statusID = tb_order.order_statusID');
        $this->db->order_by('orderID', 'DESC');
        $query = $this->db->get();
        return $query;
    }



    public function addorder($post){
        $params = array(   
            'orderID'           => $post['id'],
            'order_projectID'   => $post['projectID'],
            'order_clientID'    => $post['clientID'],
            'order_bidangID'    => $post['bidangID'],
            'order_petugasID'   => $post['petugasID'],
            'order_subbidangID' => $post['subbidangID'],
            'order_statusID'      => $post['status'],
            'waktu_start'       => $post['waktustart'],
            'waktu_end'         => $post['waktuend']
        );
        $query = $this->db->insert('tb_order', $params);
        return $query;
    }


    public function changeStatus($post){
        $params = array( 
            'order_statusID' => $post['status']
        );
        $this->db->where('orderID', $post['orderID']);
        $query = $this->db->update('tb_order',$params);
    }

 




}

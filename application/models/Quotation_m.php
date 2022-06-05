<?php

class Quotation_m extends CI_Model{

///////////////////////////////////////////////////////////////////////////////
     //Menampilkan QuoID
     public function getQuoAll(){
        $this->db->from('tb_quotation');
        $query = $this->db->get();
        return $query;
    }

///////////////////////////////////////////////////////////////////////////////

///////////////////////////////////////////////////////////////////////////////
    //Menampilkan QuoID
    public function getQuoByID($id){
        $this->db->from('tb_quotation');
        $this->db->where_in('quoID', $id);
        $this->db->join('tb_bidang', 'tb_bidang.bidangID = tb_quotation.quo_bidangID');
        $query = $this->db->get();
        return $query;
    }
///////////////////////////////////////////////////////////////////////////////

///////////////////////////////////////////////////////////////////////////////

    //Menampilkan QuoNo
    public function getQuoByNoDesc($id){
        $this->db->from('tb_quotation');
        $this->db->where('quoNo', $id);
        $this->db->order_by('quoID', 'DESC');
        $query = $this->db->get();
        return $query;
    }
///////////////////////////////////////////////////////////////////////////////

///////////////////////////////////////////////////////////////////////////////
    
   
    //Menampilkan QuoID
    public function getQuoByBidangID($id){
        $this->db->from('tb_quotation');
        $this->db->where('quo_bidangID', $id);
        $query = $this->db->get();
        return $query;
    }
///////////////////////////////////////////////////////////////////////////////

///////////////////////////////////////////////////////////////////////////////
    //Menampilkan Quo_orderID
    public function getQuoByOrderID($id){
        $this->db->from('tb_quotation');
        $this->db->where_in('quo_orderID', $id);
        $query = $this->db->get();
        return $query;
    }
///////////////////////////////////////////////////////////////////////////////



    //Menambahkan QuoID
    public function addQuoID($post){
        $params = array(     
            'quoID'        => $post['id'],
            'quoNo'        => $post['quoNo'],
            'quo_orderID'  => $post['orderID'],
            'quo_bidangID' => $post['bidangID'],
        );
        $query = $this->db->insert('tb_quotation', $params);
        return $query;
    }

    ///////////////////////// ID MAX //////////////////////////
///////////////////////////////////////////////////////////////////////////////
    //Menampilkan quoID yang paling besar
    public function getQuoMaxByBidang($bidang){
        $this->db->select_max('quoID');
        $this->db->from('tb_quotation');
        $this->db->like('quoID', $bidang, 'both'); 
        $query = $this->db->get();
        return $query;
    }
///////////////////////////////////////////////////////////////////////////////

///////////////////////////////////////////////////////////////////////////////
    //Menampilkan quoID yang paling besar
    public function getQuoMaxByNo($id){
        $this->db->select_max('quoID');
        $this->db->from('tb_quotation');
        $this->db->where_in('quoNo', $id);
        $this->db->group_by('quoNo');
        $this->db->order_by('quoID', 'DESC');
        $query = $this->db->get();
        return $query;
    }
///////////////////////////////////////////////////////////////////////////////

    ////////////////////////////Quo Detail/////////////////////
    public function addQuoDetail($post){
        $params = array(     
            'quoD_quoID'       => $post['quoID'],
            'quoD_petugasID'   => $post['petugasID'],
            'quoD_pengirimID'  => $post['pengirimID'],
            'quoD_penerimaID'  => $post['penerimaID'],
            'quoD_statusID'    => $post['statusID'],
            'quoDFile'         => $post['file'],     
            'jumlah'           => $post['jumlah'],
            'statusKonfirmasi' => $post['statuskonf'],
            'comment'          => $post['comment'],
        );
        $query = $this->db->insert('tb_quotationdetail', $params);
        return $query;
    }

///////////////////////////////////////////////////////////////////////////////
 

    public function getQuoDNotifNew($petugas){
        $status = array('SC1','RV1', 'NW1');
        $this->db->from('tb_quotationdetail');
        $this->db->where('quoD_penerimaID', $petugas);
        $this->db->where('statusKonfirmasi', 'send');
        $this->db->where_in('quoD_statusID', $status);
        $this->db->join('tb_quotation', 'tb_quotation.quoID = tb_quotationdetail.quoD_quoID');
        $query = $this->db->get();
        return $query;
    }
///////////////////////////////////////////////////////////////////////////////


///////////////////////////////////////////////////////////////////////////////
    public function getQuoDNotifNewFailed($petugas){
        $this->db->from('tb_quotationdetail');
        $this->db->where('quoD_penerimaID', $petugas);
        $this->db->where('statusKonfirmasi', 'send');
        $this->db->where_in('quoD_statusID', 'FD1');
        $this->db->join('tb_quotation', 'tb_quotation.quoID = tb_quotationdetail.quoD_quoID');
        $query = $this->db->get();
        return $query;
    }
///////////////////////////////////////////////////////////////////////////////


///////////////////////////////////////////////////////////////////////////////
    public function getQuoDAll(){
        $this->db->from('tb_quotationdetail');
        $this->db->join('tb_quotation', 'tb_quotation.quoID = tb_quotationdetail.quoD_quoID');
        $this->db->join('tb_petugas', 'tb_petugas.petugasID = tb_quotationdetail.quoD_petugasID');
        $this->db->join('tb_status', 'tb_status.statusID = tb_quotationdetail.quoD_statusID');
        $query = $this->db->get();
        return $query;
    }

   
///////////////////////////////////////////////////////////////////////////////


///////////////////////////////////////////////////////////////////////////////
    //Menampilkan QuoDetail Berdasarkan quoDetailID
    public function getQuoDByID($id){
        $this->db->from('tb_quotationdetail');
        $this->db->where_in('quoDetailID', $id);
        $this->db->join('tb_quotation', 'tb_quotation.quoID = tb_quotationdetail.quoD_quoID');
        $this->db->join('tb_petugas', 'tb_petugas.petugasID = tb_quotationdetail.quoD_petugasID');
        $this->db->join('tb_status', 'tb_status.statusID = tb_quotationdetail.quoD_statusID');
        $query = $this->db->get();
        return $query;
    }
///////////////////////////////////////////////////////////////////////////////


///////////////////////////////////////////////////////////////////////////////
    public function getQuoDByIDDesc($id){
        $this->db->from('tb_quotationdetail');
        $this->db->where_in('quoDetailID', $id);
        $this->db->join('tb_quotation', 'tb_quotation.quoID = tb_quotationdetail.quoD_quoID');
        $this->db->join('tb_petugas', 'tb_petugas.petugasID = tb_quotationdetail.quoD_petugasID');
        $this->db->join('tb_status', 'tb_status.statusID = tb_quotationdetail.quoD_statusID');
        $this->db->order_by('quoDetailID', 'DESC');
        $query = $this->db->get();
        return $query;
    }
///////////////////////////////////////////////////////////////////////////////


///////////////////////////////////////////////////////////////////////////////

    //Menampilkan QuoDetail Berdasarkan quoID
    public function getQuoDByQuoID($id){
        $this->db->from('tb_quotationdetail');
        $this->db->where_in('quoD_quoID', $id);
        $this->db->join('tb_quotation', 'tb_quotation.quoID = tb_quotationdetail.quoD_quoID');
        $this->db->join('tb_petugas', 'tb_petugas.petugasID = tb_quotationdetail.quoD_petugasID');
        $this->db->join('tb_status', 'tb_status.statusID = tb_quotationdetail.quoD_statusID');
        $query = $this->db->get();
        return $query;
    }
///////////////////////////////////////////////////////////////////////////////


///////////////////////////////////////////////////////////////////////////////
    //Menampilkan QuoDetail Berdasarkan quoID Desc
    public function getQuoDByQuoIDDesc($id){
        $this->db->from('tb_quotationdetail');
        $this->db->where_in('quoD_quoID', $id);
        $this->db->join('tb_quotation', 'tb_quotation.quoID = tb_quotationdetail.quoD_quoID');
        $this->db->join('tb_petugas', 'tb_petugas.petugasID = tb_quotationdetail.quoD_petugasID');
        $this->db->join('tb_status', 'tb_status.statusID = tb_quotationdetail.quoD_statusID');
        $this->db->order_by('quoDetailID', 'DESC');
        $query = $this->db->get();
        return $query;
    }
///////////////////////////////////////////////////////////////////////////////


///////////////////////////////////////////////////////////////////////////////

    public function jumlahQuoDetail($post){
        $this->db->select('*');
        $this->db->from('tb_quotationdetail');
        $this->db->where('quoD_quoID', $post['quoID']);
        $this->db->where('quoD_petugasID', $post['petugasID']);
        $this->db->where('quoD_pengirimID', $post['pengirimID']);
        $this->db->where('quoD_penerimaID', $post['penerimaID']);
        $query = $this->db->get();
        return $query;
    }

///////////////////////////////////////////////////////////////////////////////


///////////////////////////////////////////////////////////////////////////////
    public function getQuoDByPetugasIDNew($post){
        $this->db->from('tb_quotationdetail');
        $this->db->where('quoD_penerimaID', $post['penerima']);
        $this->db->where_in('quoD_pengirimID', $post['pengirim']);
        $this->db->where('statusKonfirmasi', 'send');
        $this->db->join('tb_quotation', 'tb_quotation.quoID = tb_quotationdetail.quoD_quoID');
        $this->db->join('tb_petugas', 'tb_petugas.petugasID = tb_quotationdetail.quoD_petugasID');
        $this->db->join('tb_status', 'tb_status.statusID = tb_quotationdetail.quoD_statusID');
        $this->db->order_by('waktu', 'DESC');
        $query = $this->db->get();
        return $query;
    }
///////////////////////////////////////////////////////////////////////////////


///////////////////////////////////////////////////////////////////////////////
    public function setQuoDStatusKonf($post){
        $data = array(
            'statusKonfirmasi'   => $post['statusConf'], 
            'waktu_start'        => $post['waktustart'],  
            'waktu_end'          => $post['waktuend'], 
        );
        $this->db->where('quoDetailID', $post['quoProsesID']);
        $query = $this->db->update('tb_quotationdetail',$data);
    }
///////////////////////////////////////////////////////////////////////////////


///////////////////////////////////////////////////////////////////////////////
    public function getQuoDByPenerimaID($post){
        $this->db->from('tb_quotationdetail');
        $this->db->where('quoD_penerimaID', $post['subbidangPetugas']);
        $this->db->order_by('quoDetailID', 'DESC');
        $this->db->join('tb_status', 'tb_status.statusID = tb_quotationdetail.quoD_statusID');
        $query = $this->db->get();
        return $query; 
    }
///////////////////////////////////////////////////////////////////////////////


///////////////////////////////////////////////////////////////////////////////
    public function getQuoDByPengirimID($post){
        $this->db->from('tb_quotationdetail');
        $this->db->where('quoD_pengirimID', $post['subbidangPetugas']);
        $this->db->where('quoD_quoID', $post['quoid']);
        $this->db->order_by('quoDetailID', 'DESC');
        $this->db->join('tb_status', 'tb_status.statusID = tb_quotationdetail.quoD_statusID');
        $query = $this->db->get();
        return $query;
    }
///////////////////////////////////////////////////////////////////////////////


///////////////////////////////////////////////////////////////////////////////
    public function setQuoDStatus($post){
        $params = array(     
            'quoD_statusID'          => $post['status'],
        );
        $this->db->where('quoDetailID', $post['quoProsesID']);
        $query = $this->db->update('tb_quotationdetail', $params);
        return $query;
    }
///////////////////////////////////////////////////////////////////////////////


///////////////////////////////////////////////////////////////////////////////
    public function getQuoDByPetugasIDDesc($petugas){
        $this->db->from('tb_quotationdetail');
        $this->db->where('quoD_pengirimID', $petugas);
        $this->db->or_where('quoD_penerimaID', $petugas);
        $this->db->order_by('quoDetailID', 'DESC');
        $this->db->join('tb_quotation', 'tb_quotation.quoID = tb_quotationdetail.quoD_quoID');
        $this->db->join('tb_petugas', 'tb_petugas.petugasID = tb_quotationdetail.quoD_petugasID');
        $this->db->join('tb_status', 'tb_status.statusID = tb_quotationdetail.quoD_statusID');
        $query = $this->db->get();
        return $query;
    }

    
///////////////////////////////////////////////////////////////////////////////


///////////////////////////////////////////////////////////////////////////////  
    //Menampilkan data FR berdasarkan quoD_penerima yang login dan quoD_quoID, kemudian urutkan quoDetailID Desc
    public function getQuoDByPenerimaQuoID($id, $petugas){
        $this->db->from('tb_quotationdetail');
        $this->db->where('quoD_penerimaID', $petugas);
        $this->db->where_in('quoD_quoID', $id);
        $this->db->join('tb_quotation', 'tb_quotation.quoID = tb_quotationdetail.quoD_quoID');
        $this->db->join('tb_petugas', 'tb_petugas.petugasID = tb_quotationdetail.quoD_petugasID');
        $this->db->join('tb_status', 'tb_status.statusID = tb_quotationdetail.quoD_statusID');
        $this->db->order_by("quoDetailID", "DESC");
        $query = $this->db->get();
        return $query;
    }
///////////////////////////////////////////////////////////////////////////////


///////////////////////////////////////////////////////////////////////////////
     //Menampilkan data FR berdasarkan quoD_pengirimID yang login dan quoD_quoID, kemudian urutkan quoDetailID Desc
     public function getQuoDByPengirimQuoID($id, $petugas){
        $this->db->from('tb_quotationdetail');
        $this->db->where('quoD_pengirimID', $petugas);
        $this->db->where_in('quoD_quoID', $id);
        $this->db->join('tb_quotation', 'tb_quotation.quoID = tb_quotationdetail.quoD_quoID');
        $this->db->join('tb_petugas', 'tb_petugas.petugasID = tb_quotationdetail.quoD_petugasID');
        $this->db->join('tb_status', 'tb_status.statusID = tb_quotationdetail.quoD_statusID');
        $query = $this->db->get();
        return $query;
    }
///////////////////////////////////////////////////////////////////////////////


   ////////////////////////Detail Max////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////
    //Menampilkan quoDetailID yang Maximal atau yang paling besar, berdasarkan quoD_quoID dan quoD_penerimaID yang login
    public function getQuoDMaxByQuoID($id){
        $this->db->select_max('quoDetailID');
        $this->db->from('tb_quotationdetail');
        $this->db->where_in('quoD_quoID', $id);
        $this->db->group_by('quoD_quoID');
        $this->db->order_by('quoDetailID', 'DESC');
        $query = $this->db->get();
        return $query; 
    }
///////////////////////////////////////////////////////////////////////////////

///////////////////////////////////////////////////////////////////////////////
    
    public function getQuoDMaxByPetugasID($petugas){
        $this->db->select_max('quoDetailID');
        $this->db->from('tb_quotationdetail');
        $this->db->where('quoD_pengirimID', $petugas);
        $this->db->or_where('quoD_penerimaID', $petugas);
        $this->db->group_by('quoD_quoID');
        $this->db->order_by('quoDetailID', 'DESC');
        $query = $this->db->get();
        return $query;
    }
///////////////////////////////////////////////////////////////////////////////

///////////////////////////////////////////////////////////////////////////////
    //Menampilkan quoDetailID yang Maximal atau yang paling besar, berdasarkan quoD_penerimaID yang login
    public function getQuoDMaxByPenerimaID($id){
        $this->db->select_max('quoDetailID');
        $this->db->from('tb_quotationdetail');
        $this->db->where('quoD_penerimaID', $id);
        $this->db->group_by('quoD_quoID');
        $this->db->order_by('quoDetailID', 'DESC');
        $query = $this->db->get();
        return $query; 
    }
///////////////////////////////////////////////////////////////////////////////

///////////////////////////////////////////////////////////////////////////////
    //Menampilkan quoDetailID yang Maximal atau yang paling besar, berdasarkan quoD_quoID dan quoD_pengirimID yang login
    public function getQuoDMaxByPengirimQuoID($id, $petugas){
        $this->db->select_max('quoDetailID');
        $this->db->from('tb_quotationdetail');
        $this->db->where_in('quoD_quoID', $id);
        $this->db->where('quoD_pengirimID', $petugas);
        $this->db->group_by('quoD_quoID');
        $this->db->order_by('quoDetailID', 'DESC');
        $query = $this->db->get();
        return $query; 
    }
///////////////////////////////////////////////////////////////////////////////

///////////////////////////////////////////////////////////////////////////////
    //Menampilkan quoDetailID yang Maximal atau yang paling besar, berdasarkan quoD_quoID dan quoD_penerimaID yang login
    public function getQuoDMaxByPenerimaQuoID($id, $petugas){
        $this->db->select_max('quoDetailID');
        $this->db->from('tb_quotationdetail');
        $this->db->where_in('quoD_quoID', $id);
        $this->db->where('quoD_penerimaID', $petugas);
        $this->db->group_by('quoD_quoID');
        $this->db->order_by('quoDetailID', 'DESC');
        $query = $this->db->get();
        return $query; 
    }


}

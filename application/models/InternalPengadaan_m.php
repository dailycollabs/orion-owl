<?php

class InternalPengadaan_m extends CI_Model{

    //Paty Cash
    //Menampilkan quoID yang paling besar
    public function getAllMaxPattyCash(){
        $this->db->select_max('pattycashNo');
        $this->db->from('tb_int_pengadaan_pattycash');
        $query = $this->db->get();
        return $query;
    }

    public function getAllPattyCash(){
        $this->db->select('*');
        $this->db->from('tb_int_pengadaan_pattycash');
        $this->db->join('tb_petugas', 'tb_petugas.petugasID = tb_int_pengadaan_pattycash.pc_petugasID');
        $this->db->join('tb_status', 'tb_status.statusID = tb_int_pengadaan_pattycash.pc_statusID');
        $query = $this->db->get();
        return $query;
    }

    public function getAllPattyCashNew($petugas){
        $this->db->select('*');
        $this->db->from('tb_int_pengadaan_pattycash');
        $this->db->where('pc_penerimaID', $petugas);
        $this->db->where('pcStatusKonf', 'send');
        $this->db->join('tb_petugas', 'tb_petugas.petugasID = tb_int_pengadaan_pattycash.pc_petugasID');
        $this->db->join('tb_status', 'tb_status.statusID = tb_int_pengadaan_pattycash.pc_statusID');
        $query = $this->db->get();
        return $query;
    }

    public function getAllPattyCashID($id){
        $this->db->select('*');
        $this->db->from('tb_int_pengadaan_pattycash');
        $this->db->where('pattycashID', $id);
        $this->db->join('tb_status', 'tb_status.statusID = tb_int_pengadaan_pattycash.pc_statusID');
        $this->db->join('tb_petugas', 'tb_petugas.petugasID = tb_int_pengadaan_pattycash.pc_petugasID');
        $query = $this->db->get();
        return $query;
    }
    

  

   

    public function jumlahPattycashProses($post){
        $this->db->select('*');
        $this->db->from('tb_int_pengadaan_pattycash');
        $this->db->where('pattycashNo', $post['pattycashNo']);
        $this->db->where('pc_petugasID', $post['petugasID']);
        $this->db->where('pc_pengirimID', $post['pengirimID']);
        $this->db->where('pc_penerimaID', $post['penerimaID']);
        $query = $this->db->get();
        return $query;

    }

    //Menampilkan QuoDetail Berdasarkan quoID
    public function getBudgetHonorbyID($id){
        $this->db->from('tb_int_pengadaan_pattycash');
        $this->db->where_in('pattycashNo', $id);
        $this->db->join('tb_status', 'tb_status.statusID = tb_int_pengadaan_pattycash.pc_statusID');
        $query = $this->db->get();
        return $query;
    }

  

    public function addPattycashProses($post){

        $params = array(     
            'pattycashNo'   => $post['id'],
            'pc_bidangID'   => $post['bidangID'],
            'pc_petugasID'  => $post['petugasID'],
            'pc_pengirimID' => $post['pengirimID'],
            'pc_penerimaID' => $post['penerimaID'],
            'pc_statusID'   => $post['statusID'],
            'pcFile'        => $post['pattycashFile'],
            'pcJumlah'      => $post['jumlah'],
            'pcStatusKonf'  => $post['statusKonfirmasi'],
            'pcComment'     => $post['comment'],
            
        );
        $query = $this->db->insert('tb_int_pengadaan_pattycash', $params);
        return $query;
    }

    ////////////////////////////////////////////
    public function changeStatusQuoDetail($post){
        $data = array(
            'pcStatusKonf'   => $post['statusConf'],  
        );
        $this->db->where('pattycashID', $post['quoProsesID']);
        $query = $this->db->update('tb_int_pengadaan_pattycash',$data);
    }

    public function uploadTimeWork($post){
        $data = array(
            'pcWaktu_start'   => $post['waktustart'],  
            'pcWaktu_end'     => $post['waktuend'],
        );
        $this->db->where('pattycashID', $post['quoProsesID']);
        $query = $this->db->update('tb_int_pengadaan_pattycash',$data);
    }



    //TimeOut
    //Menampilkan quoDetailID yang Maximal atau yang paling besar, berdasarkan quoD_penerimaID yang login
    public function getMarFRDByPenerimaIDMax($id){
        $this->db->select_max('pattycashID');
        $this->db->from('tb_int_pengadaan_pattycash');
        $this->db->where('pc_penerimaID', $id);
        $this->db->group_by('pattycashNo');
        $this->db->order_by('pattycashID', 'DESC');
        $query = $this->db->get();
        return $query; 
    }

    //Menampilkan data FR Detail Marine berdasarkan ID
    public function getMarFRDByID($id){
        $this->db->from('tb_int_pengadaan_pattycash');
        $this->db->where_in('pattycashID', $id);
        $this->db->join('tb_status', 'tb_status.statusID = tb_int_pengadaan_pattycash.pc_statusID');
        $this->db->join('tb_petugas', 'tb_petugas.petugasID = tb_int_pengadaan_pattycash.pc_petugasID');
        $this->db->order_by('pattycashID', 'DESC');
        $query = $this->db->get();
        return $query;
    }

    

    //Menampilkan data FR berdasarkan quoD_pengirimID yang login dan quoD_quoID, kemudian urutkan quoDetailID Desc
    public function getMarFRDByPengirimID($id, $petugas){
        $this->db->from('tb_int_pengadaan_pattycash');
        $this->db->where('pc_pengirimID', $petugas);
        $this->db->where_in('pattycashNo', $id);
        $this->db->join('tb_status', 'tb_status.statusID = tb_int_pengadaan_pattycash.pc_statusID');
        $this->db->join('tb_petugas', 'tb_petugas.petugasID = tb_int_pengadaan_pattycash.pc_petugasID');
        // $this->db->order_by("quoDetailID", "DESC");
        $query = $this->db->get();
        return $query;
    }

    //Menampilkan data FR berdasarkan quoD_penerima yang login dan quoD_quoID, kemudian urutkan quoDetailID Desc
    public function getMarFRDByPenerimaID($id, $petugas){
        $this->db->from('tb_int_pengadaan_pattycash');
        $this->db->where('pc_penerimaID', $petugas);
        $this->db->where_in('pattycashNo', $id);
        $this->db->join('tb_status', 'tb_status.statusID = tb_int_pengadaan_pattycash.pc_statusID');
        $this->db->join('tb_petugas', 'tb_petugas.petugasID = tb_int_pengadaan_pattycash.pc_petugasID');
        $this->db->order_by("pattycashID", "DESC");
        $query = $this->db->get();
        return $query;
    }

     //Mengubah status frMarD_statusID
     public function setMarFRDStatus($post){
        $params = array(     
            'pc_statusID'          => $post['status'],
        );
        $this->db->where('pattycashID', $post['quoProsesID']);
        $query = $this->db->update('tb_int_pengadaan_pattycash', $params);
        return $query;
    }

    //Menampilkan quoDetailID yang Maximal atau yang paling besar, berdasarkan quoD_quoID dan quoD_pengirimID yang login
    public function getMarFRDByPengirimIDMax($id, $petugas){
        $this->db->select_max('pattycashID');
        $this->db->from('tb_int_pengadaan_pattycash');
        $this->db->where_in('pattycashNo', $id);
        $this->db->where('pc_pengirimID', $petugas);
        $this->db->group_by('pattycashNo');
        $this->db->order_by('pattycashID', 'DESC');
        $query = $this->db->get();
        return $query; 
    }

    //Menampilkan quoDetailID yang Maximal atau yang paling besar, berdasarkan quoD_quoID dan quoD_penerimaID yang login
    public function getMarFRDByPenerimaIDMaxID($id, $petugas){
        $this->db->select_max('pattycashID');
        $this->db->from('tb_int_pengadaan_pattycash');
        $this->db->where_in('pattycashNo', $id);
        $this->db->where('pc_penerimaID', $petugas);
        $this->db->group_by('pattycashNo');
        $this->db->order_by('pattycashID', 'DESC');
        $query = $this->db->get();
        return $query; 
    }

    //Menampilkan data FR Detail Marine berdasarkan FR ID
    public function getMarFRDByFRID($id){
        $this->db->from('tb_int_pengadaan_pattycash');
        $this->db->where_in('pattycashNo', $id);
        $this->db->join('tb_status', 'tb_status.statusID = tb_int_pengadaan_pattycash.pc_statusID');
        $this->db->join('tb_petugas', 'tb_petugas.petugasID = tb_int_pengadaan_pattycash.pc_petugasID');
        // $this->db->order_by('quoDetailID', 'DESC');
        $query = $this->db->get();
        return $query;
    }

    //Menampilkan quoDetailID yang Maximal atau yang paling besar, berdasarkan quoD_quoID dan quoD_penerimaID yang login
    public function getMarFRDByIDMax($id){
        $this->db->select_max('pattycashID');
        $this->db->from('tb_int_pengadaan_pattycash');
        $this->db->where_in('pattycashNo', $id);
        $this->db->group_by('pattycashNo');
        $this->db->order_by('pattycashID', 'DESC');
        $query = $this->db->get();
        return $query; 
    }

    public function getWorkflowPetugas($petugas){
        $this->db->select_max('pattycashID');
        $this->db->from('tb_int_pengadaan_pattycash');
        $this->db->where('pc_pengirimID', $petugas);
        $this->db->or_where('pc_penerimaID', $petugas);
        $this->db->group_by('pattycashNo');
        // $this->db->order_by('quoD_quoID');
        $this->db->order_by('pattycashID', 'DESC');
        $query = $this->db->get();
        return $query;
    }

    public function getAllBudgetHonorID($id){
        $this->db->from('tb_int_pengadaan_pattycash');
        $this->db->where_in('pattycashID', $id);
        $this->db->join('tb_status', 'tb_status.statusID = tb_int_pengadaan_pattycash.pc_statusID');
        $this->db->join('tb_petugas', 'tb_petugas.petugasID = tb_int_pengadaan_pattycash.pc_petugasID');
        $this->db->order_by('pattycashID', 'DESC');
        $query = $this->db->get();
        return $query;
    }

    public function getQuoDetailByQuoIDDESC($id){
        $this->db->from('tb_int_pengadaan_pattycash');
        $this->db->where_in('pattycashNo', $id);
        $this->db->join('tb_status', 'tb_status.statusID = tb_int_pengadaan_pattycash.pc_statusID');
        $this->db->join('tb_petugas', 'tb_petugas.petugasID = tb_int_pengadaan_pattycash.pc_petugasID');
        $this->db->order_by('pattycashID', 'DESC');
        $query = $this->db->get();
        return $query;
    }

    public function getWorkflowPetugasID($petugas){
        $this->db->select('*');
        $this->db->from('tb_int_pengadaan_pattycash');
        $this->db->where('pc_pengirimID', $petugas);
        $this->db->or_where('pc_penerimaID', $petugas);
        // $this->db->order_by('quoD_quoID');
        $this->db->order_by('pattycashID', 'DESC');
        $this->db->join('tb_status', 'tb_status.statusID = tb_int_pengadaan_pattycash.pc_statusID');
        $this->db->join('tb_petugas', 'tb_petugas.petugasID = tb_int_pengadaan_pattycash.pc_petugasID');
        $query = $this->db->get();
        return $query;
    }

    

   
    



    //End Paty Cash
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    ///////////////////////////////////////////////////////////////////////
    //List Belanja

    //Menampilkan quoID yang paling besar
    public function getAllMaxLBPI(){
        $this->db->select_max('listbelanjaNo');
        $this->db->from('tb_int_pengadaan_listbelanja');
        $query = $this->db->get();
        return $query;
    }

    public function getAlllistBelanja(){
        $this->db->select('*');
        $this->db->from('tb_int_pengadaan_listbelanja');
        $this->db->join('tb_int_pengadaan_pattycash', 'tb_int_pengadaan_pattycash.pattycashID = tb_int_pengadaan_listbelanja.lb_pattycashID');
        $this->db->join('tb_petugas', 'tb_petugas.petugasID = tb_int_pengadaan_listbelanja.lb_petugasID');
        $query = $this->db->get();
        return $query;
    }

    public function getAlllistBelanjabyID($id){
        $this->db->from('tb_int_pengadaan_listbelanja');
        $this->db->where('listbelanjaID', $id);
        $this->db->join('tb_int_pengadaan_pattycash', 'tb_int_pengadaan_pattycash.pattycashID = tb_int_pengadaan_listbelanja.lb_pattycashID');
        $this->db->join('tb_petugas', 'tb_petugas.petugasID = tb_int_pengadaan_listbelanja.lb_petugasID');
        $this->db->join('tb_status', 'tb_status.statusID = tb_int_pengadaan_listbelanja.lb_statusID');
        $query = $this->db->get();
        return $query;
    }

    public function getAlllistBelanjaNew($petugas){
        $this->db->from('tb_int_pengadaan_listbelanja');
        $this->db->where('lb_penerimaID', $petugas);
        $this->db->where('lbStatusKonf', 'send');
        $this->db->join('tb_int_pengadaan_pattycash', 'tb_int_pengadaan_pattycash.pattycashID = tb_int_pengadaan_listbelanja.lb_pattycashID');
        $this->db->join('tb_petugas', 'tb_petugas.petugasID = tb_int_pengadaan_listbelanja.lb_petugasID');
        $this->db->join('tb_status', 'tb_status.statusID = tb_int_pengadaan_listbelanja.lb_statusID');
        $query = $this->db->get();
        return $query;
    }

    


    

    public function getAlllistBelanjaByPattyID($id){
        $this->db->from('tb_int_pengadaan_listbelanja');
        $this->db->where('lb_pattycashID', $id);
        $this->db->join('tb_int_pengadaan_pattycash', 'tb_int_pengadaan_pattycash.pattycashID = tb_int_pengadaan_listbelanja.lb_pattycashID');
        $this->db->join('tb_petugas', 'tb_petugas.petugasID = tb_int_pengadaan_listbelanja.lb_petugasID');
        $query = $this->db->get();
        return $query;
    }


    public function addlistBelanjaProses($post){
        $params = array(     
            'listbelanjaNo'     => $post['listbelanjaNo'],
            'lb_pattycashID'    => $post['pattycashID'],
            'lb_bidangID'       => $post['bidangID'],
            'lb_petugasID'      => $post['petugasID'],
            'lb_pengirimID'     => $post['pengirimID'],
            'lb_penerimaID'     => $post['penerimaID'],
            'lb_statusID'       => $post['statusID'],
            'lbPeriodicFile'    => $post['filePeriodic'],
            'lbInsidentilFile'  => $post['fileInsidentil'],
            'lbStatusKonf'      => $post['statusKonfirmasi'],
            'lbComment'         => $post['comment'],
        );
        $query = $this->db->insert('tb_int_pengadaan_listbelanja', $params);
        return $query;
    }

    ////////////////////////////////////////////
    public function changeStatusQuoDetailLBPI($post){
        $data = array(
            'lbStatusKonf'   => $post['statusConf'],  
        );
        $this->db->where('listbelanjaID', $post['quoProsesID']);
        $query = $this->db->update('tb_int_pengadaan_listbelanja',$data);
    }

    public function uploadTimeWorkLBPI($post){
        $data = array(
            'lbWaktu_start'   => $post['waktustart'],  
            'lbWaktu_end'     => $post['waktuend'],
        );
        $this->db->where('listbelanjaID', $post['quoProsesID']);
        $query = $this->db->update('tb_int_pengadaan_listbelanja',$data);
    }


    //TimeOut
    //Menampilkan quoDetailID yang Maximal atau yang paling besar, berdasarkan quoD_penerimaID yang login
    public function getMarLBPIByPenerimaIDMax($id){
        $this->db->select_max('listbelanjaID');
        $this->db->from('tb_int_pengadaan_listbelanja');
        $this->db->where('lb_penerimaID', $id);
        $this->db->group_by('listbelanjaNo');
        $this->db->order_by('listbelanjaID', 'DESC');
        $query = $this->db->get();
        return $query; 
    }

     //Menampilkan data FR Detail Marine berdasarkan ID
     public function getMarLBPIByID($id){
        $this->db->from('tb_int_pengadaan_listbelanja');
        $this->db->where_in('listbelanjaID', $id);
        $this->db->join('tb_int_pengadaan_pattycash', 'tb_int_pengadaan_pattycash.pattycashID = tb_int_pengadaan_listbelanja.lb_pattycashID');
        $this->db->join('tb_status', 'tb_status.statusID = tb_int_pengadaan_listbelanja.lb_statusID');
        $this->db->join('tb_petugas', 'tb_petugas.petugasID = tb_int_pengadaan_listbelanja.lb_petugasID');
        $this->db->order_by('listbelanjaID', 'DESC');
        $query = $this->db->get();
        return $query;
    }

    //Menampilkan data FR berdasarkan quoD_penerima yang login dan quoD_quoID, kemudian urutkan quoDetailID Desc
    public function getMarLBPIByPenerimaID($id, $petugas){
        $this->db->from('tb_int_pengadaan_listbelanja');
        $this->db->where('lb_penerimaID', $petugas);
        $this->db->where_in('listbelanjaNo', $id);
        $this->db->join('tb_int_pengadaan_pattycash', 'tb_int_pengadaan_pattycash.pattycashID = tb_int_pengadaan_listbelanja.lb_pattycashID');
        $this->db->join('tb_status', 'tb_status.statusID = tb_int_pengadaan_listbelanja.lb_statusID');
        $this->db->join('tb_petugas', 'tb_petugas.petugasID = tb_int_pengadaan_listbelanja.lb_petugasID');
        $this->db->order_by("listbelanjaID", "DESC");
        $query = $this->db->get();
        return $query;
    }

     //Mengubah status frMarD_statusID
     public function setMarLBPIStatus($post){
        $params = array(     
            'lb_statusID'          => $post['status'],
        );
        $this->db->where('listbelanjaID', $post['quoProsesID']);
        $query = $this->db->update('tb_int_pengadaan_listbelanja', $params);
        return $query;
    }

    //Menampilkan data FR berdasarkan quoD_pengirimID yang login dan quoD_quoID, kemudian urutkan quoDetailID Desc
    public function getMarLBPIByPengirimID($id, $petugas){
        $this->db->from('tb_int_pengadaan_listbelanja');
        $this->db->where('lb_pengirimID', $petugas);
        $this->db->where_in('listbelanjaNo', $id);
        $this->db->join('tb_int_pengadaan_pattycash', 'tb_int_pengadaan_pattycash.pattycashID = tb_int_pengadaan_listbelanja.lb_pattycashID');
        $this->db->join('tb_status', 'tb_status.statusID = tb_int_pengadaan_listbelanja.lb_statusID');
        $this->db->join('tb_petugas', 'tb_petugas.petugasID = tb_int_pengadaan_listbelanja.lb_petugasID');
        // $this->db->order_by("quoDetailID", "DESC");
        $query = $this->db->get();
        return $query;
    }

   

    //Menampilkan quoDetailID yang Maximal atau yang paling besar, berdasarkan quoD_quoID dan quoD_penerimaID yang login
    public function getMarLBPIByIDMax($id){
        $this->db->select_max('listbelanjaID');
        $this->db->from('tb_int_pengadaan_listbelanja');
        $this->db->where_in('listbelanjaNo', $id);
        $this->db->group_by('listbelanjaNo');
        $this->db->order_by('listbelanjaID', 'DESC');
        $query = $this->db->get();
        return $query; 
    }

    //Menampilkan data FR Detail Marine berdasarkan FR ID
    public function getMarLBPIByFRID($id){
        $this->db->from('tb_int_pengadaan_listbelanja');
        $this->db->where_in('listbelanjaNo', $id);
        $this->db->join('tb_int_pengadaan_pattycash', 'tb_int_pengadaan_pattycash.pattycashID = tb_int_pengadaan_listbelanja.lb_pattycashID');
        $this->db->join('tb_status', 'tb_status.statusID = tb_int_pengadaan_listbelanja.lb_statusID');
        $this->db->join('tb_petugas', 'tb_petugas.petugasID = tb_int_pengadaan_listbelanja.lb_petugasID');
        // $this->db->order_by('quoDetailID', 'DESC');
        $query = $this->db->get();
        return $query;
    }

    public function getLBPbyPetugas($petugas){
        $this->db->select_max('listbelanjaID');
        $this->db->from('tb_int_pengadaan_listbelanja');
        $this->db->where('lb_pengirimID', $petugas);
        $this->db->or_where('lb_penerimaID', $petugas);
        $this->db->group_by('listbelanjaNo');
        // $this->db->order_by('quoD_quoID');
        $this->db->order_by('listbelanjaID', 'DESC');
        $query = $this->db->get();
        return $query;
    }

    public function getAllLBPByID($id){
        $this->db->from('tb_int_pengadaan_listbelanja');
        $this->db->where_in('listbelanjaID', $id);
        $this->db->join('tb_int_pengadaan_pattycash', 'tb_int_pengadaan_pattycash.pattycashID = tb_int_pengadaan_listbelanja.lb_pattycashID');
        $this->db->join('tb_status', 'tb_status.statusID = tb_int_pengadaan_listbelanja.lb_statusID');
        $this->db->join('tb_petugas', 'tb_petugas.petugasID = tb_int_pengadaan_listbelanja.lb_petugasID');
        $this->db->order_by('listbelanjaID', 'DESC');
        $query = $this->db->get();
        return $query;
    }

    public function getLBPByNoDesc($id){
        $this->db->from('tb_int_pengadaan_listbelanja');
        $this->db->where_in('listbelanjaNo', $id);
        $this->db->join('tb_int_pengadaan_pattycash', 'tb_int_pengadaan_pattycash.pattycashID = tb_int_pengadaan_listbelanja.lb_pattycashID');
        $this->db->join('tb_status', 'tb_status.statusID = tb_int_pengadaan_listbelanja.lb_statusID');
        $this->db->join('tb_petugas', 'tb_petugas.petugasID = tb_int_pengadaan_listbelanja.lb_petugasID');
        $this->db->order_by('listbelanjaID', 'DESC');
        $query = $this->db->get();
        return $query;
    }





    /////////////////////////BREAKDOWN///////////////////////////////
    //Menampilkan quoID yang paling besar
    public function getAllMaxLBDL(){
        $this->db->select_max('breakdownlistID');
        $this->db->from('tb_int_pengadaan_listbreakdown');
        $query = $this->db->get();
        return $query;
    }

    public function getBreakdownID($id){
        $this->db->from('tb_int_pengadaan_listbreakdown');
        $this->db->where('breakdownlistID', $id);
        $this->db->join('tb_int_pengadaan_listbelanja', 'tb_int_pengadaan_listbelanja.listbelanjaID = tb_int_pengadaan_listbreakdown.bdl_listbelanjaID');
        $query = $this->db->get();

        return $query;

    }

    public function addlistBreakdown($post){
        $params = array(   
            'breakdownlistID'    => $post['breakdownlistID'],
            'bdl_listbelanjaID'  => $post['listbelanjaID'],
            'bdl_pattycashID'    => $post['pattycashID'],
            'bdl_bidangID'       => $post['bidangID'],
            
        );
        $query = $this->db->insert('tb_int_pengadaan_listbreakdown', $params);
        $insert_id = $this->db->insert_id();
        return  $insert_id;
    }

    public function getAllBreakdownProses(){
        $this->db->select('*');
        $this->db->from('tb_int_pengadaan_listbreakdowndetail');
        $this->db->join('tb_int_pengadaan_listbreakdown', 'tb_int_pengadaan_listbreakdown.breakdownlistID = tb_int_pengadaan_listbreakdowndetail.bdlD_breakdownlistID');
        $this->db->join('tb_petugas', 'tb_petugas.petugasID = tb_int_pengadaan_listbreakdowndetail.bdlD_petugasID');
        $query = $this->db->get();

        return $query;

    }

    public function getNewQuoDetailByPetugas($post){
        $this->db->from('tb_int_pengadaan_listbreakdowndetail');
        $this->db->where('bdlD_penerimaID', $post['penerima']);
        $this->db->where_in('bdlD_pengirimID', $post['pengirim']);
        $this->db->where('bdlDStatusKonf', 'send');
        $this->db->join('tb_int_pengadaan_listbreakdown', 'tb_int_pengadaan_listbreakdown.breakdownlistID = tb_int_pengadaan_listbreakdowndetail.bdlD_breakdownlistID');
        $this->db->join('tb_petugas', 'tb_petugas.petugasID = tb_int_pengadaan_listbreakdowndetail.bdlD_petugasID');
        $this->db->join('tb_status', 'tb_status.statusID = tb_int_pengadaan_listbreakdowndetail.bdlD_statusID');
        $query = $this->db->get();
        return $query;
    }



    public function getAllBreakdownProsesID($id){
        $this->db->from('tb_int_pengadaan_listbreakdowndetail');
        $this->db->where('bdlDetailID', $id);
        $this->db->join('tb_int_pengadaan_listbreakdown', 'tb_int_pengadaan_listbreakdown.breakdownlistID = tb_int_pengadaan_listbreakdowndetail.bdlD_breakdownlistID');
        $this->db->join('tb_petugas', 'tb_petugas.petugasID = tb_int_pengadaan_listbreakdowndetail.bdlD_petugasID');
        $this->db->join('tb_status', 'tb_status.statusID = tb_int_pengadaan_listbreakdowndetail.bdlD_statusID');
        $query = $this->db->get();

        return $query;

    }
    

    public function addBreakdownProses($post){
        $params = array(     
            'bdlD_breakdownlistID'  => $post['breakdownlistID'],
            'bdlD_petugasID'        => $post['petugasID'],
            'bdlD_pengirimID'       => $post['pengirimID'],
            'bdlD_penerimaID'       => $post['penerimaID'],
            'bdlD_statusID'         => $post['statusID'],
            'bdlDFile'              => $post['breakdownFile'],
            'bdlDJumlah'            => $post['jumlah'],
            'bdlDStatusKonf'        => $post['statusKonf'],
            'bdlComment'            => $post['comment'],
        );
        $query = $this->db->insert('tb_int_pengadaan_listbreakdowndetail', $params);
        return $query;
    }

    public function jumlahBreakdownProses($post){
        $this->db->select('*');
        $this->db->from('tb_int_pengadaan_listbreakdowndetail');
        $this->db->where('bdlD_breakdownlistID', $post['breakdownID']);
        $this->db->where('bdlD_petugasID', $post['petugasID']);
        $this->db->where('bdlD_pengirimID', $post['pengirimID']);
        $this->db->where('bdlD_penerimaID', $post['penerimaID']);
        $query = $this->db->get();
        return $query;

    }

     //Menampilkan QuoDetail Berdasarkan quoID
     public function getBreakdownDetailbyID($id){
        $this->db->from('tb_int_pengadaan_listbreakdowndetail');
        $this->db->where_in('bdlD_breakdownlistID', $id);
        $this->db->join('tb_status', 'tb_status.statusID = tb_int_pengadaan_listbreakdowndetail.bdlD_statusID');
        $query = $this->db->get();
        return $query;
    }


     ////////////////////////////////////////////
     public function changeStatusBreakdownDetail($post){
        $data = array(
            'bdlDStatusKonf'   => $post['statusConf'],  
        );
        $this->db->where('bdlDetailID', $post['quoProsesID']);
        $query = $this->db->update('tb_int_pengadaan_listbreakdowndetail',$data);
    }

    public function uploadTimeWorkBreakdownDetail($post){
        $data = array(
            'bdlDWaktu_start'   => $post['waktustart'],  
            'bdlDWaktu_end'     => $post['waktuend'],
        );
        $this->db->where('bdlDetailID', $post['quoProsesID']);
        $query = $this->db->update('tb_int_pengadaan_listbreakdowndetail',$data);
    }


     //TimeOut
    //Menampilkan quoDetailID yang Maximal atau yang paling besar, berdasarkan quoD_penerimaID yang login
    public function getBDLDByPenerimaIDMax($id){
        $this->db->select_max('bdlDetailID');
        $this->db->from('tb_int_pengadaan_listbreakdowndetail');
        $this->db->where('bdlD_penerimaID', $id);
        $this->db->group_by('bdlD_breakdownlistID');
        $this->db->order_by('bdlDetailID', 'DESC');
        $query = $this->db->get();
        return $query; 
    }

    //Menampilkan data FR Detail Marine berdasarkan ID
    public function getBDLDByID($id){
        $this->db->from('tb_int_pengadaan_listbreakdowndetail');
        $this->db->where_in('bdlDetailID', $id);
        $this->db->join('tb_int_pengadaan_listbreakdown', 'tb_int_pengadaan_listbreakdown.breakdownlistID = tb_int_pengadaan_listbreakdowndetail.bdlD_breakdownlistID');
        $this->db->join('tb_petugas', 'tb_petugas.petugasID = tb_int_pengadaan_listbreakdowndetail.bdlD_petugasID');
        $this->db->join('tb_status', 'tb_status.statusID = tb_int_pengadaan_listbreakdowndetail.bdlD_statusID');
        $this->db->order_by('bdlDetailID', 'DESC');
        $query = $this->db->get();
        return $query;
    }

    //Menampilkan data FR berdasarkan quoD_pengirimID yang login dan quoD_quoID, kemudian urutkan quoDetailID Desc
    public function getBDLDByPengirimID($id, $petugas){
        $this->db->from('tb_int_pengadaan_listbreakdowndetail');
        $this->db->where('bdlD_pengirimID', $petugas);
        $this->db->where_in('bdlD_breakdownlistID', $id);
        $this->db->join('tb_int_pengadaan_listbreakdown', 'tb_int_pengadaan_listbreakdown.breakdownlistID = tb_int_pengadaan_listbreakdowndetail.bdlD_breakdownlistID');
        $this->db->join('tb_petugas', 'tb_petugas.petugasID = tb_int_pengadaan_listbreakdowndetail.bdlD_petugasID');
        $this->db->join('tb_status', 'tb_status.statusID = tb_int_pengadaan_listbreakdowndetail.bdlD_statusID');
        // $this->db->order_by("quoDetailID", "DESC");
        $query = $this->db->get();
        return $query;
    }

    //Menampilkan data FR berdasarkan quoD_penerima yang login dan quoD_quoID, kemudian urutkan quoDetailID Desc
    public function getBDLDByPenerimaID($id, $petugas){
        $this->db->from('tb_int_pengadaan_listbreakdowndetail');
        $this->db->where('bdlD_penerimaID', $petugas);
        $this->db->where_in('bdlD_breakdownlistID', $id);
        $this->db->join('tb_int_pengadaan_listbreakdown', 'tb_int_pengadaan_listbreakdown.breakdownlistID = tb_int_pengadaan_listbreakdowndetail.bdlD_breakdownlistID');
        $this->db->join('tb_petugas', 'tb_petugas.petugasID = tb_int_pengadaan_listbreakdowndetail.bdlD_petugasID');
        $this->db->join('tb_status', 'tb_status.statusID = tb_int_pengadaan_listbreakdowndetail.bdlD_statusID');
        $this->db->order_by("bdlDetailID", "DESC");
        $query = $this->db->get();
        return $query;
    }

    //Mengubah status frMarD_statusID
    public function setBDLDStatus($post){
        $params = array(     
            'bdlD_statusID'          => $post['status'],
        );
        $this->db->where('bdlDetailID', $post['quoProsesID']);
        $query = $this->db->update('tb_int_pengadaan_listbreakdowndetail', $params);
        return $query;
    }

     //Menampilkan quoDetailID yang Maximal atau yang paling besar, berdasarkan quoD_quoID dan quoD_penerimaID yang login
     public function getBDLDByIDMax($id){
        $this->db->select_max('bdlDetailID');
        $this->db->from('tb_int_pengadaan_listbreakdowndetail');
        $this->db->where_in('bdlD_breakdownlistID', $id);
        $this->db->group_by('bdlD_breakdownlistID');
        $this->db->order_by('bdlDetailID', 'DESC');
        $query = $this->db->get();
        return $query; 
    }

    //Menampilkan data FR Detail Marine berdasarkan FR ID
    public function getBDLDByFRID($id){
        $this->db->from('tb_int_pengadaan_listbreakdowndetail');
        $this->db->where_in('bdlD_breakdownlistID', $id);
        $this->db->join('tb_int_pengadaan_listbreakdown', 'tb_int_pengadaan_listbreakdown.breakdownlistID = tb_int_pengadaan_listbreakdowndetail.bdlD_breakdownlistID');
        $this->db->join('tb_petugas', 'tb_petugas.petugasID = tb_int_pengadaan_listbreakdowndetail.bdlD_petugasID');
        $this->db->join('tb_status', 'tb_status.statusID = tb_int_pengadaan_listbreakdowndetail.bdlD_statusID');
        // $this->db->order_by('quoDetailID', 'DESC');
        $query = $this->db->get();
        return $query;
    }

    //Menampilkan quoDetailID yang Maximal atau yang paling besar, berdasarkan quoD_quoID dan quoD_pengirimID yang login
    public function getBDLDByPengirimIDMax($id, $petugas){
        $this->db->select_max('bdlDetailID');
        $this->db->from('tb_int_pengadaan_listbreakdowndetail');
        $this->db->where_in('bdlD_breakdownlistID', $id);
        $this->db->where('bdlD_pengirimID', $petugas);
        $this->db->group_by('bdlD_breakdownlistID');
        $this->db->order_by('bdlDetailID', 'DESC');
        $query = $this->db->get();
        return $query; 
    }

    //Menampilkan quoDetailID yang Maximal atau yang paling besar, berdasarkan quoD_quoID dan quoD_penerimaID yang login
    public function getBDLDByPenerimaIDMaxID($id, $petugas){
        $this->db->select_max('bdlDetailID');
        $this->db->from('tb_int_pengadaan_listbreakdowndetail');
        $this->db->where_in('bdlD_breakdownlistID', $id);
        $this->db->where('bdlD_penerimaID', $petugas);
        $this->db->group_by('bdlD_breakdownlistID');
        $this->db->order_by('bdlDetailID', 'DESC');
        $query = $this->db->get();
        return $query; 
    }

   
    public function getBreakdownPetugas($petugas){
        $this->db->select_max('bdlDetailID');
        $this->db->from('tb_int_pengadaan_listbreakdowndetail');
        $this->db->where('bdlD_pengirimID', $petugas);
        $this->db->or_where('bdlD_penerimaID', $petugas);
        $this->db->group_by('bdlD_breakdownlistID');
        // $this->db->order_by('quoD_quoID');
        $this->db->order_by('bdlDetailID', 'DESC');
        $query = $this->db->get();
        return $query;
    }

    public function getAllBreakdownID($id){
        $this->db->from('tb_int_pengadaan_listbreakdowndetail');
        $this->db->where_in('bdlDetailID', $id);
        $this->db->join('tb_int_pengadaan_listbreakdown', 'tb_int_pengadaan_listbreakdown.breakdownlistID = tb_int_pengadaan_listbreakdowndetail.bdlD_breakdownlistID');
        $this->db->join('tb_petugas', 'tb_petugas.petugasID = tb_int_pengadaan_listbreakdowndetail.bdlD_petugasID');
        $this->db->join('tb_status', 'tb_status.statusID = tb_int_pengadaan_listbreakdowndetail.bdlD_statusID');
        $this->db->order_by('bdlDetailID', 'DESC');
        $query = $this->db->get();
        return $query;
    }

    public function getBreakdownByIDDesc($id){
        $this->db->from('tb_int_pengadaan_listbreakdowndetail');
        $this->db->where_in('bdlD_breakdownlistID', $id);
        $this->db->join('tb_int_pengadaan_listbreakdown', 'tb_int_pengadaan_listbreakdown.breakdownlistID = tb_int_pengadaan_listbreakdowndetail.bdlD_breakdownlistID');
        $this->db->join('tb_petugas', 'tb_petugas.petugasID = tb_int_pengadaan_listbreakdowndetail.bdlD_petugasID');
        $this->db->join('tb_status', 'tb_status.statusID = tb_int_pengadaan_listbreakdowndetail.bdlD_statusID');
        $this->db->order_by('bdlDetailID', 'DESC');
        $query = $this->db->get();
        return $query;
    }

    public function getBreakdownByPetugasID($petugas){
        $this->db->select('*');
        $this->db->from('tb_int_pengadaan_listbreakdowndetail');
        $this->db->where('bdlD_pengirimID', $petugas);
        $this->db->or_where('bdlD_penerimaID', $petugas);
        // $this->db->order_by('quoD_quoID');
        $this->db->order_by('bdlDetailID', 'DESC');
        $this->db->join('tb_int_pengadaan_listbreakdown', 'tb_int_pengadaan_listbreakdown.breakdownlistID = tb_int_pengadaan_listbreakdowndetail.bdlD_breakdownlistID');
        $this->db->join('tb_petugas', 'tb_petugas.petugasID = tb_int_pengadaan_listbreakdowndetail.bdlD_petugasID');
        $this->db->join('tb_status', 'tb_status.statusID = tb_int_pengadaan_listbreakdowndetail.bdlD_statusID');
        $query = $this->db->get();
        return $query;
    }
   



    //////////////////////////////Pencairan Budget///////////////////////////////////////
    //Menampilkan quoID yang paling besar
    public function getAllMaxPB(){
        $this->db->select_max('pencairanbudgetID');
        $this->db->from('tb_int_pengadaan_pencairanbudget');
        $query = $this->db->get();
        return $query;
    }


    public function getAllPencairanBudget(){
        $this->db->select('*');
        $this->db->from('tb_int_pengadaan_pencairanbudget');
        $this->db->join('tb_int_pengadaan_listbreakdowndetail', 'tb_int_pengadaan_listbreakdowndetail.bdlDetailID = tb_int_pengadaan_pencairanbudget.pb_bddetailID');
        $this->db->join('tb_petugas', 'tb_petugas.petugasID = tb_int_pengadaan_pencairanbudget.pb_petugasID');
        $this->db->join('tb_status', 'tb_status.statusID = tb_int_pengadaan_pencairanbudget.pb_statusID');
        $query = $this->db->get();
        return $query;

    }

    public function getAllPencairanBudgetNew($petugas){
        $this->db->select('*');
        $this->db->from('tb_int_pengadaan_pencairanbudget');
        $this->db->where('pb_penerimaID', $petugas);
        $this->db->where('pbStatusKonf', 'send');
        $this->db->join('tb_int_pengadaan_listbreakdowndetail', 'tb_int_pengadaan_listbreakdowndetail.bdlDetailID = tb_int_pengadaan_pencairanbudget.pb_bddetailID');
        $this->db->join('tb_petugas', 'tb_petugas.petugasID = tb_int_pengadaan_pencairanbudget.pb_petugasID');
        $this->db->join('tb_int_pengadaan_pattycash', 'tb_int_pengadaan_pattycash.pattycashID = tb_int_pengadaan_pencairanbudget.pb_pattycashID');
        $this->db->join('tb_status', 'tb_status.statusID = tb_int_pengadaan_pencairanbudget.pb_statusID');
        $query = $this->db->get();
        return $query;

    }

    public function getAllPencairanBudgetID($id){
        $this->db->from('tb_int_pengadaan_pencairanbudget');
        $this->db->where('pencairanbudgetID', $id);
        $this->db->join('tb_int_pengadaan_listbreakdowndetail', 'tb_int_pengadaan_listbreakdowndetail.bdlDetailID = tb_int_pengadaan_pencairanbudget.pb_bddetailID');
        $this->db->join('tb_petugas', 'tb_petugas.petugasID = tb_int_pengadaan_pencairanbudget.pb_petugasID');
        $this->db->join('tb_status', 'tb_status.statusID = tb_int_pengadaan_pencairanbudget.pb_statusID');
        $query = $this->db->get();

        return $query;

    }

    public function addPencairanBudget($post){
        $params = array(     
            'pencairanbudgetID'  => $post['pencairanbudgetID'],
            'pbPengeluaranNo'    => $post['pengeluaranNo'],
            'pb_listbelanjaID'   => $post['listbelanjaID'],
            'pb_bddetailID'      => $post['bddetailID'],
            'pb_pattycashID'     => $post['pattycashID'],
            'pb_bidangID'        => $post['bidangID'],
            'pb_petugasID'       => $post['petugasID'],
            'pb_pengirimID'      => $post['pengirimID'],
            'pb_penerimaID'      => $post['penerimaID'],
            'pb_statusID'        => $post['status'],
            'pbFile'             => $post['pbFile'],
            'pbStatusKonf'       => $post['statusKonf'],
            'pbComment'          => $post['comment'],
        );
        $query = $this->db->insert('tb_int_pengadaan_pencairanbudget', $params);
        return $query;
    }

    public function changeStatusPencairanBudget($post){
        $data = array(
            'pbStatusKonf'   => $post['statusConf'],  
        );
        $this->db->where('pencairanbudgetID', $post['quoProsesID']);
        $query = $this->db->update('tb_int_pengadaan_pencairanbudget',$data);
    }


    public function getPBudgetbyPetugas($petugas){
        $this->db->select_max('pencairanbudgetID');
        $this->db->from('tb_int_pengadaan_pencairanbudget');
        $this->db->where('pb_pengirimID', $petugas);
        $this->db->or_where('pb_penerimaID', $petugas);
        $this->db->group_by('pbPengeluaranNo');
        // $this->db->order_by('quoD_quoID');
        $this->db->order_by('pencairanbudgetID', 'DESC');
        $query = $this->db->get();
        return $query;
    }

    public function getAllPBudgetByID($id){
        $this->db->from('tb_int_pengadaan_pencairanbudget');
        $this->db->where_in('pencairanbudgetID', $id);
        $this->db->join('tb_int_pengadaan_listbreakdowndetail', 'tb_int_pengadaan_listbreakdowndetail.bdlDetailID = tb_int_pengadaan_pencairanbudget.pb_bddetailID');
        $this->db->join('tb_int_pengadaan_pattycash', 'tb_int_pengadaan_pattycash.pattycashID = tb_int_pengadaan_pencairanbudget.pb_pattycashID');
    
        $this->db->join('tb_petugas', 'tb_petugas.petugasID = tb_int_pengadaan_pencairanbudget.pb_petugasID');
        $this->db->join('tb_status', 'tb_status.statusID = tb_int_pengadaan_pencairanbudget.pb_statusID');
        $this->db->order_by('pencairanbudgetID', 'DESC');
        $query = $this->db->get();
        return $query;
    }

    public function getPBudgetByNoDesc($id){
        $this->db->from('tb_int_pengadaan_pencairanbudget');
        $this->db->where_in('pbPengeluaranNo', $id);
        $this->db->join('tb_int_pengadaan_listbreakdowndetail', 'tb_int_pengadaan_listbreakdowndetail.bdlDetailID = tb_int_pengadaan_pencairanbudget.pb_bddetailID');
        $this->db->join('tb_int_pengadaan_pattycash', 'tb_int_pengadaan_pattycash.pattycashID = tb_int_pengadaan_pencairanbudget.pb_pattycashID');
      
        $this->db->join('tb_petugas', 'tb_petugas.petugasID = tb_int_pengadaan_pencairanbudget.pb_petugasID');
        $this->db->join('tb_status', 'tb_status.statusID = tb_int_pengadaan_pencairanbudget.pb_statusID');
        $this->db->order_by('pencairanbudgetID', 'DESC');
        $query = $this->db->get();
        return $query;
    }



    //////////////////////////////Nota Dinas///////////////////////////////////////
    public function getAllMaxND(){
        $this->db->select_max('notadinasID');
        $this->db->from('tb_int_pengadaan_notadinas');
        $query = $this->db->get();
        return $query;
    }

    public function getAllNotaDinas(){
        $this->db->select('*');
        $this->db->from('tb_int_pengadaan_notadinas');
        $this->db->join('tb_int_pengadaan_pencairanbudget', 'tb_int_pengadaan_pencairanbudget.pencairanbudgetID = tb_int_pengadaan_notadinas.nd_pencairanbudgetID');
        $this->db->join('tb_petugas', 'tb_petugas.petugasID = tb_int_pengadaan_notadinas.nd_petugasID');
        $query = $this->db->get();
        return $query;
    }

    public function getAllNotaDinasNew($petugas){
        // $this->db->select('*');
        $this->db->from('tb_int_pengadaan_notadinas');
        $this->db->where('nd_penerimaID', $petugas);
        $this->db->where('ndStatusKonf', 'send');
        $this->db->join('tb_int_pengadaan_pencairanbudget', 'tb_int_pengadaan_pencairanbudget.pencairanbudgetID = tb_int_pengadaan_notadinas.nd_pencairanbudgetID');
        $this->db->join('tb_petugas', 'tb_petugas.petugasID = tb_int_pengadaan_notadinas.nd_petugasID');
        $this->db->join('tb_status', 'tb_status.statusID = tb_int_pengadaan_notadinas.nd_statusID');
        $query = $this->db->get();
        return $query;
    }

    public function getAllNotaDinasID($id){
        $this->db->from('tb_int_pengadaan_notadinas');
        $this->db->where('notadinasID', $id);
        $this->db->join('tb_int_pengadaan_pencairanbudget', 'tb_int_pengadaan_pencairanbudget.pencairanbudgetID = tb_int_pengadaan_notadinas.nd_pencairanbudgetID');
        $this->db->join('tb_int_pengadaan_listbreakdowndetail', 'tb_int_pengadaan_listbreakdowndetail.bdlDetailID = tb_int_pengadaan_notadinas.nd_bdlDetailID');
        $this->db->join('tb_int_pengadaan_listbelanja', 'tb_int_pengadaan_listbelanja.listbelanjaID = tb_int_pengadaan_notadinas.nd_listbelanjaID');
        $this->db->join('tb_int_pengadaan_pattycash', 'tb_int_pengadaan_pattycash.pattycashID = tb_int_pengadaan_notadinas.nd_pattycashID');
        $this->db->join('tb_petugas', 'tb_petugas.petugasID = tb_int_pengadaan_notadinas.nd_petugasID');
        $this->db->join('tb_status', 'tb_status.statusID = tb_int_pengadaan_notadinas.nd_statusID');
        $query = $this->db->get();
        return $query;

    }

    public function addNotaDinas($post){
        $params = array(   
            'notadinasID'           => $post['notadinasID'],
            'nd_pencairanbudgetID'  => $post['pencairanbudgetID'],
            'nd_bdlDetailID'        => $post['breakdownID'], 
            'nd_listbelanjaID'      => $post['listbelanjaID'], 
            'nd_pattycashID'        => $post['pattycashID'], 
            'nd_bidangID'           => $post['bidangID'],
            'nd_petugasID'          => $post['petugasID'],
            'nd_pengirimID'         => $post['pengirimID'],
            'nd_penerimaID'         => $post['penerimaID'],
            'nd_statusID'           => $post['status'],
            'ndFile'                => $post['ndFile'],
            'ndStatusKonf'          => $post['statusKonf'],
            'ndComment'             => $post['comment'] 
            
        );
        $query = $this->db->insert('tb_int_pengadaan_notadinas', $params);
        return $query;
    }

    public function changeStatusNotaDinas($post){
        $data = array(
            'ndStatusKonf'   => $post['statusConf'],  
        );
        $this->db->where('notadinasID', $post['quoProsesID']);
        $query = $this->db->update('tb_int_pengadaan_notadinas',$data);
    }

    public function getNotaDinasbyPetugas($petugas){
        $this->db->from('tb_int_pengadaan_notadinas');
        $this->db->where('nd_pengirimID', $petugas);
        $this->db->or_where('nd_penerimaID', $petugas);

        // $this->db->order_by('quoD_quoID');
        $this->db->order_by('notadinasID', 'DESC');
        $query = $this->db->get();
        return $query;
    }



    public function getAllNotaDinasByID($id){
        $this->db->from('tb_int_pengadaan_notadinas');
        $this->db->where_in('notadinasID', $id);
        $this->db->join('tb_int_pengadaan_pencairanbudget', 'tb_int_pengadaan_pencairanbudget.pencairanbudgetID = tb_int_pengadaan_notadinas.nd_pencairanbudgetID');
        $this->db->join('tb_int_pengadaan_listbreakdowndetail', 'tb_int_pengadaan_listbreakdowndetail.bdlDetailID = tb_int_pengadaan_notadinas.nd_bdlDetailID');
        $this->db->join('tb_int_pengadaan_listbelanja', 'tb_int_pengadaan_listbelanja.listbelanjaID = tb_int_pengadaan_notadinas.nd_listbelanjaID');
        $this->db->join('tb_int_pengadaan_pattycash', 'tb_int_pengadaan_pattycash.pattycashID = tb_int_pengadaan_notadinas.nd_pattycashID');
        $this->db->join('tb_petugas', 'tb_petugas.petugasID = tb_int_pengadaan_notadinas.nd_petugasID');
        $this->db->join('tb_status', 'tb_status.statusID = tb_int_pengadaan_notadinas.nd_statusID');
        $this->db->order_by('notadinasID', 'DESC');
        $query = $this->db->get();
        return $query;
    }

    





    
    
    ///////////////////////////////Laporan Belanja///////////////////


    public function getAllMaxPLB(){
        $this->db->select_max('laporanbelanjaID');
        $this->db->from('tb_int_pengadaan_laporanbelanja');
        $query = $this->db->get();
        return $query;
    }


    public function getLaporanBelanjaID($id){
        $this->db->from('tb_int_pengadaan_laporanbelanja');
        $this->db->where('laporanbelanjaID', $id);
        $query = $this->db->get();

        return $query;

    }
    
    public function addLaporanBelanja($post){
        $params = array(   
            'laporanbelanjaID'            => $post['laporanbelanjaID'],
            'laporanb_notadinasID'        => $post['notadinasID'],
            'laporanb_pencairanbudgetID'  => $post['pencairanbudgetID'],
            'laporanb_bddetailID'         => $post['bddetailID'],
            'laporanb_listbelanjaID'      => $post['listbelanjaID'],
            'laporanb_pattycashID'        => $post['pattycashID'],
            'laporanb_bidangID'           => $post['bidangID'],
        );
        $query = $this->db->insert('tb_int_pengadaan_laporanbelanja', $params);
        $insert_id = $this->db->insert_id();
        return  $insert_id;
    }


    ////////////////////////////////////////////////////////////
    public function getALaporanBelanjaProses(){
        $this->db->select('*');
        $this->db->from('tb_int_pengadaan_laporanbelanjadetail');
        $this->db->join('tb_int_pengadaan_laporanbelanja', 'tb_int_pengadaan_laporanbelanja.laporanbelanjaID = tb_int_pengadaan_laporanbelanjadetail.lbd_laporanbelanjaID');
        $this->db->join('tb_petugas', 'tb_petugas.petugasID = tb_int_pengadaan_laporanbelanjadetail.lbd_petugasID');
        $this->db->join('tb_status', 'tb_status.statusID = tb_int_pengadaan_laporanbelanjadetail.lbd_statusID');
        $query = $this->db->get();
        return $query;
    }

    public function getALaporanBelanjaProsesNew($petugas){
        $this->db->select('*');
        $this->db->from('tb_int_pengadaan_laporanbelanjadetail');
        $this->db->where('lbd_penerimaID', $petugas);
        $this->db->where('lbdStatusKonf', 'send');
        $this->db->join('tb_int_pengadaan_laporanbelanja', 'tb_int_pengadaan_laporanbelanja.laporanbelanjaID = tb_int_pengadaan_laporanbelanjadetail.lbd_laporanbelanjaID');
        $this->db->join('tb_petugas', 'tb_petugas.petugasID = tb_int_pengadaan_laporanbelanjadetail.lbd_petugasID');
        $this->db->join('tb_status', 'tb_status.statusID = tb_int_pengadaan_laporanbelanjadetail.lbd_statusID');
        $query = $this->db->get();
        return $query;
    }

    public function getLaporanBelanjaProsesID($id){
        $this->db->from('tb_int_pengadaan_laporanbelanjadetail');
        $this->db->where('lbDetailID', $id);
        $this->db->join('tb_int_pengadaan_laporanbelanja', 'tb_int_pengadaan_laporanbelanja.laporanbelanjaID = tb_int_pengadaan_laporanbelanjadetail.lbd_laporanbelanjaID');
        $this->db->join('tb_petugas', 'tb_petugas.petugasID = tb_int_pengadaan_laporanbelanjadetail.lbd_petugasID');
        $this->db->join('tb_status', 'tb_status.statusID = tb_int_pengadaan_laporanbelanjadetail.lbd_statusID');
        $query = $this->db->get();
        return $query;
    }


    public function addLaporanBelanjaProses($post){
        $params = array(     
            'lbd_laporanbelanjaID'  => $post['laporanbelanjaID'],
            'lbd_petugasID'         => $post['petugasID'],
            'lbd_pengirimID'        => $post['pengirimID'],
            'lbd_penerimaID'        => $post['penerimaID'],
            'lbd_statusID'          => $post['status'],
            'lbdFile'               => $post['lbFile'],
            'lbdJumlah'             => $post['jumlah'],
            'lbdStatusKonf'         => $post['statusKonf'],
            'lbdComment'            => $post['comment'],
        );
        $query = $this->db->insert('tb_int_pengadaan_laporanbelanjadetail', $params);
        return $query;
    }

    public function jumlahLaporanBelanjaProses($post){
        $this->db->select('*');
        $this->db->from('tb_int_pengadaan_laporanbelanjadetail');
        $this->db->where('lbd_laporanbelanjaID', $post['laporanbelanjaID']);
        $this->db->where('lbd_petugasID', $post['petugasID']);
        $this->db->where('lbd_pengirimID', $post['pengirimID']);
        $this->db->where('lbd_penerimaID', $post['penerimaID']);
        $query = $this->db->get();
        return $query;

    }
   //Menampilkan QuoDetail Berdasarkan quoID
    public function getLaporanBelanjaByID($id){
        $this->db->from('tb_int_pengadaan_laporanbelanjadetail');
        $this->db->where_in('lbd_laporanbelanjaID', $id);
        $this->db->join('tb_int_pengadaan_laporanbelanja', 'tb_int_pengadaan_laporanbelanja.laporanbelanjaID = tb_int_pengadaan_laporanbelanjadetail.lbd_laporanbelanjaID');
        $this->db->join('tb_petugas', 'tb_petugas.petugasID = tb_int_pengadaan_laporanbelanjadetail.lbd_petugasID');
        $this->db->join('tb_status', 'tb_status.statusID = tb_int_pengadaan_laporanbelanjadetail.lbd_statusID');
        $query = $this->db->get();
        return $query;
    }


    //////////////////////////////////////////////////////////
     ////////////////////////////////////////////
     public function changeStatusLBD($post){
        $data = array(
            'lbdStatusKonf'   => $post['statusConf'],  
        );
        $this->db->where('lbDetailID', $post['quoProsesID']);
        $query = $this->db->update('tb_int_pengadaan_laporanbelanjadetail',$data);
    }

    public function uploadTimeWorkLBD($post){
        $data = array(
            'lbdWaktu_start'   => $post['waktustart'],  
            'lbdWaktu_end'     => $post['waktuend'],
        );
        $this->db->where('lbDetailID', $post['quoProsesID']);
        $query = $this->db->update('tb_int_pengadaan_laporanbelanjadetail',$data);
    }


    //TimeOut
    //Menampilkan quoDetailID yang Maximal atau yang paling besar, berdasarkan quoD_penerimaID yang login
    public function getLBDByPenerimaIDMax($id){
        $this->db->select_max('lbDetailID');
        $this->db->from('tb_int_pengadaan_laporanbelanjadetail');
        $this->db->where('lbd_penerimaID', $id);
        $this->db->group_by('lbd_laporanbelanjaID');
        $this->db->order_by('lbDetailID', 'DESC');
        $query = $this->db->get();
        return $query; 
    }

    //Menampilkan data FR Detail Marine berdasarkan ID
    public function getLBDByID($id){
        $this->db->from('tb_int_pengadaan_laporanbelanjadetail');
        $this->db->where_in('lbDetailID', $id);
        $this->db->join('tb_int_pengadaan_laporanbelanja', 'tb_int_pengadaan_laporanbelanja.laporanbelanjaID = tb_int_pengadaan_laporanbelanjadetail.lbd_laporanbelanjaID');
        $this->db->join('tb_petugas', 'tb_petugas.petugasID = tb_int_pengadaan_laporanbelanjadetail.lbd_petugasID');
        $this->db->join('tb_status', 'tb_status.statusID = tb_int_pengadaan_laporanbelanjadetail.lbd_statusID');
        $this->db->order_by('lbDetailID', 'DESC');
        $query = $this->db->get();
        return $query;
    }

    //Menampilkan data FR berdasarkan quoD_pengirimID yang login dan quoD_quoID, kemudian urutkan quoDetailID Desc
    public function getLBDByPengirimID($id, $petugas){
        $this->db->from('tb_int_pengadaan_laporanbelanjadetail');
        $this->db->where('lbd_pengirimID', $petugas);
        $this->db->where_in('lbd_laporanbelanjaID', $id);
        $this->db->join('tb_int_pengadaan_laporanbelanja', 'tb_int_pengadaan_laporanbelanja.laporanbelanjaID = tb_int_pengadaan_laporanbelanjadetail.lbd_laporanbelanjaID');
        $this->db->join('tb_petugas', 'tb_petugas.petugasID = tb_int_pengadaan_laporanbelanjadetail.lbd_petugasID');
        $this->db->join('tb_status', 'tb_status.statusID = tb_int_pengadaan_laporanbelanjadetail.lbd_statusID');
        // $this->db->order_by("quoDetailID", "DESC");
        $query = $this->db->get();
        return $query;
    }

     //Menampilkan data FR berdasarkan quoD_penerima yang login dan quoD_quoID, kemudian urutkan quoDetailID Desc
     public function getLBDByPenerimaID($id, $petugas){
        $this->db->from('tb_int_pengadaan_laporanbelanjadetail');
        $this->db->where('lbd_penerimaID', $petugas);
        $this->db->where_in('lbd_laporanbelanjaID', $id);
        $this->db->join('tb_int_pengadaan_laporanbelanja', 'tb_int_pengadaan_laporanbelanja.laporanbelanjaID = tb_int_pengadaan_laporanbelanjadetail.lbd_laporanbelanjaID');
        $this->db->join('tb_petugas', 'tb_petugas.petugasID = tb_int_pengadaan_laporanbelanjadetail.lbd_petugasID');
        $this->db->join('tb_status', 'tb_status.statusID = tb_int_pengadaan_laporanbelanjadetail.lbd_statusID');
        $this->db->order_by("lbDetailID", "DESC");
        $query = $this->db->get();
        return $query;
    }

    //Mengubah status frMarD_statusID
    public function setLBDStatus($post){
        $params = array(     
            'lbd_statusID'          => $post['status'],
        );
        $this->db->where('lbDetailID', $post['quoProsesID']);
        $query = $this->db->update('tb_int_pengadaan_laporanbelanjadetail', $params);
        return $query;
    }

    //Menampilkan quoDetailID yang Maximal atau yang paling besar, berdasarkan quoD_quoID dan quoD_pengirimID yang login
    public function getLBDByPengirimIDMax($id, $petugas){
        $this->db->select_max('lbDetailID');
        $this->db->from('tb_int_pengadaan_laporanbelanjadetail');
        $this->db->where_in('lbd_laporanbelanjaID', $id);
        $this->db->where('lbd_pengirimID', $petugas);
        $this->db->group_by('lbd_laporanbelanjaID');
        $this->db->order_by('lbDetailID', 'DESC');
        $query = $this->db->get();
        return $query; 
    }

    //Menampilkan quoDetailID yang Maximal atau yang paling besar, berdasarkan quoD_quoID dan quoD_penerimaID yang login
    public function getLBDByPenerimaIDMaxID($id, $petugas){
        $this->db->select_max('lbDetailID');
        $this->db->from('tb_int_pengadaan_laporanbelanjadetail');
        $this->db->where_in('lbd_laporanbelanjaID', $id);
        $this->db->where('lbd_penerimaID', $petugas);
        $this->db->group_by('lbd_laporanbelanjaID');
        $this->db->order_by('lbDetailID', 'DESC');
        $query = $this->db->get();
        return $query; 
    }

    public function getNewLBDByPetugas($post){
        $this->db->from('tb_int_pengadaan_laporanbelanjadetail');
        $this->db->where('lbd_penerimaID', $post['penerima']);
        $this->db->where_in('lbd_pengirimID', $post['pengirim']);
        $this->db->where('lbdStatusKonf', 'send');
        $this->db->join('tb_int_pengadaan_laporanbelanja', 'tb_int_pengadaan_laporanbelanja.laporanbelanjaID = tb_int_pengadaan_laporanbelanjadetail.lbd_laporanbelanjaID');
        $this->db->join('tb_petugas', 'tb_petugas.petugasID = tb_int_pengadaan_laporanbelanjadetail.lbd_petugasID');
        $this->db->join('tb_status', 'tb_status.statusID = tb_int_pengadaan_laporanbelanjadetail.lbd_statusID');
        $query = $this->db->get();
        return $query;
    }

    //Menampilkan quoDetailID yang Maximal atau yang paling besar, berdasarkan quoD_quoID dan quoD_penerimaID yang login
    public function getLBDByIDMax($id){
        $this->db->select_max('lbDetailID');
        $this->db->from('tb_int_pengadaan_laporanbelanjadetail');
        $this->db->where_in('lbd_laporanbelanjaID', $id);
        $this->db->group_by('lbd_laporanbelanjaID');
        $this->db->order_by('lbDetailID', 'DESC');
        $query = $this->db->get();
        return $query; 
    }

     //Menampilkan data FR Detail Marine berdasarkan FR ID
     public function getLBDByFRID($id){
        $this->db->from('tb_int_pengadaan_laporanbelanjadetail');
        $this->db->where_in('lbd_laporanbelanjaID', $id);
        $this->db->join('tb_int_pengadaan_laporanbelanja', 'tb_int_pengadaan_laporanbelanja.laporanbelanjaID = tb_int_pengadaan_laporanbelanjadetail.lbd_laporanbelanjaID');
        $this->db->join('tb_petugas', 'tb_petugas.petugasID = tb_int_pengadaan_laporanbelanjadetail.lbd_petugasID');
        $this->db->join('tb_status', 'tb_status.statusID = tb_int_pengadaan_laporanbelanjadetail.lbd_statusID');
        // $this->db->order_by('quoDetailID', 'DESC');
        $query = $this->db->get();
        return $query;
    }


    /////////////////////////////////////////////////////////////////////
    public function getLaporanBelanjaPetugas($petugas){
        $this->db->select_max('lbDetailID');
        $this->db->from('tb_int_pengadaan_laporanbelanjadetail');
        $this->db->where('lbd_pengirimID', $petugas);
        $this->db->or_where('lbd_penerimaID', $petugas);
        $this->db->group_by('lbd_laporanbelanjaID');
        // $this->db->order_by('quoD_quoID');
        $this->db->order_by('lbDetailID', 'DESC');
        $query = $this->db->get();
        return $query;
    }

    public function getAllLaporanBelanjaID($id){
        $this->db->from('tb_int_pengadaan_laporanbelanjadetail');
        $this->db->where_in('lbDetailID', $id);
        $this->db->join('tb_int_pengadaan_laporanbelanja', 'tb_int_pengadaan_laporanbelanja.laporanbelanjaID = tb_int_pengadaan_laporanbelanjadetail.lbd_laporanbelanjaID');
        $this->db->join('tb_petugas', 'tb_petugas.petugasID = tb_int_pengadaan_laporanbelanjadetail.lbd_petugasID');
        $this->db->join('tb_status', 'tb_status.statusID = tb_int_pengadaan_laporanbelanjadetail.lbd_statusID');
        $this->db->order_by('lbDetailID', 'DESC');
        $query = $this->db->get();
        return $query;
    }

    public function getLaporanBelanjaByIDDesc($id){
        $this->db->from('tb_int_pengadaan_laporanbelanjadetail');
        $this->db->where_in('lbd_laporanbelanjaID', $id);
        $this->db->join('tb_int_pengadaan_laporanbelanja', 'tb_int_pengadaan_laporanbelanja.laporanbelanjaID = tb_int_pengadaan_laporanbelanjadetail.lbd_laporanbelanjaID');
        $this->db->join('tb_petugas', 'tb_petugas.petugasID = tb_int_pengadaan_laporanbelanjadetail.lbd_petugasID');
        $this->db->join('tb_status', 'tb_status.statusID = tb_int_pengadaan_laporanbelanjadetail.lbd_statusID');
        $this->db->order_by('lbDetailID', 'DESC');
        $query = $this->db->get();
        return $query;
    }

    public function getLaporanBelanjaByPetugasID($petugas){
        $this->db->select('*');
        $this->db->from('tb_int_pengadaan_laporanbelanjadetail');
        $this->db->where('lbd_pengirimID', $petugas);
        $this->db->or_where('lbd_penerimaID', $petugas);
        // $this->db->order_by('quoD_quoID');
        $this->db->order_by('lbDetailID', 'DESC');
        $this->db->join('tb_int_pengadaan_laporanbelanja', 'tb_int_pengadaan_laporanbelanja.laporanbelanjaID = tb_int_pengadaan_laporanbelanjadetail.lbd_laporanbelanjaID');
        $this->db->join('tb_petugas', 'tb_petugas.petugasID = tb_int_pengadaan_laporanbelanjadetail.lbd_petugasID');
        $this->db->join('tb_status', 'tb_status.statusID = tb_int_pengadaan_laporanbelanjadetail.lbd_statusID');
        $query = $this->db->get();
        return $query;
    }


    /////////////////////////////APPROV/////////////////////
    public function addApprovalPengadaan($post){
        
        $params = array(     
            'approvPB_lbdetailID'         => $post['laporanbelanjaID'],
            'approvPB_notadinasID'        => $post['notadinasID'],
            'approvPB_pencairanbudgetID'  => $post['pencairanbudgetID'],
            'approvPB_bdlDetailID'        => $post['bddetailID'],
            'approvPB_listbelanjaID'      => $post['listbelanjaID'],
            'approvPB_pattycashID'        => $post['pattycashID'],
            'approvPB_bidangID'           => $post['bidangID'],
            
            
        );
        $query = $this->db->insert('tb_int_pengadaan_approval', $params);
        return $query;
    }

    

}

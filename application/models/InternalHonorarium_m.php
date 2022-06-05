<?php

class InternalHonorarium_m extends CI_Model{

    //Menampilkan quoID yang paling besar
    public function getAllMaxByGroupID(){
        $this->db->select_max('budgethonorID');
        $this->db->from('tb_int_honorarium_budgethonor');
        $this->db->group_by('budgethonorNo');
        $this->db->order_by('budgethonorID', 'DESC');
        $query = $this->db->get();
        return $query;
    }

    //Menampilkan quoID yang paling besar
    public function getAllMax(){
        $this->db->select_max('budgethonorNo');
        $this->db->from('tb_int_honorarium_budgethonor');
        $query = $this->db->get();
        return $query;
    }

    public function getAllBudgetHonorByFroupID(){
        $this->db->select('*');
        $this->db->from('tb_int_honorarium_budgethonor');
        $this->db->join('tb_petugas', 'tb_petugas.petugasID = tb_int_honorarium_budgethonor.budgetH_petugasID');
        $this->db->join('tb_status', 'tb_status.statusID = tb_int_honorarium_budgethonor.budgetH_statusID');
        $query = $this->db->get();
        return $query;
    }

   

    //Budget Honor

    public function changeStatusQuoDetail($post){
        $data = array(
            'budgetHStatusKonf'   => $post['statusConf'],  
        );
        $this->db->where('budgethonorID', $post['quoProsesID']);
        $query = $this->db->update('tb_int_honorarium_budgethonor',$data);
    }

    public function uploadTimeWork($post){
        $data = array(
            'budgetHWaktu_start'   => $post['waktustart'],  
            'budgetHWaktu_end'     => $post['waktuend'],
        );
        $this->db->where('budgethonorID', $post['quoProsesID']);
        $query = $this->db->update('tb_int_honorarium_budgethonor',$data);
    }


    public function getAllBudgetHonor(){
        $this->db->select('*');
        $this->db->from('tb_int_honorarium_budgethonor');
        $this->db->join('tb_petugas', 'tb_petugas.petugasID = tb_int_honorarium_budgethonor.budgetH_petugasID');
        $this->db->join('tb_status', 'tb_status.statusID = tb_int_honorarium_budgethonor.budgetH_statusID');
        $query = $this->db->get();
        return $query;
    }

    public function getNewAllBudgetHonor($petugas){
        $this->db->select('*');
        $this->db->from('tb_int_honorarium_budgethonor');
        $this->db->where('budgetH_penerimaID', $petugas);
        $this->db->where('budgetHStatusKonf', 'send');
        $this->db->join('tb_petugas', 'tb_petugas.petugasID = tb_int_honorarium_budgethonor.budgetH_petugasID');
        $this->db->join('tb_status', 'tb_status.statusID = tb_int_honorarium_budgethonor.budgetH_statusID');
        $query = $this->db->get();
        return $query;
    }

    public function getAllBudgetHonorID($id){
        $this->db->from('tb_int_honorarium_budgethonor');
        $this->db->where_in('budgethonorID', $id);
        $this->db->join('tb_petugas', 'tb_petugas.petugasID = tb_int_honorarium_budgethonor.budgetH_petugasID');
        $this->db->join('tb_status', 'tb_status.statusID = tb_int_honorarium_budgethonor.budgetH_statusID');
        $query = $this->db->get();
        return $query;
    }

    public function getWorkflowPetugas($petugas){
        $this->db->select_max('budgethonorID');
        $this->db->from('tb_int_honorarium_budgethonor');
        $this->db->where('budgetH_pengirimID', $petugas);
        $this->db->or_where('budgetH_penerimaID', $petugas);
        $this->db->group_by('budgethonorNo');
        // $this->db->order_by('quoD_quoID');
        $this->db->order_by('budgethonorID', 'DESC');
        $query = $this->db->get();
        return $query;
    }

    public function getWorkflowPetugasID($petugas){
        $this->db->select('*');
        $this->db->from('tb_int_honorarium_budgethonor');
        $this->db->where('budgetH_pengirimID', $petugas);
        $this->db->or_where('budgetH_penerimaID', $petugas);
        // $this->db->order_by('quoD_quoID');
        $this->db->order_by('budgethonorID', 'DESC');
        $this->db->join('tb_petugas', 'tb_petugas.petugasID = tb_int_honorarium_budgethonor.budgetH_petugasID');
        $this->db->join('tb_status', 'tb_status.statusID = tb_int_honorarium_budgethonor.budgetH_statusID');
        $query = $this->db->get();
        return $query;
    }

    public function getQuoDetailByQuoIDDESC($id){
        $this->db->from('tb_int_honorarium_budgethonor');
        $this->db->where_in('budgethonorNo', $id);
        $this->db->join('tb_petugas', 'tb_petugas.petugasID = tb_int_honorarium_budgethonor.budgetH_petugasID');
        $this->db->join('tb_status', 'tb_status.statusID = tb_int_honorarium_budgethonor.budgetH_statusID');
        $this->db->order_by('budgethonorID', 'DESC');
        $query = $this->db->get();
        return $query;
    }

    public function getAllBudgetHonorbyPetugasID($petugasID){
        $this->db->select('*');
        $this->db->from('tb_int_honorarium_budgethonor');
        $this->db->where('budgetH_pengirimID', $petugasID);
        $this->db->or_where('budgetH_penerimaID', $petugasID);
        $this->db->join('tb_petugas', 'tb_petugas.petugasID = tb_int_honorarium_budgethonor.budgetH_petugasID');
        $this->db->join('tb_status', 'tb_status.statusID = tb_int_honorarium_budgethonor.budgetH_statusID');
        $query = $this->db->get();
        return $query;
    }
    

    public function jumlahBudgetHonor($post){
        $this->db->select('*');
        $this->db->from('tb_int_honorarium_budgethonor');
        $this->db->where('budgethonorNo', $post['budgethonorNo']);
        $this->db->where('budgetH_petugasID', $post['petugasID']);
        $this->db->where('budgetH_pengirimID', $post['pengirimID']);
        $this->db->where('budgetH_penerimaID', $post['penerimaID']);
        $query = $this->db->get();
        return $query;

    }

    //Menampilkan QuoDetail Berdasarkan quoID
    public function getBudgetHonorbyID($id){
        $this->db->from('tb_int_honorarium_budgethonor');
        $this->db->where_in('budgethonorNo', $id);
        $this->db->join('tb_status', 'tb_status.statusID = tb_int_honorarium_budgethonor.budgetH_statusID');
        $query = $this->db->get();
        return $query;
    }

    public function statusBudgetHonor($post){
        $this->db->from('tb_int_honorarium_budgethonor');
        $this->db->where('budgethonorNo', $post['budgetHID']);
        $this->db->order_by('waktu', 'DESC');
        $query = $this->db->get();
        return $query;
    }

    public function addBudgetHonor($post){
        $params = array(     
            'budgethonorNo'       => $post['id'],
            'budgetH_petugasID'  => $post['petugasID'],
            'budgetH_pengirimID' => $post['pengirimID'],
            'budgetH_penerimaID' => $post['penerimaID'],
            'budgetH_statusID' => $post['statusID'],
            'budgetHFile'           => $post['budgetHFile'],
            'budgetHJumlah'            => $post['jumlah'],
            'budgetHStatusKonf'  => $post['statusKonfirmasi'],  
            'budgetHComment'  => $post['comment'],  
        );
        $query = $this->db->insert('tb_int_honorarium_budgethonor', $params);
        return $query;
    }

    //TimeOut
    //Menampilkan quoDetailID yang Maximal atau yang paling besar, berdasarkan quoD_penerimaID yang login
    public function getMarFRDByPenerimaIDMax($id){
        $this->db->select_max('budgethonorID');
        $this->db->from('tb_int_honorarium_budgethonor');
        $this->db->where('budgetH_penerimaID', $id);
        $this->db->group_by('budgethonorNo');
        $this->db->order_by('budgethonorID', 'DESC');
        $query = $this->db->get();
        return $query; 
    }

    //Menampilkan data FR Detail Marine berdasarkan ID
    public function getMarFRDByID($id){
        $this->db->from('tb_int_honorarium_budgethonor');
        $this->db->where_in('budgethonorID', $id);
        $this->db->join('tb_petugas', 'tb_petugas.petugasID = tb_int_honorarium_budgethonor.budgetH_petugasID');
        $this->db->join('tb_status', 'tb_status.statusID = tb_int_honorarium_budgethonor.budgetH_statusID');
        $this->db->order_by('budgethonorID', 'DESC');
        $query = $this->db->get();
        return $query;
    }

    //Menampilkan data FR berdasarkan quoD_pengirimID yang login dan quoD_quoID, kemudian urutkan quoDetailID Desc
    public function getMarFRDByPengirimID($id, $petugas){
        $this->db->from('tb_int_honorarium_budgethonor');
        $this->db->where('budgetH_pengirimID', $petugas);
        $this->db->where_in('budgethonorNo', $id);
        $this->db->join('tb_petugas', 'tb_petugas.petugasID = tb_int_honorarium_budgethonor.budgetH_petugasID');
        $this->db->join('tb_status', 'tb_status.statusID = tb_int_honorarium_budgethonor.budgetH_statusID');
        // $this->db->order_by("quoDetailID", "DESC");
        $query = $this->db->get();
        return $query;
    }

    //Menampilkan data FR berdasarkan quoD_penerima yang login dan quoD_quoID, kemudian urutkan quoDetailID Desc
    public function getMarFRDByPenerimaID($id, $petugas){
        $this->db->from('tb_int_honorarium_budgethonor');
        $this->db->where('budgetH_penerimaID', $petugas);
        $this->db->where_in('budgethonorNo', $id);
        $this->db->join('tb_petugas', 'tb_petugas.petugasID = tb_int_honorarium_budgethonor.budgetH_petugasID');
        $this->db->join('tb_status', 'tb_status.statusID = tb_int_honorarium_budgethonor.budgetH_statusID');
        $this->db->order_by("budgethonorID", "DESC");
        $query = $this->db->get();
        return $query;
    }

     //Mengubah status frMarD_statusID
     public function setMarFRDStatus($post){
        $params = array(     
            'budgetH_statusID'          => $post['status'],
        );
        $this->db->where('budgethonorID', $post['quoProsesID']);
        $query = $this->db->update('tb_int_honorarium_budgethonor', $params);
        return $query;
    }

     //Menampilkan quoDetailID yang Maximal atau yang paling besar, berdasarkan quoD_quoID dan quoD_penerimaID yang login
     public function getMarFRDByIDMax($id){
        $this->db->select_max('budgethonorID');
        $this->db->from('tb_int_honorarium_budgethonor');
        $this->db->where_in('budgethonorNo', $id);
        $this->db->group_by('budgethonorNo');
        $this->db->order_by('budgethonorID', 'DESC');
        $query = $this->db->get();
        return $query; 
    }

    //Menampilkan data FR Detail Marine berdasarkan FR ID
    public function getMarFRDByFRID($id){
        $this->db->from('tb_int_honorarium_budgethonor');
        $this->db->where_in('budgethonorNo', $id);
        $this->db->join('tb_petugas', 'tb_petugas.petugasID = tb_int_honorarium_budgethonor.budgetH_petugasID');
        $this->db->join('tb_status', 'tb_status.statusID = tb_int_honorarium_budgethonor.budgetH_statusID');
        // $this->db->order_by('quoDetailID', 'DESC');
        $query = $this->db->get();
        return $query;
    }

    //Menampilkan quoDetailID yang Maximal atau yang paling besar, berdasarkan quoD_quoID dan quoD_penerimaID yang login
    public function getMarFRDByPenerimaIDMaxID($id, $petugas){
        $this->db->select_max('budgethonorID');
        $this->db->from('tb_int_honorarium_budgethonor');
        $this->db->where_in('budgethonorNo', $id);
        $this->db->where('budgetH_penerimaID', $petugas);
        $this->db->group_by('budgethonorNo');
        $this->db->order_by('budgethonorID', 'DESC');
        $query = $this->db->get();
        return $query; 
    }

    //Menampilkan quoDetailID yang Maximal atau yang paling besar, berdasarkan quoD_quoID dan quoD_pengirimID yang login
    public function getMarFRDByPengirimIDMax($id, $petugas){
        $this->db->select_max('budgethonorID');
        $this->db->from('tb_int_honorarium_budgethonor');
        $this->db->where_in('budgethonorNo', $id);
        $this->db->where('budgetH_pengirimID', $petugas);
        $this->db->group_by('budgethonorNo');
        $this->db->order_by('budgethonorID', 'DESC');
        $query = $this->db->get();
        return $query; 
    }







     //End Budget Honor
    ///////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////

     //////////////////////////////Approval///////////////////////////////////////

     public function getAllApproval(){
        $this->db->select('*');
        $this->db->from('tb_int_honorarium_approval');
       
        $this->db->join('tb_petugas', 'tb_petugas.petugasID = tb_int_honorarium_approval.aproval_petugasID');
        $query = $this->db->get();

        return $query;

    }

    public function getAllNewApproval($petugas){
        $this->db->from('tb_int_honorarium_approval');
        $this->db->where('aproval_penerimaID', $petugas);
        $this->db->where('aprovalStatusKonf', 'send');
        $this->db->join('tb_int_honorarium_budgethonor', 'tb_int_honorarium_budgethonor.budgethonorID = tb_int_honorarium_approval.approv_budgethonorID');
        $this->db->join('tb_petugas', 'tb_petugas.petugasID = tb_int_honorarium_approval.aproval_petugasID');
        $this->db->join('tb_status', 'tb_status.statusID = tb_int_honorarium_approval.aproval_statusID');
        $query = $this->db->get();
        return $query;
    }

    public function getAllApprovalID($id){
        $this->db->from('tb_int_honorarium_approval');
        $this->db->where('approvDetailID', $id);
        $this->db->join('tb_int_honorarium_budgethonor', 'tb_int_honorarium_budgethonor.budgethonorID = tb_int_honorarium_approval.approv_budgethonorID');
        $this->db->join('tb_petugas', 'tb_petugas.petugasID = tb_int_honorarium_approval.aproval_petugasID');
        $this->db->join('tb_status', 'tb_status.statusID = tb_int_honorarium_approval.aproval_statusID');
        $query = $this->db->get();
        return $query;

    }

    public function addApproval($post){
        

        $params = array(     
            'pengeluaranID'           => $post['refID'],
            'approv_budgethonorID'    => $post['budgethonorID'],
            'aproval_petugasID'       => $post['petugasID'],
            'aproval_pengirimID'      => $post['pengirimID'],
            'aproval_penerimaID'      => $post['penerimaID'],
            'aproval_statusID'        => $post['statusID'],
            'aprovalFile'             => $post['approvalFile'],
            'aprovalStatusKonf'       => $post['statuskonf'],
            'approvalComment'         => $post['comment'],
            
        );
        $query = $this->db->insert('tb_int_honorarium_approval', $params);
        return $query;
    }


    public function changeStatusApproval($post){
        $data = array(
            'aprovalStatusKonf'   => $post['statusConf'],  
        );
        $this->db->where('approvDetailID', $post['quoProsesID']);
        $query = $this->db->update('tb_int_honorarium_approval',$data);
    }

    //////////////////////////////Approval///////////////////////////////////////


    //////////////////////////////Inventaris///////////////////////////////////////
     //Budget Honor

     //Menampilkan quoID yang paling besar
    public function getAllMaxINVT(){
        $this->db->select_max('inventarisID');
        $this->db->from('tb_int_honorarium_inventaris');
        $query = $this->db->get();
        return $query;
    }


     public function getInventarisID($id){
        $this->db->from('tb_int_honorarium_inventaris');
        $this->db->where('inventarisID', $id);
        $query = $this->db->get();
        return $query;
    }
    

    public function addInventarisID($post){
        $params = array(     
            'inventarisID' => $post['id'],
            'invent_approvDetailID' => $post['approvDetailID'],
            'invent_budgethonorID' => $post['budgethonorID']
        );
        $query = $this->db->insert('tb_int_honorarium_inventaris',$params);
        return $query;
    }

    public function getAllInventaris(){
        $this->db->select('*');
        $this->db->from('tb_int_honorarium_inventarisdetail');
        $this->db->join('tb_int_honorarium_inventaris', 'tb_int_honorarium_inventaris.inventarisID = tb_int_honorarium_inventarisdetail.inventD_inventarisID');
        $this->db->join('tb_petugas', 'tb_petugas.petugasID = tb_int_honorarium_inventarisdetail.inventD_petugasID');
        $this->db->join('tb_status', 'tb_status.statusID = tb_int_honorarium_inventarisdetail.inventD_statusID');
        $query = $this->db->get();
        return $query;
    }

    public function getAllNewInventaris($petugas){
        $this->db->from('tb_int_honorarium_inventarisdetail');
        $this->db->where('inventD_penerimaID', $petugas);
        $this->db->where('inventDstatusKonf', 'send');
        $this->db->join('tb_int_honorarium_inventaris', 'tb_int_honorarium_inventaris.inventarisID = tb_int_honorarium_inventarisdetail.inventD_inventarisID');
        $this->db->join('tb_petugas', 'tb_petugas.petugasID = tb_int_honorarium_inventarisdetail.inventD_petugasID');
        $this->db->join('tb_status', 'tb_status.statusID = tb_int_honorarium_inventarisdetail.inventD_statusID');
        $query = $this->db->get();
        return $query;
    }

    public function getAllInventarisID($id){
        $this->db->from('tb_int_honorarium_inventarisdetail');
        $this->db->where('inventarisdetailID', $id);
        $this->db->join('tb_int_honorarium_inventaris', 'tb_int_honorarium_inventaris.inventarisID = tb_int_honorarium_inventarisdetail.inventD_inventarisID');
        $this->db->join('tb_petugas', 'tb_petugas.petugasID = tb_int_honorarium_inventarisdetail.inventD_petugasID');
        $this->db->join('tb_status', 'tb_status.statusID = tb_int_honorarium_inventarisdetail.inventD_statusID');
        $query = $this->db->get();
        return $query;
    }

    public function jumlahInventarisProses($post){
        $this->db->select('*');
        $this->db->from('tb_int_honorarium_inventarisdetail');
        $this->db->where('inventD_inventarisID', $post['inventarisID']);
        $this->db->where('inventD_petugasID', $post['petugasID']);
        $this->db->where('inventD_pengirimID', $post['pengirimID']);
        $this->db->where('inventD_penerimaID', $post['penerimaID']);
        $query = $this->db->get();
        return $query;

    }
    //Menampilkan QuoDetail Berdasarkan quoID
    public function getInventarisProsesID($id){
        $this->db->from('tb_int_honorarium_inventarisdetail');
        $this->db->where_in('inventD_inventarisID', $id);
        $this->db->join('tb_int_honorarium_inventaris', 'tb_int_honorarium_inventaris.inventarisID = tb_int_honorarium_inventarisdetail.inventD_inventarisID');
        $this->db->join('tb_petugas', 'tb_petugas.petugasID = tb_int_honorarium_inventarisdetail.inventD_petugasID');
        $this->db->join('tb_status', 'tb_status.statusID = tb_int_honorarium_inventarisdetail.inventD_statusID');
        $query = $this->db->get();
        return $query;
    }

    public function addInventarisProses($post){
        $params = array(     
            'inventD_inventarisID'  => $post['inventarisID'],
            'inventD_petugasID'     => $post['petugasID'],
            'inventD_pengirimID'    => $post['pengirimID'],
            'inventD_penerimaID'    => $post['penerimaID'],
            'inventDFile'           => $post['inventarisFile'],
            'inventDJumlah'         => $post['jumlah'],
            'inventD_statusID'      => $post['status'],
            'inventDstatusKonf'     => $post['statuskonf'],
            'inventComment'         => $post['comment'],
        );
        $query = $this->db->insert('tb_int_honorarium_inventarisdetail', $params);
        return $query;
    }


    //TimeOut
    //Menampilkan quoDetailID yang Maximal atau yang paling besar, berdasarkan quoD_penerimaID yang login
    public function getINVTByPenerimaIDMax($id){
        $this->db->select_max('inventarisdetailID');
        $this->db->from('tb_int_honorarium_inventarisdetail');
        $this->db->where('inventD_penerimaID', $id);
        $this->db->group_by('inventD_inventarisID');
        $this->db->order_by('inventarisdetailID', 'DESC');
        $query = $this->db->get();
        return $query; 
    }

    //Menampilkan data FR Detail Marine berdasarkan ID
    public function getINVTByID($id){
        $this->db->from('tb_int_honorarium_inventarisdetail');
        $this->db->where_in('inventarisdetailID', $id);
        $this->db->join('tb_int_honorarium_inventaris', 'tb_int_honorarium_inventaris.inventarisID = tb_int_honorarium_inventarisdetail.inventD_inventarisID');
        $this->db->join('tb_petugas', 'tb_petugas.petugasID = tb_int_honorarium_inventarisdetail.inventD_petugasID');
        $this->db->join('tb_status', 'tb_status.statusID = tb_int_honorarium_inventarisdetail.inventD_statusID');
        $this->db->order_by('inventarisdetailID', 'DESC');
        $query = $this->db->get();
        return $query;
    }

    //Menampilkan data FR berdasarkan quoD_pengirimID yang login dan quoD_quoID, kemudian urutkan quoDetailID Desc
    public function getINVTByPengirimID($id, $petugas){
        $this->db->from('tb_int_honorarium_inventarisdetail');
        $this->db->where('inventD_pengirimID', $petugas);
        $this->db->where_in('inventD_inventarisID', $id);
        $this->db->join('tb_int_honorarium_inventaris', 'tb_int_honorarium_inventaris.inventarisID = tb_int_honorarium_inventarisdetail.inventD_inventarisID');
        $this->db->join('tb_petugas', 'tb_petugas.petugasID = tb_int_honorarium_inventarisdetail.inventD_petugasID');
        $this->db->join('tb_status', 'tb_status.statusID = tb_int_honorarium_inventarisdetail.inventD_statusID');
        // $this->db->order_by("quoDetailID", "DESC");
        $query = $this->db->get();
        return $query;
    }

    //Menampilkan data FR berdasarkan quoD_penerima yang login dan quoD_quoID, kemudian urutkan quoDetailID Desc
    public function getINVTByPenerimaID($id, $petugas){
        $this->db->from('tb_int_honorarium_inventarisdetail');
        $this->db->where('inventD_penerimaID', $petugas);
        $this->db->where_in('inventD_inventarisID', $id);
        $this->db->join('tb_int_honorarium_inventaris', 'tb_int_honorarium_inventaris.inventarisID = tb_int_honorarium_inventarisdetail.inventD_inventarisID');
        $this->db->join('tb_petugas', 'tb_petugas.petugasID = tb_int_honorarium_inventarisdetail.inventD_petugasID');
        $this->db->join('tb_status', 'tb_status.statusID = tb_int_honorarium_inventarisdetail.inventD_statusID');
        $this->db->order_by("inventarisdetailID", "DESC");
        $query = $this->db->get();
        return $query;
    }

    //Mengubah status frMarD_statusID
    public function setINVTStatus($post){
        $params = array(     
            'inventD_statusID'          => $post['status'],
        );
        $this->db->where('inventarisdetailID', $post['quoProsesID']);
        $query = $this->db->update('tb_int_honorarium_inventarisdetail', $params);
        return $query;
    }

    //Menampilkan quoDetailID yang Maximal atau yang paling besar, berdasarkan quoD_quoID dan quoD_pengirimID yang login
    public function getINVTByPengirimIDMax($id, $petugas){
        $this->db->select_max('inventarisdetailID');
        $this->db->from('tb_int_honorarium_inventarisdetail');
        $this->db->where_in('inventD_inventarisID', $id);
        $this->db->where('inventD_pengirimID', $petugas);
        $this->db->group_by('inventD_inventarisID');
        $this->db->order_by('inventarisdetailID', 'DESC');
        $query = $this->db->get();
        return $query; 
    }

     //Menampilkan quoDetailID yang Maximal atau yang paling besar, berdasarkan quoD_quoID dan quoD_penerimaID yang login
     public function getINVTByIDMax($id){
        $this->db->select_max('inventarisdetailID');
        $this->db->from('tb_int_honorarium_inventarisdetail');
        $this->db->where_in('inventD_inventarisID', $id);
        $this->db->group_by('inventD_inventarisID');
        $this->db->order_by('inventarisdetailID', 'DESC');
        $query = $this->db->get();
        return $query; 
    }

    //Menampilkan data FR Detail Marine berdasarkan FR ID
    public function getINVTByFRID($id){
        $this->db->from('tb_int_honorarium_inventarisdetail');
        $this->db->where_in('inventD_inventarisID', $id);
        $this->db->join('tb_int_honorarium_inventaris', 'tb_int_honorarium_inventaris.inventarisID = tb_int_honorarium_inventarisdetail.inventD_inventarisID');
        $this->db->join('tb_petugas', 'tb_petugas.petugasID = tb_int_honorarium_inventarisdetail.inventD_petugasID');
        $this->db->join('tb_status', 'tb_status.statusID = tb_int_honorarium_inventarisdetail.inventD_statusID');
        // $this->db->order_by('quoDetailID', 'DESC');
        $query = $this->db->get();
        return $query;
    }

    public function changeStatusINVT($post){
        $data = array(
            'inventDstatusKonf'   => $post['statusConf'],  
        );
        $this->db->where('inventarisdetailID', $post['quoProsesID']);
        $query = $this->db->update('tb_int_honorarium_inventarisdetail',$data);
    }


    public function uploadTimeWorkINVT($post){
        $data = array(
            'inventDWaktu_start'   => $post['waktustart'],  
            'inventDWaktu_end'     => $post['waktuend'],
        );
        $this->db->where('inventarisdetailID', $post['quoProsesID']);
        $query = $this->db->update('tb_int_honorarium_inventarisdetail',$data);
    }



     //End Inventaris
    ///////////////////////////////////////////////////////////////////////

}
    



   


    
    
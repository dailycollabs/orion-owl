<?php

class InvoicingApproval_m extends CI_Model{

//////////////////////////////////////MARINE////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////
  
    public function getInvMarByID($id){
        $this->db->from('tb_marine_inv_draft');
        $this->db->where('invMarID', $id);
        $this->db->join('tb_spk', 'tb_spk.spkID = tb_marine_inv_draft.invMar_spkID');
        $query = $this->db->get();
        return $query;
    }


////////////////////////////////////////////////////////////////////////////////////////////////

////////////////////////////////////////////////////////////////////////////////////////////////
    public function getInvMarByNoDesc($id){
        $this->db->from('tb_marine_inv_draft');
        $this->db->where('invMarNo', $id);
        $this->db->order_by('invMarID', 'DESC');
        $query = $this->db->get();
        return $query;
    }

////////////////////////////////////////////////////////////////////////////////////////////////

////////////////////////////////////////////////////////////////////////////////////////////////
    public function getInvMarByNo($id){
        $this->db->from('tb_marine_inv_draft');
        $this->db->where('invMarNo', $id);
        $query = $this->db->get();
        return $query;
    }
////////////////////////////////////////////////////////////////////////////////////////////////

////////////////////////////////////////////////////////////////////////////////////////////////
    public function getInvMarByFRID($id){
        $this->db->from('tb_marine_inv_draft');
        $this->db->where_in('invMar_frDetailID', $id);
        $query = $this->db->get();
        return $query;
    }

////////////////////////////////////////////////////////////////////////////////////////////////

////////////////////////////////////////////////////////////////////////////////////////////////
    public function addInvMar($post){
        $params = array(     
            'invMarID'              => $post['invID'],
            'invMarNo'              => $post['invNo'],
            'invMarRefNo'           => $post['invRefNo'],
            'invMar_frDetailID'     => $post['frDetailID'],
            'invMar_spkID'          => $post['spkID'],
            'invMar_jobdaDetailID'  => $post['jobdaDetailID'],
            'invMar_quoDetailID'    => $post['quoDetailID'],
            'invMar_orderID'        => $post['orderID'],
            'invMar_bidangID'       => $post['bidangID']  
        );
        $query = $this->db->insert('tb_marine_inv_draft', $params);
        return $query;
    }

////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////MAX//////////////////////////////////////////

////////////////////////////////////////////////////////////////////////////////////////////////
     //Menampilkan quoID yang paling besar
     public function getInvMarMax(){
        $this->db->select_max('invMarID');
        $this->db->from('tb_marine_inv_draft');
        $query = $this->db->get();
        return $query;
    }
////////////////////////////////////////////////////////DETAIL INV MARINE////////////////////////

////////////////////////////////////////////////////////////////////////////////////////////////
    public function getInvDMarByID($id){
        $this->db->from('tb_marine_inv_draftdetail');
        $this->db->where('invMarDetailID', $id);
        $this->db->join('tb_marine_inv_draft', 'tb_marine_inv_draft.invMarID = tb_marine_inv_draftdetail.invMarD_invID');
        $this->db->join('tb_petugas', 'tb_petugas.petugasID = tb_marine_inv_draftdetail.invMarD_petugasID');
        $this->db->join('tb_status', 'tb_status.statusID =  tb_marine_inv_draftdetail.invMarD_statusID');
        $query = $this->db->get();
        return $query;
    }

////////////////////////////////////////////////////////////////////////////////////////////////

////////////////////////////////////////////////////////////////////////////////////////////////
    //Menampilkan data FR Detail Marine berdasarkan ID
    public function getInvDMarByIDDesc($id){
        $this->db->from('tb_marine_inv_draftdetail');
        $this->db->where_in('invMarDetailID', $id);
        $this->db->join('tb_marine_inv_draft', 'tb_marine_inv_draft.invMarID = tb_marine_inv_draftdetail.invMarD_invID');
        $this->db->join('tb_petugas', 'tb_petugas.petugasID = tb_marine_inv_draftdetail.invMarD_petugasID');
        $this->db->join('tb_status', 'tb_status.statusID = tb_marine_inv_draftdetail.invMarD_statusID');
        $this->db->order_by('invMarDetailID', 'DESC');
        $query = $this->db->get();
        return $query;
    }

    

////////////////////////////////////////////////////////////////////////////////////////////////

////////////////////////////////////////////////////////////////////////////////////////////////
    //Menampilkan data FR Detail Marine berdasarkan FR ID
    public function getInvDMarByInvID($id){
        $this->db->from('tb_marine_inv_draftdetail');
        $this->db->where_in('invMarD_invID', $id);
        $this->db->join('tb_marine_inv_draft', 'tb_marine_inv_draft.invMarID = tb_marine_inv_draftdetail.invMarD_invID');
        $this->db->join('tb_petugas', 'tb_petugas.petugasID = tb_marine_inv_draftdetail.invMarD_petugasID');
        $this->db->join('tb_status', 'tb_status.statusID = tb_marine_inv_draftdetail.invMarD_statusID');
        $query = $this->db->get();
        return $query;
    }

    
////////////////////////////////////////////////////////////////////////////////////////////////

////////////////////////////////////////////////////////////////////////////////////////////////
    public function getInvDMarByInvIDDesc($id){
        $this->db->from('tb_marine_inv_draftdetail');
        $this->db->where_in('invMarD_invID', $id);
        $this->db->join('tb_marine_inv_draft', 'tb_marine_inv_draft.invMarID = tb_marine_inv_draftdetail.invMarD_invID');
        $this->db->join('tb_petugas', 'tb_petugas.petugasID = tb_marine_inv_draftdetail.invMarD_petugasID');
        $this->db->join('tb_status', 'tb_status.statusID =  tb_marine_inv_draftdetail.invMarD_statusID');
        $this->db->order_by('invMarDetailID', 'DESC');
        $query = $this->db->get();
        return $query;
    }

////////////////////////////////////////////////////////////////////////////////////////////////

////////////////////////////////////////////////////////////////////////////////////////////////
    public function getInvDMarByPetugasID($petugas){
        $this->db->from('tb_marine_inv_draftdetail');
        $this->db->where('invMarD_penerimaID', $petugas);
        $this->db->or_where('invMarD_pengirimID', $petugas);
        $this->db->order_by('invMarD_invID', 'DESC');
        $this->db->join('tb_marine_inv_draft', 'tb_marine_inv_draft.invMarID = tb_marine_inv_draftdetail.invMarD_invID');
        $this->db->join('tb_petugas', 'tb_petugas.petugasID = tb_marine_inv_draftdetail.invMarD_petugasID');
        $this->db->join('tb_status', 'tb_status.statusID =  tb_marine_inv_draftdetail.invMarD_statusID');
        $query = $this->db->get();
        return $query;
    }

    public function getInvDMarByPetugasIDDesc($petugas){
        $this->db->from('tb_marine_inv_draftdetail');
        $this->db->where('invMarD_penerimaID', $petugas);
        $this->db->or_where('invMarD_pengirimID', $petugas);
        $this->db->order_by('invMarDetailID', 'DESC');
        $this->db->join('tb_marine_inv_draft', 'tb_marine_inv_draft.invMarID = tb_marine_inv_draftdetail.invMarD_invID');
        $this->db->join('tb_petugas', 'tb_petugas.petugasID = tb_marine_inv_draftdetail.invMarD_petugasID');
        $this->db->join('tb_status', 'tb_status.statusID =  tb_marine_inv_draftdetail.invMarD_statusID');
        $query = $this->db->get();
        return $query;
    }

////////////////////////////////////////////////////////////////////////////////////////////////

////////////////////////////////////////////////////////////////////////////////////////////////
    public function getInvDMarNotifNew($petugas){
        $status = array('SC1','RV1', 'NW1');
        $this->db->from('tb_marine_inv_draftdetail');
        $this->db->where('invMarD_penerimaID', $petugas);
        $this->db->where('statusKonfirmasi', 'send');
        $this->db->where_in('invMarD_statusID', $status);
        $query = $this->db->get();
        return $query;
    }
////////////////////////////////////////////////////////////////////////////////////////////////

////////////////////////////////////////////////////////////////////////////////////////////////
    public function getInvDMarNotifNewFailed($petugas){
        $this->db->from('tb_marine_inv_draftdetail');
        $this->db->where('invMarD_penerimaID', $petugas);
        $this->db->where('statusKonfirmasi', 'send');
        $this->db->where_in('invMarD_statusID', 'FD1');
        $query = $this->db->get();
        return $query;
    }
    
////////////////////////////////////////////////////////////////////////////////////////////////

////////////////////////////////////////////////////////////////////////////////////////////////
    public function getInvDMarJumlah($post){
        $this->db->select('*');
        $this->db->from('tb_marine_inv_draftdetail');
        $this->db->where('invMarD_invID', $post['invID']);
        $this->db->where('invMarD_petugasID', $post['petugasID']);
        $this->db->where('invMarD_pengirimID', $post['pengirimID']);
        $this->db->where('invMarD_penerimaID', $post['penerimaID']);
        $query = $this->db->get();
        return $query;
    }

////////////////////////////////////////////////////////////////////////////////////////////////



////////////////////////////////////////////////////////////////////////////////////////////////
    public function addInvDMar($post){
        $params = array(     
            'invMarD_invID'      => $post['invID'],
            'invMarD_petugasID'  => $post['petugasID'],
            'invMarD_pengirimID' => $post['pengirimID'],
            'invMarD_penerimaID' => $post['penerimaID'],
            'invMarD_statusID'   => $post['status'],
            'invMarFile'         => $post['draftInvFile'],     
            'jumlah'             => $post['jumlah'],
            'statusKonfirmasi'   => $post['statuskonf'],
            'comment'            => $post['comentINV'],
        );
        $query = $this->db->insert('tb_marine_inv_draftdetail', $params);
        return $query;
    }

////////////////////////////////////////////////////////////////////////////////////////////////

////////////////////////////////////////////////////////////////////////////////////////////////
    public function getInvDMarByPetugasIDNew($post){
        $this->db->from('tb_marine_inv_draftdetail');
        $this->db->where('invMarD_penerimaID', $post['penerima']);
        $this->db->where('invMarD_pengirimID', $post['pengirim']);
        $this->db->where('statusKonfirmasi', 'send');
        $this->db->join('tb_marine_inv_draft', 'tb_marine_inv_draft.invMarID = tb_marine_inv_draftdetail.invMarD_invID');
        $this->db->join('tb_petugas', 'tb_petugas.petugasID = tb_marine_inv_draftdetail.invMarD_petugasID');
        $this->db->join('tb_status', 'tb_status.statusID = tb_marine_inv_draftdetail.invMarD_statusID');
        $this->db->group_by('invMarD_invID');
        $this->db->order_by('waktu', 'DESC');
        $query = $this->db->get();
        return $query;
    }

////////////////////////////////////////////////////////////////////////////////////////////////

////////////////////////////////////////////////////////////////////////////////////////////////
    public function getInvDMarApprovByPetugasIDNew($post){
        $this->db->from('tb_marine_inv_draftdetail');
        $this->db->where('invMarD_penerimaID', $post['penerima']);
        $this->db->where('invMarD_pengirimID', $post['pengirim']);
        $this->db->where('statusKonfirmasi', 'send');
        $this->db->join('tb_marine_inv_draft', 'tb_marine_inv_draft.invMarID = tb_marine_inv_draftdetail.invMarD_invID');
        $this->db->join('tb_petugas', 'tb_petugas.petugasID = tb_marine_inv_draftdetail.invMarD_petugasID');
        $this->db->join('tb_status', 'tb_status.statusID = tb_marine_inv_draftdetail.invMarD_statusID');
        $this->db->group_by('invMarD_invID');
        $query = $this->db->get();
        return $query;
    }

////////////////////////////////////////////////////////////////////////////////////////////////

////////////////////////////////////////////////////////////////////////////////////////////////
    //Merubah data FR Detail Marine status Konfirmasi dan menambahkan waktu start dan waktu End 
    public function setInvDMarStatusKonf($post){
        $data = array(
            'statusKonfirmasi'   => $post['statusConf'],  
            'waktu_start'        => $post['waktustart'],  
            'waktu_end'          => $post['waktuend'],
        );
        $this->db->where('invMarDetailID', $post['frDetailID']);
        $query = $this->db->update('tb_marine_inv_draftdetail',$data);
    }
////////////////////////////////////////////////////////////////////////////////////////////////

////////////////////////////////////////////////////////////////////////////////////////////////

    /////////////////////////////////////////////////////APProval MARINE////////////////////////////////////
    // public function getApprovInvNewMarine($post){
    //     $this->db->select('*');
    //     $this->db->from('tb_marine_inv_draftdetail');
    //     $this->db->where('invD_pengirimID', $post['pengirimID']);
    //     $this->db->where('invD_penerimaID', $post['penerimaID']);
    //     $this->db->where('status', 'approval');
    //     $query = $this->db->get();
    //     return $query;
    // }

    // public function getApprovInvNewMarine($post){
    //     $this->db->select('*');
    //     $this->db->from('tb_marine_inv_draftdetail');
    //     $this->db->where('invD_pengirimID', $post['pengirimID']);
    //     $this->db->where('invD_penerimaID', $post['penerimaID']);
    //     $this->db->where('status', 'approval');
    //     $query = $this->db->get();
    //     return $query;
    // }

////////////////////////////////////////////////////////////////////////////////////////////////

////////////////////////////////////////////////////////////////////////////////////////////////
    //Menampilkan data FR berdasarkan frMarD_pengirimID yang login dan frMarD_frID, kemudian urutkan frMarDetailID Desc
    public function getInvDMarByPengirimInvID($id, $petugas){
        $this->db->from('tb_marine_inv_draftdetail');
        $this->db->where('invMarD_pengirimID', $petugas);
        $this->db->where_in('invMarD_invID', $id);
        $this->db->join('tb_marine_inv_draft', 'tb_marine_inv_draft.invMarID = tb_marine_inv_draftdetail.invMarD_invID');
        $this->db->join('tb_petugas', 'tb_petugas.petugasID = tb_marine_inv_draftdetail.invMarD_petugasID');
        $this->db->join('tb_status', 'tb_status.statusID = tb_marine_inv_draftdetail.invMarD_statusID');
        $query = $this->db->get();
        return $query;
    }


////////////////////////////////////////////////////////////////////////////////////////////////

////////////////////////////////////////////////////////////////////////////////////////////////
    //Menampilkan data FR berdasarkan quoD_penerima yang login dan quoD_quoID, kemudian urutkan quoDetailID Desc
    public function getInvDMarByPenerimaInvID($id, $petugas){
        $this->db->from('tb_marine_inv_draftdetail');
        $this->db->where('invMarD_penerimaID', $petugas);
        $this->db->where_in('invMarD_invID', $id);
        $this->db->join('tb_marine_inv_draft', 'tb_marine_inv_draft.invMarID = tb_marine_inv_draftdetail.invMarD_invID');
        $this->db->join('tb_petugas', 'tb_petugas.petugasID = tb_marine_inv_draftdetail.invMarD_petugasID');
        $this->db->join('tb_status', 'tb_status.statusID = tb_marine_inv_draftdetail.invMarD_statusID');
        $this->db->order_by("invMarDetailID", "DESC");
        $query = $this->db->get();
        return $query;
    }

////////////////////////////////////////////////////////////////////////////////////////////////

////////////////////////////////////////////////////////////////////////////////////////////////
     //Mengubah status frMarD_statusID
     public function setInvDMarStatus($post){
        $params = array(     
            'invMarD_statusID'          => $post['status'],
        );
        $this->db->where('invMarDetailID', $post['frDetailID']);
        $query = $this->db->update('tb_marine_inv_draftdetail', $params);
        return $query;
    }

////////////////////////////////////////////////////////////////////////////////////////////////


////////////////////////////////////////MAX////////////////////////////////////////////////////

////////////////////////////////////////////////////////////////////////////////////////////////
    public function getInvDMarMaxByPetugasID($petugas){
        $this->db->select_max('invMarDetailID');
        $this->db->from('tb_marine_inv_draftdetail');
        $this->db->where('invMarD_penerimaID', $petugas);
        $this->db->or_where('invMarD_pengirimID', $petugas);
        $this->db->group_by('invMarD_invID');
        $this->db->order_by('invMarDetailID', 'DESC');
        $query = $this->db->get();
        return $query;
    }
////////////////////////////////////////////////////////////////////////////////////////////////

////////////////////////////////////////////////////////////////////////////////////////////////
    //Menampilkan frMarDetailID yang Maximal atau yang paling besar, berdasarkan frMarD_frID dan frMarD_penerimaID yang login
    public function getInvDMarMaxByPenerimaInvID($id, $petugas){
        $this->db->select_max('invMarDetailID');
        $this->db->from('tb_marine_inv_draftdetail');
        $this->db->where_in('invMarD_invID', $id);
        $this->db->where('invMarD_penerimaID', $petugas);
        $this->db->group_by('invMarD_invID');
        $this->db->order_by('invMarDetailID', 'DESC');
        $query = $this->db->get();
        return $query; 
    }
////////////////////////////////////////////////////////////////////////////////////////////////

////////////////////////////////////////////////////////////////////////////////////////////////
    //Menampilkan frMarDetailID yang Maximal atau yang paling besar, berdasarkan frMarD_frID dan frMarD_pengirimID yang login
    public function getInvDMarMaxByPengirimInvID($id, $petugas){
        $this->db->select_max('invMarDetailID');
        $this->db->from('tb_marine_inv_draftdetail');
        $this->db->where_in('invMarD_invID', $id);
        $this->db->where('invMarD_pengirimID', $petugas);
        $this->db->group_by('invMarD_invID');
        $this->db->order_by('invMarDetailID', 'DESC');
        $query = $this->db->get();
        return $query; 
    }
////////////////////////////////////////////////////////////////////////////////////////////////

////////////////////////////////////////////////////////////////////////////////////////////////
    public function getInvDMarMaxByInvID($id){
        $this->db->select_max('invMarDetailID');
        $this->db->from('tb_marine_inv_draftdetail');
        $this->db->where_in('invMarD_invID', $id);
        $this->db->group_by('invMarD_invID');
        $this->db->order_by('invMarDetailID', 'DESC');
        $query = $this->db->get();
        return $query; 
    }

    
////////////////////////////////////////////////////////////////////////////////////////////////

///////////////////////////////////////////////////////////////////////////////////////////////
    //Menampilkan frMarDetailID yang Maximal atau yang paling besar, berdasarkan frMarD_penerimaID yang login
    public function getInvDMarMaxByPenerimaID($id){
        $this->db->select_max('invMarDetailID');
        $this->db->from('tb_marine_inv_draftdetail');
        $this->db->where('invMarD_penerimaID', $id);
        $this->db->group_by('invMarD_invID');
        $this->db->order_by('invMarDetailID', 'DESC');
        $query = $this->db->get();
        return $query; 
    }

//////////////////////////////////////////////////////////////////////////////////////////////////////////


//////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////MINERBA APPROVAL///////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////

////////////////////////////////////////////////////////////////////////////////////////////////
    public function getInvMinByFRID($id){
        $this->db->from('tb_minerba_inv_draft');
        $this->db->where_in('invMin_frDetailID', $id);
        $query = $this->db->get();
        return $query;
    }

////////////////////////////////////////////////////////////////////////////////////////////////

////////////////////////////////////////////////////////////////////////////////////////////////
    public function getInvMinByID($id){
        $this->db->from('tb_minerba_inv_draft');
        $this->db->where('invMinID', $id);
        $this->db->join('tb_order', 'tb_order.orderID = tb_minerba_inv_draft.invMin_orderID');
        $query = $this->db->get();
        return $query;
    }

////////////////////////////////////////////////////////////////////////////////////////////////

////////////////////////////////////////////////////////////////////////////////////////////////
    public function getInvMinByNoDesc($id){
        $this->db->from('tb_minerba_inv_draft');
        $this->db->where('invMinNo', $id);
        $this->db->order_by('invMinID', 'DESC');
        $query = $this->db->get();
        return $query;
    }

////////////////////////////////////////////////////////////////////////////////////////////////

////////////////////////////////////////////////////////////////////////////////////////////////
    public function addInvMin($post){
        $params = array(     
            'invMinID'              => $post['invID'],
            'invMinNo'              => $post['invNo'],
            'invMinRefNo'           => $post['invRefNo'],
            'invMin_frDetailID'     => $post['frDetailID'],
            'invMin_spkID'          => $post['spkID'],
            'invMin_jobdaDetailID'  => $post['jobdaDetailID'],
            'invMin_quoDetailID'    => $post['quoDetailID'],
            'invMin_orderID'        => $post['orderID'],
            'invMin_bidangID'       => $post['bidangID'],  
        );
        $query = $this->db->insert('tb_minerba_inv_draft', $params);
        return $query;
    }

////////////////////////////////////////////////////////////////////////////////////////////////

/////////////////////////////////////////////MAX///////////////////////////////////////////////////

////////////////////////////////////////////////////////////////////////////////////////////////
     //Menampilkan quoID yang paling besar
     public function getInvMinMax(){
        $this->db->select_max('invMinID');
        $this->db->from('tb_minerba_inv_draft');
        $query = $this->db->get();
        return $query;
    }

////////////////////////////////////////////////////////////////////////////////////////////////
    

////////////////////////////////////////////////////////DETAIL INV MINERBA/////////////////////////////////////////////////////////////////

////////////////////////////////////////////Detail////////////////////////////////////////////////

////////////////////////////////////////////////////////////////////////////////////////////////
    //Notifikasi New Minerba
    public function getInvDMinNotifNew($petugas){
        $status = array('SC1', 'NW1');
        $this->db->from('tb_minerba_inv_draftdetail');
        $this->db->where('invMinD_penerimaID', $petugas);
        $this->db->where('statusKonfirmasi', 'send');
        $this->db->where_in('invMinD_statusID', $status);
        $query = $this->db->get();
        return $query;
    }
////////////////////////////////////////////////////////////////////////////////////////////////

////////////////////////////////////////////////////////////////////////////////////////////////
    //Notifikasi New Failed Minerba
    public function getInvDMinNotifNewFailed($petugas){
        $this->db->from('tb_minerba_inv_draftdetail');
        $this->db->where('invMinD_penerimaID', $petugas);
        $this->db->where('statusKonfirmasi', 'send');
        $this->db->where_in('invMinD_statusID', 'FD1');
        $query = $this->db->get();
        return $query;
    }

////////////////////////////////////////////////////////////////////////////////////////////////
    //Menampilkan data FR Detail Marine berdasarkan ID
    public function getInvDMinByIDDesc($id){
        $this->db->from('tb_minerba_inv_draftdetail');
        $this->db->where_in('invMinDetailID', $id);
        $this->db->join('tb_minerba_inv_draft', 'tb_minerba_inv_draft.invMinID = tb_minerba_inv_draftdetail.invMinD_invID');
        $this->db->join('tb_petugas', 'tb_petugas.petugasID = tb_minerba_inv_draftdetail.invMinD_petugasID');
        $this->db->join('tb_status', 'tb_status.statusID = tb_minerba_inv_draftdetail.invMinD_statusID');
        $this->db->order_by('invMinDetailID', 'DESC');
        $query = $this->db->get();
        return $query;
    }
////////////////////////////////////////////////////////////////////////////////////////////////

////////////////////////////////////////////////////////////////////////////////////////////////
     //Menampilkan data FR Detail Marine berdasarkan FR ID
     public function getInvDMinByInvID($id){
        $this->db->from('tb_minerba_inv_draftdetail');
        $this->db->where_in('invMinD_invID', $id);
        $this->db->join('tb_minerba_inv_draft', 'tb_minerba_inv_draft.invMinID = tb_minerba_inv_draftdetail.invMinD_invID');
        $this->db->join('tb_petugas', 'tb_petugas.petugasID = tb_minerba_inv_draftdetail.invMinD_petugasID');
        $this->db->join('tb_status', 'tb_status.statusID = tb_minerba_inv_draftdetail.invMinD_statusID');
        $query = $this->db->get();
        return $query;
    }

////////////////////////////////////////////////////////////////////////////////////////////////

////////////////////////////////////////////////////////////////////////////////////////////////
    public function getInvDMinByPetugasID($petugas){
        $this->db->from('tb_minerba_inv_draftdetail');
        $this->db->where('invMinD_penerimaID', $petugas);
        $this->db->or_where('invMinD_pengirimID', $petugas);
        $this->db->order_by('invMinD_invID', 'DESC');
        $this->db->join('tb_minerba_inv_draft', 'tb_minerba_inv_draft.invMinID = tb_minerba_inv_draftdetail.invMinD_invID');
        $this->db->join('tb_petugas', 'tb_petugas.petugasID = tb_minerba_inv_draftdetail.invMinD_petugasID');
        $this->db->join('tb_status', 'tb_status.statusID = tb_minerba_inv_draftdetail.invMinD_statusID');
        $query = $this->db->get();
        return $query;
    }

////////////////////////////////////////////////////////////////////////////////////////////////

////////////////////////////////////////////////////////////////////////////////////////////////
    // public function getInvMinProsesAll(){
    //     $this->db->from('tb_minerba_inv_draftdetail');
    //     $this->db->join('tb_minerba_inv_draft', 'tb_minerba_inv_draft.invMinID = tb_minerba_inv_draftdetail.invMinD_invID');
    //     $this->db->join('tb_petugas', 'tb_petugas.petugasID = tb_minerba_inv_draftdetail.invMinD_petugasID');
    //     $query = $this->db->get();
    //     return $query;
    // }

    // public function getInvDMinProsesAll(){
    //     $this->db->from('tb_minerba_inv_draftdetail');
    //     $this->db->join('tb_minerba_inv_draft', 'tb_minerba_inv_draft.invMinID = tb_minerba_inv_draftdetail.invMinD_invID');
    //     $this->db->join('tb_petugas', 'tb_petugas.petugasID = tb_minerba_inv_draftdetail.invMinD_petugasID');
    //     $query = $this->db->get();
    //     return $query;
    // }

////////////////////////////////////////////////////////////////////////////////////////////////

////////////////////////////////////////////////////////////////////////////////////////////////
    public function addInvDMinerba($post){
        $params = array(     
            'invMinD_invID'      => $post['invID'],
            'invMinD_petugasID'  => $post['petugasID'],
            'invMinD_pengirimID' => $post['pengirimID'],
            'invMinD_penerimaID' => $post['penerimaID'],
            'invMinD_statusID'   => $post['status'],   
            'invMinFile'         => $post['draftInvFile'],  
            'statusKonfirmasi'   => $post['statuskonf'],
            'comment'            => $post['comment'],
        );
        $query = $this->db->insert('tb_minerba_inv_draftdetail', $params);
        return $query;
    }

////////////////////////////////////////////////////////////////////////////////////////////////

////////////////////////////////////////////////////////////////////////////////////////////////
    // public function getInvMinNewPetugas($post){
    //     $this->db->from('tb_minerba_inv_draftdetail');
    //     $this->db->where('invMinD_penerimaID', $post['penerima']);
    //     $this->db->where('invMinD_pengirimID', $post['pengirim']);
    //     $this->db->where('statusKonfirmasi', 'send');
    //     $this->db->join('tb_minerba_inv_draft', 'tb_minerba_inv_draft.invMinID = tb_minerba_inv_draftdetail.invMinD_invID');
    //     $this->db->join('tb_petugas', 'tb_petugas.petugasID = tb_minerba_inv_draftdetail.invMinD_petugasID');
    //     $query = $this->db->get();
    //     return $query;
    // }

    // public function getInvDMinByPetugasIDNew($post){
    //     $this->db->from('tb_minerba_inv_draftdetail');
    //     $this->db->where('invMinD_penerimaID', $post['penerima']);
    //     $this->db->where('invMinD_pengirimID', $post['pengirim']);
    //     $this->db->where('statusKonfirmasi', 'send');
    //     $this->db->join('tb_minerba_inv_draft', 'tb_minerba_inv_draft.invMinID = tb_minerba_inv_draftdetail.invMinD_invID');
    //     $this->db->join('tb_petugas', 'tb_petugas.petugasID = tb_minerba_inv_draftdetail.invMinD_petugasID');
    //     $query = $this->db->get();
    //     return $query;
    // }

////////////////////////////////////////////////////////////////////////////////////////////////

////////////////////////////////////////////////////////////////////////////////////////////////
    public function getInvDMinApprovByPetugasIDNew($post){
        $this->db->from('tb_minerba_inv_draftdetail');
        $this->db->where('invMinD_penerimaID', $post['penerima']);
        $this->db->where('invMinD_pengirimID', $post['pengirim']);
        $this->db->where('statusKonfirmasi', 'send');
        $this->db->join('tb_minerba_inv_draft', 'tb_minerba_inv_draft.invMinID = tb_minerba_inv_draftdetail.invMinD_invID');
        $this->db->join('tb_petugas', 'tb_petugas.petugasID = tb_minerba_inv_draftdetail.invMinD_petugasID');
        $this->db->join('tb_status', 'tb_status.statusID = tb_minerba_inv_draftdetail.invMinD_statusID');
        $query = $this->db->get();
        return $query;
    }

////////////////////////////////////////////////////////////////////////////////////////////////

////////////////////////////////////////////////////////////////////////////////////////////////
     //Merubah data FR Detail Marine status Konfirmasi dan menambahkan waktu start dan waktu End 
     public function setInvDMinStatusKonf($post){
        $data = array(
            'statusKonfirmasi'   => $post['statusConf'],  
            'waktu_start'        => $post['waktustart'],  
            'waktu_end'          => $post['waktuend'],
        );
        $this->db->where('invMinDetailID', $post['frDetailID']);
        $query = $this->db->update('tb_minerba_inv_draftdetail',$data);
    }


////////////////////////////////////////////////////////////////////////////////////////////////

////////////////////////////////////////////////////////////////////////////////////////////////
    //Menampilkan data FR berdasarkan frMarD_pengirimID yang login dan frMarD_frID, kemudian urutkan frMarDetailID Desc
    public function getInvDMinByPengirimInvID($id, $petugas){
        $this->db->from('tb_minerba_inv_draftdetail');
        $this->db->where('invMinD_pengirimID', $petugas);
        $this->db->where_in('invMinD_invID', $id);
        $this->db->join('tb_minerba_inv_draft', 'tb_minerba_inv_draft.invMinID = tb_minerba_inv_draftdetail.invMinD_invID');
        $this->db->join('tb_petugas', 'tb_petugas.petugasID = tb_minerba_inv_draftdetail.invMinD_petugasID');
        $this->db->join('tb_status', 'tb_status.statusID = tb_minerba_inv_draftdetail.invMinD_statusID');
        $query = $this->db->get();
        return $query;
    }

////////////////////////////////////////////////////////////////////////////////////////////////

////////////////////////////////////////////////////////////////////////////////////////////////
     //Menampilkan data FR berdasarkan quoD_penerima yang login dan quoD_quoID, kemudian urutkan quoDetailID Desc
     public function getInvDMinByPenerimaInvID($id, $petugas){
        $this->db->from('tb_minerba_inv_draftdetail');
        $this->db->where('invMinD_penerimaID', $petugas);
        $this->db->where_in('invMinD_invID', $id);
        $this->db->join('tb_minerba_inv_draft', 'tb_minerba_inv_draft.invMinID = tb_minerba_inv_draftdetail.invMinD_invID');
        $this->db->join('tb_petugas', 'tb_petugas.petugasID = tb_minerba_inv_draftdetail.invMinD_petugasID');
        $this->db->join('tb_status', 'tb_status.statusID = tb_minerba_inv_draftdetail.invMinD_statusID');
        $this->db->order_by("invMinDetailID", "DESC");
        $query = $this->db->get();
        return $query;
    }

////////////////////////////////////////////////////////////////////////////////////////////////

////////////////////////////////////////////////////////////////////////////////////////////////
     //Mengubah status frMarD_statusID
     public function setInvDMinStatus($post){
        $params = array(     
            'invMinD_statusID'          => $post['status'],
        );
        $this->db->where('invMinDetailID', $post['frDetailID']);
        $query = $this->db->update('tb_minerba_inv_draftdetail', $params);
        return $query;
    }


////////////////////////////////////////MAX//////////////////////////////////////////////////

////////////////////////////////////////////////////////////////////////////////////////////////
    public function getInvDMinMaxByPenerimaInvID($id, $petugas){
        $this->db->select_max('invMinDetailID');
        $this->db->from('tb_minerba_inv_draftdetail');
        $this->db->where_in('invMinD_invID', $id);
        $this->db->where('invMinD_penerimaID', $petugas);
        $this->db->group_by('invMinD_invID');
        $this->db->order_by('invMinDetailID', 'DESC');
        $query = $this->db->get();
        return $query; 
    }

////////////////////////////////////////////////////////////////////////////////////////////////

////////////////////////////////////////////////////////////////////////////////////////////////
     //Menampilkan frMarDetailID yang Maximal atau yang paling besar, berdasarkan frMarD_penerimaID yang login
     public function getInvDMinMaxByPenerimaID($id){
        $this->db->select_max('invMinDetailID');
        $this->db->from('tb_minerba_inv_draftdetail');
        $this->db->where('invMinD_penerimaID', $id);
        $this->db->group_by('invMinD_invID');
        $this->db->order_by('invMinDetailID', 'DESC');
        $query = $this->db->get();
        return $query; 
    }
////////////////////////////////////////////////////////////////////////////////////////////////

////////////////////////////////////////////////////////////////////////////////////////////////
    public function getInvDMinMaxByInvID($id){
        $this->db->select_max('invMinDetailID');
        $this->db->from('tb_minerba_inv_draftdetail');
        $this->db->where_in('invMinD_invID', $id);
        $this->db->group_by('invMinD_invID');
        $this->db->order_by('invMinDetailID', 'DESC');
        $query = $this->db->get();
        return $query; 
    }
    
////////////////////////////////////////////////////////////////////////////////////////////////
}

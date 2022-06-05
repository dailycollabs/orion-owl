<?php
class Finalreport_m extends CI_Model{

//////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////Marine////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////////////////////////////////////////////    
    //Menampilkan quoID yang paling besar    
    public function getFRMarAll(){
        $this->db->from('tb_marine_finalreport');
        $query = $this->db->get();
        return $query;
    }

//////////////////////////////////////////////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////////////////////////////////////////////
    //Menampilkan data FR Marine berdasarkan ID
    public function getFRMarByID($id){
        $this->db->from('tb_marine_finalreport');
        $this->db->where_in('frMarID', $id);
        $query = $this->db->get();
        return $query;
    }

//////////////////////////////////////////////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////////////////////////////////////////////
    //Menampilkan data FR Marine berdasarkan SPK ID
    public function getFRMarBySpkID($spkID){
        $this->db->from('tb_marine_finalreport');
        $this->db->where_in('frMar_spkID', $spkID);
        $this->db->order_by('frMarID', 'DESC');
        $this->db->join('tb_spk', 'tb_spk.spkID = tb_marine_finalreport.frMar_spkID');
        $query = $this->db->get();
        return $query;
    }

    //Menampilkan data FR Marine berdasarkan SPK ID
    public function getMarFRbyspkID($spkID){
        $this->db->from('tb_marine_finalreport');
        $this->db->where_in('frMar_spkID', $spkID);
        $this->db->order_by('frMarID', 'DESC');
        $this->db->join('tb_spk', 'tb_spk.spkID = tb_marine_finalreport.frMar_spkID');
        $query = $this->db->get();
        return $query;
    }

//////////////////////////////////////////////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////MAX//////////////////////////////////

    //Menampilkan quoID yang paling besar
    public function getFRMarMaxID(){
        $this->db->select_max('frMarID');
        $this->db->from('tb_marine_finalreport');
        $query = $this->db->get();
        return $query;
    }
//////////////////////////////////////////////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////////////////////////////////////////////
     //Menampilkan quoID yang paling besar
     public function getFRMarMaxBySpkID($spkID){
        $this->db->select_max('frMarID');
        $this->db->from('tb_marine_finalreport');
        $this->db->where_in('frMar_spkID', $spkID);
        $this->db->order_by('frMarID', 'DESC');
        $query = $this->db->get();
        return $query;
    } 

    
//////////////////////////////////////////////////////////////////////////////////////////////////////
    //Menambahkan data FR Marine
    public function addFRMar($post){
        $params = array(
            'frMarID'               => $post['id'],
            'frMar_spkID'           => $post['fr_spkID'],
            'frMar_jobdaDetailID'   => $post['fr_jobdescID'],
            'frMar_quoDetailID'     => $post['fr_quoDetailID'],
            'frMar_orderID'         => $post['fr_orderID'],
            'frMar_bidangID'        => $post['fr_bidangID'],
        );     
        $query = $this->db->insert('tb_marine_finalreport', $params);
        return $query; 
    }

//////////////////////////////////////////////////////////////////////////////////////////////////////
  
    ///////////////////////////////Detail Final Report Marine///////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////////////////////////////////////////////
    //Menambahkan data FR Detail Marine
    public function addFRDetailMar($post){
        $params = array(     
            'frMarD_frID'       => $post['frID'],
            'frMarD_petugasID'  => $post['petugasID'],
            'frMarD_pengirimID' => $post['pengirimID'],
            'frMarD_penerimaID' => $post['penerimaID'],
            'frMarD_statusID'   => $post['status'],
            'frInternalFile'    => $post['fr_internal'],
            'frSurveyFile'      => $post['fr_survey'],
            'jumlah'            => $post['jumlah'],
            'statusKonfirmasi'  => $post['statuskonf'],  
            'frMarDComment'     => $post['comment'], 
        );
        $query = $this->db->insert('tb_marine_finalreportdetail', $params);
        $insert_id =  $this->db->insert_id();
        return $insert_id;
    }
//////////////////////////////////////////////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////////////////////////////////////////////

    //Menampilkan data FR Detail Marine berdasarkan ID
    public function getFRDMarByIDDesc($id){
        $this->db->from('tb_marine_finalreportdetail');
        $this->db->where_in('frMarDetailID', $id);
        $this->db->join('tb_marine_finalreport', 'tb_marine_finalreport.frMarID = tb_marine_finalreportdetail.frMarD_frID');
        $this->db->join('tb_petugas', 'tb_petugas.petugasID = tb_marine_finalreportdetail.frMarD_petugasID');
        $this->db->join('tb_status', 'tb_status.statusID = tb_marine_finalreportdetail.frMarD_statusID');
        $this->db->order_by('frMarDetailID', 'DESC');
        $query = $this->db->get();
        return $query;
    }

//////////////////////////////////////////////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////////////////////////////////////////////
    public function getFRDMarByIDWaktuDesc($id){
        $this->db->from('tb_marine_finalreportdetail');
        $this->db->where_in('frMarDetailID', $id);
        $this->db->join('tb_marine_finalreport', 'tb_marine_finalreport.frMarID = tb_marine_finalreportdetail.frMarD_frID');
        $this->db->join('tb_petugas', 'tb_petugas.petugasID = tb_marine_finalreportdetail.frMarD_petugasID');
        $this->db->join('tb_status', 'tb_status.statusID = tb_marine_finalreportdetail.frMarD_statusID');
        $this->db->order_by('waktu', 'DESC');
        $query = $this->db->get();
        return $query;
    }
    
//////////////////////////////////////////////////////////////////////////////////////////////////////

////////////////////////////////////////////////////////////////////////////////////////////////////

//////////////////////////////////////////frMarD_frID////////////////////////////////////////////////
    public function getFRDMarByFRIDDesc($id){
        $this->db->from('tb_marine_finalreportdetail');
        $this->db->where_in('frMarD_frID', $id);
        $this->db->join('tb_marine_finalreport', 'tb_marine_finalreport.frMarID = tb_marine_finalreportdetail.frMarD_frID');
        $this->db->join('tb_petugas', 'tb_petugas.petugasID = tb_marine_finalreportdetail.frMarD_petugasID');
        $this->db->join('tb_status', 'tb_status.statusID = tb_marine_finalreportdetail.frMarD_statusID');
        $this->db->order_by('frMarDetailID', 'DESC');
        $query = $this->db->get();
        return $query;
    }

///////////////////////////////////////////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////////////////////////////////////////////
    //Menampilkan data FR Detail Marine berdasarkan FR ID
    public function getFRDMarByFRID($id){
        $this->db->from('tb_marine_finalreportdetail');
        $this->db->where_in('frMarD_frID', $id);
        $this->db->join('tb_marine_finalreport', 'tb_marine_finalreport.frMarID = tb_marine_finalreportdetail.frMarD_frID');
        $this->db->join('tb_petugas', 'tb_petugas.petugasID = tb_marine_finalreportdetail.frMarD_petugasID');
        $this->db->join('tb_status', 'tb_status.statusID = tb_marine_finalreportdetail.frMarD_statusID');
        $query = $this->db->get();
        return $query;
    }


/////////////////////////////////////////////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////////////////////////////////////////////
     //Menampilkan data FR Detail Marine berdasarkan ID frD_frID, frD_petugasID, frD_pengirimID, frD_penerimaID,
    //Di gunakan untuk menghitung banyaknya proses yang di lakukan oleh petugas dengan FRID yang di proses di bagian FR detail
    public function getFRDMarJumlah($post){
        $this->db->select('*');
        $this->db->from('tb_marine_finalreportdetail');
        $this->db->where('frMarD_frID', $post['frID']);
        $this->db->where('frMarD_petugasID', $post['petugasID']);
        $this->db->where('frMarD_pengirimID', $post['pengirimID']);
        $this->db->where('frMarD_penerimaID', $post['penerimaID']);
        $query = $this->db->get();
        return $query;
    }


//////////////////////////////////////////////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////////////////////////////////////////////
    //Menampilkan data notifikasi
    public function getFRDMarNotifNew($petugas){
        $status = array('SC1','RV1', 'NW1');
        $this->db->from('tb_marine_finalreportdetail');
        $this->db->where('frMarD_penerimaID', $petugas);
        $this->db->where('statusKonfirmasi', 'send');
        $this->db->where_in('frMarD_statusID', $status);
        $query = $this->db->get();
        return $query;
    }

//////////////////////////////////////////////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////////////////////////////////////////////
    public function getFRDMarNotifNewFailed($petugas){
        $this->db->from('tb_marine_finalreportdetail');
        $this->db->where('frMarD_penerimaID', $petugas);
        $this->db->where('statusKonfirmasi', 'send');
        $this->db->where_in('frMarD_statusID', 'FD1');
        $query = $this->db->get();
        return $query;
    }

//////////////////////////////////////////////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////////////////////////////////////////////
    public function getFRDMarMaxByPetugasID($petugas){
        $this->db->select_max('frMarDetailID');
        $this->db->from('tb_marine_finalreportdetail');
        $this->db->where('frMarD_pengirimID', $petugas);
        $this->db->or_where('frMarD_penerimaID', $petugas);
        $this->db->group_by('frMarD_frID');
        $this->db->order_by('frMarDetailID', 'DESC');
        $this->db->join('tb_status', 'tb_status.statusID = tb_marine_finalreportdetail.frMarD_statusID');
        $query = $this->db->get();
        return $query;
    }

//////////////////////////////////////////////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////////////////////////////////////////////
    public function getFRDMarByPetugasIDDesc($petugas){
        $this->db->from('tb_marine_finalreportdetail');
        $this->db->where('frMarD_pengirimID', $petugas);
        $this->db->or_where('frMarD_penerimaID', $petugas);
        $this->db->order_by('frMarDetailID', 'DESC');
        $this->db->join('tb_marine_finalreport', 'tb_marine_finalreport.frMarID = tb_marine_finalreportdetail.frMarD_frID');
        $this->db->join('tb_petugas', 'tb_petugas.petugasID = tb_marine_finalreportdetail.frMarD_petugasID');
        $this->db->join('tb_status', 'tb_status.statusID = tb_marine_finalreportdetail.frMarD_statusID');
        $query = $this->db->get();
        return $query;
    }

//////////////////////////////////////////////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////////////////////////////////////////////
    //Menampilkan data FR Detail Marine berdasarkan Petugas yang Login
    public function getFRDMarByPetugasIDNew($post){
        $this->db->from('tb_marine_finalreportdetail');
        $this->db->where('frMarD_penerimaID', $post['petugasLogin']);
        $this->db->where('frMarD_pengirimID', $post['pengirim']);
        $this->db->where('statusKonfirmasi', 'send');
        $this->db->join('tb_marine_finalreport', 'tb_marine_finalreport.frMarID = tb_marine_finalreportdetail.frMarD_frID');
        $this->db->join('tb_petugas', 'tb_petugas.petugasID = tb_marine_finalreportdetail.frMarD_petugasID');
        $this->db->join('tb_status', 'tb_status.statusID = tb_marine_finalreportdetail.frMarD_statusID');
        $this->db->order_by("waktu", "DESC");
        $query = $this->db->get();
        return $query;
    }

//////////////////////////////////////////////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////////////////////////////////////////////
    //Menampilkan data FR berdasarkan quoD_penerima yang login dan quoD_quoID, kemudian urutkan quoDetailID Desc
    public function getFRDMarByPenerimaID($id, $petugas){
        $this->db->from('tb_marine_finalreportdetail');
        $this->db->where('frMarD_penerimaID', $petugas);
        $this->db->where_in('frMarD_frID', $id);
        $this->db->join('tb_marine_finalreport', 'tb_marine_finalreport.frMarID = tb_marine_finalreportdetail.frMarD_frID');
        $this->db->join('tb_petugas', 'tb_petugas.petugasID = tb_marine_finalreportdetail.frMarD_petugasID');
        $this->db->join('tb_status', 'tb_status.statusID = tb_marine_finalreportdetail.frMarD_statusID');
        $this->db->order_by("frMarDetailID", "DESC");
        $query = $this->db->get();
        return $query;
    }

//////////////////////////////////////////////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////////////////////////////////////////////
    //Menampilkan data FR berdasarkan frMarD_pengirimID yang login dan frMarD_frID, kemudian urutkan frMarDetailID Desc
    public function getFRDMarBypengirimID($id, $petugas){
        $this->db->from('tb_marine_finalreportdetail');
        $this->db->where('frMarD_pengirimID', $petugas);
        $this->db->where_in('frMarD_frID', $id);
        $this->db->join('tb_marine_finalreport', 'tb_marine_finalreport.frMarID = tb_marine_finalreportdetail.frMarD_frID');
        $this->db->join('tb_petugas', 'tb_petugas.petugasID = tb_marine_finalreportdetail.frMarD_petugasID');
        $this->db->join('tb_status', 'tb_status.statusID = tb_marine_finalreportdetail.frMarD_statusID');
        // $this->db->order_by("frMarDetailID", "DESC");
        $query = $this->db->get();
        return $query;
    }


//////////////////////////////////////////////////////////////////////////////////////////////////////

 


////////////////////////////////////////////////////////////////////////////////////////////////////

////////////////////////////////////////////MAX/////////////////////////////////////////////////////
    public function getFRDMarMaxByFRID($id){
        $this->db->select_max('frMarDetailID');
        $this->db->from('tb_marine_finalreportdetail');
        $this->db->where_in('frMarD_frID', $id);
        $this->db->group_by('frMarD_frID');
        $this->db->order_by('frMarDetailID', 'DESC');
        $query = $this->db->get();
        return $query; 
    }

//////////////////////////////////////////////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////////////////////////////////////////////
     //Menampilkan frMarDetailID yang Maximal atau yang paling besar, berdasarkan frMarD_frID dan frMarD_penerimaID yang login
     public function getFRDMarMaxByPenerimaFRID($id, $petugas){
        $this->db->select_max('frMarDetailID');
        $this->db->from('tb_marine_finalreportdetail');
        $this->db->where_in('frMarD_frID', $id);
        $this->db->where('frMarD_penerimaID', $petugas);
        $this->db->group_by('frMarD_frID');
        $this->db->order_by('frMarDetailID', 'DESC');
        $query = $this->db->get();
        return $query; 
    }

//////////////////////////////////////////////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////////////////////////////////////////////
    //Menampilkan frMarDetailID yang Maximal atau yang paling besar, berdasarkan frMarD_frID dan frMarD_pengirimID yang login
    public function getFRDMarMaxByPengirimFRID($id, $petugas){
        $this->db->select_max('frMarDetailID');
        $this->db->from('tb_marine_finalreportdetail');
        $this->db->where_in('frMarD_frID', $id);
        $this->db->where('frMarD_pengirimID', $petugas);
        $this->db->group_by('frMarD_frID');
        $this->db->order_by('frMarDetailID', 'DESC');
        $query = $this->db->get();
        return $query; 
    }

//////////////////////////////////////////////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////////////////////////////////////////////
     //Menampilkan frMarDetailID yang Maximal atau yang paling besar, berdasarkan frMarD_penerimaID yang login
     public function getFRDMarMaxByPengirimID($id){
        $this->db->select_max('frMarDetailID');
        $this->db->from('tb_marine_finalreportdetail');
        $this->db->where('frMarD_penerimaID', $id);
        $this->db->group_by('frMarD_frID');
        $this->db->order_by('frMarDetailID', 'DESC');
        $query = $this->db->get();
        return $query; 
    }

//////////////////////////////////////////////////////////////////////////////////////////////////////


//////////////////////////////////////////////////////////////////////////////////////////////////////
    //Merubah data FR Detail Marine status Konfirmasi dan menambahkan waktu start dan waktu End 
    public function setFRDMarStatusKonf($post){
        $data = array(
            'statusKonfirmasi'   => $post['statusConf'],  
            'waktu_start'        => $post['waktustart'],  
            'waktu_end'          => $post['waktuend'],
        );
        $this->db->where('frMarDetailID', $post['frDetailID']);
        $query = $this->db->update('tb_marine_finalreportdetail',$data);
    }

//////////////////////////////////////////////////////////////////////////////////////////////////////


//////////////////////////////////////////////////////////////////////////////////////////////////////
     //Mengubah status frMarD_statusID
     public function setFRDMarStatus($post){
        $params = array(     
            'frMarD_statusID'          => $post['status'],
        );
        $this->db->where('frMarDetailID', $post['frDetailID']);
        $query = $this->db->update('tb_marine_finalreportdetail', $params);
        return $query;
    }
///////////////////////////////////////////////////////////////////////////////////////////////////////////////

   

//////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////End Marine///////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////


//////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////MINERBA///////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////////////////////////////////////////////
    //Menampilkan quoID yang paling besar
    public function getFRMinAll(){
        $this->db->from('tb_minerba_finalreport');
        $query = $this->db->get();
        return $query;
    }

//////////////////////////////////////////////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////////////////////////////////////////////
     //Menampilkan quoID yang paling besar
     public function getFRMinMaxBySpkID($id){
        $this->db->select_max('frMinID');
        $this->db->from('tb_minerba_finalreport');
        $this->db->where_in('frMin_spkID', $id);
        $this->db->group_by('frMin_spkID');
        $this->db->order_by('frMinID', 'DESC');
        $query = $this->db->get();
        return $query;
    }

//////////////////////////////////////////////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////////////////////////////////////////////
     //Menampilkan quoID yang paling besar
     public function getFRMinMaxID(){
        $this->db->select_max('frMinID');
        $this->db->from('tb_minerba_finalreport');
        $query = $this->db->get();
        return $query;
    }

//////////////////////////////////////////////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////////////////////////////////////////////
     //getMinFRID
     public function getFRMinByID($id){
        $this->db->from('tb_minerba_finalreport');
        $this->db->where_in('frMinID', $id);
        $query = $this->db->get();
        return $query;
    }

//////////////////////////////////////////////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////////////////////////////////////////////
     //Menampilkan data FR Marine berdasarkan SPK ID
     public function getFRMinBySpkID($spkID){
        $this->db->from('tb_minerba_finalreport');
        $this->db->where_in('frMin_spkID', $spkID);
        $this->db->order_by('frMinID', 'DESC');
        $this->db->join('tb_spk', 'tb_spk.spkID = tb_minerba_finalreport.frMin_spkID');
        $query = $this->db->get();
        return $query;
    }

//////////////////////////////////////////////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////////////////////////////////////////////
    public function addFRMin($post){
        $params = array(
            'frMinID'               => $post['id'],
            'frMinlhvNo'            => $post['fr_lhvNo'],
            'frMin_spkID'           => $post['fr_spkID'],
            'frMin_jobdaDetailID'   => $post['fr_jobdescID'],
            'frMin_quoDetailID'     => $post['fr_quoDetailID'],
            'frMin_orderID'         => $post['fr_orderID'],
            'frMin_bidangID'        => $post['fr_bidangID'],
        );
        $query = $this->db->insert('tb_minerba_finalreport', $params);
        return $query;
    }

//////////////////////////////////////////////////////////////////////////////////////////////////////

    ///////////////////////////// Minerba Detail /////////////////////////////////

   
///////////////////////////////////////////DETAIL ID/////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////
    //Menampilkan data notifikasi
    public function getFRDMinNotifNew($petugas){
        $status = array('SC1','RV1', 'NW1');
        $this->db->from('tb_minerba_finalreportdetail');
        $this->db->where('frMinD_penerimaID', $petugas);
        $this->db->where('statusKonfirmasi', 'send');
        $this->db->where_in('frMinD_statusID', $status);
        $query = $this->db->get();
        return $query;
    }

//////////////////////////////////////////////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////////////////////////////////////////////
    public function getFRDMinNotifNewFailed($petugas){
        $this->db->from('tb_minerba_finalreportdetail');
        $this->db->where('frMinD_penerimaID', $petugas);
        $this->db->where('statusKonfirmasi', 'send');
        $this->db->where_in('frMinD_statusID', 'FD1');
        $query = $this->db->get();
        return $query;
    }

//////////////////////////////////////////////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////////////////////////////////////////////
    public function getFRDMinByID($id){
        $this->db->from('tb_minerba_finalreportdetail');
        $this->db->where_in('frMinDetailID', $id);
        $this->db->join('tb_minerba_finalreport', 'tb_minerba_finalreport.frMinID = tb_minerba_finalreportdetail.frMinD_frID');
        $this->db->join('tb_petugas', 'tb_petugas.petugasID = tb_minerba_finalreportdetail.frMinD_petugasID');
        $this->db->join('tb_status', 'tb_status.statusID = tb_minerba_finalreportdetail.frMinD_statusID');
        $this->db->order_by('frMinDetailID', 'DESC');
        $query = $this->db->get();
        return $query;
    }
//////////////////////////////////////////////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////////////////////////////////////////////
    //Menampilkan data FR Detail Marine berdasarkan ID
    public function getFRDMinByIDDesc($id){
        $this->db->from('tb_minerba_finalreportdetail');
        $this->db->where_in('frMinDetailID', $id);
        $this->db->join('tb_minerba_finalreport', 'tb_minerba_finalreport.frMinID = tb_minerba_finalreportdetail.frMinD_frID');
        $this->db->join('tb_petugas', 'tb_petugas.petugasID = tb_minerba_finalreportdetail.frMinD_petugasID');
        $this->db->join('tb_status', 'tb_status.statusID = tb_minerba_finalreportdetail.frMinD_statusID');
        $this->db->order_by('frMinDetailID', 'DESC');
        $query = $this->db->get();
        return $query;
    }

//////////////////////////////////////////////////////////////////////////////////////////////////////

/////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////frMarD_frID////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////////////////////////////////////////////
    public function getFRDMinByFRIDDesc($id){
        $this->db->from('tb_minerba_finalreportdetail');
        $this->db->where_in('frMinD_frID', $id);
        $this->db->join('tb_minerba_finalreport', 'tb_minerba_finalreport.frMinID = tb_minerba_finalreportdetail.frMinD_frID');
        $this->db->join('tb_petugas', 'tb_petugas.petugasID = tb_minerba_finalreportdetail.frMinD_petugasID');
        $this->db->join('tb_status', 'tb_status.statusID = tb_minerba_finalreportdetail.frMinD_statusID');
        $this->db->order_by('frMinDetailID', 'DESC');
        $query = $this->db->get();
        return $query;
    }
//////////////////////////////////////////////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////////////////////////////////////////////
    //Menampilkan data FR Detail Marine berdasarkan FR ID
    public function getFRDMinByFRID($id){
        $this->db->from('tb_minerba_finalreportdetail');
        $this->db->where_in('frMinD_frID', $id);
        $this->db->join('tb_minerba_finalreport', 'tb_minerba_finalreport.frMinID = tb_minerba_finalreportdetail.frMinD_frID');
        $this->db->join('tb_petugas', 'tb_petugas.petugasID = tb_minerba_finalreportdetail.frMinD_petugasID');
        $this->db->join('tb_status', 'tb_status.statusID = tb_minerba_finalreportdetail.frMinD_statusID');
        $query = $this->db->get();
        return $query;
    }
////////////////////////////////////////////////////////////////////////////////////////////////////// 

/////////////////////////////////////////////////////////////////////////////////////////////////////////////

//////////////////////////////////////////Petugas ID////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////////////////////////////////////////////
    public function getFRDMinByPetugasIDDesc($petugas){
        $this->db->from('tb_minerba_finalreportdetail');
        $this->db->where('frMinD_pengirimID', $petugas);
        $this->db->or_where('frMinD_penerimaID', $petugas);
        $this->db->order_by('frMinDetailID', 'DESC');
        $this->db->join('tb_minerba_finalreport', 'tb_minerba_finalreport.frMinID = tb_minerba_finalreportdetail.frMinD_frID');
        $this->db->join('tb_petugas', 'tb_petugas.petugasID = tb_minerba_finalreportdetail.frMinD_petugasID');
        $this->db->join('tb_status', 'tb_status.statusID = tb_minerba_finalreportdetail.frMinD_statusID');
        $query = $this->db->get();
        return $query;
    }

//////////////////////////////////////////////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////////////////////////////////////////////
    //Menampilkan data FR Detail Marine berdasarkan Petugas yang Login
    public function getFRDMinByPetugasIDNew($post){
        $this->db->from('tb_minerba_finalreportdetail');
        $this->db->where('frMinD_penerimaID', $post['petugasLogin']);
        $this->db->where('frMinD_pengirimID', $post['pengirim']);
        $this->db->where('statusKonfirmasi', 'send');
        $this->db->join('tb_minerba_finalreport', 'tb_minerba_finalreport.frMinID = tb_minerba_finalreportdetail.frMinD_frID');
        $this->db->join('tb_petugas', 'tb_petugas.petugasID = tb_minerba_finalreportdetail.frMinD_petugasID');
        $this->db->join('tb_status', 'tb_status.statusID = tb_minerba_finalreportdetail.frMinD_statusID');
        $this->db->order_by("frMinDetailID", "ASC");
        $query = $this->db->get();
        return $query;
    }

    
//////////////////////////////////////////////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////////////////////////////////////////////
    public function getFRDMinByPetugasFRIDNew($post){
        $this->db->from('tb_minerba_finalreportdetail');
        $this->db->where('frMinD_penerimaID', $post['petugasLogin']);
        $this->db->where('frMinD_pengirimID', $post['pengirim']);
        $this->db->where('statusKonfirmasi', 'send');
        $this->db->join('tb_minerba_finalreport', 'tb_minerba_finalreport.frMinID = tb_minerba_finalreportdetail.frMinD_frID');
        $this->db->join('tb_petugas', 'tb_petugas.petugasID = tb_minerba_finalreportdetail.frMinD_petugasID');
        $this->db->join('tb_status', 'tb_status.statusID = tb_minerba_finalreportdetail.frMinD_statusID');
        $this->db->order_by("frMinD_frID", "ASC");
        $query = $this->db->get();
        return $query;
    }

///////////////////////////////////////////////////////////////////////////////////////////////////////

////////////////////////////////////////////PENERIMA//////////////////////////////////////////////////

//////////////////////////////////////////////////////////////////////////////////////////////////////
    
//////////////////////////////////////////////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////////////////////////////////////////////
    public function getFRDMinByPenerimaID($post){
        $this->db->from('tb_minerba_finalreportdetail');
        $this->db->where('frMinD_penerimaID', $post['subbidangPetugas']);
        $this->db->order_by('frMinDetailID', 'DESC');
        $query = $this->db->get();
        return $query; 
    }

//////////////////////////////////////////////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////////////////////////////////////////////
    //Menampilkan data FR berdasarkan quoD_penerima yang login dan quoD_quoID, kemudian urutkan quoDetailID Desc
    public function getFRDMinByPenerimaFRID($id, $petugas){
        $this->db->from('tb_minerba_finalreportdetail');
        $this->db->where('frMinD_penerimaID', $petugas);
        $this->db->where_in('frMinD_frID', $id);
        $this->db->join('tb_minerba_finalreport', 'tb_minerba_finalreport.frMinID = tb_minerba_finalreportdetail.frMinD_frID');
        $this->db->join('tb_petugas', 'tb_petugas.petugasID = tb_minerba_finalreportdetail.frMinD_petugasID');
        $this->db->join('tb_status', 'tb_status.statusID = tb_minerba_finalreportdetail.frMinD_statusID');
        $this->db->order_by("frMinDetailID", "DESC");
        $query = $this->db->get();
        return $query;
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////

////////////////////////////////////////////PENGIRIM/////////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////////////////////////////////////////////
    public function getFRDMinByPengirimFRIDDesc($post){
        $this->db->from('tb_minerba_finalreportdetail');
        $this->db->where('frMinD_pengirimID', $post['subbidangPetugas']);
        $this->db->where('frMinD_frID', $post['quoid']);
        $this->db->order_by('frMinDetailID', 'DESC');
        $query = $this->db->get();
        return $query;
    }

//////////////////////////////////////////////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////////////////////////////////////////////
    //Menampilkan data FR berdasarkan frMarD_pengirimID yang login dan frMarD_frID, kemudian urutkan frMarDetailID Desc
    public function getFRDMinByPengirimFRID($id, $petugas){
        $this->db->from('tb_minerba_finalreportdetail');
        $this->db->where('frMinD_pengirimID', $petugas);
        $this->db->where_in('frMinD_frID', $id);
        $this->db->join('tb_minerba_finalreport', 'tb_minerba_finalreport.frMinID = tb_minerba_finalreportdetail.frMinD_frID');
        $this->db->join('tb_petugas', 'tb_petugas.petugasID = tb_minerba_finalreportdetail.frMinD_petugasID');
        $this->db->join('tb_status', 'tb_status.statusID = tb_minerba_finalreportdetail.frMinD_statusID');
        $query = $this->db->get();
        return $query;
    }

/////////////////////////////////////////////////////////////////////////////////////////////////////////////

////////////////////////////////////////////MAX/////////////////////////////////////////////////////////////////
    //Menampilkan frMarDetailID yang Maximal atau yang paling besar, berdasarkan frMarD_penerimaID yang login
    public function getFRDMinMaxByPenerimaID($id){
        $this->db->select_max('frMinDetailID');
        $this->db->from('tb_minerba_finalreportdetail');
        $this->db->where('frMinD_penerimaID', $id);
        $this->db->group_by('frMinD_frID');
        $this->db->order_by('frMinDetailID', 'DESC');
        $query = $this->db->get();
        return $query; 
    }
//////////////////////////////////////////////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////////////////////////////////////////////
    //Menampilkan frMarDetailID yang Maximal atau yang paling besar, berdasarkan frMarD_penerimaID yang login
    public function getFRDMinMaxByFRID($id){
        $this->db->select_max('frMinDetailID');
        $this->db->from('tb_minerba_finalreportdetail');
        $this->db->where_in('frMinD_frID', $id);
        $this->db->group_by('frMinD_frID');
        $this->db->order_by('frMinDetailID', 'DESC');
        $query = $this->db->get();
        return $query; 
    }

//////////////////////////////////////////////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////////////////////////////////////////////
    //Menampilkan frMarDetailID yang Maximal atau yang paling besar, berdasarkan frMarD_frID dan frMarD_pengirimID yang login
    public function getFRDMinMaxByPengirimFRID($id, $petugas){
        $this->db->select_max('frMinDetailID');
        $this->db->from('tb_minerba_finalreportdetail');
        $this->db->where_in('frMinD_frID', $id);
        $this->db->where('frMinD_pengirimID', $petugas);
        $this->db->group_by('frMinD_frID');
        $this->db->order_by('frMinDetailID', 'DESC');
        $query = $this->db->get();
        return $query; 
    }

    

//////////////////////////////////////////////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////////////////////////////////////////////
     //Menampilkan frMarDetailID yang Maximal atau yang paling besar, berdasarkan frMarD_frID dan frMarD_penerimaID yang login
     public function getFRDMinMaxByPenerimaFRID($id, $petugas){
        $this->db->select_max('frMinDetailID');
        $this->db->from('tb_minerba_finalreportdetail');
        $this->db->where_in('frMinD_frID', $id);
        $this->db->where('frMinD_penerimaID', $petugas);
        $this->db->group_by('frMinD_frID');
        $this->db->order_by('frMinDetailID', 'DESC');
        $query = $this->db->get();
        return $query; 
    }

     public function getFRDMinMaxByPetugasID($petugas){
        $this->db->select_max('frMinDetailID');
        $this->db->from('tb_minerba_finalreportdetail');
        $this->db->where('frMinD_pengirimID', $petugas);
        $this->db->or_where('frMinD_penerimaID', $petugas);
        $this->db->group_by('frMinD_frID');
        $this->db->order_by('frMinDetailID', 'DESC');
        $this->db->join('tb_status', 'tb_status.statusID = tb_minerba_finalreportdetail.frMinD_statusID');
        $query = $this->db->get();
        return $query;
    }

    

/////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////
    //Merubah data FR Detail Marine status Konfirmasi dan menambahkan waktu start dan waktu End 
    public function setFRDMinStatusKonf($post){
        $data = array(
            'statusKonfirmasi'   => $post['statusConf'],  
            'waktu_start'        => $post['waktustart'],  
            'waktu_end'          => $post['waktuend'],
        );
        $this->db->where('frMinDetailID', $post['frDetailID']);
        $query = $this->db->update('tb_minerba_finalreportdetail',$data);
    }
//////////////////////////////////////////////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////////////////////////////////////////////
    //Mengubah status frMarD_statusID
    public function setFRDMinStatus($post){
        $params = array(     
            'frMinD_statusID'          => $post['status'],
        );
        $this->db->where('frMinDetailID', $post['frDetailID']);
        $query = $this->db->update('tb_minerba_finalreportdetail', $params);
        return $query;
    }
////////////////////////////////////////////////////////////////////////////////////////////////////////


////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function addFRDetailMin($post){
        $params = array(     
            'frMinD_frID'       => $post['frID'],
            'frMinD_petugasID'  => $post['petugasID'],
            'frMinD_pengirimID' => $post['pengirimID'],
            'frMinD_penerimaID' => $post['penerimaID'],
            'frMinD_statusID'   => $post['status'],
            'frInternalFile'    => $post['fr_internal'],
            'lhvFile'           => $post['fr_lhv'],
            'dsrFile'           => $post['fr_dsr'],
            'coaFile'           => $post['fr_coa'],
            'cowFile'           => $post['fr_cow'],
            'cdsFile'           => $post['fr_cds'],
            'jumlah'            => $post['jumlah'],
            'statusKonfirmasi'  => $post['statuskonf'], 
            'frMinDComment'     => $post['comment']
        );
        $query = $this->db->insert('tb_minerba_finalreportdetail', $params);
        $insert_id =  $this->db->insert_id();
        return $insert_id;
    }
//////////////////////////////////////////////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////////////////////////////////////////////  
    public function getFRDMinJumlah($post){
        $this->db->select('*');
        $this->db->from('tb_minerba_finalreportdetail');
        $this->db->where('frMinD_frID', $post['frID']);
        $this->db->where('frMinD_petugasID', $post['petugasID']);
        $this->db->where('frMinD_pengirimID', $post['pengirimID']);
        $this->db->where('frMinD_penerimaID', $post['penerimaID']);
        $query = $this->db->get();
        return $query;
    }



}
<?php

class Invoicing_m extends CI_Model{
    
     //////////////////////////////////Bidang Marine/////////////////////////////////////
   

    // public function getPetugasMarine($petugas){
    //     $this->db->select_max('frMarDetailID');
    //     $this->db->from('tb_marine_finalreportdetail');
    //     $this->db->where('frMarD_pengirimID', $petugas);
    //     $this->db->or_where('frMarD_penerimaID', $petugas);
    //     $this->db->group_by('frMarD_frID');
    //     $this->db->order_by('frMarDetailID', 'DESC');
    //     $this->db->join('tb_status', 'tb_status.statusID = tb_marine_finalreportdetail.frMarD_statusID');
    //     $query = $this->db->get();
    //     return $query;
    // }
    

    // public function getPetugasDataMarine($id){
    //     $this->db->from('tb_marine_finalreportdetail');
    //     $this->db->where_in('frMarDetailID', $id);
    //     $this->db->join('tb_marine_finalreport', 'tb_marine_finalreport.frMarID = tb_marine_finalreportdetail.frMarD_frID');
    //     $this->db->join('tb_petugas', 'tb_petugas.petugasID = tb_marine_finalreportdetail.frMarD_petugasID');
    //     $this->db->join('tb_status', 'tb_status.statusID = tb_marine_finalreportdetail.frMarD_statusID');
    //     $query = $this->db->get();
    //     return $query;
    // }

    // public function getDataDescMarine($id){
    //     $this->db->from('tb_marine_finalreportdetail');
    //     $this->db->where_in('frMarD_frID', $id);
    //     $this->db->join('tb_marine_finalreport', 'tb_marine_finalreport.frMarID = tb_marine_finalreportdetail.frMarD_frID');
    //     $this->db->join('tb_petugas', 'tb_petugas.petugasID = tb_marine_finalreportdetail.frMarD_petugasID');
    //     $this->db->join('tb_status', 'tb_status.statusID = tb_marine_finalreportdetail.frMarD_statusID');
    //     $this->db->order_by('frMarDetailID', 'DESC');
    //     $query = $this->db->get();
    //     return $query;
    // }

    // public function getDataIDMarine($id){
    //     $this->db->from('tb_marine_finalreportdetail');
    //     $this->db->where_in('frMarD_frID', $id);
    //     $this->db->join('tb_marine_finalreport', 'tb_marine_finalreport.frMarID = tb_marine_finalreportdetail.frMarD_frID');
    //     $this->db->join('tb_petugas', 'tb_petugas.petugasID = tb_marine_finalreportdetail.frMarD_petugasID');
    //     $this->db->join('tb_status', 'tb_status.statusID = tb_marine_finalreportdetail.frMarD_statusID');
    //     $query = $this->db->get();
    //     return $query;
    // }

    // public function getDataPetugasIDMarine($petugas){
    //     $this->db->from('tb_marine_finalreportdetail');

    //     $this->db->where('frMarD_pengirimID', $petugas);
    //     $this->db->or_where('frMarD_penerimaID', $petugas);
    //     // $this->db->group_by('quoD_quoID');
    //     $this->db->order_by('frMarDetailID', 'DESC');
    //     $this->db->join('tb_marine_finalreport', 'tb_marine_finalreport.frMarID = tb_marine_finalreportdetail.frMarD_frID');
    //     $this->db->join('tb_petugas', 'tb_petugas.petugasID = tb_marine_finalreportdetail.frMarD_petugasID');
    //     $this->db->join('tb_status', 'tb_status.statusID = tb_marine_finalreportdetail.frMarD_statusID');
    //     $query = $this->db->get();
    //     return $query;
    // }
    


     //////////////////////////////////END Bidang Marine/////////////////////////////////////

      //////////////////////////////////Bidang Minerba/////////////////////////////////////

    // public function getPetugasMinerba($petugas){
    //     $this->db->select_max('frMinDetailID');
    //     $this->db->from('tb_minerba_finalreportdetail');
    //     $this->db->where('frMinD_pengirimID', $petugas);
    //     $this->db->or_where('frMinD_penerimaID', $petugas);
    //     $this->db->group_by('frMinD_frID');
    //     $this->db->order_by('frMinDetailID', 'DESC');
    //     $this->db->join('tb_status', 'tb_status.statusID = tb_minerba_finalreportdetail.frMinD_statusID');
    //     $query = $this->db->get();
    //     return $query;
    // }

   

    // public function getDataPetugasIDMinerba($petugas){
    //     $this->db->from('tb_minerba_finalreportdetail');
    //     $this->db->where('frMinD_pengirimID', $petugas);
    //     $this->db->or_where('frMinD_penerimaID', $petugas);
    //     $this->db->order_by('frMinDetailID', 'DESC');
    //     $this->db->join('tb_minerba_finalreport', 'tb_minerba_finalreport.frMinID = tb_minerba_finalreportdetail.frMinD_frID');
    //     $this->db->join('tb_petugas', 'tb_petugas.petugasID = tb_minerba_finalreportdetail.frMinD_petugasID');
    //     $this->db->join('tb_status', 'tb_status.statusID = tb_minerba_finalreportdetail.frMinD_statusID');
    //     $query = $this->db->get();
    //     return $query;
    // }

    

    // public function getPetugasDataMinerba($id){
    //     $this->db->from('tb_minerba_finalreportdetail');
    //     $this->db->where_in('frMinDetailID', $id);
    //     $this->db->join('tb_minerba_finalreport', 'tb_minerba_finalreport.frMinID = tb_minerba_finalreportdetail.frMinD_frID');
    //     $this->db->join('tb_petugas', 'tb_petugas.petugasID = tb_minerba_finalreportdetail.frMinD_petugasID');
    //     $this->db->join('tb_status', 'tb_status.statusID = tb_minerba_finalreportdetail.frMinD_statusID');
    //     $query = $this->db->get();
    //     return $query;
    // }

    
  

    // public function getDataDescMinerba($id){
    //     $this->db->from('tb_minerba_finalreportdetail');
    //     $this->db->where_in('frMinD_frID', $id);
    //     $this->db->join('tb_minerba_finalreport', 'tb_minerba_finalreport.frMinID = tb_minerba_finalreportdetail.frMinD_frID');
    //     $this->db->join('tb_petugas', 'tb_petugas.petugasID = tb_minerba_finalreportdetail.frMinD_petugasID');
    //     $this->db->join('tb_status', 'tb_status.statusID = tb_minerba_finalreportdetail.frMinD_statusID');
    //     $this->db->order_by('frMinDetailID', 'DESC');
    //     $query = $this->db->get();
    //     return $query;
    // }

    

    // public function getDataIDMinerba($id){
    //     $this->db->from('tb_minerba_finalreportdetail');
    //     $this->db->where_in('frMinD_frID', $id);
    //     $this->db->join('tb_minerba_finalreport', 'tb_minerba_finalreport.frMinID = tb_minerba_finalreportdetail.frMinD_frID');
    //     $this->db->join('tb_petugas', 'tb_petugas.petugasID = tb_minerba_finalreportdetail.frMinD_petugasID');
    //     $this->db->join('tb_status', 'tb_status.statusID = tb_minerba_finalreportdetail.frMinD_statusID');
    //     $query = $this->db->get();
    //     return $query;
    // }

    

    ////////////////////////////////////////////////////////////////////////////////////////

    
   






















    /////////////////////////////////INVOICE MARINE///////////////////////

    // public function getInvNewPetugasDESCMarine($petugas){
    //     $this->db->select_max('invMarDetailID');
    //     $this->db->from('tb_marine_inv_draftdetail');
    //     $this->db->where('invMarD_penerimaID', $petugas);
    //     $this->db->or_where('invMarD_pengirimID', $petugas);
    //     $this->db->group_by('invMarD_invID');
    //     $this->db->order_by('invMarDetailID', 'DESC');
    //     $query = $this->db->get();
    //     return $query;
    // }

    // public function getInvNewPetugasMarine($id){
    //     $this->db->from('tb_marine_inv_draftdetail');
    //     $this->db->where('invMarDetailID', $id);
    //     $this->db->join('tb_marine_inv_draft', 'tb_marine_inv_draft.invMarID = tb_marine_inv_draftdetail.invMarD_invID');
    //     $this->db->join('tb_petugas', 'tb_petugas.petugasID = tb_marine_inv_draftdetail.invMarD_petugasID');
    //     $this->db->join('tb_status', 'tb_status.statusID =  tb_marine_inv_draftdetail.invMarD_statusID');
    //     $query = $this->db->get();
    //     return $query;
    // }

    // public function getDetailIDMarine($id){
    //     $this->db->from('tb_marine_inv_draftdetail');
    //     $this->db->where_in('invMarD_invID', $id);
    //     $this->db->join('tb_marine_inv_draft', 'tb_marine_inv_draft.invMarID = tb_marine_inv_draftdetail.invMarD_invID');
    //     $this->db->join('tb_petugas', 'tb_petugas.petugasID = tb_marine_inv_draftdetail.invMarD_petugasID');
    //     $this->db->join('tb_status', 'tb_status.statusID =  tb_marine_inv_draftdetail.invMarD_statusID');
    //     $query = $this->db->get();
    //     return $query;
    // }

    // public function getDetailPetugasIDMarine($petugas){
    //     $this->db->from('tb_marine_inv_draftdetail');
    //     $this->db->where('invMarD_penerimaID', $petugas);
    //     $this->db->or_where('invMarD_pengirimID', $petugas);
    //     $this->db->order_by('invMarD_invID', 'DESC');
    //     $this->db->join('tb_marine_inv_draft', 'tb_marine_inv_draft.invMarID = tb_marine_inv_draftdetail.invMarD_invID');
    //     $this->db->join('tb_petugas', 'tb_petugas.petugasID = tb_marine_inv_draftdetail.invMarD_petugasID');
    //     $this->db->join('tb_status', 'tb_status.statusID =  tb_marine_inv_draftdetail.invMarD_statusID');
    //     $query = $this->db->get();
    //     return $query;
    // }

    /////////////////////////////////////////////////////////////
    // public function getInvFRID($id){
    //     $this->db->from('tb_marine_inv_draft');
    //     $this->db->where_in('invMar_frDetailID', $id);
    //     $query = $this->db->get();
    //     return $query;
    // }
    /////////////////////////////////////////////////////////////

    // public function getDataDescInvoiceMarine($id){
    //     $this->db->from('tb_marine_inv_draftdetail');
    //     $this->db->where_in('invMarD_invID', $id);
    //     $this->db->join('tb_marine_inv_draft', 'tb_marine_inv_draft.invMarID = tb_marine_inv_draftdetail.invMarD_invID');
    //     $this->db->join('tb_petugas', 'tb_petugas.petugasID = tb_marine_inv_draftdetail.invMarD_petugasID');
    //     $this->db->join('tb_status', 'tb_status.statusID =  tb_marine_inv_draftdetail.invMarD_statusID');
    //     $this->db->order_by('invMarDetailID', 'DESC');
    //     $query = $this->db->get();
    //     return $query;
    // }

     
  

    ////////////////////////////INV Minerba///////////////////////////////////////

    // public function getInvFRIDMin($id){
    //     $this->db->from('tb_minerba_inv_draft');
    //     $this->db->where_in('invMin_frDetailID', $id);
    //     $query = $this->db->get();
    //     return $query;
    // }

    // public function getDetailIDMinerba($id){
    //     $this->db->from('tb_minerba_inv_draftdetail');
    //     $this->db->where_in('invMinD_invID', $id);
    //     $this->db->join('tb_minerba_inv_draft', 'tb_minerba_inv_draft.invMinID = tb_minerba_inv_draftdetail.invMinD_invID');
    //     $this->db->join('tb_petugas', 'tb_petugas.petugasID = tb_minerba_inv_draftdetail.invMinD_petugasID');
    //     $this->db->join('tb_status', 'tb_status.statusID = tb_minerba_inv_draftdetail.invMinD_statusID');
    //     $query = $this->db->get();
    //     return $query;
    // }

    // public function getDetailPetugasIDMinerba($petugas){
    //     $this->db->from('tb_minerba_inv_draftdetail');
    //     $this->db->where('invMinD_penerimaID', $petugas);
    //     $this->db->or_where('invMinD_pengirimID', $petugas);
    //     $this->db->order_by('invMinD_invID', 'DESC');
    //     $this->db->join('tb_minerba_inv_draft', 'tb_minerba_inv_draft.invMinID = tb_minerba_inv_draftdetail.invMinD_invID');
    //     $this->db->join('tb_petugas', 'tb_petugas.petugasID = tb_minerba_inv_draftdetail.invMinD_petugasID');
    //     $this->db->join('tb_status', 'tb_status.statusID = tb_minerba_inv_draftdetail.invMinD_statusID');
    //     $query = $this->db->get();
    //     return $query;
    // }

}

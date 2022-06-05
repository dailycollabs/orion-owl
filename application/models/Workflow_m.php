<?php

// // rka/Project
// class Workflow_m extends CI_Model{
    



//     public function getWorkflowPetugas($petugas){
//         $this->db->select_max('quoDetailID');
//         $this->db->from('tb_quotationdetail');
//         $this->db->where('quoD_pengirimID', $petugas);
//         $this->db->or_where('quoD_penerimaID', $petugas);
//         $this->db->group_by('quoD_quoID');
//         // $this->db->order_by('quoD_quoID');
//         $this->db->order_by('quoDetailID', 'DESC');
//         $query = $this->db->get();
//         return $query;
//     }

//     public function getWorkflowPetugasID($petugas){
//         $this->db->from('tb_quotationdetail');
//         $this->db->where('quoD_pengirimID', $petugas);
//         $this->db->or_where('quoD_penerimaID', $petugas);
//         // $this->db->group_by('quoD_quoID');
//         $this->db->order_by('quoDetailID', 'DESC');
//         $this->db->join('tb_quotation', 'tb_quotation.quoID = tb_quotationdetail.quoD_quoID');
//         $this->db->join('tb_petugas', 'tb_petugas.petugasID = tb_quotationdetail.quoD_petugasID');
//         $this->db->join('tb_status', 'tb_status.statusID = tb_quotationdetail.quoD_statusID');
//         $query = $this->db->get();
//         return $query;
//     }

 

//     public function getWorkflowPetugasData($id){
//         $this->db->from('tb_quotationdetail');
//         $this->db->where_in('quoDetailID', $id);
//         $this->db->join('tb_quotation', 'tb_quotation.quoID = tb_quotationdetail.quoD_quoID');
//         $this->db->join('tb_petugas', 'tb_petugas.petugasID = tb_quotationdetail.quoD_petugasID');
//         $this->db->join('tb_status', 'tb_status.statusID = tb_quotationdetail.quoD_statusID');
//         $query = $this->db->get();
//         return $query;

//     }

//     public function getQuoDetailAllCheck($id, $quoID){
//         $this->db->from('tb_quotationdetail');
//         $this->db->where('quoDetailID', $id);
//         $this->db->where('quoD_quoID', $quoID);
//         $this->db->join('tb_quotation', 'tb_quotation.quoID = tb_quotationdetail.quoD_quoID');
//         $this->db->join('tb_petugas', 'tb_petugas.petugasID = tb_quotationdetail.quoD_petugasID');
//         $this->db->join('tb_status', 'tb_status.statusID = tb_quotationdetail.quoD_statusID');
//         $query = $this->db->get();
//         return $query;
//     }

//     public function getWorkApprov($id){
//         $this->db->from('tb_jobd_aproval');
//         $this->db->where_in('jobdA_quoDetailID', $id);
//         $this->db->join('tb_quotationdetail', 'tb_quotationdetail.quoDetailID = tb_jobd_aproval.jobdA_quoDetailID');
//         $query = $this->db->get();
//         return $query;
//     }

//     public function getPetugasApprovalJobd($petugas){
//         $this->db->from('tb_jobd_approvaldetail');
//         $this->db->where('jobdaD_penerimaID', $petugas);
//         $this->db->or_where('jobdaD_pengirimID', $petugas);
//         $this->db->join('tb_jobd_aproval', 'tb_jobd_aproval.jobdApprovID = tb_jobd_approvaldetail.jobdaD_jobdApprovID');
//         $this->db->join('tb_petugas', 'tb_petugas.petugasID = tb_jobd_approvaldetail.jobdaD_petugasID');
//         // $this->db->order_by('waktu', 'DESC');
//         $query = $this->db->get();
//         return $query;
//     }

//     public function getApprovalJobdID($approvDetailID, $approvID){
//         $this->db->from('tb_jobd_approvaldetail');
//         $this->db->where_in('jobdaDetailID', $approvDetailID);
//         $this->db->where('jobdaD_jobdApprovID', $approvID);
//         $this->db->join('tb_jobd_aproval', 'tb_jobd_aproval.jobdApprovID = tb_jobd_approvaldetail.jobdaD_jobdApprovID');
//         $this->db->join('tb_petugas', 'tb_petugas.petugasID = tb_jobd_approvaldetail.jobdaD_petugasID');
//         $this->db->order_by('waktu', 'DESC');
//         $query = $this->db->get();
//         return $query;
//     }
    
  


// }

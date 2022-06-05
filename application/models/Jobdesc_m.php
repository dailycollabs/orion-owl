<?php

class Jobdesc_m extends CI_Model{

//////////////////////////////////////////////////////////////////////////////////////////////////////
    public function getJobdscByID($id){
        $this->db->from('tb_jobd_aproval');
        $this->db->where('jobdApprovID', $id);
        $query = $this->db->get();
        return $query;
    }

//////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////
    public function getJobdscByNoDesc($id){
        $this->db->from('tb_jobd_aproval');
        $this->db->where('jobdApprovNo', $id);
        $this->db->order_by('jobdApprovID', 'DESC');
        $query = $this->db->get();
        return $query;
    }

   
//////////////////////////////////////////////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////////////////////////////////////////////
    public function getJobdscByQuoDID($id){
        $this->db->from('tb_jobd_aproval');
        $this->db->where_in('jobdA_quoDetailID', $id);
        $this->db->join('tb_quotationdetail', 'tb_quotationdetail.quoDetailID = tb_jobd_aproval.jobdA_quoDetailID');
        $query = $this->db->get();
        return $query;
    }
//////////////////////////////////////////////////////////////////////////////////////////////////////


//////////////////////////////////////////////////////////////////////////////////////////////////////
    //Menampilkan quoID yang paling besar
    public function getJobdscMaxByBidang($bidang){
        $this->db->select_max('jobdApprovID');
        $this->db->from('tb_jobd_aproval');
        $this->db->like('jobdApprovID', $bidang, 'both'); 
        $query = $this->db->get();
        return $query;
    }
    
//////////////////////////////////////////////////////////////////////////////////////////////////////

    public function addJobdesc($post){
        $params = array(     
            'jobdApprovID'      => $post['id'],
            'jobdApprovNo'      => $post['jobdNo'],
            'jobdA_quoDetailID' => $post['quoDetailID'],
            'jobdA_orderID'     => $post['orderID'],
            'jobdA_bidangID'    => $post['bidangID'],
        );
        $query = $this->db->insert('tb_jobd_aproval', $params);
        return $query;
    }




    //====================JOB DESC PROSES==================
    public function addJobdscDetail($post){
        $params = array(     
            'jobdaD_jobdApprovID'       => $post['jobdID'],
            'jobdaD_petugasID'          => $post['petugasID'],
            'jobdaD_pengirimID'         => $post['pengirimID'],
            'jobdaD_penerimaID'         => $post['penerimaID'],
            'jobdaDFile'                => $post['jobdFile'],     
            'jobdaD_statusID'           => $post['status'],
            'statusKonfirmasi'          => $post['statuskonf'],
        );
        $query = $this->db->insert('tb_jobd_approvaldetail', $params);
        return $query;
    }

//////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////
    public function getJobdscDByID($id){
        $this->db->from('tb_jobd_approvaldetail');
        $this->db->where('jobdaDetailID', $id);
        $this->db->join('tb_jobd_aproval', 'tb_jobd_aproval.jobdApprovID = tb_jobd_approvaldetail.jobdaD_jobdApprovID');
        $this->db->join('tb_petugas', 'tb_petugas.petugasID = tb_jobd_approvaldetail.jobdaD_petugasID');
        $this->db->join('tb_status', 'tb_status.statusID = tb_jobd_approvaldetail.jobdaD_statusID');
        $query = $this->db->get();
        return $query;
    }
//////////////////////////////////////////////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////////////////////////////////////////////
    //Menampilkan data FR Detail Marine berdasarkan ID
    public function getJobdscDByDetailIDDesc($id){
        $this->db->from('tb_jobd_approvaldetail');
        $this->db->where_in('jobdaDetailID', $id);
        $this->db->join('tb_jobd_aproval', 'tb_jobd_aproval.jobdApprovID = tb_jobd_approvaldetail.jobdaD_jobdApprovID');
        $this->db->join('tb_petugas', 'tb_petugas.petugasID = tb_jobd_approvaldetail.jobdaD_petugasID');
        $this->db->join('tb_status', 'tb_status.statusID = tb_jobd_approvaldetail.jobdaD_statusID');
        $this->db->order_by('jobdaDetailID', 'DESC');
        $query = $this->db->get();
        return $query;
    }
//////////////////////////////////////////////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////////////////////////////////////////////  
    public function getJobdscDByJobID($id){
        $this->db->from('tb_jobd_approvaldetail');
        $this->db->where_in('jobdaD_jobdApprovID', $id);
        $this->db->join('tb_jobd_aproval', 'tb_jobd_aproval.jobdApprovID = tb_jobd_approvaldetail.jobdaD_jobdApprovID');
        $this->db->join('tb_petugas', 'tb_petugas.petugasID = tb_jobd_approvaldetail.jobdaD_petugasID');
        $this->db->join('tb_status', 'tb_status.statusID = tb_jobd_approvaldetail.jobdaD_statusID');
        $query = $this->db->get();
        return $query;
    }

   
//////////////////////////////////////////////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////////////////////////////////////////////  
    public function getJobdscDNotifNew($petugas){
        $this->db->from('tb_jobd_approvaldetail');
        $this->db->where('jobdaD_penerimaID', $petugas);
        $this->db->where('statusKonfirmasi', 'send');
        $this->db->join('tb_jobd_aproval', 'tb_jobd_aproval.jobdApprovID = tb_jobd_approvaldetail.jobdaD_jobdApprovID');
        $query = $this->db->get();
        return $query;
    }

//////////////////////////////////////////////////////////////////////////////////////////////////////

////////////////////////////////////////////////////////////////////////////////////////////////////// 
   

    public function getJobdscDByPetugasIDNew($post){
        $this->db->from('tb_jobd_approvaldetail');
        $this->db->where('jobdaD_penerimaID', $post['penerima']);
        $this->db->where('jobdaD_pengirimID', $post['pengirim']);
        $this->db->where('statusKonfirmasi', 'send');
        $this->db->join('tb_jobd_aproval', 'tb_jobd_aproval.jobdApprovID = tb_jobd_approvaldetail.jobdaD_jobdApprovID');
        $this->db->join('tb_petugas', 'tb_petugas.petugasID = tb_jobd_approvaldetail.jobdaD_petugasID');
        $this->db->join('tb_status', 'tb_status.statusID = tb_jobd_approvaldetail.jobdaD_statusID');
        $this->db->order_by('waktu', 'DESC');
        $query = $this->db->get();
        return $query;
    }

//////////////////////////////////////////////////////////////////////////////////////////////////////

////////////////////////////////////////////////////////////////////////////////////////////////////// 

    public function setJobdscDStatusKonf($post){
        $data = array(
            'statusKonfirmasi'   => $post['statusConf'],  
            'waktu_start'   => $post['waktustart'],  
            'waktu_end'     => $post['waktuend'],
        );
        $this->db->where('jobdaDetailID', $post['jobdID']);
        $query = $this->db->update('tb_jobd_approvaldetail',$data);
    }


 ///////////////////////////////////////////////////////////////////////////////////////

////////////////////////////////////////////////////////////////////////////////////////


    public function getJobdscDByPetugasID($petugas){
        $this->db->from('tb_jobd_approvaldetail');
        $this->db->where('jobdaD_penerimaID', $petugas);
        $this->db->or_where('jobdaD_pengirimID', $petugas);
        $this->db->join('tb_jobd_aproval', 'tb_jobd_aproval.jobdApprovID = tb_jobd_approvaldetail.jobdaD_jobdApprovID');
        $this->db->join('tb_petugas', 'tb_petugas.petugasID = tb_jobd_approvaldetail.jobdaD_petugasID');
        $this->db->join('tb_status', 'tb_status.statusID = tb_jobd_approvaldetail.jobdaD_statusID');
        $query = $this->db->get();
        return $query;
    }
/////////////////////////////////////////////////////////////////////////////////////////

/////////////////////////////////////////////////////////////////////////////////////////


    public function getJobdscDByDetailID($approvDetailID, $approvID){
        $this->db->from('tb_jobd_approvaldetail');
        $this->db->where_in('jobdaDetailID', $approvDetailID);
        $this->db->where('jobdaD_jobdApprovID', $approvID);
        $this->db->join('tb_jobd_aproval', 'tb_jobd_aproval.jobdApprovID = tb_jobd_approvaldetail.jobdaD_jobdApprovID');
        $this->db->join('tb_petugas', 'tb_petugas.petugasID = tb_jobd_approvaldetail.jobdaD_petugasID');
        $this->db->join('tb_status', 'tb_status.statusID = tb_jobd_approvaldetail.jobdaD_statusID');
        $this->db->order_by('waktu', 'DESC');
        $query = $this->db->get();
        return $query;
    }

/////////////////////////////////////////////////////////////////////////////////////////

/////////////////////////////////////////////////////////////////////////////////////////


    public function getJobdscDByPenerimaID($post){
        $this->db->from('tb_jobd_approvaldetail');
        $this->db->where('jobdaD_penerimaID', $post['subbidangPetugas']);
        $this->db->order_by('jobdaDetailID', 'DESC');
        $this->db->join('tb_status', 'tb_status.statusID = tb_jobd_approvaldetail.jobdaD_statusID');
        $query = $this->db->get();
        return $query; 
    }

/////////////////////////////////////////////////////////////////////////////////////////

/////////////////////////////////////////////////////////////////////////////////////////


    public function getJobdscDByPengirimID($post){
        $this->db->from('tb_jobd_approvaldetail');
        $this->db->where('jobdaD_pengirimID', $post['subbidangPetugas']);
        $this->db->where('jobdaD_jobdApprovID', $post['jobdID']);
        $this->db->order_by('jobdaDetailID', 'DESC');
        $this->db->join('tb_jobd_aproval', 'tb_jobd_aproval.jobdApprovID = tb_jobd_approvaldetail.jobdaD_jobdApprovID');
        $this->db->join('tb_petugas', 'tb_petugas.petugasID = tb_jobd_approvaldetail.jobdaD_petugasID');
        $this->db->join('tb_status', 'tb_status.statusID = tb_jobd_approvaldetail.jobdaD_statusID');
        $query = $this->db->get();
        return $query;
    }

 ///////////////////////////////////////////////////////////////////////////////////////
    public function setJobdscDStatus($post){
        $params = array(     
            'jobdaD_statusID'          => $post['status'],
        );
        $this->db->where('jobdaDetailID', $post['jobdaDetailID']);
        $query = $this->db->update('tb_jobd_approvaldetail', $params);
        return $query;
    }
   
 ///////////////////////////////////////////////////////////////////////////////////////

    
 ///////////////////////////////////////////////////////////////////////////////////////
    
    public function getJobdscDByPenerimaJobdescID($id, $petugas){
        $this->db->from('tb_jobd_approvaldetail');
        $this->db->where('jobdaD_penerimaID', $petugas);
        $this->db->where_in('jobdaD_jobdApprovID', $id);
        $this->db->join('tb_jobd_aproval', 'tb_jobd_aproval.jobdApprovID = tb_jobd_approvaldetail.jobdaD_jobdApprovID');
        $this->db->join('tb_petugas', 'tb_petugas.petugasID = tb_jobd_approvaldetail.jobdaD_petugasID');
        $this->db->join('tb_status', 'tb_status.statusID = tb_jobd_approvaldetail.jobdaD_statusID');
        $this->db->order_by("jobdaDetailID", "DESC");
        $query = $this->db->get();
        return $query;
    }
 ///////////////////////////////////////////////////////////////////////////////////////
     

 ///////////////////////////////////////////////////////////////////////////////////////
     //Menampilkan data FR berdasarkan quoD_pengirimID yang login dan quoD_quoID, kemudian urutkan quoDetailID Desc
     public function getJobdscDBypengirimJobdscID($id, $petugas){
        $this->db->from('tb_jobd_approvaldetail');
        $this->db->where('jobdaD_pengirimID', $petugas);
        $this->db->where_in('jobdaD_jobdApprovID', $id);
        $this->db->order_by("jobdaDetailID", "DESC");
        $this->db->join('tb_jobd_aproval', 'tb_jobd_aproval.jobdApprovID = tb_jobd_approvaldetail.jobdaD_jobdApprovID');
        $this->db->join('tb_petugas', 'tb_petugas.petugasID = tb_jobd_approvaldetail.jobdaD_petugasID');
        $this->db->join('tb_status', 'tb_status.statusID = tb_jobd_approvaldetail.jobdaD_statusID');
        $query = $this->db->get();
        return $query;
    }

 ///////////////////////////////////////////////////////////////////////////////////////
    
 /////////////////////////////////////////Max//////////////////////////////////////////////
    //Menampilkan quoDetailID yang Maximal atau yang paling besar, berdasarkan quoD_quoID dan quoD_penerimaID yang login
   

 ///////////////////////////////////////////////////////////////////////////////////////
  

    public function getJobdscDMaxBypenerimaID($id){
        $this->db->select_max('jobdaDetailID');
        $this->db->from('tb_jobd_approvaldetail');
        $this->db->where('jobdaD_penerimaID', $id);
        $this->db->group_by('jobdaD_jobdApprovID');
        $this->db->order_by('jobdaDetailID', 'DESC');
        $query = $this->db->get();
        return $query; 
    }
 ///////////////////////////////////////////////////////////////////////////////////////
  ///////////////////////////////////////////////////////////////////////////////////////

    //Menampilkan quoDetailID yang Maximal atau yang paling besar, berdasarkan quoD_quoID dan quoD_penerimaID yang login
    public function getJobdscDMaxByPenerimaJobdscID($id, $petugas){
        $this->db->select_max('jobdaDetailID');
        $this->db->from('tb_jobd_approvaldetail');
        $this->db->where_in('jobdaD_jobdApprovID', $id);
        $this->db->where('jobdaD_penerimaID', $petugas);
        $this->db->group_by('jobdaD_jobdApprovID');
        $this->db->order_by('jobdaDetailID', 'DESC');
        $query = $this->db->get();
        return $query; 
    }
///////////////////////////////////////////////////////////////////////////////////////






}

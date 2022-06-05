<?php

Class Fungsi_send {
    protected $ci;
    var $pengirim;
    var $subbidangID;

    function __construct(){
        $this->ci =& get_instance();
    }

    
    //fungsinya untuk mengirimkan data Rka Baru
    //Bagian Admin Tidak ada karena di bagian admin hanya menerima data dari client
    function sendreceiver1(){
        $this->ci->load->model(['Petugas_m','Subbidang_m']);
        $petugas_id = $this->ci->session->userdata('petugasID');
        $petugas_data = $this->ci->Petugas_m->getAll($petugas_id)->row();
        $bidang_data = $this->ci->Subbidang_m->getAll($petugas_data->subbidangID)->row();

        $bidangID = $bidang_data->bidangID;

        if($petugas_data->subbidangID == 'HR'){
            $this->subbidangID = 'FM';
            
        }
        else if($petugas_data->subbidangID == 'FM'){
            $this->subbidangID = 'HR';
        
        }
        return $this->subbidangID;
     
       
  
    }

    function sendreceiver2(){
        $this->ci->load->model(['Petugas_m','Subbidang_m']);
        $petugas_id = $this->ci->session->userdata('petugasID');
        $petugas_data = $this->ci->Petugas_m->getAll($petugas_id)->row();
        $bidang_data = $this->ci->Subbidang_m->getAll($petugas_data->subbidangID)->row();

        $bidangID = $bidang_data->bidangID;

        if($petugas_data->subbidangID == 'AM1' || $petugas_data->subbidangID == 'AM2'){
            $this->subbidangID = 'HR';
        }
        else if($petugas_data->subbidangID == 'HR'){
            $this->subbidangID = 'GA';
        }
        else if($petugas_data->subbidangID == 'GA'){
            $this->subbidangID = 'HR';
        }
        return $this->subbidangID;
     
       
  
    }

    

    function sendreceiver4($id){
        $this->ci->load->model(['Petugas_m','Subbidang_m']);
        $petugas_id = $this->ci->session->userdata('petugasID');
        $petugas_data = $this->ci->Petugas_m->getAll($petugas_id)->row();
        $bidang_data = $this->ci->Subbidang_m->getAll($petugas_data->subbidangID)->row();

        $bidangID = $bidang_data->bidangID;
            if($petugas_data->subbidangID == 'HR'){
                $this->subbidangID = 'AM'.$id;
            }

            return $this->subbidangID;
  
    }


    /////////////////Khusus Bagian BreakdownList/////////////////////
    function sendreceiver5(){
        $this->ci->load->model(['Petugas_m','Subbidang_m']);
        $petugas_id = $this->ci->session->userdata('petugasID');
        $petugas_data = $this->ci->Petugas_m->getAll($petugas_id)->row();
        $bidang_data = $this->ci->Subbidang_m->getAll($petugas_data->subbidangID)->row();

        $bidangID = $bidang_data->bidangID;

        if($petugas_data->subbidangID == 'HR'){
            $this->subbidangID = 'GA';
        }
        else if($petugas_data->subbidangID == 'FM'){
            $this->subbidangID = 'HR';
        }
        
        return $this->subbidangID;

    }

    function sendreceiver6(){
        $this->ci->load->model(['Petugas_m','Subbidang_m']);
        $petugas_id = $this->ci->session->userdata('petugasID');
        $petugas_data = $this->ci->Petugas_m->getAll($petugas_id)->row();
        $bidang_data = $this->ci->Subbidang_m->getAll($petugas_data->subbidangID)->row();

        $bidangID = $bidang_data->bidangID;

        if($petugas_data->subbidangID == 'GA'){
            $this->subbidangID = 'HR';
        }
        else if($petugas_data->subbidangID == 'HR'){
            $this->subbidangID = 'FM';
        }
        
        return $this->subbidangID;

    }

    ///////////////////////////////////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////////////////////////

     //fungsinya untuk mengirimkan data Rka Baru
    //Bagian Admin Tidak ada karena di bagian admin hanya menerima data dari client
    function sendreceiverRka1($bidangID){
        $this->ci->load->model(['Petugas_m','Subbidang_m']);
        $petugas_id = $this->ci->session->userdata('petugasID');
        $petugas_data = $this->ci->Petugas_m->getAll($petugas_id)->row();
        $bidang_data = $this->ci->Subbidang_m->getAll($petugas_data->subbidangID)->row();

        // $bidangID = $bidang_data->bidangID;

       if($bidangID == 1){
            if($petugas_data->subbidangID == 'SM1'){
                $this->subbidangID = 'AM1';
            }
            else if($petugas_data->subbidangID == 'AM1'){
                $this->subbidangID = 'OMM1';
                
            }
            else if($petugas_data->subbidangID == 'OMM1'){
                $this->subbidangID = 'MDM1';
             
            }
            else if($petugas_data->subbidangID == 'MDM1'){
                $this->subbidangID = 'FM';
          
            }
            return $this->subbidangID;
        } 
        else if($bidangID == 2){
            if($petugas_data->subbidangID == 'SM2'){
                $this->subbidangID = 'AM2';
            }

            else if($petugas_data->subbidangID == 'AM2'){
                $this->subbidangID = 'MDM2';
              
            }
            else if($petugas_data->subbidangID == 'MDM2'){
                $this->subbidangID = 'FM';
            }
            return $this->subbidangID;

        } 
  
    }

    function sendreceiverRka2($bidangID){
        $this->ci->load->model(['Petugas_m','Subbidang_m']);
        $petugas_id = $this->ci->session->userdata('petugasID');
        $petugas_data = $this->ci->Petugas_m->getAll($petugas_id)->row();
        $bidang_data = $this->ci->Subbidang_m->getAll($petugas_data->subbidangID)->row();

        // $bidangID = $bidang_data->bidangID;

       if($bidangID == 1){
            if($petugas_data->subbidangID == 'AM1'){
                $this->subbidangID = 'SM1';
            }
            else if($petugas_data->subbidangID == 'OMM1'){
                $this->subbidangID = 'AM1';
            }
            else if($petugas_data->subbidangID == 'MDM1'){
                $this->subbidangID = 'OMM1';
                
            }
            else if($petugas_data->subbidangID == 'FM'){
                $this->subbidangID = 'MDM1';
               
            }
            return $this->subbidangID;
        } 
        else if($bidangID == 2){

            if($petugas_data->subbidangID == 'AM2'){
                $this->subbidangID = 'SM2';
            }

            else if($petugas_data->subbidangID == 'MDM2'){
                $this->subbidangID= 'AM2';
                
            }
            else if($petugas_data->subbidangID == 'FM'){
                $this->subbidangID = 'MDM2';
                
            }
            return $this->subbidangID;

        }
      
       
  
    }



}
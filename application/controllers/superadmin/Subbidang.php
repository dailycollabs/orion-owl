<?php defined('BASEPATH') or exit('No direct script access allowed');

class Subbidang extends CI_Controller{

    function __construct(){
        parent::__construct();
        $this->load->model(['Bidang_m', 'Subbidang_m']);
    }

    function index(){
        $data['title'] = 'Sub Bidang | Superadmin';
        $data['data'] = $this->Bidang_m->get();
        // echo json_encode($data);
        $this->load->view('pengelola/subbidang', $data);
    }

    function getSubbidang(){
        $data = $this->Subbidang_m->getAll()->result();
        echo json_encode($data);        
    }

    function saveSubbidang(){
        $subbidang = $this->input->post(null, TRUE);
        $data = $this->Subbidang_m->addSubBidang($subbidang);
        if($data){
            $array = array(
                'status' => 'sukses',
            ); 
        }
         echo json_encode($array);
    }

    function getSubbidangEdit(){
        $subbidangID = $this->input->get('id');
        $data = $this->Subbidang_m->getAll($subbidangID)->row();
        echo json_encode($data);        
    }

    function updateSubbidang(){
        $subbidangEdit = $this->input->post(null, TRUE);
        $data = $this->Subbidang_m->editSubbidang($subbidangEdit);
        if($data){
            $array = array(
                'status' => 'sukses',
            );
        }
        echo json_encode($array);        
    }

    function deleteSubbidang(){
        $bidangID = $this->input->post('id');
        $data = $this->Subbidang_m->deleteSubBidang($bidangID);

        if($data){
            $array = array(
                'status' => 'sukses',
            );
        }
        echo json_encode($array);    
    }
}
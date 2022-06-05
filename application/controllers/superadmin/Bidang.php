<?php defined('BASEPATH') or exit('No direct script access allowed');

class Bidang extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Bidang_m');
    }
    function index()
    {
        $data['title'] = 'Bidang | Superadmin';
        $data['data'] = $this->Bidang_m->get();
        $this->load->view('pengelola/bidang', $data);
    }

    function getBidang(){
        $data = $this->Bidang_m->get()->result();
        echo json_encode($data);        
    }

    function saveBidang(){
        $bidangNama = $this->input->post('bidangNama');
        $data = $this->Bidang_m->addBidang($bidangNama);
        if($data){
            $array = array(
                'status' => 'sukses',
            ); 
        }
         echo json_encode($array);
    }

    function getBidangEdit(){
        $bidangID = $this->input->get('id');
        $data = $this->Bidang_m->get($bidangID)->row();
        echo json_encode($data);        
    }
    
   

    function updateBidang(){
        $bidangEdit = $this->input->post(null, TRUE);
        $data = $this->Bidang_m->editBidang($bidangEdit);
        if($data){
            $array = array(
                'status' => 'sukses',
            );
        }
        echo json_encode($array);        
    }

    function deleteBidang(){
        $bidangID = $this->input->post('id');
        $data = $this->Bidang_m->deleteBidang($bidangID);

        if($data){
            $array = array(
                'status' => 'sukses',
            );
        }
        echo json_encode($array);    
    }

}

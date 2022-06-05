<?php defined('BASEPATH') or exit('No direct script access allowed');

class Pengaturan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model(['Pengaturan_m']);
        $this->load->helper(array('form','url'));
        $this->load->library(array('form_validation'));	
    }
    function index()
    {
        $this->load->view('pengelola/pengaturan');
       
    }
    
    public function getPengaturanWaktu(){
        $data = $this->Pengaturan_m->getAll();
        $array = array();
        foreach($data->result() as $row){
            $array[] = array(
                'pengaturanID' => $row->pengaturanID,
                'waktu'        => $row->waktu,
            ); 
        }
        echo json_encode($array);             
    }
}

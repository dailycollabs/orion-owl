<?php defined('BASEPATH') or exit('No direct script access allowed');

class Prosesorder extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
    }
    function index()
    {
        $data['title'] = "Proses Order | Superadmin";
        $this->load->view('pengelola/prosesorder', $data);
    }
    function prosesorder_minerba()
    {
        $data['title'] = 'Proses Order | Superadmin';
        $this->load->view('pengelola/prosesorder_minerba', $data);
    }
    function prosesorder_marine()
    {
        $data['title'] = 'Proses Order | Superadmin';
        $this->load->view('pengelola/prosesorder_marine', $data);
    }
}

<?php defined('BASEPATH') or exit('No direct script access allowed');
class Client extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
    }
    function index()
    {
        $data['title'] = 'Konfirmasi Client';
        $this->load->view('pengelola/client_konfirmasiclient', $data);
    }
    function konfirmasi_client()
    {
        $data['title'] = 'Konfirmasi Client';
        $this->load->view('pengelola/client_konfirmasiclient', $data);
    }
    function data_client()
    {
        $data['title'] = 'Data Client';
        $this->load->view('pengelola/client_dataclient', $data);
    }
}

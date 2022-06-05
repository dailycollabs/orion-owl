<?php defined('BASEPATH') or exit('No direct script access allowed');

class Dataorder extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
    }
    function index()
    {
        $data['title'] = 'Data Order | Superadmin';
        $this->load->view('pengelola/data_order', $data);
    }

    //Marine Order List
    function minerbaOrderList()
    {
        $data['title'] = 'Data Order Minerba List';
        $this->load->view('pengelola/minerba_order_list', $data);
    }

    //Minerba Order List
    function marineOrderList()
    {
        $data['title'] = 'Data Order Marine List';
        $this->load->view('pengelola/marine_order_list', $data);
    }
}

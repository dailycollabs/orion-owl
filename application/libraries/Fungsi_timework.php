<?php

Class Fungsi_timework {
    protected $ci;
    var $timework;


    function __construct(){
        $this->ci =& get_instance();
    }

    function timework(){
        $this->ci->load->model(['Pengaturan_m']);
        $notif = $this->ci->Pengaturan_m->getAll()->row();
        $waktu = $notif->waktu;
        return $waktu;
    }

    


 


}
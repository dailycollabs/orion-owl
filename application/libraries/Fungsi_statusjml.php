<?php

Class Fungsi_statusjml{
    
    protected $ci;
    var $pengirim;
    var $subbidangID;

    function __construct(){
        $this->ci =& get_instance();
    }

    function sendRecive($jumlah){
        $fungsiJumlah = $jumlah;

            if($fungsiJumlah == 0){
                $data['jumlah'] = 0;
                $data['status'] = 'NW1';
            } else if($fungsiJumlah == 1){
                $data['jumlah'] = 1;
                $data['status']  = 'RV1';
            } else if($fungsiJumlah == 2){
                $data['jumlah'] = 2;
                $data['status'] = 'RV1';
            } else if($fungsiJumlah == 3){
                $data['jumlah'] = 3;
                $data['status'] = 'RV1'; 
            } else{
                $data['jumlah'] = 4;
                $data['status'] = 'RJ2';
            } 
            return $data;
        // }
       
    }

    function sendReciveRevisi($jumlah){
        $fungsiJumlah = $jumlah;

            if($fungsiJumlah == 0){
                $data['jumlah'] = 0;
                $data['status'] = 'FD1';
            } else if($fungsiJumlah == 1){
                $data['jumlah'] = 1;
                $data['status']  = 'FD1';
            } else if($fungsiJumlah == 2){
                $data['jumlah'] = 2;
                $data['status'] = 'FD1';
            } else if($fungsiJumlah == 3){
                $data['jumlah'] = 3;
                $data['status'] = 'FD1'; 
            } else{
                $data['jumlah'] = 4;
                $data['status'] = 'RJ2';
            } 
            return $data;
        // }
       
    }

}
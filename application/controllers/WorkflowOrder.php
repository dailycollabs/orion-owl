<?php defined('BASEPATH') OR exit('No direct script access allowed');

class WorkflowOrder extends CI_Controller {

    function __construct(){
        $quoID = array();
        parent::__construct();
        check_not_petugas();
        $this->load->model(['Order_m', 'ClientProject_m']);
        $this->load->library('form_validation');
        // $this->fungsi_waktu->timeWorkOrder();
    }

    // Order
    public function addOrder(){
        $timeWork = $this->fungsi_timework->timework();
        $post      = array();
        $response = array();
        $id        = $this->input->post('projectID');
        $project   = $this->ClientProject_m->getAllID($id)->row();
        $petugasID = $this->fungsi->petugas_login()->petugasID;
        $subbidangID = $this->fungsi->petugas_login()->subbidangID;
         ////////////Create ID//////////
        date_default_timezone_set("Asia/Jakarta");
        if($project->projectbidangID == 1){
            $bidang = 'MAR';
        }else if($project->projectbidangID == 2){
            $bidang = 'MIN';
        }
        $char    = 'ORD';
        $date    = date("Y-m-d");
        $tahun   = substr($date, 0, 2);
        $bulan   = substr($date, 5, 2);
        $hari    = substr($date, 8, 2);
        $order   = $this->Order_m->getAllMaxLike($bidang)->row(); 
        $orderID = (int) substr($order->orderID, 12, 4);
        $orderID++;
        $newOrderID = $char.$bidang.$tahun.$bulan.$hari.sprintf("%04s", $orderID);
        /////////////End Create ID////////////
        
        $waktustart   = date('Y-m-d H:i:s');
        $waktuend     = date('Y-m-d H:i:s',strtotime('+'.$timeWork.' minutes',strtotime($waktustart)));

        $post = array(
            'id'          => $newOrderID,
            'projectID'   => $project->projectID,
            'clientID'    => $project->projectclientID,
            'bidangID'    => $project->projectbidangID,
            'petugasID'   => $petugasID,
            'subbidangID' => $subbidangID,
            'status'      => 'PR1',//Proses
            'waktustart'  => $waktustart,
            'waktuend'    => $waktuend
        );

        $this->Order_m->addOrder($post);
        if($this->db->affected_rows()){
            $data = $this->Order_m->getAllByID($newOrderID)->row();
            $response  = array(
                'status' => 'success',
                'orderID' => $data->orderID,
            );
        }

        echo json_encode($response);

    }

    public function timeViewOrder(){
        $this->fungsi_waktu->timeWorkOrder();
        $response = array();
        $xproses = array();
        $getID    = $this->input->get('id');
        // $getID = 'ORDMAR2012030004';
        $waktu_sekarang = date('Y-m-d H:i:s');
        $dataFR = $this->Order_m->getAllByID($getID)->row();
        // foreach($dataFR as $row){
            if($dataFR->status == 'reject'){
                $xproses = 'reject';
            }else if($dataFR->status == 'success'){
                $xproses = 'success';
            }else{
                $xproses = 'proses';
            }
        // }

        if($dataFR->waktu_end != null){
            $response = array(
                'statusAll' => $xproses,
                'status'    => $dataFR->status,
                'waktuEnd'  => $dataFR->waktu_end,
            ); 
        }
        echo json_encode($response);
    }

   
}



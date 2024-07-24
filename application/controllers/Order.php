<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Order extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Madmin');
    }

    public function index()
    {
        if(empty($this->session->userdata('userName'))) {}
        $data['order']=$this->Madmin->get_all_data('tbl_order')->result();
        // $dataWhere = array('idTransaksi' => $this->session->userdata('idTransaksi'));
        // $data['transaksi'] = $this->Madmin->get_by_idd('tbl_transaksi', $dataWhere)->result();
        $this->load->view('home/layout/header');
        $this->load->view('home/order/index', $data);
        $this->load->view('home/layout/footer');
    }

    public function histori()
    {
        $data['order']=$this->Madmin->get_all_data('tbl_order')->result();
        $this->load->view('home/layout/header');
        $this->load->view('home/order/histori', $data);
        $this->load->view('home/layout/footer');
    }



    

    // public function index(){
    //     if(empty($this->session->userdata('userName'))) {
    //         redirect('adminpanel');
    //     }
    //     $data['member']=$this->Madmin->get_all_data('tbl_member')->result();
    //     $this->load->view('admin/layout/header');
    //     $this->load->view('admin/layout/menu');
    //     $this->load->view('admin/member/tampil', $data);
    //     $this->load->view('admin/layout/footer');
    

}


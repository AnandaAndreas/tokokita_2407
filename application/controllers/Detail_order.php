<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Detail_order extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Madmin');
        
    }

    public function index()
    {
        if (empty($this->session->userdata('userName'))) {    
        }

        $data['order'] = $this->Madmin->get_all_data('tbl_order')->result();
        $this->load->view('home/layout/header');
        $this->load->view('home/order/detail_order', $data);
        $this->load->view('home/layout/footer');
    }

public function save()
{
    $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">
    ulasan dikirim!</div>');
    $id = $this->session->userdata('idOrder');
    $ulasan_ranting = $this->input->post('ulasan_ranting');
    if (empty($ulasan_ranting)) {
        $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert"> Deskripsi Harus Diisi! </div>');
        redirect('order/detail_order');
    } else {
        $data_insert = array(
            'idOrder' => $id,
            'ulasan_ranting' => $ulasan_ranting
        );
        $this->Madmin->insert('tbl_detail_order', $data_insert);
        redirect('detail_order');
    }
}

public function kirim()
{
    $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">
    resi dikirim!</div>');
    $id = $this->session->userdata('idOrder');
    $resi_ekpedisi = $this->input->post('resi_ekpedisi');
    if (empty($resi_ekpedisi)) {
        $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert"> Deskripsi Harus Diisi! </div>');
        redirect('order/histori');
    } else {
        $data_insert = array(
            'idOrder' => $id,
            'resi_ekpedisi' => $resi_ekpedisi
        );
        $this->Madmin->insert('tbl_detail_order', $data_insert);
        redirect('order/histori');
    }
}

// public function kirim($idOrder){
//     $this->form_validation->set_rules("resi_ekpedisi","resi","required");
//     $this->form_validation->set_massage("required","%s","wajib diisi");

//     $resi = $this->input->post("resi_akpedisi");
//     $this->Madmin->update_resi($resi,$idOrder);
//     $this->session->set_flashdata('pesan_sukses','resi dikirim');
//     redirect('order/histori');
// }



	}

    // public function ulasan()
    // {
    //     $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">
	// 	Data Baru Berhasil Ditambah!
	//   </div>');
    //     if (empty($this->session->userdata('userName'))) {
    //         redirect('detail_order');
    //     }

    //     $this->form_validation->set_error_delimiters('<span class=error>', '</span>');

    //     $this->form_validation->set_rules(
    //         'ulasan_ranting',
            
    //         'required',
    //         array('required' => '* Nama Kategori harus diisi')
    //     );

    //     if ($this->form_validation->run() == FALSE) {
    //         $this->load->view('admin/layout/header');
    //         $this->load->view('admin/layout/menu');
    //         $this->load->view('admin/order/detail_order');
    //         $this->load->view('admin/layout/footer');
    //         $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">
    //         * Nama Kategori Harus Diisi
    //       </div>');    
    //         redirect('order/detail_order');
    //     } else {
            
    //         $ulasan_ranting = $this->input->post('ulasan_ranting');
    //         $dataUpdate = array('ulasan_ranting' => $ulasan_ranting);
    //         $this->Madmin->update('tbl_order', $dataUpdate, $idOrder);
    //         redirect('order/detail_order');
    //     }

        

    // public function ulasan()
    // {
    //     $data["detail_order"] = $this->Madmin->get_all_data($id_order);
    //     $this->form_validation->set_rules("ulasan_ranting","required");
    //     $this->form_validation->set_massege("required","%s","wajib diisi");

    //     if($this->form_validation->run() == TRUE){
    //         $this->input->post("ulasan_ranting");
    //         $this->Madmin->update('pesan_sukses', 'nomor resi telah dikirim');
    //         $this->sesion->set_flashdata('pesan_sukses', 'nomor resi telah dikirim');
    //         redirect('order/detail_order'.$id_order,'refresh');
    //     }
    // }



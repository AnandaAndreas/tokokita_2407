<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Kategori extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Madmin');
    }

    public function index()
    {
        if (empty($this->session->userdata('userName'))) {
            redirect('adminpanel');
        }
        $data['kategori'] = $this->Madmin->get_all_data('tbl_kategori')->result();
        $this->load->view('admin/layout/header');
        $this->load->view('admin/layout/menu');
        $this->load->view('admin/kategori/tampil', $data);
        $this->load->view('admin/layout/footer');
    }

    public function add()
    {
        if (empty($this->session->userdata('userName'))) {
            redirect('adminpanel');
        }
        $this->load->view('admin/layout/header');
        $this->load->view('admin/layout/menu');
        $this->load->view('admin/kategori/formAdd');
        $this->load->view('admin/layout/footer');
    }

    public function save()
    {
        $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">
		Data Baru Berhasil Ditambah!
	  </div>');
        if (empty($this->session->userdata('userName'))) {
            redirect('adminpanel');
        }

        $this->form_validation->set_error_delimiters('<span class=error>', '</span>');

        $this->form_validation->set_rules(
            'namaKat',
            'namaKat',
            'required',
            array('required' => '* Nama Kategori harus diisi')
        );

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('admin/layout/header');
            $this->load->view('admin/layout/menu');
            $this->load->view('admin/kategori/formAdd');
            $this->load->view('admin/layout/footer');
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">
            * Nama Kategori Harus Diisi
          </div>');
            redirect('kategori/add');
        } else {
            $namaKat = $this->input->post('namaKat');
            $dataInput = array('namaKat' => $namaKat);
            $this->Madmin->insert('tbl_kategori', $dataInput);
            redirect('kategori');
        }
    }

    public function get_by_id($id)
    {
        if (empty($this->session->userdata('userName'))) {
            redirect('adminpanel');
        }
        $dataWhere = array('idKat' => $id);
        $data['kategori'] = $this->Madmin->get_by_id('tbl_kategori', $dataWhere)->row_object();
        $this->load->view('admin/layout/header');
        $this->load->view('admin/layout/menu');
        $this->load->view('admin/kategori/formEdit', $data);
        $this->load->view('admin/layout/footer');
    }

    public function edit()
    {
        if (empty($this->session->userdata('userName'))) {
            redirect('adminpanel');
        }
        $id = $this->input->post('id');
        $namaKategori = $this->input->post('namaKat');
        if (empty($namaKategori)) {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">
            Nama Kategori Harus Diisi!
          </div>');
            redirect('kategori/get_by_id/' . $id);
        } else {
            $dataUpdate = array('namaKat' => $namaKategori);
            $this->Madmin->update('tbl_kategori', $dataUpdate, 'idkat', $id);
            $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">
            Data Berhasil Diperbarui!
          </div>');
            redirect('kategori');
        }
    }

    public function delete($id)
    {
        $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">
		Data Berhasil Dihapus!
	  </div>');
        if (empty($this->session->userdata('userName'))) {
            redirect('adminpanel');
        }
        $this->Madmin->delete('tbl_kategori', 'idkat', $id);
        redirect('kategori');
    }
}
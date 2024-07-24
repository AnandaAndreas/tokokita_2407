<?php
defined('BASEPATH') or exit('No direct script acces allowed');

class Adminpanel extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Madmin');
	}

	public function index()
	{
		$this->load->view('admin/login');
	}

	public function dashboard()
	{
		if (empty($this->session->userdata('userName'))) {
			redirect('adminpanel');
		}
		$this->load->view('admin/layout/header');
		$this->load->view('admin/layout/menu');
		$this->load->view('admin/dashboard');
		$this->load->view('admin/layout/footer');
	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect('adminpanel');
	}

	public function login()
	{
		$u = $this->input->post('username');
		$p = md5($this->input->post('password'));
		if (empty($u) || empty($p)) {
			$this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">
				Username dan Password Harus Diisi!
			  </div>');
			redirect('adminpanel');
		} else {
			$cek = $this->Madmin->get_by_id('tbl_admin', array('userName' => $u))->row_object();
			if ($cek) {

				if ($p == $cek->password) {
					$data_session = array(
						'id' => $cek->idAdmin,
						'userName' => $u,
						'status' => 'login'
					);
					$this->session->set_userdata($data_session);
					redirect('adminpanel/dashboard');
				} else {
					// $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">
					// 	Password Salah!
					// 	</div>');
					redirect('adminpanel');
				}
			} else {
				redirect('adminpanel');
			}
		}
	}

	public function register()
	{
		$this->load->view('admin/register');
	}

	public function save_register()
	{
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		if (empty($username) || empty($password)) {
			$this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">');
			redirect('adminpanel/register');
		}
		$password_enkripsi = password_hash($password, PASSWORD_DEFAULT);
		$this->Madmin->insert('tbl_admin', array('username' => $username, 'password' => $password_enkripsi));
		redirect('adminpanel');
	}

	public function edit(){
		$this->load->view('admin/layout/header');
		$this->load->view('admin/layout/menu');
		$this->load->view('admin/changePassword');
		$this->load->view('admin/layout/footer');
	}

	public function ganti_password()
	{
		$password = $this->input->post('newPassword');
		$password_enkripsi = password_hash($password, PASSWORD_DEFAULT);
		$this->Madmin->update('tbl_admin', array('password' => $password_enkripsi), 'idAdmin', $this->session->userdata('id'));
		redirect('adminpanel/dashboard');
	}
}
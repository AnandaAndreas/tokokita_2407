<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Main extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('Madmin');
		$this->load->library('cart');
		$params = array('server_key' => 'SB-Mid-server-TaHgm6_5bcfKLn8RGzWPMbIV', 'production' => false);
		$this->load->library('midtrans');
		$this->midtrans->config($params);
		$this->load->helper('url');
	}

	public function index()
	{
		$data['produk'] = $this->Madmin->get_produk()->result();
		$data['kategori'] = $this->Madmin->get_all_data('tbl_kategori')->result();
		$this->load->view('home/layout/header', $data);
		$this->load->view('home/layanan');
		$this->load->view('home/home');
		$this->load->view('home/layout/footer');
	}

	public function register()
	{
		$data['kategori'] = $this->Madmin->get_all_data('tbl_kategori')->result();
		$this->load->view('home/layout/header',$data);
		$this->load->view('home/register');

		$this->load->view('home/layout/footer');
	}

	public function save_reg()
	{
		$nama = $this->input->post('nama');
		$email = $this->input->post('email');
		$tlpn = $this->input->post('tlpn');
		$idKota = $this->input->post('city');
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$alamat = $this->input->post('alamat');
		$dataInput = array('username' => $username, 'password' => md5($password), 'idKota'=>$idKota, 'namaKonsumen' => $nama, 'alamat' => $alamat, 'email' => $email, 'tlpn' => $tlpn, 'statusAktif' => 'Y');
		$this->Madmin->insert('tbl_member', $dataInput);
		redirect('main/login');
	}

	public function login()
	{
		$data['kategori'] = $this->Madmin->get_all_data('tbl_kategori')->result();
		$this->load->view('home/layout/header',$data);
		$this->load->view('home/login');
		$this->load->view('home/layout/footer');
	}

	public function login_member()
	{
		$this->load->model('Madmin');
		$u = $this->input->post('username');
		$p = md5($this->input->post('password'));

		$cek = $this->Madmin->get_by_id('tbl_member', array('username' => $u))->row_object();
		$result = $this->Madmin->cek_login_member($u, $p)->row_object();

		if ($result) {
			if ($p == $cek->password) {
				if ($cek->statusAktif == 'Y') {
					$data_session = array(
						'idKonsumen' => $result->idKonsumen,
						'idKotaTujuan' => $result->idKota,
						'Member' => $u,
						'status' => 'login'
					);
					
					$this->session->set_userdata($data_session);
					redirect('main');
				}
			}
		} else {
			redirect('main');
		}
	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect('main');
	}

	public function dashboard()
	{
		$data['kategori'] = $this->Madmin->get_all_data('tbl_kategori')->result();
		$this->load->view('home/layout/header',$data);
		$this->load->view('home/dashboard');
		$this->load->view('home/layout/footer');
	}

	public function edit($id)
	{
		$data['id'] = $id;
		$data['profil'] = $this->Madmin->get_by_id('tbl_member', array('idKonsumen' => $id))->row_object();
		$this->load->view('home/layout/header');
		$this->load->view('home/edit', $data);
		$this->load->view('home/layout/footer');
	}

	public function edit_member()
	{
		$id = $this->input->post('idKonsumen');
		$nama = $this->input->post('nama');
		$email = $this->input->post('email');
		$telpon = $this->input->post('telpon');
		$alamat = $this->input->post('alamat');
		if (empty($nama) || empty($email) || empty($telpon) || empty($alamat)) {
			$this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">
			Data Harus Diisi!
		  </div>');
			redirect('main/edit/' . $id);
		} else {
			$dataInput = array('namaKonsumen' => $nama, 'email' => $email, 'tlpn' => $telpon, 'alamat' => $alamat);
			$this->Madmin->update('tbl_member', $dataInput, 'idKonsumen',$id);
			redirect('main');
		}
	}

	public function detail_produk($idProduk){
		$dataWhere = array('idProduk'=>$idProduk);
		$data['produk'] = $this->Madmin->get_by_id('tbl_produk', $dataWhere)->row_object();
		$data['kategori'] = $this->Madmin->get_all_data('tbl_kategori')->result();
		$this->load->view('home/layout/header', $data);
		$this->load->view('home/detail_produk', $data);
		$this->load->view('home/layout/footer');
	}
	
	public function add_cart($idProduk) {
    $dataWhere = array('idProduk' => $idProduk);
    $produk = $this->Madmin->get_by_id('tbl_produk', $dataWhere)->row_object();
    $kota = $this->Madmin->get_kota_penjual($produk->idToko)->row_object();

    // Set session
    $this->session->set_userdata('idKotaAsal', $kota->idKota);
    $this->session->set_userdata('idTokoPenjual', $produk->idToko);

    $data = array(
        'id'    => $produk->idProduk,
        'qty'   => 1,
        'price' => $produk->harga,
        'name'  => $produk->namaProduk,
        'image' => $produk->foto
    );
    $this->cart->insert($data);
    redirect("main/cart");
}


	public function cart() {
		if (empty($this->session->userdata('idKonsumen'))) {
			echo "<script>alert('Anda harus login dulu untuk add cart');history.back()</script>";
			exit();
		}
	
		// Ambil data dari session
		$data['kota_asal'] = $this->session->userdata('idKotaAsal');
		$data['kota_tujuan'] = $this->session->userdata('idKotaTujuan'); // Pastikan session ini di-set sebelumnya
	
		// Debugging untuk memastikan nilai session
		// echo("<h1>" . $data['kota_asal'] . " kota asal </h1>");
		// echo("<h1>" . $data['kota_tujuan'] . " kota tujuan </h1>");
	
		// Ambil data cart
		$data['cartItems'] = $this->cart->contents();
		$data['kategori'] = $this->Madmin->get_all_data('tbl_kategori')->result();
		$data['total'] = $this->cart->total();
	
		// Load view
		$this->load->view('home/layout/header', $data);
		$this->load->view('home/cart', $data);
		$this->load->view('home/layout/footer');
	}
	

	public function delete_cart($rowid){
		$remove = $this->cart->remove($rowid);
		redirect("main/cart");
	}

	public function getProvince(){
		$curl = curl_init();
		curl_setopt_array($curl, array(
		CURLOPT_URL => "https://api.rajaongkir.com/starter/province",
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => "",
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 30,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => "GET",
		CURLOPT_HTTPHEADER => array(
		"key: b9f3f840654cb79b400b8d9df0a59bcd"
		),
	));
	$response = curl_exec($curl);
		
	$err = curl_error($curl);
		
	curl_close($curl);
	$data = json_decode($response, true);
	echo "<option value=''>Pilih Provinsi</option>";
	for ($i=0; $i < count($data['rajaongkir']['results']); $i++) {
	echo "<option value='".$data['rajaongkir']['results'][$i]['province_id']."'>".$data['rajaongkir'] ['results'][$i]['province']."</option>";
		}
	}

	public function getCity($province) {
		$curl = curl_init();
		curl_setopt_array($curl, array(
			CURLOPT_URL => "http://api.rajaongkir.com/starter/city?province=".$province,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "GET",
			CURLOPT_HTTPHEADER => array(
			"key: b9f3f840654cb79b400b8d9df0a59bcd"
			),
		));
		$response = curl_exec($curl);
		$err = curl_error($curl);
		curl_close($curl);
		$data = json_decode($response, true);
		echo "<option value=''>Pilih Kota</option>";
		for ($i=0; $i < count($data['rajaongkir'] ['results']); $i++) {
		echo "<option value='".$data['rajaongkir']['results'][$i]['city_id']."'>".$data['rajaongkir']['results'][$i]['city_name']."</option>";
		}
	}

	public function proses_transaksi()
	{
		$dataWhere = array('idKonsumen'=>$this->session->userdata('idKonsumen'));
		$member =  $this->Madmin->get_by_id('tbl_member', $dataWhere)->row_object();
		
		$data['kota_asal'] = $this->session->userdata('idKotaAsal');
		$data['kota_tujuan'] = $this->session->userdata('idKotaTujuan');

		$this->load->helper('toko');
		$ongkir = getOngkir($data['kota_asal'],$data['kota_tujuan'],'1000','jne');
		$ongkir_value = $ongkir['rajaongkir']['results'][0]['costs'][0]['cost'][0]['value'];

		$dataInput=array(
			'idKonsumen'=>$member->idKonsumen,
			'idToko'				=>$this->session->userdata('idTokoPenjual'),
			'tglOrder'				=>date("Y-m-d"),
			'statusOrder'			=>"Belum Bayar",
			'kurir'					=>"JNE Oke",
			'ongkir'				=>$ongkir_value,
		);
		$this->Madmin->insert('tbl_order', $dataInput);
		$insert_id = $this->db->insert_id();

		$transaction_details = array(
			'order_id' 				=> $insert_id,
			'gross_amount' 			=> $ongkir_value + $this->cart->total(),
		);

		$item_details = [];
		foreach($this->cart->contents() as $item){
			$item_details[] = array(
				'id' 				=>$item["id"],
				'price' 			=> $item["price"],
				'quantity' 			=> $item["qty"],
				'name' 				=> $item["name"],
			);
		}

		$item_details[] = array(
			'id'					=>"ONGKIR",
			'price' 				=> $ongkir_value,
			'quantity' 				=> 1,
			'name' 					=> "Ongkos Kirimm JNE Oke",
		);

		$billing_address = array(
			'first_name' 			=>$member->namaKonsumen,
			'last_name'				=> "",
			'address'				=> $member->alamat,
			'city'					=> $member->alamat,
			'postal_code'			=>"",
			'phone' 				=> $member->tlpn,
			'quantity'				=> 'IDN',
		);

		$shipping_address = array(
			'first_name' 			=>$member->namaKonsumen,
			'last_name' 			=> "",
			'address' 				=> $member->alamat,
			'city' 					=> $member->alamat,
			'postal_code'			=>"",
			'phone' 				=> $member->tlpn,
			'quantity' 				=> 'IDN',
		);

		$customer_details = array(
			'first_name' 			=>$member->namaKonsumen,
			'last_name' 			=> "",
			'email' 				=> $member->email,
			'phone' 				=> $member->tlpn,
			'billing_address' 		=>$billing_address,
			'shipping_address'		=> $shipping_address,
		);

		$credit_card['secure'] = true;

		$time = time();
		$custom_expiry = array(
			'start_time' 			=>date("Y-m-d H:i:s O", $time),
			'unit' 					=> 'hour',
			'duration' 				=> 2,
		);

		$transaction_data = array(
			'transaction_details'	=> $transaction_details,
			'item_details' 			=> $item_details,
			'customer_details' 		=> $customer_details,
			'credit_card' 			=> $credit_card,
			'expiry'			 	=> $custom_expiry,
		);

		error_log(json_encode($transaction_data));
		$snapToken = $this->midtrans->getSnapToken($transaction_data);
		error_log($snapToken);
		echo $snapToken;
	}
	public function finish()
    {
		$result = json_decode($this->input->post('result_data'));
		if($result->transaction_status=="settlement"){
			$id = $result->order_id;
			$dataUpdate = array('statusOrder'=>'Lunas');
			$this->Madmin->update('tbl_order', $dataUpdate, 'idOrder', $id);
			 
			redirect('/');
		}
    }

	// public function ulasan()
    // {
    //     $this->form_validation->set_rules("ulasan_ranting","required");
    //     $this->form_validation->set_massege("required","%s","wajib diisi");

    //     if($this->form_validation->run() == TRUE){
	// 		$idOrder = array('ulasan_ranting');
    //         $this->input->post("ulasan_ranting");
    //         $this->Madmin->update('idOrder',$idOrder);
    //         $this->sesion->set_flashdata('pesan_sukses', 'nomor resi telah dikirim');
    //         redirect('order/detail_order');
    //     }
    // }

	
	
}

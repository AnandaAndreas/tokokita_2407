<?php

class Madmin extends CI_Model{
	
	public function cek_login($u, $p){
		$q = $this->db->get_where('tbl_admin', array('userName'=>$u, 'password'=>$p));
		return $q;
	}

	public function get_all_data($tabel){
		$q=$this->db->get($tabel);
		return $q;
	}

	public function get_produk(){
		$this->db->select('*');
		$this->db->from('tbl_produk');
		$this->db->join('tbl_toko', 'tbl_toko.idToko = tbl_produk.idToko');
		$this->db->join('tbl_member', 'tbl_member.idKonsumen = tbl_toko.idKonsumen');
		$q = $this->db->get();
		return $q;

	}

	public function insert($tabel, $data){
		$this->db->insert($tabel, $data);
	}

	public function get_by_id($tabel, $id){
		return $this->db->get_where($tabel, $id);
	}

	public function update($tabel, $data, $pk, $id){
		$this->db->where($pk, $id);
		$this->db->update($tabel, $data);
	}
	
		public function update2($table, $data_update, $set) {
			$this->db->where($data_update);
			$this->db->set($set);
			$this->db->update($table);
		}
	
	

	public function delete($tabel, $id, $val){
		$this->db->delete($tabel, array($id => $val)); 
	}

	public function cek_login_member($u, $p){
		$q = $this->db->get_where('tbl_member', array('username'=>$u, 'password'=>$p, 'statusAktif'=>'Y'));
		return $q;
	}	

	public function get_kota_penjual($idToko){
		$this->db->select('tbl_member.idKota'); // Pastikan hanya memilih kolom yang diperlukan
    $this->db->from('tbl_toko');
    $this->db->join('tbl_member', 'tbl_member.idKonsumen = tbl_toko.idKonsumen');
    $this->db->where('tbl_toko.idToko', $idToko);
    $q = $this->db->get();
    return $q;
	}

	


	

	
}


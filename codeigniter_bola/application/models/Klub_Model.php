<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Klub_Model extends CI_Model {

		public function __construct()
		{
			parent::__construct();
			//Do your magic here
		}	

		public function getDataKlub()
		{
			$query=$this->db->query("select * from klub");
			return $query->result_array();
		}
		public function getDataIdKlub($idKlub)
		{
			$query=$this->db->query("select * from klub where id='$idKlub'");
			return $query->result_array();
		}

		public function getPemainByKlub($idKlub)
		{	
			$sql="select A.nama as namaKlub,B.* from klub as A join pemain as B on A.id = B.fk_klub where A.id=$idKlub";
			$query=$this->db->query($sql);
			return $query->result_array();
		}
		
		public function addData()
		{
			$object = array('nama' => $this->input->post('nama'),
							'logo' => $this->upload->data('file_name')
							);
			$this->db->insert('klub', $object);
		}

		public function addDataPemain($idKlub)
		{
			$object = array('nama' => $this->input->post('nama'),
							'posisi' => $this->input->post('posisi'),
							'tanggal_lahir' => $this->input->post('tanggal_lahir'),
							'fk_klub' => $idKlub
							);
			$this->db->insert('pemain', $object);
		}

		public function editData($idKlub)
		{
			$object = array('nama' => $this->input->post('nama'),
							'logo' => $this->upload->data('file_name'));
			$this->db->where('id', $idKlub);
			$this->db->update('klub', $object);
		}
		public function deleteData($idKlub)
		{
			$this->db->query("delete from klub where id = '$idKlub'");
		}

}



 ?>
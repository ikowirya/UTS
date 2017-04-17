<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pemain extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('klub_model');
	}
	public function index($idKlub)
	{
		$data['data_klub']=$this->klub_model->getPemainByKlub($idKlub);
		$this->load->view('pemain',$data);	
	}
	public function addDataPemain($idKlub) 
	{
		$this->load->helper('url','form');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('nama', 'Nama', 'trim|required');
		$this->form_validation->set_rules('posisi', 'posisi', 'trim|required');
		$this->form_validation->set_rules('tanggal_lahir', 'tanggal_lahir', 'trim|required');
		if($this->form_validation->run()==FALSE){

			$this->load->view('pemain_addDataPemain');

		}
		else
		{
				$this->klub_model->addDataPemain($idKlub);
				redirect('pemain/index/'.$this->uri->segment(3));
		}
	}

	public function deleteValidation($idPemain)
	{
		$data['data_pemain']=$this->klub_model->getDataIdKlub($idPemain);
		$this->load->view('pemain_deleteData',$data);
	}

	public function delete($idPemain,$val)
	{
		if ($val==0)
		{
			header("location:".site_url());
		}
		else 
		{
			$this->klub_model->deleteData($idPemain);
			header("location:".site_url());
		}
	}
}

/* End of file Jabatan.php */
/* Location: ./application/controllers/Jabatan.php */

 ?>
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Klub extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('klub_model');
	}
	public function index()
	{
		$data['data_klub']=$this->klub_model->getDataKlub();
		$this->load->view('klub',$data);	
	}
	public function addData() 
	{
		$this->load->helper('url','form');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('nama', 'Nama', 'trim|required');
		if($this->form_validation->run()==FALSE){

			$this->load->view('klub_addData');

		}
		else{

			$config['upload_path']          = './assets/uploads/';
            $config['allowed_types']        = 'gif|jpg|png';
            $config['max_size']             = 1000000000;
            $config['max_width']            = 10240;
            $config['max_height']           = 7680;

			$this->load->library('upload', $config);

			if ( ! $this->upload->do_upload('userfile'))
                {
                        $error['data'] = "eror";
						$this->load->view('klub_addData',$error);
                }
                else
                {
						$this->klub_model->addData();
						header("location:index");
				}
		}
	}
	public function edit($idKlub) 
	{
		$this->load->helper('url','form');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('nama', 'Nama', 'trim|required');
		if($this->form_validation->run()==FALSE){

			$data['data_klub']=$this->klub_model->getDataIdKlub($idKlub);
			$this->load->view('klub_editData',$data);

		}
		else{

			$config['upload_path']          = './assets/uploads/';
            $config['allowed_types']        = 'gif|jpg|png';
            $config['max_size']             = 1000000000;
            $config['max_width']            = 10240;
            $config['max_height']           = 7680;

			$this->load->library('upload', $config);

			if ( ! $this->upload->do_upload('userfile'))
                {
                        $error['data'] = "eror";
						$this->load->view('klub_editData/$idKlub',$error);
                }
                else
                {
						$this->klub_model->editData($idKlub);
						header("location:".site_url());
				}
		}
	}
	public function deleteValidation($idKlub)
	{
		$data['data_klub']=$this->klub_model->getDataIdKlub($idKlub);
		$this->load->view('klub_deleteData',$data);
	}

	public function delete($idKlub,$val)
	{
		if ($val==0)
		{
			header("location:".site_url());
		}
		else 
		{
			$this->klub_model->deleteData($idKlub);
			header("location:".site_url());
		}
	}
}

/* End of file Pegawai.php */
/* Location: ./application/controllers/Pegawai.php */

 ?>
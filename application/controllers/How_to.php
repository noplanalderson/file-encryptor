<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class How_to extends CI_Controller {

	public function index()
	{
		$this->load->view('head');
		$this->load->view('navbar');
		$this->load->view('howto');
		$this->load->view('footer');
	}

}

/* End of file how_to.php */
/* Location: ./application/controllers/how_to.php */
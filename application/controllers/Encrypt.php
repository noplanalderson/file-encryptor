<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Encrypt extends CI_Controller {

	public function index()
	{
		$data['msg'] = '';

		if(isset($_POST['upload'])) 
		{
			$key = $this->input->post('key', TRUE);

			$config = [
				'upload_path' 		=> UPLOAD_PATH,
				'allowed_types' 	=> 'png|jpg|jpeg|gif|docx|doc|xls|xlsx|ppt|pptx|csv|odt|txt|pdf',
				'max_size'  		=> '8192',
				'detect_mime' 		=> true,
				'file_ext_tolower'	=> true,
				'remove_spaces'		=> true
			];
			
			$this->load->library('upload');
			$this->upload->initialize($config);

			if ( ! $this->upload->do_upload('file'))
			{
				$data = array('msg' => '<div class="alert alert-danger" role="alert">'.$this->upload->display_errors().'</div>');
			}
			else
			{
				$file = $this->upload->data();

				@copy($file['full_path'], $file['file_path'].$file['raw_name']);

				$encryptCfg = array(
					'key' => $key,
					'src_file' => $file['file_path'] . DIRECTORY_SEPARATOR . $file['raw_name'],
					'file_name' => $file['file_name'],
					'real_ext' => $file['file_ext']
				);
				$this->load->library('file_encryptor', $encryptCfg);

				if($this->file_encryptor->encrypt()) {

					$data['msg'] = '<div class="alert alert-success" role="alert">'.$this->file_encryptor->show_result().'</div>';
					$this->session->set_flashdata('msg', $data['msg']);

					$contents = file_get_contents($this->file_encryptor->result());
					force_download($file['file_name'].'.naim', $contents);
				}
				else
				{
					$data['msg'] = '<div class="alert alert-danger" role="alert">'.$this->file_encryptor->show_result().'</div>';
				}
			}
		}

		array_map('unlink', glob(UPLOAD_PATH."*.*"));
		
		$this->load->view('head');
		$this->load->view('navbar');
		$this->load->view('home', $data);
		$this->load->view('footer');
	}
}

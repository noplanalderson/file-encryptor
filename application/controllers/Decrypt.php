<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Decrypt extends CI_Controller {

	public function index()
	{
		$data['msg'] = '';

		if(isset($_POST['upload'])) 
		{
			$key = $this->input->post('key', TRUE);

			$ext = explode('.', $_FILES['file']['name']);
			$naimExt = end($ext);

			if($naimExt === 'naim')
			{
				$config = [
					'upload_path' 		=> UPLOAD_PATH,
					'allowed_types' 	=> '*',
					'max_size'  		=> '8192',
					'detect_mime' 		=> false,
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
					$decryptCfg = array(
						'key' => $key,
						'src_file' => $file['file_path'] . DIRECTORY_SEPARATOR . $file['raw_name'],
						'file_name' => $file['file_name'],
						'real_ext' => $file['file_ext']
					);
					$this->load->library('file_decryptor', $decryptCfg);

					$this->file_decryptor->decrypt();
						$contents = file_get_contents($this->file_decryptor->result());
						force_download($file['raw_name'], $contents);
					
					$data['msg'] = '<div class="alert alert-info" role="alert">'.$this->file_decryptor->show_result().'</div>';
				}
			}
			else
			{
				$data['msg'] = '<div class="alert alert-danger" role="alert">File extension must *.naim '.$_FILES['file']['name'].'</div>';
			}
		}

		$this->session->set_flashdata('msg', $data['msg']);
		array_map('unlink', glob(UPLOAD_PATH."*.*"));
		
		$this->load->view('head');
		$this->load->view('navbar');
		$this->load->view('decrypt', $data);
		$this->load->view('footer');
	}
}

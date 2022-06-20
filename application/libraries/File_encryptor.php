<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * File Encryptor Class
 *
 * For encrypting file with PHP OpenSSL extensions (AES-128-CBC)
 *
 * @package		File Encryptor
 * @subpackage	Libraries
 * @category	Libraries
 * @author		Muhammad Ridwan Na'im
 * @link		https://muhammadridwannaim.epizy.com
*/
class File_encryptor
{
	/**
	 * Public Key Variable from Form Input
	 *
	 * @var $key string
	 **/
	private $key = '';

	/**
	 * Source File to Encrypt (Raw)
	 *
	 * @var $src_file string
	 **/
	private $src_file = '';

	/**
	 * Filename to Encrypt
	 *
	 * @var $file_name string
	 **/
	private $file_name = '';

	/**
	 * Extension of real file
	 *
	 * @var $enc_ext string
	 **/
	private $real_ext = '';

	/**
	 * Extension of encrypted file
	 *
	 * @var $enc_ext string
	 **/
	private $enc_ext = 'naim';

	/**
	 * Result Message
	 *
	 * @var $msg_result array
	 **/
	private $msg_result = [];

	/**
	 * CI Instance
	 * @var object
	*/
	protected $_CI;

	/**
	 * Constructor
	 *
	 * @param	array	$config
	 * @return	void
	 */
	public function __construct($config = array())
	{
		empty($config) OR $this->initialize($config, FALSE);
		$this->_CI =& get_instance();

		log_message('info', 'File Encryptor Class Initialized');
	}

	// --------------------------------------------------------------------

	/**
	 * Initialize preferences
	 *
	 * @param	array	$config
	 * @param	bool	$reset
	 * @return	Secure_upload
	 */
	public function initialize(array $config = array(), $reset = TRUE)
	{
		$reflection = new ReflectionClass($this);

		if ($reset === TRUE)
		{
			$defaults = $reflection->getDefaultProperties();
			foreach (array_keys($defaults) as $key)
			{
				if ($key[0] === '_')
				{
					continue;
				}

				if (isset($config[$key]))
				{
					if ($reflection->hasMethod('set_'.$key))
					{
						$this->{'set_'.$key}($config[$key]);
					}
					else
					{
						$this->$key = $config[$key];
					}
				}
				else
				{
					$this->$key = $defaults[$key];
				}
			}
		}
		else
		{
			foreach ($config as $key => &$value)
			{
				if ($key[0] !== '_' && $reflection->hasProperty($key))
				{
					if ($reflection->hasMethod('set_'.$key))
					{
						$this->{'set_'.$key}($value);
					}
					else
					{
						$this->$key = $value;
					}
				}
			}
		}

		return $this;
	}

	/**
	 * Encrypt the file and saves the result in a new file with $enc_ext as suffix.
	 * @return true|void  Returns true if success, void if failed
	 * 
	*/
    public function encrypt()
    {
    	$key 	= substr(sha1($this->key, true), 0, 16);
    	$iv 	= openssl_random_pseudo_bytes(16);

	    if ($ct_encrypted_file = fopen($this->src_file.$this->real_ext.'.'.$this->enc_ext, 'w'))
	    {    
	        fwrite($ct_encrypted_file, $iv);
	        if ($wt_encrypted_content = fopen($this->src_file, 'rb')) 
	        {
	            while (!feof($wt_encrypted_content)) 
	            {
	                $plaintext = fread($wt_encrypted_content, 16 * FILE_ENCRYPTION_BLOCKS);
	                $ciphertext = openssl_encrypt($plaintext, 'AES-128-CBC', $key, OPENSSL_RAW_DATA, $iv);

	                // Use the first 16 bytes of the ciphertext as the next initialization vector
	                $iv = substr($ciphertext, 0, 16);
	                fwrite($ct_encrypted_file, $ciphertext);
	            }
	            fclose($wt_encrypted_content);

	            @unlink($this->src_file.$this->real_ext);
	            @unlink($this->src_file);

	            $this->msg_result[] = 'File Encrypted with Key : '.$this->key;
	            // $this->msg_result[] = 'Download Your File <a href="'.base_url('_/uploads/'.$this->file_name.'.'.$this->enc_ext).'">here</a>';
	            return true;

	        } 
	        else 
	        {
	            $this->msg_result[] = 'Failed to Open Source File. '.$this->file_name;
	        }
	        fclose($ct_encrypted_file);
	    } 
	    else 
	    {
	        $this->msg_result[] = 'Failed to Create Encrypted File.';
	    }
    }

    /**
     * Get Encrypted File
     * @return string [full path of encrypted file]
     * 
    */
    public function result()
    {
    	return $this->src_file.$this->real_ext.'.'.$this->enc_ext;
    }

    /**
     * Display Message
     * @return string [message list]
     * 
    */
    public function show_result()
    {
    	return implode('<br/>', $this->msg_result);
    }
}

/* End of file file_encryptor.php */
/* Location: ./application/libraries/file_encryptor.php */

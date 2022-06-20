<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class File_decryptor
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

	private $decrypted_file;

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

	protected $ci;

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
	 * Encrypt the file and saves the result in a new file with $_ext_enc as suffix.
	 * 
	 * @return string|false  Returns the file name that has been created or FALSE if an error occured
	 * 
	 **/
    public function decrypt()
    {
    	$key = substr(sha1($this->key, true), 0, 16);
    	$this->decrypted_file = $this->src_file;

	    if ($fpOut = fopen($this->src_file, 'w')) 
	    {
	        if ($fpIn = fopen($this->src_file.'.'.$this->enc_ext, 'rb')) 
	        {
	            // Get the initialzation vector from the beginning of the file
	            $iv = fread($fpIn, 16);
	            while (!feof($fpIn)) 
	            {
	            	// we have to read one block more for decrypting than for encrypting
	                $ciphertext = fread($fpIn, 16 * (FILE_ENCRYPTION_BLOCKS + 1));
	                $plaintext = openssl_decrypt($ciphertext, 'AES-128-CBC', $key, OPENSSL_RAW_DATA, $iv);

	                // Use the first 16 bytes of the ciphertext as the next initialization vector
	                $iv = substr($ciphertext, 0, 16);
	                fwrite($fpOut, $plaintext);
	            }
	            fclose($fpIn);

	            @unlink($this->src_file.'.'.$this->enc_ext);
	            $this->msg_result[] = 'File Decrypted with Key : '.$this->key;
	            return true;
	        } 
	        else
	        {
            	$this->_msg_result[] = 'Failed to Open Encrypted File.';
        	}
	    } 
	    else 
	    {
	        $this->_msg_result[] = 'Failed to Create Decrypting file.';
	    }
    }

    public function result()
    {
    	return $this->decrypted_file;
    }

    public function show_result()
    {
    	return implode('<br/>', $this->msg_result);
    }
}
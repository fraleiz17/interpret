<?php
if(!defined('BASEPATH'))
	die();

class Email_model extends CI_Model{
	
	function __construct(){
		parent::__construct();
		$this->load->library('email');
	}
	
	function send_email($from = null, $to, $asunto, $mensaje,$file = null){
		// sleep(1);
		$config = array(
			// 'protocol'  => 'smtp',
			// 'smtp_host' => '127.0.0.1',
			// 'smtp_port' => 25,
			// 'smtp_user' => 'postmaster@127.0.0.1',
			// 'smtp_pass' => '123456',
			'mailtype'  => 'html',
			'crlf'		=> "\r\n",
			'newline'    => "\r\n" 
		);
		$this->email->initialize($config);
		if($from!=null){
			$this->email->from($from);
		}
		else{
			$this->email->from("noresponder@quierounperro.com.mx", "Quiero un perro");
		}

		

		$this->email->to($to);
		$this->email->subject($asunto);
		$this->email->message($mensaje);
		
		if($file != null){
		$this->email->attach($file);
		}

		if($this->email->send())
    	{
        return true;
    	} else  {
        return false;
    	}
	}
	
}

?>
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
			 'protocol' => 'smtp',
  			 'smtp_host' => 'ssl://gator1732.hostgator.com',
  			'smtp_port' => 465,
  			'smtp_user' => 'prueba@talentoindustrial.com', // change it to yours
  			'smtp_pass' => 'Prueba21!', // change it to yours
			'mailtype'  => 'html',
			'crlf'		=> "\r\n",
			'newline'    => "\r\n" 
		);
		$this->email->initialize($config);
		if($from!=null){
			$this->email->from($from);
		}
		else{
			$this->email->from("prueba@talentoindustrial.com", "interpretes");
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
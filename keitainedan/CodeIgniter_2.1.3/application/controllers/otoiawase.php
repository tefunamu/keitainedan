<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Otoiawase extends CI_Controller {

function __construct() {
parent::__construct();
}


public function index()
	{
		$this->load->helper('url'); 
		$data['page_title'] = 'モバイル料金ラボ';
		
        $this->load->view('header',$data);
        $this->load->view('otoiawase',$data);
        //$this->load->view('footer',$data);

	}
	
}
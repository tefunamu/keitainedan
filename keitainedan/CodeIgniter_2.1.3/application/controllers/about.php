<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class About extends CI_Controller {

function __construct() {
parent::__construct();
}


public function index()
	{
		$this->load->helper('url'); 
		$data['page_title'] = 'モバイル料金ラボ';
		
        $this->load->view('header',$data);
        $this->load->view('about',$data);
        //$this->load->view('footer',$data);

	}

public function saito()
	{
		$this->load->helper('url'); 
		$data['page_title'] = 'モバイル料金ラボ';
		
        $this->load->view('header',$data);
        $this->load->view('saito',$data);
        //$this->load->view('footer',$data);

	}

public function link()
	{
		$this->load->helper('url'); 
		$data['page_title'] = 'モバイル料金ラボ';
		
        $this->load->view('header',$data);
        $this->load->view('link',$data);
        //$this->load->view('footer',$data);

	}
	
public function kankyou()
	{
		$this->load->helper('url'); 
		$data['page_title'] = 'モバイル料金ラボ';
		
        $this->load->view('header',$data);
        $this->load->view('kankyou',$data);
        //$this->load->view('footer',$data);

	}
	
public function menseki()
	{
		$this->load->helper('url'); 
		$data['page_title'] = 'モバイル料金ラボ';
		
        $this->load->view('header',$data);
        $this->load->view('menseki',$data);
        //$this->load->view('footer',$data);

	}

}
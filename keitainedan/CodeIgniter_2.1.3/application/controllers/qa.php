<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Qa extends CI_Controller {

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

public function doc_adult()
	{
		$this->load->helper('url'); 
		$data['page_title'] = 'モバイル料金ラボ';
		
        $this->load->view('header',$data);
        $this->load->view('doc_adult',$data);
        //$this->load->view('footer',$data);

	}

public function doc_young()
	{
		$this->load->helper('url'); 
		$data['page_title'] = 'モバイル料金ラボ';
		
        $this->load->view('header',$data);
        $this->load->view('doc_young',$data);
        //$this->load->view('footer',$data);

	}
	
public function fee()
	{
		$this->load->helper('url'); 
		$data['page_title'] = 'モバイル料金ラボ';
		
        $this->load->view('header',$data);
        $this->load->view('fee',$data);
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


public function index()
	{
		$this->load->helper('url'); 
		$data['page_title'] = 'モバイル料金ラボ';
		
        $this->load->view('header',$data);
        $this->load->view('index',$data);
        //$this->load->view('footer',$data);

	}
	
}
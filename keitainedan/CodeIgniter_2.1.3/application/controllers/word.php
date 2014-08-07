<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Word extends CI_Controller {

function __construct() {
parent::__construct();
}


public function index()
	{
		$this->load->helper('url'); 
		$data['page_title'] = 'モバイル料金ラボ';
		
        $this->load->view('header',$data);
        $this->load->view('word',$data);
        //$this->load->view('footer',$data);

	}

public function two_nen()
	{
		$this->load->helper('url'); 
		$data['page_title'] = 'モバイル料金ラボ';
		
        $this->load->view('header',$data);
        $this->load->view('two_nen',$data);
        //$this->load->view('footer',$data);

	}

public function mnp()
	{
		$this->load->helper('url'); 
		$data['page_title'] = 'モバイル料金ラボ';
		
        $this->load->view('header',$data);
        $this->load->view('mnp',$data);
        //$this->load->view('footer',$data);

	}
	
public function sumaho()
	{
		$this->load->helper('url'); 
		$data['page_title'] = 'モバイル料金ラボ';
		
        $this->load->view('header',$data);
        $this->load->view('sumaho',$data);
        //$this->load->view('footer',$data);

	}
	
public function iphone()
	{
		$this->load->helper('url'); 
		$data['page_title'] = 'モバイル料金ラボ';
		
        $this->load->view('header',$data);
        $this->load->view('iphone',$data);
        //$this->load->view('footer',$data);

	}

public function android()
	{
		$this->load->helper('url'); 
		$data['page_title'] = 'モバイル料金ラボ';
		
        $this->load->view('header',$data);
        $this->load->view('android',$data);
        //$this->load->view('footer',$data);

	}
	
public function garake()
	{
		$this->load->helper('url'); 
		$data['page_title'] = 'モバイル料金ラボ';
		
        $this->load->view('header',$data);
        $this->load->view('garake',$data);
        //$this->load->view('footer',$data);

	}


}
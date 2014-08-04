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
        $this->load->view('qa',$data);
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
		
public function plan()
	{
		$this->load->helper('url'); 
		$data['page_title'] = 'モバイル料金ラボ';
		
        $this->load->view('header',$data);
        $this->load->view('plan',$data);
        //$this->load->view('footer',$data);

	}
	
public function docomo()
	{
		$this->load->helper('url'); 
		$data['page_title'] = 'モバイル料金ラボ';
		
        $this->load->view('header',$data);
        $this->load->view('docomo',$data);
        //$this->load->view('footer',$data);

	}
	
public function au()
	{
		$this->load->helper('url'); 
		$data['page_title'] = 'モバイル料金ラボ';
		
        $this->load->view('header',$data);
        $this->load->view('au',$data);
        //$this->load->view('footer',$data);

	}
	
public function softbank()
	{
		$this->load->helper('url'); 
		$data['page_title'] = 'モバイル料金ラボ';
		
        $this->load->view('header',$data);
        $this->load->view('softbank',$data);
        //$this->load->view('footer',$data);

	}

}
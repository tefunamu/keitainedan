<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->load->helper('url');
		$data['page_title'] = 'モバイル料金ラボ';
		
        $this->load->view('header',$data);
        $this->load->view('top');
        $this->load->view('footer',$data);
        
	}

	public function demo()
	{
		$this->load->helper('url');
		$data['page_title'] = 'モバイル料金ラボ';

        $this->load->view('header',$data);
        $this->load->view('demo',$data);
        $this->load->view('footer',$data);
        
	}
	
	public function demo2()
	{
		$this->load->helper('url'); 
		$data['page_title'] = 'モバイル料金ラボ';
		
		session_start();
		$_SESSION['kyaria']=$_REQUEST['kyaria'];

        $this->load->view('header',$data);
        $this->load->view('demo2',$data);
        $this->load->view('footer',$data);
        
	}

		public function demo3()
	{
		$data['page_title'] = 'モバイル料金ラボ';
		$this->load->helper('url'); 
		
		$d=0;
		$a=0;
		$s=0;
		
		session_start();
		
		$_SESSION['tushinryo']=$_REQUEST['tushinryo'];
		switch($_SESSION['kyaria']){
			case "docomo":
				$a=-980;
				$s-=980;
				switch($_SESSION['tushinryo']){
					case"less":
						$d+=5985;
						$a+=5985;
						$s+=5985;
						break;
					case"more":
						break;
				}
			case "au":
				break;
			case "softbank":
				break;
		}
		
		$data['docomo']=$d;
		$data['au']=$a;
		$data['softbank']=$s;
		
        $this->load->view('header',$data);
        $this->load->view('demo3',$data);
        $this->load->view('footer',$data);
        
	}

		public function book()
	{
		$this->load->helper('file');

		$data['page_title'] = 'モバイル料金ラボ';
		$this->load->helper('url');

        $this->load->view('header',$data);
        $this->load->view('book');
        $this->load->view('footer',$data);
        
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
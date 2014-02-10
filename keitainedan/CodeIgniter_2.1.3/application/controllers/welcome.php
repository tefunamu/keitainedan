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
		$this->load->helper('url'); 
		$data['page_title'] = 'モバイル料金ラボ';

		session_start();
		$_SESSION['tushinryo']=$_REQUEST['tushinryo'];
		
        $this->load->view('header',$data);
        $this->load->view('demo3',$data);
        $this->load->view('footer',$data);
        
	}
	
	public function demo4()
	{
		$this->load->helper('url');
		$data['page_title'] = 'モバイル料金ラボ';
		
		session_start();
		$_SESSION['kaisen']=$_REQUEST['kaisen'];
		
		$this->load->view('header',$data);
		$this->load->view('demo4',$data);
		$this->load->view('footer',$data);
		
	}

	public function demoX()
	{
		$this->load->helper('url'); 
		$data['page_title'] = 'モバイル料金ラボ';
		
		$docomo_ryokin=743+5700+300;#もっとも一般的な料金を表示、他も一緒
		$au_ryokin=934+5700+300;
		$softbank_ryokin=934+5700+300;
		
		#ソフバンに下取りあり。組み込まれてない。
		#auにも下取りあり。組み込まれていない。
		
		switch($_SESSION['kisyu']){
			case "iphone":
				$docomo_ryoukin-=500;
				$au_ryoukin-=500;
				$softbank_ryoukin-=500;
				
				switch($_SESSION['kyaria']){
					case "docomo":
						$au_ryoukin=-934;
						$softbank_ryoukin-=934;
						
						switch($_SESSION['kaisen_tv']){
							case "au_kaisen":
								$au_ryoukin-=910;
								if ($_SESSION['packet'] < 114000){
									$docomo_ryoukin-=1000;
									$softbank_ryoukin+=0.05*$packet-5700;
										$tuuwaryoukin = $_SESSION['tuuwazikan']*40;
										$docomo_ryoukin+=$tuuwaryoukin;
										$au_ryoukin+=$tuuwaryoukin;
										$softbank_ryoukin+=$tuuwaryoukin;
									
								}elseif ($_SESSION['packet'] < 25165824){
									$docomo_ryoukin-=1000;
										$tuuwaryoukin = $_SESSION['tuuwazikan']*40;
										$docomo_ryoukin+=$tuuwaryoukin;
										$au_ryoukin+=$tuuwaryoukin;
										$softbank_ryoukin+=$tuuwaryoukin;
									
								} else {
									$tuuwaryoukin = $_SESSION['tuuwazikan']*40;
									$docomo_ryoukin+=$tuuwaryoukin;
									$au_ryoukin+=$tuuwaryoukin;
									$softbank_ryoukin+=$tuuwaryoukin;
								}
								break;
								
							case "softbank_kaisen":
								$s-=934;
								if ($_SESSION['packet'] < 114000){
									$docomo_ryoukin-=1000;
									$softbank_ryoukin+=0.05*$packet-5700;
										$tuuwaryoukin = $_SESSION['tuuwazikan']*40;
										$docomo_ryoukin+=$tuuwaryoukin;
										$au_ryoukin+=$tuuwaryoukin;
										$softbank_ryoukin+=$tuuwaryoukin;
									
								}elseif ($_SESSION['packet'] < 25165824){
									$docomo_ryoukin-=1000;
										$tuuwaryoukin = $_SESSION['tuuwazikan']*40;
										$docomo_ryoukin+=$tuuwaryoukin;
										$au_ryoukin+=$tuuwaryoukin;
										$softbank_ryoukin+=$tuuwaryoukin;
								
								} else {
									$tuuwaryoukin = $_SESSION['tuuwazikan']*40;
									$docomo_ryoukin+=$tuuwaryoukin;
									$au_ryoukin+=$tuuwaryoukin;
									$softbank_ryoukin+=$tuuwaryoukin;
								}
								break;
								
							default:
								switch($_SESSION['ruta']){
									case "au_ruta":#これは2年間。2014/8/31まで
										au_ryouin-=934;
										if ($_SESSION['packet'] < 114000){
											$docomo_ryoukin-=1000;
											$softbank_ryoukin+=0.05*$packet-5700;
												$tuuwaryoukin = $_SESSION['tuuwazikan']*40;
												$docomo_ryoukin+=$tuuwaryoukin;
												$au_ryoukin+=$tuuwaryoukin;
												$softbank_ryoukin+=$tuuwaryoukin;
											
										}elseif ($_SESSION['packet'] < 25165824){
											$docomo_ryoukin-=1000;
												$tuuwaryoukin = $_SESSION['tuuwazikan']*40;
												$docomo_ryoukin+=$tuuwaryoukin;
												$au_ryoukin+=$tuuwaryoukin;
												$softbank_ryoukin+=$tuuwaryoukin;
								
										} else {
											$tuuwaryoukin = $_SESSION['tuuwazikan']*40;
											$docomo_ryoukin+=$tuuwaryoukin;
											$au_ryoukin+=$tuuwaryoukin;
											$softbank_ryoukin+=$tuuwaryoukin;
										}
										break;
									
									case"softbank_ruta":
									softbank_ryoukin-=934;
										if ($_SESSION['packet'] < 114000){
											$docomo_ryoukin-=1000;
											$softbank_ryoukin+=0.05*$packet-5700;
												$tuuwaryoukin = $_SESSION['tuuwazikan']*40;
												$docomo_ryoukin+=$tuuwaryoukin;
												$au_ryoukin+=$tuuwaryoukin;
												$softbank_ryoukin+=$tuuwaryoukin;
											
										}elseif ($_SESSION['packet'] < 25165824){
											$docomo_ryoukin-=1000;
												$tuuwaryoukin = $_SESSION['tuuwazikan']*40;
												$docomo_ryoukin+=$tuuwaryoukin;
												$au_ryoukin+=$tuuwaryoukin;
												$softbank_ryoukin+=$tuuwaryoukin;
								
										} else {
											$tuuwaryoukin = $_SESSION['tuuwazikan']*40;
											$docomo_ryoukin+=$tuuwaryoukin;
											$au_ryoukin+=$tuuwaryoukin;
											$softbank_ryoukin+=$tuuwaryoukin;
										}
										break;
										
									default:
										if ($_SESSION['packet'] < 114000){
											$docomo_ryoukin-=1000;
											$softbank_ryoukin+=0.05*$packet-5700;
												$tuuwaryoukin = $_SESSION['tuuwazikan']*40;
												$docomo_ryoukin+=$tuuwaryoukin;
												$au_ryoukin+=$tuuwaryoukin;
												$softbank_ryoukin+=$tuuwaryoukin;
											
										}elseif ($_SESSION['packet'] < 25165824){
											$docomo_ryoukin-=1000;
												$tuuwaryoukin = $_SESSION['tuuwazikan']*40;
												$docomo_ryoukin+=$tuuwaryoukin;
												$au_ryoukin+=$tuuwaryoukin;
												$softbank_ryoukin+=$tuuwaryoukin;
											
										} else {
											$tuuwaryoukin = $_SESSION['tuuwazikan']*40;
											$docomo_ryoukin+=$tuuwaryoukin;
											$au_ryoukin+=$tuuwaryoukin;
											$softbank_ryoukin+=$tuuwaryoukin;
										}
										break;#ルータに対する
								}
							break;#kaisenに対する
							}
						break;#キャリアに対する
						
					case "au":
						$docomo_ryoukin-=743;
						$softbank_ryoukin-=934;
						
						switch($_SESSION['kaisen_tv']){
							case "au_kaisen":
								$au_ryoukin-=910;
								if ($_SESSION['packet'] < 114000){
									$docomo_ryoukin-=1000;
									$softbank_ryoukin+=0.05*$packet-5700;
										$tuuwaryoukin = $_SESSION['tuuwazikan']*40;
										$docomo_ryoukin+=$tuuwaryoukin;
										$au_ryoukin+=$tuuwaryoukin;
										$softbank_ryoukin+=$tuuwaryoukin;
									
								}elseif ($_SESSION['packet'] < 25165824){
									$docomo_ryoukin-=1000;
										$tuuwaryoukin = $_SESSION['tuuwazikan']*40;
										$docomo_ryoukin+=$tuuwaryoukin;
										$au_ryoukin+=$tuuwaryoukin;
										$softbank_ryoukin+=$tuuwaryoukin;
									
								} else {
									$tuuwaryoukin = $_SESSION['tuuwazikan']*40;
									$docomo_ryoukin+=$tuuwaryoukin;
									$au_ryoukin+=$tuuwaryoukin;
									$softbank_ryoukin+=$tuuwaryoukin;
								}
								break;
								
							case "softbank_kaisen":
								$s-=934;
								if ($_SESSION['packet'] < 114000){
									$docomo_ryoukin-=1000;
									$softbank_ryoukin+=0.05*$packet-5700;
										$tuuwaryoukin = $_SESSION['tuuwazikan']*40;
										$docomo_ryoukin+=$tuuwaryoukin;
										$au_ryoukin+=$tuuwaryoukin;
										$softbank_ryoukin+=$tuuwaryoukin;
									
								}elseif ($_SESSION['packet'] < 25165824){
									$docomo_ryoukin-=1000;
										$tuuwaryoukin = $_SESSION['tuuwazikan']*40;
										$docomo_ryoukin+=$tuuwaryoukin;
										$au_ryoukin+=$tuuwaryoukin;
										$softbank_ryoukin+=$tuuwaryoukin;
								
								} else {
									$tuuwaryoukin = $_SESSION['tuuwazikan']*40;
									$docomo_ryoukin+=$tuuwaryoukin;
									$au_ryoukin+=$tuuwaryoukin;
									$softbank_ryoukin+=$tuuwaryoukin;
								}
								break;
								
							default:
								switch($_SESSION['ruta']){
									case "au_ruta":#これは2年間。2014/8/31まで
										au_ryouin-=934;
										if ($_SESSION['packet'] < 114000){
											$docomo_ryoukin-=1000;
											$softbank_ryoukin+=0.05*$packet-5700;
												$tuuwaryoukin = $_SESSION['tuuwazikan']*40;
												$docomo_ryoukin+=$tuuwaryoukin;
												$au_ryoukin+=$tuuwaryoukin;
												$softbank_ryoukin+=$tuuwaryoukin;
											
										}elseif ($_SESSION['packet'] < 25165824){
											$docomo_ryoukin-=1000;
												$tuuwaryoukin = $_SESSION['tuuwazikan']*40;
												$docomo_ryoukin+=$tuuwaryoukin;
												$au_ryoukin+=$tuuwaryoukin;
												$softbank_ryoukin+=$tuuwaryoukin;
								
										} else {
											$tuuwaryoukin = $_SESSION['tuuwazikan']*40;
											$docomo_ryoukin+=$tuuwaryoukin;
											$au_ryoukin+=$tuuwaryoukin;
											$softbank_ryoukin+=$tuuwaryoukin;
										}
										break;
									
									case"softbank_ruta":
									softbank_ryoukin-=934;
										if ($_SESSION['packet'] < 114000){
											$docomo_ryoukin-=1000;
											$softbank_ryoukin+=0.05*$packet-5700;
												$tuuwaryoukin = $_SESSION['tuuwazikan']*40;
												$docomo_ryoukin+=$tuuwaryoukin;
												$au_ryoukin+=$tuuwaryoukin;
												$softbank_ryoukin+=$tuuwaryoukin;
											
										}elseif ($_SESSION['packet'] < 25165824){
											$docomo_ryoukin-=1000;
												$tuuwaryoukin = $_SESSION['tuuwazikan']*40;
												$docomo_ryoukin+=$tuuwaryoukin;
												$au_ryoukin+=$tuuwaryoukin;
												$softbank_ryoukin+=$tuuwaryoukin;
								
										} else {
											$tuuwaryoukin = $_SESSION['tuuwazikan']*40;
											$docomo_ryoukin+=$tuuwaryoukin;
											$au_ryoukin+=$tuuwaryoukin;
											$softbank_ryoukin+=$tuuwaryoukin;
										}
										break;
										
									default:
										if ($_SESSION['packet'] < 114000){
											$docomo_ryoukin-=1000;
											$softbank_ryoukin+=0.05*$packet-5700;
												$tuuwaryoukin = $_SESSION['tuuwazikan']*40;
												$docomo_ryoukin+=$tuuwaryoukin;
												$au_ryoukin+=$tuuwaryoukin;
												$softbank_ryoukin+=$tuuwaryoukin;
											
										}elseif ($_SESSION['packet'] < 25165824){
											$docomo_ryoukin-=1000;
												$tuuwaryoukin = $_SESSION['tuuwazikan']*40;
												$docomo_ryoukin+=$tuuwaryoukin;
												$au_ryoukin+=$tuuwaryoukin;
												$softbank_ryoukin+=$tuuwaryoukin;
											
										} else {
											$tuuwaryoukin = $_SESSION['tuuwazikan']*40;
											$docomo_ryoukin+=$tuuwaryoukin;
											$au_ryoukin+=$tuuwaryoukin;
											$softbank_ryoukin+=$tuuwaryoukin;
										}
										break;#ルータに対する
								}
							break;#kaisenに対する
							}
						break;#キャリアに対する
						
					case "softbank":
						$docomo_ryoukin-=743;
						$au_ryoukin-=934;
						
						switch($_SESSION['kaisen_tv']){
							case "au_kaisen":
								$au_ryoukin-=910;
								if ($_SESSION['packet'] < 114000){
									$docomo_ryoukin-=1000;
									$softbank_ryoukin+=0.05*$packet-5700;
										$tuuwaryoukin = $_SESSION['tuuwazikan']*40;
										$docomo_ryoukin+=$tuuwaryoukin;
										$au_ryoukin+=$tuuwaryoukin;
										$softbank_ryoukin+=$tuuwaryoukin;
									
								}elseif ($_SESSION['packet'] < 25165824){
									$docomo_ryoukin-=1000;
										$tuuwaryoukin = $_SESSION['tuuwazikan']*40;
										$docomo_ryoukin+=$tuuwaryoukin;
										$au_ryoukin+=$tuuwaryoukin;
										$softbank_ryoukin+=$tuuwaryoukin;
									
								} else {
									$tuuwaryoukin = $_SESSION['tuuwazikan']*40;
									$docomo_ryoukin+=$tuuwaryoukin;
									$au_ryoukin+=$tuuwaryoukin;
									$softbank_ryoukin+=$tuuwaryoukin;
								}
								break;
								
							case "softbank_kaisen":
								$s-=934;
								if ($_SESSION['packet'] < 114000){
									$docomo_ryoukin-=1000;
									$softbank_ryoukin+=0.05*$packet-5700;
										$tuuwaryoukin = $_SESSION['tuuwazikan']*40;
										$docomo_ryoukin+=$tuuwaryoukin;
										$au_ryoukin+=$tuuwaryoukin;
										$softbank_ryoukin+=$tuuwaryoukin;
									
								}elseif ($_SESSION['packet'] < 25165824){
									$docomo_ryoukin-=1000;
										$tuuwaryoukin = $_SESSION['tuuwazikan']*40;
										$docomo_ryoukin+=$tuuwaryoukin;
										$au_ryoukin+=$tuuwaryoukin;
										$softbank_ryoukin+=$tuuwaryoukin;
								
								} else {
									$tuuwaryoukin = $_SESSION['tuuwazikan']*40;
									$docomo_ryoukin+=$tuuwaryoukin;
									$au_ryoukin+=$tuuwaryoukin;
									$softbank_ryoukin+=$tuuwaryoukin;
								}
								break;
								
							default:
								switch($_SESSION['ruta']){
									case "au_ruta":#これは2年間。2014/8/31まで
										au_ryouin-=934;
										if ($_SESSION['packet'] < 114000){
											$docomo_ryoukin-=1000;
											$softbank_ryoukin+=0.05*$packet-5700;
												$tuuwaryoukin = $_SESSION['tuuwazikan']*40;
												$docomo_ryoukin+=$tuuwaryoukin;
												$au_ryoukin+=$tuuwaryoukin;
												$softbank_ryoukin+=$tuuwaryoukin;
											
										}elseif ($_SESSION['packet'] < 25165824){
											$docomo_ryoukin-=1000;
												$tuuwaryoukin = $_SESSION['tuuwazikan']*40;
												$docomo_ryoukin+=$tuuwaryoukin;
												$au_ryoukin+=$tuuwaryoukin;
												$softbank_ryoukin+=$tuuwaryoukin;
								
										} else {
											$tuuwaryoukin = $_SESSION['tuuwazikan']*40;
											$docomo_ryoukin+=$tuuwaryoukin;
											$au_ryoukin+=$tuuwaryoukin;
											$softbank_ryoukin+=$tuuwaryoukin;
										}
										break;
									
									case"softbank_ruta":
									softbank_ryoukin-=934;
										if ($_SESSION['packet'] < 114000){
											$docomo_ryoukin-=1000;
											$softbank_ryoukin+=0.05*$packet-5700;
												$tuuwaryoukin = $_SESSION['tuuwazikan']*40;
												$docomo_ryoukin+=$tuuwaryoukin;
												$au_ryoukin+=$tuuwaryoukin;
												$softbank_ryoukin+=$tuuwaryoukin;
											
										}elseif ($_SESSION['packet'] < 25165824){
											$docomo_ryoukin-=1000;
												$tuuwaryoukin = $_SESSION['tuuwazikan']*40;
												$docomo_ryoukin+=$tuuwaryoukin;
												$au_ryoukin+=$tuuwaryoukin;
												$softbank_ryoukin+=$tuuwaryoukin;
								
										} else {
											$tuuwaryoukin = $_SESSION['tuuwazikan']*40;
											$docomo_ryoukin+=$tuuwaryoukin;
											$au_ryoukin+=$tuuwaryoukin;
											$softbank_ryoukin+=$tuuwaryoukin;
										}
										break;
										
									default:
										if ($_SESSION['packet'] < 114000){
											$docomo_ryoukin-=1000;
											$softbank_ryoukin+=0.05*$packet-5700;
												$tuuwaryoukin = $_SESSION['tuuwazikan']*40;
												$docomo_ryoukin+=$tuuwaryoukin;
												$au_ryoukin+=$tuuwaryoukin;
												$softbank_ryoukin+=$tuuwaryoukin;
											
										}elseif ($_SESSION['packet'] < 25165824){
											$docomo_ryoukin-=1000;
												$tuuwaryoukin = $_SESSION['tuuwazikan']*40;
												$docomo_ryoukin+=$tuuwaryoukin;
												$au_ryoukin+=$tuuwaryoukin;
												$softbank_ryoukin+=$tuuwaryoukin;
											
										} else {
											$tuuwaryoukin = $_SESSION['tuuwazikan']*40;
											$docomo_ryoukin+=$tuuwaryoukin;
											$au_ryoukin+=$tuuwaryoukin;
											$softbank_ryoukin+=$tuuwaryoukin;
										}
										break;#ルータに対する
								}
							break;#kaisenに対する
							}
						break;#キャリアに対する
				}		
				break;#機種に対する
							
			case "sumaho":
				switch($_SESSION['kyaria']){
					case "docomo":
						$au_ryoukin=-934;
						$softbank_ryoukin-=934;
						
						switch($_SESSION['kaisen_tv']){
							case "au_kaisen":
								$au_ryoukin-=1410;
								if ($_SESSION['packet'] < 114000){
									$docomo_ryoukin-=1000;
									$softbank_ryoukin+=0.05*$packet-5700;
										$tuuwaryoukin = $_SESSION['tuuwazikan']*40;
										$docomo_ryoukin+=$tuuwaryoukin;
										$au_ryoukin+=$tuuwaryoukin;
										$softbank_ryoukin+=$tuuwaryoukin;
									
								}elseif ($_SESSION['packet'] < 25165824){
									$docomo_ryoukin-=1000;
										$tuuwaryoukin = $_SESSION['tuuwazikan']*40;
										$docomo_ryoukin+=$tuuwaryoukin;
										$au_ryoukin+=$tuuwaryoukin;
										$softbank_ryoukin+=$tuuwaryoukin;
									
								} else {
									$tuuwaryoukin = $_SESSION['tuuwazikan']*40;
									$docomo_ryoukin+=$tuuwaryoukin;
									$au_ryoukin+=$tuuwaryoukin;
									$softbank_ryoukin+=$tuuwaryoukin;
								}
								break;
								
							case "softbank_kaisen":
								$s-=934;
								if ($_SESSION['packet'] < 114000){
									$docomo_ryoukin-=1000;
									$softbank_ryoukin+=0.05*$packet-5700;
										$tuuwaryoukin = $_SESSION['tuuwazikan']*40;
										$docomo_ryoukin+=$tuuwaryoukin;
										$au_ryoukin+=$tuuwaryoukin;
										$softbank_ryoukin+=$tuuwaryoukin;
									
								}elseif ($_SESSION['packet'] < 25165824){
									$docomo_ryoukin-=1000;
										$tuuwaryoukin = $_SESSION['tuuwazikan']*40;
										$docomo_ryoukin+=$tuuwaryoukin;
										$au_ryoukin+=$tuuwaryoukin;
										$softbank_ryoukin+=$tuuwaryoukin;
								
								} else {
									$tuuwaryoukin = $_SESSION['tuuwazikan']*40;
									$docomo_ryoukin+=$tuuwaryoukin;
									$au_ryoukin+=$tuuwaryoukin;
									$softbank_ryoukin+=$tuuwaryoukin;
								}
								break;
								
							default:
								switch($_SESSION['ruta']){
									case "au_ruta":#これは2年間。2014/8/31まで
										au_ryouin-=934;
										if ($_SESSION['packet'] < 114000){
											$docomo_ryoukin-=1000;
											$softbank_ryoukin+=0.05*$packet-5700;
												$tuuwaryoukin = $_SESSION['tuuwazikan']*40;
												$docomo_ryoukin+=$tuuwaryoukin;
												$au_ryoukin+=$tuuwaryoukin;
												$softbank_ryoukin+=$tuuwaryoukin;
											
										}elseif ($_SESSION['packet'] < 25165824){
											$docomo_ryoukin-=1000;
												$tuuwaryoukin = $_SESSION['tuuwazikan']*40;
												$docomo_ryoukin+=$tuuwaryoukin;
												$au_ryoukin+=$tuuwaryoukin;
												$softbank_ryoukin+=$tuuwaryoukin;
								
										} else {
											$tuuwaryoukin = $_SESSION['tuuwazikan']*40;
											$docomo_ryoukin+=$tuuwaryoukin;
											$au_ryoukin+=$tuuwaryoukin;
											$softbank_ryoukin+=$tuuwaryoukin;
										}
										break;
									
									case"softbank_ruta":
									softbank_ryoukin-=934;
										if ($_SESSION['packet'] < 114000){
											$docomo_ryoukin-=1000;
											$softbank_ryoukin+=0.05*$packet-5700;
												$tuuwaryoukin = $_SESSION['tuuwazikan']*40;
												$docomo_ryoukin+=$tuuwaryoukin;
												$au_ryoukin+=$tuuwaryoukin;
												$softbank_ryoukin+=$tuuwaryoukin;
											
										}elseif ($_SESSION['packet'] < 25165824){
											$docomo_ryoukin-=1000;
												$tuuwaryoukin = $_SESSION['tuuwazikan']*40;
												$docomo_ryoukin+=$tuuwaryoukin;
												$au_ryoukin+=$tuuwaryoukin;
												$softbank_ryoukin+=$tuuwaryoukin;
								
										} else {
											$tuuwaryoukin = $_SESSION['tuuwazikan']*40;
											$docomo_ryoukin+=$tuuwaryoukin;
											$au_ryoukin+=$tuuwaryoukin;
											$softbank_ryoukin+=$tuuwaryoukin;
										}
										break;
										
									default:
										if ($_SESSION['packet'] < 114000){
											$docomo_ryoukin-=1000;
											$softbank_ryoukin+=0.05*$packet-5700;
												$tuuwaryoukin = $_SESSION['tuuwazikan']*40;
												$docomo_ryoukin+=$tuuwaryoukin;
												$au_ryoukin+=$tuuwaryoukin;
												$softbank_ryoukin+=$tuuwaryoukin;
											
										}elseif ($_SESSION['packet'] < 25165824){
											$docomo_ryoukin-=1000;
												$tuuwaryoukin = $_SESSION['tuuwazikan']*40;
												$docomo_ryoukin+=$tuuwaryoukin;
												$au_ryoukin+=$tuuwaryoukin;
												$softbank_ryoukin+=$tuuwaryoukin;
											
										} else {
											$tuuwaryoukin = $_SESSION['tuuwazikan']*40;
											$docomo_ryoukin+=$tuuwaryoukin;
											$au_ryoukin+=$tuuwaryoukin;
											$softbank_ryoukin+=$tuuwaryoukin;
										}
										break;#ルータに対する
								}
							break;#kaisenに対する
							}
						break;#キャリアに対する
						
					case "au":
						$docomo_ryoukin-=743;
						$softbank_ryoukin-=934;
						
						switch($_SESSION['kaisen_tv']){
							case "au_kaisen":
								$au_ryoukin-=1410;
								if ($_SESSION['packet'] < 114000){
									$docomo_ryoukin-=1000;
									$softbank_ryoukin+=0.05*$packet-5700;
										$tuuwaryoukin = $_SESSION['tuuwazikan']*40;
										$docomo_ryoukin+=$tuuwaryoukin;
										$au_ryoukin+=$tuuwaryoukin;
										$softbank_ryoukin+=$tuuwaryoukin;
									
								}elseif ($_SESSION['packet'] < 25165824){
									$docomo_ryoukin-=1000;
										$tuuwaryoukin = $_SESSION['tuuwazikan']*40;
										$docomo_ryoukin+=$tuuwaryoukin;
										$au_ryoukin+=$tuuwaryoukin;
										$softbank_ryoukin+=$tuuwaryoukin;
									
								} else {
									$tuuwaryoukin = $_SESSION['tuuwazikan']*40;
									$docomo_ryoukin+=$tuuwaryoukin;
									$au_ryoukin+=$tuuwaryoukin;
									$softbank_ryoukin+=$tuuwaryoukin;
								}
								break;
								
							case "softbank_kaisen":
								$s-=934;
								if ($_SESSION['packet'] < 114000){
									$docomo_ryoukin-=1000;
									$softbank_ryoukin+=0.05*$packet-5700;
										$tuuwaryoukin = $_SESSION['tuuwazikan']*40;
										$docomo_ryoukin+=$tuuwaryoukin;
										$au_ryoukin+=$tuuwaryoukin;
										$softbank_ryoukin+=$tuuwaryoukin;
									
								}elseif ($_SESSION['packet'] < 25165824){
									$docomo_ryoukin-=1000;
										$tuuwaryoukin = $_SESSION['tuuwazikan']*40;
										$docomo_ryoukin+=$tuuwaryoukin;
										$au_ryoukin+=$tuuwaryoukin;
										$softbank_ryoukin+=$tuuwaryoukin;
								
								} else {
									$tuuwaryoukin = $_SESSION['tuuwazikan']*40;
									$docomo_ryoukin+=$tuuwaryoukin;
									$au_ryoukin+=$tuuwaryoukin;
									$softbank_ryoukin+=$tuuwaryoukin;
								}
								break;
								
							default:
								switch($_SESSION['ruta']){
									case "au_ruta":#これは2年間。2014/8/31まで
										au_ryouin-=934;
										if ($_SESSION['packet'] < 114000){
											$docomo_ryoukin-=1000;
											$softbank_ryoukin+=0.05*$packet-5700;
												$tuuwaryoukin = $_SESSION['tuuwazikan']*40;
												$docomo_ryoukin+=$tuuwaryoukin;
												$au_ryoukin+=$tuuwaryoukin;
												$softbank_ryoukin+=$tuuwaryoukin;
											
										}elseif ($_SESSION['packet'] < 25165824){
											$docomo_ryoukin-=1000;
												$tuuwaryoukin = $_SESSION['tuuwazikan']*40;
												$docomo_ryoukin+=$tuuwaryoukin;
												$au_ryoukin+=$tuuwaryoukin;
												$softbank_ryoukin+=$tuuwaryoukin;
								
										} else {
											$tuuwaryoukin = $_SESSION['tuuwazikan']*40;
											$docomo_ryoukin+=$tuuwaryoukin;
											$au_ryoukin+=$tuuwaryoukin;
											$softbank_ryoukin+=$tuuwaryoukin;
										}
										break;
									
									case"softbank_ruta":
									softbank_ryoukin-=934;
										if ($_SESSION['packet'] < 114000){
											$docomo_ryoukin-=1000;
											$softbank_ryoukin+=0.05*$packet-5700;
												$tuuwaryoukin = $_SESSION['tuuwazikan']*40;
												$docomo_ryoukin+=$tuuwaryoukin;
												$au_ryoukin+=$tuuwaryoukin;
												$softbank_ryoukin+=$tuuwaryoukin;
											
										}elseif ($_SESSION['packet'] < 25165824){
											$docomo_ryoukin-=1000;
												$tuuwaryoukin = $_SESSION['tuuwazikan']*40;
												$docomo_ryoukin+=$tuuwaryoukin;
												$au_ryoukin+=$tuuwaryoukin;
												$softbank_ryoukin+=$tuuwaryoukin;
								
										} else {
											$tuuwaryoukin = $_SESSION['tuuwazikan']*40;
											$docomo_ryoukin+=$tuuwaryoukin;
											$au_ryoukin+=$tuuwaryoukin;
											$softbank_ryoukin+=$tuuwaryoukin;
										}
										break;
										
									default:
										if ($_SESSION['packet'] < 114000){
											$docomo_ryoukin-=1000;
											$softbank_ryoukin+=0.05*$packet-5700;
												$tuuwaryoukin = $_SESSION['tuuwazikan']*40;
												$docomo_ryoukin+=$tuuwaryoukin;
												$au_ryoukin+=$tuuwaryoukin;
												$softbank_ryoukin+=$tuuwaryoukin;
											
										}elseif ($_SESSION['packet'] < 25165824){
											$docomo_ryoukin-=1000;
												$tuuwaryoukin = $_SESSION['tuuwazikan']*40;
												$docomo_ryoukin+=$tuuwaryoukin;
												$au_ryoukin+=$tuuwaryoukin;
												$softbank_ryoukin+=$tuuwaryoukin;
											
										} else {
											$tuuwaryoukin = $_SESSION['tuuwazikan']*40;
											$docomo_ryoukin+=$tuuwaryoukin;
											$au_ryoukin+=$tuuwaryoukin;
											$softbank_ryoukin+=$tuuwaryoukin;
										}
										break;#ルータに対する
								}
							break;#kaisenに対する
							}
						break;#キャリアに対する
						
					case "softbank":
						$docomo_ryoukin-=743;
						$au_ryoukin-=934;
						
						switch($_SESSION['kaisen_tv']){
							case "au_kaisen":
								$au_ryoukin-=1410;
								if ($_SESSION['packet'] < 114000){
									$docomo_ryoukin-=1000;
									$softbank_ryoukin+=0.05*$packet-5700;
										$tuuwaryoukin = $_SESSION['tuuwazikan']*40;
										$docomo_ryoukin+=$tuuwaryoukin;
										$au_ryoukin+=$tuuwaryoukin;
										$softbank_ryoukin+=$tuuwaryoukin;
									
								}elseif ($_SESSION['packet'] < 25165824){
									$docomo_ryoukin-=1000;
										$tuuwaryoukin = $_SESSION['tuuwazikan']*40;
										$docomo_ryoukin+=$tuuwaryoukin;
										$au_ryoukin+=$tuuwaryoukin;
										$softbank_ryoukin+=$tuuwaryoukin;
									
								} else {
									$tuuwaryoukin = $_SESSION['tuuwazikan']*40;
									$docomo_ryoukin+=$tuuwaryoukin;
									$au_ryoukin+=$tuuwaryoukin;
									$softbank_ryoukin+=$tuuwaryoukin;
								}
								break;
								
							case "softbank_kaisen":
								$s-=934;
								if ($_SESSION['packet'] < 114000){
									$docomo_ryoukin-=1000;
									$softbank_ryoukin+=0.05*$packet-5700;
										$tuuwaryoukin = $_SESSION['tuuwazikan']*40;
										$docomo_ryoukin+=$tuuwaryoukin;
										$au_ryoukin+=$tuuwaryoukin;
										$softbank_ryoukin+=$tuuwaryoukin;
									
								}elseif ($_SESSION['packet'] < 25165824){
									$docomo_ryoukin-=1000;
										$tuuwaryoukin = $_SESSION['tuuwazikan']*40;
										$docomo_ryoukin+=$tuuwaryoukin;
										$au_ryoukin+=$tuuwaryoukin;
										$softbank_ryoukin+=$tuuwaryoukin;
								
								} else {
									$tuuwaryoukin = $_SESSION['tuuwazikan']*40;
									$docomo_ryoukin+=$tuuwaryoukin;
									$au_ryoukin+=$tuuwaryoukin;
									$softbank_ryoukin+=$tuuwaryoukin;
								}
								break;
								
							default:
								switch($_SESSION['ruta']){
									case "au_ruta":#これは2年間。2014/8/31まで
										au_ryouin-=934;
										if ($_SESSION['packet'] < 114000){
											$docomo_ryoukin-=1000;
											$softbank_ryoukin+=0.05*$packet-5700;
												$tuuwaryoukin = $_SESSION['tuuwazikan']*40;
												$docomo_ryoukin+=$tuuwaryoukin;
												$au_ryoukin+=$tuuwaryoukin;
												$softbank_ryoukin+=$tuuwaryoukin;
											
										}elseif ($_SESSION['packet'] < 25165824){
											$docomo_ryoukin-=1000;
												$tuuwaryoukin = $_SESSION['tuuwazikan']*40;
												$docomo_ryoukin+=$tuuwaryoukin;
												$au_ryoukin+=$tuuwaryoukin;
												$softbank_ryoukin+=$tuuwaryoukin;
								
										} else {
											$tuuwaryoukin = $_SESSION['tuuwazikan']*40;
											$docomo_ryoukin+=$tuuwaryoukin;
											$au_ryoukin+=$tuuwaryoukin;
											$softbank_ryoukin+=$tuuwaryoukin;
										}
										break;
									
									case"softbank_ruta":
									softbank_ryoukin-=934;
										if ($_SESSION['packet'] < 114000){
											$docomo_ryoukin-=1000;
											$softbank_ryoukin+=0.05*$packet-5700;
												$tuuwaryoukin = $_SESSION['tuuwazikan']*40;
												$docomo_ryoukin+=$tuuwaryoukin;
												$au_ryoukin+=$tuuwaryoukin;
												$softbank_ryoukin+=$tuuwaryoukin;
											
										}elseif ($_SESSION['packet'] < 25165824){
											$docomo_ryoukin-=1000;
												$tuuwaryoukin = $_SESSION['tuuwazikan']*40;
												$docomo_ryoukin+=$tuuwaryoukin;
												$au_ryoukin+=$tuuwaryoukin;
												$softbank_ryoukin+=$tuuwaryoukin;
								
										} else {
											$tuuwaryoukin = $_SESSION['tuuwazikan']*40;
											$docomo_ryoukin+=$tuuwaryoukin;
											$au_ryoukin+=$tuuwaryoukin;
											$softbank_ryoukin+=$tuuwaryoukin;
										}
										break;
										
									default:
										if ($_SESSION['packet'] < 114000){
											$docomo_ryoukin-=1000;
											$softbank_ryoukin+=0.05*$packet-5700;
												$tuuwaryoukin = $_SESSION['tuuwazikan']*40;
												$docomo_ryoukin+=$tuuwaryoukin;
												$au_ryoukin+=$tuuwaryoukin;
												$softbank_ryoukin+=$tuuwaryoukin;
											
										}elseif ($_SESSION['packet'] < 25165824){
											$docomo_ryoukin-=1000;
												$tuuwaryoukin = $_SESSION['tuuwazikan']*40;
												$docomo_ryoukin+=$tuuwaryoukin;
												$au_ryoukin+=$tuuwaryoukin;
												$softbank_ryoukin+=$tuuwaryoukin;
											
										} else {
											$tuuwaryoukin = $_SESSION['tuuwazikan']*40;
											$docomo_ryoukin+=$tuuwaryoukin;
											$au_ryoukin+=$tuuwaryoukin;
											$softbank_ryoukin+=$tuuwaryoukin;
										}
										break;#ルータに対する
								}
							break;#kaisenに対する
							}
						break;#キャリアに対する
				}		
				break;#機種に対する
				
				break;
				
			default:#ここには定数garakeとd定数oredemoが該当します。
				#以下通話時間
				if ($_SESSION['tuuwazikan'] < 5) {
					$docomo_ryoukin += 40*$_SESSION['tuuwazikan']+743;
					$au_ryoukin +=40*0.741*$_SESSION['tuuwazikan']+934;
					$softbank_ryoukin +=40*0.784*$_SESSION['tuuwazikan']+934;
					#docomo:タイプシンプルバリュー
					#au:プランEシンプル
					#softbank:ホワイトプラン
					
				} elseif (5 =< $_SESSION['tuuwazikan'] || $_SESSION['tuuwazikan'] < 25){
					$docomo_ryoukin += 934;
					$au_ryoukin += 934;
					$softbank_ryoukin += 40*0.784*$_SESSION['tuuwazikan']+934;
					#docomo:タイプSSバリュー
					#au:プランSSシンプル
					#softbank:ホワイトプラン
				
				} elseif (25=< $_SESSION['tuuwazikan'] || $_SESSION['tuuwazikan'] <26){
					$docomo_ryoukin += 934;
					$au_ryoukin += 934;
					$softbank_ryoukin += 40*($_SESSION['tuuwazikan']-25)+1700;
					#docomo:タイプSSバリュー
					#au:プランSSシンプル
					#softbank:オレンジプラン・SSプラン
			
				} elseif (26=< $_SESSION['tuuwazikan'] || $_SESSION['tuuwazikan'] <40){
					$docomo_ryoukin += 40*($_SESSION['tuuwazikan']-26)+934;
					$au_ryoukin += 40*($_SESSION['tuuwazikan']-26)+934;
					$softbank_ryoukin += 40*($_SESSION['tuuwazikan']-25)+1700;
					#docomo:タイプSSバリュー
					#au:プランSSシンプル
					#softbank:オレンジプラン・SSプラン
				
				} elseif (40=< $_SESSION['tuuwazikan'] || $_SESSION['tuuwazikan'] <41){
					$docomo_ryoukin += 1500;
					$au_ryoukin += 40*($_SESSION['tuuwazikan']-26)+934;
					$softbank_ryoukin += 40*($_SESSION['tuuwazikan']-25)+1700;
					#docomo:タイプSバリュー
					#au:プランSSシンプル
					#softbank:オレンジプラン・SSプラン
				
				} elseif (41=< $_SESSION['tuuwazikan'] || $_SESSION['tuuwazikan'] <56){
					$docomo_ryoukin += 1500;
					$au_ryoukin += 1550;
					$softbank_ryoukin += 2200;
					#docomo:タイプSバリュー
					#au:プランSシンプル
					#softbank:ブループラン・Sプラン
				
				} elseif (56=< $_SESSION['tuuwazikan'] || $_SESSION['tuuwazikan'] <57){
					$docomo_ryoukin += 18*($_SESSION['tuuwazikan']-55)+1500;
					$au_ryoukin += 1550;
					$softbank_ryoukin += 2200;
					#docomo:タイプSバリュー
					#au:プランSシンプル
					#softbank:ブループラン・Sプラン
				
				} elseif (57=< $_SESSION['tuuwazikan'] || $_SESSION['tuuwazikan'] <63){
					$docomo_ryoukin += 18*($_SESSION['tuuwazikan']-55)+1500;
					$au_ryoukin += 1550;
					$softbank_ryoukin += 2250;
					#docomo:タイプSバリュー
					#au:プランSシンプル
					#softbank:オレンジプラン・Sプラン
				
				} elseif (63=< $_SESSION['tuuwazikan'] || $_SESSION['tuuwazikan'] <83){
					$docomo_ryoukin += 18*($_SESSION['tuuwazikan']-55)+1500;
					$au_ryoukin += 32*($_SESSION['tuuwazikan']-62)+1550;
					$softbank_ryoukin += 32*($_SESSION['tuuwazikan']-62)+2250;
					#docomo:タイプSバリュー
					#au:プランSシンプル
					#softbank:オレンジプラン・Sプラン
				
				} elseif (83=< $_SESSION['tuuwazikan'] || $_SESSION['tuuwazikan'] <92){
					$docomo_ryoukin += 2500;
					$au_ryoukin += 32*($_SESSION['tuuwazikan']-62)+1550;
					$softbank_ryoukin += 32*($_SESSION['tuuwazikan']n-62)+2250;
					#docomo:タイプMバリュー
					#au:プランSシンプル
					#softbank:オレンジプラン・Sプラン
				
				} elseif (92=< $_SESSION['tuuwazikan'] || $_SESSION['tuuwazikan'] <143){
					$docomo_ryoukin += 2500;
					$au_ryoukin += 2500;
					$softbank_ryoukin += 3200;
					#docomo:タイプMバリュー
					#au:プランMシンプル
					#softbank:オレンジプラン・Mプラン
				
				} elseif (143=< $_SESSION['tuuwazikan'] || $_SESSION['tuuwazikan'] <145){
					$docomo_ryoukin += 28*($_SESSION['tuuwazikan']-142)+2500;
					$au_ryoukin += 2500;
					$softbank_ryoukin += 3200;
					#docomo:タイプMバリュー
					#au:プランMシンプル
					#softbank:オレンジプラン・Mプラン
				
				} elseif (145=< $_SESSION['tuuwazikan'] || $_SESSION['tuuwazikan'] <196){
					$docomo_ryoukin += 28*($_SESSION['tuuwazikan']-142)+2500;
					$au_ryoukin += 28*($_SESSION['tuuwazikan']-144)+2500;
					$softbank_ryoukin += 28*($_SESSION['tuuwazikan']n-144)+3200;
					#docomo:タイプMバリュー
					#au:プランMシンプル
					#softbank:オレンジプラン・Mプラン
				
				} elseif (196=< $_SESSION['tuuwazikan'] || $_SESSION['tuuwazikan'] <203){
					$docomo_ryoukin += 4000;
					$au_ryoukin += 3950;
					$softbank_ryoukin += 28*($_SESSION['tuuwazikan']n-144)+3200;
					#docomo:タイプLバリュー
					#au:プランLシンプル
					#softbank:オレンジプラン・Mプラン
				
				} elseif (203=< $_SESSION['tuuwazikan'] || $_SESSION['tuuwazikan'] <263){
					$docomo_ryoukin += 4000;
					$au_ryoukin += 3950;
					$softbank_ryoukin += 4650;
					#docomo:タイプLバリュー
					#au:プランLシンプル
					#softbank:オレンジプラン・Lプラン
				
				} elseif (263=< $_SESSION['tuuwazikan'] || $_SESSION['tuuwazikan'] <265){
					$docomo_ryoukin += 4000;
					$au_ryoukin += 24*($_SESSION['tuuwazikan']-262)+3950;
					$softbank_ryoukin += 4650;
					#docomo:タイプLバリュー
					#au:プランLシンプル
					#softbank:オレンジプラン・Lプラン
				
				} elseif (265=< $_SESSION['tuuwazikan'] || $_SESSION['tuuwazikan'] <301){
					$docomo_ryoukin += 4000;
					$au_ryoukin += 24*($_SESSION['tuuwazikan']-262)+3950;
					$softbank_ryoukin += 4700;
					#docomo:タイプLバリュー
					#au:プランLシンプル
					#softbank:ブループラン・Lプラン
				
				} elseif (301=< $_SESSION['tuuwazikan'] || $_SESSION['tuuwazikan'] <377){
					$docomo_ryoukin += 20*($_SESSION['tuuwazikan']-300)+4000;
					$au_ryoukin += 24*($_SESSION['tuuwazikan']-262)+3950;
					$softbank_ryoukin += 20*($_SESSION['tuuwazikan']-300)+4700;
					#docomo:タイプLバリュー
					#au:プランLシンプル
					#softbank:ブループラン・Lプラン
				
				} elseif (377=< $_SESSION['tuuwazikan'] || $_SESSION['tuuwazikan'] <425){
					$docomo_ryoukin += 20*(tuuwazikan-300)+4000;
					$au_ryoukin += 6700;
					$softbank_ryoukin += 20*($_SESSION['tuuwazikan']-300)+4700;
					#docomo:タイプLバリュー
					#au:プランLLシンプル
					#softbank:ブループラン・Lプラン
				
				} elseif (425=< $_SESSION['tuuwazikan'] || $_SESSION['tuuwazikan'] <426){
					$docomo_ryoukin += 20*(tuuwazikan-300)+4000;
					$au_ryoukin += 6700;
					$softbank_ryoukin += 7200;
					#docomo:タイプLバリュー
					#au:プランLLシンプル
					#softbank:ブループラン・LLプラン
				
				} elseif (426=< $_SESSION['tuuwazikan'] || $_SESSION['tuuwazikan'] <733){
					$docomo_ryoukin += 6500;
					$au_ryoukin += 6700;
					$softbank_ryoukin += 7200;
					#docomo:タイプLLバリュー
					#au:プランLLシンプル
					#softbank:ブループラン・LLプラン
				
				} elseif (733=< $_SESSION['tuuwazikan'] || $_SESSION['tuuwazikan'] <786){
					$docomo_ryoukin += 15*($_SESSION['tuuwazikan']-732)+6500;
					$au_ryoukin += 6700;
					$softbank_ryoukin += 7200;
					#docomo:タイプLLバリュー
					#au:プランLLシンプル
					#softbank:ブループラン・LLプラン
				
				} elseif (786=< $_SESSION['tuuwazikan'] || $_SESSION['tuuwazikan'] <801){
					$docomo_ryoukin += 15*($_SESSION['tuuwazikan']-732)+6500;
					$au_ryoukin += 6700;
					$softbank_ryoukin += 14*($_SESSION['tuuwazikan']-785)+7200;
					#docomo:タイプLLバリュー
					#au:プランLLシンプル
					#softbank:ブループラン・LLプラン
				
				} elseif (801=< $_SESSION['tuuwazikan']) {
					$docomo_ryoukin += 15*($_SESSION['tuuwazikan']-732)+6500;
					$au_ryoukin += 15*($_SESSION['tuuwazikan']-800)+6700;
					$softbank_ryoukin += 14*($_SESSION['tuuwazikan']-785)+7200;
					#docomo:タイプLLバリュー
					#au:プランLLシンプル
					#softbank:ブループラン・LLプラン
				}
				
				#以下パケット
				if ($packet < 9800) {
					$docomo_ryoukin += 0.08*$packet;
					$au_ryoukin +=0.1*$packet;
					$softbank_ryoukin +=0.1*$packet;
					#docomo:パケ・ホーダイ シンプル(ダブルとの違いが不明、あきとに確認)
					#au:ダブル定額スーパーライト
					#softbank:パケットし放題S
					
				} elseif (9800 =< $packet || $packet < 25000){
					$docomo_ryoukin += 0.08*$packet;
					$au_ryoukin +=0.08*$packet;
					$softbank_ryoukin +=0.08*$packet;
					#docomo:パケ・ホーダイ シンプル(ダブルとの違いが不明。シンプルが完全に上位互換。あきとに確認)
					#au:ダブル定額ライト
					#softbank:パケットし放題(フラットとの違いが不明。無印が完全に上位互換。)
				
				} elseif (25000 <=$packet){
					$docomo_ryoukin += 0.08*$packet;
					$au_ryoukin +=0.05*$packet;
					$softbank_ryoukin +=0.08*$packet;
					#docomo:パケ・ホーダイ シンプル(ダブルとの違いが不明。シンプルが完全に上位互換。あきとに確認)
					#au:ダブル定額
					#softbank:パケットし放題(フラットとの違いが不明。無印が完全に上位互換。)
				
			break;
				
				
				
				
				
				}
		
		$data['docomo']=$d;
		$data['au']=$a;
		$data['softbank']=$s;
		
		
		
		
		
        $this->load->view('header',$data);
        $this->load->view('demoX',$data);
        $this->load->view('footer',$data);
        
	}1
	
		
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
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
        // $this->load->view('footer',$data);
        
	}

	public function kyaria()
	{
		$this->load->helper('url');
		$data['page_title'] = 'モバイル料金ラボ';
		$gakusei=NULL;
		
        $this->load->view('header',$data);
        $this->load->view('cyaria',$data);
       // $this->load->view('footer',$data);
        
	}
	
	public function kisyu()
	{
		$this->load->helper('url');
		$data['page_title'] = 'モバイル料金ラボ';
		
		session_start();
		$_SESSION['kyaria']=$_REQUEST['kyaria'];
		$_SESSION["gakusei"]=$_REQUEST["gakusei"];
		
        $this->load->view('header',$data);
        $this->load->view('kisyu',$data);
        //$this->load->view('footer',$data);

	}
	
	
	public function kaisen()#ガラケの場合は関係なし
	{
		$this->load->helper('url'); 
		$data['page_title'] = 'モバイル料金ラボ';
		
		session_start();
		$_SESSION['kisyu']=$_REQUEST['kisyu'];
		
        $this->load->view('header',$data);
        $this->load->view('kaisen',$data);
        //$this->load->view('footer',$data);

	}
	
	
	public function ruta()#ガラケの場合は関係なし
	{
		$this->load->helper('url');
		$data['page_title'] = 'モバイル料金ラボ';
		
		session_start();
		$_SESSION['kaisen']=$_REQUEST['kaisen'];
		
		$this->load->view('header',$data);
		$this->load->view('ruta',$data);
		//$this->load->view('footer',$data);

	}
	
	
	public function packet()
	{
		$this->load->helper('url'); 
		$data['page_title'] = 'モバイル料金ラボ';
		
		session_start();
		$_SESSION['ruta']=$_REQUEST['ruta'];
		
        $this->load->view('header',$data);
        $this->load->view('packet',$data);
        //$this->load->view('footer',$data);

	}
	
	
	public function tuuwazikan()
	{
		$this->load->helper('url'); 
		$data['page_title'] = 'モバイル料金ラボ';
		
		session_start();
		$_SESSION['packet']=$_REQUEST['packet'];
		$_SESSION['packet'] = mb_convert_kana($_SESSION['packet'], "a", "UTF-8");#全角数字を半角に変換してます
        $this->load->view('header',$data);
        $this->load->view('suuti',$data);
       // $this->load->view('footer',$data);

	}
	
	
	public function kekka()
	{
		$this->load->helper('url'); 
		$data['page_title'] = 'モバイル料金ラボ';
		
		session_start();
		$_SESSION['tuuwazikan']=$_REQUEST['tuuwazikan'];
		$_SESSION['tuuwazikan'] = mb_convert_kana($_SESSION['tuuwazikan'], "a", "UTF-8");#全角数字を半角に変換してます
		
		#もっとも一般的な料金を表示、他も一緒
		$docomo_ryoukin=743+5700+300;
		$au_ryoukin=934+5700+300;
		$softbank_ryoukin=934+5700+300;
		
		
		#ソフバンに下取りあり。組み込まれてない。
		#auにも下取りあり。組み込まれていない。
		#docomoの学割はスマホのみなので、あまり意味ない。基本料金無料が3年間に延長になる
		#au,softbankはガラケにも適用されるため、意味ある。ただし、日中使うプランのが多いからあれかも
		
		if ($_SESSION["gakusei"] = "zibun" || "kazoku"){
		#このif内は学割
			if($_SESSION["kisyu"] = sumaho || iphone){
				#基本料金が引かれる
				$docomo_ryoukin-=743;
				$au_ryoukin-=934;
				$softbank_ryoukin-=934;
					
			} else{
				#docomoの場合、ガラケは学割の対象外
				$au_ryoukin-=934;
				$softbank_ryoukin-=934;
			}
			
		} else if ($_SESSION["kisyu"] = sumaho || iphone){
		#このif内は乗り換え割り
			switch($_SESSION['kyaria']){
				case "docomo":
					$au_ryoukin-=934;
					$softbank_ryoukin-=934;
					break;
					
				case "au":
					$docomo_ryoukin-=743;
					$softbank_ryoukin-=934;
					break;
				
				case "softbank":
					$docomo_ryoukin-=743;
					$au_ryoukin-=934;
					break;
		
		}else{
		#学生または家族に学生がなく、ガラケにしたい場合何も起きない。
		}
		
		switch($_SESSION['kisyu']){
			case "iphone":
				#変数=基本料金+パケホプラン+ネット通信料(spモード)
				$docomo_ryoukin=743+5700+300;
				$au_ryoukin=934+5700+300;
				$softbank_ryoukin=934+5700+300;
				
				#iPhoneにはパケホプランが500円安い
				$docomo_ryoukin-=500;
				$au_ryoukin-=500;
				$softbank_ryoukin-=500;
				break;
			
			case"sumaho":
				#変数=基本料金+パケホプラン+ネット通信料(spモード)
				$docomo_ryoukin=743+5700+300;
				$au_ryoukin=934+5700+300;
				$softbank_ryoukin=934+5700+300;
				break;
				
			case"garake":
				#変数=基本料金(通話量に依存するため非表示)+パケホプランも非表示+ネット通信料(iモード)
				$docomo_ryoukin+=300;
				$au_ryoukin+=300;
				$softbank_ryoukin+=300;
				break;
		}
		
		switch($_SESSION['kaisen']){
			case "au_kaisen":
				if($_SESSION['kisyu']=="iphone"){
					$au_ryoukin-=910;
				} else{
					$au_ryoukin-=1410;
				}
				break;
				
			case "softbank_kaisen":
				if($_SESSION['kisyu'] == "iphone"){
					$softbank_ryoukin-=910;
				} else{
					$softbank_ryoukin-=1410;
				}
				break;
			
			default:
				switch($_SESSION['ruta']){
					case "au_ruta":
						$au_ryoukin-=934;
						break;
					
					case "softbank_ruta":
						$softbank_ryoukin-=934;
						break;
				}
				break;#kaisenから出た
		}
		if ($_SESSION['kisyu'] == "iphone" || "sumaho"){
			#具体的なスマホの通話量と通信料へ
			#パケット数により、docomoの安いプランがある。ソフバンもほんとに少なければ(30Mbyteレベル)安いやつがある
			
			if ($_SESSION['packet'] < 114000){
				#パケット使用料
				$docomo_ryoukin-=1000;
				$softbank_ryoukin+=0.05*$_SESSION['packet']-5700;
				
				#通話量
				$tuuwaryoukin = $_SESSION['tuuwazikan']*40;
				$docomo_ryoukin+=$tuuwaryoukin;
				$au_ryoukin+=$tuuwaryoukin;
				$softbank_ryoukin+=$tuuwaryoukin;
			
			} elseif ($_SESSION['packet'] < 25165824){
				#パケット使用料
				$docomo_ryoukin-=1000;
				
				#通話量
				$tuuwaryoukin = $_SESSION['tuuwazikan']*40;
				$docomo_ryoukin+=$tuuwaryoukin;
				$au_ryoukin+=$tuuwaryoukin;
				$softbank_ryoukin+=$tuuwaryoukin;
			
			} else {
				#パケット数による割引なし
				$tuuwaryoukin = $_SESSION['tuuwazikan']*40;
				$docomo_ryoukin+=$tuuwaryoukin;
				$au_ryoukin+=$tuuwaryoukin;
				$softbank_ryoukin+=$tuuwaryoukin;
			}
		
		} else{
			#具体的なガラケの通話量と通信料へ
			switch ($_SESSION['gakusei']){
				case "zibun"||"kazoku":
					#以下通話時間。かなり細かく分けているが、誤差5分いないの物は省略している場合がある。
					if ($_SESSION['tuuwazikan'] < 26) {
						$docomo_ryoukin += $_SESSION['tuuwazikan']*40;
						$au_ryoukin += 40*0.741*$_SESSION['tuuwazikan'];
						$softbank_ryoukin +=40*0.784*$_SESSION['tuuwazikan'];
						#docomo:タイプシンプル
						#au:プランZシンプル
						#softbank:ホワイトプラン
		
					} elseif (26<= $_SESSION['tuuwazikan'] || $_SESSION['tuuwazikan'] <40){
						$docomo_ryoukin += 40*($_SESSION['tuuwazikan']-26)+934;
						$au_ryoukin += 40*0.741*$_SESSION['tuuwazikan'];
						$softbank_ryoukin +=40*0.784*$_SESSION['tuuwazikan'];
						#docomo:タイプSSバリュー
						#au:プランZシンプル
						#softbank:ホワイトプラン
					
					} elseif (40<= $_SESSION['tuuwazikan'] || $_SESSION['tuuwazikan'] <41){
						$docomo_ryoukin += 1500;
						$au_ryoukin += 40*0.741*$_SESSION['tuuwazikan'];
						$softbank_ryoukin +=40*0.784*$_SESSION['tuuwazikan'];
						#docomo:タイプSバリュー
						#au:プランZシンプル
						#softbank:ホワイトプラン
					
					} elseif (41<= $_SESSION['tuuwazikan'] || $_SESSION['tuuwazikan'] <50){
						$docomo_ryoukin += 1500;
						$au_ryoukin += 40*0.741*$_SESSION['tuuwazikan'];
						$softbank_ryoukin +=40*0.784*$_SESSION['tuuwazikan'];
						#docomo:タイプSバリュー
						#au:プランZシンプル
						#softbank:ホワイトプラン
						
					} elseif (50<= $_SESSION['tuuwazikan'] || $_SESSION['tuuwazikan'] <56){
						$docomo_ryoukin += 1500;
						$au_ryoukin += 1550;
						$softbank_ryoukin +=40*0.784*$_SESSION['tuuwazikan'];
						#docomo:タイプSバリュー
						#au:プランZシンプル
						#softbank:ホワイトプラン
					
					} elseif (56<= $_SESSION['tuuwazikan'] || $_SESSION['tuuwazikan'] <57){
						$docomo_ryoukin += 18*($_SESSION['tuuwazikan']-55)+1500;
						$au_ryoukin += 1550;
						$softbank_ryoukin +=40*0.784*$_SESSION['tuuwazikan'];
						#docomo:タイプSバリュー
						#au:プランSシンプル
						#softbank:ホワイトプラン
					
					} elseif (57<= $_SESSION['tuuwazikan'] || $_SESSION['tuuwazikan'] <63){
						$docomo_ryoukin += 18*($_SESSION['tuuwazikan']-55)+1500;
						$au_ryoukin += 1550;
						$softbank_ryoukin +=40*0.784*$_SESSION['tuuwazikan'];
						#docomo:タイプSバリュー
						#au:プランSシンプル
						#softbank:ホワイトプラン
					
					} elseif (63<= $_SESSION['tuuwazikan'] || $_SESSION['tuuwazikan'] <83){
						$docomo_ryoukin += 18*($_SESSION['tuuwazikan']-55)+1500;
						$au_ryoukin += 32*($_SESSION['tuuwazikan']-62)+1550;
						$softbank_ryoukin +=40*0.784*$_SESSION['tuuwazikan'];
						#docomo:タイプSバリュー
						#au:プランSシンプル
						#softbank:ホワイトプラン
					
					} elseif (83<= $_SESSION['tuuwazikan'] || $_SESSION['tuuwazikan'] <92){
						$docomo_ryoukin += 2500;
						$au_ryoukin += 32*($_SESSION['tuuwazikan']-62)+1550;
						$softbank_ryoukin +=40*0.784*$_SESSION['tuuwazikan'];
						#docomo:タイプMバリュー
						#au:プランSシンプル
						#softbank:ホワイトプラン
					
					} elseif (92<= $_SESSION['tuuwazikan'] || $_SESSION['tuuwazikan'] <103){
						$docomo_ryoukin += 2500;
						$au_ryoukin += 2500;
						$softbank_ryoukin +=40*0.784*$_SESSION['tuuwazikan'];
						#docomo:タイプMバリュー
						#au:プランMシンプル
						#softbank:ホワイトプラン
						
					} elseif (103<= $_SESSION['tuuwazikan'] || $_SESSION['tuuwazikan'] <143){
						$docomo_ryoukin += 2500;
						$au_ryoukin += 2500;
						$softbank_ryoukin += 3200;
						#docomo:タイプMバリュー
						#au:プランMシンプル
						#softbank:オレンジプラン・Mプラン
					
					} elseif (143<= $_SESSION['tuuwazikan'] || $_SESSION['tuuwazikan'] <145){
						$docomo_ryoukin += 28*($_SESSION['tuuwazikan']-142)+2500;
						$au_ryoukin += 2500;
						$softbank_ryoukin += 3200;
						#docomo:タイプMバリュー
						#au:プランMシンプル
						#softbank:オレンジプラン・Mプラン
					
					} elseif (145<= $_SESSION['tuuwazikan'] || $_SESSION['tuuwazikan'] <196){
						$docomo_ryoukin += 28*($_SESSION['tuuwazikan']-142)+2500;
						$au_ryoukin += 28*($_SESSION['tuuwazikan']-144)+2500;
						$softbank_ryoukin += 28*($_SESSION['tuuwazikan']-144)+3200;
						#docomo:タイプMバリュー
						#au:プランMシンプル
						#softbank:オレンジプラン・Mプラン
					
					} elseif (196<= $_SESSION['tuuwazikan'] || $_SESSION['tuuwazikan'] <203){
						$docomo_ryoukin += 4000;
						$au_ryoukin += 3950;
						$softbank_ryoukin += 28*($_SESSION['tuuwazikan']-144)+3200;
						#docomo:タイプLバリュー
						#au:プランLシンプル
						#softbank:オレンジプラン・Mプラン
					
					} elseif (203<= $_SESSION['tuuwazikan'] || $_SESSION['tuuwazikan'] <263){
						$docomo_ryoukin += 4000;
						$au_ryoukin += 3950;
						$softbank_ryoukin += 4650;
						#docomo:タイプLバリュー
						#au:プランLシンプル
						#softbank:オレンジプラン・Lプラン
					
					} elseif (263<= $_SESSION['tuuwazikan'] || $_SESSION['tuuwazikan'] <265){
						$docomo_ryoukin += 4000;
						$au_ryoukin += 24*($_SESSION['tuuwazikan']-262)+3950;
						$softbank_ryoukin += 4650;
						#docomo:タイプLバリュー
						#au:プランLシンプル
						#softbank:オレンジプラン・Lプラン
					
					} elseif (265<= $_SESSION['tuuwazikan'] || $_SESSION['tuuwazikan'] <301){
						$docomo_ryoukin += 4000;
						$au_ryoukin += 24*($_SESSION['tuuwazikan']-262)+3950;
						$softbank_ryoukin += 4700;
						#docomo:タイプLバリュー
						#au:プランLシンプル
						#softbank:ブループラン・Lプラン
					
					} elseif (301<= $_SESSION['tuuwazikan'] || $_SESSION['tuuwazikan'] <377){
						$docomo_ryoukin += 20*($_SESSION['tuuwazikan']-300)+4000;
						$au_ryoukin += 24*($_SESSION['tuuwazikan']-262)+3950;
						$softbank_ryoukin += 20*($_SESSION['tuuwazikan']-300)+4700;
						#docomo:タイプLバリュー
						#au:プランLシンプル
						#softbank:ブループラン・Lプラン
					
					} elseif (377<= $_SESSION['tuuwazikan'] || $_SESSION['tuuwazikan'] <425){
						$docomo_ryoukin += 20*(tuuwazikan-300)+4000;
						$au_ryoukin += 6700;
						$softbank_ryoukin += 20*($_SESSION['tuuwazikan']-300)+4700;
						#docomo:タイプLバリュー
						#au:プランLLシンプル
						#softbank:ブループラン・Lプラン
					
					} elseif (425<= $_SESSION['tuuwazikan'] || $_SESSION['tuuwazikan'] <426){
						$docomo_ryoukin += 20*(tuuwazikan-300)+4000;
						$au_ryoukin += 6700;
						$softbank_ryoukin += 7200;
						#docomo:タイプLバリュー
						#au:プランLLシンプル
						#softbank:ブループラン・LLプラン
					
					} elseif (426<= $_SESSION['tuuwazikan'] || $_SESSION['tuuwazikan'] <733){
						$docomo_ryoukin += 6500;
						$au_ryoukin += 6700;
						$softbank_ryoukin += 7200;
						#docomo:タイプLLバリュー
						#au:プランLLシンプル
						#softbank:ブループラン・LLプラン
					
					} elseif (733<= $_SESSION['tuuwazikan'] || $_SESSION['tuuwazikan'] <786){
						$docomo_ryoukin += 15*($_SESSION['tuuwazikan']-732)+6500;
						$au_ryoukin += 6700;
						$softbank_ryoukin += 7200;
						#docomo:タイプLLバリュー
						#au:プランLLシンプル
						#softbank:ブループラン・LLプラン
					
					} elseif (786<= $_SESSION['tuuwazikan'] || $_SESSION['tuuwazikan'] <801){
						$docomo_ryoukin += 15*($_SESSION['tuuwazikan']-732)+6500;
						$au_ryoukin += 6700;
						$softbank_ryoukin += 14*($_SESSION['tuuwazikan']-785)+7200;
						#docomo:タイプLLバリュー
						#au:プランLLシンプル
						#softbank:ブループラン・LLプラン
					
					} elseif (801<= $_SESSION['tuuwazikan']) {
						$docomo_ryoukin += 15*($_SESSION['tuuwazikan']-732)+6500;
						$au_ryoukin += 15*($_SESSION['tuuwazikan']-800)+6700;
						$softbank_ryoukin += 14*($_SESSION['tuuwazikan']-785)+7200;
						#docomo:タイプLLバリュー
						#au:プランLLシンプル
						#softbank:ブループラン・LLプラン
					}
					break;
					
				dafalt:
					#以下通話時間。かなり細かく分けているが、誤差5分いないの物は省略している場合がある。
					if ($_SESSION['tuuwazikan'] < 5) {
						$docomo_ryoukin += 40*$_SESSION['tuuwazikan']+743;
						$au_ryoukin +=40*0.741*$_SESSION['tuuwazikan']+934;
						$softbank_ryoukin +=40*0.784*$_SESSION['tuuwazikan']+934;
						#docomo:タイプシンプルバリュー
						#au:プランEシンプル
						#softbank:ホワイトプラン
						
					} elseif (5 <= $_SESSION['tuuwazikan'] || $_SESSION['tuuwazikan'] < 25){
						$docomo_ryoukin += 934;
						$au_ryoukin += 934;
						$softbank_ryoukin += 40*0.784*$_SESSION['tuuwazikan']+934;
						#docomo:タイプSSバリュー
						#au:プランSSシンプル
						#softbank:ホワイトプラン
					
					} elseif (25<= $_SESSION['tuuwazikan'] || $_SESSION['tuuwazikan'] <26){
						$docomo_ryoukin += 934;
						$au_ryoukin += 934;
						$softbank_ryoukin += 40*($_SESSION['tuuwazikan']-25)+1700;
						#docomo:タイプSSバリュー
						#au:プランSSシンプル
						#softbank:オレンジプラン・SSプラン
			
					} elseif (26<= $_SESSION['tuuwazikan'] || $_SESSION['tuuwazikan'] <40){
						$docomo_ryoukin += 40*($_SESSION['tuuwazikan']-26)+934;
						$au_ryoukin += 40*($_SESSION['tuuwazikan']-26)+934;
						$softbank_ryoukin += 40*($_SESSION['tuuwazikan']-25)+1700;
						#docomo:タイプSSバリュー
						#au:プランSSシンプル
						#softbank:オレンジプラン・SSプラン
					
					} elseif (40<= $_SESSION['tuuwazikan'] || $_SESSION['tuuwazikan'] <41){
						$docomo_ryoukin += 1500;
						$au_ryoukin += 40*($_SESSION['tuuwazikan']-26)+934;
						$softbank_ryoukin += 40*($_SESSION['tuuwazikan']-25)+1700;
						#docomo:タイプSバリュー
						#au:プランSSシンプル
						#softbank:オレンジプラン・SSプラン
					
					} elseif (41<= $_SESSION['tuuwazikan'] || $_SESSION['tuuwazikan'] <56){
						$docomo_ryoukin += 1500;
						$au_ryoukin += 1550;
						$softbank_ryoukin += 2200;
						#docomo:タイプSバリュー
						#au:プランSシンプル
						#softbank:ブループラン・Sプラン
					
					} elseif (56<= $_SESSION['tuuwazikan'] || $_SESSION['tuuwazikan'] <57){
						$docomo_ryoukin += 18*($_SESSION['tuuwazikan']-55)+1500;
						$au_ryoukin += 1550;
						$softbank_ryoukin += 2200;
						#docomo:タイプSバリュー
						#au:プランSシンプル
						#softbank:ブループラン・Sプラン
					
					} elseif (57<= $_SESSION['tuuwazikan'] || $_SESSION['tuuwazikan'] <63){
						$docomo_ryoukin += 18*($_SESSION['tuuwazikan']-55)+1500;
						$au_ryoukin += 1550;
						$softbank_ryoukin += 2250;
						#docomo:タイプSバリュー
						#au:プランSシンプル
						#softbank:オレンジプラン・Sプラン
					
					} elseif (63<= $_SESSION['tuuwazikan'] || $_SESSION['tuuwazikan'] <83){
						$docomo_ryoukin += 18*($_SESSION['tuuwazikan']-55)+1500;
						$au_ryoukin += 32*($_SESSION['tuuwazikan']-62)+1550;
						$softbank_ryoukin += 32*($_SESSION['tuuwazikan']-62)+2250;
						#docomo:タイプSバリュー
						#au:プランSシンプル
						#softbank:オレンジプラン・Sプラン
					
					} elseif (83<= $_SESSION['tuuwazikan'] || $_SESSION['tuuwazikan'] <92){
						$docomo_ryoukin += 2500;
						$au_ryoukin += 32*($_SESSION['tuuwazikan']-62)+1550;
						$softbank_ryoukin += 32*($_SESSION['tuuwazikan']-62)+2250;
						#docomo:タイプMバリュー
						#au:プランSシンプル
						#softbank:オレンジプラン・Sプラン
					
					} elseif (92<= $_SESSION['tuuwazikan'] || $_SESSION['tuuwazikan'] <143){
						$docomo_ryoukin += 2500;
						$au_ryoukin += 2500;
						$softbank_ryoukin += 3200;
						#docomo:タイプMバリュー
						#au:プランMシンプル
						#softbank:オレンジプラン・Mプラン
					
					} elseif (143<= $_SESSION['tuuwazikan'] || $_SESSION['tuuwazikan'] <145){
						$docomo_ryoukin += 28*($_SESSION['tuuwazikan']-142)+2500;
						$au_ryoukin += 2500;
						$softbank_ryoukin += 3200;
						#docomo:タイプMバリュー
						#au:プランMシンプル
						#softbank:オレンジプラン・Mプラン
					
					} elseif (145<= $_SESSION['tuuwazikan'] || $_SESSION['tuuwazikan'] <196){
						$docomo_ryoukin += 28*($_SESSION['tuuwazikan']-142)+2500;
						$au_ryoukin += 28*($_SESSION['tuuwazikan']-144)+2500;
						$softbank_ryoukin += 28*($_SESSION['tuuwazikan']-144)+3200;
						#docomo:タイプMバリュー
						#au:プランMシンプル
						#softbank:オレンジプラン・Mプラン
					
					} elseif (196<= $_SESSION['tuuwazikan'] || $_SESSION['tuuwazikan'] <203){
						$docomo_ryoukin += 4000;
						$au_ryoukin += 3950;
						$softbank_ryoukin += 28*($_SESSION['tuuwazikan']-144)+3200;
						#docomo:タイプLバリュー
						#au:プランLシンプル
						#softbank:オレンジプラン・Mプラン
					
					} elseif (203<= $_SESSION['tuuwazikan'] || $_SESSION['tuuwazikan'] <263){
						$docomo_ryoukin += 4000;
						$au_ryoukin += 3950;
						$softbank_ryoukin += 4650;
						#docomo:タイプLバリュー
						#au:プランLシンプル
						#softbank:オレンジプラン・Lプラン
					
					} elseif (263<= $_SESSION['tuuwazikan'] || $_SESSION['tuuwazikan'] <265){
						$docomo_ryoukin += 4000;
						$au_ryoukin += 24*($_SESSION['tuuwazikan']-262)+3950;
						$softbank_ryoukin += 4650;
						#docomo:タイプLバリュー
						#au:プランLシンプル
						#softbank:オレンジプラン・Lプラン
					
					} elseif (265<= $_SESSION['tuuwazikan'] || $_SESSION['tuuwazikan'] <301){
						$docomo_ryoukin += 4000;
						$au_ryoukin += 24*($_SESSION['tuuwazikan']-262)+3950;
						$softbank_ryoukin += 4700;
						#docomo:タイプLバリュー
						#au:プランLシンプル
						#softbank:ブループラン・Lプラン
					
					} elseif (301<= $_SESSION['tuuwazikan'] || $_SESSION['tuuwazikan'] <377){
						$docomo_ryoukin += 20*($_SESSION['tuuwazikan']-300)+4000;
						$au_ryoukin += 24*($_SESSION['tuuwazikan']-262)+3950;
						$softbank_ryoukin += 20*($_SESSION['tuuwazikan']-300)+4700;
						#docomo:タイプLバリュー
						#au:プランLシンプル
						#softbank:ブループラン・Lプラン
					
					} elseif (377<= $_SESSION['tuuwazikan'] || $_SESSION['tuuwazikan'] <425){
						$docomo_ryoukin += 20*(tuuwazikan-300)+4000;
						$au_ryoukin += 6700;
						$softbank_ryoukin += 20*($_SESSION['tuuwazikan']-300)+4700;
						#docomo:タイプLバリュー
						#au:プランLLシンプル
						#softbank:ブループラン・Lプラン
					
					} elseif (425<= $_SESSION['tuuwazikan'] || $_SESSION['tuuwazikan'] <426){
						$docomo_ryoukin += 20*(tuuwazikan-300)+4000;
						$au_ryoukin += 6700;
						$softbank_ryoukin += 7200;
						#docomo:タイプLバリュー
						#au:プランLLシンプル
						#softbank:ブループラン・LLプラン
					
					} elseif (426<= $_SESSION['tuuwazikan'] || $_SESSION['tuuwazikan'] <733){
						$docomo_ryoukin += 6500;
						$au_ryoukin += 6700;
						$softbank_ryoukin += 7200;
						#docomo:タイプLLバリュー
						#au:プランLLシンプル
						#softbank:ブループラン・LLプラン
					
					} elseif (733<= $_SESSION['tuuwazikan'] || $_SESSION['tuuwazikan'] <786){
						$docomo_ryoukin += 15*($_SESSION['tuuwazikan']-732)+6500;
						$au_ryoukin += 6700;
						$softbank_ryoukin += 7200;
						#docomo:タイプLLバリュー
						#au:プランLLシンプル
						#softbank:ブループラン・LLプラン
					
					} elseif (786<= $_SESSION['tuuwazikan'] || $_SESSION['tuuwazikan'] <801){
						$docomo_ryoukin += 15*($_SESSION['tuuwazikan']-732)+6500;
						$au_ryoukin += 6700;
						$softbank_ryoukin += 14*($_SESSION['tuuwazikan']-785)+7200;
						#docomo:タイプLLバリュー
						#au:プランLLシンプル
						#softbank:ブループラン・LLプラン
					
					} elseif (801<= $_SESSION['tuuwazikan']) {
						$docomo_ryoukin += 15*($_SESSION['tuuwazikan']-732)+6500;
						$au_ryoukin += 15*($_SESSION['tuuwazikan']-800)+6700;
						$softbank_ryoukin += 14*($_SESSION['tuuwazikan']-785)+7200;
						#docomo:タイプLLバリュー
						#au:プランLLシンプル
						#softbank:ブループラン・LLプラン
					}
					break;
				}#通話時間からでた
				
				#以下パケット。パケット数はあまりかかわらないです。
				if ($_SESSION['packet'] < 9800) {
					$docomo_ryoukin += 0.08*$_SESSION['packet'];
					$au_ryoukin +=0.1*$_SESSION['packet'];
					$softbank_ryoukin +=0.1*$_SESSION['packet'];
					#docomo:パケ・ホーダイ シンプル(ダブルとの違いが不明、あきとに確認)
					#au:ダブル定額スーパーライト
					#softbank:パケットし放題S
					
				} elseif (9800 <= $_SESSION['packet'] || $_SESSION['packet'] < 25000){
					$docomo_ryoukin += 0.08*$_SESSION['packet'];
					$au_ryoukin +=0.08*$_SESSION['packet'];
					$softbank_ryoukin +=0.08*$_SESSION['packet'];
					#docomo:パケ・ホーダイ シンプル(ダブルとの違いが不明。シンプルが完全に上位互換。あきとに確認)
					#au:ダブル定額ライト
					#softbank:パケットし放題(フラットとの違いが不明。無印が完全に上位互換。)
				
				} elseif (25000 <=$_SESSION['packet']){
					$docomo_ryoukin += 0.08*$_SESSION['packet'];
					$au_ryoukin +=0.05*$_SESSION['packet'];
					$softbank_ryoukin +=0.08*$_SESSION['packet'];
					#docomo:パケ・ホーダイ シンプル(ダブルとの違いが不明。シンプルが完全に上位互換。あきとに確認)
					#au:ダブル定額
					#softbank:パケットし放題(フラットとの違いが不明。無印が完全に上位互換。)
				}#packetから出た
			break;
			}
		
		
		
		echo "docomonの料金は$docomo_ryoukin ";
		echo "auの料金は$au_ryoukin ";
		echo "softbankも料金は$softbank_ryoukin";
		
		
        $this->load->view('header',$data);
        $this->load->view('kekka',$data);
        //$this->load->view('footer',$data);
	}
	
	
	
	public function book()
	{
		$this->load->helper('file');

		$data['page_title'] = 'モバイル料金ラボ';
		$this->load->helper('url');

        $this->load->view('header',$data);
        $this->load->view('book');
        //$this->load->view('footer',$data);
        
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
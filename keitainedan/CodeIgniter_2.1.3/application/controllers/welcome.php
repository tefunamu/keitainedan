<?php if ( ! defined("BASEPATH")) exit("No direct script access allowed");

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
	 * config/routes.php, it"s displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->load->helper("url");
		$data["page_title"] = "モバイル料金ラボ";
		
        $this->load->view("header",$data);
        $this->load->view("top");
        // $this->load->view("footer",$data);
        
	}

	public function kyaria()
	{
		$this->load->helper("url");
		$data["page_title"] = "モバイル料金ラボ";
		
        $this->load->view("header",$data);
        $this->load->view("cyaria",$data);
       // $this->load->view("footer",$data);
        
	}
	
	public function kisyu()
	{
		$this->load->helper("url");
		$data["page_title"] = "モバイル料金ラボ";
		
		session_start();
		$_SESSION["kyaria"]=$_REQUEST["kyaria"];
		$_SESSION["gakusei"]=$_REQUEST["gakusei"];
		
        $this->load->view("header",$data);
        if($_SESSION["kyaria"]==FALSE){
			$this->load->view("cyaria",$data);
		}else{
			$this->load->view("kisyu",$data);
		}
        //$this->load->view("footer",$data);

	}
	
	
	public function kaisen()#ガラケの場合は関係なし
	{
		$this->load->helper("url"); 
		$data["page_title"] = "モバイル料金ラボ";
		
		session_start();
		$_SESSION["kisyu"]=$_REQUEST["kisyu"];
		$_SESSION["years"]=$_REQUEST["years"];
		
        $this->load->view("header",$data);
        if($_SESSION["kisyu"]==FALSE){
			$this->load->view("kisyu",$data);
		}else{
			$this->load->view("kaisen",$data);
		}
        //$this->load->view("footer",$data);

	}
	
	
	public function ruta()#ガラケの場合は関係なし
	{
		$this->load->helper("url");
		$data["page_title"] = "モバイル料金ラボ";
		
		session_start();
		$_SESSION["kaisen"]=$_REQUEST["kaisen"];
		
		$this->load->view("header",$data);
		if($_SESSION["kaisen"]==FALSE){
			$this->load->view("kaisen",$data);
		}else{
			if($_SESSION["kaisen"]=="nashi"){
				$this->load->view("ruta",$data);
			}else{
				$this->load->view("packet",$data);
			}
		}
		//$this->load->view("footer",$data);

	}
	
	
	public function packet()
	{
		$this->load->helper("url"); 
		$data["page_title"] = "モバイル料金ラボ";
		
		session_start();
		$_SESSION["kaisen"]=$_REQUEST["kaisen"];
		
        $this->load->view("header",$data);
        if($_SESSION["kaisen"]==FALSE){
			$this->load->view("ruta",$data);
		}else{
			$this->load->view("packet",$data);
		}
        //$this->load->view("footer",$data);

	}
	
	
	public function tuuwazikan()
	{
		$this->load->helper("url"); 
		$data["page_title"] = "モバイル料金ラボ";
		session_start();
		$_SESSION["packet"]=$_REQUEST["packet"];
		$_SESSION["packet"] = mb_convert_kana($_SESSION["packet"], "a", "UTF-8");#全角数字を半角に変換してます
		$_SESSION["packet"] = $_SESSION["packet"]*1000000/128;#MB→パケットへの換算
		
		$this->load->view("header",$data);
		if($_SESSION["packet"]==FALSE){
			$this->load->view("packet",$data);
		}else{
			$this->load->view("suuti",$data);
		}
       // $this->load->view("footer",$data);

	}
	
	
	public function kekka()
	{
		$this->load->helper("url"); 
		$data["page_title"] = "モバイル料金ラボ";
		
		session_start();
		$_SESSION["tuuwazikan"]=$_REQUEST["tuuwazikan"];
		$_SESSION["tuuwazikan"] = mb_convert_kana($_SESSION["tuuwazikan"], "a", "UTF-8");#全角数字を半角に変換してます
		
		#もっとも一般的な料金を表示、他も一緒
		$docomo_ryoukin;
		#$au_ryoukin=934+5700+300;
		#$softbank_ryoukin=934+5700+300;
		
		
		#機種の選択
		switch($_SESSION["kisyu"]){
			case "iphone":
				#変数=基本料金+パケホプラン+ネット通信料(spモード)
				$docomo_ryoukin=743+5700+300;
				$au_ryoukin=934+5700+300;
				$softbank_ryoukin=934+5700+300;
				$docomo_new=2700;
				
				#iPhoneのパケホプランは500円安い
				$docomo_ryoukin-=500;
				$au_ryoukin-=500;
				$softbank_ryoukin-=500;
				break;
			
			case "sumaho":
				#変数=基本料金+パケホプラン+ネット通信料(spモード)
				$docomo_ryoukin=743+5700+300;
				$au_ryoukin=934+5700+300;
				$softbank_ryoukin=934+5700+300;
				$docomo_new=2700;
				break;
				
			case "garake":
				#変数=基本料金(通話量に依存するため非表示)+パケホプランも非表示+ネット通信料(iモード)
				$docomo_ryoukin=743+300;
				$au_ryoukin=934+300;
				$softbank_ryoukin=934+300;
				$docomo_new=2200;
				break;
				
			case "doredemo":#ガラケです
				#変数=基本料金(通話量に依存するため非表示)+パケホプランも非表示+ネット通信料(iモード)
				$docomo_ryoukin=743+300;
				$au_ryoukin=934+300;
				$softbank_ryoukin=934+300;
				$docomo_new=2200;
				break;
		}
		
		
		#学割及び乗り換えわりの選択
			#ソフバンに下取りあり。組み込まれてない。
			#auにも下取りあり。組み込まれていない。
			#docomoの学割はスマホのみなので、あまり意味ない。基本料金無料が3年間に延長になる
			#au,softbankはガラケにも適用されるため、意味ある。ただし、日中使うプランのが多いからあれかも
		if ($_SESSION["gakusei"] == "zibun" or $_SESSION["gakusei"] == "kazoku"){
		#このif内は学割
			if($_SESSION["kisyu"] == "sumaho" or "iphone"){
				#基本料金が引かれる
				$docomo_ryoukin=$docomo_ryoukin - 743;
				$au_ryoukin -= 934;
				$softbank_ryoukin -= 934;
					
			} else{
				#docomoの場合、ガラケは学割の対象外
				$au_ryoukin-=934;
				$softbank_ryoukin-=934;
			}
			
		} elseif ($_SESSION["kisyu"] == "sumaho" || $_SESSION["kisyu"] =="iphone"){
		#このif内は乗り換え割り
			switch($_SESSION["kyaria"]){
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
			}
		} else{
		#学生ではなく家族に学生もおらず、ガラケにしたい場合何も起きない。
		}
	
		#ここから回線割引き
		switch($_SESSION["kaisen"]){
			case "au_kaisen":
				if($_SESSION["kisyu"]=="iphone"){
					$au_ryoukin-=910;
				} else{
					$au_ryoukin-=1410;
				}
				break;
				
			case "softbank_kaisen":
				if($_SESSION["kisyu"] =="iphone"){
					$softbank_ryoukin-=910;
				} else{
					$softbank_ryoukin-=1410;
				}
				break;
			
			case "au_ruta":
				$au_ryoukin-=934;
				break;
				
			case "softbank_ruta":
				$softbank_ryoukin-=934;
				break;
		}
		
		#具体的なスマホの通話量と通信料へ
		if ($_SESSION["kisyu"] == "iphone" or $_SESSION["kisyu"] =="sumaho"){
			
			#スマホの通話量
			$tuuwaryoukin = $_SESSION["tuuwazikan"]*40;
			$docomo_ryoukin += $tuuwaryoukin;
			$au_ryoukin += $tuuwaryoukin;
			$softbank_ryoukin += $tuuwaryoukin;
			
			$d_plan = タイプXiにねん;
			$a_plan = "LTEプラン";
			$_SESSION["s_plan"]=ホワイトプラン;
			
			#スマホの通信料
			#パケット数により、docomoの安いプランがある。ソフバンもほんとに少なければ(15Mbyteレベル)安いやつがある
			if ($_SESSION["packet"] < 114000){
				$docomo_ryoukin-=1000;
				$softbank_ryoukin+=0.05*$_SESSION["packet"];
				$docomo_new+=3500;
				
				$d_pakeho = "Xiパケ・ホーダイ ライト";
				$a_pakeho = "LTE フラット";
				$s_pakeho = "パケット定額サービス無し";
			
			
			} elseif (114000<= $_SESSION["packet"] && $_SESSION["packet"] < 16777216){
				$docomo_ryoukin-=1000;
				if($_SESSION["years"]<15){
					$docomo_new+=3500;
				} else{
					$docomo_new+=2900;
				}
			
			} elseif (16777216<= $_SESSION["packet"] && $_SESSION["packet"] < 25165824){
				$docomo_ryoukin-=1000;
				#2GBパックに1000円で1GBつけた方がまし、だけど10年以上docomo使ってると打ち消される
				if($_SESSION["years"]<10){
					$docomo_new+=4500;#3GB使える
				}elseif (10<=$_SESSION["years"] && $_SESSION["years"]<15){
					$docomo_new+=4400;#5GB使える
				}elseif (15 < $_SESSION["years"]){
					$docomo_new+=4200;#5GB使える
				}
				
			} elseif (25165824<= $_SESSION["packet"] && $_SESSION["packet"] < 41943040){
				$docomo_new += 5000;
				if (10<=$_SESSION["years"] && $_SESSION["years"]<15){
					$docomo_new-=600;#5GB使える
				}elseif (15 <= $_SESSION["years"]){
					$docomo_new-=800;#5GB使える
				}
			
			} else {
				#通信料1GB増加につき1000円足してく
				$docomo_new += 5000;
				$_SESSION["packet"] -= 41943040;
				for ( ; 0<$_SESSION["packet"] ; $_SESSION["packet"]-=8388608){
					$docomo_new+=1000;
				}
				
				if (10<=$_SESSION["years"] && $_SESSION["years"]<15){
					$docomo_new-=600;#5GB使える
				}elseif (15 <= $_SESSION["years"]){
					$docomo_new-=800;#5GB使える
				}
			}
		
		} else{
			#具体的なガラケの通話量と通信料へ
			#ガラケの通話時間へ
			if ($_SESSION["tuuwazikan"] < 5) {
				$docomo_ryoukin += 40*$_SESSION["tuuwazikan"]+743;
				$au_ryoukin +=40*0.741*$_SESSION["tuuwazikan"]+934;
				$softbank_ryoukin +=40*0.784*$_SESSION["tuuwazikan"]+934;
				$d_plan="タイプシンプルバリュー";;
				$a_plan="プランEシンプル";
				$s_plan="ホワイトプラン";
				
			} elseif (5 <= $_SESSION["tuuwazikan"] || $_SESSION["tuuwazikan"] < 25){
				$docomo_ryoukin += 934;
				$au_ryoukin += 934;
				$softbank_ryoukin += 40*0.784*$_SESSION["tuuwazikan"]+934;
				$d_plan="タイプSSバリュー";
				$a_plan="プランSSシンプル";
				$s_plan="ホワイトプラン";
			
			} elseif (25<= $_SESSION["tuuwazikan"] || $_SESSION["tuuwazikan"] <26){
				$docomo_ryoukin += 934;
				$au_ryoukin += 934;
				$softbank_ryoukin += 40*($_SESSION["tuuwazikan"]-25)+1700;
				$d_plan="タイプSSバリュー";
				$a_plan="プランSSシンプル";
				$s_plan="オレンジプラン・SSプラン";
	
			} elseif (26<= $_SESSION["tuuwazikan"] || $_SESSION["tuuwazikan"] <40){
				$docomo_ryoukin += 40*($_SESSION["tuuwazikan"]-26)+934;
				$au_ryoukin += 40*($_SESSION["tuuwazikan"]-26)+934;
				$softbank_ryoukin += 40*($_SESSION["tuuwazikan"]-25)+1700;
				$d_plan="タイプSSバリュー";
				$a_plan="プランSSシンプル";
				$s_plan="オレンジプラン・SSプラン";
			
			} elseif (40<= $_SESSION["tuuwazikan"] || $_SESSION["tuuwazikan"] <41){
				$docomo_ryoukin += 1500;
				$au_ryoukin += 40*($_SESSION["tuuwazikan"]-26)+934;
				$softbank_ryoukin += 40*($_SESSION["tuuwazikan"]-25)+1700;
				$d_plan="タイプSバリュー";
				$a_plan="プランSSシンプル";
				$s_plan="オレンジプラン・SSプラン";
			
			} elseif (41<= $_SESSION["tuuwazikan"] || $_SESSION["tuuwazikan"] <56){
				$docomo_ryoukin += 1500;
				$au_ryoukin += 1550;
				$softbank_ryoukin += 2200;
				$d_plan="タイプSバリュー";
				$a_plan="プランSシンプル";
				$s_plan="ブループラン・Sプラン";
			
			} elseif (56<= $_SESSION["tuuwazikan"] || $_SESSION["tuuwazikan"] <57){
				$docomo_ryoukin += 18*($_SESSION["tuuwazikan"]-55)+1500;
				$au_ryoukin += 1550;
				$softbank_ryoukin += 2200;
				$d_plan="タイプSバリュー";
				$a_plan="プランSシンプル";
				$s_plan="ブループラン・Sプラン";
			
			} elseif (57<= $_SESSION["tuuwazikan"] || $_SESSION["tuuwazikan"] <63){
				$docomo_ryoukin += 18*($_SESSION["tuuwazikan"]-55)+1500;
				$au_ryoukin += 1550;
				$softbank_ryoukin += 2250;
				$d_plan="タイプSバリュー";
				$a_plan="プランSシンプル";
				$s_plan="オレンジプラン・Sプラン";
			
			} elseif (63<= $_SESSION["tuuwazikan"] || $_SESSION["tuuwazikan"] <83){
				$docomo_ryoukin += 18*($_SESSION["tuuwazikan"]-55)+1500;
				$au_ryoukin += 32*($_SESSION["tuuwazikan"]-62)+1550;
				$softbank_ryoukin += 32*($_SESSION["tuuwazikan"]-62)+2250;
				$d_plan="タイプSバリュー";
				$a_plan="プランSシンプル";
				$s_plan="オレンジプラン・Sプラン";
			
			} elseif (83<= $_SESSION["tuuwazikan"] || $_SESSION["tuuwazikan"] <92){
				$docomo_ryoukin += 2500;
				$au_ryoukin += 32*($_SESSION["tuuwazikan"]-62)+1550;
				$softbank_ryoukin += 32*($_SESSION["tuuwazikan"]-62)+2250;
				$d_plan="タイプMバリュー";
				$a_plan="プランSシンプル";
				$s_plan="オレンジプラン・Sプラン";
			
			} elseif (92<= $_SESSION["tuuwazikan"] || $_SESSION["tuuwazikan"] <143){
				$docomo_ryoukin += 2500;
				$au_ryoukin += 2500;
				$softbank_ryoukin += 3200;
				$d_plan="タイプMバリュー";
				$a_plan="プランMシンプル";
				$s_plan="オレンジプラン・Mプラン";
			
			} elseif (143<= $_SESSION["tuuwazikan"] || $_SESSION["tuuwazikan"] <145){
				$docomo_ryoukin += 28*($_SESSION["tuuwazikan"]-142)+2500;
				$au_ryoukin += 2500;
				$softbank_ryoukin += 3200;
				$d_plan="タイプMバリュー";
				$a_plan="プランMシンプル";
				$s_plan="オレンジプラン・Mプラン";
			
			} elseif (145<= $_SESSION["tuuwazikan"] || $_SESSION["tuuwazikan"] <196){
				$docomo_ryoukin += 28*($_SESSION["tuuwazikan"]-142)+2500;
				$au_ryoukin += 28*($_SESSION["tuuwazikan"]-144)+2500;
				$softbank_ryoukin += 28*($_SESSION["tuuwazikan"]-144)+3200;
				$d_plan="タイプMバリュー";
				$a_plan="プランMシンプル";
				$s_plan="オレンジプラン・Mプラン";
			
			} elseif (196<= $_SESSION["tuuwazikan"] || $_SESSION["tuuwazikan"] <203){
				$docomo_ryoukin += 4000;
				$au_ryoukin += 3950;
				$softbank_ryoukin += 28*($_SESSION["tuuwazikan"]-144)+3200;
				$d_plan="タイプLバリュー";
				$a_plan="プランLシンプル";
				$s_plan="オレンジプラン・Mプラン";
			
			} elseif (203<= $_SESSION["tuuwazikan"] || $_SESSION["tuuwazikan"] <263){
				$docomo_ryoukin += 4000;
				$au_ryoukin += 3950;
				$softbank_ryoukin += 4650;
				$d_plan="タイプLバリュー";
				$a_plan="プランLシンプル";
				$s_plan="オレンジプラン・Lプラン";
			
			} elseif (263<= $_SESSION["tuuwazikan"] || $_SESSION["tuuwazikan"] <265){
				$docomo_ryoukin += 4000;
				$au_ryoukin += 24*($_SESSION["tuuwazikan"]-262)+3950;
				$softbank_ryoukin += 4650;
				$d_plan="タイプLバリュー";
				$a_plan="プランLシンプル";
				$s_plan="オレンジプラン・Lプラン";
			
			} elseif (265<= $_SESSION["tuuwazikan"] || $_SESSION["tuuwazikan"] <301){
				$docomo_ryoukin += 4000;
				$au_ryoukin += 24*($_SESSION["tuuwazikan"]-262)+3950;
				$softbank_ryoukin += 4700;
				$d_plan="タイプLバリュー";
				$a_plan="プランLシンプル";
				$s_plan="ブループラン・Lプラン";
			
			} elseif (301<= $_SESSION["tuuwazikan"] || $_SESSION["tuuwazikan"] <377){
				$docomo_ryoukin += 20*($_SESSION["tuuwazikan"]-300)+4000;
				$au_ryoukin += 24*($_SESSION["tuuwazikan"]-262)+3950;
				$softbank_ryoukin += 20*($_SESSION["tuuwazikan"]-300)+4700;
				$d_plan="タイプLバリュー";
				$a_plan="プランLシンプル";
				$s_plan="ブループラン・Lプラン";
			
			} elseif (377<= $_SESSION["tuuwazikan"] || $_SESSION["tuuwazikan"] <425){
				$docomo_ryoukin += 20*(tuuwazikan-300)+4000;
				$au_ryoukin += 6700;
				$softbank_ryoukin += 20*($_SESSION["tuuwazikan"]-300)+4700;
				$d_plan="タイプLバリュー";
				$a_plan="プランLLシンプル";
				$s_plan="ブループラン・Lプラン";
			
			} elseif (425<= $_SESSION["tuuwazikan"] || $_SESSION["tuuwazikan"] <426){
				$docomo_ryoukin += 20*(tuuwazikan-300)+4000;
				$au_ryoukin += 6700;
				$softbank_ryoukin += 7200;
				$d_plan="タイプLバリュー";
				$a_plan="プランLLシンプル";
				$s_plan="ブループラン・LLプラン";
			
			} elseif (426<= $_SESSION["tuuwazikan"] || $_SESSION["tuuwazikan"] <733){
				$docomo_ryoukin += 6500;
				$au_ryoukin += 6700;
				$softbank_ryoukin += 7200;
				$d_plan="タイプLLバリュー";
				$a_plan="プランLLシンプル";
				$s_plan="ブループラン・LLプラン";
			
			} elseif (733<= $_SESSION["tuuwazikan"] || $_SESSION["tuuwazikan"] <786){
				$docomo_ryoukin += 15*($_SESSION["tuuwazikan"]-732)+6500;
				$au_ryoukin += 6700;
				$softbank_ryoukin += 7200;
				$d_plan="タイプLLバリュー";
				$a_plan="プランLLシンプル";
				$s_plan="ブループラン・LLプラン";
			
			} elseif (786<= $_SESSION["tuuwazikan"] || $_SESSION["tuuwazikan"] <801){
				$docomo_ryoukin += 15*($_SESSION["tuuwazikan"]-732)+6500;
				$au_ryoukin += 6700;
				$softbank_ryoukin += 14*($_SESSION["tuuwazikan"]-785)+7200;
				$d_plan="タイプLLバリュー";
				$a_plan="プランLLシンプル";
				$s_plan="ブループラン・LLプラン";
			
			} elseif (801<= $_SESSION["tuuwazikan"]) {
				$docomo_ryoukin += 15*($_SESSION["tuuwazikan"]-732)+6500;
				$au_ryoukin += 15*($_SESSION["tuuwazikan"]-800)+6700;
				$softbank_ryoukin += 14*($_SESSION["tuuwazikan"]-785)+7200;
				$d_plan="タイプLLバリュー";
				$a_plan="プランLLシンプル";
				$s_plan="ブループラン・LLプラン";
			}
			
				
		#以下通信料
			if ($_SESSION["packet"] < 9800) {
				$docomo_ryoukin += 0.08*$_SESSION["packet"];
				$au_ryoukin +=0.1*$_SESSION["packet"];
				$softbank_ryoukin+=0.1*$_SESSION["packet"];
				$d_pakeho="パケ・ホーダイ シンプル";#(ダブルとの違いが不明、あきとに確認)
				$a_pakeho="ダブル定額スーパーライト";
				$s_pakeho="パケットし放題S";
			
			} elseif (9800 <= $_SESSION["packet"] && $_SESSION["packet"] < 25000){
				$docomo_ryoukin += 0.08*$_SESSION["packet"];
				$au_ryoukin +=0.08*$_SESSION["packet"];
				$softbank_ryoukin +=0.08*$_SESSION["packet"];
				$d_pakeho="パケ・ホーダイ シンプル";#(ダブルとの違いが不明。シンプルが完全に上位互換。あきとに確認)
				$a_pakeho="ダブル定額ライト";
				$s_pakeho="パケットし放題";#(フラットとの違いが不明。無印が完全に上位互換。)
			
			} elseif (25000 <= $_SESSION["packet"] &&  $_SESSION["packet"] < 52500){
				$docomo_ryoukin += 0.08*$_SESSION["packet"];
				$au_ryoukin +=0.05*$_SESSION["packet"];
				$softbank_ryoukin +=0.08*$_SESSION["packet"];
				$d_pakeho="パケ・ホーダイ シンプル";#(ダブルとの違いが不明。シンプルが完全に上位互換。あきとに確認)
				$a_pakeho="ダブル定額";
				$s_pakeho="パケットし放題";#(フラットとの違いが不明。無印が完全に上位互換。)
			
			} else{
				$docomo_ryoukin += 4200;
				$au_ryoukin += 4200;
				$softbank_ryoukin += 4200;
				$d_pakeho="パケ・ホーダイ シンプル";#(ダブルとの違いが不明。シンプルが完全に上位互換。あきとに確認)
				$a_pakeho="ダブル定額";
				$s_pakeho="パケットし放題";
				
			}#packetから出た
		}
		
		#新料金プランのパケット数計算
			if ($_SESSION["packet"] < 114000){
				$docomo_new+=3500;
			
			} elseif (114000<= $_SESSION["packet"] && $_SESSION["packet"] < 16777216){
				if($_SESSION["years"]<15){
					$docomo_new+=3500;
				} else{
					$docomo_new+=2900;
				}
			
			} elseif (16777216<= $_SESSION["packet"] && $_SESSION["packet"] < 25165824){
				#2GBパックに1000円で1GBつけた方がまし、だけど10年以上docomo使ってると打ち消される
				if($_SESSION["years"]<10){
					$docomo_new+=4500;#3GB使える
				}elseif (10<=$_SESSION["years"] && $_SESSION["years"]<15){
					$docomo_new+=4400;#5GB使える
				}elseif (15 < $_SESSION["years"]){
					$docomo_new+=4200;#5GB使える
				}
				
			} elseif (25165824<= $_SESSION["packet"] && $_SESSION["packet"] < 41943040){
				$docomo_new += 5000;
				if (10<=$_SESSION["years"] && $_SESSION["years"]<15){
					$docomo_new-=600;#5GB使える
				}elseif (15 <= $_SESSION["years"]){
					$docomo_new-=800;#5GB使える
				}
			
			} else {
				#通信料1GB増加につき1000円足してく
				$docomo_new += 5000;
				$_SESSION["packet"] -= 41943040;
				for ( ; 0<$_SESSION["packet"] ; $_SESSION["packet"]-=8388608){
					$docomo_new+=1000;
				}
				
				if (10<=$_SESSION["years"] && $_SESSION["years"]<15){
					$docomo_new-=600;#5GB使える
				}elseif (15 <= $_SESSION["years"]){
					$docomo_new-=800;#5GB使える
				}
			}
		
		if($docomo_ryoukin >= $docomo_new){
			$docomo_ryoukin = $docomo_new;
			$d_plan="新体系";
		}
		
		
		$_SESSION["docomo_ryoukin"]=$docomo_ryoukin;
		$_SESSION["au_ryoukin"]=$au_ryoukin;
		$_SESSION["softbank_ryoukin"]=$softbank_ryoukin;
		$_SESSION["d_plan"]=$d_plan;
		$_SESSION["d_pakeho"]=$d_pakeho;
		$_SESSION["a_plan"]=$a_plan;
		$_SESSION["a_pakeho"]=$a_pakeho;
		$_SESSION["s_plan"]=$s_plan;
		$_SESSION["s_pakeho"]=$s_pakeho;
		
		
        $this->load->view("header",$data);
        $this->load->view("kekka",$data);
        //$this->load->view("footer",$data);
	}
	
	
	
	/*public function book()
	{
		$this->load->helper("file");

		$data["page_title"] = "モバイル料金ラボ";
		$this->load->helper("url");

        $this->load->view("header",$data);
        $this->load->view("book");
        //$this->load->view("footer",$data);
        
	}*/
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
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

####################################
##
##質問事項にU25以下orNOT
##家族でソフバンにでき合計が10GB以上
##を追加しなきやいけない
##U25= yes or no
##familyotoku = yes or no
####################################


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
		$_SESSION["packet"] = $_SESSION["packet"]*1024*1024/128;#MB→パケットへの換算

		$this->load->view("header",$data);
		if($_SESSION["packet"]==FALSE){
			$this->load->view("packet",$data);
		}else{
			$this->load->view("suuti",$data);
		}
       // $this->load->view("footer",$data);

	}
	
	
	public function extra()
	{
		$this->load->helper("url"); 
		$data["page_title"] = "モバイル料金ラボ";
		session_start();
		$_SESSION["tuuwazikan"]=$_REQUEST["tuuwazikan"];
		$_SESSION["tuuwazikan"] = mb_convert_kana($_SESSION["tuuwazikan"], "a", "UTF-8");#全角数字を半角に変換してます

		$this->load->view("header",$data);
		if($_SESSION["packet"]==FALSE){
			$this->load->view("suuti",$data);
		}else{
			$this->load->view("extra",$data);
		}
       // $this->load->view("footer",$data);

	}
	
	public function kekka()
	{
		$this->load->helper("url"); 
		$data["page_title"] = "モバイル料金ラボ";
		
		#サービスがなかった場合に対応するためにNULLいれとく。
		$d_service = NULL;
		$a_service = NULL;
		$s_service = NULL;
		
		session_start();
		$_SESSION["U25"]=$_REQUEST["U25"];
		$_SESSION["familyotoku"]=$_REQUEST["familyotoku"];
		
		
		#機種の選択
		#newプランは書いてないっす
		switch($_SESSION["kisyu"]){
			case "iphone":
				#変数=基本料金+パケホプラン+ネット通信料(spモード)
				$docomo_ryoukin=743+5700+300;
				$au_ryoukin=934+5700+300;
				$softbank_ryoukin=934+5700+300;
				$d_plan="Xiパケ・ホーダイ フラット";
				$a_plan="LTEフラット";
				$s_plan="パケットし放題フラット for 4G";
				
				#iPhoneのパケホプランは500円安い
				$docomo_ryoukin-=500;
				$au_ryoukin-=500;
				$softbank_ryoukin-=500;
				break;
			
			case "sumaho":
				#変数=基本料金+パケホプラン+ネット通信料(spモード)
				#新体系=基本料金+(パケホプラン)+通信料
				$docomo_ryoukin=743+5700+300;
				$au_ryoukin=934+5700+300;
				$softbank_ryoukin=934+5700+300;
				$d_plan="Xiパケ・ホーダイ フラット";
				$a_plan="LTEフラット";
				$s_plan="パケットし放題フラット for 4G";
				break;
				
			default:#ガラケとdoredemo
				#変数=(基本料金)+(パケホプラン)+ネット通信料
				#新体系=基本料金+(パケホプラン)+通信料
				$docomo_ryoukin=300;
				$au_ryoukin=300;
				$softbank_ryoukin=300;
				break;
		}
		
		
		#学割及び乗り換えわりの選択。学割は星になった。
		
		if ($_SESSION["kisyu"] == "sumaho" || $_SESSION["kisyu"] =="iphone"){
		#このif内は乗り換え割り。乗り換えはスマホのみ対象
			switch($_SESSION["kyaria"]){
				case "docomo":
					$au_ryoukin-=934;#8/31マデ
					$softbank_ryoukin-=934;
					break;
					
				case "au":
					$softbank_ryoukin-=934;
					break;
				
				case "softbank":
					$au_ryoukin-=934;
					break;
			}
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
			$d_plan = "タイプXiにねん";
			$a_plan = "LTEプラン";
			$s_plan="ホワイトプラン";
			
			#スマホの通信料
			#パケット数により、docomoの安いプランがある。ソフバンもほんとに少なければ(15Mbyteレベル)安いやつがある
			if ($_SESSION["packet"] < 114000){
				$docomo_ryoukin-=1000;
				$softbank_ryoukin+=0.05*$_SESSION["packet"];
				$docomo_new+=3500;
				
				$d_pakeho = "Xiパケ・ホーダイ ライト";
				$a_pakeho = "LTE フラット";
				$s_pakeho = "パケットし放題 for 4G";
			
			
			} elseif (114000<= $_SESSION["packet"] && $_SESSION["packet"] < 16777216){
				$docomo_ryoukin-=1000;
			
				$d_pakeho = "Xiパケ・ホーダイ ライト";
				$a_pakeho = "LTE フラット";
				$s_pakeho = "パケットし放題フラット for 4G";
			
			} elseif (16777216 <= $_SESSION["packet"] && $_SESSION["packet"]<25165824){
				$docomo_ryoukin-=1000;
				$d_pakeho = "Xiパケ・ホーダイ ライト";
				$a_pakeho = "LTE フラット";
				$s_pakeho = "パケットし放題フラット for 4G";
			} else{
				$d_pakeho = "Xiパケ・ホーダイ フラット";
				$a_pakeho = "LTE フラット";
				$s_pakeho = "パケットし放題フラット for 4G";
			}
			
		} else{
			#具体的なガラケの通話量と通信料へ
			#ガラケの通話時間へ
			if ($_SESSION["tuuwazikan"] < 5) {
				$docomo_ryoukin += 40*$_SESSION["tuuwazikan"]+743;
				$au_ryoukin +=40*0.741*$_SESSION["tuuwazikan"]+934;
				$softbank_ryoukin +=40*0.784*$_SESSION["tuuwazikan"]+934;
				$d_plan="タイプシンプルバリュー";
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


#ここから新体系
#めんどいからパケットからギガに戻す。2gbまでは3500円だけど2.0001gbからは4500円だよって計算してる。ceil関数さま様
	$_SESSION["packet"] = $_SESSION["packet"] / 8388608;

	#ここからdocomo新体系
	#docomo専用のパケット計算式dokomopacketを作成
		$docomo_packet = $_SESSION["packet"];
		$dn_plan = "カケホーダイ&パケあえる";
		if($_SESSION["kisyu"] == "sumaho" || $_SESSION["kisyu"] == "iphone"){#基本料金+ボーナス
		
			$docomo_new = 2700 + 300;
			#U25応援割。
			if( $_SESSION["U25"] == "yes"){
				$docomo_packet -= 1;
				$docomo_new -= 500;
			}
			#13ヶ月1GBゲット
			if( $_SESSION["kisyu"] ==  "iphone"){
				$docomo_packet -= 1;
			}
			
		} else{#ガラケ
		$docomo_new = 2200+300;
		}

	#docomoデータパック(ガラスマ共通)

		if($docomo_packet < 0.005215){		#5.3MBです
			$dn_pakeho = "データパックなし";
			$docomo_new+= $_SESSION["packet"]*8388608*0.08;#GB→パケット→円
		
		} elseif (0.005215 <= $docomo_packet && $docomo_packet < 2){
			$dn_pakeho = "2GBプラン";
			if(15 < $_SESSION["years"]){
				$docomo_new+=2900;
				$dn_service = "ずっとドコモ割";
				
			} else{
				$docomo_new+=3500;
			}
		
		} elseif (2<= $docomo_packet && $docomo_packet < 3){
			#2GBパックに1000円で1GBつけた方がまし、だけど10年以上docomo使ってると打ち消される
			if($_SESSION["years"]<10){
				$docomo_new+=4500;#3GB使える
				$dn_pakeho = "2GBパック";
			
			}elseif (10<=$_SESSION["years"] && $_SESSION["years"]<15){
				$docomo_new+=4400;#5GB使える
				$dn_pakeho = "5GBパック";
				$dn_service = "ずっとドコモ割";
				
			}elseif (15 < $_SESSION["years"]){
				$docomo_new+=4200;#5GB使える
				$dn_pakeho = "5GBパック";
				$dn_service = "ずっとドコモ割";
				
			}
				
		} elseif (3<= $docomo_packet && $docomo_packet < 5){
				$docomo_new += 5000;
				$dn_pakeho = "5GBパック";
				if (10<=$_SESSION["years"] && $_SESSION["years"]<15){
					$docomo_new-=600;#5GB使える
					$dn_service = "ずっとドコモ割";
				
				}elseif (15 <= $_SESSION["years"]){
					$docomo_new-=800;#5GB使える
					$dn_service = "ずっとドコモ割";
				
				}
			
			} else {
				$dn_pakeho = "5GBパック";
				#通信料1GB増加につき1000円足してく
				$docomo_new += 5000;
				$docomo_packet -= 5;
				for ( ; 0<$docomo_packet ; $docomo_packet -= 1){
					$docomo_new+=1000;
				}
				
				if (10<=$_SESSION["years"] && $_SESSION["years"]<15){
					$docomo_new-=600;#5GB使える
				}elseif (15 <= $_SESSION["years"]){
					$docomo_new-=800;#5GB使える
				}
			}
		
	#ここからソフバンの新体系
	#ソフバンのスマホ

	if($_SESSION["kisyu"] == "sumaho" or $_SESSION["kisyu"] == "iphone"){
		$sn_plan = "基本使用料";
		$softbank_new = 2700+300;
		if ($_SESSION["U25"] == "yes"){
			if ($_SESSION["familyotoku"] == "yes"){
				switch ($_SESSION["kisyu"]){
					case "doredemo":
					#not excist
						break;
						
					case "sumaho":#yys
						if ($_SESSION["packet"] <= 3){
							$sn_pakeho = "定額2GB";
							$sn_service="家族でお得+スマホ2GB";
							if ($_SESSION["packet"] <= 2){
								$softbank_new += 3500;
							} else{
								$softbank_new += 4500;
							}
						
						} elseif(3 < $_SESSION["packet"] && $_SESSION["packet"] <= 10){
							$sn_pakeho = "定額5GB";
							$sn_service="家族でお得+スマホ2GB";
							if ($_SESSION["packet"] <= 7){
								$softbank_new += 4700;
							} else{
								$softbank_new += 4700+1000*(ceil($_SESSION["packet"])-7);
							}
							
						
						} elseif(10 < $_SESSION["packet"] && $_SESSION["packet"] <= 15){
							$sn_pakeho = "定額10GB";
							$sn_service="10GBお得";
							if ($_SESSION["packet"] <= 12){
								$softbank_new += 8000;
							} else{
								$softbank_new += 8000+1000*(ceil($_SESSION["packet"])-12);
							}
							
						} elseif(15 < $_SESSION["packet"] && $_SESSION["packet"] <= 20){
							$sn_pakeho = "定額15GB";
							$sn_service="10GBお得+スマホ2GB";
							if ($_SESSION["packet"] <= 17){
								$softbank_new += 11000;
							} else{
								$softbank_new += 11000+1000*(ceil($_SESSION["packet"])-17);
							}
							
						} elseif(20 < $_SESSION["packet"] && $_SESSION["packet"] <= 27){
							$sn_pakeho = "定額20GB";
							$sn_service="家族でお得+スマホ2GB";
							if ($_SESSION["packet"] <= 22){
								$softbank_new += 14000;
							} else{
								$softbank_new += 14000+1000*(ceil($_SESSION["packet"])-22);
							}
							
						} else {
							$sn_pakeho = "定額30GB";
							$sn_service = "家族でお得+スマホ2GB";
							if ($_SESSION["packet"]<= 32){
								$softbank_new += 19500;
							} else{
								$softbank_new += 19500+1000*(ceil($_SESSION["packet"])-32);
							}
						}
						break;
						
					case "iphone":#yyi
						if ($_SESSION["packet"] <= 5){
							$sn_pakeho = "定額2GB";
							$sn_service="U25+iphoneお得";
							if ($_SESSION["packet"] <= 4){
								$softbank_new += 3000;
							} else{
								$softbank_new += 4000;
							}
						
						} elseif(5 < $_SESSION["packet"] && $_SESSION["packet"] <= 10){
							$sn_pakeho = "定額5GB";
							$sn_service="U25+iphoneお得";
							if ($_SESSION["packet"] <= 7){
								$softbank_new += 4500;
							} else{
								$softbank_new += 4500+1000*(ceil($_SESSION["packet"])-7);
							}
							
						} elseif($_SESSION["packet"] == 11){
							$sn_pakeho = "定額10GB";
							$sn_service="iphoneボナス1GB+10GBお得";
							$softbank_new += 8000;
						
						} elseif(11 < $_SESSION["packet"] && $_SESSION["packet"] <= 14){
							$sn_pakeho = "定額10GB";
							$sn_service="U25+iphoneボナス";
							$softbank_new += 8000+1000*(ceil($_SESSION["packet"])-11);
							
						} elseif(14 < $_SESSION["packet"] && $_SESSION["packet"] <= 19){
							$sn_pakeho = "定額15GB";
							$sn_service="家族でお得+iphoneボナス";
							if ($_SESSION["packet"] <= 17){
								$softbank_new += 11000;
							} else{
								$softbank_new += 11000+1000*(ceil($_SESSION["packet"])-17);
							}
							
						} elseif(19 < $_SESSION["packet"] && $_SESSION["packet"] <= 26){
							$sn_pakeho = "定額20GB";
							$sn_service="家族でお得+iphoneボナス";
							if ($_SESSION["packet"] <= 21){
								$softbank_new += 14000;
							} else{
								$softbank_new += 14000+1000*(ceil($_SESSION["packet"])-21);
							}
							
						} else {
							$sn_pakeho = "定額30GB";
							$sn_service="家族でお得+iphoneボナス";
							if ($_SESSION["packet"]<= 31){
								$softbank_new += 19500;
							} else{
								$softbank_new += 19500+1000*(ceil($_SESSION["packet"])-31);
							}
						}
						break;
				}
			} else{#ファミリー割引
				switch ($_SESSION["kisyu"]){
					case "doredemo":
					#not excist
						break;
						
					case "sumaho":#yns
						if ($_SESSION["packet"] <= 3){
							$sn_pakeho = "定額2GB";
							$sn_service="家族でお得+スマホ2GB";
							if ($_SESSION["packet"] <= 2){
								$softbank_new += 3500;
							} else{
								$softbank_new += 4500;
							}
						
						} elseif(3 < $_SESSION["packet"] && $_SESSION["packet"] <= 5){
							$sn_pakeho = "定額5GB";
							$sn_service="U25";
							$softbank_new += 4500;
						
						} elseif(5 < $_SESSION["packet"] && $_SESSION["packet"] <= 10){
							$sn_pakeho = "定額5GB";
							$sn_service="ボナス2GB";
							if ($_SESSION["packet"] <= 7){
								$softbank_new += 5000;
							} else{
								$softbank_new += 5000+1000*(ceil($_SESSION["packet"])-7);
							}
							
						} elseif(10 < $_SESSION["packet"] && $_SESSION["packet"] <= 16){
							$sn_pakeho = "定額10GB";
							$sn_service="ボナス2GB+10GBおトク割";
							if ($_SESSION["packet"] <= 12){
								$softbank_new += 8000;
							} else{
								$softbank_new += 8000+1000*(ceil($_SESSION["packet"])-12);
							}
							
						} elseif(16 < $_SESSION["packet"] && $_SESSION["packet"] <= 18){
							$sn_pakeho = "定額15GB";
							$sn_service="ボナス2GB";
							if ($_SESSION["packet"] <= 17){
								$softbank_new += 12500;
							} else{
								$softbank_new += 13500;
							}
						
						} elseif(18 < $_SESSION["packet"] && $_SESSION["packet"] <= 25){
							$sn_pakeho = "定額20GB";
							$sn_service="U25";
							if ($_SESSION["packet"] <= 20){
								$softbank_new += 14000;
							} else{
								$softbank_new += 14000+1000*(ceil($_SESSION["packet"])-20);
							}	
						
						} else {
							$sn_pakeho = "定額30GB";
							$sn_service="U25";
							if ($_SESSION["packet"]<= 32){
								$softbank_new += 19500;
							} else{
								$softbank_new += 19500+1000*(ceil($_SESSION["packet"])-32);
							}
						}
						break;
						
					case "iphone":#yni
						if ($_SESSION["packet"] <= 5){
							$sn_pakeho = "定額2GB";
							$sn_service="U25+iphoneお得";
							if ($_SESSION["packet"] <= 4){
								$softbank_new += 3000;
							} else{
								$softbank_new += 4000;
							}
						
						} elseif(5 < $_SESSION["packet"] && $_SESSION["packet"] <= 10){
							$sn_pakeho = "定額5GB";
							$sn_service="U25+iphoneお得";
							if ($_SESSION["packet"] <= 7){
								$softbank_new += 4500;
							} else{
								$softbank_new += 4500+1000*(ceil($_SESSION["packet"])-7);
							}
							
						} elseif($_SESSION["packet"] == 11){
							$sn_pakeho = "定額10GB";
							$sn_service="iphoneボナス1GB+10GBお得";
							$softbank_new += 8000;
						
						} elseif(11 < $_SESSION["packet"] && $_SESSION["packet"] <= 15){
							$sn_pakeho = "定額10GB";
							$sn_service="U25+iphoneボナス";
							$softbank_new += 8000+1000*(ceil($_SESSION["packet"])-11);
							
						} elseif(15 < $_SESSION["packet"] && $_SESSION["packet"] <= 20){
							$sn_pakeho = "定額15GB";
							$sn_service="U25+iphoneボナス";
							if ($_SESSION["packet"] <= 17){
								$softbank_new += 11000;
							} else{
								$softbank_new += 11000+1000*(ceil($_SESSION["packet"])-17);
							}
							
						} elseif(20 < $_SESSION["packet"] && $_SESSION["packet"] <= 28){
							$sn_pakeho = "定額20GB";
							$sn_service="U25+iphoneボナス";
							if ($_SESSION["packet"] <= 22){
								$softbank_new += 15500;
							} else{
								$softbank_new += 15500+1000*(ceil($_SESSION["packet"])-22);
							}
							
						} else {
							$sn_pakeho = "定額30GB";
							$sn_service="U25+iphoneボナス";
							if ($_SESSION["packet"]<= 32){
								$softbank_new += 22000;
							} else{
								$softbank_new += 22000+1000*(ceil($_SESSION["packet"])-32);
							}
						}
						break;
				}
			}
		} else{
			if ($_SESSION["familyotoku"] == "yes"){
				switch ($_SESSION["kisyu"]){
					case "doredemo":
						#not excist
						break;
						
					case "sumaho":#nys
						if ($_SESSION["packet"] <= 3){
							$sn_pakeho = "定額2GB";
							$sn_service="家族でお得+スマホ2GB";
							if ($_SESSION["packet"] <= 2){
								$softbank_new += 3500;
							} else{
								$softbank_new += 4500;
							}
						
						} elseif(3 < $_SESSION["packet"] && $_SESSION["packet"] <= 10){
							$sn_pakeho = "定額5GB";
							$sn_service="家族でお得+スマホ2GB";
							if ($_SESSION["packet"] <= 7){
								$softbank_new += 4700;
							} else{
								$softbank_new += 4700+1000*(ceil($_SESSION["packet"])-7);
							}
							
						
						} elseif(10 < $_SESSION["packet"] && $_SESSION["packet"] <= 15){
							$sn_pakeho = "定額10GB";
							$sn_service="10GBお得";
							if ($_SESSION["packet"] <= 12){
								$softbank_new += 8000;
							} else{
								$softbank_new += 8000+1000*(ceil($_SESSION["packet"])-12);
							}
							
						} elseif(15 < $_SESSION["packet"] && $_SESSION["packet"] <= 20){
							$sn_pakeho = "定額15GB";
							$sn_service="10GBお得+スマホ2GB";
							if ($_SESSION["packet"] <= 17){
								$softbank_new += 11000;
							} else{
								$softbank_new += 11000+1000*(ceil($_SESSION["packet"])-17);
							}
							
						} elseif(20 < $_SESSION["packet"] && $_SESSION["packet"] <= 27){
							$sn_pakeho = "定額20GB";
							$sn_service="家族でお得+スマホ2GB";
							if ($_SESSION["packet"] <= 22){
								$softbank_new += 14000;
							} else{
								$softbank_new += 14000+1000*(ceil($_SESSION["packet"])-22);
							}
							
						} else {
							$sn_pakeho = "定額30GB";
							$sn_service = "家族でお得+スマホ2GB";
							if ($_SESSION["packet"]<= 32){
								$softbank_new += 19500;
							} else{
								$softbank_new += 19500+1000*(ceil($_SESSION["packet"])-32);
							}
						}
						break;
						
					case "iphone":#nyi
						if ($_SESSION["packet"] <= 4){
							$sn_pakeho = "定額2GB";
							$sn_service="iphoneお得";
							if ($_SESSION["packet"] <= 3){
								$softbank_new += 3500;
							} else{
								$softbank_new += 4500;
							}
						
						} elseif(4 < $_SESSION["packet"] && $_SESSION["packet"] <= 9){
							$sn_pakeho = "定額5GB";
							$sn_service="家族でお得+iphoneお得";
							if ($_SESSION["packet"] <= 6){
								$softbank_new += 4500;
							} else{
								$softbank_new += 4500+1000*(ceil($_SESSION["packet"])-6);
							}
							
						} elseif(9 < $_SESSION["packet"] && $_SESSION["packet"] <= 13){
							$sn_pakeho = "定額10GB";
							$sn_service="iphoneボナス";
							$softbank_new += 8000+1000*(ceil($_SESSION["packet"])-11);
							
						} elseif(14 < $_SESSION["packet"] && $_SESSION["packet"] <= 19){
							$sn_pakeho = "定額15GB";
							$sn_service="家族でお得+iphoneボナス";
							if ($_SESSION["packet"] <= 16){
								$softbank_new += 11000;
							} else{
								$softbank_new += 11000+1000*(ceil($_SESSION["packet"])-16);
							}
							
						} elseif(19 < $_SESSION["packet"] && $_SESSION["packet"] <= 26){
							$sn_pakeho = "定額20GB";
							$sn_service="家族でお得+iphoneボナス";
							if ($_SESSION["packet"] <= 21){
								$softbank_new += 14000;
							} else{
								$softbank_new += 14000+1000*(ceil($_SESSION["packet"])-21);
							}
							
						} else {
							$sn_pakeho = "定額30GB";
							$sn_service="家族でお得+iphoneボナス";
							if ($_SESSION["packet"]<= "31"){
								$softbank_new += 19500;
							} else{
								$softbank_new += 19500+1000*(ceil($_SESSION["packet"])-31);
							}
						}
						break;
				}
			} else{
				switch ($_SESSION["kisyu"]){
					case "doredemo":
						#not excist
						break;
						
					case "sumaho":#nns
						if ($_SESSION["packet"] <= 3){
							$sn_pakeho = "定額2GB";
							$sn_service="スマホ2GB";
							if ($_SESSION["packet"] <= 2){
								$softbank_new += 3500;
							} else{
								$softbank_new += 4500;
							}
					
						} elseif(3 < $_SESSION["packet"] && $_SESSION["packet"] <= 10){
							$sn_pakeho = "定額5GB";
							$sn_service="スマホ2GB";
							if ($_SESSION["packet"] <= 7){
								$softbank_new += 5000;
							} else{
								$softbank_new += 5000+1000*(ceil($_SESSION["packet"])-7);
							}
							
						} elseif(10 < $_SESSION["packet"] && $_SESSION["packet"] <= 16){
							$sn_pakeho = "定額10GB";
							$sn_service="ボナス2GB+10GBお得";
							if ($_SESSION["packet"] <= 12){
								$softbank_new += 8000;
							} else{
								$softbank_new += 8000+1000*(ceil($_SESSION["packet"])-12);
							}
							
						} elseif(16 < $_SESSION["packet"] && $_SESSION["packet"] <= 20){
							$sn_pakeho = "定額15GB";
							$sn_service="スマホ2GB";
							$softbank_new += 12500+1000*(ceil($_SESSION["packet"])-17);
							
						} elseif(20 < $_SESSION["packet"] && $_SESSION["packet"] <= 28){
							$sn_pakeho = "定額20GB";
							$sn_service="スマホ2GB";
							if ($_SESSION["packet"] <= 22){
								$softbank_new += 16000;
							} else{
								$softbank_new += 16000+1000*(ceil($_SESSION["packet"])-22);
							}
							
						} else {
							$sn_pakeho = "定額30GB";
							$sn_service = "家族でお得+スマホ2GB";
							if ($_SESSION["packet"]<= 32){
								$softbank_new += 22500;
							} else{
								$softbank_new += 22500+1000*(ceil($_SESSION["packet"])-32);
							}
						}
						break;
					
					case "iphone":#nni
						if ($_SESSION["packet"] <= 4){
							$sn_pakeho = "定額2GB";
							$sn_service="iphoneボナス";
							if ($_SESSION["packet"] <= 3){
								$softbank_new += 3500;
							} else{
								$softbank_new += 4500;
							}
					
						} elseif(4 < $_SESSION["packet"] && $_SESSION["packet"] <= 9){
							$sn_pakeho = "定額5GB";
							$sn_service="iphoneボナス";
							if ($_SESSION["packet"] <= 6){
								$softbank_new += 4500;
							} else{
								$softbank_new += 4500+1000*(ceil($_SESSION["packet"])-6);
							}
							
						} elseif(9 < $_SESSION["packet"] && $_SESSION["packet"] <= 15){
							$sn_pakeho = "定額10GB";
							$sn_service="iphoneボナス+10GBお得";
							$softbank_new += 8000+1000*(ceil($_SESSION["packet"])-11);
							
						} elseif(16 < $_SESSION["packet"] && $_SESSION["packet"] <= 19){
							$sn_pakeho = "定額15GB";
							$sn_service="家族でお得+iphoneボナス";
							if ($_SESSION["packet"] <= 16){
								$softbank_new += 12500;
							} else{
								$softbank_new += 12500+1000*(ceil($_SESSION["packet"])-16);
							}
						
						} elseif(19 < $_SESSION["packet"] && $_SESSION["packet"] <= 27){
							$sn_pakeho = "定額20GB";
							$sn_service="家族でお得+iphoneボナス";
							if ($_SESSION["packet"] <= 21){
								$softbank_new += 16000;
							} else{
								$softbank_new += 16000+1000*(ceil($_SESSION["packet"])-21);
							}
							
						} else {
							$sn_pakeho = "定額30GB";
							$sn_service="家族でお得+iphoneボナス";
							if ($_SESSION["packet"]<= "31"){
								$softbank_new += 22500;
							} else{
								$softbank_new += 22500+1000*(ceil($_SESSION["packet"])-31);
							}
						}
						break;
				}
			}
		}
	} else{
	#ソフバンのガラケ
		$sn_plan = "基本使用料";
		$softbank_new = 2200 + 300;
		if ($_SESSION["packet"] < 0.005215){		#5.3MBです
			$softbank_new+= 0.08*$_SESSION["packet"];
			$sn_pakeho="定額パックなし";
			$sn_service="特殊な割引なし";
		}else {
			$softbank_new += 3500;
			$sn_pakeho="3Gケータイ";
			$sn_service="特殊な割引なし";
		}
	}
	
	
	#ここからauの新体系
	#auのスマホ
	if($_SESSION["kisyu"] == "sumaho" or $_SESSION["kisyu"] =="iphone"){
		$au_new = 2700+300;
		if($_SESSION["kaisen"] == "au_kaisen"){
			$au_service = "スマートバリュー";
			if ($_SESSION["packet"] <= 3){
				$au_new -= 934;
			} else{
				$au_new -= 1410;
			}
		}
		
		if ($_SESSION["packet"] <= 2){
			$aun_pakeho = "定額2GB";
			$au_new += 3500;
			
		} elseif(2 < $_SESSION["packet"] && $_SESSION["packet"] <= 3){
			$aun_pakeho = "定額3GB";
				$au_new += 4200;
			
		} elseif(3 < $_SESSION["packet"] && $_SESSION["packet"] <= 6){
			$aun_pakeho = "定額5GB";
			if($_SESSION["packet"]==6){
				$au_new += 6000;
			} else{
				$au_new += 5000;
			}
			
		} elseif(6 < $_SESSION["packet"] && $_SESSION["packet"] <= 9){
			$aun_pakeho = "定額8GB";
				if($_SESSION["packet"]==9){
					$au_new += 7800;
				} else{
					$au_new += 6800;
				}
		} elseif(9 < $_SESSION["packet"] && $_SESSION["packet"] <= 11){
			$aun_pakeho = "定額10GB";
				if($_SESSION["packet"]==11){
					$au_new += 9000;
				} else{
					$au_new += 8000;
				}
		} else {
			$aun_pakeho = "定額13GB";
			$au_new += 9800;
		}
	}else {
	#auのガラケ
		$au_new = 2200+300;
		if ($_SESSION["packet"] == 0){
			$au_new -= 300;
			$aun_pakeho = なし;
			
		
		}else if ($_SESSION["packet"] != 0 && $_SESSION["packet"] < 0.005215){
			$aun_pakeho = なし;
		
		}else{
			$au_new += 3500;
			$aun_pakeho = "データ料定額サービス";
			
			if($_SESSION["kaisen"]== "au_kaisen"){
				$au_new -= 934;
				$au_service = "スマートバリュー";
			}
		}
		
	}
	
	#パケットを元に戻す。
	$_SESSION["packet"] = $_SESSION["packet"]*8388608;
	
		if($docomo_ryoukin >= $docomo_new){
			$docomo_ryoukin = $docomo_new;
			$d_plan = $dn_plan;
			$d_service = $dn_service;
			}
		
		if($softbank_ryoukin >= $softbank_new){
			$softbank_ryoukin = $softbank_new;
			$s_plan = $sn_plan;
			$s_pakeho = $sn_pakeho;
			$s_service= $sn_service;
			}
		
		if($au_ryoukin >= $au_new){
			$au_ryoukin = $au_new;
			$au_plan = 電話カケ放題プラン;#これしかないからOK
		}
	
		
		$_SESSION["docomo_ryoukin"]=ceil($docomo_ryoukin);
		$_SESSION["au_ryoukin"]=ceil($au_ryoukin);
		$_SESSION["softbank_ryoukin"]=ceil($softbank_ryoukin);
		$_SESSION["d_plan"]=$d_plan;
		$_SESSION["d_pakeho"]=$d_pakeho;
		$_SESSION["a_plan"]=$a_plan;
		$_SESSION["a_pakeho"]=$a_pakeho;
		$_SESSION["s_plan"]=$s_plan;
		$_SESSION["s_pakeho"]=$s_pakeho;
		
		
		if( $d_service == FALSE ){
			$d_service = "なし";
		}
		if($a_service == FALSE ){
			$a_service = "なし";
		}
		if($s_service == FALSE ){
			$s_service = "なし";
		}
		
		$_SESSION["d_service"]=$d_service;
		$_SESSION["a_service"]=$a_service;
		$_SESSION["s_service"]=$s_service;
		
		/*最後に外そう
		switch($_SESSION["kyaria"]){
			case "docomo":
				$_SESSION["kyaria"]="docomo";
				break;
			
			case "au":
				$_SESSION["kyaria"]="au";
				break;
		
			case "softbank":
				$_SESSION["kyaria"]="softbank";
				break;
		}
		switch($_SESSION["kisyu"]){
			case "sumaho":
				$_SESSION["kisyu"]="スマホ";
				break;
			
			case "iphone":
				$_SESSION["kisyu"]="iPhone";
				break;
			
			default:
				$_SESSION["kisyu"]="ガラケー";
				break;
		}
		switch($_SESSION["kaisen"]){
			case "au_kaisen":
				$_SESSION["kaisen"]="auの提携回線";
				break;
			
			case "softbank_kaisen":
				$_SESSION["kaisen"]="softbankの提携回線";
				break;
			default:
				$_SESSION["kaisen"]="なし";
				break;
		}
		*/
		
		$this->load->view("header",$data);
		if($_SESSION["U25"]==FALSE or $_SESSION["familyotoku"]==FALSE){
			$this->load->view("extra",$data);
		}else{
			$this->load->view("kekka",$data);
		}
       // $this->load->view("footer",$data);
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

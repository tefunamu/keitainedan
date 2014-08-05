<link rel="stylesheet" href="../../css/welcome.css">
<link href="../../js/pagefile.js" type="text/javascript" />
<div id="wrapper">
   <img src="../../images/hon.gif"  alt= ></br>
   <div id="content_left">
結果</Br>
docomo <?php echo $_SESSION["docomo_ryoukin"]; ?>円</br>
料金プラン：<?php echo $_SESSION["d_plan"]; ?></br>
パケホーダイ：<?php echo $_SESSION["d_pakeho"]; ?></br>
</Br>
au<?php echo $_SESSION["au_ryoukin"]; ?>円</br>
料金プラン：<?php echo $_SESSION["a_plan"]; ?></br>
パケホーダイ：<?php echo $_SESSION["a_pakeho"]; ?></br>
</Br>
softbank<?php echo $_SESSION["softbank_ryoukin"]; ?>円</br>
料金プラン：<?php echo $_SESSION["s_plan"]; ?></br>
パケホーダイ：<?php echo $_SESSION["s_pakeho"]; ?></br>

</Br>
共通</br>
spモード：300円</br>
ユニバーサル料：3円</br>

</div>
<div id="content_right">
入力内容<Br>
	<?php 	switch($_SESSION["kyaria"]){
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
	?>
使用中のキャリア：<?php echo $_SESSION['kyaria']?><Br>
入力した機種：<?php echo $_SESSION['kisyu']; ?><Br>
1ヶ月あたりの通話時間：<?php echo $_SESSION['tuuwazikan'] ?>分<Br>
使用している提携回線、</br>
またはルーター：<?php echo $_SESSION['kaisen']; ?><Br>
入力した通信料：<?php echo $_SESSION['packet']/1024/1024*128; ?>MB<Br>
<!--入力した学生：<?php echo $_SESSION['gakusei']; ?><Br>-->
</Br></Br>
<a href="<?php echo base_url("index.php"); ?>">トップへ戻る</a>
</div>
</div>

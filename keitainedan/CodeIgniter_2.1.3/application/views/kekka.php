<link rel="stylesheet" href="../../css/welcome.css">
<link href="../../js/pagefile.js" type="text/javascript" />
<div id="wrapper">
   <img src="../../images/hon.gif"  alt= ></br>
   <div id="content_left">
	結果</Br>
	docomo <?php echo $_SESSION["docomo_ryoukin"]; ?>円</br>
	料金プラン：<?php echo $_SESSION["d_plan"]; ?></br>
	パケホーダイ：<?php echo $_SESSION["d_pakeho"]; ?></br>
	割引サービス：<?php echo $_SESSION["d_service"]; ?></br>
	</Br>
	au<?php echo $_SESSION["au_ryoukin"]; ?>円</br>
	料金プラン：<?php echo $_SESSION["a_plan"]; ?></br>
	パケホーダイ：<?php echo $_SESSION["a_pakeho"]; ?></br>
	割引サービス：<?php echo $_SESSION["a_service"]; ?></br>
	</Br>
	softbank<?php echo $_SESSION["softbank_ryoukin"]; ?>円</br>
	料金プラン：<?php echo $_SESSION["s_plan"]; ?></br>
	パケホーダイ：<?php echo $_SESSION["s_pakeho"]; ?></br>
	割引サービス：<?php echo $_SESSION["s_service"]; ?></br>
	</Br>
	
	

</div>
<div id="content_right">
	入力内容<Br>
	使用中のキャリア：<?php echo $_SESSION['kyaria_true'];?><Br>
	次に予定している機種：<?php echo $_SESSION['kisyu_true']; ?><Br>
	使用している提携回線：<?php echo $_SESSION['kaisen_true']; ?></br>
	またはルーター：<?php echo $_SESSION['ruta_true']; ?><Br>
	1ヶ月あたりの通話時間：<?php echo $_SESSION['tuuwazikan']; ?>分<Br>
	入力した通信料：<?php echo $_SESSION['packet']; ?>GB<Br>
	満26歳まで1年以上残している<?php echo $_SESSION['U25_true']; ?></Br>
	<?php if( $_SESSION['familyotoku'] == "yes"){
	echo "softbankの家族おトク割の条件を満たしている。";
	}?>
	</Br>
	このページを「更新」しないでください。結果に不備が現れます。
	</Br></Br>
	左記料金には共通項目として</br>
	spモード：300円</br>
	ユニバーサル料：3円</br>
	がそれぞれ含まれています。</Br>
	
	<!--
	<form action="extra">
	<input type="submit" value="機種が限定される割引も確認する。">
	</Br>-->
	
	
	</Br>
	<a href="<?php echo base_url("index.php"); ?>">トップへ戻る</a>
	
	</div>
</div>

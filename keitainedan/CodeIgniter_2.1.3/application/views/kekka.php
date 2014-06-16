<link rel="stylesheet" href="../../css/welcome.css">
<link href="../../js/pagefile.js" type="text/javascript" />
<div id="wrapper">
   <img src="../../images/hon.gif"  alt= ></br>
   <div id="content_left">
結果</Br>
docomo <?php echo $_SESSION["docomo_ryoukin"]; ?>円</br>
料金プラン:<?php echo $_SESSION["d_plan"]; ?></br>
パケホーダイ：<?php echo $_SESSION["d_pakeho"]; ?></br>

au<?php echo $_SESSION["au_ryoukin"]; ?>円</br>
料金プラン：<?php echo $_SESSION["a_plan"]; ?></br>
パケホーダイ：<?php echo $_SESSION["a_pakeho"]; ?></br>

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
入力したキャリアは<?php echo $_SESSION['kyaria']?><Br>
入力した通話時間は<?php echo $_SESSION['tuuwazikan'] ?>分<Br>
入力した提携回線、</br>
またはルーターは<?php echo $_SESSION['kaisen']; ?><Br>
入力した機種は<?php echo $_SESSION['kisyu']; ?><Br>
入力した通信料は<?php echo $_SESSION['packet']/1000000*128; ?>MB<Br>
入力した学生は<?php echo $_SESSION['gakusei']; ?><Br>

<a href="<?php echo base_url("index.php"); ?>">トップ</a>
</div>
</div>

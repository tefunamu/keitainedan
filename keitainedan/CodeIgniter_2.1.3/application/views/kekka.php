<link rel="stylesheet" href="../../css/welcome.css">
<link href="../../js/pagefile.js" type="text/javascript" />
<img src="../../images/book.png" alt=""></br>
結果
<Br><Br><Br><Br><Br><Br><Br><Br><Br><Br><Br><Br>
docomo<?php echo $_SESSION["docomo_ryoukin"]; ?>円</br>
au<?php echo $_SESSION["au_ryoukin"]; ?>円</br>
softbank<?php echo $_SESSION["softbank_ryoukin"]; ?>円</br>

入力内容<Br>
入力したキャリアは<?php echo $_SESSION['kyaria']?><Br>
入力した通話時間は<?php echo $_SESSION['tuuwazikan'] ?><Br>
入力した提携回線、またはルーターは<?php echo $_SESSION['kaisen']; ?><Br>
入力した機種は<?php echo $_SESSION['kisyu']; ?><Br>
入力したパケット数は<?php echo $_SESSION['packet']; ?><Br>
入力した学生は<?php echo $_SESSION['gakusei']; ?><Br>

<a href="<?php echo base_url("index.php"); ?>">トップ</a>


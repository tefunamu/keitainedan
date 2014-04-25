<link rel="stylesheet" href="../../css/welcome.css">
<link href="../../js/pagefile.js" type="text/javascript" />
<img src="../../images/book.png" alt=""></br>
結果
docomo<?php echo $_SESSION['docomo_ryokin']; ?>円</br>
au<?php echo $_SESSION['au_ryokin']; ?>円</br>
softbank<?php echo $_SESSION['softbank_ryokin']; ?>円</br>

入力内容<Br>
<?php echo $_SESSION['kyaria']; ?><Br>
<?php echo $_SESSION['tuuwazikan'] ?><Br>
<?php echo $_SESSION['kaisen']; ?><Br>
<?php echo $_SESSION['kisyu']; ?><Br>
<?php echo $_SESSION['ruta']; ?><Br>
<?php echo $_SESSION['packet']; ?><Br>
<?php echo $_SESSION['gakusei']; ?><Br>

<a href="<?php echo base_url("index.php"); ?>">トップ</a>


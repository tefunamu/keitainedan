<!DOCTYPE html>
<html>
 <head>
 <meta charset="utf-8">
 <!--[if lt IE 9]>
    <![endif]-->
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<?php /*echo $stylesheet*/ ?>
 <meta http-equiv="Content-Type" content="text/html">
<link rel="stylesheet" href="<?php echo base_url("css/welcome.css"); ?>">	
<title><?php echo $page_title; ?></title>
 </head>
 
 <style>
	header{
		background-image:url("<?php echo base_url("images/title.gif"); ?>");
		/*height:80px;*/
	}
</style>
 
 <body>
	 <header id="header-menu">
	 <nav>
		 <a href="<?php echo base_url("index.php"); ?>"><img src = "<?php echo base_url("images/logo.gif"); ?>" alt="モバイル料金ラボ" align="left"></a>

		<a href="<?php echo base_url(""); ?>"><img src = "<?php echo base_url("images/access.gif"); ?>" alt="お問い合わせ" align="left"></a>
		<img src = "<?php echo base_url("images/author.gif"); ?>" alt="profile" align="right">
	</nav>
	</header>
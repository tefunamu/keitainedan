<!DOCTYPE html>
<html>
 <head>
 <meta charset="utf-8">
 <!--[if lt IE 9]>
    <![endif]-->
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<?php /*echo $stylesheet*/ ?>
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
	 
	 <header id="header-image">
	 <nav>
		 <a href="<?php echo base_url("index.php"); ?>"><img src = "<?php echo base_url("images/logo.gif"); ?>" alt="モバイル料金ラボ" align="left"></a>
		 <a href="<?php echo base_url("index.php"); ?>"><img src = "<?php echo base_url("images/about.gif"); ?>" alt="about" align="left"></a>
		 <a href="<?php echo base_url("index.php"); ?>"><img src = "<?php echo base_url("images/Q&A.gif"); ?>" alt="Q&A" align="left"></a>
		<div id="access">
		<a href="<?php echo base_url(""); ?>"><img src = "<?php echo base_url("images/access.gif"); ?>" alt="お問い合わせ" align="left"></a>
		</div>
		<div id="profile">
		<img src = "<?php echo base_url("images/author.gif"); ?>" alt="profile" align="">
	</nav>
	</header>
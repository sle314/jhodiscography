<?php 
session_start();
if (isset($_REQUEST['desktop']))
	$_SESSION['desktop'] = true;
if (!isset($_SESSION['desktop']))
	include "detectmobilebrowser.php";
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:fb="http://ogp.me/ns/fb#">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Josh Homme Discography - Kyuss, Queens of the Stone Age, Desert Sessions, Eagles of Death Metal, Them Crooked Vultures</title>
<meta name="audience" content="all">
<meta name="author" content="sle314">
<meta name="description" content="Joshua Homme Discography - Kyuss, QotSA, Desert Sessions, EoDM, Them Crooked Vultures">
<meta name="keywords" content="Joshua Homme discography, Queens of the Stone Age discography, Queens of the Stone Age, Eagles of Death Metal, Eagles of Death Metal discography,
Them Crooked Vultures, Them Crooked Vultures discography, Kyuss, Kyuss discography, Desert Sessions discography, Joshua Homme, Josh Homme, QotSA, EoDM, Desert Sessions, discography, Vinyl, cds, vinyl discography, cd discography">
<meta name="wot-verification" content="cf3813488bd4b4d5c3e9"/> 
<link rel="stylesheet" href="/assets/css/blueprint/screen.css" type="text/css" media="screen, projection">
<link rel="stylesheet" href="/assets/css/blueprint/print.css" type="text/css" media="print">	
<!--[if lt IE 8]><link rel="stylesheet" href="/assets/css/blueprint/ie.css" type="text/css" media="screen, projection"><![endif]-->
<link href="/assets/css/style.css" rel="stylesheet" type="text/css" />
<link href="/assets/css/main.css" rel="stylesheet" type="text/css" />
<script src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="/assets/scripts/ga.js">
</script>
<meta name="google-site-verification" content="JAI7V3736tvvPJwJiHjNB_PFGEpXRCShmbTooNWpu5A" />
<link rel="shortcut icon" href="/favicon.ico">
<link rel="icon" type="image/gif" href="/animated_favicon1.gif">
<link rel='alternate' type='application/rss+xml' title='Joshua Homme discography' href='http://jhodiscography.xtreemhost.com/rss/qotsa.xml' />
<meta property="og:title" content="Joshua Homme discography" />
	<meta property="og:type" content="musician" />
	<meta property="og:url" content="http://jhodiscography.xtreemhost.com/" />
	<meta property="og:image" content="http://jhodiscography.xtreemhost.com/assets/images/logo.jpg" />
	<meta property="og:site_name" content="Joshua Homme discography" />
	<meta property="og:description" content="Joshua Homme Discography - Kyuss, QotSA, Desert Sessions, EoDM, Them Crooked Vultures" />
	<meta property="fb:admins" content="17164788" />
</head>
<body>
	<div id="fb-root"></div>
	<script>(function(d, s, id) {
	  var js, fjs = d.getElementsByTagName(s)[0];
	  if (d.getElementById(id)) return;
	  js = d.createElement(s); js.id = id;
	  js.src = "//connect.facebook.net/hr_HR/all.js#xfbml=1";
	  fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));</script>
	<div class="container">		
		<div id="header1" class="span-24">			
			<div id="title" class="span-24 style5">				
				<h1>Joshua Homme Discography</h1>				
			</div>
		</div>
		<div id="body" class="span-24">
			<div id="main" class="style7 span-24">
				<div class="mainText span-24">
					<div class="span-4 kyuss border">
						<h2>Kyuss</h2>
					</div>
					<div class="span-4 border">
						<h2>The<br /><br />
						Desert<br /><br />
						Sessions</h2>
					</div>
					<div class="span-4 border">
						<h2>Queens<br /><br />
						of the<br /><br />
						Stone Age</h2>
					</div>
					<div class="span-4 border">
						<h2>Eagles<br /><br />
						of<br /><br />
						Death Metal</h2>
					</div>
					<div class="span-4 border">
						<h2>Them<br /><br />
						Crooked<br /><br />
						Vultures</h2>
					</div>
					<div class="span-4 kyuss last">
						<h2>Other</h2>
					</div>
				</div>
			</div>
			<div id="bottom" class="span-24"> <img src="/assets/images/backgrounds/2.jpg" alt="rounded border" width="20" height="20"/></div>
			<div class="mainText class2 span-24">
					<div class="span-4 kyuss border">
						<span class="nav"><a href="/releases/kyuss/cd">CDs</a></span>
						<span class="nav last"><a href="/releases/kyuss/vinyl">Vinyl</a></span>
					</div>
					<div class="span-4 border">
						<span class="nav"><a href="/releases/ds/cd">CDs</a></span>
						<span class="nav last"><a href="/releases/ds/vinyl">Vinyl</a></span>
					</div>
					<div class="span-4 border">
						<span class="nav"><a href="/releases/qotsa/cd">CDs</a></span>
						<span class="nav last"><a href="/releases/qotsa/vinyl">Vinyl</a></span>
					</div>
					<div class="span-4 border">
						<span class="nav"><a href="/releases/eodm/cd">CDs</a></span>
						<span class="nav last"><a href="/releases/eodm/vinyl">Vinyl</a></span>
					</div>
					<div class="span-4 border">
						<span class="nav"><a href="/releases/tcv/cd">CDs</a></span>
						<span class="nav last"><a href="/releases/tcv/vinyl">Vinyl</a></span>
					</div>
					<div class="span-4 last">
						<span class="nav"><a href="/releases/other/cd">CDs</a></span>
						<span class="nav last"><a href="/releases/other/vinyl">Vinyl</a></span>
					</div>
			</div>	
			<div class="span-24 new">
				<?php include "newest.php" ?>
			</div>
			<div class="span-24 other">
				<a href="/other">Click here for some Other Stuff</a>
			</div>			
		</div>
		<div id="footer" class="span-24 style2">
			<div><a href="/mobile/">mobile version</a></div>
			<span>have</span> or/and <span>need</span> something? <span class="turqo">&#8595;&#8595;&#8595;</span><br/>
			...copyright 2012. - <a href="mailto:sle3.14@gmail.com">sle3.14[at]gmail.com</a>...
			<div class="social">
				<a href="rss" target="_blank" class="top"><img title="subscribe" alt="subscribe" src="/assets/images/rss.jpg" width="25" height="25"/></a>
				<fb:like class="fb-like" send="false" width="130" href="http://jhodiscography.xtreemhost.com/" layout="button_count" show_faces="false" font="trebuchet ms"></fb:like>				
				<a href="https://twitter.com/jhodiscography" target="_blank" class="top"><img title="twitter" alt="twitter" src="/assets/images/twitter.jpg" width="25" height="25"/></a>
				<a href="https://twitter.com/jhodiscography" class="twitter-follow-button twitter-follow-button-custom" data-show-count="false" data-show-screen-name="false">Follow @jhodiscography</a>
				<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
				<a href="https://twitter.com/share" class="twitter-share-button" data-via="jhodiscography" data-related="jhodiscography">Tweet</a>
				<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
			</div>			
		</div>
	</div>
	<script>
		$(document).ready(function(){
			$("#newest").hide();			
			$("#newest_link a").toggle(
				function(){
					$("#newest").slideToggle(500);
				},
				function(){
					$("#newest").slideToggle(500);
			});
		});
	</script>
</body>
</html>
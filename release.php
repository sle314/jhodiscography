<?php
	session_start();
	if (isset($_REQUEST['desktop'])){
		$_SESSION['desktop'] = true;
	}
	include 'mysql.php';
	include 'functions.php';
	$db = new JHoDisc();
	$db->connect();
	$url = "";
	if ($_REQUEST['id'] && is_numeric($_REQUEST['id'])){
		$db->setVars(null,null,null,$_REQUEST['id']);
		$vars = $db->getVars();
		if ($vars['band'] != $_REQUEST['band'] || $vars['format'] != $_REQUEST['format'] || $vars['type'] != $_REQUEST['type']){
			header("Location: /error.php");
		}
		$url = "releases/".$vars['band']."/".$vars['format']."/".$vars['type']."/".$vars['id']."/".$_REQUEST['show'];
	}
	else{
		$db->setVars($_REQUEST['band'], $_REQUEST['format'], null, null);
		$vars = $db->getVars();
		if (isset($_REQUEST['type'])){
			$url = "releases/";
		}
		$url .= $vars['band']."/".$vars['format']."/".$_REQUEST['type'];
	}	
	if (!isset($_SESSION['desktop'])){
		$useragent=$_SERVER['HTTP_USER_AGENT'];
		if(preg_match('/android.+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|meego.+mobile|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(di|rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4)))
		{
			$_SESSION['mobile'] = true;
			header("Location: /mobile/$url");
		}
	}
	$title = $db->getTitle()." - ".$db->getReleasename()." - ".$db->getFormatName();	
	
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:fb="http://ogp.me/ns/fb#">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="description" content="Joshua Homme Discography - Kyuss, QotSA, Desert Sessions, EoDM, Them Crooked Vultures">
<title>
<?php
	echo $title;
?>
</title>
<link rel="stylesheet" href="/assets/css/blueprint/screen.css" type="text/css" media="screen, projection">
<link rel="stylesheet" href="/assets/css/blueprint/print.css" type="text/css" media="print">	
<!--[if lt IE 8]><link rel="stylesheet" href="assets/css/blueprint/ie.css" type="text/css" media="screen, projection"><![endif]-->
<link href="/assets/css/style.css" rel="stylesheet" type="text/css" />
<link href="/assets/css/release.css" rel="stylesheet" type="text/css" />
<link rel="shortcut icon" href="/favicon.ico">
<link rel="icon" type="image/gif" href="/animated_favicon1.gif">
<script src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="/assets/scripts/ga.js">
</script>
<link rel='alternate' type='application/rss+xml' title='Joshua Homme discography' href='http://jhodiscography.xtreemhost.com/rss/qotsa.xml' />
<meta property="og:title" content="<?php echo $title; ?>" />
	<meta property="og:type" content="musician" />
	<meta property="og:url" content="http://<?php echo $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"] ?>" />
	<?php if($_REQUEST["id"]){
	?>
	<meta property="og:image" content="http://jhodiscography.xtreemhost.com/assets/images/releases/<?php echo $vars["band"]."/".$vars["format"]."/".$vars["type"]."/".$vars["id"]."/".$vars["id2"];?>/1.jpg" />
	<?php
	}
	else{
	?>
	<meta property="og:image" content="http://jhodiscography.xtreemhost.com/assets/images/logo.jpg" />
	<?php
	}
	?>	
	<meta property="og:site_name" content="Joshua Homme discography" />
	<meta property="og:description" content="<?php echo $title; ?>" />
	<meta property="fb:admins" content="17164788" />
<style>
	#nr<?php echo $vars['id'] ?>{
		color: #fff;
	}
	.<?php echo $vars["band"]?>-navi {
		display: none;
	}
</style>
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
	<a name="top"></a>
	<div class="container">
		<div id="header1" class="span-24 class1">			
			<div id="title" class="span-24 style5 style5a">
				<h1>
					<a href="/index.php">
						<span class="title-top">
							<?php
								echo $db->getTitle()." ".$db->getFormatName();
							?>
						</span>
						<br />
						<span class="title-bottom">
							<?php 
								echo $db->getReleaseName();
							?>
						</span>
					</a>
				</h1>
			</div>
			<div id="border" class="span-24 class1">
				<?php include "release/topNavi.php"; ?>
			</div>
		</div>
		<div id="body1" class="span-24">
			<div class="releases span-24">
				<?php include "release/relList.php"; ?>
			</div>
			<div id="data-container" class="span-24">
				<a name="rel"></a>
				<?php include "release/relData.php"; ?>
			</div>
		</div>
		<div id="footer" class="span-24 style2">	
			<div><a href="/mobile/<?php echo $url ?>">mobile version</a></div>
			<span>have</span> or/and <span>need</span> something? <span class="turqo">&#8595;&#8595;&#8595;</span><br/>
			...copyright 2012. - <a href="mailto:sle3.14@gmail.com">sle3.14[at]gmail.com</a>...		
			<div class="social">
				<a href="/rss" target="_blank" class="top"><img title="subscribe" alt="subscribe" src="/assets/images/rss.jpg" width="25" height="25"/></a>
				<fb:like class="fb-like" send="false" width="130" layout="button_count" show_faces="false" font="trebuchet ms"></fb:like>				
				<a href="https://twitter.com/jhodiscography" target="_blank" class="top"><img title="twitter" alt="twitter" src="/assets/images/twitter.jpg" width="25" height="25"/></a>
				<a href="https://twitter.com/jhodiscography" class="twitter-follow-button twitter-follow-button-custom" data-show-count="false" data-show-screen-name="false">Follow @jhodiscography</a>
				<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
				<a href="https://twitter.com/share" class="twitter-share-button" data-via="jhodiscography" data-related="jhodiscography">Tweet</a>
				<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
			</div>			
		</div>	
	</div>
	<?php include "assets/scripts/release.php" ?>
</body>
</html>
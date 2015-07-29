<?php 
include '../mysql.php';
	include '../functions.php';
	$db = new JHoDisc();
	$db->connect();

	$db->setVars($_REQUEST['band'], $_REQUEST['format'], $_REQUEST['type'], null);

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="https://ajax.aspnetcdn.com/ajax/jquery.mobile/1.1.1/jquery.mobile-1.1.1.min.css" />
    <link rel="stylesheet" href="/mobile/style.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js">
    </script>
    <script src="https://ajax.aspnetcdn.com/ajax/jquery.mobile/1.1.1/jquery.mobile-1.1.1.min.js">
    </script>
	<script>$.mobile.pushStateEnabled = false;</script>
	<title>
		<?php echo $db->getTitle()." Discography - ".$db->getReleaseType()." ".$db->getFormatName(); ?>
	</title>
	<script type="text/javascript" src="/assets/scripts/ga.js"></script>
	<link rel='alternate' type='application/rss+xml' title='Joshua Homme discography' href='http://jhodiscography.xtreemhost.com/rss/qotsa.xml' />
</head>
<body>
<div data-role="page" id="page1">
	<div data-role="header" class="header" data-theme="a">
		<a rel="external" href="/mobile/<?php echo $_REQUEST['band']."/".$_REQUEST['format']."/".$_REQUEST['type']; ?>" data-icon="home" data-iconpos="notext">Back</a>
		<h1><?php echo $db->bandShortNames[$_GET['band']]." - ".$db->getReleaseType()." ".$db->getFormatName() ?></h1>
		<a rel="external" style="top:5px;" href="/mobile/releases/<?php echo $_REQUEST['band']."/".$db->getOppFormat()."/".$_REQUEST['type']; ?>"><?php echo $db->getOppFormatName() ?></a>
	</div>
	<div data-role="content" id="container">

<?php
if (($result = $db->getReleases($_REQUEST['type'])) != null){
?>
	<ul data-role="listview" data-inset="true" data-theme="e" class="list">
<?php
	foreach ($result as $item){
	?>		
		
		<li>
			<a name="n<?php echo $item['id'] ?>" rel="external" class="<?php echo $item['class']; ?>" id="n<?php echo $item['id']; ?>" href="/mobile/releases/<?php echo $_GET['band']?>/<?php echo $_GET['format']?>/<?php echo $_GET['type']?>/<?php echo $item['id']; ?>">
				<?php echo $item['name']; ?>
			</a>
		</li>
	<?php		
	}
	?>
	</ul>
	<div class="rel desktop"><a data-inline="true" data-role="button" class="deskLink" rel="external" href="/desktop/releases/<?php echo $_REQUEST['band']."/".$_REQUEST['format']."/".$_REQUEST['type'] ?>">desktop version</a></div>
<?php
}
else{
?>
	<div style="text-align: center; margin-top: 30px;">None</div>
<?php 
}									
?>
</div>
</div>
</body>
</html>
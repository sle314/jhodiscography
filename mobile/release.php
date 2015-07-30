<?php
include '../mysql.php';
include '../functions.php';
$db = new JHoDisc();
$db->connect();

$db->setVars(null,null,null,$_GET['id']);
$vars = $db->getvars();
$db->setOppId();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="https://ajax.aspnetcdn.com/ajax/jquery.mobile/1.1.1/jquery.mobile-1.1.1.min.css" />
    <link rel="stylesheet" href="/mobile/style.css" />
    <link rel="stylesheet" href="/mobile/photoswipe/photoswipe.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
    <script src="https://ajax.aspnetcdn.com/ajax/jquery.mobile/1.1.1/jquery.mobile-1.1.1.min.js"></script>
	<script type="text/javascript" src="/mobile/photoswipe/lib/klass.min.js"></script>
	<script type="text/javascript" src="/mobile/photoswipe/code.photoswipe.jquery-3.0.5.min.js"></script>
	<script>$.mobile.pushStateEnabled = false;</script>
	<title>
		<?php echo $db->bandShortNames[$vars['band']]." - ".$db->getReleaseName()." - ".$db->getFormatName()." ".$db->getReleaseType()." - ".$db->getTitle()." Discography"; ?>
	</title>
	<script type="text/javascript" src="/assets/scripts/ga.js"></script>
	<link rel='alternate' type='application/rss+xml' title='Joshua Homme discography' href='http://jhodiscography.xtreemhost.com/rss/qotsa.xml' />
</head>
<body>
<div data-role="page" id="release">
	<div data-role="header" class="header headerRelease">
		<a class="ui-btn-left" rel="external" style="top:15px;" href="/mobile/releases/<?php echo $vars['band'] ?>/<?php echo $vars['format'] ?>/<?php echo $vars['type'] ?>#n<?php echo $vars['id']?>" data-inline="true" data-icon="back" data-iconpos="notext"></a>
		<a class="ui-btn-left" rel="external" style="top:15px;left: 35px;" href="/mobile/<?php echo $vars['band']."/".$vars['format']."/".$vars['type'] ?>" data-icon="home" data-inline="true" data-iconpos="notext">Back</a>
		<h1><?php echo $db->bandShortNames[$vars['band']]." ".$db->getReleaseType()." ".$db->getFormatName()."<br/>-<br/>".$db->getReleaseName(); ?></h1>
		<?php
			if ($db->getOppId()){
		?>
				<a class="ui-btn-right" rel="external" style="top:5px;" href="/mobile/releases/<?php echo $_GET['band']?>/<?php echo $db->getOppFormat()?>/<?php echo $_GET['type']?>/<?php echo $db->getOppId() ?>/"><?php echo $db->getOppVersion() ?><br/>version</a>
		<?php
			}
		?>
	</div>
	<div data-role="content" id="container" class="release-cont">
<?php
if ($_REQUEST["id"] && is_numeric($_REQUEST["id"]) && $db->checkId($_REQUEST["id"])){
	if (($result = $db->getInfo()) != null){
	?>
		<!--div data-role="collapsible-set" data-theme="a"-->
		<?php
			foreach($result as $item)
		{
			?>
				<div data-role="collapsible" data-theme="a" class="collapse" id="rel<?php echo $item['id']?>">
					<h3><?php echo ($item['name'] == "" ? "original release" : $item['name'])?></h3>
					<table id="reltable">
					<tr>
					<td class="row" style="width: 27%">
						Year:
					</td>
					<td><?php echo $item['year'] ?></td>
					</tr>
					<tr>
					<td class="row">
						Label:
					</td>
					<td><?php echo $item['label'] ?></td>
					</tr>
					<tr>
					<td class="row">
						<?php
							if ($vars['format'] == 'vinyl') echo "Info:";
							else echo "Barcode:";
						?>
					</td>
					<td><?php echo $item['info']; ?></td>
					</tr>
					<tr>
					<td class="row">
						Matrix:
					</td>
					<td><?php echo $item['matrix'] ; ?></td>
					</tr>
					</table>
					<div class="t-list-wrapper">
						<div id="getTracks" class="<?php echo $item['id']?>">
							<a href="#">tap to load track list</a>
						</div>
					</div>
					<div>
						<div style="display: none;" class="tap-lrg" id="tap-lrg<?php echo $item['id']?>">*tap an image for a larger view</div>
						<div class="getImgs"><a href="#" id="<?php echo $item['id']?>">tap to load images</a></div>
						<div class="pics" style="display: none;">
						</div>
					</div>
				</div>
		<?php
		}
		?>
		<!--/div-->
		<div class="rel desktop"><a data-inline="true" data-role="button" class="deskLink" rel="external" href="/desktop/releases/<?php echo $vars['band']."/".$vars['format']."/".$vars['type']."/".$vars['id']."/".$_REQUEST['show'] ?>">desktop version</a></div>
		<?php
	}
}
?>
	</div>
</div>
<script>
	$(document).bind('pageinit',function(){
		var ajax = function(tries, pics){xhr = $.ajax({
							  type: "POST",
							  url: "/mobile/getImages.php",
							  data: { id: <?php echo $vars['id']?>, id2 : pics.attr("id") },
							  tries : tries,
							  beforeSend : $.mobile.showPageLoadingMsg()
							}).done(function( data ) {
								if (data.indexOf("none") == -1 && data.indexOf("<img") == -1 && this.tries > 0){
									this.tries--;
									ajax(this.tries, pics);
									return;
								}
								if (this.tries > 0){
								  pics.parent().siblings(".pics").html(data).fadeIn(1000);
								}
							}).fail(function(xsr){
								if (this.tries > 0){
									this.tries--;
									ajax(this.tries, pics);
									return;
								}

							}).always(function(){
								if (this.tries <= 0){
									$(".pics").html("can't get images, please refresh the page and try again").fadeIn(1000);
								}
								pics.remove();
								$.mobile.hidePageLoadingMsg();
								$("#tap-lrg"+pics.attr("id")).show()
							});}
		$(".getImgs a").unbind("click").click(function(){
				ajax(5,$(this));
		});

		var ajaxTracks = function(tries, tracks){xhr = $.ajax({
							  type: "POST",
							  url: "/mobile/getTracks.php",
							  data: { id: <?php echo $vars['id']?>, id2 : tracks.attr("class") },
							  tries : tries,
							  beforeSend : $.mobile.showPageLoadingMsg()
							}).done(function( data ) {
								if (data.indexOf("same") == -1 && data.indexOf("unavailable") == -1 && data.indexOf("t-list-inner") == -1 && this.tries > 0){
									this.tries--;
									ajaxTracks(this.tries, tracks);
									return;
								}
								if (this.tries > 0){
								  tracks.html(data).fadeIn(1000);
								}
							}).fail(function(xsr){
								if (this.tries > 0){
									this.tries--;
									ajaxTracks(this.tries, tracks);
									return;
								}

							}).always(function(){
								if (this.tries <= 0){
									tracks.html("can't get tracks, please refresh the page and try again").fadeIn(1000);
								}
								$.mobile.hidePageLoadingMsg();
							});}

		$("#getTracks a").unbind("click").click(function(){
				ajaxTracks(5,$(this).parent());
		});

		var num;
		if ((num = "<?php echo $_REQUEST['show'] ?>")  != null){

			if (num == "all"){
				$(".ui-btn-inner").trigger("click");
			}
			else{
				$("#rel"+num+" .ui-btn-inner").trigger("click");
			}
		}

	});
</script>
</body>
</html>
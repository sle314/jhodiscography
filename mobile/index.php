<?php
	if (!isset($_REQUEST['type']) || $_REQUEST["type"] == "") $_REQUEST['type'] = "lp";
	if (!isset($_REQUEST['format']) || $_REQUEST["format"] == "") $_REQUEST['format'] = "vinyl";
	if (!isset($_REQUEST['band']) || $_REQUEST["band"] == "") $_REQUEST['band'] = "qotsa";
	$url = "";
	if (isset($_REQUEST['band']) && isset($_REQUEST['format'])){
	 $url = "releases/".$_REQUEST['band']."/".$_REQUEST['format']."/";
	}
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
			Josh Homme discography - Kyuss, Queens of the Stone Age, Eagles of Death Metal, Desert Sessions, Them Crooked Vutures
		</title>
		<script type="text/javascript" src="/assets/scripts/ga.js"></script>
		<link rel='alternate' type='application/rss+xml' title='Joshua Homme discography' href='http://jhodiscography.xtreemhost.com/rss/qotsa.xml' />
    </head>
    <body>
        <!-- Home -->
        <div data-role="page" id="page1">			
				<div data-role="content" id="container">
					<form data-ajax="false" method="GET" action="/mobile/releases">
						<div data-role="fieldcontain" class="field">
							<select class="band" name="band" id="selectmenu1" data-theme="a">
								<option id="q" value="qotsa">
									Queens of the Stone Age
								</option>
								<option id="kyuss" value="kyuss">
									Kyuss
								</option>
								<option id="ds" value="ds">
									Desert Sessions
								</option>
								<option id="eodm" value="eodm">
									Eagles of Death Metal
								</option>
								<option id="tcv" value="tcv">
									Them Crooked Vultures
								</option>
								<option id="other" value="other">
									Other
								</option>
							</select>
						</div>
						<div data-role="fieldcontain" class="field">
							<select class="format" name="format" id="selectmenu2" data-theme="a">
								<option id="vinyl" value="vinyl">
									Vinyl
								</option>
								<option id="cd" value="cd">
									Cd
								</option>                        
							</select>
						</div>
						<div data-role="fieldcontain" class="field">
							<select class="type" name="type" id="selectmenu3" data-theme="a">
								<option id="lp" value="lp">
									Lp
								</option>
								<option id="single" value="single">
									Single
								</option>
								<option id="other-type" value="other">
									Other
								</option>
							</select>
						</div>
						<div data-role="fieldcontain" class="go-button field">
							<input id="formButton" rel="external" data-theme="e" data-icon="check" data-iconpos="right" value="Go" type="submit"/>
						</div>
					</form>
					<?php include "newest.php";?>
					<div class="desktop"><a data-inline="true" data-role="button" class="deskLink" rel="external" href="/desktop/<?php echo $url ?>">desktop version</a></div>
				</div>	
				
        </div>		
		<script>
		$(document).bind('pageinit',function(){	
			
			$("select.band").val("<?php echo $_REQUEST['band'] ?>");
			$("select.format").val("<?php echo $_REQUEST['format'] ?>");
			$("select.type").val("<?php echo $_REQUEST['type'] ?>");
			
			$('select').selectmenu('refresh');
			
			$("#formButton").click(function(){
				location.href="/mobile/releases/"+$("select.band").val()+"/"+$("select.format").val()+"/"+$("select.type").val();
				return false;
			});

		});
		</script>
    </body>
</html>
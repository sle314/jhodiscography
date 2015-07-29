<div class="t-list-title">
	Track list
</div>
<div class="t-list-inner track-list">
<?php
require_once "../mysql.php";

if (is_numeric(intval($_REQUEST['id'])) && is_numeric(intval($_REQUEST['id2']))){
	$db = new Database();
	$db->connect();
	$db->select("`release`", 'band,format,type', 'release.id = '.$_REQUEST['id'], null);
	$name_row = $db->getResult();
	$directory = "../assets/tracks/".$name_row[0]['band']."/".$name_row[0]['format']."/".$name_row[0]['type']."/".$_REQUEST['id']."/".$_REQUEST['id2']."/";
	
	if (file_exists($directory."tracks.xml")){
		$dom = new DOMDocument(); 	
		$dom->preserveWhiteSpace = false;
		$xp = null;
		if(@$dom->load( $directory."tracks.xml" )){
			$xp = new DOMXPath( $dom );
			$query = $xp->query("//side");
			?>
								
			<?php 
			foreach($query as $side){
				
				?><div class="t-list-list"><?php
				
				if ($side->getAttribute("val") != ""){
				?>
					<div class="t-list-header">
						<?php echo $side->getAttribute("val")?>
					</div>
				<?php
				}					

				foreach($side->getElementsByTagName("track") as $track){
					
					
				?>
					<div class="t-list-tracks">					
						<span class='t-list-first-inner'><?php echo $track->getAttribute("n") ?>.&nbsp;</span>
						<span class="t-list-track last"><?php echo $track->nodeValue ?></span>
					</div>
			<?php
				}
			?>
				</div>
			<?php
			}
			?>
	</div>
			<?php
			}
		else echo "unavailable";
	}
	else echo "data not available";
}	
else{
	?>
	<div class="text1 style4 span-24-1">unavailable</div>
	<?php
}
?>
</div>
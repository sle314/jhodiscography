<?php
if ($_REQUEST["id"] && is_numeric($_REQUEST["id"]) && $db->checkId($_REQUEST["id"])){
?>
<div class="data-inner">
<?php
	if (($result = $db->getInfo()) != null){
		$base_dir = 'assets/images/releases/'.$vars["band"].'/'.$vars["format"].'/'.$vars["type"].'/';
		$i = 0;

			foreach($result as $item)
		{
			$i++;
?>
		<div class="all-data other1 span-24" id="rel<?php echo $_REQUEST['id']?>">
			<div class="version style3">
				<h2><a class="outer" id="n<?php echo $item['id']; ?>" href="#" title="click for details">
					<span class="span1">
						<?php echo "#$i" ?>
					</span>
					- <?php echo $item['album']." - ".$item['name'] ?>
				</a></h2>
			</div>
			<div class="hidden data span-24-1">
				<div class="text1 style2 span-24-1">
					<span>Year:&nbsp;</span>
					<?php echo $item['year'] ?>
				</div>
				<div class="text1 style2 span-24-1">
					<span>Released by:&nbsp;</span>
					<?php echo $item['label'] ?>
				</div>
				<div class="text1 style2 span-24-1">
					<span>
						<?php
						if ($vars['format'] == 'vinyl') echo "Info: ";
						else echo "Barcode: ";
						?>
					</span>
					<?php echo $item['info']; ?>
				</div>
				<div class="text1 style2 span-24-1">
					<span>Matrix number:&nbsp;</span>
					<?php echo $item['matrix'] ; ?>
				</div>
				<div class="text1 style4 span-24-1">
					Track List:&nbsp;
				</div>
				<div class="track-list text1 style2 span-24-1">
					<?php
					if (file_exists('assets/tracks/'.$vars["band"].'/'.$vars["format"].'/'.$vars["type"].'/'.$vars["id"].'/'.$item['id']."/tracks.xml")){
						$dom = new DOMDocument();
						$dom->preserveWhiteSpace = false;
						$xp = null;
						if(@$dom->load( 'assets/tracks/'.$vars["band"].'/'.$vars["format"].'/'.$vars["type"].'/'.$vars["id"].'/'.$item['id']."/tracks.xml" )){
							$xp = new DOMXPath( $dom );
							$query = $xp->query("//side");
							?>
							<div style="padding-left: 5px;">
								<div class="t-list-headers">
							<?php
							foreach($query as $side){
								if ($side->getAttribute("val") != ""){
								?>
									<div class="t-list-header <?php echo $side->getAttribute("class") ?>">
										<?php echo $side->getAttribute("val")?>:
									</div>
								<?php
								}
							}
							?>
								</div>
							<?php
							foreach($query as $side){
							?>
								<div class="<?php echo $side->getAttribute("class") ?>">
							<?php
								foreach($side->getElementsByTagName("track") as $track){
								?>
									<div class='t-list-first-inner'><?php echo $track->getAttribute("n") ?>.&nbsp;</div>
									<div class="<?php echo $side->getAttribute("class")?>-inner last"><?php echo $track->nodeValue ?></div>
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
					?>
				</div>
				<div class="text1 style4 span-24-1">Pics:&nbsp;</div>
				<?php
				if (is_dir($base_dir.$vars["id"].'/'.$item['id']))
					$filecount = count(glob($base_dir.$vars["id"].'/'.$item['id']."/*.jpg"));
				if (file_exists($base_dir.$vars["id"].'/'.$item['id']."/0.jpg")){
					$filecount -= 1;
				}
				if ($filecount > 0)
				{
				?>
				<div class="show">
					<div class="text3 style4 span-24-1" style="display:none;">
						<a id="<?php echo $item['id']; ?>" href="#">+ show</a>
					</div>
					<div class="pics span-24-1 style8">
						<div class="loading span-24-1">
							<img src="/assets/images/loading.gif" />
						</div>
						<?php echo "<noscript><div class='pics-inner'>";
						for ($j=1; $j<=$filecount; $j++){
							echo " <img src='$base_dir".$vars["id"].'/'.$item['id'].'/'.$j.".jpg' alt='".$db->getReleasename()."' title='".$db->getReleasename()."' class='releaseImage' />";
						}
						echo "</div></noscript>";?>
					</div>
				</div>
				<?php
				}
				else
				{
				?>
					<div class="text1 style4 span-24-1">none at the time</div>
				<?php
				}
				?>
			</div>
		</div>
		<?php
		}
		$db->getBottombuttons();
	}
	else{
	?>
		<div class="other1 style1 span-24" style="text-align: center;">error</div>
	<?php
	}
	?>
	</div>
	<?php
}
?>
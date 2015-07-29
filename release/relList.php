<?php
$widths = $db->getReleaseStruct();
foreach($widths as $key => $width)
{
	$apendix = "s:";
	if ($key == "other") {
		$apendix = ":";
		$width .= " last";
	}
?>
	<div class="releaseList span-<?php echo $width ?>">
		<div class="append-bottom style1 span-<?php echo $width ?> last">
			<?php echo ucfirst($key).$apendix; ?>
		</div>
		<div class="<?php echo $key; ?> style6 span-<?php echo $width ?> last">
			<ol>
			<?php
				if (($result = $db->getReleases($key)) != null){
					foreach ($result as $item){
			?>
						<li>
							<a class="<?php echo $item['class']; ?>" id="nr<?php echo $item['id']; ?>" href="<?php echo "/releases/".$vars['band']."/".$vars['format']."/".$key."/".$item['id']; ?>">
							<?php echo $item['name']; ?>
							</a>
						</li>
					<?php
					}
				}
				else{
				?>
					<div class="style2" style="margin-left: -20px;">No <?php echo $key.' '.$db->getFormatName()?> at this time</div>
				<?php
				}
				?>
			</ol>
		</div>
	</div>
	<?php
}
?>
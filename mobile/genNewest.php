<?php ob_start(); ?>
<div id="newest" data-role="collapsible" data-inline="true" data-theme="b">
<h3>Newest additions</h3>
	<ul id="newest-list" data-role="listview" data-inset="true" data-theme="a" class="list">
	<?php
		include "../mysql.php";
		include "../functions.php";
		$db = new JHoDisc();
		$db->connect();
		if ($db->select("`subrelease` JOIN `release` ON release.id=subrelease.id_release JOIN `names` on names.id=release.id_name","subrelease.name as name,names.name as album,id_release as id,subrelease.id as id2,band,type,format",null,"subrelease.pubDate DESC LIMIT 31")){
			$nameRow = $db->getResult();
			foreach ($nameRow as $item){
				echo "<li><a rel='external' href='/mobile/release/".$item['band']."/".$item['format']."/".$item['type']."/".$item['id']."/".$item['id2']."#n".$item['id2']."'>".$db->bandShortNames[$item['band']]." - ".$item['album']." - ".$item['name']."</a></li>";
			}
		}
	?>
	</ul>
</div>
<?php

$fp = fopen("newest.php", 'w');
fwrite($fp, ob_get_contents());
fclose($fp);
ob_end_flush();
?>
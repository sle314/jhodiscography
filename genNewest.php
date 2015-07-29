<?php ob_start(); ?>
<div id="newest_link"><a href="#">Newest additions</a></div>
	<div id="newest">
	<?php
		include "mysql.php";
		include "functions.php";
		$db = new JHoDisc();
		$db->connect();
		if ($db->select("`subrelease` JOIN `release` ON release.id=subrelease.id_release JOIN `names` on names.id=release.id_name","subrelease.name as name,names.name as album,id_release as id,subrelease.id as id2,band,type,format",null,"subrelease.pubDate DESC LIMIT 15")){
			$nameRow = $db->getResult();
			foreach ($nameRow as $item){
				echo "<a href='/releases/".$item['band']."/".$item['format']."/".$item['type']."/".$item['id']."/".$item['id2']."#n".$item['id2']."'>".$db->bandShortNames[$item['band']]." - ".$item['album']." - ".$item['name']."</a><br/>";
			}
		}
	?>
</div>
<?php

$fp = fopen("newest.php", 'w');
fwrite($fp, ob_get_contents());
fclose($fp);
ob_end_flush();
?>
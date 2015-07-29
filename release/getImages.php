<div class="pics-inner">
<?php
require_once "../mysql.php";

if (is_numeric(intval($_REQUEST['id'])) && is_numeric(intval($_REQUEST['id2']))){
	$db = new Database();
	$db->connect();
	$db->select("`release` JOIN `names` ON names.id = release.id_name JOIN `subrelease` ON subrelease.id_release=release.id", 'band,format,type,names.name,subrelease.name as name2', 'release.id = '.$_REQUEST['id'], null);
	$name_row = $db->getResult();
	$directory = "/assets/images/releases/".$name_row[0]['band']."/".$name_row[0]['format']."/".$name_row[0]['type']."/".$_REQUEST['id']."/".$_REQUEST['id2']."/";
	$filecount = 0;
	if (is_dir("..".$directory))
		$filecount = count(glob("..".$directory."*.jpg"));
	if (file_exists("..".$directory.'0.jpg')){
		$filecount -= 1;
	}
	if ($filecount > 0)
	{	
		for ($j=1; $j<=$filecount; $j++){
			$size = getimagesize("..".$directory.$j.'.jpg');
			echo ' <img src="'.$directory.$j.'.jpg" alt="'.$name_row[0]['name']." - ".$name_row[0]['name2'].'" align="bottom" title="'.$name_row[0]['name']." - ".$name_row[0]['name2'].'" class="releaseImage" width="'.$size[0].'" height="'.$size[1].'"/> ';
		}
	}
	else{
	?>
		<div class="text1 style4 span-24-1">none at the time</div>
<?php
	}
}
else{
	?>
	<div class="text1 style4 span-24-1">none at the time</div>
	<?php
}
?>
</div>

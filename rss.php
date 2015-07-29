<?php
include 'mysql.php';
include 'functions.php';
$db = new JHoDisc();
$db->connect();
	
	$result = $db->getRSS();

	$now = date(DATE_RSS);
	$output = 
	"<?xml version='1.0' encoding='UTF-8'?>
		<rss version='2.0' xmlns:atom='http://www.w3.org/2005/Atom'>
			<channel>
				<atom:link href='http://jhodiscography.xtreemhost.com/rss/qotsa.xml' rel='self' type='application/rss+xml' />
				<title>Joshua Homme discography</title>
				<description>Kyuss, QotSA, EoDM, Desert Sessions, TCV</description>
				<link>http://jhodiscography.xtreemhost.com/</link>
				<pubDate>$now</pubDate>
				<lastBuildDate>$now</lastBuildDate>
				";
	$domain="jhodiscography.xtreemhost.com";
	foreach($result as $item){	
			
			$mainImage = $domain."/assets/images/releases/".$item['band']."/".$item['format']."/".$item['type']."/".$item['id']."/".$item['id2']."/1.jpg";
			
			$output .= 
					'<item>
						<guid>http://jhodiscography.xtreemhost.com/releases/'.$item['band']."/".$item['format']."/".$item['type']."/".$item['id'].'/'.$item['id2'].'</guid>
						<title>
							'.$db->bandShortNames[$item['band']]." - ".$item['album'].' - '.$item['name'].'
						</title>
						<description>
							<![CDATA[<table border="0" cellpadding="0" style="text-align: center;font-size: 12px;">
							<tr>
								<td width="50%" style="padding: 0 5px;">
									<a href="http://jhodiscography.xtreemhost.com/releases/'.$item['band']."/".$item['format']."/".$item['type']."/".$item['id'].'/'.$item['id2'].'">
										<img border="0" src="http://'.$mainImage.'" width="135px"/>
									</a>									
								</td>
								<td style="padding: 0 5px 0 5px; text-align: left;">
									<b>Year:</b> '.$item['year'].'<br /><br/>
									<b>Released by:</b> '.$item['label'].'<br /><br/>
									<b>Info / barcode:</b> '.$item['info'].'<br /><br/>
									<b>Mx#:</b> '.$item['matrix'].'
								</td>
							</tr>
							<tr>
								<td style="font-size: 9px">*click image for more info</td>
								<td></td>
							</tr>
							</table>]]>						
						</description>
						<link>http://jhodiscography.xtreemhost.com/releases/'.$item['band']."/".$item['format']."/".$item['type']."/".$item['id'].'/'.$item['id2']."</link>
						<pubDate>".date(DATE_RSS,strtotime($item['pubDate']))."</pubDate>
					</item>
				";		
	}
$output .= 
		"</channel>
	</rss>";
$output = str_replace("&","&amp;",$output);
	$myFile = "rss/qotsa.xml";
	$fh = fopen($myFile, 'w');
	fwrite($fh, $output);
	fclose($fh);

?>

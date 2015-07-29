<ul class="navi">
	<li><a href="/">Home</a></li>
	<li><a href="/other">Merch</a></li>
	<li class='border append-1'>
		<a href='<?php echo $db->getCdVinylQuery(); ?>'>
			<?php echo $db->getOppFormatName(); ?>
		</a>
	</li>		
	<li class="kyuss-navi"><a href="/releases/kyuss/<?php echo $vars["format"]; ?>">Kyuss</a></li>
	<li class="qotsa-navi"><a href="/releases/qotsa/<?php echo $vars["format"]; ?>">QotSA</a></li>
	<li class="ds-navi"><a href="/releases/ds/<?php echo $vars["format"]; ?>">Desert Sessions</a></li>
	<li class="eodm-navi"><a href="/releases/eodm/<?php echo $vars["format"]; ?>">EoDM</a></li>
	<li class="tcv-navi"><a href="/releases/tcv/<?php echo $vars["format"]; ?>">TCV</a></li>
	<li class="last other-navi"><a href="/releases/other/<?php echo $vars["format"]; ?>">Other</a></li>
</ul>
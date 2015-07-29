<?php

class JHoDisc extends Database
{
	private $t,$f,$b,$id,$of;
	private $typeNames = array("single"=>"Single","lp"=>"Lp","other"=>"Other");
	private $bandNames = array("kyuss"=>"Kyuss","qotsa"=>"Queens of the Stone Age","ds"=>"Desert Sessions"
								,"eodm"=>"Eagles of Death Metal","tcv"=>"Them Crooked Vultures","other"=>"Other");
	public $bandShortNames = array("kyuss"=>"Kyuss","qotsa"=>"QotSA","ds"=>"Desert Sessions","eodm"=>"EoDM","tcv"=>"TCV","other"=>"Other");
	private $formatNames = array("vinyl"=>"Vinyl","cd"=>"CD's");

	public function getRSS(){
		$this->select("`subrelease` JOIN `release` ON release.id=subrelease.id_release JOIN names on names.id=release.id_name ",
			'subrelease.id as id2,subrelease.id_release as id, names.name as album, subrelease.name as name, subrelease.year, matrix, info, label,band,type,format, pubDate',null,"pubDate DESC, id_release DESC, id DESC limit 15");
		return $this->getResult();
	}

	public function checkId($id)
	{
		if ($id > 0 && $id < $this->getMaxId()+1)
			return true;
		else
			return false;
	}

	private function getMaxId()
	{
		$s = "`release`";
		$this->select($s, 'MAX(id) as max',null,null);
		$name_row = $this->getResult();
		return $name_row[0]['max'];
	}

	public function setVars($b, $f, $t, $id)
	{
		$this->t = $t;
		if($b && $f){
			if ($this->checkBandFormat($b, $f))
			{
				$this->b = $b;
				$this->f = $f;
			}
			else
				$this->errorInfo();
		}
		elseif ($id){
			 if($this->checkId($id)){
				$this->id = $id;
				$s1 = "`release` JOIN `subrelease` ON release.id=subrelease.id_release";
				$s2 = 'release.id = '.$id;
				$this->select($s1, 'band, format, type, subrelease.id as id', $s2, null);
				$name_row = $this->getResult();

				$this->b = $name_row[0]['band'];
				$this->f = $name_row[0]['format'];
				$this->t = $name_row[0]['type'];

				$this->id2 = $name_row[0]['id'];

			}
			else{
				echo "Wrong ID!<br /><a href='".$_SERVER['HTTP_REFERER']."' onClick='window.back();return false;'>Go back</a><br /><a href='index.php'>Go home</a>";
				exit();
			}
		}
		else{
			$this->errorInfo();
		}
		if (!$this->checkType())
			$this->errorInfo();
	}

	private function checkBandFormat($b, $f)
	{
		if (array_key_exists($b,$this->bandNames) && array_key_exists($f,$this->formatNames) || 1)
			return true;
		else
			return false;
	}

	private function checkType()
	{
		if (array_key_exists($this->t,$this->typeNames) || 1)
			return true;
		else
			return false;
	}

	private function errorInfo()
	{
		header('Location: /error.html');
	}

	public function getVars()
	{

		return array("band"=>$this->b, "format"=>$this->f, "type"=>$this->t, "id"=>$this->id, "id2"=>$this->id2);
	}

	public function getTitle()
	{
		return $this->bandNames[$this->b];
	}

	public function getReleaseType()
	{
		return ucfirst($this->t);
	}

	public function getFormatName()
	{
		return $this->formatNames[$this->f];
	}

	public function getReleaseName()
	{
		if ($this->id)
		{
			$s1 = '`release` JOIN `names` ON release.id_name=names.id';
			$s2 = 'release.id = '.$this->id;
			$this->select($s1, 'names.name as name', $s2, null);
			$name_row = $this->getResult();
			return $name_row[0]['name'];
		}
		else
			return "";
	}

	public function getCdVinylQuery()
	{
		$this->setOppId();
		$q = "/releases/$this->b/$this->of";
		if($_REQUEST['id'] && $this->oppId){
			$q = "/releases/$this->b/$this->of/$this->t/$this->oppId#rel";
		}
		return $q;
	}
	public function getOppId(){
		return $this->oppId;
	}

	public function setOppId(){

		$this->gFN = $this->f == 'vinyl' ? "CD Version" : "Vinyl Version";
		$this->getOppFormat();

		$s1 = "`release` JOIN `names` ON names.id=release.id_name";
		$s2 = "release.id = $this->id";
		$this->select($s1, 'names.name as name', $s2, null);
		$name_row = $this->getResult();

		$s1 = "`release` JOIN `names` ON names.id=release.id_name";
		$s2 = "band='$this->b' AND names.name = '".$name_row[0]['name']."' and format='$this->of'";
		$this->select($s1, 'release.id as id', $s2, null);
		$name_row = $this->getResult();

		$this->oppId = $name_row[0]['id'];

		if (!$this->oppId && $this->b == 'ds')
		{
			if ($this->t == 'lp')
			{
				if ($this->f == 'vinyl')
				{
					if ($this->id == 142 || $this->id == 143)
						$this->oppId = 131;
					elseif ($this->id == 144 || $this->id == 145)
						$this->oppId = 132;
					else
						$this->oppId = 133;
				}
				else
				{
					if ($this->id == 131)
						$this->oppId = 142;
					elseif ($this->id == 132)
						$this->oppId = 144;
					else
						$this->oppId = 146;
				}
			}
		}

	}

	public function getOppFormatName(){
		return $this->formatNames[$this->of];
	}

	public function getOppFormat(){
		$this->of = ($this->f == 'vinyl' ? 'cd' : 'vinyl');
		return $this->of;
	}

	public function getOppVersion(){
		return str_replace(" Version","",$this->gFN);
	}

	public function getReleaseStruct()
	{
		$keys = array_keys($this->typeNames);
		switch($this->b){
			case("kyuss"):
				if ($this->f == 'vinyl') return array_combine($keys,array(7,9,8));
				else return array_combine($keys,array(5,9,10));
			case("qotsa"):
				if($this->f == 'vinyl') return array_combine($keys,array(7,8,9));
				else return array_combine($keys,array(7,8,9));
			case("ds"):
				if($this->f == 'vinyl') return array_combine($keys,array(4,13,7));
				else return array_combine($keys,array(4,12,8));
			case("eodm"):
				if($this->f == 'vinyl') return array_combine($keys,array(9,7,8));
				else return array_combine($keys,array(8,6,10));
			case("tcv"):
				if($this->f == 'vinyl') return array_combine($keys,array(8,8,8));
				else return array_combine($keys,array(8,8,8));
			case("other"):
				if($this->f == 'vinyl') return array_combine($keys,array(10,7,7));
				else return array_combine($keys,array(8,8,8));
			default:
				return array_combine($keys,array(8,8,8));
		}
	}

	public function getReleases($t)
	{
		$f = "`release` JOIN `names` ON release.id_name=names.id";
		$s = "release.id AS id, class, name";
		$w = "band='$this->b' AND format='$this->f' AND type='$t'";
		$o = 'release.year,release.id,names.name';
		if($this->select($f, $s, $w, $o))
			return $this->getResult();
	}

	public function getInfo()
	{

		$f = "`subrelease` LEFT OUTER JOIN `release` ON subrelease.id_release=release.id LEFT OUTER JOIN `names` ON release.id_name=names.id";
		$s = 'subrelease.id as id, names.name as album, subrelease.name as name, subrelease.year as year,
							subrelease.label as label, subrelease.info as info,subrelease.matrix as matrix';
		$w = 'release.id = '.$this->id;
		$o = 'subrelease.year, subrelease.id, subrelease.name';
		$this->select($f, $s, $w, $o);
		return $this->getResult();

	}

	private function checkButtonType($t)
	{
		$s = "`release` JOIN `names` ON release.id_name=names.id";
		if($this->select($s,'release.id as id, name', "release.type='$t' and release.band='$this->b' and release.format='$this->f'", 'release.year'))
		{
			if ($this->getResult())
				return true;
			else
				return false;
		}
		else
			return false;
	}

	public function getBottomButtons()
	{
		$minId = $maxId = false;

		if($this->select('`release` JOIN `names` ON names.id = release.id_name','release.id AS id', "band='$this->b' AND format='$this->f' AND type='$this->t'", 'release.year, names.name LIMIT 1')){
			$rez = $this->getResult();
			$minId=($this->id == $rez[0]['id']);
		}

		if($this->select('`release` JOIN `names` ON names.id = release.id_name','release.id AS id', "band='$this->b' AND format='$this->f' AND type='$this->t'", 'release.year DESC, names.name DESC LIMIT 1')){
			$rez = $this->getResult();
			$maxId=($this->id == $rez[0]['id']);
		}

		$tip = array_keys($this->typeNames);
		$tip2 = array("Singles", "Lp's", "Other");

		for ($z=0; $z<3; $z++)
		{
			if ($this->t == $tip[$z]){
				$a = $z;
				break;
			}

		}

		$k = 0;

		for ($j=0; $j<3; $j++)
		{
			if ($j != $a)
			{
				$c[$k][0] = $j;
				if($this->select('`release` JOIN `names` ON names.id = release.id_name','release.id AS id', "band='$this->b' AND format='$this->f' AND type='".$tip[$j]."'", 'release.year ASC, names.name ASC LIMIT 1')){
					$rez = $this->getResult();
					$c[$k][1]=$rez[0]['id'];
				}
				$k++;
			}
		}

		if($this->select("`release` JOIN `names` ON names.id=release.id_name","release.id AS id, names.name as name",
		"band='$this->b' AND format='$this->f' AND type='$this->t' AND release.id<>$this->id
		AND names.name<(SELECT name FROM `release` JOIN `names` ON release.id_name=names.id WHERE release.id=$this->id)
		AND release.year=(SELECT release.year FROM `release` WHERE release.id=$this->id)",
		"names.name DESC LIMIT 1")){
			if (($rez = $this->getResult()) != null){
				$p = $rez[0]['id'];
				$tp = $rez[0]['name'];
			}
			else if($this->select("`release` JOIN `names` ON names.id=release.id_name","release.id AS id, names.name as name",
		"band='$this->b' AND format='$this->f' AND type='$this->t'
		AND release.year<(SELECT release.year FROM `release` WHERE release.id=$this->id)",
		"release.year DESC,names.name DESC LIMIT 1")){
				if (($rez = $this->getResult()) != null){
					$p = $rez[0]['id'];
					$tp = $rez[0]['name'];
				}
			}
		}

		if($this->select("`release` JOIN `names` ON names.id=release.id_name","release.id AS id, names.name as name",
		"band='$this->b' AND format='$this->f' AND type='$this->t' AND release.id<>$this->id
		AND names.name>(SELECT name FROM `release` JOIN `names` ON release.id_name=names.id WHERE release.id=$this->id)
		AND release.year=(SELECT release.year FROM `release` WHERE release.id=$this->id)",
		"names.name ASC LIMIT 1")){
			if(($rez = $this->getResult()) != null){
				$n = $rez[0]['id'];
				$tn = $rez[0]['name'];
			}
			else if($this->select("`release` JOIN `names` ON names.id=release.id_name","release.id AS id, names.name as name",
		"band='$this->b' AND format='$this->f' AND type='$this->t'
		AND release.year>(SELECT release.year FROM `release` WHERE release.id=$this->id)",
		"release.year ASC,names.name ASC LIMIT 1")){
				if(($rez = $this->getResult()) != null){
					$n = $rez[0]['id'];
					$tn = $rez[0]['name'];
				}
			}
		}
		?>
		<div id="bottomButtons" class="span-24">


				<ul class="bottom1">
		<?php

			if ($minId == false){
		?>
					<li class="text2 class2 style4"><a href="<?php echo "/releases/$this->b/$this->f/$this->t/$p"; ?>#rel" title="<?php echo $tp ?>"><---Previous</a></li>
		<?php
		}
			if(!$maxId){
		?>
					<li class="text2 class2 style4"><a href="<?php echo "/releases/$this->b/$this->f/$this->t/$n"; ?>#rel" title="<?php echo $tn ?>">Next---></a></li>
		<?php
			}

?>
				</ul>


		<ul class="bottom">
		<?php
			if ($this->oppId)
			{
		?>
			<li class="text2 class2">
				<a href="<?php echo "/releases/$this->b/$this->of/$this->t/$this->oppId"; ?>#rel"><?php echo $this->gFN; ?></a>
			</li>
		<?php
			}
			if ($this->checkButtonType($tip[$c[0][0]]) && $c[0][1])
			{
		?>
			<li class="text2 class2">
				<a href="<?php echo "/releases/$this->b/$this->f/".$tip[$c[0][0]]."/".$c[0][1] ?>#rel"><?php echo $tip2[$c[0][0]] ;?></a>
			</li>
		<?php
			}
			if ($this->checkButtonType($tip[$c[1][0]]) && $c[1][1])
			{
		?>
			<li class="text2 class2">
				<a href="<?php echo "/releases/$this->b/$this->f/".$tip[$c[1][0]]."/".$c[1][1] ?>#rel"><?php echo $tip2[$c[1][0]]; ?></a>
			</li>
		<?php
			}
		?>
			<li class="text2 class2 last">
				<a class="bck-top" href="#top" onClick="$('body, html').animate({scrollTop : 0}, 500);return false;">back to top</a>
			</li>
		</ul>
	</div>
<?php	}

}
?>
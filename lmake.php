<?php

class Langwan_Licence {
	private $keydir = null;
	private $data = array();
	private $output = null;
	public function execute() {
		$options = getopt("k:d:o:");
		$keydir = empty($options["k"]) ? "default/pri" : $options["k"];
		$datafile = empty($options["d"]) ? "default/data.php" : $options['d'];
		$outdir = empty($options["o"]) ? "default/licence.dat" : $options["o"];
		$data = include($datafile);
		$sdata = serialize($data);
		//$salt = rand(1000, 9999);
		//$sdata = $salt.$sdata;
		$pri = file_get_contents($keydir);
		openssl_private_encrypt($sdata, $out, $pri);
		$b = base64_encode($out);
		file_put_contents($outdir, $b);
		echo "make licence file successed.\n";
	}
}

$run = new Langwan_Licence();
$run->execute();
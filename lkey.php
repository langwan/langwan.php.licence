<?php

class Langwan_Licence_Make_Key {
	private $output;
	public function execute() {
		$options = getopt("o:");
		$output = empty($options["o"]) ? "default" : $options["o"];
		$res = openssl_pkey_new();
		openssl_pkey_export($res, $pri);
		$d = openssl_pkey_get_details($res);
		$pub = $d['key'];
		@mkdir($output, 0777, true);
		file_put_contents($output."/pri", $pri);
		file_put_contents($output."/pub", $pub);	
		echo "make private and public key successed.\n";
	}
}

$run = new Langwan_Licence_Make_Key();
$run->execute();
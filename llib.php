<?php

interface Langwan_Licence_Checker {
	public function check($data);
}

class CXF_Licence_Checker_Default implements Langwan_Licence_Checker {
	public function check($data) {
		$expires = strtotime($data['expires']);
		if($expires < time()) {
			return false;
		}
		return true;
	}
}

class Langwan_Licence_Lib {
	private $lfile = null;
	private $kfile = null;
	private $checker = null;
	public function Langwan_Licence_Lib($kfile, $lfile, Langwan_Licence_Checker $checker) {
		$this->kfile = $kfile;
		$this->lfile = $lfile;
		$this->checker = $checker;
	}
	public function check() {
		$licence = base64_decode($this->lfile);
		$ret = openssl_public_decrypt($licence, $data, $this->kfile);
		$data = unserialize($data);
		return $this->checker->check($data);
	}
}

<?php
namespace app\merchant\controller;

class Entry extends Common {
	// 商家主页
	public function index() {
		return $this -> fetch();
	}
}
<?php
namespace app\admin\controller;

class Entry extends Common {
	// 访问主页(员工)
	public function index() {
		return $this -> fetch();
	}
	
}
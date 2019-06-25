<?php
namespace app\admin\controller;
use think\Controller;
use think\Request;

class Common extends Controller {
	public function __construct(Request $request = null) {
		parent::__construct($request);	// 执行父类构造方法
		
		// 没有登录（检查session有没有指定参数）就跳到登录页
		if(!session('admin.admin_username')) {
			$this -> redirect('admin/login/login');
		}
	}
}
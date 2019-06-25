<?php
namespace app\user\controller;
use think\Controller;
use app\common\model\User;

class Register extends Controller {
	// 用户注册
	public function register() {
		// 获取post参数数组
		$postArr = input('post.');
		$username = $postArr['username'];
		$password = $postArr['password'];
		
		// 调用User的register方法来判断，接收返回值
		$res = (new User()) -> register($username, $password);
		
		echo json_encode($res);
	}
}
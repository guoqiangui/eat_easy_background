<?php
namespace app\user\controller;
use think\Controller;
use app\common\model\User;

class Login extends Controller {
	// 用户登录
	public function login() {
		// 获取post参数数组
		$postArr = input('post.');
		$username = $postArr['username'];
		$password = $postArr['password'];
		
		// 调用User的login方法来判断，接收返回值
		$res = (new User()) -> login($username, $password);
		
		// 储存到session中
		session('user.username', $username);
		
		echo json_encode($res);
	}
	
	// 判断是否已经登录
	public function isLogin() {
		if(session('user.username')) {
			return 1;
		} 
		return 0;
	}
	
	// 判断是否为会员
	public function isVip() {
		$user = new User();
		
		$username = input('post.username');
		
		$res = $user -> queryUserByUsername($username);
		
		if($res) {
			echo 1;
		} else {
			echo 0;
		}
	}
}
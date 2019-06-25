<?php
namespace app\merchant\controller;
use think\Controller;
use app\common\model\Merchant;


class Login extends Controller {
	// 访问登录页
	public function login() {
		// 判读是否为post
		if(request() -> isPost()) {
			// 获取post参数数组
			$postArr = input('post.');
			$username = $postArr['username'];
			$password = $postArr['password'];
			
			$res = (new Merchant()) -> login($username, $password);
			
			if($res['valid']) {
				// 登录成功, 重定向到商家主页
				$this -> success($res['msg'], 'merchant/entry/index');exit;
			} else {
				// 登录失败, 显示错误信息
				$this -> error($res['msg']);exit;
			}
			
		}
		
		return $this -> fetch();
	}
}
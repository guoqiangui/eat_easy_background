<?php
namespace app\admin\controller;
use think\Controller;
use app\common\model\Admin;
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
			
			// 调用Admin的login方法来判断，接收返回值
			$res = (new Admin()) -> login($username, $password);
			
			if($res['valid']) {
				// 登录成功, 重定向到主页
				$this -> success($res['msg'], 'admin/entry/index');exit;
			} else {
				// 登录失败, 显示错误信息
				$this -> error($res['msg']);exit;
			}
			
		}
		
		return $this -> fetch();
	}
}
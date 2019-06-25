<?php
namespace app\common\model;
use think\Model;

class Admin extends Model {
	protected $pk = 'id';	// 主键名
	protected $table = 'admin';	// 数据库表名
	
	public function login($username, $password) {
		// 查询得到单条结果
		$userInfo = $this -> where('username', $username) 
							-> where('password', $password) 
							-> find();
		
		if(!$userInfo) {
			// 进来了表示未查找到, 返回错误信息给controller
			return ['valid' => 0, 'msg' => '用户名或密码错误'];
		} 
		
		// 查找到了
		// 将用户信息储存到session中
		session('admin.admin_username', $userInfo['username']);
		// 返回成功信息给controller
		return ['valid' => 1, 'msg' => '登录成功'];
	}
	
}

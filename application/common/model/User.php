<?php
namespace app\common\model;
use think\Model;

class User extends Model {
	protected $pk = 'id';	// 主键名
	protected $table = 'user';	// 数据库表名
	
	// 查询用户数
	public function queryUserNum() {
		return $this -> count();
	}
	
	// 查询活跃用户数
	public function queryActiveNum() {
		return $this -> where('is_active', 1) -> count();
	}
	
	// 查询会员数
	public function queryVipNum() {
		return $this -> where('user_type', 'vip') -> count();
	}
	
	// 查询新增用户数(本周申请的)
	public function queryNewUserNum() {
		return $this -> whereTime('apply_time', 'week') -> count();
	}
	
	// 查询活跃用户数
	public function queryActiveUserNum() {
		return $this -> where('is_active', 1) -> count();
	}
	
	// 查询新增会员数(本周)
	public function queryNewVipNum() {
		return $this -> where('user_type', 'vip')
						-> whereOr('user_type', 'svip')
						-> whereTime('apply_time', 'week')
						->count();
	}
	
	// 查询所有会员
	public function queryAllVip() {
		return $this -> where('user_type', 'vip')
						-> whereOr('user_type', 'svip')
						-> select();
	}
	
	// 注册
	public function register($username, $password) {
		$userInfo = $this -> where('username', $username) -> select();

		if($userInfo) {
			// 进来了表示查找到用户, 返回错误信息: 用户名已存在
			return ['valid' => 0, 'msg' => '用户名已存在'];
		} else {
			// 添加用户
			$newUser = ['username' => $username, 'password' => $password];
			$this -> insert($newUser);
			
			return ['valid' => 1, 'msg' => '注册成功'];
		}
	}
	
	// 登录
	public function login($username, $password) {
		$res =  $this -> where('username', $username)
				-> where('password', $password)
				-> select();
				
		if(!$res) {
			return ['valid' => 0, 'msg' => '用户名或密码错误'];
		} else {
			// 登录成功, 将用户信息储存到session中
			session('user.username', $username);
			
			return ['valid' => 1, 'msg' => '登录成功'];
		}
	}
	
	// 根据id查询用户信息
	public function queryById($id) {
		return $this -> where('id', $id) -> find();
	}
	
	// 根据用户名查询会员信息, 模糊查询
	public function queryByUsername($username) {
		$vipArr = $this -> where('user_type', 'vip')
						-> where('username', 'like', "%$username%")
						-> select();
						
		$svipArr = $this -> where('user_type', 'svip')
				-> where('username', 'like', "%$username%")
				-> select();
		
		// 合并查找出来的vip和svip数组
		return $vipArr + $svipArr;
	}
	
	// 修改用户信息
	public function modifyUser($dataArr) {
		$this -> update($dataArr);
	}
	
	// 查询所有新增会员
	public function queryAllNewVip() {
		return $this -> where('user_type', 'vip')
						-> whereOr('user_type', 'svip')
						-> whereTime('apply_time', 'week')
						-> select();
	}
	
	// 根据id删除
	public function deleteById($id) {
		// 文档有点问题, 只能这样删了
		$this -> where('id', $id) -> delete();
	}
	
	// 根据用户名查找用户
	public function queryUserByUsername($username) {
		return $this -> where('username', $username) -> find();
	}
}

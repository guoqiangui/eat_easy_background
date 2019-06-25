<?php
namespace app\common\model;
use think\Model;

class User extends Model {
	protected $pk = 'id';
	protected $table = 'user';
	
	// 查询用户数
	public function queryUserNum() {
		return $this -> count();
	}
	
	// 查询活跃数
	public function queryActiveNum() {
		return $this -> where('is_active', 1) -> count();
	}
	
	// 查询会员数
	public function queryVipNum() {
		return $this -> where('user_type', 'vip') -> whereOr('user_type', 'svip') -> count();
	}
	
	// 查询所有用户
	public function queryAllUsers() {
		return $this -> select();
	}
}
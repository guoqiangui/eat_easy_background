<?php
namespace app\common\business;
use app\common\business\ebi\EBI;
use app\common\dao\MerchantDAO;

class MerchantEBO implements EBI {
	// 增
	public function add($object) {
		
	}
	// 删(根据id)
	public function delete($id) {
		
	}
	// 改
	public function update($object) {
		
	}
	// 查
	public function findByCondition($condition) {
		
	}
	// 查询所有
	public function findAll() {
		
	}
	
	// 登录
	public function login($username, $password) {
		// 无论有几条结果, 都会放到数组中
		$userInfo = (new MerchantDAO()) -> findByCondition([
			'merchant_name' => $username,
			'password' => $password
		]);
		
		if(!$userInfo) {
			// 进来了表示未查找到, 返回错误信息给controller
			return ['valid' => 0, 'msg' => '用户名或密码错误'];
		} 
		
		// 查找到了
		// 将用户信息储存到session中
		session('merchant.merchant_name', $userInfo[0]['merchant_name']);
		// 返回成功信息给controller
		return ['valid' => 1, 'msg' => '登录成功'];
	}
}
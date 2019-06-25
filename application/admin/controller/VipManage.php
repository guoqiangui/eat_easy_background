<?php
namespace app\admin\controller;
use think\Controller;
use app\common\model\User;

class VipManage extends Controller {
	// 加载会员管理页面
	public function index() {
		$user = new User();
		
		// 查询所有会员信息
		$allUserArr = $user -> queryAllVip();
		
		// 所有会员数
		$allVipNum = count($allUserArr);
		
		// 新增会员数
		$newVipNum = $user -> queryNewVipNum();
		
		return $this -> fetch('vip-manage', ['userArr' => $allUserArr, 
												'allVipNum' => $allVipNum,
												'newVipNum' => $newVipNum,
												'type' => 'all'
											]);
	}
	
	
	// 查询单个会员信息(根据id查询)
	public function queryUserInfo() {
		$user = new User();
		
		// 获取会员id
		$id = input("post.")['id'];
		
		$res = $user -> queryById($id);
		
		echo json_encode($res);
	}
	
	
	// 修改会员信息
	public function modifyVipInfo() {
		$user = new User();
		
		// 将参数数组传入
		$user -> modifyUser(input("post."));
		
		// 更新完成后加载会员管理页面(这里return不能漏)
		return $this -> index();
	}
	
	
	// 查询所有新增会员
	public function queryAllNewVip() {
		$user = new User();
		
		$allNewVipArr = $user -> queryAllNewVip();
		
		// 查询所有会员信息
		$allUserArr = $user -> queryAllVip();
		// 所有会员数
		$allVipNum = count($allUserArr);
		
		// 新增会员数
		$newVipNum = $user -> queryNewVipNum();
		
		return $this -> fetch('vip-manage', ['userArr' => $allNewVipArr, 
												'allVipNum' => $allVipNum,
												'newVipNum' => $newVipNum,
												'type' => 'new'
											]);
	}
	
	
	// 搜索会员
	public function searchVip() {
		$user = new User();
		
		$username = input('post.')['username'];
		
		// 按照条件查询得到的会员
		$userArr = $user -> queryByUsername($username);
		
		// 查询所有会员信息
		$allUserArr = $user -> queryAllVip();
		// 所有会员数
		$allVipNum = count($allUserArr);
		
		// 新增会员数
		$newVipNum = $user -> queryNewVipNum();
		
		return $this -> fetch('vip-manage', ['userArr' => $userArr, 
												'allVipNum' => $allVipNum,
												'newVipNum' => $newVipNum,
												'type' => 'all'
											]);
	}
	
	// 删除用户(根据id)
	public function deleteUser() {
		$user = new User();
		
		$id = input('post.')['id'];
		
		$user -> deleteById($id);
		
		return $this -> index();
	}
}
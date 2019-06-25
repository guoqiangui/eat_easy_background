<?php
namespace app\admin\controller;
use think\Controller;
use app\common\model\Merchant;

class MerchantManage extends Controller {
	// 加载商家管理页面
	public function index() {
		$merchant = new Merchant();
		
		// 查询所有商家信息
		$allMerchantArr = $merchant -> queryAllMerchant();
		
		// 所有商家数
		$allMerchantNum = count($allMerchantArr);
		
		// 新增商家数
		$newMerchantNum = $merchant -> queryNewMerchantNum();
		
		return $this -> fetch('merchant-manage', ['merchantArr' => $allMerchantArr, 
												'allMerchantNum' => $allMerchantNum,
												'newMerchantNum' => $newMerchantNum,
												'type' => 'all'
											]);
	}
	
	
	// 查询单个商家信息(根据id查询)
	public function queryMerchantInfo() {
		$merchant = new Merchant();
		
		// 获取商家id
		$id = input("post.")['id'];
		
		$res = $merchant -> queryById($id);
		
		echo json_encode($res);
	}
	
	
	// 修改商家信息
	public function modifyMerchantInfo() {
		$merchant = new Merchant();
		
		// 将参数数组传入
		$merchant -> modifyMerchant(input("post."));
		
		// 更新完成后加载商家管理页面(这里return不能漏)
		return $this -> index();
	}
	
	
	// 查询所有新增商家
	public function queryAllNewMerchant() {
		$merchant = new Merchant();
		
		$allNewMerchantArr = $merchant -> queryAllNewMerchant();
		
		// 查询所有商家信息
		$allMerchantArr = $merchant -> queryAllMerchant();
		
		// 所有商家数
		$allMerchantNum = count($allMerchantArr);
		
		// 新增商家数
		$newMerchantNum = $merchant -> queryNewMerchantNum();
		
		return $this -> fetch('merchant-manage', ['merchantArr' => $allNewMerchantArr, 
												'allMerchantNum' => $allMerchantNum,
												'newMerchantNum' => $newMerchantNum,
												'type' => 'new'
											]);
	}
	
	// 搜索商家
	public function searchMerchant() {
		$merchant = new Merchant();
		
		$merchant_name = input('post.')['merchant_name'];
		
		// 按照条件查询得到的商家
		$merchantArr = $merchant -> queryByMerchantName($merchant_name);
		
		// 查询所有商家信息
		$allMerchantArr = $merchant -> queryAllMerchant();
		
		// 所有商家数
		$allMerchantNum = count($allMerchantArr);
		
		// 新增商家数
		$newMerchantNum = $merchant -> queryNewMerchantNum();
		
		return $this -> fetch('merchant-manage', ['merchantArr' => $merchantArr, 
												'allMerchantNum' => $allMerchantNum,
												'newMerchantNum' => $newMerchantNum,
												'type' => 'all'
											]);
	}
	
	// 删除商家
	public function deleteMerchant() {
		$merchant = new Merchant();
		
		$id = input('post.')['id'];
		
		$merchant -> deleteById($id);
		
		return $this -> index();
	}
}
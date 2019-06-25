<?php
namespace app\admin\controller;
use think\Controller;
use app\common\model\User;
use app\common\model\Merchant;

class Main extends Controller {
	// 得到主页数据
	public function index() {
		$user = new User();
		$merchant = new Merchant();
		
		// 获得用户数
		$userNum = $user -> queryUserNum();
		// 获得活跃数
		$activeNum = $user -> queryActiveNum();
		// 获得商家数
		$merchantNum = $merchant -> queryMerchantNum();
		// 获得会员数
		$vipNum = $user -> queryVipNum();
		
		return $this -> fetch('main', [
			'userNum' => $userNum,
			'activeNum' => $activeNum,
			'merchantNum' => $merchantNum,
			'vipNum' => $vipNum
		]);
	}
}
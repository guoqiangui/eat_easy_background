<?php
namespace app\admin\controller;
use think\Controller;
use app\common\model\Profit;

class ProfitManage extends Controller {
	// 加载收益管理页面
	public function index() {
		$profit = new Profit();
		
		// 获取总广告收益
		$adProfit = $profit -> queryAdProfit();
		// 获取总会员收益
		$vipProfit = $profit -> queryVipProfit();
		// 获取总其他收益
		$othersProfit = $profit -> queryOthersProfit();
		
		// 获取所有收益实体
		$profitArr = $profit -> queryAll();
		
		return $this -> fetch('profit-manage', [
			'vipProfit' => $vipProfit,
			'adProfit' => $adProfit,
			'othersProfit' => $othersProfit,
			'profitArr' => $profitArr
		]);
	}
	
	// 加载收益图表页面
	public function profitChart() {
		$profit = new Profit();
		
		// 获取每个时间段的收益数组
		$profitArr = $profit -> queryProfitOrderByTime();
		
		// 转成json
		$profitJson = json_encode($profitArr);
		
		// dump($profitArr);
		
		return $this -> fetch('profit-chart', ['profitJson' => $profitJson]);
	}
}
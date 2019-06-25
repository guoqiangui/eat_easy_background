<?php
namespace app\admin\controller;
use app\common\model\User;
use app\common\model\Article;
use app\common\model\Merchant;

class DataAnalysis extends Common {
	// 加载数据分析页
	public function index() {
		$user = new User();
		$article = new Article();
		$merchant = new Merchant();
		
		// 获取五个数据: 新增用户, 活跃用户, 新增会员数, 商家数, 发文数
		// 1.获取新增用户数(本周)
		$newUserNum = $user -> queryNewUserNum();	
		
		// 2.获取活跃用户数
		$activeUserNum = $user -> queryActiveUserNum();
		
		// 3.获取新增会员数(本周)
		$newVipNum = $user -> queryNewVipNum();
		
		// 4.获取商家数
		$merchantNum = $merchant -> queryMerchantNum();
		
		// 5.获取发文数
		$publishedArticleNum = $article -> queryPublishedArticleNum();
		
		// 将所有数据添加到数组中
		$dataArr = [$newUserNum, $activeUserNum, $newVipNum, $merchantNum, $publishedArticleNum];
		$dataJson = json_encode($dataArr);
		
		// dump($publishedArticleNum);
		
		return $this -> fetch('data-analysis', ['dataJson' => $dataJson]);
	}
}
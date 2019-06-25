<?php
namespace app\merchant\controller;
use think\Session;
use app\common\model\Merchant;

class DataAnalysis extends Common {
	// 加载数据分析页
	public function index() {
		$merchant = new Merchant();
		
		// 商家id
		$id = Session::get('merchant.id');
		
		// 获取五个数据: 粉丝数, 阅读数, 点赞数, 转发数, 评论数
		// 1.获取粉丝数
		$fansNum = $merchant -> getFansNum($id);	
		
		// 2.阅读数
		$readNum = $merchant -> queryReadNum($id);
		
		// 3.点赞数
		$likeNum = $merchant -> queryLikeNum($id);
		
		// 4.转发数
		$forwardNum = $merchant -> getForwardNum($id);
		
		// 5.评论数
		$commentNum = $merchant -> getCommentNum($id);
		
		// 将所有数据添加到数组中
		$dataArr = [$fansNum, $readNum, $likeNum, $forwardNum, $commentNum];
		$dataJson = json_encode($dataArr);
		
		// dump($commentNum);
		// dump($id);
		
		return $this -> fetch('data-analysis',  ['dataJson' => $dataJson]);
	}
}
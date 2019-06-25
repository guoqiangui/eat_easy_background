<?php
namespace app\merchant\controller;
use think\Controller;
use app\common\model\Merchant;

class Main extends Controller {
	// 得到主页数据
	public function index() {
		return $this -> fetch('main');
	}
	
	// 获得粉丝数, 阅读数和点赞数
	public function getDataArr() {
		$merchant = new Merchant();
		
		// 得到商家id
		$id = input('post.id');
		
		// 查询得到粉丝数
		$merchantObj = $merchant -> queryById($id);
		$fansNum = $merchantObj['fans_number'];
		
		// 查询得到该商家的文章阅读数
		$readNum = $merchant -> queryReadNum($id);
		
		// 查询得到点赞数
		$likeNum = $merchant -> queryLikeNum($id);
		
		
		$dataArr = [$fansNum, $readNum, $likeNum];
		echo json_encode($dataArr);
	}
}
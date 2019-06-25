<?php
namespace app\merchant\controller;
use think\Controller;
use app\common\model\Article;

class ContentManage extends Controller {
	// 得到主页数据
	public function index() {
		return $this -> fetch('content-manage');
	}
	
	// 加载对应状态的文章
	public function getArticleByState() {
		$article = new Article();
		
		// 获取商家id和要读取的文章状态
		$merchant_id = input('post.merchant_id');
		$state = input('post.state');
		
		$res = $article -> queryArticleByState($merchant_id, $state);
		return $res;
	}
	
	// 加载修改文章页面
	public function loadModifyArticlePage() {
		$article = new Article();
		
		$article_id = input('get.id');
		
		$res = $article -> queryById($article_id);
		
		return $this -> fetch('modify-article', [
			'id' => $article_id,
			'res' => $res
		]);
	}
	
	// 修改文章
	public function modifyArticle() {
		$article = new Article();
		
		$postArr = input('post.');
		
		
		// 添加文章, 状态为未通过
		$article -> modifyArticle($postArr);
	}
	
}
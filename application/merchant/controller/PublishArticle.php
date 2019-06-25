<?php
namespace app\merchant\controller;
use think\Controller;
use app\common\model\Article;

class PublishArticle extends Controller {
	// 得到主页数据
	public function index() {
		return $this -> fetch('publish-article');
	}
	
	// 商家请求发布文章
	public function reqPublishArticle() {
		$article = new Article();
		
		// 添加文章, 状态为未通过
		$article -> addUnpassArticle(input('post.'));
	}
	
	// 请求存为草稿
	public function saveAsDraft() {
		$article = new Article();
		
		// 添加文章, 状态为草稿
		$article -> addDraftArticle(input('post.'));
	}
}
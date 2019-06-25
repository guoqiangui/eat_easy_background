<?php
namespace app\admin\controller;
use think\Controller;
use app\common\model\Article;

class ArticleManage extends Controller {
	// 加载文章管理页面
	public function index() {
		$article = new Article();
		
		return $this -> fetch('article-manage');
	}
	
	// 根据状态查询所有文章
	public function getArticleByState() {
		$article = new Article();
		
		$state = input('post.state');
		
		return $article -> queryAllByState($state);
	}
	
	// 根据id获取文章
	public function getArticleById() {
		$article = new Article();
		$id = input('post.id');
		return $article -> queryById($id);
	}
	
	// 修改文章状态
	public function modifyState() {
		$article = new Article();
		
		return $article -> modifyArticle(input('post.'));
	}
}
<?php
namespace app\common\model;
use think\Model;

class Article extends Model {
	protected $pk = 'id';	// 主键名
	protected $table = 'article';	// 数据库表名
	
	// 根据id查询
	public function queryById($id) {
		return $this -> where('id', $id) -> find();
	}
	
	// 查询已发布文章数
	public function queryPublishedArticleNum() {
		return $this -> where('state', 'published') -> count();
	}
	
	// 添加文章, 状态为未通过
	public function addUnpassArticle($dataArr) {
		// 添加状态为未通过
		$dataArr['state'] = 'unpass';
		
		// 更新修改时间
		$dataArr['modify_time'] = date('Y-m-d H:i:s');
		
		$this -> save($dataArr);
	}
	
	// 添加文章, 状态为草稿
	public function addDraftArticle($dataArr) {
		// 添加状态为草稿
		$dataArr['state'] = 'draft';
		
		// 更新修改时间
		$dataArr['modify_time'] = date('Y-m-d H:i:s');
		
		$this -> save($dataArr);
	}
	
	// 根据状态获取对应商家的文章
	public function queryArticleByState($merchant_id, $state) {
		return $this -> where('merchant_id', $merchant_id)
				-> where('state', $state)
				-> select();
	}
	
	// 根据状态查询所有文章
	public function queryAllByState($state) {
		return $this -> where('state', $state)
				-> select();
	}
	
	// 修改文章
	public function modifyArticle($dataArr) {
		// 更新修改时间
		$dataArr['modify_time'] = date('Y-m-d H:i:s');
		
		$this -> update($dataArr);
	}
}

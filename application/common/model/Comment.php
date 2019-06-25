<?php
namespace app\common\model;
use think\Model;

class Comment extends Model {
	protected $pk = 'id';	// 主键名
	protected $table = 'comment';	// 数据库表名
	
	// 查询所有评论信息
	public function queryAllByMerchantId($merchant_id) {
		
	}
	
	// 查询举报评论数
	public function queryReportNum() {
		return $this -> where('type', 1)
						-> count();
	}
}

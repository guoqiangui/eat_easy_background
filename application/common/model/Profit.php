<?php
namespace app\common\model;
use think\Model;

class Profit extends Model {
	protected $pk = 'id';	// 主键名
	protected $table = 'profit';	// 数据库表名
	
	// 查询总广告收益
	public function queryAdProfit() {
		return $this -> where('type', 'ad') -> sum('profit');
	}
	
	// 查询总会员收益
	public function queryVipProfit() {
		return $this -> where('type', 'vip') -> sum('profit');
	}
	
	// 查询总其他收益
	public function queryOthersProfit() {
		return $this -> where('type', 'others') -> sum('profit');
	}
	
	// 查询所有收益
	public function queryAll() {
		return $this -> select();
	}
	
	public function queryProfitOrderByTime() {
		return $this -> order('profit_time') -> select();
	}
}

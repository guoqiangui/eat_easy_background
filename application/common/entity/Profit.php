<?php
namespace app\common\model;
use think\Model;

class Profit extends Model {
	protected $pk = 'id';
	protected $table = 'profit';
	
	// 查询总广告收入
	public function queryAdProfit() {
		return $this -> where('type', 'ad') -> sum('profit');
	}
	
	// 查询总会员收入
	public function queryVipProfit() {
		return $this -> where('type', 'vip') -> sum('profit');
	}
	
	// 查询总其他收入
	public function queryOthersProfit() {
		return $this -> where('type', 'others') -> sum('profit');
	}
	
	// 查询所有
	public function queryAll() {
		return $this -> select();
	}
	
	// 按时间排序查询总收益
	public function queryProfitOrderByTime() {
		return $this -> order('profit_time') -> select();
	}
}
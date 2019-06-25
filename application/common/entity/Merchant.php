<?php
namespace app\common\model;
use think\Model;

class Merchant extends Model {
	protected $pk = 'id';
	protected $table = 'merchant';
	
	// 查询商家数
	public function queryMerchantNum() {
		return $this -> count();
	}
}
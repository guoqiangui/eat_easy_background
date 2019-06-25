<?php
namespace app\common\dao;
use think\Model;
use app\common\dao\dai\DAI;

class AdminDAO extends Model implements DAI {
	protected $pk = 'id';	// 主键名
	protected $table = 'admin';	// 数据库表名
	
	// 增
	public function addEntity($object) {
		
	}
	// 删(根据id)
	public function deleteEntity($id) {
		
	}
	// 改
	public function updateEntity($object) {
		
	}
	// 条件查询
	public function findByCondition($condition) {
		// $userInfo = $this -> where('username', $data['username']) -> where('password', $data['password']) -> find();
		
		$sql = 'select * from '.$this -> table.' where 1=1';
		
		// 遍历数组
		foreach($condition as $key => $value) {
			// 拼接sql语句
			$sql .= ' and '.$key.' = "'.$value.'"';
		}
		
		return $this -> query($sql);
	}
	// 查询所有
	public function findAll() {
		
	}
	
}

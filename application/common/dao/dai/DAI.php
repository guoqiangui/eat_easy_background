<?php
namespace app\common\dao\dai;

// 数据访问类接口
interface DAI {
	// 增
	public function addEntity($object);
	// 删(根据id)
	public function deleteEntity($id);
	// 改
	public function updateEntity($object);
	// 查
	public function findByCondition($condition);
	// 查询所有
	public function findAll();
}
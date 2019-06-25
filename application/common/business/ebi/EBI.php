<?php
namespace app\common\business\ebi;

// 业务类接口
interface EBI {
	// 增
	public function add($object);
	// 删(根据id)
	public function delete($id);
	// 改
	public function update($object);
	// 查
	public function findByCondition($condition);
	// 查询所有
	public function findAll();
}
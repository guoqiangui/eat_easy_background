<?php
namespace app\common\model;
use think\Model;

class Merchant extends Model {
	protected $pk = 'id';	// 主键名
	protected $table = 'merchant';	// 数据库表名
	
	public function login($username, $password) {
		// 查询得到单条结果
		$merchantInfo = $this -> where('merchant_name', $username) 
							-> where('password', $password) 
							-> find();
		
		if(!$merchantInfo) {
			// 进来了表示未查找到, 返回错误信息给controller
			return ['valid' => 0, 'msg' => '用户名或密码错误'];
		} 
		
		// 查找到了
		// 将用户信息储存到session中
		session('merchant.merchant_name', $merchantInfo['merchant_name']);
		session('merchant.id', $merchantInfo['id']);
		
		// 返回成功信息给controller
		return ['valid' => 1, 'msg' => '登录成功'];
	}
	
	
	// 查询商家数
	public function queryMerchantNum() {
		return $this -> count();
	}
	
	// 查询所有商家
	public function queryAllMerchant() {
		return $this -> select();
	}
	
	// 根据id查询商家
	public function queryById($id) {
		// 查找单个用find()
		return $this -> where('id', $id) -> find();
	}
	
	// 修改商家
	public function modifyMerchant($dataArr) {
		$this -> update($dataArr);
	}
	
	// 查询新增商家数(本周)
	public function queryNewMerchantNum() {
		return $this -> whereTime('apply_time', 'week')
						-> count();
	}
	
	// 查询所有新增商家(本周)
	public function queryAllNewMerchant() {
		return $this -> whereTime('apply_time', 'week')
						-> select();
	}
	
	// 根据用户名查询商家(模糊查询)
	public function queryByMerchantName($merchant_name) {
		return $this -> where('merchant_name', 'like', "%$merchant_name%") 
						-> select();
	}
	
	// 删除商家
	public function deleteById($id) {
		$this -> where('id', $id) -> delete();
	}
	
	// 查询得到该商家的文章阅读数
	public function queryReadNum($id) {
		$resArr =  $this -> query('
			SELECT m.id as merchant_id, a.id as article_id, a.read_number 
			FROM merchant m, article a 
			WHERE m.id = a.merchant_id;
		');
		
		$readNum = 0;
		
		// 将阅读数量相加
		foreach($resArr as $value) { 
			// 指定商家的文章才相加
			if($value['merchant_id'] == $id) {
				$readNum += $value['read_number'];
			}
		}
		
		return $readNum;
	}
	
	// 查询并得到该商家总点赞数
	public function queryLikeNum($id) {
		$resArr = $this -> query('
			SELECT m.id as merchant_id, a.id as article_id, a.like_number
			FROM merchant m, article a
			WHERE m.id = a.merchant_id;
		');
		
		$likeNum = 0;
		
		// 将点赞数相加
		foreach($resArr as $value) {
			if($value['merchant_id'] == $id) {
				$likeNum += $value['like_number'];
			}
		}
		
		return $likeNum;
	}
	
	// 获取粉丝数
	public function getFansNum($id) {
		$arr = $this -> query("SELECT fans_number FROM merchant WHERE id=$id");
		return $arr[0]['fans_number'];
	}
	
	// 转发数
	public function getForwardNum($id) {
		$resArr = $this -> query('
			SELECT m.id as merchant_id, a.id as article_id, a.forward_number
			FROM merchant m, article a
			WHERE m.id = a.merchant_id;
		');
		
		$forwardNum = 0;
		
		// 将转发数相加
		foreach($resArr as $value) {
			if($value['merchant_id'] == $id) {
				$forwardNum += $value['forward_number'];
			}
		}
		
		return $forwardNum;
	}
	
	// 评论数
	public function getCommentNum($merchant_id) {
		$restArr =  $this -> query("
			SELECT m.id as merchant_id, a.id as article_id, c.id as comment_id
			FROM merchant m, article a, comment c
			WHERE m.id = a.merchant_id 
			AND a.id = c.article_id
		");
		
		$commentNum = 0;
		
		foreach($restArr as $value) {
			if($value['merchant_id'] == $merchant_id) {
				$commentNum ++;
			}
		}
		
		return $commentNum;
	}
}

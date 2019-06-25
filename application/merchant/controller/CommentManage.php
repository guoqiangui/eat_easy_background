<?php
namespace app\merchant\controller;
use think\Controller;
use app\common\model\Comment;

// 评论管理(未完成)
class CommentManage extends Controller {
	// 加载评论管理页
	public function index() {
		$comment = new Comment();
		
		// 查询该商家的所有评论信息
		$allCommentArr = $comment -> queryAllByMerchantId(Session::get('merchant.id'));
		
		// 所有评论数
		$allCommentNum = count($allCommentArr);
		
		// 举报评论数
		$reportNum = $comment -> queryReportNum();
		
		return $this -> fetch('vip-manage', ['commentArr' => $allCommentArr, 
												'allCommentNum' => $allCommentNum,
												'reportNum' => $reportNum,
												'type' => 'all'
											]);
	}
	
	
}
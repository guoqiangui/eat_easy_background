<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:98:"D:\phpStudy\PHPTutorial\WWW\eat-easy-background\public/../application/merchant\view\main\main.html";i:1558626364;}*/ ?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title></title>
		<link rel="stylesheet" href="/eat-easy-background/public/static/css/base.css">
		<link rel="stylesheet" href="/eat-easy-background/public/static/css/b-main.css">
	</head>
	<body>
		<!-- 公告 -->
		<div class="announcement">
			公告：<span></span>
		</div>
		<!-- 商家信息 -->
		<div class="business-info-wrapper">
			<ul class="business-info-list">
				<li class="business-info-item fans">
					<span>0</span>
					<span>粉丝数</span>
				</li>
				<li class="business-info-item read">
					<span>0</span>
					<span>阅读数</span>
				</li>
				<li class="business-info-item like">
					<span>0</span>
					<span>点赞数</span>
				</li>
			</ul>
		</div>
	</body>
</html>
<script src="/eat-easy-background/public/static/lib/jquery-1.11.1.min.js"></script>
<script>
	$(function () {
		var serverName = "localhost:8080";
		
		// 获取session中储存的id
		var id = <?php echo \think\Session::get('merchant.id'); ?>;
		
		$.ajax({
			url: `http://${serverName}/eat-easy-background/public/merchant/main/getDataArr`,
			type: "post",
			data: {
				id: id
			},
			success: function (data) {
				data = JSON.parse(data);
				// console.log(data);
				
				// 将粉丝数渲染到网页中
				$(".business-info-item.fans span:first-child").html(data[0]);
				// 阅读数
				$(".business-info-item.read span:first-child").html(data[1]);
				// 点赞数
				$(".business-info-item.like span:first-child").html(data[2]);
			}, 
			error: function () {
				alert("服务器错误");
			}
		});
	});
</script>
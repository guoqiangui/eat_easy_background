<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:95:"D:\phpStudy\PHPTutorial\WWW\eat-easy-background\public/../application/admin\view\main\main.html";i:1556964854;}*/ ?>
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
					<span><?php echo $userNum; ?></span>
					<span>用户数</span>
				</li>
				<li class="business-info-item read">
					<span><?php echo $activeNum; ?></span>
					<span>活跃数</span>
				</li>
				<li class="business-info-item like">
					<span><?php echo $merchantNum; ?></span>
					<span>商家数</span>
				</li>
				<li class="business-info-item like">
					<span><?php echo $vipNum; ?></span>
					<span>会员数</span>
				</li>
			</ul>
		</div>
	</body>
</html>
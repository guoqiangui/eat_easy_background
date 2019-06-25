<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:100:"D:\phpStudy\PHPTutorial\WWW\eat-easy-background\public/../application/merchant\view\entry\index.html";i:1558926406;}*/ ?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<!-- 打开链接的地方 -->
		<base target="display-page" />
		<title></title>
		<link rel="stylesheet" href="/eat-easy-background/public/static/css/base.css">
		<link rel="stylesheet" href="/eat-easy-background/public/static/css/index.css">
	</head>
	<body>
		<div class="wrapper">
			<!-- 头部区域 -->
			<header class="header clearfix">
				<div class="name fl">后台管理系统（商家端）</div>
				<div class="user fr">
					<div class="user-img-wrapper">
						<img src="/eat-easy-background/public/static/img/avatar.png" class="user-img">
					</div>
					<span class="user-name"><?php echo \think\Session::get('merchant.merchant_name'); ?></span>
				</div>
			</header>
			<!-- 左侧菜单栏 -->
			<aside class="main-menu">
				<ul class="menu-list">
					<div class="menu-label">主菜单</div>
					<li class="menu-list-item"><a href="<?php echo url('merchant/main/index'); ?>" class="active">主页</a></li>
					<li class="menu-list-item"><a href="<?php echo url('merchant/publish_article/index'); ?>">发布文章</a></li>
					<li class="menu-list-item"><a href="<?php echo url('merchant/content_manage/index'); ?>">内容管理</a></li>
					<!-- <li class="menu-list-item"><a href="<?php echo url('merchant/comment_manage/index'); ?>">评论管理</a></li> -->
					<li class="menu-list-item"><a href="<?php echo url('merchant/data_analysis/index'); ?>">数据分析</a></li>
					<!-- <li class="menu-list-item"><a href="material-manage.html">素材管理</a></li> -->
				</ul>
			</aside>
			<!-- 主体内容区域 -->
			<div class="content-wrapper">
				<iframe src="<?php echo url('merchant/main/index'); ?>" frameborder="0" class="display-page" name="display-page"></iframe>
			</div>
		</div>
	</body>
</html>
<script src="/eat-easy-background/public/static/lib/jquery-1.11.1.min.js"></script>
<script>
	// 点击切换菜单
	$(".menu-list-item a").on("click", function () {
		$(".menu-list-item a").removeClass("active");
		$(this).addClass("active");
	});
</script>
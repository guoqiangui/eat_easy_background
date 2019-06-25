<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:118:"D:\phpStudy\PHPTutorial\WWW\eat-easy-background\public/../application/merchant\view\content_manage\content-manage.html";i:1558926886;}*/ ?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>内容管理</title>
		<link rel="stylesheet" href="/eat-easy-background/public/static/css/base.css">
		<link rel="stylesheet" href="/eat-easy-background/public/static/css/b-content-manage.css">
	</head>
	<body>
		<!-- 内容状态 -->
		<nav class="content-status">
			<ul class="content-status-list clearfix">
				<li class="content-status-item">
					<a href="#" class="published active">已发表</a>
				</li>
				<li class="content-status-item">
					<a href="#" class="unpass">未通过</a>
				</li>
				<li class="content-status-item">
					<a href="#" class="draft">草稿</a>
				</li>
			</ul>
		</nav>
		<!-- 文章列表 -->
		<div class="article-list-wrapper">
			<ul class="article-list"></ul>
		</div>
		<!-- 分页 -->
		<!-- <div class="pagination-wrapper">
			<ul class="pagination clearfix">
				<li class="page-first"><a href="#">首页</a></li>
				<li class="page-pre"><a href="#">上一页</a></li>
				<li class="page-number"><a href="#">1</a></li>
				<li class="page-number"><a href="#">2</a></li>
				<li class="page-number"><a href="#">3</a></li>
				<li class="page-separator"><a href="#">...</a></li>
				<li class="page-number"><a href="#">9</a></li>
				<li class="page-number"><a href="#">10</a></li>
				<li class="page-next"><a href="#">下一页</a></li>
				<li class="page-last"><a href="#">尾页</a></li>
			</ul>
		</div> -->
	</body>
</html>
<script src="/eat-easy-background/public/static/lib/jquery-1.11.1.min.js"></script>
<script>
	$(function () {
		var serverName = "localhost:8080";
		var merchant_id = <?php echo \think\Session::get('merchant.id'); ?>;
		
		// 渲染指定状态的文章
		function renderArticle(merchant_id, state) {
			$.ajax({
				url: `http://${serverName}/eat-easy-background/public/merchant/content_manage/getArticleByState`,
				type: "post",
				data: {
					merchant_id: merchant_id,
					state: state
				},
				success: function (articleArr) {
					// 模板字符串
					var allArticle = ``;
					
					articleArr.forEach(function (article, index) {
						// 不断拼接
						allArticle += `
							<li class="article-list-item">
								<span style="display: none;" class="article-id">${article.id}</span>
								<!-- 文章信息 -->
								<div class="article-info">
									<!-- 缩略图（没有缩略图就加载默认缩略图） -->
									<img src="${article.thumbnail ? article.thumbnail : '/eat-easy-background/public/static/img/缩略图.png'}" class="thumbnail">
									<div class="title-time-wrapper">
										<!-- 文章标题 -->
										<h2 class="article-title">${article.title}</h2>
										<!-- 修改时间 -->
										<div class="publish-time">${article.modify_time}</div>
									</div>
								</div>
								<!-- 操作 -->
								<div class="article-operate">
									<button class="modify">修改</button>
								</div>
							</li>
						`;
						
					});
					
					// 拼接完后添加到article-list中
					$(".article-list").html(allArticle);
					
				}
			});
		}
		
		// 默认渲染已发布文章
		renderArticle(merchant_id, "published");
		
		// 点击文章状态tab栏
		$(".content-status .content-status-list a").on("click", function () {
			// 进行切换
			$(".content-status .content-status-list a").removeClass("active");
			$(this).addClass("active");
			
			// 获取state
			var state;
			if($(this).hasClass("published")) {
				state = "published";
			} else if($(this).hasClass("unpass")) {
				state = "unpass";
			} else if($(this).hasClass("draft")) {
				state = "draft";
			}
			
			// 渲染对应状态的文章列表
			renderArticle(merchant_id, state);
		});
		
		// 点击修改按钮
		$(".article-list").on("click", function (e) {
			if($(e.target).hasClass("modify")) {
				// console.log(e.target.parentNode.parentNode.firstElementChild.innerHTML);
				var id = e.target.parentNode.parentNode.firstElementChild.innerHTML;
				
				location.href = `http://${serverName}/eat-easy-background/public/merchant/content_manage/loadModifyArticlePage?id=${id}`;
			}
			
		});
	});
</script>
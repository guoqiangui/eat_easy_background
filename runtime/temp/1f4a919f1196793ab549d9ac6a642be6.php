<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:120:"D:\phpStudy\PHPTutorial\WWW\eat-easy-background\public/../application/merchant\view\publish_article\publish-article.html";i:1558928128;}*/ ?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title></title>
		<link rel="stylesheet" href="/eat-easy-background/public/static/css/base.css">
		<link rel="stylesheet" href="/eat-easy-background/public/static/css/b-publish-article.css">
	</head>
	<body>
		<div class="wrapper">
			<!-- 输入文章标题 -->
			<div class="title-input">
				<label for="titleInput">文章标题</label>
				<input type="text" placeholder="请输入文章标题" id="titleInput">
			</div>
			<!-- 编辑器 -->
			<div id="editor" class="text-editor"></div>
			<!-- 操作按钮 -->
			<div class="operate-btn-wrapper">
				<ul class="operate-btn-list">
					<li class="operate-btn-item">
						<a href="javascript:;" class="operate-btn publish">发布</a>
					</li>
					<li class="operate-btn-item">
						<a href="javascript:;" class="operate-btn preview">预览</a>
					</li>
					<li class="operate-btn-item">
						<a href="javascript:;" class="operate-btn draft">存为草稿</a>
					</li>
				</ul>
			</div>
			<!-- 预览文章的模态框 -->
			<div class="preview-modal">
				<div class="preview-content-wrapper">
					<button class="btn-close" title="关闭">X</button>
					<div class="preview-content">
						<h1 class="title"></h1>
						<div class="article"></div>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>
<script src="/eat-easy-background/public/static/lib/jquery-1.11.1.min.js"></script>
<script src="/eat-easy-background/public/static/lib/wangEditor/wangEditor.min.js"></script>
<script type="text/javascript">
	// 初始化wangEditor
	var E = window.wangEditor;
	var editor = new E("#editor");
	
	// 开启debug模式
	editor.customConfig.debug = true;
	
	// 配置服务器端地址(显示上传图片必不可少)
	editor.customConfig.uploadImgServer = "<?php echo url('merchant/upload/uploadImg'); ?>";
	
	// 文件名称(参数名), 如果上传多张图片就不用设置
	// editor.customConfig.uploadFileName = "file";
	
	// 设置header
// 	editor.customConfig.uploadImgHeaders = {
// 		'Accept': 'text/json'
// 	};
	
	// 最后创建编辑器
	editor.create();
	
	
	var serverName = "localhost:8080";
	
	// 点击发布
	$(".operate-btn.publish").on("click", function () {
		// 获得标题
		var title = $("#titleInput").val();
		// 获得文章内容
		var content = editor.txt.html();
		// console.log(content);
		// console.log(typeof content);	// string
		
		$.ajax({
			url: `http://${serverName}/eat-easy-background/public/merchant/publish_article/reqPublishArticle`,
			type: "post",
			data: {
				merchant_id: <?php echo \think\Session::get('merchant.id'); ?>,
				title: title,
				content: content
			},
			success: function (data) {
				alert("提交成功，请等待审核");
			}
		});
	});
	
	// 点击预览
	$(".operate-btn.preview").on("click", function () {
		// 获得标题
		var title = $("#titleInput").val();
		// 获得文章内容
		var content = editor.txt.html();
		
		// 将编辑的内容和标题添加到其中并显示模态框, 这里只能用find(), children()只能找子元素
		$(".preview-modal").show().find(".title").html(title).siblings(".article").html(content);
	});
	
	// 隐藏模态框(利用冒泡)
	$(".preview-modal").on("click", function (e) {
		// 点击非预览区域或点击了关闭预览按钮，隐藏模态框
		if($(e.target).hasClass("preview-modal") || $(e.target).hasClass("btn-close")) {
			$(this).hide();
		}
	});
	
	// 点击存为草稿
	$(".operate-btn.draft").on("click", function () {
		// 获得标题
		var title = $("#titleInput").val();
		// 获得文章内容
		var content = editor.txt.html();
		
		$.ajax({
			url: `http://${serverName}/eat-easy-background/public/merchant/publish_article/saveAsDraft`,
			type: "post",
			data: {
				merchant_id: <?php echo \think\Session::get('merchant.id'); ?>,
				title: title,
				content: content
			},
			success: function (data) {
				alert("存为草稿成功");
			}
		});
	});
</script>
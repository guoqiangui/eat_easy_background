<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:117:"D:\phpStudy\PHPTutorial\WWW\eat-easy-background\public/../application/admin\view\merchant_manage\merchant-manage.html";i:1558595236;}*/ ?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>商家管理</title>
		<link rel="stylesheet" href="/eat-easy-background/public/static/css/base.css">
		<link rel="stylesheet" href="/eat-easy-background/public/static/css/b-comment-manage.css">
	</head>
	<body>
		<div class="wrapper">
			<!-- 顶部工具栏 -->
			<div class="toolbar">
				<!-- 左侧导航栏 -->
				<div class="nav-bar">
					<ul class="nav-list">
						<li class="nav-list-item"><a href="<?php echo url('admin/merchant_manage/index'); ?>" class="all-vips <?php echo $type == 'all' ? 'active' : '' ?>">全部商家（<span><?php echo $allMerchantNum; ?></span>）</a></li>
						<li class="nav-list-item separator">|</li>
						<li class="nav-list-item"><a href="<?php echo url('admin/merchant_manage/queryAllNewMerchant'); ?>" class="new-vips <?php echo $type == 'new' ? 'active' : '' ?>">新增商家（<span><?php echo $newMerchantNum; ?></span>）</a></li>
					</ul>
				</div>
				<!-- 右侧搜索 -->
				<div class="search" method="post">
					<form action="<?php echo url('admin/merchant_manage/searchMerchant'); ?>" method="post">
						<input type="text" placeholder="搜商家" name="merchant_name">
						<button class="btn-search">搜索</button>
					</form>
				</div>
			</div>
			<!-- 评论管理区域 -->
			<div class="comment-manage">
				<table>
					<thead>
						<tr>
							<th>序号</th>
							<th>头像</th>
							<th>昵称</th>
							<th>标签</th>
							<th>申请时间</th>
							<th>操作</th>
						</tr>
					</thead>
					<tbody>
						<?php
						if($merchantArr) {
							foreach($merchantArr as $value) {
						?>
								<tr>
									<td><?php echo $value['id'] ?></td>
									<!-- 没有头像就指定默认头像 -->
									<td><img src="<?php echo $value['avatar'] ? $value['avatar'] : '/eat-easy-background/public/static/img/avatar.png'?>" class="avatar"></td>
									<td><?php echo $value['merchant_name'] ?></td>
									<!-- 没有标签显示无 -->
									<td><?php echo $value['tag'] ? $value['tag'] : "无" ?></td>
									<td><?php echo $value['apply_time'] ?></td>
									<td>
										<button class="btn-modify">修改</button>
										<button class="btn-delete">删除</button>
									</td>
								</tr>
						<?php
							}
						} else {
							echo '<h3 style="color: red;">无法查找到数据</h3>';
						}
						?>
						<!-- <tr>
							<td>01</td>
							<td><img src="/eat-easy-background/public/static/img/1545709431162.jpg" class="avatar"></td>
							<td>萧远山</td>
							<td>vip</td>
							<td>知名吃货</td>
							<td>223</td>
							<td>483</td>
							<td>346</td>
							<td>2017-03-12 16:47</td>
							<td>
								<button class="btn-modify">修改</button>
								<button class="btn-delete">删除</button>
							</td>
						</tr> -->
					</tbody>
				</table>
			</div>
			<!-- 点击修改按钮弹出的模态框 -->
			<div class="modify-modal">
				<div class="modify-info">
					<form action="<?php echo url('admin/merchant_manage/modifyMerchantInfo'); ?>" method="post">
						<!-- 隐藏的id -->
						<input type="hidden" id="merchant_id" name="id">
						<div class="form-item">
							<span class="field-name">昵称：</span><input type="text" name="merchant_name" id="merchant_name">
						</div>
						<div class="form-item">
							<span class="field-name">标签：</span><input type="text" name="tag" id="tag">
						</div>
						<div class="form-item">
							<span class="field-name">申请时间：</span><input type="text" name="apply_time" id="apply_time">
						</div>
						<input type="submit" value="提交更改" class="btn-submit-modify">
					</form>
				</div>
			</div>
		</div>
	</body>
</html>
<script src="/eat-easy-background/public/static/lib/jquery-1.11.1.min.js"></script>
<script>
	$(function () {
		// 服务器名字
		var serverName = "localhost:8080";
		
		// 点击顶部tab栏, 
		$(".toolbar .nav-bar a").on("click", function () {
			//切换active类
			// 全部移除active
			$(".toolbar .nav-bar a").removeClass("active");
			
			$(this).addClass("active");
		});
		
		// 点击修改按钮
		$(".comment-manage .btn-modify").on("click", function () {
			// 弹出模态框
			$(".modify-modal").show();
			
			// 获取id
			var id = $(this).parent().parent().children(":first-child").html();
			
			// 请求服务器查询该id的商家信息
			$.ajax({
				url: `http://${serverName}/eat-easy-background/public/admin/merchant_manage/queryMerchantInfo`,
				type: "post",
				data: {
					id: id
				},
				success: function (data) {
					// 将商家信息渲染到表单中
					var obj = JSON.parse(data);
					
					console.log(obj);
					
					$("#merchant_id").val(obj.id);
					$("#merchant_name").val(obj.merchant_name);
					$("#tag").val(obj.tag);
					$("#apply_time").val(obj.apply_time);
				},
				error: function () {
					alert("服务器出错");
				}
			});
		});

		
		// 点击其他地方隐藏模态框
		$(".modify-modal").on("click", function (e) {
			if(e.target.className == "modify-modal") {
				$(this).hide();
			}
		});
		
		
		// 点击删除按钮
		$(".comment-manage .btn-delete").on("click", function () {
			// 获取id
			var id = $(this).parent().parent().children(":first-child").html();

			$.ajax({
				url: `http://${serverName}/eat-easy-background/public/admin/merchant_manage/deleteMerchant`,
				type: "post",
				data: {
					id: id
				},
				success: function (data) {
					// 重新渲染页面
					$("body").html(data);
				},
				error: function () {
					alert("服务器出错");
				}
			});
		});
	});
</script>
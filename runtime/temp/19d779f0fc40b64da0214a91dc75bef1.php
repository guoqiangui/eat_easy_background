<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:113:"D:\phpStudy\PHPTutorial\WWW\eat-easy-background\public/../application/admin\view\profit_manage\profit-manage.html";i:1558166620;}*/ ?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title></title>
		<link rel="stylesheet" href="/eat-easy-background/public/static/css/base.css">
		<link rel="stylesheet" href="/eat-easy-background/public/static/css/e-profit-manage.css">
	</head>
	<body>
		<div class="wrapper">
			<div class="profit-situation-container">
				<div class="title">
					<h1>收益概况</h1>
					<form action="<?php echo url('admin/profit_manage/profitChart'); ?>">
						<button class="show-table-btn">报表</button>
					</form>
				</div>
				<div class="profit-situation">
					<ul class="profit-list">
						<li class="profit-item">
							<p>总收益</p>
							<p>￥<?php echo $vipProfit + $adProfit + $othersProfit; ?></p>
						</li>
						<li class="profit-item">
							<p>会员收益</p>
							<p>￥<?php echo $vipProfit; ?></p>
						</li>
						<li class="profit-item">
							<p>广告收益</p>
							<p>￥<?php echo $adProfit; ?></p>
						</li>
						<li class="profit-item">
							<p>其他收益</p>
							<p>￥<?php echo $othersProfit; ?></p>
						</li>
					</ul>
				</div>
				
			</div>
			
			<!-- 收益管理 -->
			<div class="profit-manage">
				<table>
					<thead>
						<tr>
							<th>日期</th>
							<th>会员</th>
							<th>广告</th>
							<th>其他</th>
						</tr>
					</thead>
					<tbody>
						<?php
						foreach($profitArr as $value) {
						?>
						<tr>
							<td><?php echo $value['profit_time'] ?></td>
							<td><?php echo $value['type'] === 'vip' ? $value['profit'] : 0 ?></td>
							<td><?php echo $value['type'] === 'ad' ? $value['profit'] : 0 ?></td>
							<td><?php echo $value['type'] === 'others' ? $value['profit'] : 0 ?></td>
						</tr>
						<?php
						}
						?>
					</tbody>
				</table>
			</div>
		</div>
	</body>
</html>

<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:113:"D:\phpStudy\PHPTutorial\WWW\eat-easy-background\public/../application/admin\view\data_analysis\data-analysis.html";i:1558157874;}*/ ?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>数据分析</title>
		<link rel="stylesheet" href="/eat-easy-background/public/static/css/base.css">
		<style>
			body, html {
				width: 100%;
				height: 100%;
			}
			#cvs {
				display: block; /*消除底部白边*/
				/* 不能用css设置canvas的宽高，会有拉伸的问题 */
				/* width: 100%;
				height: 100%; */
			}
		</style>
	</head>
	<body>
		<canvas id="cvs">您的浏览器不支持canvas，请升级浏览器</canvas>
	</body>
</html>
<script src="/eat-easy-background/public/static/lib/jquery-1.11.1.min.js"></script>
<script>
	$(function () {
		// 获取绘图环境
		var cvs = $("#cvs")[0];
		var ctx = cvs.getContext("2d");
		
		// 使canvas自适应屏幕
		function fitScreen() {
			// 还是不能设置css, 只能设置html属性
			cvs.width = $(document.body).width();
			cvs.height = $(document.body).height();
		}
		
		/*
		画直线的方法
			参数：画图环境、起点x轴、起点y轴、终点x轴、终点y轴
			lineWidth: 线条宽度
			color: 线条颜色
			dashArr：可选，是画虚线用的数组
		*/
		function drawLine(ctx, beginX, beginY, endX, endY, lineWidth, color, dashArr) {
			// 重新画
			ctx.beginPath();
			
			ctx.lineWidth = lineWidth;
			
			ctx.strokeStyle = color;
			
			if(dashArr) {
				ctx.setLineDash(dashArr);
			}
			ctx.moveTo(beginX, beginY);
			ctx.lineTo(endX, endY);
			ctx.stroke();
		}
		
		/*
		画条形图
		参数: 
			ctx: 绘图环境
			arr: 数组，按照新增用户、活跃用户、新增会员数、商家数、发文数的顺序依次存入
			textArr: 数轴上的点的文字
		*/
		function drawBarChart(ctx, arr, textArr) {
			// 颜色数组
			var colorArr = ["#FFBBFF", "#FF6347", "#BF3EFF", "#98FB98", "#71C671", "#6495ED", "#EEEE00", "#FF7F50", "#E0FFFF", "#B22222"];	
			
			// 获取当前cvs的宽高
			var cvsWidth = $(document.body).width();
			var cvsHeight = $(document.body).height();
			
			// 值为0的线
			drawLine(ctx, cvsWidth * 0.2, cvsHeight * 0.8, cvsWidth * 0.8, cvsHeight * 0.8, 2, "black");
			// 画完剩下的五条线
			drawLine(ctx, cvsWidth * 0.2, cvsHeight * (1 - 0.32), cvsWidth * 0.8, cvsHeight * (1 - 0.32), 2, "black", [5, 15]);
			drawLine(ctx, cvsWidth * 0.2, cvsHeight * (1 - 0.44), cvsWidth * 0.8, cvsHeight * (1 - 0.44), 2, "black");
			drawLine(ctx, cvsWidth * 0.2, cvsHeight * (1 - 0.56), cvsWidth * 0.8, cvsHeight * (1 - 0.56), 2, "black");
			drawLine(ctx, cvsWidth * 0.2, cvsHeight * (1 - 0.68), cvsWidth * 0.8, cvsHeight * (1 - 0.68), 2, "black");
			drawLine(ctx, cvsWidth * 0.2, cvsHeight * 0.2, cvsWidth * 0.8, cvsHeight * 0.2);
			
			
			
			// 画横坐标上的五个点, 并在横坐标五个点下画文字
			ctx.beginPath();
			ctx.font = "12px 微软雅黑";
			// 设置文字对齐方式
			ctx.textAlign = "center";
			for(var i = 1; i <= arr.length; i ++) {
				ctx.beginPath();
				ctx.arc(cvsWidth * (0.2 + 0.6 / (arr.length + 1) * i), cvsHeight * 0.8, 3, 0, 2 * Math.PI);
				ctx.fill();
				
				ctx.fillText(textArr[i-1], cvsWidth * (0.2 + 0.6 / (arr.length + 1) * i), cvsHeight * 0.83);
			}
			
			
			// 画横坐标上的五个数, 根据最大值的大小来选择刻度
			// 获取arr中的最大值
			var maxValue = arr[0];
			arr.forEach(function (value) {
				if(maxValue < value) {
					maxValue = value;
				}
			});
			
			// 计算基本单位
			// 计算数字最大长度的以1开头的数字, 例如2500会得到1000, 即4位得到1000
			function getBaseNum(maxValue) {
				// 获取最大的数字有多少位
				var numLength = (maxValue + "").length;
				
				if(numLength === 1) {
					return 1;
				}
				
				var baseNum = "1";
				for(var i = 0; i < numLength - 1; i++) {
					// 在后面加0
					baseNum = baseNum + "0";
				}
				
				return baseNum;
			}
			
			var baseNum = getBaseNum(maxValue);
			
			// 获取最大的数字的第一位
			var first = (maxValue + "")[0];
			// 坐标轴上的最大值
			var coordMax;
			// 如果小于2, 则坐标轴上的最大值取3*baseNum, 以下类似
			if(first < 2) {
				coordMax = 2 * baseNum;
			} else if(first < 4) {
				coordMax = 4 * baseNum;
			} else if(first < 6) {
				coordMax = 6 * baseNum;
			} else if(first < 8) {
				coordMax = 8 * baseNum;
			} else {
				coordMax = 10 * baseNum;
			}
			// 根据坐标轴上的最大值来画5个刻度(画数字)
			ctx.textAlign = "right";
			ctx.textBaseline = "middle";
			for(var i = 0; i <= 5; i++) {
				ctx.fillText(coordMax * i/5, cvsWidth * 0.17, cvsHeight * (1 - (0.2 + i*0.12)));
			}
			
			// 坐标上标出5个点
			ctx.textAlign = "center";
			arr.forEach(function (value, index) {
				// 获取当前值占坐标轴最大值的比例
				var scale = value / coordMax;
				// 计算点在canvas中的坐标
				var coordX = cvsWidth * (0.2 + 0.6 / (arr.length + 1) * (index + 1));
				var coordY = cvsHeight * (1 - (0.2 + 0.6 * scale));
				
				// 在点的上面标上值
				ctx.fillStyle = colorArr[index];
				ctx.fillText(value, coordX, coordY - 15);
			});
			
			// 画矩形
			arr.forEach(function (value, index) {
				ctx.beginPath();
				
				// 获取当前值占坐标轴最大值的比例
				var scale = value / coordMax;
				// 计算点在canvas中的坐标
				var coordX = cvsWidth * (0.2 + 0.6 / (arr.length + 1) * (index + 1));
				var coordY = cvsHeight * (1 - (0.2 + 0.6 * scale));
				
				// 画矩形
				var rectWidth = 0.6 * cvsWidth / (arr.length + 1);	// 矩形宽
				var rectHeight = 0.8 * cvsHeight - coordY;	// 矩形高
				ctx.rect(coordX - rectWidth / 2, coordY, rectWidth, rectHeight);
				// 填充颜色
				ctx.fillStyle = colorArr[index];
				ctx.fill();
			});
		}
		
		// 横坐标上五个点的文字
		var textArr = ["新增用户", "活跃用户", "新增会员数", "商家数", "发文数"];
		
		// 读取服务器的json数据
		var dataJson = <?php echo $dataJson; ?>;
		
		
		fitScreen();
		// 预先画一次
		drawBarChart(ctx, dataJson, textArr);
		
		// 让canvas在屏幕改变的时候自适应屏幕大小, 并根据屏幕的大小来画折线图
		$(window).on("resize", function () {
			fitScreen();
			
			drawBarChart(ctx, dataJson, textArr);
		});
	});
	
	
	
	
</script>
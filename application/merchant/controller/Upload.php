<?php
namespace app\merchant\controller;
use think\Controller;

// 上传图片(支持多图片上传)
class Upload extends Controller {
	// 要给编辑器的接口格式
	// 		{
	// 			"errno": 0,
	// 			"data": [
	// 				"图片1线上地址",
	// 				"图片2线上地址",
	// 				...
	// 			]
	// 		}
	public function uploadImg() {
		// 获取上传的文件
		$files = request() -> file();
		// dump($files);
		
		// 放置文件在服务器地址的数组
		$urlArr = [];
		
		foreach ($files as $file) {
			if($file) {
				// 将文件移动到/public/uploads/目录下
				$info = $file -> move(ROOT_PATH . 'public' . DS . 'uploads');
				
				if($info) {
					// 服务器名字
					$serverName = 'localhost:8080';
					// 得到uploads下的路径
					$saveName = str_replace('\\','/',$info -> getSaveName());	// 将\换成/
					// 拼接出图片的url
					$url = "http://$serverName/eat-easy-background/public/uploads/$saveName";
					// 添加到urlArr中
					array_push($urlArr, $url);
				} 
			}
		}
		
		// 返回给服务器的数据
		$data = [
			'errno' => 0,
			'data' => $urlArr
		];
		
		return json($data);
	}
}
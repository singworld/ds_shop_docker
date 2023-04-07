<?php 
@header('Content-Type: text/html; charset=UTF-8');
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta charset="utf-8" />
    <meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no, width=device-width">
    <link href="//cdn.staticfile.org/ionic/1.3.2/css/ionic.min.css" rel="stylesheet" />
</head>
<body>
<div class="bar bar-header bar-light" align-title="center">
	<h1 class="title">支付结果页面</h1>
</div>
<div class="has-header" style="padding: 5px;position: absolute;width: 100%;">
<div class="text-center" style="color: #a09ee5;">
<i class="icon ion-checkmark-circled" style="font-size: 80px;"></i><br>
<span>支付成功，请回到浏览器查看订单</span>
</div>
</div>
<script>
document.body.addEventListener('touchmove', function (event) {
	event.preventDefault();
},{ passive: false });
</script>
</body>
</html>
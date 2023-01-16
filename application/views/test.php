<!DOCTYPE html>
<html>
<head>
	<title>test spinner</title>
	<style type="text/css">
	.load {
	border: 16px solid #000;
	border-radius:50%;
	border-top: 16px solid white;
	width:120px;
	height:120px;
	animation: rotate 2s linear infinite;
}

@keyframes rotate {
	0% {transform: rotate (0deg);}
	100% {transform: rotate (360deg)}
}
	</style>
</head>
<body>
	<div class="sweet_loader">
<div class="spinner-border text-primary"></div></div>
<div class="load"></div>
</body>
</html>
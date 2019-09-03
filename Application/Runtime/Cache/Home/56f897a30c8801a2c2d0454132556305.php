<?php if (!defined('THINK_PATH')) exit();?> <DOCTYPE html>
 <html lang="en">
 <head>
 	<meta charset="UTF-8">
 	<title>发表留言</title>
 </head>
 <body align="center">
 <h1>发表留言</h1>
<form action="/th3/index.php/Home/Index/do_post" method="post">
	<label for="content">留言内容</label><br>
	<textarea name="content"  id="content" rows="4" maxlength="100" required></textarea><br>
	<button>发表</button>
	<button type="reset">重置</button>
</form>

	<p>
		<a href="/th3/index.php/Home/Index/index">首页</a>
	</p>
</body>
</html>
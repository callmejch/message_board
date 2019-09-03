<?php if (!defined('THINK_PATH')) exit();?> <DOCTYPE html>
 <html lang="en">
 <head>
 	<meta charset="UTF-8">
 	<title>留言列表</title>
 </head>
 <body align="center">
 <h1>留言板</h1>

	 <div >
	 	<?php if(empty($_SESSION['user']['username'])): ?><a href="<?php echo U('User/login');?>">登录</a>
	 		<a href="<?php echo U('User/register');?>">注册</a>
	 		<?php else: ?>
	 		欢迎您！<?php echo ($_SESSION['user']['username']); ?>
	 		<a href="/th3/index.php/Home/Index/post"><strong>发表留言</strong></a><a href="<?php echo U('User/logout');?>">退出登录</a><?php endif; ?>
	</div align="center">
	<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($i % 2 );++$i;?><div align="center">
			<?php echo ($item["content"]); ?><br/>
			留言者：<?php echo ($item["username"]); ?>
			留言时间：<?php echo (date('Y-m-d H:i:s',$item["created_at"])); ?>
			<?php if(($_SESSION['user']['userId']) == $item["user_id"]): ?><a href="<?php echo U('delete?id='.$item['message_id']);?>" onclick="return confirm('确定删除这条留言？')">删除</a><?php endif; ?>
		</div><?php endforeach; endif; else: echo "" ;endif; ?>

<p align="center">
	<?php echo ($page); ?>
</p>
</body>
</html>
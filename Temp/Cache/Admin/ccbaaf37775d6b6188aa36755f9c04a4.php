<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel='stylesheet' type='text/css' href='__PUBLIC__/Admin/css/admin_style.css' />
<script type="text/javascript" src="__PUBLIC__/js/jquery.min.js"></script>
<script type="text/javascript" src="__PUBLIC__/js/formValidator.js"></script>
<script type="text/javascript">
</script>
</head>
<body>
		
			<table width="100%" border="0" cellpadding="4" cellspacing="1" class="table">

				<tr class="tr rt">
					<td width="100">展位：</td>
					<td colspan="3" class="lt"><?php echo ($info["exposition"]); ?>						
					</td>
				</tr>
				<tr class="tr rt">
					<td width="100">展会：</td>
					<td colspan="3" class="lt"><?php echo ($expoName); ?>
					</td>
				</tr>
				<tr class="tr rt">
					<td width="100">电话：</td>
					<td colspan="3" class="lt"><?php echo ($info["phone"]); ?>
					</td>
				</tr>
				<tr class="tr rt">
					<td width="100">类型：</td>
					<td colspan="3" class="lt"><?php echo ($info["type"]); ?>
					</td>
				</tr>
				<tr class="tr rt">
					<td width="100">传真：</td>
					<td colspan="3" class="lt">
						<?php echo ($info["fax"]); ?>
					</td>
				</tr>
				<tr class="tr rt">
					<td width="100">联系人：</td>
					<td colspan="3" class="lt">
						<?php echo ($info["person"]); ?>
					</td>
				</tr>
				<tr class="tr rt">
					<td width="100">地址：</td>
					<td colspan="3" class="lt"><?php echo ($info["address"]); ?>
					</td>
				</tr>
				<tr class="tr rt">
					<td width="100">邮编：</td>
					<td colspan="3" class="lt"><?php echo ($info["zipcode"]); ?>						
					</td>
				</tr>
				<tr class="tr rt">
					<td width="100">E-mail：</td>
					<td colspan="3" class="lt"><?php echo ($info["email"]); ?>						
					</td>
				</tr>
				<tr class="tr rt">
					<td width="100">网站：</td>
					<td colspan="3" class="lt"><?php echo ($info["website"]); ?>
					</td>
				</tr>
				<tr class="tr rt">
					<td width="100">图片：</td>
					<td colspan="3" class="lt"><?php echo ($info["pic"]); ?>						
					</td>	
				</tr>
</table>
</body>
</html>
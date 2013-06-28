<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?php echo ($tpltitle); ?>后台用户</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel='stylesheet' type='text/css' href='__PUBLIC__/Admin/css/admin_style.css' />
<script type="text/javascript" src="__PUBLIC__/js/jquery.min.js"></script>
<script type="text/javascript" src="__PUBLIC__/js/formValidator.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
			alt=true;			
			$("#checkall").click(function() {						
					$(".check").each(function() { 
						$(this).attr("checked", alt); 						
					}); 					
				alt =! alt;	
			}); 

		$.formValidator.initConfig({formid:"myform",autotip:true,onerror:function(msg,obj){
			window.top.art.dialog({content:msg,lock:true,width:250,height:100,ok:function(){$(obj).focus();}});
		}});
		$("#username").formValidator({onshow:"请输入用户名",onfocus:"用户名至少3个字符,最多50个字符",oncorrect:"输入正确"}).inputValidator({min:3,empty:{leftempty:false,rightempty:false,emptyerror:"两边不能有空符号"},onerror:"你输入的用户名非法,请确认"})
		    .ajaxValidator({
			datatype : "json",
			async : true,
			type: "GET",
			url : "<?php echo U('/Admin/User/check_username',array('userid'=>$info['id']));?>",
			success : function(data){
	            if( data == "0" ){
	            	return true;
	            }else{
	            	return false;
	            }
			},
			error: function(){
				window.top.art.dialog({content:"服务器没有返回数据，可能服务器忙，请重试",lock:true,width:250,height:100,ok:function(){}});
			},
			onerror : "该用户名已存在，请更换",
			onwait : "用户名校验中..."
		})<?php if(($info["id"]) > "0"): ?>.defaultPassed()<?php endif; ?>;


		$("#password").formValidator({<?php if(($info["id"]) > "0"): ?>empty:true,<?php endif; ?>onshow:"请输入密码",onfocus:"至少6个长度",oncorrect:"密码合法"}).inputValidator({min:6,empty:{leftempty:false,rightempty:false,emptyerror:"密码两边不能有空符号"},onerror:"密码不能为空,请确认"});
		$("#repassword").formValidator({<?php if(($info["id"]) > "0"): ?>empty:true,<?php endif; ?>onshow:"输再次输入密码",onfocus:"至少6个长度",oncorrect:"密码一致"}).inputValidator({min:6,empty:{leftempty:false,rightempty:false,emptyerror:"重复密码两边不能有空符号"},onerror:"重复密码不能为空,请确认"}).compareValidator({desid:"password",operateor:"=",onerror:"两次密码不一致,请确认"});
		$("#remark").formValidator({empty:true,onshow:"请输入你的描述"}).inputValidator({max:250,onerror:"描述不能超过250个字符,请确认"});

	});
	checkedvalues=[];
		function getCheckedValues () {
			// body...
			checkedvaluess= []
			$(".check").each(function() { 						
						if($(this).attr("checked")){
							checkedvalues.push($(this).attr("value"))							
						}
			}); 
		}
</script>

</head>
<body>
		<?php if(($info["id"]) > "0"): ?><form action="<?php echo U('/Admin/User/edit');?>" method="post" name="form" id="myform">
			<input type="hidden" name="id" value="<?php echo ($info["id"]); ?>">
		<?php else: ?>
			<form action="<?php echo U('/Admin/User/add');?>" method="post" name="form" id="myform"><?php endif; ?>
			<table width="98%" border="0" cellpadding="4" cellspacing="1" class="table">

				<tr class="table_title">
					<td colspan="4"><?php echo ($tpltitle); ?>后台用户</td>
				</tr>
				<tr class="tr rt">
					<td width="100">公司名称：</td>
					<td colspan="3" class="lt">					

						<input type="text" name="company" id="company" style="width:200px" value="<?php echo ($company); ?>" <?php if(($username) != C("SPECIAL_USER")): ?>readonly="readonly" value="<?php echo ($company); ?>"<?php endif; ?>>
					</td>
				</tr>
				<tr class="tr rt">
					<td width="100">用户名称：</td>
					<td colspan="3" class="lt">
						<input type="text" name="username" id="username" style="width:200px" value="<?php echo ($info["username"]); ?>" <?php if(($info["username"]) == C("SPECIAL_USER")): ?>readonly="readonly"<?php endif; ?>>
					</td>
				</tr>
				<tr class="tr rt">
					<td width="100">密　　码：</td>
					<td colspan="3" class="lt">
						<input type="password" name="password" id="password" style="width:200px" value="">
					</td>
				</tr>
				<tr class="tr rt">
					<td width="100">确认密码：</td>
					<td colspan="3" class="lt">
						<input type="password" name="repassword" id="repassword" style="width:200px" value="">
					</td>
				</tr>
				<?php if(($username) == C("SPECIAL_USER")): ?><tr class="tr rt">
						<td width="100">用户角色：</td>
						<td colspan="3" class="lt">
							<select name="role">
								<?php if(is_array($role)): $i = 0; $__LIST__ = $role;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["id"]); ?>" <?php if(($vo["id"]) == $info["role"]): ?>selected=""<?php endif; ?> ><?php echo ($vo["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
							</select>
						</td>
					</tr><?php endif; ?>				
				<tr class="tr rt">
					<td >用户状态：</td>
					<td colspan="3" class="lt">
						<input type="radio" class="radio" value="1" name="status" id="status1" <?php if(($info["status"] == 1) OR ($info['status'] == '') ): ?>checked=""<?php endif; ?> >
							启用
							<input type="radio" class="radio" value="0" name="status" id="status2" <?php if(($info["status"]) == "0"): ?>checked=""<?php endif; ?> >
							关闭
					</td>
				</tr>
				<tr class="tr rt">
					<td >机器码：</td>
					<td colspan="3" class="lt">
						<input type="text" name="auth_id" id="mac" style="width:200px" value="<?php echo ($info["auth_id"]); ?>">						
					</td>
				</tr>
				<tr class="tr rt">
					<td >备注说明：</td>
					<td colspan="3" class="lt">
						<input type="text" name="remark" id="remark" style="width:400px" value="<?php echo ($info["remark"]); ?>">
					</td>
				</tr>
	<tr class="tr lt">
		<td colspan="4">
			<?php if(($info["id"]) > "0"): ?><input class="bginput" type="submit" name="dosubmit" value="修 改" >
				<?php else: ?>
				<input class="bginput" type="submit" name="dosubmit" value="添 加"><?php endif; ?>
			&nbsp;
			<input class="bginput" type="button" onclick="javascript:history.back(-1);" value="返 回" ></td>
	</tr>
</table>
<table width="100%" border="0" cellpadding="10" cellspacing="1" class="table">
		<tr class="list_head ct">
				<td width="30"><input type="checkbox" id="checkall"/></td>
				<td width="70">编号</td>
				<td >名称</td>				
			</tr>
	    <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr class='<?php if(($mod) == "1"): ?>tr<?php else: ?>ji<?php endif; ?>'>
				<td align='center'><input class="check" type="checkbox" name='checkname[]' value='<?php echo ($vo["id"]); ?>'/></td>
				<td align='center'><?php echo ($vo["id"]); ?></td>
				<td ><a href="<?php echo U('/Admin/Company/index/',array('eid'=>$vo['id']));?>"><?php echo ($vo["name"]); ?></a>
				</td>				
			</tr><?php endforeach; endif; else: echo "" ;endif; ?>
		<tr class="tr">
          <td colspan="10" class="pages">
            <?php echo ($page); ?>
          </td>
        </tr>
	</table>
</form>
﻿<style>
#footer, #footer a:link, #footer a:visited {
	clear:both;
	color:#0072e3;
	font:12px/1.5 Arial;
	margin-top:10px;
	text-align:center;
	white-space:nowrap;
}
</style>
<div id="footer">程序版本：<?php echo (C("cms_var")); ?>&nbsp;&nbsp;&nbsp;&nbsp;Copyright © 2011-2012 All rights reserved</div>
</body>
</html>
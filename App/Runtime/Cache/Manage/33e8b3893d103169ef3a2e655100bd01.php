<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>后台管理中心</title>
<link rel='stylesheet' type="text/css" href="__PUBLIC__/css/style.css" />
<script type="text/javascript" src="__PUBLIC__/js/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="__PUBLIC__/js/common.js"></script>
<script language="JavaScript">
    <!--
    var URL = '__URL__';
    var APP	 = '__APP__';
    var SELF='__SELF__';
    var PUBLIC='__PUBLIC__';
    //-->
</script>
</head>
<body>
	<style type="text/css">
html {
	_overflow-y: scroll
}
</style>
	<div style="min-width: 780px">

		<div class="column">
			<dl class="dbox winbg1" id="item3">
				<dt class="lside">
					<div class="l">我的个人信息</div>
				</dt>
				<dd>
					<div class="content">
						您好，<?php echo (session('zhtx_adm_username')); ?><br />
						<div class="clear"></div>
						上次登录时间：<?php echo (session('zhtx_adm_logintime')); ?>&nbsp;&nbsp;<br />
						上次登录IP：<?php echo (session('zhtx_adm_loginip')); ?> <br />
					</div>
				</dd>
			</dl>
			<dl class="dbox winbg1" id="item3">
				<dt class="lside">
					<div class="l">系统信息</div>
				</dt>
				<dd>
				    <div class="content">
					<table width="100%" border="0" cellspacing="0" cellpadding="0"
						class="home_table">
						<tr>
							<td height="32" colspan="2">软件版本号： <span title="ZHTXCMS V<?php echo ($cms_info["ZHTXCMS_VER"]); ?>">ZHTXCMS V<?php echo ($cms_info["ZHTXCMS_VER"]); ?></span></td>
						</tr>
						<tr>
							<td width="50%" height="32">服务器版本： <span
								title="Microsoft-IIS/7.5"><?php echo $_SERVER['SERVER_SOFTWARE'];?></span></td>
							<td width="50%">操作系统：<?php echo PHP_OS;?></td>
						</tr>
						<tr>
							<td height="32">PHP版本号： <?php echo PHP_VERSION;?></td>
							<td>GDLibrary： <span class="ture"><?php echo extension_loaded('gd')?'支持':'不支持';?></span></td>
						</tr>
						<tr>
							<td height="32">MySql版本： <?php echo getDbVersion();?></td>
							<td height="28">ZEND支持： <span class="ture"><?php echo extension_loaded('zend')?'支持':'不支持';?></span></td>
						</tr>
						<tr>
							<td height="32">ZIP扩展： <?php echo extension_loaded('zip')?'开启':'未开启';?></td>
							
						</tr>
						<tr class="nb">
							<td height="32" colspan="2">支持上传的最大文件：<?php echo ini_get('upload_max_filesize')?></td>
						</tr>
					</table>
					</div>
				</dd>
			</dl>
		</div>

		<div class="column">

			<dl class="dbox winbg2" id="item1">
				<dt class="lside">
					<span class="l">系统提示</span>
				</dt>
				<dd>
					<div id="safelist" class="content">
						1.取消uploads目录的执行权限！<br /> 2.本程序为了加速网站访问,大量使用缓存,如您修改的资料未更新请点击更新按钮<br />3.更改后台入口文件 zhtx_admin.php文件名；<br/>
					</div>
				</dd>
			</dl>


            <dl class="dbox winbg2" id="item1">
                <dt class="lside">
                    <span class="l">信息统计</span>
                </dt>
                <dd>
                 <div class="content">
                    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="home_table">
                    <tbody><tr>
                        <td width="80" height="32">网站栏目数：</td>
                        <td class="num">38</td>
                    </tr>
                    <tr>
                        <td height="32">单页信息数：</td>
                        <td class="num">
                        0</td>
                    </tr>
                    <tr>
                        <td height="32">列表信息数：</td>
                        <td class="num">17</td>
                    </tr>
                    <tr>
                        <td height="32">图片信息数：</td>
                        <td class="num">17</td>
                    </tr>
                    <tr class="nb">
                        <td height="32">注册会员数：</td>
                        <td class="num">0</td>
                    </tr>
                </tbody></table>
                </div>
                </dd>
            </dl>


		</div>

	</div>
</body>
</html>
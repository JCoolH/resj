<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<link rel='stylesheet' type="text/css" href="__PUBLIC__/css/style.css" />
<script type="text/javascript" src="__PUBLIC__/js/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="__PUBLIC__/js/common.js"></script>
<script type="text/javascript" src="__PUBLIC__/js/jquery.form.min.js"></script>
<script type="text/javascript">
	
	function select_type(id) {
		if (id == 1) {
			$("#SizeDl").hide();
			$("#setting").html('&lt;loop&gt;&lt;a href=&quot;{'+'$url}&quot;&gt;{'+'$content}&lt;/a&gt;&lt;/loop&gt;');
		}else if(id == 2) {
			$("#SizeDl").show();
			$("#setting").html('&lt;loop&gt;&lt;a href=&quot;{'+'$url}&quot;&gt;&lt;img src=&quot;{'+'$content}&quot; /&gt;&lt;/a&gt;&lt;/loop&gt;');
		}else {
			$("#SizeDl").show();
			$("#setting").html('&lt;loop&gt;&lt;embed src=&quot;{'+'$content}&quot; quality=&quot;high&quot; width=&quot;{'+'$width}&quot; height=&quot;{'+'$height}&quot; wmode=&quot;opaque&quot; type=&quot;application/x-shockwave-flash&quot;&gt;&lt;/embed&gt;&lt;/loop&gt;');
		}
		
	}

	$(function(){
		$("#SizeDl").show();
		$("#setting").html('&lt;loop&gt;&lt;a href=&quot;{'+'$url}&quot;&gt;&lt;img src=&quot;{'+'$content}&quot; /&gt;&lt;/a&gt;&lt;/loop&gt;');
	});
</script>
</head>
<body>
<div class="main">
    <div class="pos">添加广告位</div>
	<div class="form">
		<form method='post' id="form_do" name="form_do" action="<?php echo U(GROUP_NAME. '/Abc/add');?>">
		<dl>
			<dt>广告位名：</dt>
			<dd>
				<input type="text" name="name" class="inp_large" />
			</dd>
		</dl>
		<dl>
			<dt>广告类型：</dt>
			<dd>				
				<select name="type" onChange="select_type(this.value)">
					<option value="1">文字广告</option>
					<option value="2" selected="selected">图片广告</option>
					<option value="3">flash广告</option>
				</select>
			</dd>
		</dl>

		<dl id="SizeDl">
			<dt>尺寸：</dt>
			<dd>
				宽：<input type="text" name="width" value="0"  class="inp_small" />px
				&nbsp;&nbsp;
				高：<input type="text" name="height" value="0"  class="inp_small" />px
			</dd>
		</dl>

		<dl>
			<dt>显示广告数：</dt>
			<dd>
				<input type="text" name="num" value="1"  class="inp_small" />条
			</dd>
		</dl>
		<dl>
			<dt>描述：</dt>
			<dd>
				<textarea name="remark" class="tarea_default"></textarea>
			</dd>
		</dl>	

		<dl>
			<dt>模板：</dt>
			<dd>
				<textarea name="setting" id="setting" class="tarea_default"></textarea>
				<p>支持html代码,对应字段放到&lt;loop&gt;&lt;/loop&gt;之间。loop为循环列表。</p>
				<p>可用字段:$title为标题，$content为图片地址或文本内容或动画地址</p>
				<p>$url为链接地址，$width为广告宽度,$height为广告高度</p>
				<p>$sort排序数值，$autoindex为自增变量(从0开始递增)，$autoindex+1为自增变量(从1开始递增)</p>
			</dd>
		</dl>
		</div>
		<div class="form_b">		
			<input type="submit" class="btn_blue" id="submit" value="提 交">
			<input type="button" onclick="goUrl('<?php echo U(GROUP_NAME. '/Abc/index');?>')" class="btn_green" value="取消" />
		</div>
	   </form>
	</div>


</body>
</html>
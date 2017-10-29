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
	var data_path = "__DATA__";
	var tpl_public = "__PUBLIC__";
</script>
<script type="text/javascript" src="__PUBLIC__/js/jBox.config.js"></script>
<script type="text/javascript" src="__PUBLIC__/js/calendar.config.js"></script>
<script type="text/javascript">
$(function () {
	//缩略图上传
	var type = <?php echo ($cate['type']); ?>;
	var litpic_tip = $(".litpic_tip");
	var btn = $(".litpic_btn span");
	$("#fileupload").wrap("<form id='myfileuploadform' action='<?php echo U(GROUP_NAME. '/Public/uploadFile');?>' method='post' enctype='multipart/form-data'></form>");
	$("#myfileuploadform").append('<input type="hidden" name="sfile" value="abc1" />')
    $("#fileupload").change(function(){
    	if($("#fileupload").val() == "") return;
		$("#myfileuploadform").ajaxSubmit({
			dataType:  'json',
			beforeSend: function() {
        		$('#litpic_show').empty();
				btn.html("上传中...");
    		},
			success: function(data) {
				//litpic_tip.html("<b>"+data.title+"("+data.size+"k)</b> <span class='delimg' rel='"+data.url+"'>删除</span>");
				if(data.state == 'SUCCESS'){					
					litpic_tip.html(""+ data.title +" 上传成功("+data.size+"k)");
					var img = data.url;
					if (type == 2) {
						$('#litpic_show').html("<img src='"+img+"' width='88' height='31'>");
					}
					$("#litpic").val(img);
				}else {
					litpic_tip.html(data.state);		
				}			
					btn.html("上传文件");

			},
			error:function(xhr){
				btn.html("上传失败");
				litpic_tip.html(xhr);
			}
		});
	});
	
});


$(function () {

	$('#BrowerPicture').click(function(){
		$.jBox("iframe:<?php echo U(GROUP_NAME.'/Public/browseFile', array('stype' => 'ad'));?>",{
			title:'ZHTXCMS',
			width: 650,
   			height: 350,
    		buttons: { '关闭': true }
   			}
		);
	});	

});


function selectFile(sfile) {
	$.jBox.tip("选择文件成功");
	$.jBox.close(true);
	$("#litpic").val(sfile);
	//$('#litpic_show').html("<img src='"+sfile+"' width='120'>");
}

</script>
</head>
<body>
<div class="main">
    <div class="pos">添加广告</div>
	<div class="form">
		<form method='post' id="form_do" name="form_do" action="<?php echo U(GROUP_NAME. '/Abc/editDetail');?>">
		<dl>
			<dt>广告名称：</dt>
			<dd>
				<input type="text" name="title" class="inp_large" value="<?php echo ($vo["title"]); ?>" />
			</dd>
		</dl>

		<dl>
            <dt> 开始时间：</dt>
            <dd>
                
                <input type="text" class="inp_one" name="starttime" id="starttime" value="<?php echo (date('Y-m-d H:i:s',$vo["starttime"])); ?>">
                <script type="text/javascript">
                    Calendar.setup({
                        weekNumbers: true,
                        inputField : "starttime",
                        trigger    : "starttime",
                        dateFormat: "%Y-%m-%d %H:%M:%S",
                        showTime: true,
                        minuteStep: 1,
                        onSelect   : function() {this.hide();}
                    });
                </script>
            </dd>
        </dl>

		<dl>
            <dt> 结束时间：</dt>
            <dd>
                
                <input type="text" class="inp_one" name="endtime" id="endtime" value="<?php echo (date('Y-m-d H:i:s',$vo["endtime"])); ?>">
                <script type="text/javascript">
                    Calendar.setup({
                        weekNumbers: true,
                        inputField : "endtime",
                        trigger    : "endtime",
                        dateFormat: "%Y-%m-%d %H:%M:%S",
                        showTime: true,
                        minuteStep: 1,
                        onSelect   : function() {this.hide();}
                    });
                </script>
            </dd>
        </dl>
        <?php switch($cate['type']): case "1": ?><dl>
			<dt>文字内容：</dt>
			<dd>
				<textarea name="content" class="tarea_default"><?php echo ($vo["content"]); ?></textarea>
			</dd>
		</dl><?php break;?>
	    <?php case "2": ?><dl>
			<dt> 图片：</dt>
			<dd>
				<div class="litpic_show">
				    <div style="float:left;">
				    <input type="text" class="inp_w250" name="content" id="litpic"  value="<?php echo ($vo["content"]); ?>" />
				    <input type="button" class="btn_blue_b" id="BrowerPicture" value="选择站内图片">
				    </div>
						<div class="litpic_btn">
				        <span>上传图片</span>
				        <input id="fileupload" type="file" name="mypic">
				    </div>
				    <div class="litpic_tip"></div>
				    <div id="litpic_show"> </div>
				</div>
			</dd>
		</dl><?php break;?>
	    <?php case "3": ?><dl>
			<dt> flash：</dt>
			<dd>
				<div class="litpic_show">
				    <div style="float:left;">
				    <input type="text" class="inp_w250" name="content" id="litpic"  value="<?php echo ($vo["content"]); ?>" />
				    <input type="button" class="btn_blue_b" id="BrowerPicture" value="选择站内flash">
				    </div>
						<div class="litpic_btn">
				        <span>上传flash</span>
				        <input id="fileupload" type="file" name="mypic">
				    </div>
				    <div class="litpic_tip"></div>
				    <div id="litpic_show"> </div>
				</div>
			</dd>
		</dl><?php break; endswitch;?>
			

		<dl>
			<dt> 链接地址：</dt>
			<dd>
				<input type="text" name="url" class="inp_large" value="<?php echo ($vo["url"]); ?>" />
			</dd>
		</dl>
		<dl>
			<dt> 排列：</dt>
			<dd>
				<input type="text" name="sort" class="inp_small" value="<?php echo ($vo["sort"]); ?>" />
			</dd>
		</dl>

		<dl>
			<dt> 状态：</dt>
			<dd>
				<input type="radio" name="status" value="1" <?php if($vo["status"] == 1): ?>checked="checked"<?php endif; ?>  />启用
				&nbsp;&nbsp;
				<input type="radio" name="status" value="0" <?php if($vo["status"] == 0): ?>checked="checked"<?php endif; ?> />停用

			</dd>
		</dl>
		<div class="form_b">	
			<input type="hidden" name="id" value="<?php echo ($vo["id"]); ?>" />
			<input type="hidden" name="aid" value="<?php echo ($cate["id"]); ?>" />
			<input type="hidden" name="type" value="<?php echo ($cate["type"]); ?>" />	
			<input type="submit" class="btn_blue" id="submit" value="提 交">
			<input type="button" onclick="goUrl('<?php echo U(GROUP_NAME. '/Abc/detail', array('aid' => $cate['id']));?>')" class="btn_green" value="返回" />
		</div>
	   </form>
	</div>
</div>


</body>
</html>
<?php

//自定义标签库
class TagLibOther extends TagLib {
	
	//xxxtest测试数据，可删除
	protected $tags = array(
		//自定义标签
		'xxxtest'	=> array('close' => 0),	
		//导航
		'navlistext'	=> array(
			'attr'	=> 'typeid,curcls',
			'close'	=> 1,
		),
		//通用列表
		'listext'	=> array(
			'attr'	=> 'flag,typeid,titlelen,infolen,orderby,keyword,allfield,limit,pagesize,pageroll,pagetheme',
			'close'	=> 1,
		),
		// 获取指定文章
		'category'	=> array('attr'	=> 'id','close' => 0),	
		'content'	=> array('attr'	=> 'id,table','close' => 0),	
	);
	

	public function _xxxtest($attr, $content) {
		return 'tag__xxxtest';
	}

		//导航
	public function _navlistext($attr, $content) {
		//$attr = $this->parseXmlAttr($attr, 'navlist');
		$attr = !empty($attr)? $this->parseXmlAttr($attr, 'navlistext') : null;
		$typeid = $attr['typeid'] == '' ? -1 : intval($attr['typeid']);//不能用empty,0,'','0',会认为true
		$curcls = $attr['curcls'];
		$str = <<<str
<?php
	\$_typeid = $typeid;
	\$_curcls = '$curcls';
	if(\$_typeid == -1) \$_typeid = I('cid', 0, 'intval');
	\$_navlist = get_nav_cate(1);
	import('Class.Category', APP_PATH);	
	if(\$_typeid == 0) {
		\$_navlist  = Category::toLayer(\$_navlist);
	}else {
		\$_navlist  = Category::toLayer(\$_navlist, 'child', \$_typeid);
	}

	if (\$_curcls) {
		\$top = category_top(\$cate['id']);
	}
	foreach(\$_navlist as \$autoindex => \$navlist):
		\$navlist['url'] = getUrl(\$navlist);
		if (\$_curcls) {
			if (\$top['id'] == \$navlist['id']) {
				\$navlist['curcls'] = \$_curcls;
			}
		}
?>
str;

	$str .= $content;
	$str .='<?php endforeach;?>';
	return $str;

	}

	//标签名前加下划线
	//文章列表
	public function _listext($attr, $content) {
		$attr = $this->parseXmlAttr($attr, 'listext');
		$flag = empty($attr['flag'])? '': $attr['flag'];
		$typeid = !isset($attr['typeid']) || $attr['typeid'] == '' ? -1 : trim($attr['typeid']);//只接收一个栏目ID
		$titlelen = empty($attr['titlelen'])? 0 : intval($attr['titlelen']);
		$infolen = empty($attr['infolen'])? 0 : intval($attr['infolen']);		
		$orderby = empty($attr['orderby'])? 'id DESC' : $attr['orderby'];
		$limit = empty($attr['limit'])? '10' : $attr['limit'];
		$pagesize = empty($attr['pagesize'])? '0' : $attr['pagesize'];
		$keyword = empty($attr['keyword'])? '': trim($attr['keyword']);

		$pageroll = empty($attr['pageroll'])? '5' : $attr['pageroll'];
		$pagetheme = empty($attr['pagetheme'])? ' %upPage% %linkPage% %downPage% 共%totalPage%页' : htmlspecialchars_decode($attr['pagetheme']);
		

		$flag = flag2sum($flag);

		$allfield = ($attr['allfield']==1)?1:0;
		$str = <<<str
<?php
	\$_typeid = $typeid;	
	\$_keyword = "$keyword";
	if(\$_typeid == -1) \$_typeid = I('cid', 0, 'intval');
	if (\$_typeid>0 || substr(\$_typeid,0,1) == '$') {
		import('Class.Category', APP_PATH);
		\$_selfcate = Category::getSelf(getCategory(), \$_typeid);
		\$_tablename = strtolower(\$_selfcate['tablename']);
		\$ids = Category::getChildsId(getCategory(), \$_typeid, true);
		//p(\$ids);
		\$where = array(\$_tablename.'.status' => 0, \$_tablename .'.cid'=> array('IN',\$ids));
	}else {
		\$_tablename = 'article';
		\$where = array(\$_tablename.'.status' => 0);
		
	}
	if (\$_keyword != '') {
		\$where[\$_tablename.'.title'] = array('like','%'.\$_keyword.'%');
	}


	if ($flag > 0) {	
		\$where['_string'] = \$_tablename.'.flag & $flag = $flag ';	
	}

	if (!empty(\$_tablename) && \$_tablename != 'page') {
	
		//分页
		if ($pagesize > 0) {
			
			//import('ORG.Util.Page');
			import('Class.Page', APP_PATH);
			\$count = D2('ArcView',"\$_tablename")->where(\$where)->count();

			\$thisPage = new Page(\$count, $pagesize);
			
			\$ename = I('e', '', 'htmlspecialchars,trim');
			if (!empty(\$ename) && C('URL_ROUTER_ON') == true) {
				\$thisPage->url = ''.\$ename. '/p';
			}
			//设置显示的页数
			\$thisPage->rollPage = $pageroll;
			\$thisPage->setConfig('theme',"$pagetheme");
			\$limit = \$thisPage->firstRow. ',' .\$thisPage->listRows;	
			\$page = \$thisPage->show();

		}else {
			\$limit = "$limit";
		}	
		if ($allfield) {
			\$_list = D2('ArcView',"\$_tablename")->where(\$where)->order("$orderby")->limit(\$limit)->select();
		}else{
			\$_list = D2('ArcView',"\$_tablename")->nofield('content,pictureurls')->where(\$where)->order("$orderby")->limit(\$limit)->select();
		}
		if (empty(\$_list)) {
			\$_list = array();
		}
	}else {
		\$_list = array();
	}


	//Load('extend');//调用msubstr()

	foreach(\$_list as \$autoindex => \$list):

	\$_jumpflag = (\$list['flag'] & B_JUMP) == B_JUMP? true : false;
	\$list['url'] = getContentUrl(\$list['id'], \$list['cid'], \$list['ename'], \$_jumpflag, \$list['jumpurl']);
	if (\$list['picturedesc']) {
		\$list['picturedesc'] = json_decode(\$list['picturedesc'],true);
	}
	if (\$list['ext']) {
		\$list['ext'] = render_ext(\$list['ext']);
	}
	if($titlelen) \$list['title'] = str2sub(\$list['title'], $titlelen, 0);	
	if($infolen) \$list['description'] = str2sub(\$list['description'], $infolen, 0);

?>
str;
	$str .= $content;
	$str .='<?php endforeach;?>';
	return $str;

	}

	public function _category($attr, $content) {
		$attr = $this->parseXmlAttr($attr, 'category');
		if (!$attr['id']) {
			return;
		}
		$str = '<?php ';
		$str .= '$_category=xl_get_cat("'.$attr['id'].'");';
		$str .= '?>';
		return $str;
	}
	

	public function _content($attr, $content) {
		$attr = $this->parseXmlAttr($attr, 'content');
		if (!$attr['id']) {
			return;
		}
		if (!$attr['table']) {
			$attr['table'] = 'article';
		}
		$str = '<?php ';
		$str .= '$_content=xl_get_content("'.$attr['id'].'","'.$attr['table'].'");';
		$str .= '?>';
		return $str;
	}

}
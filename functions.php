<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;

/* 后台设置 */
function themeConfig($form) {
	//header部分
    $logoUrl = new Typecho_Widget_Helper_Form_Element_Text('logoUrl', NULL, NULL, _t('站点LOGO地址'), _t('在这里填入一个图片URL地址, 以在网站标题前加上一个LOGO'));
	$form->addInput($logoUrl->addRule('xssCheck', _t('请不要在图片链接中使用特殊字符')));

	$logotext = new Typecho_Widget_Helper_Form_Element_Text('logotext', null, NULL, _t('站点说明'), _t('logo 旁边的两行说明 以&lt;br&gt;换行'));
	$form->addInput($logotext);

	$DnsPrefetch = new Typecho_Widget_Helper_Form_Element_Radio('DnsPrefetch',
        array('able' => _t('启用'),
            'disable' => _t('禁止'),
        ),
        'disable', _t('DNS预解析加速'), _t('默认禁止，启用则会对CDN资源和Gravatar进行加速'));
    $form->addInput($DnsPrefetch);

	$fatext = new Typecho_Widget_Helper_Form_Element_Textarea('fatext', NULL, NULL, _t('顶部导航栏fa图标'), _t('顶部导航栏fa图标，&lt;i class="fa fa-plug"&gt;&lt;/i&gt; 格式一行一个<br>和导航条菜单项按顺序匹配,用法参见<a href="http://www.yeahzan.com/fa/facss.html" target="_blank">FA图标CSS分类参考</a>'));
    $form->addInput($fatext);

    $tuijian = new Typecho_Widget_Helper_Form_Element_Text('tj_cid', NULL, NULL, _t('今日观点'), _t('请输入要置顶展示文章的cid'));
    $form->addInput($tuijian);
	//首页文章列表上的导航代码
	$smallbanner = new Typecho_Widget_Helper_Form_Element_Textarea('smallbanner', NULL, NULL, _t('首页中部小菜单'), _t('填写导航条代码 A链接格式即可'));
    $form->addInput($smallbanner);
	
	//幻灯片
	$Slider = new Typecho_Widget_Helper_Form_Element_Radio('Slider',
        array('SliderTrue'=>_t('开启'),'SliderFalse'=>_t('关闭')),
        'SliderFalse',
        _t("幻灯片开关"),
        _t("开启后请在下方填写来幻灯片代码发布幻灯片")
        );
    $form->addInput($Slider); 

	$slidercode = new Typecho_Widget_Helper_Form_Element_Textarea('slidercode', NULL, NULL, _t('幻灯片代码'), _t('请按此格式填写，展示几个就填几行&lt;a href="你的链接"&gt; &lt;img src="图片链接" width="100%" /&gt;&lt;/a&gt;'));
	$form->addInput($slidercode);

	
	//侧边栏
    $sidebarBlock = new Typecho_Widget_Helper_Form_Element_Checkbox('sidebarBlock', 
    array('ShowRecentPosts' => _t('最新文章'),
    'ShowCategory' => _t('推荐链接，广告位'),
    'ShowRecentComments' => _t('最新评论'),
	'ShowTags' => _t('标签云')),
    array('ShowRecentPosts', 'ShowCategory', 'ShowRecentComments', 'ShowTags'), _t('侧边栏显示'));    
    $form->addInput($sidebarBlock->multiMode());
	$sidebarAD = new Typecho_Widget_Helper_Form_Element_Textarea('sidebarAD', NULL, NULL, _t('侧边栏推荐位蓝色'), _t('请按固定格式填写，否则会造成错乱，可添加多个，第一行是广告的链接地址，第二行是广告标题，第三行是广告内容<br>例如:<br>http://themebetter.com/theme/dux<br>DUX主题 新一代主题<br>DUX Wordpress主题是大前端当前使用主题，是大前端积累多年Wordpress主题经验设计而成；更加扁平的风格和干净白色的架构会让网站显得内涵而出色...'));
    $form->addInput($sidebarAD);
    $sitebar_fu = new Typecho_Widget_Helper_Form_Element_Text('sitebar_fu', NULL, NULL, _t('侧边栏浮动'), _t('请输入要浮动的侧边栏模块序号并使用英文逗号分隔，例如1,3 代表第1和第3块侧边栏会浮动'));
    $form->addInput($sitebar_fu);	

	//社交
    $socialweixin = new Typecho_Widget_Helper_Form_Element_Text('socialweixin', NULL, NULL, _t('输入微信二维码链接'), _t('在这里输入微信二维码链接,图片格式,支持 http:// 或 https:// 或 //'));
    $form->addInput($socialweixin->addRule('xssCheck', _t('请不要在图片链接中使用特殊字符')));
	$socialweibo = new Typecho_Widget_Helper_Form_Element_Text('socialweibo', NULL, NULL, _t('输入微博链接'), _t('在这里输入微博链接,支持 http:// 或 https:// 或 //'));
    $form->addInput($socialweibo->addRule('xssCheck', _t('请不要在链接中使用特殊字符')));
    $socialtwitter = new Typecho_Widget_Helper_Form_Element_Text('socialtwitter', NULL, NULL, _t('输入Twitter链接'), _t('在这里输入twitter链接,支持 http:// 或 https:// 或 //'));
    $form->addInput($socialtwitter->addRule('xssCheck', _t('请不要在链接中使用特殊字符')));
		
	//图片CDN
    $srcAddress = new Typecho_Widget_Helper_Form_Element_Text('src_add', NULL, NULL, _t('图片CDN替换前地址'), _t('即你的附件存放链接，一般为http://www.yourblog.com/usr/uploads/'));
    $form->addInput($srcAddress->addRule('xssCheck', _t('请不要在链接中使用特殊字符')));
    $cdnAddress = new Typecho_Widget_Helper_Form_Element_Text('cdn_add', NULL, NULL, _t('图片CDN替换后地址'), _t('即你的七牛云存储域名，一般为http://yourblog.qiniudn.com/，可能也支持其他有镜像功能的CDN服务'));
    $form->addInput($cdnAddress->addRule('xssCheck', _t('请不要在链接中使用特殊字符')));
    $default_thumb = new Typecho_Widget_Helper_Form_Element_Text('default_thumb', NULL, '', _t('默认缩略图'),_t('文章没有图片时的默认缩略图，留空则无，一般为http://www.yourblog.com/image.png'));
    $form->addInput($default_thumb->addRule('xssCheck', _t('请不要在链接中使用特殊字符')));
	
	//作者简介
	$authordesc = new Typecho_Widget_Helper_Form_Element_Text('authordesc', null, NULL, _t('作者简介'), _t('文章页的作者说明'));
	$form->addInput($authordesc);

	//代码高亮设置
	$useHighline = new Typecho_Widget_Helper_Form_Element_Radio('useHighline',
        array('able' => _t('启用'),
            'disable' => _t('禁止'),
        ),
        'disable', _t('代码高亮设置'), _t('默认禁止，启用则会对 ``` 进行代码高亮，支持20种编程语言的高亮'));
    $form->addInput($useHighline);
	
	//footer部分
	$footad = new Typecho_Widget_Helper_Form_Element_Textarea('footad', NULL, NULL, _t('底部广告栏'), _t('页底广告位，可以放置广告，bootstrap样式'));
    $form->addInput($footad);
	$flinks = new Typecho_Widget_Helper_Form_Element_Textarea('flinks', NULL, NULL, _t('底部友情链接'), _t('底部导航条 一般li格式 友情链接使用'));
    $form->addInput($flinks);
	$fcode = new Typecho_Widget_Helper_Form_Element_Textarea('fcode', NULL, NULL, _t('底部小广告'), _t('该块显示在网站底部版权上方，可已定义放一些链接或者图片之类的内容。'));
    $form->addInput($fcode);
	$GoogleAnalytics = new Typecho_Widget_Helper_Form_Element_Textarea('GoogleAnalytics', NULL, NULL, _t('统计代码'), _t('填写你的各种跟踪统计代码，相当于页尾代码'));
    $form->addInput($GoogleAnalytics);
	

}



/**
 * 解析内容以实现附件加速
 * @access public
 * @param string $content 文章正文
 * @param Widget_Abstract_Contents $obj
 */
function parseContent($obj) {
    $options = Typecho_Widget::widget('Widget_Options');
    if (!empty($options->src_add) && !empty($options->cdn_add)) {
        $obj->content = str_ireplace($options->src_add, $options->cdn_add, $obj->content);
    }
    echo trim($obj->content);
}


/*文章阅读次数统计*/
function get_post_view($archive) {
    $cid = $archive->cid;
    $db = Typecho_Db::get();
    $prefix = $db->getPrefix();
    if (!array_key_exists('views', $db->fetchRow($db->select()->from('table.contents')))) {
        $db->query('ALTER TABLE `' . $prefix . 'contents` ADD `views` INT(10) DEFAULT 0;');
        echo 0;
        return;
    }
    $row = $db->fetchRow($db->select('views')->from('table.contents')->where('cid = ?', $cid));
    if ($archive->is('single')) {
        $views = Typecho_Cookie::get('extend_contents_views');
        if (empty($views)) {
            $views = array();
        } else {
            $views = explode(',', $views);
        }
        if (!in_array($cid, $views)) {
            $db->query($db->update('table.contents')->rows(array('views' => (int)$row['views'] + 1))->where('cid = ?', $cid));
            array_push($views, $cid);
            $views = implode(',', $views);
            Typecho_Cookie::set('extend_contents_views', $views); //记录查看cookie
            
        }
    }
    echo $row['views'];
}


/*Typecho 24小时发布文章数量*/
function get_recent_posts_number($days = 1,$display = true)
{
$db = Typecho_Db::get();
$today = time() + 3600 * 8;
$daysago = $today - ($days * 24 * 60 * 60);
$total_posts = $db->fetchObject($db->select(array('COUNT(cid)' => 'num'))
->from('table.contents')
->orWhere('created < ? AND created > ?', $today,$daysago)
->where('type = ? AND status = ? AND password IS NULL', 'post', 'publish'))->num;
if($display) {
echo $total_posts;
} else {
return $total_posts;
}
}

//缩略图调用
function showThumb($obj,$size=null,$link=false){
    preg_match_all( "/<[img|IMG].*?src=[\'|\"](.*?)[\'|\"].*?[\/]?>/", $obj->content, $matches );
    $thumb = '';
    $options = Typecho_Widget::widget('Widget_Options');
    $attach = $obj->attachments(1)->attachment;
    if (isset($attach->isImage) && $attach->isImage == 1){
        $thumb = $attach->url;
        if(!empty($options->src_add) && !empty($options->cdn_add)){
            $thumb = str_ireplace($options->src_add,$options->cdn_add,$thumb);
        }
    }elseif(isset($matches[1][0])){
        $thumb = $matches[1][0];
        if(!empty($options->src_add) && !empty($options->cdn_add)){
            $thumb = str_ireplace($options->src_add,$options->cdn_add,$thumb);
        }
    }
    if(empty($thumb) && empty($options->default_thumb)){
		$thumb= $options->themeUrl .'/img/thumb/' . rand(1, 20) . '.jpg';
		//去掉下面4行双斜杠 启用BING美图随机缩略图
		//$str = file_get_contents('http://cn.bing.com/HPImageArchive.aspx?format=js&idx='.rand(1, 30).'&n=1');
        //$array = json_decode($str);
		//$imgurl = $array->{"images"}[0]->{"urlbase"};
        //$thumb = '//i'.rand(0, 2).'.wp.com/cn.bing.com'.$imgurl.'_1920x1080.jpg?resize=220,150';
		
        return $thumb;
    }else{
        $thumb = empty($thumb) ? $options->default_thumb : $thumb;
    }
    if($link){
        return $thumb;
    }
}

//编辑推荐
function hotpost() {
    $options = Typecho_Widget::widget('Widget_Options');
    if ((!empty($options->tj_cid)) && floor($options->tj_cid)==$options->tj_cid) {
        $tjids =  $options->tj_cid;
    }else{
		$tjids = 0;
	}
    //return $tjids;
$defaults = array(
'cid' => $tjids,
'before' => '',
'after' => '',
'xformat' => '<article class="excerpt-minic excerpt-minic-index"><h2><span class="red">【今日观点】</span><a href="{permalink}" title="{title}">{title}</a></h2><p class="note">{content}...</p></article>'
);
$db = Typecho_Db::get();
 
$sql = $db->select()->from('table.contents')
->where('status = ?','publish')
->where('type = ?', 'post')
->where('cid = ?', $defaults['cid']);
 
$result = $db->fetchAll($sql);
echo $defaults['before'];
foreach($result as $val){
$val = Typecho_Widget::widget('Widget_Abstract_Contents')->filter($val);
echo str_replace(array('{permalink}', '{title}','{content}'),array($val['permalink'], $val['title'],substr($val['text'],0,250)), $defaults['xformat']);
}
echo $defaults['after'];
}

//幻灯片输出
function slout() {
    $options = Typecho_Widget::widget('Widget_Options');
    if (!empty($options->slidercode)) {
        $text = $options->slidercode;
    }else{
		$text='<a target="_blank" href="http://www.daqianduan.com/theme/xiu"><img src="http://www.daqianduan.com/wp-content/uploads/2014/11/hs-xiu.jpg"></a>
<a target="_blank" href="http://www.daqianduan.com/theme/xiu"><img src="http://demo.themebetter.com/dux/wp-content/uploads/sites/3/2015/06/hs-xiu.jpg"></a>';
	}
	$t_arr = explode('
', $text);
	$sss = '<div id="focusslide" class="carousel slide" data-ride="carousel"><ol class="carousel-indicators">';
	foreach($t_arr as $key=>$val) {$sss .= '<li data-target="#focusslide" data-slide-to="'.$key.'"';
	if($key==0){$sss .= ' class="active"></li>';}else{$sss .= '></li>';}}
	$sss .= '</ol><div class="carousel-inner" role="listbox">';
	foreach($t_arr as $key=>$val) {$sss .= '<div class="item';
	if($key==0){$sss .= ' active">';}else{$sss .= '">';} $sss .= $val.'</div>';}
	$sss .= '</div><a class="left carousel-control" href="#focusslide" role="button" data-slide="prev"><i class="fa fa-angle-left"></i></a><a class="right carousel-control" href="#focusslide" role="button" data-slide="next"><i class="fa fa-angle-right"></i></a></div>';
	
	echo $sss;
}

//导航fa图标
function fa_ico() {
    $options = Typecho_Widget::widget('Widget_Options');
    if (!empty($options->fatext)) {
        $text = $options->fatext;
    }else{
		$text="<i class=\"fa fa-plug\"></i>\n<i class=\"fa fa-tablet\"></i>\n<i class=\"fa fa-book\"></i>";
	}
	$b_arr = explode("\n", $text);
		
	return $b_arr;
}

//侧边栏推荐位
function sitebar_ad($obj) {
    $options = $obj;
    if (!empty($options)) {
        $text = $options;
    }else{
		$text="http://themebetter.com/theme/dux\nDUX主题 新一代主题\nDUX Wordpress主题是大前端当前使用主题，是大前端积累多年Wordpress主题经验设计而成；更加扁平的风格和干净白色的架构会让网站显得内涵而出色...";
	}
	$b_arr = explode("\n", $text);
		
	return $b_arr;
}



?>

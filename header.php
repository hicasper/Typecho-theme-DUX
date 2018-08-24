<?php if(!defined( '__TYPECHO_ROOT_DIR__'))exit;?>
<!DOCTYPE HTML>
<html>
<head>
	<meta charset="<?php $this->options->charset(); ?>"><?php if ($this->options->DnsPrefetch): ?>
    <meta http-equiv="x-dns-prefetch-control" content="on"><?php if ($this->options->cdn_add): ?>
    <link rel="dns-prefetch" href="<?php $this->options->cdn_add(); ?>" /><?php endif; ?>
    <link rel="dns-prefetch" href="//cdn.bootcss.com" />
    <link rel="dns-prefetch" href="//secure.gravatar.com" />
	<link rel="dns-prefetch" href="//apps.bdimg.com"><?php endif; ?>
	<meta http-equiv="X-UA-Compatible" content="IE=11,IE=10,IE=9,IE=8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
	<meta name="apple-mobile-web-app-title" content="<?php $this->options->title();?>">
	<meta http-equiv="Cache-Control" content="no-siteapp">
	<title><?php $this->archiveTitle(array('category'=>_t(' %s '),'search'=>_t(' %s '),'tag'=>_t(' %s '),'author'=>_t(' %s ')),'',' - ');?> <?php $this->options->title();?></title>
	<meta name='robots' content='noindex,follow' />
	<link rel='stylesheet' id='_bootstrap-css'  href='//cdn.bootcss.com/bootstrap/3.2.0/css/bootstrap.min.css?ver=0.1' type='text/css' media='all' />
	<link rel='stylesheet' id='_fontawesome-css'  href='//cdn.bootcss.com/font-awesome/4.2.0/css/font-awesome.min.css?ver=0.1' type='text/css' media='all' />
	<link rel='stylesheet' id='_main-css'  href='<?php $this->options->themeUrl('css/main.css?ver=0.1'); ?>' type='text/css' media='all' />
	<link rel='stylesheet' href='<?php $this->options->themeUrl('css/custom.css'); ?>' type='text/css' media='all' />
	<script type='text/javascript' src='//cdn.bootcss.com/jquery/1.9.1/jquery.min.js?ver=0.1'></script>
	<!--加载进度条-->
	<link href="//cdn.bootcss.com/pace/1.0.2/themes/orange/pace-theme-flash.css" rel="stylesheet" />
	<script> paceOptions = { elements: {selectors: ['#footer']}};</script>
	<script src="//cdn.bootcss.com/pace/1.0.2/pace.min.js"></script>
	<!--加载进度条-->
	<link rel="shortcut icon" href="<?php $this->options->themeUrl('favicon.ico'); ?>">
	<!--[if lt IE 9]><script src="http://apps.bdimg.com/libs/html5shiv/3.7/html5shiv.min.js"></script><![endif]-->
	<?php $this->header('keywords=&generator=&template=&pingback=&xmlrpc=&wlw=&commentReply=&rss1=&rss2=&atom='); ?>
</head>
<body class="<?php if ($this->is('index')) : ?>home<?php elseif ($this->is('post')) : ?>single<?php elseif ($this->is('page')) : ?>page<?php elseif ($this->is('archive')) : ?>archive<?php else: ?><?php endif; ?>">
<header class="header">
<div class="container">
	<h1 class="logo"><?php if (!empty($this->options->logoUrl)): ?>
        <a href="<?php $this->options ->siteUrl(); ?>">
            <img src="<?php $this->options->logoUrl(); ?>" alt="<?php $this->options->title();?>" />
		</a><?php else: ?>
		<a href="<?php $this->options ->siteUrl(); ?>">
            <img src="<?php $this->options->themeUrl('img/logo.png'); ?>" alt="<?php $this->options->title();?>" /><?php $this->options->title();?></a><?php endif; ?>
	</h1>
  <div class="brand"><?php if($this->options->logotext && !empty($this->options->logotext) ): ?><?php $this->options->logotext(); ?><?php endif; ?></div> <?php /* logo 旁边的两行说明 以<br>换行*/ ?>
  <ul class="site-nav site-navbar">
    <li>
      <a href="<?php $this->options ->siteUrl(); ?>">
        <i class="fa fa-home"></i>首页</a>
    </li><?php /* 头部大导航条 一般li格式 支持fa标签*/ ?>
<?php 
$this->widget('Widget_Metas_Category_List')->to($cats); 
$i=0;  $b_arr = fa_ico(); 
?>
<?php while ($cats->next()): ?>
<li><a href="<?php $cats->permalink()?>"><?php echo $b_arr[$i]; ?> <?php $cats->name()?></a></li>
<?php $i++; ?>
<?php endwhile; ?>
    <!--<li>
      <a>
        <i class="fa fa-file-text-o"></i>独立页面</a>
      <ul class="sub-menu"><?php /* 头部大导航条下二级菜单 一般li格式 */ ?>
        <?php $this->widget('Widget_Contents_Page_List')->to($pages); ?>
            <?php while($pages->next()): ?>
            <li <?php if($this->is('page', $pages->slug)): ?> class="current-menu-item"<?php endif; ?>><a href="<?php $pages->permalink(); ?>"><?php $pages->title(); ?></a></li>
            <?php endwhile; ?>
      </ul>
    </li>-->
    <li class="navto-search">
      <a href="javascript:;" class="search-show active">
        <i class="fa fa-search"></i>
      </a>
    </li>
  </ul>
  <div class="topbar">
    <ul class="site-nav topmenu"> <?php /* 头部小导航条 一般li格式*/ ?>
	<?php $this->widget('Widget_Contents_Page_List')->to($pages); ?>
        <?php while($pages->next()): ?>
        <li <?php if($this->is('page', $pages->slug)): ?> class="current-menu-item"<?php endif; ?>><a href="<?php $pages->permalink(); ?>"><?php $pages->title(); ?></a></li>
        <?php endwhile; ?>
      
    <li class="menusns">
        <a href="javascript:;">关注本站<i class="fa fa-angle-down"></i></a>
        <ul class="sub-menu"><?php /* 社交类二级菜单 */ ?>
          <?php if ($this->options->socialweixin): ?><li>
            <a class="sns-wechat" href="javascript:;" title='关注"<?php $this->options->title();?>"' data-src="<?php $this->options->socialweixin(); ?>">
              <i class="fa fa-wechat"></i>微信</a>
          </li><?php endif; ?>
          <?php if ($this->options->socialweibo): ?><li>
            <a target="_blank" rel="external nofollow" href="<?php $this->options->socialweibo(); ?>">
              <i class="fa fa-weibo"></i>微博</a>
          </li><?php endif; ?>
          <?php if ($this->options->socialtwitter): ?><li>
            <a target="_blank" rel="external nofollow" href="<?php $this->options->socialtwitter(); ?>">
              <i class="fa fa-twitter"></i>Twitter</a>
          </li><?php endif; ?>
          <li>
            <a target="_blank" href="<?php $this->options ->siteUrl(); ?>feed/">
              <i class="fa fa-rss"></i>RSS订阅</a>
          </li>
        </ul>
      </li>
    </ul>
	<?php if($this->user->hasLogin()): ?>
	<a class="signin-loader" href="<?php $this->options->adminUrl(); ?>"><?php $this->user->screenName(); ?><?php _e('(个人中心)'); ?></a>&nbsp; &nbsp;
	<a class="signup-loader" href="<?php $this->options->logoutUrl(); ?>"><?php _e('退出'); ?></a>
    <?php else: ?><a class="signin-loader" href="<?php $this->options->adminUrl('login.php'); ?>"><?php _e('Hi, 请登录'); ?></a>&nbsp; &nbsp;
	<a class="signup-loader" href="<?php $this->options ->adminUrl('register.php'); ?>"><?php _e('我要注册'); ?></a>
    <?php endif; ?>
	</div>
  <i class="fa fa-bars m-icon-nav"></i>
</div>
</header>
<div class="site-search">
  <div class="container">
    <form method="get" class="site-search-form" action="<?php $this->options ->siteUrl(); ?>">
      <input class="search-input" name="s" type="text" placeholder="输入关键字" value="">
      <button class="search-btn" type="submit">
        <i class="fa fa-search"></i>
      </button>
    </form>
  </div>
</div><!--header-->
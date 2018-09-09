<?php if(!defined( '__TYPECHO_ROOT_DIR__'))exit;?>
<!DOCTYPE HTML>
<html>
<head>
    <meta charset="<?php $this->options->charset(); ?>"><?php if ($this->options->DnsPrefetch): ?>
    <meta http-equiv="x-dns-prefetch-control" content="on"><?php if ($this->options->cdn_add): ?>
    <link rel="dns-prefetch" href="<?php $this->options->cdn_add(); ?>" /><?php endif; ?>
    <link rel="dns-prefetch" href="//cdn.bootcss.com" />
    <link rel="dns-prefetch" href="//cn.gravatar.com" /><?php endif; ?>
    <title><?php $this->archiveTitle(array('category'=>_t(' %s '),'search'=>_t(' %s '),'tag'=>_t(' %s '),'author'=>_t(' %s ')),'',' - ');?> <?php $this->options->title();?></title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
    <link rel="shortcut icon" href="<?php $this->options->themeUrl('favicon.ico'); ?>">
    <meta name="apple-mobile-web-app-title" content="<?php $this->options->title();?>">
    <meta http-equiv="Cache-Control" content="no-siteapp">
    <meta http-equiv="Cache-Control" content="no-transform">

    <link rel='stylesheet' id='_bootstrap-css'  href='//cdn.bootcss.com/bootstrap/3.2.0/css/bootstrap.min.css ' type='text/css' media='all' />
    <link rel='stylesheet' id='_fontawesome-css'  href='//cdn.bootcss.com/font-awesome/4.2.0/css/font-awesome.min.css ' type='text/css' media='all' />
    <link rel='stylesheet' id='_main-css'  href='<?php $this->options->themeUrl('css/main.css '); ?>' type='text/css' media='all' /><?php if ($this->options->customcss): ?>
    <style><?php $this->options->customcss(); ?></style><?php endif; ?>

    <script type='text/javascript' src='//cdn.bootcss.com/jquery/1.9.1/jquery.min.js '></script>
    <!--加载进度条-->
    <link href="//cdn.bootcss.com/pace/1.0.2/themes/orange/pace-theme-flash.css" rel="stylesheet" />
    <script> paceOptions = { elements: {selectors: ['#footer']}};</script>
    <script src="//cdn.bootcss.com/pace/1.0.2/pace.min.js"></script>
    <!--[if lt IE 9]><script src="//cdn.bootcss.com/html5shiv/3.7.3/html5shiv.min.js"></script><![endif]-->
    <?php $this->header('keywords=&generator=&template=&pingback=&xmlrpc=&wlw=&commentReply=&rss1=&rss2=&atom='); ?>
</head>

<body class="<?php if ($this->is('index')) : ?>home<?php elseif ($this->is('post')) : ?>single<?php elseif ($this->is('page')) : ?>page<?php elseif ($this->is('archive')) : ?>archive<?php else: ?><?php endif; ?>">
    <header class="header">
        <div class="container">
            <h1 class="logo">
<?php if (!empty($this->options->logoUrl)): ?>
                <a href="<?php $this->options ->siteUrl(); ?>"><img src="<?php $this->options->logoUrl(); ?>" alt="<?php $this->options->title();?>" /></a>
<?php else: ?>
                <a href="<?php $this->options ->siteUrl(); ?>"><img src="<?php $this->options->themeUrl('img/logo.png'); ?>" alt="<?php $this->options->title();?>" /><?php $this->options->title();?></a>
<?php endif; ?>
            </h1>
            <div class="brand"><?php if($this->options->logotext && !empty($this->options->logotext) ): ?><?php $this->options->logotext(); ?><?php endif; ?></div>
            <ul class="site-nav site-navbar">
                <li>
                <a href="<?php $this->options ->siteUrl(); ?>">
                    <i class="fa fa-home"></i>首页</a>
                </li><?php $this->widget('Widget_Metas_Category_List')->to($cats); $i=0;  $b_arr = fa_ico(); ?><?php while ($cats->next()): ?>
                <li><a href="<?php $cats->permalink()?>"><?php echo $b_arr[$i]; ?> <?php $cats->name()?></a></li><?php $i++; ?><?php endwhile; ?>
                <li>
                    <a><i class="fa fa-file-text-o"></i>页面</a>
                    <ul class="sub-menu">
    <?php $this->widget('Widget_Contents_Page_List')->to($pages); while($pages->next()): ?>
                        <li <?php if($this->is('page', $pages->slug)): ?> class="current-menu-item"<?php endif; ?>><a href="<?php $pages->permalink(); ?>"><?php $pages->title(); ?></a></li>
    <?php endwhile; ?>
                    </ul>
                </li>
                <li class="navto-search">
                    <a href="javascript:;" class="search-show active"><i class="fa fa-search"></i></a>
                </li>
            </ul>
            <i class="fa fa-bars m-icon-nav"></i>
        </div>
    </header>
    <div class="site-search">
        <div class="container">
            <form method="get" class="site-search-form" action="<?php $this->options ->siteUrl(); ?>">
                <input class="search-input" name="s" type="text" placeholder="输入关键字" value="">
                <button class="search-btn" type="submit"><i class="fa fa-search"></i></button>
            </form>
        </div>
    </div>
    <!--header-->
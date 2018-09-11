<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('header.php'); ?>
    <section class="container">
        <div class="f404">
            <img src="<?php $this->options->themeUrl('img/404.png'); ?>">
            <h1>404 Page Not Found</h1>
            <h2>沒有找到你要的内容！</h2>
            <p>
                <a class="btn btn-primary" href="<?php $this->options ->siteUrl(); ?>">返回首页</a>
            </p>
        </div>
    </section>
<?php $this->need('footer.php'); ?>
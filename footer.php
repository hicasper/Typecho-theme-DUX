<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
?>
    <!--footer-->
<?php if($this->options->footad && !empty($this->options->footad) ): ?><div class="branding branding-black">
	<div class="container">
		<?php $this->options->footad(); ?>
	</div>
</div><?php endif; ?>
<footer id="footer" class="footer">
	<div class="container">
		<?php if($this->options->flinks && !empty($this->options->flinks) ): ?>
		<div class="flinks"><?php /* 底部导航条 一般li格式 友情链接使用*/ ?>
			<strong>友情链接</strong>
			<ul class='xoxo blogroll'>
				<?php $this->options->flinks(); ?>
			</ul>
		</div><?php endif; ?>
		<?php if($this->options->fcode && !empty($this->options->fcode) ): ?><div class="fcode"><?php $this->options->fcode(); ?></div><?php endif; ?>
		<p>&copy; <?php echo date("Y"); ?> <a href="<?php $this->options ->siteUrl(); ?>"><?php $this->options->title();?></a>&nbsp; Powered by <a href="http://www.typecho.org/" target="_blank">Typecho</a>
</p>
		<div class="hide"></div>	
	</div>
</footer>
<?php if ($this->options->useHighline == 'able'): ?>
<script src="//cdn.bootcss.com/highlight.js/9.9.0/highlight.min.js"></script>
<?php endif; ?>
<script>
window.jsui={
    www: '<?php $this->options ->siteUrl(); ?>',
    uri: '<?php echo rtrim($this->options ->themeUrl,"/");?>',
    ver: '0.1',
	roll: [<?php if (!empty($this->options->sitebar_fu)) {$text = $this->options->sitebar_fu;}
	else{$text='1,2';} $sf_arr = explode(",", $text);foreach($sf_arr as $val){echo '"'.$val.'",';} //侧边栏第几个模块浮动?>],
    ajaxpager: '0',
    url_rp: '<?php $this->options->adminUrl('login.php'); ?>'
};
</script>
<script type='text/javascript' src='//cdn.bootcss.com/bootstrap/3.2.0/js/bootstrap.min.js?ver=0.1'></script>
<script type='text/javascript' src='<?php $this->options->themeUrl('js/loader.js?ver=0.1'); ?>'></script>
<?php if($this->options->GoogleAnalytics): ?>
<?php $this->options->GoogleAnalytics(); ?>
<?php endif; ?>
</body>
</html>
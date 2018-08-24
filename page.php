<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('header.php'); ?>
<div class="container container-page">
	<div class="pageside">
	<div class="pagemenus">
		<ul class="pagemenu">
		<?php $this->widget('Widget_Contents_Page_List')->to($cpages);?>
<?php while ($cpages->next()): ?>
<li<?php if($cpages->title==$this->title){print ' class="active"';} ?>><a href="<?php $cpages->permalink();?>"><?php $cpages->title();?></a></li>
<?php endwhile; ?> 
		</ul>
	</div>
	</div>	
	<div class="content">
	<header class="article-header">
	<h1 class="article-title"><a href="<?php $this->permalink(); ?>"><?php $this->title() ?></a></h1>
	</header>
	<article class="article-content">
	<?php parseContent($this); ?>
	</article>

	
<?php //$this->need('comments.php'); ?>				
	</div>
</div>
<?php $this->need('footer.php'); ?>
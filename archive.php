<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('header.php'); ?>

<section class="container">
  <div class="content-wrap">
    <div class="content">
      <div class="pagetitle">
        <h3><?php $this->archiveTitle(array(
            'category'  =>  _t('%s'),
            'search'    =>  _t('搜索 %s'),
            'tag'       =>  _t('标签 %s'),
            'author'    =>  _t('作者 %s')
        ), '', ''); ?></h3>
      </div>
		<?php if($this->have()):?>
        <?php while($this->next()): ?>
      <article class="excerpt">
        <a class="focus" href="<?php $this->permalink() ?>">
          <img src="<?php $this->options->themeUrl('img/thumbnail.png'); ?>" data-src="<?php echo showThumb($this,null,true); ?>" class="thumb"></a>
        <header>
          <a class="cat"><?php $this->category(',',false); ?><i></i></a>
          <h2>
            <a href="<?php $this->permalink() ?>" title="<?php $this->title() ?>-<?php $this->options->title();?>"><?php $this->title() ?></a></h2>
        </header>
        <p class="meta">
          <time>
            <i class="fa fa-clock-o"></i><?php $this->date('Y-m-d'); ?></time>
          <span class="author">
            <i class="fa fa-user"></i><?php $this->author(); ?></span>
          <span class="pv">
            <i class="fa fa-eye"></i>阅读(<?php get_post_view($this) ?>)</span>
          <a class="pc" href="<?php $this->permalink() ?>#respond">
            <i class="fa fa-comments-o"></i>评论(<?php $this->commentsNum('0', '1', '%d'); ?>)</a>
        </p>
        <p class="note"><?php $this->excerpt(111, '...'); ?></p></article>
		<?php endwhile; ?>
		<?php endif; ?>		
		
      <div class="pagination">
		<?php $this->pageNav('上一页', '下一页', 3, '...', array('wrapTag' => 'ul', 'wrapClass' => 'page-navigator', 'itemTag' => 'li', 'textTag' => 'span', 'currentClass' => 'active', 'prevClass' => 'prev-page', 'nextClass' => 'next-page')); ?>
      </div>
    </div>
  </div>
<?php $this->need('sidebar.php'); ?>
</section>

<?php $this->need('footer.php'); ?>
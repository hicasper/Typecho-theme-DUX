<?php
/**
 * 标签云
 *
 * @package custom
 */
 if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('header.php'); ?>
    <div class="container <?php if ($this->options->pagesidebar == "able"): ?>container-page<?php else: ?>container-no-sidebar<?php endif; ?>">
<?php if ($this->options->pagesidebar == "able"): ?>
        <div class="pageside">
            <div class="pagemenus">
                <ul class="pagemenu">
<?php $this->widget('Widget_Contents_Page_List')->to($cpages);?>
<?php while ($cpages->next()): ?>
                    <li <?php if($cpages->permalink==$this->permalink){echo ' class="active"';} ?>><a href="<?php $cpages->permalink()?>"><?php $cpages->title()?></a></li>
<?php endwhile; ?>
                </ul>
            </div>
        </div>
<?php endif; ?>
        <div class="content">
            <header class="article-header">
                <h1 class="article-title"><a href="<?php $this->permalink(); ?>"><?php $this->title() ?></a></h1>
            </header>
            <article class="article-content" style="display:none"></article>
            <div class="tag-clouds">
<?php $this->widget('Widget_Metas_Tag_Cloud', 'ignoreZeroCount=1&limit=30')->to($tags); ?>
<?php while($tags->next()): ?>
                <a href="<?php $tags->permalink(); ?>"><?php $tags->name(); ?>（<?php $tags->count(); ?>）</a>
<?php endwhile; ?>
            </div>
        </div>
    </div>
<?php $this->need('footer.php'); ?>
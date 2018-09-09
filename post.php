<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('header.php'); ?>
    <section class="container">
        <div class="content-wrap">
            <div class="content">
                <header class="article-header">
                    <h1 class="article-title"><a href="<?php $this->permalink(); ?>"><?php $this->title() ?></a></h1>
                    <div class="article-meta">
                        <span class="item"><?php $this->date('Y-m-d'); ?></span>
                        <span class="item">分类：<?php $this->category(' / ');?></span>
                        <span class="item post-views">阅读(<?php get_post_view($this) ?>)</span>
                        <span class="item">评论(<?php $this->commentsNum('0', '1', '%d'); ?>)</span>
                    </div>
                </header>
                <article class="article-content">
                    <?php parseContent($this); ?>
                </article>

                <div class="post-copyright">本原创文章未经允许不得转载 | 当前页面：<a href="<?php $this->options ->siteUrl(); ?>"><?php $this->options->title();?></a> &raquo; <a href="<?php $this->permalink(); ?>"><?php $this->title() ?></a></div>
                <div class="article-tags">标签：<?php $this->tags(' ', true, '<a>没有标签</a>'); ?></div>
<?php if($this->options->authordesc && !empty($this->options->authordesc) ): ?>
                <div class="article-author">
                    <div class="avatar"><?php $this->author->gravatar('50', 'g'); ?></div><h4><i class="fa fa-user" aria-hidden="true"></i><?php $this->author(); ?></h4>
                    <span><?php $this->options->authordesc(); ?></span>
                </div>
<?php endif; ?>
                <nav class="article-nav">
                    <span class="article-nav-prev">上一篇<br><?php $this->thePrev(); ?></span>
                    <span class="article-nav-next">下一篇<br><?php $this->theNext(); ?></span>
                </nav>
<?php $this->related(8,'author')->to($relatedPosts); ?>
<?php if($relatedPosts->have()):?>
                <div class="relates"><div class="title"><h3>相关推荐</h3></div>
                    <ul>
<?php while($relatedPosts->next()): ?>
                        <li><a href="<?php $relatedPosts->permalink();?>" title="<?php $relatedPosts->title();?>"><?php $relatedPosts->title();?></a></li>
<?php endwhile; ?>
                    </ul>
                </div>
<?php endif?>

<?php $this->need('comments.php'); ?>
            </div>
        </div>
<?php $this->need('sidebar.php'); ?>
    </section>
<?php $this->need('footer.php'); ?>
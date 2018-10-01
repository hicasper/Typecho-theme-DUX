<?php
/**
 * 页面存档
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
        <article class="article-content"></article>
<?php
    $this->widget('Widget_Contents_Post_Recent', 'pageSize=10000')->to($archives);
    $year=0; $mon=0; $i=0; $j=0;
    $output = '<article class="archives">';
    while($archives->next()):
    $year_tmp = date('Y',$archives->created);
    $mon_tmp = date('m',$archives->created);
    $y=$year; $m=$mon;
    if ($mon != $mon_tmp && $mon > 0) $output .= '</ul></div>';
    if ($year != $year_tmp && $year > 0) $output .= '';
    if ($year != $year_tmp) {
    $year = $year_tmp;
    }
    if ($mon != $mon_tmp) {
    $mon = $mon_tmp;
    $output .= '<div class="item"><h3>'. $year . '年' . $mon .' 月</h3><ul class="archives-list">'; //输出月份
    }
    $output .= '<li><time>'.date('d日: ',$archives->created).'</time><a href="'.$archives->permalink .'">'. $archives->title .'</a> <span class="text-muted">'. $archives->commentsNum.'评论</span></li>'; //输出文章日期和标题
    endwhile;
    $output .= '</ul></div></article>';
?>
<?php echo $output; ?>
    </div>
<?php $this->need('footer.php'); ?>
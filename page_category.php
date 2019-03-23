<?php
/**
 * 分类存档
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
$obj = $this->widget('Widget_Metas_Category_List');
if($obj->have()){
	$output = '<article class="archives">';
    while($obj->next()){
		$output .= '<div class="item"><h3><a href="'.$obj->permalink.'"><font color="#F15A23">'.$obj->name.'</font></a></h3><ul class="archives-list">';
        $this->widget('Widget_Archive@'.$obj->name, 'type=category', 'mid='.$obj->mid)->to($categoryPosts);
        while ($categoryPosts->next()) {
            $output .= '<li><a href="'.$categoryPosts->permalink .'">'. $categoryPosts->title .'</a> <span class="text-muted">'. $categoryPosts->commentsNum.'评论</span></li>';
		}  
		$output .= '</ul></div>';    
    }
    $output .= '</article>';
    echo $output;
}else{
    echo '无分类';
}
?>

<?php $this->need('comments.php'); ?>
    </div>
</div>
<?php $this->need('footer.php'); ?>

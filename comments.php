<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php
function threadedComments($comments, $options) {
    $commentClass = 'commentlist';
    if ($comments->authorId) {
        if ($comments->authorId == $comments->ownerId) {
            $commentClass .= ' comment-by-author';
        } else {
            $commentClass .= ' comment-by-user';
        }
    }

    $commentLevelClass = $comments->levels > 0 ? ' comment-child' : ' comment-parent';

    if ($comments->url) {
        $author = '<a href="' . $comments->url . '" target="_blank"' . ' rel="external nofollow">' . $comments->author . '</a>';
    } else {
        $author = $comments->author;
    }
?>

<li id="<?php $comments->theId(); ?>" class="comment byuser comment-author-admin bypostauthor depth-<?php echo $comments->levels+1; ?> comment-body<?php
if ($comments->levels > 0) {
    echo ' comment-child';
    $comments->levelsAlt(' comment-level-odd', ' comment-level-even');
} else {
    echo ' comment-parent';
}
$comments->alt(' odd', ' even');
?>">
	<?php
        $host = 'https://secure.gravatar.com';
        $url = '/avatar/';
        $size = '50';
        $rating = Helper::options()->commentsAvatarRating;
        $hash = md5(strtolower($comments->mail));
        $avatar = $host . $url . $hash . '?s=' . $size . '&r=' . $rating . '&d=';
    ?>
	<div class="comt-avatar"><img alt="" data-src="<?php echo $avatar ?>" srcset="<?php echo $avatar ?> 2x" class="avatar avatar-50 photo" height="50" width="50" src="<?php $aoptions = Typecho_Widget::widget('Widget_Options'); $aoptions ->themeUrl("img/avatar-default.png"); ?>"></div>
	<div class="comt-main" id="div-<?php $comments->theId(); ?>"><p><?php $comments->content(); ?></p>
	<div class="comt-meta"><span class="comt-author"><?php echo $comments->author; ?></span> (<?php $comments->date('Y-m-d'); ?>) <?php $comments->reply('回复'); ?></div></div>
    <?php if ($comments->children) { ?>
        <ul class="children">
            <?php $comments->threadedComments($options); ?>
        </ul><!-- .children -->
    <?php } ?>
</li><!-- #comment -->
<?php } ?>

<?php $this->comments()->to($comments); ?>
<div class="title" id="comments">
	<h3>评论 <?php $this->commentsNum('<small>抢沙发</small>', '<b>1</b>', '<b>%d</b>'); ?></h3>
</div>
<div id="<?php $this->respondId(); ?>" class="no_webshot">
	<?php if(!$this->allow('comment')){ ?>
	<h3 class="title">
		<strong>文章评论已关闭！</strong>
	</h3>
	<?php }else{ ?>
	
	<form action="<?php $this->commentUrl() ?>" method="post" id="commentform">
		<div class="comt">
			<div class="comt-title">
				<?php if($this->user->hasLogin()): ?>
				<img alt="" data-src="https://secure.gravatar.com/avatar/<?php echo md5($this->user->mail); ?>?s=50" srcset="https://secure.gravatar.com/avatar/<?php echo md5($this->user->mail); ?>?s=50 2x" class="avatar avatar-50 photo" height="50" width="50" src="<?php $aoptions = Typecho_Widget::widget('Widget_Options'); $aoptions ->themeUrl("img/avatar-default.png"); ?>">
				<p><?php $this->user->screenName(); ?></p>
				<?php else: ?>
				<?php $aoptions = Typecho_Widget::widget('Widget_Options');?> 
				<img alt="" data-src="<?php $aoptions ->themeUrl("img/avatar-default.png"); ?>" srcset="<?php $aoptions ->themeUrl("img/avatar-default.png"); ?> 2x" class="avatar avatar-50 photo" height="50" width="50" src="<?php $aoptions ->themeUrl("img/avatar-default.png"); ?>">
				<?php endif; ?>
				<p><?php $comments->cancelReply('取消'); ?></p>
			</div>
			<div class="comt-box">
				<textarea placeholder="你的评论可以一针见血" class="input-block-level comt-area" name="text" id="comment" cols="100%" rows="3" tabindex="1" ></textarea>
				<div class="comt-ctrl">
					<div class="comt-tips"></div>
					<button type="submit" name="submit" id="submit" tabindex="5">提交评论</button>
					<?php $security = $this->widget('Widget_Security'); ?>
					<input type="hidden" name="_" value="<?php echo $security->getToken($this->request->getReferer())?>">
				</div>
			</div>

			<?php if(!$this->user->hasLogin()): ?>
				<div class="comt-comterinfo" id="comment-author-info" >
					<ul>
						<li class="form-inline"><label class="hide" for="author">昵称</label><input class="ipt" type="text" name="author" id="author" value="" tabindex="2" placeholder="昵称" required><span class="text-muted">昵称 (必填)</span></li>
						<li class="form-inline"><label class="hide" for="email">邮箱</label><input class="ipt" type="text" name="email" id="email" value="" tabindex="3" placeholder="邮箱" <?php if ($this->options->commentsRequireMail): ?> required<?php endif; ?>><span class="text-muted">邮箱 (必填)</span></li>
						<li class="form-inline"><label class="hide" for="url">网址</label><input class="ipt" type="text" name="url" id="url" value="" tabindex="4" placeholder="网址"><span class="text-muted">网址</span></li>
					</ul>
				</div>
			<?php endif; ?>
		</div>

	</form>
	<?php } ?>
</div>
<?php if ($comments->have()) : ?>
<div id="postcomments">
	<ol class="commentlist">
		<?php $comments->listComments(array('before' =>  '','after'  =>  '')); ?>
	</ol>	
	<div class="pagenav">
		<?php $comments->pageNav('←','→','2','...'); ?>
	</div>
</div>
<?php endif; ?>
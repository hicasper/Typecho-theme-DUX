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
    $host = '//cn.gravatar.com';
    $url = '/avatar/';
    $size = '50';
    $rating = Helper::options()->commentsAvatarRating;
    $hash = md5(strtolower($comments->mail));
    $avatar = $host . $url . $hash . '?s=' . $size . '&r=' . $rating . '&d=mm';
?>
        <div class="comt-avatar"><img alt="" data-src="<?php echo $avatar; ?>" srcset="<?php echo $avatar; ?> 2x" class="avatar photo" height="50" width="50" src="<?php $aoptions = Typecho_Widget::widget('Widget_Options'); $aoptions ->themeUrl("img/avatar-default.png"); ?>"></div>
        <div class="comt-main" id="div-<?php $comments->theId(); ?>">
            <?php $comments->content(); ?>
            <div class="comt-meta">
                <span class="comt-author"><?php echo $author; ?></span> <?php $comments->date('Y-m-d'); ?>&nbsp;&nbsp;&nbsp;&nbsp;<?php $comments->reply('回复'); ?>
            </div>
        </div>
    <?php if ($comments->children) { ?><ul class="children"><?php $comments->threadedComments($options); ?></ul><?php } ?>
    </li><?php } ?>
<?php $this->comments()->to($comments); ?>
    <div class="title" id="comments">
        <h3>评论 <?php $this->commentsNum('<small></small>', '<b>1</b>', '<b>%d</b>'); ?></h3>
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
                    <img alt="" data-src="//cn.gravatar.com/avatar/<?php echo md5($this->user->mail); ?>?s=50" srcset="//cn.gravatar.com/avatar/<?php echo md5($this->user->mail); ?>?s=50 2x" class="avatar photo" height="50" width="50" src="<?php $aoptions = Typecho_Widget::widget('Widget_Options'); $aoptions ->themeUrl("img/avatar-default.png"); ?>">

<?php elseif($this->remember('author',true) != "" && $this->remember('mail',true) != ""): ?>
                    <img alt="" data-src="//cn.gravatar.com/avatar/<?php echo md5($this->remember('mail')); ?>?s=50" srcset="//cn.gravatar.com/avatar/<?php echo md5($this->remember('mail')); ?>?s=50 2x" class="avatar photo" height="50" width="50" src="<?php $aoptions = Typecho_Widget::widget('Widget_Options'); $aoptions ->themeUrl("img/avatar-default.png"); ?>">
<?php else: ?><?php $aoptions = Typecho_Widget::widget('Widget_Options');?>
                    <img alt="" data-src="<?php $aoptions ->themeUrl("img/avatar-default.png"); ?>" srcset="<?php $aoptions ->themeUrl("img/avatar-default.png"); ?> 2x" class="avatar photo" height="50" width="50" src="<?php $aoptions ->themeUrl("img/avatar-default.png"); ?>">
<?php endif; ?>

                   <p><?php $comments->cancelReply('<font color="##FF5151"><br>取消</font>'); ?></p>
                </div>
                <div class="comt-box">
                    <font size="3" color="#66B3FF"><?php if($this->user->hasLogin()): ?><?php $this->user->screenName(); ?><?php elseif($this->remember('author',true) != "" && $this->remember('mail',true) != ""): ?><?php $this->remember('author'); ?><?php endif; ?></font>                    
                    <textarea placeholder="欢迎在此评论， be nice & cool." class="input-block-level comt-area" name="text" id="comment" cols="100%" rows="3" tabindex="1" ></textarea>
                    <div class="comt-ctrl">
                        <div class="comt-tips"></div>
                        <button type="submit" name="submit" id="submit" tabindex="5">提交评论</button>
<?php $security = $this->widget('Widget_Security'); ?>
                        <input type="hidden" name="_" value="<?php echo $security->getToken($this->request->getReferer())?>">
                    </div>

                </div>
<?php if(!$this->user->hasLogin()): ?>
                <div class="comt-comterinfo" id="comment-author-info" <?php if($this->remember('author',true) != "" && $this->remember('mail',true) != ""): ?>style="display:none;"<?php endif; ?> >
                    <ul>
                        <li class="form-inline"><label class="hide" for="author">昵称</label><input class="ipt" type="text" name="author" id="author" value="<?php $this->remember('author'); ?>" tabindex="2" placeholder="昵称（必填）" required><span class="text-muted"></span></li>
                        <li class="form-inline"><label class="hide" for="mail">邮箱</label><input class="ipt" type="text" name="mail" id="mail" value="<?php $this->remember('mail'); ?>" tabindex="3" placeholder="邮箱（必填）" <?php if ($this->options->commentsRequireMail): ?> required<?php endif; ?>><span class="text-muted"></span></li>
                        <li class="form-inline"><label class="hide" for="url">网址</label><input class="ipt" type="text" name="url" id="url" value="<?php $this->remember('url'); ?>" tabindex="4" placeholder="网址"><span class="text-muted"></span></li>
                    </ul>
                </div>
<?php endif; ?>
            </div>
        </form>
<?php } ?>
    </div>
<?php if ($comments->have()) : ?>
    <div id="postcomments">
        <ol class="commentlist"><?php $comments->listComments(array('before' =>  '','after'  =>  '')); ?></ol>
        <div class="pagination">
            <?php $comments->pageNav('←','→',2,'...',array('wrapTag' => 'ul')); ?>
        </div>
    </div>
<?php endif; ?>

<script>
function showhidediv(id){  
var sbtitle=document.getElementById(id);  
if(sbtitle){  
   if(sbtitle.style.display=='block'){  
   sbtitle.style.display='none';  
   }else{  
   sbtitle.style.display='block';  
   }  
}  
}
    
(function () {
    window.TypechoComment = {
        dom : function (id) {
            return document.getElementById(id);
        },
        create : function (tag, attr) {
            var el = document.createElement(tag);
            for (var key in attr) {
                el.setAttribute(key, attr[key]);
            }
            return el;
        },
        reply : function (cid, coid) {
            var comment = this.dom(cid), parent = comment.parentNode,
                response = this.dom('<?php echo $this->respondId(); ?>'),
                input = this.dom('comment-parent'),
                form = 'form' == response.tagName ? response : response.getElementsByTagName('form')[0],
                textarea = response.getElementsByTagName('textarea')[0];
            if (null == input) {
                input = this.create('input', {
                    'type' : 'hidden',
                    'name' : 'parent',
                    'id'   : 'comment-parent'
                });
                form.appendChild(input);
            }
            input.setAttribute('value', coid);
            if (null == this.dom('comment-form-place-holder')) {
                var holder = this.create('div', {
                    'id' : 'comment-form-place-holder'
                });
                response.parentNode.insertBefore(holder, response);
            }
            comment.appendChild(response);
            this.dom('cancel-comment-reply-link').style.display = '';
            if (null != textarea && 'text' == textarea.name) {
                textarea.focus();
            }
            return false;
        },
        cancelReply : function () {
            var response = this.dom('<?php echo $this->respondId(); ?>'),
            holder = this.dom('comment-form-place-holder'),
            input = this.dom('comment-parent');
            if (null != input) {
                input.parentNode.removeChild(input);
            }
            if (null == holder) {
                return true;
            }
            this.dom('cancel-comment-reply-link').style.display = 'none';
            holder.parentNode.insertBefore(response, holder);
            return false;
        }
    };
})();
</script>

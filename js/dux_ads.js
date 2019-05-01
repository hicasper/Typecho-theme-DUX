$.getScript('//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js',function(){
    if ($(window).width() > 250){
        $('.excerpt:first').before('<article class="excerpt-minic" style="max-height:130px;margin-bottom:10px;"><ins class="adsbygoogle" style="display:block" data-ad-format="fluid" data-ad-layout-key="-hc+5+15-58+68" data-ad-client="ca-pub-3698194630053816" data-ad-slot="9192487876"></ins></article>');
    }
    if ($(window).width() > 640){
        $('.article-header').append('<ins class="adsbygoogle" style="display:block;margin:1.5em auto -0.3em;" data-ad-client="ca-pub-3698194630053816" data-ad-slot="4735788990" data-ad-format="auto" data-full-width-responsive="true"></ins>');
    }
    $('.article-nav').after('<ins class="adsbygoogle" style="display:block;margin:-1em auto 1.5em;" data-ad-client="ca-pub-3698194630053816" data-ad-slot="9629023024" data-ad-format="auto" data-full-width-responsive="true"></ins>');
    if ($(window).width() > 1024){
        $('.widget:last').after('<div class="widget widget_ui_textasb"><ins class="adsbygoogle" style="display:block" data-ad-client="ca-pub-3698194630053816" data-ad-slot="1205482377" data-ad-format="auto" data-full-width-responsive="true"></ins></div>');
    }
    $('.copyright').before('<ins class="adsbygoogle" style="display:block" data-ad-client="ca-pub-3698194630053816" data-ad-slot="7672765910" data-ad-format="link" data-full-width-responsive="true"></ins><hr>');
    [].forEach.call(document.querySelectorAll('.adsbygoogle'), function(){
        (adsbygoogle = window.adsbygoogle || []).push({});
    });
});
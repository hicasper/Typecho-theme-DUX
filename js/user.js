tbfine(['router', 'jsrender'], function (){

	/* jsonp
 * ====================================================
*/
(function($) {
    $.ajaxTransport('jsonpi', function(opts, originalOptions, jqXHR) {
        var jsonpCallback = opts.jsonpCallback = 
                jQuery.isFunction(opts.jsonpCallback) ? opts.jsonpCallback() : opts.jsonpCallback,
            previous = window[jsonpCallback],
            replace = "$1" + jsonpCallback + "$2",
            url = opts.url;

        if (opts.type == 'GET')
            opts.params[opts.jsonp] = jsonpCallback;
        else
            url += (/\?/.test( url ) ? "&" : "?") + opts.jsonp + "=" + jsonpCallback;

        return {
            send: function(_, completeCallback) {
                var name = 'jQuery_iframe_' + jQuery.now(),
                    iframe, form;

                // Install callback
                window[jsonpCallback] = function(data) {
                    // TODO: How to handle errors? Only 200 for now
                    completeCallback(200, 'success', {
                        'jsonpi': data
                    });

                    iframe.remove();
                    form.remove();

                    window[jsonpCallback] = previous;
                };

                iframe = $('<iframe name="'+name+'">') //ie7 bug fix
                    //.attr('name', name)
                    .appendTo('head');

                form = $('<form>')
                    .attr('method', opts.type) // GET or POST
                    .attr('action', url)
                    .attr('target', name);
                
                $.each(opts.params, function(k, v) {
                    $('<input>')
                        .attr('type', 'hidden')
                        .attr('name', k)
                        .attr('value', v)
                        .appendTo(form);
                });
                form.appendTo('body').submit();
            },
            abort: function() {
                // TODO
            }
       };
    });
})(jQuery);

return {
	init: function (){
		var 
			_iframe = $('#contentframe'),
			_main = $('.user-main'),
			_homepage = 'comments',
			cache_postmenu = null,
			cache_userdata = null,
			cache_orderdata = null,
			cache_coupondata = null,

			rp_post = /^#post\//,
			rp_comment = /^#comment/,
			rp_like = /^#like/,

			ajax_url = jsui.uri+'/action/user.php',

			_msg = {
				// 1-2位：类型；3-4位：01-69指客户端操作提示，71-99指服务端操作提示
				1101: '该栏目下暂无数据！',
				1079: '服务器异常，请稍候再试！',

				1201: '暂无文章！',
				1301: '暂无评论！'
			}

		function is_comment(){
			return rp_comment.test(location.hash) ? true : false
		}


		var routes = {
			'posts/all': function(){
				get_postdata('all', 1)
				$('.user-postmenu a:eq(0)').addClass('active')
			},
			'posts/all/:paged': function(paged){
				get_postdata('all', paged)
				$('.user-postmenu a:eq(0)').addClass('active')
			},

			'posts/publish': function(){
				get_postdata('publish', 1)
				$('.user-postmenu a:eq(1)').addClass('active')
			},
			'posts/publish/:paged': function(paged){
				get_postdata('publish', paged)
				$('.user-postmenu a:eq(1)').addClass('active')
			},

			'posts/future': function(){
				get_postdata('future', 1)
				$('.user-postmenu a:eq(2)').addClass('active')
			},
			'posts/future/:paged': function(paged){
				get_postdata('future', paged)
				$('.user-postmenu a:eq(2)').addClass('active')
			},

			'posts/pending': function(){
				get_postdata('pending', 1)
				$('.user-postmenu a:eq(3)').addClass('active')
			},
			'posts/pending/:paged': function(paged){
				get_postdata('pending', paged)
				$('.user-postmenu a:eq(3)').addClass('active')
			},

			'posts/draft': function(){
				get_postdata('draft', 1)
				$('.user-postmenu a:eq(4)').addClass('active')
			},
			'posts/draft/:paged': function(paged){
				get_postdata('draft', paged)
				$('.user-postmenu a:eq(4)').addClass('active')
			},

			'posts/trash': function(){
				get_postdata('trash', 1)
				$('.user-postmenu a:eq(5)').addClass('active')
			},
			'posts/trash/:paged': function(paged){
				get_postdata('trash', paged)
				$('.user-postmenu a:eq(5)').addClass('active')
			},

			'comments': function(){
				get_commentdata(1)
			},
			'comments/:paged': function(paged){
				get_commentdata(paged)
			},

			'info': function(){
				menuactive('info')

				loading( _main )

				if( !cache_userdata ){
					$.ajax({
						url: ajax_url,
						type: 'POST',
						dataType: 'json',
						data: {
							action: 'info'
						},
						success: function(data, textStatus, xhr) {
							if( data.user ){
								cache_userdata = data.user
								_main.html(
									$('#temp-info').render( data.user )
								)
							}else{
								loading(_main, _msg['1101'])
							}
						},
						error: function(xhr, textStatus, errorThrown) {
							loading(_main, _msg['1079'])
						}
					});

				}else{
					_main.html(
						$('#temp-info').render( cache_userdata )
					)
				}
			},

			'password': function(){
				menuactive('password')

				_main.html(
					$('#temp-password').render()
				)
				
			},

			'post-new': function(){
				menuactive('post-new')

				_main.html(
					$('#temp-postnew').render()
				)

				$('.user-main').hide()
				$('.user-main-postnew').show()
				
			}

		}

		var router = Router(routes);
		router.configure({
			on: function(){
				if( location.hash.indexOf('posts/')<=0 ){
					$('.user-postmenu').remove()
				}
			},
			before: function(){
				$('.user-main').show()
				$('.user-main-postnew').hide()
			},
			notfound: function(){
				location.hash = _homepage
			}
		})
		router.init();

		if( !location.hash ) location.hash = _homepage


		/* 
		 * functions
		 * ====================================================
		*/
	
		function get_postdata(status, paged, callback){
			menuactive('posts')
			$('.user-postmenu a').removeClass()

			loading( _main )

			var datas = {
				action: 'posts',
				status: status,
				paged: paged
			}

			if( !cache_postmenu ){
				datas.first = true
			}

			$.ajax({
				url: ajax_url,
				type: 'POST',
				dataType: 'json',
				data: datas,
				success: function(data, textStatus, xhr) {
					// console.log( data )

					if( !cache_postmenu && data.menus ){
						cache_postmenu = data.menus
					}

					if( (cache_postmenu || (!cache_postmenu && data.menus)) && !$('.user-postmenu').length ){
						_main.before( '<div class="user-postmenu"></div>' )
						$('.user-postmenu').html(
							$('#temp-postmenu').render( cache_postmenu || data.menus )
						)
					}

					if( data.items ){
						_main.html('<ul class="user-postlist"></ul>')
						$('.user-postlist').html(
							$('#temp-postitem').render( data.items )
						).after( paging(data.max, paged, '#posts/'+status+'/') )
						
						thumb_lazyload()
					}else{
						loading(_main, _msg['1201'])
					}

					callback && callback()
				},
				error: function(xhr, textStatus, errorThrown) {
					loading(_main, _msg['1079'])
				}
			});
		}

		function get_commentdata(paged){

			menuactive('comments')
			loading( _main )

			$.ajax({
				url: ajax_url,
				type: 'POST',
				dataType: 'json',
				data: {
					action: 'comments',
					paged: paged
				},
				success: function(data, textStatus, xhr) {
					// console.log( data )

					if( data.items ){
						_main.html( '<ul class="user-commentlist"></ul>' )
						$('.user-commentlist').html(
							$('#temp-commentitem').render( data.items )
						).after( paging(data.max, paged, '#comments/') )
					}else{
						loading(_main, _msg['1301'])
					}
				},
				error: function(xhr, textStatus, errorThrown) {
					loading(_main, _msg['1079'])
				}
			});
		}

		function menuactive(name){
			$('.usermenus li').removeClass('active')
			$('.usermenu-'+name).addClass('active')
		}

		function loading(el, msg){
			if( !msg ){
				msg = '<i class="fa fa-spinner fa-spin" style="position:relative;top:1px;margin-right:5px;"></i> 数据加载中'
			}
			el.html('<div class="user-loading">'+msg+'</div>')
		}

		function thumb_lazyload(){
			tbquire(['lazyload'], function(){
				$('.user-main .thumb').lazyload({
			        data_attribute: 'src',
			        placeholder: jsui.uri + '/img/thumbnail.png',
			        threshold: 400
			    });
		    });
		}


		function paging(max, current, plink, step) {
			var show = 2
			if( !step ) step = 10
		    if ( max <= step ) return;
		    max = Math.ceil(max/step)
		    var html = '<div class="pagination user-pagination"><ul>'

		    if ( !current ) current = 1
		    current = Number(current)
		    if ( current > show + 1 ) html += '<li><a href="'+plink+'1">1</a></li>'
		    if ( current > show + 2 ) html += '<li><span>...</span></li>'
		    for( i = current - show; i <= current + show; i++ ) { 
		        if ( i > 0 && i <= max ){
		        	html += (i == current) ? '<li class="active"><span>'+i+'</span></li>' : '<li><a href="'+plink+i+'">'+i+'</a></li>'
		        }
		    }

		    if ( current < max - show - 1 ) html += '<li><span>...</span></li>'
		    if ( current < max - show ) html += '<li><a href="'+plink+max+'">'+max+'</a></li>'

		    html += '<li><span>共'+max+'页</span></li>'
		    html += '</ul></div>'

		    return html
		}


		var _tipstimer
		function tips(str){
		    if( !str ) return false
		    _tipstimer && clearTimeout(_tipstimer)
		    $('.user-tips').html(str).animate({
		        top: 0
		    }, 220)
		    _tipstimer = setTimeout(function(){
		        $('.user-tips').animate({
		            top: -30
		        }, 220)
		    }, 5000)
		}



		/* click event
		 * ====================================================
		*/
		$('.container-user').on('click', function(e){
		    e = e || window.event;
		    var target = e.target || e.srcElement
		    var _ta = $(target)

		    if( _ta.parent().attr('evt') ){
		        _ta = $(_ta.parent()[0])
		    }else if( _ta.parent().parent().attr('evt') ){
		        _ta = $(_ta.parent().parent()[0])
		    }

		    var type = _ta.attr('evt')

		    if( !type || _ta.hasClass('disabled') ) return 

		    switch( type ){
		    	
		    	case 'postnew.submit':

		    		var form = _ta.parent().parent().parent()
		            var inputs = form.serializeObject()

		            if( !window.tinyMCE ){
		            	tips('数据异常');  
			            return
		            }

			        inputs.post_content = tinyMCE.activeEditor.getContent();

		            var title   =  $.trim(inputs.post_title)
			        var url     =  $.trim(inputs.post_url)
			        var content =  $.trim(inputs.post_content)


		            if ( !title || title.length > 50 ) {
			            tips('标题不能为空，且小于50个字符');  
			            return
			        }

			        if ( !content || content.length > 10000 || content.length < 10 ) {
			            tips('文章内容不能为空，且介于10-10000字之间');  
			            return
			        }

			        if ( !url && url.length > 200 ) {
			            tips('来源链接不能大于200个字符');  
			            return
			        }

		    		$.ajax({  
		                type: 'POST',  
		                url:  ajax_url,  
		                data: inputs,  
		                dataType: 'json',
		                success: function(data){  

		                	if( data.msg ){
	                            tips(data.msg)
	                        }

		                    if( data.error ){
		                        return
		                    }

		                    form.find('.form-control').val('')

		                    location.hash = 'posts/draft'
		                }  
		            });  

		    		break;

		        case 'password.submit':
		        	var form = _ta.parent().parent().parent()
		            var inputs = form.serializeObject()

		            if( !inputs.action ){
		                return
		            }

		        	if( !$.trim(inputs.passwordold) ){
	                    tips('请输入原密码')
	                    return
	                }

	                if( !inputs.password || inputs.password.length < 6 ){
	                    tips('新密码不能为空且至少6位')
	                    return
	                }

	                if( inputs.password !== inputs.password2 ){
	                    tips('两次密码输入不一致')
	                    return
	                }

	                if( inputs.passwordold === inputs.password ){
	                    tips('新密码和原密码不能相同')
	                    return
	                }

		        	$.ajax({  
		                type: 'POST',  
		                url:  ajax_url,  
		                data: inputs,  
		                dataType: 'json',
		                success: function(data){  

		                    if( data.error ){
		                        if( data.msg ){
		                            tips(data.msg)
		                        }
		                        return
		                    }

		                    tips('修改成功！下次登录请使用新密码！')

		                    $('input:password').val('')
		                }  
		            });  

		            break;

		        case 'info.submit':
		            var form = _ta.parent().parent().parent()
		            var inputs = form.serializeObject()

		            if( !inputs.action ){
		                return
		            }

	                if( !/.{2,20}$/.test(inputs.nickname) ){
	                    tips('昵称限制在2-20字内')
	                    return
	                }

	                /*if( !inputs.email ){
	                    tips('邮箱不能为空')
	                    return
	                }

	                if( !is_mail(inputs.email) ){
	                    tips('邮箱格式错误')
	                    return
	                }
*/
	                if( inputs.url && (!is_url(inputs.url) || inputs.url.length>100) ){
	                    tips('网址格式错误')
	                    return
	                }

	                if( inputs.qq && !is_qq(inputs.qq) ){
	                    tips('QQ格式错误')
	                    return
	                }

	                if( inputs.weixin && inputs.weixin.length>30 ){
	                    tips('微信字数过长，限制在30字内')
	                    return
	                }

	                if( inputs.weibo && (!is_url(inputs.weibo) || inputs.weibo.length>100) ){
	                    tips('微博格式错误')
	                    return
	                }

		            $.ajax({  
		                type: 'POST',  
		                url:  ajax_url,  
		                data: inputs,  
		                dataType: 'json',
		                success: function(data){  

		                    if( data.error ){
		                        if( data.msg ){
		                            tips(data.msg)
		                        }
		                        return
		                    }

		                    tips('修改成功！')

		                    cache_userdata = null
		                }  
		            });  

		            break;


		    }
		})
	}
}

})
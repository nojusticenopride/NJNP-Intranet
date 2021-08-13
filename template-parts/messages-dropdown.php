<?php
global $messages_template;
$menu_link            = trailingslashit( bp_loggedin_user_domain() . bp_get_messages_slug() );
$unread_message_count = messages_get_unread_count();
$currentuser_ID = get_current_user_id();
?>
<script>
var chat_appid = '55773';
var chat_auth = '5778036a1e43591ca5260c95d0d5d919';
</script>
<div id="header-messages-dropdown-elem" class="dropdown-passive dropdown-right notification-wrap messages-wrap menu-item-has-children">
    <a href="<?php echo $menu_link ?>"
       ref="notification_bell"
       class="notification-link">
        
                
       <span id="messagesCount" class="d-flex" data-balloon-pos="down" data-balloon="<?php _e( 'Messages', 'buddyboss-theme' ); ?>">
            <i class="bb-icon-inbox-small"></i>
			
        </span>
    </a>
    <section class="notification-dropdown">
        <header class="notification-header">
            <h2 class="title"><?php _e( 'Messages', 'buddyboss-theme' ); ?></h2>
        </header>

        <ul class="notification-list">
               <script>
   



var chat_height = '200px';
var chat_width = '428';

document.write('<div id="cometchat_embed_synergy_container" style="width:'+chat_width+';height:'+chat_height+';max-width:100%;border:1px solid #CCCCCC;border-radius:5px;overflow:hidden;"></div>');

var chat_js = document.createElement('script'); chat_js.type = 'text/javascript'; chat_js.src = 'https://fast.cometondemand.net/'+chat_appid+'x_xchatx_xcorex_xembedcode.js';

chat_js.onload = function() {
    var chat_iframe = {};chat_iframe.module="synergy";chat_iframe.style="min-height:"+chat_height+";min-width:"+chat_width+";";chat_iframe.width=chat_width.replace('px','');chat_iframe.height=chat_height.replace('px','');chat_iframe.src='https://'+chat_appid+'.cometondemand.net/cometchat_embedded.php'; if(typeof(addEmbedIframe)=="function"){addEmbedIframe(chat_iframe);}
}

var chat_script = document.getElementsByTagName('script')[0]; chat_script.parentNode.insertBefore(chat_js, chat_script);
            
</script>        </ul>

		<footer class="notification-footer">
			<a href="<?php echo $menu_link ?>" class="delete-all">
				<?php _e( 'View Inbox', 'buddyboss-theme' ); ?>
				<i class="bb-icon-angle-right"></i>
			</a>
		</footer>
    </section>
</div>



 

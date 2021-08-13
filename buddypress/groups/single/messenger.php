<?php

$args = array(
	'exclude'             => array( bp_loggedin_user_id() ),
	'exclude_admins_mods' => false,
);

$group_members = groups_get_group_members( $args );

?>

<div id="group-messages-container" class="p-0 border-0">
<div class="spinner-border load-acf text-warning mt-5 mx-auto mb-5" role="status">
                      <span class="visually-hidden">Loading...</span>
                    </div>
<div class="the-acf-form the-acf-form-chat invisible w-100" id="modal-body-content">
    <?php
    $group_id = bp_get_current_group_id();
   ?>
    
 
    <div id="cometchat_embed_chatrooms_container" class="w-100"></div><script  type="text/javascript" charset="utf-8" src="//fast.cometondemand.net/55773x_xd5022x_xcorex_xembedcode.js?v=7.52.5"></script><script>var iframeObj = {};iframeObj.module="chatrooms";iframeObj.style="min-height:100vh;min-width:100%;";iframeObj.src="https://55773.cometondemand.net/cometchat_embedded.php?guid='<?php echo $group_id; ?>'";iframeObj.width="100%";iframeObj.height="100%";if(typeof(addEmbedIframe)=="function"){addEmbedIframe(iframeObj);}</script>
	
</div>
</div>

<a href="javascript:void(0)" onclick="javascript:jqcc.cometchat.audiovideocall({guid:'22''});">Start Audio/Video Call</a>
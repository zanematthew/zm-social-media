<?php

function zm_social_admin_init(){
    global $_zm_setting_fields;
    $_zm_setting_fields[] = 'zm_social_fb_app_id';
}
add_action( 'admin_init', 'zm_social_admin_init' );

function zm_social_head(){
    /**
     * @todo this should be a method, so it could be
     * re-build on the fly if neeed?
     * @todo clean this up, it smells bad
     * @todo add to wp admin settings
     */
    $app_id = get_option('zm_social_fb_app_id');
    print '<script type="text/javascript">var _app_id = "'.$app_id.'";</script>';
}
add_action('wp_head', 'zm_social_head' );

/**
 * Spits out smelly template for the small facebook like button
 * @todo Class 3rd party shit?
 */
function zm_social_facebook_button( $url=null ){

    if ( is_null( $url ) ){
        $url = site_url();
    }

    $html = '<script>(function(d, s, id) {var js, fjs = d.getElementsByTagName(s)[0];if (d.getElementById(id)) {return;}js = d.createElement(s); js.id = id;js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";fjs.parentNode.insertBefore(js, fjs);}(document, "script", "facebook-jssdk"));</script>';
    $html .= '<div class="fb-like" data-href="' . $url . '" data-send="false" data-layout="button_count" data-width="128" data-show-faces="false"></div>';

    print '<div class="zm-social-facebook-button">'.$html.'</div>';
}


/**
 * Spits out smelly template for the small twitter tweet button
 */
function zm_social_twitter_button( $title=null, $url=null ){

    if ( empty( $title ) ){
        $title = get_bloginfo('name') . ' - ' . get_bloginfo('description');
    }

    if ( empty( $url ) ){
        $url = site_url();
    }

    // Are we on a attendee page?
    // $query_var = get_query_var('taxonomy');
    // if ( $query_var == 'attendees' ) {
    //     global $current_user;
    //     get_current_user();

    //     $url = $_SERVER['REQUEST_URI'];
    //     $title = "Checkout {$current_user->user_login}'s BMX Schedule!";
    // }

    $html = '<a href="https://twitter.com/share" class="twitter-share-button" data-url="' . $url . '" data-text="' . $title . '">Tweet</a>';
    $html .= '<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>';

    print '<div class="zm-social-twitter-button">'.$html.'</div>';
}


function zm_social_settings(){?>
    <fieldset>
        <legend>zM Social</legend>
        <div class="row">
            <label>Facebook App ID</label>
            <input name="zm_social_fb_app_id" id="zm_social_fb_app_id" type="text" value="<?php print get_option('zm_social_fb_app_id'); ?>">
        </div>
    </fieldset>
<?php }
add_action( 'zm_social_settings', 'zm_social_settings' );
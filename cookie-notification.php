<?php
/**
 * Plugin Name:       Cookie notification message
 * Plugin URI:        www.groupe361.com
 * Description:       Simple and customizable cookie notification message
 * Version:           1.0.0
 * Author:            German Pichardo
 * Author URI:        www.german-pichardo.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       cookie-textdomain
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'ABSPATH' ) ) {
    die;
}

if( !class_exists( 'CookieNotification' )){
    class CookieNotification {
        /**
         * Plugin initialization
         */
        public function __construct() {
            // ADMIN : Register customize options
            add_action( 'customize_register' , array( $this, 'cookie_notification_customize_register' ) );
            add_action( 'customize_controls_enqueue_scripts' , array( $this, 'rewrite_cookie_in_customizer_live_preview' ) );
        }

        //  =====================================================
        //  = ADMIN:                                            =
        //  =====================================================

        // Rewrite cookie in order to see the notification in preview mode
        public static function rewrite_cookie_in_customizer_live_preview() {
            wp_enqueue_script( 'cookie_rewrite_js', plugins_url( 'js/customizer-rewrite-cookie.js', __FILE__ ), array( 'customize-preview' ), '1.0', true );
        }

        // Customizer register fields
        public static function cookie_notification_customize_register($wp_customize ) {
            $wp_customize->add_section('cookie_notification_section', array(
                'title' => __('Cookie notification', 'cookie-textdomain'),
                'priority' => 35,
            ));

            //  =====================================================
            //  = Color Picker : cookie_notification_background_color_1      =
            //  =====================================================
            $wp_customize->add_setting('cookie_notification_background_color_1', array(
                'default' => '#e8e8e7',
                'sanitize_callback' => 'sanitize_hex_color',
            ));

            $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'cookie_notification_background_color_1', array(
                'label' => __('Background color', 'cookie-textdomain'),
                'section' => 'cookie_notification_section',
                'settings' => 'cookie_notification_background_color_1',
            )));


            //  =====================================================
            //  = Color Picker : cookie_notification_text_color_2      =
            //  =====================================================
            $wp_customize->add_setting('cookie_notification_text_color_2', array(
                'default' => '#ffffff',
                'sanitize_callback' => 'sanitize_hex_color',
            ));

            $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'cookie_notification_text_color_2', array(
                'label' => __('Text color', 'cookie-textdomain'),
                'section' => 'cookie_notification_section',
                'settings' => 'cookie_notification_text_color_2',
            )));

            //  =====================================================
            //  = Text Input: cookie_notification_button_text_3    =
            //  =====================================================
            $wp_customize->add_setting('cookie_notification_button_text_3', array(
                'default' => 'ok',
            ));

            $wp_customize->add_control('cookie_notification_button_text_3', array(
                'label' => __('Accept button text', 'cookie-textdomain'),
                'section' => 'cookie_notification_section',
                'settings' => 'cookie_notification_button_text_3',
                'type' => 'text',

            ));

            //  =====================================================
            //  = Radio:  cookie_notification_banner_position_4    =
            //  =====================================================
            $wp_customize->add_setting('cookie_notification_banner_position_4', array(
                'default' => 'bottom',
            ));

            $wp_customize->add_control('cookie_notification_banner_position_4', array(
                'label' => __('Position', 'cookie-textdomain'),
                'description' => __( 'Default position is bottom', 'cookie-textdomain' ),
                'section' => 'cookie_notification_section',
                'settings' => 'cookie_notification_banner_position_4',
                'type' => 'radio',
                'choices'  => array(
                    'top'  => 'Top',
                    'bottom' => 'Bottom',
                ),
            ));

            //  =====================================================
            //  = TextArea cookie_notification_banner_message_5    =
            //  =====================================================
            $wp_customize->add_setting('cookie_notification_banner_message_5', array(
                'default' => __( 'Les cookies assurent le bon fonctionnement de nos services. En utilisant ces derniers, vous acceptez l&apos;utilisation des cookies.', 'cookie-textdomain' ),
            ));

            $wp_customize->add_control('cookie_notification_banner_message_5', array(
                'label' => __('Notification message', 'cookie-textdomain'),
                'section' => 'cookie_notification_section',
                'settings' => 'cookie_notification_banner_message_5',
                'type' => 'text',

            ));

            //  =====================================================
            //  = Select:  cookie_notification_banner_font_size_6    =
            //  =====================================================
            $wp_customize->add_setting('cookie_notification_banner_font_size_6', array(
                'default' => '11',
            ));

            $wp_customize->add_control('cookie_notification_banner_font_size_6', array(
                'label' => __('Font size', 'cookie-textdomain'),
                'section' => 'cookie_notification_section',
                'settings' => 'cookie_notification_banner_font_size_6',
                'type' => 'select',
                'choices'  => array(
                    '10'  => '10px',
                    '11' => '11px',
                    '12' => '12px',
                    '13' => '13px',
                    '14' => '14px',
                ),
            ));

            //  =====================================================
            //  = Select:  cookie_notification_banner_opacity_7    =
            //  =====================================================
            $wp_customize->add_setting('cookie_notification_banner_opacity_7', array(
                'default' => '80',
            ));

            $wp_customize->add_control('cookie_notification_banner_opacity_7', array(
                'label' => __('Opacity', 'cookie-textdomain'),
                'description' => __( 'Default opacity is 80%', 'cookie-textdomain' ),
                'section' => 'cookie_notification_section',
                'settings' => 'cookie_notification_banner_opacity_7',
                'type' => 'select',
                'choices'  => array(
                    '60'  => '60%',
                    '70' => '70%',
                    '80' => '80%',
                    '90' => '90%',
                    '100' => '100%',
                ),
            ));

            //  =====================================================
            //  = Text Input: cookie_notification_banner_more_info_text_8    =
            //  =====================================================
            $wp_customize->add_setting('cookie_notification_banner_more_info_text_8', array(
                'default' => 'en savoir plus',
            ));

            $wp_customize->add_control('cookie_notification_banner_more_info_text_8', array(
                'label' => __('More Info Text', 'cookie-textdomain'),
                'description' => __( 'In order to show the more info link, a valid url must be added', 'cookie-textdomain' ),
                'section' => 'cookie_notification_section',
                'settings' => 'cookie_notification_banner_more_info_text_8',
                'type' => 'text',
            ));

            //  =====================================================
            //  = Text Input: cookie_notification_banner_more_info_url_9    =
            //  =====================================================
            $wp_customize->add_setting('cookie_notification_banner_more_info_url_9', array(
                'default' => '',
            ));

            $wp_customize->add_control('cookie_notification_banner_more_info_url_9', array(
                'label' => __('More Info Url', 'cookie-textdomain'),
                'description' => __( 'In order to show the more info link, a valid url must be added', 'cookie-textdomain' ),
                'section' => 'cookie_notification_section',
                'settings' => 'cookie_notification_banner_more_info_url_9',
                'type' => 'text',
            ));

            //  =====================================================
            //  = Checkbox:  cookie_notification_banner_more_info_url_target_blank_10    =
            //  =====================================================

            $wp_customize->add_setting('cookie_notification_banner_more_info_url_target_blank_10', array(
                'default' => 'true',
            ));

            $wp_customize->add_control('cookie_notification_banner_more_info_url_target_blank_10', array(
                'label' => __('Open url in new window', 'cookie-textdomain'),
                'section' => 'cookie_notification_section',
                'settings' => 'cookie_notification_banner_more_info_url_target_blank_10',
                'type' => 'checkbox',
                'choices'  => array(
                    'true'  => 'Open url in new window',
                ),
            ));

            //  =====================================================
            //  = Text Input cookie_notification_additional_css_11    =
            //  =====================================================
            $wp_customize->add_setting('cookie_notification_additional_css_11', array(
                'default' => '/*You can add your own CSS here.*/',
            ));

            $wp_customize->add_control('cookie_notification_additional_css_11', array(
                'label' => __('Additional CSS', 'cookie-textdomain'),
                'description' => __( 'You can add custom css to the main wrapper', 'cookie-textdomain' ),
                'section' => 'cookie_notification_section',
                'settings' => 'cookie_notification_additional_css_11',
                'type' => 'textarea',
                'input_attrs' => array(
                    'class' => 'code',
                )

            ));
            //  =====================================================
            //  = Checkbox:  cookie_notification_activate_cookie_message_0    =
            //  =====================================================

            $wp_customize->add_setting('cookie_notification_activate_cookie_message_0');

            $wp_customize->add_control('cookie_notification_activate_cookie_message_0', array(
                'label' => __('Disable notification temporary', 'cookie-textdomain'),
                'section' => 'cookie_notification_section',
                'settings' => 'cookie_notification_activate_cookie_message_0',
                'type' => 'checkbox',
            ));

        }

        //  =====================================================
        //  = FRONT :                                           =
        //  =====================================================


    }
} // !class_exists

$cookie_notification = new CookieNotification();

function cookie_inline_css() { ?>
    <style id="cookie_inline_css" type="text/css">
        #cookie-notification-wrapper {
            width:100%;
            font-family:Arial,Helvetica,sans serif;
            text-align: center;
            padding: 5px;
            z-index: 100000;
            position:fixed;
            left: 0;
        }
        #cookie-notification-wrapper .cookie-notification-inner {
            display:inline-block;
        }
        #cookie-notification-wrapper button[type="button"] {
            background:none;
            height: 26px;
            line-height:25px;
            outline: 0;
            font-size:10px;
            -webkit-border-radius: 8px;
            -moz-border-radius: 8px;
            border-radius: 8px;
            padding: 0 8px;
            cursor: pointer;
            position: relative;
            vertical-align: middle;
            display: inline-block;
        }
        /*Start Additional CSS*/
        <?php if(!empty(get_theme_mod( 'cookie_notification_additional_css_11'))) {
            print get_theme_mod( 'cookie_notification_additional_css_11','' );
        } ?>
        /*End Additional CSS*/
    </style>
    <?php
}

/******************************************************************************
 * FRONT-END
 * If disable notification option is checked
 * && "cookie-notification-enabled" is already injected
 * && we are not in admin area
 *************************************************************************/
// Verify cookie value
function is_cookie_notification_enabled(){
    return (!isset($_COOKIE['cookie-notification-enabled'])) || ( (isset($_COOKIE['cookie-notification-enabled'])) && ($_COOKIE['cookie-notification-enabled'] !== '1') );
}


function print_inline_scripts() {
    if ( is_customize_preview() ||  (is_cookie_notification_enabled() && !is_admin()) ) {
        // Inline CSS in head
        add_action( 'wp_print_styles', 'cookie_inline_css' );
        // Inline JS in footer with priority
        add_action( 'wp_footer', 'cookie_inline_scripts',999 ); // 999 is our priority
    }
}
add_action('cookie_load_scripts','print_inline_scripts');
do_action('cookie_load_scripts');

/**
 * Inline JavaScript to build cookie banner
 */
function cookie_inline_scripts() {
    // Variables with PHP fallback
    // Output array
    $banner_options = array (
        'background'    =>	get_theme_mod('cookie_notification_background_color_1','#808080') ,
        'text_color'    =>	get_theme_mod('cookie_notification_text_color_2', '#ffffff'),
        'button_text'   =>	get_theme_mod('cookie_notification_button_text_3','ok'),
        'position'      =>	get_theme_mod('cookie_notification_banner_position_4','bottom'),
        'message'       =>	get_theme_mod('cookie_notification_banner_message_5', __('Les cookies assurent le bon fonctionnement de nos services. En utilisant ces derniers, vous acceptez l&apos;utilisation des cookies','cookie-textdomain')),
        'font_size'     =>	get_theme_mod('cookie_notification_banner_font_size_6','11'),
        'opacity'       =>	get_theme_mod('cookie_notification_banner_opacity_7','80'),
        'link_text'     =>	get_theme_mod('cookie_notification_banner_more_info_text_8',__( 'en savoir plus', 'cookie-textdomain' )),
        'link_url'      =>	esc_url_raw(get_theme_mod('cookie_notification_banner_more_info_url_9','')),
        'link_target_blank'   =>	get_theme_mod('cookie_notification_banner_more_info_url_target_blank_10',false) ,
        'custom_css'    =>	get_theme_mod('cookie_notification_additional_css_11',''),
    );

    { ?>
        <!--START cookie_inline_scripts-->
        <script id="cookie_inline_scripts" type="text/javascript" >
            /**************************************************
             * Start - Cookie Message
             ***************************************************/
                // Notification options
            var option = <?php print json_encode($banner_options, 128); // 128 to convert to a pretty Json string ?>;

            // We execute and pass the banner options
            if (window.attachEvent)
                window.attachEvent('onload', createCookieBanner( option));
            else
            if (window.addEventListener)
                window.addEventListener('load', createCookieBanner( option),false);

            function isIPaddress(ip){
                if (/^(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)$/.test(ip)) return true;
                return false;
            }

            function getDomain(){
                var domain;

                if(isIPaddress(window.location.hostname) || window.location.hostname === 'localhost')
                    domain = "";
                else{
                    domain = window.location.hostname.split(".");
                    domain = "." + domain[domain.length-2] + "." + domain[domain.length-1];
                }
                return domain;
            }

            function writeCookie(key, value, domain, path){
                var dateExpire = new Date();
                dateExpire.setMonth(dateExpire.getMonth() + 13);
                document.cookie= key + "=" + value + "; expires=" + dateExpire.toUTCString() + "; domain=" + domain + ";" + "path=" + path + ";";
            }

            function readCookie(key){
                var value = new Array();

                var allcookies = document.cookie;
                // Get all the cookies pairs in an array
                cookiearray  = allcookies.split(';');

                // Now take key value pair out of this array
                for(var i=0; i<cookiearray.length; i++){
                    if (i > 0)
                        cookiearray[i] = cookiearray[i].substring(1);

                    value[cookiearray[i].split('=')[0]] = cookiearray[i].split('=')[1];
                }
                return value[key];
            }

            function createDom(htmlStr) {
                var fragment = document.createDocumentFragment(),
                    temp = document.createElement('div');
                temp.innerHTML = htmlStr;
                while (temp.firstChild) {
                    fragment.appendChild(temp.firstChild);
                }
                return fragment;
            }

            // Convert Hex to rgba with opacity capability
            function convertHex(hex,opacity){
                hex = hex.replace('#','');
                r = parseInt(hex.substring(0,2), 16);
                g = parseInt(hex.substring(2,4), 16);
                b = parseInt(hex.substring(4,6), 16);

                resultRgba = 'rgba('+r+','+g+','+b+','+opacity/100+')';
                return resultRgba;
            }

            function createCookieBanner(option) {
                if(readCookie('cookie-notification-enabled')!=='1'){
                    // Banner string options : background, text_color, button_text, message, font_size, opacity
                    console.log(JSON.stringify(option));

                    // If link_url exists we build the button
                    var link_button = ""; // Link empty
                    var link_target_blank = ""; // Link target empty

                    if(option.link_url) {
                        // Open in new window attribute
                        console.log(option.link_target_blank);
                        if(option.link_target_blank !== false) {
                            link_target_blank = " target='_blank' ";
                        }
                        // Build the href
                        link_button = "<a "+link_target_blank+" href='" + option.link_url + "' style='color: "+option.text_color+";text-decoration: underline;' title='" + option.link_text + "' >" + option.link_text + "</a> ";
                    }

                    // Position conditional style
                    var banner_position = "top:auto;bottom:0;"; // Default position

                    if(option.position === 'top') {
                        banner_position = "bottom:auto;top:0;";
                    }

                    // create banner
                    var bannerWrapper = createDom("<div id='cookie-notification-wrapper' style='background: "+option.background+"; background-color: "+convertHex(option.background,option.opacity)+"; color: "+option.text_color+"; font-size: "+option.font_size+"px;"+banner_position+"'><div class='cookie-notification-inner container'>"+option.message+" "+link_button+"  <button type='button' style='color:"+option.text_color+";border:1px solid "+option.text_color+";font-size: "+option.font_size+"px;' id='cookie-notification-button' title='Fermer'>"+option.button_text+"</button></div></div>");

                    body=document.body;
                    body.insertBefore(bannerWrapper,body.childNodes[0]);

                    setTimeout(function () {document.getElementById("cookie-notification-wrapper");}, 300);
                    document.getElementById('cookie-notification-button').onclick = function(){
                        var p = document.getElementById("cookie-notification-wrapper");
                        body.removeChild(p);
                        writeCookie("cookie-notification-enabled", "1", getDomain(), "/");
                    }
                }
            }
            /**************************************************
             * End - Cookie Message
             ***************************************************/
        </script>
        <!--END cookie_inline_scripts-->
    <?php }

}
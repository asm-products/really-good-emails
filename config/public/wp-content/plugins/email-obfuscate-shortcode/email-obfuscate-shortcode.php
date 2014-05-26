<?php
/*
Plugin Name: Email Obfuscate Shortcode
Plugin URI: http://wordpress.org/extend/plugins/email-obfuscate-shortcode
Description: No more spam! Example usage: [email-obfuscate email="bob@company.com"] -- See plugin site for more examples.
Version: 2.0
Author: khromov
Author URI: http://khromov.wordpress.com
License: GPL2
*/

/**
 * Debug flag
 **/
define('EOS_DEBUG', false);

/**
 * Register activation hook
 **/
register_activation_hook( __FILE__, array( 'EOS', 'activate' ) );

/**
 * Translation support
 **/
load_plugin_textdomain('email-obfuscate-shortcode', false, basename( dirname( __FILE__ ) ) . '/languages' );

/**
 * Register the shortcode
 **/
add_shortcode('email-obfuscate', array('EOS', 'obfuscate_shortcode'));

/**
 * Function for calling EOS from other plugins.
 * 
 * This is function is callable in any of your plugins.
 * 
 * Example of array to pass to args:
 * 
 * Simple:
 * array
 *  (
 *      'email' => 'bob@company.com'
 *  )
 * 
 * All args:
 * array
 *  (
 *      'email' => 'bob@company.com',
 *      'linkable' => 1,
 *      'link_title' => 'Click here to email Bob!',
 *      'use_htmlentities' => 1,
 *      'use_noscript_fallback' => 1,
 *      'noscript_message' => 'Please enable JavaScript to see this field'
 *   )
 * 
 **/
function eos_obfuscate($args)
{
    return EOS::obfuscate_shortcode($args);
}

/**
 * Main class
 **/
class EOS
{
    /**
     * Plugin activation function
     **/
    static function activate()
    {
        //Check for required functions
        if(!function_exists('mb_convert_encoding') || !function_exists('mb_detect_encoding'))
            die(__('You need to install the PHP Multibyte String (mbstring) extension to use this plugin.'));
    }
    
    /**
     * Obfuscation routine
     **/
    static function obfuscate_shortcode($args)
    {
        //Get values from shortcode and put them in local variables
        extract
        (
            shortcode_atts
            (
                array
                (
        	       'email' => false,
                   'linkable' => true, //0 if you want to store phones, names or other hidden information instead of emails
                   'link_title' => "",
                   'use_htmlentities' => true,
                   'use_noscript_fallback' => true,
                   'noscript_message' => __("Please enable JavaScript to see this field.", "email-obfuscate-shortcode"),
				   'tag_title' => ''
                ),
                $args
            )
        );
        
        if(!$email)
            return __("You have not entered an email address for this shortcode.", "email-obfuscate-shortcode");
        else
        {        
            //Init return variable
            $ret = $email;
            
            //Encode as htmlentities
            if($use_htmlentities)
                $ret = EOS::html_entities_all($ret);
            
            //Wrap in mailto: link
            if($linkable)
			   $ret = '<a href="mailto:'.$ret.'"'. ($tag_title != '' ? (' title="'. $tag_title .'"') : '') .'>'. ($link_title=='' ? $email : $link_title) .'</a>';
            
            //Convert to JS snippet
            $ret = EOS::safe_text($ret);
                
            //Add noscript fallback
            if($use_noscript_fallback)
                $ret .= "<noscript>{$noscript_message}</noscript>"; 
            
            if(EOS_DEBUG)
            {
                $ret .= "
                            <div class=\"eos_debug\">
                                --- EOS debug info: --- <br />
                                Raw email string: {$email} <br/>
                                Linkable: {$linkable} <br/>
                                Link title: {$link_title} <br/>
                                noscript fallback: {$use_noscript_fallback}<br/>
                                noscript message: {$noscript_message}<br/>
                                tag title: {$tag_title}<br/>
                                --- End of EOS debug info ---
                            </div>
                        ";      
            }
            return $ret;
        }
    }
    
    /**
     * Encodes every character in $text into its numeric html representation.
     * http://stackoverflow.com/questions/3005116/how-to-convert-all-characters-to-their-html-entity-equivalent-using-php/3005240
     */
    static function html_entities_all($text)
    {
        $text = mb_convert_encoding($text , 'UTF-32', 'UTF-8');
        $t = unpack("N*", $text);
        $t = array_map(array('EOS', 'html_entities_closure_wrap'), $t);
        
        return implode("", $t);
    }
    
    //For PHP <5.3 support.
    static function html_entities_closure_wrap($n)
    {
    	return "&#$n;";
    }
    
    /**
     * safe_text() obfuscator function
     * http://khromov.wordpress.com/2011/10/04/php-function-for-scrambling-e-mail-addressesphone-numbers-using-javascript/
     **/
    static function safe_text($text)
    {
        //Check if text is UTF-8 and decode if it is
        if(mb_detect_encoding($text, 'UTF-8', true))
                $text = utf8_decode($text);
        
        //Create the obfuscation array
        $chars = str_split($text);
    
        $enc[] = rand(0,255);
    
        foreach($chars as $char)
            $enc[] = ord($char)-$enc[sizeof($enc)-1];
        
        $finished_array = join(',',$enc);

		//Make a random div
		$div = md5(rand().microtime());

		$ret  = '<span id="'. $div .'"></span>';
        $ret .= "<script type=\"text/javascript\">
                    var t=[{$finished_array}];
                    var toAppend = '';
                    for (var i=1; i<t.length; i++)
                    {
                    	toAppend+=String.fromCharCode(t[i]+t[i-1]);
                    }
                    document.getElementById('". $div ."').innerHTML = toAppend;
                </script>";
                
        return $ret;   
    }
}
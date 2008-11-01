<?php
/*
 * SocioFluid - social bookmarking plugin for wordpress
 * http://www.improveseo.info/category/sociofluid/
 *
 * Version: 1.1
 * Date: 28/10/2008
 *
 *  Copyright (c) 2008 Adrian Ianculescu
 *  Dual licensed under the MIT-LICENSE.txt and GPL-LICENSE.txt
 *
 *   http://www.opensource.org/licenses/mit-license.php
 *   http://www.gnu.org/licenses/gpl.html
 */
 
/*
Plugin Name: SocioFluid
Plugin URI: http://www.improveseo.info/category/sociofluid/
Description:  SocioFluid is a social bookmarking plugin for wordpress. For details you can check the <a href="http://www.improveseo.info/SocioFluid">SocioFluid Homepage</a>.
Version: 1.1
Author: Adrian Ianculescu
*/


add_filter('the_content', 'sociofluid_the_content');
add_action('wp_head', 'sociofluid_wp_head');


function returnImage($pathtemp, $item, $smallsize, $largesize)
{
	return '<img alt="'.$pathtemp.'/'.$item.'_'.$largesize.'.png" style="padding-bottom: '.($largesize-$smallsize).'px; margin:0px;" src="'.$pathtemp.'/'.$item.'_'.$smallsize.'.png" /></a>';
}


function get_smallsize($options){
		
		$small = 32;
		if ($options['small'] == 16) $small = 16;
		if ($options['small'] == 24) $small = 24;
		if ($options['small'] == 32) $small = 32;
		if ($options['small'] == 48) $small = 48;
		
		return $small;
}

function get_largesize($options){
		
		$large = 32;
		if ($options['large'] == 16) $large = 16;
		if ($options['large'] == 24) $large = 24;
		if ($options['large'] == 32) $large = 32;
		if ($options['large'] == 48) $large = 48;
		
		return $large;
}

function get_valign($options){
		
		$valign = 'bottom';
		if ($options['valignn'] == 0) $valign = 'bottom';
		if ($options['valignn'] == 1) $valign = 'middle';
		if ($options['valignn'] == 2) $valign = 'top';
		
		return $valign;
}

function check_if_none($checks, $options)
{
	$isone = false;
	foreach($checks as $check)
	{
		if (!((!$mypluginall[$check]) || ($mypluginall[$check] == 0)))
			$isone = true;
	}
	
	if ($isone == false)
	{
		foreach($checks as $check)
		{
			$mypluginall[$check] = 1;
		}
	}
}

function externalGetSociofluidButtonsForCurrentUrl()
{
	global $mypluginall;
	global $item;
	$mypluginall = get_option('myplugin');
	sociofluid_update_options($mypluginall);
	$checks = array('check_digg', 'check_reddit', 'check_dzone', 'check_stumbleupon', 'check_delicious', 'check_blinklist', 'check_blogmarks', 'check_furl', 'check_newsvine', 'check_technorati','check_magnolia');
	$item = $item + 1;
	
	check_if_none($checks, $options);
	
	$pathtemp = get_bloginfo('wpurl').'/wp-content/plugins/sociofluid/images';
	$thisURL = $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
	$thisTitle = "";
	
	$newwindow = false;
	if (!((!$mypluginall['open_in_new_window']) || ($mypluginall['open_in_new_window'] == 0)))
		$newwindow = true;
		
	$customcss = $mypluginall['cssstyle'];
	
	$menu = get_the_buttons($mypluginall, $pathtemp, $thisURL, $thisTitle, $item, $newwindow, $customcss); 

	return $menu;
}

function externalGetSociofluidButtonsInLoop()
{
	global $mypluginall;
	global $item;
	$mypluginall = get_option('myplugin');
	sociofluid_update_options($mypluginall);
	$checks = array('check_digg', 'check_reddit', 'check_dzone', 'check_stumbleupon', 'check_delicious', 'check_blinklist', 'check_blogmarks', 'check_furl', 'check_newsvine', 'check_technorati','check_magnolia');
	$item = $item + 1;
	
	check_if_none($checks, $options);
	
	$pathtemp = get_bloginfo('wpurl').'/wp-content/plugins/sociofluid/images';
	$thisURL = urlencode(get_permalink($post->ID));
	$thisTitle = urlencode(get_the_title($post->ID));
	
	$newwindow = false;
	if (!((!$mypluginall['open_in_new_window']) || ($mypluginall['open_in_new_window'] == 0)))
		$newwindow = true;
		
	$customcss = $mypluginall['cssstyle'];
	
	$menu = get_the_buttons($mypluginall, $pathtemp, $thisURL, $thisTitle, $item, $newwindow, $customcss); 

	return $menu;
}

function sociofluid_the_content($content)
{
	global $mypluginall;
	global $item;
	$mypluginall = get_option('myplugin');
	sociofluid_update_options($mypluginall);
	$checks = array('check_digg', 'check_reddit', 'check_dzone', 'check_stumbleupon', 'check_delicious', 'check_blinklist', 'check_blogmarks', 'check_furl', 'check_newsvine', 'check_technorati','check_magnolia');
	$item = $item + 1;
	
	check_if_none($checks, $options);
	
	$newwindow = false;
	if (!((!$mypluginall['open_in_new_window']) || ($mypluginall['open_in_new_window'] == 0)))
		$newwindow = true;
		
	$customcss = $mypluginall['cssstyle'];

	if ((!$mypluginall['show_customized']) || ($mypluginall['show_customized'] == 0))
	{
		if ( !is_page() && !is_feed() && (is_single() || (!((!$mypluginall['show_on_homepage']) || ($mypluginall['show_on_homepage'] == 0)))))
		{
			if ((!$mypluginall['show_on_top']) || ($mypluginall['show_on_top'] == 0))
			{
				$pathtemp = get_bloginfo('wpurl').'/wp-content/plugins/sociofluid/images';
				$thisURL = urlencode(get_permalink($post->ID));
				$thisTitle = urlencode(get_the_title($post->ID));
				$menu = get_the_buttons($mypluginall, $pathtemp, $thisURL, $thisTitle, $item, $newwindow, $customcss); 
				$content .= $menu;
			}
			else
			{
				$pathtemp = get_bloginfo('wpurl').'/wp-content/plugins/sociofluid/images';
				$thisURL = urlencode(get_permalink($post->ID));
				$thisTitle = urlencode(get_the_title($post->ID));
				$menu = get_the_buttons($mypluginall, $pathtemp, $thisURL, $thisTitle, $item, $newwindow, $customcss); 
				$content = $menu.$content;	
			}
		}
	}
		
	return $content;			
}

function get_the_checks()
{
$checks = array(
	"check_digg" => array(
				0 => 'digg',
				1 => 'http://digg.com/submit?phase=2&url=%s&title=%s',
				2 => 'Digg'
				),
	"check_reddit" => array(
				0 => 'reddit',
				1 => 'http://reddit.com/submit?url=%s&amp;title=%s',
				2 => 'Reddit'
				),
	"check_dzone" => array(
				0 => 'dzone',
				1 => 'http://dzone.com/links/add.html?url=%s&amp;title=%s',
				2 => 'DZone'
				),
	"check_stumbleupon" => array(
				0 => 'stumbleupon',
				1 => 'http://www.stumbleupon.com/submit?url=%s&amp;title=%s',
				2 => 'StumbleUpon'
				),
	"check_delicious" => array(
				0 => 'delicious',
				1=> 'http://del.icio.us/post?url=%s&amp;title=%s',
				2 => 'del.icio.us'
				),
	"check_blinklist" => array(
				0 => 'blinklist',
				1 => 'http://blinklist.com/index.php?Action=Blink/addblink.php&amp;Description=&amp;Url=%s&amp;title=%s',
				2 => 'BlinkList'
				),
	"check_blogmarks" => array(
				0 => 'blogmarks',
				1 => 'http://blogmarks.net/my/new.php?mini=1&amp;simple=1&url=%s&title=%s',
				2 => 'BlogMarks'
				),
	"check_furl" => array(
				0 => 'furl',
				1 => 'http://www.furl.net/storeIt.jsp?&amp;u=%s&amp;t=%s',
				2 => 'Furl'
				),
	"check_newsvine" => array(
				0 => 'newsvine',
				1 => 'http://newsvine.com/_tools/seed&amp;save?u=%s&amp;h=%s',
				2 => 'NewsVine'
				),
	"check_technorati" => array(
				0 => 'technorati',
				1 => 'http://technorati.com/faves?add=%s',
				2 => 'Technorati'
				),	
	"check_magnolia" => array(
				0 => 'magnolia',
				1 => 'http://ma.gnolia.com/beta/bookmarklet/add?url=%s&amp;title=%s',
				2 => 'Magnolia'
				),
	"check_google" => array(
				0 => 'google',
				1 => 'http://www.google.com/bookmarks/mark?op=add&amp;bkmk=%s&amp;title=%s',
				2 => 'Google'
				),
	"check_myspace" => array(
				0 => 'myspace',
				1 => 'http://www.myspace.com/Modules/PostTo/Pages/?u=%s&amp;t=%s',
				2 => 'Myspace'
				),				
	"check_facebook" => array(
				0 => 'facebook',
				1 => 'http://www.facebook.com/sharer.php?u=%s?p=%s',
				2 => 'Facebook'
				),	
	"check_yahoobuzz" => array(
				0 => 'yahoobuzz',
				1 => 'http://buzz.yahoo.com/submit?submitUrl=%s&amp;submitHeadline=%s',
				2 => 'Yahoo Buzz'
				),	
	"check_sphinn" => array(
				0 => 'sphinn',
				1 => 'http://sphinn.com/submit.php?url=%s&amp;title=%s',
				2 => 'Sphinn'
				),					
	"check_mixx" => array(
				0 => 'mixx',
				1 => 'http://www.mixx.com/submit?page_url=%s&amp;title=%s',
				2 => 'Mixx'
				),				
	"check_twitthis" => array(
				0 => 'twitter',
				1 => 'http://twitthis.com/twit?url=%s&amp;title=%s',
				2 => 'TwitThis'
				),
	"check_jamespot" => array(
				0 => 'jamespot',
				1 => 'http://www.jamespot.com/?action=spotit&amp;url=%s&amp;title=%s',
				2 => 'Jamespot'
				),
	"check_meneame" => array(
				0 => 'meneame',
				1 => 'http://meneame.net/submit.php?url=%s&amp;title=%s',
				2 => 'Meneame'
				)
	);

	return $checks;
}

function get_the_buttons($mypluginall, $pathtemp, $thisURL, $thisTitle, $id, $newwindow, $customcss )
{
	$checks = get_the_checks();

	$small = get_smallsize($mypluginall); $large = get_largesize($mypluginall);
	$toadd = "\n\n" . '<!-- SocioFluid 1.1 - Social Bookmarking Plugin -->' . "\n";	
	$toadd .= '<div style="'.$customcss.'">';
	$toadd .= '<div class="docking" style="border: 0pt none ; margin: 0pt; padding: 0pt; height: '.($large+10).'px;">';		
	$toadd .= '<div id="sociobar'.$id.'" align="center">';
	
	foreach($checks as $key => $value)
	{
		if (!((!$mypluginall[$key]) || ($mypluginall[$key] == 0)))
		{
			$url = sprintf($value[1], $thisURL, $thisTitle);
			$toadd .= '<a style="border: 0pt none ; margin: 0pt;" href="'.$url.'" title="'.$value[2].'"';
			if ($newwindow)
				$toadd .= ' target="_blank"';
			$toadd .= 'rel="nofollow">';
			$toadd .= returnImage($pathtemp, $value[0], $small, $large);
			$toadd .= "\r\n";
		}
	}

	$small = get_smallsize($mypluginall);
	$valign = get_valign($mypluginall);
	$toadd .= "<script type='text/javascript'> <!--\njQuery(function() {	jQuery('#sociobar".$id."').jqDock({labels: 'br', align:'$valign', size:$small, duration:300}) })\n--></script>";
	
	$toadd .= '</div></div></div>';	
	return $toadd;
}

function sociofluid_wp_head() 
{
	global $mypluginall;
	$mypluginall = get_option('myplugin');
	$small = get_smallsize($mypluginall);
	$valign = get_valign($mypluginall);
	
	echo '<!-- Required by SocioFluid 1.1 plugin (jquery + jqdock): -->';
	echo '<script type="text/javascript" src="'.get_bloginfo('wpurl').'/wp-content/plugins/sociofluid/js/jquery-1.2.6.min.js"></script>';
	echo '<script type="text/javascript" src="'.get_bloginfo('wpurl').'/wp-content/plugins/sociofluid/js/jquery.jqDock.min.js"></script>';	
}


function myplugin_admin_menu() 
{
	add_submenu_page('options-general.php', 'SocioFluid', 'SocioFluid', 8, __FILE__, 'sociofluid_show_admin_panel');
}

add_action('admin_menu', 'myplugin_admin_menu');

function sociofluid_show_admin_panel()
{ 
    include 'sociofluid-admin.php';
}

function sociofluid_update_options($options){
	global $mypluginall;
	
	$checks = get_the_checks();
	foreach($checks as $key => $value)
	{
		if(!$options[$key]){$options[$key] = 0; }
	}
	
	if(!$options['show_on_homepage']){$options['show_on_homepage'] = 0; }	
	if(!$options['show_on_top']){$options['show_on_top'] = 0; }		
	if(!$options['open_in_new_window']){$options['open_in_new_window'] = 0; }	
	if(!$options['show_customized']){$options['show_customized'] = 0; }	

	while (list($option, $value) = each($options)) 
	{	
		if( get_magic_quotes_gpc() ) 
		{ 
			$value = stripslashes($value);
		}
		$mypluginall[$option] =$value;
	}
	
	return $mypluginall;
}
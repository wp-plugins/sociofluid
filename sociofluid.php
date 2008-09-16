<?php
/*
 * SocioFluid - social bookmarking plugin for wordpress
 * http://www.improveseo.info/SocioFluid
 *
 * Version: 1.0
 * Date: 13/07/2008
 *
 *  Copyright (c) 2008 Adrian Ianculescu
 *  Dual licensed under the MIT-LICENSE.txt and GPL-LICENSE.txt
 *
 *   http://www.opensource.org/licenses/mit-license.php
 *   http://www.gnu.org/licenses/gpl.html
 */
 
/*
Plugin Name: SocioFluid
Plugin URI: http://www.improveseo.info/SocioFluid
Description:  SocioFluid is a social bookmarking plugin for wordpress. For details you can check the <a href="http://www.improveseo.info/SocioFluid">SocioFluid Homepage</a>.
Version: 1.0
Author: Adrian Ianculescu
*/


add_filter('the_content', 'sociofluid_the_content');
add_action('wp_head', 'sociofluid_wp_head');


function returnImage($pathtemp, $item, $smallsize, $largesize)
{
	return '<img alt="'.$pathtemp.'/'.$item.'_'.$largesize.'.png" style="padding-bottom: '.($largesize-$smallsize).'px; margin:0px;" src="'.$pathtemp.'/'.$item.'_'.$smallsize.'.png"></a>';
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


function sociofluid_the_content($content)
{
	global $mypluginall;
	global $item;
	$mypluginall = get_option('myplugin');
	sociofluid_update_options($mypluginall);
	$checks = array('check_digg', 'check_reddit', 'check_dzone', 'check_stumbleupon', 'check_delicious', 'check_blinklist', 'check_blogmarks', 'check_furl', 'check_newsvine', 'check_technorati','check_magnolia');
	$item = $item + 1;
	
	check_if_none($checks, $options);

	if ( !is_page() && !is_feed() && (is_single() || (!((!$mypluginall['show_on_homepage']) || ($mypluginall['show_on_homepage'] == 0)))))
	{
		if ((!$mypluginall['show_on_top']) || ($mypluginall['show_on_top'] == 0))
		{
			$pathtemp = get_bloginfo('wpurl').'/wp-content/plugins/sociofluid/images';
			$thisURL = urlencode(get_permalink($post->ID));
			$thisTitle = urlencode(get_the_title($post->ID));
			$menu = get_the_buttons($mypluginall, $pathtemp, $thisURL, $thisTitle, $item); 
			$content .= $menu;
		}
		else
		{
			$pathtemp = get_bloginfo('wpurl').'/wp-content/plugins/sociofluid/images';
			$thisURL = urlencode(get_permalink($post->ID));
			$thisTitle = urlencode(get_the_title($post->ID));
			$menu = get_the_buttons($mypluginall, $pathtemp, $thisURL, $thisTitle, $item); 
			$content = $menu.$content;	
		}
	}
	
	return $content;			
}

function get_the_buttons($mypluginall, $pathtemp, $thisURL, $thisTitle, $id )
{
	$small = get_smallsize($mypluginall); $large = get_largesize($mypluginall);
	$toadd = "\n\n" . '<!-- SocioFluid 1.0 - Social Bookmarking Plugin -->' . "\n";	
	$toadd .= '<div class="docking" style="border: 0pt none ; margin: 0pt; padding: 0pt; height: '.($large+10).'px;">';		
	$toadd .= '<div id="sociobar'.$id.'" align="center">';	
	
	if (!((!$mypluginall['check_digg']) || ($mypluginall['check_digg'] == 0)))
	{
		$toadd .= '<a style="border: 0pt none ; margin: 0pt;" href="http://digg.com/submit?phase=2&url=';
		$toadd .= $thisURL;
		$toadd .= '&title=';
		$toadd .= $thisTitle;
		$toadd .= '" title="Digg">';
		$toadd .= returnImage($pathtemp, 'digg', $small, $large);
	}
	
	if (!((!$mypluginall['check_reddit']) || ($mypluginall['check_reddit'] == 0)))
	{
		$toadd .= '<a style="border: 0pt none ; margin: 0pt;" href="http://reddit.com/submit?url=';
		$toadd .= $thisURL;
		$toadd .= '&title=';
		$toadd .= $thisTitle;
		$toadd .= '" title="Reddit">';
		$toadd .= returnImage($pathtemp, 'reddit', $small, $large);
	}
	
	if (!((!$mypluginall['check_dzone']) || ($mypluginall['check_dzone'] == 0)))
	{
		$toadd .= '<a style="border: 0pt none ; margin: 0pt;" href="http://dzone.com/links/add.html?url=';
		$toadd .= $thisURL;
		$toadd .= '&title=';
		$toadd .= $thisTitle;
		$toadd .= '" title="DZone">';
		$toadd .= returnImage($pathtemp, 'dzone', $small, $large);
	}		
	
	if (!((!$mypluginall['check_stumbleupon']) || ($mypluginall['check_stumbleupon'] == 0)))
	{
		$toadd .= '<a style="border: 0pt none ; margin: 0pt;" href="http://www.stumbleupon.com/submit?url=';
		$toadd .= $thisURL;
		$toadd .= '&title=';
		$toadd .= $thisTitle;
		$toadd .= '" title="StumbleUpon">';
		$toadd .= returnImage($pathtemp, 'stumbleupon', $small, $large);
	}

	if (!((!$mypluginall['check_delicious']) || ($mypluginall['check_delicious'] == 0)))
	{
		$toadd .= '<a style="border: 0pt none ; margin: 0pt;" href="http://del.icio.us/post?url=';
		$toadd .= $thisURL;
		$toadd .= '&title=';
		$toadd .= $thisTitle;
		$toadd .= '" title="del.icio.us">';
		$toadd .= returnImage($pathtemp, 'delicious', $small, $large);
	}

	if (!((!$mypluginall['check_blinklist']) || ($mypluginall['check_blinklist'] == 0)))
	{
		$toadd .= '<a style="border: 0pt none ; margin: 0pt;" href="http://blinklist.com/index.php?Action=Blink/addblink.php&Description=&Url=';
		$toadd .= $thisURL;
		$toadd .= '&title=';
		$toadd .= $thisTitle;
		$toadd .= '" title="BlinkList">';
		$toadd .= returnImage($pathtemp, 'blinklist', $small, $large);
	}
			
	if (!((!$mypluginall['check_blogmarks']) || ($mypluginall['check_blogmarks'] == 0)))
	{
		$toadd .= '<a style="border: 0pt none ; margin: 0pt;" href="http://blogmarks.net/my/marks,new?mini=1&amp;url=';
		$toadd .= $thisURL;
		$toadd .= '&title=';
		$toadd .= $thisTitle;
		$toadd .= '" title="BlogMarks">';
		$toadd .= returnImage($pathtemp, 'blogmarks', $small, $large);
	}
	
	if (!((!$mypluginall['check_furl']) || ($mypluginall['check_furl'] == 0)))
	{
		$toadd .= '<a style="border: 0pt none ; margin: 0pt;" href="http://www.furl.net/storeIt.jsp?&u=';
		$toadd .= $thisURL;
		$toadd .= '&t=';
		$toadd .= $thisTitle;
		$toadd .= '" title="Furl">';
		$toadd .= returnImage($pathtemp, 'furl', $small, $large);
	}

	if (!((!$mypluginall['check_newsvine']) || ($mypluginall['check_newsvine'] == 0)))
	{
		$toadd .= '<a style="border: 0pt none ; margin: 0pt;" href="http://newsvine.com/_tools/seed&amp;save?u=';
		$toadd .= $thisURL;
		$toadd .= '&h=';
		$toadd .= $thisTitle;
		$toadd .= '" title="NewsVine">';
		$toadd .= returnImage($pathtemp, 'newsvine', $small, $large);
	}

	if (!((!$mypluginall['check_technorati']) || ($mypluginall['check_technorati'] == 0)))
	{
		$toadd .= '<a style="border: 0pt none ; margin: 0pt;" href="http://technorati.com/faves?add=';
		$toadd .= $thisURL;
		$toadd .= '" title="Technorati">';
		$toadd .= returnImage($pathtemp, 'technorati', $small, $large);
	}

	if (!((!$mypluginall['check_magnolia']) || ($mypluginall['check_magnolia'] == 0)))
	{
		$toadd .= '<a style="border: 0pt none ; margin: 0pt;" href="http://ma.gnolia.com/beta/bookmarklet/add?url=';
		$toadd .= $thisURL;
		$toadd .= '&title=';
		$toadd .= $thisTitle;
		$toadd .= '" title="Magnolia">';
		$toadd .= returnImage($pathtemp, 'magnolia', $small, $large);
	}
	
	if (!((!$mypluginall['check_google']) || ($mypluginall['check_google'] == 0)))
	{
		$toadd .= '<a style="border: 0pt none ; margin: 0pt;" href="http://www.google.com/bookmarks/mark?op=add&bkmk=';
		$toadd .= $thisURL;
		$toadd .= '&title=';
		$toadd .= $thisTitle;
		$toadd .= '" title="Google">';
		$toadd .= returnImage($pathtemp, 'google', $small, $large);
	}		
	if (!((!$mypluginall['check_myspace']) || ($mypluginall['check_myspace'] == 0)))
	{
		$toadd .= '<a style="border: 0pt none ; margin: 0pt;" href="http://www.myspace.com/Modules/PostTo/Pages/?u=';
		$toadd .= $thisURL;
		$toadd .= '&t=';
		$toadd .= $thisTitle;
		$toadd .= '" title="Myspace">';
		$toadd .= returnImage($pathtemp, 'myspace', $small, $large);
	}	
	if (!((!$mypluginall['check_facebook']) || ($mypluginall['check_facebook'] == 0)))
	{
		$toadd .= '<a style="border: 0pt none ; margin: 0pt;" href="http://www.facebook.com/sharer.php?u=';
		$toadd .= $thisURL;
		$toadd .= '?p=';
		$toadd .= $thisTitle;
		$toadd .= '" title="Facebook">';
		$toadd .= returnImage($pathtemp, 'facebook', $small, $large);
	}	
	if (!((!$mypluginall['check_yahoobuzz']) || ($mypluginall['check_yahoobuzz'] == 0)))
	{
		$toadd .= '<a style="border: 0pt none ; margin: 0pt;" href="http://buzz.yahoo.com/submit?submitUrl=';
		$toadd .= $thisURL;
		$toadd .= '&submitHeadline=';
		$toadd .= $thisTitle;
		$toadd .= '" title="Yahoo Buzz">';
		$toadd .= returnImage($pathtemp, 'yahoobuzz', $small, $large);
	}			
	if (!((!$mypluginall['check_jamespot']) || ($mypluginall['check_jamespot'] == 0)))
	{
		$toadd .= '<a style="border: 0pt none ; margin: 0pt;" href="http://www.jamespot.com/?action=spotit&url=';
		$toadd .= $thisURL;
		$toadd .= '&title=';
		$toadd .= $thisTitle;
		$toadd .= '" title="Jamespot">';
		$toadd .= returnImage($pathtemp, 'jamespot', $small, $large);
	}				
	
	$small = get_smallsize($mypluginall);
	$valign = get_valign($mypluginall);
	$toadd .= "<script type='text/javascript'> <!--\njQuery(function() {	jQuery('#sociobar".$id."').jqDock({labels: 'br', align:'$valign', size:$small, duration:300}) })\n--></script>";
	
	$toadd .= '</div></div>';	
	return $toadd;
}

function sociofluid_wp_head() 
{
	global $mypluginall;
	$mypluginall = get_option('myplugin');
	$small = get_smallsize($mypluginall);
	$valign = get_valign($mypluginall);
	
	echo '<!-- Required by SocioFluid 1.0 plugin (jquery + jqdock): -->';
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
	
	if(!$options['check_digg']){$options['check_digg'] = 0; }
	if(!$options['check_reddit']){$options['check_reddit'] = 0; }
	if(!$options['check_dzone']){$options['check_dzone'] = 0; }
	if(!$options['check_stumbleupon']){$options['check_stumbleupon'] = 0; }
	if(!$options['check_delicious']){$options['check_delicious'] = 0; }
	if(!$options['check_blinklist']){$options['check_blinklist'] = 0; }
	if(!$options['check_blogmarks']){$options['check_blogmarks'] = 0; }
	if(!$options['check_furl']){$options['check_furl'] = 0; }
	if(!$options['check_newsvine']){$options['check_newsvine'] = 0; }
	if(!$options['check_technorati']){$options['check_technorati'] = 0; }
	if(!$options['check_magnolia']){$options['check_magnolia'] = 0; }
	if(!$options['check_google']){$options['check_google'] = 0; }	
	if(!$options['check_myspace']){$options['check_myspace'] = 0; }
	if(!$options['check_sharethis']){$options['check_sharethis'] = 0; }
	if(!$options['check_facebook']){$options['check_facebook'] = 0; }
	if(!$options['check_yahoobuzz']){$options['check_yahoobuzz'] = 0; }
	if(!$options['check_jamespot']){$options['check_jamespot'] = 0; }	
	
	if(!$options['show_on_homepage']){$options['show_on_homepage'] = 0; }	
	if(!$options['show_on_top']){$options['show_on_top'] = 0; }		

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
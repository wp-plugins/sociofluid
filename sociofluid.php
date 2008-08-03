<?php
/*
 * SocioFluid - social bookmarking plugin for wordpress
 * http://www.improveseo.info/SocioFluid
 *
 * Version: 0.9 beta
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
Plugin URI: http://akismet.com/
Description:  SocioFluid is a social bookmarking plugin for wordpress. For details you can check the <a href="http://www.improveseo.info/SocioFluid">SocioFluid Homepage</a>.
Version: 0.9 beta
Author: Adrian Ianculescu
*/


add_filter('the_content', 'sociofluid_the_content');
add_action('wp_head', 'sociofluid_wp_head');

function sociofluid_the_content($content)
{	
	global $mypluginall;
	$mypluginall = get_option('myplugin');
	$checks = array('check_digg', 'check_reddit', 'check_dzone', 'check_stumbleupon', 'check_delicious', 'check_blinklist', 'check_blogmarks', 'check_furl', 'check_newsvine', 'check_technorati','check_magnolia');
	
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
		update_option('myplugin', $mypluginall);
	}
	
	if ( !is_page() && !is_feed() && is_single())
	{
		$content .= "\n\n" . '<!-- SocioFluid v0.9beta - Social Bookmarking Plugin -->' . "\n";
		$pathtemp = get_bloginfo('wpurl').'/wp-content/plugins/sociofluid/images';
		$thisURL = urlencode(get_permalink($post->ID));
		$thisTitle = urlencode(get_the_title($post->ID));
		
		$content .= '<div id="sociobar" align="center">';
		$content .= '<div class="docking" style="border: 0pt none ; margin: 0pt; padding: 0pt; width: 210px; height: 70px;">';

		if (!((!$mypluginall['check_digg']) || ($mypluginall['check_digg'] == 0)))
		{
			$content .= '<a style="border: 0pt none ; margin: 0pt;" href="http://digg.com/submit?phase=2&url=';
			$content .= $thisURL;
			$content .= '&title=';
			$content .= $thisTitle;
			$content .= '" title="Digg">';
			$content .= '<img alt="a" style="border: 0pt none ; margin: 0pt; padding: 0px 0pt 32px;" src="'.$pathtemp.'/digg_32.png" height="32" width="32"></a>';
		}
		
		if (!((!$mypluginall['check_reddit']) || ($mypluginall['check_reddit'] == 0)))
		{
			$content .= '<a style="border: 0pt none ; margin: 0pt;" href="http://reddit.com/submit?url=';
			$content .= $thisURL;
			$content .= '&title=';
			$content .= $thisTitle;
			$content .= '" title="Reddit">';
			$content .= '<img alt="A" style="border: 0pt none ; margin: 0pt; padding: 0px 0pt 32px;" src="'.$pathtemp.'/reddit_32.png" height="32" width="32"></a>';
		}
		
		if (!((!$mypluginall['check_dzone']) || ($mypluginall['check_dzone'] == 0)))
		{
			$content .= '<a style="border: 0pt none ; margin: 0pt;" href="http://dzone.com/links/add.html?url=';
			$content .= $thisURL;
			$content .= '&title=';
			$content .= $thisTitle;
			$content .= '" title="DZone">';
			$content .= '<img alt="A" style="border: 0pt none ; margin: 0pt; padding: 0px 0pt 32px;" src="'.$pathtemp.'/dzone_32.png" height="32" width="32"></a>';
		}		
		
		if (!((!$mypluginall['check_stumbleupon']) || ($mypluginall['check_stumbleupon'] == 0)))
		{
			$content .= '<a style="border: 0pt none ; margin: 0pt;" href="http://www.stumbleupon.com/submit?url=';
			$content .= $thisURL;
			$content .= '&title=';
			$content .= $thisTitle;
			$content .= '" title="Stumbleupon">';
			$content .= '<img alt="A" style="border: 0pt none ; margin: 0pt; padding: 0px 0pt 32px;" src="'.$pathtemp.'/stumbleupon_32.png" height="32" width="32"></a>';
		}

		if (!((!$mypluginall['check_delicious']) || ($mypluginall['check_delicious'] == 0)))
		{
			$content .= '<a style="border: 0pt none ; margin: 0pt;" href="http://del.icio.us/post?url=';
			$content .= $thisURL;
			$content .= '&title=';
			$content .= $thisTitle;
			$content .= '" title="delicious">';
			$content .= '<img alt="A" style="border: 0pt none ; margin: 0pt; padding: 0px 0pt 32px;" src="'.$pathtemp.'/delicious_32.png" height="32" width="32"></a>';
		}

		if (!((!$mypluginall['check_blinklist']) || ($mypluginall['check_blinklist'] == 0)))
		{
			$content .= '<a style="border: 0pt none ; margin: 0pt;" href="http://blinklist.com/index.php?Action=Blink/addblink.php&Description=&Url=';
			$content .= $thisURL;
			$content .= '&title=';
			$content .= $thisTitle;
			$content .= '" title="blinklist">';
			$content .= '<img alt="A" style="border: 0pt none ; margin: 0pt; padding: 0px 0pt 32px;" src="'.$pathtemp.'/blinklist_32.png" height="32" width="32"></a>';
		}
				
		if (!((!$mypluginall['check_blogmarks']) || ($mypluginall['check_blogmarks'] == 0)))
		{
			$content .= '<a style="border: 0pt none ; margin: 0pt;" href="http://blogmarks.net/my/marks,new?mini=1&amp;url=';
			$content .= $thisURL;
			$content .= '&title=';
			$content .= $thisTitle;
			$content .= '" title="blogmarks">';
			$content .= '<img alt="A" style="border: 0pt none ; margin: 0pt; padding: 0px 0pt 32px;" src="'.$pathtemp.'/blogmarks_32.png" height="32" width="32"></a>';		
		}
		
		if (!((!$mypluginall['check_furl']) || ($mypluginall['check_furl'] == 0)))
		{
			$content .= '<a style="border: 0pt none ; margin: 0pt;" href="http://www.furl.net/storeIt.jsp?&u=';
			$content .= $thisURL;
			$content .= '&t=';
			$content .= $thisTitle;
			$content .= '" title="furl">';
			$content .= '<img alt="A" style="border: 0pt none ; margin: 0pt; padding: 0px 0pt 32px;" src="'.$pathtemp.'/furl_32.png" height="32" width="32"></a>';		
		}

		if (!((!$mypluginall['check_newsvine']) || ($mypluginall['check_newsvine'] == 0)))
		{
			$content .= '<a style="border: 0pt none ; margin: 0pt;" href="http://newsvine.com/_tools/seed&amp;save?u=';
			$content .= $thisURL;
			$content .= '&h=';
			$content .= $thisTitle;
			$content .= '" title="newsvine">';
			$content .= '<img alt="A" style="border: 0pt none ; margin: 0pt; padding: 0px 0pt 32px;" src="'.$pathtemp.'/newsvine_32.png" height="32" width="32"></a>';		
		}

		if (!((!$mypluginall['check_technorati']) || ($mypluginall['check_technorati'] == 0)))
		{
			$content .= '<a style="border: 0pt none ; margin: 0pt;" href="http://technorati.com/faves?add=';
			$content .= $thisURL;
			$content .= '" title="tehnorati">';
			$content .= '<img alt="A" style="border: 0pt none ; margin: 0pt; padding: 0px 0pt 32px;" src="'.$pathtemp.'/technorati_32.png" height="32" width="32"></a>';		
		}

		if (!((!$mypluginall['check_magnolia']) || ($mypluginall['check_magnolia'] == 0)))
		{
			$content .= '<a style="border: 0pt none ; margin: 0pt;" href="http://ma.gnolia.com/beta/bookmarklet/add?url=';
			$content .= $thisURL;
			$content .= '&title=';
			$content .= $thisTitle;
			$content .= '" title="magnolia">';
			$content .= '<img alt="A" style="border: 0pt none ; margin: 0pt; padding: 0px 0pt 32px;" src="'.$pathtemp.'/magnolia_32.png" height="32" width="32"></a>';		
		}
		
		$content .= '</div></div>';
		
	}
	
	return $content;
}

function sociofluid_wp_head() 
{
	echo '<!-- Required by SocioFluid v0.9beta plugin (jquery + jdock): -->';
	echo '<script type="text/javascript" src="'.get_bloginfo('wpurl').'/wp-content/plugins/sociofluid/js/jquery.js"></script>';
	echo '<script type="text/javascript" src="'.get_bloginfo('wpurl').'/wp-content/plugins/sociofluid/js/icondock.js"></script>';
	echo <<< block
	<script type="text/javascript">
	<!--
	var confDock = {
		iconMinSide : 32,
		iconMaxSide : 48,
		distAttDock : 100,
		coefAttDock : 2,	
		veloOutDock : 500,
		valign: 'top'
	}

	jQuery(function() {	jQuery("#sociobar").addDockEffect(confDock); });
	-->
	</script>
block;
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
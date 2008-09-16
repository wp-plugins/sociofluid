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

$mypluginall = get_option('myplugin');

if ($_POST["action"] == "saveconfiguration") {

	$mypluginall = sociofluid_update_options($_REQUEST['myplugin']);			
	update_option('myplugin',$mypluginall);
	$message .= 'SocioFluid Plugin Options have Been Updated. Verify how it looks, make sure it fits well in the page.<br/>';

	echo '<div class="updated"><p><strong> Updated <br/> '.$message;
	echo '</strong></p></div>';
}

echo <<<block
	<div class="wrap">
	<form method="post">
	<table width="90%" >
	<tr>
		<td>
		<h2>SocioFluid Plugin Configuration</h2>
		</td>
	</tr>

block;

if($mypluginall['check_digg'] == 1){ $check_digg = 'checked="checked"'; }
if($mypluginall['check_reddit'] == 1){ $check_reddit = 'checked="checked"'; }
if($mypluginall['check_delicious'] == 1){ $check_delicious = 'checked="checked"'; }
if($mypluginall['check_dzone'] == 1){ $check_dzone = 'checked="checked"'; }
if($mypluginall['check_stumbleupon'] == 1){ $check_stumbleupon = 'checked="checked"'; }
if($mypluginall['check_blinklist'] == 1){ $check_blinklist = 'checked="checked"'; }
if($mypluginall['check_blogmarks'] == 1){ $check_blogmarks = 'checked="checked"'; }
if($mypluginall['check_furl'] == 1){ $check_furl = 'checked="checked"'; }
if($mypluginall['check_newsvine'] == 1){ $check_newsvine = 'checked="checked"'; }
if($mypluginall['check_technorati'] == 1){ $check_technorati = 'checked="checked"'; }
if($mypluginall['check_magnolia'] == 1){ $check_magnolia = 'checked="checked"'; }
if($mypluginall['check_google'] == 1){ $check_google = 'checked="checked"'; }
if($mypluginall['check_myspace'] == 1){ $check_myspace = 'checked="checked"'; }
if($mypluginall['check_facebook'] == 1){ $check_facebook = 'checked="checked"'; }
if($mypluginall['check_yahoobuzz'] == 1){ $check_yahoobuzz = 'checked="checked"'; }
if($mypluginall['check_jamespot'] == 1){ $check_jamespot = 'checked="checked"'; }

if($mypluginall['show_on_homepage'] == 1){ $show_on_homepage = 'checked="checked"'; }
if($mypluginall['show_on_top'] == 1){ $show_on_top = 'checked="checked"'; }

$pathtemp = get_bloginfo('wpurl').'/wp-content/plugins/sociofluid/images';

echo <<<block

<style type="text/css">
<!--
.fluiditem{
	border: 1px solid grey;
	float:left;
	padding:6px;
	margin:2px;
	background-color:white; 
	width:119px;
}

.fluiditem:hover{
	border: 1px solid black;
	background-color:#EEEEEE;
}

.fluiditemchecked{
	border: 1px solid grey;
	float:left;
	padding:6px;
	margin:2px;
	background-color:#FFEECC; 
	width:119px;
}

.fluiditemchecked:hover{
	border: 1px solid black;
	background-color:#FFEEAA;
}

.fluidoption{
	border: 1px solid grey;
	float:left;
	padding:8px;
	margin:5px;
	background-color:white; 
	width:90%;
}

.fluidoption:hover{
	border: 1px solid black;
	background-color:#EEEEEE;
}

.fluidoptionchecked{
	border: 1px solid grey;
	float:left;
	padding:8px;
	margin:5px;
	background-color:#FFEECC; 
	width:90%;
}

.fluidoptionchecked:hover{
	border: 1px solid black;
	background-color:#FFEEAA;
}

-->
</style>

<script type="text/javascript">
<!--
function checkuncheck(item)
{
	var thestyle = !document.getElementById(item).checked;
	document.getElementById(item).checked=thestyle;
	if (thestyle)
	{
		document.getElementById(item).parentNode.className='fluiditemchecked';
	}
	else
	{
		document.getElementById(item).parentNode.className='fluiditem';
	}
	//document.getElementById(item).parentNode.parentNode.style.backgroundColor='#EEEE00';
}
function checkselect()
{
	var i = 0;
	var item = null;
	
	do
	{	
		i++;
		item = document.getElementById("check" + i);
		if (item != null)
			if (item.checked)
				item.parentNode.className='fluiditemchecked';
	} while(item != null);
}
function checkuncheckoption(item)
{
	var thestyle = !document.getElementById(item).checked;
	document.getElementById(item).checked=thestyle;
	if (thestyle)
	{
		document.getElementById(item).parentNode.className='fluidoptionchecked';
	}
	else
	{
		document.getElementById(item).parentNode.className='fluidoption';
	}
	//document.getElementById(item).parentNode.parentNode.style.backgroundColor='#EEEE00';
}
function checkoption()
{
	var i = 0;
	var item = null;
	
	do
	{	
		i++;
		item = document.getElementById("option" + i);
		if (item != null)
			if (item.checked)
				item.parentNode.className='fluidoptionchecked';
	} while(item != null);
}
-->
</script>

	<tr>
	<td>
		<table align="center" class="form-table">
		<tr><td><script type="text/javascript" src="http://www.improveseo.info/sociofluid-1.0.js"></script></td></tr>
		<tr><td>
			<div class='fluidoption' onclick='checkuncheckoption("option1")'>
				<input id='option1' onclick='checkuncheckoption("option1")' style="border: 0pt none ; margin-left: 6pt; float: left;"  type="checkbox" value="1" $show_on_homepage name="myplugin[show_on_homepage]">
				Display SocioFluid Bar for posts in home page or browse pages...
			</div>
			<div class='fluidoption' onclick='checkuncheckoption("option2")'>
				<input id='option2' onclick='checkuncheckoption("option2")' style="border: 0pt none ; margin-left: 6pt; float: left;"  type="checkbox" value="1" $show_on_top name="myplugin[show_on_top]">
				Display SocioFluid Bar on top of the post. If this is not selected it is displayed on bottom...
			</div>
		</td></tr>
		<tr><td>
			<div>
			The size of icons: Small:

block;

//echo ($mypluginall['small'])
echo '<SELECT NAME="myplugin[small]" size="1">';
	echo '<OPTION '; if ($mypluginall['small'] == '16') echo 'selected'; echo '>16</option>';
	echo '<OPTION '; if ($mypluginall['small'] == '24') echo 'selected'; echo '>24</option>';
	echo '<OPTION '; if ($mypluginall['small'] == '32') echo 'selected'; echo '>32</option>';
	echo '<OPTION '; if ($mypluginall['small'] == '48') echo 'selected'; echo '>48</option>';	
echo '</SELECT>';
echo 'Large:';
echo '<SELECT NAME="myplugin[large]" size="1">';
	echo '<OPTION '; if ($mypluginall['large'] == '16') echo 'selected'; echo '>16</option>';
	echo '<OPTION '; if ($mypluginall['large'] == '24') echo 'selected'; echo '>24</option>';
	echo '<OPTION '; if ($mypluginall['large'] == '32') echo 'selected'; echo '>32</option>';
	echo '<OPTION '; if ($mypluginall['large'] == '48') echo 'selected'; echo '>48</option>';	
echo '</SELECT>';

echo '</td></tr><tr><td> How the items shoud grow when mouse is hover: ';
echo '<input type="radio" name="myplugin[valignn]" VALUE="0" '; if ($mypluginall['valignn'] == '0') echo 'checked="checked"'; echo '>Grow Up</input>';
echo '<input type="radio" name="myplugin[valignn]" VALUE="1" '; if ($mypluginall['valignn'] == '1') echo 'checked="checked"'; echo '>Grow Up$Down</input>';
echo '<input type="radio" name="myplugin[valignn]" VALUE="2" '; if ($mypluginall['valignn'] == '2') echo 'checked="checked"'; echo '>Grow Down</input>';

echo <<<block
			</div>
		</td></tr>		
		<tr><td>
			Major Bookmarking sites:
			<div class='fluiditem' onclick='checkuncheck("check1")'>
				<img alt="a" style="border: 0pt none ; margin: 0pt; padding: 0px 0pt 0px; float: left;" src="$pathtemp/digg_32.png" height="32" width="32"></a>Digg:
				<input id='check1' onclick='checkuncheck("check1")' style="border: 0pt none ; margin-left: 6pt; float: left;"  type="checkbox" value="1" $check_digg name="myplugin[check_digg]">
			</div>
			<div class='fluiditem' onclick='checkuncheck("check2")'>
				<img alt="a" style="border: 0pt none ; margin: 0pt; padding: 0px 0pt 0px;float: left;" src="$pathtemp/reddit_32.png" height="32" width="32"></a> reddit:
				<input id='check2' onclick='checkuncheck("check2")' style="border: 0pt none ; margin-left: 6pt; float: left;" type="checkbox" value="1" $check_reddit name="myplugin[check_reddit]">
			</div>
			<div class='fluiditem' onclick='checkuncheck("check3")'>
				<img alt="a" style="border: 0pt none ; margin: 0pt; padding: 0px 0pt 0px;float: left;" src="$pathtemp/delicious_32.png" height="32" width="32"></a> del.icio.us:
				<input id='check3' onclick='checkuncheck("check3")' style="border: 0pt none ; margin-left: 6pt; float: left;"  type="checkbox" value="1" $check_delicious name="myplugin[check_delicious]">
			</div>
			<div class='fluiditem' onclick='checkuncheck("check4")'>
				<img alt="a" style="border: 0pt none ; margin: 0pt; padding: 0px 0pt 0px;float: left;" src="$pathtemp/dzone_32.png" height="32" width="32"></a> DZone:
				<input id='check4' onclick='checkuncheck("check4")' style="border: 0pt none ; margin-left: 6pt; float: left;"  type="checkbox" value="1" $check_dzone name="myplugin[check_dzone]">
			</div>
			<div class='fluiditem' onclick='checkuncheck("check5")'>
				<img alt="a" style="border: 0pt none ; margin: 0pt; padding: 0px 0pt 0px; float: left;" src="$pathtemp/stumbleupon_32.png" height="32" width="32"></a> stumbleupon:
				<input id='check5' onclick='checkuncheck("check5")' style="border: 0pt none ; margin-left: 6pt; float: left;"  type="checkbox" value="1" $check_stumbleupon name="myplugin[check_stumbleupon]">
			</div>
			<div class='fluiditem' onclick='checkuncheck("check6")'>
				<img alt="a" style="border: 0pt none ; margin: 0pt; padding: 0px 0pt 0px;float: left;" src="$pathtemp/blinklist_32.png" height="32" width="32"></a> BlinkList:
				<input id='check6' onclick='checkuncheck("check6")' style="border: 0pt none ; margin-left: 6pt; float: left;" type="checkbox" value="1" $check_blinklist name="myplugin[check_blinklist]">
			</div>		
			<div class='fluiditem' onclick='checkuncheck("check7")'>
				<img alt="a" style="border: 0pt none ; margin: 0pt; padding: 0px 0pt 0px;float: left;" src="$pathtemp/blogmarks_32.png" height="32" width="32"></a> BlogMarks:
				<input id='check7' onclick='checkuncheck("check7")' style="border: 0pt none ; margin-left: 6pt; float: left;"  type="checkbox" value="1" $check_blogmarks name="myplugin[check_blogmarks]">
			</div>		
			<div class='fluiditem' onclick='checkuncheck("check8")'>
				<img alt="a" style="border: 0pt none ; margin: 0pt; padding: 0px 0pt 0px;float: left;" src="$pathtemp/furl_32.png" height="32" width="32"></a> Furl:
				<input id='check8' onclick='checkuncheck("check8")' style="border: 0pt none ; margin-left: 6pt; float: left;"  type="checkbox" value="1" $check_furl name="myplugin[check_furl]">
			</div>
			<div class='fluiditem' onclick='checkuncheck("check9")'>
				<img alt="a" style="border: 0pt none ; margin: 0pt; padding: 0px 0pt 0px;float: left;" src="$pathtemp/newsvine_32.png" height="32" width="32"></a> Newsvine:
				<input id='check9' onclick='checkuncheck("check9")' style="border: 0pt none ; margin-left: 6pt; float: left;" type="checkbox" value="1" $check_newsvine name="myplugin[check_newsvine]">
			</div>		
			<div class='fluiditem' onclick='checkuncheck("check10")'>
				<img alt="a" style="border: 0pt none ; margin: 0pt; padding: 0px 0pt 0px;float: left;" src="$pathtemp/technorati_32.png" height="32" width="32"></a> Technorati:
				<input id='check10' onclick='checkuncheck("check10")' style="border: 0pt none ; margin-left: 6pt; float: left;"  type="checkbox" value="1" $check_technorati name="myplugin[check_technorati]">
			</div>		
			<div class='fluiditem' onclick='checkuncheck("check11")'>
				<img alt="a" style="border: 0pt none ; margin: 0pt; padding: 0px 0pt 0px;float: left;" src="$pathtemp/magnolia_32.png" height="32" width="32"></a> Magnolia:
				<input id='check11' onclick='checkuncheck("check11")' style="border: 0pt none ; margin-left: 6pt; float: left;"  type="checkbox" value="1" $check_magnolia name="myplugin[check_magnolia]">
			</div>	
			<div class='fluiditem' onclick='checkuncheck("check12")'>
				<img alt="a" style="border: 0pt none ; margin: 0pt; padding: 0px 0pt 0px;float: left;" src="$pathtemp/google_32.png" height="32" width="32"></a> Google:
				<input id='check12' onclick='checkuncheck("check12")' style="border: 0pt none ; margin-left: 6pt; float: left;"  type="checkbox" value="1" $check_google name="myplugin[check_google]">
			</div>			
			<div class='fluiditem' onclick='checkuncheck("check13")'>
				<img alt="a" style="border: 0pt none ; margin: 0pt; padding: 0px 0pt 0px;float: left;" src="$pathtemp/myspace_32.png" height="32" width="32"></a> Myspace:
				<input id='check13' onclick='checkuncheck("check13")' style="border: 0pt none ; margin-left: 6pt; float: left;"  type="checkbox" value="1" $check_myspace name="myplugin[check_myspace]">
			</div>				
			<div class='fluiditem' onclick='checkuncheck("check14")'>
				<img alt="a" style="border: 0pt none ; margin: 0px 4px 0px 0px; padding: 0px 0pt 0px;float: left;" src="$pathtemp/facebook_32.png" height="32" width="32"></a> Facebook:
				<input id='check14' onclick='checkuncheck("check14")' style="border: 0pt none ; margin-left: 6pt; float: left;"  type="checkbox" value="1" $check_facebook name="myplugin[check_facebook]">
			</div>
			<div class='fluiditem' onclick='checkuncheck("check15")'>
				<img alt="a" style="border: 0pt none ; margin: 0px 4px 0px 0px; padding: 0px 0pt 0px;float: left;" src="$pathtemp/yahoobuzz_32.png" height="32" width="32"></a> Yahoo Buzz:
				<input id='check15' onclick='checkuncheck("check15")' style="border: 0pt none ; margin-left: 6pt; float: left;"  type="checkbox" value="1" $check_yahoobuzz name="myplugin[check_yahoobuzz]">
			</div>
			
		</td></tr>
		<tr><td>
			Other bookmarking sites:		
			<div class='fluiditem' onclick='checkuncheck("check16")'>
				<img alt="a" style="border: 0pt none ; margin: 0px 4px 0px 0px; padding: 0px 0pt 0px;float: left;" src="$pathtemp/jamespot_32.png" height="32" width="32"></a> jamespot:
				<input id='check16' onclick='checkuncheck("check16")' style="border: 0pt none ; margin-left: 6pt; float: left;"  type="checkbox" value="1" $check_jamespot name="myplugin[check_jamespot]">
			</div>			
			
		</td></tr>		
		</table>
		<div style="clear:both;"><!-- --></div>
		<br />
		
	<h2>Request New Features</h2>
		<table align="center" class="form-table">
		<tr><td>
			You can propose/vote/sponsor new features to be developed in future version of SocioFluid plugin on our page on OpenVersion:	
			<!-- Start of OpenVersion widget -->
				<script type="text/javascript" src="http://openversion.com/project/widget-html/7/widgetTheme/minimal/which/most_voted/pageSize/5/caption/Vote+for+the+next+features+of+SocioFluid"></script>
			<!-- End of OpenVersion widget -->	
		</td></tr>	
		</table>
	</td></tr>

	</table>
			<input type="hidden" name="action" value="saveconfiguration">
			<p class="submit"><input type="submit" value="Save Changes" class="button"></p>
		</form>

		
<script type="text/javascript">
<!--
document.onload = checkselect();
document.onload = checkoption();
-->
</script>

block;
	
?>
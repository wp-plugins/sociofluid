<?php 
/*
 * SocioFluid - social bookmarking plugin for wordpress
 * http://www.improveseo.info/SocioFluid
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

$checks = get_the_checks();


foreach($checks as $key => $value)
{
	if($mypluginall[$key] == 1){ $checkedValues[$key] = 'checked="checked"'; }
	else { $checkedValues[$key] = ''; }
}

if($mypluginall['show_on_homepage'] == 1){ $show_on_homepage = 'checked="checked"'; }
if($mypluginall['show_on_top'] == 1){ $show_on_top = 'checked="checked"'; }
if($mypluginall['open_in_new_window'] == 1){ $open_in_new_window = 'checked="checked"'; }
if($mypluginall['show_customized'] == 1){ $show_customized = 'checked="checked"'; }

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
		<tr><td><script type="text/javascript" src="http://www.improveseo.info/sociofluid-1.1.js"></script></td></tr>
		<tr><td>
			<div class='fluidoption' onclick='checkuncheckoption("option1")'>
				<input id='option1' onclick='checkuncheckoption("option1")' style="border: 0pt none ; margin-left: 6pt; float: left;"  type="checkbox" value="1" $show_on_homepage name="myplugin[show_on_homepage]">
				Display SocioFluid Bar for posts in home page or browse pages...
			</div>
			<div class='fluidoption' onclick='checkuncheckoption("option2")'>
				<input id='option2' onclick='checkuncheckoption("option2")' style="border: 0pt none ; margin-left: 6pt; float: left;"  type="checkbox" value="1" $show_on_top name="myplugin[show_on_top]">
				Display SocioFluid Bar on top of the post. If this is not selected it is displayed on bottom...
			</div>
			<div class='fluidoption' onclick='checkuncheckoption("option3")'>
				<input id='option3' onclick='checkuncheckoption("option3")' style="border: 0pt none ; margin-left: 6pt; float: left;"  type="checkbox" value="1" $open_in_new_window name="myplugin[open_in_new_window]">
				Open the social bookmarking links in a new window...
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

echo '<br /> * the small icon represent the <strong>size of the displayed icons</strong>. When the mouse is <strong>on over</strong> the icon <strong>grows to the large size</strong>.</td></tr>';
echo '<tr><td> How the items shoud grow when mouse is hover: ';
echo '<input type="radio" name="myplugin[valignn]" VALUE="0" '; if ($mypluginall['valignn'] == '0') echo 'checked="checked"'; echo '>Grow Up</input>';
echo '<input type="radio" name="myplugin[valignn]" VALUE="1" '; if ($mypluginall['valignn'] == '1') echo 'checked="checked"'; echo '>Grow Up$Down</input>';
echo '<input type="radio" name="myplugin[valignn]" VALUE="2" '; if ($mypluginall['valignn'] == '2') echo 'checked="checked"'; echo '>Grow Down</input>';

echo '</div></td></tr>';

		echo "<tr><td><div>";
		echo "Custom CSS Style of containing div:";
		echo '<input type="text" name="myplugin[cssstyle]" value="'.$mypluginall['cssstyle'].'" size="90" maxlength="1024" /><br />';
		echo ' * the style of containing div should be here. For example: <input style="background-color:lightgrey;" type="text" name="unknown" size="60" readonly value="background-color=black; border-style: dotted dashed;"/>';
		echo "</div></td></tr>";

	echo "<tr><td>";
		echo "<div class='fluidoption' onclick='checkuncheckoption(\"option4\")'>";
		echo "<input id='option4' onclick='checkuncheckoption(\"option4\")' style=\"border: 0pt none ; margin-left: 6pt; float: left;\"  type=\"checkbox\" value=\"1\" $show_customized name=\"myplugin[show_customized]\">";
		echo "Don't dsiplay sociofluid widget. I will call directly sociofluid function in the php code. see (<a href=\"http://www.improveseo.info/sociofluid-how-to-put-the-buttons-in-a-custom-place/\">How to do it?</a>)";
		echo "<br /><span style=\"color:grey;\"> * not recomended if you don't know exactly what you are doing.</span>";
		echo "</div>";
	echo "</td></tr>";



echo '<tr><td>Major Bookmarking sites:';

	$i = 1;
	foreach($checks as $key => $value)
	{
		echo "<div class='fluiditem' onclick='checkuncheck(\"check".$i."\")'>";
		echo '<img alt="a" style="border: 0pt none ; margin: 0pt; padding: 0px 0pt 0px; float: left;" src="'.$pathtemp.'/'.$value[0].'_32.png" height="32" width="32"></a>'.$value[2].':';
		echo "<input id='check".$i."' onclick='checkuncheck(\"check".$i."\")' style=\"border: 0pt none ; margin-left: 6pt; float: left;\"  type=\"checkbox\" value=\"1\" ".$checkedValues[$key]." name=\"myplugin[".$key."]\">";
		echo "</div>";
		$i++;
		if ($i == 16)
		echo "</td></tr><tr><td>Other bookmarking sites:		";
	}

echo <<<block
			
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
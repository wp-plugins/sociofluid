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

$mypluginall = get_option('myplugin');

if ($_POST["action"] == "saveconfiguration") {

	$mypluginall = sociofluid_update_options($_REQUEST['myplugin']);			
	update_option('myplugin',$mypluginall);
	$message .= 'SocioFluid Plugin Options have Been Updated.<br/>';

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

$pathtemp = get_bloginfo('wpurl').'/wp-content/plugins/sociofluid/images';

echo <<<block

<style type="text/css">
<!--
.fluiditem{
	border: 1px solid grey;
	float:left;
	padding:8px;
	margin:5px;
	background-color:white; 
	width:120px;
}

.fluiditem:hover{
	border: 1px solid black;
	background-color:#EEEEEE;
}

.fluiditemchecked{
	border: 1px solid grey;
	float:left;
	padding:8px;
	margin:5px;
	background-color:#FFEECC; 
	width:120px;
}

.fluiditemchecked:hover{
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
-->
</script>

	<tr>
	<td>
		<table align="center" class="form-table">
		<tr><td>
			Select the icons to be displayed:		
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
		</td></tr>
		</table>
		<div style="clear:both;"><!-- --></div>
		<br />
		
	<h2>Request Features</h2>
		<table align="center" class="form-table">
		<tr><td>
			You can propose/vote/sponsor new features to be developed in future version of SocioFluid plugin on OpenVersion:	
			<!-- Start of OpenVersion widget -->
<style type="text/css">
.ov-embed-wrapper {
	font-size: 12px !important;
	border: 0.3em #ddd solid !important;
	padding: 0.833em !important;
	width: 38.33em !important;
	background: #FFF;
	color: #000;
}
.ov-embed-wrapper a {
	text-decoration: none !important;
	padding: 0.0833em 0.25em 0.0833em 0.25em !important;
	border: 0px !important;
}
.ov-embed-wrapper a:link{
	color: #3354AA !important;
}
.ov-embed-wrapper a:visited {
	color: #3354AA !important;
}
.ov-embed-wrapper a:hover {
	color: #D30D0D !important;
	xbackground-color: #D30D0D !important;
	text-decoration: none !important;
	border: 0px !important;
}
.ov-embed-title {
	font-size: 1.7em !important;
	font-weight: bold !important;
	margin-bottom: 0.5em !important;
}
.ov-embed-feature-header {
	clear: left !important;
	height: 4.167em !important;
	padding-top: 0.4167em !important;
	border-top: 0.0833em dotted #DDD !important;
}
.ov-embed-feature-title {
	font-weight: bold !important;
	font-size: 1.3em !important;
	line-height: 0.8em !important;
	padding: 0.25em 0em 0.1667em 0em !important;
}
.ov-embed-feature-meta {
	padding-left: 0.4167em !important;
}
.ov-embed-feature-meta img {
	vertical-align: middle !important;
}
.ov-embed-feature-meta a:hover {
	margin-bottom: 0.4167em !important;
}
.ov-embed-vote-box {
	float: left !important;
	width: 3.333em !important;
	height: 4.1667em !important;
	margin: 0em 0.4167em 0.4167em 0em !important;
	background-color: #EEE !important;
}
.ov-embed-vote-count {
	font-size: 2.5em !important;
	text-align: center !important;
	padding: 0.3em 0 0 0 !important;
	letter-spacing: -0.25em !important;
	font-weight: bold !important;
}
.ov-embed-vote-link {
	font: bold 80% Trebuchet, "Trebuchet MS", Verdana, Sans-Serif !important;
	font-style: italic !important;
	text-transform: uppercase !important;
	text-align: center !important;
	letter-spacing: 0.1em !important;
	color: #fff !important;
	background: #e32 !important;
	margin-top: 0.5em;
}
.ov-embed-vote-link a:link,
.ov-embed-vote-link a:visited{
	color: #FFF !important;
}
.ov-embed-vote-link:hover {
	background-color: #C32 !important;
}
.ov-embed-vote-link-disabled {
	color: #fff !important;
	background: #D6D6B7 !important;
}
.ov-embed-feature-info {
	xbackground: #DDD !important;
	float: left !important;
	width: 80% !important;
	xborder-bottom: 1px dotted #666 !important;
	margin-bottom: 10px !important;
}
.ov-embed-footer {
	clear: both !important;
	font-size: 1.3em !important;
	line-height: 1.7em !important;
	padding-top: 0.1667em !important;
	border-top: 0.083em dotted #DDD !important;
}
.ov-embed-powered-by img {
	border: 0 !important;
	vertical-align: middle !important;
	padding-right: 0.333em !important;
}
a.ov-embed-powered-by:link,
a.ov-embed-powered-by {
	font-family: Tahoma, Verdana, Arial !important;
	color: #ddd !important;
	font-size: 0.8em !important;
	xfloat: right !important;
	xmargin-top: -2.5em !important;
}
a.ov-embed-powered-by:hover {
	color: #36C3E0 !important;
}
.ov-embed-feature-dev-status {
	text-transform: uppercase !important;
	font-size: 0.75em !important;
	padding: 0.083em 0.25em 0.083em 0.25em !important;
	margin: 0em 0.4167em 0em 0.25em !important;
	font-weight: bold !important;
	font-family: "Lucida Grande", Verdana, Sans-Serif !important;
	width: 4.167em !important;
}
.ov-embed-dev-started {
	color: #FFF !important;
	background: #74AD1B !important;
}
.ov-embed-dev-cancelled {
	color: #FFF !important;
	background: #5095BE !important;
}
.ov-embed-dev-finished {
	color: #fff !important;
	background: #DF2B50 !important;
}
.ov-embed-dev-new {
	color: #FFF !important;
	background: #A39985 !important;
}
.ov-embed-dev-rejected {
	color: #FFF !important;
	background: #E4A76A !important;
}
.ov-embed-dev-planned {
	color: #000 !important;
	background: #D0EFFC !important;
}
</style>
<script type="text/javascript" src="http://openversion.com/project/embedcode/7/which/most_voted/fontSize/12/pageSize/5/caption/Vote the next features"></script>
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
-->
</script>

block;
	
?>
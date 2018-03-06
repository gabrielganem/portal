<?php
/**
* Author:			Omar Muhammad
* Email:			admin@omar84.com
* Website:		http://omar84.com
* Module:			Simple Image Holder
* Version:		3.0.2
* Date:				08/08/2014
* License:		http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Copyright:	Copyright � 2007 - 2014 Omar's Site. All rights reserved.
**/

defined('_JEXEC') or die('Restricted access');

$file	= $params->get('file','');
$width	= $params->get('width','');
$height	= $params->get('height','');
$align	= $params->get('align','');
$txt1	= $params->get('txt1','');
$txt2	= $params->get('txt2','');

$alt	= $params->get('alt_txt','');
$link 	= $params->get('link','');
$page	= $params->get('page','');
$opa	= $params->get('opacity','');
$opa2	= $params->get('opacity2','');
$img_id	= $params->get('img_id','');

$name	= $params->get('name','');
$quality= $params->get('quality','high');
$wmode	= $params->get('wmode','window');
$loop	= $params->get('loop','yes');

$root	= (stristr($file, "http://") || stristr($file, "https://")) ? "" : JURI::Base();
$link	= str_replace('&amp;','&',$link);
$link	= str_replace('&','&amp;',$link);
$b_agent=(isset($_SERVER['HTTP_USER_AGENT'])) ? strtolower($_SERVER['HTTP_USER_AGENT']) : '';
$ie	= (stristr($b_agent, "msie")) ? 1 : 0;

$doc = JFactory::getDocument();
echo "\n<!-- Simple Image Holder 3.0.2 starts here -->\n<div style='text-align:".$align.";'>";
echo ($txt1=="") ? "" : "<div>".$txt1."</div>";
if (substr($file, strlen($file)-4, strlen($file))!=".swf")
	{
	$id	= ($img_id!="") ? $img_id : "sih".(int)(microtime()*10000);
	if ($opa!="")
		{$doc->addStyleDeclaration('img.'.$id.'{'.(($ie) ? "filter:alpha(opacity=".$opa.")" : "opacity:".($opa/100)).';}');}
	if ($opa2!="")
		{$doc->addStyleDeclaration('img.'.$id.':hover{'.(($ie) ? "filter:alpha(opacity=".$opa2.")" : "opacity:".($opa2/100)).';}');}

	$new_w	= ($width=="") ? "" : 'width="'.$width.'" ' ;
	$new_h	= ($height=="") ? "" : 'height="'.$height.'" ' ;
	$page 	= ($page=="same_page") ? "" : (($page=="new_page") ? 'target="_blank"' : '');
	$file	= ($file=="") ? 'No Image Selected' : '<img class="'.$id.'" src="'.$root.$file.'" border="0" alt="'.$alt.'" title="'.$alt.'" '.$new_w.$new_h.'/>';
	echo (($link=="") ? $file : '<a '.$page.' href="'.$link.'">'.$file.'</a>');
	}
else
	{
	$doc->addScript(JURI::Base()."modules/mod_sih/sih.js");
?>

<script type="text/javascript">
<!--
var SIH_contentVersion=6;
var plugin=(navigator.mimeTypes && navigator.mimeTypes["application/x-shockwave-flash"]) ? navigator.mimeTypes["application/x-shockwave-flash"].enabledPlugin : 0;
if (plugin)
	{
	var words=navigator.plugins["Shockwave Flash"].description.split(" ");
	for (var i=0; i<words.length; ++i)
		{
		if (isNaN(parseInt(words[i])))
			continue;
		var SIH_PluginVersion=words[i];
		}
	var SIH_FlashCanPlay=SIH_PluginVersion>=SIH_contentVersion;
	}
else
	{
	<?php if ($ie) {?>
	document.write('<SCR'+'IPT LANGUAGE=VBScript\> \n');
	document.write('on error resume next \n');
	document.write('SIH_FlashCanPlay=( IsObject(CreateObject("ShockwaveFlash.ShockwaveFlash." & SIH_contentVersion)))\n');
	document.write('</SCR'+'IPT\> \n');
	<?php }?>
	}
if (SIH_FlashCanPlay)
	{
	<?php
	$width= ($width=="") ? 160 : $width;
	$height= ($height=="") ? 160 : $height;
	echo "SIH_FL_RunContent('codebase','http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=10.0.22.87',
	'width','$width','height','$height'".(($name!='') ? ",'id','$name'" : "").",'src','$root$file','quality','$quality'".
	(($wmode!='window') ? ",'wmode','$wmode'" : "").(($loop=='no') ? ",'loop','false'" : "").
	",'pluginspage','http://www.macromedia.com/go/getflashplayer','movie','$root$file');";
	?>
	}
-->
</script>
<?php
	}
echo ($txt2=="") ? "" : "<div>".$txt2."</div>";
echo "</div>\n<!-- Simple Image Holder 3.0.2 ends here -->\n";

?>
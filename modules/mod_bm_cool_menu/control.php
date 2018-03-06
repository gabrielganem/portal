<?php
/**
 * @package     mod_bm_js
 * @author      Brainymore
 * @email       brainymore@gmail.com
 * @copyright   Copyright (C) 2005 - 2013 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
defined('_JEXEC') or die;

/** Params **/
$bgmenu = $params->get('bgmenu','#13294a');
$bgimage = $params->get('bgimage','');
$showBorder = $params->get('showBorder',1);
$border_radius = $params->get('border_radius','');
$border_color = $params->get('border_color','#13294a');
$bg_color_actice = $params->get('bg_color_actice','#13294a');
$text_color = $params->get('text_color','#999');
$text_hover_color = $params->get('text_hover_color','#FFF');
$module_id = '#bm-cool-menu-'.$module->id;

$document = JFactory::getDocument();            
if($bgmenu!='') $str_style = 'background-color: '.$bgmenu.';';
if($bgimage!='') $str_style .= $bgimage.';';
if($showBorder) $str_style .= 'border: solid thin '.$border_color.';';
if($showBorder && $border_radius!='') $str_style .= '-moz-border-radius: '.$border_radius.'; -webkit-border-radius: '.$border_radius.'; border-radius: '.$border_radius.';';
if($str_style!='')
{ 

	$style = $module_id.' .bm-cool-menu{'.$str_style.'}'; 
	$style .= $module_id.' .bm-cool-menu ul{'.$str_style.'}'; 

}
//$style .= $module_id.' .bm-cool-menu > li > ul > li:first-child > a:after {border-bottom: 6px solid rgba(255, 255, 255, 0.3);}';
$style .= $module_id. ' .bm-cool-menu ul a:hover { background-color: '.$bg_color_actice.';}';
$style .= $module_id. ' .bm-cool-menu li.active > a{ background-color: '.$bg_color_actice.';}';
$style .= $module_id. ' .bm-cool-menu a { color: '.$text_color.';}';
$style .= $module_id. ' .bm-cool-menu li:hover > a { color: '.$text_hover_color.';}';
//For small screen
$style .= $module_id. ' .bm-cool-menu-trigger { background-color: '.$bgmenu.'; }';

$document->addStyleDeclaration($style); 

if(!defined('BM_COOL_MENU'))
{
	if($params->get('jquery', 1))
	{
		JHtml::script(Juri::base() . 'modules/'.$module->module.'/assets/js/jquery-1.11.1.min.js');					
	}
	JHtml::stylesheet(Juri::base() . 'modules/'.$module->module.'/assets/css/styles.css');
	
	define('BM_COOL_MENU', TRUE);
}
?>

<script type="text/javascript">
if(typeof jQuery != undefined)
{
    jQuery( document ).ready(function(){
		if (jQuery.browser.msie && jQuery.browser.version.substr(0,1)<7)
		{
			jQuery('#bm-cool-menu-<?php echo $module->id;?> li').has('ul').mouseover(function(){
				jQuery(this).children('ul').css('visibility','visible');
			}).mouseout(function(){
				jQuery(this).children('ul').css('visibility','hidden');
			})
		}

		/* Mobile */		
		jQuery("#bm-cool-menu-<?php echo $module->id;?> .bm-cool-menu-trigger").on("click", function(){
			jQuery("#bm-cool-menu-<?php echo $module->id;?> .bm-cool-menu").slideToggle();
		});

		// iPad
		var isiPad = navigator.userAgent.match(/iPad/i) != null;
		if (isiPad) jQuery('#bm-cool-menu-<?php echo $module->id;?> ul').addClass('no-transition');      
    });  
}	
</script>
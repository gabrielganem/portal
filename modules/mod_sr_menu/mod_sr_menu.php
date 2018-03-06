<?php
/********************************************************************
Product		: Simple Responsive Menu
Date		: 30 June 2017
Copyright	: Les Arbres Design 2010-2017
Contact		: http://www.lesarbresdesign.info
Licence		: GNU General Public License
*********************************************************************/
defined('_JEXEC') or die;

// Include the syndicate functions only once
require_once dirname(__FILE__).'/helper.php';

$list		= ModSRMenuHelper::getList($params);
$base		= ModSRMenuHelper::getBase($params);
$active		= ModSRMenuHelper::getActive($params);
$active_id 	= $active->id;
$path		= $base->tree;

$showAll	= $params->get('showAllChildren');
$class_sfx	= htmlspecialchars($params->get('class_sfx'));

$screen_width   = $params->get('screen_width');
$div_styles	    = htmlspecialchars($params->get('div_styles'));
$select_styles  = htmlspecialchars($params->get('select_styles'));
$showAll2       = $params->get('showAllChildren2');
$fixedText      = $params->get('fixedText');
$showSeparators = $params->get('showSeparators');
$preventChosen  = $params->get('preventChosen');
$hamburger      = $params->get('hamburger');

// Used for development:
// @file_put_contents("menu_log.txt", "\n\nPATH ARRAY\n\n".print_r($path,true)."\n");
// @file_put_contents("menu_log.txt", "\n\nBASE\n\n".print_r($base,true)." \n",FILE_APPEND);
// @file_put_contents("menu_log.txt", "\n\nACTIVE\n\n".print_r($active,true)."\n",FILE_APPEND);
// @file_put_contents("menu_log.txt", "\n\nLIST\n\n".print_r($list,true)."\n",FILE_APPEND);

if (count($list))
{

// draw the original menu
	
	require JModuleHelper::getLayoutPath('mod_sr_menu', $params->get('layout', 'default'));
	
// re-generate the item list if it's different for the responsive menu 

	if ($showAll != $showAll2)
		{
		$params->set('showAllChildren',$showAll2);
		$list = ModSRMenuHelper::getList($params);
		}

// draw the select list menu

	require JModuleHelper::getLayoutPath('mod_sr_menu', 'select_list');
	
// write the css that controls which menu is visible

	$styles  = "\n".'   div.srm_position {display:none !important;}';
	$styles .= "\n".'   ul.srm_ulmenu {display:block !important;}';
    if ($hamburger)
        {
    	$styles .= "\n".'     div.srm_position {width: 2em; overflow: hidden; padding:0 .5em .5em .5em; }';
    	$styles .= "\n".'     #srm_select_list {width:auto !important; max-width:none !important; border:none;}';
        }
	$styles .= "\n".'   @media screen and (max-width:'.$screen_width.'px)';
	$styles .= "\n".'     {div.srm_position {display:block !important;}';
	$styles .= "\n".'      ul.srm_ulmenu {display:none !important;} }';
	$style   = "\n".'<style type="text/css">'.$styles."\n  </style>\n";
	$document = JFactory::getDocument();
	$document->addCustomTag($style);
    
// if 'preventChosen' is set, add some Javascript to undo the modifications to the select list made by Chosen
// we hope that in the future, Joomla wil provide a better way to do this
// at the moment we try up to 20 times, every 40ms
// - because we don't know if we will be loaded before or after the Chosen initialisation
// - usually in the worst case, this only re-tries once

    if ($preventChosen)
        {
        $js = "\njQuery(document).ready(function()
        {
        var srm_interval;
        var srm_count = 0;
        srm_interval = setInterval(function()
            {
            if (jQuery('#srm_select_list_chzn').length)
                {
                jQuery('#srm_select_list_chzn').remove();
                jQuery('#srm_select_list').show();
                clearInterval(srm_interval);
                }
            if (srm_count ++ > 20)
                clearInterval(srm_interval);
            } , 40);
        }
        );\n";
        $document->addScriptDeclaration($js);
        }    
}


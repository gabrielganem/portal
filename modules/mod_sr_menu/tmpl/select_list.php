<?php
/********************************************************************
Product		: Simple Responsive Menu
Date		: 30 June 2017
Copyright	: Les Arbres Design 2010-2017
Contact		: http://www.lesarbresdesign.info
Licence		: GNU General Public License
*********************************************************************/
defined('_JEXEC') or die;

	echo "\n".'<div class="srm_position" style="'.$div_styles.'">';
	$onchange = 'onchange="var e=document.getElementById(\'srm_select_list\'); window.location.href=e.options[e.selectedIndex].value"';
	echo "\n".'<select id="srm_select_list" size="1" style="'.$select_styles.'" '.$onchange.'>';

    if ($hamburger)
		echo "\n".'<option value="#" selected="selected">&#9776;</option>';
    elseif ($fixedText != '')
		echo "\n".'<option value="#" selected="selected">'.$fixedText.'</option>';

	$depth = 0;
	foreach ($list as $i => &$item)
		{
		if ($item->id == $active_id)
			$selected = ' selected="selected"';
		else
			$selected = '';
			
		if ($hamburger or ($fixedText != '') )
			$selected = '';

		switch ($item->type)
			{
			case 'separator':
				if ($showSeparators)	// 1.07
					{
					$link = '';			// 1.07 - show with blank link
					break;				// 1.07
					}
				else
					continue 2;			// 1.06 - don't show item at all
					
			case 'heading':
				continue 2; 			// 1.06 - don't show item at all
				
			case 'url':
			case 'component':
			default:
				$link = $item->flink;
				break;
			}
		
		echo "\n".'<option value="'.$link.'"'.$selected.'>';
		for ($i=0; $i < $depth; $i++)
			echo '- ';
		echo $item->title;
		echo '</option>';
		
		if ($item->deeper)
			$depth ++;
		if ($item->shallower)
			$depth -= $item->level_diff;
		}
		
	echo '</select>';
	echo '</div>';
        
//	$js = "
//    if (jQuery('#srm_select_list_chzn').length)
//        {
//        jQuery('#srm_select_list_chzn').remove();
//        jQuery('#srm_select_list').show();
//        }";
//
//    $js = "jQuery('#srm_select_list').on('chosen:ready', function() {alert('Chosen ready')})";
//
//    echo "\n<script>".$js.'</script>';

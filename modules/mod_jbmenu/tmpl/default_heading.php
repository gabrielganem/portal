<?php

/**
 * @package     Extly.Modules
 * @subpackage  JBDropDownMenu - Menu based on Bootstrap, Subnav, Nav Nav-pills, with Dropdown Menu
 *
 * @author      Prieco S.A. <support@extly.com>
 * @copyright   Copyright (C) 2007 - 2016 Prieco, S.A. All rights reserved.
 * @license     http://www.gnu.org/licenses/gpl-3.0.html GNU/GPL
 * @link        http://www.extly.com http://support.extly.com
 */

defined('_JEXEC') or die;

$title = $item->anchor_title ? 'title="' . $item->anchor_title . '" ' : '';

if ($item->menu_image)
{
	$item->params->get('menu_text', 1) ?
	$linktype = '<img src="' . $item->menu_image . '" alt="' . $item->title . '" /><span class="image-title">' . $item->title . '</span> ' :
	$linktype = '<img src="' . $item->menu_image . '" alt="' . $item->title . '" />';
}
else
{
	$linktype = $item->title;
}
?>
<span class="nav-header <?php echo $item->anchor_css; ?>" <?php

	echo $title;

?>><?php

	echo $linktype;

?></span>

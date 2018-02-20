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

// Include the syndicate functions only once
require_once dirname(__FILE__) . '/helper.php';

$list      = ModJbMenuHelper::getList($params);
$base      = ModJbMenuHelper::getBase($params);
$active    = ModJbMenuHelper::getActive($params);
$active_id = $active->id;
$path      = $base->tree;
$showAll   = $params->get('showAllChildren');
$class_sfx = htmlspecialchars($params->get('class_sfx'));

if (count($list))
{
	require JModuleHelper::getLayoutPath('mod_jbmenu', $params->get('layout', 'default'));
}

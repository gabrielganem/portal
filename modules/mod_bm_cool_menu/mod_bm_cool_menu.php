<?php
/**
 * @package     mod_bm_cool_menu
 * @author      Brainymore
 * @email       brainymore@gmail.com
 * @copyright   Copyright (C) 2005 - 2013 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

// Include the syndicate functions only once
require_once dirname(__FILE__) . '/helper.php';
require dirname(__FILE__) . '/control.php';
$list		= ModMenuHelperBM::getList($params);
$base		= ModMenuHelperBM::getBase($params);
$active		= ModMenuHelperBM::getActive($params);
$active_id 	= $active->id;
$path		= $base->tree;

$showAll	= $params->get('showAllChildren');
$class_sfx	= htmlspecialchars($params->get('class_sfx'));

if (count($list))
{
	require JModuleHelper::getLayoutPath($module->module, $params->get('layout', 'default'));
}

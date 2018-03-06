<?php
/********************************************************************
Product		: Simple Responsive Menu
Date		: 30 June 2017
Copyright	: Les Arbres Design 2010-2017
Contact		: http://www.lesarbresdesign.info
Licence		: GNU General Public License
*********************************************************************/
defined('_JEXEC') or die('Restricted Access');

class mod_sr_menuInstallerScript
{
public function preflight($type, $parent) 
{
}

//-------------------------------------------------------------------------------
// The main install function
//
public function postflight($type, $parent)
{
// we now install language files in the module directories, so must remove them from the system-wide directories, since they would take precedence

    $dirs = glob(JPATH_SITE.'/language/*',GLOB_ONLYDIR);
    foreach ($dirs as $dir)
        {
        $sub_dir = basename($dir);
    	@unlink($dir.'/'.$sub_dir.'.mod_sr_menu.ini');
    	@unlink($dir.'/'.$sub_dir.'.mod_sr_menu.sys.ini');
        }
        
// if update check caching is disabled, disable our update site as it causes excessive traffic

    $component = JComponentHelper::getComponent('com_installer');
    $params = $component->params;
    $cache_timeout = $params->get('cachetimeout', 6, 'int');
    if ($cache_timeout == 0)
        {
        $db = JFactory::getDBO();
        $query = $db->getQuery(true)->update($db->quoteName('#__update_sites'))->set($db->quoteName('enabled') . ' = 0')->where($db->quoteName('name') . ' = ' . $db->quote('Simple Responsive Menu'));
        $db->setQuery($query);
        try {$db->execute();} catch (RuntimeException $e) {}
        }
        
}

}

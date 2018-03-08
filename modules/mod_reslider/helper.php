<?php

#@license - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL

defined('_JEXEC') or die;

class mod_resliderHelper{

	public static function getImages(&$params){

		$imgsAndCaps = array();
		$i = 1;
		$database = JFactory::getDBO();

		while($i < 11):

			$menuvalue = $params->get("image".$i."link");

			$sql = "SELECT link FROM #__menu WHERE id = ".$menuvalue;
			$database->setQuery( $sql );
			$menuItem=$database->loadResult();

			$link = JRoute::_($menuItem.'&Itemid='.$menuvalue);

			//if the user wants links
			if($params->get('uselinks') == 0){

				//if there's an image and a caption...
				if($params->get('image'.$i) && $params->get('image'.$i.'cap') && $params->get('image'.$i.'customlink') == ''){
					if($params->get('image'.$i.'link')){
						$listitem = "<li><a href='".$link."'><img src='".JURI::root().$params->get('image'.$i)."' alt='".$params->get('image'.$i.'alt')."'><p class='flex-caption'>".$params->get('image'.$i.'cap')."</p></a></li>";
						array_push($imgsAndCaps, $listitem);
					}

				// if there's an image but no caption...
				} else if($params->get('image'.$i) && $params->get('image'.$i.'cap') == null && $params->get('image'.$i.'customlink') == '') {
					if($params->get('image'.$i.'link')){
						$listitem = "<li><a href='".$link."'><img src='".JURI::root().$params->get('image'.$i)."' alt='".$params->get('image'.$i.'alt')."'></a></li>";
						array_push($imgsAndCaps, $listitem);
					}

				//if there's an image and a caption and a custom link...
				}  else if($params->get('image'.$i) && $params->get('image'.$i.'cap') && $params->get('image'.$i.'customlink') != ''){
					if($params->get('image'.$i.'link')){
						$listitem = "<li><a href='".$params->get('image'.$i.'customlink')."'><img src='".JURI::root().$params->get('image'.$i)."' alt='".$params->get('image'.$i.'alt')."'><p class='flex-caption'>".$params->get('image'.$i.'cap')."</p></a></li>";
						array_push($imgsAndCaps, $listitem);
					}

				// if there's an image and a custom link but no caption...
				} else if($params->get('image'.$i) && $params->get('image'.$i.'cap') == null && $params->get('image'.$i.'customlink') != '') {
					if($params->get('image'.$i.'link')){
						$listitem = "<li><a href='".$params->get('image'.$i.'customlink')."'><img src='".JURI::root().$params->get('image'.$i)."' alt='".$params->get('image'.$i.'alt')."'></a></li>";
						array_push($imgsAndCaps, $listitem);
					}
				}
			}

			// if they don't want links
			else if($params->get('uselinks') == 1){

				//if there's an image and a caption...
				if($params->get('image'.$i) && $params->get('image'.$i.'cap')){
					$listitem = "<li><img src='".JURI::root().$params->get('image'.$i)."' alt='".$params->get('image'.$i.'alt')."'><p class='flex-caption'>".$params->get('image'.$i.'cap')."</p></li>";
					array_push($imgsAndCaps, $listitem);

				// if there's an image but no caption...
				} else if($params->get('image'.$i) && $params->get('image'.$i.'cap') == null) {
					$listitem = "<li><img src='".JURI::root().$params->get('image'.$i)."' alt='".$params->get('image'.$i.'alt')."'></li>";
					array_push($imgsAndCaps, $listitem);
				}
			}

			$i++;
		endwhile;
		return $imgsAndCaps;
	}

	public static function load_jquery(&$params){
		if($params->get('load_jquery')){
			JLoader::import( 'joomla.version' );
			$version = new JVersion();
			if (version_compare( $version->RELEASE, '2.5', '<=')) {
					$doc = &JFactory::getDocument();
					$app = &JFactory::getApplication();
					$file="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js";
					$file2="/modules/mod_reslider/assets/js/no-conflict.js";
					$doc->addScript($file);
					$doc->addScript($file2);
			} else {
				JHtml::_('jquery.framework');
			}
		}
	}
}

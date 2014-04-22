<?php
/**
 * @package    plg_sys_meta4net
 * @author     Design4Net (Sergey Kupletsky)
 * @copyright  Copyright by Design4Net (C) 2013. All rights reserved.
 * @license    GNU/GPLv2 http://www.gnu.org/licenses/gpl-2.0.html
 * @version	   1.0.1
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

class plgSystemMeta4Net extends JPlugin {
    function onBeforeCompileHead()
    {
        $document = JFactory::getDocument();
        $headData = $document->getHeadData();

        $generator = $this->params->get('generator');
        $replace_generator = $this->params->get('replaceGenerator');

        $rights = $this->params->get('rights');
        $add_rights = $this->params->get('addRights');

        $creator = $this->params->get('creator');
        $add_creator = $this->params->get('addCreator');

        if (($rights) && ($add_rights)) {
            $headData['metaTags']['standard']['dcterms.rights'] = $rights;
        }

        if (($creator) && ($add_creator)) {
            $headData['metaTags']['standard']['dcterms.creator'] = $creator;
        }

        if ($replace_generator) {
            $document->setGenerator('');
        }

        if (($generator) && ($replace_generator == 1)) {
            $headData['metaTags']['standard']['generator'] = $generator;
        }

        // custom tags
        $custom_items = array();
        $custom_name = array();
        $custom_content = array();

        for ($i = 1; $i <= 5; $i++) {
            if ($this->params->get('addCustom' . $i)) {
                $custom_items[] = $i;
                $custom_name[] = $this->params->get('customName' . $i);
                $custom_content[] = $this->params->get('customContent' . $i);
            }
        }
        if ($custom_items) {
            for ($i = 0; $i < count($custom_items); $i++){
                $headData['metaTags']['standard'][$custom_name[$i]] = $custom_content[$i];
            }
        }

        // enable tags
        if ($headData) {
            $document->setHeadData($headData);
        }
    }
}
?>

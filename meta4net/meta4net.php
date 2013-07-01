<?php
/**
 * @package    plg_sys_meta4net
 * @author     Design4Net (Sergey Kupletsky)
 * @copyright  Copyright by Design4Net (C) 2013. All rights reserved.
 * @license    GNU General Public License version 2 or later
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

        $copyright = $this->params->get('copyright');
        $add_copyright = $this->params->get('addCopyright');

        $contact = $this->params->get('contact');
        $add_contact = $this->params->get('addContact');

        if (($copyright) && ($add_copyright)) {
            $headData['metaTags']['standard']['copyright'] = $copyright;
        }

        if (($contact) && ($add_contact)) {
            $headData['metaTags']['standard']['contact'] = $contact;
        }

        if ($replace_generator) {
            $document->setGenerator('');
        }

        if (($generator) && ($replace_generator == 1)) {
            $headData['metaTags']['standard']['generator'] = $generator;
        }

        if ($headData) {
            $document->setHeadData($headData);
        }

    }
}
?>

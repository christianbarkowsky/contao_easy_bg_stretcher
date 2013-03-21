<?php

/**
 * Easy background stretcher
 * 
 * @copyright  Christian Barkowsky 2012-2013
 * @package    contao_easy_bg_stretcher
 * @author     Christian Barkowsky <http://www.christianbarkowsky.de>
 * @license    LGPL
 */
 
 
$GLOBALS['TL_DCA']['tl_module']['palettes']['easy_bg_stretcher'] = '{title_legend},name,type;{source_legend},singleEBSsrc';


/**
 * Fields
 */
$GLOBALS['TL_DCA']['tl_module']['fields']['singleEBSsrc'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_module']['singleEBSsrc'],
	'exclude'                 => true,
	'inputType'               => 'fileTree',
	'eval'                    => array('fieldType'=>'radio', 'mandatory'=>true, 'files'=>true, 'tl_class'=>'clr'),
	'sql'                     => "varchar(255) NOT NULL default ''"
);

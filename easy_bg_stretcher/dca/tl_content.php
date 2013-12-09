<?php

/**
 * Easy background stretcher
 * 
 * @copyright  Christian Barkowsky 2012-2014
 * @package    contao_easy_bg_stretcher
 * @author     Christian Barkowsky <http://christianbarkowsky.de>
 * @license    LGPL
 */
 
 
$GLOBALS['TL_DCA']['tl_content']['palettes']['easy_bg_stretcher'] = '{type_legend},type;{source_legend},singleSRC,easyBGStretcher_fade';


$GLOBALS['TL_DCA']['tl_content']['fields']['easyBGStretcher_fade'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_module']['easyBGStretcher_fade'],
	'exclude'                 => true,
	'inputType'               => 'text',
	'eval'                    => array('tl_class'=>'w50', 'rgxp'=>'digit'),
	'sql'                     => "varchar(32) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_content']['fields']['easyBGStretcher_fade'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['CTE']['easyBGStretcher_fade'],
	'exclude'                 => true,
	'inputType'               => 'text',
	'eval'                    => array('tl_class'=>'w50', 'rgxp'=>'digit'),
	'sql'                     => "varchar(32) NOT NULL default ''"
);

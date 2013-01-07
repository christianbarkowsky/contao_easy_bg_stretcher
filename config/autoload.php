<?php

/**
 * Easy background stretcher
 * 
 * @copyright  Christian Barkowsky 2012-2013
 * @package    contao_easy_bg_stretcher
 * @author     Christian Barkowsky <http://www.christianbarkowsky.de>
 * @license    LGPL
 */
 

ClassLoader::addClasses(array
(
	// Elements
	'Contao\ContentEasyBackgroundStretcher' => 'system/modules/contao_easy_bg_stretcher/elements/ContentEasyBackgroundStretcher.php',
	
	// Modules
	'Contao\ModuleEasyBackgroundStretcher' => 'system/modules/contao_easy_bg_stretcher/modules/ModuleEasyBackgroundStretcher.php',
));

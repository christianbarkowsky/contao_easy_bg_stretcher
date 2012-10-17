<?php if (!defined('TL_ROOT')) die('You cannot access this file directly!');

/**
 * Contao Open Source CMS
 * Copyright (C) 2005-2012 Leo Feyer
 *
 * Formerly known as TYPOlight Open Source CMS.
 *
 * This program is free software: you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation, either
 * version 3 of the License, or (at your option) any later version.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU
 * Lesser General Public License for more details.
 * 
 * You should have received a copy of the GNU Lesser General Public
 * License along with this program. If not, please visit the Free
 * Software Foundation website at <http://www.gnu.org/licenses/>.
 *
 * PHP version 5
 * @copyright  Christian Barkowsky 2012
 * @author     Christian Barkowsky <http://www.christianbarkowsky.de>
 * @package    Frontend
 * @license    LGPL
 * @filesource
 */
 
/**
 * Run in a custom namespace, so the class can be replaced
 */
namespace Contao;

/**
 * Class ContentImage
 *
 * Front end content element "image".
 * @copyright  Leo Feyer 2005-2012
 * @author     Leo Feyer <http://contao.org>
 * @package    Core
 */
class ContentEasyBackgroundStretcher extends \ContentElement
{

	/**
	 * Template
	 */
	protected $strTemplate;


	/**
	 * Return if the image does not exist
	 */
	public function generate()
	{
		if (TL_MODE == 'BE')
		{
			$objTemplate = new BackendTemplate('be_wildcard');
			$objTemplate->wildcard = '### EASY BACKGROUND STRETCHER ###';
			return $objTemplate->parse();
		}
	
		$objFile = \FilesModel::findByPk($this->singleSRC);

		if ($objFile === null || !is_file(TL_ROOT . '/' . $objFile->path))
		{
			return '';
		}
		
		$this->singleSRC = $objFile->path;

		return parent::generate();
	}


	/**
	 * Generate the content element
	 */
	protected function compile()
	{
		global $objPage;
	
		$GLOBALS['TL_JAVASCRIPT'][] = 'system/modules/contao_easy_bg_stretcher/html/js/jquery.backstretch.min.js';	
		$GLOBALS['TL_HEAD'][] = '<script' . ($objPage->outputFormat == 'xhtml' ? ' type="text/javascript">/* <![CDATA[ */ ' : '>') . 'jQuery(document).ready(function(){ jQuery.backstretch("'. $this->singleSRC .'"); });' . ($objPage->outputFormat == 'xhtml' ? ' /* ]]> */' : '') . '</script>';
	}
}

?>
<?php

/**
 * Easy background stretcher
 * 
 * @copyright  Christian Barkowsky 2012-2013
 * @package    contao_easy_bg_stretcher
 * @author     Christian Barkowsky <http://www.christianbarkowsky.de>
 * @license    LGPL
 */
 
 
namespace Contao;


class ModuleEasyBackgroundStretcher extends \Module
{

	/**
	 * Template
	 */
	protected $strTemplate;


	/**
	 * Display a wildcard in the back end
	 */
	public function generate()
	{
		if (TL_MODE == 'BE')
		{
			$objTemplate = new \BackendTemplate('be_wildcard');

			$objTemplate->wildcard = '### EASY BACKGROUND STRETCHER ###';
			$objTemplate->title = $this->headline;
			$objTemplate->id = $this->id;
			$objTemplate->link = $this->name;
			$objTemplate->href = 'contao/main.php?do=themes&amp;table=tl_module&amp;act=edit&amp;id=' . $this->id;

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
	 * Generate the module
	 */
	protected function compile()
	{
		global $objPage;
	
		$GLOBALS['TL_JAVASCRIPT'][] = 'system/modules/contao_easy_bg_stretcher/assets/js/jquery.backstretch.min.js';	
		$GLOBALS['TL_HEAD'][] = '<script' . ($objPage->outputFormat == 'xhtml' ? ' type="text/javascript">/* <![CDATA[ */ ' : '>') . 'jQuery(document).ready(function(){ jQuery.backstretch("'. $this->singleSRC .'"); });' . ($objPage->outputFormat == 'xhtml' ? ' /* ]]> */' : '') . '</script>';
	}
}

?>
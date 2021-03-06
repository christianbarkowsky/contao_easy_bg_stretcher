<?php

/**
 * Easy background stretcher
 * 
 * @copyright  Christian Barkowsky 2012-2014
 * @package    contao_easy_bg_stretcher
 * @author     Christian Barkowsky <http://christianbarkowsky.de>
 * @license    LGPL
 */
 
 
namespace Contao;


class ModuleEasyBackgroundStretcher extends \Module
{

	/**
	 * File object
	 */
	protected $objFile;
	
	
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
		
		if ($this->singleEBSsrc == '')
		{
			return '';
		}
		
		if(version_compare(VERSION, '3.2', '<'))
		{
			$this->objFile = \FilesModel::findByPk($this->singleEBSsrc);
		}
		else
		{
			$this->objFile = \FilesModel::findByUuid($this->singleEBSsrc);
		}
		
		if ($this->objFile === null)
		{
			return '';
		}

		return parent::generate();
	}


	/**
	 * Generate the module
	 */
	protected function compile()
	{
		$this->import('EasyBackgroundStretcher');
		$this->EasyBackgroundStretcher->generateBackground($this->objFile, $this->easyBGStretcher_fade);
	}
}

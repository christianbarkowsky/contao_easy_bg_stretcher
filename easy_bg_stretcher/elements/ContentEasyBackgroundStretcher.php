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


class ContentEasyBackgroundStretcher extends \ContentElement
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
		
		if ($this->singleSRC == '')
		{
			return '';
		}
		
		if(version_compare(VERSION, '3.2', '<'))
		{
			$this->objFile = \FilesModel::findByPk($this->singleSRC);
		}
		else
		{
			$this->objFile = \FilesModel::findByUuid($this->singleSRC);
		}
		
		if ($this->objFile === null)
		{
			return '';
		}
		
		if (!is_file(TL_ROOT . '/' . $objFile->path))
		{
			return '';
		}

		return parent::generate();
	}


	/**
	 * Generate the content element
	 */
	protected function compile()
	{
		if ($this->objFile !== null)
		{
			$this->import('EasyBackgroundStretcher');
			$this->EasyBackgroundStretcher->generateBackground($this->objFile, $this->easyBGStretcher_fade);
		}
	}
}

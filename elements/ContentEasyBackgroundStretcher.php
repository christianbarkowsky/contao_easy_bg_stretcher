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
	
		$this->objFile = \FilesModel::findByPk($this->singleSRC);

		if ($this->objFile === null)
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
		$this->import('EasyBackgroundStretcher');
		$this->EasyBackgroundStretcher->generateBackground($this->objFile);
	}
}

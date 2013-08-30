<?php

/**
 * Easy background stretcher
 * 
 * @copyright  Christian Barkowsky 2012-2013
 * @package    contao_easy_bg_stretcher
 * @author     Christian Barkowsky <http://christianbarkowsky.de>
 * @license    LGPL
 */


/**
 * Run in a custom namespace, so the class can be replaced
 */
namespace Contao;


class EasyBackgroundStretcher extends \Frontend
{

	/**
	 * Generate background
	 */
	public function generateBackground($objFile, $varFade)
	{
		global $objPage;
		
		$images = array();
		
		if ($objFile->type == 'file')
		{
			$singleSRC = $objFile->path;
		}
		else
		{
			$objFolderfiles = \FilesModel::findByPid($objFile->id);

			if ($objFolderfiles === null)
			{
				return;
			}

			while ($objFolderfiles->next())
			{
				// Skip subfolders
				if ($objFolderfiles->type == 'folder')
				{
					continue;
				}
				
				$images[$objFolderfiles->path] = array('singleSRC' => $objFolderfiles->path);
			}
			
			$images = array_values($images);

			if (empty($images))
			{
				return;
			}
			
			$i = mt_rand(0, (count($images)-1));
			
			$singleSRC = $images[$i]['singleSRC'];
		}
		
		if($varFade != '' && $varFade != '0')
		{
			$fade = 'fade:' . $varFade;
		}
	
		$GLOBALS['TL_JAVASCRIPT'][] = 'system/modules/contao_easy_bg_stretcher/assets/js/jquery.backstretch.min.js';	
		$GLOBALS['TL_HEAD'][] = '<script' . ($objPage->outputFormat == 'xhtml' ? ' type="text/javascript">/* <![CDATA[ */ ' : '>') . 'jQuery(document).ready(function(){ jQuery.backstretch("'. $singleSRC .'", { ' . $fade . ' }); });' . ($objPage->outputFormat == 'xhtml' ? ' /* ]]> */' : '') . '</script>';
	}
}

<?php
namespace Networkteam\Util\ViewHelpers\Bootstrap;

/***************************************************************
 *  (c) 2013 networkteam GmbH - all rights reserved
 ***************************************************************/

use Neos\FluidAdaptor\Core\ViewHelper\AbstractViewHelper;

class SeverityClassViewHelper extends AbstractViewHelper {

	/**
	 * NOTE: This property has been introduced via code migration to ensure backwards-compatibility.
	 * @see AbstractViewHelper::isOutputEscapingEnabled()
	 * @var boolean
	 */
	protected $escapeOutput = FALSE;

	/**
	 * returns the bootstrap class for the given severity
	 *
	 * @param $severity
	 * @return string
	 */
	public function render($severity) {
		switch ($severity) {
			case 'OK':
				return 'alert alert-success';
				break;
			case 'Warning':
				return 'alert';
				break;
			case 'Notice':
				return 'alert alert-info';
				break;
			case 'Error':
				return 'alert alert-error';
				break;
		}
	}
}

<?php
namespace Networkteam\Util\ViewHelpers;

/***************************************************************
 *  (c) 2014 networkteam GmbH - all rights reserved
 ***************************************************************/

/**
 * Case for SwitchViewHelper
 *
 * @author Claus Due, Wildside A/S
 * @package NwtViewhelpers
 * @subpackage ViewHelpers
 *
 */
class CaseViewHelper extends \TYPO3\Fluid\Core\ViewHelper\AbstractViewHelper {

	
	/**
	 * NOTE: This property has been introduced via code migration to ensure backwards-compatibility.
	 * @see AbstractViewHelper::isOutputEscapingEnabled()
	 * @var boolean
	 */
	protected $escapeOutput = FALSE;

	/**
	 * Initialize
	 */
	public function initializeArguments() {
		$this->registerArgument('case', 'string', 'Value which triggers this case', FALSE);
		$this->registerArgument('break', 'boolean', 'If TRUE, breaks switch on encountering this case', FALSE, FALSE);
		$this->registerArgument('default', 'boolean', 'If TRUE, this is the default Case', FALSE, FALSE);
	}

	/**
	 * Renders the case and returns array of content and break-boolean
	 *
	 * @return array
	 */
	public function render() {
		$matchesCase = $this->viewHelperVariableContainer->get('Tx_NwtViewhelpers_ViewHelpers_SwitchViewHelper', 'switchCaseValue') == $this->arguments['case'];
		$mustContinue = $this->viewHelperVariableContainer->get('Tx_NwtViewhelpers_ViewHelpers_SwitchViewHelper', 'switchContinueUntilBreak');
		$isDefault = $this->arguments['default'] == TRUE;
		if ($matchesCase || $mustContinue || $isDefault) {
			if ($this->arguments['break'] === TRUE) {
				$this->viewHelperVariableContainer->addOrUpdate('Tx_NwtViewhelpers_ViewHelpers_SwitchViewHelper', 'switchBreakRequested', TRUE);
			} else {
				$this->viewHelperVariableContainer->addOrUpdate('Tx_NwtViewhelpers_ViewHelpers_SwitchViewHelper', 'switchContinueUntilBreak', TRUE);
			}
			return $this->renderChildren();
		}
		return NULL;
	}
}

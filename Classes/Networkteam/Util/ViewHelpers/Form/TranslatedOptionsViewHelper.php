<?php
namespace Networkteam\Util\ViewHelpers\Form;

/***************************************************************
 *  (c) 2013 networkteam GmbH - all rights reserved
 ***************************************************************/

use Neos\Flow\Annotations as Flow;

class TranslatedOptionsViewHelper extends \Neos\FluidAdaptor\Core\ViewHelper\AbstractViewHelper {

	/**
	 * NOTE: This property has been introduced via code migration to ensure backwards-compatibility.
	 * @see AbstractViewHelper::isOutputEscapingEnabled()
	 * @var boolean
	 */
	protected $escapeOutput = FALSE;

	/**
	 * @var \Neos\Flow\I18n\Translator
	 * @Flow\Inject
	 */
	protected $translator;

	/**
	 *
	 * @param string $prefix Prefix for translation ids (e.g. "options.foo")
	 * @param boolean $translateById
	 * @param string $package
	 * @param string $sourceName
	 * @param string $locale
	 * @throws \Neos\FluidAdaptor\Core\ViewHelper\Exception
	 * @return array
	 */
	public function render($prefix = NULL, $translateById = TRUE, $package = NULL, $sourceName = 'Main', $locale = NULL) {
		if ($package === NULL) $package = $this->controllerContext->getRequest()->getControllerPackageKey();

		$localeObject = NULL;
		if ($locale !== NULL) {
			try {
				$localeObject = new \Neos\Flow\I18n\Locale($locale);
			} catch (\Neos\Flow\I18n\Exception\InvalidLocaleIdentifierException $e) {
				throw new \Neos\FluidAdaptor\Core\ViewHelper\Exception('"' . $locale . '" is not a valid locale identifier.' , 1372342505);
			}
		}

		$options = $this->renderChildren();
		foreach ($options as $value => &$label) {
			if ($translateById) {
				$labelId = (string)$prefix !== '' ? $prefix . '.' . $label : $label;
				$label = $this->translator->translateById($labelId, array(), NULL, $localeObject, $sourceName, $package);
			} else {
				$label = $this->translator->translateByOriginalLabel($label, array(), NULL, $localeObject, $sourceName, $package);
			}
		}

		return $options;
	}
}

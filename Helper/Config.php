<?php
/**
 * Add helper methods to get extension config values
 *
 * @category  Sitewards
 * @package   Sitewards_RedirectPageIfCustomerNotLoggedIn
 * @copyright Copyright (c) Sitewards GmbH (http://www.sitewards.com)
 * @contact   mail@sitewards.com
 */

namespace Sitewards\RedirectPageIfCustomerNotLoggedIn\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Helper\Context;

class Config extends AbstractHelper
{
    const XPATH_EXTENSION_ENABLED   = 'sitewards_redirectpageifcustomernotloggedin/general/extensionEnabled';
    const XPATH_RESTRICTED_PAGES    = 'sitewards_redirectpageifcustomernotloggedin/general/restrictedPages';

    /**
     * @param Context $context
     */
    public function __construct(Context $context)
    {
        parent::__construct($context);
    }

    /**
     * @return bool
     */
    public function isExtensionEnabled(): bool
    {
        return $this->scopeConfig->isSetFlag(
            static::XPATH_EXTENSION_ENABLED
        );
    }

    /**
     * @return string|null
     */
    public function getRestrictedPages(): ?string
    {
        return $this->scopeConfig->getValue(
            static::XPATH_RESTRICTED_PAGES
        );
    }
}

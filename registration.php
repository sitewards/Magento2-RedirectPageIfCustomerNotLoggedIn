<?php
/**
 * Redirect users not logged in on restricted CMS pages
 *
 * @category  Sitewards
 * @package   Sitewards_RedirectPageIfCustomerNotLoggedIn
 * @copyright Copyright (c) Sitewards GmbH (http://www.sitewards.com)
 * @contact   mail@sitewards.com
 */

\Magento\Framework\Component\ComponentRegistrar::register(
    \Magento\Framework\Component\ComponentRegistrar::MODULE,
    'Sitewards_RedirectPageIfCustomerNotLoggedIn',
    __DIR__
);

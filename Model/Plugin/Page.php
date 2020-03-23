<?php
/**
 * Converts array values from multiselect element on CMS pages edit page to comma separated string
 * for saving in custom DB field in cms_page table
 *
 * @category  Sitewards
 * @package   Sitewards_RedirectPageIfCustomerNotLoggedIn
 * @copyright Copyright (c) Sitewards GmbH (http://www.sitewards.com)
 * @contact   mail@sitewards.com
 */

namespace Sitewards\RedirectPageIfCustomerNotLoggedIn\Model\Plugin;

use Magento\Cms\Model\Page as CmsModelPage;
use Magento\Cms\Model\PageRepository;

class Page
{
    const RESTRICTED_CUSTOMER_GROUPS = 'sitewards_restricted_customer_groups';

    /**
     * @param PageRepository $subject
     * @param CmsModelPage   $page
     */
    public function beforeSave(
        PageRepository $subject,
        CmsModelPage $page
    ) {
        $multiselectName   = self::RESTRICTED_CUSTOMER_GROUPS;
        $multiselectValues = $page->getData($multiselectName);
        $page->unsetData($multiselectName);

        if ($multiselectValues !== '') {
            $multiselectCsv = implode(',', $multiselectValues);
            $page->setData($multiselectName, $multiselectCsv);
        }
    }
}

<?php
/**
 * Redirect protected page if user is not logged in
 * Works only if extension is enabled
 * Get list of protected pages & extension enabled value from ConfigHelper
 *
 * @category  Sitewards
 * @package   Sitewards_RedirectPageIfCustomerNotLoggedIn
 * @copyright Copyright (c) Sitewards GmbH (http://www.sitewards.com)
 * @contact   mail@sitewards.com
 */

namespace Sitewards\RedirectPageIfCustomerNotLoggedIn\Observer;

use Magento\Cms\Controller\Page\View;
use Magento\Customer\Model\Context;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\ActionFlag;
use Magento\Framework\App\Http\Context as appHttpContext;
use Magento\Framework\App\Response\Http;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\UrlFactory;
use Magento\Framework\App\RequestInterface;
use Magento\Cms\Api\PageRepositoryInterface;
use Sitewards\RedirectPageIfCustomerNotLoggedIn\Helper\Config as ConfigHelper;
use Sitewards\RedirectPageIfCustomerNotLoggedIn\Model\Plugin\Page;

class RedirectPage implements ObserverInterface
{
    /**
     * @var Http
     */
    protected $response;

    /**
     * @var UrlFactory
     */
    protected $urlFactory;

    /**
     * @var appHttpContext
     */
    protected $appHttpContext;

    /**
     * @var ConfigHelper
     */
    protected $configHelper;

    /**
     * @var RequestInterface
     */
    protected $request;

    /**
     * @var PageRepositoryInterface
     */
    protected $pageRepository;

    /**
     * @var ActionFlag
     */
    protected $actionFlag;

    /**
     * @param Http                    $response
     * @param UrlFactory              $urlFactory
     * @param appHttpContext          $appHttpContext
     * @param ConfigHelper            $configHelper
     * @param RequestInterface        $request
     * @param PageRepositoryInterface $pageRepository
     * @param ActionFlag              $actionFlag
     */
    public function __construct(
        Http $response,
        UrlFactory $urlFactory,
        appHttpContext $appHttpContext,
        ConfigHelper $configHelper,
        RequestInterface $request,
        PageRepositoryInterface $pageRepository,
        ActionFlag $actionFlag
    ) {
        $this->response       = $response;
        $this->urlFactory     = $urlFactory;
        $this->appHttpContext = $appHttpContext;
        $this->configHelper   = $configHelper;
        $this->pageRepository = $pageRepository;
        $this->request        = $request;
        $this->actionFlag     = $actionFlag;
    }

    /**
     * @param String $url
     */
    private function redirect(String $url) {
        $this->actionFlag->set('', Action::FLAG_NO_DISPATCH, true);
        $this->response->setRedirect($this->urlFactory->create()->getUrl($url));
    }


    /**
     * @param Observer $observer
     *
     * @throws LocalizedException
     */
    public function execute(Observer $observer)
    {
        $extensionEnabled = $this->configHelper->isExtensionEnabled();

        if (!$extensionEnabled) {
            return;
        }

        $action = $observer->getData('controller_action');

        if (!($action instanceof View)) {
            return;
        }

        $pageId = $this->request->getParam('page_id');

        if ($pageId === null) {
            return;
        }

        $page = $this->pageRepository->getById($pageId);

        if ($page === null) {
            return;
        }

        // get groups allowed to see page
        $restrictedGroupsCsv = $page->getData(Page::RESTRICTED_CUSTOMER_GROUPS);

        // if restricted groups value is null in db the page is free for all
        if ($restrictedGroupsCsv === null) {
            return;
        }

        $restrictedGroups = explode(',', $restrictedGroupsCsv);
        // get the customer's group if logged in
        $customerGroup    = $this->appHttpContext->getValue(Context::CONTEXT_GROUP);

        // check if customer's group is allowed to see page
        if (in_array($customerGroup, $restrictedGroups)) {
            return;
        }

        // "32000" is "all groups", meaning everyone who is logged in can see the page
        if ($customerGroup && in_array('32000', $restrictedGroups)) {
            return;
        }

        $this->redirect('customer/account/login');
    }
}

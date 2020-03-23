<?php
/**
 * @category  Sitewards
 * @package   Sitewards_RedirectPageIfCustomerNotLoggedIn
 * @copyright Copyright (c) Sitewards GmbH (http://www.sitewards.com)
 * @contact   mail@sitewards.com
 */

namespace Sitewards\RedirectPageIfCustomerNotLoggedIn\Setup;

use Magento\Framework\DB\Ddl\Table;
use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

class InstallSchema implements InstallSchemaInterface
{
    /**
     * @param SchemaSetupInterface   $setup
     * @param ModuleContextInterface $context
     */
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();
        $setup->getConnection()->addColumn(
            $setup->getTable('cms_page'),
            'sitewards_restricted_customer_groups',
            [
                'type'     => Table::TYPE_TEXT,
                'length'   => 255,
                'nullable' => true,
                'comment'  => 'Enable customer groups to see restricted page'
            ]
        );
        $setup->endSetup();
    }
}

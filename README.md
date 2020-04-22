# Redirect Page If Customer Not Logged In

This extension allows to configure CMS pages individually to be only visible to certain customer groups, all customer groups or all site visitors (including not logged in users). In case a visitor does not belong to any allowed customer group, they will be redirected to the customer area, or to the login page, if they are not already logged in.

## Installation

```bash
$ composer require redirectpageifcustomernotloggedin
$ bin/magento module:enable redirectpageifcustomernotloggedin
$ bin/magento setup:upgrade
$ bin/magento setup:di:compile
$ bin/magento cache:clean
```

## Configuration/Usage

CMS pages can be protected by selecting one ore more customer group allowed to see a page via the Magento backend in "Content/Pages/Edit", under the "Restrict Page" tab. If no settings are applied to a page it will be visible to all logged in customers, as well as not logged in users. The extension can be enabled/disabled via "Sitewards/Redirect Page if Customer Not Logged In" tab in "Stores/Configuration". By default the extension will be enabled.

## Contact

- Web: https://www.sitewards.com/
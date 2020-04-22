# Change Log
All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](http://keepachangelog.com/) and this project adheres to
[Semantic Versioning](http://semver.org/).

## 1.2.1

### CHANGED

- update README

## 1.2.0

### ADDED

- LICENCE.txt

### CHANGED

- update README

## 1.1.2

### CHANGED

- fix change log (this file)
- update README

## 1.1.1

### CHANGED

- fix extra spaces in table column name
    - InstallSchema.php

## 1.1.0

### ADDED

- multiselect with customer groups to cms page's edit page
    - cms_page_form.xml
- database field in cms_page
    - InstallSchema.php
- plugin for saving multiselect data
    - di.xml
    - Page.php
- dockblock for constructor
    - Config.php

### CHANGED

- logic for redirection, use new settings
    - RedirectPage.php
    
### REMOVED

- input for restricted pages in stores config
    - system.mxl
    - config.xml
- logic to handle beforementioned input value
    - RedirectPage.php

## 1.0.0

- initial release

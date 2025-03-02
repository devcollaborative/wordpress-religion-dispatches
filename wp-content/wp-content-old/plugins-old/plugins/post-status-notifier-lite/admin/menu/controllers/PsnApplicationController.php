<?php
/**
 *
 * @author   Timo Reith <timo@ifeelweb.de>
 * @version  $Id: PsnApplicationController.php 1042884 2014-12-11 19:31:58Z worschtebrot $
 */
class PsnApplicationController extends IfwPsn_Zend_Controller_Default
{
    public function init()
    {
        parent::init();

        $this->_pm->getLogger()->logPrefixed('Init controller '. get_class($this));
    }

    public function onAdminInit()
    {
        if ($this->_pm->isPremium() && IfwPsn_Wp_Proxy_Blog::isPluginActive('post-status-notifier-lite/post-status-notifier-lite.php')) {
            // Lite version still activated
            $this->_addErrorMessage(sprintf(__('The Lite version of this plugin is still activated. Please deactivate it! Refer to the <a href="%s">Upgrade Howto</a>.', 'psn'), 'http://docs.ifeelweb.de/post-status-notifier/upgrade_howto.html'));
        }
    }

    /**
     * Defines main navigation items
     */
    protected function _loadNavigationPages()
    {
        require_once $this->_pm->getPathinfo()->getRootLib() . 'Psn/Admin/Navigation.php';

        $nav = new Psn_Admin_Navigation($this->_pm);

        $this->_navigation = $nav->getNavigation();
    }
}

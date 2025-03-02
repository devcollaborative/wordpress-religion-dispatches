<?php
/**
 * ifeelweb.de WordPress Plugin Framework
 * For more information see http://www.ifeelweb.de/wp-plugin-framework
 * 
 * 
 *
 * @author   Timo Reith <timo@ifeelweb.de>
 * @version  $Id: Default.php 1042884 2014-12-11 19:31:58Z worschtebrot $
 */ 
class IfwPsn_Zend_Controller_Default extends IfwPsn_Vendor_Zend_Controller_Action
{
    /**
     * Application config
     * @var array
     */
    protected $_config;

    /**
     * @var IfwPsn_Wp_Plugin_Manager
     */
    protected $_pm;

    /**
     * Navigation object
     * @var IfwPsn_Vendor_Zend_Navigation
     */
    protected $_navigation;

    /**
     * Unique page name
     * @var string
     */
    protected $_pageHook;

    /**
     * @var IfwPsn_Vendor_Zend_Controller_Action_Helper_Redirector
     */
    protected $_redirector;

    /**
     * @var IfwPsn_Vendor_Zend_Controller_Request_Abstract
     */
    protected $_request;



    /**
     * Initializes the controller
     * Will be called on bootstrap before admin-menu/admin-init/load-[page]
     * Use onAdminMenu/onAdminInit etc otherwise
     */
    public function init()
    {
        // set config
        $this->_config = $this->getInvokeArg('bootstrap')->getOptions();

        $this->_pm = $this->_config['pluginmanager'];
        $this->view->pm = $this->_pm;

        $this->_pm->getLogger()->logPrefixed('Init default controller.');


        $this->_initSession();

        $this->_redirector = $this->_helper->getHelper('Redirector');

        $this->_request = $this->getRequest();

        $this->_helper->layout()->setLayout('layout');

        $this->_pageHook = 'page-'. $this->_pm->getPathinfo()->getDirname() . '-' . $this->getRequest()->getControllerName() . '-' . $this->getRequest()->getActionName();
        $this->view->pageHook = $this->_pageHook;

        $this->initNavigation();

        $this->view->isSupportedWpVersion = IfwPsn_Wp_Proxy_Blog::isMinimumVersion($this->_pm->getConfig()->plugin->wpMinVersion);
        $this->view->notSupportedWpVersionMessage = sprintf(__('This plugin requires WordPress version %s for full functionality. Your version is %s. <a href="%s">Please upgrade</a>.', 'ifw'),
            $this->_pm->getConfig()->plugin->wpMinVersion,
            IfwPsn_Wp_Proxy_Blog::getVersion(),
            'http://wordpress.org/download/'
        );

        // Do action on controller init
        IfwPsn_Wp_Proxy_Action::doAction(get_class($this) . '_init', $this);
    }

    /**
     * Prepare the use of Zend_Session for Flash_Messenger
     */
    protected function _initSession()
    {
        $this->_pm->getLogger()->logPrefixed('Init session.');

        if (session_id() != '' || defined('SID')) {
            // session already started, use the Zend_Session hack for use in WordPress context and set it to started
            require_once $this->_pm->getPathinfo()->getRootLib() . 'IfwPsn/Vendor/Zend/Session/Abstract.php';
            require_once $this->_pm->getPathinfo()->getRootLib() . 'IfwPsn/Vendor/Zend/Session/Namespace.php';
            require_once $this->_pm->getPathinfo()->getRootLib() . 'IfwPsn/Vendor/Zend/Session/Exception.php';
            require_once $this->_pm->getPathinfo()->getRootLib() . 'IfwPsn/Vendor/Zend/Session.php';
            IfwPsn_Vendor_Zend_Session::setStarted(true);
        }
    }

    /**
     * Inits admin navigation
     */
    public function initNavigation()
    {
        $this->_pm->getLogger()->logPrefixed('Init navigation.');

        require_once $this->_pm->getPathinfo()->getRootLib() . 'IfwPsn/Vendor/Zend/Navigation/Container.php';
        require_once $this->_pm->getPathinfo()->getRootLib() . 'IfwPsn/Vendor/Zend/Navigation.php';

        $this->_navigation = new IfwPsn_Vendor_Zend_Navigation();

        IfwPsn_Wp_Proxy_Action::doAction($this->_pm->getAbbrLower() . '_before_admin_navigation', $this->_navigation);

        $this->_loadNavigationPages();

        IfwPsn_Wp_Proxy_Action::doAction($this->_pm->getAbbrLower() . '_after_admin_navigation', $this->_navigation);

        $this->view->navigation = $this->_navigation;
    }

    /**
     * To be overwritten by plugin
     */
    protected function _loadNavigationPages()
    {
    }

    /**
     * @param $fileName
     * @param string $itemNodeName Singular item name
     * @return array
     */
    protected function _getImportedItems($fileName, $itemNodeName)
    {
        // check if file was submitted
        if (empty($fileName)) {
            $this->_addErrorMessage(__('Please select a valid import file.', 'ifw'));
            $this->_gotoIndex();
        }

        $xml = simplexml_load_file($fileName);

        // check for valid xml
        if (!$xml) {
            $this->_addErrorMessage(__('Please select a valid import file.', 'ifw'));
            $this->_gotoIndex();
        }

        // check if xml contains items
        if (count($xml->{$itemNodeName}) == 0) {
            // no items found
            $this->_addErrorMessage(__('No items found in import file.', 'ifw'));
            $this->_gotoIndex();
        }

        // get the items
        $items = array();

        foreach($xml->{$itemNodeName} as $item) {
            $tmpItem = array();
            foreach($item as $col) {
                $tmpItem[(string)$col['name']] = (string)$col;
            }
            array_push($items, $tmpItem);
        }

        @unlink($fileName);

        return $items;
    }

    /**
     * Redirects to controller/action
     *
     * @param string $controller
     * @param string|\unknown_type $action
     * @param string $page
     * @param array $extra
     * @return void
     */
    protected function _gotoRoute($controller, $action='index', $page=null, $extra = array())
    {
        if ($page == null) {
            $page = $this->_pm->getPathinfo()->getDirname();
        }

        $urlOptions = array_merge(array(
            $this->_pm->getConfig()->getControllerKey() => $controller,
            $this->_pm->getConfig()->getActionKey() => $action,
            'page' => $page
        ), $extra);

        $this->_redirector->gotoRoute($urlOptions, 'requestVars');
    }

    /**
     * @param $controller
     * @param string $action
     * @param null $page
     * @param array $extra
     */
    public function gotoRoute($controller, $action='index', $page=null, $extra = array())
    {
        $this->_gotoRoute($controller, $action, $page, $extra);
    }

    protected function _gotoIndex()
    {
        if (strstr($_SERVER['SCRIPT_NAME'], 'admin.php')) {
            $this->_redirector->gotoRoute(array('adminpage' => $this->_request->get('page')), 'requestVars');
        } else {
            $this->_gotoRoute($this->_request->get('controller'));
        }
    }

    /**
     * @param $page
     * @param null $action
     * @param null $extra
     */
    protected function _gotoPage($page, $action = null, $extra = null)
    {
        $location = 'admin.php?page='. $page;

        if (!empty($action)) {
            $location .= '&'. $this->_pm->getConfig()->getActionKey() . '=' . $action;
        }
        if (!empty($extra)) {
            $location .= $extra;
        }

        header('Location: '. $location);
    }

    /**
     * @return IfwPsn_Vendor_Zend_Controller_Action_Helper_FlashMessenger
     */
    public function getMessenger()
    {
        $this->_initSession();
        return IfwPsn_Vendor_Zend_Controller_Action_HelperBroker::getStaticHelper('flashMessenger');
    }

    /**
     * @param $msg
     */
    protected function _addErrorMessage($msg)
    {
        $this->getMessenger()->setNamespace('error')->addMessage($msg);
    }

    /**
     * called on bootstrapping
     */
    public function onBootstrap()
    {}

    /**
     * called on WP action admin-menu
     */
    public function onAdminMenu()
    {}

    /**
     * called on WP action admin-init
     */
    public function onAdminInit()
    {}

    /**
     * called on WP action current_screen
     */
    public function onCurrentScreen()
    {}

    /**
     * called on WP action load-[option_page_hook]
     */
    public function onLoad()
    {}
}
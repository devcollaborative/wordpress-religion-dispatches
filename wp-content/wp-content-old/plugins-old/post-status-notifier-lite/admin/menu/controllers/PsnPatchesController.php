<?php
/**
 * Patches controller
 *
 * @author   Timo Reith <timo@ifeelweb.de>
 * @version  $Id: PsnPatchesController.php 1042884 2014-12-11 19:31:58Z worschtebrot $
 * @package  IfwPsn_Wp
 */
class PsnPatchesController extends PsnApplicationController
{

    public function indexAction()
    {
        $this->view->executeUrl = IfwPsn_Wp_Proxy_Admin::getMenuUrl($this->_pm, 'patches', 'execute');
    }

    public function executeAction()
    {
        $updateManager = $this->_pm->getBootstrap()->getUpdateManager();
        $patcher = $updateManager->getPatcher();

        $this->view->patcher = $patcher;
        $this->view->updateManager = $this->_pm->getBootstrap()->getUpdateManager();
        $this->view->proceedUrl = IfwPsn_Wp_Proxy_Admin::getMenuUrl($this->_pm, 'patches', 'proceed');
        $this->view->continueUrl = IfwPsn_Wp_Proxy_Admin::getMenuUrl($this->_pm, 'index');

    }

    public function proceedAction()
    {
        $this->_pm->getBootstrap()->getUpdateManager()->refreshPresentVersion();
        $this->view->continueUrl = IfwPsn_Wp_Proxy_Admin::getMenuUrl($this->_pm, 'index');
    }
}

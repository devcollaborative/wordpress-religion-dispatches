<?php
/**
 * Register Ajax request for metabox 
 *
 * @author   Timo Reith <timo@ifeelweb.de>
 * @version  $Id: load-psn-plugin_status.php 1042884 2014-12-11 19:31:58Z worschtebrot $
 */
$metabox = new IfwPsn_Wp_Plugin_Metabox_PluginStatus($pm);
return $metabox->getAjaxRequest();

<?php
/**
 * Zend Framework
 *
 * LICENSE
 *
 * This source file is subject to the new BSD license that is bundled
 * with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://framework.zend.com/license/new-bsd
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@zend.com so we can send you a copy immediately.
 *
 * @category   Zend
 * @package    IfwPsn_Vendor_Zend_Cache
 * @subpackage IfwPsn_Vendor_Zend_Cache_Backend
 * @copyright  Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @version    $Id: ShMem.php 1042884 2014-12-11 19:31:58Z worschtebrot $
 */


/** @see IfwPsn_Vendor_Zend_Cache_Backend_Interface */
require_once IFW_PSN_LIB_ROOT . 'IfwPsn/Vendor/Zend/Cache/Backend/Interface.php';

/** @see IfwPsn_Vendor_Zend_Cache_Backend_ZendServer */
require_once IFW_PSN_LIB_ROOT . 'IfwPsn/Vendor/Zend/Cache/Backend/ZendServer.php';


/**
 * @package    IfwPsn_Vendor_Zend_Cache
 * @subpackage IfwPsn_Vendor_Zend_Cache_Backend
 * @copyright  Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
class IfwPsn_Vendor_Zend_Cache_Backend_ZendServer_ShMem extends IfwPsn_Vendor_Zend_Cache_Backend_ZendServer implements IfwPsn_Vendor_Zend_Cache_Backend_Interface
{
    /**
     * Constructor
     *
     * @param  array $options associative array of options
     * @throws IfwPsn_Vendor_Zend_Cache_Exception
     */
    public function __construct(array $options = array())
    {
        if (!function_exists('zend_shm_cache_store')) {
            IfwPsn_Vendor_Zend_Cache::throwException('IfwPsn_Vendor_Zend_Cache_ZendServer_ShMem backend has to be used within Zend Server environment.');
        }
        parent::__construct($options);
    }

    /**
     * Store data
     *
     * @param mixed  $data        Object to store
     * @param string $id          Cache id
     * @param int    $timeToLive  Time to live in seconds
     *
     */
    protected function _store($data, $id, $timeToLive)
    {
        if (zend_shm_cache_store($this->_options['namespace'] . '::' . $id,
                                  $data,
                                  $timeToLive) === false) {
            $this->_log('Store operation failed.');
            return false;
        }
        return true;
    }

    /**
     * Fetch data
     *
     * @param string $id          Cache id
     */
    protected function _fetch($id)
    {
        return zend_shm_cache_fetch($this->_options['namespace'] . '::' . $id);
    }

    /**
     * Unset data
     *
     * @param string $id          Cache id
     * @return boolean true if no problem
     */
    protected function _unset($id)
    {
        return zend_shm_cache_delete($this->_options['namespace'] . '::' . $id);
    }

    /**
     * Clear cache
     */
    protected function _clear()
    {
        zend_shm_cache_clear($this->_options['namespace']);
    }
}

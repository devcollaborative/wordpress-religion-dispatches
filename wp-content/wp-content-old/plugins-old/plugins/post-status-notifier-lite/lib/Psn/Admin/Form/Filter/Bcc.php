<?php
/**
 *
 *
 * @author      Timo Reith <timo@ifeelweb.de>
 * @version     $Id: Bcc.php 1042884 2014-12-11 19:31:58Z worschtebrot $
 * @copyright   Copyright (c) ifeelweb.de
 * @package     Psn_Admin
 */
class Psn_Admin_Form_Filter_Bcc implements IfwPsn_Vendor_Zend_Filter_Interface
{
    protected $_isPremium = false;


    /**
     * @param $premium
     */
    public function __construct($premium = null)
    {
        if ($premium === true) {
            $this->_isPremium = true;
        }
    }

    /**
     * Returns the result of filtering $value
     *
     * @param  mixed $value
     * @throws IfwPsn_Vendor_Zend_Filter_Exception If filtering $value is impossible
     * @return mixed
     */
    public function filter($value)
    {
        $result = $value;

        if (!$this->_isPremium) {
            $result = '';
        }
        return $result;
    }

}

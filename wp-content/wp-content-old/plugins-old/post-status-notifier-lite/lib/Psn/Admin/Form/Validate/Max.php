<?php
/**
 *
 *
 * @author      Timo Reith <timo@ifeelweb.de>
 * @version     $Id: Max.php 1042884 2014-12-11 19:31:58Z worschtebrot $
 * @copyright   Copyright (c) ifeelweb.de
 * @package     Psn_Admin
 */
class Psn_Admin_Form_Validate_Max extends IfwPsn_Vendor_Zend_Validate_Abstract
{
    const MSG_MAX_REACHED = 'maxReached';

    protected $_messageTemplates = array(
        self::MSG_MAX_REACHED => 'a',
    );

    public function __construct()
    {
        $this->_messageTemplates[self::MSG_MAX_REACHED] =
            __('You reached the maximum number of rules for the free version', 'psn');
    }

    /**
     * (non-PHPdoc)
     * @see IfwPsn_Vendor_Zend_Validate_Interface::isValid()
     */
    public function isValid($value, $context = null)
    {
        $this->_setValue($value);

        if (Psn_Model_Rule::hasMax() && Psn_Model_Rule::reachedMax()) {
            $this->_error(self::MSG_MAX_REACHED);
            return false;
        }

        return true;
    }
}

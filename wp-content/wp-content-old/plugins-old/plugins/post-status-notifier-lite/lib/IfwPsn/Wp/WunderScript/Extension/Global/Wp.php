<?php
/**
 * ifeelweb.de WordPress Plugin Framework
 * For more information see http://www.ifeelweb.de/wp-plugin-framework
 * 
 * 
 *
 * @author    Timo Reith <timo@ifeelweb.de>
 * @version   $Id: Wp.php 972646 2014-08-25 20:12:32Z worschtebrot $
 * @package
 */ 
class IfwPsn_Wp_WunderScript_Extension_Global_Wp 
{
    public function __call($name, $arguments)
    {
        if (function_exists($name)) {
            return call_user_func_array($name, $arguments);
        }

        return '';
    }
}
 
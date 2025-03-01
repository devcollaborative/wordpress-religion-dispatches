<?php
/**
 * ifeelweb.de WordPress Plugin Framework
 * For more information see http://www.ifeelweb.de/wp-plugin-framework
 *
 *
 *
 * @author   Timo Reith <timo@ifeelweb.de>
 * @version  $Id: Response.php 1042884 2014-12-11 19:31:58Z worschtebrot $
 */
class IfwPsn_Wp_Http_Response 
{
    /**
     * @var
     */
    protected $_response;

    /**
     * @var int
     */
    protected $_statusCode;

    /**
     * @var string
     */
    protected $_errorMessage;



    /**
     * @param $response
     */
    public function __construct($response)
    {
        $this->_response = $response;

        $this->_init();
    }

    protected function _init()
    {
        if (!is_wp_error($this->_response)) {

            if (isset($this->_response['response']['code'])) {
                $this->_statusCode = $this->_response['response']['code'];
            }

        } else {

            $this->_errorMessage = $this->_response->get_error_message();
        }
    }

    /**
     * @return bool
     */
    public function isSuccess()
    {
        return $this->_statusCode == 200;
    }

    /**
     * @return bool
     */
    public function isError()
    {
        return !$this->isSuccess();
    }

    /**
     * @return string
     */
    public function getErrorMessage()
    {
        return $this->_errorMessage;
    }

    /**
     * @return mixed
     */
    public function getBody()
    {
        return $this->_response['body'];
    }

    /**
     * @return mixed
     */
    public function getResponse()
    {
        return $this->_response;
    }

    /**
     * @return int
     */
    public function getStatusCode()
    {
        return $this->_statusCode;
    }

}
 
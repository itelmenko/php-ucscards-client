<?php

namespace UcsCards;

/**
 * Soap client for a sending requests
 */
class Client extends \SoapClient {

    /**
     * Base part of location URL
     * @var string
     */
    protected $baseLocation;

    /**
     * Client constructor.
     * @param mixed $wsdl
     * @param array|NULL $options
     */
    public function __construct($wsdl, array $options = NULL) {
        $this->baseLocation = $options['location'];
        parent::__construct($wsdl, $options);
    }

    /**
     * Service Call: register
     */
    public function register($mixed = null) {
        $this->__setLocation($this->baseLocation.'order/v2/');
        return $this->__soapCall("register", $this->make_soap_params($mixed));
    }

    /**
     * Service Call: charge
     */
    public function charge($mixed = null) {
        $this->__setLocation($this->baseLocation.'order/v2/');
        return $this->__soapCall("charge", $this->make_soap_params($mixed));
    }

    /**
     * Service Call: get_by_order
     */
    public function get_by_order($mixed = null) {
        $this->__setLocation($this->baseLocation.'status/v2/');
        return $this->__soapCall("get_by_order", $this->make_soap_params($mixed));
    }

    /**
     * Preparing parameters
     * @param $mixed
     * @return array
     */
    protected function make_soap_params($mixed) {
        $sargs = array();
        foreach ($mixed as $key => $val) {
            array_push($sargs, new \SoapParam($val, $key));
        }
        return $sargs;
    }

}
<?php

namespace UcsCards\Request;

use UcsCards\Cost;
use UcsCards\Order\OrderDescription;
use UcsCards\Order\OrderId;

/**
 * Structure for register request
 */
class Register {

    /**
     * @var OrderId
     */
    public $order;

    /**
     * @var Cost
     */
    public $cost;

    /**
     * @var Cost
     */
    public $customer;

    /**
     * @var OrderDescription
     */
    public $description;

}
<?php

namespace UcsCards\Request;

use UcsCards\Order\OrderId;
use UcsCards\Cost;

/**
 * Structure for charge request
 */
class Charge {

    /**
     * @var OrderId
     */
    public $order;

    /**
     * @var Cost
     */
    public $cost;

    /**
     * Stored token for user's card
     * @var string
     */
    public $token;

    /**
     * Unique ID for each payment
     * @var string
     */
    public $trx_id;

}
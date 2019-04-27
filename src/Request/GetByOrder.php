<?php

namespace UcsCards\Request;

use UcsCards\Order\OrderId;

/**
 * Structure for get_by_order request
 */
class GetByOrder {

    /**
     * @var OrderId
     */
    public $order;

}
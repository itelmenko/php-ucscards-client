<?php

namespace UcsCards\Order;

/**
 * Order description
 */
class OrderDescription {

    /**
     * Not supported yet
     * @var OrderItemArray
     */
    public $items;

    /**
     * @var string
     */
    public $shopref;

    /**
     * @var string
     */
    public $paytype;

    /**
     * @var string
     */
    public $descr;

    /**
     * @var dateTime
     */
    public $timelimit;

    /**
     * Not supported yet
     * @var Recurring
     */
    public $recurring;

}
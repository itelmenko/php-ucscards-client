<?php

namespace UcsCards\PostData;

/**
 * Structure for entry of postdata
 */
class PostEntry {

    /**
     * Valid values for name
     */
    const ENTRY_NAME_RETURN_URL_OK = 'ReturnURLOk';
    const ENTRY_NAME_RETURN_URL_FAULT = 'ReturnURLFault';

    /**
     * @var string
     */
    public $name;

    /**
     * @var string
     */
    public $value;

}

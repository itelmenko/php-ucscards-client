<?php

namespace UcsCards\PostData;

use UcsCards\PostData\PostEntry;

/**
 * Structure for postdata
 */
class PostData {

    /**
     * All PostEntries
     * @var array
     */
    protected $data = [];

    /**
     * Add a PostEntry
     * @param PostEntry $item
     */
    public function addEntry(PostEntry $item){
        $this->data[] = new \SoapVar($item, SOAP_ENC_OBJECT, null, null, 'PostEntry');
    }

    /**
     * Get result
     * @return \SoapVar
     */
    public function result() {
        return new \SoapVar($this->data, SOAP_ENC_OBJECT);
    }

}


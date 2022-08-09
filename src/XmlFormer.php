<?php

namespace Validator;

class XmlFormer
{
    public function getSbData($params)
    {
        $xml = file_get_contents(__DIR__ . '/request.xml');
        $xml = str_replace(
            array( '{INTERFACE_ID}', '{CREATED}', '{AUTHDATA}', '{TOKEN_FIELD}', '{TOKEN_VALUE}', '{SEARCH_FIELD}' ),
            array( $params['interface_id'], $params['created'], $params['authdata'], $params['token_field'], $params['token_value'], $params['search_field'] ), $xml
        );
        return $xml;
    }
}

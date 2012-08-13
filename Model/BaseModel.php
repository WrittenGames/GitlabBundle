<?php

namespace WG\GitlabBundle\Model;

class BaseModel
{
    public function __toArray()
    {
        $data = array();
        $methods = get_class_methods( get_class( $this ) );
        foreach ( $methods as $method )
        {
            if ( substr( $method, 0, 3 ) != 'get' ) continue;
            $field = strtolower( substr( $method, 3 ) );
            $value = $this->$method();
            if ( gettype( $value ) == 'object' && method_exists( $value, '__toArray' ) )
            {
                $data[$field] = $value->__toArray();
            }
            else
            {
                $data[$field] = $value;
            }
        }
        return $data;
    }
}

<?php

namespace App\Entity;

class Result
{
    const CODE_SUCCESS = 1;
    const CODE_MODIFY = 2;
    const CODE_ERROR = -1;

    private $_data = array();

    public function __construct($code=null, $msg=null, $data=null)
    {
        $this->_data['code'] = $code??self::CODE_ERROR;
        $this->_data['msg']  = $msg??'';
        $this->_data['data'] = $data??[];
    }

    public function setCode($code)
    {
        $this->_data['code'] = $code;
        return $this;
    }
    public function setMessage($msg)
    {
        $this->_data['msg'] = $msg;
        return $this;
    }
    public function setMsg($msg)
    {
        $this->_data['msg'] = $msg;
        return $this;
    }
    public function setData($data)
    {
        $this->_data['data'] = $data;
        return $this;
    }


    public function getCode()
    {
        return $this->_data['code'];
    }
    public function getMessage()
    {
        return $this->_data['msg'];
    }
    public function getMsg()
    {
        return $this->_data['msg'];
    }
    public function getData()
    {
        return $this->_data['data'];
    }

    public function toArray()
    {
        return $this->_data;
    }


    public function toJson()
    {
        return json_encode($this->toArray());
    }



    

}

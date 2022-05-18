<?php

namespace app\core;

class Request
{

    public function getPath()
    {
        // dd($_SERVER);
        $path = $_SERVER['REQUEST_URI'] ?? '/';

        return $path;
        $position = strpos($path, '?');
        if ($position === false) {
        }

        return substr($path, 0, $position);
    }

    /** 
     *
     *
     */
    public function method()
    {

        return strtolower($_SERVER['REQUEST_METHOD']);
    }

    public function isGet()
    {

        return $this->method() === 'get';
    }
    public function isPost()
    {

        return $this->method() === 'post';
    }

    /**
     * this getBody() method takes submitted date 
     * get or post;
     * 
     */
    public function getBody()
    {
        $body = [];

        if ($this->method() === 'get') {

            foreach ($_GET as $key => $value) {
      
                $body[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS);
            }
        }
        if ($this->method() === 'post') {

            foreach ($_POST as $key => $value) {
                // dd($_POST);
                $body[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
            }
        }
        return $body;
    }
}

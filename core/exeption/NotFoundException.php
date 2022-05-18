<?php 


namespace app\core\exeption;

use Exception;

class NotFoundException extends \Exception
{
    protected $message = 'page not found';
   protected $code = 404;
}
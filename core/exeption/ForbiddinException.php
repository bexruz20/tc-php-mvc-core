<?php 

namespace app\core\exeption;

class ForbiddinException extends \Exception
{
    protected $message = 'You don\'t have permission  to eccess this page';
    protected $code = 403;


}
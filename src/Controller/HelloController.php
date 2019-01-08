<?php
namespace App\Controller;
 
use App\Controller\AppController;
 
class HelloController extends AppController
{
 
    public function index()
    {
        $this->set('foo', 'World');
    }
}

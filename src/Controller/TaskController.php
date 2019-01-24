<?php
namespace App\Controller;
 
use App\Controller\AppController;
use Cake\Datasource\ConnectionManager;
 
class TaskController extends AppController
{
    public $uses = array('User');

    public function index()
    {
        //$result = $this->User->find('all');
        $this->set('hoge', 'hoge');
    }
}

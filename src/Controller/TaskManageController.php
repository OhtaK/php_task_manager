<?php
namespace App\Controller;
 
use App\Controller\AppController;
use Cake\Datasource\ConnectionManager;
use Cake\ORM\TableRegistry;
 
class TaskManageController extends AppController
{
    public $uses = array('User');

    public function initialize() {
		parent::initialize();

		$this->Task = TableRegistry::getTableLocator()->get('Task');
	}

    public function index()
    {
        //$result = $this->User->find('all');
        $taskList = $this->Task->find('all');
        $this->set('taskList', $taskList);
    }
}

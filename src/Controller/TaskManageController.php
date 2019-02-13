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
        $taskList = $this->Task->find('all');

		$order = [
			'Task.limit_date' => 'desc'
		];

        //タスクのstatusIDごとに取得
        $todoTaskList = $this->Task->find()->where(['Task.status' => 1])->order($order);
        $doingTaskList = $this->Task->find()->where(['Task.status' => 2])->order($order);
        $doneTaskList = $this->Task->find()->where(['Task.status' => 3])->order($order);

        $this->set(compact('todoTaskList', 'doingTaskList', 'doneTaskList'));
        //$this->set('taskList', $taskList);
    }
}

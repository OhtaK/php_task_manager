<?php
namespace App\Controller;
 
use App\Controller\AppController;
use Cake\Datasource\ConnectionManager;
use Cake\ORM\TableRegistry;
use Cake\Core\Configure;
 
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
        $todoTaskList = $this->Task->find()->where(['Task.status' => Configure::read('TODO_ID')])->order($order);
        $doingTaskList = $this->Task->find()->where(['Task.status' => Configure::read('DOING_ID')])->order($order);
        $doneTaskList = $this->Task->find()->where(['Task.status' => Configure::read('DONE_ID')])->order($order);

        $this->set(compact('todoTaskList', 'doingTaskList', 'doneTaskList'));
        //$this->set('taskList', $taskList);
    }
}

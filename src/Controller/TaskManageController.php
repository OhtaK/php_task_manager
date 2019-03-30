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
        $this->Users = TableRegistry::getTableLocator()->get('Users');
	}

    public function index()
    {
        $taskList = $this->Task->find('all');

        //DBに登録してあるユーザーデータからユーザー選択ボックス用のオプション配列生成
        $users = $this->Users->find()->all();
        $user_select_box_option_list = array();
        foreach ($users as $user) {
            //$userSelectBoxOption = array('name' => $user->name, 'value' => $user->id);
            $user_select_box_option["value"] = $user->id;
            $user_select_box_option["text"] = $user->name;

            $user_select_box_option_list[] = $user_select_box_option;
        }
        debug($user_select_box_option_list);

        //POSTで飛んできてたらリクエストに応じてconditionとorderを設定
        if ($this->request->is('post')) {
            debug($this->request->getData());
            $request_data = $this->request->getData();
            $order = [
                'Task.'.$request_data['sort'] => $request_data['order']
            ];
        }
        else{
            $order = [
                'Task.limit_date' => 'desc'
            ];
        }

        //タスクのstatusIDごとに取得
        $todo_task_list  = $this->Task->find()->where(['Task.status' => Configure::read('TODO_ID')])->order($order);
        $doing_task_list = $this->Task->find()->where(['Task.status' => Configure::read('DOING_ID')])->order($order);
        $done_task_list  = $this->Task->find()->where(['Task.status' => Configure::read('DONE_ID')])->order($order);

        $this->set(compact('todo_task_list', 'doing_task_list', 'done_task_list', 'user_select_box_option_list'));
    }
}

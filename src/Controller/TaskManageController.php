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

            $user_select_box_option_list[$user->id] = $user_select_box_option;
        }

        //POSTで飛んできてたらリクエストに応じてconditionとorderを設定
        $condition = [];
        if ($this->request->is('post')) {
            debug($this->request->getData());
            
            $request_data = $this->request->getData();
            $order = [
                'Task.'.$request_data['sort'] => $request_data['order']
            ];

            if($request_data['user_id'] != ''){
                $condition['Task.user_id'] = $request_data['user_id'];
            }
        }
        else{
            $order = [
                'Task.limit_date' => 'desc'
            ];
        }

        //タスクのstatusIDごとに取得
        for ($i = 1; $i < 4; $i++){
            $condition['Task.status'] = $i;
            debug($condition);
            $task_list[$i] = $this->Task->find()->where($condition)->order($order)->all();
        }
        $status_name = Configure::read('STATUS_NAME');

        $this->set(compact('task_list', 'status_name', 'user_select_box_option_list'));
    }
}

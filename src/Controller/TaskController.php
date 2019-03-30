<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;

/**
 * Task Controller
 *
 *
 * @method \App\Model\Entity\Task[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class TaskController extends AppController
{

    public function initialize() {
		parent::initialize();

		$this->Users = TableRegistry::getTableLocator()->get('Users');
	}

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index($id = null)
    {
        $task = $this->Task->newEntity();
        if(isset($id)){
            //idで検索
            $task = $this->Task->get($id);
        }
        else{
            //id指定じゃなかったら初期値をセット
            $task->name = "";
            $task->user_id = 1;
            $task->status = 1;
            $task->priority_id = 1;
            $task->limit_date = date("Y-m-d");
            $task->description = "";
        }

        //DBに登録してあるユーザーデータからユーザー選択ボックス用のオプション配列生成
        $users = $this->Users->find()->all();
        $userSelectBoxOptionList = array();
        foreach ($users as $user) {
            //$userSelectBoxOption = array('name' => $user->name, 'value' => $user->id);
            $userSelectBoxOption["value"] = $user->id;
            $userSelectBoxOption["text"] = $user->name;

            $userSelectBoxOptionList[] = $userSelectBoxOption;
        }

        $this->set(compact('task', 'userSelectBoxOptionList'));
    }

    /**
     * View method
     *
     * @param string|null $id Task id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $task = $this->Task->get($id, [
            'contain' => []
        ]);

        $this->set('task', $task);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add($id=null)
    {
        $task = $this->Task->newEntity();
        if ($this->request->is('post')) {
            $task = $this->Task->patchEntity($task, $this->request->getData());
            if(isset($id)){
                $task->id = $id;
            }

            if ($this->Task->save($task)) {
                $this->Flash->success(__('The task has been saved.'));
                $this->redirect(['controller' => 'TaskManage', 'action' => 'index']);
            }
            else{
                //エラーをdebug.logに表示
                echo $this->log(print_r($task->errors(),true),LOG_DEBUG);
                $this->Flash->error(__('The task could not be saved. Please, try again.'));
                $this->redirect(['controller' => 'Task', 'action' => 'index']);
            }
        }
        else{
            $this->Flash->error(__('URL直打ちはダメです'));
            $this->redirect(['controller' => 'Task', 'action' => 'index']);
        }
    }

    /**
     * Edit method
     *
     * @param string|null $id Task id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $task = $this->Task->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $task = $this->Task->patchEntity($task, $this->request->getData());
            if ($this->Task->save($task)) {
                $this->Flash->success(__('The task has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The task could not be saved. Please, try again.'));
        }
        $this->set(compact('task'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Task id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $task = $this->Task->get($id);
        if ($this->Task->delete($task)) {
            $this->Flash->success(__('The task has been deleted.'));
        } else {
            $this->Flash->error(__('The task could not be deleted. Please, try again.'));
        }

        $this->redirect(['controller' => 'TaskManage', 'action' => 'index']);
    }
}

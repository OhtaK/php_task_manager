<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Task Controller
 *
 *
 * @method \App\Model\Entity\Task[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class TaskController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $task = $this->paginate($this->Task);

        $this->set(compact('task'));
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
    public function add()
    {
        $task = $this->Task->newEntity();
        if ($this->request->is('post')) {
            $task = $this->Task->patchEntity($task, $this->request->getData());
            //echo $this->log(pr($task), LOG_DEBUG);
            //$task->id = 1;
            if ($this->Task->save($task)) {
                $this->Flash->success(__('The task has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            else{
                //エラーをdebug.logに表示
                echo $this->log(print_r($task->errors(),true),LOG_DEBUG);
                $this->Flash->error(__('失敗！ The task could not be saved. Please, try again.'));
            }
            $this->Flash->error(__('The task could not be saved. Please, try again.'));
        }
        $this->set(compact('task'));
        $this->render('/Task/index');
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

        return $this->redirect(['action' => 'index']);
    }
}

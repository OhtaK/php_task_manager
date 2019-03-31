<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Error\Debugger;
use Cake\I18n\Time;

/**
 * User Controller
 *
 * @property \App\Model\Table\UserTable $User
 *
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UsersController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index($id = null)
    {
        if(isset($id)){
            //idで検索
            $search_user = $this->Users->findById($id)->first();
            if(!isset($search_user)){
                $this->Flash->error(__('データが見つかりませんでした。'));
                $search_user['name'] = '';
                $search_user['password'] = '';
            }
        }
        else{
            $users = $this->Users->find('all');
            $search_user['name'] = '';
            $search_user['password'] = '';
        }
        $this->set(compact('users', 'search_user'));
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => ['Task']
        ]);

        $this->set('user', $user);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add($id = null)
    {
        $user = $this->Users->newEntity();
        
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if(isset($id)){
                $user['id'] = $id;
            }
            debug($user);

            if ($this->Users->save($user)) {
                if(isset($id)){
                    $this->Flash->success(__('The user has been saved.'));
                }
                else{
                    $this->Flash->success(__('The user has been added.'));
                }
                return $this->redirect(['action' => 'index']);
            }
            else{
                //エラーログをmy_app_name/logs/debug.logに出力
                echo $this->log(print_r($user->errors(),true),LOG_DEBUG);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->redirect('/users');
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(compact('user'));
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        debug($id);
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->findById($id)->first();
        
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('The user has been deleted.'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    
}

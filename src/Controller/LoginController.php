<?php
namespace App\Controller;
 
use App\Controller\AppController;
use Cake\Datasource\ConnectionManager;
use Cake\ORM\TableRegistry;
use Cake\Core\Configure;
 
class LoginController extends AppController
{
    public $uses = array('Users');

    public function initialize() {
		parent::initialize();

		$this->Task = TableRegistry::getTableLocator()->get('Task');
	}

    public function index()
    {
    }

    /**
	 * ログイン
	 */
	public function login() {
		// if (!$this->request->is('post'))
		// 	return;

		$this->Users = TableRegistry::getTableLocator()->get('Users');
		$user = $this->Auth->identify();
		if ($user) {
			$this->Auth->setUser($user);
			return $this->redirect($this->Auth->redirectUrl());
		}

		$this->Flash->error('ユーザ名またはパスワードを確認してください。');
		$this->render('/login/index');
	}

	/**
	 * ログアウト
	 */
	public function logout() {
		$this->Flash->success('ログアウトしました。');
		return $this->redirect($this->Auth->logout());
	}
}

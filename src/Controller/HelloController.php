<?php
namespace App\Controller;
 
use App\Controller\AppController;
use Cake\Datasource\ConnectionManager;
 
class HelloController extends AppController
{
 
    public function index()
    {
        $connection = ConnectionManager::get('default');
        $results = $connection->execute('SELECT * FROM user')->fetchAll();
        $existData = false;
        if(isset($results)){
            $existData = true;
        }

        $this->set('results', $results);
        $this->set('existData',$existData);
    }
}

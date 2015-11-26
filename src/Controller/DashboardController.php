<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;

/**
 * Dashboard Controller
 *
 */
class DashboardController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function perform($assignmentId)
    {
        $assignments = TableRegistry::get('Assignments');
        
        $assignment = $assignments->get($assignmentId,
                                       ['contain' => ['Inputs',
                                                      'Users'=> function ($q) {
                                                           return $q->where(['Users.id' => $this->Auth->user('id')]);
                                                       }
                                                     ]
                                       ]);
        if (count($assignment->users) > 0) {
            $this->set('assignment', $assignment);
            $this->set('concordia_enabled', $assignment->users[0]->_joinData->concordia_enabled);
        } else {
            $this->Flash->error(__('This assignment is not yours!'));
            return $this->redirect(['controller' => 'Assignments', 'action' => 'index']
    );
        }    
   }
}

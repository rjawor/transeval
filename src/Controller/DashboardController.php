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
        
        $this->set('assignment', $assignments->get($assignmentId, ['contain' => ['Inputs']]));
    }

}

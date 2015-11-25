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
        
        $assignment = $assignments->get($assignmentId, ['contain' => ['Inputs', 'Users']]);
        die(print_r($assignment, true));
        
        $this->set('assignment', $assignment);
   }
}

<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * UsersAssignments Controller
 *
 * @property \App\Model\Table\UsersAssignmentsTable $UsersAssignments
 */
class UsersAssignmentsController extends AppController
{



    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $usersAssignment = $this->UsersAssignments->newEntity();
        if ($this->request->is('post')) {
            $usersAssignment = $this->UsersAssignments->patchEntity($usersAssignment, $this->request->data);
            if ($this->UsersAssignments->save($usersAssignment)) {
                $this->Flash->success(__('The users assignment has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The users assignment could not be saved. Please, try again.'));
            }
        }
        $users = $this->UsersAssignments->Users->find('list', ['limit' => 200]);
        $assignments = $this->UsersAssignments->Assignments->find('list', ['limit' => 200]);
        $this->set(compact('usersAssignment', 'users', 'assignments'));
        $this->set('_serialize', ['usersAssignment']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Users Assignment id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $usersAssignment = $this->UsersAssignments->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $usersAssignment = $this->UsersAssignments->patchEntity($usersAssignment, $this->request->data);
            if ($this->UsersAssignments->save($usersAssignment)) {
                $this->Flash->success(__('The users assignment has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The users assignment could not be saved. Please, try again.'));
            }
        }
        $users = $this->UsersAssignments->Users->find('list', ['limit' => 200]);
        $assignments = $this->UsersAssignments->Assignments->find('list', ['limit' => 200]);
        $this->set(compact('usersAssignment', 'users', 'assignments'));
        $this->set('_serialize', ['usersAssignment']);
    }

    public function complete()
    {
        if ($this->request->is('post')) {
            $query = $this->UsersAssignments->find('all')->where(
                                                       [
                                                        'user_id'=>$this->request->data["user_id"],
                                                        'assignment_id'=>$this->request->data["assignment_id"]
                                                       ]);
            $usersAssignment = $query->first();
            $usersAssignment->completed = 1;
            if (!$this->UsersAssignments->save($usersAssignment)) {
                $this->log('The users assignment could not be saved: '.print_r($usersAssignment,true));
            }
        }
    }

    /**
     * Delete method
     *
     * @param string|null $id Users Assignment id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $usersAssignment = $this->UsersAssignments->get($id);
        if ($this->UsersAssignments->delete($usersAssignment)) {
            $this->Flash->success(__('The users assignment has been deleted.'));
        } else {
            $this->Flash->error(__('The users assignment could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}

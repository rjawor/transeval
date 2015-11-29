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
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users', 'Assignments']
        ];
        $this->set('usersAssignments', $this->paginate($this->UsersAssignments));
        $this->set('_serialize', ['usersAssignments']);
    }

    /**
     * View method
     *
     * @param string|null $id Users Assignment id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $usersAssignment = $this->UsersAssignments->get($id, [
            'contain' => ['Users', 'Assignments']
        ]);
        $this->set('usersAssignment', $usersAssignment);
        $this->set('_serialize', ['usersAssignment']);
    }

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

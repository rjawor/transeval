<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Assignments Controller
 *
 * @property \App\Model\Table\AssignmentsTable $Assignments
 */
class AssignmentsController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $query = $this->Assignments->find('all');
        $query->matching('Users', function ($q) {
            return $q->where(['Users.id' => $this->Auth->user('id')]);
        });
        $this->set('assignments', $this->paginate($query));
        $this->set('_serialize', ['assignments']);
    }
    
    public function config()
    {
        $this->paginate = [
            'contain' => ['Users']
        ];
        $this->set('assignments', $this->paginate($this->Assignments));
        $this->set('_serialize', ['assignments']);
    }

    /**
     * View method
     *
     * @param string|null $id Assignment id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $assignment = $this->Assignments->get($id, [
            'contain' => ['Inputs']
        ]);
        $this->set('assignment', $assignment);
        $this->set('_serialize', ['assignment']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $assignment = $this->Assignments->newEntity();
        if ($this->request->is('post')) {
            $assignment->name = $this->request->data['name'];
            $inputs_array = array();
            
            $pos = 0;
            foreach (explode("\n", $this->request->data['inputs']) as $sentence) {
                $sentence = trim($sentence);
                if ($sentence != '') {
                    $input = $this->Assignments->Inputs->newEntity();
                    $input->pos = $pos;
                    $input->content = $sentence;
                    array_push($inputs_array, $input);
                    $pos++;
                }
            }
            
            $assignment->inputs = $inputs_array;
            if ($this->Assignments->save($assignment)) {
                $this->Flash->success(__('The assignment has been saved.'));
                return $this->redirect(['action' => 'config']);
            } else {
                $this->Flash->error(__('The assignment could not be saved. Please, try again.'));
            }
        }
        $languages = $this->Assignments->Languages->find('list', ['limit' => 200]);
        $users = $this->Assignments->Users->find('list', ['limit' => 200]);
        $this->set(compact('assignment', 'languages', 'users'));
        $this->set('_serialize', ['assignment']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Assignment id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $assignment = $this->Assignments->get($id, [
            'contain' => ['Users']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $assignment->users = $this->Assignments->Users->find('all')->toArray();
            for ($i=0; $i<count($assignment->users); $i++) {
                $assignment->users[$i]->_joinData = $this->Assignments->UsersAssignments->newEntity();
                $assignment->users[$i]->_joinData->concordia_enabled = 
                       in_array($assignment->users[$i]->id, $this->request->data['users']['_ids']);
            }
            if ($this->Assignments->save($assignment)) {
                $this->Flash->success(__('The assignment has been saved.'));
                return $this->redirect(['action' => 'config']);
            } else {
                $this->Flash->error(__('The assignment could not be saved. Please, try again.'));
            }
        }
        $languages = $this->Assignments->Languages->find('list', ['limit' => 200]);
        $users = $this->Assignments->Users->find('list', ['limit' => 200]);
        $this->set(compact('assignment', 'languages', 'users', 'concordia_enabled'));
        $this->set('_serialize', ['assignment']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Assignment id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $assignment = $this->Assignments->get($id);
        if ($this->Assignments->delete($assignment)) {
            $this->Flash->success(__('The assignment has been deleted.'));
        } else {
            $this->Flash->error(__('The assignment could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
    
    public function thankyou() {
    
    }
}

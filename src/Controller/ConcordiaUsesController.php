<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * ConcordiaUses Controller
 *
 * @property \App\Model\Table\ConcordiaUsesTable $ConcordiaUses
 */
class ConcordiaUsesController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Targets']
        ];
        $this->set('concordiaUses', $this->paginate($this->ConcordiaUses));
        $this->set('_serialize', ['concordiaUses']);
    }

    /**
     * View method
     *
     * @param string|null $id Concordia Use id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $concordiaUse = $this->ConcordiaUses->get($id, [
            'contain' => ['Targets']
        ]);
        $this->set('concordiaUse', $concordiaUse);
        $this->set('_serialize', ['concordiaUse']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        if ($this->request->is('post')) {
            $concordiaUse = $this->ConcordiaUses->newEntity($this->request->data);
            if (!$this->ConcordiaUses->save($concordiaUse)) {
                $this->log('ConcordiaUsesController problem saving. ConcordiaUse: '.print_r($concordiaUse, true));
            }
        }

    }

    /**
     * Edit method
     *
     * @param string|null $id Concordia Use id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $concordiaUse = $this->ConcordiaUses->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $concordiaUse = $this->ConcordiaUses->patchEntity($concordiaUse, $this->request->data);
            if ($this->ConcordiaUses->save($concordiaUse)) {
                $this->Flash->success(__('The concordia use has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The concordia use could not be saved. Please, try again.'));
            }
        }
        $targets = $this->ConcordiaUses->Targets->find('list', ['limit' => 200]);
        $this->set(compact('concordiaUse', 'targets'));
        $this->set('_serialize', ['concordiaUse']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Concordia Use id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $concordiaUse = $this->ConcordiaUses->get($id);
        if ($this->ConcordiaUses->delete($concordiaUse)) {
            $this->Flash->success(__('The concordia use has been deleted.'));
        } else {
            $this->Flash->error(__('The concordia use could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}

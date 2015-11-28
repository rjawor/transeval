<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Targets Controller
 *
 * @property \App\Model\Table\TargetsTable $Targets
 */
class TargetsController extends AppController
{

    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('RequestHandler');
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        if ($this->request->is('post')) {
            $target = $this->Targets->newEntity($this->request->data);
            if ($this->Targets->save($target)) {
                $this->set(compact('target'));
                $this->set('_serialize', ['target']);
            } else {
                $this->log('TargetsController problem saving. Target: '.print_r($target, true));
            }
        }
    }


    public function accept()
    {
        $this->autorender = false;
        if ($this->request->is('post')) {
            $this->log('accept:', 'info');
            $this->log($this->request->data, 'info');
            $target = $this->Targets->get($this->request->data["target_id"]);
            $target->content = $this->request->data["content"];
            $target->accepted = true;
            if (!$this->Targets->save($target)) {
                $this->log('TargetsController problem saving. Target: '.print_r($target, true));
            }
        }    
    }

}

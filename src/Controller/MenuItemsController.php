<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Core\App;
use Cake\Core\Plugin;
use Cake\Utility\Inflector;

/**
 * MenuItems Controller
 *
 * @property \App\Model\Table\MenuItemsTable $MenuItems
 */
class MenuItemsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->MenuItems->find();
        $menuItems = $this->paginate($query);

        $this->set(compact('menuItems'));
    }

    /**
     * View method
     *
     * @param string|null $id Menu Item id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $menuItem = $this->MenuItems->get($id, contain: []);
        $this->set(compact('menuItem'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $menuItem = $this->MenuItems->newEmptyEntity();
        if ($this->request->is('post')) {
            $menuItem = $this->MenuItems->patchEntity($menuItem, $this->request->getData());
            if ($this->MenuItems->save($menuItem)) {
                $this->Flash->success(__('The menu item has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The menu item could not be saved. Please, try again.'));
        }
        $this->set(compact('menuItem'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Menu Item id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $menuItem = $this->MenuItems->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $menuItem = $this->MenuItems->patchEntity($menuItem, $this->request->getData());
            if ($this->MenuItems->save($menuItem)) {
                $this->Flash->success(__('The menu item has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The menu item could not be saved. Please, try again.'));
        }
        $this->set(compact('menuItem'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Menu Item id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $menuItem = $this->MenuItems->get($id);
        if ($this->MenuItems->delete($menuItem)) {
            $this->Flash->success(__('The menu item has been deleted.'));
        } else {
            $this->Flash->error(__('The menu item could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function generate()
    {
        $controllers = $this->getAppControllers();
        $controllerActions = [];

        foreach ($controllers as $controller) {
            $className = "App\\Controller\\{$controller}Controller";
            $methods = get_class_methods($className);
            $controllerActions[$controller] = array_filter($methods, function($method) {
                return !in_array($method, ['beforeFilter', 'initialize']) 
                    && strpos($method, '_') !== 0;
            });
        }

        if ($this->request->is('post')) {
            $data = $this->request->getData();
            $link = "/{$data['controller']}/{$data['action']}";
            $title = Inflector::humanize($data['controller']) . ' ' . Inflector::humanize($data['action']);

            if (!$this->MenuItems->exists(['link' => $link])) {
                $menuItem = $this->MenuItems->newEntity([
                    'title' => $title,
                    'link' => $link,
                    'order' => $this->getNextOrder()
                ]);

                if ($this->MenuItems->save($menuItem)) {
                    $this->Flash->success(__('Menu item generated successfully'));
                    return $this->redirect(['action' => 'index']);
                }
                $this->Flash->error(__('Could not save menu item'));
            }
        }

        $this->set(compact('controllers', 'controllerActions'));
    }

    private function getAppControllers(): array
    {
        $controllers = [];
        $files = glob(APP . 'Controller' . DS . '*.php');
        
        foreach ($files as $file) {
            $className = basename($file, '.php');
            if ($className !== 'AppController' && 
                $className !== 'ErrorController' && 
                $className !== 'PagesController') {
                $controllers[] = str_replace('Controller', '', $className);
            }
        }
        
        return $controllers;
    }

    private function getNextOrder(): int
    {
        $lastItem = $this->MenuItems->find()
            ->orderDesc('order')
            ->first();

        return $lastItem ? $lastItem->order + 1 : 1;
    }
}

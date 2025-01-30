<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\EventInterface;

class AppController extends Controller
{
    public function initialize(): void
    {
        parent::initialize();

        $this->loadComponent('Authentication.Authentication');
        $this->Authentication->addUnauthenticatedActions(['display']);
        $this->loadComponent('Flash');

        // Chargement des éléments de menu
        $menuItemsTable = $this->getTableLocator()->get('MenuItems');
        $menuItems = $menuItemsTable->find()
            ->order(['order' => 'ASC'])
            ->all();
        
        $this->set(compact('menuItems'));

        //$this->loadComponent('FormProtection');
    }
}
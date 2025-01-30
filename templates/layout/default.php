<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 * @var \App\View\AppView $this
 */

$cakeDescription = 'My Shop';
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        <?= $cakeDescription ?>:
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>

    <?= $this->Html->css(['normalize.min', 'milligram.min', 'fonts', 'cake']) ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body>
    <!-- Ajout du bouton hamburger -->
    <button class="menu-toggle"></button>

    <div class="sidebar">
        <div class="sidebar-header">
            <?= $this->Html->link('MyShop', '/', ['class' => 'brand']) ?>
        </div>
        <nav class="sidebar-menu">
            <ul>
            <!-- je garde ces liens ici afin qu'ils ne puissent pas être supprimés par inadvertance-->
            <li><?= $this->Html->link('Produits', '/products', ['class' => 'nav-link']) ?></li>
            <li><?= $this->Html->link('Utilisateurs', '/users', ['class' => 'nav-link']) ?></li>
            <li><?= $this->Html->link('Items du menu', '/menu-items', ['class' => 'nav-link']) ?></li>
                <?php foreach ($menuItems as $item): ?>
                    <li>
                        <?= $this->Html->link(
                            $item->title,
                            $item->link,
                            ['class' => 'nav-link']
                        ) ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        </nav>
    </div>
    
    <div class="main-content">
        <nav class="top-nav">
            <div class="top-nav-title">
                <a href="<?= $this->Url->build('/') ?>"><span>My</span>SHOP</a>
            </div>
            <div class="top-nav-links">
            <?php 
                $this->loadHelper('Authentication.Identity');
                if ($this->Identity->isLoggedIn()) : ?>
                    <span class="user-info">
                        <?= h($this->Identity->get('first_name')) ?> <?= h($this->Identity->get('name')) ?>
                    </span>
                    <?= $this->Html->link('Déconnexion', ['controller' => 'Users', 'action' => 'logout']) ?>
                <?php else : ?>
                    <?= $this->Html->link('Connexion', ['controller' => 'Users', 'action' => 'login']) ?>
                <?php endif; ?>
            </div>
        </nav>
        <main class="main">
            <div class="container">
                <?= $this->Flash->render() ?>
                <?= $this->fetch('content') ?>
            </div>
        </main>
    </div>
    <footer>
    </footer>

    <script>
    document.querySelector('.menu-toggle').addEventListener('click', function() {
        this.classList.toggle('active');
        document.querySelector('.sidebar').classList.toggle('active');
    });
    </script>
</body>
</html>

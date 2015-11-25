<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = 'TransEval';
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $cakeDescription ?><?php if ($this->fetch('title') != 'Pages') echo ": ".$this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>

    <?= $this->Html->css('base.css') ?>
    <?= $this->Html->css('cake.css') ?>
    <?= $this->Html->css('transeval.css') ?>
    
    <?= $this->Html->script('jquery-1.11.3.min') ?>
    <?= $this->Html->script('dashboard') ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body>
    <nav class="top-bar expanded" data-topbar role="navigation">
        <ul class="title-area large-3 medium-4 columns">
            <li class="name">
                <h1><a href=""><?php if ($this->fetch('title') != 'Pages') echo $this->fetch('title') ?></a></h1>
            </li>
        </ul>
        <section class="top-bar-section">
            <ul>
                <li><a href="/transeval/assignments">Assignments</a></li>
            </ul>
            <ul class="right">
                <li>
			    <?php
                if (is_null($this->request->session()->read('Auth.User.username'))) {
                ?>
                    <a href="/transeval/users/login">log in</a>
                <?php
                } else {
                    echo "<a href='/transeval/users/logout'>logged in as: <b>".$this->request->session()->read('Auth.User.username')."</b> (log out)</a>"; 
                }

                ?></a>
                </li>
            </ul>
        </section>
    </nav>
    <?= $this->Flash->render() ?>
    <section class="container clearfix">
        <?= $this->fetch('content') ?>
    </section>
    <footer>
    </footer>
</body>
</html>

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

$cakeDescription = 'CakePHP: the rapid development php framework';
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

    <link href="https://fonts.googleapis.com/css?family=Raleway:400,700" rel="stylesheet">
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/normalize.css@8.0.1/normalize.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <?= $this->fetch('test') ?>

    <!--icon -->

    <!-- class -->

    <?= $this->Html->css('milligram.min.css') ?>
    <?= $this->Html->css('cake.css') ?>
    <style type="text/css">
        .danhmuc{
            border:1px solid #ccc;
            border-width:1px 0;
            list-style:none;
            margin:0;
            padding:0;
            text-align:center;
        }
        .danhmuc li{
            display:inline;
        }
        .danhmuc a{
            display:inline-block;
            padding:10px;
        }
        
        .view{
            border:50px;
            background:MediumSeaGreen;
        }
        .edit{
            border:50px;
            background:Violet;
        }
        .delete{
            border:50px;
            background:Orange;
        }
        a:hover {
        color: blue;
        text-decoration: none;
        }
    </style>
    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body>
    <nav class="top-nav">
        <div class="top-nav-title">
            <a href="/"><span>Cake</span>PHP</a>
        </div>
        <div class="top-nav-links">
            <a target="_blank" href="https://book.cakephp.org/4/">Documentation</a>
            <a target="_blank" href="https://api.cakephp.org/4/">API</a>
            <?php if($user_name){ ?>
                <?= $this->Html->link("Logout", ['controller'=>'Users','action' => 'logout']);?>
            <?php } ?>
        </div>
    </nav>
    <?php
        if($user_name)
        {
            ?>
                <nav >
                <!-- Brand -->
                    <div class="top-nav-links" style="text-align:center">

                    <!-- Links -->
                    <ul class="danhmuc">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                                Users
                            </a>
                            <div class="dropdown-menu">
                                <?= $this->Html->link("List Users",['controller'=>'Users','action'=>'index'])?>
                                <?= $this->Html->link("Add User",['controller'=>'Users','action'=>'add'])?>
                            </div>
                        </li>
                        
                        <li >
                        <?= $this->Html->link("Send mail for user", ['controller'=>'Mail','action' => 'sendMailToUser']) ?>
                        </li>

                        <!-- Dropdown -->
                        <li>
                        <?= $this->Html->link("Category", ['controller'=>'Categories','action' => 'category']) ?>
                        
                        </li>
                    </ul>
                    </div>
                </nav>
            <?php
        }
    ?>
    
    <main class="main">
        <div class="container">
            <?= $this->Flash->render() ?>
            <?= $this->fetch('content') ?>
        </div>
    </main>
    <footer>
    </footer>
</body>
</html>

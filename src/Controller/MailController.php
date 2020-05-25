<?php
declare(strict_types=1);

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
 * @since         3.3.4
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use Cake\Validation\Validator;
use Cake\Event\EventInterface;
use Cake\Mailer\Mailer;

/**
 * Error Handling Controller
 *
 * Controller used by ExceptionRenderer to render error responses.
 */
class MailController extends AppController
{
    public function sendMailToUser()
    {
        if($this->request->is('post','put'))
        {
            $this->loadmodel('User');
            // $user=$this->User->newEmptyEntity();
            
            $data=$this->request->getData();
            $subject=$data["set_subject"];
            $content=$data["content"];
            $email=$this->Auth->User('email');
            
            // $Email = new CakeEmail();
            // $Email->config('gmail');

            $mailer = new Mailer('default');
            $mailer->setFrom($this->Auth->User('email'))
                ->setTo($email)
                ->setSubject($subject)
                ->deliver($content);
        }
    }
    public function sendMailOfAdmin()
    {
        
        if($this->request->is('post','put'))
        {
            $this->loadmodel('User');
            // $user=$this->User->newEmptyEntity();
            
            $data=$this->request->getData();
            $subject=$data["set_subject"];
            $content=$data["content"];
            // $Email = new CakeEmail();
            // $Email->config('gmail');

            $mailer = new Mailer('default');
            $mailer->setFrom($this->Auth->User('email'))
                ->setTo('thao19011999@gmail.com')
                ->setSubject($subject)
                ->deliver($content);
        }
    }
}

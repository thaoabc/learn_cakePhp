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

use Cake\Event\EventInterface;

/**
 * Error Handling Controller
 *
 * Controller used by ExceptionRenderer to render error responses.
 */
class LoginController extends AppController
{
    public function login()
    {
      
      // $this->loadModel('User');
      // echo 1;die;
      // $User =$this->User->newEntity();
      // echo 1;die;
      // $data = [
      //     'id' => $this->Auth->user('id'),
      // ];
      // pr($data);die;
      // $User = $this->User->patchEntity($User,$data);
      // //dd($User);die;
      // $this->set('users',$this->User->find('all'));

      $this->loadModel('User');

      if($this->request->is('post','put'))
      {
        $User =$this->User->get($id);
        
      }

      $this->set('database',$User);
    }

    public function view($id)
    {
      $user = $this->Users
      ->get($id);

      $this->set('user', $user);
    }

    public function add()
    {
      $user = $this->Users->newEmptyEntity();
        if ($this->request->is('post','put')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());

            // Hardcoding the user_id is temporary, and will be removed later
            // when we build authentication out.
            //$user->id = 1;

            if ($this->Users->save($user)) {
                $this->Flash->success(__('Your User has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Unable to add your User.'));
        }
        $this->set('user', $user);
    }

    public function edit($id)
    {
        $user = $this->Users
            ->get($id);
        if ($this->request->is(['post', 'put'])) {
            $user=$this->Users->patchEntity($user, $this->request->getData());
            
            if ($this->Users->save($user)) {
                $this->Flash->success(__('Your User has been updated.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Unable to update your User.'));
        }
        $this->set('User', $user);
    }

    public function delete($id)
    {
      $user = $this->Users
            ->get($id);
            if ($this->Users->delete($user))
            {
              $this->Flash->success(__('Your User has been updated.'));
              return $this->redirect(['action' => 'index']);
            }

            $this->Flash->error(__('Unable to update your User.'));
        $this->set('User', $user);
    }
}

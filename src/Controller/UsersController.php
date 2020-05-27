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

use App\Controller\Session;
use Cake\Validation\Validator;
use Cake\Event\EventInterface;
use Cake\Mailer\Mailer;
use Cake\Routing\Router;

/**
 * Error Handling Controller
 *
 * Controller used by ExceptionRenderer to render error responses.
 */
class UsersController extends AppController
{

  public function login()
  {
    $this->loadModel('User');
      if($this->request->is('post','put'))
      {
        //$user = $this->User->newEmptyEntity();
        $user = $this->Auth->identify();
        if($user)
        {
          $this->Auth->setUser($user);
          //if($this->)
          $this->Flash->success("You are logged in");
          return $this->redirect(['controller'=>'Users','action'=>'index']);
        }
        else
        {
          return $this->Flash->error("You entered the wrong account");
        }
      }
  }

  public function logout()
  {
    $this->Flash->success("You are logged out");
    $this->Auth->logout();
    return $this->redirect(['controller' => 'Users', 'action' => 'login']);
    //return $this->redirect($this->Auth->logout());
  }
  public function index()
  {
    $this->loadModel('User');
    $key=$this->request->getQuery('key');
    if($key)
    {
      $query=$this->Users->find('all')->where(['Or'=>['user_name like'=>'%'.$key.'%','email like'=>'%'.$key.'%']]);
    }
    else
    {
      $query=$this->User->find('all')
                        ->order(['id DESC']);
    }

    if($this->request->is('ajax')){

      // $user_add = $this->User->newEntity($this->request->getData(),['validate' => 'update']);
      // if($user_add->getErrors())
      // {
      //   $this->set('errors',$user_add->getErrors());
      // }
      // else
      // {
        $files = $this->request->getData('image_file');
        $name=$files->getClientFileName();
        $targetPath='img/uploads/'.$name;
        if($name)
        {
          $files->moveTo($targetPath);
        }
        $user = $this->User->newEmptyEntity();
        $user->user_name=$this->request->getData('user_name');
        $user->email=$this->request->getData('email');
        $user->password=$this->request->getData('password');
        $user->position=$this->request->getData('position');
        $user->image=$name;
        if ($this->User->save($user)) 
        {
            $this->NoticeSingupSuccess($user->email);
            echo json_encode($result, $user);
            // wp_send_json_success(array(
            //   'amount' => $user
            // ));
        }
      //}
      
    }

    $this->set('database',$this->paginate($query,['limit'=>'3']));
  }

  public function view($id)
  {
    if($this->request->is('post'))
    {
      echo $this->Users
      ->get($id);
      $this->autoRender = false;
    }
    else
    {
      $user = $this->Users
      ->get($id);
  
      $this->set('user', $user);
    }
  }
  public function testAdd()
  {
    $this->loadModel('User');
    if($this->request->is('ajax')){

      // $user_add = $this->User->newEntity($this->request->getData(),['validate' => 'update']);
      // if($user_add->getErrors())
      // {
      //   $this->set('errors',$user_add->getErrors());
      // }
      // else
      // {
        $files = $this->request->getData('image_file');
        $name=$files->getClientFileName();
        $targetPath='img/uploads/'.$name;
        if($name)
        {
          $files->moveTo($targetPath);
        }
        $user = $this->User->newEmptyEntity();
        $user->user_name=$this->request->getData('user_name');
        $user->email=$this->request->getData('email');
        $user->password=$this->request->getData('password');
        $user->position=$this->request->getData('position');
        $user->image=$name;
        if ($this->User->save($user)) 
        {
            $this->NoticeSingupSuccess($user->email);
            $this->response->body($user);
        }
        else
        {
          $error="Not Inserted,Some Probelm occur.";
          echo ($error);
        }
      //}
      
    }
    else
    {
      $error="Not Inserted,Some Probelm occur.";
              echo ($error);
    }
  }

  public function add()
  {
    if($this->_isAdmin()!=true)
    {
      $this->Flash->error(__('Bạn không có quyền truy cập'));
      return $this->redirect(['action' => 'index']);
    }
    $this->loadModel('User');
    $user = $this->User->newEmptyEntity();
      if ($this->request->is('post','put')) 
      {
        $user_add = $this->User->newEntity($this->request->getData(),['validate' => 'update']);

        if ($user_add->getErrors()) 
        {
          $this->set('errors', $user_add->getErrors());
        }
        else
        {
            $email=$this->request->getData('email');
            $checkmail=$this->User->find()->select()->where(['email'=>$email])->first();
            if(isset($checkmail))
            { 
              $this->Flash->error(__('Tài khoản này đã tồn tại'));
            }
            else
            {
              $user=$this->User->patchEntity($user, $this->request->getData());
           
              $files = $this->request->getData('image_file');
            
              $name=$files->getClientFileName();
              
              $targetPath='img/uploads/'.$name;
              if($name)
              {
                $files->moveTo($targetPath);
              }
              $user->image=$name;
              if ($this->User->save($user)) 
              {
                  $this->Flash->success(__('Your User has been saved.'));
                  $this->NoticeSingupSuccess($user->email);
                  return $this->redirect(['action' => 'index']);
              }
              $this->Flash->error(__('Unable to add your User.'));
            }
        }
      }
  }

  public function edit($id)
  {
    if($this->_isAdmin()!=true)
    {
      $this->Flash->error(__('Bạn không có quyền truy cập'));
      return $this->redirect(['action' => 'index']);
    }
    $this->loadModel('User');
      $user = $this->User
          ->get($id);
      
      $this->set('User', $user);
      if ($this->request->is(['post', 'put','submit'])) {
        $user_add = $this->User->newEntity($this->request->getData(),['validate' => 'update']);
        if ($user_add->getErrors()) {
          $this->set('errors', $user_add->getErrors());
          return $this->redirect(['action' => 'add']);
        }
        else
        {
          $user=$this->User->patchEntity($user, $this->request->getData());

            $files = $this->request->getData('image_file');
            
            $name=$files->getClientFileName();
            
            $targetPath='img/uploads/'.$name;
            if($name)
            {
              $files->moveTo($targetPath);
            }
            $user->image=$name;
          
            if ($this->User->save($user)) {
                $this->Flash->success(__('Your User has been updated.'));
                return $this->redirect(['action' => 'index']);
            }
            else
            {
              $this->Flash->error(__('Unable to update your User.'));
            }
        }
      }
      else
      {
        $this->set('errors', null);
      }
  }

  public function delete($id)
  {
    if($this->_isAdmin()!=true)
    {
      $this->Flash->error(__('Bạn không có quyền truy cập'));
      return $this->redirect(['action' => 'index']);
    }
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

  function _isAdmin(){
    $admin = FALSE;
    $this->loadModel('User');
    $role=$this->User->find()
    ->select('position')->where(['email'=>$this->Auth->User('email')])->first();
    //debug($role->position);
    if($role->position==0)
        $admin = TRUE;
    //dd($admin);
    return $admin; 
  }

  function NoticeSingupSuccess($email)
  {
    if($this->request->is('post','put'))
        {
            $this->loadmodel('User');

            $mailer = new Mailer('default');
            $mailer->setFrom($this->Auth->User('email'))
                ->setTo($email)
                ->setSubject("Bạn đã đăng ký thành công")
                ->deliver("Welcome to my home");
        }
  }
  function resetPassword()
  {
    if($this->request->is('post','put') && !empty($this->request->getData('email')))
    {
      $this->loadmodel('User');
      $user = $this->User->newEmptyEntity();
      $data=$this->request->getData();
      $email=$data["email"];
      $passkey = uniqid();
      $url=Router::url(['action'=>'sendNewPass',$passkey]);
      $user=$this->User->find()->select()->where(['email'=>$email])->first();
      $user->token=$passkey;
      //$this->loadHelper('Html');
      //$a=$this->Html->link("click",['controller'=>'Users','action'=>'sendNewPass',$passkey, 'target' => '_blank']);
      if($this->User->save($user))
      {
        $mailer = new Mailer('default');
        $mailer->setFrom('thao19011999@gmail.com')
            ->setTo($email)
            ->setSubject("Reset your password")
            ->deliver($passkey);
        if ($mailer->send()) 
        {
          
          echo json_encode($result,'success');
          //return $this->redirect(['action'=>'login']);
        } 
        else 
        {
            $this->Flash->error(__('Error sending email: ') . $email->smtpError);
        }
      }
    }
  }
  function sendNewPass()
  {
    if($this->request->is('post','put'))
    {
      $data=$this->request->getData();
      if(isset($data['checkkey']))
      {
        $this->loadModel("User");
        $passkey=$data['checkkey'];
        if($this->User->find("all")->where(['token'=>$passkey])->first())
        {
          $this->set('passkey',$passkey);
        }
        else
        {
          $this->redirect(['action'=>'resetPassword']);
          $this->Flash->error(__('Nhập không đúng mã'));
        }
      }
      else
      {
        $this->loadModel("User");
        $passkey=$data['passkey'];
        if($this->User->find("all")->where(['token'=>$passkey])->first())
        {
          $user_resetpass = $this->User->newEntity($this->request->getData(),['validate' => 'ResetPass']);
          if($user_resetpass->getErrors())
          { 
            $error=$user_resetpass->getErrors();
            $this->set('errors',$error);
            $this->set('passkey',$passkey);
            $this->Flash->error(__('Chưa thay được mật khẩu'));
          }
          else
          {
            $user=$this->User->find()->select()->where(['token'=>$passkey])->first();
            $user->password=$data['password'];
            pr($data['password']);
            pr($user->password);
            if($this->User->save($user))
            {
              dd($user);
              $this->Flash->success(__('Đăng nhập vào tài khoản của bạn với mật khẩu mới'));
              return $this->redirect(['action'=>'login']);
            }
            else
            {
              $this->Flash->error(__('Chưa thay được mật khẩu'));
              $this->set('passkey',$passkey);
            }
          }
        }
      }
    }
  }

  public function destroytoken()
  {
    if($this->request->is('ajax')){
      $this->loadModel('User');
      $email_token=$this->request->getData('email_token');
      $user_pass=$this->User->find()->select()->where(['email'=>$email_token])->first();
      $user_pass->token='';
      if($this->User->save($user_pass))
      {
        echo json_encode($result, $user_pass);
        wp_die(); 
      }
    }
  }
}

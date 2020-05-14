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

/**
 * Error Handling Controller
 *
 * Controller used by ExceptionRenderer to render error responses.
 */
class UsersController extends AppController
{

  public function login()
  {

    //   if($this->request->is('post','put')){
    //     $user_name = $_POST['user_name'];
        //  $email = $_POST['email'];
        //  $password=$_POST['password'];

    //     $this->loadModel('User');

    //     $user=$this->User->getInfor($user_name,$email,$password);

    //     if($user){
    //       $position=$this->Users->find()
    //       ->select('position')->where(['email'=>$email]);
    //       dd($position=='admin');
    //       Session::write(User.position, $position);
    //      //$this->Session->write("session",$user_name); //ghi session
    //      $this->redirect(['action' => 'index']);//đăng nhập thành công chuyển trang thông tin
    //     }else{
    //       return $this->Flash->error("You entered the wrong account");
    //     }
    //  }
    $this->loadModel('User');
      if($this->request->is('post','put'))
      {
        //$user = $this->User->newEmptyEntity();
        $user = $this->Auth->identify();
        if($user)
        {
          $this->Auth->setUser($user);
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
    $this->Auth->logout();
    return $this->redirect(['controller' => 'Pages', 'action' => 'display','home']);
    //return $this->redirect($this->Auth->logout());
  }
  public function index()
  {

    $this->loadModel('User');
    $User =$this->User->getData();

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
          return $this->redirect(['action' => 'add']);
        }
        else
        {
          $user = $this->User->patchEntity($user, $this->request->getData());

          if(!$user->getErrors)
          {
            $files = $this->request->getData('image_file');
            
            // Read the file data.
            // $files->getStream();
            // $files->getSize();
            $name=$files->getClientFileName();
            
            $targetPath=WWW_ROOT.'img'.DS.$name;
            if($name)
            {
              $files->moveTo($targetPath);
            }
            $user->image=$name;
          
            if ($this->User->save($user)) 
            {
                $this->Flash->success(__('Your User has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Unable to add your User.'));
          }
          else
          {
            $this->set('errors', $user_add->getErrors());
            return $this->redirect(['action' => 'add']);
          }
        }
      }
      else
      {
        $this->set('errors',null);
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
      if ($this->request->is(['post', 'put'])) {
        $user_add = $this->User->newEntity($this->request->getData(),['validate' => 'update']);
        if ($user_add->getErrors()) {
          $this->set('errors', $user_add->getErrors());
          return $this->redirect(['action' => 'add']);
        }
        else
        {
          $user=$this->User->patchEntity($user, $this->request->getData());

          if(!$user->getErrors)
          {
            $files = $this->request->getData('image_file');
            
            // Read the file data.
            // $files->getStream();
            // $files->getSize();
            $name=$files->getClientFileName();
            
            $targetPath=WWW_ROOT.'img'.DS.$name;
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
          else
          {
            $this->set('errors', $user_add->getErrors());
            return $this->redirect(['action' => 'index']);
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
}

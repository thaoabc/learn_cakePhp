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
class CategoriesController extends AppController
{
  public function category()
  {
    $this->loadmodel('Category');
    $this->set('all_list',$this->Category->all_list());
    $this->set('categories',$this->Category->get_category());
  }
  function add() {
    $this->loadmodel('Category');
    if (!empty($this->request->getData())) {
      $category=$this->Category->newEntity($this->request->getData(),['validate'=>'add']);
      if($category->getErrors())
      {
        $this->set('errors',$category->getErrors());
      }
      else
      {
        $category=$this->Category->newEmptyEntity();
        $category=$this->Category->patchEntity($category,$this->request->getData());
        if($this->Category->save($category))
        {
           $this->Flash->success('Thêm thành công');
           return $this->redirect(['action'=>'category']);
        }
      }
    }
    else
    {
      $this->set('categories',$this->Category->get_category());
    }
  }
  
  public function edit($id)
  {
    $this->loadmodel('Category');
    if (!empty($this->request->getData())) {
      $category=$this->Category->newEntity($this->request->getData(),['validate'=>'add']);
      if($category->getErrors())
      {
        $this->set('errors',$category->getErrors());
      }
      else
      {
        $category=$this->Category->get($id);
        $category->name=$this->request->getData('name');
        if(empty($this->request->getData('parent_id')))
        {
          $category->parent_id=0;
        }
        else
        {
          $category->parent_id=$this->request->getData('parent_id');
        }
        //$category=$this->Category->patchEntity($category,$this->request->getData());
        if($this->Category->save($category))
        {
           $this->Flash->success('Sửa thành công');
           return $this->redirect(['action'=>'category']);
        }
      }
    }
    else
    {
      $category=$this->Category->get($id);
      $this->set('data',$category);
      $this->set('categories',$this->Category->get_category());
    }
  }

  public function delete($id)
  {
    $this->loadmodel('Category');
    $category=$this->Category->get($id);
    if($this->Category->delete($category))
    {
      $this->Flash->success('Xóa thành công');
      return $this->redirect(['action'=>'category']);
    }
  }
}

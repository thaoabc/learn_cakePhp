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
    $this->set('Categories', $this->Category->find("all"));
    $this->set('list_cat',$this->Category->generateTreeList());
  }
  
}

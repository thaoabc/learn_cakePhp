<?php
namespace App\Model\Table;

use Cake\Validation\Validator;
use Cake\ORM\Table;

class CategoryTable extends Table
{
    public function initialize(array $config): void
    {
        $this->setTable('categories');
        $this->addBehavior('Tree');
    }

    public function all_list()
    {
        $descendants = $this->find('all');

        return($descendants);
    }

    public function get_category()
    {
        $query = $this->find('treeList', [
            'keyPath' => 'id',
            'valuePath'=>'name'
        ])
        ->toArray();
        
        // $query_id=$this->find()
        // ->select('parent_id');
        // foreach($query as $item)
        // {
        //     foreach($query_id as $id)
        //     {
        //         //dd($id['parent_id']);
        //         if(isset($query[$id['parent_id']]))
        //         {
        //             echo $item;
        //         }
        //     }
            
        // }
        return($query);
    }

    public function validationAdd($validator)
    {
        $validator
            ->minLength('name',2,__('Tên phải ít nhất 2 kí tự'))
            ->maxLength('name',25,__('Tên nhập tối đa 25 kí tự'))
            ->notEmpty('name', __('Điền thông tin đầy đủ'));

        return $validator;
    }
}
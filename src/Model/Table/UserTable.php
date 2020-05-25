<?php
namespace App\Model\Table;

use Cake\Validation\Validator;
use Cake\ORM\Table;

class UserTable extends Table
{
    public function initialize(array $config): void
    {
        $this->setTable('users');
    }
    public function getData()
    {
        $query = $this->find()
        ->select()->all();
        return $query;
    }

    public function getInfor($user_name,$email,$password)
    {
         $query=$this->find()
         ->where(['user_name' => $user_name,'email'=>$email,'password'=>$password])->first();
        if($query){
            return true;
        }else{
            return false;
        }
    }

    public function validationUpdate($validator)
    {
        $validator
            ->scalar('user_name', __('You need to provide a name of user'))
            ->maxLength('user_name',25)
            ->notEmpty('user_name', __('You need to provide a name of user'));
        $validator
            ->scalar('email', __('You need to provide a name of user'))
            ->notEmpty('email', __('A email is required'))
            ->requirePresence('email','create')
            ->notEmpty('password',__('A password to protect for your account'));
        $validator
            ->notEmptyFile('image')
            ->add('image',[
                'mimeType'=>[
                'rule'=>['fileSize','<=','1MB'],
                'message'=>'Image file size must be less than 1MB.',
                ],
            ]);

        return $validator;
    }

    public function validationResetPass($validator)
    {
        $validator
            ->maxLength('password',6)
            ->notEmpty('Password',__("Hãy nhập mật khẩu"));
        $validator
            ->add('confirm_password', 'no-misspelling', [
                'rule' => ['compareWith', 'password'],
                'message' => 'Mật khẩu không trùng khớp',
            ]);

        return $validator;
    }
}
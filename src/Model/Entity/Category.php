<?php
namespace App\Model\Entity;

use Cake\Auth\DefaultPasswordHasher;
use Cake\ORM\Entity;

/**
 * User Entity
 *
 * @property int $id
 * @property int $user_id
 * @property string $type
 * @property array $entry
 * @property array $meta
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\User $user
 */
class Category extends Entity
{

/**
 * Fields that can be mass assigned using newEntity() or patchEntity().
 *
 * Note that when '*' is set to true, this allows all unspecified fields to
 * be mass assigned. For security purposes, it is advised to set '*' to false
 * (or remove it), and explicitly make individual fields accessible as needed.
 *
 * @var array
 */
    protected $_accessible = [
        '*' => true,
        'id' => false
    ];

    // protected function _setPassword($password)
    // {
    //     if (strlen($password) > 0) {
    //       return (new DefaultPasswordHasher)->hash($password);
    //     }
    // }

    protected function _setPassword($password)
    {
        if (strlen($password) > 0) {
            return (new DefaultPasswordHasher)->hash($password);
        }
    }
    
}
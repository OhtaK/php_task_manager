<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Task Entity
 *
 * @property int $id
 * @property string|null $name
 * @property int|null $user_id
 * @property \Cake\I18n\FrozenTime $limit_date
 * @property int $status
 * @property int|null $priority_id
 * @property string|null $description
 * @property \Cake\I18n\FrozenTime $create_date
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Priority $priority
 */
class Task extends Entity
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
        'name' => true,
        'user_id' => true,
        'limit_date' => true,
        'status' => true,
        'priority_id' => true,
        'description' => true,
        'create_date' => true,
        'user' => true,
        'priority' => true
    ];
}

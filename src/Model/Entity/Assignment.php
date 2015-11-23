<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Assignment Entity.
 *
 * @property int $id
 * @property int $source_lang_id
 * @property int $target_lang_id
 * @property \App\Model\Entity\Language $language
 * @property string $name
 * @property \Cake\I18n\Time $created
 * @property \App\Model\Entity\User[] $users
 */
class Assignment extends Entity
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
        'id' => false,
    ];
}

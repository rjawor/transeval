<?php
namespace App\Model\Table;

use App\Model\Entity\Target;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Targets Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Inputs
 * @property \Cake\ORM\Association\BelongsTo $Users
 */
class TargetsTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->table('targets');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('Inputs', [
            'foreignKey' => 'input_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER'
        ]);
        
        $this->addBehavior('Timestamp');
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->add('id', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('id', 'create');

        $validator
            ->allowEmpty('content');

        $validator
            ->add('started', 'valid', ['rule' => 'datetime'])
            ->allowEmpty('started');

        $validator
            ->add('accepted', 'valid', ['rule' => 'datetime'])
            ->allowEmpty('ended');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['input_id'], 'Inputs'));
        $rules->add($rules->existsIn(['user_id'], 'Users'));
        return $rules;
    }
}

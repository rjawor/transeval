<?php
namespace App\Model\Table;

use App\Model\Entity\ConcordiaUse;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ConcordiaUses Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Targets
 */
class ConcordiaUsesTable extends Table
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

        $this->table('concordia_uses');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('Targets', [
            'foreignKey' => 'target_id',
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
            ->allowEmpty('fragment');

        $validator
            ->add('word_count', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('word_count');

        $validator
            ->allowEmpty('overlay_score');

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
        $rules->add($rules->existsIn(['target_id'], 'Targets'));
        return $rules;
    }
}

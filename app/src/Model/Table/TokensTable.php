<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Tokens Model
 *
 * @property \App\Model\Table\AirdropsTable&\Cake\ORM\Association\HasMany $Airdrops
 *
 * @method \App\Model\Entity\Token newEmptyEntity()
 * @method \App\Model\Entity\Token newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Token[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Token get($primaryKey, $options = [])
 * @method \App\Model\Entity\Token findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Token patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Token[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Token|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Token saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Token[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Token[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Token[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Token[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class TokensTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('tokens');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('Airdrops', [
            'foreignKey' => 'token_id',
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->scalar('network')
            ->maxLength('network', 15)
            ->requirePresence('network', 'create')
            ->notEmptyString('network');

        $validator
            ->scalar('address')
            ->maxLength('address', 36)
            ->requirePresence('address', 'create')
            ->notEmptyString('address');

        $validator
            ->integer('identifier')
            ->requirePresence('identifier', 'create')
            ->notEmptyString('identifier');

        return $validator;
    }
}

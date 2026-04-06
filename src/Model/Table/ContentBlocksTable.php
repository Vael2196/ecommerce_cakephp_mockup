<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\ORM\Behavior\TreeBehavior;

/**
 * ContentBlocks Model
 *
 * @property \App\Model\Table\ContentBlocksTable&\Cake\ORM\Association\BelongsTo $ParentContentBlocks
 * @property \App\Model\Table\ContentBlocksTable&\Cake\ORM\Association\HasMany $ChildContentBlocks
 *
 * @method \App\Model\Entity\ContentBlock newEmptyEntity()
 * @method \App\Model\Entity\ContentBlock newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\ContentBlock> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ContentBlock get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\ContentBlock findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\ContentBlock patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\ContentBlock> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\ContentBlock|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\ContentBlock saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\ContentBlock>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\ContentBlock>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\ContentBlock>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\ContentBlock> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\ContentBlock>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\ContentBlock>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\ContentBlock>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\ContentBlock> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ContentBlocksTable extends Table
{
    /**
     * Initialize method
     *
     * @param array<string, mixed> $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('content_blocks');
        $this->setDisplayField('label');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

//        $this->addBehavior('Tree');

        // Relations
        $this->belongsTo('ParentContentBlocks', [
            'className' => 'ContentBlocks',
            'foreignKey' => 'parent_id',
        ]);
        $this->hasMany('ChildContentBlocks', [
            'className' => 'ContentBlocks',
            'foreignKey' => 'parent_id',
            'dependent' => true,
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
            ->notEmptyString('page')
            ->notEmptyString('label')
            ->inList('type', ['text','html','image']);

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->existsIn(['parent_id'], 'ParentContentBlocks'), ['errorField' => 'parent_id']);

        return $rules;
    }
}

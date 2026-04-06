<?php

declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * CartProducts Model
 *
 * @property \App\Model\Table\CartsTable&\Cake\ORM\Association\BelongsTo $Carts
 * @property \App\Model\Table\ProductsTable&\Cake\ORM\Association\BelongsTo $Products
 *
 * @method \App\Model\Entity\CartProduct newEmptyEntity()
 * @method \App\Model\Entity\CartProduct newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\CartProduct> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\CartProduct get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\CartProduct findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\CartProduct patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\CartProduct> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\CartProduct|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\CartProduct saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\CartProduct>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\CartProduct>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\CartProduct>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\CartProduct> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\CartProduct>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\CartProduct>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\CartProduct>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\CartProduct> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class CartProductsTable extends Table
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

        $this->setTable('cart_products');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Carts', [
            'foreignKey' => 'cart_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Products', [
            'foreignKey' => 'product_id',
            'joinType' => 'INNER',
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
            ->integer('cart_id')
            ->notEmptyString('cart_id');

        $validator
            ->integer('product_id')
            ->notEmptyString('product_id');

        $validator
            ->integer('product_quantity')
            ->notEmptyString('product_quantity');

        $validator
            ->decimal('subtotal')
            ->notEmptyString('subtotal');

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
        $rules->add($rules->existsIn(['cart_id'], 'Carts'), ['errorField' => 'cart_id']);
        $rules->add($rules->existsIn(['product_id'], 'Products'), ['errorField' => 'product_id']);

        return $rules;
    }
}

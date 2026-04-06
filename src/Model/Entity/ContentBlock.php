<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ContentBlock Entity
 *
 * @property int $id
 * @property string $page
 * @property int|null $parent_id
 * @property string $type
 * @property string $label
 * @property string|null $value
 * @property string|null $previous_value
 * @property \Cake\I18n\DateTime $created
 * @property \Cake\I18n\DateTime|null $updated
 *
 * @property \App\Model\Entity\ParentContentBlock $parent_content_block
 * @property \App\Model\Entity\ChildContentBlock[] $child_content_blocks
 */
class ContentBlock extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array<string, bool>
     */
    protected array $_accessible = [
        'page' => true,
        'parent_id' => true,
        'type' => true,
        'label' => true,
        'value' => true,
        'previous_value' => true,
        'created' => true,
        'updated' => true,
        'parent_content_block' => true,
        'child_content_blocks' => true,
    ];
}

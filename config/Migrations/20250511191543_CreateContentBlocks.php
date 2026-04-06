<?php
declare(strict_types=1);

use Migrations\BaseMigration;

class CreateContentBlocks extends BaseMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * https://book.cakephp.org/migrations/4/en/migrations.html#the-change-method
     * @return void
     */
    public function change(): void
    {
        if (!$this->hasTable('content_blocks')) {
            $table = $this->table('content_blocks');
            $table
                ->addColumn('page', 'string', [
                    'limit' => 100,
                    'null' => false,
                ])
                ->addColumn('parent_id', 'integer', [
                    'null' => true,
                    'default' => null,
                ])
                ->addColumn('type', 'string', [
                    'limit' => 50,
                    'default' => 'text',
                    'null' => false,
                ])
                ->addColumn('label', 'string', [
                    'limit' => 255,
                    'null' => false,
                ])
                ->addColumn('value', 'text', [
                    'null' => true,
                    'default' => null,
                ])
                ->addColumn('previous_value', 'text', [
                    'null' => true,
                    'default' => null,
                ])
                ->addTimestamps()
                ->addForeignKey(
                    'parent_id',
                    'content_blocks',
                    'id',
                    ['delete'=> 'CASCADE', 'update'=> 'NO_ACTION']
                )
                ->create();
        }
    }
}

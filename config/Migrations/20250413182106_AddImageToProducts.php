<?php
declare(strict_types=1);

use Migrations\BaseMigration;

class AddImageToProducts extends BaseMigration
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
        $table = $this->table('products');
        $table->addColumn('image', 'string', [
            'limit' => 255,
            'null' => true,
            'default' => null,
        ])
            ->update();
    }
}

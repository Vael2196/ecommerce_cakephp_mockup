<?php
declare(strict_types=1);

use Migrations\BaseMigration;

class AddRespondedToMessages extends BaseMigration
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
        $table = $this->table('messages');
        $table->
        addColumn('responded', 'boolean', [
            'default' => false,
            'null' => false,
        ])->update();
    }
}

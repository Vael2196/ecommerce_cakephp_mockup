<?php
declare(strict_types=1);

use Migrations\BaseSeed;
use Authentication\PasswordHasher\DefaultPasswordHasher;

/**
 * AdminUserSeed seed.
 */
class AdminUserSeedSeed extends BaseSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeds is available here:
     * https://book.cakephp.org/migrations/4/en/seeding.html
     *
     * @return void
     */
    public function run(): void
    {
        $data = [
            [
                'username' => 'MoN1sh',
                'email' => 'merchmanagercrunchycravings@gmail.com',
                'password' => (new DefaultPasswordHasher())->hash('Adm1nL4V0sh'),
                'role' => 1,
                'created' => date('Y-m-d H:i:s'),
                'modified' => date('Y-m-d H:i:s'),
            ]
        ];

        $table = $this->table('users');
        $table->insert($data)->save();
    }
}

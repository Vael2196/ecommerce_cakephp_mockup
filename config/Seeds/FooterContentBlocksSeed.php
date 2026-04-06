<?php
declare(strict_types=1);

use Migrations\BaseSeed;

/**
 * FooterContentBlocks seed.
 */
class FooterContentBlocksSeed extends BaseSeed
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
                'page' => 'footer',
                'parent_id' => null,
                'label' => 'Address',
                'value' => '12944 Reichert Port, New Tyler, VT 82635',
                'created' => date('Y-m-d H:i:s'),
                'updated' => date('Y-m-d H:i:s'),
            ],
            [
                'page' => 'footer',
                'parent_id' => null,
                'label' => 'Phone',
                'value' => '03 9999 9999',
                'created' => date('Y-m-d H:i:s'),
                'updated' => date('Y-m-d H:i:s'),
            ],
        ];
        $this->table('content_blocks')->insert($data)->save();
    }
}

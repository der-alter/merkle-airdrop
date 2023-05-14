<?php

declare(strict_types=1);

use Cake\Collection\Collection;
use Migrations\AbstractSeed;

/**
 * User seed.
 */
class UserSeed extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeds is available here:
     * https://book.cakephp.org/phinx/0/en/seeding.html
     *
     * @return void
     */
    public function run(): void
    {
        $this->execute('SET foreign_key_checks=0');
        $this->execute('TRUNCATE TABLE users');
        $this->execute('SET foreign_key_checks=1');

        $json = file_get_contents(ROOT . '/../infra/testdata/drops.json');
        $data = (new Collection(json_decode($json)))
            ->map(fn ($drop) => ['address' => $drop->pkh, 'created' => date('Y-m-d H:i:s'),])
            ->toArray();

        $table = $this->table('users');
        $table->insert($data)->save();
    }
}

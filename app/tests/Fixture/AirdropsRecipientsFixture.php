<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * AirdropsRecipientsFixture
 */
class AirdropsRecipientsFixture extends TestFixture
{
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'id' => 1,
                'airdrop_id' => 1,
                'recipient_id' => 1,
                'amount' => 1,
                'claimed' => 1688938384,
            ],
        ];
        parent::init();
    }
}

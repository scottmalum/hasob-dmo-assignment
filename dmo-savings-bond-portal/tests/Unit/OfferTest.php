<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Schema;
use PHPUnit\Framework\TestCase;

class OfferTest extends TestCase
{
    use RefreshDatabase, WithFaker;
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_offers_table_has_expected_columns()
    {
        $this->assertTrue(
            Schema::hasColumns('sb_offers',[
                'id',
                'organization_id',
                'status',
                'offer_title',
                'price_per_unit',
                'max_units_per_investor',
                'interest_rate_pct',
                'offer_start_date',
                'offer_end_date',
                'offer_settlement_date',
                'offer_maturity_date',
                'tenor_years'
            ]));
    }
}

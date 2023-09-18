<?php

namespace App\Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use DMO\SavingsBond\Models\Offer;

class BondOfferFactory extends Factory
{
     /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Offer::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            // 'offer_title' => $this->faker->name,
            // 'status' => 'active',
            // 'organization_id' => $this->faker->uuid(),
            // 'price_per_unit' => $this->faker->numberBetween(1,100000000),
            // 'max_units_per_investor' => $this->faker->numberBetween(1,100000000),
            // 'interest_rate_pct' => $this->faker->numberBetween(0,100),
            // 'offer_start_date' => Carbon::parse('09/19/2023'),
            // 'offer_end_date' => Carbon::parse('04/31/2024'),
            // 'offer_settlement_date' => Carbon::parse('09/19/2027'),
            // 'offer_maturity_date' => Carbon::parse('09/19/2030'),
            // 'tenor_years' => $this->faker->numberBetween(1,10)

        'organization_id' => $this->faker->word,
        'display_ordinal' => $this->faker->randomDigitNotNull,
        'status' => $this->faker->word,
        'wf_status' => $this->faker->word,
        'wf_meta_data' => $this->faker->text,
        'offer_title' => $this->faker->word,
        'price_per_unit' => $this->faker->word,
        'max_units_per_investor' => $this->faker->randomDigitNotNull,
        'interest_rate_pct' => $this->faker->word,
        'offer_start_date' => $this->faker->date('Y-m-d H:i:s'),
        'offer_end_date' => $this->faker->date('Y-m-d H:i:s'),
        'offer_settlement_date' => $this->faker->date('Y-m-d H:i:s'),
        'offer_maturity_date' => $this->faker->date('Y-m-d H:i:s'),
        'tenor_years' => $this->faker->randomDigitNotNull,
        // 'created_at' => $this->faker->date('Y-m-d H:i:s'),
        // 'updated_at' => $this->faker->date('Y-m-d H:i:s'),
            
        ];
    }
}

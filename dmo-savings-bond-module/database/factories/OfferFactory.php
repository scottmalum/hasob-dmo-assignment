<?php

namespace Database\Factories;

use Carbon\Carbon;
use DMO\SavingsBond\Models\Offer;
use Illuminate\Database\Eloquent\Factories\Factory;
use Hasob\FoundationCore\Models\Organization;

class OfferFactory extends Factory
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
        'organization_id' => $this->faker->word,
        // 'display_ordinal' => $this->faker->randomDigitNotNull,
        'status' => $this->faker->word,
        'wf_status' => $this->faker->word,
        'wf_meta_data' => $this->faker->text,
        'offer_title' => $this->faker->word,
        'price_per_unit' => $this->faker->numberBetween(1,100000),
        'max_units_per_investor' => $this->faker->numberBetween(1,100000),
        'interest_rate_pct' => $this->faker->randomFloat(2),
        'offer_start_date' => Carbon::parse('09/19/2023'),
        'offer_end_date' => Carbon::parse('04/31/2024'),
        'offer_settlement_date' => Carbon::parse('09/19/2027'),
        'offer_maturity_date' => Carbon::parse('09/19/2030'),
        'tenor_years' => $this->faker->numberBetween(1,10),
        // 'created_at' => $this->faker->date('Y-m-d H:i:s'),
        // 'updated_at' => $this->faker->date('Y-m-d H:i:s'),
        ];
    }
}

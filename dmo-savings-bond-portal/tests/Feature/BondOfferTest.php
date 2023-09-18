<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use Hash;
use Carbon\Carbon;
use DMO\SavingsBond\Models\Offer;
use Hasob\FoundationCore\Models\User;
use Hasob\FoundationCore\Models\Department;
use Hasob\FoundationCore\Models\Organization;

class BondOfferTest extends TestCase
{
    use RefreshDatabase;

    protected $test_org_id;
    protected $user;

    protected function setUp(): void
    {
        parent::setUp();
        
        $this->test_org_id = Organization::create([
            'org' => 'app',
            'domain' => 'test',
            'full_url' => 'www.app.test',
            'subdomain' => 'sub',
            'is_local_default_organization' => true,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ])->id;

        $this->user = User::factory()->create([
            'organization_id' => $this->test_org_id
        ]);
    
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_an_action_that_requires_authentication()
    {
        $response = $this->actingAs($this->user)->get('/sb/offers/index');

        $response->assertSee('Offers');
    }

    public function test_a_new_offer_can_be_created()
    {
        $data = [
            'offer_title' => 'Student Loan',
            'organization_id' => $this->user->organization_id,
            'status' => 'active',
            'price_per_unit' => 100000,
            'max_units_per_investor' => 100,
            'interest_rate_pct' => 30,
            'offer_start_date' => Carbon::parse('09/19/2023'),
            'offer_end_date' => Carbon::parse('04/31/2024'),
            'offer_settlement_date' => Carbon::parse('09/19/2027'),
            'offer_maturity_date' => Carbon::parse('09/19/2030'),
        ];

        $response = $this->actingAs($this->user)->post('/sb/offers/store',$data);
        $response->assertSeeTextInOrder(['More Information','Quick Links']);
    }

    public function test_a_single_offer_can_be_viewed()
    {
        $offer = Offer::factory()->create([
            'offer_title' => 'Student Loan',
            'organization_id' => $this->test_org_id,
        ]);

        $this->actingAs($this->user)->get('/sb/offers/'.$offer->id);
        $result = Offer::find($offer->id);
        // dump($offer->offer_title);
        $this->assertEquals($result->offer_title, $offer->offer_title);
    }

    public function test_user_table_contains_a_given_number_of_records()
    {
        User::factory()->count(3)->create(['organization_id' => $this->test_org_id]);
        // 5 records due to admin that was seeded to the DB and the user created for authenticaion in the setup()
        $this->assertDatabaseCount('fc_users',5);
    }

    public function test_offer_records()
    {
        Offer::factory()->count(3)->create(['organization_id' => $this->test_org_id]);
        $this->assertDatabaseCount('sb_offers',3);

    }

    // public function test_update_offer()
    // {
    //     $offer = Offer::factory()->create([
    //         'offer_title' => 'Student Loan',
    //         'organization_id' => $this->test_org_id,
    //     ]);

    //     $data = [
    //         'offer_title' => 'Student Loan Fees',
    //         'organization_id' => $this->user->organization_id,
    //         'status' => 'active',
    //         'price_per_unit' => 100000,
    //     ];

    //     $response = $this->actingAs($this->user)->put('/sb/offers/'.$offer->id,$data);
    //     // $response->assertSeeTextInOrder(['More Information','Quick Links']);
    //     $response->assertRedirect('/sb/offers');

    // }

    // public function test_delete_offer(){
    //     $offer = Offer::factory()->create([
    //         'offer_title' => 'Student Loan',
    //         'organization_id' => $this->test_org_id,
    //     ]);

    //     $response = $this->actingAs($this->user)->delete('/sb/offers/'.$offer->id);

    //     $response->assertSeeText('More Information');

    // }

    public function test_edit_offer_route()
    {
        $offer = Offer::factory()->create([
            'offer_title' => 'Student Loan',
            'organization_id' => $this->test_org_id,
        ]);

        $response = $this->actingAs($this->user)->get('/sb/offers/'.$offer->id.'/edit');
        
        
        $response->assertSee('Offer Details');
    }
}

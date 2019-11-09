<?php

namespace Tests\Feature;

use App\Models\Address;
use App\Models\Offer;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class OfferTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     * @test
     * @return void
     */
    public function attach_address_to_offer()
    {
        $address = factory(Address::class)->create();
        /** @var Offer $offer */
        $offer = factory(Offer::class)->create();
        $offer->addresses()->attach($address);

        $this->assertEquals(1, $offer->addresses->count());
    }
}

<?php

namespace Tests\Feature;

use App\Models\Address;
use App\Models\Resource;
use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class resourceTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     * @test
     * @return void
     */
    public function attach_address_to_resource()
    {
        $address = factory(Address::class)->create();
        /** @var Resource $resource */
        $resource = factory(Resource::class)->create();
        $resource->addresses()->attach($address);
        $resource->owner->addresses()->attach($address);

        $this->assertEquals(1, $resource->addresses->count());
        $this->assertDatabaseHas('addressables', [
        	'address_id' => $address->id,
        	'addressable_id' => $resource->id,
			'addressable_type' => Resource::class
		]);

		$this->assertDatabaseHas('addressables', [
			'address_id' => $address->id,
			'addressable_id' => $resource->owner->id,
			'addressable_type' => User::class
		]);
    }
}

<?php

namespace Tests\Api;

use Tests\ApiTestCase;
use App\Http\Controllers\Api\ApiController;

class ApiAdressesTest extends ApiTestCase
{
    public function test_address_get_contacts()
    {
        $user = $this->signin();
        $contact = factory('App\Contact')->create(['account_id' => $user->account->id]);
        $address = factory('App\Address')->create([
            'account_id' => $user->account->id,
            'contact_id' => $contact->id,
            'name' => 'address name',
            'street' => 'street',
            'postal_code' => '12345',
            'country' => 'FR'
            ]);

        $response = $this->json('GET', '/api/contacts');

        $response->assertStatus(200);
        $response->assertJsonFragment([
            'object' => 'address',
            'id' => $address->id,
            'name' => 'address name',
            'country' => [
                'object' => 'country',
                'id' => 'FR',
                'name' => 'France',
                'iso' => 'FR'
            ],
            'street' => 'street',
            'postal_code' => '12345',
        ]);
    }

    public function test_address_get_contactid()
    {
        $user = $this->signin();
        $contact = factory('App\Contact')->create(['account_id' => $user->account->id]);
        $address = factory('App\Address')->create([
            'account_id' => $user->account->id,
            'contact_id' => $contact->id,
            'name' => 'address name',
            'street' => 'street',
            'postal_code' => '12345',
            'country' => 'FR'
            ]);

        $response = $this->json('GET', '/api/contacts/'.$contact->id);

        $response->assertStatus(200);
        $response->assertJsonFragment([
            'object' => 'address',
            'id' => $address->id,
            'name' => 'address name',
            'country' => [
                'object' => 'country',
                'id' => 'FR',
                'name' => 'France',
                'iso' => 'FR'
            ],
            'street' => 'street',
            'postal_code' => '12345',
        ]);
    }

    public function test_address_get_contactid_address()
    {
        $user = $this->signin();
        $contact = factory('App\Contact')->create(['account_id' => $user->account->id]);
        $address = factory('App\Address')->create([
            'account_id' => $user->account->id,
            'contact_id' => $contact->id,
            'name' => 'address name',
            'street' => 'street',
            'postal_code' => '12345',
            'country' => 'FR'
            ]);

        $response = $this->json('GET', '/api/contacts/'.$contact->id.'/addresses');

        $response->assertStatus(200);
        $response->assertJsonFragment([
            'object' => 'address',
            'id' => $address->id,
            'name' => 'address name',
            'country' => [
                'object' => 'country',
                'id' => 'FR',
                'name' => 'France',
                'iso' => 'FR'
            ],
            'street' => 'street',
            'postal_code' => '12345',
        ]);
    }


    public function test_address_get_addressid()
    {
        $user = $this->signin();
        $contact = factory('App\Contact')->create(['account_id' => $user->account->id]);
        $address = factory('App\Address')->create([
            'account_id' => $user->account->id,
            'contact_id' => $contact->id,
            'name' => 'address name',
            'street' => 'street',
            'postal_code' => '12345',
            'country' => 'FR'
            ]);

        $response = $this->json('GET', '/api/addresses/'.$address->id);

        $response->assertStatus(200);
        $response->assertJsonFragment([
            'object' => 'address',
            'id' => $address->id,
            'name' => 'address name',
            'country' => [
                'object' => 'country',
                'id' => 'FR',
                'name' => 'France',
                'iso' => 'FR'
            ],
            'street' => 'street',
            'postal_code' => '12345',
        ]);
    }
}

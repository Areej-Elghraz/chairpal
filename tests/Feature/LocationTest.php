<?php

namespace Tests\Feature;

use App\Enums\TokenAbilityEnum;
use App\Models\City;
use App\Models\Country;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LocationTest extends TestCase
{
    use RefreshDatabase;

    protected function authenticate()
    {
        $user = User::factory()->create();
        $token = $user->createToken('test-token', [TokenAbilityEnum::ACCESS_TOKEN->value])->plainTextToken;
        return ['Authorization' => 'Bearer ' . $token];
    }

    public function test_can_create_country()
    {
        $headers = $this->authenticate();
        $response = $this->postJson('/api/countries', ['name' => 'Test Country'], $headers);

        $response->assertStatus(201)
                 ->assertJsonPath('data.name', 'Test Country');
        
        $this->assertDatabaseHas('countries', ['name' => 'Test Country']);
    }

    public function test_can_update_country()
    {
        $headers = $this->authenticate();
        $country = Country::create(['name' => 'Old Name']);

        $response = $this->putJson("/api/countries/{$country->id}", ['name' => 'New Name'], $headers);

        $response->assertStatus(200)
                 ->assertJsonPath('data.name', 'New Name');
                 
        $this->assertDatabaseHas('countries', ['id' => $country->id, 'name' => 'New Name']);
    }

    public function test_can_delete_country()
    {
        $headers = $this->authenticate();
        $country = Country::create(['name' => 'To Delete']);

        $response = $this->deleteJson("/api/countries/{$country->id}", [], $headers);

        $response->assertStatus(200);
        $this->assertDatabaseMissing('countries', ['id' => $country->id]);
    }

    public function test_can_list_countries()
    {
        $headers = $this->authenticate();
        Country::create(['name' => 'C1']);
        Country::create(['name' => 'C2']);

        $response = $this->getJson('/api/countries', $headers);

        $response->assertStatus(200)
                 ->assertJsonCount(2, 'data');
    }

    public function test_can_create_city()
    {
        $headers = $this->authenticate();
        $country = Country::create(['name' => 'Country for City']);
        
        $response = $this->postJson('/api/cities', [
            'name' => 'Test City',
            'country_id' => $country->id
        ], $headers);

        $response->assertStatus(201)
                 ->assertJsonPath('data.name', 'Test City')
                 ->assertJsonPath('data.country_id', $country->id);
                 
        $this->assertDatabaseHas('cities', ['name' => 'Test City']);
    }

    public function test_can_update_city()
    {
        $headers = $this->authenticate();
        $country = Country::create(['name' => 'Country']);
        $city = City::create(['name' => 'Old City', 'country_id' => $country->id]);

        $response = $this->putJson("/api/cities/{$city->id}", [
            'name' => 'New City',
            'country_id' => $country->id
        ], $headers);

        $response->assertStatus(200)
                 ->assertJsonPath('data.name', 'New City');
                 
        $this->assertDatabaseHas('cities', ['id' => $city->id, 'name' => 'New City']);
    }

    public function test_can_delete_city()
    {
        $headers = $this->authenticate();
        $country = Country::create(['name' => 'Country']);
        $city = City::create(['name' => 'City to Delete', 'country_id' => $country->id]);

        $response = $this->deleteJson("/api/cities/{$city->id}", [], $headers);

        $response->assertStatus(200);
        $this->assertDatabaseMissing('cities', ['id' => $city->id]);
    }

    public function test_can_list_cities()
    {
        $headers = $this->authenticate();
        $country = Country::create(['name' => 'Country']);
        City::create(['name' => 'City 1', 'country_id' => $country->id]);
        City::create(['name' => 'City 2', 'country_id' => $country->id]);

        $response = $this->getJson('/api/cities', $headers);

        $response->assertStatus(200)
                 ->assertJsonCount(2, 'data');
    }
}

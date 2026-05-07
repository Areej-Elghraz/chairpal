<?php

namespace Tests\Feature;

use App\Models\Place;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class VisitorTrackingTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_record_visit_only_once()
    {
        $user = User::factory()->create(['email_verified_at' => now()]);
        $place = Place::factory()->create();

        Sanctum::actingAs($user, [\App\Enums\TokenAbilityEnum::ACCESS_TOKEN->value]);

        // First visit
        $response = $this->postJson("/api/places/{$place->id}/visit");
        $response->assertStatus(201);
        $this->assertEquals(1, $place->visitors()->count());

        // Second visit
        $response = $this->postJson("/api/places/{$place->id}/visit");
        $response->assertStatus(201);
        $this->assertEquals(1, $place->visitors()->count());
    }

    public function test_top_visitors_attribute_returns_first_three()
    {
        $place = Place::factory()->create();
        $users = User::factory()->count(5)->create();

        foreach ($users as $user) {
            $place->visitors()->attach($user->id, ['created_at' => now()->addSeconds($users->search($user))]);
        }

        $place = $place->fresh();
        $this->assertCount(3, $place->top_visitors);
        $this->assertEquals($users[0]->id, $place->top_visitors[0]->id);
    }

    public function test_visitors_count_is_appended_by_default()
    {
        // Create an organization user to own the place
        $orgUser = User::factory()->create(['role' => \App\Enums\UserRoleEnum::ORGANIZATION->value]);
        $place = Place::factory()->create(['owner_id' => $orgUser->id]);
        
        $users = User::factory()->count(2)->create(['email_verified_at' => now()]);
        $place->visitors()->attach($users->pluck('id'));

        Sanctum::actingAs($users[0], [\App\Enums\TokenAbilityEnum::ACCESS_TOKEN->value]);

        $response = $this->getJson("/api/places/{$place->id}");
        $response->assertStatus(200);
        $response->assertJsonPath('data.visitorsCount', 2);
    }
}

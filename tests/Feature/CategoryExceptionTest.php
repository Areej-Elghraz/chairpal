<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Laravel\Sanctum\Sanctum;

class CategoryExceptionTest extends TestCase
{
    use RefreshDatabase;

    public function test_duplicate_category_creation_returns_localized_error()
    {
        $user = User::factory()->create();
        Sanctum::actingAs($user, ['access_token']);

        // Create initial category
        Category::create([
            'name' => 'electronics',
            'owner_id' => $user->id,
        ]);

        // Try to create duplicate
        $response = $this->postJson('/api/categories', [
            'name' => 'Electronics', // Should be normalized to lowercase
            'image' => \Illuminate\Http\UploadedFile::fake()->image('cat.jpg'),
        ]);

        $response->assertStatus(409)
            ->assertJson([
                'message' => 'Category already exists!',
            ]);
    }

    public function test_duplicate_category_creation_returns_localized_error_in_german()
    {
        $user = User::factory()->create();
        Sanctum::actingAs($user, ['access_token']);

        // Create initial category
        Category::create([
            'name' => 'books',
            'owner_id' => $user->id,
        ]);

        // Try to create duplicate with German headers
        $response = $this->postJson('/api/categories', [
            'name' => 'Books',
            'image' => \Illuminate\Http\UploadedFile::fake()->image('cat.jpg'),
        ], ['Accept-Language' => 'de']);

        $response->assertStatus(409)
            ->assertJson([
                'message' => 'Kategorie existiert bereits!',
            ]);
    }
}

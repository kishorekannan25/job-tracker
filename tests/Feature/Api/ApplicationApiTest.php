<?php

namespace Tests\Feature\Api;

use App\Models\Application;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class ApplicationApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_a_user_can_log_in_and_get_a_token(): void
    {
        $user = User::factory()->create(['password' => 'secret123']);

        $this->postJson('/api/login', [
            'email' => $user->email,
            'password' => 'secret123',
        ])->assertOk()->assertJsonStructure(['token']);
    }

    public function test_login_fails_with_the_wrong_password(): void
    {
        $user = User::factory()->create(['password' => 'secret123']);

        $this->postJson('/api/login', [
            'email' => $user->email,
            'password' => 'wrong',
        ])->assertUnauthorized();
    }

    public function test_guests_cannot_list_applications(): void
    {
        $this->getJson('/api/applications')->assertUnauthorized();
    }

    public function test_users_only_get_their_own_applications(): void
    {
        $me = User::factory()->create();
        $someoneElse = User::factory()->create();

        Application::factory()->for($me)->create(['company' => 'My Company']);
        Application::factory()->for($someoneElse)->create(['company' => 'Their Company']);

        Sanctum::actingAs($me);

        $this->getJson('/api/applications')
            ->assertOk()
            ->assertJsonCount(1, 'data')
            ->assertJsonPath('data.0.company', 'My Company');
    }

    public function test_an_application_can_be_created(): void
    {
        $user = User::factory()->create();
        Sanctum::actingAs($user);

        $this->postJson('/api/applications', [
            'company' => 'Petronas Digital',
            'role' => 'Junior Developer',
            'status' => 'applied',
            'applied_date' => '2026-10-26',
        ])->assertCreated()->assertJsonPath('data.company', 'Petronas Digital');

        $this->assertDatabaseHas('applications', [
            'company' => 'Petronas Digital',
            'user_id' => $user->id,
        ]);
    }

    public function test_a_user_cannot_update_someone_elses_application(): void
    {
        $me = User::factory()->create();
        $theirs = Application::factory()->create(['company' => 'Their Company']);

        Sanctum::actingAs($me);

        $this->putJson("/api/applications/{$theirs->id}", [
            'company' => 'Changed',
            'role' => 'Tester',
            'status' => 'offer',
            'applied_date' => '2026-10-26',
        ])->assertForbidden();

        $this->assertDatabaseHas('applications', [
            'id' => $theirs->id,
            'company' => 'Their Company',
        ]);
    }
}

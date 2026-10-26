<?php

namespace Tests\Feature;

use App\Models\Application;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ApplicationTest extends TestCase
{
    use RefreshDatabase;

    public function test_guests_are_redirected_to_login(): void
    {
        $this->get('/applications')->assertRedirect('/login');
    }

    public function test_users_only_see_their_own_applications(): void
    {
        $me = User::factory()->create();
        $someoneElse = User::factory()->create();

        Application::factory()->for($me)->create(['company' => 'My Company']);
        Application::factory()->for($someoneElse)->create(['company' => 'Their Company']);

        $this->actingAs($me)
            ->get('/applications')
            ->assertOk()
            ->assertSee('My Company')
            ->assertDontSee('Their Company');
    }

    public function test_an_application_is_stored_against_the_logged_in_user(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)->post('/applications', [
            'company' => 'Petronas Digital',
            'role' => 'Junior Developer',
            'status' => 'applied',
            'applied_date' => '2026-10-14',
        ])->assertRedirect('/applications');

        $this->assertDatabaseHas('applications', [
            'company' => 'Petronas Digital',
            'user_id' => $user->id,
        ]);
    }

    public function test_company_is_required(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)->post('/applications', [
            'company' => '',
            'role' => 'Developer',
            'status' => 'applied',
            'applied_date' => '2026-10-14',
        ])->assertSessionHasErrors('company');

        $this->assertDatabaseCount('applications', 0);
    }

    public function test_a_user_cannot_view_someone_elses_application(): void
    {
        $application = Application::factory()->create();
        $intruder = User::factory()->create();

        $this->actingAs($intruder)
            ->get('/applications/'.$application->id)
            ->assertForbidden();
    }

    public function test_a_user_cannot_delete_someone_elses_application(): void
    {
        $application = Application::factory()->create();
        $intruder = User::factory()->create();

        $this->actingAs($intruder)
            ->delete('/applications/'.$application->id)
            ->assertForbidden();

        $this->assertDatabaseHas('applications', ['id' => $application->id]);
    }
}

<?php

namespace Tests\Feature;

use App\Models\Application;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DashboardTest extends TestCase
{
    use RefreshDatabase;

    public function test_guests_are_redirected_to_login(): void
    {
        $this->get('/dashboard')->assertRedirect('/login');
    }

    public function test_dashboard_counts_only_my_applications_by_status(): void
    {
        $me = User::factory()->create();
        $someoneElse = User::factory()->create();

        Application::factory()->for($me)->count(2)->create(['status' => 'interview']);
        Application::factory()->for($me)->create(['status' => 'offer']);
        Application::factory()->for($someoneElse)->count(5)->create(['status' => 'interview']);

        $response = $this->actingAs($me)->get('/dashboard');

        $response->assertOk();
        $response->assertViewHas('total', 3);
        $response->assertViewHas('counts', function ($counts) {
            return $counts['interview'] == 2
                && $counts['offer'] == 1
                && ! isset($counts['rejected']);
        });
    }
}

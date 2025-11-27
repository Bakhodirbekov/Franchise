<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminRoleAssignmentTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_assign_operator_role_to_user()
    {
        // Create an admin user
        $admin = User::factory()->create([
            'role' => 'admin'
        ]);

        // Create a regular user
        $user = User::factory()->create([
            'role' => 'user'
        ]);

        // Admin assigns operator role to user
        $response = $this->actingAs($admin)
            ->put("/admin/users/{$user->id}", [
                'role' => 'operator'
            ]);

        // Assert the response redirects correctly
        $response->assertRedirect('/admin/users');
        $response->assertSessionHas('success');

        // Refresh the user model from database
        $user->refresh();

        // Assert the user now has operator role
        $this->assertEquals('operator', $user->role);
    }

    public function test_user_with_operator_role_can_access_operator_panel()
    {
        // Create a user with operator role
        $user = User::factory()->create([
            'role' => 'operator'
        ]);

        // Try to access operator dashboard
        $response = $this->actingAs($user)
            ->get('/operator');

        // Should be able to access the operator panel
        $response->assertStatus(200);
    }

    public function test_user_with_user_role_cannot_access_operator_panel()
    {
        // Create a user with user role
        $user = User::factory()->create([
            'role' => 'user'
        ]);

        // Try to access operator dashboard
        $response = $this->actingAs($user)
            ->get('/operator');

        // Should be redirected to home with error
        $response->assertRedirect('/');
        $response->assertSessionHas('error');
    }
}
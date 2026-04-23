<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Member;

class MemberTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_sends_email_with_credentials_when_member_is_created()
    {
        // Create an admin user to bypass authentication
        $admin = User::factory()->create([
            'role' => 'admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('password')
        ]);

        // Authenticate as admin
        $this->actingAs($admin);

        // Arrange
        $data = [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'membership_type' => 'basic',
            'expiry_date' => now()->addYear(),
            'trainor_id' => null,
        ];

        // Act
        $response = $this->post(route('members.store'), $data);

        // Assert
        $response->assertRedirect(route('members.list'));
        $this->assertDatabaseHas('members', [
            'email' => 'john@example.com',
        ]);
        $this->assertDatabaseHas('users', [
            'email' => 'john@example.com',
            'role' => 'member'
        ]);
    }
}

<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AdminAuthTest extends TestCase
{
    use RefreshDatabase;

    public function test_guests_are_redirected_to_the_admin_login_page(): void
    {
        $this->get(route('admin.dashboard'))->assertRedirect(route('login'));
        $this->get(route('admin.products.index'))->assertRedirect(route('login'));
    }

    public function test_admin_can_sign_in_and_sign_out(): void
    {
        $admin = User::factory()->create([
            'email' => 'admin@example.test',
            'password' => 'correct-horse-battery-staple',
            'is_admin' => true,
        ]);

        $this->post(route('admin.login.store'), [
            'email' => $admin->email,
            'password' => 'correct-horse-battery-staple',
        ])->assertRedirect(route('admin.dashboard'));

        $this->assertAuthenticatedAs($admin);
        $this->get(route('admin.dashboard'))->assertOk();

        $this->post(route('admin.logout'))->assertRedirect(route('login'));
        $this->assertGuest();
        $this->get(route('admin.dashboard'))->assertRedirect(route('login'));
    }

    public function test_invalid_credentials_and_non_admin_users_cannot_sign_in(): void
    {
        $admin = User::factory()->create(['is_admin' => true]);
        $this->from(route('login'))
            ->post(route('admin.login.store'), [
                'email' => $admin->email,
                'password' => 'incorrect-password',
            ])
            ->assertRedirect(route('login'))
            ->assertSessionHasErrors('email');
        $this->assertGuest();

        $user = User::factory()->create(['is_admin' => false]);
        $this->from(route('login'))
            ->post(route('admin.login.store'), [
                'email' => $user->email,
                'password' => 'password',
            ])
            ->assertRedirect(route('login'))
            ->assertSessionHasErrors('email');

        $this->actingAs($user)->get(route('admin.dashboard'))->assertForbidden();
    }

    public function test_admin_creation_command_saves_a_hashed_admin_password(): void
    {
        $this->artisan('admin:create')
            ->expectsQuestion('Nama admin', 'Faza Admin')
            ->expectsQuestion('Email admin', 'owner@fazacoffee.local')
            ->expectsQuestion('Password admin (minimal 12 karakter)', 'local-demo-password')
            ->expectsQuestion('Ulangi password', 'local-demo-password')
            ->expectsOutputToContain('Akun admin owner@fazacoffee.local siap digunakan.')
            ->assertExitCode(0);

        $admin = User::where('email', 'owner@fazacoffee.local')->firstOrFail();
        $this->assertTrue($admin->is_admin);
        $this->assertTrue(Hash::check('local-demo-password', $admin->password));
    }
}

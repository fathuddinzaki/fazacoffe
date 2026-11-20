<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class CreateAdminUser extends Command
{
    protected $signature = 'admin:create {--name=} {--email=} {--password-env=}';

    protected $description = 'Create or update a Faza Coffee administrator account';

    public function handle(): int
    {
        $name = trim((string) ($this->option('name') ?: $this->ask('Nama admin')));
        $email = trim((string) ($this->option('email') ?: $this->ask('Email admin')));

        if ($name === '' || filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
            $this->error('Nama dan alamat email yang valid wajib diisi.');

            return self::FAILURE;
        }

        $passwordEnv = $this->option('password-env');
        $password = $passwordEnv
            ? getenv($passwordEnv)
            : $this->secret('Password admin (minimal 12 karakter)');
        $confirmation = $passwordEnv
            ? $password
            : $this->secret('Ulangi password');

        if (! is_string($password) || strlen($password) < 12 || $password !== $confirmation) {
            $this->error('Password harus minimal 12 karakter dan kedua input harus sama.');

            return self::FAILURE;
        }

        User::updateOrCreate(
            ['email' => $email],
            ['name' => $name, 'password' => $password, 'is_admin' => true],
        );

        $this->info("Akun admin {$email} siap digunakan.");

        return self::SUCCESS;
    }
}

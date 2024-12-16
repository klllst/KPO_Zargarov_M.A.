<?php

namespace App\Console\Commands;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Console\Command;

class CreateAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:create-admin';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create admin account';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $name = $this->ask('Введите имя Администратора');

        $admin = Admin::create([
            'name' => $name,
        ]);

        $user = User::create([
            'email' => 'admin' . $admin->id . '@mail.ru',
            'password' => 'password',
        ]);

        $admin->user()->save($user);

        $this->info('Admin created successfully!');
        $this->info('email = ' . $user->email);
        $this->info('password = password');
    }
}

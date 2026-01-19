<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class CreateAdminCommand extends Command
{
    protected $signature = 'admin:create';
    protected $description = 'Create default admin user';

    public function handle()
    {
        $admin = Admin::firstOrCreate(
            ['email' => 'admin@seemas.com'],
            [
                'name' => 'Admin',
                'password' => Hash::make('admin123')
            ]
        );

        $this->info('Admin created successfully!');
        $this->info('Email: admin@seemas.com');
        $this->info('Password: admin123');

        return 0;
    }
}
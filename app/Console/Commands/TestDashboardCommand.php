<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Auth;
use App\User;

class TestDashboardCommand extends Command
{
    protected $signature = 'test:dashboard';
    protected $description = 'Test the dashboard logic to find where it crashes';

    public function handle()
    {
        $user = User::where('id', '!=', 1)->first();
        if (!$user) {
            $this->error('No non-admin user found.');
            return;
        }

        Auth::login($user);
        $this->info('Logged in as ' . $user->username);
        
        $controller = app(\App\Http\Controllers\DashboardController::class);
        $this->info('Controller instantiated');
        
        try {
            $controller->index();
            $this->info('Dashboard loaded successfully!');
        } catch (\Throwable $e) {
            $this->error($e->getMessage() . ' in ' . $e->getFile() . ':' . $e->getLine());
        }
    }
}

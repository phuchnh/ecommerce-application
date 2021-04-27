<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class MakeAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:admin';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create administrator';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     * @throws \Throwable
     */
    public function handle()
    {
        $name = $this->ask('Name?');
        $email = $this->ask('Email?');
        $password = $this->ask('Password?');
        $user = User::make(compact('name', 'email', 'password'));
        $user->forceFill([
            'is_admin' => true,
            'email_verified_at' => $user->freshTimestamp(),
        ]);
        $user->saveOrFail();
    }
}

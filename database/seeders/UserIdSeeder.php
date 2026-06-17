<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserIdSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::whereNull('user_id')->get();

        foreach ($users as $user) {
            $user->update([
                'user_id' => 'USR' . str_pad($user->id, 6, '0', STR_PAD_LEFT)
            ]);
        }
    }
}

<?php

use Spatie\Permission\Models\Role;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::truncate();
        User::truncate();
        //Storage::disk('public')->deleteDirectory('');

        $adminRole = Role::create(['name' => 'Admin']);
        $writerRole = Role::create(['name' => 'Writer']);

        $admin = new User;
        $admin->name = 'Carlos';
        $admin->email = 'iescierva.carlos@gmail.com';
        $admin->password = bcrypt('123456');

        $admin->save();

        $admin->assignRole($adminRole);

        $writer = new User;
        $writer->name = 'Antonio';
        $writer->email = 'iescierva.antonio@gmail.com';
        $writer->password = bcrypt('123456');

        $writer->save();

        $writer->assignRole($writerRole);
    }
}

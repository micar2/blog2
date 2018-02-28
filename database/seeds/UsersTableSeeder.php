<?php

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
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
        Permission::truncate();
        Role::truncate();
        User::truncate();
        //Storage::disk('public')->deleteDirectory('');

        $adminRole = Role::create(['name' => 'Admin']);
        $writerRole = Role::create(['name' => 'Writer']);
        $editorRole = Role::create(['name' => 'Editor']);

        $viewPostsPermission = Permission::create(['name' => 'View posts']);
        $viewPostsPermission = Permission::create(['name' => 'Create posts']);
        $viewPostsPermission = Permission::create(['name' => 'Update posts']);
        $viewPostsPermission = Permission::create(['name' => 'Delete posts']);

        factory(User::class)->create([
            'name' => 'Carlos',
            'email' => 'iescierva.carlos@gmail.com'
        ])->assignRole($adminRole);

        factory(User::class,30)->create()->each->assignRole($writerRole);

        factory(User::class,19)->create()->each->assignRole($editorRole);
    }
}

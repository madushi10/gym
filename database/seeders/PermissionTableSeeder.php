<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'course-list',
            'course-create',
            'course-edit',
            'course-delete',
            'fine-list',
            'fine-create',
            'fine-edit',
            'fine-delete',
            'news-list',
            'news-create',
            'news-edit',
            'news-delete',
            'role-list',
            'role-create',
            'role-edit',
            'role-delete',
            'user-list',
            'user-create',
            'user-edit',
            'user-delete',
            'student-list',
            'student-create',
            'student-edit',
            'student-delete',

        ];

        foreach ($permissions as $permission) {
             Permission::create(['name' => $permission]);
        }
    }

}

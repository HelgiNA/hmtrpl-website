<?php

// database/seeders/DatabaseSeeder.php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Division;
use App\Models\Member;
use App\Models\Post;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Buat User Admin
        $adminUser = User::factory()->admin()->create([
            'password' => Hash::make('password'), // Ganti dengan password aman
        ]);

        // 2. Buat Divisi & Kategori terlebih dahulu (tabel induk)
        $divisions  = Division::factory(5)->create();
        $categories = Category::factory(4)->create();

        // 3. Buat 10 User biasa, dan untuk setiap user, buatkan data member-nya
        User::factory(10)->create([
            'password' => Hash::make('password'),
        ])->each(function ($user) use ($divisions) {
            Member::factory()->create([
                'user_id'     => $user->id,
                'email'       => $user->email, // Pastikan emailnya sama
                'division_id' => $divisions->random()->id,
            ]);
        });

        // 4. Buat 20 Post, penulisnya diambil dari admin atau user random
        $users = User::all();
        Post::factory(20)->create([
            'author_id'   => $users->random()->id,
            'category_id' => $categories->random()->id,
        ]);
    }
}

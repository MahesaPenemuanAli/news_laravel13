<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\AuthorProfile;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Menu;
use App\Models\MenuItem;
use App\Models\Poll;
use App\Models\PollOption;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Buat Role
        $adminRole = \Spatie\Permission\Models\Role::firstOrCreate(['name' => 'super_admin', 'guard_name' => 'web']);
        $reporterRole = \Spatie\Permission\Models\Role::firstOrCreate(['name' => 'reporter', 'guard_name' => 'web']);

        $admin = User::factory()->create([
            'name' => 'Super Admin',
            'email' => 'admin@news.com',
            'password' => bcrypt('admin123'),
        ]);
        $admin->assignRole($adminRole);

        // Buat Reporter
        $reporterNames = ['Aisyah Putri', 'Budi Santoso', 'Citra Dewi'];
        $reporters = collect();
        foreach ($reporterNames as $name) {
            $reporter = User::factory()->create([
                'name' => $name,
                'email' => Str::slug($name, '.') . '@news.com',
            ]);
            $reporter->assignRole($reporterRole);
            $reporters->push($reporter);
        }

        // Buat AuthorProfile untuk setiap reporter
        $bios = [
            'Jurnalis investigasi berpengalaman dengan spesialisasi di bidang politik dan kebijakan publik. Telah menulis lebih dari 500 artikel selama 10 tahun berkarir.',
            'Reporter ekonomi dan bisnis yang berdedikasi menghadirkan analisis mendalam tentang tren pasar dan perkembangan ekonomi Indonesia.',
            'Penulis teknologi dan digital lifestyle. Mengikuti perkembangan AI, startup, dan transformasi digital Indonesia.',
        ];
        $expertises = ['Politik & Kebijakan', 'Ekonomi & Bisnis', 'Teknologi & Digital'];

        foreach ($reporters as $index => $reporter) {
            AuthorProfile::create([
                'user_id' => $reporter->id,
                'bio' => $bios[$index],
                'expertise' => $expertises[$index],
                'photo' => null,
                'twitter_url' => 'https://twitter.com/' . Str::slug($reporter->name),
                'facebook_url' => 'https://facebook.com/' . Str::slug($reporter->name),
                'instagram_url' => null,
            ]);
        }

        // Buat Kategori
        $categoryData = [
            ['name' => 'Nasional', 'is_featured' => true],
            ['name' => 'Internasional', 'is_featured' => true],
            ['name' => 'Bisnis', 'is_featured' => true],
            ['name' => 'Teknologi', 'is_featured' => true],
            ['name' => 'Olahraga', 'is_featured' => false],
            ['name' => 'Hiburan', 'is_featured' => false],
        ];

        $categories = collect($categoryData)->map(function ($data, $index) {
            return Category::create([
                'name' => $data['name'],
                'slug' => Str::slug($data['name']),
                'description' => "Kumpulan berita {$data['name']} terkini dan terpercaya.",
                'is_active' => true,
                'is_featured' => $data['is_featured'],
                'order' => $index + 1,
            ]);
        });

        // Buat Tags
        $tags = Tag::factory()->count(20)->create();

        // Buat 50 Artikel — random author & category per-artikel
        $allAuthors = $reporters->push($admin);
        $articles = collect();
        for ($i = 0; $i < 50; $i++) {
            $article = Article::factory()->create([
                'author_id' => $allAuthors->random()->id,
                'category_id' => $categories->random()->id,
                'is_breaking_news' => $i < 5, // 5 artikel pertama = breaking news
                'is_featured' => $i < 3,       // 3 artikel pertama = featured
            ]);
            $articles->push($article);
        }

        // Attach tags ke setiap artikel
        $articles->each(function ($article) use ($tags) {
            $article->tags()->attach(
                $tags->random(rand(2, 4))->pluck('id')->toArray()
            );
        });

        // Buat Komentar — random artikel & user
        for ($i = 0; $i < 100; $i++) {
            Comment::factory()->create([
                'article_id' => $articles->random()->id,
                'user_id' => $allAuthors->random()->id,
            ]);
        }

        // Buat Polling
        $poll = Poll::create([
            'question' => 'Menurut Anda, apakah TALL Stack adalah masa depan pengembangan web?',
            'is_active' => true,
        ]);

        PollOption::create(['poll_id' => $poll->id, 'option_text' => 'Ya, Sangat Setuju', 'votes_count' => 145]);
        PollOption::create(['poll_id' => $poll->id, 'option_text' => 'Biasa Saja', 'votes_count' => 32]);
        PollOption::create(['poll_id' => $poll->id, 'option_text' => 'Tidak, Lebih Suka React', 'votes_count' => 58]);

        // ============================
        // Buat Menu Header & Footer
        // ============================
        $headerMenu = Menu::create(['name' => 'Menu Utama', 'location' => 'header']);
        $footerMenu = Menu::create(['name' => 'Menu Footer', 'location' => 'footer']);

        // Menu items sesuai kategori
        foreach ($categories as $index => $category) {
            MenuItem::create([
                'menu_id' => $headerMenu->id,
                'title' => $category->name,
                'category_id' => $category->id,
                'order' => $index + 1,
                'is_active' => true,
            ]);
            MenuItem::create([
                'menu_id' => $footerMenu->id,
                'title' => $category->name,
                'category_id' => $category->id,
                'order' => $index + 1,
                'is_active' => true,
            ]);
        }

        // Tambah menu item statis di footer
        MenuItem::create([
            'menu_id' => $footerMenu->id,
            'title' => 'Tentang Kami',
            'url' => '/about',
            'order' => count($categoryData) + 1,
            'is_active' => true,
        ]);
        MenuItem::create([
            'menu_id' => $footerMenu->id,
            'title' => 'Kontak',
            'url' => '/contact',
            'order' => count($categoryData) + 2,
            'is_active' => true,
        ]);
    }
}

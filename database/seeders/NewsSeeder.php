<?php

namespace Database\Seeders;

use App\Models\News;
use App\Models\User;
use Illuminate\Database\Seeder;

class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get some admin users to be creators
        $admins = User::where('is_admin', true)->get();
        $creator = $admins->isNotEmpty() ? $admins->random() : User::first();

        $newsItems = [
            [
                'title' => 'Welcome to Our Club Management System',
                'body' => 'We are excited to announce the launch of our new club management system. This platform will help us better organize our activities, manage memberships, and keep everyone informed about upcoming events and news.',
                'photo_path' => null,
                'link' => 'https://club.example.com/about',
                'creator_id' => $creator->id,
            ],
            [
                'title' => 'Annual General Meeting Scheduled',
                'body' => 'Our Annual General Meeting has been scheduled for next month. All members are encouraged to attend as we will be discussing important club matters, reviewing our financial status, and planning for the upcoming year.',
                'photo_path' => null,
                'link' => 'https://club.example.com/events/agm-2025',
                'creator_id' => $creator->id,
            ],
            [
                'title' => 'New Equipment Added to Inventory',
                'body' => 'We have recently added new equipment to our inventory including modern presentation tools and office supplies. Members can now request access to these items through our new inventory management system.',
                'photo_path' => 'news/equipment-photo.jpg',
                'link' => null,
                'creator_id' => $creator->id,
            ],
        ];

        foreach ($newsItems as $newsItem) {
            News::create($newsItem);
        }

        // Create additional random news
        News::factory()->count(4)->create();

        // Create the last 3 news with specific Tirana images
        $tiranaImages = [
            asset('images/tirana1.jpg'),
            asset('images/tirana2.jpg'),
            asset('images/tirana3.png'),
        ];

        foreach ($tiranaImages as $index => $imagePath) {
            News::factory()->create([
                'photo_path' => $imagePath,
                'title' => match ($index) {
                    0 => 'Actividades del Club Tirana',
                    1 => 'Eventos Especiales en Tirana',
                    2 => 'Celebración Anual del Club'
                },
                'created_at' => now()->addMinutes($index + 1), // Hace que cada noticia sea más reciente
                'updated_at' => now()->addMinutes($index + 1),
            ]);
        }
    }
}

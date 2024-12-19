<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Post;
use App\Models\Tag;
use App\Models\Video;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DemoPolimorphicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $posts = [
            ['title' => 'Новость 1'],
            ['title' => 'Новость 2'],
            ['title' => 'Новость 3'],
            ['title' => 'Новость 4'],
            ['title' => 'Новость 5'],
        ];

        Post::query()->truncate();
        Post::query()->insert($posts);

        $videos = [
            ['title' => 'Видео 1'],
            ['title' => 'Видео 2'],
            ['title' => 'Видео 3'],
            ['title' => 'Видео 4'],
            ['title' => 'Видео 5'],
        ];

        Video::query()->truncate();
        Video::query()->insert($videos);

        $tags = [
            ['name' => 'Tag 1'],
            ['name' => 'Tag 2'],
            ['name' => 'Tag 3'],
            ['name' => 'Tag 4'],
            ['name' => 'Tag 5'],
        ];


        Tag::query()->insert($tags);
    }
}

<?php

namespace Database\Seeders;

use App\Models\Banner;
use Illuminate\Database\Seeder;

class BannerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Banner::create([
            'title' => 'Welcome to ITB Stikom Bali',
            'description' => 'Ut velit est quam dolor ad a aliquid qui  aliquid. Sequi ea ut et est quaerat sequi nihil ut aliquam. Occaecati alias dolorem  mollitia ut. Similique ea voluptatem. Esse doloremque accusamus repellendus deleniti  vel. Minus et tempore modi architecto.',
            'image' => 'Id4grTOZP4rkm9NeGh9yexHnZpvwKmJwix4iWYXV.jpg'
        ]);
    }
}

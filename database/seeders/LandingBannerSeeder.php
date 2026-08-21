<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\LandingBanner;
use Illuminate\Database\Seeder;

class LandingBannerSeeder extends Seeder
{
    public function run(): void
    {
        $banners = [
            [
                'title' => 'Dokumentasi Kegiatan Harmonisasi Produk Hukum Riau #1',
                'image_path' => 'images/2000.jpg.jpeg',
                'order' => 1,
                'is_active' => true,
            ],
            [
                'title' => 'Dokumentasi Kegiatan Harmonisasi Produk Hukum Riau #2',
                'image_path' => 'images/2001.jpeg',
                'order' => 2,
                'is_active' => true,
            ],
            [
                'title' => 'Dokumentasi Kegiatan Harmonisasi Produk Hukum Riau #3',
                'image_path' => 'images/2002.jpeg',
                'order' => 3,
                'is_active' => true,
            ],
            [
                'title' => 'Dokumentasi Kegiatan Harmonisasi Produk Hukum Riau #4',
                'image_path' => 'images/2004.jpg.jpeg',
                'order' => 4,
                'is_active' => true,
            ],
            [
                'title' => 'Dokumentasi Kegiatan Harmonisasi Produk Hukum Riau #5',
                'image_path' => 'images/2005.jpeg',
                'order' => 5,
                'is_active' => true,
            ],
            [
                'title' => 'Dokumentasi Kegiatan Harmonisasi Produk Hukum Riau #6',
                'image_path' => 'images/2006.jpeg',
                'order' => 6,
                'is_active' => true,
            ],
            [
                'title' => 'Dokumentasi Kegiatan Harmonisasi Produk Hukum Riau #7',
                'image_path' => 'images/2007.jpg.jpeg',
                'order' => 7,
                'is_active' => true,
            ],
            [
                'title' => 'Dokumentasi Kegiatan Harmonisasi Produk Hukum Riau #8',
                'image_path' => 'images/2008.jpg.jpeg',
                'order' => 8,
                'is_active' => true,
            ],
            [
                'title' => 'Dokumentasi Kegiatan Harmonisasi Produk Hukum Riau #9',
                'image_path' => 'images/2009.jpg.jpeg',
                'order' => 9,
                'is_active' => true,
            ],
            [
                'title' => 'Dokumentasi Kegiatan Harmonisasi Produk Hukum Riau #10',
                'image_path' => 'images/2010.jpeg',
                'order' => 10,
                'is_active' => true,
            ],
        ];

        foreach ($banners as $banner) {
            LandingBanner::query()->updateOrCreate(
                ['image_path' => $banner['image_path']],
                $banner
            );
        }
    }
}

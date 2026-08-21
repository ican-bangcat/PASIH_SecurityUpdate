<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\News;
use App\Models\User;
use Illuminate\Database\Seeder;

class NewsSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::query()->where('email', 'admin2@pasih.test')->first()
            ?? User::query()->first();

        $adminId = $admin?->id;

        $newsData = [
            [
                'title' => 'Kanwil Kemenkum Riau Gelar Rapat Pengharmonisasian Raperda Kabupaten Bengkalis',
                'slug' => 'kanwil-kemenkum-riau-gelar-rapat-pengharmonisasian-raperda-kabupaten-bengkalis',
                'excerpt' => 'Tim Perancang Peraturan Perundang-undangan melaksanakan analisis konsepsi dan sinkronisasi norma terhadap rancangan peraturan daerah secara komprehensif.',
                'content' => '<p>Pekanbaru &mdash; Kantor Wilayah Kementerian Hukum dan HAM Riau melalui Divisi Pelayanan Hukum dan HAM menyelenggarakan Rapat Pengharmonisasian, Pembulatan, dan Pemantapan Konsepsi Rancangan Peraturan Daerah (Raperda) Kabupaten Bengkalis.</p><p>Rapat ini bertujuan untuk memastikan setiap pasal dan norma hukum yang tertuang dalam rancangan peraturan daerah selaras dengan peraturan perundang-undangan yang lebih tinggi, tidak bertentangan dengan kepentingan umum, serta memiliki asas kepastian hukum dan kemanfaatan bagi masyarakat luas.</p><p>Melalui proses harmonisasi yang intensif ini, diharapkan produk hukum yang dihasilkan mampu menjawab kebutuhan pembangunan daerah dan melindungi hak-hak masyarakat secara optimal.</p>',
                'image_path' => 'images/0.jpg',
                'status' => 'published',
                'published_at' => '2026-08-12 09:00:00',
                'author_id' => $adminId,
                'author_name' => 'Humas Kanwil Kemenkumham Riau',
            ],
            [
                'title' => 'Peningkatan Kualitas Produk Hukum Daerah Melalui Layanan Digital PASIH',
                'slug' => 'peningkatan-kualitas-produk-hukum-daerah-melalui-layanan-digital-pasih',
                'excerpt' => 'Pemerintah Provinsi Riau berkomitmen mempercepat proses digitalisasi fasilitasi dan penelaahan hukum se-Kabupaten/Kota secara transparan dan akuntabel.',
                'content' => '<p>Pekanbaru &mdash; Langkah transformasi digital di bidang hukum terus digencarkan oleh Kanwil Kemenkum Riau bersama Pemerintah Provinsi Riau. Salah satu terobosan strategis yang dihadirkan adalah aplikasi PASIH (Pendampingan Analisis & Evaluasi Hukum Peraturan Daerah).</p><p>Sistem ini dirancang untuk mempermudah alur pengajuan permohonan, penelaahan substansi, disposisi, hingga penyampaian hasil analisis peraturan daerah oleh pejabat fungsional perancang perundang-undangan dan analis hukum.</p><p>Dengan transparansi alur kerja yang terintegrasi, pemerintah daerah di seluruh Provinsi Riau kini dapat memantau status telaah secara real-time, mempercepat waktu proses permohonan, serta mewujudkan tertib administrasi regulasi daerah.</p>',
                'image_path' => 'images/1.jpg',
                'status' => 'published',
                'published_at' => '2026-08-10 10:30:00',
                'author_id' => $adminId,
                'author_name' => 'Humas Kanwil Kemenkumham Riau',
            ],
            [
                'title' => 'Bimbingan Teknis Penyusunan Prolegda Bagi Pengelola JDIH se-Provinsi Riau',
                'slug' => 'bimbingan-teknis-penyusunan-prolegda-bagi-pengelola-jdih-se-provinsi-riau',
                'excerpt' => 'Mewujudkan kepastian hukum dan keterbukaan informasi publik dalam pembentukan peraturan legislatif daerah di seluruh tingkat Kabupaten dan Kota.',
                'content' => '<p>Pekanbaru &mdash; Untuk meningkatkan kapasitas aparatur pemerintah daerah dalam merancang program legislasi yang terstruktur, Kanwil Kemenkum Riau menggelar Bimbingan Teknis Penyusunan Program Pembentukan Peraturan Daerah (Propemperda/Prolegda) bersama perwakilan pengelola JDIH dari 12 Kabupaten/Kota di Riau.</p><p>Kegiatan ini memfokuskan pada metodologi evaluasi kebutuhan hukum, penentuan skala prioritas rancangan peraturan, serta sinergi antara eksekutif dan legislatif di tingkat daerah.</p><p>Diharapkan bimtek ini mampu mendorong terciptanya regulasi daerah yang berkualitas, aspiratif, serta berdaya guna dalam meningkatkan kesejahteraan ekonomi dan sosial masyarakat Riau.</p>',
                'image_path' => 'images/2.webp',
                'status' => 'published',
                'published_at' => '2026-08-08 14:15:00',
                'author_id' => $adminId,
                'author_name' => 'Humas Kanwil Kemenkumham Riau',
            ],
        ];

        foreach ($newsData as $data) {
            News::query()->updateOrCreate(
                ['slug' => $data['slug']],
                $data
            );
        }
    }
}

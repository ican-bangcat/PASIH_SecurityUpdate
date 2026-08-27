<?php

use App\Models\Instansi;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

beforeEach(function () {
    Storage::fake('public');
    Role::firstOrCreate(['nama_role' => 'admin']);
    Role::firstOrCreate(['nama_role' => 'operator_pemda']);
});

it('allows admin to upload legacy historical analysis data and publish directly to public page', function () {
    $adminRole = Role::where('nama_role', 'admin')->first();
    $admin = User::factory()->create(['id_role' => $adminRole->id_role]);

    $instansi = Instansi::query()->create([
        'nama_instansi' => 'Pemerintah Kabupaten Siak',
        'jenis_instansi' => 'Pemerintah Kabupaten',
    ]);

    $perdaFile = UploadedFile::fake()->create('perda_lama.pdf', 200, 'application/pdf');
    $analisisFile = UploadedFile::fake()->create('hasil_analisis_lama.pdf', 300, 'application/pdf');

    $response = $this->actingAs($admin)->post(route('admin.archive-analysis.store'), [
        'instansi_id' => $instansi->id_instansi,
        'perda_title' => 'Peraturan Daerah Kabupaten Siak Nomor 5 Tahun 2020',
        'nomor_surat' => '005/Perda/2020',
        'perihal' => 'Pengajuan Ranperda Siak 2020',
        'description' => 'Data arsip lama',
        'completed_at' => '2025-06-15',
        'peraturan_daerah' => $perdaFile,
        'hasil_analisis' => $analisisFile,
        'ringkasan_analisis' => 'Ringkasan analisis data lama',
        'hasil_evaluasi' => 'Hasil evaluasi data lama',
        'rekomendasi' => 'Rekomendasi data lama',
    ]);

    $response->assertRedirect(route('admin.archive-analysis.index'));
    $this->assertDatabaseHas('submissions', [
        'perda_title' => 'Peraturan Daerah Kabupaten Siak Nomor 5 Tahun 2020',
    ]);

    // Check public page
    $publicResponse = $this->get(route('public.analysis.index'));
    $publicResponse->assertStatus(200);
    $publicResponse->assertSee('Peraturan Daerah Kabupaten Siak Nomor 5 Tahun 2020');
});

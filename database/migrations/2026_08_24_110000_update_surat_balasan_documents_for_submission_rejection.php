<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('suratbalasan_documents', function (Blueprint $table) {
            $table->foreignId('assignment_id')->nullable()->change();
            if (! Schema::hasColumn('suratbalasan_documents', 'submission_id')) {
                $table->foreignId('submission_id')->nullable()->after('assignment_id')->constrained('submissions')->cascadeOnDelete();
            }
            if (! Schema::hasColumn('suratbalasan_documents', 'kategori_surat')) {
                $table->string('kategori_surat')->default('surat_tugas')->after('file_size');
            }
        });
    }

    public function down(): void
    {
        Schema::table('suratbalasan_documents', function (Blueprint $table) {
            if (Schema::hasColumn('suratbalasan_documents', 'submission_id')) {
                $table->dropConstrainedForeignId('submission_id');
            }
            if (Schema::hasColumn('suratbalasan_documents', 'kategori_surat')) {
                $table->dropColumn('kategori_surat');
            }
            $table->foreignId('assignment_id')->nullable(false)->change();
        });
    }
};

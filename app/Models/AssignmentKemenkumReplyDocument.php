<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssignmentKemenkumReplyDocument extends Model
{
    use HasFactory;

    protected $table = 'suratbalasan_documents';

    protected $fillable = [
        'assignment_id',
        'submission_id',
        'uploaded_by',
        'file_name',
        'file_path',
        'mime_type',
        'file_size',
        'kategori_surat',
    ];

    public function assignment()
    {
        return $this->belongsTo(Assignment::class);
    }

    public function submission()
    {
        return $this->belongsTo(Submission::class);
    }
}

<?php

namespace App\Enums;

enum SubmissionStatus: string
{
    case Submitted = 'submitted';
    case Revised = 'revised';
    case Rejected = 'rejected';
    case Accepted = 'accepted';
    case Disposed = 'disposed';
    case Assigned = 'assigned';
    case PendingReplyLetter = 'pending_reply_letter';
    case Completed = 'completed';

    public function label(): string
    {
        return match ($this) {
            self::Submitted => 'Diajukan',
            self::Revised => 'Perlu Revisi',
            self::Rejected => 'Ditolak',
            self::Accepted => 'Diterima',
            self::Disposed => 'Didisposisikan',
            self::Assigned => 'Dalam Proses Analisis',
            self::PendingReplyLetter => 'Menunggu Surat Balasan Penolakan',
            self::Completed => 'Selesai',
        };
    }
}

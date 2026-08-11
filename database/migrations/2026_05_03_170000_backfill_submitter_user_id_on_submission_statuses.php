<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        $statuses = DB::table('submission_statuses')
            ->join('submissions', 'submissions.id', '=', 'submission_statuses.submission_id')
            ->where('submission_statuses.status', 'submitted')
            ->whereNull('submission_statuses.user_id')
            ->select('submission_statuses.id as ss_id', 'submissions.submitter_id')
            ->get();

        foreach ($statuses as $status) {
            DB::table('submission_statuses')
                ->where('id', $status->ss_id)
                ->update(['user_id' => $status->submitter_id]);
        }
    }

    public function down(): void
    {
        // No-op: data backfill is intentionally irreversible.
    }
};

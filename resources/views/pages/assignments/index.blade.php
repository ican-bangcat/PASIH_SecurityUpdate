@extends('layouts.app')
@section('title', 'Penugasan')

@section('content')
  @php
    $userRole = auth()->user()?->role?->value;
    $isKetuaTim = $userRole === 'ketua_tim_analisis';
    $isKadiv = $userRole === 'kepala_divisi_p3h';
    $isKakanwil = $userRole === 'kakanwil';
  @endphp
  <div class="space-y-5">
    <div>
      <h1 class="pasih-page-title">Penugasan</h1>
      <p class="mt-1 pasih-page-breadcrumb">
        <a href="{{ route('dashboard') }}" class="hover:text-slate-700 hover:underline">Dashboard</a>
        <span class="mx-1">/</span>
        <span>Penugasan</span>
      </p>
    </div>

    @if(isset($pendingReplySubmissions) && $pendingReplySubmissions->isNotEmpty())
      <div class="rounded-xl bg-amber-50 border border-amber-300 p-4 space-y-3">
        <div class="flex items-center gap-2 text-amber-900 font-bold text-sm sm:text-base">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-amber-600 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
          </svg>
          Permohonan Ditolak - Menunggu Upload Surat Balasan Penolakan ({{ $pendingReplySubmissions->count() }})
        </div>
        <p class="text-xs sm:text-sm text-slate-700">Permohonan berikut telah ditolak dan membutuhkan pengunggahan Surat Balasan Penolakan dari Ketua Tim Analisis sebelum dikirim ke Pemda:</p>
        <div class="divide-y divide-amber-200/60 rounded-lg bg-white ring-1 ring-amber-200">
          @foreach($pendingReplySubmissions as $pendingSub)
            <div class="p-3 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 text-sm">
              <div>
                <div class="font-semibold text-slate-800">{{ $pendingSub->perda_title }}</div>
                <div class="text-xs text-slate-500">{{ $pendingSub->submitter?->instansi?->nama_instansi ?? '-' }} • {{ $pendingSub->nomor_surat }}</div>
              </div>
              <a href="{{ route('submissions.rejection-reply.form', $pendingSub) }}" class="inline-flex items-center justify-center gap-1.5 px-3 py-1.5 rounded-md bg-amber-600 text-white text-xs font-semibold hover:bg-amber-700 shrink-0">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a2 2 0 002 2h12a2 2 0 002-2v-1M12 4v12m0 0l-4-4m4 4l4-4" />
                </svg>
                Unggah Surat Balasan
              </a>
            </div>
          @endforeach
        </div>
      </div>
    @endif

    <div class="rounded-xl bg-white ring-1 ring-slate-200 overflow-hidden">
      <div class="px-4 py-3 border-b border-slate-200 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
        <form method="GET" action="{{ route('assignments.index') }}" class="flex items-center gap-2 text-sm text-slate-700">
          <span>Tampil</span>
          <select name="per_page" class="h-8 rounded-md border-slate-300 text-sm focus:outline-none focus:ring-0 focus:border-slate-300" onchange="this.form.submit()">
            <option value="5" @selected($perPage === 5)>5</option>
            <option value="10" @selected($perPage === 10)>10</option>
            <option value="25" @selected($perPage === 25)>25</option>
          </select>
          <span>Data</span>
          <input type="hidden" name="q" value="{{ $search }}">
          <input type="hidden" name="status" value="{{ $status }}">
        </form>
        <form method="GET" action="{{ route('assignments.index') }}" class="flex items-center gap-2 text-sm text-slate-700">
          <label for="q">Cari:</label>
          <input id="q" type="text" name="q" value="{{ $search }}" class="h-8 w-40 px-3 rounded-md border border-[#B9B9B9] text-sm">
          <input type="hidden" name="per_page" value="{{ $perPage }}">
          <input type="hidden" name="status" value="{{ $status }}">
        </form>
      </div>

      <div class="overflow-x-auto">
        <table class="w-full text-sm">
          <thead class="bg-slate-50 text-slate-600">
            <tr>
              <th class="px-4 py-3 text-center">No</th>
              <th class="px-4 py-3 text-left">Judul Perda</th>
              <th class="px-4 py-3 text-left">Nomor Surat</th>
              <th class="px-4 py-3 text-left">Tanggal Pengajuan</th>
              <th class="px-4 py-3 text-left">Instansi Pengaju</th>
              <th class="px-4 py-3 text-left">Status Analisis</th>
              <th class="px-4 py-3 text-left">Penanggung Jawab</th>
              <th class="px-4 py-3 text-left">Aksi</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-slate-200">
            @forelse($assignments as $assignment)
              @php
                $rowNumber = ($assignments->firstItem() ?? 1) + $loop->index;
                $submission = $assignment->submission;
                $statusTone = match($assignment->status->value) {
                    'assigned' => 'permohonan-available',
                    'in_progress' => 'permohonan-in-analysis',
                    'pending_kadiv_approval' => 'permohonan-awaiting-kadiv',
                    'pending_kakanwil_approval' => 'permohonan-awaiting-kakanwil',
                    'revision_by_pic' => 'permohonan-revision',
                    'completed' => 'permohonan-done',
                    default => 'permohonan-unassigned',
                };

                $userRole = auth()->user()->role->value;
                $isKetuaTim = $userRole === 'ketua_tim_analisis';
                $isKadiv = $userRole === 'kepala_divisi_p3h';
                $isKakanwil = $userRole === 'kakanwil';
                $isAnalystOwner = $userRole === 'analis_hukum' && $assignment->analyst_id === auth()->id();

                $rowBgColor = null;
                if ($assignment->status->value !== 'completed') {
                    if ($assignment->pic_assigned_at !== null) {
                        $now = now();
                        $twoMonthsAfterPicAssigned = $assignment->pic_assigned_at->copy()->addMonthsNoOverflow(2);
                        $threeMonthsAfterPicAssigned = $assignment->pic_assigned_at->copy()->addMonthsNoOverflow(3);

                        if ($now->lt($twoMonthsAfterPicAssigned)) {
                            $rowBgColor = '#D1FAE5';
                        } elseif ($now->lte($threeMonthsAfterPicAssigned)) {
                            $rowBgColor = '#FEF08A';
                        } else {
                            $rowBgColor = '#FECACA';
                        }
                    } else {
                        $rowBgColor = '#E5E7EB';
                    }
                }
              @endphp
              <tr class="text-slate-700" @if($rowBgColor !== null) style="background-color: {{ $rowBgColor }};" @endif>
                <td class="px-4 py-3 text-center">{{ $rowNumber }}</td>
                <td class="px-4 py-3">{{ $submission->perda_title ?: '-' }}</td>
                <td class="px-4 py-3">{{ $submission->nomor_surat }}</td>
                <td class="px-4 py-3">{{ optional($submission->submitted_at)->format('d-m-Y') ?: '-' }}</td>
                <td class="px-4 py-3">{{ $submission->submitter?->instansi?->nama_instansi ?? '-' }}</td>
                <td class="px-4 py-3"><x-ui.badge :tone="$statusTone">{{ $assignment->status->label() }}</x-ui.badge></td>
                <td class="px-4 py-3">{{ $assignment->analyst?->name ?? 'Belum ada Penanggung Jawab' }}</td>
                <td class="px-4 py-3">
                  <div class="flex items-center gap-1.5">
                    <a href="{{ route('assignments.show', $assignment) }}" class="h-8 w-8 rounded-md bg-blue-600 text-white inline-flex items-center justify-center" title="Detail">
                      <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /><circle cx="12" cy="12" r="3" /></svg>
                    </a>

                    @if($isKetuaTim)
                      @if(in_array($assignment->status->value, ['assigned', 'in_progress'], true))
                        <button
                          type="button"
                          onclick="openAssignPicModal('{{ route('assignments.assign-pic.store', $assignment) }}', '{{ addslashes($submission->perda_title ?: '-') }}', '{{ addslashes($submission->submitter?->instansi?->nama_instansi ?? $submission->submitter?->name ?? '-') }}', '{{ $assignment->analyst_id ?? '' }}', '{{ optional($assignment->deadline_at)->format('Y-m-d') ?? '' }}')"
                          class="h-8 w-8 rounded-md text-white inline-flex items-center justify-center cursor-pointer hover:opacity-90 transition-opacity"
                          style="background-color:#06B6D4"
                          title="Tentukan Penanggung Jawab">
                          <img src="{{ asset('icon/IC_Hand.svg') }}" alt="Ikon tangan" class="h-4 w-4" />
                        </button>
                      @else
                        <button type="button" class="h-8 w-8 rounded-md text-white inline-flex items-center justify-center cursor-not-allowed" style="background-color:#B9B9B9" title="Penanggung Jawab sudah ditentukan">
                          <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="none" stroke="currentColor">
                            <path d="M16.6666 13.3332V7.08317C16.6666 6.39317 16.1325 5.83317 15.4333 5.83317C15 5.83317 14.1666 6.08317 14.1666 7.08317V4.58317M14.1666 4.58317C14.1666 3.89317 13.6325 3.33317 12.9333 3.33317C12.5108 3.33317 11.6666 3.58317 11.6666 4.58317M14.1666 4.58317V9.1665M11.6666 4.58317V2.9165C11.6666 2.2265 11.1325 1.6665 10.4333 1.6665C9.73329 1.6665 9.16663 2.2265 9.16663 2.9165V4.58317M11.6666 4.58317V9.1665M9.16663 4.58317C9.16663 3.58317 8.33913 3.33317 7.91663 3.33317C7.21663 3.33317 6.66663 3.909 6.66663 4.59984V11.6665M9.16663 4.58317V9.1665" stroke-width="1.66667" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M16.6667 13.333C16.6667 16.6664 14.055 18.333 10.8333 18.333C7.61166 18.333 6.50333 17.4997 4.00333 13.333L2.69416 11.1622C2.2475 10.4389 2.605 9.50053 3.42833 9.23386C3.69758 9.14628 3.98722 9.14342 4.25815 9.22569C4.52907 9.30795 4.76823 9.47136 4.94333 9.69386L6.66666 11.6939" stroke-width="1.66667" stroke-linecap="round" stroke-linejoin="round"/>
                          </svg>
                        </button>
                      @endif
                    @endif

                    @if($isAnalystOwner)
                      @if(in_array($assignment->status->value, ['in_progress', 'revision_by_pic'], true))
                        <a href="{{ route('assignments.upload-hasil.form', $assignment) }}" class="h-8 w-8 rounded-md text-white inline-flex items-center justify-center" style="background-color:#FB7C5A" title="Upload Hasil Analisis">
                          <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" /></svg>
                        </a>
                      @else
                        <button type="button" class="h-8 w-8 rounded-md text-white inline-flex items-center justify-center cursor-not-allowed" style="background-color:#B9B9B9" title="Upload dinonaktifkan">
                          <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" /></svg>
                        </button>
                      @endif
                    @endif

                    @if($isKadiv || $isKakanwil)
                      @php
                        $canApprove = ($isKadiv && $assignment->status->value === 'pending_kadiv_approval')
                            || ($isKakanwil && $assignment->status->value === 'pending_kakanwil_approval');
                      @endphp
                      @if($canApprove)
                        <a href="{{ route('assignments.approval.form', $assignment) }}" class="h-8 w-8 rounded-md bg-emerald-600 text-white inline-flex items-center justify-center" title="Persetujuan / Revisi">
                          <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                          </svg>
                        </a>
                      @else
                        <button type="button" class="h-8 w-8 rounded-md text-white inline-flex items-center justify-center cursor-not-allowed" style="background-color:#B9B9B9" title="Belum bisa Persetujuan">
                          <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                          </svg>
                        </button>
                      @endif
                    @endif
                  </div>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="8" class="px-4 py-6 text-center text-slate-500">Belum ada penugasan.</td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>

      <div class="px-4 py-3 border-t border-slate-200 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 text-sm text-slate-600">
        <div>
          Menampilkan {{ $assignments->firstItem() ?? 0 }} - {{ $assignments->lastItem() ?? 0 }} dari {{ $assignments->total() }} data
        </div>
        <div>
          {{ $assignments->onEachSide(1)->links('vendor.pagination.pasih') }}
        </div>
      </div>
    </div>
  </div>

  @if($isKetuaTim)
    <div id="assignPicModal" class="fixed inset-0 z-50 hidden overflow-y-auto bg-slate-900/50 backdrop-blur-sm p-4 flex items-center justify-center">
      <div class="relative w-full max-w-xl rounded-2xl bg-white shadow-2xl ring-1 ring-slate-200 overflow-hidden">
        <div class="flex items-center justify-between px-6 py-4 border-b border-slate-100 bg-slate-50">
          <div>
            <h3 class="text-lg font-bold text-slate-800">Tentukan Penanggung Jawab</h3>
            <p class="text-xs text-slate-500 mt-0.5">Pilih analis dan batas waktu pengerjaan</p>
          </div>
          <button type="button" onclick="closeAssignPicModal()" class="text-slate-400 hover:text-slate-600 rounded-lg p-1.5 hover:bg-slate-100 transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
          </button>
        </div>

        <div id="assignPicAlert" class="hidden mx-6 mt-4 rounded-lg px-4 py-3 text-sm font-medium"></div>

        <form id="assignPicFormElement" method="POST" action="" enctype="multipart/form-data" class="p-6 space-y-4">
          @csrf
          <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <label class="block text-sm font-medium text-slate-700">
              Judul Peraturan Daerah
              <input type="text" id="modalPerdaTitle" disabled class="mt-2 w-full h-10 px-4 py-2 rounded-md border border-[#B9B9B9] bg-slate-100 text-sm text-slate-500">
            </label>
            <label class="block text-sm font-medium text-slate-700">
              Instansi Pengaju
              <input type="text" id="modalInstansiName" disabled class="mt-2 w-full h-10 px-4 py-2 rounded-md border border-[#B9B9B9] bg-slate-100 text-sm text-slate-500">
            </label>
          </div>

          <label class="block text-sm font-medium text-slate-700">
            Penanggung Jawab Analisis <span class="text-red-500">*</span>
            <select name="analyst_id" id="modalAnalystId" class="mt-2 w-full h-10 px-4 py-2 rounded-md border border-[#B9B9B9] text-sm focus:outline-none focus:ring-0 focus:border-[#B9B9B9]" required>
              <option value="">Pilih Analis</option>
              @foreach($analysts as $analyst)
                <option value="{{ $analyst->id }}">{{ $analyst->name }}</option>
              @endforeach
            </select>
          </label>

          <label class="block text-sm font-medium text-slate-700">
            Deadline <span class="text-red-500">*</span>
            <input type="date" name="deadline_at" id="modalDeadlineAt" min="{{ now()->toDateString() }}" required class="mt-2 w-full h-10 px-4 py-2 rounded-md border border-[#B9B9B9] text-sm">
          </label>

          <label class="block text-sm font-medium text-slate-700">
            Upload Surat Balasan ke Pemda <span class="text-slate-400 text-xs font-normal">(Opsional)</span>
            <p class="mt-1 text-xs text-slate-500">Format: PDF/DOC/DOCX, maksimal 10 MB.</p>
            <input
              type="file"
              name="surat_balasan_kemenkum"
              data-max-size="10485760"
              accept=".pdf,.doc,.docx"
              class="mt-2 block w-full rounded-xl border border-[#B9B9B9] bg-white text-sm text-slate-700 file:mr-3 file:rounded-l-xl file:border-0 file:bg-slate-100 file:px-4 file:py-3 file:text-base file:text-slate-700">
          </label>

          <div class="pt-3 flex items-center justify-end gap-3 border-t border-slate-100">
            <button type="button" onclick="closeAssignPicModal()" class="h-10 px-4 rounded-md border border-slate-300 text-slate-700 text-sm font-medium hover:bg-slate-50 transition-colors">
              Batal
            </button>
            <button type="submit" id="assignPicSubmitBtn" class="inline-flex items-center gap-2 h-10 px-5 rounded-md bg-emerald-600 text-white text-sm font-semibold hover:bg-emerald-700 transition-colors">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a2 2 0 002 2h12a2 2 0 002-2v-1M12 4v12m0 0l-4-4m4 4l4-4" />
              </svg>
              <span id="assignPicSubmitText">Simpan</span>
            </button>
          </div>
        </form>
      </div>
    </div>

    <script>
      function openAssignPicModal(actionUrl, perdaTitle, instansiName, analystId, deadlineAt) {
        const modal = document.getElementById('assignPicModal');
        const form = document.getElementById('assignPicFormElement');
        if (!modal || !form) return;
        form.action = actionUrl;
        document.getElementById('modalPerdaTitle').value = perdaTitle || '-';
        document.getElementById('modalInstansiName').value = instansiName || '-';
        document.getElementById('modalAnalystId').value = analystId || '';
        document.getElementById('modalDeadlineAt').value = deadlineAt || '';
        hideAssignPicAlert();
        resetAssignPicSubmitBtn();
        modal.classList.remove('hidden');
      }

      function closeAssignPicModal() {
        const modal = document.getElementById('assignPicModal');
        if (modal) modal.classList.add('hidden');
      }

      function showAssignPicAlert(message, isError) {
        const alert = document.getElementById('assignPicAlert');
        if (!alert) return;
        alert.textContent = message;
        alert.className = isError
          ? 'mx-6 mt-4 rounded-lg px-4 py-3 text-sm font-medium bg-rose-50 text-rose-700 ring-1 ring-rose-200'
          : 'mx-6 mt-4 rounded-lg px-4 py-3 text-sm font-medium bg-emerald-50 text-emerald-700 ring-1 ring-emerald-200';
      }

      function hideAssignPicAlert() {
        const alert = document.getElementById('assignPicAlert');
        if (alert) {
          alert.textContent = '';
          alert.className = 'hidden mx-6 mt-4 rounded-lg px-4 py-3 text-sm font-medium';
        }
      }

      function setAssignPicLoading(loading) {
        const btn = document.getElementById('assignPicSubmitBtn');
        const text = document.getElementById('assignPicSubmitText');
        if (!btn || !text) return;
        btn.disabled = loading;
        text.textContent = loading ? 'Menyimpan...' : 'Simpan';
        btn.classList.toggle('opacity-60', loading);
        btn.classList.toggle('cursor-not-allowed', loading);
      }

      function resetAssignPicSubmitBtn() {
        setAssignPicLoading(false);
      }

      document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('assignPicFormElement');
        if (!form) return;

        form.addEventListener('submit', function(e) {
          e.preventDefault();
          hideAssignPicAlert();
          setAssignPicLoading(true);

          const formData = new FormData(form);
          const csrfToken = formData.get('_token') || document.querySelector('meta[name="csrf-token"]')?.content || '';

          // Bersihkan file input jika tidak ada file yang dipilih agar tidak memicu deteksi anomali multipart pada WAF
          const fileInput = form.querySelector('input[type="file"][name="surat_balasan_kemenkum"]');
          if (fileInput && (!fileInput.files || fileInput.files.length === 0)) {
            formData.delete('surat_balasan_kemenkum');
          }

          fetch(form.action, {
            method: 'POST',
            headers: {
              'X-Requested-With': 'XMLHttpRequest',
              'Accept': 'application/json',
              'X-CSRF-TOKEN': csrfToken,
            },
            body: formData,
          })
          .then(async function(response) {
            let data = null;
            const contentType = response.headers.get('content-type') || '';
            
            if (contentType.includes('application/json')) {
              data = await response.json();
            } else {
              // Jika respons bukan JSON (kemungkinan WAF redirect atau HTML error)
              throw new Error('Respons server tidak valid (kemungkinan diblokir WAF atau sesi berakhir). Status: ' + response.status);
            }

            if (!response.ok || !data || data.success !== true) {
              let errorMsg = (data && data.message) ? data.message : 'Terjadi kesalahan saat menyimpan data.';
              if (data && data.errors) {
                const errorList = Object.values(data.errors).flat();
                if (errorList.length > 0) {
                  errorMsg = errorList.join(' ');
                }
              }
              throw new Error(errorMsg);
            }

            showAssignPicAlert(data.message || 'Penanggung jawab analisis berhasil ditetapkan', false);
            setTimeout(function() {
              window.location.href = data.redirect || '{{ route("assignments.index") }}';
            }, 800);
          })
          .catch(function(err) {
            showAssignPicAlert(err.message || 'Gagal mengirim data. Silakan coba lagi.', true);
            setAssignPicLoading(false);
          });
        });
      });
    </script>
  @endif
@endsection

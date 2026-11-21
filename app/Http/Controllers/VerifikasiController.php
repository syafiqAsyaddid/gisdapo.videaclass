<?php

namespace App\Http\Controllers;

use App\Models\Sekolah;
use App\Models\User;
use App\Models\VerifikasiData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class VerifikasiController extends Controller
{
    /**
     * Halaman Antrean Verifikasi & Approval (Supervisor & Admin KCD)
     */
    public function index(Request $request)
    {
        $status = $request->get('status', 'all');

        $query = VerifikasiData::with(['sekolah.kecamatan', 'pengaju', 'verifikator'])->latest();
        if (in_array($status, ['pending', 'approved', 'rejected'])) {
            $query->where('status', $status);
        }

        $items = $query->get();

        $counts = [
            'all' => VerifikasiData::count(),
            'pending' => VerifikasiData::where('status', 'pending')->count(),
            'approved' => VerifikasiData::where('status', 'approved')->count(),
            'rejected' => VerifikasiData::where('status', 'rejected')->count(),
        ];

        return view('kcd.verifikasi', compact('items', 'status', 'counts'));
    }

    /**
     * Setujui (Approve) pengajuan data sekolah (Khusus Supervisor)
     */
    public function approve(Request $request, $id)
    {
        if (!auth()->user()->can('supervisor')) {
            abort(403, 'Hanya Supervisor yang dapat melakukan approval data.');
        }

        $item = VerifikasiData::findOrFail($id);
        $item->update([
            'status' => 'approved',
            'catatan_supervisor' => $request->input('catatan_supervisor', 'Data telah diverifikasi dan disetujui.'),
            'verified_by' => auth()->id(),
            'verified_at' => now(),
        ]);

        $this->syncSekolahStatus($item->sekolah_id, $item->catatan_supervisor);

        return redirect()->back()->with('success', 'Data sekolah berhasil diverifikasi dan disetujui (Approved).');
    }

    /**
     * Tolak / Minta Revisi (Reject) pengajuan data sekolah (Khusus Supervisor)
     */
    public function reject(Request $request, $id)
    {
        if (!auth()->user()->can('supervisor')) {
            abort(403, 'Hanya Supervisor yang dapat melakukan penolakan/revisi data.');
        }

        $request->validate([
            'catatan_supervisor' => 'required|string|max:1000',
        ]);

        $item = VerifikasiData::findOrFail($id);
        $item->update([
            'status' => 'rejected',
            'catatan_supervisor' => $request->catatan_supervisor,
            'verified_by' => auth()->id(),
            'verified_at' => now(),
        ]);

        $this->syncSekolahStatus($item->sekolah_id, $request->catatan_supervisor);

        return redirect()->back()->with('success', 'Pengajuan ditolak dan dikembalikan ke sekolah untuk revisi.');
    }

    /**
     * Sinkronisasi status verifikasi ringkas pada tabel sekolah
     */
    private function syncSekolahStatus($sekolahId, $latestNote = null)
    {
        $hasRejected = VerifikasiData::where('sekolah_id', $sekolahId)->where('status', 'rejected')->exists();
        $hasPending = VerifikasiData::where('sekolah_id', $sekolahId)->where('status', 'pending')->exists();

        $overall = 'approved';
        if ($hasRejected) {
            $overall = 'rejected';
        } elseif ($hasPending) {
            $overall = 'pending';
        }

        Sekolah::where('id', $sekolahId)->update([
            'status_verifikasi' => $overall,
            'catatan_verifikasi' => $latestNote,
        ]);
    }

    /**
     * Manajemen Akun Supervisor (Khusus Admin KCD)
     */
    public function indexSupervisor()
    {
        if (!auth()->user()->can('admin_kcd')) {
            abort(403, 'Hanya Admin KCD yang dapat mengelola akun Supervisor.');
        }

        $supervisors = User::where('hak_akses_id', 4)->latest()->get();
        return view('kcd.supervisor-index', compact('supervisors'));
    }

    public function storeSupervisor(Request $request)
    {
        if (!auth()->user()->can('admin_kcd')) {
            abort(403);
        }

        $request->validate([
            'username' => 'required|string|max:255|unique:users,username',
            'email' => 'nullable|email|max:255',
            'password' => 'required|string|min:6',
        ]);

        User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'hak_akses_id' => 4,
            'sekolah_id' => null,
            'remember_token' => Str::random(10),
        ]);

        return redirect()->back()->with('success', 'Akun Supervisor berhasil ditambahkan.');
    }

    public function destroySupervisor($id)
    {
        if (!auth()->user()->can('admin_kcd')) {
            abort(403);
        }

        $supervisor = User::where('hak_akses_id', 4)->findOrFail($id);
        $supervisor->delete();

        return redirect()->back()->with('success', 'Akun Supervisor berhasil dihapus.');
    }

    /**
     * Halaman Status Verifikasi untuk User / Sekolah
     */
    public function sekolahIndex()
    {
        $sekolah = Sekolah::findOrFail(auth()->user()->sekolah_id);
        $riwayat = VerifikasiData::with(['pengaju', 'verifikator'])
            ->where('sekolah_id', $sekolah->id)
            ->latest()
            ->get();

        return view('sekolah.verifikasi', [
            'page' => 'verifikasi',
            'sekolah' => $sekolah,
            'riwayat' => $riwayat,
        ]);
    }

    /**
     * Pengajuan verifikasi manual oleh Operator Sekolah
     */
    public function ajukanSekolah(Request $request)
    {
        $request->validate([
            'kategori' => 'nullable|string|max:100',
            'keterangan' => 'nullable|string|max:500',
        ]);

        $sekolahId = auth()->user()->sekolah_id;
        VerifikasiData::catat(
            $sekolahId,
            $request->input('kategori', 'Pengajuan Lengkap'),
            $request->input('keterangan', 'Pengajuan verifikasi data sekolah oleh Operator Sekolah.')
        );

        return redirect()->back()->with('success', 'Pengajuan verifikasi berhasil dikirim ke Supervisor.');
    }
}

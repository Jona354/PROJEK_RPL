<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Notifikasi;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
public function boot(): void
{
    View::composer('*', function ($view) {

        if (!Auth::check()) {
            return;
        }

        if (Auth::user()->role == 'staff_gudang') {

            $notifikasi = Notifikasi::where('tipe', 'permintaan')
                ->latest()
                ->take(5)
                ->get();

            $jumlahNotif = Notifikasi::where('tipe', 'permintaan')
                ->where('sudah_dibaca', 0)
                ->count();

        } elseif (Auth::user()->role == 'chef') {

            $notifikasi = Notifikasi::whereIn('tipe', [
                'disetujui',
                'ditolak'
            ])
            ->latest()
            ->take(5)
            ->get();

            $jumlahNotif = Notifikasi::whereIn('tipe', [
                'disetujui',
                'ditolak'
            ])
            ->where('sudah_dibaca', 0)
            ->count();

            } elseif (Auth::user()->role == 'admin_gudang') {

    $notifikasi = Notifikasi::whereIn('tipe', [
        'barang_masuk',
        'stok_minimum',
        'kadaluarsa'
    ])
    ->latest()
    ->take(5)
    ->get();

    $jumlahNotif = Notifikasi::whereIn('tipe', [
        'barang_masuk',
        'stok_minimum',
        'kadaluarsa'
    ])
    ->where('sudah_dibaca', 0)
    ->count();

        } else {

            $notifikasi = collect();
            $jumlahNotif = 0;
        }

        $view->with('notifikasi', $notifikasi);
        $view->with('jumlahNotif', $jumlahNotif);
    });
}
}

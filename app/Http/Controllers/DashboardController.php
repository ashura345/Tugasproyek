<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard');  // Menampilkan halaman dashboard
    }

    // Method untuk mengambil data chart
    public function chartData()
    {
        // Data pembayaran yang dummy
        $data = [
            ['category' => 'SPP', 'status' => 'Bayar', 'total' => 50],
            ['category' => 'SPP', 'status' => 'Belum Bayar', 'total' => 30],
            ['category' => 'Seragam', 'status' => 'Bayar', 'total' => 40],
            ['category' => 'Seragam', 'status' => 'Belum Bayar', 'total' => 60],
            ['category' => 'Ijazah', 'status' => 'Bayar', 'total' => 30],
            ['category' => 'Ijazah', 'status' => 'Belum Bayar', 'total' => 20],
        ];

        return response()->json($data);
    }
}


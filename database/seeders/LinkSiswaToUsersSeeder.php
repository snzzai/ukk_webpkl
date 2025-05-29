<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Siswa;
use Illuminate\Support\Facades\Log;

class LinkSiswaToUsersSeeder extends Seeder
{
    public function run()
    {
        // Pertama, hubungkan siswa yang sudah ada usernya
        $users = User::where('role', 'siswa')
                   ->whereDoesntHave('siswa')
                   ->get();

        foreach ($users as $user) {
            // Cari siswa dengan email yang sama
            $siswa = Siswa::where('email', $user->email)->first();
            
            if ($siswa && !$siswa->user_id) {
                $siswa->user_id = $user->id;
                $siswa->save();
                Log::info("Menghubungkan siswa {$siswa->id} dengan user {$user->id}");
            }
        }

        // Kedua, handle siswa yang belum punya user
        $siswasWithoutUser = Siswa::whereNull('user_id')->get();
        
        foreach ($siswasWithoutUser as $siswa) {
            try {
                // Cek apakah user dengan email yang sama sudah ada
                $user = User::where('email', $siswa->email)->first();
                
                if (!$user) {
                    // Buat user baru jika belum ada
                    $user = User::create([
                        'name' => $siswa->nama,
                        'email' => $siswa->email,
                        'password' => bcrypt('password123'), // Ganti dengan password default
                        'role' => 'siswa'
                    ]);
                    Log::info("Membuat user baru {$user->id} untuk siswa {$siswa->id}");
                } else {
                    Log::info("User sudah ada {$user->id} untuk siswa {$siswa->id}");
                }
                
                // Hubungkan siswa dengan user
                $siswa->user_id = $user->id;
                $siswa->save();
                
            } catch (\Exception $e) {
                Log::error("Gagal menghubungkan siswa {$siswa->id}: " . $e->getMessage());
                
                // Alternatif: buat email unik jika email sudah dipakai
                if (str_contains($e->getMessage(), 'Duplicate entry')) {
                    $newEmail = 'siswa_' . $siswa->id . '@sija.com';
                    $user = User::create([
                        'name' => $siswa->nama,
                        'email' => $newEmail,
                        'password' => bcrypt('password123'),
                        'role' => 'siswa'
                    ]);
                    $siswa->user_id = $user->id;
                    $siswa->save();
                    Log::info("Membuat user dengan email alternatif {$newEmail} untuk siswa {$siswa->id}");
                }
            }
        }
    }
}
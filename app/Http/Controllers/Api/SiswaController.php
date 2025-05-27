<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Siswa;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    public function index()
    {
        return Siswa::all();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'nis' => 'required|unique:siswa,nis',
        ]);

        return Siswa::create($validated);
    }

    public function show(Siswa $siswa)
    {
        return $siswa->load('user');
    }

    public function update(Request $request, Siswa $siswa)
    {
        $validated = $request->validate([
            'nama' => 'required|exists:users,id',
            'nis' => 'required|unique:siswaS,nis,' . $siswa->id,
        ]);

        $siswa->update($validated);
        return $siswa;
    }

    public function destroy(Siswa $siswa)
    {
        $siswa->delete();
        return response()->json(null, 204);
    }

}

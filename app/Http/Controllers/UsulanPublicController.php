<?php

namespace App\Http\Controllers;

use App\Models\UsulanPublic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UsulanPublicController extends Controller
{
    // Ambil semua data usulan publik
    public function index()
    {
        $usulan = UsulanPublic::select([
            'id',
            'name',
            'username',
            'land_use_change',
            'description',
            'surat_permohonan',
            'foto_ktp',
            'sertifikat_tanah',
            'foto_lokasi',
            'contact_person',
            'type',
            'status',
            DB::raw('ST_AsGeoJSON(geometry) as geometry')
        ])->get();

        return response()->json($usulan);
    }

    // Menyimpan usulan publik baru
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'username' => 'required|string',
            'land_use_change' => 'required|string',
            'description' => 'nullable|string',
            'surat_permohonan' => 'nullable|string',
            'foto_ktp' => 'nullable|string',
            'sertifikat_tanah' => 'nullable|string',
            'foto_lokasi' => 'nullable|string',
            'contact_person' => 'required|string',
            'geometry' => 'required|json',
            'type' => 'required|in:Point,LineString,Polygon',
        ]);

        $usulan = DB::table('usulan_public')->insert([
            'name' => $request->name,
            'username' => $request->username,
            'land_use_change' => $request->land_use_change,
            'description' => $request->description,
            'surat_permohonan' => $request->surat_permohonan,
            'foto_ktp' => $request->foto_ktp,
            'sertifikat_tanah' => $request->sertifikat_tanah,
            'foto_lokasi' => $request->foto_lokasi,
            'contact_person' => $request->contact_person,
            'geometry' => DB::raw("ST_SetSRID(ST_GeomFromGeoJSON(?), 4326)"),
            'type' => $request->type,
            'status' => 'pending',
            'created_at' => now(),
            'updated_at' => now()
        ], [$request->geometry]);

        return response()->json(['message' => 'Usulan berhasil disimpan'], 201);
    }

    // Update status usulan (approve/reject)
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,approved,rejected'
        ]);

        $usulan = UsulanPublic::findOrFail($id);
        $usulan->status = $request->status;
        $usulan->save();

        return response()->json(['message' => 'Status berhasil diupdate']);
    }
}

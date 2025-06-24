<?php

namespace App\Http\Controllers;

use App\Models\PolygonModel;
use Illuminate\Http\Request;

class PolygonController extends Controller
{
    public function __construct()
    {
        $this->polygon = new PolygonModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Map',
        ];

        return view('map', $data);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        // Validate data
        $request->validate(
            [
                'name' => 'required|unique:polygon,name',
                'description' => 'required',
                'geom_polygon' => 'required',
                'image' => 'nullable|mimes:jpeg,png,jpg,gif,svg|max:10000',
                'username' => 'required',
                'land_use_change' => 'required',
                'contact_person' => 'required',
                'surat_permohonan' => 'nullable|mimes:pdf|max:10000',
                'foto_ktp' => 'nullable|mimes:jpeg,png,jpg|max:5000',
                'sertifikat_tanah' => 'nullable|mimes:pdf,jpeg,png,jpg|max:10000',
                'foto_lokasi' => 'nullable|mimes:jpeg,png,jpg|max:5000',
            ],
            [
                'name.required' => 'Name is required',
                'name.unique' => 'Name already exist',
                'description.required' => 'Description is required',
                'geom_polygon.required' => 'Geometry polygon is required',
                'username.required' => 'Username is required',
                'land_use_change.required' => 'Land Use Change is required',
                'contact_person.required' => 'Contact Person is required',
            ]
        );

        //Create images directory
        if (!is_dir('storage/images')) {
            mkdir('./storage/images', 0777);
        }

        // Handle image file
        $name_image = $this->uploadFile($request, 'image');

        // Handle document uploads
        $surat_permohonan = $this->uploadFile($request, 'surat_permohonan');
        $foto_ktp = $this->uploadFile($request, 'foto_ktp');
        $sertifikat_tanah = $this->uploadFile($request, 'sertifikat_tanah');
        $foto_lokasi = $this->uploadFile($request, 'foto_lokasi');

        $data = [
            'geom' => $request->geom_polygon,
            'name' => $request->name,
            'description' => $request->description,
            'image' => $name_image,
            'username' => $request->username,
            'land_use_change' => $request->land_use_change,
            'description_suggestion' => $request->description_suggestion,
            'surat_permohonan' => $surat_permohonan,
            'foto_ktp' => $foto_ktp,
            'sertifikat_tanah' => $sertifikat_tanah,
            'foto_lokasi' => $foto_lokasi,
            'contact_person' => $request->contact_person,
            'geometry' => $request->geom_polygon,
            'type' => 'Polygon',
            'status' => 'pending',
            'user_id' => auth()->user()->id,
        ];

        //Create data
        if (!$this->polygon->create($data)) {
            return redirect()->route('map')->with('error', 'Polygon failed to add');
        }

        return redirect()->route('map')->with('success', 'Polygon has been added');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        $data = [
            'title' => 'Edit Polygon',
            'id' => $id,
        ];
        return view('edit-polygon', $data);
    }

    public function update(Request $request, string $id)
    {
        // Validate data
        $request->validate(
            [
                'name' => 'required|unique:polygon,name,' . $id,
                'description' => 'required',
                'geom_polygon' => 'required',
                'image' => 'nullable|mimes:jpeg,png,jpg,gif,svg|max:10000',
                'username' => 'required',
                'land_use_change' => 'required',
                'contact_person' => 'required',
                'surat_permohonan' => 'nullable|mimes:pdf|max:10000',
                'foto_ktp' => 'nullable|mimes:jpeg,png,jpg|max:5000',
                'sertifikat_tanah' => 'nullable|mimes:pdf,jpeg,png,jpg|max:10000',
                'foto_lokasi' => 'nullable|mimes:jpeg,png,jpg|max:5000',
            ],
            [
                'name.required' => 'Name is required',
                'name.unique' => 'Name already exist',
                'description.required' => 'Description is required',
                'geom_polygon.required' => 'Geometry polygon is required',
                'username.required' => 'Username is required',
                'land_use_change.required' => 'Land Use Change is required',
                'contact_person.required' => 'Contact Person is required',
            ]
        );

        if (!is_dir('storage/images')) {
            mkdir('./storage/images', 0777);
        }

        $polygon = $this->polygon->find($id);

        // Handle image update
        $name_image = $this->uploadFile($request, 'image', $polygon->image);

        // Handle document updates
        $surat_permohonan = $this->uploadFile($request, 'surat_permohonan', $polygon->surat_permohonan);
        $foto_ktp = $this->uploadFile($request, 'foto_ktp', $polygon->foto_ktp);
        $sertifikat_tanah = $this->uploadFile($request, 'sertifikat_tanah', $polygon->sertifikat_tanah);
        $foto_lokasi = $this->uploadFile($request, 'foto_lokasi', $polygon->foto_lokasi);

        $data = [
            'geom' => $request->geom_polygon,
            'name' => $request->name,
            'description' => $request->description,
            'image' => $name_image,
            'username' => $request->username,
            'land_use_change' => $request->land_use_change,
            'description_suggestion' => $request->description_suggestion,
            'surat_permohonan' => $surat_permohonan,
            'foto_ktp' => $foto_ktp,
            'sertifikat_tanah' => $sertifikat_tanah,
            'foto_lokasi' => $foto_lokasi,
            'contact_person' => $request->contact_person,
            'geometry' => $request->geom_polygon,
            'type' => 'Polygon',
        ];

        if (!$polygon->update($data)) {
            return redirect()->route('map')->with('error', 'Polygon failed to update');
        }

        return redirect()->route('map')->with('success', 'Polygon has been updated');
    }

    public function destroy(string $id)
    {
        $polygon = $this->polygon->find($id);

        $this->deleteFile($polygon->image);
        $this->deleteFile($polygon->surat_permohonan);
        $this->deleteFile($polygon->foto_ktp);
        $this->deleteFile($polygon->sertifikat_tanah);
        $this->deleteFile($polygon->foto_lokasi);

        if (!$polygon->delete()) {
            return redirect()->route('map')->with('error', 'Polygon failed to delete');
        }

        return redirect()->route('map')->with('success', 'Polygon has been deleted');
    }

    private function uploadFile($request, $field, $oldFile = null)
    {
        if ($request->hasFile($field)) {
            $file = $request->file($field);
            $fileName = time() . "_" . $field . "." . strtolower($file->getClientOriginalExtension());
            $file->move('storage/images', $fileName);

            // Delete old file
            if ($oldFile && file_exists('./storage/images/' . $oldFile)) {
                unlink('./storage/images/' . $oldFile);
            }

            return $fileName;
        }

        return $oldFile;
    }

    private function deleteFile($fileName)
    {
        if ($fileName && file_exists('./storage/images/' . $fileName)) {
            unlink('./storage/images/' . $fileName);
        }
    }
}

<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\tag;
use Illuminate\Http\Request;
use Str;
use Validator;

class Tagcontroller extends Controller
{
    public function index()
    {
        $tag = Tag::latest()->get();
        $res = [
            'succes' => true,
            'message' => 'Daftar Tag',
            'data' => $tag,
        ];
        return response()->json($res, 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_tag' => 'required|unique:tags',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'succes' => false,
                'message' => 'Validasi ,gagal',
                'errors' => $validator->errors(),
            ], 422);
        }

        try {
            $tag = new Tag();
            $tag->nama_tag = $request->nama_tag;
            $tag->slug = Str::slug($request->nama_tag);
            $tag->save();
            return response()->json([
                'succes' => true,
                'message' => 'data berhasil dibuat',
                'data' => $tag,
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'succes' => false,
                'message' => 'terjadi kesalahan',
                'errors' => $e->getMessage(),
            ], 500);
        }
    }

    public function show($id)
    {
        try {
            $tag = Tag::findOrFail($id);
            return response()->json([
                'success' => true,
                'message' => 'detail tag',
                'data' => $tag,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'data tidak ditemukan',
                'errors' => $e->getMessage(),
            ], 404);
        }
    }

    public function update(Request $request , $id)
    {
        $validator = Validator::make($request->all(), [
            'nama_tag' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'succes' => false,
                'message' => 'Validasi ,gagal',
                'errors' => $validator->errors(),
            ], 422);
        }

        try {
            $tag = Tag::findOrFail($id);
            $tag->nama_tag = $request->nama_tag;
            $tag->slug = Str::slug($request->nama_tag);
            $tag->save();
            return response()->json([
                'succes' => true,
                'message' => 'data berhasil diperbaharui',
                'data' => $tag,
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'succes' => false,
                'message' => 'terjadi kesalahan',
                'errors' => $e->getMessage(),
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $tag = Tag::findOrFail($id);
            return response()->json([
                'success' => true,
                'message' => 'tag' . $tag->nama_tag. 'berhasil dihapus',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'data tidak ditemukan',
                'errors' => $e->getMessage(),
            ], 404);
        }
    }
}

<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SiswaModel;
use DB;
use Illuminate\Support\Facades\Validator;
use DataTables; 

class SiswaController extends Controller
{
    public function index()
    {
        return view('backend/pages/siswa/index',[
            'active' => 'siswa',
        ]);
    }

    public function create()
    {
        return view('backend/pages/siswa/form',[
            'active' => 'siswa',
            'url' => 'siswa',
            'kategori' => $kategori,
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'siswa_nis'         => 'required|numeric',
            'siswa_nama'         => 'required',
            'siswa_tgl_lahir'         => 'required',
            'siswa_jekel'         => 'required',
            'siswa_notelp'         => 'required|numeric',
            'siswa_alamat'         => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => 'false',
                'message' => 'error',
                'data'  => $validator->getMessageBag()->toArray(),
            ], 400);
        }

        if($request->siswa_id == NULL){
            $siswa = new SiswaModel;
            $siswa->siswa_nis = $request->input('siswa_nis');
            $siswa->siswa_nama = $request->input('siswa_nama');
            $siswa->siswa_tgl_lahir = $request->input('siswa_tgl_lahir');
            $siswa->siswa_jekel = $request->input('siswa_jekel');
            $siswa->siswa_notelp = $request->input('siswa_notelp');
            $siswa->siswa_alamat = $request->input('siswa_alamat');
            $siswa->save();

            return response()->json([
                    'success' => 'true',
                    'message' => 'Data berhasil ditambahkan',
            ], 201);
        }else{
            $siswa = SiswaModel::find($request->siswa_id);
            
            $siswa->siswa_nis = $request->input('siswa_nis');
            $siswa->siswa_nama = $request->input('siswa_nama');
            $siswa->siswa_tgl_lahir = $request->input('siswa_tgl_lahir');
            $siswa->siswa_jekel = $request->input('siswa_jekel');
            $siswa->siswa_notelp = $request->input('siswa_notelp');
            $siswa->siswa_alamat = $request->input('siswa_alamat');
            $siswa->save();

            return response()->json([
                    'success' => 'true',
                    'message' => 'Data berhasil diedit',
            ], 201);
        }
    }

    public function edit(Request $request)
    {
        $siswa = SiswaModel::findOrfail($request->id);
        return response()->json([
            'success' => 'true',
            'message' => 'Data berhasil diambil',
            'data' => $siswa
        ], 200);
    }

    public function destroy(SiswaModel $siswa)
    {
        $siswa->forceDelete();

        return redirect()
            ->route('siswa')
            ->with('message', 'Data berhasil dihapus');
    }

    // api
    public function apiSiswa(Request $request)
    {
        if ($request->ajax()) {
            $data = DB::table('tb_siswa')
                    ->get();

            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('option', function($row){
                        $actionBtn = '
                                    <button type="button" class="btn btn-warning btn-sm" onclick="mForm(' . "'" . $row->siswa_id . "'" . ')"><i class="fa fa-edit"></i> Edit</button>
                                    <button type="button" class="btn btn-danger btn-sm" onclick="mHapus(' . "'" . route('siswa.delete', $row->siswa_id) . "'" . ')"><i class="fa fa-trash"></i> Delete</button>';
                        return $actionBtn;
                    })
                    ->rawColumns(['option'])
                    ->make(true);
        }
    }
}

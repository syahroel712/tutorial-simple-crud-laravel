<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BukuModel;
use DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Image;

class BukuController extends Controller
{
    public function index()
    {
        $buku = BukuModel::all();
        
        return view(
            'backend/pages/buku/index',
            [
                'active' => 'buku',
                'buku' => $buku,
            ]
        );
    }

    public function create()
    {
        return view(
            'backend/pages/buku/form',
            [
                'active' => 'buku',
                'url' => 'buku.store'
            ]
        );
    }

    public function store(Request $request, BukuModel $buku)
    {
        $validator = Validator::make($request->all(), [
            'buku_isbn'             => 'required|unique:tb_buku,buku_isbn',
            'buku_judul'            => 'required',
            'buku_hal'              => 'required|numeric',
            'buku_deskripsi'        => 'required',
            'buku_status'           => 'required',
            'buku_foto'             => 'sometimes|mimes:png,jpg,jpeg|max:2000',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->route('buku.create')
                ->withErrors($validator)
                ->withInput();
        }

        if ($request->hasFile('buku_foto')) {
            $foto = $request->file('buku_foto');
            $filename = time() . "." . $foto->getClientOriginalExtension();
            $img = Image::make($foto->getRealPath());
            $img->resize(700, 700, function ($constraint) {
                $constraint->aspectRatio();
            })->save('images/buku/' . $filename);
            $buku->buku_foto = $filename;
        }else{
            $buku->buku_foto = 'example.jpg';
        }

        $buku->buku_isbn = $request->input('buku_isbn');
        $buku->buku_judul = $request->input('buku_judul');
        $buku->buku_hal = $request->input('buku_hal');
        $buku->buku_deskripsi = $request->input('buku_deskripsi');
        $buku->buku_status = $request->input('buku_status');
        $buku->save();

        return redirect()
            ->route('buku')
            ->with('message', 'Data berhasil ditambahkan');
    }

    public function edit(BukuModel $buku)
    {
        return view(
            'backend/pages/buku/form',
            [
                'active' => 'buku',
                'buku' => $buku,
                'url' => 'buku.update',
            ]
        );
    }

    public function update(Request $request, BukuModel $buku)
    {
        $validator = Validator::make($request->all(),[
            'buku_isbn'             => [
                                            'required', 
                                            Rule::unique('tb_buku')->ignore($buku->buku_id,'buku_id')
                                        ],
            'buku_judul'            => 'required',
            'buku_hal'              => 'required|numeric',
            'buku_deskripsi'        => 'required',
            'buku_status'           => 'required',
            'buku_foto'             => 'sometimes|mimes:png,jpg,jpeg',
        ]);

        if($validator->fails()){
            return redirect()
                ->route('buku.update', $buku->buku_id)
                ->withErrors($validator)
                ->withInput();
        }

        if ($request->hasFile('buku_foto')) {
            if($buku->buku_foto != 'example.jpg'){
                unlink('images/buku/' . $buku->buku_foto);
            }
            $foto = $request->file('buku_foto');
            $filename = time() . "." . $foto->getClientOriginalExtension();
            $img = Image::make($foto->getRealPath());
            $img->resize(700, 700, function ($constraint) {
                $constraint->aspectRatio();
            })->save('images/buku/' . $filename);
            $buku->buku_foto = $filename;
        }

        $buku->buku_isbn = $request->input('buku_isbn');
        $buku->buku_judul = $request->input('buku_judul');
        $buku->buku_hal = $request->input('buku_hal');
        $buku->buku_deskripsi = $request->input('buku_deskripsi');
        $buku->buku_status = $request->input('buku_status');
        $buku->save();

        return redirect()
            ->route('buku')
            ->with('message', 'Data berhasil diedit');
    }

    public function destroy(BukuModel $buku)
    {
        $buku_foto = $buku->buku_foto;
        if($buku_foto != 'example.jpg'){
            unlink('images/buku/' . $buku_foto);
        }
        $buku->forceDelete();
        
        return redirect()
            ->route('buku')
            ->with('message', 'Data berhasil dihapus');
    }    
}

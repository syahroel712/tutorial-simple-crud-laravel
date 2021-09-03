@extends('backend/layouts/app')
@section('content')

<section class="section">
    <div class="section-header">
        <h1>Buku</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">App Admin</a></div>
            <div class="breadcrumb-item">Buku</div>
        </div>
    </div>

    <div class="section-body">
        <h2 class="section-title">Form Buku</h2>
        <p class="section-lead">
            &nbsp;
        </p>

        <div class="row">
            <div class="col-12 col-md-12 col-lg-12">
                <div class="card">
                    <form action="{{ route($url, $buku->buku_id ?? null) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @if(isset($buku))
                        @method('put')
                        @endif
                        <div class="card-header">
                            <a href="{{ route('buku') }}" class="btn btn-primary"><i class="fa fa-arrow-left"></i>
                                Back</a>
                        </div>

                        <div class="card-body">
                            <div class="form-group">
                                <label>ISBN</label>
                                <input type="text" class="form-control @error('buku_isbn') {{ 'is-invalid' }} @enderror"
                                    name="buku_isbn" value="{{ old('buku_isbn') ?? $buku->buku_isbn ?? '' }}">
                                @error('buku_isbn')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Judul</label>
                                <input type="text"
                                    class="form-control @error('buku_judul') {{ 'is-invalid' }} @enderror"
                                    name="buku_judul" value="{{ old('buku_judul') ?? $buku->buku_judul ?? '' }}">
                                @error('buku_judul')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Halaman</label>
                                <input type="text"
                                    class="form-control number @error('buku_hal') {{ 'is-invalid' }} @enderror"
                                    name="buku_hal" value="{{ old('buku_hal') ?? $buku->buku_hal ?? '' }}">
                                @error('buku_hal')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Foto</label>
                                <input type="file" class="form-control @error('buku_foto') {{ 'is-invalid' }} @enderror"
                                    name="buku_foto" >
                                @error('buku_foto')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Deskripsi</label>
                                <textarea name="buku_deskripsi" id="buku_deskripsi" cols="20" rows="10"
                                    class="form-control textarea @error('buku_deskripsi') {{ 'is-invalid' }} @enderror"
                                    name="buku_deskripsi"
                                    id="buku_deskripsi">{{ old('buku_deskripsi') ?? $buku->buku_deskripsi ?? '' }}</textarea>
                                @error('buku_deskripsi')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Status</label>
                                <select class="custom-select select2bs4 @error('buku_status') {{ 'is-invalid' }} @enderror"
                                    name="buku_status" id="buku_status">
                                    <option value="">-- Pilih --</option>
                                    <option value="Tersedia">Tersedia</option>
                                    <option value="Kosong">Kosong</option>
                                </select>

                                @if( old('buku_status') != '' )
                                <script>
                                    document.getElementById('buku_status').value = "{{ old('buku_status') }}"

                                </script>
                                @endif

                                @if(isset($buku))
                                <script>
                                    document.getElementById('buku_status').value = '<?php echo $buku->buku_status ?>'

                                </script>
                                @endif

                                @error('buku_status')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="card-footer">
                            <button class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@extends('backend/layouts/app')
@section('content')
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Kategori</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">SWIMOC POS</a></li>
                                <li class="breadcrumb-item active">Kategori</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <!-- Default box -->
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title"><a class="btn btn-primary btn-sm text-white" href="{{ route('kategori') }}"><i class="fa fa-arrow-left"></i> Back</a></h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse"
                                            data-toggle="tooltip" title="Collapse">
                                            <i class="fas fa-minus"></i></button>
                                        <button type="button" class="btn btn-tool" data-card-widget="remove"
                                            data-toggle="tooltip" title="Remove">
                                            <i class="fas fa-times"></i></button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <form class="form-horizontal" action="{{ route($url, $kategori->kategori_id ?? null) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @if(isset($kategori))
                                        @method('put')
                                        @endif
                                        <div class="card-body">
                                            <div class="form-group">
                                                <label>Nama</label>
                                                <input type="text" class="form-control @error('kategori_nama') {{ 'is-invalid' }} @enderror" name="kategori_nama" id="kategori_nama" value="{{ old('kategori_nama') ?? $kategori->kategori_nama ?? '' }}">
                                                @error('kategori_nama')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label>Status</label>
                                                <select class="custom-select @error('kategori_status') {{ 'is-invalid' }} @enderror" name="kategori_status" id="kategori_status">
                                                    <option value="">-- Pilih --</option>
                                                    <option value="On">On</option>
                                                    <option value="Off">Off</option>
                                                </select>
                                                
                                                @if( old('kategori_status') != ''  )
                                                <script>
                                                    document.getElementById('kategori_status').value = "{{ old('kategori_status') }}"
                                                </script>
                                                @endif
                                                @if(isset($kategori))
                                                <script>
                                                    document.getElementById('kategori_status').value = '<?php echo $kategori->kategori_status ?>'
                                                </script>
                                                @endif
                                                @error('kategori_status')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <button type="submit" class="btn btn-primary">Save</button>
                                        </div>
                                    </form>
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    
                                </div>
                                <!-- /.card-footer-->
                            </div>
                            <!-- /.card -->
                        </div>
                    </div>
                </div>
            </section>
            <!-- /.content -->
@endsection
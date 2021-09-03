@extends('backend/layouts/app')
@section('content')
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Supplier</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">SWIMOC POS</a></li>
                                <li class="breadcrumb-item active">Supplier</li>
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
                                    <h3 class="card-title"><a class="btn btn-primary btn-sm text-white" href="{{ route('supplier') }}"><i class="fa fa-arrow-left"></i> Back</a></h3>
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
                                    <form class="form-horizontal" action="{{ route($url, $supplier->supplier_id ?? null) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @if(isset($supplier))
                                        @method('put')
                                        @endif
                                        <div class="card-body">
                                            <div class="form-group">
                                                <label>Nama</label>
                                                <input type="text" class="form-control @error('supplier_nama') {{ 'is-invalid' }} @enderror" name="supplier_nama" id="supplier_nama" value="{{ old('supplier_nama') ?? $supplier->supplier_nama ?? '' }}">
                                                @error('supplier_nama')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label>No Telpon</label>
                                                <input type="text" class="form-control number @error('supplier_notelp') {{ 'is-invalid' }} @enderror" name="supplier_notelp" id="supplier_notelp" value="{{ old('supplier_notelp') ?? $supplier->supplier_notelp ?? '' }}">
                                                @error('supplier_notelp')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label>Alamat</label>
                                                <textarea class="form-control @error('supplier_nama') {{ 'is-invalid' }} @enderror" name="supplier_alamat" id="supplier_alamat" rows="2">{{ old('supplier_alamat') ?? $supplier->supplier_alamat ?? '' }}</textarea>
                                                @error('supplier_alamat')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label>Status</label>
                                                <select class="custom-select @error('supplier_status') {{ 'is-invalid' }} @enderror" name="supplier_status" id="supplier_status">
                                                    <option value="">-- Pilih --</option>
                                                    <option value="On">On</option>
                                                    <option value="Off">Off</option>
                                                </select>
                                                
                                                @if( old('supplier_status') != ''  )
                                                <script>
                                                    document.getElementById('supplier_status').value = "{{ old('supplier_status') }}"
                                                </script>
                                                @endif
                                                @if(isset($supplier))
                                                <script>
                                                    document.getElementById('supplier_status').value = '<?php echo $supplier->supplier_status ?>'
                                                </script>
                                                @endif
                                                @error('supplier_status')
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
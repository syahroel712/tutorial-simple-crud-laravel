@extends('backend/layouts/app')
@section('content')
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Admin</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">SWIMOC POS</a></li>
                                <li class="breadcrumb-item active">Admin</li>
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
                                    <h3 class="card-title"><a class="btn btn-primary btn-sm text-white" href="{{ route('admin') }}"><i class="fa fa-arrow-left"></i> Back</a></h3>
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
                                    <form class="form-horizontal" action="{{ route($url, $admin->admin_id ?? null) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @if(isset($admin))
                                        @method('put')
                                        @endif
                                        <div class="card-body">
                                            <div class="form-group">
                                                <label>Nama</label>
                                                <input type="text" class="form-control @error('admin_nama') {{ 'is-invalid' }} @enderror" name="admin_nama" id="admin_nama" value="{{ old('admin_nama') ?? $admin->admin_nama ?? '' }}">
                                                @error('admin_nama')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label>Username</label>
                                                <input type="text" class="form-control @error('admin_username') {{ 'is-invalid' }} @enderror" name="admin_username" id="admin_username" value="{{ old('admin_username') ?? $admin->admin_username ?? '' }}">
                                                @error('admin_username')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label>Password</label>
                                                <input type="password" class="form-control @error('admin_password') {{ 'is-invalid' }} @enderror" name="admin_password" id="admin_password" value="{{ old('admin_password') ?? '' }}">
                                                @if(isset($admin))
                                                <span style="color: red; font-style: italic; font-size: 14px;">* Abaikan jika tidak ingin ganti password</span>
                                                @endif
                                                @error('admin_password')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label>No Telpon</label>
                                                <input type="text" class="form-control number-telp @error('admin_notelp') {{ 'is-invalid' }} @enderror" name="admin_notelp" id="admin_notelp" value="{{ old('admin_notelp') ?? $admin->admin_notelp ?? '' }}">
                                                @error('admin_notelp')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label>Alamat</label>
                                                <textarea class="form-control @error('admin_nama') {{ 'is-invalid' }} @enderror" name="admin_alamat" id="admin_alamat" rows="2">{{ old('admin_alamat') ?? $admin->admin_alamat ?? '' }}</textarea>
                                                @error('admin_alamat')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label>Level</label>
                                                <select class="custom-select @error('admin_level') {{ 'is-invalid' }} @enderror" name="admin_level" id="admin_level">
                                                    <option value="">-- Pilih --</option>
                                                    <option value="admin">Admin</option>
                                                    <option value="kasir">Kasir</option>
                                                </select>
                                                
                                                @if( old('admin_level') != ''  )
                                                <script>
                                                    document.getElementById('admin_level').value = "{{ old('admin_level') }}"
                                                </script>
                                                @endif
                                                @if(isset($admin))
                                                <script>
                                                    document.getElementById('admin_level').value = '<?php echo $admin->admin_level ?>'
                                                </script>
                                                @endif
                                                @error('admin_level')
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
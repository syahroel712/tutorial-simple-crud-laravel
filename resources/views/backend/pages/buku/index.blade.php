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
        <h2 class="section-title">Data Buku</h2>
        <p class="section-lead">
            Beri keterangan disini
        </p>

        <div class="alert alert-success alert-has-icon" style="display:none" id="message">
            <div class="alert-icon"><i class="far fa-lightbulb"></i></div>
            <div class="alert-body">
                <div class="alert-title">Success</div>
                {{ session()->get('message') }}
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <a href="{{ route('buku.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Add</a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped example1" id="table-1">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>ISBN</th>
                                        <th>Judul</th>
                                        <th>Halaman</th>
                                        <th>Deskripsi</th>
                                        <th>Status</th>
                                        <th>Create At</th>
                                        <th>Foto</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($buku as $no => $bk)
                                    <tr>
                                        <td>{{ $no+1 }}</td>
                                        <td>{{ $bk->buku_isbn }}</td>
                                        <td>{{ $bk->buku_judul }}</td>
                                        <td>{{ number_format($bk->buku_hal) }}</td>
                                        <td>{!! Str::limit($bk->buku_deskripsi, 300) !!}</td>
                                        <td><span style="color: <?php echo ($bk->buku_status == 'Tersedia') ? 'blue' : 'red' ?>">{{ $bk->buku_status }}</span></td>
                                        <td>{{ \Carbon\Carbon::parse($bk->created_at)->isoFormat('D MMMM Y') }}</td>
                                        <td>
                                            <img src="{{ asset('images/buku/'. $bk->buku_foto) }}" alt="Load Gagal" style="width: 250px;">
                                        </td>
                                        <td>
                                            <a href="{{ route('buku.edit', $bk->buku_id) }}" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i> Update</a>
                                            <button type="button" class="btn btn-danger btn-sm" onclick="mHapus('{{ route('buku.delete', $bk->buku_id) }}')"><i class="fa fa-trash"></i> Delete</button>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>

<!-- modal hapus -->
<div class="modal fade" id="modalHapus" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Delete Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" method="POST" id="formDelete">
                <div class="modal-body">
                    @csrf
                    @method('delete')
                    Yakin Hapus Data ?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-info">Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // untuk hapus data
    function mHapus(url) {
        $('#modalHapus').modal()
        $('#formDelete').attr('action', url);
    }

</script>

@if(session()->has('message'))
<script>
    $('#message').show();
    setInterval(function () {
        $('#message').hide();
    }, 5000);

</script>
@endif

@endsection

@extends('backend/layouts/app')
@section('content')
<section class="section">
    <div class="section-header">
        <h1>Siswa</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">App Admin</a></div>
            <div class="breadcrumb-item">Siswa</div>
        </div>
    </div>

    <div class="section-body">
        <h2 class="section-title">Data Siswa</h2>
        <p class="section-lead">
            Beri keterangan disini
        </p>

        <div class="alert alert-success alert-has-icon" style="display:none" id="message">
            <div class="alert-icon"><i class="far fa-lightbulb"></i></div>
            <div class="alert-body">
                <div class="alert-title">Success</div>
                <p id="message_text"></p>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <button onclick="mForm()" class="btn btn-primary"><i class="fa fa-plus"></i> Add</button>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped yajra-example" id="table-1">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>NIS</th>
                                        <th>Nama</th>
                                        <th>Tanggal Lahir</th>
                                        <th>Jekel</th>
                                        <th>No Telpon</th>
                                        <th>Alamat</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>

<!-- modal form -->
<div class="modal fade" id="modalForm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Form Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="siswa_id">
                <div class="form-group">
                    <label>NIS</label>
                    <input type="text" class="form-control number @error('siswa_nis') {{ 'is-invalid' }} @enderror"
                        name="siswa_nis" id="siswa_nis" value="{{ old('siswa_nis') ?? $buku->siswa_nis ?? '' }}">
                </div>
                <div class="form-group">
                    <label>Nama</label>
                    <input type="text"
                        class="form-control @error('siswa_nama') {{ 'is-invalid' }} @enderror"
                        name="siswa_nama" id="siswa_nama" value="{{ old('siswa_nama') ?? $buku->siswa_nama ?? '' }}">
                </div>
                <div class="form-group">
                    <label>Tanggal Lahir</label>
                    <input type="date"
                        class="form-control @error('siswa_tgl_lahir') {{ 'is-invalid' }} @enderror"
                        name="siswa_tgl_lahir" id="siswa_tgl_lahir" value="{{ old('siswa_tgl_lahir') ?? $buku->siswa_tgl_lahir ?? '' }}">
                </div>
                <div class="form-group">
                    <label>Jenis Kelamin</label>
                    <select class="custom-select @error('siswa_jekel') {{ 'is-invalid' }} @enderror"
                        name="siswa_jekel" id="siswa_jekel">
                        <option value="">-- Pilih --</option>
                        <option value="Laki laki">Laki laki</option>
                        <option value="Perempuan">Perempuan</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>No Telpon</label>
                    <input type="text"
                        class="form-control number @error('siswa_notelp') {{ 'is-invalid' }} @enderror"
                        name="siswa_notelp" id="siswa_notelp" value="{{ old('siswa_notelp') ?? $buku->siswa_notelp ?? '' }}">
                </div>
                <div class="form-group">
                    <label>Alamat</label>
                    <input type="text"
                        class="form-control @error('siswa_alamat') {{ 'is-invalid' }} @enderror"
                        name="siswa_alamat" id="siswa_alamat" value="{{ old('siswa_alamat') ?? $buku->siswa_alamat ?? '' }}">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button class="btn btn-primary" onclick="save()">Submit</button>
            </div>
        </div>
    </div>
</div>

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
    // untuk form
    function mForm(id = null) {

        if(id != null){
            $.ajax({
                type: "POST",
                url: "{{ route('siswa.edit') }}",
                data: {
                    '_token' : '{{ csrf_token() }}',
                    'id' : id
                },
                dataType: "JSON",
                success: function (res) {
                    $('#siswa_nis').val(res.data.siswa_nis);
                    $('#siswa_nama').val(res.data.siswa_nama);
                    $('#siswa_tgl_lahir').val(res.data.siswa_tgl_lahir);
                    $('#siswa_jekel').val(res.data.siswa_jekel).change();
                    $('#siswa_notelp').val(res.data.siswa_notelp);
                    $('#siswa_alamat').val(res.data.siswa_alamat);
                }
            });
        }

        $('#siswa_id').val(id);
        $('#modalForm').modal()
    }

    // untuk hapus data
    function mHapus(url) {
        $('#modalHapus').modal()
        $('#formDelete').attr('action', url);
    }

    // untuk simpan
    function save() {  
        var siswa_id = $('#siswa_id').val();
        var siswa_nis = $('#siswa_nis').val();
        var siswa_nama = $('#siswa_nama').val();
        var siswa_tgl_lahir = $('#siswa_tgl_lahir').val();
        var siswa_jekel = $('#siswa_jekel').val();
        var siswa_notelp = $('#siswa_notelp').val();
        var siswa_alamat = $('#siswa_alamat').val();

        $.ajax({
            type: "POST",
            url: "{{ route('siswa.save') }}",
            data: {
                '_token' : '{{ csrf_token() }}',
                'siswa_id' : siswa_id,
                'siswa_nis' : siswa_nis,
                'siswa_nama' : siswa_nama,
                'siswa_tgl_lahir' : siswa_tgl_lahir,
                'siswa_jekel' : siswa_jekel,
                'siswa_notelp' : siswa_notelp,
                'siswa_alamat' : siswa_alamat,
            },
            dataType: "JSON",
            success: function (res) {
                location.reload();
            },
            error: function (res) { 
                var errors = res.responseJSON.data;
                $( ".text-strong" ).remove();
                $.each(errors, function (key, val) {
                    $(document).find('[name='+key+']').after('</div><span class="text-strong text-danger">' +val[0]+ '</span>')
                });
            },
        });

    }

</script>


<script>
    $(document).ready(function () {
        var table = $('.yajra-example').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('siswa.list') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'siswa_nis', name: 'siswa_nis'},
                {data: 'siswa_nama', name: 'siswa_nama'},
                {
                    data: 'siswa_tgl_lahir',
                    name: 'siswa_tgl_lahir',
                    render: $.fn.dataTable.render.moment('YYYY-MM-DD','DD/MM/YYYY')
                },
                {data: 'siswa_jekel', name: 'siswa_jekel'},
                {data: 'siswa_notelp', name: 'siswa_notelp'},
                {data: 'siswa_alamat', name: 'siswa_alamat'},
                {
                    data: 'option', 
                    name: 'option', 
                    orderable: true, 
                    searchable: true
                },
            ]
        });
    });
</script>


@endsection

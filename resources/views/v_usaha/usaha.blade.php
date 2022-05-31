@extends('layout/template')
@section('title', 'Izin Usaha')
@section('content')

@if (session('pesan'))
<div class="alert alert-success alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <h4><i class="icon fa fa-check"></i> Berhasil!</h4>
    {{session('pesan')}}
</div>
@endif
<section class="content">
    <div class="row">
        <div class="col-xs-15">
            <div class="box">
                <div class="box-header">
                    <a href="add" class="btn btn-success btn-sm">Tambah Data</a>
                    <div class="btn-group">
                        <button type="button" class="btn btn-primary btn-sm">Cetak Laporan</button>
                        <button type="button" class="btn btn-primary dropdown-toggle btn-sm" data-toggle="dropdown" aria-expanded="false">
                            <span class="caret"></span>
                            <span class="sr-only">Toggle Dropdown</span>
                        </button>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="formkegiatan">Laporan Kegiatan</a></li>
                            <li><a href="formpenerimaan">Penerimaan Biaya</a></li>
                            <li><a href="klasifikasiretri">Klasifikasi Retribusi</a></li>
                        </ul>
                    </div>
                    <div class="box-tools">
                        <br>
                        <form action="/v_usaha/usaha" method="get">
                            <div class="input-group input-group-sm" style="width: 300px;">
                                <input type="text" name="search" class="form-control" placeholder="Cari berdasarkan nama pemilik, perusahaan, dan trayek">
                                <div class="input-group-btn">
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <tr>
                            <th>No</th>
                            <th>No. Uji</th>
                            <th>Pemilik</th>
                            <th>Perusahaan</th>
                            <th>Tanggal Terbit</th>
                            <th>Aksi</th>
                        </tr>
                        <?php $no = 1; ?>
                        @foreach ($usaha as $data)
                        <tr>
                            <td>{{$no++}}</td>
                            <td>{{$data->no_uji}}</td>
                            <td>{{$data->pemilik}}</td>
                            <td>{{$data->perusahaan}}</td>
                            <td>{{Carbon\Carbon::parse($data->terbit)->isoFormat('d MMMM Y')}}</td>
                            <td>
                                <a href="/v_usaha/detail/{{$data->id}}" class="btn btn-sm btn-info">Detail</a>
                                <a href="/v_usaha/edit/{{$data->id}}" class="btn btn-sm btn-warning">Edit</a>
                                <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#delete{{$data->id}}">
                                    Hapus
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </table>
                </div>
                <div class="box-footer clearfix">
                    <div class="d-flex justify-content-center">
                        <p>Halaman saat ini : <b>{{$usaha->currentPage() }}</b></p>
                        <p>Jumlah Data : <b>{{$usaha->total() }}</b></p>
                        <p>Data perhalaman : <b>{{$usaha->perPage() }}</b></p>
                        {{$usaha->links()}}
                    </div>
                </div>
            </div>
            <!-- /.box -->
        </div>
    </div>
</section>
@foreach ($usaha as $data)
<div class="modal modal-danger fade" id="delete{{$data->id}}">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">{{$data->pemilik}}</h4>
            </div>
            <div class="modal-body">
                <p>Apakah anda yakin ingin menghapus data ini?</p>
            </div>
            <div class="modal-footer">
                <a href="" class="btn btn-outline pull-left" data-dismiss="modal">Tidak</a>
                <a href="/v_usaha/delete/{{$data->id}}" class="btn btn-outline">Ya</a>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
@endforeach
@endsection
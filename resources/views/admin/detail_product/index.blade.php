@extends('admin.layouts.app')
@section('header')
<style>
    .ik {
        cursor: pointer;
    }

    #trHover:hover {
        background-color: #e6e6e6;
    }

</style>
@endsection
@section('iconHeader')
<i class="mdi mdi-sitemap bg-inverse"></i>
@endsection
@section('titleHeader')
Data Produk
@endsection
@section('subtitleHeader')
Produk
@endsection
@section('breadcrumb')
Data Produk
@endsection
@section('content-wrapper')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card-body">
                        <div class="dt-responsive">
                            <table id="dataTable" class="table table-striped table-bordered nowrap" style="width: 102%">
                                <thead>
                                    <tr>
                                        <th style="width: 3%"></th>
                                        <th>Nama Produk</th>
                                        <!-- <th>Nama Jenis Produk</th> -->
                                        <th>Asal</th>
                                        <th>Panen</th>
                                        <th>Kelas</th>
                                        <th>DB</th>
                                        <th>Sisa</th>
                                        <th>Produksi</th>
                                        <th>Masuk</th>
                                        <th>Keluar Komersial</th>
                                        <th>Keluar Non-Komersial</th>
                                        <th>Bulan</th>
                                        <th>Tahun</th>
                                        <th>Stock Bibit</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td></td>
                                        <th>Nama Produk</th>
                                        <!-- <th>Nama Jenis Produk</th> -->
                                        <th>Asal</th>
                                        <th>Panen</th>
                                        <th>Kelas</th>
                                        <th>DB</th>
                                        <th>Sisa</th>
                                        <th>Produksi</th>
                                        <th>Masuk</th>
                                        <th>Keluar Komersial</th>
                                        <th>Keluar Non-Komersial</th>
                                        <th>Bulan</th>
                                        <th>Tahun</th>
                                        <th>Stock Bibit</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>


        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Confirm to delete
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('detail-product.destroy', 'id') }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <div class="modal-body">
                            <input id="id" name="id" type="hidden">
                            You want to delete?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-danger">Ya</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>
<!-- /.content-wrapper -->
@endsection
@section('footer')
<script src="{{ url('assets/admin/dynamictable/dynamitable.jquery.min.js') }}"></script>
<script type="text/javascript">
    var _gaq = _gaq || [];
    _gaq.push(['_setAccount', 'UA-36251023-1']);
    _gaq.push(['_setDomainName', 'jqueryscript.net']);
    _gaq.push(['_trackPageview']);

    (function () {
        var ga = document.createElement('script');
        ga.type = 'text/javascript';
        ga.async = true;
        ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') +
            '.google-analytics.com/ga.js';
        var s = document.getElementsByTagName('script')[0];
        s.parentNode.insertBefore(ga, s);
    })();
    $(document).on('click', '.delete', function () {
        let id = $(this).attr('data-id');
        $('#id').val(id);
    });

</script>
<script type="text/javascript">
    $(document).ready(function () {

        $('#dataTable tfoot th').each(function () {
            var title = $('#dataTable thead th').eq($(this).index()).text();
            $(this).html('<input type="text" class="form-control" placeholder="' + title + '" />');
        });

        var table = $('#dataTable').DataTable({
            processing: true,
            serverSide: true,
            searching: true,
            "initComplete": function (settings, json) {
                $("#dataTable").wrap(
                    "<div class='scroll' style='overflow:auto; width:100%;position:relative;padding-left:20px;padding-bottom:20px'></div>"
                    );
            },
            ajax: "{{ route('detail-product.index') }}",
            columns: [{
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'product_name',
                    name: 'products.name'
                },
                // {
                //     data: 'nama',
                //     name: 'nama'
                // },
                {
                    data: 'asal',
                    name: 'asal'
                },
                {
                    data: 'panen',
                    name: 'panen'
                },
                {
                    data: 'kelas',
                    name: 'kelas'
                },
                {
                    data: 'db',
                    name: 'db'
                },
                {
                    data: 'sisa',
                    name: 'sisa'
                },
                {
                    data: 'produksi',
                    name: 'produksi'
                },
                {
                    data: 'masuk',
                    name: 'masuk'
                },
                {
                    data: 'keluar_komersial',
                    name: 'keluar_komersial'
                },
                {
                    data: 'keluar_nonkomersial',
                    name: 'keluar_nonkomersial'
                },
                {
                    data: 'bulan',
                    name: 'bulan'
                },
                {
                    data: 'tahun',
                    name: 'tahun',
                },
                {
                    data: 'stock',
                    name: 'stock',
                },
            ]
        });
        table.columns().eq(0).each(function (colIdx) {
            $('input', table.column(colIdx).footer()).on('keyup change', function () {
                console.log(colIdx + '-' + this.value);
                table
                    .column(colIdx)
                    .search(this.value)
                    .draw();
            });
        });
    });

</script>
@endsection

@section('fixedButton')
<a class="fixedButtonRefresh" href>
    <button data-toggle="tooltip" data-placement="top" title="" type="button" class="btn btn-icon btn-secondary "
        onclick="window.location.reload();" data-original-title="Refresh">
        <i class="ik ik-refresh-ccw"></i>
    </button>
</a>
<a class="fixedButtonAdd" href="{{route('detail-product.create')}}">
    <button data-toggle="tooltip" data-placement="top" title="" href="" class="btn btn-icon btn-info"
        data-original-title="Tambah">
        <i class="ik ik-plus"></i>
    </button>
</a>
@endsection

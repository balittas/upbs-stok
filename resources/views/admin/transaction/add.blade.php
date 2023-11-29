@extends('admin.layouts.app')
@section('css')
<link rel="stylesheet" href="{{url('assets/admin/plugins/select2/dist/css/select2.min.css')}}">
@endsection
@section('titleHeader')
Transaksi
@endsection
@section('subtitleHeader')
Tambah Transaksi
@endsection
@section('breadcrumb')
Transaksi
@endsection
@section('content-wrapper')
<input class="js-dynamic-enable" type="hidden"/>
<input class="js-dynamic-disable" type="hidden"/>

<input type="hidden" class="js-large" />
<input type="hidden" class="js-medium" />
<input type="hidden" class="js-small" />
<div class="row">
    <div class="col-sm-12" style="margin-bottom:20%">
        <div class="card">
            <div class="box-body" style="padding-bottom:50px">
                <form id="fileUploadForm" class="text-left border border-light p-5" action="{{route('transaction.store')}}" method="POST"
                    enctype="multipart/form-data" style="padding-bottom: 50px;">
                    @csrf

                    <div class="form-group">
                        <label>User</label>
                        <div class="input-group">
                            <span class="input-group-prepend">
                                <label class="input-group-text"><i class="ik ik-edit-1"></i></label>
                            </span>
                                <select name="user_id" class="select2 form-control" id="default-select">
                                        @foreach($users as $data)
                                        <option value="{{$data->id}}"
                                        >{{$data->name}}</option>
                                        @endforeach
                                </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Total Bayar</label>
                        <div class="input-group">
                            <span class="input-group-prepend">
                                <label class="input-group-text"><i class="ik ik-edit-1"></i></label>
                            </span>
                            <input type="text" class="form-control  " placeholder="Total Bayar" id="paid_total" required>
                            <input type="hidden" name="paid_total" class="paid_total">
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Status</label>
                        <div class="input-group">
                            <span class="input-group-prepend">
                                <label class="input-group-text"><i class="ik ik-edit-1"></i></label>
                            </span>
                            <select name="status" class="select2 form-control" id="default-select">
                                <option value="Cancel">Cancel</option>
                                <option value="Complete">Complete</option>
                                <option value="Pending">Pending</option>
                        </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Alamat</label>
                        <div class="input-group">
                            <span class="input-group-prepend">
                                <label class="input-group-text"><i class="ik ik-edit-1"></i></label>
                            </span>
                            <input type="text" class="form-control  " placeholder="Alamat" id="alamat" name="alamat" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Kode Pos</label>
                        <div class="input-group">
                            <span class="input-group-prepend">
                                <label class="input-group-text"><i class="ik ik-edit-1"></i></label>
                            </span>
                            <input type="text" class="form-control  " name="zip_code" placeholder="Kode Pos" id="zip_code" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Kabupaten/Kota</label>
                        <div class="input-group">
                            <span class="input-group-prepend">
                                <label class="input-group-text"><i class="ik ik-edit-1"></i></label>
                            </span>
                            <input type="text" class="form-control  " name="kabupaten_kota" placeholder="Kabupaten/Kota" id="kabupaten_kota" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Provinsi</label>
                        <div class="input-group">
                            <span class="input-group-prepend">
                                <label class="input-group-text"><i class="ik ik-edit-1"></i></label>
                            </span>
                            <input type="text" class="form-control  " name="provinsi" placeholder="Provinsi" id="provinsi" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>No Hp</label>
                        <div class="input-group">
                            <span class="input-group-prepend">
                                <label class="input-group-text"><i class="ik ik-edit-1"></i></label>
                            </span>
                            <input type="text" class="form-control  " name="no_hp"  placeholder="No Hp" id="no_hp" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Nama Penerima</label>
                        <div class="input-group">
                            <span class="input-group-prepend">
                                <label class="input-group-text"><i class="ik ik-edit-1"></i></label>
                            </span>
                            <input type="text" class="form-control  " name="nama_penerima" placeholder="Nama Penerima" id="nama_penerima" required>
                        </div>
                    </div>

                    <img id="output" width="50%" />
                    <div class="form-group">
                        <label>Bukti Transfer Produk</label>
                        <div class="input-group">
                            <span class="input-group-prepend">
                                <label class="input-group-text"><i class="ik ik-edit-1"></i></label>
                            </span>
                            <input accept="image/*" onchange="loadFile(event)" id="image" type="file"
                                class="form-control" name="bukti_transfer_produk" required>
                        </div>
                    </div>

                    <img id="output" width="50%" />
                    <div class="form-group">
                        <label>Bukti Transfer Ongkir</label>
                        <div class="input-group">
                            <span class="input-group-prepend">
                                <label class="input-group-text"><i class="ik ik-edit-1"></i></label>
                            </span>
                            <input accept="image/*" onchange="loadFile(event)" id="image" type="file"
                                class="form-control" name="bukti_transfer_ongkir" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Total Produk</label>
                        <div class="input-group">
                            <span class="input-group-prepend">
                                <label class="input-group-text"><i class="ik ik-edit-1"></i></label>
                            </span>
                            <input type="text" class="form-control  " placeholder="Total Produk" id="total_produk" required>
                            <input type="hidden" name="total_produk" class="total_ongkir">
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Total Ongkir</label>
                        <div class="input-group">
                            <span class="input-group-prepend">
                                <label class="input-group-text"><i class="ik ik-edit-1"></i></label>
                            </span>
                            <input type="text" class="form-control  " placeholder="Total Ongkir" id="total_ongkir" required>
                            <input type="hidden" name="total_ongkir" class="total_ongkir">
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Notes</label>
                        <div class="input-group">
                            <span class="input-group-prepend">
                                <label class="input-group-text"><i class="ik ik-edit-1"></i></label>
                            </span>
                            <input type="text" class="form-control  " name="order_notes" placeholder="Notes" id="order_notes" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="progress">
                            <div class="progress-bar progress-bar-striped progress-bar-animated bg-primary"
                                role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"
                                style="width: 0%"></div>
                        </div>
                    </div>

                    <div class="footer-buttons">
                        <a class="fixedButtonRefresh" href="{{route('transaction.index')}}">
                            <button data-toggle="tooltip" data-placement="top" title="" type="button"
                                class="btn btn-icon btn-secondary " data-original-title="Back">
                                <i class="ik ik-arrow-left"></i>
                            </button>
                        </a>
                        <a class="fixedButtonAdd">
                            <button data-toggle="tooltip" type="submit" data-placement="top" title="" href=""
                                class="btn btn-icon btn-info" data-original-title="Tambah">
                                <i class="ik ik-save"></i>
                            </button>
                        </a>
                    </div>
                </form>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
    <!-- /.col -->
</div>

@endsection
@section('fixedButton')

@endsection
@section('footer')

<script src="{{url('assets/admin/plugins/select2/dist/js/select2.min.js')}}"></script>
<script src="{{url('assets/admin/plugins/summernote/dist/summernote-bs4.min.js')}}"></script>
<script src="{{url('assets/admin/plugins/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js')}}"></script>
<script src="{{url('assets/admin/plugins/jquery.repeater/jquery.repeater.min.js')}}"></script>
<script src="{{url('assets/admin/plugins/mohithg-switchery/dist/switchery.min.js')}}"></script>
<script src="{{url('assets/admin/js/form-advanced.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.3.0/jquery.form.min.js"></script>

{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script> --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.css" rel="stylesheet"/>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<script>
    var loadFile = function (event) {
        var output = document.getElementById('output');
        output.src = URL.createObjectURL(event.target.files[0]);
        output.onload = function () {
            URL.revokeObjectURL(output.src)
        }
    };

</script>

<script>
    var SITEURL = "{{URL('/')}}";
    let validExt = ['jpg', 'png', 'jpeg'];

    function resetForm($form) {
        $form.find('input:file').val('');
    }
    $('input').on('change', function () {
        var extension = this.files[0].type.split('/')[1]
        console.log(this.files[0].type)
        if (validExt.indexOf(extension) == -1) {
            alert('Video extensions are allowed is jpg/png/jpeg');
            resetForm($('#fileUploadForm'));
        }
    });
    $(function () {
        uploadSuccess = function () {
            'use strict';
            resetToastPosition();
            $.toast({
                heading: 'Success',
                text: 'Transaksi berhasil ditambahkan',
                showHideTransition: 'slide',
                icon: 'success',
                loaderBg: '#f96868',
                position: 'top-right'
            })

        };
        $(document).ready(function () {
            $('#fileUploadForm').ajaxForm({
                beforeSend: function () {
                    var percentage = '0';
                },
                uploadProgress: function (event, position, total, percentComplete) {
                    var percentage = percentComplete;
                    $('.progress .progress-bar').css("width", percentage + '%',
                        function () {
                            return $(this).attr("aria-valuenow", percentage) + "%";
                        });
                },
                complete: function (xhr) {
                    var percentage = '0';
                    uploadSuccess();
                    setTimeout(function () {
                        window.location.href = SITEURL + "/" + "admin-page/transaction";
                    }, 3000);
                }
            });

        });
    });

</script>
<script>
    $('#paid_total').keyup(function (event) {
        if (event.which >= 37 && event.which <= 40) return;
        var number = $(this).val()
        $(this).val(format(number))
        $('.paid_total').val(deformat($(this).val()))
    })

    function format(value) {
        return value.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ".")
    }

    function deformat(value) {
        var number = ''
        for (const c of value) {
            if (c != '.') {
                number += c;
            }
        }
        return number;
    }
</script>
<script>
    $('#total_produk').keyup(function (event) {
        if (event.which >= 37 && event.which <= 40) return;
        var number = $(this).val()
        $(this).val(format(number))
        $('.total_produk').val(deformat($(this).val()))
    })

    function format(value) {
        return value.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ".")
    }

    function deformat(value) {
        var number = ''
        for (const c of value) {
            if (c != '.') {
                number += c;
            }
        }
        return number;
    }
</script>
<script>
    $('#total_ongkir').keyup(function (event) {
        if (event.which >= 37 && event.which <= 40) return;
        var number = $(this).val()
        $(this).val(format(number))
        $('.total_ongkir').val(deformat($(this).val()))
    })

    function format(value) {
        return value.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ".")
    }

    function deformat(value) {
        var number = ''
        for (const c of value) {
            if (c != '.') {
                number += c;
            }
        }
        return number;
    }
</script>
@endsection

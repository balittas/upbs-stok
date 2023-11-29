@extends('admin.layouts.app')
@section('css')
<link rel="stylesheet" href="{{url('assets/admin/plugins/select2/dist/css/select2.min.css')}}">
@endsection
@section('titleHeader')
Data Produk
@endsection
@section('subtitleHeader')
Tambah Kategori Produk
@endsection
@section('breadcrumb')
Data Produk
@endsection
@section('content-wrapper')
<input class="js-dynamic-enable" type="hidden" />
<input class="js-dynamic-disable" type="hidden" />

<input type="hidden" class="js-large" />
<input type="hidden" class="js-medium" />
<input type="hidden" class="js-small" />
<div class="row">
    <div class="col-sm-12" style="margin-bottom:20%">
        <div class="card">
            <div class="box-body" style="padding-bottom:50px">
                <form id="fileUploadForm" class="text-left border border-light p-5" action="{{route('product-category.store')}}"
                    method="POST" enctype="multipart/form-data" style="padding-bottom: 50px;">
                    @csrf
                    <div class="form-group">
                        <label>Nama Kategori Produk</label>
                        <div class="input-group">
                            <span class="input-group-prepend">
                                <label class="input-group-text"><i class="ik ik-edit-1"></i></label>
                            </span>
                            <input type="text" class="form-control  " placeholder="Nama Kategori Produk" name="name">
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
                        <a class="fixedButtonRefresh" href="{{route('product-category.index')}}">
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
                text: 'Kategori Produk berhasil ditambahkan',
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
                        window.location.href = SITEURL + "/" + "admin-page/product-category";
                    }, 3000);
                }
            });

        });
    });

</script>
<script>
    $('#price').keyup(function (event) {
        if (event.which >= 37 && event.which <= 40) return;
        var number = $(this).val()
        $(this).val(format(number))
        $('.price').val(deformat($(this).val()))
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

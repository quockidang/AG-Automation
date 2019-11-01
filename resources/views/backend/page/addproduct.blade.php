@extends('backend.main')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            {{$titleheader}}
            <small>advanced tables</small>
        </h1>
    </section>


    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-8">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">{{$boxtitle}}</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <form id="formaddproduct" class="needs-validation form-horizontal" novalidate role="form"
                            action="{{URL::to('/submitaddproduct')}}" method="post"
                            data-bv-feedbackicons-valid="glyphicon glyphicon-ok"
                            data-bv-feedbackicons-invalid="glyphicon glyphicon-remove"
                            data-bv-feedbackicons-validating="glyphicon glyphicon-refresh"
                            enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <select name="id_type" class="form-control form-control-sm" required>
                                    <option disabled="disabled" selected>Loại sản phẩm</option>
                                    @foreach ($Categorys as $key => $item)
                                    <option value="{{$item->id}}">{{$item->categories_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="row">
                                <div class="col form-group ">
                                    <input type="text" minlength="10" maxlength="100"
                                        data-bv-stringlength-message="Vui lòng nhập chuỗi có độ dài lớn hơn 10 và nhỏ hơn 100"
                                        name="name" required data-error="Vui lòng nhập vào tên sp"
                                        class="form-control form-control-sm" placeholder="Tên sản phẩm">
                                    <div class="invalid-feedback">
                                        Vui lòng nhập tên sản phẩm
                                    </div>
                                </div>
                                <div class="col form-group ">
                                    <input type="text" data-bv-integer="true"
                                        data-bv-integer-message="Chuỗi nhập vào không phải là số" name="price" required
                                        data-error="Vui lòng nhập giá sản phẩm" class="form-control form-control-sm"
                                        placeholder="Giá sản phẩm">
                                    <div class="invalid-feedback">
                                        Vui lòng nhập Giá
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">

                                    <select name="warranty" class="form-control form-control-sm">
                                        <option disabled selected>Thời gian bảo hành</option>

                                        <option value="6 tháng">6 tháng</option>
                                        <option value="1 năm"> 1 năm</option>
                                        <option value="2 năm"> 2 năm</option>
                                        <option value="3 năm"> 3 năm</option>
                                        <option value="5 năm"> 5 năm</option>
                                        <option value="10 năm"> 10 năm</option>
                                    </select>
                                </div>
                            <div class="form-group">

                                <select name="accessory_group_id" class="form-control form-control-sm">
                                    <option disabled selected>Chọn Nhóm Phụ Kiện Cho Sản Phẩm(Không bắt buộc)</option>
                                    @foreach ($AccessoriesGroup as $key => $group)
                                    <option value="{{$group->id}}">{{$group->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group ">
                                <textarea rows="2" type="text" minlength="10" maxlength="500"
                                    data-bv-stringlength-message="Vui lòng nhập chuỗi có độ dài lớn hơn 10 và nhỏ hơn 500"
                                    name="detail" required data-error="Vui lòng nhập detail"
                                    class="form-control form-control-sm" placeholder="Detail"></textarea>
                                <div class="invalid-feedback">
                                    Vui lòng nhập detail
                                </div>
                            </div>


                            <div class="form-group">
                                <label class="control-label">Hình ảnh</label>
                                <input type="file" class="form-control" name="image" required />

                            </div>
                            <div class="form-group ">
                                <label class="control-label">Mô tả chi tiết</label>
                                <textarea id="editor1" rows="4" cols="80" type="text" minlength="10" maxlength="2000"
                                    data-bv-stringlength-message="Vui lòng nhập chuỗi có độ dài lớn hơn 10 và nhỏ hơn 500"
                                    name="detail_descrip" data-error="Vui lòng nhập mô tả"
                                    class="form-control form-control-sm" placeholder="Detail"></textarea>
                                <div class="invalid-feedback">
                                    Vui lòng nhập mô tả chi tiết
                                </div>
                            </div>
                            <div class="box-footer row">
                                <button class="col-3 btn btn-outline-secondary">Thoát</button>
                                <button type="submit" name="add_customer"
                                    class="ml-5 col-3 btn btn-outline-primary ">Thêm Sản Phẩm</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->




    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection

@section('script')

<script>
    $(document).ready(function() {
    $('#formaddproduct').bootstrapValidator({
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            image: {
                validators: {
                    file: {
                        extension: 'jpeg,png,jpg',
                        type: 'image/jpeg,image/png',
                        maxSize: 2048 * 1024,
                        message: 'File vừa chọn không hợp lệ'
                    }
                }
            }
        }
    });
});
</script>
<script>
    $(document).ready(function() {
        $('#formaddproduct').bootstrapValidator();
    });

</script>
<script>
    (function() {
    'use strict';
    window.addEventListener('load', function() {
        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.getElementsByClassName('needs-validation');
        // Loop over them and prevent submission
        var validation = Array.prototype.filter.call(forms, function(form) {
        form.addEventListener('submit', function(event) {
            if (form.checkValidity() === false) {
            event.preventDefault();
            event.stopPropagation();
            }
            form.classList.add('was-validated');
        }, false);
        });
    }, false);
    })();
</script>
<script>
    CKEDITOR.replace( 'editor1',
		{
			filebrowserBrowseUrl : 'ckfinder/ckfinder.html',
			filebrowserImageBrowseUrl : 'ckfinder/ckfinder.html?type=Images',
			filebrowserFlashBrowseUrl : 'ckfinder/ckfinder.html?type=Flash',
			filebrowserUploadUrl : 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
			filebrowserImageUploadUrl : 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
			filebrowserFlashUploadUrl : 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash'
		});
</script>
<script src="js/backend/addproduct.js"></script>
@endsection

@extends('backend.main')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      {{$titleheader}}
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
            <form  id="formaddproduct" class="needs-validation form-horizontal" novalidate role="form" action="{{URL::to('/submit-edit-customer/'.$Customer->id)}}"
             method="post" data-bv-feedbackicons-valid="glyphicon glyphicon-ok"
             data-bv-feedbackicons-invalid="glyphicon glyphicon-remove"
             data-bv-feedbackicons-validating="glyphicon glyphicon-refresh" enctype="multipart/form-data">
                {{ csrf_field() }}

                        <div class="row">
                            <div class="col form-group ">
                            <input type="text" minlength="10" maxlength="100" value="{{$Customer->name}}"
                                    data-bv-stringlength-message="Vui lòng nhập chuỗi có độ dài lớn hơn 10 và nhỏ hơn 100"
                                     name="name" required data-error="Vui lòng nhập vào tên sp" class="form-control form-control-sm"  placeholder="Tên khách hàng">
                                    <div class="invalid-feedback">
                                        Vui lòng nhập tên khách hàng
                                </div>
                            </div>
                            <div class="col form-group ">
                            <input type="text" minlength="10" maxlength="100" value="{{$Customer->phone}}"
                                    data-bv-stringlength-message="Vui lòng nhập chuỗi có độ dài lớn hơn 10 và nhỏ hơn 100"
                                     name="phone" required data-error="Vui lòng nhập vào tên sp" class="form-control form-control-sm"  placeholder="Số điện thoại">
                                    <div class="invalid-feedback">
                                        Vui lòng nhập số điện thoại
                                </div>
                            </div>
                        </div>
                        <div class=" form-group ">
                                <input type="text" minlength="10" maxlength="100" value="{{$Customer->address}}"
                                data-bv-stringlength-message="Vui lòng nhập chuỗi có độ dài lớn hơn 10 và nhỏ hơn 100"
                                 name="address" required data-error="Vui lòng nhập vào tên sp" class="form-control form-control-sm"  placeholder="Địa chỉ">
                                <div class="invalid-feedback">
                                    Vui lòng nhập địa chỉ
                            </div>
                        </div>
                        <div class=" form-group ">
                                <input type="email" minlength="10" maxlength="100" value="{{$Customer->email}}"
                                data-bv-stringlength-message="Vui lòng nhập chuỗi có độ dài lớn hơn 10 và nhỏ hơn 100"
                                 name="email" required data-error="Vui lòng nhập vào tên sp" class="form-control form-control-sm"  placeholder="Email">
                                <div class="invalid-feedback">
                                    Vui lòng nhập email
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="gender" id="exampleRadios1" value="Nam" checked>
                            <label class="form-check-label" for="exampleRadios1">
                              Nam
                            </label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input" type="radio" name="gender" id="exampleRadios2" value="Nữ">
                            <label class="form-check-label" for="exampleRadios2">
                              Nữ
                            </label>
                          </div>

                <div class="box-footer">
                    <a href="{{URL::to('/delete-customer/'.$Customer->id)}}"><button type="button" class="col-3 btn btn-outline-danger">Xóa Khách Hàng</button></a>
                    <button type="submit" class="ml-5 col-3 btn btn-outline-primary ">Thêm Khách hàng</button>
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

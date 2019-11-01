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
            <form  id="formaddproduct" class="needs-validation form-horizontal" novalidate role="form" action="{{URL::to('/submitaddproduct')}}"
             method="post" data-bv-feedbackicons-valid="glyphicon glyphicon-ok"
             data-bv-feedbackicons-invalid="glyphicon glyphicon-remove"
             data-bv-feedbackicons-validating="glyphicon glyphicon-refresh" enctype="multipart/form-data">
                {{ csrf_field() }}
                    <div class="form-group">
                        <label for="">Danh mục</label>
                            <select name="id_type" class="form-control form-control-sm" aria-readonly="true" required>
                            <option  selected>{{$productCategory->categories_name}}</option>
                            </select>
                    </div>
                    <div class="row">
                            <div class="col form-group ">
                                <label for="">Tên sản phẩm</label>
                            <input readonly type="text" minlength="10" maxlength="100" readonly
                                    data-bv-stringlength-message="Vui lòng nhập chuỗi có độ dài lớn hơn 10 và nhỏ hơn 100"
                            name="name" value="{{$productModel->name}}" required data-error="Vui lòng nhập vào tên sp" class="form-control form-control-sm"  placeholder="Tên sản phẩm">
                                    <div class="invalid-feedback">
                                        Vui lòng nhập tên sản phẩm
                                    </div>
                            </div>
                            <div class="col form-group ">
                                <label for="">Giá</label>
                                    <input type="text"
                            data-bv-integer="true" readonly value="{{number_format($productModel->price) . ' VND'}}"
                                    data-bv-integer-message="Chuỗi nhập vào không phải là số"
                                     name="price" required data-error="Vui lòng nhập giá sản phẩm" class="form-control form-control-sm"  placeholder="Giá sản phẩm">
                                    <div class="invalid-feedback">
                                        Vui lòng nhập Giá
                                    </div>
                            </div>
                    </div>

                    <div class="form-group ">
                        <label for="">Chi tiết sản phẩm</label>
                    <textarea rows="2" type="text" minlength="10" maxlength="500" readonly
                            data-bv-stringlength-message="Vui lòng nhập chuỗi có độ dài lớn hơn 10 và nhỏ hơn 500"
                    name="detail" required data-error="Vui lòng nhập detail" class="form-control form-control-sm"  placeholder="Detail">{{$productModel->detail}}</textarea>
                            <div class="invalid-feedback">
                                Vui lòng nhập detail
                            </div>
                    </div>

                    <div class="col form-group ">
                            <label class="control-label">Nhóm Phụ Kiện</label>
                            <input type="text" readonly
                    data-bv-integer="true" value="{{$AccessoriesGroup->name}}"
                            data-bv-integer-message="Chuỗi nhập vào không phải là số"
                             required data-error="Vui lòng nhập giá sản phẩm" class="form-control form-control-sm"  placeholder="Nhóm Phụ kiện">
                            <div class="invalid-feedback">
                                Vui lòng nhập Nhóm Phụ kiện
                            </div>
                    </div>
                    <div class="form-group">
                            <label class="control-label">Hình ảnh</label>
                            <div >
                                <img class="w-25" src="{{asset('source/images/'.$productModel->image)}}" alt="Ảnh sản phẩm" srcset="">
                            </div>
                        </div>
                        <div class="form-group ">
                                <label class="control-label">Mô tả chi tiết</label>
                                <textarea  id="editor1" rows="4" cols="80" type="text" minlength="10" maxlength="2000" readonly
                                data-bv-stringlength-message="Vui lòng nhập chuỗi có độ dài lớn hơn 10 và nhỏ hơn 500"
                        name="detail_descrip" required data-error="Vui lòng nhập detail" class="form-control form-control-sm"  placeholder="Detail">{{$productModel->detail_descrip}}</textarea>
                                <div class="invalid-feedback">
                                    Vui lòng nhập mô tả chi tiết
                                </div>
                        </div>
                <div class="box-footer">
                    <a href="{{URL::to('/edit-product/'.$productModel->id)}}"><button type="button" name="add_customer" class="btn btn-primary "> Chỉnh Sửa</button></a>
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

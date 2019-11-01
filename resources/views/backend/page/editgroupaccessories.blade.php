
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
            <form  id="formaddproduct" class="needs-validation form-horizontal" novalidate role="form" action="{{URL::to('/submit-edit-group-accessory/'.$NameAccessoriesGroup->id)}}"
             method="post" data-bv-feedbackicons-valid="glyphicon glyphicon-ok"
             data-bv-feedbackicons-invalid="glyphicon glyphicon-remove"
             data-bv-feedbackicons-validating="glyphicon glyphicon-refresh" enctype="multipart/form-data">
                {{ csrf_field() }}

                            <div class="col form-group ">
                            <input type="text" minlength="3" maxlength="100" value="{{$NameAccessoriesGroup->name}}"
                                    data-bv-stringlength-message="Vui lòng nhập chuỗi có độ dài lớn hơn 10 và nhỏ hơn 100"
                                     name="name" required data-error="Vui lòng nhập vào tên sp" class="form-control form-control-sm"  placeholder="Tên phụ kiện">
                                    <div class="invalid-feedback">
                                        Vui lòng nhập tên nhóm phụ kiện
                                    </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                        <div class="form-group" style="padding-left: 15px">

                                            <select class="js-example-basic test form-control" name="arrayId[]" multiple="multiple">
                                                @foreach ($AccessoriesforID as $items)
                                                <option selected value="{{$items->accessories_id}}">
                                                    <?php
                                                        $name = App\Accessories::find($items->accessories_id);
                                                        echo $name->name;
                                                    ?>
                                                </option>
                                                @endforeach
                                                @foreach ($Accessories as $item)
                                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                                @endforeach
                                            </select>
                                </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group" style="padding-left: 15px">

                                        <select class="js-example-basic1  test form-control" name="arrayId1[]" multiple="multiple">
                                            @foreach ($AccessoriesforID1 as $items)
                                            <option selected value="{{$items->accessories_id}}">
                                                <?php
                                                    $name = App\Accessories::find($items->accessories_id);
                                                    echo $name->name;
                                                ?>
                                            </option>
                                            @endforeach
                                            @foreach ($Accessories as $item)
                                                <option value="{{$item->id}}">{{$item->name}}</option>
                                            @endforeach
                                        </select>
                            </div>
                            </div>
                            </div>

                    <button type="submit" class="ml-5 col-3 btn btn-outline-primary ">Update Nhóm Phụ Kiện</button>
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
  <div>

  </div>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection

@section('script')

<script type="text/javascript">

    $(document).ready(function() {
         $(".js-example-basic").select2({
            placeholder: "Chọn Phụ kiện Theo Bo Kit",
    });
    });

    $(document).ready(function() {
         $(".js-example-basic1").select2({
            placeholder: "Chọn Phụ kiện Rời",
    });
    });
</script>

<script>
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
            },
            accessory_code:{
                validators: {
                    regexp: {
                        regexp: /^[\w]+$/,
                        message: 'Mã phụ kiện không được có khoảng trắng'
                    }
                }
            }
        }
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
@endsection

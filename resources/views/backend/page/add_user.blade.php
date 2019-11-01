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
            <form  id="formaddproduct1" class="needs-validation form-horizontal" novalidate role="form" action="{{URL::to('/submit-add-user')}}"
             method="post" data-bv-feedbackicons-valid="glyphicon glyphicon-ok"
             data-bv-feedbackicons-invalid="glyphicon glyphicon-remove"
             data-bv-feedbackicons-validating="glyphicon glyphicon-refresh" enctype="multipart/form-data">
                {{ csrf_field() }}

                        <div class="row">
                            <div class="col form-group ">
                                    <input type="text" minlength="10" maxlength="100"
                                    data-bv-stringlength-message="Vui lòng nhập chuỗi có độ dài lớn hơn 10 và nhỏ hơn 100"
                                     name="name" required data-error="Vui lòng nhập vào tên sp" class="form-control form-control-sm"  placeholder="Tên tài khoản">
                                    <div class="invalid-feedback">
                                        Vui lòng nhập tên tài khoản
                                </div>
                            </div>
                            <div class="col form-group ">
                                    <input type="email"

                                     name="email" required data-error="Vui lòng nhập vào email" class="form-control form-control-sm"  placeholder="Email">
                                    <div class="invalid-feedback">
                                        Vui lòng nhập email
                                </div>
                            </div>
                        </div>
                        <div class=" form-group ">
                                <input type="password"
                                 name="password" required data-error="Vui lòng nhập vào tên sp" class="form-control form-control-sm"  placeholder="PassWord">
                                <div class="invalid-feedback">
                                    Vui lòng nhập địa chỉ
                            </div>
                        </div>

                <div class="box-footer row">
                    <button type="submit" class="ml-5 col-3 btn btn-outline-primary ">Thêm Tài khoản</button>
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
          $('#formaddproduct1').bootstrapValidator();
      });

  </script>
@endsection

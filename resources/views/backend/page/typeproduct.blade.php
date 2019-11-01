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
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">{{$boxtitle}}</h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <div class="tab-pane active float-right">
              <a class="text-green cursor-pointer posa" id="addLevel">
                <i class="fa fa-plus-square fontsize25"></i>
              </a>
              @include('backend.section.typeproduct.table_typeproduct')
              @include('backend.section.typeproduct.modal_typeproduct')
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
      @include('backend.modal_confirm_delete')
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection

@section('script')
<script src="js/backend/typeproduct.js"></script>
@endsection
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
      <div class="col-md-12">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">{{$boxtitle}}</h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
                <a title="Thêm tài khoảng quảng trị" class="text-green cursor-pointer posa" href="{{URL::to('/add-user')}}">
                    <button type="button" class="btn btn-success">Thêm</button>
                </a>
                <div class="table-responsive table-borderless">
                        <table class="table table-hover table-borderless table-striped b-t b-light">
                          <thead>
                            <tr>
                                <th scope="col">STT</th>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Thao tác</th>
                            </tr>
                          </thead>
                          <tbody>
                              @foreach ($Users as $key => $item)
                              <tr>
                                    <td>{{$key}}</td>
                                    <td>{{$item->name}}</td>
                                    <td>{{$item->email}}</td>
                                    <td>
                                    
                                            <a href="{{URL::to('/delete-user/'.$item->id)}}" onclick="return confirm('Are you sure to delete?')" class="active" ui-toggle-class=""><i class="fa fa-trash fontsize25" aria-hidden="true"></i></a>
                                    </td>
                                </tr>
                              @endforeach
                          </tbody>
                        </table>
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



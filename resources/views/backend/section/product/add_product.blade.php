<div class="modal-body">
    <!-- Custom Tabs -->
    <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="tab_vn_edit">
                <form action="{{route('submitaddproduct')}}" enctype="multipart/form-data" class="form-horizontal"
                    id="LevelForm" role="form" data-toggle="validator" method="POST">

                    @csrf
                    {{-- <div class="form-group">
                        <label for="name" class="col-sm-2 control-label ">Mã sản phẩm</label>
                        <div class="col-sm-9">
                            <input  type="text" class="form-control" id="addMaSV" name="addMaSV" value=""
                                required data-required-error="Tên cấp trường không được trống.">
                            <div class="help-block with-errors"></div>
                        </div>
                    </div> --}}

                    @if (isset($product))
                    <input name="action" hidden id="action" value="update">
                    <input name="id" hidden id="id" value="{{$product->id}}">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Mã sản phẩm</label>
                        <div class="col-sm-9">
                            <input disabled type="text" class="form-control" id="addId" name="addId"
                                value="{{$product->id}}">
                        </div>
                    </div>
                    @endif
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Loại sản phẩm</label>
                        <div class="col-sm-9">
                            <select name="addType" class="form-control">
                                @if (isset($product))
                                @foreach ($ProductType as $item)
                                @if ($product->id_type == $item->id)
                                <option selected value="{{$item->id}}">{{$item->name}}</option>
                                @else
                                <option value="{{$item->id}}">{{$item->name}}</option>
                                @endif
                                @endforeach

                                @else
                                @foreach ($ProductType as $item)
                                <option value="{{$item->id}}">{{$item->name}}</option>
                                @endforeach
                                @endif
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Tên sản phẩm</label>
                        <div class="col-sm-9">
                            @if (isset($product))
                            <input type="text" class="form-control" id="addTenSP" name="addTenSP"
                                value="{{$product->name}}" required
                                data-required-error="Tên sản phẩm không được trống.">
                            @elseif (old())
                            <input type="text" class="form-control" id="addTenSP" name="addTenSP"
                                value="{{old('addTenSP')}}" required
                                data-required-error="Tên sản phẩm không được trống.">
                            @else
                            <input type="text" class="form-control" id="addTenSP" name="addTenSP" value="" required
                                data-required-error="Tên sản phẩm không được trống.">
                            @endif
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="addDiaChi" class="col-sm-2 control-label">Detail</label>
                        <div class="col-sm-9">
                            @if (isset($product))
                            <textarea type="text" class="form-control" id="addDetail" name="addDetail" value="" required
                                data-minlength="10" data-minlength-error="Độ dài ngắn nhất 10"
                                data-required-error="Chi tiết không được trống.">{{$product->detail}}</textarea>
                            @elseif (old())
                            <textarea type="text" class="form-control" id="addDetail" name="addDetail" value="" required
                                data-minlength="10" data-minlength-error="Độ dài ngắn nhất 10"
                                data-required-error="Chi tiết không được trống.">{{old('addDetail')}}</textarea>
                            @else
                            <textarea type="text" class="form-control" id="addDetail" name="addDetail" value="" required
                                data-minlength="10" data-minlength-error="Độ dài ngắn nhất 10"
                                data-required-error="Chi tiết không được trống."></textarea>
                            @endif

                            <div class="help-block with-errors"></div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="addDiaChi" class="col-sm-2 control-label">Giá</label>
                        <div class="col-sm-9">
                            @if (isset($product))
                            <input type="number" class="form-control" id="addPrice" name="addPrice" min='1000'
                                value="{{$product->price}}" required data-required-error="Giá nhỏ không được trống.">
                            @elseif (old())
                            <input type="number" class="form-control" id="addPrice" name="addPrice" min='1000'
                                value="{{old('addPrice')}}" required data-required-error="Giá nhỏ không được trống.">
                            @else
                            <input type="number" class="form-control" id="addPrice" name="addPrice" value="" required
                                data-required-error="Giá nhỏ không được trống.">
                            @endif

                            <div class="help-block with-errors"></div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="addPrice" class="col-sm-2 control-label">Mới</label>
                        <div class="col-sm-9">
                            @if (isset($product))
                            @if ($product->new ==1)
                            <select name="addNew" class="form-control">
                                <option selected value="1">New</option>
                                <option value="0">Old</option>
                            </select>
                            @else
                            <select name="addNew" class="form-control">
                                <option value="1">New</option>
                                <option selected value="0">Old</option>
                            </select>
                            @endif
                            @else
                            <select name="addNew" class="form-control">
                                <option value="1">New</option>
                                <option value="0">Old</option>
                            </select>
                            @endif

                        </div>
                    </div>

                    <div class="form-group">
                        <label for="addPrice" class="col-sm-2 control-label">Hình ảnh</label>
                        <div class="col-sm-9">
                            
                            @if (isset($product))
                            <input type="file" name="image" id="exampleInputFile">
                            <img class="size120 imagefile" src="source/images/{{$product->image}}" alt="">
                            @else
                            <input type="file" name="image" id="exampleInputFile" required
                                data-required-error="Hình ảnh không được trống">
                            <img class="size120 imagefile" src="" alt="">
                            @endif

                            <div class="help-block with-errors"></div>
                        </div>

                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Nhóm phụ kiện</label>
                        <div class="col-sm-9">
                            @if (isset($product) && isset($productcustomization))
                            <select class="form-control select2 select2-hidden-accessible" multiple=""
                                data-placeholder="Select a State" style="width: 100%;" name="Customization[]" id="Customization"
                                tabindex="-1" aria-hidden="true">
                                @foreach ($customization as $item)
                                @php
                                $u =0;
                                @endphp
                                @foreach ($productcustomization as $itemtp)
                                @if ($item->id == $itemtp->customization_id)
                                @php
                                $u =1;
                                @endphp
                                <option selected value="{{$item->id}}" >{{$item->name}}
                                </option>
                                @endif
                                @endforeach

                                @if ($u==0)
                                <option value="{{$item->id}}" >{{$item->name}}
                                </option>
                                @endif
                               
                                @endforeach
                            </select>
                            @elseif(old('Customization'))
                            <select class="form-control select2 select2-hidden-accessible" multiple=""
                                data-placeholder="Select a State" style="width: 100%;" name="Customization[]" id="Customization"
                                tabindex="-1" aria-hidden="true">
                                @foreach ($customization as $item)
                                @foreach (old('Customization') as $itemtp)
                                @if ($item->id == $itemtp)
                                <option selected value="{{$item->id}}" >{{$item->name}}
                                </option>
                                @else
                                <option value="{{$item->id}}" >{{$item->name}}
                                </option>
                                @endif
                                @endforeach
                                @endforeach
                            </select>
                            @else
                            <select class="form-control select2 select2-hidden-accessible" multiple=""
                                data-placeholder="Select a State" style="width: 100%;" name="Customization[]" id="Customization"
                                tabindex="-1" aria-hidden="true">
                                @foreach ($customization as $item)
                                <option value="{{$item->id}}" >{{$item->name}}</option>
                                @endforeach
                            </select>
                            @endif
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <!-- /.box-header -->
                        <label for="addPrice" class="col-sm-2 control-label">Mô tả chi tiết</label>
                        <div class="box-body pad col-sm-9">
                            @if (isset($product))
                            <textarea id="editor1" name="addDetailDescrip" rows="10" cols="80">
                                    {{$product->detail_descrip}}
            </textarea>
                            @else
                            <textarea id="editor1" name="addDetailDescrip" rows="10" cols="80">
                                    This is my textarea to be replaced with CKEditor.
            </textarea>
                            @endif

                        </div>
                    </div>
                    <!-- /.box -->
            </div>
            <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Thoát</button>
                    <button type="submit" class="btn btn-success">Cập nhật</button>
                </div>
            
            </form>
        </div>
        <!-- /.tab-pane -->
    </div>
    <!-- /.tab-content -->
</div>
<!-- nav-tabs-custom -->
</div>

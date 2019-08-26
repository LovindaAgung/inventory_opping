@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')

    <a class="" href="{{ route('home') }}"> <button class="btn btn-primary">Go Back</button></a>

@stop

@section('content')


    <div class="row">
        <div class="col-md-6">
          <!-- Custom Tabs -->
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#tab_2" data-toggle="tab" aria-expanded="true">Requested Item</a></li>
              <li class="pull-right"><a href="#" class="text-muted"><i class="fa fa-gear"></i></a></li>
            </ul>

            <div class="tab-content">
              <!-- /.tab-pane -->
              <div class="tab-pane active" id="tab_2">
                <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Edit Requested Item</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" method="post" action="{{ route('inventory.update',$item->id) }}">
              @csrf
              @method('PUT')
              <div class="box-body">
                <div class="form-group">
                  <label for="name">Name</label>
                  <input name="name" type="text" class="form-control" value="{{$item->name}}">
                </div>
                <div class="form-group">
                  <label for="quantity">Quantity</label>
                  <input name="quantity" type="text" class="form-control" value="{{$item->quantity}}">
                </div>
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Send Request</button>
              </div>
            </form>
          </div>
              </div>
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- nav-tabs-custom -->
        </div>
        <!-- /.col -->
        <!-- /.col -->
      </div>
@stop

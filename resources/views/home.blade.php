@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')

    @if(\Request::is('home'))
    <h1>User Dashboard - {{Auth::user()->email}}</h1>

    @elseif(\Request::is('admin'))
    <h1>Admin Dashboard</h1>
    @endif

@stop

@section('content')
    @if(\Request::is('home'))
    <div class="row">
        <div class="col-md-6">
          <!-- Custom Tabs -->
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true">Own Items</a></li>
              <li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="false">Request Item</a></li>
              <li class="pull-right"><a href="#" class="text-muted"><i class="fa fa-gear"></i></a></li>
            </ul>

            <div class="tab-content">
              <div class="tab-pane active" id="tab_1">
                <div>
                  <div class="box">
              <div class="box-header with-border">
                <h3 class="box-title">Issued things to be approved</h3>
              </div>
            <!-- /.box-header -->
              <div class="box-body">
                <table id="data-table-user" class="table table-bordered">
                  <thead>
                      <tr>
                          <th>No.</th>
                          <th>Name</th>
                          <th>Quantity</th>
                          <th width="100px">Action</th>
                      </tr>
                  </thead>

                  <tbody>

                  </tbody>
                </table>
              </div>
            <!-- /.box-body -->

          </div>
                </div>
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="tab_2">
                <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Request New Item
                @if(Auth::user()->disabled==1)
                - is Disabled by Admin
                @endif
              </h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" method="post" action="{{ route('inventory.store') }}">
              @csrf
              <div class="box-body">
                <div class="form-group">
                  <label for="name">Name</label>
                  @if(Auth::user()->disabled==1)
                  <input name="name" type="text" class="form-control" placeholder="Name of Item . . ." disabled/>
                  @else
                  <input name="name" type="text" class="form-control" placeholder="Name of Item . . ." />
                  @endif
                </div>
                <div class="form-group">
                  <label for="quantity">Quantity</label>
                  @if(Auth::user()->disabled==1)
                  <input name="quantity" type="text" class="form-control" placeholder="Ex: 1 ~ 99" disabled/>
                  @else
                  <input name="quantity" type="text" class="form-control" placeholder="Ex: 1 ~ 99" />
                  @endif
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







    @elseif(\Request::is('admin'))

    <div class="row">
        <div class="col-md-6">
          <!-- Custom Tabs -->
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true">New Items</a></li>
              <li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="false">Item List</a></li>
              <li class=""><a href="#tab_3" data-toggle="tab" aria-expanded="false">User List</a></li>
              <li class="pull-right"><a href="#" class="text-muted"><i class="fa fa-gear"></i></a></li>
            </ul>

            <div class="tab-content">
              <div class="tab-pane active" id="tab_1">
                <div>
                  <div class="box">
                    <div class="box-header with-border">
                      <h3 class="box-title">Issued things to be approved</h3>
                    </div>
                  <!-- /.box-header -->
                    <div class="box-body">
                      <table id="data-table-admin-request" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Name</th>
                                <th>Quantity</th>
                                <th>Owner Id</th>
                                <th width="100px">Action</th>
                            </tr>
                        </thead>

                        <tbody>

                        </tbody>
                      </table>
                    </div>
                </div>
            </div>
          </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="tab_2">
                <div class="box">
                  <div class="box-header with-border">
                    <h3 class="box-title">Hover Data Table</h3>
                  </div>
                  <!-- /.box-header -->
                  <div class="box-body">
                    <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                      <div class="row">
                        <div class="col-sm-6">
                        </div><div class="col-sm-6">
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-sm-12">
                          <div class="box-body">
                    <table id="data-table-admin-items" class="table table-bordered">
                      <thead>
                          <tr>
                              <th>No.</th>
                              <th>Name</th>
                              <th>Quantity</th>
                              <th>Owner Id</th>
                              <th>Status</th>

                          </tr>
                      </thead>

                      <tbody>

                      </tbody>
                    </table>
                            </div>
                    <!-- /.box-body -->
                  </div>
                    </div>
                    <!-- /.tab-pane -->
                  </div>
                  <!-- /.tab-content -->
                </div>
                <!-- nav-tabs-custom -->
              </div>
              <!-- /.col -->
              <!-- /.col -->
            </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="tab_3">
                <div class="box">
              <div class="box-header">
                <h3 class="box-title">Hover Data Table</h3>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                  <div class="row">
                    <div class="col-sm-6">
                    </div><div class="col-sm-6">
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-12">
                      <div class="box-body">
                        <table id="data-table-admin-users" class="table table-bordered">
                          <thead>
                              <tr>
                                  <th>No.</th>
                                  <th>Name</th>
                                  <th>Email</th>
                                  <th width="100px">Action</th>

                              </tr>
                          </thead>

                          <tbody>

                          </tbody>
                        </table>
                      </div>
              <!-- /.box-body -->
            </div>
              </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- nav-tabs-custom -->
        </div>
        <!-- /.col -->
        <!-- /.col -->
      </div>

    @endif
@stop

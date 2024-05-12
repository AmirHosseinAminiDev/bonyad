@extends('admin.layouts.master')
@section('title','ایجاد استاد جدید')
@section('content')
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">@yield('title')  <a href="{{ route('teachers.index') }}" class="btn btn-primary">لیست اساتید</a></h3>

                <div class="card-tools">
                    <div class="input-group input-group-sm" style="width: 150px;">
                        <input type="text" name="table_search" class="form-control float-right" placeholder="جستجو">

                        <div class="input-group-append">
                            <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card-header -->
            <form action="">
                <div class="row">
                    <div class="col-md-6">
                        <select name="" id="" class="form-control">
                            <option value="{{ \App\Enums\TeachersStatus::ACTIVE->value }}">فعال</option>
                            <option value="{{ \App\Enums\TeachersStatus::INACTIVE->value }}">غیر فعال</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <select name="" id="" class="form-control">
                            <option value="{{ \App\Enums\TeachersStatus::ACTIVE->value }}">فعال</option>
                            <option value="{{ \App\Enums\TeachersStatus::INACTIVE->value }}">غیر فعال</option>
                        </select>
                    </div>
                </div>
            </form>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->

    </section>
    <!-- /.content -->
@endsection

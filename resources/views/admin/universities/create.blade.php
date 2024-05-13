@extends('admin.layouts.master')
@section('title','مدیریت دانشگاه ها')
@section('content')
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">@yield('title') <a href="{{ route('universities.create') }}"
                                                          class="btn btn-primary">لیست دانشگاه ها</a></h3>

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
            <div class="card-body p-0">
                <form action="{{ route('universities.store') }}" method="POST">
                    @csrf
                    <label for="">نام دانشگاه</label>
                    <input type="text" name="name" class="form-control" placeholder="نام دانشگاه" id="">
                    <button type="submit" class="btn btn-success m-2">ثبت</button>
                </form>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->

    </section>
    <!-- /.content -->
@endsection

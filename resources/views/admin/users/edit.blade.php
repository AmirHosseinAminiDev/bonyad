@extends('admin.layouts.master')
@section('title','ایجاد کاربر جدید')
@section('content')
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">@yield('title')  <a href="{{ route('users.index') }}" class="btn btn-primary">لیست کاربران</a></h3>

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
            <form action="{{ route('users.update',$user) }}" method="POST" class="p-3">
                @csrf
                <div class="row mt-2">
                    <div class="col-md-6">
                        <input type="text" name="name" value="{{ $user->name ?? '' }}" id="" class="form-control" placeholder="نام">
                    </div>
                    <div class="col-md-6">
                        <input type="text" value="{{ $user->last_name ?? '' }}" name="last_name" id="" class="form-control" placeholder="نام خانوادگی">
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-md-6">
                        <input type="text" value="{{ $user->phone ?? '' }}" name="phone" id="" class="form-control" placeholder="تلفن">
                    </div>
                    <div class="col-md-6">
                        <input type="text" value="{{ $user->national_code ?? '' }}" name="national_code" id="" class="form-control" placeholder="کد ملی">
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-md-6">
                        <input type="text" name="email" value="{{ $user->email ?? '' }}" id="" class="form-control" placeholder="ایمیل">
                    </div>
                    <div class="col-md-3">
                        <input type="password" name="password" id="" class="form-control" placeholder="رمز عبور">
                    </div>
                    <div class="col-md-3">
                        <input type="password" name="password_confirmation" id="" class="form-control" placeholder="تکرار رمز عبور">
                    </div>
                </div>
                <button type="submit" class="btn btn-success mt-2">ثبت</button>
            </form>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->

    </section>
    <!-- /.content -->
@endsection

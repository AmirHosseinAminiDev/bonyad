@extends('admin.layouts.master')
@section('title','مدیریت کاربران')
@section('content')
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">@yield('title')  <a href="{{ route('users.create') }}" class="btn btn-primary">ایجاد کاربر جدید</a></h3>

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
            <div class="card-body table-responsive p-0">
                <table class="table table-hover">
                    <tbody><tr>
                        <th>شماره</th>
                        <th>کاربر</th>
                        <th>ایمیل</th>
                        <th>تلفن</th>
                        <th>نقش</th>
                        <th>عملیات</th>
                    </tr>
                    <tr>
                        <td>۱۸۳</td>
                        <td>محمد</td>
                        <td>۱۱-۷-۲۰۱۴</td>
                        <td><span class="badge badge-success">تایید شده</span></td>
                        <td>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ</td>
                        <td>
                            <div class="row">
                                <div class="col-md-4">
                                    <a href="" class="btn btn-success">نمایش</a>
                                </div>
                                <div class="col-md-4">
                                    <a href="" class="btn btn-warning">ویرایش</a>
                                </div>
                                <div class="col-md-4">
                                    <a href="" class="btn btn-danger">حذف</a>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>۲۱۹</td>
                        <td>حسام</td>
                        <td>۱۱-۷-۲۰۱۴</td>
                        <td><span class="badge bg-danger">در حال بررسی</span></td>
                        <td>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ</td>
                        <td>
                            <div class="row">
                                <div class="col-md-4">
                                    <a href="" class="btn btn-success">نمایش</a>
                                </div>
                                <div class="col-md-4">
                                    <a href="" class="btn btn-warning">ویرایش</a>
                                </div>
                                <div class="col-md-4">
                                    <a href="" class="btn btn-danger">حذف</a>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>۶۵۷</td>
                        <td>رضا</td>
                        <td>۱۱-۷-۲۰۱۴</td>
                        <td><span class="badge badge-primary">تایید شده</span></td>
                        <td>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ</td>
                        <td>
                            <div class="row">
                                <div class="col-md-4">
                                    <a href="" class="btn btn-success">نمایش</a>
                                </div>
                                <div class="col-md-4">
                                    <a href="" class="btn btn-warning">ویرایش</a>
                                </div>
                                <div class="col-md-4">
                                    <a href="" class="btn btn-danger">حذف</a>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>۱۷۵</td>
                        <td>پرهام</td>
                        <td>۱۱-۷-۲۰۱۴</td>
                        <td><span class="badge badge-danger">رد شده</span></td>
                        <td>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ</td>
                        <td>
                            <div class="row">
                                <div class="col-md-4">
                                    <a href="" class="btn btn-success">نمایش</a>
                                </div>
                                <div class="col-md-4">
                                    <a href="" class="btn btn-warning">ویرایش</a>
                                </div>
                                <div class="col-md-4">
                                    <a href="" class="btn btn-danger">حذف</a>
                                </div>
                            </div>
                        </td>
                    </tr>
                    </tbody></table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->

    </section>
    <!-- /.content -->
@endsection

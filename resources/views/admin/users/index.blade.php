@extends('admin.layouts.master')
@section('title','مدیریت کاربران')
@section('content')
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">@yield('title') <a href="{{ route('users.create') }}" class="btn btn-primary">ایجاد
                        کاربر جدید</a></h3>

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
                    <tbody>
                    <tr>
                        <th>شماره</th>
                        <th>کاربر</th>
                        <th>ایمیل</th>
                        <th>تلفن</th>
                        <th>نقش</th>
                        <th>عملیات</th>
                    </tr>
                    @forelse($users as $user)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $user->fullName() }}</td>
                            <td>{{ $user->email ?? 'ندارد' }}</td>
                            <td>{{ $user->phone ?? 'ندارد' }}</td>
                            <td>کاربر عادی</td>
                            <td>
                                <div class="row">
                                    <div class="col-md-4">
                                        <a href="{{ route('users.edit',$user) }}" class="btn btn-success">نمایش</a>
                                    </div>
                                    <div class="col-md-4">
                                        <a href="{{ route('users.edit',$user) }}" class="btn btn-warning">ویرایش</a>
                                    </div>
                                    <div class="col-md-4">
                                        <form action="{{ route('users.delete',$user) }}" method="POST"
                                              id="delete-form">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">حذف</button>
                                        </form>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            هیچ کاربری موجود نیست
                        </tr>
                    @endforelse

                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->

    </section>
    <!-- /.content -->
@endsection
@push('scripts')
    <script>
        $("#delete-form").on("submit", function(){
            return confirm("آیا مطمئن هستید؟");
        });
    </script>
@endpush

@extends('admin.layouts.master')
@section('title','مدیریت کلاس ها')
@section('content')
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">@yield('title') <a href="{{ route('classes.create') }}"
                                                          class="btn btn-primary">ایجاد
                        کلاس جدید</a></h3>

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
                        <th>نام</th>
                        <th>استاد</th>
                        <th>دانشگاه</th>
                        <th>تاریخ شروع</th>
                        <th>تاریخ پایان</th>
                        <th>عملیات</th>
                    </tr>
                    @forelse($classes as $class)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $class->name }}</td>
                            <td>{{ $class->teacher->user->fullName() }}</td>
                            <td>{{ $class->university->name }}</td>
                            <td>{{ \Morilog\Jalali\Jalalian::forge($class->start_date)->format('Y/m/d') }}</td>
                            <td>{{ \Morilog\Jalali\Jalalian::forge($class->end_date)->format('Y/m/d') }}</td>
                            <td>
                                <div class="row">
                                    <div class="col-md-4">
                                        <a href="{{ route('classes.edit',$class) }}"
                                           class="btn btn-success">نمایش</a>
                                    </div>
                                    <div class="col-md-4">
                                        <a href="{{ route('classes.edit',$class) }}"
                                           class="btn btn-warning">ویرایش</a>
                                    </div>
                                    <div class="col-md-4">
                                        <a class="btn btn-danger text-white"
                                           onclick="showConfirmationClass()">حذف</a>
                                        <form action="{{ route('classes.delete',$class) }}" method="POST"
                                              id="delete-form">
                                            @csrf
                                            @method('DELETE')

                                        </form>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            هیچ کلاسی موجود نیست
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
        function showConfirmationClass() {
            if (confirm('آیا از حذف کلاس مطمئن هستید؟')) {
                document.getElementById('delete-form').submit();
            }
        }
    </script>
@endpush

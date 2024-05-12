@extends('admin.layouts.master')
@section('title','مدیریت اساتید')
@section('content')
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">@yield('title') <a href="{{ route('teachers.create') }}" class="btn btn-primary">ایجاد
                        استاد جدید</a></h3>

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
                        <th>وضعیت</th>
                        <th>عملیات</th>
                    </tr>
                    @forelse($teachers as $teacher)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $teacher->user->fullName() }}</td>
                            <td>{{ $teacher->user->email ?? 'ندارد' }}</td>
                            <td>{{ $teacher->user->phone ?? 'ندارد' }}</td>
                            <td>
                                @if($teacher->status == \App\Enums\TeachersStatus::ACTIVE->value)
                                    <span class="badge badge-success"
                                          onclick="showConfirmationTeacher()"
                                    >فعال</span>
                                @else
                                    <span class="badge badge-danger"
                                          onclick="showConfirmationTeacher()">غیر فعال</span>
                                @endif
                                <form action="{{ route('teachers.status',$teacher) }}" id="teachersStatus"
                                      class="d-none" method="POST">
                                    @csrf
                                    @method('PUT')
                                </form>
                            </td>
                            <td>
                                <div class="row">
                                    <div class="col-md-4">
                                        <a href="{{ route('teachers.edit',$teacher) }}"
                                           class="btn btn-success">سوابق</a>
                                    </div>
                                    <div class="col-md-4">
                                        <a href="{{ route('teachers.edit',$teacher) }}"
                                           class="btn btn-success">ویرایش</a>
                                    </div>
                                    <div class="col-md-4">
                                        <form action="{{ route('users.delete',$teacher) }}" method="POST"
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
        $("#delete-form").on("submit", function () {
            return confirm("آیا مطمئن هستید؟");
        });

        function showConfirmationTeacher() {
            if (confirm('آیا از تغییر وضعیت استاد مطمئن هستید؟')) {
                document.getElementById('teachersStatus').submit();
            }
        }
    </script>
@endpush

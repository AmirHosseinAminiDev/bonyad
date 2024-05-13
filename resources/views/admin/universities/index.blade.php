@extends('admin.layouts.master')
@section('title','مدیریت دانشگاه ها')
@section('content')
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">@yield('title') <a href="{{ route('universities.create') }}"
                                                          class="btn btn-primary">ایجاد
                        دانشگاه جدید</a></h3>

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
                        <th>عملیات</th>
                    </tr>
                    @forelse($universities as $university)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $university->name }}</td>
                            <td>
                                <div class="row">
                                    <div class="col-md-4">
                                        <a href="{{ route('universities.edit',$university) }}" class="btn btn-success">نمایش</a>
                                    </div>
                                    <div class="col-md-4">
                                        <a href="{{ route('universities.edit',$university) }}" class="btn btn-warning">ویرایش</a>
                                    </div>
                                    <div class="col-md-4">
                                        <a class="btn btn-danger text-white" onclick="showConfirmationUniversity()">حذف</a>
                                        <form action="{{ route('universities.destroy',$university) }}" method="POST"
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
                            هیچ دانشگاهی موجود نیست
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
        function showConfirmationUniversity() {
            if (confirm('آیا از حذف دانشگاه مطمئن هستید؟')) {
                document.getElementById('delete-form').submit();
            }
        }
    </script>
@endpush

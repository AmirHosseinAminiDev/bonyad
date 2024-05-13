@extends('admin.layouts.master')
@section('title','مدیریت کلاس ها')
@push('select')
    <!-- Persian Data Picker -->
    <link rel="stylesheet" href="{{ asset('admin/dist/css/persian-datepicker.min.css') }}">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('admin/plugins/select2/select2.min.css') }}">
@endpush
@section('content')
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">@yield('title') <a href="{{ route('universities.create') }}"
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
            <div class="card-body p-3">
                <form action="{{ route('classes.store') }}" method="POST">
                    @csrf
                    <div class="row p-3">
                        <div class="col-md-6">
                            <label for="">استاد</label>
                            <select name="teacher" id="" class="form-control select2">
                                @forelse($teachers as $teacher)
                                    <option value="{{ $teacher->id }}">{{ $teacher->user->fullName() }}</option>
                                @empty
                                    <option value="" disabled>هیچ استادی یافت نشد</option>
                                @endforelse
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="">دانشگاه</label>
                            <select name="university" id="" class="form-control select2">
                                @forelse($universities as $uni)
                                    <option value="{{ $uni->id }}">{{ $uni->name }}</option>
                                @empty
                                    <option value="" disabled>هیچ دانشگاهی یافت نشد</option>
                                @endforelse
                            </select>
                        </div>
                    </div>
                    <div class="row p-3">
                        <div class="col-md-6">
                            <label for="">نام کلاس</label>
                            <input type="text" name="name" id="" class="form-control" placeholder="نام کلاس...">
                        </div>
                        <div class="col-md-3">
                            <label for="">تاریخ شروع</label>
                            <input name="start_date" class="form-control normal-example">
                        </div>
                        <div class="col-md-3">
                            <label for="">تاریخ پایان</label>
                            <input name="end_date" class="form-control normal-example">
                        </div>
                    </div>
                    <div class="row p-3">
                        <div class="col-md-6">
                            <label for="">تعداد دانشجویان پسر</label>
                            <input type="number" name="boys" value="0" id="" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label for="">تعداد دانشجویان دختر</label>
                            <input type="number" name="girls" value="0" id="" class="form-control">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success">ثبت</button>
                </form>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->

    </section>
    <!-- /.content -->
@endsection
@push('select-scripts')
    <!-- Select2 -->
    <script src="{{ asset('admin/plugins/select2/select2.full.min.js') }}"></script>
    <!-- Persian Data Picker -->
    <script src="{{ asset('admin/dist/js/persian-date.min.js') }}"></script>
    <script src="{{ asset('admin/dist/js/persian-datepicker.min.js') }}"></script>
@endpush
@push('scripts')
    <script>
        $(function () {
            //Initialize Select2 Elements
            $('.select2').select2()
        })

        function showConfirmationUniversity() {
            if (confirm('آیا از حذف دانشگاه مطمئن هستید؟')) {
                document.getElementById('delete-form').submit();
            }
        }

        $('.normal-example').persianDatepicker({
            observer: true,
            format: 'YYYY/MM/DD',
        });
    </script>
@endpush

@extends('admin.layouts.master')
@section('title','ایجاد استاد جدید')
@push('select')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('admin/plugins/select2/select2.min.css') }}">
@endpush
@section('content')
    <!-- Main content -->
    <section class="content">
        <form action="{{ route('teachers.store') }}" method="POST" class="form-control" enctype="multipart/form-data">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">انتخاب کاربر</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <label for="">انتخاب کاربر</label>
                        <select name="user" id="" class="form-control select2">
                            @forelse($users as $user)
                                <option
                                    value="{{ $user->id }}">{{ $user->fullName() }} - {{ $user->national_code ?? 'ندارد' }}</option>
                            @empty
                                <option value="" disabled>هیچ کاربری یافت نشد</option>
                            @endforelse
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">@yield('title') <a href="{{ route('teachers.index') }}" class="btn btn-primary">لیست
                        اساتید</a></h3>

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

                @csrf
                <div class="row p-3">
                    <div class="col-md-6">
                        <label for="">رشته</label>
                        <input class="form-control" type="text" name="major" id="" placeholder="رشته">
                    </div>
                    <div class="col-md-6">
                        <label for="">سطح تحصیلات</label>
                        <select name="education_level" id="" class="form-control">
                            <option value="{{ \App\Enums\EducationLevels::KARDANI }}">کاردانی</option>
                            <option value="{{ \App\Enums\EducationLevels::KARSHENASI }}">کارشناسی</option>
                            <option value="{{ \App\Enums\EducationLevels::ARSHAD }}">کارشناسی ارشد</option>
                            <option value="{{ \App\Enums\EducationLevels::DR }}">دکتری</option>
                        </select>
                    </div>
                </div>
                <div class="row p-3">
                    <div class="col-md-6">
                        <label for="">وضعیت اشتغال</label>
                        <select name="job_status" class="form-control">
                            <option value="{{ \App\Enums\JobStatus::EMPLOYEE->value }}">شاغل</option>
                            <option value="{{ \App\Enums\JobStatus::RETIRED->value }}">بازنشسته</option>
                            <option value="{{ \App\Enums\JobStatus::FREE->value }}">بیکار</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="">شغل</label>
                        <input type="text" class="form-control" name="job" id="" placeholder="شغل">
                    </div>
                </div>
                <div class="row p-3">
                    <div class="col-md-6">
                        <label for="">تاریخ تولد</label>
                        <input type="text" name="birth_date" class="form-control" placeholder="تاریخ تولد" id="">
                    </div>
                    <div class="col-md-6">
                        <label for="">آدرس</label>
                        <input type="text" name="address" class="form-control" placeholder="آدرس" id="">
                    </div>
                </div>
                <div class="row p-3">
                    <div class="col-md-6">
                        <label for="">وضعیت تاهل</label>
                        <select name="marriage_status" class="form-control">
                            <option value="{{ \App\Enums\MarriageStatus::SINGLE->value }}">مجرد</option>
                            <option value="{{ \App\Enums\MarriageStatus::MARRIED->value }}">متاهل</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="">تعداد فرزندان</label>
                        <input type="number" name="children_count" value="0" class="form-control" id="">
                    </div>
                </div>
                <div class="row p-3">
                    <div class="col-md-6">
                        <label for="">سابقه جبهه</label>
                        <input type="file" name="war_history" id="" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label for="">سابقه بسیج</label>
                        <input type="file" name="active_basij" id="" class="form-control">
                    </div>
                </div>


            <!-- /.card-body -->
        </div>
        <!-- /.card -->
            <button class="btn btn-success m-3" type="submit">ثبت</button>
        </form>
    </section>
    <!-- /.content -->
@endsection
@push('select-scripts')
    <!-- Select2 -->
    <script src="{{ asset('admin/plugins/select2/select2.full.min.js') }}"></script>
@endpush
@push('scripts')
    <script>
        $(function () {
            //Initialize Select2 Elements
            $('.select2').select2()
        })
    </script>
@endpush

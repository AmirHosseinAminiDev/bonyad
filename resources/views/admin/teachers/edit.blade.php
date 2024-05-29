@extends('admin.layouts.master')
@section('title','ویرایش استاد')
@push('select')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('admin/plugins/select2/select2.min.css') }}">
    <style>
        table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
        }
    </style>
@endpush
@section('content')
    <!-- Main content -->
    <section class="content">
        <form action="{{ route('teachers.update',$teacher) }}" method="POST" class="form-control"
              enctype="multipart/form-data">
            @csrf
            @method('PUT')
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
                                        value="{{ $user->id }}" {{ $teacher->user->id == $user->id ? 'selected' : '' }}>{{ $user->fullName() }}
                                        - {{ $user->national_code ?? 'ندارد' }}</option>
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
                    <h3 class="card-title">@yield('title') <a href="{{ route('teachers.index') }}"
                                                              class="btn btn-primary">لیست
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
                        <input class="form-control" type="text" name="major"
                               value="{{ $teacher->user->masterRequest->document->major ?? '' }}" id=""
                               placeholder="رشته">
                    </div>
                    <div class="col-md-6">
                        <label for="">سطح تحصیلات</label>
                        <select name="education_level" id="" class="form-control">
                            <option value="{{ \App\Enums\EducationLevels::KARDANI->value }}"
                                {{ $teacher->user->masterRequest->document->education_level == \App\Enums\EducationLevels::KARDANI->value ? 'selected' : '' }}>
                                کاردانی
                            </option>
                            <option value="{{ \App\Enums\EducationLevels::KARSHENASI->value }}"
                                {{ $teacher->user->masterRequest->document->education_level == \App\Enums\EducationLevels::KARSHENASI->value ? 'selected' : '' }}
                            >کارشناسی
                            </option>
                            <option value="{{ \App\Enums\EducationLevels::ARSHAD->value }}"
                                {{ $teacher->user->masterRequest->document->education_level == \App\Enums\EducationLevels::ARSHAD->value ? 'selected' : '' }}
                            >کارشناسی ارشد
                            </option>
                            <option value="{{ \App\Enums\EducationLevels::DR->value }}"
                                {{ $teacher->user->masterRequest->document->education_level == \App\Enums\EducationLevels::DR->value ? 'selected' : '' }}
                            >دکتری
                            </option>
                        </select>
                    </div>
                </div>
                <div class="row p-3">
                    <div class="col-md-6">
                        <label for="">وضعیت اشتغال</label>
                        <select name="job_status" class="form-control">
                            <option value="{{ \App\Enums\JobStatus::EMPLOYEE->value }}"
                                {{ $teacher->user->masterRequest->document->job_status == \App\Enums\JobStatus::EMPLOYEE->value ? 'selected' : '' }}
                            >شاغل
                            </option>
                            <option value="{{ \App\Enums\JobStatus::RETIRED->value }}"
                                {{ $teacher->user->masterRequest->document->job_status == \App\Enums\JobStatus::RETIRED->value ? 'selected' : '' }}
                            >بازنشسته
                            </option>
                            <option value="{{ \App\Enums\JobStatus::FREE->value }}"
                                {{ $teacher->user->masterRequest->document->job_status == \App\Enums\JobStatus::FREE->value ? 'selected' : '' }}
                            >بیکار
                            </option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="">شغل</label>
                        <input type="text" class="form-control"
                               value="{{  $teacher->user->masterRequest->document->job ?? '' }}" name="job" id=""
                               placeholder="شغل">
                    </div>
                </div>
                <div class="row p-3">
                    <div class="col-md-6">
                        <label for="">تاریخ تولد</label>
                        <input type="text" name="birth_date" class="form-control" placeholder="تاریخ تولد" id=""
                               value="{{  $teacher->user->masterRequest->document->birth_date ?? '' }}"
                        >
                    </div>
                    <div class="col-md-6">
                        <label for="">آدرس</label>
                        <input type="text" name="address" class="form-control" placeholder="آدرس" id=""
                               value="{{  $teacher->user->masterRequest->document->address ?? '' }}">
                    </div>
                </div>
                <div class="row p-3">
                    <div class="col-md-6">
                        <label for="">وضعیت تاهل</label>
                        <select name="marriage_status" class="form-control">
                            <option value="{{ \App\Enums\MarriageStatus::SINGLE->value }}"
                                {{ $teacher->user->masterRequest->document->marriage_status == \App\Enums\MarriageStatus::SINGLE->value ? 'selected' : '' }}
                            >مجرد
                            </option>
                            <option value="{{ \App\Enums\MarriageStatus::MARRIED->value }}"
                                {{ $teacher->user->masterRequest->document->marriage_status == \App\Enums\MarriageStatus::MARRIED->value ? 'selected' : '' }}
                            >متاهل
                            </option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="">تعداد فرزندان</label>
                        <input type="number" name="children_count"
                               value="{{  $teacher->user->masterRequest->document->children_count ?? '0' }}"
                               class="form-control" id="">
                    </div>
                </div>
                <div class="row p-3">
                    <div class="col-md-6">
                        <label for="">سابقه جبهه</label>
                        <input type="file" name="war_history" id="" class="form-control">
                        @if(!is_null($teacher->user->masterRequest->document->war_document))
                            <a href="{{ asset('war_history/'.$teacher->user->masterRequest->document->war_document) }}"
                               class="btn btn-success mt-2">دانلود</a>
                        @endif
                    </div>
                    <div class="col-md-6">
                        <label for="">سابقه بسیج</label>
                        <input type="file" name="active_basij" id="" class="form-control">
                        @if(!is_null($teacher->user->masterRequest->document->active_basij))
                            <a href="{{ asset('active_basij/'.$teacher->user->masterRequest->document->active_basij) }}"
                               class="btn btn-success mt-2" target="_blank">دانلود</a>
                        @endif
                    </div>
                </div>


                <!-- /.card-body -->
            </div>
            <!-- /.card -->
            <button class="btn btn-success m-3" type="submit">ثبت</button>
        </form>


        <div class="card">
            <div class="card-header">
                <h3 class="card-title">لیست کلاس‌های استاد</h3>
                <button onclick="exportTableToExcel()" class="btn btn-success">خروجی اکسل</button>
            </div>
            <div class="card-body">
                <table class="table table-bordered" id="classTable">
                    <thead>
                    <tr>
                        <th>نام استاد</th>
                        <th>نام دانشگاه تدریس</th>
                        <th>نام درس</th>
                        <th>تاریخ شروع کلاس</th>
                        <th>تاریخ پایان کلاس</th>
                        <th>تعداد دانشجویان دختر</th>
                        <th>تعداد دانشجویان پسر</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($teacher->classes as $c)
                        <tr>
                            <td>{{ $teacher->user->fullName() }}</td>
                            <td>{{ $c->university->name }}</td>
                            <td>{{ $c->name }}</td>
                            <td>{{ jdate($c->start_date)->format('Y/m/d') }}</td>
                            <td>{{ jdate($c->end_date)->format('Y/m/d') }}</td>
                            <td>{{ $c->boys }}</td>
                            <td>{{ $c->girls }}</td>
                        </tr>
                    @empty
                        <tr>
                            هیچ داده ای یافت نشد
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>


    </section>
    <!-- /.content -->
@endsection
@push('select-scripts')
    <!-- Select2 -->
    <script src="{{ asset('admin/plugins/select2/select2.full.min.js') }}"></script>
@endpush
@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.16.9/xlsx.full.min.js"></script>

    <script>
        function exportTableToExcel() {
            const table = document.getElementById('classTable');
            const wb = XLSX.utils.table_to_book(table);

            // Add border to the cells
            const sheetName = wb.SheetNames[0];
            const sheet = wb.Sheets[sheetName];

            var range = XLSX.utils.decode_range(sheet['!ref']);
            for (var R = range.s.r; R <= range.e.r; ++R) {
                for (var C = range.s.c; C <= range.e.c; ++C) {
                    var cell_address = { c: C, r: R };
                    var cell = sheet[XLSX.utils.encode_cell(cell_address)];
                    if (cell) {
                        cell.s = {
                            border: {
                                top: { style: "thin", color: { auto: 1 } },
                                bottom: { style: "thin", color: { auto: 1 } },
                                left: { style: "thin", color: { auto: 1 } },
                                right: { style: "thin", color: { auto: 1 } }
                            }
                        };
                    }
                }
            }

            // Add the border style to the sheet
            sheet['!rows'] = [];
            for (var R = range.s.r; R <= range.e.r; ++R) {
                sheet['!rows'].push({ hpx: 20 }); // Set row height
            }

            // Set metadata for the Excel file
            wb.Props = {
                Title: 'نام استاد: }}{{ $teacher->user->fullName() }}',
                Author: 'Your Name',
                CreatedDate: new Date()
            };

            XLSX.writeFile(wb, 'class_data.xlsx');
        }
    </script>
    <script>
        $(function () {
            //Initialize Select2 Elements
            $('.select2').select2()
        })
    </script>
@endpush

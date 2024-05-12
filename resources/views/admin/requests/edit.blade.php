@extends('admin.layouts.master')
@section('title','درخواست ها')
@section('content')
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">@yield('title') <a href="{{ route('requests.index') }}" class="btn btn-primary">لیست
                        درخواست ها</a></h3>

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
            <div class="card-body">
                <form action="{{ route('requests.update',$master) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row p-3">
                        <div class="col-md-6">
                            نام : {{ $master->user->name ?? 'ندارد' }}
                        </div>
                        <div class="col-md-6">
                            نام خانوادگی : {{ $master->user->last_name ?? 'ندارد' }}
                        </div>
                    </div>
                    <div class="row p-3">
                        <div class="col-md-6">
                            کد ملی : {{ $master->user->national_code ?? 'ندارد' }}
                        </div>
                        <div class="col-md-6">
                            تلفن : {{ $master->user->phone ?? 'ندارد' }}
                        </div>
                    </div>
                    <div class="row p-3">
                        <div class="col-md-6">
                            ایمیل : {{ $master->user->email ?? 'ندارد' }}
                        </div>
                        <div class="col-md-6">
                            رشته : {{ $master->document->major ?? 'ندارد' }}
                        </div>
                    </div>
                    <div class="row p-3">
                        <div class="col-md-6">
                            سطح تحصیلات : {{ $master->document->education_level ?? 'ندارد' }}
                        </div>
                        <div class="col-md-6">
                            وضعیت شغل : {{ $master->document->job_status ?? 'ندارد' }}
                        </div>
                    </div>
                    <div class="row p-3">
                        <div class="col-md-6">
                            شغل : {{ $master->document->job ?? 'ندارد' }}
                        </div>
                        <div class="col-md-6">
                            تاریخ تولد : {{ $master->document->birth_date ?? 'ندارد' }}
                        </div>
                    </div>
                    <div class="row p-3">
                        <div class="col-md-6">
                            آدرس : {{ $master->document->address ?? 'ندارد'}}
                        </div>
                        <div class="col-md-6">
                            وضعیت تاهل : {{ $master->document->marriage_status ?? 'ندارد'}}
                        </div>
                    </div>
                    <div class="row p-3">
                        <div class="col-md-6">
                            تعداد فرزند ها : {{ $master->document->chidren_count ?? 'ندارد' }}
                        </div>
                        <div class="col-md-3">
                            <a href="{{ public_path('').'/war_history/'.$master->document->war_history }}"
                               class="btn btn-primary">مدرک سابقه جبهه</a>
                        </div>
                        <div class="col-md-3">
                            <a href="{{ public_path('').'/active_basij/'.$master->document->active_basij }}"
                               class="btn btn-primary">مدرک سابقه بسیج</a>
                        </div>
                    </div>
                    <div class="row p-3">
                        <label for="">نتیجه :</label>
                        <select class="form-control" name="result" id="">
                            <option value="" selected>لطفا انتخاب کنید</option>
                            <option value="{{ \App\Enums\RequestsStatus::ACCEPTED->value }}">تایید</option>
                            <option value="{{ \App\Enums\RequestsStatus::REJECTED->value }}">رد</option>
                            <option value="{{ \App\Enums\RequestsStatus::INPROGRESS->value }}">درحال پردازش</option>
                        </select>
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

@extends('admin.layouts.master')
@section('title','درخواست ها')
@section('content')
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">@yield('title') <a href="{{ route('users.create') }}" class="btn btn-primary">ایجاد
                        استاد جدید</a></h3>

                <div class="card-tools">
                    <div class="input-group input-group-sm" style="width: 150px;">
                        <form action="">
                            <div class="row">
                                <div class="col-md-12">
                                    <select name="type" id="filter" class="form-control">
                                        <option value="all">همه</option>
                                        <option value="{{ \App\Enums\RequestsStatus::ACCEPTED }}">تایید شده ها</option>
                                        <option value="{{ \App\Enums\RequestsStatus::REJECTED }}">رد شده ها</option>
                                        <option value="{{ \App\Enums\RequestsStatus::INPROGRESS }}">درحال پردازش ها
                                        </option>
                                    </select>
                                </div>
                            </div>

                        </form>


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
                        <th>وضعیت درخواست</th>
                        <th>عملیات</th>
                    </tr>
                    @forelse($requests as $request)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $request->user->fullName() }}</td>
                            <td>{{ $request->user->email ?? 'ندارد' }}</td>
                            <td>{{ $request->user->phone ?? 'ندارد' }}</td>
                            <td>
                                @switch($request->status)
                                    @case(\App\Enums\RequestsStatus::ACCEPTED->value)
                                        <span class="badge badge-success text-white">تایید شده</span>
                                        @break
                                    @case(\App\Enums\RequestsStatus::REJECTED->value)
                                        <span class="badge badge-danger text-white">رد شده</span>
                                        @break
                                    @default
                                        <span class="badge badge-warning text-white">درحال پردازش</span>
                                @endswitch
                            </td>
                            <td>
                                <div class="row">
                                    <div class="col-md-4">
                                        <a href="{{ route('users.edit',$request->user) }}" class="btn btn-success">نمایش
                                            کاربر</a>
                                    </div>
                                    <div class="col-md-4">
                                        <a href="{{ route('requests.edit',$request) }}"
                                           class="btn btn-warning text-white">نمایش درخواست</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            هیچ درخواستی موجود نیست
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
        var select = document.getElementById('filter');
        select.onchange = function(){
            this.form.submit();
        };
    </script>
@endpush

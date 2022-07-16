@extends('Admin::layouts.admin')

@section('title', __('Bảng điều khiển'))

@section('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('admins/plugin/daterangepicker/daterangepicker.min.css') }}" />
    <style>
        .highcharts-figure,
        .highcharts-data-table table {
            min-width: 360px;
            max-width: 800px;
            margin: 1em auto;
        }
    </style>
@stop

@section('content')
    <div class="col-sm-12">
        <form>
            <div class="form-row align-items-center">
                <div class="col-sm-8">
                </div>
                <div class="col-sm-4">
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                            <div class="input-group-text"><i class="fa fa-calendar fa-1x"></i></div>
                        </div>
                        <input type="text" id="reportrange" name="daterange" class="form-control" value="{{ $startDate->format('Y-m-d') . ' / ' . $endDate->format('Y-m-d') }}">
                    </div>
                </div>
            </div>
        </form>
    </div>

    <div class="col-xl-3 col-md-6"><a href="{{ route('admin.users.index') }}">
            <div class="card-box">
                <h4 class="header-title mt-0 mb-10">Người dùng</h4>
                <div class="widget-box-2">
                    <div class="widget-detail-2 text-right">
                        <h2 class="font-weight-normal mb-1" style="text-align: center"> {{ $countData['user'] }} </h2>
                        <p class="text-muted mb-10" style="text-align: center">Người dùng</p>
                    </div>
                </div>
            </div>
        </a>
    </div>
@stop

@section('scripts')
    <script src="{{ asset('admins/plugin/moment/moment.min.js') }}"></script>
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script type="text/javascript" src="{{ asset('admins/plugin/daterangepicker/daterangepicker.min.js') }}"></script>
    <script>

        $(function() {
            var start;
            var end = moment().subtract(29, 'days');
            $('input[name="daterange"]').daterangepicker({
                startDate: start,
                endDate: end,
                // autoUpdateInput: false,
                ranges : {
                    'Hôm nay': [moment(), moment()],
                    'Hôm qua': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    '7 ngày trước': [moment().subtract(6, 'days'), moment()],
                    '30 ngày trước': [moment().subtract(29, 'days'), moment()],
                    'Tháng này': [moment().startOf('month'), moment().endOf('month')],
                    'Tháng trước': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                },
                locale: {
                    customRangeLabel: 'Thời gian khác',
                    format: 'YYYY-MM-DD',
                    cancelLabel: 'Hủy',
                    applyLabel: 'Chọn'
                }
            }, function (start, end) {
                var myUrl = window.location.pathname;
                window.location = myUrl+'?start='+start.format('YYYY-MM-DD')+'&end='+end.format('YYYY-MM-DD');
            });
        });
    </script>
@stop

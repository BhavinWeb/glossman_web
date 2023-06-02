@extends('admin.layouts.app')
@section('title')
    {{ __('dashboard') }}
@endsection
@section('breadcrumbs')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0">{{ __('dashboard') }}</h1>
        </div>
    </div>
@endsection
@section('content')
    <x-setup-guide />
    <x-admin.dashboard.overview :orders-amount="$ordersAmount" :products-amount="$productsAmount" :products-amount="$productsAmount" :users-amount="$usersAmount" :brands-amount="$brandsAmount"
        :categories-amount="$categoriesAmount" :total-earnings="$totalEarnings" />
    <div class="row">
        <div class="col-12">
            <x-admin.dashboard.yearly-month-based-earning />
        </div>
    </div>
    <div class="row">
        <div class="col-6">
            <x-admin.dashboard.category-product-sell-statistic />
        </div>
        <div class="col-6">
            <x-admin.dashboard.order-status-statistic />
        </div>
    </div>

    <div class="row">
        <x-admin.dashboard.order-table :recent-orders="$recentOrders" />
        <x-admin.dashboard.product-table :recent-products="$recentProducts" />
    </div>
@endsection

@section('script')
    <script src="{{ asset('backend') }}/plugins/chart.js/Chart.min.js"></script>
    <script>
        //- PIE CHART -
        var categories_name = {!! $categories_name !!};
        var sell_data = {!! $sell_data !!};
        var pieData = {
            labels: categories_name,
            datasets: [{
                data: sell_data,
                backgroundColor: ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de'],
            }]
        }
        // Get context with jQuery - using jQuery's .get() method.
        var pieChartCanvas = $('#pieChart').get(0).getContext('2d')
        var pieData = pieData;
        var pieOptions = {
            maintainAspectRatio: false,
            responsive: true,
        }
        //Create pie or douhnut chart
        new Chart(pieChartCanvas, {
            type: 'pie',
            data: pieData,
            options: pieOptions
        });

        //-------------
        //- DONUT CHART -
        //-------------
        var orders_status_key = {!! $orders_status_key !!};
        var orders_status_data = {!! $orders_status_data !!};

        var donutChartCanvas = $('#donutChart').get(0).getContext('2d')
        var donutData = {
            labels: orders_status_key,
            datasets: [{
                data: orders_status_data,
                backgroundColor: ['#f56954', '#00c0ef', '#f39c12', '#00a65a', '#FF0000'],
            }]
        }
        var donutOptions = {
            maintainAspectRatio: false,
            responsive: true,
        }
        //Create pie or douhnut chart
        // You can switch between pie and douhnut using the method below.
        var donutChart = new Chart(donutChartCanvas, {
            type: 'doughnut',
            data: donutData,
            options: donutOptions
        })

        $('#filter').on('change', function() {
            $('#filterForm').submit();
        })
    </script>
    <script>
        var areaChartData = {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            datasets: [{
                label: 'Earnings',
                backgroundColor: 'rgba(60,141,188,0.9)',
                borderColor: 'rgba(60,141,188,0.8)',
                pointRadius: false,
                pointColor: '#3b8bba',
                pointStrokeColor: 'rgba(60,141,188,1)',
                pointHighlightFill: '#fff',
                pointHighlightStroke: 'rgba(60,141,188,1)',
                data: {{ json_encode($earningsByMonth) }}
            }]
        }

        //-------------
        //- BAR CHART -
        //-------------
        var barChartCanvas = $('#barChart').get(0).getContext('2d')
        var barChartData = jQuery.extend(true, {}, areaChartData)
        var temp = areaChartData.datasets
        barChartData.datasets = temp

        var barChartOptions = {
            responsive: true,
            maintainAspectRatio: false,
            datasetFill: false,
            display: false
        }

        var barChart = new Chart(barChartCanvas, {
            type: 'bar',
            data: barChartData,
            options: barChartOptions
        })
    </script>
@endsection

@section('style')
    <style>
        #barChart{
            height:230px; min-height:230px
        }

        #donutChart{
            min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;
        }

        #pieChart{
            min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;
        }
    </style>
@endsection

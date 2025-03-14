@extends('backend.layouts.app')

@section('content')
    
    {{-- @if (Auth::user()->user_type == 'admin' || (Auth::user()->user_type == 'staff' && Auth::user()->hasPermissionTo('some-permission'))) --}}
        <div class="row gutters-10">
            <div class="col-lg-12">
                <div class="row gutters-10">
                    <div class="col-3">
                        <a href="{{ route('categories.index') }}" style="color:white;">
                            <div class="bg-grad-6 text-white rounded-lg mb-4 overflow-hidden">
                                
                                <div class="px-3 pt-3">
                                    <div class="fs-20">
                                        <span class=" d-block">{{  trans('messages.total') }}</span>
                                        Categories
                                    </div>
                                    <div class="h3 fw-700 mb-3">{{ App\Models\Category::count() }}</div>
                                </div>
                                
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
                                    <path fill="rgba(255,255,255,0.3)" fill-opacity="1"
                                        d="M0,128L34.3,112C68.6,96,137,64,206,96C274.3,128,343,224,411,250.7C480,277,549,235,617,213.3C685.7,192,754,192,823,181.3C891.4,171,960,149,1029,117.3C1097.1,85,1166,43,1234,58.7C1302.9,75,1371,149,1406,186.7L1440,224L1440,320L1405.7,320C1371.4,320,1303,320,1234,320C1165.7,320,1097,320,1029,320C960,320,891,320,823,320C754.3,320,686,320,617,320C548.6,320,480,320,411,320C342.9,320,274,320,206,320C137.1,320,69,320,34,320L0,320Z">
                                    </path>
                                </svg>
                            </div>
                        </a>
                    </div>
                    <div class="col-3">
                        <a href="{{ route('industries.index') }}" style="color:white;">
                            <div class="bg-grad-3 text-white rounded-lg mb-4 overflow-hidden">
                                <div class="px-3 pt-3">
                                    <div class="fs-20">
                                        <span class="d-block">{{  trans('messages.total') }}</span>
                                        Industries
                                    </div>
                                    <div class="h3 fw-700 mb-3">{{ App\Models\Industry::count() }}</div>
                                </div>
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
                                    <path fill="rgba(255,255,255,0.3)" fill-opacity="1"
                                        d="M0,128L34.3,112C68.6,96,137,64,206,96C274.3,128,343,224,411,250.7C480,277,549,235,617,213.3C685.7,192,754,192,823,181.3C891.4,171,960,149,1029,117.3C1097.1,85,1166,43,1234,58.7C1302.9,75,1371,149,1406,186.7L1440,224L1440,320L1405.7,320C1371.4,320,1303,320,1234,320C1165.7,320,1097,320,1029,320C960,320,891,320,823,320C754.3,320,686,320,617,320C548.6,320,480,320,411,320C342.9,320,274,320,206,320C137.1,320,69,320,34,320L0,320Z">
                                    </path>
                                </svg>
                            </div>
                        </a>
                    </div>
                    <div class="col-3">
                        <a href="{{ route('technologies.index') }}" style="color:white;">
                            <div class="bg-grad-1 text-white rounded-lg mb-4 overflow-hidden">
                                <div class="px-3 pt-3">
                                    <div class="fs-20">
                                        <span class=" d-block">{{  trans('messages.total') }}</span>
                                        Technologies
                                    </div>
                                    <div class="h3 fw-700 mb-3">{{ App\Models\Technology::count() }}</div>
                                </div>
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
                                    <path fill="rgba(255,255,255,0.3)" fill-opacity="1"
                                        d="M0,128L34.3,112C68.6,96,137,64,206,96C274.3,128,343,224,411,250.7C480,277,549,235,617,213.3C685.7,192,754,192,823,181.3C891.4,171,960,149,1029,117.3C1097.1,85,1166,43,1234,58.7C1302.9,75,1371,149,1406,186.7L1440,224L1440,320L1405.7,320C1371.4,320,1303,320,1234,320C1165.7,320,1097,320,1029,320C960,320,891,320,823,320C754.3,320,686,320,617,320C548.6,320,480,320,411,320C342.9,320,274,320,206,320C137.1,320,69,320,34,320L0,320Z">
                                    </path>
                                </svg>
                            </div>
                        </a>
                    </div>
                    {{-- <div class="col-3">
                        <div class="bg-grad-4 text-white rounded-lg mb-4 overflow-hidden">
                            <div class="px-3 pt-3">
                                <div class="fs-20">
                                    <span class=" d-block">{{  trans('messages.total') }}</span>
                                    Projects
                                </div>
                                <div class="h3 fw-700 mb-3"></div>
                            </div>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
                                <path fill="rgba(255,255,255,0.3)" fill-opacity="1"
                                    d="M0,128L34.3,112C68.6,96,137,64,206,96C274.3,128,343,224,411,250.7C480,277,549,235,617,213.3C685.7,192,754,192,823,181.3C891.4,171,960,149,1029,117.3C1097.1,85,1166,43,1234,58.7C1302.9,75,1371,149,1406,186.7L1440,224L1440,320L1405.7,320C1371.4,320,1303,320,1234,320C1165.7,320,1097,320,1029,320C960,320,891,320,823,320C754.3,320,686,320,617,320C548.6,320,480,320,411,320C342.9,320,274,320,206,320C137.1,320,69,320,34,320L0,320Z">
                                </path>
                            </svg>
                        </div>
                    </div> --}}
                    <div class="col-3">
                        <a href="{{ route('portfolios.index') }}" style="color:white;">
                            <div class="bg-grad-5 text-white rounded-lg mb-4 overflow-hidden">
                                <div class="px-3 pt-3">
                                    <div class="fs-20">
                                        <span class=" d-block">{{  trans('messages.total') }}</span>
                                        Portfolios
                                    </div>
                                    <div class="h3 fw-700 mb-3">{{ App\Models\Portfolio::count() }}</div>
                                </div>
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
                                    <path fill="rgba(255,255,255,0.3)" fill-opacity="1"
                                        d="M0,128L34.3,112C68.6,96,137,64,206,96C274.3,128,343,224,411,250.7C480,277,549,235,617,213.3C685.7,192,754,192,823,181.3C891.4,171,960,149,1029,117.3C1097.1,85,1166,43,1234,58.7C1302.9,75,1371,149,1406,186.7L1440,224L1440,320L1405.7,320C1371.4,320,1303,320,1234,320C1165.7,320,1097,320,1029,320C960,320,891,320,823,320C754.3,320,686,320,617,320C548.6,320,480,320,411,320C342.9,320,274,320,206,320C137.1,320,69,320,34,320L0,320Z">
                                    </path>
                                </svg>
                            </div>
                        </a>
                    </div>
                    {{-- <div class="col-3">
                        <div class="bg-grad-2 text-white rounded-lg mb-4 overflow-hidden">
                            <div class="px-3 pt-3">
                                <div class="fs-20">
                                    <span class=" d-block">{{  trans('messages.total') }}</span>
                                   
                                </div>
                                <div class="h3 fw-700 mb-3">0</div>
                            </div>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
                                <path fill="rgba(255,255,255,0.3)" fill-opacity="1"
                                    d="M0,128L34.3,112C68.6,96,137,64,206,96C274.3,128,343,224,411,250.7C480,277,549,235,617,213.3C685.7,192,754,192,823,181.3C891.4,171,960,149,1029,117.3C1097.1,85,1166,43,1234,58.7C1302.9,75,1371,149,1406,186.7L1440,224L1440,320L1405.7,320C1371.4,320,1303,320,1234,320C1165.7,320,1097,320,1029,320C960,320,891,320,823,320C754.3,320,686,320,617,320C548.6,320,480,320,411,320C342.9,320,274,320,206,320C137.1,320,69,320,34,320L0,320Z">
                                </path>
                            </svg>
                        </div>
                    </div> --}}
                </div>
            </div>

            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header d-block d-md-flex row">
                        <h5 class="mb-0 h6 col-md-9">Portfolios Launched </h5>
                        <div class="col-md-3">
                            <select id="yearSelector" class="form-control w-50" style="margin: 0% 50% 0%">
                                @for ($i = date('Y'); $i >= 2010; $i--)
                                    <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                            </select>
                        </div>
                    </div>
                    <div class="card-body">
                        <canvas id="monthlyPortfoliosChart" style="min-height: 350px; "></canvas>
                    </div>
                </div>
            </div>

            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header d-block d-md-flex row">
                        <h5 class="mb-0 h6 col-md-9">Category-wise Portfolio Count </h5>
                    </div>
                    <div class="card-body">
                        <canvas id="categoryPortfolioChart" style="min-height: 350px; " ></canvas>
                    </div>
                </div>
            </div>

            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header d-block d-md-flex row">
                        <h5 class="mb-0 h6 col-md-9">Industry-wise Portfolio Count </h5>
                    </div>
                    <div class="card-body">
                        <canvas id="industryPortfolioChart" style="min-height: 350px; " ></canvas>
                    </div>
                </div>
            </div>

            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header d-block d-md-flex row">
                        <h5 class="mb-0 h6 col-md-9">Technology-wise Portfolio Count </h5>
                    </div>
                    <div class="card-body">
                        <canvas id="technologyPortfolioChart" style="min-height: 350px; " ></canvas>
                    </div>
                </div>
            </div>

        </div>
    {{-- @endif --}}


@endsection
@section('script')
    <script src="{{ asset('assets/js/chartjs.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>
    <script type="text/javascript">
        document.addEventListener("DOMContentLoaded", function () {
            let yearSelector = document.getElementById("yearSelector");
            let ctx = document.getElementById("monthlyPortfoliosChart").getContext("2d");
            let chart;

            function fetchChartData(year) {
                fetch(`/admin/portfolio-monthly-count?year=${year}`)
                    .then(response => response.json())
                    .then(data => {
                        let months = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
                        
                        if (chart) chart.destroy(); // Destroy previous chart instance

                        chart = new Chart(ctx, {
                            type: "bar",
                            data: {
                                labels: months,
                                datasets: [{
                                    label: `Portfolios Launched in ${year}`,
                                    data: Object.values(data),
                                    backgroundColor: "rgba(44, 177, 56, 0.6)",
                                    borderColor: "rgba(44, 177, 56,1)",
                                    borderWidth: 2,
                                }]
                            },
                            options: {
                                responsive: true,
                                maintainAspectRatio: false,
                                scales: { 
                                    y: { 
                                        beginAtZero: true 
                                    } 
                                },
                                plugins: {
                                    legend: {
                                        display: true,  // Enables the legend
                                        position: "bottom" // Can be 'top', 'bottom', 'left', or 'right'
                                    },
                                    datalabels: {
                                        anchor: "middle", // Position the labels at the end of bars
                                        align: "middle",
                                        color: "black", // Text color
                                        font: {
                                            weight: "bold",
                                            size: 14
                                        },
                                        formatter: (value) => value > 0 ? value : "" // Show only if greater than 0
                                    }
                                }
                            },
                            plugins: [ChartDataLabels] 
                        });
                    });
            }

            // Load chart initially for the current year
            fetchChartData(yearSelector.value);

            // Update chart when the year is changed
            yearSelector.addEventListener("change", function () {
                fetchChartData(this.value);
            });

            const categoryCounts = @json($categoryCounts);
            const labels = categoryCounts.map(item => item.name);
            const data = categoryCounts.map(item => item.portfolio_count);
            const ctxCat = document.getElementById('categoryPortfolioChart').getContext('2d');

            const chartCat = new Chart(ctxCat, {
                            type: 'bar',
                            data: {
                                labels: labels,
                                datasets: [{
                                    label: 'Portfolio Count by Categories',
                                    data: data,
                                    backgroundColor: 'rgba(247, 95, 95, 0.6)',
                                    borderColor: 'rgb(247, 95, 95, 1)',
                                    borderWidth: 1
                                }]
                            },
                            options: {
                                responsive: true,
                                maintainAspectRatio: false,
                                scales: {
                                    y: {
                                        beginAtZero: true
                                    }
                                },
                                plugins: {
                                    legend: {
                                        display: true,  // Enables the legend
                                        position: "bottom" // Can be 'top', 'bottom', 'left', or 'right'
                                    },
                                    datalabels: {
                                        anchor: "middle", // Position the labels at the end of bars
                                        align: "middle",
                                        color: "black", // Text color
                                        font: {
                                            weight: "bold",
                                            size: 14
                                        },
                                        formatter: (value) => value > 0 ? value : "" // Show only if greater than 0
                                    }
                                }
                            },
                            plugins: [ChartDataLabels] 
            });

            const industryCounts = @json($industryCounts);
            const labelsInd = industryCounts.map(item => item.name);
            const dataInd = industryCounts.map(item => item.portfolio_count);
            const ctxInd = document.getElementById('industryPortfolioChart').getContext('2d');

            const chartInd = new Chart(ctxInd, {
                            type: 'bar',
                            data: {
                                labels: labelsInd,
                                datasets: [{
                                    label: 'Portfolio Count by Industries',
                                    data: dataInd,
                                    backgroundColor: 'rgb(90, 166, 228, 0.6)',
                                    borderColor: 'rgb(90, 166, 228, 1)',
                                    borderWidth: 1
                                }]
                            },
                            options: {
                                responsive: true,
                                maintainAspectRatio: false,
                                scales: {
                                    y: {
                                        beginAtZero: true
                                    }
                                },
                                plugins: {
                                    legend: {
                                        display: true,  // Enables the legend
                                        position: "bottom" // Can be 'top', 'bottom', 'left', or 'right'
                                    },
                                    datalabels: {
                                        anchor: "middle", // Position the labels at the end of bars
                                        align: "middle",
                                        color: "black", // Text color
                                        font: {
                                            weight: "bold",
                                            size: 14
                                        },
                                        formatter: (value) => value > 0 ? value : "" // Show only if greater than 0
                                    }
                                }
                            },
                            plugins: [ChartDataLabels] 
            });

            const technologyCounts = @json($technologyCounts);
            const labelsTech = technologyCounts.map(item => item.name);
            const dataTech = technologyCounts.map(item => item.portfolio_count);
            const ctxTech = document.getElementById('technologyPortfolioChart').getContext('2d');

            const chartTech = new Chart(ctxTech, {
                            type: 'bar',
                            data: {
                                labels: labelsTech,
                                datasets: [{
                                    label: 'Portfolio Count by Technologies',
                                    data: dataTech,
                                    backgroundColor: 'rgba(204, 79, 154, 0.6)',
                                    borderColor: 'rgba(204, 79, 154, 1)',
                                    borderWidth: 1
                                }]
                            },
                            options: {
                                responsive: true,
                                maintainAspectRatio: false,
                                scales: {
                                    y: {
                                        beginAtZero: true
                                    }
                                },
                                plugins: {
                                    legend: {
                                        display: true,  // Enables the legend
                                        position: "bottom" // Can be 'top', 'bottom', 'left', or 'right'
                                    },
                                    datalabels: {
                                        anchor: "middle", // Position the labels at the end of bars
                                        align: "middle",
                                        color: "black", // Text color
                                        font: {
                                            weight: "bold",
                                            size: 14
                                        },
                                        formatter: (value) => value > 0 ? value : "" // Show only if greater than 0
                                    }
                                }
                            },
                            plugins: [ChartDataLabels] 
            });

        });
    </script>
@endsection

@extends('layouts.app')
@section('title')
    Beranda
@endsection
@section('content')
    <!-- ...::: Start Hero Section :::... -->
    <div class="hero-section hero-display hero-bg">
        <div class="box-wrapper">
            <div class="container">
                <div class="row align-items-center flex-column-reverse flex-md-row">
                    <div class="col-12 col-md-6">
                        <!-- Start Hero Content -->
                        <div class="hero-content">
                            <h2 class="title highlight">Selamat Datang di</h2>
                            <h2 class="title">Monitoring Perkembangan Balita dan Ibu Hamil</h2>
                            {{-- <a href="/dashboard" class="btn btn-lg btn-default btn-animate icon-space-left"><span>Pantau
                                    Perkembangan <i class="icofont-doctor-alt"></i></span></a> --}}
                        </div>
                        <!-- End Hero Content -->
                    </div>
                    <div class="col-12 col-md-6">
                        <!-- Start Hero Image -->
                        <div class="hero-image-1">
                            <img class="animate-top-bottom" src="assets/images/background/hero-bg-1.png" alt="">
                        </div>
                        <!-- End Hero Image -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="contact-banner-display-section section-top-gap-150">
        <div class="box-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <!-- Start Contact Banner Area -->
                        <div class="custom-grid-12">
                            <!-- Start Faq Area -->
                            <ul class="faq-list-area">
                                <!-- Start Faq Single Item -->
                                <li class="faq-single-item">
                                    {{-- <div class="number">01</div> --}}

                                    <div class="content">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <h5 class="title">Grafik Total Balita</h5>
                                                <div id="balita_chart"></div><br>
                                            </div>
                                            <div class="col-lg-6">
                                                <h5 class="title">Grafik Total Ibu Hamil</h5>
                                                <div id="bumil_chart"></div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <h5 class="title">Grafik Balita Berdasarkan Status Gizi</h5>
                                                <div id="balita_by_status"></div><br>
                                            </div>
                                            <div class="col-lg-6">
                                                <h5 class="title">Grafik Ibu Hamil Berdasarkan Status Gizi</h5>
                                                <div id="bumil_by_status"></div><br>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="rows">
                                        <select name="tanggal" id="pilih-bulan" class="form-control">
                                            <option value="">Semua</option>
                                            <option value="{{ date('Y') . '-01' }}"
                                                {{ $tanggal == date('Y') . '-01' ? 'selected' : '' }}>Januari
                                                {{ date('Y') }} </option>
                                            <option value="{{ date('Y') . '-02' }}"
                                                {{ $tanggal == date('Y') . '-02' ? 'selected' : '' }}>Februari
                                                {{ date('Y') }}
                                            </option>
                                            <option value="{{ date('Y') . '-03' }}"
                                                {{ $tanggal == date('Y') . '-03' ? 'selected' : '' }}>Maret
                                                {{ date('Y') }}
                                            </option>
                                            <option value="{{ date('Y') . '-04' }}"
                                                {{ $tanggal == date('Y') . '-04' ? 'selected' : '' }}>April
                                                {{ date('Y') }} </option>
                                            <option value="{{ date('Y') . '-05' }}"
                                                {{ $tanggal == date('Y') . '-05' ? 'selected' : '' }}>Mei
                                                {{ date('Y') }}
                                            </option>
                                            <option value="{{ date('Y') . '-06' }}"
                                                {{ $tanggal == date('Y') . '-06' ? 'selected' : '' }}>Juni
                                                {{ date('Y') }} </option>
                                            <option value="{{ date('Y') . '-07' }}"
                                                {{ $tanggal == date('Y') . '-07' ? 'selected' : '' }}>Juli
                                                {{ date('Y') }} </option>
                                            <option value="{{ date('Y') . '-08' }}"
                                                {{ $tanggal == date('Y') . '-08' ? 'selected' : '' }}>Agustus
                                                {{ date('Y') }}
                                            </option>
                                            <option value="{{ date('Y') . '-09' }}"
                                                {{ $tanggal == date('Y') . '-09' ? 'selected' : '' }}>September
                                                {{ date('Y') }}
                                            </option>
                                            <option value="{{ date('Y') . '-10' }}"
                                                {{ $tanggal == date('Y') . '-10' ? 'selected' : '' }}>Oktober
                                                {{ date('Y') }}
                                            </option>
                                            <option value="{{ date('Y') . '-11' }}"
                                                {{ $tanggal == date('Y') . '-11' ? 'selected' : '' }}>Nopember
                                                {{ date('Y') }}
                                            </option>
                                            <option value="{{ date('Y') . '-12' }}"
                                                {{ $tanggal == date('Y') . '-12' ? 'selected' : '' }}>Desember
                                                {{ date('Y') }}
                                            </option>
                                        </select>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <!-- End Contact Banner Area -->
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script>
        $('#pilih-bulan').change(function() {
            let request = $(this).val()
            window.location.href = "{{ route('beranda') }}?tanggal=" + request
        })
    </script>
    <script>
        var options = {
            series: [{
                name: 'Hasil',
                data: {!! json_encode($rowBalita) !!}
            }],
            chart: {
                type: 'bar',
                height: 400,
                stacked: true,
            },
            colors: ['#3232ac'],
            dataLabels: {
                enabled: false,
            },
            stroke: {
                curve: 'smooth'
            },
            legend: {
                position: 'bottom',
                horizontalAlign: 'left'
            },
            xaxis: {
                categories: {!! json_encode($label) !!},
            },
            yaxis:[
                {
                    show:false,
                    labels:{
                        formatter: function(val){
                            return parseInt(val)
                        }
                    }
                }
            ],
            dataLabels: {
                enabled: true,
                formatter: function (val) {
                    return val;
                }
            },
        };

        var chart = new ApexCharts(document.querySelector("#balita_chart"), options);
        chart.render();

        var optionsBumil = {
            series: [{
                name: 'Hasil',
                data: {!! json_encode($rowBumil) !!}
            }],
            chart: {
                type: 'bar',
                height: 400,
                stacked: true,
            },
            colors: ['#3232ac'],
            dataLabels: {
                enabled: false,
            },
            stroke: {
                curve: 'smooth'
            },
            legend: {
                position: 'bottom',
                horizontalAlign: 'left'
            },
            xaxis: {
                categories: {!! json_encode($label) !!},
            },
            yaxis:[
                {
                    show:false,
                    labels:{
                        formatter: function(val){
                            return parseInt(val)
                        }
                    }
                }
            ],
            dataLabels: {
                enabled: true,
                formatter: function (val) {
                    return val;
                }
            },

        };

        var chartBumil = new ApexCharts(document.querySelector("#bumil_chart"), optionsBumil);
        chartBumil.render();


        var optionsBalitaByStatus = {
          series: {!! json_encode($grafikByStatus['balita']) !!},
          chart: {
          type: 'bar',
          height: 350,
          stacked: true,
        },
        responsive: [{
          breakpoint: 480,
          options: {
            legend: {
              position: 'bottom',
              offsetX: -10,
              offsetY: 0
            }
          }
        }],
        xaxis: {
            categories: {!! json_encode($label) !!},
        },
        fill: {
          opacity: 1
        },
        legend: {
          position: 'right',
          offsetX: 0,
          offsetY: 50
        },
        dataLabels: {
                enabled: true,
                formatter: function (val) {
                    return val;
                }
            },
            yaxis:[
                {
                    show:false,
                    labels:{
                        formatter: function(val){
                            return parseInt(val)
                        }
                    }
                }
            ],
        };

        var chartBalitaByStatus = new ApexCharts(document.querySelector("#balita_by_status"), optionsBalitaByStatus);
        chartBalitaByStatus.render();

        var optionsBumilByStatus = {
          series: {!! json_encode($grafikByStatus['bumil']) !!},
          chart: {
          type: 'bar',
          height: 350,
          stacked: true,
        },
        responsive: [{
          breakpoint: 480,
          options: {
            legend: {
              position: 'bottom',
              offsetX: -10,
              offsetY: 0
            }
          }
        }],
        xaxis: {
            categories: {!! json_encode($label) !!},
        },
        fill: {
          opacity: 1
        },
        legend: {
          position: 'right',
          offsetX: 0,
          offsetY: 50
        },
        dataLabels: {
                enabled: true,
                formatter: function (val) {
                    return val;
                }
            },
            yaxis:[
                {
                    show:false,
                    labels:{
                        formatter: function(val){
                            return parseInt(val)
                        }
                    }
                }
            ],
        };

        var chartBumilByStatus = new ApexCharts(document.querySelector("#bumil_by_status"), optionsBumilByStatus);
        chartBumilByStatus.render();

        function getRandomColor($total) {
            const categories = [];
            var letters = '0123456789ABCDEF';
            var color = '#';
            for (var j = 0; j < $total; j++) {
                for (var i = 0; i < 6; i++) {
                    color += letters[Math.floor(Math.random() * 16)];
                }
                categories.push(color);
                color = '#';
            }

            return categories;
        }
    </script>
@endpush

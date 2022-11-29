@extends('layouts.app')

@section('title')
    Monitoring
@endsection

@section('content')
    <div class="breadcrumb-section breadcrumb-bg">
        <div class="box-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="container text-center">
                            <h2 class="title">Monitoring Perkembangan</h2>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb justify-content-center">
                                    <li class="breadcrumb-item"><a href="/">Beranda</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Monitoring</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if ($nama_balita)
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
                                            <h5 class="title">Hai <b>{{ auth()->guard('web')->user()->nama }}</b>, ini
                                                Grafik
                                                Perkembangan <b>{{ $nama_balita }}</b>
                                            </h5>
                                            <div id="balita_chart"></div>
                                        </div>
                                        <div class="rows">
                                            <select name="" id="pilih-balita" class="form-control">
                                                @foreach ($semua_balita as $key => $value)
                                                    <option value="{{ $key }}"
                                                        {{ $value == $nama_balita ? 'selected' : '' }}>{{ $value }}
                                                    </option>
                                                @endforeach
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
    @endif
    @if ($bumil)
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
                                            <h5 class="title">Hai <b>{{ auth()->guard('web')->user()->nama }}</b>, ini
                                                Grafik
                                                Perkembangan Kandungan Anda</b>
                                            </h5>
                                            <div id="bumil_chart"></div>
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
    @endif
@endsection
@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script>
        $('#pilih-balita').change(function() {
            let request = $(this).val()
            window.location.href = "{{ route('dashboard') }}?balita_id=" + request
        })
    </script>
    <script>
        @if ($nama_balita)
            var options = {
                series: [{
                    name: 'Hasil',
                    data: {!! json_encode($balita['rows']) !!}
                }],
                chart: {
                    type: 'area',
                    height: 400,
                    stacked: true,
                },
                // colors: getRandomColor(1),
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
                    categories: {!! json_encode($balita['labels']) !!},
                },
            };

            var chart = new ApexCharts(document.querySelector("#balita_chart"), options);
            chart.render();
        @endif
        @if ($bumil)
            var options = {
                series: [{
                    name: 'Hasil',
                    data: {!! json_encode($bumil['rows']) !!}
                }],
                chart: {
                    type: 'area',
                    height: 400,
                    stacked: true,
                },
                // colors: getRandomColor(1),
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
                    categories: {!! json_encode($bumil['labels']) !!},
                },
            };

            var chart = new ApexCharts(document.querySelector("#bumil_chart"), options);
            chart.render();
        @endif

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

        function formatRupiah(angka, prefix) {
            var number_string = angka.replace(/[^,\d]/g, '').toString(),
                split = number_string.split(','),
                sisa = split[0].length % 3,
                rupiah = split[0].substr(0, sisa),
                ribuan = split[0].substr(sisa).match(/\d{3}/gi);

            // tambahkan titik jika yang di input sudah menjadi angka ribuan
            if (ribuan) {
                separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }

            rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
            return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
        }
    </script>
@endpush

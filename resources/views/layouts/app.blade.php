<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- JAVASCRIPT -->
    <script src="{{ asset('js/semantic.min.js') }}"></script>
    <script src="{{ asset('js/materialize.min.js') }}"></script> 
    <script src="{{ asset('js/jquery-1.7.2.min.js') }}"></script>
    <script src="{{ asset('js/excanvas.min.js') }}"></script> 
    <script src="{{ asset('js/chart.min.js') }}" type="text/javascript"></script> 
    <script src="{{ asset('js/bootstrap.js') }}"></script>
    <script language="javascript" type="text/javascript" src="{{ asset('js/full-calendar/fullcalendar.min.js') }}"></script>
    <script src="{{ asset('js/base.js') }}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    {{-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> --}}

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.css">
    <link rel="stylesheet" href="{{ asset('css/materialize.min.css') }}">
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap-responsive.min.css') }}" rel="stylesheet">
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600"
            rel="stylesheet">
    <link href="{{ asset('css/font-awesome.css') }}" rel="stylesheet">
    <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/pages/dashboard.css') }}" rel="stylesheet">

    <style>
        tbody {
            display:block;
            height:100%;
            overflow:auto;
        }
        .body150 {
            height:200px;
        }

        .body350 {
            height:350px;
        }

        thead, tbody tr {
            display:table;
            width:100%;
            table-layout:fixed;
        }
        thead {
            width: calc( 100% - 1em )
        }
        table {
            width:100%;
}
    </style>

</head>
<body>
    <div class="navbar navbar-fixed-top">
        <div class="navbar-inner">
            <div class="container">
                <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <a class="brand" href="{{ route('home.index') }}">
                    Farmasi
                </a>
                <div class="nav-collapse">
                    <ul class="nav pull-right">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="icon-user"></i> {{ Auth::user()->name }}
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>              
        </div>
    </div> <!--- End of Navbar -->
    <div class="subnavbar">
        <div class="subnavbar-inner">
            <div class="container">
                <ul class="mainnav">
                    <li>
                        <a href="{{ route('home.index') }}"><i class="icon-dashboard"></i><span>Dashboard</span></a>
                    </li>
                    <li>
                        <a href="{{ route('opname.index') }}"><i class="icon-briefcase"></i><span>Stok Opname</span></a>
                    </li>
                    <li>
                        <a href="#"><i class="icon-facetime-video"></i><span>App Tour</span> </a></li>
                    <li>
                        <a href="#"><i class="icon-bar-chart"></i><span>Charts</span> </a> </li>
                    <li>
                        <a href="#"><i class="icon-code"></i><span>Shortcodes</span></a>
                    </li>
                    <li class="dropdown">
                        <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown"> <i class="icon-long-arrow-down"></i><span>Master Data Obat BHP</span> <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="{{ route('jenis.index') }}">Pengaturan Barang</a></li>
                            <li><a href="{{ route('persentasejual.index') }}">Set Harga Jual Barang</a></li>
                            <li><a href="{{ route('barang.index') }}">Obat BHP</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div> <!-- End of Subnavbar -->
    <div class="main">
        <div class="main-inner">
            <div class="container">
                
                @yield('content')

            </div>
        </div>
    </div>
    {{-- <script>
        $(document).on('click', '#smallButton', function(event) {
            event.preventDefault();
            let href = $(this).attr('data-attr');
            $.ajax({
                url: href
                , beforeSend: function() {
                    $('#loader').show();
                },
                // return the result
                success: function(result) {
                    $('#smallModal').modal("show");
                    $('#smallBody').html(result).show();
                }
                , complete: function() {
                    $('#loader').hide();
                }
                , error: function(jqXHR, testStatus, error) {
                    console.log(error);
                    alert("Page " + href + " cannot open. Error:" + error);
                    $('#loader').hide();
                }
                , timeout: 8000
            })
        });
    </script> --}}

    
    {{-- <script>
        var list = $('#list-input')
        var total = parseInt($('#total').val())
        var angka = 0

        $('#tambah-input').click(function(){
            $('#total').val(++angka)
            list.append("<div class='baris-input'><input type='text' class='form-control' name='angka["+angka+"][testing]' placeholder='input"+angka+"'><input type='text' class='form-control' name='angka["+angka+"][testing2]' placeholder='inputan"+angka+"'><button class='hapus-cok btn-default'>remove</button></div>")
        })
        $(document).on('click','.hapus-cok',function(){
            $(this).parents('.baris-input').remove()
            var angka2 = $('#total').val()
            var tot = $('#total').val(angka2-1)  
        })
    </script> --}}

    {{-- <script>
         $('.cari').select2({
            placeholder: 'Cari Nama Obat',
            ajax: {
            url: 'admin/cari',
            dataType: 'json',
            delay: 250,
            processResults: function (data) {
                return {
                results:  $.map(data, function (item) {
                    return {
                    text: item.nama,
                    id: item.id
                    }
                })
                };
            },
            cache: true
            }
        });
    </script> --}}
</body>
</html>


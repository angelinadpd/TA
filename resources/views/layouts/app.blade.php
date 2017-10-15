<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
      <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>BAKS</title>
    <!-- BOOTSTRAP STYLES-->
    <link href="{{ asset ('vendors/css/bootstrap.css')}} " rel="stylesheet" />
     <!-- FONTAWESOME STYLES-->
    <link href="{{ asset ('vendors/css/font-awesome.css') }}" rel="stylesheet" />
     <!-- MORRIS CHART STYLES-->
    <link href="{{ asset ('vendors/js/morris/morris-0.4.3.min.css') }}" rel="stylesheet" />
        <!-- CUSTOM STYLES-->
    <link href="{{ asset ('vendors/css/custom.css') }}" rel="stylesheet" />
     <!-- GOOGLE FONTS-->
   <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
</head>
<body>
    <div id="wrapper">
        <nav class="navbar navbar-default navbar-cls-top " role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
  <div style="color: white;
padding: 15px 50px 5px 50px;
float: right;
font-size: 16px;"> 
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                 <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                        <a href="{{ url('/login') }}" class="btn btn-danger square-btn-adjust">Login</a>
                    @else
                        <a href="{{ url('/logout') }}" class="btn btn-danger square-btn-adjust"></i>Logout {{ Auth::user()->name }}</a>
                    @endif
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav> 
           <!-- /. NAV TOP  -->
                <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">
                <li class="text-center">
                    <img src="vendors/img/bg.jpg" class="user-image img-responsive"/>
                    </li>
                    
                    <li>
                        <a class="active-menu"  href="/" class="fa fa-dashboard fa-3x"></i> Dashboard</a>
                    </li>
                    @if (Auth::check())
                    <li>
                        <a  href="{{route('barang.index')}}"><i class="fa fa-desktop fa-3x"></i>Barang</a>
                    </li>
                    <li>
                        <a  href="{{route('promo.index')}}"><i class="fa fa-desktop fa-3x"></i>Promo</a>
                    </li>
                    <li>
                        <a  href="{{route('penjualan.index')}}"><i class="fa fa-desktop fa-3x"></i>Penjualan</a>
                    </li> 
                    <li>
                        <a href="#"><i class="fa fa-sitemap fa-3x"></i>Pembelian<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="{{route('pemesanan.index')}}">Pemesanan</a>
                            </li>
                            <li>
                                <a href="{{route('realisasi.index')}}">Realisasi</a>
                            </li>
                        </ul>
                      </li>  
                      <li>
                        <a href="#"><i class="fa fa-sitemap fa-3x"></i>Report<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="{{route('barang.laporanstokbarang')}}">Stok Barang</a>
                            </li>
                            <li>
                                <a href="{{route('realisasi.realisasipemesanan')}}">Pemesanan dan Realisasi</a>
                            </li>
                            <li>
                                <a href="{{route('penjualan.laporanpenjualan')}}">Penjualan</a>
                            </li>
                            <li>
                                <a href="{{route('penjualan.selectnotafaktur')}}">Cetak Faktur</a>
                            </li>
                            <li>
                                <a href="{{route('penjualan.selectnotasj')}}">Cetak Surat Jalan</a>
                            </li>
                        </ul>
                      </li>                                                 
                      @endif   
                </ul>
               
            </div>
            
        </nav>  
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12" align="center">
                     <h2>PT. Besar Anugerah Kasih Sejati</h2>   
                        <h5>Jl. Gurun Laweh No. 3G & 3H <br>
                            Telp.0751 841174 </h5>
                    </div>
                </div>              
             <!-- /. PAGE INNER  -->
             <div class="right_col" role="main">
                @if (Session::has('message'))
                <div class="alert alert-info">
                    <p>{{ Session::get('message') }}</p>
                </div>
                @endif

                @yield('content')

            </div> 
            </div>
         <!-- /. PAGE WRAPPER  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>-->
        </div>
</div>
     <!-- /. WRAPPER  -->
    <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
    <!-- JQUERY SCRIPTS -->
    <script src="/vendors/js/jquery-1.10.2.js"></script>
      <!-- BOOTSTRAP SCRIPTS -->
    <script src="/vendors/js/bootstrap.min.js"></script>
    <!-- METISMENU SCRIPTS -->
    <script src="/vendors/js/jquery.metisMenu.js"></script>
     <!-- MORRIS CHART SCRIPTS -->
     <script src="/vendors/js/morris/raphael-2.1.0.min.js"></script>
    <script src="/vendors/js/morris/morris.js"></script>
      <!-- CUSTOM SCRIPTS -->
    <script src="/vendors/js/custom.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>

</body>
</html>
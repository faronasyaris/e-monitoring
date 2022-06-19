@extends("secretary.main")

@section("content")

<!DOCTYPE html>
<html dir="ltr" lang="en">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta
      name="keywords"
      content="wrappixel, admin dashboard, html css dashboard, web dashboard, bootstrap 5 admin, bootstrap 5, css3 dashboard, bootstrap 5 dashboard, Matrix lite admin bootstrap 5 dashboard, frontend, responsive bootstrap 5 admin template, Matrix admin lite design, Matrix admin lite dashboard bootstrap 5 dashboard template"
    />
    <meta
      name="description"
      content="Matrix Admin Lite Free Version is powerful and clean admin dashboard template, inpired from Bootstrap Framework"
    />
    <meta name="robots" content="noindex,nofollow" />
    <title>Matrix Admin Lite Free Versions Template by WrapPixel</title>
    <!-- Favicon icon -->
    <link
      rel="icon"
      type="image/png"
      sizes="16x16"
      href="template/assets/images/favicon.png"
    />

    <link href="template/assets/libs/flot/css/float-chart.css" rel="stylesheet" />

    <link href="template/dist/css/style.min.css" rel="stylesheet" />
 
  </head>

  <body>


        <div class="container-fluid">
    
          
    
          <div class="row">
            <!-- Column -->
            <div class="col-md-6 col-lg-2 col-xlg-3">
              <div class="card card-hover">
                <div class="box bg-cyan text-center">
                  <h1 class="font-light text-white">
                    <i class="mdi mdi-view-dashboard"></i>
                  </h1>
                  <h6 class="text-white">Dashboard</h6>
                </div>
              </div>
            </div>
            <!-- Column -->
            <div class="col-md-6 col-lg-4 col-xlg-3">
              <div class="card card-hover">
                <div class="box bg-success text-center">
                  <h1 class="font-light text-white">
                    <i class="mdi mdi-chart-areaspline"></i>
                  </h1>
                  <h6 class="text-white">Charts</h6>
                </div>
              </div>
            </div>
            <!-- Column -->
            <div class="col-md-6 col-lg-2 col-xlg-3">
              <div class="card card-hover">
                <div class="box bg-warning text-center">
                  <h1 class="font-light text-white">
                    <i class="mdi mdi-collage"></i>
                  </h1>
                  <h6 class="text-white">Widgets</h6>
                </div>
              </div>
            </div>
            <!-- Column -->
            <div class="col-md-6 col-lg-2 col-xlg-3">
              <div class="card card-hover">
                <div class="box bg-danger text-center">
                  <h1 class="font-light text-white">
                    <i class="mdi mdi-border-outside"></i>
                  </h1>
                  <h6 class="text-white">Tables</h6>
                </div>
              </div>
            </div>
            <!-- Column -->
            <div class="col-md-6 col-lg-2 col-xlg-3">
              <div class="card card-hover">
                <div class="box bg-info text-center">
                  <h1 class="font-light text-white">
                    <i class="mdi mdi-arrow-all"></i>
                  </h1>
                  <h6 class="text-white">Full Width</h6>
                </div>
              </div>
            </div>
            <!-- Column -->
            <!-- Column -->
            <div class="col-md-6 col-lg-4 col-xlg-3">
              <div class="card card-hover">
                <div class="box bg-danger text-center">
                  <h1 class="font-light text-white">
                    <i class="mdi mdi-receipt"></i>
                  </h1>
                  <h6 class="text-white">Forms</h6>
                </div>
              </div>
            </div>
            <!-- Column -->
            <div class="col-md-6 col-lg-2 col-xlg-3">
              <div class="card card-hover">
                <div class="box bg-info text-center">
                  <h1 class="font-light text-white">
                    <i class="mdi mdi-relative-scale"></i>
                  </h1>
                  <h6 class="text-white">Buttons</h6>
                </div>
              </div>
            </div>
            <!-- Column -->
            <div class="col-md-6 col-lg-2 col-xlg-3">
              <div class="card card-hover">
                <div class="box bg-cyan text-center">
                  <h1 class="font-light text-white">
                    <i class="mdi mdi-pencil"></i>
                  </h1>
                  <h6 class="text-white">Elements</h6>
                </div>
              </div>
            </div>
            <!-- Column -->
            <div class="col-md-6 col-lg-2 col-xlg-3">
              <div class="card card-hover">
                <div class="box bg-success text-center">
                  <h1 class="font-light text-white">
                    <i class="mdi mdi-calendar-check"></i>
                  </h1>
                  <h6 class="text-white">Calnedar</h6>
                </div>
              </div>
            </div>
            <!-- Column -->
            <div class="col-md-6 col-lg-2 col-xlg-3">
              <div class="card card-hover">
                <div class="box bg-warning text-center">
                  <h1 class="font-light text-white">
                    <i class="mdi mdi-alert"></i>
                  </h1>
                  <h6 class="text-white">Errors</h6>
                </div>
              </div>
            </div>
            <!-- Column -->
          </div>
         
        
         >
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-body">
                  <div class="d-md-flex align-items-center">
                    <div>
                      <h4 class="card-title">Site Analysis</h4>
                      <h5 class="card-subtitle">Overview of Latest Month</h5>
                    </div>
                  </div>
                  <div class="row">
                    <!-- column -->
                    <div class="col-lg-9">
                      <div class="flot-chart">
                        <div
                          class="flot-chart-content"
                          id="flot-line-chart"
                        ></div>
                      </div>
                    </div>
                    <div class="col-lg-3">
                      <div class="row">
                        <div class="col-6">
                          <div class="bg-dark p-10 text-white text-center">
                            <i class="mdi mdi-account fs-3 mb-1 font-16"></i>
                            <h5 class="mb-0 mt-1">2540</h5>
                            <small class="font-light">Total Users</small>
                          </div>
                        </div>
                        <div class="col-6">
                          <div class="bg-dark p-10 text-white text-center">
                            <i class="mdi mdi-plus fs-3 font-16"></i>
                            <h5 class="mb-0 mt-1">120</h5>
                            <small class="font-light">New Users</small>
                          </div>
                        </div>
                        <div class="col-6 mt-3">
                          <div class="bg-dark p-10 text-white text-center">
                            <i class="mdi mdi-cart fs-3 mb-1 font-16"></i>
                            <h5 class="mb-0 mt-1">656</h5>
                            <small class="font-light">Total Shop</small>
                          </div>
                        </div>
                        <div class="col-6 mt-3">
                          <div class="bg-dark p-10 text-white text-center">
                            <i class="mdi mdi-tag fs-3 mb-1 font-16"></i>
                            <h5 class="mb-0 mt-1">9540</h5>
                            <small class="font-light">Total Orders</small>
                          </div>
                        </div>
                        <div class="col-6 mt-3">
                          <div class="bg-dark p-10 text-white text-center">
                            <i class="mdi mdi-table fs-3 mb-1 font-16"></i>
                            <h5 class="mb-0 mt-1">100</h5>
                            <small class="font-light">Pending Orders</small>
                          </div>
                        </div>
                        <div class="col-6 mt-3">
                          <div class="bg-dark p-10 text-white text-center">
                            <i class="mdi mdi-web fs-3 mb-1 font-16"></i>
                            <h5 class="mb-0 mt-1">8540</h5>
                            <small class="font-light">Online Orders</small>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- column -->
                  </div>
                </div>
              </div>
            </div>
          </div>
         >
       
         >
         >
      
         >
    
        </div>
    
        <div class="container">
          @yield ('content')
      </div>
     
      </div>
    </div>
  
    <script src="template/assets/libs/jquery/dist/jquery.min.js"></script>

    <script src="template/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="template/assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
    <script src="template/assets/extra-libs/sparkline/sparkline.js"></script>

    <script src="template/dist/js/waves.js"></script>

    <script src="template/dist/js/sidebarmenu.js"></script>
   
    <script src="template/dist/js/custom.min.js"></script>

    <script src="template/assets/libs/flot/excanvas.js"></script>
    <script src="template/assets/libs/flot/jquery.flot.js"></script>
    <script src="template/assets/libs/flot/jquery.flot.pie.js"></script>
    <script src="template/assets/libs/flot/jquery.flot.time.js"></script>
    <script src="template/assets/libs/flot/jquery.flot.stack.js"></script>
    <script src="template/assets/libs/flot/jquery.flot.crosshair.js"></script>
    <script src="template/assets/libs/flot.tooltip/js/jquery.flot.tooltip.min.js"></script>
    <script src="template/dist/js/pages/chart/chart-page-init.js"></script>
  </body>
</html>


@stop
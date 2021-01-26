<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>SDB new applicants</title>

<!-- jQuery 3 -->
<script src="public/bower_components/jquery/dist/jquery.min.js"></script>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="public/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="public/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="public/bower_components/Ionicons/css/ionicons.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="public/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="public/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="public/dist/css/skins/_all-skins.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">



<style>

    .red {
  background-color: red !important;
}


</style>
<script>



/*
$(function () {

    var branch = $("#branch").children("option:selected").val();
        $('#tempb').val(branch);

        var br = $('#tempb').val();
  var table=   $('#example1').DataTable({
        "processing": true,
                "serverSide": true,
                "select": true,
                'paging'      : true,
      'lengthChange': true,
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : true,

                "ajax":{
                    "url": "/sdb-dash/applicants",
                    "type": "GET",
                    "timeout": 0,
                    "data":[{'f_branch':br}],
                },

                "columnDefs": [ {
            "targets": -1,
            "data": null,
            "defaultContent": "<button>View</button>"
        } ]


    })



    $('#example1 tbody').on( 'click', 'button', function () {
        var data = table.row( $(this).parents('tr') ).data();
      //  alert( data[1] +"'NIC "+ data[ 4 ] );
        window.open('/sdb-dash/applicant-details?ReportID='+ data[ 3 ], '_blank');
    } );

    })

*/

$(function () {
  change_current_branch();



    function change_current_branch(is_category,app_status,product){

        //var branch = $("#branch").children("option:selected").val();
       // $('#tempb').val(branch);

      //  var br = $('#tempb').val();
        var table=   $('#example1').DataTable({
        "processing": true,
                "serverSide"  : true,
                "select"      : true,
                'paging'      : true,
                'lengthChange': true,
                'searching'   : true,
                'ordering'    : true,
                'info'        : true,
                'autoWidth'   : true,

                "ajax":{
                    url: "/sdb-dash/applicants",
                    type: "GET",
                    timeout: 0,
                    data:{'f_branch':is_category,'app_status':app_status,'product':product},
                },

                "columnDefs": [ {
                "targets": -1,
                "defaultContent": "<button>View Latest</button>"
        } ],
            "createdRow": function( row, data, dataIndex ) {
                if ( data[7] === "0" ) {
                $(row).addClass( 'red' );
                }
            }


    });






    }



// branch selection by central ops
    $('#example1 tbody').on( 'click', 'button', function () {
      var table = $('#example1').DataTable();
        var data = table.row( $(this).parents('tr') ).data();
       alert( "NIC "+ data );
       console.log(data);
        window.open('/sdb-dash/applicant-details?ReportID='+ data[ 4 ], '_blank');
    } );


/// application_status

$(document).on('change', '#application_status', function(){
        var app_status = $(this).val();
        var category = $('#branch').val();
        var product = $('#product_type').val();
        $('#example1').DataTable().destroy();
        if(category != '')
        {
          change_current_branch(category,app_status,product);
        }
        else
        {
          change_current_branch();
        }
    });

//////// divide funcvtionsa
    $(document).on('change', '#branch', function(){
        var category = $(this).val();
        var app_status = $('#application_status').val();
        var product = $('#product_type').val();
        $('#example1').DataTable().destroy();
        if(category != '')
        {
          change_current_branch(category,app_status,product);
        }
        else
        {
          change_current_branch();
        }
    });


    //////// product type
    $(document).on('change', '#product_type', function(){
        var product = $(this).val();
        var app_status = $('#application_status').val();
        var category = $('#branch').val();
        $('#example1').DataTable().destroy();
        if(category != '')
        {
          change_current_branch(category,app_status,product);
        }
        else
        {
          change_current_branch();
        }
    });


  });

</script>



</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

    @include('header')
  <!-- Left side column. contains the logo and sidebar -->




@include('sidebar')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Onboard Applications
        <small>advanced tables</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Tables</a></li>
        <li class="active">Data tables</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">


          <!-- /.box -->






          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Data Table With Full Features</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">

              <div class="col-md-12">
                <div class="col-md-4">
                  <div class="form-group">
                    <input type="hidden" value="" id="tempb"/>
                    <label>Select application status.</label>
                    <select  id="application_status"  class="form-control select2" style="width: 100%;">
                      <option value="10">All</option>
                      <option value="1">Approved</option>
                      <option value="2">Rejected</option>
                      <option value="0">Pending</option>

                    </select>
                  </div>
                </div>


                <div class="col-md-4">
                    <div class="form-group">
                      <input type="hidden" value="" id="tempb"/>
                      <label>Product Type.</label>
                      <select  id="product_type"  class="form-control select2" style="width: 100%;">
                        <option value="all">All</option>
                        <option value="savings">Savings</option>
                        <option value="fd">Fixed Deposits</option>
                      </select>
                    </div>
                  </div>


                <div class="col-md-4">

                    @if ( (int)session('user_branch')===0 )
                    <div class="form-group">
                        <input type="hidden" value="" id="tempb"/>
                        <label>Select a branch to view applications.</label>
                        <select  id="branch"  class="form-control select2" style="width: 100%;">
                          @foreach ( $branches as $ac)
                          <option value="{{$ac['code']}}">{{ $ac['name'] }}</option>
                          @endforeach
                        </select>
                      </div>
                      @else

                      <input type="hidden" value="" id="tempb"/>
                      <label>Select a branch to view applications.</label>
                      <select  id="branch"  class="form-control select2" style="width: 100%;">
                        @foreach ( $branches as $ac)
                            @if ((int)$ac['code']===(int)(int)session('user_branch'))
                            <option value="{{$ac['code']}}">{{ $ac['name'] }}</option>
                            @endif

                        @endforeach
                      </select>

                    @endif





                </div>
              </div>





              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>Application ID</th>
                    <th>Title</th>
                    <th>Full Name</th>
                    <th>F Name</th>
                    <th>NIC</th>
                    <th>Primary Mobile Number</th>
                    <th>Applied TimeStamp</th>
                    <th>Signed</th>
                    <th>Action</th>

                </tr>
                </thead>
                <tbody>

                </tbody>
                <tfoot>
                <tr>
                    <th>Application ID</th>
                    <th>Title</th>
                    <th>Full Name</th>
                    <th>F Name</th>
                    <th>NIC</th>
                    <th>Primary Mobile Number</th>
                    <th>Applied TimeStamp</th>
                    <th>Signed</th>
                    <th>Action</th>
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  @include('footer')


  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="public/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="public/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- DataTables -->
<script src="public/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="public/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>

<!-- SlimScroll -->
<script src="public/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="public/bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="public/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="public/dist/js/demo.js"></script>
<!-- page script -->
<script>
  $(function () {



  })
</script>
</body>
</html>

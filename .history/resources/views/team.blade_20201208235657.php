<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>SDB My team</title>

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
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">


  <script>
      function addTeamMember(){
        var mobile = $("#InputMobile").val();
        var name = $("#InputName").val();
        var email = $("#InputEmail").val();
        var password = $("#InputPassword").val();
        var password_c = $("#InputPassword_c").val();
        var role = $("#role").children("option:selected").val();
        var branch = $("#branch").children("option:selected").val();

console.log(branch);

        $.ajax({
                method: "POST",
                url: "api/new_member",
                data: {name, email, password, password_c, mobile, role, branch}
                })
                .done(function( msg ) {
                    alert( "Data Saved: " + msg );
                });


      }
  </script>


<script>
    $(function () {
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
                      "url": "/sdb-dash/myteam_members",
                      "type": "GET",
                      "timeout": 0,
                  },

                  "columnDefs": [ {
              "targets": -1,
              "data": null,
              "defaultContent": "<button>Edit</button>"
          } ]


      })






      $('#example1 tbody').on( 'click', 'button', function () {
          var data = table.row( $(this).parents('tr') ).data();
          alert( data[1] +"'NIC "+ data[ 4 ] );
        //  window.open('/sdb-dash/applicant-details?ReportID='+ data[ 4 ], '_blank');
      } );



    })
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
        General Team
        <small>Preview</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Team</a></li>
        <li class="active">General</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-6">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Quick Register</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form">
                <div class="box-body">

                    <div class="form-group">
                        <label for="exampleInputEmail1">Mobile</label>
                        <input type="number" class="form-control" id="InputMobile" placeholder="Enter mobile">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <input type="email" class="form-control" id="InputEmail" placeholder="Enter email">
                    </div>
                    <div class="form-group">
                    <label for="exampleInputEmail1">Name</label>
                    <input type="text" class="form-control" id="InputName" placeholder="Enter name">
                    </div>

                    <div class="form-group">
                    <label for="exampleInputPassword1">Password</label>
                    <input type="password" class="form-control" id="InputPassword" placeholder="Password">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputPassword1">Re enter Password</label>
                        <input type="password" class="form-control" id="InputPassword_c" placeholder="Password">
                    </div>


                    <!-- select -->
                    <div class="form-group">
                        <label>Role</label>
                        <select id="role" class="form-control">
                        <option value="bdo">BDO</option>
                        <option value="manager"> Manager (Approval Officer)</option>
                        </select>
                    </div>

                    <!-- select -->
                    <div class="form-group">
                        <label>Branch</label>
                        <select id="branch" class="form-control">
                            @foreach ( $branches as $ac)
                            <option value="{{$ac['code']}}">{{ $ac['name'] }}</option>
                            @endforeach
                        </select>
                    </div>


                    <div class="checkbox">
                    <label>
                        <input type="checkbox"> Check me out
                    </label>
                    </div>
                </div>
                <!-- /.box-body -->

                <div class="box-footer">
                    <button type="submit" onclick="addTeamMember()" class="btn btn-primary">Add new team member</button>
                </div>
            </form>
          </div>
          <!-- /.box -->


        </div>
        <!--/.col (left) -->


        <!-- right column -->
        <div class="col-md-6">
          <!-- Horizontal Form -->

          <div class="box">
            <div class="box-header">
              <h3 class="box-title">My team members</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Mobile</th>
                    <th>Role</th>
                    <th>Action</th>

                </tr>
                </thead>
                <tbody>

                </tbody>
                <tfoot>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Mobile</th>
                    <th>Role</th>
                    <th>Action</th>
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
          </div>


      </div>
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
<!-- FastClick -->
<script src="public/bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="public/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="public/dist/js/demo.js"></script>
</body>
</html>

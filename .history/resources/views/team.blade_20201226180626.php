<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>SDB My team</title>

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







  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">


  <script>
      function addTeamMember(){
        var empid = $("#InputEmpID").val();
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


      function check_emp_id(){
        var empid = $("#InputEmpID").val();

        $.ajax({
                method: "POST",
                url: "api/minitHR",
                data: {empid, empid}
                })
                .done(function( msg ) {

                    if (typeof msg !== 'undefined') {
                        console.log(msg);
                        var emp = JSON.parse(msg);
                        alert(emp["data"]['emp_branch']);
                    }else{
                        console.log("No records");
                    }

                    //alert( "Data Saved: " + msg );
                });

      }
  </script>



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


  <!-- confirm alerts  -->
  <link rel="stylesheet" href="public/jqalerts/jquery-confirm.min.css">
  <!--confirm alerts  -->
  <script src="public/jqalerts/jquery-confirm.min.js"></script>


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
        //  alert( data[1] +"'NIC "+ data[ 4 ] );
          team_member_details(data[1]);
          $('#exampleModalCenter').modal('show');
        //  window.open('/sdb-dash/applicant-details?ReportID='+ data[ 4 ], '_blank');

      } );



    })


    function team_member_details(email){

        $.ajax({
                method: "get",
                url: "api/my_team_member",
                data: {email, email}
                })
                .done(function( msg ) {
                   // alert( "Data Saved: " + msg );
                   var k = JSON.parse(msg);
                   console.log(k)

                   $("#editInputMobile").val(k['mobile']);
                   $("#editInputName").val(k['name']);
                   $("#editInputEmail").val(k['email']);
                   $("div.id_100 select").val(k['role']);
                   $("div.id_101 select").val(k['branch']);
                   $("#editInputCEmail").val(k['email']);


                  // $("#role").children("option:selected").val();
                   //$("#branch").children("option:selected").val();


                });

    }


    function delete_team_member_details(){

        var email = $("#editInputEmail").val();
        $.ajax({
            method: "post",
            url: "api/delete_my_team_member",
            data: {email, email}
        })
        .done(function( msg ) {
           // alert( "Data Saved: " + msg );
           var k = JSON.parse(msg);
           console.log(k)
           if(msg==1|msg=="1"){
                     // alert( "Deleted : " + msg );
                      location.reload();
                    }else{
                      alert("Error in Deletion")
                    }
/*
           $("#editInputMobile").val(k['mobile']);
           $("#editInputName").val(k['name']);
           $("#editInputEmail").val(k['email']);
           $("div.id_100 select").val(k['role']);
           $("div.id_101 select").val(k['branch']);
           $("#editInputCEmail").val(k['email']);

*/
          // $("#role").children("option:selected").val();
           //$("#branch").children("option:selected").val();


        });

}


    function reset_req_pass(){

            var email = $("#editInputEmail").val();
            $.ajax({
                method: "post",
                url: "api/req_new_pass",
                data: {email, email}
            })
            .done(function( msg ) {
            // alert( "Data Saved: " + msg );
            var k = JSON.parse(msg);
            console.log(k)
            location.reload();

            });

    }


// update staff member details
    function update_team_member_details(){
        var mobile = $("#editInputMobile").val();
        var name = $("#editInputName").val();
        var email = $("#editInputEmail").val();
        var cemail = $("#editInputCEmail").val();
        var role = $("#editrole").children("option:selected").val();
        var branch = $("#editbranch").children("option:selected").val();


        $.ajax({
                method: "POST",
                url: "api/update_my_team_member",
                data: {name:name, email:email,cemail:cemail, mobile:mobile, role:role, branch:branch}
                })
                .done(function( msg ) {
                    console.log(msg);
                    if(msg==1|msg=="1"){
                     // alert( "Updated : " + msg );
                      location.reload();
                    }else{
                      alert("Error in update")
                    }



                });


      }


      function sure_update(){
        $.confirm({
                    title: 'Change user details?',
                    content: 'This dialog will automatically trigger \'cancel\' in 6 seconds if you don\'t respond.',
                    autoClose: 'cancelAction|8000',
                    buttons: {
                        deleteUser: {
                            text: 'Modify user',
                            action: function () {
                                update_team_member_details();
                                $.alert('Modified the user!');
                            }
                        },
                        cancelAction: function () {
                            $.alert('action is canceled');
                        }
                    }
                });
      }



      function sure_delete(){


        $.confirm({
                    title: 'Delete user?',
                    content: 'This dialog will automatically trigger \'cancel\' in 6 seconds if you don\'t respond.',
                    autoClose: 'cancelAction|8000',
                    buttons: {
                        deleteUser: {
                            text: 'delete user',
                            action: function () {
                                delete_team_member_details();
                                $.alert('Deleted the user!');
                            }
                        },
                        cancelAction: function () {
                            $.alert('action is canceled');
                        }
                    }
                });




      }



      function req_new_pass(){

        $.confirm({
                    title: 'Reset user password ?',
                    content: 'This dialog will automatically trigger \'cancel\' in 6 seconds if you don\'t respond.',
                    autoClose: 'cancelAction|8000',
                    buttons: {
                        deleteUser: {
                            text: 'Reset Password',
                            action: function () {
                                reset_req_pass();
                                $.alert('New password has been sent as SMS successfully!');
                            }
                        },
                        cancelAction: function () {
                            $.alert('action is canceled');
                        }
                    }
                });


      }
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
                        <label for="exampleInputEmail1">Employee ID</label>
                        <input type="empid" onkeyup="check_emp_id()" class="form-control" id="InputEmpID" placeholder="Enter employee ID number">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Mobile</label>
                        <input type="number" class="form-control" id="InputMobile" placeholder="Enter mobile">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <input disabled type="email" class="form-control" id="InputEmail" placeholder="Enter email">
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








<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Modify</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">





     <!-- general form elements -->
     <div class="box box-primary">

        <!-- /.box-header -->
        <!-- form start -->
        <form role="form">
            <div class="box-body">

                <div class="form-group">
                    <label for="exampleInputEmail1">Mobile</label>
                    <input type="number" class="form-control" id="editInputMobile" placeholder="Enter mobile">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Email address</label>
                    <input type="email" class="form-control" id="editInputEmail" placeholder="Enter email">
                </div>
                <div class="form-group">
                <label for="exampleInputEmail1">Name</label>
                <input type="text" class="form-control" id="editInputName" placeholder="Enter name">
                </div>


                <!-- select -->
                <div class="form-group id_100">
                    <label>Role</label>
                    <select id="editrole" class="form-control">
                    <option value="bdo">BDO</option>
                    <option value="manager"> Manager (Approval Officer)</option>
                    <option value="na"> Remove roll</option>
                    </select>
                </div>

                <!-- select -->
                <div class="form-group id_101">
                    <label>Branch</label>
                    <select id="editbranch" class="form-control">
                        @foreach ( $branches as $ac)
                        <option value="{{$ac['code']}}">{{ $ac['name'] }}</option>
                        @endforeach
                    </select>
                </div>



            </div>
            <!-- /.box-body -->

            <input type="hidden" class="form-control" id="editInputCEmail" >
        </form>
      </div>
      <!-- /.box -->






        </div>
        <div class="modal-footer">
            @if (session('user_branch')==0|session('user_branch')=="0")
            <!-- <button type="button" onclick="sure_delete()" class="btn btn-block btn-danger">Delete user</button> -->
            <button type="button" onclick="req_new_pass()" class="btn btn-block btn-danger">Reset Password</button>
            @endif

          <button type="button" onclick="sure_update()" class="btn btn-block btn-warning">Save changes</button>
          <button type="button" class="btn btn-block btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>





</body>
</html>

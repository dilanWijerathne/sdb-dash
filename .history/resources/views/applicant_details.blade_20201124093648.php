<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>SDB</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="public/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="public/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="public/bower_components/Ionicons/css/ionicons.min.css">
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

      function review(code,email){

               var bdocode = $('#bdocode').val();
               var bdoemail = $('#bdoemail').val();
               var appref = $('#appref').val();


        alert("You marked review status");
        $.ajax({
            method: "POST",
            url: "api/review",
            data: { bdo: bdoemail,type:type,appref:appref}
            })
            .done(function( msg ) {
                console.log(msg);
                alert( msg );
                location.reload();

            });
      }

      // "http://10.101.6.198/sdbl/inapp",
      function cacc(){
          var nic = $('#nicvalue').val();

          alert("You are going to create account for : "+ nic);
        $.ajax({
            method: "POST",
            url: "api/applicant-approval",
            data: { nic: nic}
            })
            .done(function( msg ) {
                console.log(msg);
                alert( msg );
                location.reload();

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
        {{$Applicant['full_name']}}
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">SDB Central</a></li>
        <li class="active">User profile</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="row">
        <div class="col-md-3">

          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">

                <img class="profile-user-img img-responsive img-circle" src="http://10.101.6.198/sdbl/public/user.png" alt="User profile picture">


              <h3 class="profile-username text-center"> {{$Applicant['nic']}} - {{$Applicant['sex']}} </h3>
                <input type="hidden" value="{{$Applicant['nic']}}" id="nicvalue"  />
              <p class="text-muted text-center">{{$Applicant['applicant_status']}}</p>

                <!-- primary display section -->
              <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  <b>Account going to open</b> <a class="pull-right">{{$Applicant['applicant_going_to_open']}}</a>
                </li>

                @if($Applicant['applicant_individual_account_type']!==null)
                <li class="list-group-item">
                  <b>Applicant individual account type</b> <a class="pull-right"> {{$Applicant['applicant_individual_account_type']}}</a>
                </li>
                @endif

                @if($Applicant['existing_customer']==='true')

                <li class="list-group-item">
                  <b>Existing customer</b> <a class="pull-right">CIF  @if(isset($cif['cif'])){{$cif['cif']}} @endif</a>
                </li>
                @endif


                <li class="list-group-item" style="color: red">
                  <b>PEP</b> <a class="pull-right">{{$KYC['pep']}}</a>
                </li>

              </ul>
               <!-- end primary display section -->
               <hr>


                <!-- primary display section -->
              <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  <b>Date of birth</b> <a class="pull-right">: dd {{$Applicant['birth_day']}}- mm {{$Applicant['birth_month']}}- yyyy {{$Applicant['birth_year']}} </a>
                </li>

                <li class="list-group-item">
                  <b>Primary mobile</b> <a class="pull-right"> {{$Applicant['primary_mobile_number']}}</a>
                </li>

                @if($Applicant['secondary_mobile_number']!==""|$Applicant['secondary_mobile_number']!==null)
                <li class="list-group-item">
                  <b>Secondary contact number</b> <a class="pull-right"> {{$Applicant['secondary_mobile_number']}}</a>
                </li>
                @endif


                <li class="list-group-item">
                  <b>Email</b> <a class="pull-right"> {{$Applicant['email']}}</a>
                </li>
                <li class="list-group-item">
                  <b>District</b> <a class="pull-right"> {{$Applicant['district']}}</a>
                </li>

                <li class="list-group-item">
                  <b>Address</b> <a class="pull-right"> {{$Applicant['address1']}}, {{$Applicant['address2']}},{{$Applicant['address3']}}</a>
                </li>

                <hr>

                <li class="list-group-item">
                  <b>Applied timestamp</b> <a class="pull-right"> {{$Applicant['updated_at']}}</a>
                </li>

                <hr>
                <div class="box-header with-border">
                    <h3 class="box-title"> Avaiable accounts</h3>
                  </div>



                  @isset($acc[0])

                    @foreach ($acc as $ac)
                    <li class="list-group-item">
                        <b>Account number</b> <a class="pull-right"> {{ $ac['account_number'] }} </a>
                        </li>

                    @endforeach
                  @endisset






                <hr>



              </ul>
               <!-- end primary display section -->

               <input type="hidden" value="{{$bdo['code']}}"  id="#bdocode"/>>
               <input type="hidden" value="{{$bdo['email']}}"  id="#bdoemail"/>>
               <input type="hidden" value="{{$Applicant['ref']}}"  id="#appref"/>>

               @if ($Applicant['approved'] ===1 |  $Applicant['approved'] ==='1' )
               <a onclick="" class="btn btn-primary btn-block"><b>Reviewd by Manager</b></a>
               @endif
               @if ($Applicant['ops'] ===1 |  $Applicant['ops'] ==='1' )
               <a onclick="" class="btn btn-primary btn-block"><b>Reviewd by Centralized Ops</b></a>
               @endif
               @if ($Applicant['approved'] ===0 |  $Applicant['approved'] ==='0' )
               <a onclick="review()" class="btn btn-primary btn-warning btn-block"><b>Reviewed</b></a>
               @endif

            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

          <!-- About Me Box -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title"> For  Your Info</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">




              <strong><i class="fa fa-map-marker margin-r-5"></i> Location</strong>

              <p class="text-muted">Kirulapona, Colombo</p>

              <hr>

              <strong><i class="fa fa-map-marker margin-r-5"></i> BDO</strong>
             <p class="text-muted">{{$bdo['email']}}</p>

              <hr>
              <strong><i class="fa fa-map-marker margin-r-5"></i> Branch</strong>
              <p class="text-muted"> {{$bdo['name']}} </p>

               <hr>

               <a onclick="cacc()" class="btn btn-primary btn-block"><b>Approve</b></a>
               <a href="#" class="btn btn-primary btn-warning btn-block"><b>Request to improve</b></a>
               <a href="#" class="btn btn-primary btn-danger  btn-block"><b>Reject</b></a>


            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#activity" data-toggle="tab">Applicant Info</a></li>
              <li><a href="#timeline" data-toggle="tab">Timeline</a></li>
              <li><a href="#settings" data-toggle="tab">Message to BDO</a></li>
            </ul>
            <div class="tab-content">
              <div class="active tab-pane" id="activity">


                <!-- Post -->
                <div class="post clearfix">
                  <div class="user-block">
                    <img class="img-circle img-bordered-sm" src="public/dist/icons/worker-green-icon.png" alt="User Image">
                        <span class="username">
                          <a href="#">Captured info</a>
                          <a href="#" class="pull-right btn-box-tool"><i class="fa fa-times"></i></a>
                        </span>

                  </div>
                  <!-- /.user-block -->

   <!-- =========================================================== -->

   <div class="row">

    <div class="col-md-4">
      <div class="box box-warning collapsed-box">
        <div class="box-header with-border">
          <h3 class="box-title">Nominees</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
            </button>
          </div>
          <!-- /.box-tools -->
        </div>
        <!-- /.box-header -->
        <div class="box-body">
         {{$Nominee['json']}}
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>
    <!-- /.col -->

<div class="col-md-4">
      <div class="box box-warning collapsed-box">
        <div class="box-header with-border">
          <h3 class="box-title">Line of work</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
            </button>
          </div>
          <!-- /.box-tools -->
        </div>
        <!-- /.box-header -->
        <div class="box-body">



                 <!-- primary display section -->
                 <ul class="list-group list-group-unbordered">
                     @if($WorkPlace['name']!=="")
                    <li class="list-group-item">
                      <b>Employer :</b> <a class="pull-right">{{$WorkPlace['name']}}</a>
                    </li>
                    @endif

                    @if($WorkPlace['address']!=="")
                    <li class="list-group-item">
                        <b>Employer Address :</b> <a class="pull-right">{{$WorkPlace['address']}}</a>
                      </li>
                      @endif
                      @if($WorkPlace['telephone']!=="")
                      <li class="list-group-item">
                        <b>Telephone :</b> <a class="pull-right">{{$WorkPlace['telephone']}}</a>
                      </li>
                      @endif

                      @if($WorkPlace['position']!=="")
                      <li class="list-group-item">
                        <b>Position :</b> <a class="pull-right">{{$WorkPlace['position']}}</a>
                      </li>
                      @endif

                      @if($WorkPlace['income_monthly']!=="")
                      <li class="list-group-item">
                        <b>Monthly income :</b> <a class="pull-right">{{$WorkPlace['income_monthly']}}</a>
                      </li>
                      @endif
                      @if($WorkPlace['other_income']!=="")
                      <li class="list-group-item">
                        <b>Other income :</b> <a class="pull-right">{{$WorkPlace['other_income']}}</a>
                      </li>
                      @endif


                  </ul>
                   <!-- end primary display section -->



        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>
    <!-- /.col -->
    <div class="col-md-4">
        <div class="box box-warning collapsed-box">
          <div class="box-header with-border">
            <h3 class="box-title">KYC</h3>

            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
              </button>
            </div>
            <!-- /.box-tools -->
          </div>
          <!-- /.box-header -->
          <div class="box-body">
           {{$KYC['json']}}
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
      </div>
      <!-- /.col -->

    <!-- /.col -->
  </div>
  <!-- /.row -->

  <!-- =========================================================== -->




                  <form class="form-horizontal">
                    <div class="form-group margin-bottom-none">
                      <div class="col-sm-9">
                        <input class="form-control input-sm" placeholder="Response">
                      </div>
                      <div class="col-sm-3">
                        <button type="submit" class="btn btn-danger pull-right btn-block btn-sm">Comment</button>
                      </div>
                    </div>
                  </form>
                </div>
                <!-- /.post -->

                @if(isset($nicf['file_path']))


                <!-- Post -->
                <div class="post">
                  <div class="user-block">
                    <img class="img-circle img-bordered-sm" src="public/dist/icons/User-Files-icon.png" alt="User Image">
                        <span class="username">
                          <a href="#">Captured Docs</a>
                          <a href="#" class="pull-right btn-box-tool"><i class="fa fa-times"></i></a>
                        </span>

                  </div>
                  <!-- /.user-block -->
                  <div class="row margin-bottom">

                    <div class="col-sm-6">
                      <img class="img-responsive" src="http://10.101.6.198/sdbl/public/{{$nicf['file_path']}}" alt="Photo">
                    </div>


                    <div class="col-sm-6">
                        <img class="img-responsive" src="http://10.101.6.198/sdbl/public/{{$nicr['file_path']}}" alt="Photo">
                      </div>



                    <!-- /.col -->
                  </div>
                  <!-- /.row -->




                     <!-- /.user-block -->
                     <div class="row margin-bottom">

                        @isset($proof['file_path'])
                        <div class="col-sm-6">
                          <img class="img-responsive" src="http://10.101.6.198/sdbl/public/{{$proof['file_path']}}" alt="Photo">
                        </div>
                        @endisset



                        <!-- /.col -->
                        <div class="col-sm-6">
                          <div class="row">


                            <div class="col-sm-6">
                             @isset($selfie['file_path'])
                              <img class="img-responsive" src="http://10.101.6.198/sdbl/public/{{$selfie['file_path']}}" alt="Photo">
                              @endisset
                              <br>

                              <img class="img-responsive" src="{{$signature['signature']}}" alt="Photo">


                            </div>


                            <!-- /.col -->


                           <!--

                             <div class="col-sm-6">
                              <img class="img-responsive" src="public/dist/img/photo4.jpg" alt="Photo">
                              <br>
                              <img class="img-responsive" src="public/dist/img/photo1.png" alt="Photo">
                            </div>

                            --->


                            <!-- /.col -->
                          </div>
                          <!-- /.row -->
                        </div>
                        <!-- /.col -->
                      </div>
                      <!-- /.row -->




                  <ul class="list-inline">
                    <li><a href="#" class="link-black text-sm"><i class="fa fa-share margin-r-5"></i> Share</a></li>
                    <li><a href="#" class="link-black text-sm"><i class="fa fa-thumbs-o-up margin-r-5"></i> Like</a>
                    </li>
                    <li class="pull-right">
                      <a href="#" class="link-black text-sm"><i class="fa fa-comments-o margin-r-5"></i> Comments
                        (5)</a></li>
                  </ul>

                  <input class="form-control input-sm" type="text" placeholder="Type a comment">
                </div>

                @endif

                <!-- /.post -->
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="timeline">
                <!-- The timeline -->
                <ul class="timeline timeline-inverse">
                  <!-- timeline time label -->
                  <li class="time-label">
                        <span class="bg-red">
                          10 Feb. 2014
                        </span>
                  </li>
                  <!-- /.timeline-label -->
                  <!-- timeline item -->
                  <li>
                    <i class="fa fa-envelope bg-blue"></i>

                    <div class="timeline-item">
                      <span class="time"><i class="fa fa-clock-o"></i> 12:05</span>

                      <h3 class="timeline-header"><a href="#">Support Team</a> sent you an email</h3>

                      <div class="timeline-body">
                        Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles,
                        weebly ning heekya handango imeem plugg dopplr jibjab, movity
                        jajah plickers sifteo edmodo ifttt zimbra. Babblely odeo kaboodle
                        quora plaxo ideeli hulu weebly balihoo...
                      </div>
                      <div class="timeline-footer">
                        <a class="btn btn-primary btn-xs">Read more</a>
                        <a class="btn btn-danger btn-xs">Delete</a>
                      </div>
                    </div>
                  </li>
                  <!-- END timeline item -->
                  <!-- timeline item -->
                  <li>
                    <i class="fa fa-user bg-aqua"></i>

                    <div class="timeline-item">
                      <span class="time"><i class="fa fa-clock-o"></i> 5 mins ago</span>

                      <h3 class="timeline-header no-border"><a href="#">Sarah Young</a> accepted your friend request
                      </h3>
                    </div>
                  </li>
                  <!-- END timeline item -->
                  <!-- timeline item -->
                  <li>
                    <i class="fa fa-comments bg-yellow"></i>

                    <div class="timeline-item">
                      <span class="time"><i class="fa fa-clock-o"></i> 27 mins ago</span>

                      <h3 class="timeline-header"><a href="#">Jay White</a> commented on your post</h3>

                      <div class="timeline-body">
                        Take me to your leader!
                        Switzerland is small and neutral!
                        We are more like Germany, ambitious and misunderstood!
                      </div>
                      <div class="timeline-footer">
                        <a class="btn btn-warning btn-flat btn-xs">View comment</a>
                      </div>
                    </div>
                  </li>
                  <!-- END timeline item -->
                  <!-- timeline time label -->
                  <li class="time-label">
                        <span class="bg-green">
                          3 Jan. 2014
                        </span>
                  </li>
                  <!-- /.timeline-label -->
                  <!-- timeline item -->
                  <li>
                    <i class="fa fa-camera bg-purple"></i>

                    <div class="timeline-item">
                      <span class="time"><i class="fa fa-clock-o"></i> 2 days ago</span>

                      <h3 class="timeline-header"><a href="#">Mina Lee</a> uploaded new photos</h3>

                      <div class="timeline-body">
                        <img src="http://placehold.it/150x100" alt="..." class="margin">
                        <img src="http://placehold.it/150x100" alt="..." class="margin">
                        <img src="http://placehold.it/150x100" alt="..." class="margin">
                        <img src="http://placehold.it/150x100" alt="..." class="margin">
                      </div>
                    </div>
                  </li>
                  <!-- END timeline item -->
                  <li>
                    <i class="fa fa-clock-o bg-gray"></i>
                  </li>
                </ul>
              </div>
              <!-- /.tab-pane -->

              <div class="tab-pane" id="settings">
                <form class="form-horizontal">
                  <div class="form-group">



                  <div class="form-group">
                    <label for="inputExperience" class="col-sm-2 control-label">Message</label>

                    <div class="col-sm-10">
                      <textarea class="form-control" id="inputExperience" placeholder="Experience"></textarea>
                    </div>
                  </div>






                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <button type="submit" class="btn btn-danger">Submit</button>
                    </div>
                  </div>
                </form>
              </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  @include('footer')


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

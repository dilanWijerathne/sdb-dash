<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Customer onboarding</title>
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

<style>

.descp{
    font-size: 8px;
}
</style>

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <script
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD6eeNDwS3BxO8m1EmWnkLRRuCcFyN3guE&callback=initMap&libraries=&v=weekly"
      defer
    ></script>

    <style type="text/css">
        /* Set the size of the div element that contains the map */
        #map {
          height: 400px;
          /* The height is 400 pixels */
          width: 300px;
          /* The width is the width of the web page */
        }
        .img-responsive_custom{
            display: block;
            max-width: 300px;
            max-height: 400px;
            margin: auto;

        }

        .img-responsive_custom2{
            display: block;
            max-width: 200px;
            max-height: 200px;
            margin-top: 10;

        }

        .img-frame{
            height: 430px;
            border-width: 1px;
            border-color: darkgray;
            border-style: ridge
        }
        .img-frame2{
            height: 430px;
            border-width: 1px;
            margin-top: 10;
            border-color: darkgray;
            border-style: ridge
        }
      </style>



  <script>



      // Initialize and add the map
function initMap() {

    var gps_json = $('#gps').val();
    var gps_obj = JSON.parse(gps_json);
    alert(gps_obj.coords.latitude);
    console.log(gps_obj.coords.latitude);
  // The location of Uluru
  const uluru = { lat:gps_obj.coords.latitude, lng: gps_obj.coords.longitude };
  // The map, centered at Uluru
  const map = new google.maps.Map(document.getElementById("map"), {
    zoom: 6,
    center: uluru,
  });
  // The marker, positioned at Uluru
  const marker = new google.maps.Marker({
    position: uluru,
    map: map,
  });
}


    function send_msg(from,to,ref,nic){
        console.log("send msg clicked");
        var msg = $('#message_input').val();

        $.confirm({
            title: 'Confirm!',
            content: 'Simple confirm!',
            buttons: {
                confirm: function () {
                    //$.alert('Confirmed!');

                // alert(comment+"  "+bdo+"  "+ref);
                    if(msg.length>3){


                        ///
                        $.ajax({
                            method: "GET",
                            url: "api/nessage_send",
                            data: {from_user:from,to_user:to,msg:msg,nic:nic, ref: ref}
                            })
                            .done(function( msg ) {
                                msg(ref);
                                console.log(msg);
                                location.reload();

                            });
                        ///

                    }
                    else{
                        //alert("Please add a valid comment. you cannot comment empty fields!");
                        $.alert('Please provide a valid message!');
                    }
                },
                cancel: function () {
                    $.alert('Canceled!');
                },

            }
        });

/////////////////

        /////////



            /////////
    }




      function msg(ref){
          //line 740

          console.log("msg li clicked");
          $.ajax({
            method: "GET",
            url: "api/nessage_by_ref",
            data: { ref: ref}
            })
            .done(function( msg ) {
                var k = JSON.parse(msg);

            ///        line 504
            var st ="";
            for(var i=0; i<k.length;i++){
                var t = '<div class="col-sm-12" style="margin-top: 50px" ><div class="col-sm-10"><dl><dt> ->  '+k[i]['from_user']+' for application no '+k[i]['ref']+' of NIC '+k[i]['nic']+'</dt><dd> '+k[i]['msg']+'</dd><dd>'+k[i]['created_at']+'</dd></dl><hr></div> </div>';
                st = st.concat(t);
            }

            console.log(st);
            $(".message_list").html( st );


            });
      }


function com_list(ref){


        $.ajax({
            method: "GET",
            url: "api/comment_by_bdo_app",
            data: { ref: ref}
            })
            .done(function( msg ) {
                var k = JSON.parse(msg);

            ///        line 504
            var st ="";
            for(var i=0; i<k.length;i++){
                var t = '<div class="col-sm-12"><div class="col-sm-9"><dl><dt>Commented by : '+k[i]['from']+'</dt><dd> '+k[i]['msg']+'</dd></dl><hr></div>         <div class="col-sm-3">    <b>@</b> '+' '+k[i]['created_at']+'       </div><hr></div>';
                st = st.concat(t);
            }

            console.log(st);
            $(".comlist").append( st );
            blacklist_check();
            });


      }

// check black list internally of

      function blacklist_check(){
        //var nic = "760054291V";// $('#nicvalue').val();
        var nic =  $('#nicvalue').val();
            $.ajax({
                method: "POST",
                url: "api/blacklist_check",
                data: { nic: nic}
                })
                .done(function( msg ) {
                    var k = JSON.parse(msg);
                    console.log(k);



                if (k['JSON']['Status']['Status'] === 'OK') {
                            var ti =  ' <h3 class="box-title"> For  Your Info</h3>';
                            var st1 = ' <li class="list-group-item"><b>'+k['JSON']['Customer']['name']+'</b> <a class="pull-right">  </a></li>';
                            var st2 = ' <li class="list-group-item"><b>Address line 1</b> <a class="pull-right"> '+k['JSON']['Customer']['address_line_1']+' </a></li>';
                            var st3 = ' <li class="list-group-item"><b>Address line 2</b> <a class="pull-right"> '+k['JSON']['Customer']['address_line_2']+' </a></li>';
                            var st4 = ' <li class="list-group-item"><b>Remarks Line 1</b> <a class="pull-right"> '+k['JSON']['Customer']['remarks_line_1']+' </a></li>';
                            var st5 = ' <li class="list-group-item"><b>Remarks Line 2</b> <a class="pull-right"> '+k['JSON']['Customer']['remarks_line_2']+' </a></li>';
                            var st6 = ' <li class="list-group-item"><b>Rec Type</b> <a class="pull-right"> '+k['JSON']['Customer']['rec_type']+' </a></li>';
                            var st7 = ' <li class="list-group-item"><b>Expire Date</b> <a class="pull-right"> '+k['JSON']['Customer']['expire_date']+' </a></li>';
                            console.log(k['JSON']['Customer']['name']);
                            console.log(k['JSON']['Customer']['remarks_line_1']);
                            $("#blacklist_items").append(st1);
                            $("#blacklist_items").append( st2 );
                            $("#blacklist_items").append( st3 );
                            $("#blacklist_items").append( st4 );
                            $("#blacklist_items").append( st5 );
                            $("#blacklist_items").append( st6 );
                            $("#blacklist_items").append( st7 );


                      console.log(k);

            }else{
              var stext = "No sanctioned data";
              var st1 = ' <li class="list-group-item"><b>'+stext+'</b> <a class="pull-right">  </a></li>';
              $("#blacklist_items").append(st1);
            }

        });
      }





      function review(code,ref,user_email){




            var type = "";
            if(code==="0"| code===0){
                var type = 'ops';
            }else{
                var type = 'mng';
            }


            console.log("Type " + type + "  - > officer bdo- mng  "+ user_email+ "  -> app ref " + ref);

            //alert("Type " + type + "  - > officer bdo- mng  "+ user_email+ "  -> app ref " + ref);
    //    alert("You marked review status");
        $.ajax({
            method: "POST",
            url: "api/review",
            data: { bdo: user_email,type:type,ref:ref}
            })
            .done(function( msg ) {
                console.log(msg);
             //   alert( msg );
                location.reload();

            });
      }

      /// reject application

      function reject(code,ref,user_email){


        console.log(" officer bdo- mng  "+ user_email+ "  -> app ref " + ref);

        alert("officer bdo- mng  "+ user_email+ "  -> app ref " + ref);
        alert("You marked review status");
        $.ajax({
        method: "POST",
        url: "api/reject",
        data: { bdo: user_email,ref:ref}
        })
        .done(function( msg ) {
            console.log(msg);
            alert( msg );
            location.reload();

        });
    }


      function cacc(branch, ref,u_email){

            var ref = $('#appref').val();
            var nic = $('#nicvalue').val();
            $('#approve_text').html('Please Wait...');
            $('#approve_button').off('click');

          review(branch, ref,u_email);
        $.ajax({
            method: "POST",
            url: "api/applicant-approval",
            data: { ref: ref}
            })
            .done(function( msg ) {
                console.log(msg);
                alert( msg );

                location.reload();
            });
      }


      function cacc_old(branch, ref,u_email){


     var nic = $('#nicvalue').val();
     $('#approve_text').html('Please Wait...');
       $('#approve_button').off('click');

     review(branch, ref,u_email);
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






      function comment_fd(){
        var comment = $('#comment_input').val();
        var bdo = $('#bdoemail').val();
        var ref = $('#appref').val();
        var from = $('#user_name').val();

        $.confirm({
            title: 'Confirm!',
            content: 'Simple confirm!',
            buttons: {
                confirm: function () {
                    //$.alert('Confirmed!');

                // alert(comment+"  "+bdo+"  "+ref);
                    if(comment.length>3){


                        ///
                        $.ajax({
                        method: "POST",
                        url: "api/comment",
                        data: { msg: comment,bdo:bdo,ref:ref,from:from}
                        })
                        .done(function( msg ) {
                            console.log(msg);
                            $.alert( msg );
                            location.reload();

                        });

                        ///

                    }
                    else{
                        //alert("Please add a valid comment. you cannot comment empty fields!");
                        $.alert('Please add a valid comment. you cannot comment empty fields!');
                    }
                },
                cancel: function () {
                    $.alert('Canceled!');
                },

            }
        });

//

/*
        var comment = $('#comment_input').val();
        var bdo = $('#bdoemail').val();
        var ref = $('#appref').val();
        var from = $('#user_name').val();
        alert(comment+"  "+bdo+"  "+ref);
        if(comment!==null|comment!==""| comment!==" "){


            ///
            $.ajax({
            method: "POST",
            url: "api/comment",
            data: { msg: comment,bdo:bdo,ref:ref,from:from}
            })
            .done(function( msg ) {
                console.log(msg);
                alert( msg );
                location.reload();

            });

            ///

        }
        else{
            alert("Please add a valid comment. you cannot comment empty fields!");
        }

*/
        //
      }


  </script>
</head>
<body onload=" com_list({{$Applicant['ref']}})" class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

    @include('header')
  <!-- Left side column. contains the logo and sidebar -->
  @include('sidebar')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section  class="content-header">
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
        <div class="col-md-4">

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
                  <b> Customer CIF</b> <a class="pull-right">  @if(isset($cif['cif'])){{$cif['cif']}} @endif</a>
                </li>
                @endif

                @if(isset($KYC['pep']))
                <li class="list-group-item" style="color: red">
                  <b>PEP</b> <a class="pull-right">{{$KYC['pep']}}</a>
                </li>
                @endif

                @if(isset($KYC['pep_relationship']))
                <li class="list-group-item" style="color: red">
                  <b>PEP Relationship</b> <a class="pull-right">{{$KYC['pep_relationship']}}</a>
                </li>
                @endif

              </ul>
               <!-- end primary display section -->
               <hr>


               @isset($investment['desposit'])
               <ul class="list-group list-group-unbordered">
                @if(isset($investment['desposit']))
                <li class="list-group-item">
                  <b>Investment Value</b> <a class="pull-right"> {{$investment['desposit']}} LKR</a>
                </li>
                @endif

                @if(isset($investment['desposit']))
                <li class="list-group-item">
                  <b>Investment period</b> <a class="pull-right"> {{$investment['period']}} M</a>
                </li>
                @endif


               </ul>
               @endisset


               @isset($fd['desposit'])
                     <!-- primary display section -->
              <ul class="list-group list-group-unbordered">


                @if(isset($fd['desposit']))
                <li class="list-group-item">
                  <b>FD Value</b> <a class="pull-right"> {{$fd['desposit']}} LKR</a>
                </li>
                @endif

                @if(isset($fd['period']))
                <li class="list-group-item">
                  <b>FD Period</b> <a class="pull-right"> {{$fd['period']}} M</a>
                </li>
                @endif






                @if(isset( $fd['interest_disposal_method'] ))

                  @if ($fd['interest_disposal_method']==="monthly")
                  <li class="list-group-item">
                    <b>Interest disposal method</b> <a class="pull-right">Monthly </a>
                  </li>
                  @endif

                  @if ($fd['interest_disposal_method']==="maturity")
                  <li class="list-group-item">
                    <b>Interest disposal method</b> <a class="pull-right">Maturity </a>
                  </li>
                  @endif

                @endif


                @if(isset( $fd['interest_payable_at'] ))

                  @if ($fd['interest_payable_at']==="disposeOther")
                  <li class="list-group-item">
                    <b>Interest payable at</b> <a class="pull-right"> Dispose to other bank account </a>
                  </li>
                  @endif

                  @if ($fd['interest_payable_at']==="capitalized")
                  <li class="list-group-item">
                    <b>Interest payable at</b> <a class="pull-right">Capitalized </a>
                  </li>
                  @endif

                @endif






                @if(isset($fd['interest_transfer_bank']))
                <li class="list-group-item">
                  <b>Interest transfer bank</b> <a class="pull-right"> {{$fd['interest_transfer_bank']}}</a>
                </li>
                @endif

                @if(isset($fd['interest_transfer_acc_name']))
                <li class="list-group-item">
                  <b>Interest transfer Account Name</b> <a class="pull-right"> {{$fd['interest_transfer_acc_name']}}</a>
                </li>
                @endif

                @if(isset($fd['interest_transfer_account']))
                <li class="list-group-item">
                  <b>Interest transfer account</b> <a class="pull-right"> {{$fd['interest_transfer_account']}}</a>
                </li>
                @endif

              </ul>
               <!-- end primary display section -->
               <hr>
               @endisset


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
                  <b>Address</b> <a class="pull-right"> {{$Applicant['address1']}}, {{$Applicant['address2']}},{{$Applicant['address3']}},{{$Applicant['address4']}}</a>
                </li>

                <hr>

                <li class="list-group-item">
                  <b>Applied date</b> <a class="pull-right"> {{$created_at }}</a>
                </li>

                <li class="list-group-item">
                  <b>Updated date</b> <a class="pull-right"> {{$updated_at}}</a>
                </li>

                <hr>
                <div class="box-header with-border">
                    <h3 class="box-title"> Avaiable accounts</h3>
                  </div>



                  @isset($acc[0])

                    @foreach ($acc as $ac)
                    <li class="list-group-item">

                         @if ($Applicant['ref'] === $ac['app_ref'])
                            <b>Account number</b> <a class="pull-right"> {{ $ac['account_number'] }} </a>
                        @else
                            <b>OA </b> <a class="pull-right"> {{ $ac['account_number'] }} </a>
                        @endif



                    </li>

                    @endforeach
                  @endisset






                <hr>



              </ul>
               <!-- end primary display section -->


               <input type="hidden" value="{{$bdo['code']}}"  id="bdocode"/>
               <input type="hidden" value="{{$bdo['email']}}"  id="bdoemail"/>
               <input type="hidden" value="{{$Applicant['ref']}}"  id="appref"/>

               <input type="hidden" value="{{$Applicant['gps']}}"  id="gps"/>

               <input type="hidden" value="{{ session('user_email') }}"  id="user_name"/>

               <h3 class="box-title">Internal sanction details </h3>
               <ul class="list-group list-group-unbordered" id="blacklist_items">

               </ul>


               @if ($Applicant['approved'] ===1 |  $Applicant['approved'] ==='1' )
               <a onclick="" class="btn btn-primary btn-block"><b>Reviewed & Sanction List Checked</b></a>
               @endif
               @if ($Applicant['ops'] ===1 |  $Applicant['ops'] ==='1' )
               <a onclick="" class="btn btn-primary btn-block"><b>Reviewd by Centralized Ops</b></a>
               @endif
               @if ($Applicant['approved'] ===0 |  $Applicant['approved'] ==='0' )
               <a onclick="review('{{session('user_branch')}}','{{$Applicant['ref']}}','{{session('user_email')}}')" class="btn btn-primary btn-warning btn-block"><b>Review & Sanction List Check</b></a>
               @endif
                    @if ($Applicant['ops'] ===0 |  $Applicant['ops'] ==='0' )
                    <a onclick="review('{{session('user_branch')}}','{{$Applicant['ref']}}','{{session('user_email')}}')" class="btn btn-primary btn-warning btn-block"><b>Review as Ops</b></a>
                    @endif




            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

          <!-- About Me Box -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title"> For  Your Info</h3>
              <div id="map">


              </div>
            </div>
            <!-- /.box-header -->

            <div class="box-body">




              <strong><i class="fa fa-map-marker margin-r-5"></i> Location</strong>



              @if (isset( $Applicant['ops_staff'] ))
                  @if ($Applicant['ops_staff']!=NULL)
                  <hr>
                  <strong><i class="fa fa-map-marker margin-r-5"></i> Cen Ops/ Reviewed Officer </strong>
                  <p class="text-muted">{{$Applicant['ops_staff']}}</p>
                  @endif
              @endif

              @if (isset($Applicant['review_staff']))
                 @if ($Applicant['review_staff']!=NULL)
                 <hr>
                 <strong><i class="fa fa-map-marker margin-r-5"></i> Approved Officer </strong>
                <p class="text-muted">{{ $Applicant['review_staff'] }}</p>

                 @endif
              @endif



              <hr>

              <strong><i class="fa fa-map-marker margin-r-5"></i> BDO</strong>
             <p class="text-muted">{{$bdo['email']}}</p>

              <hr>
              <strong><i class="fa fa-map-marker margin-r-5"></i> Branch</strong>
              <p class="text-muted"> {{$bdo['name']}} </p>

               <hr>

               <strong><i class="fa fa-map-marker margin-r-5"></i> App version</strong>
              <p class="text-muted"> {{$Applicant['appv']}} </p>

               <hr>




               @if ((int)$Applicant['done']===0)
               <a id="approve_button" onclick="cacc('{{session('user_branch')}}','{{$Applicant['ref']}}','{{session('user_email')}}')" class="btn btn-primary btn-block"><b id="approve_text">Approve</b></a>
               <a href="#" class="btn btn-primary btn-warning btn-block"><b>Request to improve</b></a>
               <a onclick="reject('{{session('user_branch')}}','{{$Applicant['ref']}}','{{session('user_email')}}')"  class="btn btn-primary btn-danger  btn-block"><b>Reject</b></a>
               @endif

               @if ((int)$Applicant['done']===1)
               <a onclick="" class="btn btn-primary btn-block"><b>Approved</b></a>
               @endif

               @if ((int)$Applicant['done']===2)
               <a onclick=""  class="btn btn-primary btn-danger  btn-block"><b>Rejected</b></a>
              @endif
              @if ((int)$Applicant['done']===3)
              <a href="#" class="btn btn-primary btn-warning btn-block"><b>Requested to improve</b></a>
             @endif


            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
        <div class="col-md-8">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#activity" data-toggle="tab">Applicant Info</a></li>
              <!--
                <li><a href="#timeline" data-toggle="tab">Timeline</a></li>
                --->
              <li onclick="msg({{$Applicant['ref']}})"><a href="#settings" data-toggle="tab">Message to BDO</a></li>
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

          @php
/*
nic : ""
contact_number : ""
title : "Rev"
full_name : "Uttgu"
dob : "1/2/2018"
age : 2
address : "Yfhghghg"
propostion : 15

*/




          if(isset($Nominee['json'])){

            if( 2 <strlen( $Nominee['json']) ){
              $js = json_decode($Nominee['json'],true);

              for($i=0;$i<count($js); $i++){

                echo '  <div class="info-box bg-red">
                          <span class="info-box-icon"><i class="fa fa-share-alt-square"></i></span>

                          <div class="info-box-content">
                            <span class="info-box-text">Name : '.$js[$i]['title'].'. '.$js[$i]['full_name'].'</span>
                            <span class="info-box-text"> Address : '.$js[$i]['address'].'</span>
                            <span class="info-box-text"> DOB : '.$js[$i]['dob'].'</span>
                             <span class="info-box-text"> NIC : '.$js[$i]['nic'].'</span>
                            <span class="info-box-text"> Contact No : '.$js[$i]['contact_number'].'</span>
                            <span class="info-box-text"> Address : '.$js[$i]['address'].'</span>

                            <div class="progress">
                              <div class="progress-bar" style="width: '.$js[$i]['propostion'].'%"></div>
                            </div>
                                <span class="progress-description">
                                  '.$js[$i]['propostion'].'% of Propostion
                                </span>
                          </div>

                         </div>';


                }
            }
          }



          @endphp

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

                    @if($WorkPlace['sector']!==NULL)
                    <li class="list-group-item">
                      <b>Sector :</b> <a class="pull-right">{{$WorkPlace['sector']}}</a>
                    </li>
                    @endif

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
                      @if($WorkPlace['source_other_income']!=="")
                      <li class="list-group-item">
                        <b>Source of other income :</b> <a class="pull-right">{{$WorkPlace['source_other_income']}}</a>
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


            @php
            //$js =     $KYC['json'];
         if(isset($KYC['json'])){
            $js = json_decode($KYC['json'],true);

            if(isset($js['pupose'])){
                $purpose =  $js['pupose'];
                $purpose = json_decode($purpose,true);
                echo  '<div class="box-header with-border">
                    <h4 class="box-title"> Purpose </h4>
                  </div>';
                echo '  <ul style="list-style-type:disc;  margin: 0;  margin: 0;" class="list-group list-group-unbordered">';
                for($i=0;$i<count($purpose) ; $i++){
               //     echo $purpose[$i] ."<br>";
                    echo ' <li >
                      <b> </b> <a class="pull-right">'.$purpose[$i].'</a>
                    </li>';
                }
                echo '</ul>';

            }
            if(isset($js['source_funds'])){
                $source_of_funds =  $js['source_funds'];
               // echo $source_of_funds ."<br>";
               $source_of_funds = json_decode($source_of_funds,true);
                echo  '<div class="box-header with-border">
                    <h4 class="box-title"> Source of Funds </h4>
                  </div>';
                echo '  <ul style="list-style-type:disc;  margin: 0;  margin: 0;" class="list-group list-group-unbordered">';
                for($i=0;$i<count($source_of_funds) ; $i++){
               //     echo $purpose[$i] ."<br>";
                    echo ' <li>
                      <b> </b> <a class="pull-right">'.$source_of_funds[$i].'</a>
                    </li>';
                }
                echo '</ul>';

            }
            if(isset($js['source_wealth'])){
                $source_wealth = $js['source_wealth'];
              //  echo $source_wealth ."<br>";
              $source_wealth = json_decode($source_wealth,true);
                echo  '<div class="box-header with-border">
                    <h4 class="box-title"> Source of Wealth </h4>
                  </div>';
                echo '  <ul style="list-style-type:disc;  margin: 0;  margin: 0;" class="list-group list-group-unbordered">';
                for($i=0;$i<count($source_wealth) ; $i++){
               //     echo $purpose[$i] ."<br>";
                    echo ' <li >
                      <b> </b> <a class="pull-right">'.$source_wealth[$i].'</a>
                    </li>';
                }
                echo '</ul>';


            }
            if(isset($js['anticipated_volume'])){
                $anticipated_volume =  $js['anticipated_volume'];
               // echo $anticipated_volume ."<br>";

               $anticipated_volume = json_decode($anticipated_volume,true);
                echo  '<div class="box-header with-border">
                    <h4 class="box-title"> Anticipated Volums </h4>
                  </div>';
                echo '  <ul style="list-style-type:disc;  margin: 0;  margin: 0;" class="list-group list-group-unbordered">';
                for($i=0;$i<count($anticipated_volume) ; $i++){
               //     echo $purpose[$i] ."<br>";
                    echo ' <li>
                      <b> </b> <a class="pull-right">'.$anticipated_volume[$i].'</a>
                    </li>';
                }
                echo '</ul>';

            }
            if(isset($js['pep'])){
                $pep = $js['pep'];
               // echo $pep ."<br>";
            }if(isset($js['pep_relationsip'])){
                $pep_relationsip = $js['pep_relationsip'];
              //  echo $pep_relationsip ."<br>";
            }
         }

            @endphp



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



  <div class="comlist form-group margin-bottom-none">

  </div>




                    <div class="form-group margin-bottom-none">
                      <div class="col-sm-9">
                        <input class="form-control input-sm" id="comment_input" placeholder="Response to this application">
                      </div>
                      <div class="col-sm-3">
                        <!--   <a  onclick="comment()" class="btn btn-danger  btn-sm">Comment</a>     --->
                        <a onclick="comment_fd()" class="btn btn-primary btn-block"><b>Comment</b></a>
                      </div>
                    </div>

                </div>
                <!-- /.post -->

            @if(isset($nicf['file_path']) | isset($nicr['file_path']))


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



                        @isset($nicf['file_path'])
                        <div class="col-sm-6 img-frame">
                            <a href="#">NIC Front Side</a>
                        <img   class="img-responsive_custom" src="{{env('SAMBA')}}/sdbl/public/{{$nicf['file_path']}}" alt="Photo">
                        </div>
                        @endisset

                        @isset($nicr['file_path'])
                        <div class="col-sm-6 img-frame">
                            <a href="#">NIC Back Side</a>
                            <img  class="img-responsive_custom" src="{{env('SAMBA')}}/sdbl/public/{{$nicr['file_path']}}" alt="Photo">
                        </div>
                        @endisset





                        <!-- /.col -->
                    </div>
                  <!-- /.row -->




                     <!-- /.user-block -->
                     <div class="row margin-bottom">

                        @isset($proof['file_path'])
                        <div class="col-sm-6 ">
                            <a href="#">Proof Document 1</a>
                          <img class="img-responsive_custom" src="{{env('SAMBA')}}/sdbl/public/{{$proof['file_path']}}" alt="Photo">
                        </div>
                        @endisset
                        @isset($proofr['file_path'])
                        <div class="col-sm-6 ">
                            <a href="#">Proof Document 2</a>
                          <img class="img-responsive_custom" src="{{env('SAMBA')}}/sdbl/public/{{$proofr['file_path']}}" alt="Photo">
                        </div>
                        @endisset

                     </div>
                        <div class="row margin-bottom">
                        <!-- /.col -->




                             @isset($selfie['file_path'])
                             <div class="col-sm-6 img-frame">
                             <a href="#">Other Documents </a>
                              <img class="img-responsive_custom" src="{{env('SAMBA')}}/sdbl/public/{{$selfie['file_path']}}" alt="Photo">
                            </div>
                              @endisset

                              @isset($selfie2['file_path'])
                              <div class="col-sm-6 img-frame">
                              <a href="#">Other Documents 02 </a>
                               <img class="img-responsive_custom" src="{{env('SAMBA')}}/sdbl/public/{{$selfie2['file_path']}}" alt="Photo">
                             </div>
                               @endisset



                              @isset($signature['signature'])
                              <div class="col-sm-6 img-frame2">
                                  <p class="descp" > මෙම ගිණුම විවෘත කිරීමේ විද්‍යුත් අයදුම් පත්‍රය හා ක්‍රියාත්මක කිරීමට අදාළ වන නියමයන් සහ කොන්දේසි මාගේ  /අපගේ සුපුරුදු භාෂාවෙන් මා/අප වෙත පැහැදිලි කරන ලද බව මම / අපි මෙහි සනාථ කරමි /කරමු.මෙම ගිණුම් විවෘත කිරීමේ විද්‍යුත් අයදුම්පතේ දක්වා ඇති සියලුම තොරතුරු සත්‍ය සහ නිවැරදි බව මම / අපි මෙයින් සහතික කරන අතර, ලබා දී ඇති තොරතුරුවල කිසියම් වෙනසක් / වෙනස්කමක් සිදුවුවහොත් වහාම බැංකුව දැනුවත් කිරීමට කටයුතු  කරමි/කරමු.</p>
                                  <p class="descp">இந்த கணக்கைத் திறப்பதற்கான விண்ணப்பத்திற்கும் அதன் செயல்பாட்டிற்கும் மற்றும் இலத்திரனியல் கணக்கு திறப்பு விண்ணப்ப படிவத்திற்குபொருந்தக்கூடிய விதிமுறைகள் மற்றும் நிபந்தனைகள் எனக்கு / எங்களுக்கு வழக்கமான மொழியில் எனக்கு / எங்களுக்கு விளக்கப்பட்டன மற்றும் எனக்கு / எங்களால் புரிந்து கொள்ளப்பட்டதை  நான் / நாங்கள் இதன்மூலம் உறுதிப்படுத்துகிறோம்.
                                    இந்த இலத்திரனியல் கணக்கு திறப்பு பயன்பாட்டில் வழங்கப்பட்ட அனைத்து தகவல்களும் உண்மை மற்றும் சரியானவை என்பதை நான் / நாங்கள் இதன்மூலம் உறுதிப்படுத்துகிறோம், மேலும் வழங்கப்பட்ட தகவலில் ஏதேனும் மாற்றம் / மாற்றங்கள் ஏற்பட்டால் உடனடியாக வங்கிக்கு அறிவிப்பதற்கு நடவடிக்கை மேற்கொள்வேன் /மேற்றக்கொள்வோம்.</p>
                                  <p class="descp"> I/we hereby confirm that the terms and conditions applicable to opening and operations of this account and electronic account opening application form were explained to me/us in the language conversant by me /us and understood by me/us.I / we hereby affirm that all the information provided in this electronic account opening application form are true and correct and further undertake to intimate the bank promptly in case of any change /s in any of such information provided.</p>
                              <a href="#">Applicant's Signature  </a>
                              <img class="img-responsive_custom2" src="{{$signature['signature']}}" alt="Photo">
                            </div>
                            @endisset




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

                  <div class="form-group">


                    <div  class="form-group message_list">

                  </div>

                  <div class="form-group">
                    <label for="inputExperience" class="col-sm-2 control-label">Message</label>

                    <div class="col-sm-10">
                      <textarea class="form-control" id="message_input" placeholder="I need to tell ..."></textarea>
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <!--
                            from,to,ref,msg,nic
                            --->

                            <a onclick="send_msg('{{session('user_email')}}','{{$bdo['email']}}','{{$Applicant['ref']}}','{{$Applicant['nic']}}')" class="btn btn-primary btn-block"><b>Send</b></a>
                    </div>
                  </div>

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

<!-- confirm alerts  -->
<link rel="stylesheet" href="public/jqalerts/jquery-confirm.min.css">
<!--confirm alerts  -->
<script src="public/jqalerts/jquery-confirm.min.js"></script>

<script>


</script>
</body>
</html>

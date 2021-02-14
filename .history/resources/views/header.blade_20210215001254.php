<header class="main-header">

    <script>

        function change_pass(pass,email){
          //  alert("pass");
            $.ajax({
                method: "POST",
                url: "api/reset_my_password",
                data: {email:email, password:pass}
                })
                .done(function( msg ) {
                    //alert( "Data Saved: " + msg );
                    $.alert(''+msg);
                });

        }
        function password_chg(email){


            $.confirm({
                        title: 'Change my password',
                        content: '' +
                        '<form action="" class="formName">' +
                        '<div class="form-group">' +
                        '<label>Enter new password here</label>' +
                        '<input type="text" placeholder="New password" class="pass form-control" required />' +
                        '</div>' +
                        '<div class="form-group">' +
                        '<label>Repeat new password here</label>' +
                        '<input type="text" placeholder="New password" class="pass2 form-control" required />' +
                        '</div>' +
                        '</form>',
                        buttons: {
                            formSubmit: {
                                text: 'Submit',
                                btnClass: 'btn-blue',
                                action: function () {
                                    var pass = this.$content.find('.pass').val();
                                    var pass2 = this.$content.find('.pass2').val();
                                    if(!pass){
                                        $.alert('provide a valid password');
                                        return false;
                                    }
                                    if(!pass2){
                                        $.alert('Repeat the password');
                                        return false;
                                    }

                                    if(pass===pass2){
                                        change_pass(pass,email);
                                        return true;
                                    }else{
                                        $.alert('Repeated password is mitmating');
                                        return false;
                                    }
                                  //  $.alert('Your name is ' + name);
                                }
                            },
                            cancel: function () {
                                //close
                            },
                        },
                        onContentReady: function () {
                            // bind to events
                            var jc = this;
                            this.$content.find('form').on('submit', function (e) {
                                // if the user submits the form by pressing enter in the field.
                                e.preventDefault();
                                jc.$$formSubmit.trigger('click'); // reference the button and click it
                            });
                        }
                    });


        }
    </script>
    <!-- Logo -->
    <a href="public/index2.html" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>SDB</b>TB</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>SDB</b>Tab Banking</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">




          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="public/dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
              <span class="hidden-xs"> {{session('user_name')}} </span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="public/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">

                <p>
                    {{session('user_mobile')}}
                  <small>{{session('branch_name')}}</small>
                </p>
              </li>

              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a onclick="password_chg('{{session('user_email')}}')" class="btn btn-default btn-flat">Change my password</a>
                </div>
                <div class="pull-right">
                  <a href="logout" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li>
        </ul>
      </div>
    </nav>
  </header>

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
                    <input type="number" class="form-control" id="editMyMobile" placeholder="Enter mobile">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Email address</label>
                    <input type="email" class="form-control" id="editMyEmail" placeholder="Enter email">
                </div>
                <div class="form-group">
                <label for="exampleInputEmail1">Name</label>
                <input type="text" class="form-control" id="editMyName" placeholder="Enter name">
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">New Password</label>
                    <input type="text" class="form-control" id="editMyName" placeholder="Enter name">
                    </div>


                <!-- select -->
                <div class="form-group id_100">
                    <label>Role</label>
                    <select disabled id="editrole" class="form-control">
                    <option value="bdo">BDO</option>
                    <option value="manager"> Manager (Approval Officer)</option>
                    <option value="na"> Remove roll</option>
                    </select>
                </div>

                <!-- select -->
                <div class="form-group id_101">
                    <label>Branch</label>
                    <select disabled id="editbranch" class="form-control">
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
            <button type="button" onclick="delete_team_member_details()" class="btn btn-block btn-danger">Delete user</button>
            @endif

          <button type="button" onclick="update_team_member_details()" class="btn btn-block btn-warning">Save changes</button>
          <button type="button" class="btn btn-block btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>



<footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>CVC</b> 2.4.0
    </div>
    <strong>Copyright &copy; 2020 <a href="https://www.sdb.lk">SDB Bank PLC</a>.</strong> All rights
    reserved.
  </footer>

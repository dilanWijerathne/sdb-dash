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

<?php
include "../inc/header.php";
echo
'
<script type="text/javascript">
var elem = document.getElementById("settingsMenu");
elem.className +=" active";
</script>
';
if($_SESSION['correctInfo'] == false)
{
  include "../inc/unauthenticated.php";
  exit();
}
?>
<!--- search --->

<div class="container-fluid">
  <div class="row">
    <div class="col"></div>
    <div class="col-lg-6 col-md-8 col-sm-12">
      <form style="margin-top: 10%;" method="post" id="accessPointForm" autocomplete="off">

        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1">SSID:</span>
          </div>
          <input type="text" class="form-control" placeholder="Please Enter the SSID for Your Access Point." aria-label="Username" aria-describedby="basic-addon1" id="SSIDField" name="ssid">
        </div>

        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1">Password:</span>
          </div>
          <input type="password" class="form-control" placeholder="Please Enter a Strong Password." aria-label="Password" aria-describedby="basic-addon1" id="APPasswordField" name="password">
        </div>

        <button type="button" class="btn btn-block btn-primary" name="submitBtn" style="margin-top:10px;" id="submit" onclick="saveBtnClicked()">Save</button>
        <hr>
      </form>

      <div class="card" >
      <div class="card-header" id="headingOne" style="padding:0px">
        <button class="btn btn-block btn-dark" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne" style="border-radius:0px">
          Change Username and/or Password
        </button>
      </div>
      <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
      <div class="card-body">
      <form method="post" id="loginCredentials" action="../inc/changeUsernameAndPassword.php" autocomplete="off">

        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1">Username:</span>
          </div>
          <input type="text" class="form-control" placeholder="Please Enter a Username." aria-label="Username" aria-describedby="basic-addon1" id="usernameField" name="usernameField">
        </div>

        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1">Password:</span>
          </div>
          <input type="password" class="form-control" placeholder="Please Enter a Strong Password." aria-label="Password" aria-describedby="basic-addon1" id="passwordField" name="passwordField">
        </div>

        <button type="button" class="btn btn-block btn-primary" style="margin-top:10px;" onclick="submitCredentialsForm()">Save</button>
      </form>
    </div>
  </div>
    </div>
    <hr>

      <button type="button" class="btn btn-block btn-danger" style="margin-top:10px;" data-toggle="modal" data-target="#confirmationDialog">Reboot</button>

      <div class="modal fade" id="confirmationDialog" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document" id="modalDialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="rebootDialogTitle">Reboot?</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body" id="rebootDialogBody" style="justify-content: center;align-items: center;display: flex;">
              Are you sure you want to reboot the device?
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal" id="closeBtn">Close</button>
              <button class="btn btn-danger" onclick="rebootBtnClicked()" id="rebootBtn">Reboot</button>
            </div>
          </div>
        </div>
      </div>

      <div class="modal fade" id="userFeedback" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content" style="justify-content: center;align-items: center;display: flex;">
            <div class="modal-header" id="userFeedback_header">
              <h5>Updating Your Access Point Configurations</h5>
            </div>
            <div class="modal-body" id="userFeedback_body">
              <span class="fas fa-cog fa-spin fa-10x"></span>
            </div>
          </div>
        </div>
      </div>

    </div>
    <div class="col"></div>
  </div>
</div>

</body>


</html>

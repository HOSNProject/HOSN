<?php
include "../inc/header.php";
echo
'
<script type="text/javascript">
var elem = document.getElementById("AddRulesMenu");
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
<div class="container-fluid" >
  <div class="row">
    <div class="col" ></div>
    <div class="col-lg-6 col-md-8 col-sm-12">
      <form class="" style="margin-top:10%" method="post" action="../inc/basicRuleAssembler.php" id="simpleRuleForm" autocomplete="off">
        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <lable class="input-group-text form-control" id="inputGroupSelect01">Rule Action:</lable>
          </div>
          <select name="ruleAction" class="custom-select" for="inputGroupSelect01">
            <option value="alert">alert</option>
            <option value="log">log</option>
            <option value="pass">pass</option>
            <option value="activate">activate</option>
            <option value="dynamic">dynamic</option>
            <option value="drop">drop</option>
            <option value="reject">reject</option>
            <option value="sdrop">sdrop</option>
          </select>
        </div>

        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <div class="input-group-text">
              <input type="radio" id="TCPRadio" name="TCP_UDP" value="tcp" checked>
              <label class="mb-0" for="TCPRadio">TCP</label>
            </div>
          </div>
          <div class="input-group-append">
            <div class="input-group-text" >
              <input type="radio" id="UDPRadio" name="TCP_UDP" value="udp">
              <label class="mb-0" for="UDPRadio">UDP</label>
            </div>
          </div>
        </div>

        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <lable class="input-group-text form-control">Message : </lable>
          </div>
          <input type="text" name="msgValue" placeholder="Please Enter Your Mesasage Here." class="input-group-text form-control bg-light text-left">
        </div>
        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <lable class="input-group-text form-control" style="padding-right:42px;">Source IP and Port : </lable>
          </div>
          <input type="text" name="srcIP" placeholder="Please Enter an IPv4 Address." class="input-group-text form-control bg-light IP">
          <div class="append">
            <label class="input-group-text " style="border-radius:0px; padding-left:2px;padding-right:2px"><b>:</b></label>
          </div>
          <input type="text" name="srcPort" placeholder="0-65535" class="input-group-text form-control bg-light">
        </div>
        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <lable class="input-group-text form-control">Destination IP and Port : </lable>
          </div>
          <input type="text" name="desIP" placeholder="Please Enter an IPv4 Address." class="input-group-text form-control bg-light IP">
          <div class="append">
            <label class="input-group-text " style="border-radius:0px; padding-left:2px;padding-right:2px"><b>:</b></label>
          </div>
          <input type="text" name="desPort"class="input-group-text form-control bg-light" placeholder="0-65535">
        </div>
        <div id="options">

        </div>
        <button class="btn btn-link" type="button" name="button" onclick="addNewOptionModule()" style="padding:0px" id="addOptionBtn"><span class="fa-2x far fa-plus-square"></span></button>
        <button type="button" class="btn btn-block btn-success" style="margin-top:10px;" onclick="submitSimpleRuleForm()">Add Rule</button>
      </form>
      <hr></hr>
      <button class="btn btn-primary btn-block" type="button" data-toggle="collapse" data-target="#advanceRuleSection" aria-expanded="false" aria-controls="collapseExample">Advance Rules</button>
      <br>
      <div class="collapse" id="advanceRuleSection">
        <form class="form-control" id="advanceRulesForm" method="post" style="margin-bottom:0px">
          <textarea class="form-control" name="advanceRulesField" rows="8" cols="80"></textarea>
          <button class="btn btn-success btn-block" type="button" onclick="submitAdvanceRules()" style="margin-top:10px">Add Rule(s)</button>
        </form>
      </div>


      <div class="modal fade" id="ruleAddingDialog" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content" style="justify-content: center;align-items: center;display: flex;">
            <div class="modal-header" id="ruleAddingDialog_header">
              <h3>Validating And Adding Your Rule.</h3>
            </div>
            <div class="modal-body" id="ruleAddingDialog_body">
              <span class="fas fa-cog fa-spin fa-10x"></span>
            </div>
            <div class="modal-footer" id="ruleAddingDialog_footer">
              <h5>Please Wait</h5>
            </div>
          </div>
        </div>
      </div>

    </div>
    <div class="col" >

    </div>
  </div>
</div>



</body>


</html>

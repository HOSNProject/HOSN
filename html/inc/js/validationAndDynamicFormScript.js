//////////////////////////////////////////////////////////////////////////////////////////////////
//                           "Add Rules" PAGE JS FUNCTIONS AND CODE                             //
//////////////////////////////////////////////////////////////////////////////////////////////////

//<editor-fold> "Add Rules" PAGE REGION

var optionsCount = 0;
// Delete option module when the user click on the delete button.
$(document).on("click",".optionModule", function () {
  $(this).parent().parent().remove();
  optionsCount--;
  disable_EnableOptions();
  $('#addOptionBtn').css('display','inline-block');
});
//Listen for any changes to the option modules.
$(document).on("change", ".selectOption", function() {
	if($(this).attr('id') == 'classificationSelect' || $(this).attr('id') =='fragbitsValue1' || $(this).attr('id') =='flowValue' || $(this).attr('id') =='fragbitsValue2' || $(this).attr('id') =='ipoptsValue')
  		return;
  else if ($(this).attr('id') =='flagsModifiers')
      return;
	dynamicllyChangeValueField();
	setupValidation();
});
//Add new option module.
function addNewOptionModule()
{
  optionsCount++;
  var module = `
  <div class="input-group mb-3" id="optionModule`+optionsCount+`">
  <div class="input-group-prepend optionsPrepend">
  <button type="button" class="btn bt-danger bg-danger optionModule"><span class="far fa-minus-square" style="color:white"></span></button>
  </div>
  <div class="input-group-append optionsPrepend">
  <select id="optionName`+optionsCount+`" class="custom-select selectOption ignore" style="border-radius:0px">
  <option value="classtype" selected>classtype</option>
  <option value="priority">priority</option>
  <option value="flags">Flags</option>
  <option value="seq">seq</option>
  <option value="itype">itype</option>
  <option value="icode">icode</option>
  <option value="ack">ack</option>
  <option value="fragbits">fragbits</option>
  <option value="flow">flow</option>
  <option value="content">content</option>
  <option value="ipopts">ipopts</option>
  <option value="id">id</option>
  </select>
  </div>
  <input type="text" name="optionName`+optionsCount+`" class="input-group-text form-control bg-light">
  </div>
  `;
  $('#options').append(module);

  $('#options').children().children('div:has(select)').children().not('#optionName'+optionsCount).each(function(y)
  {
    var select = $(this);
    $(`#optionModule`+optionsCount).children('div:has(select)').children().children().each(function(x)
    {
        if($(this).val() == select.val())
          $(this).remove();
    });
  });
  if($(`#optionModule`+optionsCount+` select`).children().length-1 == 0)
  {
    $('#addOptionBtn').css('display','none');
  }
  disable_EnableOptions();

  dynamicllyChangeValueField();
  setupValidation();
}
//Disable all the option modules except the last one.
function disable_EnableOptions()
{
  $('#options').children().children('div:has(select)').children().each(function (index) {
    if(($('#options').children().children('div:has(select)').children().length-1) != index)
    {
      $(this).attr('disabled',true);
    }
    else {
      $(this).attr('disabled',false);
    }
  });
}
//This function is responsable of no option repetition and displaying the correct value formate for each option.
function dynamicllyChangeValueField()
{
	$('#options').children().each(function(){
		var optionName = $(this).children('div:has(select)').children().val();
		$(this).children().not('.optionsPrepend').remove();
		if(optionName == 'flags')
		  {
		    var flagsSelectList =
		    `
		    <div class="input-group-append">
		    <div class="input-group-text">
		    <input type="checkbox" class="" id="SYNCheckBox" name="SYN">
		    <label class="mb-0" for="SYNCheckBox">SYN</label>
		    </div>
		    </div>
		    <div class="input-group-append">
		    <div class="input-group-text" >
		    <input type="checkbox" class="" id="ACKCheckBox" name="ACK">
		    <label class="mb-0" for="ACKCheckBox">ACK</label>
		    </div>
		    </div>

		    <div class="input-group-append">
		    <div class="input-group-text">
		    <input type="checkbox" class="" id="FINCheckBox" name="FIN">
		    <label class="mb-0" for="FINCheckBox">FIN</label>
		    </div>
		    </div>
		    <div class="input-group-append">
		    <div class="input-group-text" >
		    <input type="checkbox" class="" id="URGCheckBox" name="URG">
		    <label class="mb-0" for="URG">URG</label>
		    </div>
		    </div>

		    <div class="input-group-append">
		    <div class="input-group-text">
		    <input type="checkbox" class="" id="PSHCheckBox" name="PSH">
		    <label class="mb-0" for="PSHCheckBox">PSH</label>
		    </div>
		    </div>
		    <div class="input-group-append">
		    <div class="input-group-text" >
		    <input type="checkbox" class="" id="RSTCheckBox" name="RST">
		    <label class="mb-0" for="RSTCheckBox">RST</label>
		    </div>
		    </div>

        <select name="flagsModifiers" class="custom-select selectOption ignore" style="border-radius-top-right:0px" id="flagsModifiers">
		    <option value="0">-No Modifiers-</option>
		    <option value="+">Match On The Specified Bits, Plus Any Others</option>
		    <option value="*">Match If Any Of The Specified Bits Are Set</option>
		    <option value="!">Match If The Specified Bits Are Not Set</option>
		    </select>
		    `;
		    $(this).append(flagsSelectList);
		  }
		  else if (optionName == 'classtype')
		  {
		    var classificationSelect = `
		    <select name="classificationValue" class="custom-select selectOption" style="border-radius:0px" id="classificationSelect">
		    <option value="attempted-admin">Attempted Administrator Privilege Gain</option>
		    <option value="attempted-user">Attempted User Privilege Gain</option>
		    <option value="inappropriate-content">Inappropriate Content was Detected</option>
		    <option value="policy-violation">Potential Corporate Privacy Violation</option>
		    <option value="shellcode-detect">Executable code was detected</option>
		    <option value="successful-admin">Successful Administrator Privilege Gain</option>
		    <option value="successful-user">Successful User Privilege Gain</option>
		    <option value="trojan-activity">A Network Trojan was detected</option>
		    <option value="unsuccessful-user">Unsuccessful User Privilege Gain</option>
		    <option value="web-application-attack">Web Application Attack</option>
		    <option value="attempted-dos">Attempted Denial of Service</option>
		    <option value="attempted-recon">Attempted Information Leak</option>
		    <option value="bad-unknown">Potentially Bad Traffic</option>
		    <option value="default-login-attempt">Attempt to login by a default username and password</option>
		    <option value="denial-of-service">Detection of a Denial of Service Attack</option>
		    <option value="misc-attack">Misc Attack</option>
		    <option value="non-standard-protocol">Detection of a non-standard protocol or event</option>
		    <option value="rpc-portmap-decode">Decode of an RPC Query</option>
		    <option value="successful-dos">Denial of Service</option>
		    <option value="successful-recon-largescale">Large Scale Information Leak</option>
		    <option value="successful-recon-limited">Information Leak</option>
		    <option value="suspicious-filename-detect">A suspicious filename was detected</option>
		    <option value="suspicious-login">An attempted login using a suspicious username was detected</option>
		    <option value="system-call-detect">A system call was detected</option>
		    <option value="unusual-client-port-connection">A client was using an unusual port</option>
		    <option value="web-application-activity">Access to a potentially vulnerable web application</option>
		    <option value="icmp-event">Generic ICMP event</option>
		    <option value="misc-activity">Misc activity</option>
		    <option value="network-scan">Detection of a Network Scan</option>
		    <option value="not-suspicious">Not Suspicious Traffic</option>
		    <option value="protocol-command-decode">Generic Protocol Command Decode</option>
		    <option value="string-detect">A suspicious string was detected</option>
		    <option value="unknown">Unknown Traffic</option>
		    <option value="tcp-connection">A TCP connection was detected</option>
		    </select>
		    `;
		    $(this).append(classificationSelect);
		  }
		else if(optionName == "priority")
		    {
		      $(this).append(`<input type="text" name="priorityField" value="" class="input-group-text form-control bg-light number" placeholder="Numbers Only">`);
		    }
		    else if(optionName == "seq")
		    {
		      $(this).append(`<input type="text" name="seqField" value="" class="input-group-text form-control bg-light number" placeholder="Numbers Only">`);
		    }
		    else if(optionName == "ack")
		    {
		      $(this).append(`<input type="text" name="ackField" value="" class="input-group-text form-control bg-light number" placeholder="Numbers Only">`);
		    }
		    else if(optionName == "itype")
		    {
		      $(this).append(`<input type="text" name="itypeField" value="" class="input-group-text form-control bg-light number" placeholder="Numbers Only">`);
		    }
		    else if(optionName == "icode")
		    {
		      $(this).append(`<input type="text" name="icodeField" value="" class="input-group-text form-control bg-light number" placeholder="Numbers Only">`);
		    }
		    else if(optionName == 'id')
		    {
		      $(this).append(`<input type="text" name="idField" value="" class="input-group-text form-control bg-light number" placeholder="Numbers Only">`);
		    }
		else if(optionName == "fragbits")
		  {
		    var fragbitsSelect = `
		    <select name="fragbitsValue1" class="custom-select selectOption ignore" style="border-radius:0px" id="fragbitsValue1">
		    <option value="M">More Fragments</option>
		    <option value="D">Don't Fragment </option>
		    <option value="R">Reserved Bit </option>
		    </select>
		    <select name="fragbitsValue2" class="custom-select selectOption ignore" style="border-radius-top-right:0px" id="fragbitsValue2">
		    <option value="">-No Modifiers-</option>
		    <option value="+">Match On The Specified Bits, Plus Any Others</option>
		    <option value="*">Match If Any Of The Specified Bits Are Set</option>
		    <option value="!">Match If The Specified Bits Are Not Set</option>
		    </select>
		    `;
		    $(this).append(fragbitsSelect);
		  }
		  else if(optionName == "flow")
		  {
		    var flowSelect = `
		    <select name="flowValue" class="custom-select selectOption ignore" style="border-radius:0px" id="flowValue">
		    <option value="to_client">Trigger On Server Responses From A To B</option>
		    <option value="to_server">Trigger On Client Requests From A To B</option>
		    <option value="from_client">Trigger On Client Requests From A To B</option>
		    <option value="from_server">Trigger On Server Responses From A To B</option>
		    <option value="established">Trigger Only On Established TCP Connections</option>
		    <option value="not_established">Trigger Only When No TCP Connection Is Established</option>
		    <option value="stateless">Trigger Regardless Of The State Of The Stream Processor</option>
		    <option value="no_stream">Do Not Trigger On Rebuilt Stream Packets</option>
		    <option value="only_stream">Only Trigger On Rebuilt Stream Packets</option>
		    <option value="no_frag">Do Not Trigger On Rebuilt Frag Packets</option>
		    <option value="only_frag">Only Trigger On Rebuilt Frag Packets</option>
		    </select>
		    `;
		    $(this).append(flowSelect);
		  }
		  else if(optionName == "ipopts")
		  {
		    var ipoptsSelect = `
		    <select name="ipoptsValue" class="custom-select selectOption ignore" style="border-radius:0px" id="ipoptsValue">
		    <option value="rr">Record Route</option>
		    <option value="eol">End Of List</option>
		    <option value="nop">No Op</option>
		    <option value="ts">Time Stamp</option>
		    <option value="sec">IP Security</option>
		    <option value="esec">IP Extended Security</option>
		    <option value="lsrr">Loose Source Routing</option>
		    <option value="lsrre">Loose Source Routing</option>
		    <option value="ssrr">Strict Source Routing</option>
		    <option value="satid">Stream Identifier</option>
		    <option value="any">Any IP Options Are Set</option>
		    </select>
		    `;
		    $(this).append(ipoptsSelect);
		  }
		  else if(optionName == "content")
		  {
		    $(this).append(`<input type="text" name="contentField" value="" class="input-group-text form-control bg-light" placeholder="Content To Search For In the Packets">`);
		  }
	});
}

//Declare some validation methods and start the validation process by calling "setupValidation()".
$().ready(function()
{
  $.validator.addMethod( "ipv4", function( value, element ) {
    return this.optional( element ) || /(^(25[0-5]|2[0-4]\d|[01]?\d\d?)\.(25[0-5]|2[0-4]\d|[01]?\d\d?)\.(25[0-5]|2[0-4]\d|[01]?\d\d?)\.(25[0-5]|2[0-4]\d|[01]?\d\d?)$)|^any$/i.test( value );
  }, "Please enter a valid IP v4 address." );

  $.validator.addMethod( "integer", function( value, element ) {
    return this.optional( element ) || /^-?\d+$/.test( value );
  }, "A positive or negative non-decimal number please" );

  $.validator.addMethod( "portNumber", function( value, element ) {
    return this.optional( element ) || /(^([0-9]{1,5}$))|^(any)$/.test(value);
    //(^([1-9]{1,5})|
  }, "Port number or 'any'" );

  $.validator.addMethod( "snortRule", function( value, element ) {
    return this.optional( element ) || /^(alert|log|pass|activate|dynamic|drop|sdrop) (tcp|udp|ip) ([\w\.-\/])+ ([\w\.-\/])+ (->|<>) ([\w\.-\/])+ ([\w\.-\/])+([\w\d\s!@#\$%^&*()])+$/.test( value );
  }, "Not snort Rule" );
  setupValidation();
});
//initialize the validation processes for the two form in "add Rules" page.
function setupValidation()
{
  $('#simpleRuleForm').validate({
    errorPlacement:function(error,element){
      //element.parent().after(error);
    },
    errorClass:"is-invalid",
    validClass:"is-valid",
    ignore: ".ignore",
    errorElement:"div",
    rules:{
      msgValue:{
        required:true
      },
      srcIP:{
        required:true,
        ipv4:true
      },
      srcPort:{
        required:true,
        portNumber:true
      },
      desIP:{
        required:true,
        ipv4:true
      },
      desPort:{
        required:true,
        portNumber:true
      },
      priorityField:{
        required:true,
        integer:true
      },
      seqField:{
        required:true,
        integer:true
      },
      ackField:{
        required:true,
        integer:true
      },
      itypeField:{
        required:true,
        integer:true
      },
      icodeField:{
        required:true,
        integer:true
      },
      contentField:{
        required:true
      },
      idField:{
        required:true
      }
    }
  });
  $('#advanceRulesForm').validate({
    errorPlacement:function(error,element){
      //element.parent().after(error);
    },
    errorClass:"is-invalid",
    validClass:"is-valid",
    errorElement:"div",
    rules:{
      advanceRulesField:{
        required:true,
      }
    }
  });
}
//Send the content of the #simpleRuleForm to the server to assemble the rule, validate it
//then waits for the response and give the user a UI feedback.
function submitSimpleRuleForm()
{
  if($('#simpleRuleForm').valid())
  {
    $('#ruleAddingDialog').modal('show');

    var response = $.ajax({
      type:'POST',
      url:'../inc/basicRuleAssembler.php',
      data:$('#simpleRuleForm').serializeArray(),
      dataType: 'json',
      async: false,
    });
    console.log(response.responseText);
    if(response.responseText == 'Yes')
    {
      setTimeout(function(){
        var old = $('#ruleAddingDialog').html();
        $('#ruleAddingDialog_header').html('<h3>Your Rule Has Been Added</h3>');
        $('#ruleAddingDialog_body').html('<span class="fas fa-check fa-10x text-success"></span>');
        $('#ruleAddingDialog_footer').html('<h5 class="text-success">Successful<h5>');
        setTimeout(function(){
          $('#ruleAddingDialog').modal('hide');
          setTimeout(function(){
            $('#ruleAddingDialog').html(old);
          }, 1000);
        }, 1000);
      }, 1000);
    }
    else if(response.responseText == 'No')
    {
      setTimeout(function(){
        var old = $('#ruleAddingDialog').html();
        $('#ruleAddingDialog_header').html('<h3>Your Rule Failed To Validate (Sorry)</h3>');
        $('#ruleAddingDialog_body').html('<span class="fas fa-times-circle fa-10x text-danger"></span>');
        $('#ruleAddingDialog_footer').html('<h5 class="text-danger">ERROR MESSAGE: '+response.responseText+'<h5>');
        setTimeout(function(){
          $('#ruleAddingDialog').modal('hide');
          setTimeout(function(){
            $('#ruleAddingDialog').html(old);
          }, 1000);
        }, 3500);
      }, 1000);
    }
  }
}
//Send the content of the #advanceRulesForm to the server to validate the rule
//then waits for the response and give the user a UI feedback.
function submitAdvanceRules()
{
  if($('#advanceRulesForm').valid())
  {
    $('#ruleAddingDialog').modal('show');
    var response = $.ajax({
      type:'POST',
      url:'../inc/advanceRulesValidator.php',
      data:$('#advanceRulesForm').serializeArray(),
      async:false
    });
    if(response.responseText == 'Yes')
    {
      setTimeout(function(){
        var old = $('#ruleAddingDialog').html();
        $('#ruleAddingDialog_header').html('<h3>Your Rules Have Been Added</h3>');
        $('#ruleAddingDialog_body').html('<span class="fas fa-check fa-10x text-success"></span>');
        $('#ruleAddingDialog_footer').html('<h5 class="text-success">Successful<h5>');
        setTimeout(function(){
          $('#ruleAddingDialog').modal('hide');
          setTimeout(function(){
            $('#ruleAddingDialog').html(old);
          }, 1000);
        }, 1000);
      }, 1000);
    }
    else
    {
      setTimeout(function(){
        var old = $('#ruleAddingDialog').html();
        $('#ruleAddingDialog_header').html('<h3>Your Rules Failed To Validate (Sorry)</h3>');
        $('#ruleAddingDialog_body').html('<span class="fas fa-times-circle fa-10x text-danger"></span>');
        $('#ruleAddingDialog_footer').html('<h5 class="text-danger">ERROR MESSAGE: '+response.responseText+'<h5>');
        setTimeout(function(){
          $('#ruleAddingDialog').modal('hide');
          setTimeout(function(){
            $('#ruleAddingDialog').html(old);
          }, 1000);
        }, 3500);
      }, 1000);
    }
    console.log(response.responseText);
  }
}

//</editor-fold>as

//////////////////////////////////////////////////////////////////////////////////////////////////
//                           SETTING PAGE JS FUNCTIONS AND CODE                                 //
//////////////////////////////////////////////////////////////////////////////////////////////////

//<editor-fold> SETTINGS PAGE REGION
  //This method will be called when the reboot button is clicked.
  //This method is responsable of changing some UI and sending reboot command to the server.
  function rebootBtnClicked()
  {
    //TODO: Add custom script here if needed.
    $.ajax({
      type:'POST',
      url:'../inc/reboot.php',
      async:false
    });
    $('#rebootBtn').attr('disabled',true);
    $('#closeBtn').attr('disabled',true);
    $('#rebootDialogBody').html("<span class='fas fa-spinner fa-5x fa-spin'></span>");
    $('#rebootDialogTitle').html("Rebooting ...");
  }

  //This function will be called when the save button is clicked in the Settings page.
  //This function is responsable of updating the access point configurations and showing some UI feedback to the user.
  function saveBtnClicked()
  {
    if($('#accessPointForm').valid())
    {
      var response = $.ajax({
        type:'POST',
        url:'../inc/accessPointConfigurations.php',
        data:$('#accessPointForm').serializeArray(),
        async:false
      });
      $('#userFeedback').modal('toggle');
      if(response.responseText == 'Yes')
      {
        setTimeout(function(){
          var old = $('#userFeedback').html();
          $('#userFeedback_header').html('<h5>Access Point Configurations Has Been Updated !</h5>');
          $('#userFeedback_body').html('<span class="fas fa-check fa-10x text-success"></span>');
          setTimeout(function(){
            $('#userFeedback').modal('hide');
            setTimeout(function(){
              $('#userFeedback').html(old);
            }, 1000);
          }, 1000);
        }, 1000);
      }
      else if(response.responseText == 'No')
      {
        setTimeout(function(){
          var old = $('#userFeedback').html();
          $('#userFeedback_header').html('<h5>Failed To Update Your Access Point Configurations</h5>');
          $('#userFeedback_body').html('<span class="fas fa-times-circle fa-10x text-danger"></span>');
          setTimeout(function(){
            $('#userFeedback').modal('hide');
            setTimeout(function(){
              $('#userFeedback').html(old);
            }, 1000);
          }, 1000);
        }, 1000);
      }
      $('#accessPointForm').trigger("reset");
    }
  }
  $(document).on('DOMNodeInserted','#SSIDField-error', function () {
    $('#SSIDField-error').addClass('invalid-feedback');
  });
  $(document).on('DOMNodeInserted','#APPasswordField-error', function () {
    $('#APPasswordField-error').addClass('invalid-feedback');
  });

  $(document).on('DOMNodeInserted','#usernameField-error', function ()
  {
    $('#usernameField-error').addClass('invalid-feedback');
  });
  $(document).on('DOMNodeInserted','#passwordField-error', function ()
  {
    $('#passwordField-error').addClass('invalid-feedback');
  });

  //This function will start when the page is loaded and will initialize the validation process.
  $().ready(function()
  {
    $.validator.addMethod( "alphanumeric", function( value, element ) {
      return this.optional( element ) || /^\w{1,}$/i.test( value );
    }, "Please enter a valid name (Alphanumeric and _ only)." );
    $.validator.addMethod( "strongPassword", function( value, element ) {
      return this.optional( element ) || /^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*_])(?=.{8,})/.test( value );
    }, "Please enter a password that contains at lest one lower case letter, one upper case letter, one number and one special character." );
    $('#loginCredentials').validate(
      {
        errorClass:"is-invalid",
        focusInvalid: false,
        validClass:"is-valid",
        errorElement:"div",
        rules:{
          usernameField:{
            required:true,
            alphanumeric:true,
            maxlength:50
          },
          passwordField:{
            required:true,
            minlength:8,
            strongPassword:true,
            maxlength:128,
          }
        },
        messages:{
          usernameField:{
            required:"Please enter a Username.",
            maxlength:"The Username maximum length is 32 charachters."
          },
          passwordField:{
            required:"Please enter a password.",
            minlength:"The password should be at lest 8 characters.",
            maxlength:"The password should not be longer than 128 characters."
          }
        }
      });
    $('#accessPointForm').validate(
      {
        focusInvalid: false,
        errorClass:"is-invalid",
        validClass:"is-valid",
        errorElement:"div",
        rules:{
          ssid:{
            required: true,
            maxlength: 32,
            alphanumeric:true,
          },
          password:{
            required: true,
            minlength: 8,
            maxlength: 63,
            strongPassword:true
          }
        },
        messages:{
          ssid:{
            required:"Please enter a name of the access point (SSID).",
            maxlength:"The SSID maximum length is 32 charachters."
          },
          password:{
            required:"Please enter a password.",
            minlength:"The password should be at lest 8 characters.",
            maxlength:"The password should not be longer than 63 characters."
          }
        }

      });
  });

  //This is responsable of changing the login Credentials.
  function submitCredentialsForm()
  {
    if($('#loginCredentials').valid())
    {
      $('#passwordField').val(sha512($('#passwordField').val()));
      var response = $.ajax({
        type:'POST',
        url:'../inc/changeUsernameAndPassword.php',
        data:$('#loginCredentials').serializeArray(),
        async:false
      });
      var APHeader = $('#userFeedback_header').html();
      $('#userFeedback_header').html("<h5>Updating Your Login Credentials</h5>");
      $('#userFeedback').modal('toggle');
      console.log(response.responseText);
      if(response.responseText == 'Yes')
      {
        setTimeout(function(){
          var old = $('#userFeedback').html();
          $('#userFeedback_header').html('<h5>Login Credentials Have Been Updated !</h5>');
          $('#userFeedback_body').html('<span class="fas fa-check fa-10x text-success"></span>');
          setTimeout(function(){
            $('#userFeedback').modal('hide');
            setTimeout(function(){
              $('#userFeedback').html(old);
            }, 1000);
          }, 1000);
        }, 1000);
      }
      else if(response.responseText == 'No')
      {
        setTimeout(function(){
          var old = $('#userFeedback').html();
          $('#userFeedback_header').html('<h5>Failed To Update Your Login Credentials</h5>');
          $('#userFeedback_body').html('<span class="fas fa-times-circle fa-10x text-danger"></span>');
          setTimeout(function(){
            $('#userFeedback').modal('hide');
            setTimeout(function(){
              $('#userFeedback').html(old);
            }, 1000);
          }, 1000);
        }, 1000);
      }
      $('#userFeedback_header').html(APHeader);
    }
    $('#loginCredentials').trigger("reset");
  }
//</editor-fold>

//////////////////////////////////////////////////////////////////////////////////////////////////
//                        NOTIFICATIONS PAGE JS FUNCTIONS AND CODE                              //
//////////////////////////////////////////////////////////////////////////////////////////////////

//<editor-fold> NOTIFICATIONS PAGE REGION
    // If the table is empty (No notifications) then display the message "Nothing to do here !".
    $(document).ready(function()
    {
      $('.dataTables_empty').html('Nothing to do here !'); //change the text of the table when there is no data to show.
    });

//</editor-fold>

//////////////////////////////////////////////////////////////////////////////////////////////////
//                           "My Rules" PAGE JS FUNCTIONS AND CODE                              //
//////////////////////////////////////////////////////////////////////////////////////////////////

//<editor-fold> "My Rules" PAGE REGOIN
var editingRules = true;
var rulseBeforeChanges;
//An event listener that listen for click event and delete the row that has been clicked.
$(document).on('click', '.deleteOnClick', function()
{
  var row = $(this).parent();
  row.addClass('bg-danger');
  row.fadeOut(300, function() {row.remove();});
});

//This function will update the "userAddedRules".
function saveChangesToRules()
{
  var remainingRules = [];
  $('#userAddedRules').children().each(function()
  {
    var startAt = $(this).children().last().html().indexOf('sid:')+4;
    var firstPart = $(this).children().last().html().substring(startAt);
    var final = firstPart.substring(0, firstPart.indexOf(';'));
    remainingRules.push(final);
  });
  var toBeSend = "";
  for (var i = 0;i<remainingRules.length;i++)
  {
    toBeSend+=remainingRules[i]+",";
  }
  console.log(toBeSend);
  var response = $.ajax({
    type:'POST',
    url:'../inc/updateUserAddedRules.php',
    data:{rules:toBeSend},
    async:false,
  });
}
//Called when the "Edit Rules" button clicked in "My Rules" page.
//This function manage the UI then calls the "saveChangesToRules()" to update the Rules.
function editRules()
{
  if(editingRules)
  {
    rulseBeforeChanges = $('#userAddedRules').children().length;
    $('#userAddedRules_header').children().append('<th class="deleteCheckbox" style="display:none"></th>');
    $('#userAddedRules').children().each(function(){
      var test = $(this).append("<td class='deleteCheckbox deleteOnClick' style='display:none;width:10px;padding:0px;border-width:0px'><button style='border-radius:100px;margin-right:20px' class='text-danger btn btn-block btn-link deleteOnClick' type='button'><span class='fas fa-trash-alt fa-lg'></span></button></td>");
    });
    $('#userAddedRules').children().children('.deleteCheckbox').fadeIn(100);
    $('#userAddedRules_header').children().children('.deleteCheckbox').fadeIn(100);
    $('#myRulesBtn').html('Stop Editing Rules & Save Changes').removeClass('btn-warning').addClass('btn-danger');
    editingRules = false;
  }
  else
  {
    $('#myRulesBtn').html('Edit Rules').removeClass('btn-danger').addClass('btn-warning');
    $('.deleteCheckbox').fadeOut(100, function() {$(this).remove();});
    editingRules=true;
    if(rulseBeforeChanges == $('#userAddedRules').children().length)
    {
      console.log('No change');
    }
    else
    {
      setTimeout(function(){
        saveChangesToRules();
      },150);
      console.log('Rules have been Modified ! (Updateing Rules)');
    }
  }
}

//</editor-fold>

var formChecker = null;

function swfUploadLoaded() {
	var btnSubmit = document.getElementById("btnSubmit");
	
	btnSubmit.onclick = doSubmit;
	btnSubmit.disabled = true;
	
	/*txtLastName.onchange = validateForm;
	txtFirstName.onchange = validateForm;
	txtEducation.onchange = validateForm;
	txtReferences.onchange = validateForm;
	*/
	formChecker = window.setInterval(validateForm, 1000);
	
	validateForm();
}

// Called by the queue complete handler to submit the form
function uploadDone() {
	try {
		//alert('Done');
		//document.forms[0].submit();
	} catch (ex) {
		//alert("Error submitting form");
	}
}

function fileDialogStart() {
	$('#txtFileName').removeClass('error');
	$('#fsUploadProgress').css('width', 0);
	$('#txtFileName').val('');
	$('#uploadButton').attr('disabled', 'disabled');

	this.cancelUpload();
}

function fileQueued(file) {
	$('#txtFileName').val(file.name);
	$('#uploadButton').removeAttr('disabled');
}

function uploadProgress(file, bytesLoaded, bytesTotal) {

	var percent = Math.ceil((bytesLoaded / bytesTotal) * 100);
	$('#fsUploadProgress').css('width', ((percent/100)*250)+'px');
}

function uploadSuccess(file, serverData) {
	var response = serverData.split(':');
	if((response.length == 2) && (response[0] > 0)) {
		this.customSettings.upload_successful = true;
		$('#hidFileID').val(serverData);
		$('#txtFileName').val('Completed');
		$('#txtFileName').removeClass('error');
		$('#fsUploadProgress').css('width', 0);
		
		$('#thumbPlaceholder').empty();
		$('#thumbPlaceholder').show();
	}
}

function uploadComplete(file) {
	try {
		if (this.customSettings.upload_successful) {
			//this.setButtonDisabled(true);
			uploadDone();
		} else {
			//alert("There was a problem with the upload.\nThe server did not accept it.");
			$('#txtFileName').val('Server Rejected File');
			$('#txtFileName').addClass('error');
			$('#fsUploadProgress').css('width', 0);
		}
	} catch (e) {
	}
}

function uploadError(file, errorCode, message) {
	try {
		
		if (errorCode === SWFUpload.UPLOAD_ERROR.FILE_CANCELLED) {
			// Don't show cancelled error boxes
			return;
		}
		
		var txtFileName = document.getElementById("txtFileName");
		txtFileName.value = "";
		//validateForm();
		
		// Handle this error separately because we don't want to create a FileProgress element for it.
		switch (errorCode) {
		case SWFUpload.UPLOAD_ERROR.MISSING_UPLOAD_URL:
			alert("There was a configuration error.  You will not be able to upload a resume at this time.");
			this.debug("Error Code: No backend file, File name: " + file.name + ", Message: " + message);
			return;
		case SWFUpload.UPLOAD_ERROR.UPLOAD_LIMIT_EXCEEDED:
			alert("You may only upload 1 file.");
			this.debug("Error Code: Upload Limit Exceeded, File name: " + file.name + ", File size: " + file.size + ", Message: " + message);
			return;
		case SWFUpload.UPLOAD_ERROR.FILE_CANCELLED:
		case SWFUpload.UPLOAD_ERROR.UPLOAD_STOPPED:
			break;
		default:
			alert("An error occurred in the upload. Try again later.");
			this.debug("Error Code: " + errorCode + ", File name: " + file.name + ", File size: " + file.size + ", Message: " + message);
			return;
		}

		switch (errorCode) {
		case SWFUpload.UPLOAD_ERROR.HTTP_ERROR:
			//progress.setStatus("Upload Error");
			this.debug("Error Code: HTTP Error, File name: " + file.name + ", Message: " + message);
			break;
		case SWFUpload.UPLOAD_ERROR.UPLOAD_FAILED:
			//progress.setStatus("Upload Failed.");
			this.debug("Error Code: Upload Failed, File name: " + file.name + ", File size: " + file.size + ", Message: " + message);
			break;
		case SWFUpload.UPLOAD_ERROR.IO_ERROR:
			//progress.setStatus("Server (IO) Error");
			this.debug("Error Code: IO Error, File name: " + file.name + ", Message: " + message);
			break;
		case SWFUpload.UPLOAD_ERROR.SECURITY_ERROR:
			//progress.setStatus("Security Error");
			this.debug("Error Code: Security Error, File name: " + file.name + ", Message: " + message);
			break;
		case SWFUpload.UPLOAD_ERROR.FILE_CANCELLED:
			//progress.setStatus("Upload Cancelled");
			this.debug("Error Code: Upload Cancelled, File name: " + file.name + ", Message: " + message);
			break;
		case SWFUpload.UPLOAD_ERROR.UPLOAD_STOPPED:
			//progress.setStatus("Upload Stopped");
			this.debug("Error Code: Upload Stopped, File name: " + file.name + ", Message: " + message);
			break;
		}
	} catch (ex) {
	}
}
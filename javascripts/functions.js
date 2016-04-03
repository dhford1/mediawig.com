// JavaScript Document

/* FORM FUNCTIONS */

function fncValidateAndSubmit(oForm) {
  if (fncValidateForm(oForm)) {
    oForm.submit();
  }
}

var blnDoFancyFields = false;
function fncValidateForm(oForm) {
  blnDoFancyFields = false;
  var strErrors = "";
  var oElements = oForm.elements;
  if (arguments.length >= 2) {
    if (arguments[1] == true) {
      blnDoFancyFields = true;
    }
  }
  
  for (var i=0;i<oElements.length;i++) {
    // Validate each element using the fncValidFormField function which will
    //   return any errors found.  
    strErrors = strErrors + fncValidFormField(oElements[i]);
  }
  
  if (strErrors.length > 0) {
    // Report any errors and return false
    alert("Please correct these errors before continuing: \n" + strErrors);
    return false;
  }
  else {
    // All elements have been validated, return true
    return true;
  }
}

function fncValidFormField(oElement) {
  // Returns error message if invalid
  // Form Elements can have the following additional attributes (which may lead to invalid XHTML)
  //   required - makes sure there is a value provided or selected
  //   validphone - ensures valid US/Canadian phone number
  //   validemail - ensures valid email address
  // Does not validate checkbox lists or radio buttons
  var strElementError = "";
  var strNiceName = oElement.name;
  var blnAllRequired = false;
  
  if (oElement.form) {
    if (oElement.form.getAttribute("required")) {
      blnAllRequired = true;
    }
  }
  
  if (typeof(blnDoFancyFields) == "undefined") {
    blnDoFancyFields = false;
  }
  if (arguments.length >= 2) {
    if (arguments[1] == true) {
      blnDoFancyFields = true;
    }
  }
  
  if (oElement.getAttribute("nicename")) {
    strNiceName = oElement.getAttribute("nicename");
  }
  
  if (!oElement.disabled && oElement.getAttribute("type") != "hidden") {
    
    // Validate Required Elements
    if (blnAllRequired || oElement.getAttribute("required")) {
      
      // Check Required Text Elements (Text, Textbox, Textarea)
      if ((oElement.type.indexOf("text") >= 0 || oElement.type.indexOf("password") >= 0) && oElement.value.length <= 0) {
        strElementError = "Please provide a response for " + strNiceName;
      }
      
      // Check Required Drop-Down Boxes
      if (oElement.type.indexOf("select") >= 0) {
        var intNumSelected = 0;
        for (var j=0;j<oElement.length;j++) {
          if (oElement[j].selected && oElement[j].value.length > 0) {
            intNumSelected++;
          }
        }
          
        if (intNumSelected == 0) {
          strElementError = "Please select a response for " + strNiceName;
        }
      }
    }
    
    // Validate Phone Number
    if (oElement.getAttribute("validphone") && oElement.value.length > 0) {
      if (!fncValidUSCanadaPhone(oElement.value)) {
        strElementError = "Please provide a valid " + strNiceName;
      }
    }
    
    // Validate Email Addresses
    if (oElement.getAttribute("validemail") && oElement.value.length > 0) {
      if (!fncValidEmail(oElement.value)) {
        strElementError = "Please provide a valid " + strNiceName;
      }
    }
    if (oElement.getAttribute("validintlphone") && oElement.value.length > 0) {
      if (!fncValidIntlPhone(oElement.value)) {
        strElementError = "Please provide a valid " + strNiceName;
      }
    }
  }
  
  if (strElementError.length > 0) {
    strElementError = "\n - " + strElementError;
    if (blnDoFancyFields) { fncAddClass(oElement, "clsFormInputInvalid"); }
  }
  else {
    if (blnDoFancyFields) { fncRemoveClass(oElement, "clsFormInputInvalid"); }
  }
  return strElementError;
}

function fncValidEmail(strEmail) {
	strInvalidChars = " /:,;'";
	if (strEmail == "" ) {
		return false;
	}
	for ( i = 0; i<strInvalidChars.length;  i++) {
		chrBadChar=strInvalidChars.charAt(i);
		if (strEmail.indexOf(chrBadChar,0) > -1) {
			return false;
		}
	}
	intPos=strEmail.indexOf("@",1)
	if (intPos == -1 ) {
		return false;
	}
	if (strEmail.indexOf("@",intPos+1) > -1 ) {
		return false;
	}
	intPeriodPos=strEmail.indexOf(".",intPos)
	if (intPeriodPos == -1 ) {
		return false;
	}
	if (intPeriodPos+3 > strEmail.length ) {
		return false;
	}
	return true;
}

function fncValidUSCanadaPhone(strPhone) {
	if (strPhone.match(/\s*\(?\s*[2-9]\d{2}\s*\)?\s*([-.]?)\s*\d{3}\s*([-.]?)\s*\d{4}\s*/)) {
	  if (fncValidIntlPhone(strPhone)) {
		  return true;
	  }
	}
	return false;
}

function fncValidIntlPhone(strPhone) {
	strPhone = strPhone.replace(/[\s\(\)\-\.]/g,"");
	if (strPhone.length >= 10) {
	  return true;
	}
}


// Get Ajax Content



var http = createRequestObject();
function createRequestObject() {
	var objAjax;
	var browser = navigator.appName;
	if(browser == "Microsoft Internet Explorer"){
		objAjax = new ActiveXObject("Microsoft.XMLHTTP");
	}else{
		objAjax = new XMLHttpRequest();
	}
	return objAjax;
}

function getNewContent(NewContent){
http.open('get',NewContent);
http.onreadystatechange = updateNewContent;
http.send(null);
return false;
}

function updateNewContent(){
if(http.readyState == 4){
document.getElementById('idAJAXcontent').innerHTML = http.responseText;
}
}
//List of any reports that ARE sub types.
var is_subreport=[];
var is_manualreport=[];
//List of any reports that HAVE sub types. 
//Any reports that are not in this list/array are 
//final reports (no more selections need to be done, aside from date/time).
var has_subreport=[];
var has_manualreport = [];

const DISABLE = false;
const ENABLE = true;

var visibleDivs=[];
var visibleDivs2=[];
var report_id1; //dash-separated id of element
var report_id2;
var rev_id = " ";
var type; //actual name or type of the report (or subreport)
var parent_type;
var subparent_type;
var manparent_type;
var is_subtype=false;
var is_mantype=false;
var is_revtype = false;

var previousSelection1 = " ";
var previousSelection2 = " ";
/*
	Function onLoad() will execute on a page refresh/load. 
	The function will populate the javascript array variables 
	accordingly, using the php comma separated string variables.
	
	Update the is_subreport and has_subreport variables with their arrays
*/
function onLoad(is_sub, has_sub, is_man, has_man){
	is_subreport = is_sub.split(",");
	has_subreport = has_sub.split(",");
	is_manualreport = is_man.split(",");
	has_manualreport = has_man.split(",");
	var e = document.getElementById('refresh');
	if (e.value=="no"){
		e.value="yes";
	}
	else{
		e.value="no";
		location.reload(true);
	}
}

/*
	Function isInArray() checks if an element is in an array (arr). 
	Can also be used for checking if a substring (element) 
	is in a string (arr).
*/
function isInArray(element, arr){
	return (arr.indexOf(element) != -1);
}

/*
	Function altDownload is coded as an alternative solution to 
	download manuals when the user clicks View File
*/
function altDownload(button, alt_link){
	let a = document.createElement('a');
	a.href = alt_link;
	a.download = alt_link.split('/').pop();
	document.body.appendChild(a);
	console.log(button.id);
	if (button.id == "view-file"){
		window.open(alt_link);
	}
	else{
		a.click();
	}
	document.body.removeChild(a);
}

/*			
	Function toggleButtons will be used to enable/disable buttons on the 
	Manuals Website depending on how correctly the user manouvers through
	the website
*/	
function toggleButtons(relative_link, enable){
	
	let dl = document.getElementById("download");
	let view = document.getElementById("view-file");
	if (enable){
		//Enable Download button
		dl.href = relative_link; //enable the <a> tag by directing it to an actual link
		//Enable View File button
		view.href = relative_link;
		
		//sets the 'download' attribute of <a> tag so
		//that the file is automatically downloaded upon click
		dl.setAttribute("download",relative_link); 
	}
	else{
		//Disable Download button
		dl.href = "#"; //disables the <a> tag by directing it nothing (current page)
		dl.removeAttribute("download"); //removes the 'download' attribute of <a> tag
		//Disable View File button
		view.href = "#";
	}
}

/*
	Function getReportLink will be used by the main program in ttc_home.php
	to retrieve the link to the manual and enable the buttons for the user
	to be able to view or download the manual.
	
	It will also show the associated description for the Manual Revision
*/
function getReportLink(select){
	is_subtype = true;
	is_mantype = true;
	is_revtype = true;
	let index = select.selectedIndex;
	type = select.options[index].label;
	showDescription();
	rev_id = select;
	let report = getReport(type);
	let filename = report['filename'];
	toggleButtons(filename, ENABLE);
}

/* 
	Function closeOtherWindows will take in an argument of a block and 
	remove it from the user's view
*/ 
function closeOtherWindows(exceptThis){
	if(exceptThis != " "){
		document.getElementById(exceptThis).style.display = "none";
	}
	if(rev_id != " ")
		rev_id.selectedIndex = -1;
}

/*
	Function showNextDiv will open the Model Types columns upon 
	selection of a specific Asset Type and will display the 
	correspinding description of the Model Type
*/
function showNextDiv(select){
	closeOtherWindows(previousSelection1);
	closeOtherWindows(previousSelection2);
	
	report_id=select.value;
	if (report_id==''){
		return;
	}

	let index = select.selectedIndex;
	type = select.options[index].label;

	//Hide any datetime elements until full report has been selected
	var datetimeDivs = document.querySelectorAll(".datetime");
	for (let i = 0; i< datetimeDivs.length; i++){
		datetimeDivs[i].style.display = "none"; //hide div
	}
	datetimeDivs = document.querySelectorAll(".datetime select");
	for (let i = 0; i< datetimeDivs.length; i++){
		datetimeDivs[i].selectedIndex = -1; //unselect the previously made selection
	}	


	is_subtype = false;
	is_mantype = false;
	is_revtype = false;
	toggleButtons(null, DISABLE);

	//If the selected report has a subtype, then display the sub options. Selection is not done yet.
	if (isInArray(report_id, has_subreport)){
		visibleDivs.push(report_id);
		showSubOptions();
		parent_type = type; //store the current report type as the parent type.
	} 
	else{
		/*
			Otherwise, the selected report does not have a subtype.
			Then, if it IS NOT a subtype, clear/hide the subtype selection menu.
			Regardless, the selection is done for choosing the report. All that is left is the date(or datetime) selection.
		*/
		if (!isInArray(report_id, is_subreport)){
			hideSubOptions();
			hideSubOptions2();
		}
		else{
			is_subtype = true;
		}
		
		closeOtherWindows(previousSelection1);
		document.getElementById(report_id).style.display = "inline-block";
		previousSelection1 = report_id;
	}
	showDescription();
}

/*
	Function showNextDiv2 will display the Manual Names
	column of the associated Model Type and will display 
	the corresponding description
*/
function showNextDiv2(select){
	closeOtherWindows(previousSelection2);
	
	report_id2=select.value;
	if (report_id2==''){
		return;
	}
	
	let index = select.selectedIndex;
	type = select.options[index].label;

	is_subtype = true;
	is_mantype = false;
	is_revtype = false;
	toggleButtons(null, DISABLE);
	
	
	//If the selected report has a subtype, then display the sub options. Selection is not done yet.
	if (isInArray(report_id2, has_manualreport)){
		visibleDivs2.push(report_id2);
		showSubOptions2();
		subparent_type = type; //store the current report type as the parent type.
	} 
	else{
		/*
			Otherwise, the selected report does not have a subtype.
			Then, if it IS NOT a subtype, clear/hide the subtype selection menu.
			Regardless, the selection is done for choosing the report. All that is left is the date(or datetime) selection.
		*/
		if (!isInArray(report_id2, is_manualreport)){
			hideSubOptions2();
		}
		else{
			is_subtype = true;
		}
		
	}
	showDescription();
}

/*
	Function showNextDiv3 will display the Manual Revisions column 
	upon selection of a Manual Name and will display the corresponding
	description
*/
function showNextDiv3(select){	
	report_id2=select.value;
	if (report_id2==''){
		return;
	}
	
	let index = select.selectedIndex;
	type = select.options[index].label;
	manparent_type = type;
	
	is_subtype = true;
	is_mantype = true;
	is_revtype = false;
	toggleButtons(null, DISABLE);
	
	closeOtherWindows(previousSelection2);
	document.getElementById(report_id2).style.display = "inline-block";
	previousSelection2 = report_id2;
	
	showDescription();
}

/*
	Functions hideSubOptions will be used to remove elements/blocks
	from the user's display as the user manouvers through the website
*/
function hideSubOptions(){
	var length = visibleDivs.length;
	var div_name = null;
	while (length > 0){
		div_name = visibleDivs.pop(); // remove last element and return it to div_name
		document.getElementById(div_name).style.display = "none";	
		document.querySelector('#'+div_name+' select').selectedIndex = -1; // clear selection
		length--;
	}
}
function hideSubOptions2(){
	var length = visibleDivs2.length;
	var div_name = null;
	while (length > 0){
		div_name = visibleDivs2.pop(); // remove last element and return it to div_name
		document.getElementById(div_name).style.display = "none";	
		document.querySelector('#'+div_name+' select').selectedIndex = -1; // clear selection
		length--;
	}
}

/* 
	Functions showSubOptions will be used to hide certain columns of the 
	website while displaying others depending on the actions of the user.
	
	For example, if the user has made selections up to the Manual Names 
	and the user decides to change the parent Model Type, then the website 
	should hide the Manual Names column and reopen it with the children of 
	the newly selected Model Type
*/
function showSubOptions(){
	hideSubOptions();
	hideSubOptions2();
	document.getElementById(report_id).style.display = "inline-block";
	visibleDivs.push(report_id);
}
function showSubOptions2(){
	hideSubOptions2();
	document.getElementById(report_id2).style.display = "inline-block";
	visibleDivs2.push(report_id2);
}

/*
	Function getReport will use the types of the Asset Types, Model Types, Manual Names and Manual Revisions
	to determine the full subarray (holding the type, description, and children) to return from the Manuals Array
*/
function getReport(){
	for (let key in reports_obj){
		let report = reports_obj[key];
		//If we know that parameter 'type' is a subtype, 
		//then we can check the parent types before iterating further into the object
		if (is_subtype){ 		
			if (report['type'] === parent_type || (report['type'].indexOf(parent_type)) != -1){
				let subreports_obj = report['modeltypes'];
				for (let key in subreports_obj){
					let subreport = subreports_obj[key];
					if(is_mantype){
						if(subreport['type'] == subparent_type){
							let subSubreports_obj = subreport['manualnames'];
							for (let key in subSubreports_obj){
								let subSubreport = subSubreports_obj[key];
								if(is_revtype){
									if(subSubreport['type'] == manparent_type){
										let manreport_obj = subSubreport['revisions'];
										for (let key in manreport_obj){
											let manreport = manreport_obj[key];
											if(manreport['type'] == type){
												return manreport;
											}
										}
									}
								} else {
									if(subSubreport['type']==type){
										return subSubreport;
									}
								}
							}
						}
					}else {
						if (subreport['type'] === type){
							return subreport;
						}
					}
				}
			}
		}
		else{ //If the parameter 'type' is not a subtype, we don't need to check any modeltypes.
			if (report['type'] === type || (report['type'].indexOf(type)) != -1){
				return report;
			}
		}
	}
}

/*
	Function showDescription will extract the description element of the subarray returned 
	by getReport to display the description as a block at the bottom of the webpage
*/
function showDescription(){
	let description = document.getElementById('report-description');
	let report = getReport();
	description.style.display = "block";
	description.innerHTML = "<p class=emphasis>" + type +"&nbsp;</p><p class=description>" + report['description'] + "</p>";

}

/* 
	Function adjustViewListener will use the argument of the window size 
	to change size of the columns displayed depending on how the user 
	minimizes or maximizes their screen
*/
function adjustViewListener(winView){
	let selectors = document.getElementsByTagName("select");
	if (winView.matches){
		for (let i = 0; i<selectors.length; i++){
			selectors[i].removeAttribute('size');
		}
	}
	else{
		for (let i = 0; i<selectors.length; i++){
			selectors[i].setAttribute('size', 15);
		}
	}
}

var winView = window.matchMedia("(max-width: 600px)");
adjustViewListener(winView); // Call listener at run time
winView.addListener(adjustViewListener); //Attach listener function on state changes


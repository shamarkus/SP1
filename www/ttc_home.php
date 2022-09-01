<?php
	$is_subreport_str='';
	$has_subreport_str='';
	$is_manual_str='';
	$has_manual_str='';
	
	/*
		Array is structured such that the first layer of arrays will consist of Asset Types
									  the next layer of arrays will consist of Model Types
									  the following layer of arrays will consist of Manual Names
									  and the final layer of arrays will consist of Manual Revisions
									 
		The access will work as follows: Asset Type --> Model Type --> Manual Name --> Manual Revisision --> Link
		
		The array will be populated based on the local text configuration files.
		
		For example, an asset entry for Switch Manuals may look similar to the following:
		
		array("type" => "Switch Manuals",
			  "description"=>"Switch manuals for switch movement and control.",
			  "modeltypes" => array(array("type" => "Alstom HW1122",
									    "description" => "This is the description for the Alstome HW1122",
									    "manualnames" => array(array("type" => "SH-00-S03: HW1122 Point Machine Installation and Maintenance Manual - Sheppard Subway",
																	"description" => "Point Machine Installation and Maintenace Manual Description",
																	"revisions" =>  array(array("type" => "April 12, 2000",
																								"description" => "Manual Publication Date",
																								"filename" => "https://op.int.ttc.ca/dc/subwayinfr/signalstra/signalstrai/pwstceequipm00013/edocume/Alstom%20HW1122.pdf"), // NEED TO ADD NEW FILE LOCATION
																								)),
	*/
	$MANUALS = array();
	
	// This function will be used to generate IDs for various div elements by replacing spaces with hyphens
	function replaceSpaceWithDash($str){
        $text = str_replace(' ', '-', $str);
        return strtolower($text);
    }
	
	/*
		This function will generate the HTML for selecting any top-level Asset Types.
		It takes a parameter of the manuals array data structure.
	*/
	function generateManualSelectors($report_array){
		
		echo "<div id=report-select><h3>Select an Asset Type:</h3><select id=type size='15' 
		onchange='showNextDiv(this)'>";
		
		$prev_optgroup='';
		$curr_optgroup='';
		$report_num = 1;
		foreach ($report_array as $report){ // index through Asset Types
			$report_type=$report['type'];
			// split the sub-manual and store the separate strings as array in $token
			$token=explode('>',$report_type); 
			if (count($token)>1){	// if more than 1 string	
				$curr_optgroup = $token[0];
				// if there was no previous optgroup, then open up a new opt group label. 
				// Also, if the optgroup changes between reports, open up a new label 
				// after closing the previous.
				if ($prev_optgroup == ''){
					echo "<optgroup></optgroup>";
					echo "<optgroup label='$curr_optgroup'>";
				}
				else if ($prev_optgroup != '' && $prev_optgroup != $curr_optgroup){
					echo "</optgroup><optgroup></optgroup>";
					echo "<optgroup label='$curr_optgroup'>";
				}
				$report_type = $token[1];
			}
			else{	
				if ($report_num ==1){
				// first report should start with optgroup for spacing, if no label is provided.
					echo "<optgroup>";
				}
				// no optgroup specified if we are in this else block
				$curr_optgroup = '';
				// then close and reset the previous optgroup if it existed. and open up a new one.
				if ($prev_optgroup != ''){
					$prev_optgroup = '';
					echo "</optgroup><optgroup>";
				}
				
			}
			$prev_optgroup = $curr_optgroup;
			$option_value = replaceSpaceWithDash($report_type);
			// display option by showing the 'type' and store value as the 'type' with dashes instead of spaces 
			echo "<option value={$option_value} title='$report_type'>{$report_type}</option>";
			$report_num++;
		}
		echo "</optgroup></select></div>";
	}

	/*
		This function will generate the HTML for selecting any Model Types, 
		as well as determine and return strings that consist of report names(IDs) 
		that are/have a subtype(s) or are a final report.
		It takes a parameter of the entire manual array data structure.
	*/
	function generateOptSelectors($report_array) {
		$is_subreport_str='';
		$has_subreport_str='';
		foreach ($report_array as $report){	// index through each Asset Type
			if (array_key_exists('modeltypes', $report)){ // see if the particular index has a Model Type
				// if the report has a defined 'modeltypes' key (not null), then it HAS a modeltype. 
				// append to the $has_subreport_str string.
				$report_type = $report['type']; // store value of key (type) which is the Asset Type
					
				if (strpos($report_type, '>') !== false){ // if Asset Type has over seeing group and a subgroup, 
					$token = explode('>', $report_type); // take the name of the subgroup
					$report_type = $token[1];
				}
				$report_id = replaceSpaceWithDash($report_type); // sash separated string, all lowercase --> report_id
				$has_subreport_str .= $report_id . ','; // concatenate the Asset Type with comma and add to HAS array
				$modeltypes_array=$report['modeltypes']; // store value of key (modeltypes) which is an array of 
				$prev_optgroup='';							// all the model types
				$curr_optgroup='';
				$subreport_num = 1;
				
				// display options and ability to use function to switch to manual names
				// using the showNextDiv2 function
				echo "<div id=$report_id><h3>Select a Model Type:</h3><select size='15' 
				onchange='showNextDiv2(this)'>";
				
				foreach($modeltypes_array as $key => $subreport){ // discard the subreport description for now
					$subreport_type = $subreport['type']; // store the name of the modelType for option display
					
					// try to tokenize the subreport
					$token=explode('>',$subreport_type);
					if (count($token)>1 ){
						$curr_optgroup = $token[0];
						if ($prev_optgroup == ''){
							echo "<optgroup></optgroup>";
							echo "<optgroup label='$curr_optgroup'>";
						}						
						else if ($prev_optgroup != '' && $prev_optgroup != $curr_optgroup){
							echo "</optgroup>";
							echo "<optgroup label='$curr_optgroup'>";
						}
						$subreport_type = $token[1];
					}
					else{
						if ($subreport_num ==1){
						// first report should start with optgroup for spacing, if no label is provided.
							echo "<optgroup>";
						}
						// no optgroup specified if we are in this else block
						$curr_optgroup = '';
						if ($prev_optgroup != ''){

							$prev_optgroup = '';

							echo "</optgroup><optgroup>";

						}
					}
					$prev_optgroup = $curr_optgroup;
					$subreport_id = replaceSpaceWithDash($subreport_type);
					// append it to the $is_subreport_str string
					$is_subreport_str .= $subreport_id . ',';
					
					// display model type options and store value of model type name with dashes (this variable)
					echo "<option value=$subreport_id title='$subreport_type'>$subreport_type</option>";
					$subreport_num++;				
				}
			echo "</optgroup></select></div>";
			}
		}
		// remove the extra comma at the end of the string.
		$is_subreport_str = substr($is_subreport_str, 0, -1);
		$has_subreport_str = substr($has_subreport_str, 0, -1);
		return array( $is_subreport_str, $has_subreport_str );
	}
	
	/*
		This function will generate the HTML for selecting any Manual Names, 
		as well as determine and return strings that consist of model type(IDs) 
		that are/have a model type or are a final manual.
		It takes a parameter of the entire manual array data structure.
	*/
	function generateManualOptSelectors($report_array) {
		$is_manual_str='';
		$has_manual_str='';
		foreach ($report_array as $report){
			
			// if the report has a defined 'modeltypes' key (not null), then it HAS a subtype. 
			$report_type = $report['type'];
			if (strpos($report_type, '>') !== false){
				$token = explode('>', $report_type);
				$report_type = $token[1];
			}
			$modeltypes_array=$report['modeltypes'];
			
			foreach($modeltypes_array as $key => $subreport){ // discard the subreport description for now
				if(array_key_exists('manualnames', $subreport)){
					// if the subreport has a defined 'manualname' key ( not null), then it has a manual name
					$subreport_type = $subreport['type'];
					if (strpos($report_type, '>') !== false){
						$token = explode('>', $report_type);
						$report_type = $token[1];
					}
					$model_type_id = replaceSpaceWithDash($subreport_type);
					$has_manual_str .= $model_type_id . ',';
					$manualnames_array=$subreport['manualnames'];
					$prev_optgroup='';
					$curr_optgroup='';
					$submanual_num = 1;
					
					// display manual name options and ability to use function to open window with its revisions
					// using the showNextDiv3 function
					echo "<div id=$model_type_id><h3>Select a Manual Name:</h3><select size='15' 
					onchange='showNextDiv3(this)'>";
					foreach($manualnames_array as $key2 => $manname){
						
						$manname_type = $manname['type'];
						
						if ($submanual_num ==1){
						// first report should start with optgroup for spacing, if no label is provided.
							echo "<optgroup>";
						}
						// no optgroup specified if we are in this else block
						$curr_optgroup = '';
						if ($prev_optgroup != ''){

							$prev_optgroup = '';

							echo "</optgroup><optgroup>";

						}
					
						$prev_optgroup = $curr_optgroup;
						$submanname_id = replaceSpaceWithDash($manname_type);
						// append it to the $is_manual_str string
						$is_manual_str .= $submanname_id . ','; 
						
						// display manual name options and store value of manual names with dashes (this variable)
						echo "<option value=$submanname_id title='$manname_type'>$manname_type</option>";
						$submanual_num++;
					}
					echo "</optgroup></select></div>";
				}						
			}
				
		}	
		// remove the extra comma at the end of the string.
		$is_manual_str = substr($is_manual_str, 0, -1);
		$has_manual_str = substr($has_manual_str, 0, -1);
		return array( $is_manual_str, $has_manual_str );
	}			
	
	/*
		This function will generate the HTML for selecting a specific revision for the report,
		using the current system date.
		Every page refresh will update the manual revisions that are available to be selected.
		If additional or special revision selectors are required, this function will need to be updated.
	*/
	function generateRevisions($report_array){
		// index array to locate the revisions (the fourth column)
		foreach ($report_array as $report){
			if (array_key_exists('modeltypes', $report)){
				// if the report has a defined 'modeltypes' key (not null), then it HAS a subtype. 
				// append to the $has_subreport_str string.
				$report_type = $report['type'];
				if (strpos($report_type, '>') !== false){
					$token = explode('>', $report_type);
					$report_type = $token[1];
				}
				$modeltypes_array=$report['modeltypes'];
				
				foreach($modeltypes_array as $key => $subreport){ // discard the subreport description for now
					if(array_key_exists('manualnames', $subreport)){
						// if the subreport has a defined 'manualname' key ( not null), then it has a manual name
						$subreport_type = $subreport['type'];
						if (strpos($subreport_type, '>') !== false){
							$token = explode('>', $subreport_type);
							$subreport_type = $token[1];
						}
						$manualnames_array=$subreport['manualnames'];

						foreach($manualnames_array as $key2 => $manname){
							if(array_key_exists('revisions', $manname)){
								// if the manual name has a defined 'revision' key (not null), then it has a manual name
								$manname_type = $manname['type'];
								if (strpos($manname_type, '>') !== false){
									$token = explode('>', $manname_type);
									$manname_type = $token[1];
								}
								$model_name_id = replaceSpaceWithDash($manname_type);
								$manualrevisions_array=$manname['revisions'];
								$prev_optgroup='';
								$curr_optgroup='';
								$rev_num = 1;
								
								// display window for options and ability to call the onchange fuction
								// to extract the link to the manual's pdf
								echo "<div id=$model_name_id><h3>Select a Manual Revision:</h3><select size='15' 
								onchange='getReportLink(this); return false;'>";
								foreach($manualrevisions_array as $key3 => $manrevision){
									$manrevision_type = $manrevision['type']; 
									
									if ($rev_num ==1){
									// first report should start with optgroup for spacing, if no label is provided.
										echo "<optgroup>";
									}
									// no optgroup specified if we are in this else block
									$curr_optgroup = '';
									if ($prev_optgroup != ''){

										$prev_optgroup = '';

										echo "</optgroup><optgroup>";

									}

									$prev_optgroup = $curr_optgroup;
									$revision_id = replaceSpaceWithDash($manrevision_type);
									// append it to the $is_subreport_str string
									$is_subreport_str .= $revision_id . ','; 
									
									// display the manual revision options and use the revision to create id with dashes (this variable)
									echo "<option value=$revision_id title='$manrevision_type'>$manrevision_type</option>";
									$rev_num++;
								}
								echo "</optgroup></select></div>";
							}
						}
					}						
				}
			}
		}	
	}
	// GLOBAL VARIABLES
	$assetEntries = array();
	$assetDescriptionEntries = array();
	$modelEntries = array();
	$modelDescriptionEntries = array();
	$mannameEntries = array();
	$mannameDescriptionEntries = array();
	
	$assetDescriptionChanged = false;
	$modelDescriptionChanged = false;
	$mannameDescriptionChanged = false;
	$linkChanged = false;
	
	/*
			The following functions will update the array with additions from the 
	 		loading of information from the text file configuration.
	*/	
	
	/* 
		This function will read all the entries in the local text configuration file
		line by line ignoring entries beginning with an asterisk (*) or a space.
		It will convert the line into an array of commands removing any 
		whitespace before or after commands.
	*/
	function readEntries(&$typeArray, &$descriptionArray, $readFile){
			
		while(!feof($readFile)){
			$fullEntry = fgets($readFile);
			//Strip any carriage return or new line characters
			$fullEntry = str_replace(array("\r", "\n"), '', $fullEntry);
			// ignore code with the asterisk --> instructions
			if($fullEntry[0] == '*'){
				//Ignore the line
				array_push($typeArray, '');
				array_push($descriptionArray, '');
			} else if($fullEntry[0] == ' '){
				//Ignore the line	
			} else if($fullEntry[0] == '>'){
				$fullEntry = ltrim($fullEntry, '>');
				$fullCommand = explode('|', $fullEntry);
				array_push($typeArray, trim($fullCommand[0]));
				array_push($descriptionArray, trim($fullCommand[1]));
			}
		}
	}
	
	/* 
		This function will force variables used to determine if the user has 
		made modifications to descriptions/links to be false.
	*/
	function resetVariables(){
		$GLOBALS['assetDescriptionChanged'] = false;
		$GLOBALS['modelDescriptionChanged'] = false;
		$GLOBALS['mannameDescriptionChanged'] = false;
		$GLOBALS['linkChanged'] = false;
	}
	
	/* 
		This function will take in the full list of commands and retrieve the 
		Manual Revision Name as well as the corresponding link and insert it 
		into the multidimensional Manuals global array correctly
	*/
	function insertNewRevisionEntry($commands, &$fullManualsArray){
		// convert commands into a new subarray
		$subArray = array("type" => $commands[6],
						  "description" => "Manual Publication Date",
						  "filename" => $commands[7]);
		$assetCounter = 0;
		$modelCounter = 0;
		$manualNameCounter = 0;
		
		// traverse the array using the Asset Type, Model Type and Manual Name
		// to correctly insert the subarray generated in the right place
		foreach ($fullManualsArray as $key => $element){
			if($element['type']==$commands[0]){
				$modelsArray = $element['modeltypes'];
				foreach ($modelsArray as $key => $subelement){
					if($subelement['type']==$commands[2]){
						$manualNamesArray = $subelement['manualnames'];
						foreach($manualNamesArray as $key => $subSubelement){
							if($subSubelement['type']==$commands[4]){
								// Using the index numbers of the sub elements, carefully index the multidimensional array to insert the subarray
								array_push($fullManualsArray[$assetCounter]['modeltypes'][$modelCounter]['manualnames'][$manualNameCounter]['revisions'], $subArray);
								break;
							}
							$manualNameCounter++;
						}
					}
					$modelCounter++;
				}
			}
			$assetCounter++;
		}
	}	
	
	/*
		This function will traverse the array to check if the user has made changes
		to the link they entered initially
	*/
	function isInManualRevisions($string, $link, $fullManualsArray, $assetType, $modelType, $manualName){
		foreach ($fullManualsArray as $key => $element){
			if($element['type']==$assetType){
				$modelArray = $element['modeltypes'];
				foreach($modelArray as $key => $modelElement){
					if($modelElement['type']==$modelType){
						$manualArray = $modelElement['manualnames'];
						foreach($manualArray as $key => $manualElement){
							if($manualElement['type'] == $manualName){
								$revisionsArray = $manualElement['revisions'];
								foreach($revisionsArray as $key => $revElement){
									if($revElement['type'] == $string){
										if($revElement['filename'] != $link){
											$GLOBALS['linkChanged'] = true;
										}
										return true;
									}		
									
								}
							}
						}
					}
				}
			}
		}		
		return false;
		
		
	}
	
	/* 
		This function will take in the full list of commands and retrieve the 
		Manual Name as well as the corresponding description and insert it 
		into the multidimensional Manuals global array correctly
	*/
	function insertNewManualNameEntry($commands, &$fullManualsArray){
		// convert commands into a new subarray
		$subArray = array("type" => $commands[4],
						  "description" => $commands[5],
						   "revisions" => array(
											  array("type" => $commands[6],
													"description" => "Manual Publication Date",
												    "filename" => $commands[7])
													));
													
		
		
		$assetCounter = 0;
		$modelCounter = 0;
		
		// traverse the array using the Asset Type and Model Type
		// to correctly insert the subarray generated in the right place
		foreach ($fullManualsArray as $key => $element){
			if($element['type']==$commands[0]){
				$modelsArray = $element['modeltypes'];
				foreach ($modelsArray as $key => $subelement){
					if($subelement['type']==$commands[2]){
						// Using the index numbers of the sub elements, carefully index the multidimensional array to insert the subarray
						array_push($fullManualsArray[$assetCounter]['modeltypes'][$modelCounter]['manualnames'], $subArray);
						break;
					}
					$modelCounter++;
				}
			}
			$assetCounter++;
		}
	}
	
	/*
		This function will traverse the array to check if the user has made changes
		to the manual name description they entered initially
	*/
	function isInManualNames($string, $description, $fullManualsArray, $assetType, $modelType){
		foreach ($fullManualsArray as $key => $element){
			if($element['type']==$assetType){
				$modelArray = $element['modeltypes'];
				foreach($modelArray as $key => $modelElement){
					if($modelElement['type']==$modelType){
						$manualArray = $modelElement['manualnames'];
						foreach($manualArray as $key => $manualElement){
							if($manualElement['type'] == $string){
								if($manualElement['description'] != $description){
									$GLOBALS['mannameDescriptionChanged'] = true;
								}
								return true;
							}
						}
					}
				}
			}
		}
		return false;
	}
	
	/* 
		This function will take in the full list of commands and retrieve the 
		Model Type Name as well as the corresponding description and insert it 
		into the multidimensional Manuals global array correctly
	*/
	function insertNewModelEntry($commands, &$fullManualsArray){
		// convert commands into a new subarray
		$subArray = array("type" => $commands[2],
						  "description" => $commands[3],
						  "manualnames" => array(
											   array("type" => $commands[4],
												     "description" => $commands[5],
												     "revisions" => array(
																	    array("type" => $commands[6],
																			  "description" => "Manual Publication Date",
																			  "filename" => $commands[7])
													))));
		$counter = 0;
		
		// traverse the array using the Asset Type
		// to correctly insert the subarray generated in the right place
		foreach ($fullManualsArray as $key => $element){
			if($element['type']==$commands[0]){
				array_push($fullManualsArray[$counter]['modeltypes'], $subArray);
				break;
			}
			$counter++;
		}
	}
	
	/*
		This function will traverse the array to check if the user has made changes
		to the model type description they entered initially
	*/
	function isInModelType($string, $description, $fullManualsArray, $assetType){
		foreach ($fullManualsArray as $key => $element){
			if($element['type']==$assetType){
				$modelArray = $element['modeltypes'];
				foreach($modelArray as $key => $modelElement){
					if($modelElement['type']==$string){
						if($modelElement['description'] != $description){
							$GLOBALS['modelDescriptionChanged'] = true;
						}
						return true;
					}
				}
			}
		}
		return false;
	}
	
	/* 
		This function will take in the full list of commands and retrieve the 
		Asset Type Name as well as the corresponding description and insert it 
		into the multidimensional Manuals global array correctly
	*/
	function insertNewAssetEntry($commands, &$fullManualsArray){
		// convert commands into a new subarray
		$subArray = array("type" => $commands[0],
							  "description" => $commands[1],
							  "modeltypes" => array(
												  array("type" => $commands[2],
														"description" => $commands[3],
														"manualnames" => array(
																			 array("type" => $commands[4],
																				   "description" => $commands[5],
																				   "revisions" => array(
																									  array("type" => $commands[6],
																											"description" => "Manual Publication Date",
																											"filename" => $commands[7])
																											))))));
		array_push($fullManualsArray, $subArray);
	}
	
	/*
		This function will traverse the array to check if the user has made changes
		to the asset type description they entered initially
	*/
	function isInAssetType($string, $description, $array){
		$arrayLength = count($array);
		foreach ($array as $key => $element){
			if($element['type']==$string){
				if($element['description'] != $description){
					$GLOBALS['assetDescriptionChanged'] = true;
				}
				return true;
			}
		}
		return false;
	}
	
	/*
		This function will use the fully generated Manuals array and the boolean variables
		for whether descriptions for the various entires have been modified to pinpoint 
		where changes need to be made using the commands
	*/
	function checkUpdateDescriptions_Links($fullCommandArray){
		$fullManualsArray = $GLOBALS['MANUALS'];
		$assetDesChange = $GLOBALS['assetDescriptionChanged'];
		$modelDesChange = $GLOBALS['modelDescriptionChanged'];
		$mannameDesChange = $GLOBALS['mannameDescriptionChanged'];
		$linkChange = $GLOBALS['linkChanged'];
		
		$assetCounter = 0;
		$modelCounter = 0;
		$manualCounter = 0;
		$revCounter = 0;
		
		foreach ($fullManualsArray as $key => $element){
			if($element['type']==$fullCommandArray[0]){
				if($assetDesChange == true){
					$GLOBALS['MANUALS'][$assetCounter]['description'] = $fullCommandArray[1];
				}
				$modelArray = $element['modeltypes'];
				foreach($modelArray as $key => $modelElement){
					if($modelElement['type']==$fullCommandArray[2]){
						if($modelDesChange == true){
							$GLOBALS['MANUALS'][$assetCounter]['modeltypes'][$modelCounter]['description'] = $fullCommandArray[3];
						}
						$manualArray = $modelElement['manualnames'];
						foreach($manualArray as $key => $manualElement){
							if($manualElement['type'] == $fullCommandArray[4]){
								if($mannameDesChange == true){
									$GLOBALS['MANUALS'][$assetCounter]['modeltypes'][$modelCounter]['manualnames'][$manualCounter]['description'] = $fullCommandArray[5];
								}
								$revisionsArray = $manualElement['revisions'];
								foreach($revisionsArray as $key => $revElement){
									if($revElement['type'] == $fullCommandArray[6]){
										if($linkChange == true){
											$GLOBALS['MANUALS'][$assetCounter]['modeltypes'][$modelCounter]['manualnames'][$manualCounter]['revisions'][$revCounter]['filename'] = $fullCommandArray[7];
										}
									}		
									$revCounter++;
								}
							}
							$manualCounter++;
						}
					}
					$modelCounter++;
				}
			}
			$assetCounter++;
		}
	}
	
	/*
		This function will consider the commands entered by the user and check if Asset Type, Model Type,
		Manual Name, Manual Revision has been previously entered by the user. If it is not, then the 
		program will add a new entry into the global array. 
		
		If the Asset Type, Model Type, Manual Name and Manual Revision is already in the list, check if
		their corresponding descriptions or links have been changed and make changes as necessary.
	*/
	function updateArray($fullCommandArray){
		$arraySize = count($fullCommandArray);

		if (isInAssetType($fullCommandArray[0], $fullCommandArray[1], $GLOBALS['MANUALS'])){
		
			if(isInModelType($fullCommandArray[2], $fullCommandArray[3], $GLOBALS['MANUALS'], $fullCommandArray[0])){
				
				if(isInManualNames($fullCommandArray[4], $fullCommandArray[5], $GLOBALS['MANUALS'], $fullCommandArray[0], $fullCommandArray[2])){
					
					if(isInManualRevisions($fullCommandArray[6], $fullCommandArray[7], $GLOBALS['MANUALS'], $fullCommandArray[0], $fullCommandArray[2], $fullCommandArray[4])){
						
					} else {
						insertNewRevisionEntry($fullCommandArray, $GLOBALS['MANUALS']);
					}
				} else {
					insertNewManualNameEntry($fullCommandArray, $GLOBALS['MANUALS']);
				}
			} else {
				insertNewModelEntry($fullCommandArray, $GLOBALS['MANUALS']);	
			}
		} else{
			insertNewAssetEntry($fullCommandArray, $GLOBALS['MANUALS']);
		}
		checkUpdateDescriptions_Links($fullCommandArray, $GLOBALS['MANUALS']);
	}
	
	/*
		This function will read each entry line by line and extract input into an array
		ignoring entries that begin with an asterisk (*) or a space and removing any whitespace
		around the arguments
	*/
	function readTextConfig($readFile){
		
		while(!feof($readFile)){
			$fullCommand = array();
			$fullEntry = fgets($readFile);
			//Remove any carriage return or new line characters
			$fullEntry = str_replace(array("\r", "\n"), '', $fullEntry);
			
			// ignore code with the asterisk --> instructions
			if($fullEntry[0] == '*'){
				// ignore the line
			} else if($fullEntry[0] == ' '){
				// ignore the line	
			} else if($fullEntry[0] == '>'){
				resetVariables();
				$fullEntry = ltrim($fullEntry, '>');
				$tempCommand = explode('|', $fullEntry);
				
				$index = 0;
				$arraySize = count($tempCommand);
				
				// convert first 3 arguments into integers while keeping the rest as strings
				while($index < $arraySize){
					$tempCommand[$index] = trim($tempCommand[$index]);
					if($index < 3)
						$tempCommand[$index] = (int) $tempCommand[$index];
					$index++;
				}
				
				// index the array for input
				array_push($fullCommand, $GLOBALS['assetEntries'][$tempCommand[0]], $GLOBALS['assetDescriptionEntries'][$tempCommand[0]]);
				array_push($fullCommand, $GLOBALS['modelEntries'][$tempCommand[1]], $GLOBALS['modelDescriptionEntries'][$tempCommand[1]]);
				array_push($fullCommand, $GLOBALS['mannameEntries'][$tempCommand[2]], $GLOBALS['mannameDescriptionEntries'][$tempCommand[2]]);
				array_push($fullCommand, $tempCommand[3], $tempCommand[4]);
				
				updateArray($fullCommand);
			}
		}	
	}	

/**
 * Workaround for PHP < 5.1.6
 */
if (!function_exists('json_encode')) {
	function json_encode($data) {
		switch ($type = gettype($data)) {
			case 'NULL':
				return 'null';
			case 'boolean':
				return ($data ? 'true' : 'false');
			case 'integer':
			case 'double':
			case 'float':
				return $data;
			case 'string':
				return '"' . addslashes($data) . '"';
			case 'object':
				$data = get_object_vars($data);
			case 'array':
				$output_index_count = 0;
				$output_indexed = array();
				$output_associative = array();
				foreach ($data as $key => $value) {
					$output_indexed[] = json_encode($value);
					$output_associative[] = json_encode($key) . ':' . json_encode($value);
					if ($output_index_count !== NULL && $output_index_count++ !== $key) {
						$output_index_count = NULL;
					}
				}
				if ($output_index_count !== NULL) {
					return '[' . implode(',', $output_indexed) . ']';
				} else {
					return '{' . implode(',', $output_associative) . '}';
				}
			default:
				return ''; // Not supported
		}
	}
}
?><!DOCTYPE html>
<html>
<head>
	<?php
	// Open the text configuration files for Asset, Model and Manual Types, and the Manual Revisions
	// Read each entry line by line and extract input into an array
	// Close text confirguration files after data has been fully extracted
	$myfile = fopen("Text_Configuration_Files/Asset-Description-Version-Control/asset-description-config.txt", "r") or die("Unable to open file!");
	
		readEntries($GLOBALS['assetEntries'], $GLOBALS['assetDescriptionEntries'], $myfile);
		
	fclose($myfile);
	
	$myfile = fopen("Text_Configuration_Files/Model-Description-Version-Control/model-description-config.txt", "r") or die("Unable to open file!");
	
		readEntries($GLOBALS['modelEntries'], $GLOBALS['modelDescriptionEntries'], $myfile);
		
	fclose($myfile);
	
	$myfile = fopen("Text_Configuration_Files/Manual-Description-Version-Control/manual-description-config.txt", "r") or die("Unable to open file!");
	
		readEntries($GLOBALS['mannameEntries'], $GLOBALS['mannameDescriptionEntries'], $myfile);
		
	fclose($myfile);
	
	$myfile = fopen("Text_Configuration_Files/Revision-Link-Version-Control/Textfile.txt", "r") or die("Unable to open file!");
		  
	readTextConfig($myfile);
	
	fclose($myfile);
	?>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width,initial-scale=1.0">
	<meta name="description" content="Homepage for downloading reports.">
	<title>Signals & Train Control Engineering Web Manuals</title>
	<meta name="Author" content="Authored by Krishanth Suthaharan">
	<link rel="stylesheet" type="text/css" href="ttc_style.css">
	<script src="/ttc_main.js"></script>
	<script>var reports_obj = JSON.parse( '<?php echo json_encode($MANUALS); ?>' );</script>
</head>

<body>
	
	<div id="page-container">
		<!-- NAVIGATION TOP BANNER HERE -->
		<?php include(getcwd() . "/ttc_topnav.php"); ?>
		<div class="clear"></div>
		<div class="content-container">
			<p class="welcome">Welcome to the Signals and Train Control Engineering Web Manuals Home Page!
				<br>On this site are manuals mandated by the Toronto Transit Commission (TTC).<br/>
			</p>
			<input type="hidden" id="refresh" value="no">
			<div class="report-download-area">
				<h2>View Manuals</h2>
				<div class="selector-area">
					<?php
						// Display of columns with manual options to select from
						generateManualSelectors($MANUALS);
						list($is_subreport_str, $has_subreport_str)=generateOptSelectors($MANUALS);	
						
						list($is_manual_str, $has_manual_str)=generateManualOptSelectors($MANUALS);
						echo "<script>onLoad('$is_subreport_str','$has_subreport_str', '$is_manual_str', '$has_manual_str');</script>";
						
						generateRevisions($MANUALS);
						
						// end of display for manual options
					?>
				</div>
				<div class="clear"></div>
				<div class="buttons">
					<a href="#" id="popout" name="ttc_map_2019.png">View Map</a>
					<div id="map-modal" class="modal">
						<span class="close">&times;</span>
						<a href="#"><img class="modal-content" id="ttc_subwaymap"></a>
					</div>
					<script type=text/javascript>
						// Popout window div
						var modal = document.getElementById("map-modal");
						//Button that triggers popout event
						var popout_button = document.getElementById("popout");
						// Image that gets displayed in the popout window div.
						var modalImg = document.getElementById("ttc_subwaymap");

						popout_button.onclick = function(){
							modal.style.display = "block";
							modalImg.src = this.name;
						}

						var span = document.getElementsByClassName("close")[0];
						span.onclick = function(){
							modal.style.display = "none";
						}

						document.addEventListener('keydown', function(ev){
							if (ev.key === "Esc" || ev.key === "Escape"){
								modal.style.display = "none";
							}
						})

					</script>
					<a href="#" id="view-file" target="_blank">View File in New Tab</a>
					<a href="#" id="download">View File in Current Tab</a>
				</div>
				<div class="tooltips-box">
						<div id="report-description" style="display:none;"></div>
						<div id="tip">
							<p class="emphasis">Tooltip:&nbsp;</p><p class="description">Use the selection menu above to choose the report you wish to download.
							In case the full name of an option is hidden because it is too long, hovering over the option will display the full name of the option.
							<br>Selecting a report type will display information of the selected report in this box. If additional help is needed, please see the <a href="ttc_download_help.php" target="_blank" style="color: rgb(35,138,218);">Download Instructions Page</a>.</p>
						</div>
				</div>
			</div>
		</div>

		<div id="footer">
			<p class="copyright">©2021 Toronto Transit Commission</p>
		</div>
	</div>
</body>


</html>

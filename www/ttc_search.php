<?php
	$directory = "/var/www/html/";								//Search within this directory
	$grep = $_POST["grep"];								//User input search parameter
	$tokens = explode(" ", $grep);						//Tokenize input into individual strings
	$num_tokens = count($tokens);						//Count number of tokens elements
	$index = 0;											//Used to count number of results	
	$today = date("Ymd");
	$Hour = date("H"); 
	$system=$_POST["system_one"];
	define("LIMIT", 1000);								//Limit number of search results	

	//Returns the filename of the alternate log file due to primary-secondary switchover
	function switchover($file){
		if (strpos($file, "-A-")){ 
			//If previous server was A, switch to B.
			$file = str_replace("-A-", "-B-", $file);
		}
		else{
			if (strpos($file, "-B-")){
				//If previous server was B, switch to A.
				$file = str_replace("-B-", "-A-", $file);
			}
		}
		return $file;
	}
	
	function search($directory, $file, $tokens, $num_tokens, $index)	//Function used to search log files
	{
		if(file_exists($directory.$file)) 
		{
			$stream = fopen($directory.$file,"r");
			$stop_loop = 0;
			while(($line=fgets($stream))!==false && $stop_loop==0)
			{
				for($i=0;$i<$num_tokens;$i++) 
				{
					$b_matched=preg_match("/".$tokens[$i]."/i", $line, $match);		
					if($index>=LIMIT) $stop_loop=1;
					if($b_matched)
					{
						echo substr($line,8)."<br>";
						$index++;
					}
				}
			}
			fclose($stream);
			
		}
		else {
			if (!file_exists($directory.(switchover($file)))){
				echo "<b>Could not find log file ".$file.". Please contact S&TCE.</b><br>";	
			}
		}
		return($index);
	}

	if(strlen($grep)>2)	//Ensure the search parameter is at least 3 characters long
	{	//Perform search using search form, checkboxes and time frames as input		
		echo "<strong>Search:</strong> ".$grep."<br>";
		if(isset($_POST['day_eight']) && $_POST['day_eight']=='true' && $index<LIMIT) for ($i=$_POST['start_eight']; $i<=$_POST['stop_eight']; $i++) $index=search($directory, "ttc_seven_".str_pad($i, 2, 0, STR_PAD_LEFT).".log", $tokens, $num_tokens, $index);
		if(isset($_POST['day_seven']) && $_POST['day_seven']=='true' && $index<LIMIT) for ($i=$_POST['start_seven']; $i<=$_POST['stop_seven']; $i++) $index=search($directory, "ttc_six_".str_pad($i, 2, 0, STR_PAD_LEFT).".log", $tokens, $num_tokens, $index);
		if(isset($_POST['day_six']) && $_POST['day_six']=='true' && $index<LIMIT) for ($i=$_POST['start_six']; $i<=$_POST['stop_six']; $i++) $index=search($directory, "ttc_five_".str_pad($i, 2, 0, STR_PAD_LEFT).".log", $tokens, $num_tokens, $index);
		if(isset($_POST['day_five']) && $_POST['day_five']=='true' && $index<LIMIT) for ($i=$_POST['start_five']; $i<=$_POST['stop_five']; $i++) $index=search($directory, "ttc_four_".str_pad($i, 2, 0, STR_PAD_LEFT).".log", $tokens, $num_tokens, $index);
		if(isset($_POST['day_four']) && $_POST['day_four']=='true' && $index<LIMIT) for ($i=$_POST['start_four']; $i<=$_POST['stop_four']; $i++) $index=search($directory, "ttc_three_".str_pad($i, 2, 0, STR_PAD_LEFT).".log", $tokens, $num_tokens, $index);
		if(isset($_POST['day_three']) && $_POST['day_three']=='true' && $index<LIMIT) for ($i=$_POST['start_three']; $i<=$_POST['stop_three']; $i++) $index=search($directory, "ttc_two_".str_pad($i, 2, 0, STR_PAD_LEFT).".log", $tokens, $num_tokens, $index);
		if(isset($_POST['day_two']) && $_POST['day_two']=='true' && $index<LIMIT) for ($i=$_POST['start_two']; $i<=$_POST['stop_two']; $i++) $index=search($directory, "ttc_one_".str_pad($i, 2, 0, STR_PAD_LEFT).".log", $tokens, $num_tokens, $index);
		if(isset($_POST['day_one']) && $_POST['day_one']=='true' && $index<LIMIT) for ($i=$_POST['start_one']; $i<=$_POST['stop_one'] && $i<= $Hour; $i++) $index=search($directory, "$system-A-$today".str_pad($i, 2, 0, STR_PAD_LEFT).".log", $tokens, $num_tokens, $index);
	  	if(isset($_POST['day_one']) && $_POST['day_one']=='true' && $index<LIMIT) for ($i=$_POST['start_one']; $i<=$_POST['stop_one'] && $i<= $Hour; $i++) $index=search($directory, "$system-B-$today".str_pad($i, 2, 0, STR_PAD_LEFT).".log", $tokens, $num_tokens, $index);
		//If(isset($_POST['day_one']) && $_POST['day_one']=='true' && $i>$Hour) echo  "<b>There is no available data after current hour, please select proper time range.</b><br>";
		if($index==0) echo "<b>No matches found.</b><br>";
		if($index>=LIMIT) echo "<b>Search limited to ".LIMIT." results. Please narrow search parameters.</b><br>";		
	}
	else echo "Please enter three or more characters to narrow the search parameters";
?>

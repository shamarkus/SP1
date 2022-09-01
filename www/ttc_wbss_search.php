<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <meta name="Description" content="CSS/WBSS Alarms Search">
    <meta name="Author" content="Edward" chan?="" w="">
    <link rel="stylesheet" type="text/css" href="ttc_style.css">
    <title>WBSS Search</title>
  </head>
  <body>
    <div id="page-container">
    <?php include(getcwd() . "/ttc_topnav.php"); ?>
    <div class="clear"></div>
      <div class="content-container">
        <div>CSS/WBSS Alarms for the past <span style="font-weight: bold; text-decoration: underline;">seven</span> days can be searched from this site.</div>
        <div>Please see the <a href="ttc_search_help.php" target="_blank" style="color: rgb(35,138,218);">Search Instructions Page</a> for help.</div>
        <script language="JavaScript">
          function mdy(todaysdate){
            var mm = todaysdate.getMonth() + 1;
			var dd = todaysdate.getDate();
			return '<big>' + todaysdate.getFullYear()+ '/' + ((mm>9 ? '' : '0') + mm)+ '/' + ((dd>9 ? '' : '0') + dd) + '</big>';
          }
        </script>
        <div id="search-form">
            <form action="ttc_search.php" method="post">
              <br><h3>Select dates to search:</h3>
               <table>
				  <tbody>
					<tr>
					  <td><h4>Date</h4></td>
					  <td><h4>Start</h4></td>
					  <td><h4>Stop</h4></td>
					  <td><h4>System</h4></td>
					</tr>
					<tr>
					  <td><input name="day_eight"
						  value="true" type="checkbox">
						<script language="JavaScript">
	eightDate=new Date()
	eightDate.setDate(eightDate.getDate() - 7)
	document.write (mdy(eightDate))
	</script></td>
					  <td>
						<select name="start_eight">
						  <option selected="selected"
							value="0">12:00:00 AM</option>
						  <option value="1">1:00:00 AM</option>
						  <option value="2">2:00:00 AM</option>
						  <option value="3">3:00:00 AM</option>
						  <option value="4">4:00:00 AM</option>
						  <option value="5">5:00:00 AM</option>
						  <option value="6">6:00:00 AM</option>
						  <option value="7">7:00:00 AM</option>
						  <option value="8">8:00:00 AM</option>
						  <option value="9">9:00:00 AM</option>
						  <option value="10">10:00:00 AM</option>
						  <option value="11">11:00:00 AM</option>
						  <option value="12">12:00:00 PM</option>
						  <option value="13">1:00:00 PM</option>
						  <option value="14">2:00:00 PM</option>
						  <option value="15">3:00:00 PM</option>
						  <option value="16">4:00:00 PM</option>
						  <option value="17">5:00:00 PM</option>
						  <option value="18">6:00:00 PM</option>
						  <option value="19">7:00:00 PM</option>
						  <option value="20">8:00:00 PM</option>
						  <option value="21">9:00:00 PM</option>
						  <option value="22">10:00:00 PM</option>
						  <option value="23">11:00:00 PM</option>
						</select>
					  </td>
					  <td>
						<select name="stop_eight">
						  <option value="0">12:59:59 AM</option>
						  <option value="1">1:59:59 AM</option>
						  <option value="2">2:59:59 AM</option>
						  <option value="3">3:59:59 AM</option>
						  <option value="4">4:59:59 AM</option>
						  <option value="5">5:59:59 AM</option>
						  <option value="6">6:59:59 AM</option>
						  <option value="7">7:59:59 AM</option>
						  <option value="8">8:59:59 AM</option>
						  <option value="9">9:59:59 AM</option>
						  <option value="10">10:59:59 AM</option>
						  <option value="11">11:59:59 AM</option>
						  <option value="12">12:59:59 PM</option>
						  <option value="13">1:59:59 PM</option>
						  <option value="14">2:59:59 PM</option>
						  <option value="15">3:59:59 PM</option>
						  <option value="16">4:59:59 PM</option>
						  <option value="17">5:59:59 PM</option>
						  <option value="18">6:59:59 PM</option>
						  <option value="19">7:59:59 PM</option>
						  <option value="20">8:59:59 PM</option>
						  <option value="21">9:59:59 PM</option>
						  <option value="22">10:59:59 PM</option>
						  <option selected="selected"
							value="23">11:59:59 PM</option>
						</select>
					  </td>
					</tr>
					<tr>
					  <td><input name="day_seven"
						  value="true" type="checkbox">
						<script language="JavaScript">
	sevenDate=new Date()
	sevenDate.setDate(sevenDate.getDate() - 6)
	document.write (mdy(sevenDate))
	</script></td>
					  <td>
						<select name="start_seven">
						  <option selected="selected"
							value="0">12:00:00 AM</option>
						  <option value="1">1:00:00 AM</option>
						  <option value="2">2:00:00 AM</option>
						  <option value="3">3:00:00 AM</option>
						  <option value="4">4:00:00 AM</option>
						  <option value="5">5:00:00 AM</option>
						  <option value="6">6:00:00 AM</option>
						  <option value="7">7:00:00 AM</option>
						  <option value="8">8:00:00 AM</option>
						  <option value="9">9:00:00 AM</option>
						  <option value="10">10:00:00 AM</option>
						  <option value="11">11:00:00 AM</option>
						  <option value="12">12:00:00 PM</option>
						  <option value="13">1:00:00 PM</option>
						  <option value="14">2:00:00 PM</option>
						  <option value="15">3:00:00 PM</option>
						  <option value="16">4:00:00 PM</option>
						  <option value="17">5:00:00 PM</option>
						  <option value="18">6:00:00 PM</option>
						  <option value="19">7:00:00 PM</option>
						  <option value="20">8:00:00 PM</option>
						  <option value="21">9:00:00 PM</option>
						  <option value="22">10:00:00 PM</option>
						  <option value="23">11:00:00 PM</option>
						</select>
					  </td>
					  <td>
						<select name="stop_seven">
						  <option value="0">12:59:59 AM</option>
						  <option value="1">1:59:59 AM</option>
						  <option value="2">2:59:59 AM</option>
						  <option value="3">3:59:59 AM</option>
						  <option value="4">4:59:59 AM</option>
						  <option value="5">5:59:59 AM</option>
						  <option value="6">6:59:59 AM</option>
						  <option value="7">7:59:59 AM</option>
						  <option value="8">8:59:59 AM</option>
						  <option value="9">9:59:59 AM</option>
						  <option value="10">10:59:59 AM</option>
						  <option value="11">11:59:59 AM</option>
						  <option value="12">12:59:59 PM</option>
						  <option value="13">1:59:59 PM</option>
						  <option value="14">2:59:59 PM</option>
						  <option value="15">3:59:59 PM</option>
						  <option value="16">4:59:59 PM</option>
						  <option value="17">5:59:59 PM</option>
						  <option value="18">6:59:59 PM</option>
						  <option value="19">7:59:59 PM</option>
						  <option value="20">8:59:59 PM</option>
						  <option value="21">9:59:59 PM</option>
						  <option value="22">10:59:59 PM</option>
						  <option selected="selected"
							value="23">11:59:59 PM</option>
						</select>
					  </td>
					</tr>
					<tr>
					  <td><input name="day_six" value="true"
						  type="checkbox">
						<script language="JavaScript">
	sixDate=new Date()
	sixDate.setDate(sixDate.getDate() - 5)
	document.write (mdy(sixDate))
	</script></td>
					  <td>
						<select name="start_six">
						  <option selected="selected"
							value="0">12:00:00 AM</option>
						  <option value="1">1:00:00 AM</option>
						  <option value="2">2:00:00 AM</option>
						  <option value="3">3:00:00 AM</option>
						  <option value="4">4:00:00 AM</option>
						  <option value="5">5:00:00 AM</option>
						  <option value="6">6:00:00 AM</option>
						  <option value="7">7:00:00 AM</option>
						  <option value="8">8:00:00 AM</option>
						  <option value="9">9:00:00 AM</option>
						  <option value="10">10:00:00 AM</option>
						  <option value="11">11:00:00 AM</option>
						  <option value="12">12:00:00 PM</option>
						  <option value="13">1:00:00 PM</option>
						  <option value="14">2:00:00 PM</option>
						  <option value="15">3:00:00 PM</option>
						  <option value="16">4:00:00 PM</option>
						  <option value="17">5:00:00 PM</option>
						  <option value="18">6:00:00 PM</option>
						  <option value="19">7:00:00 PM</option>
						  <option value="20">8:00:00 PM</option>
						  <option value="21">9:00:00 PM</option>
						  <option value="22">10:00:00 PM</option>
						  <option value="23">11:00:00 PM</option>
						</select>
					  </td>
					  <td>
						<select name="stop_six">
						  <option value="0">12:59:59 AM</option>
						  <option value="1">1:59:59 AM</option>
						  <option value="2">2:59:59 AM</option>
						  <option value="3">3:59:59 AM</option>
						  <option value="4">4:59:59 AM</option>
						  <option value="5">5:59:59 AM</option>
						  <option value="6">6:59:59 AM</option>
						  <option value="7">7:59:59 AM</option>
						  <option value="8">8:59:59 AM</option>
						  <option value="9">9:59:59 AM</option>
						  <option value="10">10:59:59 AM</option>
						  <option value="11">11:59:59 AM</option>
						  <option value="12">12:59:59 PM</option>
						  <option value="13">1:59:59 PM</option>
						  <option value="14">2:59:59 PM</option>
						  <option value="15">3:59:59 PM</option>
						  <option value="16">4:59:59 PM</option>
						  <option value="17">5:59:59 PM</option>
						  <option value="18">6:59:59 PM</option>
						  <option value="19">7:59:59 PM</option>
						  <option value="20">8:59:59 PM</option>
						  <option value="21">9:59:59 PM</option>
						  <option value="22">10:59:59 PM</option>
						  <option selected="selected"
							value="23">11:59:59 PM</option>
						</select>
					  </td>
					</tr>
					<tr>
					  <td><input name="day_five"
						  value="true" type="checkbox">
						<script language="JavaScript">
	fiveDate=new Date()
	fiveDate.setDate(fiveDate.getDate() - 4)
	document.write (mdy(fiveDate))
	</script></td>
					  <td>
						<select name="start_five">
						  <option selected="selected"
							value="0">12:00:00 AM</option>
						  <option value="1">1:00:00 AM</option>
						  <option value="2">2:00:00 AM</option>
						  <option value="3">3:00:00 AM</option>
						  <option value="4">4:00:00 AM</option>
						  <option value="5">5:00:00 AM</option>
						  <option value="6">6:00:00 AM</option>
						  <option value="7">7:00:00 AM</option>
						  <option value="8">8:00:00 AM</option>
						  <option value="9">9:00:00 AM</option>
						  <option value="10">10:00:00 AM</option>
						  <option value="11">11:00:00 AM</option>
						  <option value="12">12:00:00 PM</option>
						  <option value="13">1:00:00 PM</option>
						  <option value="14">2:00:00 PM</option>
						  <option value="15">3:00:00 PM</option>
						  <option value="16">4:00:00 PM</option>
						  <option value="17">5:00:00 PM</option>
						  <option value="18">6:00:00 PM</option>
						  <option value="19">7:00:00 PM</option>
						  <option value="20">8:00:00 PM</option>
						  <option value="21">9:00:00 PM</option>
						  <option value="22">10:00:00 PM</option>
						  <option value="23">11:00:00 PM</option>
						</select>
					  </td>
					  <td>
						<select name="stop_five">
						  <option value="0">12:59:59 AM</option>
						  <option value="1">1:59:59 AM</option>
						  <option value="2">2:59:59 AM</option>
						  <option value="3">3:59:59 AM</option>
						  <option value="4">4:59:59 AM</option>
						  <option value="5">5:59:59 AM</option>
						  <option value="6">6:59:59 AM</option>
						  <option value="7">7:59:59 AM</option>
						  <option value="8">8:59:59 AM</option>
						  <option value="9">9:59:59 AM</option>
						  <option value="10">10:59:59 AM</option>
						  <option value="11">11:59:59 AM</option>
						  <option value="12">12:59:59 PM</option>
						  <option value="13">1:59:59 PM</option>
						  <option value="14">2:59:59 PM</option>
						  <option value="15">3:59:59 PM</option>
						  <option value="16">4:59:59 PM</option>
						  <option value="17">5:59:59 PM</option>
						  <option value="18">6:59:59 PM</option>
						  <option value="19">7:59:59 PM</option>
						  <option value="20">8:59:59 PM</option>
						  <option value="21">9:59:59 PM</option>
						  <option value="22">10:59:59 PM</option>
						  <option selected="selected"
							value="23">11:59:59 PM</option>
						</select>
					  </td>
					</tr>
					<tr>
					  <td><input name="day_four"
						  value="true" type="checkbox">
						<script language="JavaScript">
	fourDate=new Date()
	fourDate.setDate(fourDate.getDate() - 3)
	document.write (mdy(fourDate))
	</script></td>
					  <td>
						<select name="start_four">
						  <option selected="selected"
							value="0">12:00:00 AM</option>
						  <option value="1">1:00:00 AM</option>
						  <option value="2">2:00:00 AM</option>
						  <option value="3">3:00:00 AM</option>
						  <option value="4">4:00:00 AM</option>
						  <option value="5">5:00:00 AM</option>
						  <option value="6">6:00:00 AM</option>
						  <option value="7">7:00:00 AM</option>
						  <option value="8">8:00:00 AM</option>
						  <option value="9">9:00:00 AM</option>
						  <option value="10">10:00:00 AM</option>
						  <option value="11">11:00:00 AM</option>
						  <option value="12">12:00:00 PM</option>
						  <option value="13">1:00:00 PM</option>
						  <option value="14">2:00:00 PM</option>
						  <option value="15">3:00:00 PM</option>
						  <option value="16">4:00:00 PM</option>
						  <option value="17">5:00:00 PM</option>
						  <option value="18">6:00:00 PM</option>
						  <option value="19">7:00:00 PM</option>
						  <option value="20">8:00:00 PM</option>
						  <option value="21">9:00:00 PM</option>
						  <option value="22">10:00:00 PM</option>
						  <option value="23">11:00:00 PM</option>
						</select>
					  </td>
					  <td>
						<select name="stop_four">
						  <option value="0">12:59:59 AM</option>
						  <option value="1">1:59:59 AM</option>
						  <option value="2">2:59:59 AM</option>
						  <option value="3">3:59:59 AM</option>
						  <option value="4">4:59:59 AM</option>
						  <option value="5">5:59:59 AM</option>
						  <option value="6">6:59:59 AM</option>
						  <option value="7">7:59:59 AM</option>
						  <option value="8">8:59:59 AM</option>
						  <option value="9">9:59:59 AM</option>
						  <option value="10">10:59:59 AM</option>
						  <option value="11">11:59:59 AM</option>
						  <option value="12">12:59:59 PM</option>
						  <option value="13">1:59:59 PM</option>
						  <option value="14">2:59:59 PM</option>
						  <option value="15">3:59:59 PM</option>
						  <option value="16">4:59:59 PM</option>
						  <option value="17">5:59:59 PM</option>
						  <option value="18">6:59:59 PM</option>
						  <option value="19">7:59:59 PM</option>
						  <option value="20">8:59:59 PM</option>
						  <option value="21">9:59:59 PM</option>
						  <option value="22">10:59:59 PM</option>
						  <option selected="selected"
							value="23">11:59:59 PM</option>
						</select>
					  </td>
					</tr>
					<tr>
					  <td><input name="day_three"
						  value="true" type="checkbox">
						<script language="JavaScript">
	threeDate=new Date()
	threeDate.setDate(threeDate.getDate() - 2)
	document.write (mdy(threeDate))
	</script></td>
					  <td>
						<select name="start_three">
						  <option selected="selected"
							value="0">12:00:00 AM</option>
						  <option value="1">1:00:00 AM</option>
						  <option value="2">2:00:00 AM</option>
						  <option value="3">3:00:00 AM</option>
						  <option value="4">4:00:00 AM</option>
						  <option value="5">5:00:00 AM</option>
						  <option value="6">6:00:00 AM</option>
						  <option value="7">7:00:00 AM</option>
						  <option value="8">8:00:00 AM</option>
						  <option value="9">9:00:00 AM</option>
						  <option value="10">10:00:00 AM</option>
						  <option value="11">11:00:00 AM</option>
						  <option value="12">12:00:00 PM</option>
						  <option value="13">1:00:00 PM</option>
						  <option value="14">2:00:00 PM</option>
						  <option value="15">3:00:00 PM</option>
						  <option value="16">4:00:00 PM</option>
						  <option value="17">5:00:00 PM</option>
						  <option value="18">6:00:00 PM</option>
						  <option value="19">7:00:00 PM</option>
						  <option value="20">8:00:00 PM</option>
						  <option value="21">9:00:00 PM</option>
						  <option value="22">10:00:00 PM</option>
						  <option value="23">11:00:00 PM</option>
						</select>
					  </td>
					  <td>
						<select name="stop_three">
						  <option value="0">12:59:59 AM</option>
						  <option value="1">1:59:59 AM</option>
						  <option value="2">2:59:59 AM</option>
						  <option value="3">3:59:59 AM</option>
						  <option value="4">4:59:59 AM</option>
						  <option value="5">5:59:59 AM</option>
						  <option value="6">6:59:59 AM</option>
						  <option value="7">7:59:59 AM</option>
						  <option value="8">8:59:59 AM</option>
						  <option value="9">9:59:59 AM</option>
						  <option value="10">10:59:59 AM</option>
						  <option value="11">11:59:59 AM</option>
						  <option value="12">12:59:59 PM</option>
						  <option value="13">1:59:59 PM</option>
						  <option value="14">2:59:59 PM</option>
						  <option value="15">3:59:59 PM</option>
						  <option value="16">4:59:59 PM</option>
						  <option value="17">5:59:59 PM</option>
						  <option value="18">6:59:59 PM</option>
						  <option value="19">7:59:59 PM</option>
						  <option value="20">8:59:59 PM</option>
						  <option value="21">9:59:59 PM</option>
						  <option value="22">10:59:59 PM</option>
						  <option selected="selected"
							value="23">11:59:59 PM</option>
						</select>
					  </td>
					</tr>
					<tr>
					  <td><input name="day_two" value="true"
						  type="checkbox">
						<script language="JavaScript">
	twoDate=new Date()
	twoDate.setDate(twoDate.getDate() - 1)
	document.write (mdy(twoDate))
	</script></td>
					  <td>
						<select name="start_two">
						  <option selected="selected"
							value="0">12:00:00 AM</option>
						  <option value="1">1:00:00 AM</option>
						  <option value="2">2:00:00 AM</option>
						  <option value="3">3:00:00 AM</option>
						  <option value="4">4:00:00 AM</option>
						  <option value="5">5:00:00 AM</option>
						  <option value="6">6:00:00 AM</option>
						  <option value="7">7:00:00 AM</option>
						  <option value="8">8:00:00 AM</option>
						  <option value="9">9:00:00 AM</option>
						  <option value="10">10:00:00 AM</option>
						  <option value="11">11:00:00 AM</option>
						  <option value="12">12:00:00 PM</option>
						  <option value="13">1:00:00 PM</option>
						  <option value="14">2:00:00 PM</option>
						  <option value="15">3:00:00 PM</option>
						  <option value="16">4:00:00 PM</option>
						  <option value="17">5:00:00 PM</option>
						  <option value="18">6:00:00 PM</option>
						  <option value="19">7:00:00 PM</option>
						  <option value="20">8:00:00 PM</option>
						  <option value="21">9:00:00 PM</option>
						  <option value="22">10:00:00 PM</option>
						  <option value="23">11:00:00 PM</option>
						</select>
					  </td>
					  <td>
						<select name="stop_two">
						  <option value="0">12:59:59 AM</option>
						  <option value="1">1:59:59 AM</option>
						  <option value="2">2:59:59 AM</option>
						  <option value="3">3:59:59 AM</option>
						  <option value="4">4:59:59 AM</option>
						  <option value="5">5:59:59 AM</option>
						  <option value="6">6:59:59 AM</option>
						  <option value="7">7:59:59 AM</option>
						  <option value="8">8:59:59 AM</option>
						  <option value="9">9:59:59 AM</option>
						  <option value="10">10:59:59 AM</option>
						  <option value="11">11:59:59 AM</option>
						  <option value="12">12:59:59 PM</option>
						  <option value="13">1:59:59 PM</option>
						  <option value="14">2:59:59 PM</option>
						  <option value="15">3:59:59 PM</option>
						  <option value="16">4:59:59 PM</option>
						  <option value="17">5:59:59 PM</option>
						  <option value="18">6:59:59 PM</option>
						  <option value="19">7:59:59 PM</option>
						  <option value="20">8:59:59 PM</option>
						  <option value="21">9:59:59 PM</option>
						  <option value="22">10:59:59 PM</option>
						  <option selected="selected"
							value="23">11:59:59 PM</option>
						</select>
					  </td>
					</tr>
					<tr>
					  <td><input name="day_one" value="true"
						  type="checkbox">
						<script language="JavaScript">
	oneDate=new Date()
	oneDate.setDate(oneDate.getDate() - 0)
	document.write (mdy(oneDate))
	</script></td>
					  <td>
						<select name="start_one">
						  <option selected="selected"
							value="0">12:00:00 AM</option>
						  <option value="1">1:00:00 AM</option>
						  <option value="2">2:00:00 AM</option>
						  <option value="3">3:00:00 AM</option>
						  <option value="4">4:00:00 AM</option>
						  <option value="5">5:00:00 AM</option>
						  <option value="6">6:00:00 AM</option>
						  <option value="7">7:00:00 AM</option>
						  <option value="8">8:00:00 AM</option>
						  <option value="9">9:00:00 AM</option>
						  <option value="10">10:00:00 AM</option>
						  <option value="11">11:00:00 AM</option>
						  <option value="12">12:00:00 PM</option>
						  <option value="13">1:00:00 PM</option>
						  <option value="14">2:00:00 PM</option>
						  <option value="15">3:00:00 PM</option>
						  <option value="16">4:00:00 PM</option>
						  <option value="17">5:00:00 PM</option>
						  <option value="18">6:00:00 PM</option>
						  <option value="19">7:00:00 PM</option>
						  <option value="20">8:00:00 PM</option>
						  <option value="21">9:00:00 PM</option>
						  <option value="22">10:00:00 PM</option>
						  <option value="23">11:00:00 PM</option>
						</select>
					  </td>
					  <td>
						<select name="stop_one">
						  <option value="0">12:59:59 AM</option>
						  <option value="1">1:59:59 AM</option>
						  <option value="2">2:59:59 AM</option>
						  <option value="3">3:59:59 AM</option>
						  <option value="4">4:59:59 AM</option>
						  <option value="5">5:59:59 AM</option>
						  <option value="6">6:59:59 AM</option>
						  <option value="7">7:59:59 AM</option>
						  <option value="8">8:59:59 AM</option>
						  <option value="9">9:59:59 AM</option>
						  <option value="10">10:59:59 AM</option>
						  <option value="11">11:59:59 AM</option>
						  <option value="12">12:59:59 PM</option>
						  <option value="13">1:59:59 PM</option>
						  <option value="14">2:59:59 PM</option>
						  <option value="15">3:59:59 PM</option>
						  <option value="16">4:59:59 PM</option>
						  <option value="17">5:59:59 PM</option>
						  <option value="18">6:59:59 PM</option>
						  <option value="19">7:59:59 PM</option>
						  <option value="20">8:59:59 PM</option>
						  <option value="21">9:59:59 PM</option>
						  <option value="22">10:59:59 PM</option>
						  <option selected="selected"
							value="23">11:59:59 PM</option>
						</select>
					  </td>
					  <td>
						<select name="system_one">
						  <option selected="selected"  
						  <option value="bds-TCS">BDS</option>
						  <option value="atc-TCS">ATC</option>
						  <option value="yus-TCS">YUS</option>
					  <td>
					</tr>
				  </tbody>
				</table>
				<h3 style="float:left;">Search:<h3> <input name="grep" type="text">
            
            <input value="Search" type="submit"><br>
          </form>
        </div>
      </div>
      <div id="footer">
        <p class="copyright">©2019 Toronto Transit Commission</p>
      </div>
    </div>
  </body>
</html>

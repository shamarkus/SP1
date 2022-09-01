<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <meta name="Description" content="CSS/WBSS Alarms Search Instructions">
    <meta name="Author" content="Edward" chan?="" w="">
    <link rel="stylesheet" type="text/css" href="ttc_style.css">
    <title>Search</title>
  </head>
  <body>
    <div id="page-container">
    <?php include(getcwd() . "/ttc_topnav.php"); ?>
    <div class="clear"></div>
      <div class="content-container">
							<h1>Custom Search</h1><br>
							<b>Description:</b> This tool allows the user to search log files from the past seven days. <br><br>
							<b>Instructions:</b>
							<li>Select the checkboxes next to the dates to be searched
							<li>Set the time frame for that day
							<li>Input the search parameter in the search box and click Search
							<li>Results may take a few moments to appear<br><br>
							<b>Search rules:</b>
							<li>The tool will search every line of the log files for a match
							<li>The search parameter will be matched even if it is not a complete word or code
							<li>The search tool is not case sensitive
							<li>The search must contain at least three characters
							<li>More than one search term may be used, and only the lines containing all search terms will be returned
							<li>Searches will be limited to a maximum of 1000 results.<br><br>
							<b>Example search terms:</b><br>
							<li>train detection failure<br>
							<li>critical detection failure<br>
							<li>passed signal<br>
							<li>track failure<br>
							<li>user<br>
							<li>ttc3<br>
							<li>ttc4<br>
							<li>ttc23<br>
							<li>ttc24<br>
							<li> out of correspondence<br><br>
							<b>Variable Messages:</b> Some message types will vary according to the location, so a static search is not
							useful. In these instances, the user may input <i>regular expressions</i>. Regular expressions are codes that
							represent variable entries.<br>Use the following rules for regular expressions:<br>
							<table>
							<tr><td>(abc)<td>The exact phrase abc</tr>
							<tr><td>[abc]<td>A single character of a, b or c</tr>
							<tr><td>[^abc]<td>A single character except a, b or c</tr>
							<tr><td>[a-z]<td>Any single character in the range a-z</tr>
							<tr><td>(a|b)<td>a or b</tr>
							<tr><td>a?<td>Zero or one instance of a</tr>
							<tr><td>a*<td>Zero or more instances of a</tr>
							<tr><td>a+<td>One or more instances of a</tr>
							<tr><td>a{3}<td>Exactly three instances of a</tr>
							<tr><td>a{3,}<td>Three or more instances of a</tr>
							<tr><td>a{3,6}<td>Between three and six instances of a</tr>
							<tr><td>.<td>Any single character</tr>
							<tr><td>\s<td>Space</tr>
							<tr><td>\d<td>Any digit</tr>
							</table><br>
							<i>Power Alarm example:</i><br><br>
							Determine the regular expression for the power alarm message (ex. SDVVPO2)<br><br>
							The message is in the format of four letters followed by the letters PO followed
							by an optional number. The regular expression for this is:<br>
							<code>\s[a-z]{4}(po)\d?\s</code>
							A search using this parameter will display all power alarm messages.<br><br>
							</big></big></p>
          </div>
        <div id="footer">
          <p class="copyright">©2019 Toronto Transit Commission</p>
        </div>
      </div>
  </body>
</html>

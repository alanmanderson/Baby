<html>

<head>
	<link rel="stylesheet" type="text/css" href="main.css" />
  <title>Luke Alan Anderson!!!</title>
  <script type="text/javascript" src="jquery.js"></script>
	<script type="text/javascript" src="json2.js"></script>
	<script type="text/javascript" src="jquery-1.4.2.js"></script>
  <script type="text/javascript" src="jquery.label_over.js"></script>
	<script type="text/javascript">
		$(function() {
				$("#mode").click(function() {
					alert("test");
					var mode = $('#mode').val();
					var url = "start.php?mode=" + mode;
					location.href = url;
				});
			})
			
		function StartEvent(eventID){
			var id = document.getElementsByName("UserID")[0].value;
			var url = "Log.php?mode=newEvent&eventID="+eventID+"&UserID="+id;
			location.href=url;
		}

		function StopEvent(eventID){
			var id = document.getElementsByName("UserID")[0].value;
			var url = "Log.php?mode=stopEvent&eventID="+eventID+"&UserID="+id;
			location.href=url;
		}		
	</script>
</head>
<body>
	<form>
		<?php
			$mydb = mysql_connect("Localhost", "alanmand_user1", "daBrav3s") or die(mysql_error());
			mysql_select_db("alanmand_baby") or die(mysql_error());
			function drawTable($results){
				echo "<table><th>event</th><th>start</th><th>end</th><th>duration</th>";
				$totDur = 0;
				$totCount = 0;
				while($row=mysql_fetch_array($results)){
					echo("<tr><td>");
					echo($row["Name"]);
					echo("</td><td>");
					echo($row["Start"]);
					echo("</td>");
					$totCount++;
					if ($row['hasDuration']==1){
						$start = strtotime($row['Start']);
						$End = strtotime($row['End']);
						$duration = $End - $start;
						$duration = round($duration/60,2);
						$totDur+=$duration;
						echo ("<td>");
						echo($row["End"]);
						echo("</td><td>");
						echo $duration;
						echo("</td>");
					}
					echo("</tr>");
				}
				echo("<tr><th>Time</th><td>$totDur</td><th>Quantity</th><td>$totCount</td></tr>");
				echo "</table>";
			}
			
			$sql = "SELECT * FROM EventTypes";
			$result = mysql_query($sql) or die(sql_error());
			while($row=mysql_fetch_array($result)){
				$name=$row["Name"];
				$id=$row["ID"];
				if ($row['hasDuration']==1){
				        echo "<table><tr><td>";
					echo("<input type=\"button\" value=\"start $name\" name=$name onclick=\"StartEvent($id)\"/>");
					echo "</td><td>";
					echo("<input type=\"button\" value=\"stop $name\" name=$name onclick=\"StopEvent($id)\"/>");
					echo "</td></tr></table>";
				} else{
					echo("<input type=\"button\" value=\"$name\" name=$name onclick=\"StartEvent($id)\"/>");
				}
				$sql="SELECT * FROM Log INNER JOIN EventTypes ON EventTypes.ID = Log.EventID WHERE Log.EventID=$id";
				$events = mysql_query($sql) or die(sql_error());
				drawTable($events);
			}
		
		?>
		<input type="hidden" value="1" name="UserID"/>
<!--		<table id="contractions">
			<th>Start</th><th>End</th><th>Duration</th><th>Since Last Contraction</th>
			<?php
				#$mydb = mysql_connect("sql.mit.edu", "alanma", "daBrav3s") or die(mysql_error());
				#mysql_select_db("alanma+C") or die(mysql_error());
				
				#$sql="SELECT * FROM c";
				#$result = mysql_query($sql);
				#while($row=mysql_fetch_array($result)){
					#echo("<tr><td>");
					#echo($row['Start']);
					#echo("</td><td>");
					#echo($row['End']);
					#echo("</td></tr>");
				#}
			?>
		</table> -->
	</form>
</body>

</html>
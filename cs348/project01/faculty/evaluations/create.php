<?php include "../../include/config.php"; ?>
<?php include "../../include/header.php"; ?>
<?php

	$result = mysql_query("SELECT * FROM Faculties WHERE FacultyID='" . $_GET['FacultyID'] . "'");
	$faculty = mysql_fetch_array($result);

	if (empty($_POST) == false)
	{
		$result = mysql_query("INSERT INTO CourseEvaluations (CourseID, EvaluationName, Type, Weightage, DeadlineDate, MeetingRoom) VALUES ('" . $_POST['CourseID'] . "', '" . $_POST['EvaluationName'] . "', '" . $_POST['Type'] . "', '" . $_POST['Weightage'] . "', '" . $_POST['DeadlineDate'] . "', '" . $_POST['MeetingRoom'] . "')");

		header("Location: " . $RootDirectory . "faculty/evaluations?FacultyID=" . $faculty['FacultyID']);
		exit;
	}

	$result = mysql_query("SELECT * FROM Courses WHERE FacultyID='" . $faculty['FacultyID'] . "'");
	while($row = mysql_fetch_array($result))
	{
		$CourseID .= "<option value='" . $row['CourseID'] . "'>" . $row['CourseName'] . "</option>\n";
	}

?>
<p>Hello <?=$faculty['Name']?> (Faculty). You are currently creating a course evaluation:<p>
<form action="create.php?FacultyID=<?=$faculty['FacultyID']?>" method="post">
	<table cellpadding="0" cellspacing="0">
		<tr>
			<td><b>Course: </b></td>
			<td><select name="CourseID"><?=$CourseID?></select></td>
		</tr>
		<tr>
			<td><b>Name: </b></td>
			<td><input name="EvaluationName" type="text" /></td>
		</tr>
		<tr>
			<td><b>Type: </b></td>
			<td><select name="Type">
				<option value="0">Homework</option>
				<option value="1">Midterm</option>
				<option value="2">Final Exam</option>
				<option value="3">Project</option>
				</select></td>
		</tr>
		<tr>
			<td><b>Weightage: </b></td>
			<td><input name="Weightage" type="text" /></td>
		</tr>
		<tr>
			<td><b>Deadline Date: </b></td>
			<td><input name="DeadlineDate" type="text" /></td>
		</tr>
		<tr>
			<td><b>Meeting Room: </b></td>
			<td><input name="MeetingRoom" type="text" /></td>
		</tr>
	</table>
	<br />
	<input type="submit" value="Create Evaluation" />
</form>
<div class="home">
	<a href="<?=$RootDirectory?>faculty?FacultyID=<?=$faculty['FacultyID']?>">Click here to return to the menu</a>
</div>
<?php include "../../include/footer.php"; ?>
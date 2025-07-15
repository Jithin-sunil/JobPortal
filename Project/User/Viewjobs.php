<?php
 include("../Assets/Connection/Connection.php");
?>

<!DOCTYPE html
  PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>View Jobs</title>
</head>

<body>
  <div align="center">
    <form action="" method="post">
      <table width="300" border="1">
        <tr>
          <td>Job Type</td>
          <td><label for="sel_type2"></label>
            <select name="sel_type" id="sel_type" onchange="searchjob()">
              <option value="">-select-</option>
              <?php
		$selQry = "select * from tbl_jobtype where jobtype_status=0 ORDER BY jobtype_name ASC";
		$row=$Con->query($selQry);
			   while($data=$row->fetch_assoc())
			   {
		?>
              <option value="<?php echo $data['jobtype_id']?>">
                <?php echo $data['jobtype_name']?>
              </option>

              <?php
	    }
		?>
            </select>
          </td>
          <td>Category</td>
          <td><label for="sel_category"></label>
            <select name="sel_category" id="sel_category" onchange="searchjob()">
              <option value="">-select-</option>
              <?php
		$selQry = "select * from tbl_category where category_status=0 ORDER BY category_name ASC";
		$row=$Con->query($selQry);
			   while($data=$row->fetch_assoc())
			   {
		?>
              <option value="<?php echo $data['category_id']?>">
                <?php echo $data['category_name']?>
              </option>

              <?php
	    }
		?>

            </select>
          </td>
        </tr>

      </table>
    </form>


    <div id="result">
    <table width="650" border="1">
    <tr>
      <td>Sl.No</td>
      <td>Title</td>
      <td>Content</td>
      <td>Experience</td>
      <td>Job Type</td>
      <td>Job Category</td>
      <td>Last Date</td>
      <td>Action</td>
    </tr>
    <?php
    $i=0;
    $selQry = "SELECT * FROM tbl_jobpost p 
               INNER JOIN tbl_jobtype t ON p.jobtype_id = t.jobtype_id 
               INNER JOIN tbl_category c ON p.category_id = c.category_id 
               WHERE jobpost_status=0 
               ORDER BY jobpost_date ASC";
    $row = $Con->query($selQry); 
    while($data=$row->fetch_assoc()) {
      $i++;
    ?>
    <tr>
      <td><?php echo $i?></td>
      <td><?php echo $data['jobpost_title']?></td>
      <td><?php echo $data['jobpost_content']?></td>
      <td><?php echo $data['jobpost_experience']?></td>
      <td><?php echo $data['jobtype_name']?></td>
      <td><?php echo $data['category_name']?></td>
      <td><?php echo $data['jobpost_lastdate']?></td>
      <td>
        <a href="Viewmore.php?eid=<?php echo $data['jobpost_id']?>">Viewmore</a><br>
        <a href="Application.php?eid=<?php echo $data['jobpost_id']?>">Add Application</a>
      </td>
    </tr>
    <?php } ?>
  </table>
</div>

  </div>
</body>

</html>

<script src="../Assets/JQ/jQuery.js"></script>
<script>
  function searchjob() {
    var type = document.getElementById("sel_type").value;
    var category = document.getElementById("sel_category").value;

    $.ajax({
      url: "../Assets/AjaxPages/AjaxSearch.php?type=" + type + "&category=" + category,
      success: function (result) {

        $("#result").html(result);
      }
    });
  }


</script>
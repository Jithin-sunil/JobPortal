<?php
include("../Connection/Connection.php");

$type = $_GET['type'];
$category = $_GET['category'];

$where = " WHERE jobpost_status=0";

if ($type != "") {
  $where .= " AND p.jobtype_id = '$type'";
}

if ($category != "") {
  $where .= " AND p.category_id = '$category'";
}

$selQry = "SELECT * FROM tbl_jobpost p 
           INNER JOIN tbl_jobtype t ON p.jobtype_id = t.jobtype_id 
           INNER JOIN tbl_category c ON p.category_id = c.category_id 
           $where ORDER BY jobpost_date ASC";

$row = $Con->query($selQry);

$i = 0;

if ($row->num_rows > 0) {
?>
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
  while($data = $row->fetch_assoc()) {
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
<?php
} else {
  echo "<h4 style='color:red; text-align:center;'>No data found</h4>";
}
?>

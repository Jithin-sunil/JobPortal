 <option value="">-select district-</option>
          <?php
		  include("../Connection/Connection.php");
		  $selQry="select * from tbl_district where district_status=0 and state_id='".$_GET['sid']."'";
		  $row=$Con->query($selQry);
		  while($data=$row->fetch_assoc())
		  {
		  ?>
          <option value="<?php echo $data['district_id']?>"><?php echo $data['district_name']?></option>
          <?php
		  }
		  ?>
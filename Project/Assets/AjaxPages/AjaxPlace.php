 <option value="">-select place-</option>
          <?php
		  include("../Connection/Connection.php");
		  $selQry="select * from tbl_place where place_status=0 and district_id='".$_GET['pid']."'" ;
		  $row=$Con->query($selQry);
		  while($data=$row->fetch_assoc())
		  {
		  ?>
          <option value="<?php echo $data['place_id']?>"><?php echo $data['place_name']?></option>
          <?php
		  }
		  ?>
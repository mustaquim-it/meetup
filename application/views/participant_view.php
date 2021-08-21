<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Pagination with Search Filter in CodeIgniter 3</title>
  
    <style type="text/css">

	::selection { background-color: #E13300; color: white; }
	::-moz-selection { background-color: #E13300; color: white; }

	body {
		background-color: #fff;
		margin: 40px;
		font: 13px/20px normal Helvetica, Arial, sans-serif;
		color: #4F5155;
	}

	a {
		color: #003399;
		background-color: transparent;
		font-weight: normal;
        padding: 5px;
	}

    td{
        text-align: center;
    }
	h1 {
		color: #444;
		background-color: transparent;
		border-bottom: 1px solid #D0D0D0;
		font-size: 19px;
		font-weight: normal;
		margin: 0 0 14px 0;
		padding: 14px 15px 10px 15px;
	}

	code {
		font-family: Consolas, Monaco, Courier New, Courier, monospace;
		font-size: 12px;
		background-color: #f9f9f9;
		border: 1px solid #D0D0D0;
		color: #002166;
		display: block;
		margin: 14px 0 14px 0;
		padding: 12px 10px 12px 10px;
	}

	#body {
		margin: 0 15px 0 15px;
	}

	p.footer {
		text-align: right;
		font-size: 11px;
		border-top: 1px solid #D0D0D0;
		line-height: 32px;
		padding: 0 10px 0 10px;
		margin: 20px 0 0 0;
	}

	#container {
		margin: 10px;
		border: 1px solid #D0D0D0;
		box-shadow: 0 0 8px #D0D0D0;
	}
	</style>
  </head>
  <body>
  <div id="container">
    <!-- Search form (start) -->
    <form method='post' action="<?= $search_url; ?>" >
        <input type='text' name='search' value='<?= $search ?>'><input type='submit' name='submit' value='Submit'>
        <input type='button' name='submit' value='Reset' onclick="location.href='<?php echo base_url();?>Participant'">
    </form>
    <br/>

    <!-- Posts List -->
    <div id="body">
        <table border='1' width='100%' style='border-collapse: collapse;'>
            <tr>
                <th>S.no</th>
                <th>Name</th>
                <th>Age</th>
                <th>DOB</th>
                <th>Profession</th>
                <th>Locality</th>
                <th>Guests</th>
                <th>Address</th>
                <th>Created at</th>
            </tr>
            <?php 
            $sno = $row+1;
            foreach($result as $data){
                echo "<tr>";
                echo "<td>".$sno."</td>";
                echo "<td>".$data['name']."</td>";
                echo "<td>".$data['age']."</td>";
                echo "<td>".$data['dob']."</td>";
                echo "<td>".$data['profession']."</td>";
                echo "<td>".$data['locality']."</td>";
                echo "<td>".$data['guests']."</td>";
                echo "<td>".$data['address']."</td>";
                echo "<td>".$data['created_at']."</td>";
                echo "</tr>";
                $sno++;
            }
            if(count($result) == 0){
                echo "<tr>";
                echo "<td colspan='3'>No record found.</td>";
                echo "</tr>";
            }
            ?>
        </table>

        <!-- Paginate -->
        <div style='margin-top: 10px;'>
            <?= $pagination; ?>
        </div>
    </div>
  </div>
 </body>
</html>
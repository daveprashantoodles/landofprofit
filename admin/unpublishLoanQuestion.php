<?php
include_once("db_connect.php");
$res['code'] ="400";
$res["msg"] = "Aw,something went wrong.Please try again."; 
if(isset($_POST["id"]))
{
	if(count($_POST["id"])>0)
	{
		$ids = implode(",",$_POST["id"]);
		$sql = "update loanQuestions set publish = 0 WHERE id IN ({$ids}) ";
		$query = mysqli_query($con,$sql);
		if($query)
		{			
			$res['code'] ="200";
			$res["msg"] = "Records are Unpublished.";
		}		
	}
}

header("content-Type:application/json");
echo json_encode($res);exit;
?>
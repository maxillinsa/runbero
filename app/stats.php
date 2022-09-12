<?php 

$totearn=0;
$totdeduct=0;
if($role=="admin" || $role=="payrollofficer"){
$qst= "select sum(amount) amt from tblrunlogitems,tblrunlog,tblpayroll where tblrunlog.id=logid and tblrunlog.approved='Y' and creditdebit='C'
and payroll=tblpayroll.id and tblpayroll.compid=$compid";
//echo $qst;exit;
$totearn=returnQueryValue($qst,"amt");
//echo $totpaid;exit;

$qst= "select sum(amount) amt from tblrunlogitems,tblrunlog,tblpayroll where tblrunlog.id=logid and tblrunlog.approved='Y' and creditdebit='D'
and payroll=tblpayroll.id and tblpayroll.compid=$compid";
//echo $qst;exit;
$totdeduct=returnQueryValue($qst,"amt");


$qstup= "select sum(amount) amt from tblrunlogitemsup,tblrunlogup,tblpayroll where tblrunlogup.id=logid and tblrunlogup.approved='Y' and creditdebit='C'
and payroll=tblpayroll.id and tblpayroll.compid=$compid";
//echo $qstup;
$totupfront=returnQueryValue($qstup,"amt");

}else{
	$usemail=returnQueryValue("select email from tblusers where id=$curuserid","email");
	
	
				$usempid=returnQueryValue("select id from tblemployee where email='$usemail'","id");
				
	
	$qst= "select sum(amount) amt from tblrunlogitems,tblrunlog,tblpayroll where tblrunlog.id=logid and tblrunlog.approved='Y' and creditdebit='C'
and payroll=tblpayroll.id and tblpayroll.compid=$compid and tblrunlogitems.empid=$usempid";
//echo $qst;
$totearn=returnQueryValue($qst,"amt");
//echo $totpaid;exit;

$qst= "select sum(amount) amt from tblrunlogitems,tblrunlog,tblpayroll where tblrunlog.id=logid and tblrunlog.approved='Y' and creditdebit='D'
and payroll=tblpayroll.id and tblpayroll.compid=$compid and tblrunlogitems.empid=$curuserid";
//echo $qst;exit;
$totdeduct=returnQueryValue($qst,"amt");

$qstup= "select sum(amount) amt from tblrunlogitemsup,tblrunlogup,tblpayroll where tblrunlogup.id=logid and tblrunlogup.approved='Y' and creditdebit='C'
and payroll=tblpayroll.id and tblpayroll.compid=$compid and tblrunlogitemsup.empid=$curuserid";
//echo $qst;exit;
$totupfront=returnQueryValue($qstup,"amt");
}
$netpayout=$totearn-$totdeduct;

?>
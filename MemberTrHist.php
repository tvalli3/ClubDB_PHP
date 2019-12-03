<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>ClubDB</title>
    </head>
    <body>
        <h1>Member Transaction History</h1>
        
        <?php
            $memberid = "";
            //$memberid = (int) $_GET['memberid'];
            $memberid = $_GET['memberid'];
            if ($memberid != "") {                
                require_once ('dbtest.php');
                //echo '<p>Branch = ' .$memberid. ' returned.</p>';
                $query = "SELECT * FROM tblMembers WHERE MemID = '$memberid' ";
                $r = mysqli_query($dbc, $query);
                if (mysqli_num_rows($r) > 0) {
                    $row = mysqli_fetch_array($r);
                    echo "<p>Member ID: " .$row['MemID']. " & '$memberid'<br>";
                    echo "Member Name: " .$row['LastName']. ', ' .$row[FirstName]. 
                            ' ' .$row[MiddleName]."<br>";
                    echo "Member Joined: " .$row['MemDt']. "<br>";
                    echo "Member Status: " .$row['Status']. "<br></p>";
                } else {
                    echo "<p>Member not on file</p>";
                }
                //table
                
                echo "<table border='1'>";
                echo "<caption>Transaction History</caption>";
                echo "<tr>";
                echo "<th>Purchase Dt</th>";
                echo "<th>Trans Cd</th>";
                echo "<th>Trans Desc</th>";
                echo "<th>Trans Type</th>";
                echo "<th>Amount</th>";
                echo "</tr>";
                $query2 = "SELECT p.MemId, p.PurchaseDt, p.TransCd, c.TransDesc, p.TransType, p.Amount 
                            FROM tblpurchases p, tblcodes c 
                            WHERE p.TransCd = c.TransCd AND p.MemId = '$memberid' 
                            ORDER BY p.MemId, p.PurchaseDt, p.TransCd ";
                $r2 = mysqli_query($dbc, $query2);
                while ($row = mysqli_fetch_array($r2)) {
                    echo "<tr>";
                    echo "<td>" .$row['PurchaseDt']. "</td>";
                    echo "<td>" .$row['TransCd']. "</td>";
                    echo "<td>" .$row['TransDesc']. "</td>";
                    echo "<td>" .$row['TransType']. "</td>";
                    //setlocale(LC_MONETARY,"en_US");
                    //$amount = money_format("%n", $row['Amount']); 
                    //$amount = $row['Amount']; 
                    echo "<td align=right>" .sprintf('$%01.2f', $row['Amount']). "</td>";
                    echo "</tr>";
                    
                }
                echo "</table";

                
            } else {
                echo '<p>No member ID from form found.</p>';
                echo '<p>Requested Member ID is "$memberid"</p>';
            }
        ?>
    </body>
</html>

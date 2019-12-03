<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>ClubDB</title>
    </head>
    <body>
        <script type="text/javascript" src="ajax.js"></script>
        <script type="text/javascript" src="Club.js"></script>
        <h1>Club Member Purchases Review</h1>
        <p>Select a member and click go to see transactions for that member.</p>
        <br>
        <form id="MemberForm" action="MemberTrHist.php" method="get">
            
            
        <?php
            require_once ('dbtest.php');
            $query = "SELECT * FROM tblMembers ORDER BY LastName, FirstName, MiddleName ";
            $r = mysqli_query($dbc,$query);
            if (mysqli_num_rows($r) > 0) {
                echo '<select id="memberid" name="memberid">';
                while ($row = mysqli_fetch_array($r)) {
                    echo '<option value="' .$row['MemID']. '">'
                            .$row['LastName']. ', ' .$row[FirstName]. 
                            ' ' .$row[MiddleName]. '</option>';
                }
                echo '</select>';
            } else {
                echo "<p>No members found</p>";
            }
        ?>
            <input type="submit" name="go" id="go" value="Go" />
        </form>
        <div id="results"></div>
    </body>
</html>

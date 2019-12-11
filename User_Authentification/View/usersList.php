
<?php
if($_SESSION['user']){
    echo "<div>
            <h2 class='center'>List of users</h2>
            <table class=''>
                <tr>
                    <th>Email</th>
                    <th>Password</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Admin</th>
                </tr>";
    
    foreach($userList as $user){
        echo "</tr>";
            echo "<td>".$user['email']."</td>";
            echo "<td>".$user['password']."</td>";
            echo "<td>".$user['firstName']."</td>";
            echo "<td>".$user['lastName']."</td>";
            echo "<td>".$user['admin']."</td>";
        echo "<tr>";
    }

    echo "  </table>
        </div>";
}else {
    echo "<div class='wrapper-50 margin-auto center'>
            <h2>Unauthorized</h2>
            <p>
                You don't have access to this ressource !<br>
                Please contact an administrator.
            </p>
            <p>
                <a href='./index.php'>Return to main page</a>
            </p>
        </div>";
}
?>

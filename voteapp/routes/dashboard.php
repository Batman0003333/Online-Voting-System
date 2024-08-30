<?php
session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (!isset($_SESSION["userdata"])) {
    header("Location: ../index.html");
    exit();
}

$userdata = $_SESSION["userdata"];
$groupsdata = isset($_SESSION["groupsdata"]) ? $_SESSION["groupsdata"] : [];

if ($userdata['status'] == 0) { 
    $status = '<b style="color:red">Not Voted</b>';
} else {
    $status = '<b style="color:green">Voted</b>';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        h1 {
            color: #444;
            font-size: 36px;
            margin: 20px 0;
            text-align: center;
        }

        hr {
            width: 80%;
            border: 1px solid #ddd;
            margin-bottom: 20px;
        }

        button {
            padding: 10px 20px;
            margin: 5px;
            background-color: #5cb85c;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #4cae4c;
        }

        #Profile, #Group {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            width: 80%;
            margin: 20px 0;
            text-align: center;
        }

        #Profile {
            background-color: #f9f9f9;
        }

        #Group {
            background-color: #f1f1f1;
            padding: 20px;
        }

        #Group div {
            background-color: #fff;
            padding: 15px;
            border-radius: 10px;
            box-shadow: 0 0 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            text-align: left;
            position: relative;
        }

        #Group img {
            border-radius: 5px;
            float: right;
            margin-left: 20px;
        }

        #votebtn {
            padding: 10px;
            font-size: 15px;
            background-color: #007bff;
            color: white;
            border-radius: 5px;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        #votebtn:hover {
            background-color: #0056b3;
        }

        @media (max-width: 600px) {
            h1 {
                font-size: 28px;
            }

            button {
                font-size: 14px;
                padding: 8px 16px;
            }

            #Profile, #Group {
                width: 100%;
                padding: 15px;
            }

            #votebtn {
                padding: 5px;
                font-size: 14px;
            }
        }
    </style>
</head>
<body>
    <div id="buttonSection">
        <button onclick="window.history.back()">Back</button>
        <button onclick="window.location.href='logout.php'">Logout</button>
    </div>
    <h1>Dashboard</h1>
    <hr>
    <div id="Profile">
        <h2>Profile Section</h2>
        <img src="../uploads/<?php echo $userdata['photo']; ?>" height="100" width="100"><br><br>
        <b>Name:</b> <?php echo $userdata['name']; ?><br><br>
        <b>Mobile:</b> <?php echo $userdata['mobile']; ?><br><br>
        <b>Address:</b> <?php echo $userdata['address']; ?><br><br>
        <b>Status:</b> <?php echo $status; ?><br><br>
    </div>
    <div id="Group">
        <h2>Candidates Section </h2>
        <?php
        if ($groupsdata) {
            for ($i = 0; $i < count($groupsdata); $i++) {
                ?>
                <div>
                    <img src="../uploads/<?php echo $groupsdata[$i]['photo']; ?>" height="100" width="100">
                    <b>Party Name: </b> <?php echo $groupsdata[$i]['name']; ?><br><br>
                    <b>Votes: </b> <?php echo $groupsdata[$i]['votes']; ?><br><br>
                    <form action="../api/vote.php" method="POST">
                        <input type="hidden" name="gvotes" value="<?php echo $groupsdata[$i]['votes']; ?>">
                        <input type="hidden" name="gid" value="<?php echo $groupsdata[$i]['id']; ?>">
                        <input type="submit" name="votesbtn" value="Vote" id="votebtn">
                    </form>
                </div>
                <?php
            }
        } else {
            echo "<p>No groups available.</p>";
        }
        ?>
    </div>
</body>
</html>

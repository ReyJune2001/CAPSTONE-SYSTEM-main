<?php
// Include the session check at the beginning of restricted pages
session_start();

// Check if the user is not logged in or is not an admin or operator
if (!isset($_SESSION['Username']) || ($_SESSION['Level'] != 'Admin' && $_SESSION['Level'] != 'Operator')) {
    header('Location: login.php'); // Redirect to the login page if not authenticated
    exit();
}

include 'connect.php';

$id = 1;

$sql = "Select * from `tbl_user` where userID=$id";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($result);

/*TO FETCH THE DATA FROM DATABASE - */
$Name = $row['Name']; /*column name in the database */
$Username = $row['Username'];
$Profile_image = $row['Profile_image'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    <title>Paint-Acetate Reports</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW"
        crossorigin="anonymous"></script>

       <!--FOR DATATABLES STYLING-->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/datetime/1.5.1/css/dataTables.dateTime.min.css">
    

        <!--FOR DATA TABLES SCRIPT-->
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.2/moment.min.js"></script>
    <script src="https://cdn.datatables.net/datetime/1.5.1/js/dataTables.dateTime.min.js"></script>


    <style>
        * {

            list-style: none;
            text-decoration: none;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Noto+Serif+Makasar';
        }

        body {
            background: white;
        }

        .wrapper .sidebar {
            background: rgb(5, 68, 104);
            position: fixed;
            top: 0;
            left: 0;
            width: 300px;
            height: 100%;
            padding: 20px 0;
            transition: all 0.5s ease;
        }

        .wrapper .sidebar .profile {
            margin-bottom: 30px;
            text-align: center;
        }

        .wrapper .sidebar .profile img {
            display: block;
            width: 110px;
            height: 110px;
            border-radius: 50%;
            margin: 0 auto;
        }

        .wrapper .sidebar .profile h3 {
            color: #ffffff;
            margin: 15px 0 5px;
        }

        .wrapper .sidebar .profile p {
            color: rgb(206, 240, 253);
            font-size: 14px;
        }

        .wrapper .sidebar ul li a {
            display: block;
            padding: 13px 30px;
            border-bottom: 1px solid #10558d;
            color: rgb(241, 237, 237);
            font-size: 16px;
            position: relative;
            margin-right: 33px;
            text-decoration: none;
        }

        .wrapper .sidebar ul li a .icon {
            color: #dee4ec;
            width: 30px;
            display: inline-block;
        }

        .wrapper .sidebar ul li a:hover,
        .wrapper .sidebar ul li a.active {
            color: #0c7db1;

            background: white;
            border-right: 2px solid rgb(5, 68, 104);

        }

        .wrapper .sidebar ul li a:hover .icon,
        .wrapper .sidebar ul li a.active .icon {
            color: #0c7db1;

        }

        .wrapper .sidebar ul li a:hover:before,
        .wrapper .sidebar ul li a.active:before {
            display: block;

        }

        .wrapper .section {
            width: calc(100% - 300px);
            margin-left: 300px;
            transition: all 0.5s ease;

        }

        .wrapper .section .top_navbar {
            background: white;
            height: 2px;
            display: flex;
            align-items: center;
            padding: 0 30px;
            margin-top: 20px;

        }

        .wrapper .section .top_navbar .hamburger a {
            font-size: 30px;
            color: black;
        }

        .wrapper .section .top_navbar .hamburger a:hover {
            color: rgb(7, 105, 185);
        }

        body.active .wrapper .sidebar {
            left: -300px;
        }

        body.active .wrapper .section {
            margin-left: 0;
            width: 100%;
        }

        /*USER PROFILE STYLES*/
        .admin_profile {
            display: flex;
            justify-content: flex-end;
            margin-top: 20px;
            margin-right: 32px;

        }

        .img-admin {
            height: 55px;
            width: 55px;
            border-radius: 50%;
            border: 3px solid transparent;
            /* Set a default border style */
        }

        .img-admin:hover {
            border-color: blue;
            /* Change the border color to red on hover */

        }


        img {
            height: 50px;
            width: 50px;
            border-radius: 50%;

        }

        /*USER HOME PROFILE STYLES*/
        .Admin-Profile {
            display: flex;
            justify-content: start;
            margin-top: 20px;
            margin-left: 50px;

        }

        .Img-Admin {
            height: 200px;
            width: 200px;
            border-radius: 50%;
            border: 5px solid;
            /* Set a default border style */
            border-color: rgb(0, 255, 38);
        }

        /*FOR ADMIN PROFILE MODAL */
        .container {
            min-height: 50vh;
            background-color: var(--light-bg);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .container .profile {
            padding: 20px;
            box-shadow: var(--box-shadow);
            text-align: center;
            width: 400px;
            border-radius: 5px;

        }

        .container .profile img {
            height: 160px;
            width: 160px;
            border-radius: 50%;
            object-fit: cover;


        }

        /*FOR UPDATE MODAL */

        .container2 {
            min-height: 40vh;

        }

        .container2 .profile2 {
            box-shadow: var(--box-shadow);

            border-radius: 5px;
        }

        .container2 .profile2 .img2 {
            Display: absolute;
            height: 180px;
            width: 180px;
            margin-left: 140px;
            margin-top: 50px;
            border-radius: 50%;
            object-fit: cover;
        }

        /*FOR UPDATE PROFILE */
        .update-profile form .flex {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
            gap: 15px;
        }

        .update-profile form .flex .inputBox {
            width: 50%;
            margin-top: 20px;
        }

        .update-profile form .flex .inputBox span {
            text-align: left;
            display: block;
            margin-top: 15px;
            font-size: 17px;
            color: var(--black);
        }

        .update-profile form .flex .inputBox .box {
            width: 100%;
            border-radius: 10px;
            padding: 12px 14px;
            font-size: 17px;
            color: var(--black);
            margin-top: 10px;
        }

        /*FOR VOLUME TABLE CONTENT */


        table,
        th,
        td {
            border: 1px solid black;
            border-collapse: collapse;
            text-align: center;

            color: black;
        }

        .date-cell {
            white-space: nowrap;
        }

        .paint-color-cell {
            white-space: nowrap;
        }

        /*FOR TABLE CONTAINER */


        .container3,
        .container3-fluid,
        .container3-lg,
        .container3-md,
        .container3-sm,
        .container3-xl,
        .container3-xxl {
            --bs-gutter-x: 3.9rem;
            --bs-gutter-y: 0;
            width: 100%;
            padding-right: calc(var(--bs-gutter-x) * .5);
            padding-left: calc(var(--bs-gutter-x) * .5);
            margin-top: 15px;
            margin-right: auto;
            margin-left: auto;
            background-color: rgb(225, 225, 212);

        }

        /*FOR SEARCH BAR */
        .searchfield {
            width: 150px;
            height: 30px;
            margin-left: 5px;
            background-color: rgb(225, 225, 212);
            border-color: #86b7fe;
            border-radius: 5px;

        }

        /*FOR FILTER BAR */
        .filterfield {
            width: 150px;
            height: 30px;
            margin-left: 5px;
            background-color: rgb(225, 225, 212);
            border-color: #86b7fe;
            border-radius: 5px;
        }

        /*FOR SORT BAR */
        .sortfield {
            width: 150px;
            height: 30px;
            margin-left: 5px;
            background-color: rgb(225, 225, 212);
            border-color: #86b7fe;
            border-radius: 5px;
        }


        /*Operation Button */

        .btn_opt {
            display: flex;
            justify-content: flex-end;
            margin-top: 50px;
            margin-right: 32px;
        }

        /*MAIN CONTENT */

        .main1 {
            background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url(IMAGES/background2.jpg);
            background-size: cover;
            padding: 2em 0 2em 0;
            flex: 1 1 150px;
            margin-top: 20px;
            margin-left: 30px;
            height: 100%;
            padding-left: 30px;
            padding-right: 30px;

        }

        header {
            background-color: transparent;
            padding: 2em 0 2em 0;
            padding-bottom: 0px;
        }

        .main2 {
            display: flex;
            flex: 1;


        }

        .editProfile_container {
            background-color: #3498db;
            padding: 3em 0 3em 0;
            flex: 1 1 100px;
            margin-right: auto;
            text-align: center;

        }




        label {
            color: white;
            text-align: center;


        }

        input {
            width: 30%;
            height: 35px;
            margin-bottom: 20px;
            border-color: #86;
            border-radius: 5px;
        }

        .selector {
            width: 30%;
            height: 35px;
            margin-bottom: 20px;
            border-color: #86;
            border-radius: 5px;
        }

        .newpaint {
            text-align: left;
            margin-left: 45px;
        }

        .operational_btn {
            margin-right: 30px;
        }

        /*FOR PARALLELOGRAM IN ADMIN PROFILE */
        .parallelogram-button {
            display: inline-block;
            padding: 8px 40px;

            text-decoration: none;
            transition: background-color 0.3s;
        }

        .parallelogram-button1 {
            background-color: #3498db;
            transform: skew(20deg);
            transform-origin: bottom right;
        }

        .parallelogram-button2 {
            margin-left: 20px;
            background-color: #2ecc71;
            transform: skew(20deg);
            transform-origin: bottom right;
        }

        .parallelogram-button1:hover {
            background-color: #2980b9;
        }

        .parallelogram-button2:hover {
            background-color: #27ae60;
        }

        .profile-history-btn {
            margin-left: 300px;
        }

        /* Style for the select option in admin profile */
        .dropdown {
            border: none;
            font-size: 23px;
            width: 6%;
            text-align: center;

        }

        /* Style for the options within the dropdown */
        .dropdown option {
            padding: 10px;
            font-size: 20px;
            text-align: center;
        }

        /* FOR CLOCK */

        .clockcontainer {
            width: 295px;
            height: 180px;
            position: absolute;
            top: 95%;


        }

        .clock {

            color: white;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;

        }

        .clock span {
            font-size: 20px;
            width: 30px;
            display: inline-block;
            text-align: center;
            position: relative;
        }

        /*FOR SYSTEM RESPONSIVE */
    </style>
</head>

<body>
    <div class="wrapper">
        <div class="section">
            <div class="admin_profile">
                <img src="uploaded_image/<?php echo $Profile_image; ?>" class="img-admin" id="image">

                <select class="dropdown" required onchange="handleDropdownChange(this)">
                    <option value="admin">
                        <?php echo $Username; ?>
                    </option>
                    <option value="edit_profile">&nbsp;Edit Profile&nbsp;</option>
                    <option value="logout">Logout</option>
                </select>
            </div>
            <div class="top_navbar">
                <div class="hamburger">
                    <a href="#">
                        <i class="fas fa-bars"></i>
                    </a>



                </div>
            </div>

            <!--MAIN CONTENT-->



            <!--Top menu -->
            <div class="sidebar">
                <!--profile image & text-->
                <div class="profile">
                    <img src="IMAGES/logo.jpg" alt="profile_picture">
                    <h3>Mindanao Container Corporation</h3>
                    <!--<p>purok-8,Villanueva,Mis or.</p> -->
                </div>
                <!--menu item-->
                <ul>
                    <li>
                        <!-- Hidden hyperlink -->
                        <a href="hidden_profile.php" style="display:none;">Hidden Link

                        </a>
                    </li>
                    <li>
                        <a href="profile.php" style="display:none;">
                            <span class="icon"><i class="fa-solid fa-user"></i></span>
                            <span class="item">Profile</span>
                        </a>
                    </li>
                    <li>
                        <a href="dataEntry.php">
                            <span class="icon"><i class="fa-regular fa-keyboard"></i></span>
                            <span class="item">Data Entry</span>
                        </a>
                    </li>
                    <li>
                        <a href="volume.php">
                            <span class="icon"><i class="fa-solid fa-chart-simple"></i></span>
                            <span class="item">Volume</span>
                        </a>
                    </li>
                    <li>
                        <a href="monitoring.php">
                            <span class="icon"><i class="fas fa-desktop"></i></span>
                            <span class="item">Monitoring</span>
                        </a>
                    </li>
                    <li>
                        <a href="report.php" class="active">
                            <span class="icon"><i class="fa-regular fa-folder"></i></span>
                            <span class="item">Reports</span>
                        </a>
                    </li>

                </ul>

                <!--FOR CLOCK-->
                <div class="clockcontainer">
                    <div class="clock">
                        <span id="hrs"></span>
                        <span>:</span>
                        <span id="min"></span>
                        <span>:</span>
                        <span id="sec"></span>
                        <span id="ampm"></span>

                    </div>
                </div>

            </div>
        </div>

    </div>


    <!-- Clickable image modal -->
    <div class="modal fade" id="clickable_image" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container">

                        <div class="profile">
                            <div class="admin_modal">
                                <a href="#" id="image">
                                    <img src="IMAGES/sampleImage.jpg">
                                </a>
                            </div>

                            <h1 style="margin-top:20px;">Rey June</h1>

                            <div id="update_profile">
                                <a href="profile.php"><button class="btn btn-primary btn-lg"
                                        style="font-size:25px; margin-top:20px;">Update profile</button></a>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>


    <!--FOR CLOCK SCRIPT-->
    <script>
        let hrs = document.getElementById("hrs");
        let min = document.getElementById("min");
        let sec = document.getElementById("sec");
        let ampm = document.getElementById("ampm");

        setInterval(() => {
            let currentTime = new Date();
            let hours = currentTime.getHours();
            let period = "AM";

            if (hours >= 12) {
                period = "PM";
                if (hours > 12) {
                    hours -= 12;
                }
            }

            hrs.innerHTML = (hours < 10 ? "0" : '') + hours;
            min.innerHTML = (currentTime.getMinutes() < 10 ? "0" : '') + currentTime.getMinutes();
            sec.innerHTML = (currentTime.getSeconds() < 10 ? "0" : '') + currentTime.getSeconds();
            ampm.innerHTML = period;
        }, 1000)
    </script>


    <!-- FOR clickable image dropdown -->
    <script>
        function handleDropdownChange(select) {
            var selectedValue = select.value;

            if (selectedValue === "edit_profile") {
                // Redirect to the edit profile page
                window.location.href = "profile.php"; // Change the URL accordingly
            } else if (selectedValue === "logout") {
                // Redirect to the logout page
                window.location.href = "logout.php"; // Change the URL accordingly
            }
        }
    </script>

    <!--FOR clickable image modal-->
    <script>
        document.getElementById('image').addEventListener('click', function () {
            var clickable_image = new bootstrap.Modal(document.getElementById('clickable_image'));
            clickable_image.show();
        })
    </script>

    <!--FOR SIDEBAR-->
    <script>
        var hamburger = document.querySelector(".hamburger");
        hamburger.addEventListener("click", function () {
            document.querySelector("body").classList.toggle("active");
        })
    </script>
</body>

</html>
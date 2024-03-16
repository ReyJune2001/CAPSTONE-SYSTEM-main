<!--FOR ADMIN PROFILE-->
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW"
        crossorigin="anonymous"></script>

    <title>Paint-Acetate Reports</title>

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



        /*MAIN CONTENT */

        .main1 {
            background-color: rgb(225, 225, 212);
            padding: 2%;

            flex: 1 1 150px;
            margin-top: 20px;
            margin-left: 30px;
            height: 100%;
        }



        .main2 {
            display: flex;
            flex: 1;
            padding-top: 2%;
            padding-bottom: 2%;
            height: 100%;

        }

        header {
            background-color: rgb(25, 142, 214);
            padding: 2em 0 2em 0;
            text-align: center;
        }

        .left {
            background-color: yellow;
            padding: 3em 0 3em 0;
            flex: 1 1 100px;
            margin-left: auto;
            text-align: center;

        }

        main {
            background-color: white;
            padding: 3em 0 3em 0;
            flex: 1 1 150px;
            text-align: center;

        }

        .right {
            background-color: rgb(0, 255, 38);
            padding: 3em 0 3em 0;
            flex: 1 1 100px;
            margin-right: auto;
            text-align: center;

        }

        footer {
            background-color: darkcyan;
            text-align: center;

            padding: 2em 0 2em 0;

        }

        .editProfile_container {
            background-color: #3498db;
            padding: 3em 0 3em 0;
            flex: 1 1 100px;
            margin-right: auto;
            text-align: center;

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
            top: 12%;
            left: 80%;
            transform: translate(-50%, -50%);


        }

        .clock {

            color: black;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;

        }

        .clock span {
            font-size: 22px;
            width: 30px;
            display: inline-block;
            text-align: center;
            position: relative;
        }

        /*FOR DATA ENTRY */
        .modal-body {

            background-color: rgb(225, 225, 212);

        }

        .initial {
            display: flex;
            flex: 1;
            padding-top: 2%;
            padding-bottom: 2%;
            height: 100%;
            background-color: #87ceeb;
            /*#98fb98 */
        }


        .styleform {
            width: 25%;
            height: 35px;
            margin-bottom: 20px;
            border-color: #86;
            border-radius: 5px;
        }

        .modal-body .initial {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100%;
            /* Ensure the container fills the height of the modal body */
        }

        .modal-header {

            background-color: #5484f4;
        }

        /* Adjust the alignment of the modal title to center it */
        .center-modal-title {
            font-size: 30px;
            text-align: center;
            /* Center-align the modal title */
            margin: 0 auto;
            /* Center the title horizontally */
            margin-left: 40%;
            color: white;
        }

        /*FOR NEW PAINT MIX */
        .newpaintmix {
            display: flex;
            flex-direction: row;
            /* Boxes will be arranged horizontally */
            justify-content: space-around;
            /* Space evenly distributed along the main axis */
            align-items: center;

        }

        /*FOR PRODUCTION OUTPUT */
        .productionOutput {
            display: flex;
            flex-direction: row;
            /* Boxes will be arranged horizontally */
            justify-content: space-around;
            /* Space evenly distributed along the main axis */
            align-items: center;

        }

        /*FOR yield */
        .yield {
            display: flex;
            flex-direction: row;
            /* Boxes will be arranged horizontally */
            justify-content: space-around;
            /* Space evenly distributed along the main axis */
            align-items: center;

        }

        /*FOR ending */
        .ending {
            display: flex;
            flex-direction: row;
            /* Boxes will be arranged horizontally */
            justify-content: space-around;
            /* Space evenly distributed along the main axis */
            align-items: center;

        }

        /*FOR READONLY OF YIELD */


        .vertical-line {
            width: 4px;
            /* Adjust the width of the line as needed */
            height: 8vh;
            /* Sets the height to be the full height of the viewport */
            background-color: gray;
            /* Change the color of the line */
            position: absolute;

            left: 50%;
            /* Position the line in the center horizontally */
            transform: translateX(-50%);
            /* Adjusts the position to the center */

        }

        .boxstyle {
            display: flex;
            flex-direction: row;
            /* Boxes will be arranged horizontally */
            justify-content: space-around;
            /* Space evenly distributed along the main axis */
            align-items: center;
            /* Center vertically on the cross axis */



        }

        .box {

            width: 25%;
            height: 80px;
            margin-top: 20px;
            padding-left: -10px;

            border: 2px solid #6be87a;
            text-align: center;
        }

        .box1 {
            background-color: white;
        }



        /*FOR SYSTEM RESPONSIVE */
    </style>
</head>

<body>
    <div class="wrapper">
        <div class="section">

            <div class="admin_profile">
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
            <div class="main1">
                <header>Header content</header>
                <div class="main2">
                    <aside class="left">Left content</aside>
                    <main>
                        <button type="button" class="btn btn-primary" id="initial">Data Entry <i
                                class="fa-regular fa-square-plus"></i></button>

                        <!-- Data Entry modal -->

                        <div class="modal fade" id="initialmodal" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title center-modal-title" id="exampleModalLabel">DATA ENTRY
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">

                                        <form method="post">
                                            <fieldset>
                                                <div class="initial">
                                                    <div class="form-column">
                                                        <br>
                                                        <label>Date:</label>
                                                        <input type="date" style="text-align: center;" class="styleform"
                                                            name="date" value="<?php echo $date; ?>" required>

                                                        <label style="margin-left:6%;">Diameter:</label>
                                                        <input type="text" style="text-align: center;" class="styleform"
                                                            name="diameter" placeholder="diameter"
                                                            value="<?php echo $diameter; ?>" required>
                                                        <br>
                                                        <label style="">Paint Color:</label>
                                                        <select name="paint_color"
                                                            style="text-align: center; margin-right:4%;"
                                                            class="styleform" required>
                                                            <option value="">------ Select ------</option>
                                                            <option value="Royal Blue" <?php if ($paint_color == 'Royal Blue')
                                                                echo 'selected'; ?>>Royal Blue</option>
                                                            <option value="Deft Blue" <?php if ($paint_color == 'Deft Blue')
                                                                echo 'selected'; ?>>Deft Blue</option>
                                                            <option value="Buff" <?php if ($paint_color == 'Buff')
                                                                echo 'selected'; ?>>Buff
                                                            </option>
                                                            <option value="Golden Brown" <?php if ($paint_color == 'Golden Brown')
                                                                echo 'selected'; ?>>Golden Brown</option>
                                                            <option value="Clear" <?php if ($paint_color == 'Clear')
                                                                echo 'selected'; ?>>Clear
                                                            </option>
                                                            <option value="White" <?php if ($paint_color == 'White')
                                                                echo 'selected'; ?>>White
                                                            </option>
                                                            <option value="Black" <?php if ($paint_color == 'Black')
                                                                echo 'selected'; ?>>Black
                                                            </option>
                                                            <option value="Alpha Gray" <?php if ($paint_color == 'Alpha Gray')
                                                                echo 'selected'; ?>>Alpha Gray</option>
                                                            <option value="Nile Green" <?php if ($paint_color == 'Nile Green')
                                                                echo 'selected'; ?>>Nile Green</option>
                                                            <option value="Emirald Green" <?php if ($paint_color == 'Emirald Green')
                                                                echo 'selected'; ?>>Emirald Green</option>
                                                            <option value="Jade Green" <?php if ($paint_color == 'Jade Green')
                                                                echo 'selected'; ?>>Jade Green</option>
                                                        </select>
                                                        <label style="margin-left:4%;">Height:</label>
                                                        <input type="text" style="text-align: center; margin-right:6%;"
                                                            class="styleform" name="height" placeholder="height"
                                                            value="<?php echo $height; ?>" required>
                                                        <br>
                                                        <label
                                                            style="text-align: center; margin-left:10%;">Supplier:</label>
                                                        <select name="supplier_name" style="text-align: center; "
                                                            class="styleform" required>
                                                            <option value="">------ Select ------</option>
                                                            <option value="Nippon" <?php if ($supplier_name == 'Nippon')
                                                                echo 'selected'; ?>>
                                                                Nippon</option>
                                                            <option value="Treasure Island" <?php if ($supplier_name == 'Treasure Island')
                                                                echo 'selected'; ?>>Treasure Island</option>
                                                            <option value="Inkote" <?php if ($supplier_name == 'Inkote')
                                                                echo 'selected'; ?>>
                                                                Inkote</option>
                                                            <option value="Century" <?php if ($supplier_name == 'Century')
                                                                echo 'selected'; ?>>
                                                                Century</option>
                                                        </select>

                                                        <label style="margin-left:5%;">Paint ratio:</label>
                                                        <input type="text" style="text-align: center; margin-right:13%;"
                                                            class="styleform" name="paintRatio"
                                                            placeholder="paint ratio" value="<?php echo $paintRatio; ?>"
                                                            required>
                                                        <br>
                                                        <label style="margin-left:5%;">Batch No:</label>
                                                        <input type="text" style="text-align: center;" class="styleform"
                                                            name="batchNumber" placeholder="batch number"
                                                            value="<?php echo $batchNumber; ?>" required>

                                                        <label style="margin-left:3%;">Acetate ratio:</label>
                                                        <input type="text" style="text-align: center; margin-right:9%;"
                                                            class="styleform" name="acetateRatio"
                                                            placeholder="acetate ratio"
                                                            value="<?php echo $acetateRatio; ?>" required>
                                                        <br><br>

                                                        <hr style="border-top: 5px solid black;">
                                                        <br>

                                                        <div class="ending">
                                                            <button type="button" class="btn btn-primary"
                                                                id="toggleEndingInventory" style="font-size:20px;margin-left:px;width:30%;">
                                                                Ending Inventory
                                                            </button>
                                                        </div>
                                                        <br>
                                                        <!-- "Ending Inventory" section -->
                                                        <div class="collapse" id="collapseEndingInventory">
                                                            <div class="card card-body" style="background-color:#87ceeb; border:none;">
                                                                <div class="form-column">
                                                                    <label style="margin-left:;">Diameter:</label>
                                                                    <input type="text" style="text-align: center;"
                                                                        class="styleform" name="Endingdiameter"
                                                                        placeholder="diameter"
                                                                        value="<?php echo $Endingdiameter; ?>" required>


                                                                    <label style="margin-left:8%">Height:</label>
                                                                    <input type="text"
                                                                        style="text-align: center; margin-right:4%;"
                                                                        class="styleform" name="Endingheight"
                                                                        placeholder="height"
                                                                        value="<?php echo $Endingheight; ?>" required>
                                                                    <br>

                                                                    <label style="margin-left:1%;">Paint ratio:</label>
                                                                    <input type="text" style="text-align: center;"
                                                                        class="styleform" name="EndingpaintRatio"
                                                                        placeholder="paint ratio"
                                                                        value="<?php echo $EndingpaintRatio; ?>"
                                                                        required>

                                                                    <label style="margin-left:3%;">Acetate
                                                                        ratio:</label>
                                                                    <input type="text"
                                                                        style="text-align: center; margin-right:6%;"
                                                                        class="styleform" name="EndingacetateRatio"
                                                                        placeholder="acetate ratio"
                                                                        value="<?php echo $EndingacetateRatio; ?>"
                                                                        required>
                                                                    <br><br>


                                                                    <div class="newpaintmix">
                                                                        <h4>New Paint Mix</h4>
                                                                    </div>
                                                                    <br>

                                                                    <label style="margin-left:6%;">Supplier:</label>
                                                                    <select name="newSupplier_name"
                                                                        style="text-align: center;" class="styleform"
                                                                        required>
                                                                        <option value="">------ Select ------</option>
                                                                        <option value="Nippon" <?php if ($newSupplier_name == 'Nippon')
                                                                            echo 'selected'; ?>>Nippon</option>
                                                                        <option value="Treasure Island" <?php if ($newSupplier_name == 'Treasure Island')
                                                                            echo 'selected'; ?>>Treasure Island</option>
                                                                        <option value="Inkote" <?php if ($newSupplier_name == 'Inkote')
                                                                            echo 'selected'; ?>>Inkote</option>
                                                                        <option value="Century" <?php if ($newSupplier_name == 'Century')
                                                                            echo 'selected'; ?>>Century</option>
                                                                    </select>

                                                                    <label style="margin-left:1%;">Spay
                                                                        Viscosity:</label>
                                                                    <input type="text"
                                                                        style="text-align: center; margin-right:9%;"
                                                                        class="styleform" name="sprayViscosity"
                                                                        placeholder="spray viscosity"
                                                                        value="<?php echo $sprayViscosity; ?>" required>

                                                                    <br>

                                                                    <label>Paint (L):</label>
                                                                    <input type="text" style="text-align: center;"
                                                                        class="styleform" name="NewpaintL"
                                                                        placeholder="paint liter"
                                                                        value="<?php echo $NewpaintL; ?>" required>

                                                                    <label style="margin-left:30px;">Acetate
                                                                        (L):</label>
                                                                    <input type="text"
                                                                        style="text-align: center;margin-right:3%;"
                                                                        class="styleform" name="NewacetateL"
                                                                        placeholder="acetate liter"
                                                                        value="<?php echo $NewacetateL; ?>" required>

                                                                    <br><br>

                                                                    <div class="productionOutput">
                                                                        <h4>Production Output</h4>
                                                                    </div>
                                                                    <br>

                                                                    <label style="margin-left:2%;">Customer:</label>
                                                                    <input type="text" style="text-align: center;"
                                                                        class="styleform" name="customer_name"
                                                                        placeholder="customer"
                                                                        value="<?php echo $customer_name; ?>" required>

                                                                    <label style="margin-left:6%;">Quantity:</label>
                                                                    <input type="text"
                                                                        style="text-align: center; margin-right:5%;"
                                                                        class="styleform" name="quantity"
                                                                        placeholder="quantity"
                                                                        value="<?php echo $quantity; ?>" required>
                                                                    <br><br>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="yield">
                                                            <h4>Yield</h4>
                                                        </div>

                                                        <div class="boxstyle">
                                                            <div class="box box1">
                                                                <label
                                                                    style="margin-left:17px;">Paint&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Acetate<span
                                                                        class="vertical-line"></span></label><br>
                                                                <input type="number"
                                                                    style="text-align: center; margin-left:21px; width: 35%; border: none !important; outline: none !important;"
                                                                    class="readonlyInput styleform" id="paintYield"
                                                                    name="paintYield"
                                                                    value="<?php echo $paintYield; ?>">

                                                                <input type="number"
                                                                    style="text-align: center; margin-left:25px; width: 35%; border: none !important; outline: none !important;"
                                                                    class="readonlyInput styleform" id="acetateYield"
                                                                    name="acetateYield"
                                                                    value="<?php echo $acetateYield; ?>">
                                                            </div>
                                                        </div>

                                                        <br><br>
                                                        <button type="submit" id="update" class="btn btn-primary btn-lg"
                                                            name="submit"
                                                            style="font-size:20px; border-radius:50px; border-color:white; width:30%; padding-top:1%;padding-bottom:1%;">Add</button>


                                                    </div>


                                                </div>
                                            </fieldset>
                                        </form>

                                    </div>

                                </div>
                            </div>
                        </div>
                    </main>
                    <aside class="right">Right content</aside>

                </div>
                <footer>Footer content</footer>
            </div>


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
                            <span class="icon"><i class="fa-solid fa-table-cells-large"></i></span>
                            <span class="item">Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="volume.php">
                            <span class="icon"><i class="fa-solid fa-flask-vial"></i></span>
                            <span class="item">Volume</span>
                        </a>
                    </li>
                    <li>
                        <a href="monitoring.php">
                            <span class="icon"><i class="fa-solid fa-chart-column"></i></span>
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

    <!--FOR DATA ENTRY Script-->
    <script>
        document.getElementById('initial').addEventListener('click', function () {
            var initialmodal = new bootstrap.Modal(document.getElementById('initialmodal'));
            initialmodal.show();
        })
    </script>

    <!-- JavaScript to toggle and collapse "Ending Inventory" -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.getElementById('toggleEndingInventory').addEventListener('click', function () {
                var collapseEndingInventory = new bootstrap.Collapse(document.getElementById('collapseEndingInventory'));
                collapseEndingInventory.toggle();
            });
        });
    </script>


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
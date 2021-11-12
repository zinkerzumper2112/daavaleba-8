<?php
    include('db_connection.php');


    $id = isset($_GET['id']) && $_GET['id'] ? $_GET['id'] : null;

    if($id) {
        // select
        $select_query = "SELECT * FROM students WHERE id = " . $id;

        $result = mysqli_query($conn, $select_query);
        $student = mysqli_fetch_assoc($result); // []

        if(!$student) {
            die('student not found');
        }
    } else {
        die('invalid id');
    }


    if(isset($_POST['action']) && $_POST['action'] == 'update') {
        $name = isset($_POST['name']) ? $_POST['name'] : '' ;
        $lastname = isset($_POST['lastname']) ? $_POST['lastname'] : '' ;
        $age = isset($_POST['age']) ? $_POST['age'] : '' ;
        $id = isset($_POST['id']) ? $_POST['id'] : '' ;

        if($name && $lastname && $age && $id) {
            // update
            $update_query = "UPDATE students SET name = '$name', lastname = '$lastname', age = '$age' WHERE id = " . $id;

            if(mysqli_query($conn, $update_query)) {
                header('Location: index.php');
            } else {
                echo "Error";
            }
        }
    }
?>


<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    
    <div class="container">
        <h2>Update Row <a href="index.php">back</a></h2>
        <form action="" method="post">
            <input type="hidden" name="action" value="update">
            <input type="hidden" name="id" value="<?= $student['id']; ?>">
            <div>
                <label>Name</label>
                <input type="text" name="name" value="<?= $student['name']; ?>">
            </div>
            <div>
                <label>Lastname</label>
                <input type="text" name="lastname" value="<?= $student['lastname']; ?>">
            </div>
            <div>
                <label>Age</label>
                <input type="text" name="age" value="<?= $student['age']; ?>">
            </div>
            <div>
                <button>Update</button>
            </div>
        </form>
    </div>


</body>
</html>
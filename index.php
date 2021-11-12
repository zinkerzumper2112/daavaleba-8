<?php

    include('db_connection.php');
    $students =[];
    if(isset($_POST['action']) && $_POST['action'] == 'insert') {
        $name = isset($_POST['name']) ? $_POST['name'] : '' ;
        $lastname = isset($_POST['lastname']) ? $_POST['lastname'] : '' ;
        $age = isset($_POST['age']) ? $_POST['age'] : '' ;

        if($name && $lastname && $age) {
            $insert_query = "INSERT INTO students (name, lastname, age) VALUES ('$name', '$lastname', '$age')";
            
            if(mysqli_query($conn, $insert_query)) {
                echo "Record Created";
            } else {
                echo "Error";
            }
        }
    }

    //delete
    if(isset($_POST['action']) && $_POST['action'] == 'delete'){
        $id = isset($_POST['id']) ? $_POST['id'] : null;

        if($id) {
            $delete_query = "DELETE FROM students WHERE id = " .$id;

            if(mysqli_query($conn, $delete_query)) {
                echo "Record Deleted";
            } else {
                echo "Error";
            }
        }
    }

    //select
    $select_query = "SELECT * FROM students";
    $result = mysqli_query($conn, $select_query);
    $students = mysqli_fetch_all($result, MYSQLI_ASSOC); // [ [], [], [], ]
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
        <form action="" method="post">
            <input type="hidden" name="action" value="insert">
            <div>
                <label>Name</label>
                <input type="text" name="name">
            </div>
            <div>
                <label>Lastname</label>
                <input type="text" name="lastname">
            </div>
            <div>
                <label>Age</label>
                <input type="text" name="age">
            </div>
            <div>
                <button>Add</button>
            </div>
        </form>
        <table>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Lastname</th>
                <th>Age</th>
                <th></th>
            </tr>
            </tr>
            <?php foreach($students as $value): ?>
                <tr>
                    <td><?= $value['id'] ?></td>
                    <td><?= $value['name'] ?></td>
                    <td><?= $value['lastname'] ?></td>
                    <td><?= $value['age'] ?></td>
                    <td class="actions">
                        <form action="" method="post" onsubmit="return deleteRecord()">
                            <input type="hidden" name="action" value="delete">
                            <input type="hidden" name="id" value="<?= $value['id'] ?>">
                            <button>x</button>
                        </form>
                        <a href="update.php?id=<?= $value['id'] ?>">Edit</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>

    <script src="assets/script.js"></script>
    
</body>
</html>
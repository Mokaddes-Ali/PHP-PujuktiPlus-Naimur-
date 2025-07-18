<?php 
include 'db_connect.php';
session_start();

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    try{
        $sql = "INSERT INTO students(name, email,phone,address) VALUES(:name,:email, :phone, :address)";

        $stmt = $conn->prepare($sql);
/*         $stmt হচ্ছে PDOStatement অবজেক্ট, যা এই prepared SQL statement ধরে রাখে।

 তুমি এখন এটাতে bindParam() বা execute() করতে পারো। */
 $stmt->execute([
    ':name' => $name,
    ':email'=> $email,
    'phone'=> $phone,
    'address'=> $address
 ]);

//         if($conn->query($sql)===FALSE){
//             throw new Exception("Insert Failed:" . $conn->error);
//         }
// else{
    $_SESSION['success'] = "Student created successfully!";
    header("Location: index.php");
    exit();
}catch(PDOException $e){
    // die("". $e->getMessage());
    $_SESSION["error"] = $e->getMessage();
    header("Location: index.php");
    exit();
}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Student</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f6f8;
            padding: 30px;
        }

        .form-container {
            max-width: 500px;
            margin: auto;
            background-color: #ffffff;
            padding: 10px 50px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }

        .form-container h2 {
            text-align: center;
            color: #333;
            margin-bottom: 25px;
        }

        .form-group {
            margin-bottom: 18px;
        }

        .form-group label {
            display: block;
            margin-bottom: 6px;
            color: #333;
            font-weight: 600;
        }

        .form-group input, 
        .form-group textarea {
            width: 100%;
            padding: 10px 14px;
            font-size: 15px;
            border: 1px solid #ccc;
            border-radius: 6px;
            transition: border-color 0.3s;
        }

        .form-group input:focus, 
        .form-group textarea:focus {
            border-color: #007bff;
            outline: none;
        }

        .form-group textarea {
            resize: vertical;
        }

        .submit-btn {
            width: 100%;
            background-color: #007bff;
            color: white;
            padding: 12px;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .submit-btn:hover {
            background-color: #0056b3;
        }
    .add-new-btn-container {
        text-align: right;
        margin: 20px auto;
        max-width: 1000px;
        padding-right: 10px;
    }

    .add-new-btn {
        height: 25px;
        margin-top: 14px;
        background-color: #28a745;
        color: white;
        padding: 10px 20px;
        font-size: 16px;
        border-radius: 6px;
        text-decoration: none;
        font-weight: 600;
        transition: background-color 0.3s;
        display: inline-block;
    }

    .add-new-btn:hover {
        background-color: #218838;
    }
      .btn-heading{
        display: flex;
        gap: 150px;
    }
    </style>
</head>
<body>

<div class="form-container">
   <div class="add-new-btn-container btn-heading">
         <h2>➕ Add New Student</h2>
    <a href="index.php" class="add-new-btn">See All</a>

</div>

    <form action="create.php" method="POST">
        <div class="form-group">
            <label for="name">Full Name</label>
            <input type="text" name="name" id="name" placeholder="Enter full name" required>
        </div>

        <div class="form-group">
            <label for="email">Email Address</label>
            <input type="email" name="email" id="email" placeholder="Enter email" required>
        </div>

        <div class="form-group">
            <label for="phone">Phone Number</label>
            <input type="text" name="phone" id="phone" placeholder="Enter phone number" required>
        </div>

        <div class="form-group">
            <label for="address">Home Address</label>
            <textarea name="address" id="address" rows="3" placeholder="Enter address" required></textarea>
        </div>

        <button type="submit" class="submit-btn">Save Student</button>
    </form>
</div>

</body>
</html>

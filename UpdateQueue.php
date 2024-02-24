<!DOCTYPE html>
<html lang="en">


<head>
    <title>Update</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            padding: 20px;
        }


        h1 {
            color: #007bff;
        }


        form {
            max-width: 500px;
            margin: auto;
        }


        label {
            font-weight: bold;
        }


        input[type="text"],
        input[type="date"],
        input[type="email"],
        input[type="number"],
        input[type="file"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            box-sizing: border-box;
        }


        button {
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }


        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>


<body>
    <h1>Update</h1>


    <?php
    require 'conn.php';


    if (isset($_GET['FoodID'])) {
        $sql_select_customer = 'SELECT queue.QDate, queue.QNumber, patient.Pid, queue.QStatus
        FROM queue
        JOIN patient ON queue.Pid = patient.Pid
        JOIN gender ON patient.Pgender = gender.GenderID;';
        $stmt = $conn->prepare($sql_select_customer);
        $stmt->execute([$_GET['QDate']]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
    }
    ?>


    <form action="UpdateQueue.php" method="POST" enctype="multipart/form-data">
        <label for="QDate">Date:</label>
        <input type="date" placeholder="QDate" name="QDate" required class="form-control" value="<?php echo $result['QDate']; ?>">
        <br>


        <label for="QNamber">Namber:</label>
        <input type="number" placeholder="QNamber" name="QNamber" required class="form-control" value="<?php echo $result['QNamber']; ?>">
        <br>


        <label for="Pid">id:</label>
        <input type="number" placeholder="Pid" name="Pid" required class="form-control" value="<?php echo $result['Pid']; ?>">
        <br>
        <label>Select a Status</label>
<select name="QStatus" class="form-control">
    <option value="ป่วย" <?php if (isset($result['QStatus']) && $result['QStatus'] == 'ป่วย') echo 'selected'; ?>>ป่วย</option>
    <option value="กำลังรักษา" <?php if (isset($result['QStatus']) && $result['QStatus'] == 'กำลังรักษา') echo 'selected'; ?>>กำลังรักษา</option>
    <option value="หายป่วย" <?php if (isset($result['QStatus']) && $result['QStatus'] == 'หายป่วย') echo 'selected'; ?>>หายป่วย</option>
</select>
        <br><br>
        <input type="submit" value="Update" name="submit" class="btn btn-primary">
    </form>


</body>


</html>
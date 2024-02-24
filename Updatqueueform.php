<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
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


    <?php
    require '';


    if (isset($_GET['QDate'], $_GET['QNamber'])) {
        $query_select = 'UPDATE queue SET QDate= :QDate, QNamber= :QNamber, Pid= :Pid, QStatus= :QStatus WHERE QDate= :QDate';
        $stmt = $conn->prepare($query_select);
        $params = array($_GET['QDate'], $_GET['QNamber']);
        $stmt->execute($params);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
    }
    ?>


    <div class="container">
        <div class="row">
            <div class="col-md-4"> <br>
                <h3>ฟอร์มแก้ไขข้อมูลคิว</h3>
                <form action="UpdateQueue.php" method="POST">


                    <label for="name" class="col-sm-5 col-form-label"> วันที่จองเข้ารับการรักษา : </label>
                    <input type="text" name="QDate" class="form-control" required value="<?= $result['QDate']; ?>">


                    <label for="name" class="col-sm-2 col-form-label"> รหัสคิว : </label>
                    <input type="text" name="QNamber" class="form-control" required value="<?= $result['QNamber']; ?>">


                    <label for="name" class="col-sm-2 col-form-label"> รหัสบัตรประชาชน : </label>
                    <input type="text" name="Pid" class="form-control" required value="<?= $result['Pid']; ?>">


                    <label for="name" class="col-sm-2 col-form-label"> สถานะ : </label>
                    <select name="QStatus" id="QDate" class="form-control">
                        <option value="รอเข้ารับการรักษา">รอเข้ารับการรักษา</option>
                        <option value="รักษาเสร็จแล้ว">รักษาเสร็จแล้ว</option>
                    </select>


                    <br> <button type="submit" name="submit" class="btn btn-primary">แก้ไขข้อมูล</button>
                </form>
            </div>
        </div>
    </div>


</body>


</html>
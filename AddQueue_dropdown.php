<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <style type="text/css">
        img {
            transition: transform 0.25s ease;
        }

        img:hover {
            -webkit-transform: scale(1.5);
            transform: scale(1.5);
        }
    </style>
</head>

<body>
<?php
require 'conn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST['QDate']) && !empty($_POST['QNamber']) && !empty($_POST['Pid'])) {
        try {
            $sql = "INSERT INTO queue (QDate, QNamber, Pid, QStatus) VALUES (:QDate, :QNamber, :Pid, :QStatus)";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':QDate', $_POST['QDate']);
            $stmt->bindParam(':QNamber', $_POST['QNamber']);
            $stmt->bindParam(':Pid', $_POST['Pid']);
            $stmt->bindValue(':QStatus', 'Pending'); // Set QStatus default value to 'Pending'
            $stmt->execute();
            echo "Queue added successfully";
        } catch (PDOException $e) {
            echo "Failed to add queue: " . $e->getMessage();
        }
    } else {
        echo "Please fill in all fields";
    }
}
?>

    <div class="container">
        <div class="row">
            <div class="col-md-4"> <br>
                <h3>ฟอร์มเพิ่มข้อมูลคิว</h3>
                <br><br>
                <form method="post" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                    <input type="Date" placeholder="วันที่" name="QDate" class="form-control" required>
                    <br>
                    <input type="number" placeholder="หมายเลขคิว" name="QNamber" class="form-control" required>
                    <br>
                    <input type="text" placeholder="รหัสบัตรประชาชน" class="form-control" name="Pid" required>
                    <br>
                    <input type="submit" value="Submit" name="submit" class="btn btn-primary" />
                </form>
            </div>
        </div>
    </div>

    <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script>
        $(document).ready(function() {
            $('form').submit(function(event) {
                event.preventDefault(); // Prevent form from submitting normally
                $.ajax({
                    type: $(this).attr('method'),
                    url: $(this).attr('action'),
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function(response) {
                        alert(response); // Alert success message
                        window.location.href = "index.php"; // Redirect to index.php
                    },
                    error: function(xhr, status, error) {
                        alert(xhr.responseText); // Alert error message
                    }
                });
            });
        });
    </script>
</body>

</html>
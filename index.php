<!DOCTYPE html>

<?php 
    include 'db.php'; 

    $page = (isset($_GET['page']) ? $_GET['page'] : 1);
    $perPage = (isset($_GET['per-page']) && ($_GET['per-page']) <= 50 ? $_GET['per-page'] : 5);
    $start = ($page > 1) ? ($page * $perPage) - $perPage : 0;

    $sql = "select * from tasks limit ".$start." , ".$perPage."";
    // $sql = "select * from tasks ";
    $total = $db->query('select * from tasks')->num_rows;
    $pages = ceil($total / $perPage);
    
    $rows = $db->query($sql);
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Crud App</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container">
        <h1 class="text-center">To Do List</h1>
        <div class="col-md-10 col-md-offset-5"></div>
        <button type="button" class="btn btn-success mb-2" data-toggle="modal" data-target="#exampleModal">Add a task</button>
        <button type="button" class="btn btn-default mb-2 float-right" onclick="print()">Print</button>
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Task</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Form for task -->
                    <form method="post" action="add.php">
                        <div class="form-group">
                            <label for="">Task Name</label>
                            <input class="form-control" type="text" required name="task" id="">
                            <input type="submit" class="btn btn-primary mt-2" name="send" value="ADD">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">CANCEL</button>
                </div>
                </div>
            </div>
        </div>

        <div class="col-md-12 text-center">
            <form action="search.php" method="post" class="form-group">
                <h5>Search</h5>
                <input type="text" placeholder="Search for task" name="search" class="form-control">
            </form>
        </div>

        <table class="table">
        <thead>
            <tr>
                <th scope="col">No.</th>
                <th scope="col">Task</th>
                <th scope="col"></th>
                <th scope="col">Completed</th>
            </tr>
        </thead>
        <tbody>
            <?php while($row = $rows->fetch_assoc()): ?>
                <tr>
                    <th scope="row"><?php echo $row['id']?></th>
                    <td class="col-md-10"><?php echo $row['name']?></td>
                    <td><a href="update.php?id=<?php echo $row['id'];?>" class="btn btn-success">Edit</a></td>
                    <td><a href="delete.php?id=<?php echo $row['id'];?>" class="btn btn-danger">Delete</a></td>
                </tr>
            <?php endwhile ?>
            
        </tbody>
        </table>
        <div class="d-flex justify-content-center">
            
            <ul class="pagination">
                <?php for($i=1; $i <= $pages; $i++): ?>
                <li class="page-item"><a class="page-link" href="?page=<?php echo $i; ?>&per-page=<?php echo $perPage;?>"><?php echo $i; ?></a></li>
                <?php endfor; ?>
            </ul>
            
        </div>
    </div>
</body>
</html>
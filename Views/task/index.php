<?php

include_once("../../Controllers/tasksController.php");

$contask = new Controller_tasks();
$tasks = $contask->display_tasks();

?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Tasks</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
    <script src="main.js"></script>


</head>
<body>

<table class="table table-hover myTable">
<thead class="thead-dark">
  <tr>
    <th class="text-center">ID</th>
    <th class="text-center">Title</th>
    <th class="text-center">Description</th>
    <th class="text-center"> Creation Date</th>
    <th class="text-center"> Edition Date</th>
  </tr>
</thead>
  <?php foreach ($tasks as $task):?>
  <tr>
     <td><?php echo $task["id"] ?></td>
     <td><?php echo $task["title"] ?></td> 
     <td><?php echo $task["description"]?></td> 
     <td><?php echo $task["creation_date"]?></td> 
     <td><?php echo $task["edition_date"]?></td>     
     <td class="text-right"> 
        <a class="btn btn-danger" href ="delete_category.php?id=<?php echo $task["id"]?>"> Delete </a>
        <a class="btn btn-success" href ="update_category.php?id=<?php echo $task["id"]?>"> Update </a>
        <a class="btn btn-primary" href ="display_category.php?id=<?php echo $task["id"]?>"> View Category </a>
    </td>  
  </tr>
<?php endforeach; ?>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>

</body>
</html>
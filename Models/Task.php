<?php

include_once("Db.php");

class Model_tasks
{
	public $bd;

	function __construct()
	{	
		$pdo = new connect_DB("127.0.0.1", "root", "root", 3306, "todo_php");
		$this->bd = $pdo->getConn();
	}

	//récupère toutes les tâches
	function get_tasks()
	{
		$sql = "select * from tasks";
		$stmt = $this->bd->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $result;
	}

	//récupère la tâche correspondant à l'id
	function get_task($id)
	{
		$sql = "select * from tasks where id=:id";
		$stmt = $this->bd->prepare($sql);
		$stmt->bindParam(":id", $id);
		$stmt->execute();
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		return $result;
	}

	//créé de nouvelles tâches 
	function post_task($title, $description = null)
	{
		$sql = "INSERT INTO tasks(`title`, `description`, `creation_date`, `edition_date`) VALUES(:title, :description, NOW(), NOW())";
		$stmt = $this->bd->prepare($sql);
		$stmt->bindParam(":title", $title);
		$stmt->bindParam(":description", $description);
		$result = $stmt->execute();
		return $result;
	}

	//modifie une tâche en fonction de son id
	function put_task($id, $title = null, $description = null)
	{
		$sql = "UPDATE tasks SET title = :title, description = :description, edition_date =NOW() WHERE id = :id";
		$stmt = $this->bd->prepare($sql);
		$stmt->bindParam(":title", $title);
		$stmt->bindParam(":description", $description);
		$stmt->bindParam(":id", $id);
		$result = $stmt->execute();
		return $result;
	}

	//supprime une tâche en fonction de son ID
	function delete_task($id)
	{
		$sql = "DELETE FROM tasks WHERE id = :id";
		$stmt = $this->bd->prepare($sql);
		$stmt->bindParam(":id", $id);
		$result = $stmt->execute();
		return $result;
	}
}

/*
$test = new Model_tasks();
$test->post_task("test", "palala");
$test->post_task("testouille", "palalalouille");
$test->post_task("mzerdul");
//$test->put_task(4, "chia", "on teste le fetch all");
//$test->delete_task(1);*/
?>

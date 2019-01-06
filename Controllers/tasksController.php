<?php

include_once("../../Models/Task.php");

//$_POST['task_title'] = "plaf";
//$_POST['task_description'] = "flouf";

//classe qui contient les fonctions permettant de vérifier les entrées (du user au model(db)) et qui produit un signal de sortie (du model(db) au view)

class Controller_tasks extends Model_tasks
{

	function display_tasks()
	{
		$tasks = new Model_tasks();
		$task1 = $tasks->get_tasks();

		foreach($task1 as $key => $task)
		{
			$task1[$key]['title'] = htmlspecialchars($task['title']) . "\n";
			if($task['description'] == null)
			{
				$task1[$key]['description'] = "Pas de description" . "\n";
			}
			else
			{
				$task1[$key]['description'] = nl2br(htmlspecialchars($task['description'])) . "\n";
			}
		}
		return $task1;		
	}

	function display_task($id)
	{
		$tasks = new Model_tasks();
		$task1 = $tasks->get_task($id);

		if(isset($task1['id']))
		{
			foreach($task1 as $key => $task)
			{
				echo $task1[$key]['title'] = htmlspecialchars($task['title']) . "\n";

				if($task['description'] == null)
				{
					echo "Pas de description" . "\n";
				}
				else
				{
					echo $task1[$key]['description'] = nl2br(htmlspecialchars($task['description'])) . "\n";
				}
				echo $task1[$key]['creation_date'] = htmlspecialchars($task['creation_date']) . "\n";
				echo $task1[$key]['edition_date'] = htmlspecialchars($task['edition_date']) . "\n";
			}	
		}
		else
		{
			echo "Aucune tâche correspondante" . "\n";
			return;
		}	
	}

	function create()
	{
		$tasks = new Model_tasks();
		
		if(isset($_POST['task_title']))
		{
			$title = $this->secure_input($_POST['task_title']);

			if(isset($_POST['task_description']))
			{
				$description = $this->secure_input($_POST['task_description']);
			}

			$task1 = $tasks->post_task($title, $description);
			echo "Tâche ajoutée" . "\n";
		}	

		else
		{
			echo "Merci de rentrer au moins un titre de tâche";
			return;
		}	

		header("Location: " . "Views/task/create.php");
	}

	function delete($id)
	{
		$tasks = new Model_tasks();
		$test = $tasks->get_task($id);

		if(isset($test['id']))
		{
			$task1 = $tasks->delete_task($id);
		}
		else
		{
			echo "Cet ID n'est pas reconnu" . "\n";
			return;
		}
	}


	function edit($id)
	{
		$mt = new Model_tasks();
		$task = $mt->get_task($id);
		
		if(!$task)
		{
			echo "Cette tâche n'existe pas !" . "\n";
			return;
		}

		if(isset($_POST['task_title']))
		{
			$title = $this->secure_input($_POST['task_title']);

			if(isset($_POST['task_description']))
			{
				$description = $this->secure_input($_POST['task_description']);
			}

			$task1 = $mt->put_task($id, $title, $description);
			echo "Tâche modifiée !" . "\n";
		}	

		else
		{
			echo "Merci de rentrer au moins un titre de tâche";
			return;
		}	

		header("Location: " . "Views/task/edit.php");
	}



	function secure_input($data)
	{
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}


	/*//permet de fusionner toutes les données qu'on veut donner au view
	function set()
	{

	}

	//fonction qui importe les données avec la méthode extract puis charge la mise en page demandée dans les views
	//prépare les données pr le view
	function render()
	{

	}*/
}

$test = new Controller_tasks();
$display = $test->edit(6);
//var_dump($display);

?>
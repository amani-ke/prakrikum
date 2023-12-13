<?php

/*
    Class implementing Singleton pattern to get a cursor to the current database.
*/
class MysqlDatabase {

    /* cursor to DB connection */
    private $cursor = null;

    /* Singleton instance - not needed in class methods */
    private static $instance = null;

    /*
        Use this method to get access to the database connection.
    */
    public static function get_instance(){
        if(self::$instance == null){
            self::$instance = new MysqlDatabase();
        }
        return self::$instance;
    }

    /*
        Private constructor to implement Singleton. Do not use this method for instatiation!
    */
	private function __construct(){
		$host = '127.0.0.1';
		$db = 'realdb';
		$user = 'wt1_prakt';
		$pw = 'abcd';
		
		$dsn = "mysql:host=$host;port=3306;dbname=$db";
		
		$options = [
			PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
			PDO::ATTR_CASE => PDO::CASE_NATURAL
		];

		try{
            $this->cursor = new PDO($dsn, $user, $pw, $options);
		} 
		catch(PDOException $e){
			echo "Verbindungsaufbau gescheitert: " . $e->getMessage();
		}
    }
    
    /*
        Do not call this method directly.
    */
	public function __destruct(){
		$this->cursor = NULL;	
    }

    // Method to read tasks from the database
    public function read_tasks() {
        $query = "SELECT id, due_date, description, priority FROM Task";
        $statement = $this->cursor->query($query);
        $tasks = [];

        while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
            $task = new Task($row['id'], $row['due_date'], $row['description'], $row['priority']);
            $tasks[] = $task;
        }

        return $tasks;
    }

    // Method to delete a task from the database
    public function delete_task($task_id) {
        $query = "DELETE FROM Task WHERE id = :id";
        $statement = $this->cursor->prepare($query);
        $statement->bindParam(':id', $task_id, PDO::PARAM_INT);
        $statement->execute();
    }
}

?>

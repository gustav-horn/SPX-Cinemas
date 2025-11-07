<?php 

class DatabaseSingleton {
    // 1. static property holds single instance of the class
    private static ?DatabaseSingleton $instance = null;

    // 2. property holds PDO database connection
    private PDO $connection;

    /**
     * Private constructor to prevent creation of new insances
     * (like through "via new DatabaseSingleton()")
     */

    private function __construct() {
        $host = "localhost";
        $db = "SPXCinemasDb";
        $user = "spxcinemas";
        $pass = "spxcinemas";
        $charset = "utf8mb4";

        $dsn = "mysql:host={$host}; dbname={$db}; charset={$charset}";

        try {
            // Attempt to establish the PDO connection
            $this->connection = new PDO($dsn, $user, $pass);

            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

        }

        catch(PDOException $e) {
            error_log("Database connection failed: ". $e->getMessage());
            exit("Critical Error: Database connection failed.");
        }
    }

    public static function getInstance(): DatabaseSingleton {
        if (self::$instance === null) {
            self::$instance = new DatabaseSingleton();
        }
        return self::$instance;
    }

    /**
     * Generic method for SELECT (i.e. non-mutating) queries
     * Uses prepared statements for security (i.e. to prevent SQL injection attacks)
     * @param string $sql The SQL query to execute
     * @param array $param Optional array of parameters for the prepared statement
     * @return array The resulting data as an array of associative arrays
     */
    public function query(string $sql, array $params = []): array {
        $stmt = $this->connection->prepare($sql);

        // Handle positional arguments
        if (!empty($params)) {
            // Check to determine if using positional (?) or named (:key) parameters

            if (array_keys($params)[0] === 0) { //Positional
                $i = 1;
                foreach ($params as $value) {
                    $stmt->bindValue($i, $value, is_int($value) ? PDO::PARAM_INT : PDO::PARAM_STR);
                    $i++;
                }
            }
            else { //Named
                foreach ($params as $key => $value) {
                    $stmt->bindValue(":".$key, $value, is_int($value) ? PDO::PARAM_INT : PDO::PARAM_STR);
                }
            }
        }

        //Actually execute our SQL
        $stmt->execute();
        return $stmt->fetchAll();
    }

    /**
     * Generic method for INSERT, UPDATE AND DELETE statements (i.e. mutating queries)
     * Ueses prepared statements for security (to prevent SQL injection)
     * @param string $sql The SQL statement to execute
     * @param array $params Optional array of parameters for the prepared statement.
     * @return int The number of rows affected
     */
    public function execute(string $sql, array $params = []): int {
        $stmt = $this->connection->prepare($sql);

        // Fill the statement with the positional arguments
        if (!empty($params)) {
           // Check to determine if using positional (?) or named (:key) parameters

            if (array_keys($params)[0] === 0) { //Positional
                $i = 1;
                foreach ($params as $value) {
                    $stmt->bindValue($i, $value, is_int($value) ? PDO::PARAM_INT : PDO::PARAM_STR);
                    $i++;
                }
            }
            else { //Named
                foreach ($params as $key => $value) {
                    $stmt->bindValue(":".$key, $value, is_int($value) ? PDO::PARAM_INT : PDO::PARAM_STR);
                }
            }
        }

        //Actually execute the statment
        $stmt->execute();
        return $stmt->rowCount();
    }

    /**
     * Returns the Id of the last inserted row or sequence value.
     * Useful after an INSERT operation.
     * @return string The last inserted Id
     */
    public function lastInsertId(): string {
        return $this->connection->lastInsertId();
    }

    // --- Prevent Cloning and Unserialization to ensure single instance -- 
    private function __clone() {}
}
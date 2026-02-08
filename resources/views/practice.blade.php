<?php

    // accept number and returns even or odd
    function checkEvenOdd($number) {
        if ($number % 2 == 0) {
            return "Even";
        } else {
            return "Odd";
        }
    }

// sample usage
echo checkEvenOdd(4); // even ito
echo checkEvenOdd(7); // odd ito

// Print only numbers greater than 10

$numbers = [5, 10, 15, 20, 25];

foreach ($numbers as $num) {
    if ($num > 10 ) {
        echo $num . PHP_EOL;
    }
}

// using array_filter

$result = array_filter($numbers, function ($num) {
    return $num > 10;
});

print_r($result);

$username = "admin";

if (!empty($username) && strlen($username) >=5 ) {
    echo "Valid username";
} else {
    echo "Username too short";
}

// query to get all active users
SELECT * FROM users
WHERE status = 'active'
ORDER BY name ASC;

// query to show user name && order total
/*  JOIN 

Tables:

orders
| id | user_id | total |

users
| id | name |

 Write a query to show:

user name

order total */

SELECT users.name, orders.total
FROM orders
INNER JOIN users ON orders.user_id = users.id;

// cleaner 
SELECT u.name, o.total
FROM orders o
JOIN users u ON o.user_id = u.id;

// multiple orders
SELECT u.name, o.total
FROM users u
JOIN orders o ON o.user_id = u.id;

//total amount per user
SELECT u.name, SUM(o.total) AS total_amount
FROM users u
JOIN orders o ON o.user_id = u.id
GROUP BY u.name;

// sample PDO

<?php 

try {
    $pdo = new PDO (
        "mysql:host=localhost;dbname=sample_db;charset=utf8",
        "root",
        "",
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]
        );
} catch (PDOException $e) {
    die("Database connection failed");
}

// test

for ($i = 1; $i <=50; $i++) {
    if ($i % 3 == 0 && $i % 5 == 0) {
        echo "FizzBuzz";
    } elseif ($i % 3 == 0) {
        echo "Fizz";
    } elseif ($i % 5 == 0) {
        echo "Buzz";
    } else {
        echo $i;
    }

    echo PHP_EOL;
}

// test email validate
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $email = trim($_POST['email'] ?? '');

    if($email && filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Valid email";
    } else {
        echo "Invalid email";
    }
}

// sql test

SELECT *
FROM products
WHERE stock > 0
ORDER BY price DESC;

//cleaner SQL
SELECT id, name, price, stock
FROM products
WHERE stock > 0
ORDER BY price DESC;


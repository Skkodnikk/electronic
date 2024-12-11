<?php
session_start();
$host = 'localhost';
$db_name = 'electronic';
$username = 'kot';
$password = 'owo';
if (isset($_SESSION['user_ID'])) {
    $user_ID = $_SESSION['user_ID'];
    $review = $_POST['review'];

    // Подключение к базе данных
    $conn = new mysqli('electronic', 'username', 'password', 'database');

    // Проверка соединения
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Подготовка и выполнение SQL-запроса
    $stmt = $conn->prepare("INSERT INTO reviews (user_ID, review) VALUES (?, ?)");
    $stmt->bind_param("is", $user_ID, $review);

    if ($stmt->execute()) {
        echo "Ваш отзыв был успешно добавлен.";
    } else {
        echo "Ошибка: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Вы должны войти, чтобы оставить отзыв.";
}
?>

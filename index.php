<?php
header('Content-Type: text/html; charset=utf-8');

$servername = "DB_SERVER_PRIVATE_IP";  // DB 서버의 프라이빗 IP
$username = "dbuser";
$password = "dbpassword";
$dbname = "testdb";

// MySQL 연결
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("MySQL 연결 실패: " . $conn->connect_error);
}

// 주소록 데이터 조회
$sql = "SELECT id, name, phone, email, address FROM address_book";
$result = $conn->query($sql);

// index.html 파일 삽입
include("./index.html");

// HTML 테이블 출력
echo "<h2>주소록</h2>";
if ($result->num_rows > 0) {
    echo "<table border='1' cellpadding='5'>";
    echo "<tr><th>ID</th><th>이름</th><th>전화번호</th><th>이메일</th><th>주소</th></tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row["id"]) . "</td>";
        echo "<td>" . htmlspecialchars($row["name"]) . "</td>";
        echo "<td>" . htmlspecialchars($row["phone"]) . "</td>";
        echo "<td>" . htmlspecialchars($row["email"]) . "</td>";
        echo "<td>" . htmlspecialchars($row["address"]) . "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "주소록에 데이터가 없습니다.";
}

$conn->close();
?>

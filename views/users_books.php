<?php
 $data = $authorController->view();
 

 

 ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Пользователи и их книги</title>
</head>
<body>
    <h1>Пользователи и их книги</h1>
    <table border="1">
        <tr>
            <th>Пользователь</th>
            <th>Книги</th>
            <th>Начало</th>
            <th>Конец</th>
            <th>Вернул(да/нет)</th>
        </tr>
        <?php
        
        foreach ($data as $key=>$value){
          echo" <tr>";
           echo "<td>".$key."</td>";
            foreach ($value as $key => $val) {
                
                echo" <td>".$val['title']."</td>";
               echo  "<td>". $val['start_date'] ."</td>";
               echo  "<td>". $val['due_date'] ."</td>";
               if ($val['returned']) {
                echo  "<td>да</td>";
               }else {
                echo  "<td>нет</td>";
               }
            }
        }
            ?>

    </table>
</body>
</html>

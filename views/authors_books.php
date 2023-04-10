<?php
 $data = $authorController->view();
 $authors = $data['authors'];     
 $books = $data['books']; 
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Авторы и их книги</title>
</head>
<body>
    <h1>Авторы и их книги</h1>
    <table border="1">
        <tr>
            <th>Автор</th>
            <th>Книги</th>
        </tr>
        <?php
        foreach ($authors as $author): ?>
            <tr>
                <td><?= htmlspecialchars($author['name']) ?></td>
                <td>
                    <ul>
                        <?php foreach ($books as $book): ?>
                            <?php if ($book['author_id'] == $author['id']): ?>
                                <li><?= htmlspecialchars($book['title']) ?></li>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </ul>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>

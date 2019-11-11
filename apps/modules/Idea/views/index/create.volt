<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Create Idea</title>
</head>

<body>
    {% if isAuth is not true %}
    <a href="/tugas-kpl/user/signup">Daftar disini</a>
    <a href="/tugas-kpl/user/login">Login disini</a>
    {% else %}
    <a href="/tugas-kpl/user/logout">Logout</a>
    {% endif %}
    <h1>Buat Ide</h1>
    <form action="./create" method="post">
        <input type="text" name="content" placeholder="Content">
        <br>
        <input type="text" name="description" placeholder="Description">
        <br>
        <input type="submit">
    </form>
</body>

</html>
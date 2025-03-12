<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="add.css">
    <style>
        body {
            font-family: "Roboto", sans-serif;
            margin: 20px;
            background: linear-gradient(to right, #e0eafc, #cfdef3);
        }

        .fade-in {
            animation: fadeIn 1s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
            color: #343a40;
        }

        form {
            width: 50%;
            margin: 20px auto;
            padding: 20px;
            border: 1px solid #ced4da;
            border-radius: 5px;
            background-color: #f8f9fa;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 5px;
            color: #343a40;
        }

        input[type="text"],
        input[type="password"],
        select,
        input[type="date"],
        textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ced4da;
            border-radius: 5px;
            box-sizing: border-box;
        }

        button[type="submit"],
        a {
            padding: 10px 15px;
            margin: 5px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.2s ease;
            text-decoration: none;
        }

        button[type="submit"] {
            background-color: #007bff;
            color: white;
        }

        a {
            background-color: #ffc107;
            color: white;
        }

        button[type="submit"]:hover {
            background-color: #0056b3;
            transform: scale(1.02);
        }

        a:hover {
            background-color: #535a5e;
            transform: scale(1.02);
        }
    </style>
</head>

<body class="fade-in">
    <h1>Register</h1>
    <form action="process_register.php" method="POST">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>
        <br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        <br>
        <label for="nisn">NISN:</label>
        <input type="text" id="nisn" name="nisn" required>
        <br>
        <label for="role">Role:</label>
        <select id="role" name="role" required>
            <option value="admin">Admin</option>
            <option value="guru">Guru</option>
            <option value="siswa">Siswa</option>
        </select>
        <br>
        <button type="submit">Register</button>
    </form>
</body>

</html>
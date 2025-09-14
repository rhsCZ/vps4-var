<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Centered Form with Response Frame</title>
    <link rel="stylesheet" href="dnsquery.css">
</head>
<body>
    <div class="container">
        <div class="response-frame" id="responseFrame">
            <!-- This is where the response will appear -->
        </div>
        <form class="centered-form">
            <label for="inputField">Enter Something:</label>
            <input type="text" id="inputField" name="inputField" required>
            <button type="submit">Submit</button>
        </form>
    </div>
</body>
</html>
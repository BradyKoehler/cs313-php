<!DOCTYPE html>
<html>
<head>

  <title>Brady Koehler</title>
  <link rel="stylesheet" href="styles/main.css" type="text/css" />

</head>
<body>

  <aside>
    <h1>Brady Koehler</h1>

    <img src="img/me.jpg" />

    <ul>
      <li><a class="underline" href="/assignments">Assignments</a></li>
    </ul>
  </aside>

  <div id="main">
    <h1 class="hero">Welcome to my PHP testing site.</h1>
    <p>I'm a software developer, specializing in web development.</p>
    <p>This site contains the assignments for my web development class, as well
      as any other PHP projects I feel like working on.</p>

    <br /><hr /><br />

    <h2>Contact me</h2>
    <p>If you'd like to leave me a message, please fill out the form below.</p>
    <form action="/message.php" method="POST">
      <label for="name">Name</label><br />
      <input id="name" name="name" type="text" />
      <br /><br />
      <label for="message">Message</label><br />
      <textarea id="message" name="message" cols="60" rows="5"></textarea>
      <br /><br />
      <input type="submit" value="Submit" />
    </form>
  </div>

  <div id="css-editor">
    <textarea placeholder="type here to edit the css of this page" cols="31"></textarea>
  </div>

  <script src="scripts/main.js" type="text/javascript"></script>
</body>
</html>

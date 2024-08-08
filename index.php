<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laptop Check System</title>
   <link rel="stylesheet" href="style_index.css">
    <script src="script.js" defer></script>
</head>
<body>
    <?php include 'header.php'; ?>

    <div class="main-container">
        <aside class="sidebar">
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="#">Students</a></li>
                <li><a href="#">Laptops</a></li>
                <li><a href="#about">About</a></li>
                <li><a href="login.php">Login</a></li>
            </ul>
        </aside>
        
        <main class="content">
            <h1></h1>
            <div class="carousel">
                <img src="laptop 1.jpeg" alt="Image 1">
                <img src="laptop 2.jpg" alt="Image 2">
                <img src="laptop 3.jpeg" alt="Image 3">
            </div>
            
            <section  id="about"  class="about">
                <h2>About Us</h2>
                <p>Welcome to the Demo University Library. We provide a wide range of resources to help you with your studies and research. Our library is equipped with the latest technology and a comfortable environment to ensure you have the best experience possible.</p>
            </section>
        </main>
    </div>

    <?php include 'footer.php'; ?>
</body>
</html>

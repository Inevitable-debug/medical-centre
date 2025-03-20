<?php //designed with assistance from chat gpt
$pageTitle = "Russel Street Medical"; // Set the page title for this specific page
require_once 'head.php'; // Include the common head section
require_once 'tools.php';
?>
<body>
<?php require_once 'header.php'; // Include the common header section ?>

<main>
    <?php require_once 'body.php'; // Include the common body section ?>
</main>

<?php require_once 'footer.php'; // Include the common footer section ?>
<!-- Include the carousel plugin script -->
<script src="carousel-plugin.js"></script>

<!-- Use the CarouselPlugin here -->
<script>
    const containerSelector = ".carousel-container";
    // Pass your container, prevButton, and nextButton selectors here
    CarouselPlugin(containerSelector, "#prevBtn", "#nextBtn");
</script>
</body>
</html>
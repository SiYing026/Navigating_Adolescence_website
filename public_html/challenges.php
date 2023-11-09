<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
   <link rel="icon" type="image/x-icon" href="images/favicon.png" sizes="32x32">
<!--     font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

<!--     custom css file link  -->
    <link rel="stylesheet" href="css/style.css">

</head>
<body>
    
<?php include('header.php'); ?>
<section class="heading">
    <h3>challenges will be faced during adolescence </h3>
    <p> <a href="home.php">home >></a> information >> <a href="challenges.php">Challenges</a> </p>
</section>
    
<!-- Category buttons -->
<div class="button-container">
    <button class="category-button" data-category="*">All</button>
    <button class="category-button" data-category="Identity Formation">Identity Formation</button>
    <button class="category-button" data-category="Peer Pressure">Peer Pressure</button>
    <button class="category-button" data-category="Academic Expectations">Academic Expectations</button>
    <button class="category-button" data-category="Future Concerns">Future Concerns</button>
</div>


    <!-- Display filtered items here -->
    <style>
        #filteredItems {
            display: -ms-grid;
            display: grid;
            -ms-grid-columns: (minmax(31rem, 1fr))[auto-fit];
                grid-template-columns: repeat(auto-fit, minmax(31rem, 1fr));
            gap: 1.5rem;
  
  
        }
    </style>
    
    <section class="course-1">
    <div id="filteredItems">
        
    </div>
        </section>
    
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            // Get the category buttons and the container to display filtered items
            const categoryButtons = document.querySelectorAll(".category-button");
            const filteredItemsContainer = document.getElementById("filteredItems");

            // Function to fetch and display items based on the selected category
            function fetchAndDisplayItems(selectedCategory) {
                // Send an AJAX request to a PHP script to fetch items from the database
                fetch("php/challenges_fetch_data.php", {
                    method: "POST",
                    body: JSON.stringify({ category: selectedCategory }),
                    headers: {
                        "Content-Type": "application/json",
                    },
                })
                .then(response => response.text())
                .then(data => {
                    // Display the retrieved items in the container
                    filteredItemsContainer.innerHTML = data;
                })
                .catch(error => console.error(error));
            }

            // Add event listener to each category button
            categoryButtons.forEach(button => {
                button.addEventListener("click", function (event) {
                    const selectedCategory = event.target.getAttribute("data-category");
                    fetchAndDisplayItems(selectedCategory);
                });
            });

            // Load all items when the page loads
            fetchAndDisplayItems("*");
        });
    </script>

<?php include('footer.php'); ?>
<!-- custom js file link  -->
        <script src="js/script.js"></script>

</body>
</html>
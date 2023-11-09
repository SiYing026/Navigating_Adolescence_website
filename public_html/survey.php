
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="icon" type="image/x-icon" href="images/favicon.png" sizes="32x32">

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" />
   

    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/style.css">

</head>
<body>
    
<!-- header section starts  -->

<?php include('header.php'); ?>

<style>
/* Add your CSS styles here */
.rating {
    margin-bottom: 20px;
    justify-content: flex-start;
}

.stars {
    width: 100%;
    display: flex;
    direction: rtl; /* Set the direction to right-to-left */
    padding-right: 70%;
    background: #fff;
}

.stars input[type="radio"] {
    display: none;
}

.stars label {
    font-size: 50px;
    cursor: pointer;
    padding: 0rem 2rem;
}

.stars label::before {
    content: "\2605";
    color: #ccc;
    transition: color 0.2s ease-in-out;
}

.stars input[type="radio"]:checked ~ label::before {
    color: #ffcc00;
}
</style>
<section class="heading">
    <h3>Just telling the truth</h3>
    <p> <a href="home.php">home >></a> Survey</p>
</section>

<section class="survey">

    <div class="icons-container">

        <div class="icons">
            <h3>Congratulations! You've successfully completed the VR experience.</h3>
            <p>We're interested in understanding your emotions and opinions. </p>
            <span>Note: Your data will be used by Navigating Adolescence to enhance 
                our platform and services, 
                ensuring the privacy and security of your information. 
                Refer to our Privacy Policy for details on data handling and protection.</span>
        </div>

    </div>

    <?php
if(isset($_POST['submit_rating']))
{
    $host = "localhost";
    $username = "root";
    $password = "Siyingdb*123";
    $database = "navigating_adolescence";

    $conn = new mysqli($host, $username, $password, $database);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION['user_id'];
    $rating1 = $_POST["rating1"];
    $rating2 = $_POST["rating2"];
    $topic = $_POST['topics'];
    $techniques = $_POST['q4'];
    $rating3 = $_POST["rating3"];
    $features = $_POST['q2'];
    $rating4 = $_POST['rating4'];
    $rating5 = $_POST['rating5'];

    $sql = "INSERT INTO survey (user_id, rating1, rating2, topic, techniques, rating3, features, rating4, rating5) "
            . "VALUES ('$user_id', '$rating1', '$rating2', '$topic', '$techniques', '$rating3', '$features', '$rating4', '$rating5')";
    if ($conn->query($sql) !== TRUE) {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    echo '<script>
            window.alert("Thank you for your feedback.");
            window.location.href = "home.php";
        </script>';
}


    $conn->close();
}
?>
<div class="row">
    <form action="survey.php" method="POST">
        <div class="rating">
            <h3>Dealing with Stress</h3>
            <label for="rating1"><p>1. Did the content meet your expectations in providing information on dealing with stress during adolescence?</p></label>
            <div class="stars">
                <input type="radio" name="rating1" value="5" id="star1" required>
                <label for="star1"></label>
                <input type="radio" name="rating1" value="4" id="star2" required>
                <label for="star2"></label>
                <input type="radio" name="rating1" value="3" id="star3" required>
                <label for="star3"></label>
                <input type="radio" name="rating1" value="2" id="star4" required>
                <label for="star4"></label>
                <input type="radio" name="rating1" value="1" id="star5" required>
                <label for="star5"></label>
            </div>
        </div>

        <div class="rating">
            <label for="rating2"><p>2. Were you able to find relevant and helpful information on the website?</p></label>
            <div class="stars">
                <input type="radio" name="rating2" value="5" id="star6" required>
                <label for="star6"></label>
                <input type="radio" name="rating2" value="4" id="star7" required>
                <label for="star7"></label>
                <input type="radio" name="rating2" value="3" id="star8" required>
                <label for "star8"></label>
                <input type="radio" name="rating2" value="2" id="star9" required>
                <label for="star9"></label>
                <input type="radio" name="rating2" value="1" id="star10" required>
                <label for="star10"></label>
            </div>
        </div>
        
        <p>3. Are there specific topics related to adolescent stress you would like to see covered in the future?</p>
            <div class="card">
              <div class="content">
                <input type="radio" name="topics" id="one" value="Stress management techniques" required>
                <input type="radio" name="topics" id="two" value="Mental health resources" required>
                <input type="radio" name="topics" id="three" value="Coping with academic pressure" required>
                <input type="radio" name="topics" id="four" value="Healthy communication with parents" required>
                <input type="radio" name="topics" id="five" value="Tips for dealing with peer pressure" required>
                <label for="one" class="box first">
                  <div class="plan">
                    <span class="circle"></span>
                    <span class="yearly">Stress management techniques</span>
                  </div>
                </label>
                <label for="two" class="box second">
                  <div class "plan">
                    <span class="circle"></span>
                    <span class="yearly">Mental health resources</span>
                  </div>
                </label>
                <label for="three" class="box third">
                  <div class="plan">
                    <span class="circle"></span>
                    <span class="yearly">Coping with academic pressure</span>
                  </div>
                </label>
                <label for="four" class="box four">
                  <div class="plan">
                    <span class="circle"></span>
                    <span class="yearly">Healthy communication with parents</span>
                  </div>
                </label>
                <label for="five" class="box five">
                  <div class="plan">
                    <span class="circle"></span>
                    <span class="yearly">Tips for dealing with peer pressure</span>
                  </div>
                </label>
              </div>
            </div>
        
        <p>4. Have you applied any stress management techniques learned from the website in your daily life?</p>
            <textarea name="q4" placeholder="You can mention specific techniques or strategies and how they have helped you." required></textarea>
            
        <span class="br"></span> 
        <div class="rating">
            <h3>Safe and Private Experience</h3>
            <label for="rating3"><p>1. How secure and private did you feel when exploring the virtual reality exhibition?</p></label>
            <div class="stars">
                <input type="radio" name="rating3" value="5" id="star11" required>
                <label for="star11"></label>
                <input type="radio" name="rating3" value="4" id="star12" required>
                <label for="star12"></label>
                <input type="radio" name="rating3" value="3" id="star13" required>
                <label for="star13"></label>
                <input type="radio" name="rating3" value="2" id="star14" required>
                <label for="star14"></label>
                <input type="radio" name="rating3" value="1" id="star15" required>
                <label for="star15"></label>
            </div>
        </div>
        
        <p>2. Were there any specific features or aspects of the VR environment that contributed to your sense of security?</p>
            <textarea name="q2" placeholder="Please describe any specific features or aspects that made you feel more secure or any suggestions for improvement." required cols="30" rows="10"></textarea>
            
        <div class="rating">
            <label for="rating4"><p>3. Overall, how satisfied are you with the VR experience, and how has it affected your willingness to explore your mental stress challenges?</p></label>
            <div class="stars">
                <input type="radio" name="rating4" value="5" id="star16" required>
                <label for="star16"></label>
                <input type="radio" name="rating4" value="4" id="star17" required>
                <label for="star17"></label>
                <input type="radio" name="rating4" value="3" id="star18" required>
                <label for="star18"></label>
                <input type="radio" name="rating4" value="2" id="star19" required>
                <label for="star19"></label>
                <input type="radio" name="rating4" value="1" id="star20" required>
                <label for="star20"></label>
            </div>
        </div>
            
        <div class="rating">
            <label for="rating5"><p>4. Did you feel a sense of connection with other participants who may be dealing with similar challenges?</p></label>
            <div class="stars">
                <input type="radio" name="rating5" value="5" id="star21" required>
                <label for="star21"></label>
                <input type="radio" name="rating5" value="4" id="star22" required>
                <label for="star22"></label>
                <input type="radio" name="rating5" value="3" id="star23" required>
                <label for="star23"></label>
                <input type="radio" name="rating5" value="2" id="star24" required>
                <label for="star24"></label>
                <input type="radio" name="rating5" value="1" id="star25" required>
                <label for="star25"></label>
            </div>
        </div>

        <button type="submit" name="submit_rating" class="btn">Submit Ratings</button>
    </form>
</div>
    </section>
<?php include('footer.php'); ?>
</body>
</html>

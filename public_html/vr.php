<html lang="en-us">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link rel="stylesheet" href="TemplateData/style.css">
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
  
  <?php include('header.php'); ?>
    <section class="heading">
    <h3>Navigating Adolescence Virtual Reality Explore</h3>
    <p> <a href="home.php">home >></a> Virtual Reality </p>
</section>
  
  <section class="todo">

    <div class="image">
        <img src="images/vrimg.png" alt="">
    </div>

    <div class="content">
        <h4>To-do List Before Entering VR Exhibition : </h4> 
        
        <h4>1. Prepare Your Space:</h4> 
        <p>Create a comfortable, distraction-free environment for the virtual reality experience.</p>

        <h4>2. Stay Open-Minded:</h4> 
        <p>Approach the exhibition with an open mind and a willingness to explore diverse perspectives.</p>
        
        <h4>3. Cultivate Empathy:</h4> 
        <p>Develop empathy by understanding the challenges and growing pains of the individuals featured.</p>
        
        <h4>4. Seek More Knowledge:</h4> 
        <p>If a topic interests you, pursue additional resources or consult experts for further insight.</p>
        
        <h4>5. Share and Discuss:</h4> 
        <p>Engage in post-exhibition discussions with friends or family to reflect and share your insights.</p>
        
    </div>
</section>
  
  <div class="control">
          <style>
              .control {
                  background: #def1fa; 
                  padding-top: 8rem;
                  padding-bottom: 8rem;
              }
              .control p {
                  text-transform: none;
                  font-size: 1.7rem;
                  text-align: center;
              }
              
              .unity {
                  background: #def1fa; 
                  height: 800px;
              }
              .unity .btn {
                position: absolute;
                margin-bottom: 0px;
                margin-top: 652px;
                left: 50%;
                transform: translateX(-50%);
              }
          </style>
          <p><b>W (Forward):</b> Press the 'W' key to move forward in the virtual world.</p>
            <p><b>S (Backward):</b> Use the 'S' key to step back.</p>
            <p><b>A (Left):</b> Press 'A' to move to the left.</p>
            <p><b>D (Right):</b> Use the 'D' key to move to the right.</p>
            <p>Move your mouse to control your viewpoint. This allows you to look around in any direction.</p>
      </div>
  
  <section class="unity" style="">
  <body data-new-gr-c-s-check-loaded="14.1045.0" data-gr-ext-installed="" >
    <div id="unity-container" class="unity-desktop" style="margin-top: 1052px">
      <canvas id="unity-canvas" width="1920" height="1200" tabindex="-1" style="width: 960px; height: 600px; cursor: default; "></canvas>
      <div id="unity-loading-bar" style="display: none;">
        <div id="unity-logo"></div>
        <div id="unity-progress-bar-empty">
          <div id="unity-progress-bar-full" style="width: 100%;"></div>
        </div>
      </div>
      <div id="unity-warning"> </div>
      <div id="unity-footer">
        <div id="unity-webgl-logo"></div>
        <div id="unity-fullscreen-button"></div>
        <div id="unity-build-title">Exhibition</div>
      </div>
      </div>
      <a href="survey.php" class="btn">Complete Explore</a>
    </section>
    
    <script>

      var container = document.querySelector("#unity-container");
      var canvas = document.querySelector("#unity-canvas");
      var loadingBar = document.querySelector("#unity-loading-bar");
      var progressBarFull = document.querySelector("#unity-progress-bar-full");
      var fullscreenButton = document.querySelector("#unity-fullscreen-button");
      var warningBanner = document.querySelector("#unity-warning");

      // Shows a temporary message banner/ribbon for a few seconds, or
      // a permanent error message on top of the canvas if type=='error'.
      // If type=='warning', a yellow highlight color is used.
      // Modify or remove this function to customize the visually presented
      // way that non-critical warnings and error messages are presented to the
      // user.
      function unityShowBanner(msg, type) {
        function updateBannerVisibility() {
          warningBanner.style.display = warningBanner.children.length ? 'block' : 'none';
        }
        var div = document.createElement('div');
        div.innerHTML = msg;
        warningBanner.appendChild(div);
        if (type == 'error') div.style = 'background: red; padding: 10px;';
        else {
          if (type == 'warning') div.style = 'background: yellow; padding: 10px;';
          setTimeout(function() {
            warningBanner.removeChild(div);
            updateBannerVisibility();
          }, 5000);
        }
        updateBannerVisibility();
      }

      var buildUrl = "Build";
      var loaderUrl = buildUrl + "/Build.loader.js";
      var config = {
        dataUrl: buildUrl + "/Build.data",
        frameworkUrl: buildUrl + "/Build.framework.js",
        codeUrl: buildUrl + "/Build.wasm",
        streamingAssetsUrl: "StreamingAssets",
        companyName: "DefaultCompany",
        productName: "Exibition",
        productVersion: "0.1",
        showBanner: unityShowBanner,
      };

      // By default, Unity keeps WebGL canvas render target size matched with
      // the DOM size of the canvas element (scaled by window.devicePixelRatio)
      // Set this to false if you want to decouple this synchronization from
      // happening inside the engine, and you would instead like to size up
      // the canvas DOM size and WebGL render target sizes yourself.
      // config.matchWebGLToCanvasSize = false;

      if (/iPhone|iPad|iPod|Android/i.test(navigator.userAgent)) {
        // Mobile device style: fill the whole browser client area with the game canvas:

        var meta = document.createElement('meta');
        meta.name = 'viewport';
        meta.content = 'width=device-width, height=device-height, initial-scale=1.0, user-scalable=no, shrink-to-fit=yes';
        document.getElementsByTagName('head')[0].appendChild(meta);
        container.className = "unity-mobile";
        canvas.className = "unity-mobile";

        // To lower canvas resolution on mobile devices to gain some
        // performance, uncomment the following line:
        // config.devicePixelRatio = 1;


      } else {
        // Desktop style: Render the game canvas in a window that can be maximized to fullscreen:

        canvas.style.width = "960px";
        canvas.style.height = "600px";
      }

      loadingBar.style.display = "block";

      var script = document.createElement("script");
      script.src = loaderUrl;
      script.onload = () => {
        createUnityInstance(canvas, config, (progress) => {
          progressBarFull.style.width = 100 * progress + "%";
              }).then((unityInstance) => {
                loadingBar.style.display = "none";
                fullscreenButton.onclick = () => {
                  unityInstance.SetFullscreen(1);
                };
              }).catch((message) => {
                alert(message);
              });
            };

      document.body.appendChild(script);

    </script><script src="Build/Build.loader.js"></script>
  

<script src="blob:http://localhost:10083/088135de-47fd-4171-ba7a-23abd72fd92a"></script>
  </body>
  <grammarly-desktop-integration data-grammarly-shadow-root="true"></grammarly-desktop-integration>
  
</html>

<?php include('footer.php'); ?>
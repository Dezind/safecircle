<!------------------------------------------ Loading Screen ------------------------------------------>
<div id="loading-screen">
    <img src="images/loading.gif" alt="Loading..." class="loading-gif">
</div>

<script>
    function hideLoadingScreen() {
        setTimeout(function() {

            document.getElementById("loading-screen").style.opacity = "0";
            document.getElementById("content").style.display = "block";
            document.getElementById("content").style.opacity = "1";
            //document.getElementById("loading-screen").style.display = "none";
        }, 2000); // Adjust the delay in milliseconds (2000 ms = 2 seconds)

        setTimeout(function() {
            document.getElementById("loading-screen").style.display = "none";
        }, 2700);
    }
</script>
<!------------------------------------------ Loading Screen ------------------------------------------>
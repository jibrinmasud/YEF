<?php require_once 'header.php';?>

 <section id="supporters" class="section-with-bg wow fadeInUp">
      <div class="container">
        <div class="row">
          <div class="col-lg-6">
            <h1 style="text-align:center; margin-left:400px;">Ooops</h1>
            <p style="text-align:center; margin-left:300px;">Site Under Construction</p>
            <p style="text-align:center; margin-left:250px;">Come Back Later  in</p>
            <p id="demo" style="text-align:center; margin-left:250px; font-size:20px;"></p>
          </div>  
        </div>
      </div>
    </section>
<script>
// Set the date we're counting down to
var countDownDate = new Date("Jan 10, 2020 15:37:25").getTime();

// Update the count down every 1 second
var x = setInterval(function() {

  // Get today's date and time
  var now = new Date().getTime();
    
  // Find the distance between now and the count down date
  var distance = countDownDate - now;
    
  // Time calculations for days, hours, minutes and seconds
  var days = Math.floor(distance / (1000 * 60 * 60 * 24));
  var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
  var seconds = Math.floor((distance % (1000 * 60)) / 1000);
    
  // Output the result in an element with id="demo"
  document.getElementById("demo").innerHTML = days + "d " + hours + "h "
  + minutes + "m " + seconds + "s ";
    
  // If the count down is over, write some text 
  if (distance < 0) {
    clearInterval(x);
    document.getElementById("demo").innerHTML = "EXPIRED";
  }
}, 1000);
</script>
<?php require_once 'footer.php';?>

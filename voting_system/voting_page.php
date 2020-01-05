<?php
//Include authentication
require("process/auth.php");

//Include database connection
require("config/db.php");

//Include class Voting
require("classes/Voting.php");
?>
<!DOCTYPE HTML>
<html lang="en-US">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Voting System</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style_voter.css">
    
     
   <!-- Bootstrap CSS File -->
  <link href="../lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Libraries CSS Files -->
  <link href="../lib/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <link href="../lib/animate/animate.min.css" rel="stylesheet">
  <link href="../lib/venobox/venobox.css" rel="stylesheet">
  <link href="../lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

  <!-- Main Stylesheet File -->
  <link href="../css/style.css" rel="stylesheet">
</head>
<body>

<!-- Header -->
<?php require_once "../header.php";?>
<!-- End Header -->



<?php
if(isset($_GET['organization'])) {
    $org = $_GET['organization'];
}
?>

<?php

$readPos = new Voting();
$rtnReadPos = $readPos->READ_POSITION($org);

?>

<div class="container">
    <div class="row">
        <?php if($rtnReadPos) { ?>
        <div class="col-md-6 col-md-offset-3">
            <?php
            if(isset($_POST['vote'])) {
                $org            = trim($_POST['org']);
                $pos            = trim($_POST['pos']);
                $candidate_id   = trim($_POST['nominee']);
                $voters_id       = trim($_POST['voter_id']);


                $insertVote = new Voting();
                $rtnInsertVote = $insertVote->VOTE_NOMINEE($org, $pos, $candidate_id, $voters_id);
            }

            ?>
            <div class="voting-con">

                <h4 style="text-align: center;"><?php echo $org; ?> Voting Page</h4><hr />
                <?php while($rowPos = $rtnReadPos->fetch_assoc()) { ?>
                <form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST" role="form">
                    <p class="help-block"><b><?php echo $rowPos['pos']; ?></b></p>
                        <?php
                        $readNominee = new Voting();
                        $rtnReadNominee = $readNominee->READ_NOMINEES($org, $rowPos['pos']);
                        ?>

                        <?php if($rtnReadNominee) { ?>
                            <div class="form-group">
                                <select name="nominee" class="form-control">
                                    <option value="">*****Select Nominee*****</option>
                                    <?php while($rowNominee = $rtnReadNominee->fetch_assoc()) { ?>
                                    <option value="<?php echo $rowNominee['id']; ?>"><?php echo $rowNominee['name']; ?></option>
                                    <?php } //End while ?>
                                </select>
                            </div>
                        <?php } //End if ?>
                        <input type="hidden" name="org" value="<?php echo $org; ?>">
                        <input type="hidden" name="pos" value="<?php echo $rowPos['pos']; ?>">
                        <input type="hidden" name="voter_id" value="<?php echo $_SESSION['ID']; ?>">

                    <?php
                    $validateVote = new Voting();
                    $rtnValVote = $validateVote->VALIDATE_VOTE($org, $rowPos['pos'], $_SESSION['ID'])
                    ?>
                        <button type="submit" name="vote"
                                <?php if($rtnValVote->num_rows > 0) { ?>
                                <?php echo "class='btn btn-default disabled'>"; ?>
                                <?php } else { ?>
                                <?php echo "class='btn btn-info'>"; ?>
                                <?php } //End if ?>
                            Vote
                        </button>
                </form><hr />
                <?php } //End while ?>
            </div>
        </div>
        <?php } //End if ?>
    </div>
</div>






<!-- Footer -->
<?php require_once "../footer.php";?>
<!-- End Footer -->

<script src="assets/js/jquery.js"></script>
<script src="assets/js/bootstrap.min.js"></script>

</body>
</html>
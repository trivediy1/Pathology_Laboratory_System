<?php 
    include "core/init.php";
    include 'includes/overall/header.php';
?>
<script>
swal({
                title: 'Good job!',
                text: 'You clicked the button!',
                icon: 'success',
                }).then(function(){window.location='index.php';});</script>
        <!--<form>
            <input type="button" id="b1" name="b1" value="show">
        </form>
        <?php
            //echo "<script>swal('Oops!','You Haven't activated your account!', 'error');</script>";
            
        ?>
        <!--<script>
    $("#b1").click(function() {
    swal({ 
  title: "Error",
   text: "wrong user or password",
    type: "error" 
  },
  function(){
      window.location.href = 'index.php';
});
});
</script>
        <script>
        swal({
  title: "Good job!",
  text: "You clicked the button!",
  icon: "success",
  }).then(function(){window.location="index.php";});        
    /*swal({
    title: "Wow!",
    text: "Message!",
    type: "success"
}).then(function() {
    window.location = "index.php";
});*/
                //swal("Good job!", "You clicked the button!", "success");
                //swal('Oops!', 'Something went wrong!', 'error');
                /*swal({
                        title: "Are you sure?",
                        text: "Are you sure that you want to leave this page?",
                        icon: "warning",
                        dangerMode: true,
                      })
                      .then(willDelete => {
                        if (willDelete) {
                          swal("Deleted!", "Your imaginary file has been deleted!", "success");
                        }
                });*/
                /*swal("Type something:", {
                    content: "input",
                  })
                  .then((value) => {
                    swal(`You typed: ${value}`);
                  });*/
        
                /*swal({
                        text: 'Wanna log some information about Bulbasaur?',
                        button: {
                          text: "Search!",
                          closeModal: false,
                        },
                      })
                      .then(willSearch => {
                        if (willSearch) {
                          return fetch(`gautam`)
                        }
                      })
                      .then(result => result.json())
                      .then(json => console.log(json))
                      .catch(err => {
                        swal("Oops!", "Seems like we couldn't fetch the info", "error")
                 });*/
                 

            
        </script> -->
<?php include 'includes/overall/footer.php';?>
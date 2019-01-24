{{-- <script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script> --}}
<script src="{{ asset('js/app.js') }}"></script>  
<script>
  function goBack() {
    window.history.back();
  }
</script>
<script>
    $(function() {
      $('.alert').delay(1500).fadeIn('normal', function() {
          $(this).delay(1500).fadeOut();
          });
      });
</script>

<script>
  function roundToTwo(num) {    
    return +(Math.round(num + "e+2")  + "e-2");
}
$(function() {
    $("#num1, #num2").on("keydown keyup", sum);
	function sum() {
	$("#sum").val(Number($("#num1").val()) + Number($("#num2").val()));
	$("#order_ACTUAR_L").val(roundToTwo(Number($("#num1").val()) - Number($("#num2").val())));
	}
});

</script>


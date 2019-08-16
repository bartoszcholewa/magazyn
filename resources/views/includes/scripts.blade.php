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

<script>
$(document).ready(function() {

$('select[name="order_MATERIAL_ID"]').on('change', function(){
    var orderMaterialId = $(this).val();
    if(orderMaterialId) {
        $.ajax({
            url: '/rolls/get/'+orderMaterialId,
            type:"GET",
            dataType:"json",
            beforeSend: function(){
                $('#loader').css("visibility", "visible");
            },

            success:function(data) {

                $('select[name="order_ROLL_ID"]').empty();

                $.each(data, function(key, value){

                    $('select[name="order_ROLL_ID"]').append('<option value="'+ key +'">' + value + '</option>');
                });
                
            },
            complete: function(){
                $('#loader').css("visibility", "hidden");
                
                
            }
        });
    } else {
        $('select[name="order_ROLL_ID"]').empty();
    }

});

});
</script>
<script>
function centerModal() {
    $(this).css('display', 'block');
    var $dialog = $(this).find(".modal-dialog");
    var offset = ($(window).height() - $dialog.height()) / 2;
    // Center modal vertically in window
    $dialog.css("margin-top", offset);
}

$('.modal').on('show.bs.modal', centerModal);
$(window).on("resize", function () {
    $('.modal:visible').each(centerModal);
});
</script>

<script>
    function search_func(){
        address=document.getElementById("address").value;
        window.location = "?search=" + address;
    }
    function handle(e){
        address=document.getElementById("address").value;
        if(e.keyCode === 13){
            window.location = "?search=" + address;
        }
        return false;
    }
</script>

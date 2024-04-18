
$(document).ready(function() {
  $('#summernote').summernote({
    height: 200
  });

  function loadUsersOnline(){
    $.get("function.php?onlineusers=result", function(data){
      $(".usersonline").html(data);

    });
  }
  setInterval(function(){
    loadUsersOnline();
  },500);

  loadUsersOnline();


  });
  $(document).ready(function() {
    $('#selectAllBoxes').click(function(event){
      if (this.checked) {
        $('.checkBoxes').each(function(){
          this.checked = true;
        });
      } else {
        $('.checkBoxes').each(function(){
          this.checked = false;
      });
      } 

    });
    });
  









$(document).ready(function(){
  fetch_user();

    
  setInterval(function () {
    fetch_user();
  update_chat_history_data();

  }, 5000);
 
  
  $(document).on('click', '.btnEnviar', function(){
  var to_user_id = $(this).attr('id');
  var chat_message = $('#mensaje'+to_user_id).val();
  $.ajax({
   url:"../../../chat/enviarMensaje.php",
   method:"POST",
   data:{to_user_id:to_user_id, chat_message:chat_message},
   success:function(data)
   {
    $('#mensaje'+to_user_id).val('');

    $('#historialChat'+to_user_id).html(data);

   }
  })
});


function fetch_user()
 {
  $.ajax({
    url:"../../../chat/mostrarClientes.php",
   method:"POST",
   success:function(data){
    $('#clientes').html(data);
   }
  })
 }
 


function fetch_user_chat_history(to_user_id)
 {
  $.ajax({
   url:"../../../chat/mostrarMensajes.php",
   method:"POST",
   data:{to_user_id:to_user_id},
   success:function(data){

    $('#historialChat'+to_user_id).html(data);

   }
  })
 }

 function update_chat_history_data()
 {
  $('.historialChat').each(function(){
   var to_user_id = $(this).data('touserid');
   fetch_user_chat_history(to_user_id);
   $('.historialChat').scrollTop($('.historialChat')[0].scrollHeight);

  });
 }
 
 function make_chat_dialog_box(to_user_id, to_user_name)
 {
 


  
  var modal_content = '<div id="user_dialog_'+to_user_id+'" class="user_dialog" title="Estas hablando con '+to_user_name+'">';
  modal_content += '<h2>'+to_user_name+'</h2>';
  modal_content += '<div   class="text-left pre-scrollable w-100  historialChat" data-touserid="'+to_user_id+'" id="historialChat'+to_user_id+'">';
  modal_content += fetch_user_chat_history(to_user_id);
  modal_content += '</div>';

  modal_content += '<div class="form-group">';
  modal_content += '<textarea name="mensaje'+to_user_id+'" id="mensaje'+to_user_id+'" class="form-control mensaje"></textarea>';
  modal_content += '</div><div class="form-group" align="right">';
  modal_content+= '<button type="button" name="btnEnvia" id="'+to_user_id+'" class="btn btn-info btnEnviar">Enviar</button></div></div>';
  $('#user_model_details').html(modal_content);
 }




 $(document).on('click', '.empezarChat', function(){
  var to_user_id = $(this).data('touserid');
  var to_user_name = $(this).data('tousername');
  make_chat_dialog_box(to_user_id, to_user_name);
  $("#user_dialog_"+to_user_id).dialog({
    autoOpen: false,
    width: 600, // overcomes width:'auto' and maxWidth bug
        height: 600,
        maxWidth: 600,
        modal: true,
        fluid: true, //new option
        resizable: false,
        open: function(event, ui){
           fluidDialog(); // needed when autoOpen is set to true in this codepen
        }
  });
  $('#user_dialog_'+to_user_id).dialog('open');
 });

});




/*** Begin "Responsive" jQuery UI Dialog Window Code ***/
// run function on all dialog opens
$(document).on("dialogopen", ".ui-dialog", function (event, ui) {
    fluidDialog();
});

// remove window resize namespace
$(document).on("dialogclose", ".ui-dialog", function (event, ui) {
    $(window).off("resize.responsive");
});

function fluidDialog() {
    var $visible = $(".ui-dialog:visible");
    // each open dialog
    $visible.each(function () {
        var $this = $(this);
        var dialog = $this.find(".ui-dialog-content").data(dialog).uiDialog;
        // if fluid option == true
        if (dialog.options.maxWidth && dialog.options.width) {
            // fix maxWidth bug
            $this.css("max-width", dialog.options.maxWidth);
            //reposition dialog
            dialog.option("position", dialog.options.position);
        }

        if (dialog.options.fluid) {
            // namespace window resize
            $(window).on("resize.responsive", function () {
                var wWidth = $(window).width();
                // check window width against dialog width
                if (wWidth < dialog.options.maxWidth + 50) {
                    // keep dialog from filling entire screen
                    $this.css("width", "90%");
                    
                }
              //reposition dialog
              dialog.option("position", dialog.options.position);
            });
        }

    });
}





// vient quick start dans la documentation de kceditor.com version 5 build
$(document).ready(function(){
    // editor ckeditor
    ClassicEditor
    .create( document.querySelector( '#body' ) )
    .catch( error => {
        console.error( error );
    } );

        // rest of the code
        $('#selectAllBoxes').click(function(event){
            if(this.checked){
                $('.checkBoxes').each(function(){
                    this.checked = true;
                });
            }else{
                $('.checkBoxes').each(function(){
                    this.checked = false;
                });
            }
        });


// cette partie ne marche pas
var div_box = "<div id='load-screen'><div id='loading'></div></div>" ;
$("body").prepend(div_box);
$('#load-screen').delay(700).fadeOut(600, function(){
    $(this).remove();
});



});

function loadUserOnline(){
    $.get("functions.php?onlineusers=result", function(data){

        $(".useronline").text(data);
    });
}

setInterval(function(){
    loadUserOnline();
}, 500);


jQuery(document).ready(function(){
    jQuery("li.nav-item.padre").on("click", menuDesplegable);
    jQuery(".showMenu").on("click", mostrarSidebar);
    jQuery(".cerrarSidebar").on("click", mostrarSidebar);
    jQuery("input[type='file']").on("change", fileChange);
    jQuery('.mydatepicker, #datepicker').datepicker({
      format: 'dd-mm-yyyy'
    });
    jQuery('.dropify').dropify();
    jQuery("input#avatar").change(cambiarFoto);
    jQuery(".dateBetween .dataInit").change(dataBetween)
    jQuery(".dateBetween .dataFinish").change(dataBetween)
    mostarBienvenida()

   
})

function menuDesplegable(){
    if(jQuery(this).hasClass("active")){
        jQuery(this).removeClass("active");
        jQuery(this).find(".hijo").slideUp();
    }else{
        jQuery(this).addClass("active");
        jQuery(this).find(".hijo").slideDown();
    }
}

function mostrarSidebar(){
    if(jQuery("body").hasClass("menuCompact")){
        jQuery("body").removeClass("menuCompact");
    }else{
        jQuery("body").addClass("menuCompact");
    }
}

function fileChange(){
    var nameFile = jQuery(this)[0].files[0].name;
    var sizeFile = jQuery(this)[0].files[0].size/1000;
    jQuery("label[for='"+jQuery(this).attr("id")+"']").html(nameFile+"<br>"+sizeFile+"MB");
}

function cambiarFoto(){
    if (jQuery(this)[0].files && jQuery(this)[0].files[0]) {
    var reader = new FileReader();

    reader.onload = function(e) {
        console.log(e)
      jQuery('#previewAvatar').attr('src', e.target.result);
    }

    reader.readAsDataURL(jQuery(this)[0].files[0]);
  }
}

function mostarBienvenida(){
    jQuery.ajax({
       url : "/bienvenida",
        method:"get",
        success: function(data){
            if(JSON.parse(data).show == true){
                jQuery("#bienvenida").modal("show");
                setTimeout(cerrarBienvenida, 30000);
            }
        }
    });
}

function cerrarBienvenida(){
    jQuery.ajax({
        url:"cerrarBienvenida",
        method:"get",
        success: function(){
            jQuery("#bienvenida").modal("hide");
        }
    })
}

function dataBetween() {
    var p = jQuery(this).parent().parent();
    var input = p.find(".dateInput");
    var _init = p.find(".dataInit");
    var finish = p.find(".dataFinish");
    input.val(_init.val()+"|"+finish.val());
}
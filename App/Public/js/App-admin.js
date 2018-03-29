$(document).ready(function(){
    $("#add-address").click(function(e){
        e.preventDefault();
        var numberOfAddresses = $("#_meta_post").find("input[name^='_meta_post[Ảnh đại diện-meta_thumbnail_png]']").length;
        var input = '<input type="text" name="_meta_post[Ảnh đại diện-meta_thumbnail_png][' + numberOfAddresses + ']" />';
        var removeButton = '<span class="remove-address button_plus">-</span>';
        var html = "<div class='address'>" + input + removeButton + "</div>";
        $("#_meta_post").find(".meta_thumbnail").after(html);
    });
});

$(document).on("click", ".remove-address",function(e){
    e.preventDefault();
    $(this).parents(".address").remove();
    //update labels
    $("#_meta_post").find("label[for^='_meta_postmeta_thumbnail_png']").each(function(){
        //$(this).html("Ảnh Đại Diện " + ($(this).parents('.address').index() + 1));
    });
});
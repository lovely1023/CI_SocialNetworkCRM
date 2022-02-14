$(document).ready(function(){

   $(".btn_delete").on("click", function(){
      let id = $(this).attr("data-id");

      $("a").attr("href", baseURL+"/common_fields/delete_email_template/" + id);
   });

   $(".btn_edit").on("click", function(){
      let id = $(this).attr("data-id");

      $.ajax({
         url: baseURL + "/common_fields/get_email_template_dtl/" + id,
         dataType:"JSON",
         success:function(data)
         {
            $("form#editEmailTemplate").attr("action", baseURL+"/common_fields/edit_email_template/" + id);

            $('#template_type').val(data['email_template_type']);
            $('#subject').val(data['subject']);
            $('#header_image').val(data['header_image']);
            $('#email_content').val(data['content']);
         }
       });
   });
});
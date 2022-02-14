$(document).ready(function(){
  /**
   * Email Template Type CRUD
   */
  function load_email_template_type()
  {
    $.ajax({
      url: baseURL + "/common_fields/load_email_template_type",
      dataType:"JSON",
      success:function(data){
        let row = 1;
        let html = '';
        $('#template_type').val('');
        for(let count = 0; count < data.length; count++)
        {
          html += '<tr>';
          html += '<td>'+ row++ +'</td>';
          html += '<td class="table_data" data-row_id="'+data[count].id+'" data-column_name="template_type">'+data[count].template_type+'</td>';
          html += '<td><button type="button" name="edit_btn_emailTemplateType" id="'+data[count].id+'" class="btn btn-xs btn-primary btn_edit_emailTemplateType"><i class="fas fa-edit"></i></button><button type="button" name="delete_btn_emailTemplateType" data-id="'+data[count].id+'" class="btn btn-xs btn-danger btn_delete_emailTemplateType"><i class="fas fa-minus"></i></button></td></tr>';
        }
        $('tbody#email_template_type_table').html(html);
      }
    });
  }

  load_email_template_type();
 
  $(document).on('click', '#btn_add_emailTemplateType', function(){
    let template_type = $('#template_type').val();
    $.ajax({
      url: baseURL + "/common_fields/add_email_template_type",
      method:"POST",
      data:{template_type:template_type},
      success:function(data){
        load_email_template_type();
      }
    });
  });

  $(document).on('click', '.btn_edit_emailTemplateType', function() {
    let id = $(this).attr('id');

    $.ajax({
      url: baseURL + "/common_fields/get_email_template_type_dtl/" + id,
      dataType:"JSON",
      success:function(data)
      {
        $('h4.input-title').text('Edit Email Template Type');

        $('#template_type').val(data['template_type']);

        $('button#btn_add_emailTemplateType').addClass('hidden');
        $('button#btn_save_emailTemplateType').removeClass('hidden');
        $('button#btn_save_emailTemplateType').attr('data-id', id);
        $('button#btn_cancel_emailTemplateType').removeClass('hidden');
      }
    });
  });

  $('button#btn_cancel_emailTemplateType').on('click', function(){
    $('h4.input-title').text('Add New Email Template Type');
    $('button#btn_add_emailTemplateType').removeClass('hidden');
    $('button#btn_save_emailTemplateType').addClass('hidden');
    $('button#btn_cancel_emailTemplateType').addClass('hidden');
    load_email_template_type();
  });

  $('#btn_save_emailTemplateType').on('click', function(){
    let id = $(this).attr('data-id');
    let template_type = $('#template_type').val();

    $.ajax({
      url: baseURL + "/common_fields/edit_email_template_type/" + id,
      method:"POST",
      data:{template_type:template_type},
      success:function(data){
        $('h4.input-title').text('Add New Email Template Type');
        $('button#btn_add_emailTemplateType').removeClass('hidden');
        $('button#btn_save_emailTemplateType').addClass('hidden');
        $('button#btn_cancel_emailTemplateType').addClass('hidden');
        load_email_template_type();
      }
    });
  });

  $(document).on('click', '.btn_delete_emailTemplateType', function(){
    var id = $(this).attr('data-id');
    if(confirm("Are you sure you want to delete this?"))
    {
      $.ajax({
        url: baseURL + "/common_fields/delete_email_template_type/" + id,
        method:"POST",
        data:{id:id},
        success:function(data){
          load_email_template_type();
        }
      })
    }
  });

  /**
   * Email Campaign Type CRUD
   */
  function load_campaign_type()
  {
    $.ajax({
      url: baseURL + "/common_fields/load_campaign_type",
      dataType:"JSON",
      success:function(data){
        let row = 1;
        let html = '';
        $('#org_list').val('');
        $('#campaign_type').val('');
        for(let count = 0; count < data.length; count++)
        {
          html += '<tr>';
          html += '<td>'+ row++ +'</td>';
          html += '<td class="table_data" data-row_id="'+data[count].id+'" data-column_name="org_name">'+data[count].org_name+'</td>';
          html += '<td class="table_data" data-row_id="'+data[count].id+'" data-column_name="campaign_type">'+data[count].campaign_type+'</td>';
          html += '<td><button type="button" name="edit_btn_campaignType" id="'+data[count].id+'" class="btn btn-xs btn-primary btn_edit_campaignType"><i class="fas fa-edit"></i></button><button type="button" name="delete_btn_campaignType" data-id="'+data[count].id+'" class="btn btn-xs btn-danger btn_delete_campaignType"><i class="fas fa-minus"></i></button></td></tr>';
        }
        $('tbody#campaign_type_table').html(html);
      }
    });
  }

  load_campaign_type();
 
  $(document).on('click', '#btn_add_campaignType', function(){
    let org = $('#org_list').val();
    let campaign_type = $('#campaign_type').val();
    $.ajax({
      url: baseURL + "/common_fields/add_campaign_type",
      method:"POST",
      data:{org:org, campaign_type:campaign_type},
      success:function(data){
        load_campaign_type();
      }
    });
  });

  $(document).on('click', '.btn_edit_campaignType', function() {
    let id = $(this).attr('id');

    $.ajax({
      url: baseURL + "/common_fields/get_campaign_type_dtl/" + id,
      dataType:"JSON",
      success:function(data)
      {
        $('h4.input-title').text('Edit Email Campaign Type');

        $('select#org_list').val(data['org_id']);
        $('#campaign_type').val(data['campaign_type']);

        $('button#btn_add_campaignType').addClass('hidden');
        $('button#btn_save_campaignType').removeClass('hidden');
        $('button#btn_save_campaignType').attr('data-id', id);
        $('button#btn_cancel_campaignType').removeClass('hidden');
      }
    });
  });

  $('button#btn_cancel_campaignType').on('click', function(){
    $('h4.input-title').text('Add New Email Campaign Type');
    $('button#btn_add_campaignType').removeClass('hidden');
    $('button#btn_save_campaignType').addClass('hidden');
    $('button#btn_cancel_campaignType').addClass('hidden');
    load_campaign_type();
  });

  $('#btn_save_campaignType').on('click', function(){
    let id = $(this).attr('data-id');
    let org = $('#org_list').val();
    let campaign_type = $('#campaign_type').val();
    $.ajax({
      url: baseURL + "/common_fields/edit_campaign_type/" + id,
      method:"POST",
      data:{org:org, campaign_type:campaign_type},
      success:function(data){
        $('h4.input-title').text('Add New Email Campaign Type');
        $('button#btn_add_campaignType').removeClass('hidden');
        $('button#btn_save_campaignType').addClass('hidden');
        $('button#btn_cancel_campaignType').addClass('hidden');
        load_campaign_type();
      }
    });
  });

  $(document).on('click', '.btn_delete_campaignType', function(){
    var id = $(this).attr('data-id');
    if(confirm("Are you sure you want to delete this?"))
    {
      $.ajax({
        url: baseURL + "/common_fields/delete_campaign_type/" + id,
        method:"POST",
        data:{id:id},
        success:function(data){
          load_campaign_type();
        }
      })
    }
  });

  /**
   * Mobile Carrier CRUD
   */
  function load_mobile_carrier()
  {
    $.ajax({
      url: baseURL + "/common_fields/load_mobile_carrier",
      dataType:"JSON",
      success:function(data){
        let row = 1;
        let html = '';
        $('#mobile_carrier').val('');
        $('#country_list').val('');
        for(let count = 0; count < data.length; count++)
        {
          html += '<tr>';
          html += '<td>'+ row++ +'</td>';
          html += '<td class="table_data" data-row_id="'+data[count].id+'" data-column_name="carrier_name">'+data[count].mobile_carrier_name+'</td>';
          html += '<td class="table_data" data-row_id="'+data[count].id+'" data-column_name="country">'+data[count].country+'</td>';
          html += '<td><button type="button" name="edit_btn_mobileCarrier" id="'+data[count].id+'" class="btn btn-xs btn-primary btn_edit_mobileCarrier"><i class="fas fa-edit"></i></button><button type="button" name="delete_btn_mobileCarrier" data-id="'+data[count].id+'" class="btn btn-xs btn-danger btn_delete_mobileCarrier"><i class="fas fa-minus"></i></button></td></tr>';
        }
        $('tbody#mobile_carrier_table').html(html);
      }
    });
  }

  load_mobile_carrier();

  $(document).on('click', '#btn_add_mobileCarrier', function(){
    let mobile_carrier = $('#mobile_carrier').val();
    let country = $('#country_list').val();
    $.ajax({
      url: baseURL + "/common_fields/add_mobile_carrier",
      method:"POST",
      data:{mobile_carrier:mobile_carrier, country:country},
      success:function(data){
        load_mobile_carrier();
      }
    });
  });

  $(document).on('click', '.btn_edit_mobileCarrier', function() {
    let id = $(this).attr('id');

    $.ajax({
      url: baseURL + "/common_fields/get_mobile_carrier_dtl/" + id,
      dataType:"JSON",
      success:function(data)
      {
        $('h4.input-title').text('Edit Mobile Carrier');

        $('select#country_list').val(data['country']);
        $('#mobile_carrier').val(data['mobile_carrier_name']);

        $('button#btn_add_mobileCarrier').addClass('hidden');
        $('button#btn_save_mobileCarrier').removeClass('hidden');
        $('button#btn_save_mobileCarrier').attr('data-id', id);
        $('button#btn_cancel_mobileCarrier').removeClass('hidden');
      }
    });
  });

  $('button#btn_cancel_mobileCarrier').on('click', function(){
    $('h4.input-title').text('Add New Mobile Carrier');
    $('button#btn_add_mobileCarrier').removeClass('hidden');
    $('button#btn_save_mobileCarrier').addClass('hidden');
    $('button#btn_cancel_mobileCarrier').addClass('hidden');
    load_mobile_carrier();
  });

  $('#btn_save_mobileCarrier').on('click', function(){
    let id = $(this).attr('data-id');
    let country = $('#country_list').val();
    let mobile_carrier = $('#mobile_carrier').val();
    console.log('country value: '+country);
    $.ajax({
      url: baseURL + "/common_fields/edit_mobile_carrier/" + id,
      method:"POST",
      data:{mobile_carrier:mobile_carrier, country:country},
      success:function(data){
        $('h4.input-title').text('Add New Email Campaign Type');
        $('button#btn_add_mobileCarrier').removeClass('hidden');
        $('button#btn_save_mobileCarrier').addClass('hidden');
        $('button#btn_cancel_mobileCarrier').addClass('hidden');
        load_mobile_carrier();
      }
    });
  });

  $(document).on('click', '.btn_delete_mobileCarrier', function(){
    let id = $(this).attr('data-id');
    if(confirm("Are you sure you want to delete this?"))
    {
      $.ajax({
        url: baseURL + "/common_fields/delete_mobile_carrier/" + id,
        method:"POST",
        data:{id:id},
        success:function(data){
          load_mobile_carrier();
        }
      })
    }
  });

  /**
   * Country CRUD
   */
  function load_country()
  {
    $.ajax({
      url: baseURL + "/common_fields/load_country",
      dataType:"JSON",
      success:function(data){
        let row = 1;
        let html = '';
        $('#country_name').val('');
        $('#country_code').val('');
        for(let count = 0; count < data.length; count++)
        {
          html += '<tr>';
          html += '<td>'+ row++ +'</td>';
          html += '<td class="table_data" data-row_id="'+data[count].id+'" data-column_name="country_name">'+data[count].country_name+'</td>';
          html += '<td class="table_data" data-row_id="'+data[count].id+'" data-column_name="country_code">'+data[count].country_code+'</td>';
          html += '<td><button type="button" name="edit_btn_country" id="'+data[count].id+'" class="btn btn-xs btn-primary btn_edit_country"><i class="fas fa-edit"></i></button><button type="button" name="delete_btn_country" data-id="'+data[count].id+'" class="btn btn-xs btn-danger btn_delete_country"><i class="fas fa-minus"></i></button></td></tr>';
        }
        $('tbody#country_table').html(html);
      }
    });
  }

  load_country();

  $(document).on('click', '#btn_add_country', function(){
    let country_name = $('#country_name').val();
    let country_code = $('#country_code').val();
    $.ajax({
      url: baseURL + "/common_fields/add_country",
      method:"POST",
      data:{country_name:country_name, country_code:country_code},
      success:function(data){
        load_country();
      }
    });
  });

  $(document).on('click', '.btn_edit_country', function() {
    let id = $(this).attr('id');

    $.ajax({
      url: baseURL + "/common_fields/get_country_dtl/" + id,
      dataType:"JSON",
      success:function(data)
      {
        $('h4.input-title').text('Edit Country');

        $('#country_name').val(data['country_name']);
        $('#country_code').val(data['country_code']);

        $('button#btn_add_country').addClass('hidden');
        $('button#btn_save_country').removeClass('hidden');
        $('button#btn_save_country').attr('data-id', id);
        $('button#btn_cancel_country').removeClass('hidden');
      }
    });
  });

  $('button#btn_cancel_country').on('click', function(){
    $('h4.input-title').text('Add New Country');
    $('button#btn_add_country').removeClass('hidden');
    $('button#btn_save_country').addClass('hidden');
    $('button#btn_cancel_country').addClass('hidden');
    load_country();
  });

  $('#btn_save_country').on('click', function(){
    let id = $(this).attr('data-id');
    let country_name = $('#country_name').val();
    let country_code = $('#country_code').val();
    $.ajax({
      url: baseURL + "/common_fields/edit_country/" + id,
      method:"POST",
      data:{country_name:country_name, country_code:country_code},
      success:function(data){
        $('h4.input-title').text('Add Country');
        $('button#btn_add_country').removeClass('hidden');
        $('button#btn_save_country').addClass('hidden');
        $('button#btn_cancel_country').addClass('hidden');
        load_country();
      }
    });
  });

  $(document).on('click', '.btn_delete_country', function(){
    let id = $(this).attr('data-id');
    if(confirm("Are you sure you want to delete this?"))
    {
      $.ajax({
        url: baseURL + "/common_fields/delete_country/" + id,
        method:"POST",
        data:{id:id},
        success:function(data){
          load_country();
        }
      })
    }
  });
  /**
   * City CRUD
   */
  function load_city()
  {
    $.ajax({
      url: baseURL + "/common_fields/load_city",
      dataType:"JSON",
      success:function(data){
        let row = 1;
        let html = '';
        $('#city_name').val('');
        $('#city_country').val('');
        $('#area_code').val('');
        for(let count = 0; count < data.length; count++)
        {
          html += '<tr>';
          html += '<td>'+ row++ +'</td>';
          html += '<td class="table_data" data-row_id="'+data[count].id+'" data-column_name="city_name">'+data[count].city_name+'</td>';
          html += '<td class="table_data" data-row_id="'+data[count].id+'" data-column_name="city_country">'+data[count].country+'</td>';
          html += '<td class="table_data" data-row_id="'+data[count].id+'" data-column_name="area_code">'+data[count].area_code+'</td>';
          html += '<td><button type="button" name="edit_btn_city" id="'+data[count].id+'" class="btn btn-xs btn-primary btn_edit_city"><i class="fas fa-edit"></i></button><button type="button" name="delete_btn_city" data-id="'+data[count].id+'" class="btn btn-xs btn-danger btn_delete_city"><i class="fas fa-minus"></i></button></td></tr>';
        }
        $('tbody#city_table').html(html);
      }
    });
  }

  load_city();

  $(document).on('click', '#btn_add_city', function(){
    let city_name = $('#city_name').val();
    let country = $('#city_country').val();
    let area_code = $('#area_code').val();
    $.ajax({
      url: baseURL + "/common_fields/add_city",
      method:"POST",
      data:{city_name:city_name, country:country, area_code:area_code},
      success:function(data){
        load_city();
      }
    });
  });

  $(document).on('click', '.btn_edit_city', function() {
    let id = $(this).attr('id');

    $.ajax({
      url: baseURL + "/common_fields/get_city_dtl/" + id,
      dataType:"JSON",
      success:function(data)
      {
        $('h4.input-title').text('Edit City');

        $('#city_name').val(data['city_name']);
        $('#city_country').val(data['country']);
        $('#area_code').val(data['area_code']);

        $('button#btn_add_city').addClass('hidden');
        $('button#btn_save_city').removeClass('hidden');
        $('button#btn_save_city').attr('data-id', id);
        $('button#btn_cancel_city').removeClass('hidden');
      }
    });
  });

  $('button#btn_cancel_city').on('click', function(){
    $('h4.input-title').text('Add City');
    $('button#btn_add_city').removeClass('hidden');
    $('button#btn_save_city').addClass('hidden');
    $('button#btn_cancel_city').addClass('hidden');
    load_city();
  });

  $('#btn_save_city').on('click', function(){
    let id = $(this).attr('data-id');
    let city_name = $('#city_name').val();
    let country = $('#city_country').val();
    let area_code = $('#area_code').val();
    $.ajax({
      url: baseURL + "/common_fields/edit_city/" + id,
      method:"POST",
      data:{city_name:city_name, country:country, area_code:area_code},
      success:function(data){
        $('h4.input-title').text('Add City');
        $('button#btn_add_city').removeClass('hidden');
        $('button#btn_save_city').addClass('hidden');
        $('button#btn_cancel_city').addClass('hidden');
        load_city();
      }
    });
  });

  $(document).on('click', '.btn_delete_city', function(){
    let id = $(this).attr('data-id');
    if(confirm("Are you sure you want to delete this?"))
    {
      $.ajax({
        url: baseURL + "/common_fields/delete_city/" + id,
        method:"POST",
        data:{id:id},
        success:function(data){
          load_city();
        }
      })
    }
  });
  /**
   * Organization CRUD
   */
  function load_org()
  {
    $.ajax({
      url: baseURL + "/common_fields/load_org",
      dataType:"JSON",
      success:function(data){
        let row = 1;
        let html = '';
        $('#organization').val('');
        for(let count = 0; count < data.length; count++)
        {
          html += '<tr>';
          html += '<td>'+ row++ +'</td>';
          html += '<td class="table_data" data-row_id="'+data[count].id+'" data-column_name="organization">'+data[count].org_name+'</td>';
          html += '<td><button type="button" name="edit_btn_org" id="'+data[count].id+'" class="btn btn-xs btn-primary btn_edit_org"><i class="fas fa-edit"></i></button><button type="button" name="delete_btn_org" data-id="'+data[count].id+'" class="btn btn-xs btn-danger btn_delete_org"><i class="fas fa-minus"></i></button></td></tr>';
        }
        $('tbody#organization_table').html(html);
      }
    });
  }

  load_org();

  $(document).on('click', '#btn_add_org', function(){
    let org_name = $('#organization').val();
    console.log(org_name);
    $.ajax({
      url: baseURL + "/common_fields/add_org",
      method:"POST",
      data:{org_name:org_name},
      success:function(data){
        load_org();
      }
    });
  });

  $(document).on('click', '.btn_edit_org', function() {
    let id = $(this).attr('id');

    $.ajax({
      url: baseURL + "/common_fields/get_org_dtl/" + id,
      dataType:"JSON",
      success:function(data)
      {
        $('h4.input-title').text('Edit Organization');

        $('#organization').val(data['org_name']);

        $('button#btn_add_org').addClass('hidden');
        $('button#btn_save_org').removeClass('hidden');
        $('button#btn_save_org').attr('data-id', id);
        $('button#btn_cancel_org').removeClass('hidden');
      }
    });
  });

  $('button#btn_cancel_org').on('click', function(){
    $('h4.input-title').text('Add City');
    $('button#btn_add_org').removeClass('hidden');
    $('button#btn_save_org').addClass('hidden');
    $('button#btn_cancel_org').addClass('hidden');
    load_org();
  });

  $('#btn_save_org').on('click', function(){
    let id = $(this).attr('data-id');
    let org_name = $('#organization').val();
    $.ajax({
      url: baseURL + "/common_fields/edit_org/" + id,
      method:"POST",
      data:{org_name:org_name},
      success:function(data){
        $('h4.input-title').text('Add City');
        $('button#btn_add_org').removeClass('hidden');
        $('button#btn_save_org').addClass('hidden');
        $('button#btn_cancel_org').addClass('hidden');
        load_org();
      }
    });
  });

  $(document).on('click', '.btn_delete_org', function(){
    let id = $(this).attr('data-id');
    if(confirm("Are you sure you want to delete this?"))
    {
      $.ajax({
        url: baseURL + "/common_fields/delete_org/" + id,
        method:"POST",
        data:{id:id},
        success:function(data){
          load_org();
        }
      })
    }
  });

});
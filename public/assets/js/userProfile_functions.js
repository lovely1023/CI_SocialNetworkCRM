$(document).ready(function () {
	var save_method;
	var dashboard_type = $('table.table').attr('dashboard-type');

	// load_users();
	load_rights();
	load_countries();

	$('#createProfile').on('click', function (){
		$('#userForm')[0].reset();
	});

	$().on('click', function (){

	});

	$("#userProfileForm").on('submit', function (e) {
		e.preventDefault();
		// save_details();
		var first_name = $('#userForm input[name="first_name"]').val();
		var mid_name = $('#userForm input[name="mid_name"]').val();
		var last_name = $('#userForm input[name="last_name"]').val();
		var birth_date = $('#userForm input[name="birth_date"]').val();
		var gender = $('#userForm input[name="gender"]').val();
		var phone_number = $('#userForm input[name="phone_number"]').val();
		var mobile_number = $('#userForm input[name="mobile_number"]').val();
		var email_address = $('#userForm input[name="email_address"]').val();
		var access_right = $('#userForm select[name="access_right"]').val();
		var addAlert = $('#userForm input[name="addAlert"]').val();
		var upload_photo = $('#userForm input#upload_photo').val();
		var home_address = $('#userForm input[name="home_address"]').val();
		var city = $('#userForm input[name="city"]').val();
		var zip_code = $('#userForm input[name="zip_code"]').val();
		var state = $('#userForm input[name="state"]').val();
		var country = $('#userForm select[name="country"]').val();
		var user_name = $('#userForm input[name="user_name"]').val();
		var password = $('#userForm input[name="password"]').val();
		var password_confirm = $('#userForm input[name="password_confirm"]').val();
		save_method = $('#userForm button#userSave').attr('data-method');
		
		$.ajax({
			url: baseURL + '/cr/save_userProfile',
			type: "POST",
			data: new FormData(this),
			// {
			// 	first_name: first_name,
			// 	mid_name: mid_name,
			// 	last_name: last_name,
			// 	birth_date: birth_date,
			// 	gender: gender,
			// 	phone_number: phone_number,
			// 	mobile_number: mobile_number,
			// 	email_address: email_address,
			// 	access_right: access_right,
			// 	alert: addAlert,
				file: upload_photo,
			// 	home_address: home_address,
			// 	city: city,
			// 	zip_code: zip_code,
			// 	state: state,
			// 	country: country,
			// 	user_name: user_name,
			// 	password: password,
			// 	password_confirm: password_confirm,
			// },
			// enctype: 'multipart/form-data',
			processData: false,
			contentType: false,
			dataType: "JSON",
			success: function(response){
				if(response.success==true){
					alert("Yes login");
					//  load_users();
					location.reload();
				}
			},
			error: function (xhr, ajaxOptions, thrownError) {
				alert('file: '+upload_photo);
				alert(xhr.status);
				alert(xhr.responseText);
				alert(thrownError);
			}
		});
	});

	$('#confirmDelete').on('click', function() {
		var loggedInUserId = $('[name="logged_user"]').val();
		var userId = $('[name="user_id"]').val();
		
		delete_user(loggedInUserId, userId);
	});

});

function load_users() {
	$.ajax({
		url: baseURL + "/admin_dashboard/load_users",
		dataType: "JSON",
		success: function (data) {
			let html = "";
			let row = 1;
			for (let count = 0; count < data.length; count++) {
				html += "<tr >";
				html += "<td scope='row'>" + row++ + "</td>";
				html += "<td>";
				if (data[count].first_name != null) {
					html += data[count].first_name + " ";
				} else {
					html += "";
				}

				if (data[count].last_name != null) {
					html += data[count].last_name;
				} else {
					html += "";
				}
				html += "</td>";

				html += "<td>" + data[count].access_name + "</td>";
				html += "<td>" + data[count].mobile_number + "</td>";
				html += "<td>" + data[count].email_address + "</td>";
				if (data[count].status == 1) {
					html += "<td>Active</td>";
				} else {
					html += "<td>Inactive</td>";
				}

				html +=
					"<td><a href='#userProfileForm' id='updateUser' type='button' class=' btn-modal btn-update-profile'" +
					"data-lightbox='inline'" +
					"data-clientId='" +
					data[count].client_id +
					"'" +
					"><i class='fas fa-user-edit'></i></a>" +
					// "<a href='javascript:void(0);' id='deleteUser' class='btn-modal text-danger btn-delete-profile deleteUser' data-lightbox='inline' data-clientId='" +
					// data[count].client_id +
					// "' data-toggle='modal' data-target='#modalDeleteUser'><i class='fas fa-user-minus'></i></a></td>";
					"<a class=' btn-modal text-danger btn-delete-profile deleteUser' data-lightbox='inline' data-clientId='" +
					data[count].client_id +
					"'><i class='fas fa-user-minus'></i></a></td>";
			}

			$("#userData").html(html);
		},
	});
}

function load_countries() {
	$.ajax({
		url: baseURL + "/admin_dashboard/load_countries",
		dataType: "JSON",
		success: function (data) {
			let html = "";
			html += '<option value="">Select your Country</option>';
			for (let count = 0; count < data.length; count++) {
				html +=
					'<option value="' +
					data[count].country_name +
					'">' +
					data[count].country_name +
					"</option>";
			}

			$("select#addCountry").append(html);
		},
	});
}

function load_rights() {
	$.ajax({
		url: baseURL + "/admin_dashboard/load_rights",
		dataType: "JSON",
		success: function (data) {
			let html = "";
			html += '<option value="">Set Access Right</option>';
			for (let count = 0; count < data.length; count++) {
				html +=
					'<option value="' +
					data[count].access_rights_id +
					'">' +
					data[count].access_name +
					"</option>";
			}
			$("select#access_right").append(html);
		},
	});
}

function save_details() {
	var first_name = $('#userForm input[name="first_name"]').val();
	var mid_name = $('#userForm input[name="mid_name"]').val();
	var last_name = $('#userForm input[name="last_name"]').val();
	var birth_date = $('#userForm input[name="birth_date"]').val();
	var gender = $('#userForm input[name="gender"]').val();
	var phone_number = $('#userForm input[name="phone_number"]').val();
	var mobile_number = $('#userForm input[name="mobile_number"]').val();
	var email_address = $('#userForm input[name="email_address"]').val();
	var access_right = $('#userForm select[name="access_right"]').val();
	var addAlert = $('#userForm input[name="addAlert"]').val();
	var upload_photo = $('#userForm input#upload_photo').val();
	var home_address = $('#userForm input[name="home_address"]').val();
	var city = $('#userForm input[name="city"]').val();
	var zip_code = $('#userForm input[name="zip_code"]').val();
	var state = $('#userForm input[name="state"]').val();
	var country = $('#userForm select[name="country"]').val();
	var user_name = $('#userForm input[name="user_name"]').val();
	var password = $('#userForm input[name="password"]').val();
	var password_confirm = $('#userForm input[name="password_confirm"]').val();
	save_method = $('#userForm button#userSave').attr('data-method');
	
	$.ajax({
		url: baseURL + '/admin_dashboard/save_userProfile',
		type: "POST",
		data:
		{
			first_name: first_name,
			mid_name: mid_name,
			last_name: last_name,
			birth_date: birth_date,
			gender: gender,
			phone_number: phone_number,
			mobile_number: mobile_number,
			email_address: email_address,
			access_right: access_right,
			alert: addAlert,
			file: upload_photo,
			home_address: home_address,
			city: city,
			zip_code: zip_code,
			state: state,
			country: country,
			user_name: user_name,
			password: password,
			password_confirm: password_confirm,
		},
		enctype: 'multipart/form-data',
		processData: false,
		contentType: false,
		dataType: "JSON",
		success: function(response){
			if(response.success==true){
				 alert("Yes login");
				//  load_users();
				 location.reload();
			}
		  },
		error: function (xhr, ajaxOptions, thrownError) {
			alert('file: '+upload_photo);
			alert(xhr.status);
			alert(xhr.responseText);
			alert(thrownError);
		}
	});
}

function update_data(id)
{

}

function update_user(loggedInUserId, userId)
{
	save_method = 'update';
	$('#userForm button#userSave').attr('data-method','update');
	// <?php header('Content-type: application/json'); ?>
	//Ajax Load data from ajax 
	$.ajax({
		url : baseURL + "/common_fields/get_userData/" + loggedInUserId + "/" + userId,
		type: "GET",
		dataType: "JSON",
		success: function(data)
		{
			console.log(data);
			$('[name="first_name"]').val(data[0].first_name);
			$('[name="mid_name"]').val(data[0].mid_name);
			$('[name="last_name"]').val(data[0].last_name);
			$('[name="birth_date"]').val(data[0].birth_date);
			let $gender_field = $('input:radio[name=gender]');
			if(data[0].gender == 'male')
			{
				$('[name="gender"][value=male]').prop('checked', true);
			} else {
				$('[name="gender"][value=female]').prop('checked', true);
			}

			$('[name="gender"]').val(data[0].gender);
			$('[name="phone_number"]').val(data[0].phone_number);
			$('[name="mobile_number"]').val(data[0].mobile_number);
			$('[name="email_address"]').val(data[0].email_address);
			$('[name="access_right"]').val(data[0].access_rights_id);
			if(data[0].alert == 1)
			{
				$('[name="alert"]').prop('checked',true );
			}
			$('[name="home_address"]').val(data[0].home_address);
			$('[name="city"]').val(data[0].city);
			$('[name="zip_code"]').val(data[0].zip_code);
			$('[name="state"]').val(data[0].state);
			$('[name="country"]').val(data[0].country);
			$('[name="user_name"]').val(data[0].user_name);

			$('.modal-title').text('Edit Book'); // Set title to Bootstrap modal title

		},
		error: function (jqXHR, textStatus, errorThrown)
		{
				console.log(jqXHR);
				alert('Error get data from ajax');
		}
	});
}

function append_data (loggedInUserId, userId)
{
	$('#modalDeleteUser input[name="logged_user"]').val(loggedInUserId);
	$('#modalDeleteUser input[name="user_id"]').val(userId);
}

function delete_user(loggedInUserId, id)
{
		$.ajax({
			url : baseURL + "/admin_dashboard/delete_user/"+loggedInUserId+"/"+id,
			type: "POST",
			dataType: "JSON",
			success: function(data)
			{
				location.reload();
			},
			error: function (jqXHR, textStatus, errorThrown)
			{
				 alert('Error deleting data');
			}
	  });
}

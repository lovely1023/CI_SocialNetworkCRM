<div class="content col-lg-7 col-xs-12">
   <div class="row">
      <div class="col-lg-12 col-xs-12">
         <h4>Email Template List</h4>
         <table class="table">
            <thead class="thead-dark">
            <tr>
               <th scope="col"></th>
               <th scope="col">Image</th>
               <th scope="col">Type</th>
               <th scope="col">Subject</th>
               <th scope="col">Content</th>
               <th scope="col">Action</th>
               </tr>
            </thead>
            <tbody>
					<?php $row = 1;
					foreach($email_templates as $template): ?>
               <tr >
                  <td scope="row"><?=$row++?></td>
                  <td><?=(empty($template['image'])) ? '' : '<img src="'.base_url().'/uploads/email_template/'.$template['image'].'" style="width: 28px; border-radius: 14px;">'?></td>
                  <td><?=$template['email_template_type']?></td>
                  <td><?=$template['subject']?></td>
						<td><?=strlen($template['content']) > 50 ? substr($template['content'],0,50)."..." : $template['content'];?></td>
                  <td>
                     <a href="#updateEmailTemplate" title="update template" type="button" class="btn-modal text-primary btn_edit"
                        data-lightbox="inline"
								data-id="<?=$template['id']?>"
                        ><i class="fas fa-file-alt"></i></a>
                     
                     <a href="#modalStripDanger" title="delete template" data-lightbox="inline" data-id="<?=$template['id']?>" type="button" class="text-danger btn_delete"><i class="fas fa-file-excel"></i></a>
                     
                     <!-- <a href="#" title="advance settings" data-lightbox="inline" data-id="<?=$template['id']?>" type="button" class="text-info"><i class="fas fa-cog"></i></a> -->
                  </td>
               </tr>
					<?php endforeach; ?>
            </tbody>
         </table>
      </div>
      
   </div>
</div>

<div class="sidebar col-lg-3">
   <div class="col-lg-12 col-xs-12">
		<br>
		<a href="#newEmailTemplate" data-lightbox="inline" type="button" class="btn btn-icon-holder btn-shadow btn-outline btn-rounded btn-modal">
			Build Email Template <i class="far fa-envelope"></i>
		</a>
		<br>
		<br>
	</div>
   <div class="widget widget-mycart p-cb">
      <h4>Template Types</h4>
      <div class="cart-item">
         <div class="cart-image"> <a href="#"><img src="<?php echo base_url()."/images/admin.png"; ?>"></a></div>
         <div class="cart-product-meta">
         <a href="#">Business Prospect <i class="fas fa-greater-than"></i></a>
         <span>1 / 10</span>
         </div>
      </div>
      <div class="cart-item">
         <div class="cart-image"> <a href="#"><img src="<?php echo base_url()."/images/admin.png"; ?>"></a></div>
         <div class="cart-product-meta">
         <a href="#">Customer Prospect <i class="fas fa-greater-than"></i></a>
         <span>1 / 10</span>
         </div>
      </div>
      <div class="cart-item">
         <div class="cart-image"> <a href="#"><img src="<?php echo base_url()."/images/admin.png"; ?>"></a></div>
         <div class="cart-product-meta">
         <a href="#">Promoter Prospect <i class="fas fa-greater-than"></i></a>
         <span>1 / 10</span>
         </div>
      </div>
      <br>
      <br>
   </div>

</div>

<div id="newEmailTemplate" class="modal no-padding mfp-hide" data-delay="2000" style="max-width: 700px;">
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<span class="h4">Create New Email Template</span>
				</div>
				<form id="addEmailTemplate" class="form-validate" method="POST" action="<?=base_url('common_fields/add_email_template')?>" enctype="multipart/form-data" novalidate="novalidate">
					<div class="card-body">
						<div class="form-row">
							<div class="col-md-12">
								<p class="text-muted"><span class="text-primary">Step 1:</span> Select the type of email template.</p>
							</div>
							<div class="form-group col-md-6">
								<label for="template_type">Template Type</label>
								<select name="template_type" class="form-control update_type" required="">
								<option value="">Select Template Type</option>
								<?php foreach($template_types as $types): ?>
								<option value="<?=$types['template_type']?>"><?=$types['template_type']?></option>
								<?php endforeach; ?>
								</select>
							</div>
							<div class="line"></div>
						</div>
						<div class="form-row">
							<div class="col-md-12">
								<p class="text-muted"><span class="text-primary">Step 2:</span> Build your headline.</p>
							</div>
							<div class="form-group col-md-5">
								<label for="subject">Subject</label>
								<input type="text" class="form-control" name="subject" placeholder="Enter the subject" required="">
							</div>
							<div class="form-group col-md-6 col-md-offset-1">
								<label class="form-label">Header image</label>
								<input type="file" name="header_image">
								<small class="form-text text-muted">Optional: Add your headline image.</small>
							</div>
							<div class="line"></div>
						</div>
						<div class="form-row">
							<div class="col-md-12">
								<p class="text-muted"><span class="text-primary">Step 3:</span> Create your content.</p>
							</div>
							<div class="form-group col-md-12">
								<textarea name="content" class="form-control update_txtMsg" placeholder="Your Cotent" style="width: 100%; min-height: 160px;" required=""></textarea>
							</div>
						</div>
						<button type="submit" class="btn m-t-30 mt-3">Save</button>
					</div>
				
				</form>	
				</div>
			</div>
		</div>
	</div>
</div>

<div id="updateEmailTemplate" class="modal no-padding mfp-hide" data-delay="2000" style="max-width: 700px;">
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<span class="h4">Update Email Template</span>
				</div>
				<form id="editEmailTemplate" method="POST" class="form-validate" enctype="multipart/form-data" novalidate="novalidate">
					<div class="card-body">
						<div class="form-row">
							<div class="col-md-12">
								<p class="text-muted"><span class="text-primary">Step 1:</span> Select the type of email template.</p>
							</div>
							<div class="form-group col-md-6">
								<label for="template_type">Template Type</label>
								<select name="template_type" id="template_type" class="form-control update_type" required="">
								<option value="">Select Template Type</option>
								<?php foreach($template_types as $types): ?>
								<option value="<?=$types['template_type']?>"><?=$types['template_type']?></option>
								<?php endforeach; ?>
								</select>
							</div>
							<div class="line"></div>
						</div>
						<div class="form-row">
							<div class="col-md-12">
								<p class="text-muted"><span class="text-primary">Step 2:</span> Build your headline.</p>
							</div>
							<div class="form-group col-md-5">
								<label for="subject">Subject</label>
								<input type="text" id="subject" class="form-control update_subject" name="subject" placeholder="Enter the subject" required="">
							</div>
							<div class="form-group col-md-6 col-md-offset-1">
								<label class="form-label">Header image</label>
								<input type="file" name="header_image" id="header_image">
								<small class="form-text text-muted">Optional: Add your headline image.</small>
							</div>
							<div class="line"></div>
						</div>
						<div class="form-row">
							<div class="col-md-12">
								<p class="text-muted"><span class="text-primary">Step 3:</span> Create your content.</p>
							</div>
							<div class="form-group col-md-12">
								<textarea name="content" id="email_content" class="form-control update_txtMsg" placeholder="Your Cotent" style="width: 100%; min-height: 160px;" required=""></textarea>
							</div>
						</div>
						
						<button type="submit" class="btn m-t-30 mt-3">Save</button>
					</div>
				</form>	
				</div>
			</div>
		</div>
	</div>
</div>

<div id="modalStripDanger" class="modal-strip modal-top background-danger">
	<div class="container">
		<div class="text-center">Please confirm deletion.
			<a href="" class="m-l-10 btn btn-light">Confirm</a>
		</div>
	</div>
</div>

<style>
	form .line{
		margin: 20px 0px 10px 0px;
	}
</style>

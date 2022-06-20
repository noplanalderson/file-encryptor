<?php
defined('BASEPATH') OR exit('No direct script access allowed');?>
<!-- Background image -->
<div
	class="bg-image"
	style="
	background-image: url('https://assets.hmetro.com.my/images/socialmedia/celcomHM.jpg');
	height: 100vh;
	background-size: cover;
	"
	>
	<div class="mask" style="background-color: rgba(0, 0, 0, 0.6); background-size: cover;height: 100vh;">
		<div class="container p-5">
			<div class="row w-50">
				<div class="col-lg-12">
					
					<div class="card">
						<div class="card-header text-white bg-secondary">
							<h5 class="p-2"><i class="fas fa-lock"></i> Encrypt Your File!</h5>
						</div>
						<div class="card-body">
							<?= $this->session->flashdata('msg'); ?>
							<?= form_open_multipart('', 'method="post"'); ?>
							
							<div class="form-group">
								<label for="key" class="form-label">Public Key *</label>
								<div class="input-group mb-3">
									<input type="text" id="inputGroupSelect04" class="form-control" name="key" value="<?= random_string('alnum', '16') ?>" placeholder="Public Key" required>
									<button class="btn btn-outline-primary" id="copyBtn" type="button"><i class="fas fa-copy"></i></button>
								</div>
							</div>
							<div class="mb-3">
								<label for="formFile" class="form-label">File *</label>
								<input class="form-control" type="file" name="file" id="formFile" required>
							</div>
							<small class="text-danger">Allowed extensions : png|jpg|jpeg|gif|docx|doc|xls|xlsx|ppt|pptx|csv|odt|txt|pdf</small>
						</div>
						<div class="card-footer text-end">
							<button type="submit" name="upload" class="btn btn-md btn-success"><i class="fas fa-file-upload"></i> Upload!</button>
							
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
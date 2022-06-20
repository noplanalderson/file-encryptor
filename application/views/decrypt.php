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

			  		<div class="card w-50">
			  			<div class="card-header text-white bg-secondary">
			  				<h5 class="p-2"><i class="fas fa-lock-open"></i> Decrypt Your File!</h5>
			  			</div>
						  <div class="card-body">

						    <?= $this->session->flashdata('msg'); ?>

						    <?= form_open_multipart('', 'method="post"'); ?>

						    <div class="mb-3">
								  <label for="pubKey" class="form-label">Public Key *</label>
								  <input type="text" class="form-control" id="pubKey" name="key" placeholder="Public Key" required>
								</div>

								<div class="mb-3">
								  <label for="formFile" class="form-label">File (*.naim) *</label>
								  <input class="form-control" type="file" name="file" id="formFile" required>
								</div>
						  </div>
						  <div class="card-footer text-end">

								<button type="submit" name="upload" class="btn btn-md btn-success"><i class="fas fa-file-upload"></i> Upload!</button>
						  	
						  </div>
			  		</div>
			  	</div>
		  </div>


		
			  	
		</div>
		<!-- Background image -->
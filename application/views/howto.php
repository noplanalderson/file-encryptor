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
			<div class="row">
				<div class="col-lg-12">
					
					<div class="card">
						<div class="card-header text-white bg-secondary">
							<h5 class="p-2"><i class="fas fa-book"></i> How To</h5>
						</div>
						<div class="card-body">
							<p>This tool is used to encrypt files with AES-256-CBC encryption. You can define your own public key or use an automatic public key and then upload your file. The encryption result will be downloaded automatically.</p>

							<p>Save your public key carefully because it is the public key that is used to decrypt your files.</p>

							<p>Do not try to decrypt it with a random public key because you will lose your files forever.</p>

							<div class="text-center">
								<a href="<?= base_url('encrypt') ?>" class="btn btn-sm btn-success" title="Encrypt"><i class="fas fa-lock"></i> Encrypt</a>
								<a href="<?= base_url('decrypt') ?>" class="btn btn-sm btn-danger" title="Decrypt"><i class="fas fa-lock-open"></i> Decrypt</a>
							</div>
						</div>
						<div class="card-footer text-end">
							
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
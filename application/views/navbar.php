<?php
defined('BASEPATH') OR exit('No direct script access allowed');?>
  <body>
  	<nav class="navbar sticky-top navbar-expand-lg navbar-dark bg-primary">
		  <div class="container-fluid">
		    <a class="navbar-brand border border-light rounded-circle px-3 py-2" href="<?= base_url() ?>"><i class="fas fa-n"></i></a>
		    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
		      <span class="navbar-toggler-icon"></span>
		    </button>
		    <div class="collapse navbar-collapse" id="navbarNav">
		      <ul class="navbar-nav">
		        <li class="nav-item">
		          <a class="nav-link active" aria-current="page" href="<?= base_url('encrypt') ?>"><i class="fas fa-lock"></i> Encrypt</a>
		        </li>
		        <li class="nav-item">
		          <a class="nav-link active" href="<?= base_url('decrypt') ?>"><i class="fas fa-lock-open"></i> Decrypt</a>
		        </li>
		        <li class="nav-item">
		          <a class="nav-link active" href="<?= base_url('how-to') ?>"><i class="fas fa-book"></i> How to Use</a>
		        </li>
		        <li class="nav-item">
		          <a class="nav-link active" href="https://github.com/noplanalderson/file-encryptor"><i class="fab fa-github"></i> Github</a>
		        </li>
		      </ul>
		    </div>
		  </div>
		</nav>
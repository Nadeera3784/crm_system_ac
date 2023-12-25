<?php if($this->session->flashdata('success')): ?>
<?php alert_dismissable('success', $this->session->flashdata('success')); ?>
<?php endif; ?>
<?php if($this->session->flashdata('error')): ?>
<?php alert_dismissable('info', $this->session->flashdata('error')); ?>
<?php endif; ?>
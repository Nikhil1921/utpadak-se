<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="card-header">
    <h5><?= $title ?> <?= $operation ?></h5>
</div>
<div class="card-body">
    <?= form_open() ?>
        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <?= form_label('Pincode', 'pincode', 'class="col-form-label"') ?>
                    <?= form_input([
                        'class' => "form-control",
                        'type' => "text",
                        'id' => "pincode",
                        'name' => "pincode",
                        'minlength' => 6,
                        'maxlength' => 6,
                        'required' => "",
                        'value' => set_value('pincode') ? set_value('pincode') : (isset($data['pincode']) ? $data['pincode'] : '')
                    ]); ?>
                    <?= form_error('pincode') ?>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <?= form_label('Delivery Charge', 'del_charge', 'class="col-form-label"') ?>
                    <?= form_input([
                        'class' => "form-control",
                        'type' => "text",
                        'id' => "del_charge",
                        'name' => "del_charge",
                        'maxlength' => 3,
                        'required' => "",
                        'value' => set_value('del_charge') ? set_value('del_charge') : (isset($data['del_charge']) ? $data['del_charge'] : '')
                    ]); ?>
                    <?= form_error('del_charge') ?>
                </div>
            </div>
            <div class="col-12"></div>
            <div class="col-3">
                <?= form_button([
                    'type'    => 'submit',
                    'class'   => 'btn btn-outline-primary btn-block col-12',
                    'content' => 'SAVE'
                ]); ?>
            </div>
            <div class="col-3">
                <?= anchor("$url", 'CANCEL', 'class="btn btn-outline-danger col-12"'); ?>
            </div>
        </div>
    <?= form_close() ?>
</div>
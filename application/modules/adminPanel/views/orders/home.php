<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="card-header">
    <div class="row">
        <div class="col-6">
            <h5><?= $title ?> <?= $operation ?></h5>
        </div>
    </div>
</div>
<div class="card-body">
    <div class="row">
        <div class="col-2">
            <button class="btn btn-outline-primary-2x col-12" onclick="">New Order</button>
        </div>
        <div class="col-2">
            <button class="btn btn-outline-secondary-2x col-12" onclick="">Packing</button>
        </div>
        <div class="col-2">
            <button class="btn btn-outline-secondary-2x col-12" onclick="">Shipping</button>
        </div>
        <div class="col-2">
            <button class="btn btn-outline-success-2x col-12" onclick="">Delivered</button>
        </div>
        <div class="col-2">
            <button class="btn btn-outline-danger-2x col-12" onclick="">Canceled</button>
        </div>
        <div class="col-2">
            <button class="btn btn-outline-danger-2x col-12" onclick="">Returned</button>
        </div>
    </div>
    <hr>
    <div class="table-responsive">
        <table class="datatable table table-striped table-bordered nowrap">
            <thead>
                <th class="target">Sr.</th>
                <th>Name</th>
                <th>Mobile</th>
                <th>Total</th>
                <th>Payment staus</th>
                <th>Payment type</th>
                <th>Payment id</th>
                <th class="target">Action</th>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</div>
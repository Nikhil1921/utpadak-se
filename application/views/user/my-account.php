<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="blog-area mt-120 mb-75">
    <div class="container">
        <div class="row">
            <?php $this->load->view('user/sidebar') ?>
            <div class="col-xl-8 col-lg-7">
                <div class="news-detalis-content mb-50">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Order #</th>
                                <th>Products</th>
                                <th>Total</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if($orders): ?>
                            <?php foreach($orders as $k => $v): ?>
                                <tr>
                                    <td><?= ++$k ?></td>
                                    <td>
                                        <?php foreach(json_decode($v['details']) as $prod): ?>
                                            <?= $prod->p_title ?><br>
                                        <?php endforeach ?>
                                    </td>
                                    <td><?= $v['total_amount'] + $v['shipping'] - ($v['total_amount'] * $v['discount'] / 100) ?></td>
                                    <td>
                                        <?= anchor('user/order?order='.e_id($v['id']), '<i class="fa fa-eye"></i>'); ?>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="4" class="text-center">No orders available.</td>
                                </tr>
                            <?php endif ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
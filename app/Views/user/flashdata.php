<?php
if (isset($message)) : ?>
                            <div class=" alert alert-primary" style=" 
                               color: #004085;
                                background-color: #cce5ff;
                                border-color: #b8daff;margin-top:20px;" role="alert">
                                <div class="text-black">
                                 <?php print_r($message); ?>
                                </div>
                            </div>
        <?php endif; ?>

        <?php if (isset($successMessage)) : ?>
                            <div class=" alert alert-success"  role="alert" style="margin-top:20px;">
                                <div class="text-white">
                                 <?php print_r($successMessage); ?>
                                </div>
                            </div>
        <?php endif; ?>

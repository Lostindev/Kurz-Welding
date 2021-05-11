<main class="main">
            <nav class="breadcrumb-nav">
                <div class="container">
                    <ul class="breadcrumb">
                        <li><a href="/"><i class="d-icon-home"></i></a></li>
                        <li><a href="#" class="active">Home</a></li>
                        <li>Gallery</li>
                    </ul>
                </div>
            </nav>
            <div class="page-content pb-10 mb-10">
                <div class="container">
                    <div class="posts grid post-grid row" data-grid-options="{
                        'layoutMode': 'fitRows'
                    }">
                    <?php $getGallery = getGallery(); ?>
                        <?php if(count($getGallery) > 0):?>
                        <?php foreach($getGallery as $item):?>
                        <?php $gUrl = (str_replace(' ', '-', strtolower($item['gName']))); ?>
                        <div class="grid-item col-sm-6 col-lg-4 lifestyle shopping winter-sale">
                            <article class="post post-mask gradient">
                                <figure class="post-media overlay-zoom">
                                    <a href="post-single.html">
                                        <img src="<?php echo base_url('/img/gallery/'.$item['gDp']); ?>" width="380" height="280" alt="post" />
                                    </a>
                                </figure>
                                <div class="post-details">
                                    <div class="post-meta">
                                        on <a href="#" class="post-date">Jun 22, 2018</a>
                                    </div>
                                    <h4 class="post-title"><a href="post-single.html"><?php echo $item['gName'];?></a>
                                    </h4>
                                    <a href="post-single.html" class="btn btn-link btn-underline btn-white">Read more<i
                                            class="d-icon-arrow-right"></i></a>
                                </div>
                            </article>
                        </div>
                        <?php endforeach; ?>
                        <?php endif; ?>

                    </div>
                    <ul class="pagination mt-5 justify-content-center">
                        <li class="page-item disabled">
                            <a class="page-link page-link-prev" href="#" aria-label="Previous" tabindex="-1"
                                aria-disabled="true">
                                <i class="d-icon-arrow-left"></i>Prev
                            </a>
                        </li>
                        <li class="page-item active" aria-current="page"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item">
                            <a class="page-link page-link-next" href="#" aria-label="Next">
                                Next<i class="d-icon-arrow-right"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </main>
<div class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="card demo-icons">
                <div class="card-header">
                    <h5 class="card-title">Data Master</h5>
                    <p class="card-category"></p>
                    </div>
                    <div class="card-body all-icons">
                        <div id="icons-wrapper">
                            <section>
                                <ul>
                                    <?php 
                                        $url = $this->uri->segment(1);
                                        foreach ($submenus as $child) { ?>
                                            <li>
                                                <a href="<?=base_url($url.'/'.$child->function);?>">
                                                    <?=$child->icon;?>
                                                    <p><?=$child->nama_menu;?></p>
                                                </a>
                                            </li>
                                        <?php };?>

                                        <!-- list of icons here with the proper class-->
                                    </ul>
                                </section>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
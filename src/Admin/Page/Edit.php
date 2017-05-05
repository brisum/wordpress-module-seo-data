<?php

namespace Brisum\Wordpress\SeoData\Admin\Page;

use Brisum\Wordpress\SeoData\Model\SeoData;

defined('ABSPATH') OR exit;

class Edit {
    protected static $pageUrl = '/admin.php?page=seo_data_editor';
	public function __construct() {
		add_action('admin_menu', [$this, 'addMenuItem']);
    }

	public function addMenuItem() {
		add_menu_page(
			__('Seo Data', 'seo_data'),
			__('Seo Data', 'seo_data'),
			'manage_options',
			'seo_data_editor',
			__CLASS__ . '::page'
		);
	}

    public static function page()
    {
        ?>
        <div class="wrap" id="seo_data_editor">
            <h2><?php echo __('Seo Data', 'seo_data'); ?></h2>
            <br />

            <?php
                if (isset($_GET['add'])) {
                    self::add();
                } elseif (isset($_GET['edit'])) {
                    self::edit();
                } else {
                    self::table();
                }
            ?>
        </div>
        <?php
    }

    protected static function add()
    {
        $pageUrl = admin_url(self::$pageUrl);
        $seoData = new SeoData();

        ?>
        <div>
            <a href="<?php echo $pageUrl; ?>">
                <?php echo __('<< Back to list', 'seo_data'); ?>
            </a>
        </div>
        <div class="clearfix"></div>
        <br />
        <?php

        if (isset($_POST['seo_data'])) {
            $seoData->url = isset($_POST['seo_data']['url']) ? strip_tags($_POST['seo_data']['url']) :'';
            $seoData->title = isset($_POST['seo_data']['title']) ? strip_tags($_POST['seo_data']['title']) :'';
            $seoData->meta_description = isset($_POST['seo_data']['meta_description']) ? strip_tags($_POST['seo_data']['meta_description']) :'';
            $seoData->meta_keywords = isset($_POST['seo_data']['meta_keywords']) ? strip_tags($_POST['seo_data']['meta_keywords']) :'';
            $seoData->h1 = isset($_POST['seo_data']['h1']) ? strip_tags($_POST['seo_data']['h1']) :'';
            $seoData->content = isset($_POST['seo_data']['content']) ? $_POST['seo_data']['content'] :'';

            if('' === trim($seoData->url)) {
                ?>
                <div class="alert alert-danger">
                    <?php echo __('Url can not be empty'); ?>
                </div>
                <?php
            } elseif(false !== $seoData->add()) {
                ?>
                    <div class="alert alert-success">
                        <?php echo __('Seo data has been added successfully'); ?>
                    </div>
                <?php
                $seoData = new SeoData();
            } else {
                ?>
                    <div class="alert alert-danger">
                        <?php echo __('Seo data has not been added'); ?>
                    </div>
                <?php
            }
        }

        ?>
        <form method="post" action="">
            <button type="submit" class="btn btn-primary">
                <?php echo __('Save', 'seo_data'); ?>
            </button>
            <div class="clearfix"></div>
            <br />

            <div class="form-group">
                <label for="seo_data_url">
                    <?php echo __('Url', 'seo_data'); ?>
                </label>
                <input type="text" class="form-control" id="seo_data_url" placeholder="url"
                       name="seo_data[url]"
                       value="<?php echo $seoData->url; ?>">
            </div>

            <div class="form-group">
                <label for="seo_data_title">
                    <?php echo __('Title', 'seo_data'); ?>
                </label>
                <input type="text" class="form-control" id="seo_data_title" placeholder="title"
                       name="seo_data[title]"
                       value="<?php echo $seoData->title; ?>">
            </div>

            <div class="form-group">
                <label for="seo_data_meta_description">
                    <?php echo __('Meta description', 'seo_data'); ?>
                </label>
                <input type="text" class="form-control" id="seo_data_meta_description"
                       placeholder="meta description"
                       name="seo_data[meta_description]"
                       value="<?php echo $seoData->meta_description; ?>">
            </div>

            <div class="form-group">
                <label for="seo_data_meta_keywords">
                    <?php echo __('Meta keywords', 'seo_data'); ?>
                </label>
                    <textarea name="seo_data[meta_keywords]" id="seo_data_meta_keywords" rows="3"
                              class="form-control"
                    ><?php echo $seoData->meta_keywords; ?></textarea>
            </div>

            <div class="form-group">
                <label for="seo_data_h1">
                    <?php echo __('H1', 'seo_data'); ?>
                </label>
                <input type="text" class="form-control" id="seo_data_h1"
                       placeholder="H1"
                       name="seo_data[h1]"
                       value="<?php echo $seoData->h1; ?>">
            </div>

            <div class="form-group">
                <label for="seo_data_content">
                    <?php echo __('Content', 'seo_data'); ?>
                </label>
                    <textarea name="seo_data[content]" id="seo_data_content" rows="20"
                              class="form-control"
                    ><?php echo $seoData->content; ?></textarea>
            </div>


            <button type="submit" class="btn btn-primary">
                <?php echo __('Save', 'seo_data'); ?>
            </button>
        </form>
        <?php
    }

    protected static function edit()
    {
        $pageUrl = admin_url(self::$pageUrl);
        $seoData = SeoData::get(intval($_GET['edit']));

        ?>
            <div>
                <a href="<?php echo $pageUrl; ?>">
                    <?php echo __('<< Back to list', 'seo_data'); ?>
                </a>
            </div>
            <div class="clearfix"></div>
            <br />
        <?php

        if (isset($_POST['seo_data'])) {
            $seoData->url = isset($_POST['seo_data']['url']) ? strip_tags($_POST['seo_data']['url']) :'';
            $seoData->title = isset($_POST['seo_data']['title']) ? strip_tags($_POST['seo_data']['title']) :'';
            $seoData->meta_description = isset($_POST['seo_data']['meta_description']) ? strip_tags($_POST['seo_data']['meta_description']) :'';
            $seoData->meta_keywords = isset($_POST['seo_data']['meta_keywords']) ? strip_tags($_POST['seo_data']['meta_keywords']) :'';
            $seoData->h1 = isset($_POST['seo_data']['h1']) ? strip_tags($_POST['seo_data']['h1']) :'';
            $seoData->content = isset($_POST['seo_data']['content']) ? $_POST['seo_data']['content'] :'';

            if('' === trim($seoData->url)) {
                ?>
                <div class="alert alert-danger">
                    <?php echo __('Url can not be empty'); ?>
                </div>
                <?php
            } elseif(false !== $seoData->save()) {
                ?>
                <div class="alert alert-success">
                    <?php echo __('Seo data has been saved successfully'); ?>
                </div>
                <?php
            }  else {
                ?>
                <div class="alert alert-danger">
                    <?php echo __('Seo data has not been added'); ?>
                </div>
                <?php
            }
        }

        if ($seoData) {
            ?>
                <form method="post" action="">
                    <button type="submit" class="btn btn-primary">
                        <?php echo __('Save', 'seo_data'); ?>
                    </button>
                    <div class="clearfix"></div>
                    <br />

                    <div class="form-group">
                        <label for="seo_data_url">
                            <?php echo __('Url', 'seo_data'); ?>
                        </label>
                        <input type="text" class="form-control" id="seo_data_url" placeholder="url"
                               name="seo_data[url]"
                               value="<?php echo $seoData->url; ?>">
                    </div>

                    <div class="form-group">
                        <label for="seo_data_title">
                            <?php echo __('Title', 'seo_data'); ?>
                        </label>
                        <input type="text" class="form-control" id="seo_data_title" placeholder="title"
                               name="seo_data[title]"
                               value="<?php echo $seoData->title; ?>">
                    </div>

                    <div class="form-group">
                        <label for="seo_data_meta_description">
                            <?php echo __('Meta description', 'seo_data'); ?>
                        </label>
                        <input type="text" class="form-control" id="seo_data_meta_description"
                               placeholder="meta description"
                               name="seo_data[meta_description]"
                               value="<?php echo $seoData->meta_description; ?>">
                    </div>

                    <div class="form-group">
                        <label for="seo_data_meta_keywords">
                            <?php echo __('Meta keywords', 'seo_data'); ?>
                        </label>
                        <textarea name="seo_data[meta_keywords]" id="seo_data_meta_keywords" rows="3"
                                  class="form-control"
                        ><?php echo $seoData->meta_keywords; ?></textarea>
                    </div>

                    <div class="form-group">
                        <label for="seo_data_h1">
                            <?php echo __('H1', 'seo_data'); ?>
                        </label>
                        <input type="text" class="form-control" id="seo_data_h1"
                               placeholder="H1"
                               name="seo_data[h1]"
                               value="<?php echo $seoData->h1; ?>">
                    </div>

                    <div class="form-group">
                        <label for="seo_data_content">
                            <?php echo __('Content', 'seo_data'); ?>
                        </label>
                        <textarea name="seo_data[content]" id="seo_data_content" rows="20"
                                  class="form-control"
                        ><?php echo $seoData->content; ?></textarea>
                    </div>


                    <button type="submit" class="btn btn-primary">
                        <?php echo __('Save', 'seo_data'); ?>
                    </button>
                </form>
            <?php
        } else {
            ?>
                <div class="alert alert-danger">
                    <?php echo __("Can't found seo data", 'seo_data'); ?>
                </div>
            <?php
        }
    }

    protected static function table()
    {
        $pageUrl = admin_url(self::$pageUrl);
        ?>
            <div id='seo_data_editor_manager'>
                <a href="<?php echo $pageUrl . '&add'; ?>" class='button-primary add'>
                    <?php echo __('Add Seo Data', 'seo_data' ); ?>
                </a>
                <div class="clear"></div>
                <br />

                <table class="wp-list-table widefat fixed striped">
                    <?php foreach (SeoData::getAll() as $seoData) : ?>
                        <tr>
                            <td class="col-url" style="width: 70%;">
                                <?php echo $seoData->url; ?>
                            </td>
                            <td>
                                <span style="color:<?php echo $seoData->title ? 'green' : 'red'; ?>">T</span>
                            </td>
                            <td>
                                <span style="color:<?php echo $seoData->meta_description ? 'green' : 'red'; ?>">MD</span>
                            </td>
                            <td>
                                <span style="color:<?php echo $seoData->meta_keywords ? 'green' : 'red'; ?>">MK</span>
                            </td>
                            <td>
                                <span style="color:<?php echo $seoData->h1 ? 'green' : 'red'; ?>">H1</span>
                            </td>
                            <td>
                                <span style="color:<?php echo $seoData->content ? 'green' : 'red'; ?>">C</span>
                            </td>
                            <td>
                                <a href="<?php echo sprintf('%s&edit=%d', $pageUrl, $seoData->id); ?>">
                                    <?php echo __('Edit', 'seo_data'); ?>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            </div>
        <?php
    }
}
<?php
$path = __FILE__;
$pathwp = explode( 'wp-content', $path );
$wp_url = $pathwp[0];

require_once( $wp_url . '/wp-load.php' );
$type = $_GET["type"];
?>


<?php

/* Accordion
----------------------------------------- */
if( $type=="sc-accordion" ) : ?>

	<div class="shortcode-form clearfix">
    
		<h2><?php _e('Accordion', 'sc-text'); ?></h2>
		<form action="/" method="get" id="sc-accordion" accept-charset="utf-8">
				
			<div id="box1" class="item_box field-box">
				<label><?php _e('Section Title', 'sc-text'); ?></label>
				<input type="text" class="item_title" id="item-title1" name="item-title" value="<?php _e('Title 1', 'sc-text'); ?>" />
				
				<label><?php _e('Section Text', 'sc-text'); ?></label>
				<textarea class="item_text" id="item-text1" name="item-text"></textarea>
			</div>
            
		</form>
        
		<div class="controls">
			<button class="button" id="btn-add">+</button>
			<button class="button" id="btn-remove">-</button>
            <a href="#" class="insert-shortcode button-primary"><?php _e('Insert', 'sc-text'); ?></a>
		</div>
		
	</div>



<?php 

/* Button
----------------------------------------- */
elseif( $type=="sc-button" ): ?>
	
	<div class="shortcode-form">
    
		<h2><?php _e('Button', 'sc-text'); ?></h2>
        
        <div class="btn-preview"></div>

		<form action="/" method="get" id="sc-button" accept-charset="utf-8">
        	<div class="field-box">
				<label for="button-text"><?php _e('Button Text', 'sc-text'); ?></label>
				<input type="text" id="button-text" name="button-text" value="Button Text" />
			</div> 
            <div class="field-box">
				<label for="button-url"><?php _e('Button URL', 'sc-text'); ?></label>
				<input type="text" id="button-url" name="button-url" value="http://yoursite.com/page" />
			</div>
			<div class="field-box">
            	<label for="icon-bg"><?php _e('Background Color', 'sc-text'); ?></label><br />
                 <div class="pallete bg-pallete clearfix">
                	<!-- Color list -->
                </div>
            </div>
            <div class="field-box">
            	<label for="icon-bg"><?php _e('Text Color', 'sc-text'); ?></label><br />
            	<div class="clearfix">
                    <input type="radio" name="text-color" id="color-white" value="white" checked="checked" />
                    <label for="color-white"><?php _e('White', 'sc-text'); ?></label>
                    &nbsp;
                    <input type="radio" name="text-color" id="color-black" value="black" />
                    <label for="color-black"><?php _e('Black', 'sc-text'); ?></label>
             	</div>
             </div>
             <div class="field-box">
             	<label><?php _e('Open button link in:', 'sc-text'); ?></label><br />
             	<input type="radio" name="window-open" id="window-self" value="_self" checked="checked" />
                <label for="window-self"><?php _e('Same Window (_self)', 'sc-text'); ?></label>&nbsp;
                <input type="radio" name="window-open" id="window-blank" value="_blank" />
                <label for="window-blank"><?php _e('New Window (_blank)', 'sc-text'); ?></label>
             </div>
		</form>
        
 		<a href="#" class="insert-shortcode button-primary"><?php _e('Insert', 'sc-text'); ?></a>
        
	</div>        
        


<?php

/* Info Box
----------------------------------------- */
elseif( $type=="sc-infobox" ): ?>
		
        
        <div class="shortcode-form clearfix">
        
            <h2><?php _e('Info Box', 'sc-text'); ?></h2>
            
            <div class="info-preview">
            	<!-- Preview -->
            </div>
            
            <form action="/" method="get" id="sc-infobox" accept-charset="utf-8">
                <div class="field-box">
                    <label for="infobox-title"><?php _e('Main Title', 'sc-text'); ?></label>
                    <input type="text" id="infobox-title" name="infobox-title" value="<?php _e('Type Main Title', 'sc-text'); ?>" />
                </div>
                <div class="field-box">
                    <label for="infobox-sub"><?php _e('Sub Title', 'sc-text'); ?></label>
                    <input type="text" id="infobox-sub" name="infobox-sub" value="<?php _e('Type Sub Title', 'sc-text'); ?>" />
                </div>
                <div class="field-box">
                	<label><?php _e('Background', 'sc-text'); ?></label>
                    <div class="pallete bg-pallete clearfix">
                        <!-- Icons color list -->
                    </div>
                </div>
                <div class="field-box">
                    <label for="opacity"><?php _e('Box Opacity', 'sc-text'); ?></label><br />
                    <div class="clearfix">
                        <input type="radio" name="box-opacity" id="opacity-on" value="on" checked="checked" />
                        <label for="opacity-on"><?php _e('On', 'sc-text'); ?></label>
                        &nbsp;
                        <input type="radio" name="box-opacity" id="opacity-off" value="off" />
                        <label for="opacity-off"><?php _e('Off', 'sc-text'); ?></label>
                    </div>
                </div>
                <div class="field-box">
                    <label for="content-color"><?php _e('Box Content Color', 'sc-text'); ?></label><br />
                    <div class="clearfix">
                    	<input type="radio" name="box-color" id="box-black" value="black" checked="checked" />
                        <label for="box-black"><?php _e('Black', 'sc-text'); ?></label>
                        &nbsp;
                        <input type="radio" name="box-color" id="box-white" value="white" />
                        <label for="box-white"><?php _e('White', 'sc-text'); ?></label>
                    </div>
             	</div>
            </form>
            
            <a href="#" class="insert-shortcode button-primary"><?php _e('Insert', 'sc-text'); ?></a>

        </div>
     
                
<?php 

/* Columns
----------------------------------------- */
elseif( $type=="sc-columns" ): ?>
		
        <div class="shortcode-form clearfix">
        
            <h2><?php _e('Columns', 'sc-text'); ?></h2>
            
            <form action="/" method="get" id="sc-columns" accept-charset="utf-8">
                <div class="input-list columns">
                
                  <input type="radio" name="columns-width" id="col1" value="coltpl1" />
                  <label for="col1"></label>
    
                  <input type="radio" name="columns-width" id="col2" value="coltpl2" />
                  <label for="col2"></label>
    
                  <input type="radio" name="columns-width" id="col3" value="coltpl3" />
                  <label for="col3"></label>
    
                  <input type="radio" name="columns-width" id="col4" value="coltpl4" />
                  <label for="col4"></label>
    
                  <input type="radio" name="columns-width" id="col5" value="coltpl5" />
                  <label for="col5"></label>
                    
                </div>
            </form>
        
        	<a href="#" class="insert-shortcode button-primary"><?php _e('Insert', 'sc-text'); ?></a>

        </div>


<?php 

/* Tabs
----------------------------------------- */
elseif( $type=="sc-tabs" ): ?>
		
        
        <div class="shortcode-form clearfix">
        
            <h2><?php _e('Tabs', 'sc-text'); ?></h2>
            <form action="/" method="get" id="sc-tabs" accept-charset="utf-8">
            	
                <div class="field-box">
                    <label><?php _e('Tabs Layout', 'sc-text'); ?></label><br />
                    
                    <input type="radio" name="tab-layout" id="tab-hor" value="horizontal" checked>
                    <label for="tab-hor"><?php _e('Horizontal', 'sc-text'); ?></label>
                    &nbsp;
                    <input type="radio" name="tab-layout" id="tab-ver" value="vertical">
                    <label for="tab-ver"><?php _e('Vertical', 'sc-text'); ?></label>
                    
                </div> 
               
                <div id="box1" class="item_box field-box">
                    <label><?php _e('Tab Title', 'sc-text'); ?></label>
                    <input type="text" class="item_title" id="item-title1" name="item-title" value="<?php _e('Title 1', 'sc-text'); ?>" />
                    
                    <label><?php _e('Tab Text', 'sc-text'); ?></label>
                    <textarea class="item_text" id="item-text1" name="item-text"></textarea>
                </div>
              
            </form>
        
            <div class="controls">
                <button class="button" id="btn-add">+</button>
                <button class="button" id="btn-remove">-</button>
                <a href="#" class="insert-shortcode button-primary"><?php _e('Insert', 'sc-text'); ?></a>
			</div>

        </div>


<?php 

/* Title
----------------------------------------- */
elseif( $type=="sc-title" ): ?>
		
        <div class="shortcode-form clearfix">
        
            <h2><?php _e('Title', 'sc-text'); ?></h2>
            
            <form action="/" method="get" id="sc-title" accept-charset="utf-8">
            	<div class="field-box">
                    <label><?php _e('Main Title', 'sc-text'); ?></label>
                    <input type="text" id="maintitle" name="maintitle" value="" />
                </div>
                <div class="field-box">
                    <label><?php _e('Sub Title', 'sc-text'); ?></label>
                    <input type="text" id="subtitle" name="subtitle" value="" />
                </div>
            </form>
        
        	<a href="#" class="insert-shortcode button-primary"><?php _e('Insert', 'sc-text'); ?></a>

        </div>
     
        
<?php

/* Separator
----------------------------------------- */
elseif( $type=="sc-separator" ): ?>
		
        <div class="shortcode-form clearfix">
        
            <h2><?php _e('Separator', 'sc-text'); ?></h2>
            
            <form action="/" method="get" id="sc-separator" accept-charset="utf-8">
                <div class="field-box">
                    <label><?php _e('Separator', 'sc-text'); ?></label><br />
                    
                    <input type="radio" name="sep-type" id="sep-thin" value="thin" checked>
                    <label for="sep-thin"><?php _e('Thin Line', 'sc-text'); ?></label>
                    &nbsp;
                    <input type="radio" name="sep-type" id="sep-thick" value="thick">
                    <label for="sep-thick"><?php _e('Thick Line', 'sc-text'); ?></label>
                    &nbsp;
                    <input type="radio" name="sep-type" id="sep-double" value="double">
                    <label for="sep-double"><?php _e('Double Line', 'sc-text'); ?></label>
                    &nbsp;
                    <input type="radio" name="sep-type" id="sep-space" value="space">
                    <label for="sep-space"><?php _e('White Space', 'sc-text'); ?></label>
                </div> 
            </form>
        
        	<a href="#" class="insert-shortcode button-primary"><?php _e('Insert', 'sc-text'); ?></a>

        </div>

 
<?php endif; ?> 
<?php
/**
 * MightyThemes Customizer Custom Controls
 */

if ( class_exists( 'WP_Customize_Control' ) ) {

	/**
	 * Separator Custom Control
	 */
	class MightyThemes_Separator_Custom_Control extends WP_Customize_Control {
		/**
		 * Data type of control
		 */
 		public $type = 'custom_separator';
		/**
		 * Enqueue our scripts and styles
		 */
 		public function enqueue() {
			wp_enqueue_style( 'mightythemes-custom-controls-css', trailingslashit( get_template_directory_uri() ) . 'inc/customizer/custom/controls/css/customizer.css', array(), '1.0', 'all' );
 		}
		/**
		 * Render the control in the customizer
		 */
 		public function render_content() {
 		?>
			<div class="separator-border-control">
				<strong>
					<?php if( !empty( $this->label ) ) { ?>
						<p class="separator-text-control" style=""><?php echo esc_html( $this->label ); ?> </p>
					<?php } ?>
				</strong>
				<?php if( !empty( $this->description ) ) { ?>
					<p class="text-muted separator-text-control separator-description-control"><?php echo esc_html( $this->description ); ?></p>
				<?php } ?>
			</div>
 		<?php
 		}
 	}

	/**
	 * Image Radio Control for MightyThemes Preloaders
	 */
	class MightyThemes_Preloaders_Custom_Control extends WP_Customize_Control {
		/**
		 * Data type of control
		 */
 		public $type = 'preloaders_radio_button';
		/**
		 * Enqueue our scripts and styles
		 */
 		public function enqueue() {
			wp_enqueue_style( 'mightythemes-custom-controls-css', trailingslashit( get_template_directory_uri() ) . 'inc/customizer/custom/controls/css/customizer.css', array(), '1.0', 'all' );
 		}
		/**
		 * Render the control in the customizer
		 */
 		public function render_content() {
 		?>
			<div class="preloader_image_radio_button_control">
				<?php if( !empty( $this->label ) ) { ?>
					<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
				<?php } ?>
				<?php if( !empty( $this->description ) ) { ?>
					<span class="customize-control-description"><?php echo esc_html( $this->description ); ?></span>
				<?php } ?>
				
				<div class="preloader-radio-image-control">
					<?php foreach ( $this->choices as $key => $value ) { ?>					
						<label class="radio-button-label">
							<input type="radio" name="<?php echo esc_attr( $this->id ); ?>" value="<?php echo esc_attr( $key ); ?>" <?php $this->link(); ?> <?php checked( esc_attr( $key ), $this->value() ); ?>/>
							<div class="radio-image">
								<div id="wp-preloader" class="align-items-center d-flex">
									<?php echo $value['code']; // WPCS: XSS ok. ?>
								</div>
							</div>
							<?php if($value['name']) : ?>
								<span class="image-radio-title"><?php echo esc_attr($value['name']); ?></span>
							<?php endif; ?>
						</label>
					<?php } ?>
				</div>
			</div>
 		<?php
 		}
 	}
	
	/**
	 * Image Check Box Custom Control
	 */
	class MightyThemes_Image_Checkbox_Custom_Control extends WP_Customize_Control {
 		/**
 		 * Data type of control
 		 */
  		public $type = 'image_checkbox';
 		/**
 		 * Enqueue our scripts and styles
 		 */
  		public function enqueue() {
			wp_enqueue_style( 'mightythemes-custom-controls-css', trailingslashit( get_template_directory_uri() ) . 'inc/customizer/custom/controls/css/customizer.css', array(), '1.0', 'all' );
  		}
 		/**
 		 * Render the control in the customizer
 		 */
  		public function render_content() {
  		?>
 			<div class="image_checkbox_control">
 				<?php if( !empty( $this->label ) ) { ?>
 					<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
 				<?php } ?>
 				<?php if( !empty( $this->description ) ) { ?>
 					<span class="customize-control-description"><?php echo esc_html( $this->description ); ?></span>
 				<?php } ?>
				<?php	$chkboxValues = explode( ',', esc_attr( $this->value() ) ); ?>
				<input type="hidden" id="<?php echo esc_attr( $this->id ); ?>" name="<?php echo esc_attr( $this->id ); ?>" value="<?php echo esc_attr( $this->value() ); ?>" class="customize-control-multi-image-checkbox" <?php $this->link(); ?> />
				<div class="checkbox-image-control">
					<?php foreach ( $this->choices as $key => $value ) { ?>
						<label class="checkbox-label">
							<input type="checkbox" name="<?php echo esc_attr( $key ); ?>" value="<?php echo esc_attr( $key ); ?>" <?php checked( in_array( esc_attr( $key ), $chkboxValues ), 1 ); ?> class="multi-image-checkbox"/>
							<div class="checkbox-image">
								<img src="<?php echo esc_url( $value['image'] ); ?>" alt="<?php echo esc_attr( $value['name'] ); ?>" title="<?php echo esc_attr( $value['name'] ); ?>" />
							</div>
							<?php if($value['name']) : ?>
								<span class="image-checkbox-title"><?php echo esc_attr($value['name']); ?></span>
							<?php endif; ?>
						</label>
					<?php	} ?>
				</div>
 			</div>
  		<?php
  		}
  	}

	/**
	 * Text Radio Button Custom Control
	 */
	class MightyThemes_Text_Radio_Button_Custom_Control extends WP_Customize_Control {
		/**
		 * The type of control being rendered
		 */
		 public $type = 'text_radio_button';
		/**
		 * Enqueue our scripts and styles
		 */
		 public function enqueue() {
			wp_enqueue_style( 'mightythemes-custom-controls-css', trailingslashit( get_template_directory_uri() ) . 'inc/customizer/custom/controls/css/customizer.css', array(), '1.0', 'all' );
		 }
		/**
		 * Render the control in the customizer
		 */
		 public function render_content() {
		 ?>
			 <?php if( !empty( $this->label ) ) { ?>
					<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
				<?php } ?>
				<?php if( !empty( $this->description ) ) { ?>
					<span class="customize-control-description"><?php echo esc_html( $this->description ); ?></span>
			<?php } ?>
			<div class="mt-text-radio-btn">
			   <div class="radio-buttons">
				   <?php foreach ( $this->choices as $key => $value ) { ?>
						<label class="radio-button-label">
							<input type="radio" name="<?php echo esc_attr( $this->id ); ?>" value="<?php echo esc_attr( $key ); ?>" <?php $this->link(); ?> <?php checked( esc_attr( $key ), $this->value() ); ?>/>
							<span><?php echo esc_attr( $value ); ?></span>
						</label>
					<?php	} ?>
			   </div>
			</div>
		 <?php
		 }
	 }

	/**
	 * Image Radio Button Custom Control
	 */
	class MightyThemes_Image_Radio_Button_Custom_Control extends WP_Customize_Control {
		/**
		 * Data type of control
		 */
 		public $type = 'image_radio_button';
		/**
		 * Enqueue our scripts and styles
		 */
 		public function enqueue() {
			wp_enqueue_style( 'mightythemes-custom-controls-css', trailingslashit( get_template_directory_uri() ) . 'inc/customizer/custom/controls/css/customizer.css', array(), '1.0', 'all' );
 		}
		/**
		 * Render the control in the customizer
		 */
 		public function render_content() {
 		?>
			<div class="image_radio_button_control">
				<?php if( !empty( $this->label ) ) { ?>
					<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
				<?php } ?>
				<?php if( !empty( $this->description ) ) { ?>
					<span class="customize-control-description"><?php echo esc_html( $this->description ); ?></span>
				<?php } ?>
				
				<div class="radio-image-control">
					<?php foreach ( $this->choices as $key => $value ) { ?>					
						<label class="radio-button-label">
							<input type="radio" name="<?php echo esc_attr( $this->id ); ?>" value="<?php echo esc_attr( $key ); ?>" <?php $this->link(); ?> <?php checked( esc_attr( $key ), $this->value() ); ?>/>
							<div class="radio-image">
								<img src="<?php echo esc_url( $value['image'] ); ?>" alt="<?php echo esc_attr( $value['name'] ); ?>" title="<?php echo esc_attr( $value['name'] ); ?>" />
							</div>
							<?php if($value['name']) : ?>
								<span class="image-radio-title"><?php echo esc_attr($value['name']); ?></span>
							<?php endif; ?>
						</label>
					<?php	} ?>
				</div>
			</div>
 		<?php
 		}
 	}

	/**
	 * Slider Custom Control
	 */
	class MightyThemes_Slider_Custom_Control extends WP_Customize_Control {
		/**
		 * Data type of control
		 */
		public $type = 'slider_control';
		/**
		 * Enqueue our scripts and styles
		 */
		public function enqueue() {
			wp_enqueue_script( 'mightythemes-custom-controls-js', trailingslashit( get_template_directory_uri() ) . 'inc/customizer/custom/controls/js/customizer.js', array( 'jquery', 'jquery-ui-core' ), '1.0', true );
			wp_enqueue_style( 'mightythemes-custom-controls-css', trailingslashit( get_template_directory_uri() ) . 'inc/customizer/custom/controls/css/customizer.css', array(), '1.0', 'all' );
		}
		/**
		 * Render the control in the customizer
		 */
		public function render_content() {
		?>
			<div class="slider-custom-control">

				<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
				<input type="number" id="<?php echo esc_attr( $this->id ); ?>" name="<?php echo esc_attr( $this->id ); ?>" value="<?php echo esc_attr( $this->value() ); ?>" class="customize-control-slider-value" <?php $this->link(); ?> />

				<div class="slider" slider-min-value="<?php echo esc_attr( $this->input_attrs['min'] ); ?>"
					slider-max-value="<?php echo esc_attr( $this->input_attrs['max'] ); ?>"
					slider-step-value="<?php echo esc_attr( $this->input_attrs['step'] ); ?>">
				</div>

				<span class="slider-reset dashicons dashicons-image-rotate" slider-reset-value="<?php echo esc_attr( $this->input_attrs['default'] ); ?>"></span>
			</div>
		<?php
		}
	}

	/**
	 * Toggle Switch Custom Control
	 */
	class MightyThemes_Toggle_Switch_Custom_control extends WP_Customize_Control {
		/**
		 * Data type of control
		 */
		public $type = 'toggle_switch';
		/**
		 * Enqueue our scripts and styles
		 */
		public function enqueue(){
			wp_enqueue_style( 'mightythemes-custom-controls-css', trailingslashit( get_template_directory_uri() ) . 'inc/customizer/custom/controls/css/customizer.css', array(), '1.0', 'all' );
		}
		/**
		 * Render the control in the customizer
		 */
		public function render_content(){
		?>
			<div class="toggle-switch-control">
				<div class="toggle-switch">
					<input type="checkbox" id="<?php echo esc_attr($this->id); ?>" name="<?php echo esc_attr($this->id); ?>" class="toggle-switch-checkbox" value="<?php echo esc_attr( $this->value() ); ?>" <?php $this->link(); checked( $this->value() ); ?>>
					<label class="toggle-switch-label" for="<?php echo esc_attr( $this->id ); ?>">
						<span class="toggle-switch-inner"></span>
						<span class="toggle-switch-switch"></span>
					</label>
				</div>
				<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
				<?php if( !empty( $this->description ) ) { ?>
					<span class="customize-control-description"><?php echo esc_html( $this->description ); ?></span>
				<?php } ?>
			</div>
		<?php
		}
	}
}


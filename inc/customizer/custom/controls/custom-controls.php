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
									<?php echo $value['code']; ?>
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
								<img src="<?php echo esc_attr( $value['image'] ); ?>" alt="<?php echo esc_attr( $value['name'] ); ?>" title="<?php echo esc_attr( $value['name'] ); ?>" />
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
								<img src="<?php echo esc_attr( $value['image'] ); ?>" alt="<?php echo esc_attr( $value['name'] ); ?>" title="<?php echo esc_attr( $value['name'] ); ?>" />
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
	 * Simple Notice Custom Control
	 */
	class MightyThemes_Simple_Notice_Custom_Control extends WP_Customize_Control {
		/**
		 * Data type of control
		 */
		public $type = 'simple_notice';
		/**
		 * Render the control in the customizer
		 */
		public function render_content() {
			$allowed_html = array(
				'a' => array(
					'href' => array(),
					'title' => array(),
					'class' => array(),
					'target' => array(),
				),
				'br' => array(),
				'em' => array(),
				'strong' => array(),
				'i' => array(
					'class' => array()
				),
				'span' => array(
					'class' => array(),
				),
				'code' => array(),
			);
		?>
			<div class="simple-notice-custom-control">
				<?php if( !empty( $this->label ) ) { ?>
					<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
				<?php } ?>
				<?php if( !empty( $this->description ) ) { ?>
					<span class="customize-control-description"><?php echo wp_kses( $this->description, $allowed_html ); ?></span>
				<?php } ?>
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

	/**
	 * Sortable Repeater Custom Control
	 */
	class MightyThemes_Sortable_Repeater_Custom_Control extends WP_Customize_Control {
		/**
		 * Data type of control
		 */
		public $type = 'sortable_repeater';
		/**
 		 * Button labels
 		 */
		public $button_labels = array();
		/**
		 * Constructor
		 */
		public function __construct( $manager, $id, $args = array(), $options = array() ) {
			parent::__construct( $manager, $id, $args );
			// Merge the passed button labels with our default labels
			$this->button_labels = wp_parse_args( $this->button_labels,
				array(
					'add' => __( 'Add', 'mtwriter' ),
				)
			);
		}
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
	      <div class="sortable_repeater_control">
				<?php if( !empty( $this->label ) ) { ?>
					<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
				<?php } ?>
				<?php if( !empty( $this->description ) ) { ?>
					<span class="customize-control-description"><?php echo esc_html( $this->description ); ?></span>
				<?php } ?>
				<input type="hidden" id="<?php echo esc_attr( $this->id ); ?>" name="<?php echo esc_attr( $this->id ); ?>" value="<?php echo esc_attr( $this->value() ); ?>" class="customize-control-sortable-repeater" <?php $this->link(); ?> />
				<div class="sortable">
					<div class="repeater">
						<input type="text" value="" class="repeater-input" placeholder="https://" /><span class="dashicons dashicons-sort"></span><a class="customize-control-sortable-repeater-delete" href="#"><span class="dashicons dashicons-no-alt"></span></a>
					</div>
				</div>
				<button class="button customize-control-sortable-repeater-add" type="button"><?php echo $this->button_labels['add']; ?></button>
			</div>
		<?php
		}
	}

	/**
	 * Four Fields Custom Control
	 */
	class MightyThemes_Connected_Input_Custom_Control extends WP_Customize_Control {
		/**
		 * Data type of control
		 */
		 public $type = 'connected_input';
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
		<div class="connected_input_control">

			<?php if( !empty( $this->label ) ) { ?>
				<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
			<?php } ?>
			<?php if( !empty( $this->description ) ) { ?>
				<span class="customize-control-description"><?php echo esc_html( $this->description ); ?></span>
			<?php } ?>

			<div class="connected-input-control">

				<div class="row no-gutters">
					
					<input type="hidden" id="<?php echo esc_attr($this->id); ?>" name="<?php echo esc_attr($this->id); ?>_values" value="" class="customize-control-connected-input" />

					<div class="col input-number">						
						<input type="number" id="<?php echo esc_attr( $this->id ); ?>" name="<?php echo esc_attr( $this->id ); ?>" value="0" class="field-first connected-fields-value connected-field" />
					</div>
					<div class="col input-number">												
						<input type="number" id="<?php echo esc_attr( $this->id ); ?>" name="<?php echo esc_attr( $this->id ); ?>" value="0" class="field-second connected-fields-value connected-field" />
					</div>
					<div class="col input-number">												
						<input type="number" id="<?php echo esc_attr( $this->id ); ?>" name="<?php echo esc_attr( $this->id ); ?>" value="0" class="field-third connected-fields-value connected-field" />
					</div>
					<div class="col input-number">												
						<input type="number" id="<?php echo esc_attr( $this->id ); ?>" name="<?php echo esc_attr( $this->id ); ?>" value="0" class="field-fourth connected-fields-value connected-field" />
					</div>
					<div class="col lock-button">
						<input id="lock-icon" class="connected-fields-value" type="checkbox" />
						<label for="lock-icon" class="dash-lock"></label>
					</div>
					<div class="col">
						<span class="slider-reset dashicons dashicons-image-rotate" slider-reset-value="<?php echo esc_attr( $this->value() ); ?>"></span>
					</div>
				</div>
			</div>
		</div>
		<?php
		}
	}

	/**
	 * Toggle Switch Custom Control
	 */
	class MightyThemes_Section_Custom_control extends WP_Customize_Control {
		/**
		 * Data type of control
		 */
		public $type = 'custom_section';
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
			<ul class="customize-pane-child accordion-sub-container control-panel-content accordion-section control-section control-panel control-panel-default current-panel"
				id="sub-accordion-panel-custom_panel">
				
				<li id="accordion-section-custom_section2"
					class="accordion-section control-section control-section-default control-subsection"
					aria-owns="sub-accordion-section-custom_section2" style="">
					<h3 class="accordion-section-title" tabindex="0">
						MT Custom section
						<span class="screen-reader-text">Press return or enter to open this section</span>
					</h3>
				</li>

			</ul>
		<?php
		}
	}

}

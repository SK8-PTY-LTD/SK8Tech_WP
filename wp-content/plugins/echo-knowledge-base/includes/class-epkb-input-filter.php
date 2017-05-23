<?php

/**
 *
 * For input data:
 * 1. Sanitize data
 * 2. Based on field type, also validate data
 * Internal fields have spec with 'internal' => true
 *
 * @copyright   Copyright (C) 2017, Echo Plugins
 * @license http://opensource.org/licenses/gpl-2.0.php GNU Public License
 */
class EPKB_Input_Filter {

	// basic fields
	const TEXT = 'text';                // use Text or Textarea widget
	const CHECKBOX = 'checkbox';
	const RADIO = 'radio';

	// advanced fields
	const SELECTION = 'select';         // use Dropdown or Radio_buttons_horizontal
	const CHECKBOXES_MULTI_SELECT = 'multi_select';
	const CHECKBOXES_MULTI_SELECT_NOT = 'multi_select_not';

	// custom fields
	const COLOR_HEX = 'color_hex';
	const NUMBER = 'number';   // use Text widget
	const TRUE_FALSE = 'true_false';

	// special fields
	const ID = 'id';
	const LICENSE_KEY = 'license_key';
	const ENUMERATION = 'enumeration';  // use when input has to be from a list of values
	const INTERNAL_ARRAY = 'internal_array';              // array of stored values


	/**
	 * Validate and sanitize input. If input not in spec then exclude it.
	 *
	 * NOTE: Missing input is not handled i.e. no default values are supplied.
	 *
	 * @param array $input to sanitize - array of settings (key-value pairs)
	 *
	 * @return array|WP_Error returns key - value pairs
	 */
	public function validate_and_sanitize( array $input ) {
		$specification = EPKB_Settings_Specs::get_fields_specification();
		return $this->validate_and_sanitize_specs( $input, $specification );
	}

	public function validate_and_sanitize_specs( array $input, array $specification ) {

		if ( empty($input) ) {
			return new WP_Error('invalid_input', 'Empty input');
		}

		$sanitized_input = array();
		$errors = array();

		// filter each field
		foreach ($input as $key => $input_value) {

			if ( ! isset($specification[$key]) || $input_value === null ) {
				continue;
			}

			$field_spec = $specification[$key];

			$defaults = array(
				'label'       => "Label",
				'type'        => EPKB_Input_Filter::TEXT,
				'mandatory'    => true,
				'max'         => '20',
				'min'         => '3',
				'options'     => array(),
				'internal'    => false,
				'default'     => ''
			);
			$field_spec = wp_parse_args( $field_spec, $defaults );

			// SANITIZE FIELD
			$type = empty($field_spec['type']) ? '' : $field_spec['type'];
			switch ( $type ) {

				case self::CHECKBOXES_MULTI_SELECT:
				case self::CHECKBOXES_MULTI_SELECT_NOT:

					$input_value = is_array($input_value) ? $input_value : array();
					$input_adj = array();
					foreach ( $input_value as $arr_key => $arr_value ) {

						// one choice can have multiple true [key,value] pairs separated by comma
						$arr_value = empty($arr_value) ? '' : $arr_value;
						$tmp = explode(',', $arr_value);
						if ( ! empty($tmp[0]) && ! empty($tmp[1]) ) {
							$arr_key = $tmp[0];
							$arr_value = $tmp[1];
						}
						$input_adj[$arr_key] = sanitize_text_field($arr_value);
					}
					$input_value = $input_adj;
					break;

				case self::INTERNAL_ARRAY:
					// no need to sanitize
					break;

				default:
					$input_value = trim( sanitize_text_field( $input_value ) );
			}

			// validate/sanitize input
			$result = $this->filter_input_field( $input_value, $field_spec );
			if ( is_wp_error($result) ) {
				// internal fields are assigned defaults if their value is missing or invalid
				if ( empty( $field_spec['internal'] ) ) {
					$errors[] = '<strong>' . $field_spec['label'] . '</strong> ' . $result->get_error_message();
				} else {
					$sanitized_input[$key] = $field_spec['default'];
				}
			} else {
				$sanitized_input[$key] = $result;
			}

		} // next

		if ( empty($errors) ) {
			return $sanitized_input;
		}

		return new WP_Error('invalid_input', __( 'validation failed', 'echo-knowledge-base' ), $errors );
	}

	private function filter_input_field( $value, $field_spec ) {

		// further sanitize the field
		switch ( $field_spec['type'] ) {

			case self::TEXT:
			case self::LICENSE_KEY:
				return $this->filter_text( $value, $field_spec );
				break;

			case self::CHECKBOX:
				return $this->filter_checkbox( $value );
				break;

			case self::SELECTION:
				return $this->filter_select( $value, $field_spec );
				break;

			case self::CHECKBOXES_MULTI_SELECT:
			case self::CHECKBOXES_MULTI_SELECT_NOT:
				// no filtering needed;
				return $value;
				break;

			case self::NUMBER:
				return $this->filter_number( $value, $field_spec );
				break;

			case self::COLOR_HEX:
				return $this->filter_color_hex( $value, $field_spec );
				break;

			case self::TRUE_FALSE:
				return $this->filter_true_false( $value );
				break;

			case self::ID:
				return $this->filter_id( $value );
				break;

			case self::ENUMERATION:
				return $this->filter_enumeration( $value, $field_spec );
				break;

			case self::INTERNAL_ARRAY:
				// no filtering needed
				return $value;
				break;

			default:
				return new WP_Error('epkb-invalid-input-type', 'unknown input type: ' . $field_spec['type']);
		}
	}

	/**
	 * Sanitize and validate text. Output WP Error if text too big/small
	 *
	 * @param $text
	 * @param $field_spec
	 *
	 * @return string|WP_Error returns sanitized and validated text
	 */
	private function filter_text( $text, $field_spec ) {

		if ( is_array($text) ) {
			$text = '';
		}

		if ( strlen($text) > $field_spec['max'] ) {
			$nof_chars_to_remove = strlen($text) - $field_spec['max'];

			$msg = sprintf( _n( 'is too long. Remove %d character.', 'is too long. Remove %d characters.', $nof_chars_to_remove, 'echo-knowledge-base' ), $nof_chars_to_remove );
			return new WP_Error('filter_text_big', $msg );
		}

		if ( ( empty($text) && ! empty($field_spec['mandatory']) ) || ( strlen($text) > 0 && strlen($text) < $field_spec['min'] ) ) {
			$nof_chars_to_remove = $field_spec['min'] - strlen($text);

			$msg = sprintf( _n( 'is too short. Add at least %d character.', 'is too short. Add at least %d characters.', $nof_chars_to_remove, 'echo-knowledge-base' ), $nof_chars_to_remove );
			return new WP_Error('filter_text_small', $msg );
		}

		return $text;
	}

	/**
	 * Sanitize and validate selection. Output WP Error if text is not in the selection
	 *
	 * @param $value
	 * @param $field_spec
	 *
	 * @return string|WP_Error returns sanitized and validated text
	 */
	private function filter_select( $value, $field_spec ) {

		if ( ! in_array( $value, array_keys($field_spec['options']) )  && ! empty($field_spec['mandatory']) ) {

			$value_text = ( empty($value) ? 'empty.' : 'value "' . $value . '".' );
			$msg = sprintf( __( 'cannot be ' . $value_text . ' Valid values are: %s', 'echo-knowledge-base' ),
																		EPKB_Utilities::get_variable_string($field_spec['options']) );
			return new WP_Error('filter_selection_invalid', $msg );
		}

		return $value;
	}

	/**
	 * Sanitize and validate checkbox.
	 *
	 * @param $value
	 *
	 * @return string|WP_Error returns sanitized and validated text
	 */
	private function filter_checkbox( $value ) {

		if ( empty($value) || $value == 'off' ) {
			return "off";
		} else if ( $value == "on" ) {
			return $value;
		}

		return new WP_Error('filter_checkbox_invalid', __( 'is not valid', 'echo-knowledge-base' ) );
	}

	/**
	 * Sanitize and validate a number
	 *
	 * @param $number
	 * @param array $field_spec
	 * @return string|WP_Error returns sanitized and validated text
	 */
	private function filter_number( $number, $field_spec=array() ) {

		$number = empty($number) ? 0 : trim($number);
		$number_int = EPKB_Utilities::filter_int( $number );
		if ( $number != $number_int ) {
			return new WP_Error('filter_not_number', 'not a number.');
		}

		if ( $number > $field_spec['max'] ) {
			$msg = sprintf( __( 'is larger than maximum of: %s', 'echo-knowledge-base' ), $field_spec['max'] );
			return new WP_Error( 'filter_not_number', $msg );
		} else if ( $number < $field_spec['min'] ) {
			$msg = sprintf( __( 'is smaller than minimum of: %s', 'echo-knowledge-base' ), $field_spec['min'] );
			return new WP_Error( 'filter_not_number', $msg );
		}

		return $number;
	}

	/**
	 * Sanitize and validate true/false value
	 *
	 * @param $boolean
	 *
	 * @return string|WP_Error returns sanitized and validated text
	 */
	private function filter_true_false( $boolean ) {
		return $boolean === true;
	}

	/**
	 * Sanitize and validate HEX color number
	 *
	 * @param $value
	 * @param $field_spec
	 *
	 * @return string|WP_Error
	 */
	public function filter_color_hex( $value, $field_spec=array() ) {

		// Check for a hex color string '#c1c2b4'
		if ( preg_match('/^#[a-f0-9]{6}$/i', $value) )
		{
			return $value;
		}

		// Check for a hex color string without hash 'c1c2b4'
		else if(preg_match('/^[a-f0-9]{6}$/i', $value))
		{
			return '#' . $value;
		}

		if ( empty($value) && empty($field_spec['mandatory']) ) {
			return $value;
		}

		return new WP_Error('filter_not_color_hex', __( 'is not valid HEX color.', 'echo-knowledge-base' ) );
	}

	/**
	 * Sanitize and validate ID
	 *
	 * @param $id
	 *
	 * @return int|WP_Error
	 */
	private function filter_id( $id ) {
		$id = EPKB_Utilities::sanitize_get_id( $id );
		if ( is_wp_error($id) ) {
			return new WP_Error('filter_not_id', ' with internal error (' . $id->get_error_code() . ')');
		}
		return $id;
	}

	/**
	 * Input has to match one of the predefined values.
	 *
	 * @param $value
	 * @param $field_spec
	 *
	 * @return mixed - WP_Error | valid value
	 */
	private function filter_enumeration( $value, $field_spec ) {
		if ( in_array( $value, $field_spec['options'] ) ) {
			return $value;
		}

		return new WP_Error('filter_not_enumeration', __( 'value is not in enumeration', 'echo-knowledge-base' ) );
	}

	/**
	 * Place form fields into an array. Fill missing values with original settings if they are missing.
	 *
	 * @param $submitted_fields
	 * @param $all_fields_specs
	 * @param $orig_settings - original settings, internal fields will be preserved in the result
	 *
	 * @return array of name - value pairs
	 */
	public function retrieve_form_fields( $submitted_fields, $all_fields_specs, $orig_settings ) {

		$name_values = array();
		foreach ($all_fields_specs as $key => $spec ) {

			// copy over fields that are internal
			if ( ! empty($spec['internal']) || $spec['type'] == EPKB_Input_Filter::ID ) {
				$default_value = isset($spec['default']) ? $spec['default'] : '';
				$orig_value = isset($orig_settings[$key]) ? $orig_settings[$key] :$default_value;
				$name_values += array( $key => $orig_value);
				continue;
			}

			// checkboxes in a box have zero or more values
			$is_multiselect =  $spec['type'] == EPKB_Input_Filter::CHECKBOXES_MULTI_SELECT;
			if ( $is_multiselect || $spec['type'] == EPKB_Input_Filter::CHECKBOXES_MULTI_SELECT_NOT) {

				$multi_selects = array();  // TODO apply defaults if field missing
				foreach ($submitted_fields as $submitted_key => $submitted_value) {

					$submitted_value = stripslashes( $submitted_value );
					$submitted_value = sanitize_text_field( $submitted_value );

					if ( ! empty($submitted_key) && strpos($submitted_key, $key) === 0) {

						$chunks = $is_multiselect ?  explode('[[-,-]]', $submitted_value) : explode('[[-HIDDEN-]]', $submitted_value);
						if ( empty($chunks[0]) || empty($chunks[1]) || ! empty($chunks[2]) ) {
							continue;
						}

						if ( $is_multiselect ) {
							$multi_selects[$chunks[0]] = $chunks[1];
						} else if ( ! empty($submitted_value) && strpos($submitted_value, '[[-HIDDEN-]]') !== false ) {
							$multi_selects[$chunks[0]] = $chunks[1];
						}
					}
				}

				$name_values += array( $key => $multi_selects );
				continue;
			}

			// checkbox or radio button without value is considered to be 'off'
			if ( empty($submitted_fields[$key]) && ( $spec['type'] == EPKB_Input_Filter::CHECKBOX || $spec['type'] == EPKB_Input_Filter::RADIO ) ) {
				$submitted_fields[$key] = 'off';
			}

			// for regular input if it exists then retrieve it
			if ( isset($submitted_fields[$key]) ) {
				$input_value = trim( $submitted_fields[ $key ] );

			// if the input is missing then use the original config value
			} else {
				$default_value = isset($spec['default']) ? $spec['default'] : '';
				$input_value = isset($orig_settings[$key]) ? $orig_settings[$key] :$default_value;
			}

			$input_value = stripslashes( $input_value );
			$name_values += array( $key => sanitize_text_field($input_value) );
		}

		return $name_values;
	}
}



<form class='center config-form mt-5' name='device_config_network' method='post'>
	<input type='hidden' name='tab-index' value='4'>
	<input type='hidden' name='type' value='display'>
		<h2><?php echo __("TAB_HL_DISPLAY", "BLINX ADD"); ?></h2>
		<div class="form-group col">
			<label for="modeDisplay">
			<?php echo __("TAB_HL_DISPLAY_MODE", "BLINX ADD"); ?>
			</label>
			<select class="form-control custom-select" id="modeDisplay" name='modeDisplay'>
				<option value='0'>
					<?php echo __("TAB_HL_DISPLAY_MODE_TEXT", "BLINX ADD"); ?>
				</option>
				<option value='1'>
					<?php echo __("TAB_HL_DISPLAY_MODE_TIME", "BLINX ADD"); ?>
				</option>
				<option value='2'>
					<?php echo __("TAB_HL_DISPLAY_MODE_SENSOR", "BLINX ADD"); ?>
				</option>
				<option value='3'>
					<?php echo __("TAB_HL_DISPLAY_MODE_SENSOR_TIME", "BLINX ADD"); ?>
				</option>
				<option value='4'>
					<?php echo __("TAB_HL_DISPLAY_MODE_MQTT_SENSOR", "BLINX ADD"); ?>
				</option>
				<option value='5'>
					<?php echo __("TAB_HL_DISPLAY_MODE_MQTT_SENSOR_TIME", "BLINX ADD"); ?>
				</option>
				<option value='6' selected='selected'>
					<?php echo __("TAB_HL_DISPLAY_MODE_BLINX", "BLINX ADD"); ?>
				</option>
			</select>
			<small class="form-text text-muted">
				<?php echo __("TAB_HL_DISPLAY_MODE_HELP", "BLINX ADD"); ?>
			</small>
		</div>
		<div id="DisplayText" disabled='disabled' class="form-group col disabled">
			<label for="DisplayTextInput">
				<?php echo __("TAB_HL_DISPLAY_TEXT", "BLINX ADD"); ?>
			</label>
			<input type="text"
				class="form-control"
				id="DisplayTextInput"
				name='DisplayTextInput'
				placeholder="<?php echo __("PLEASE_ENTER"); ?>"
				value=''
			>
			<small class="form-text text-muted">
				<?php echo __("TAB_HL_DISPLAY_TEXT_HELP", "BLINX ADD"); ?>
			</small>
		</div>
		<div class="form-group col">
			<label for="DisplayDimmerInput">
				<?php echo __("TAB_HL_DISPLAY_DIMMER", "BLINX ADD"); ?>
			</label>
			<input type="number"
				class="form-control"
				id="DisplayDimmerInput"
				name='DisplayDimmerInput'
				placeholder="<?php echo __("PLEASE_ENTER"); ?>"
				value='100'
				min='0'
				max='100'
			>
			<small class="form-text text-muted">
				<?php echo __("TAB_HL_DISPLAY_DIMMER_HELP", "BLINX ADD"); ?>
			</small>
		</div>
		<div class="form-group col">
			<label for="DisplaySizeInput">
				<?php echo __("TAB_HL_DISPLAY_SIZE", "BLINX ADD"); ?>
			</label>
			<input type="number"
				class="form-control"
				id="DisplaySizeInput"
				name='DisplaySizeInput'
				placeholder="<?php echo __("PLEASE_ENTER"); ?>"
				value='1'
				min='1'
				max='4'
			>
			<small class="form-text text-muted">
				<?php echo __("TAB_HL_DISPLAY_SIZE_HELP", "BLINX ADD"); ?>
			</small>
		</div>
		<div class="form-group col ">
			<label for="DisplayRotateInput">
				<?php echo __("TAB_HL_DISPLAY_ROTATE", "BLINX ADD"); ?>
			</label>
			<select class="form-control custom-select" id="DisplayRotateInput" name='DisplayRotateInput'>
				<option value='0'>
					0°
				</option>
				<option value='1'>
					90°
				</option>
				<option value='2'>
					180°
				</option>
				<option value='3'>
					270°
				</option>
			</select>
			<small class="form-text text-muted">
				<?php echo __("TAB_HL_DISPLAY_ROTATE_HELP", "BLINX ADD"); ?>
			</small>
		</div>
	<div class="row mt-5">
		<div class="col col-12">
			<div class="text-right">
				<button type='submit' class='btn btn-primary ' name='save' value='submit'>
					<?php echo __("BTN_SAVE_DEVICE_CONFIG", "DEVICE_CONFIG"); ?>
				</button>
			</div>
		</div>
	</div>
</form>


		<?php
		foreach($statusSensor->analog as $key => $value):
			if(in_array($value->name, ["Relay", "Relay_i"])){
				?>
<form class='center config-form mt-5' name='device_config_network' method='post'>
	<input type='hidden' name='tab-index' value='4'>
	<input type='hidden' name='port' value='<?php echo $key; ?>'>
	<input type='hidden' name='type' value='relay'>
	<h2><?php echo __("TAB_HL_ANALOG_OUTPUT", "BLINX ADD") . $key . ", type : " . $value->name; ?></h2>
		<div class="form-group col">
			<label for="PortRelay">
			</label>
			<select class="form-control custom-select" id="PortRelay" name='PortRelay'>
				<option value='0'>
					<?php echo __("TAB_HL_POWER_ON", "BLINX ADD"); ?>
				</option>
				<option value='1'>
					<?php echo __("TAB_HL_POWER_OFF", "BLINX ADD"); ?>
				</option>
				<option value='2'>
					<?php echo __("TAB_HL_ANALOG_RELAY_TOGGLE", "BLINX ADD"); ?>
				</option>
				<option value='3'>
					<?php echo __("TAB_HL_ANALOG_RELAY_BLINK", "BLINX ADD"); ?>
				</option>
			</select>
		</div>
	<div class="row mt-5">
		<div class="col col-12">
			<div class="text-right">
				<button type='submit' class='btn btn-primary ' name='save' value='submit'>
					<?php echo __("BTN_SAVE_DEVICE_CONFIG", "DEVICE_CONFIG"); ?>
				</button>
			</div>
		</div>
	</div>
</form>
				<?php
			} else if(in_array($value->name, ["PWM", "PWM_i"])){
				?>
<form class='center config-form mt-5' name='device_config_network' method='post'>
	<input type='hidden' name='tab-index' value='4'>
	<input type='hidden' name='port' value='<?php echo $key; ?>'>
	<input type='hidden' name='type' value='pwm'>
	<h2><?php echo __("TAB_HL_ANALOG_OUTPUT", "BLINX ADD") . $key . ", type : " . $value->name; ?></h2>
		<div class="form-group col">
			<label for="PortFreq">
				<?php echo __("TAB_HL_ANALOG_PWM_FREQ", "BLINX ADD"); ?>
			</label>
			<input type="number"
				class="form-control"
				id="PortFreq"
				name='PortFreq'
				placeholder="<?php echo __("PLEASE_ENTER"); ?>"
				value='0'
			>
		<small class="form-text text-muted">
			<?php echo __("TAB_HL_ANALOG_PWM_FREQ_HELP", "BLINX ADD"); ?>
		</small>
			<label for="PortValue">
				<?php echo __("TAB_HL_ANALOG_PWM_VALUE", "BLINX ADD"); ?>
			</label>
			<input type="number"
				class="form-control"
				id="PortValue"
				name='PortValue'
				placeholder="<?php echo __("PLEASE_ENTER"); ?>"
				value='0'
			>
		<small class="form-text text-muted">
			<?php echo __("TAB_HL_ANALOG_PWM_VALUE_HELP", "BLINX ADD"); ?>
		</small>
			<label for="PortPhase">
				<?php echo __("TAB_HL_ANALOG_PWM_PHASE", "BLINX ADD"); ?>
			</label>
			<input type="number"
				class="form-control"
				id="PortPhase"
				name='PortPhase'
				placeholder="<?php echo __("PLEASE_ENTER"); ?>"
				value='0'
			>
		<small class="form-text text-TAB_HL_ANALOG_PWM_PHASE_HELP">
			<?php echo __("TAB_HL_ANALOG_PWM_FREQ", "BLINX ADD"); ?>
		</small>
		</div>
	<div class="row mt-5">
		<div class="col col-12">
			<div class="text-right">
				<button type='submit' class='btn btn-primary ' name='save' value='submit'>
					<?php echo __("BTN_SAVE_DEVICE_CONFIG", "DEVICE_CONFIG"); ?>
				</button>
			</div>
		</div>
	</div>
</form>

		<?php
			}
		endforeach;
		?>

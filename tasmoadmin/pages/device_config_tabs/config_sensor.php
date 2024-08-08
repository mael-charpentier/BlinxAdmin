
<div class="form-group col">
		<label for="defaultSensor">
			<?php echo __("TAB_HL_LED_BUZZER", "BLINX ADD"); ?>
		</label>
		<select class="form-control custom-select" id="defaultSensor" name='defaultSensor'>
			<option value='0' <?php echo isset($statusSensor->analog)
                                         && ($statusSensor->analog->default->name == "Relay" ||
										 	 $statusSensor->analog->default->name == "Relay_i" ) ? "selected=\selected\"" : ""; ?>>
				<?php echo __("TAB_HL_LED", "BLINX ADD"); ?>
			</option>
			<option value='1' <?php echo isset($statusSensor->analog)
                                         && ($statusSensor->analog->default->name == "PWM" ||
										 	 $statusSensor->analog->default->name == "PWM_i" ) ? "selected=\selected\"" : ""; ?>>
				<?php echo __("TAB_HL_BUZZER", "BLINX ADD"); ?>
			</option>
		</select>
		<small id="WifiConfigHelp" class="form-text text-muted">
			<?php echo __("TAB_HL_LED_BUZZER_HELP", "BLINX ADD"); ?>
		</small>
	</div>
	
	<?php foreach (["1A", "1B", "2A", "2B"] as $idPort): ?>
	<div class="form-group col">
		<label for="Port<?php echo $idPort;?>">
			<?php echo __("TAB_HL_PORT", "BLINX ADD"); ?> <?php echo $idPort; ?>
		</label>
		<select class="form-control custom-select" id="Port<?php echo $idPort;?>" name='Port<?php echo $idPort;?>'>
			<option value='0' <?php echo isset($statusSensor->analog)
                                         && ($statusSensor->analog->$idPort->name == "None" )? "selected=\selected\"" : ""; ?>>
			<?php echo __("TAB_HL_ANALOG_CHOICE_NONE", "BLINX ADD"); ?>
			</option>
			<option value='1' <?php echo isset($statusSensor->analog)
                                         && ($statusSensor->analog->$idPort->name == "Relay" ) ? "selected=\selected\"" : ""; ?>>
			<?php echo __("TAB_HL_ANALOG_CHOICE_RELAY", "BLINX ADD"); ?>
			</option>
			<option value='2' <?php echo isset($statusSensor->analog)
                                         && ($statusSensor->analog->$idPort->name == "Relay_i" ) ? "selected=\selected\"" : ""; ?>>
			<?php echo __("TAB_HL_ANALOG_CHOICE_RELAY_I", "BLINX ADD"); ?>
			</option>
			<option value='3' <?php echo isset($statusSensor->analog)
                                         && ($statusSensor->analog->$idPort->name == "PWM" ) ? "selected=\selected\"" : ""; ?>>
			<?php echo __("TAB_HL_ANALOG_CHOICE_PWM", "BLINX ADD"); ?>
			</option>
			<option value='4' <?php echo isset($statusSensor->analog)
                                         && ($statusSensor->analog->$idPort->name == "PWM_i" )? "selected=\selected\"" : ""; ?>>
			<?php echo __("TAB_HL_ANALOG_CHOICE_PWM_I", "BLINX ADD"); ?>
			</option>
			<option value='5' <?php echo isset($statusSensor->analog)
                                         && ($statusSensor->analog->$idPort->name == "ADC Joystick" ) ? "selected=\selected\"" : ""; ?>>
			<?php echo __("TAB_HL_ANALOG_CHOICE_JOYSTICK", "BLINX ADD"); ?>
			</option>
			<option value='6' <?php echo isset($statusSensor->analog)
                                         && ($statusSensor->analog->$idPort->name == "ADC Temp" ) ? "selected=\selected\"" : ""; ?>>
			<?php echo __("TAB_HL_ANALOG_CHOICE_TEMP", "BLINX ADD"); ?>
			</option>
			<option value='7' <?php echo isset($statusSensor->analog)
                                         && ($statusSensor->analog->$idPort->name == "ADC Light" ) ? "selected=\selected\"" : ""; ?>>
			<?php echo __("TAB_HL_ANALOG_CHOICE_LIGHT", "BLINX ADD"); ?>
			</option>
			<option value='8' <?php echo isset($statusSensor->analog)
                                         && ($statusSensor->analog->$idPort->name == "ADC Button" ) ? "selected=\selected\"" : ""; ?>>
			<?php echo __("TAB_HL_ANALOG_CHOICE_BUTTON", "BLINX ADD"); ?>
			</option>
			<option value='9' <?php echo isset($statusSensor->analog)
                                         && ($statusSensor->analog->$idPort->name == "ADC Button_i" ) ? "selected=\selected\"" : ""; ?>>
			<?php echo __("TAB_HL_ANALOG_CHOICE_BUTTON_I", "BLINX ADD"); ?>
			</option>
			<option value='10' <?php echo isset($statusSensor->analog)
                                         && ($statusSensor->analog->$idPort->name == "ADC Range" ) ? "selected=\selected\"" : ""; ?>>
			<?php echo __("TAB_HL_ANALOG_CHOICE_RANGE", "BLINX ADD"); ?>
			</option>
			<option value='11' <?php echo isset($statusSensor->analog)
                                         && ($statusSensor->analog->$idPort->name == "ADC CT Power" ) ? "selected=\selected\"" : ""; ?>>
			<?php echo __("TAB_HL_ANALOG_CHOICE_POWER", "BLINX ADD"); ?>
			</option>
			<option value='12' <?php echo isset($statusSensor->analog)
                                         && ($statusSensor->analog->$idPort->name == "ADC Input" ) ? "selected=\selected\"" : ""; ?>>
			<?php echo __("TAB_HL_ANALOG_CHOICE_INPUT", "BLINX ADD"); ?>
			</option>
		</select>
		<small id="WifiConfigHelp" class="form-text text-muted">
			<?php echo __("TAB_HL_ANALOG_HELP", "BLINX ADD"); ?>
		</small>
	</div>
	<?php endforeach; ?>

<div class="row mt-5">
    <div class="col col-12">
        <div class="text-right">
            <button type='submit' class='btn btn-primary configCommand' name='save' value='submit'>
                <?php echo __("BTN_SAVE_DEVICE_CONFIG", "DEVICE_CONFIG"); ?>
            </button>
        </div>
    </div>
</div>
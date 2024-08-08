

<form class='center config-form' name='device_config_network' method='post' id='input-list'>
	<input type='hidden' name='tab-index' value='3'>
	<div class="form-group col">
		
		<div class="form-check custom-control custom-checkbox">
			<input class="form-check-input custom-control-input select_all_input"
				   type="checkbox"
				   value='select_all_input'
				   id="select_all_input"
				   name='select_all_input'
			>
			<label class="form-check-label custom-control-label" for="select_all_input">
				<?php echo __("TABLE_HEAD_ALL", "DEVICES"); ?>
			</label>
		</div>
		<?php
		if(isset($statusSensor->sensorI2C)){
		foreach($statusSensor->sensorI2C as $key => $value):
			foreach($value as $type => $info):
		?>
			<div class="form-check custom-control custom-checkbox">
				<input class="form-check-input custom-control-input input_checkbox"
					   type="checkbox"
					   <?php /*if (isset($disabledDeviceIds) && array_key_exists($device_group->id, $disabledDeviceIds)): ?>
						   disabled="disabled"
					   <?php endif*/ ?>
					   value='<?php echo $info->access_name; ?>'
					   id="cb_<?php echo $info->access_name; ?>"
					   name='sensors_input[]'
				>
				<label class="form-check-label custom-control-label"
					   for="cb_<?php echo $info->access_name; ?>"
				>
					<?php
						echo $key . ", " . $type . " : " . $info->value;
					?>
				</label>
			</div>
			<?php
			endforeach;
		endforeach;
		}
		
		if(isset($statusSensor->analog)){
		foreach($statusSensor->analog as $key => $value):
			if(!in_array($value->name, ["None", "Relay", "Relay_i", "PWM", "PWM_i"])){
				?>
				<div class="form-check custom-control custom-checkbox">
					<input class="form-check-input custom-control-input input_checkbox"
						   type="checkbox"
						   <?php /*if (isset($disabledDeviceIds) && array_key_exists($device_group->id, $disabledDeviceIds)): ?>
							   disabled="disabled"
						   <?php endif*/ ?>
						   value='<?php echo $value->access_name; ?>'
						   id="cb_<?php echo $value->access_name; ?>"
						   name='sensors_input[]'
					>
					<label class="form-check-label custom-control-label"
						   for="cb_<?php echo $value->access_name; ?>"
					>
							<?php echo __("TAB_HL_PORT", "BLINX ADD") . $key . ", type :" . $value->name . "and ";
							foreach($value as $k => $v):
								if($k != "name" && $k != "access_name"){
									echo $k . ":" . $v;
								}
							endforeach;
							?>
					</label>
				</div>
				<?php
			}
		endforeach;
		}
		?>
	</div>
	<div class="form-group col">
		<label for="deltaTime">
			<?php echo __("TAB_HL_DELTA_TIME", "BLINX ADD"); ?>
		</label>
		<select class="form-control custom-select" id="deltaTime" name='deltaTime'>
			<option value='0'>
				50ms 
				<?php echo __("TAB_HL_50MS_NOT_SUPPORTED", "BLINX ADD"); ?>
			</option>
			<option value='1'>
				1s
			</option>
			<option value='2'>
				10s
			</option>
			<option value='3'>
				1m
			</option>
			<option value='4'>
				10m
			</option>
			<option value='5'>
				1h
			</option>
		</select>
	</div>

	<div class="row mt-5">
		<div class="col col-12">
			<div class="text-right">
				<button type='submit' class='btn btn-primary ' name='save' value='submit'>
					<?php echo __("TAB_HL_GET_DATA", "BLINX ADD"); ?>
				</button>
			</div>
		</div>
	</div>
</form>

<?php
if(ISSET($resultSensor)){
?>
<div>
	<h2>Result</h2>
	<?php echo str_replace("\n", "<br>\n", $resultSensor); ?>
</div>
<?php
}
?>
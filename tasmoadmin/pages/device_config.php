<?php

use TasmoAdmin\Sonoff;

$msg            = false;
$device         = null;
$activeTabIndex = 0;


$Sonoff = $container->get(Sonoff::class);

$device = $Sonoff->getDeviceById($device_id);

if(!empty($_POST[ "save" ])) {
    $activeTabIndex = $_POST[ "tab-index" ];
	if ($activeTabIndex == 2){
		// config analog sensor
		$arrayAnalogType = ["None", "Relay", "Relay_i", "PWM", "PWM_i", "ADC Joystick", "ADC Temp", "ADC Light", "ADC Button", "ADC Button_i", "ADC Range", "ADC CT Power", "ADC Input"];
		$config = [];
		if (isset($_POST[ "defaultSensor" ])){
			echo $_POST[ "defaultSensor" ];
			if ($_POST[ "defaultSensor" ] == 0){
				$config["led"] = "on";
			} else if ($_POST[ "defaultSensor" ] == 1){
				$config["buzzer"] = "on";
			}
		}
		foreach (["1A", "1B", "2A", "2B"] as $idPort):
			$nameArg = "Port" . $idPort;
			if (isset($_POST[ $nameArg ])){
				$config["port" . $idPort] = $arrayAnalogType[$_POST[ $nameArg ]];
			}
		endforeach;

        $result = $Sonoff->saveConfigSensor($device, $config);

	} else if ($activeTabIndex == 3){
		// input sensor
		$config = [];
		$delta_list = ["50ms", "1s", "10s", "1m", "10m", "1h"];
		if($_POST[ "deltaTime" ] != -1){
			$config["delta"] = $delta_list[$_POST[ "deltaTime" ]];
		}
		$config["n"] = 10;

		$csvSensor = "";
		if(ISSET($_POST["sensors_input"])){
			$csvSensor .= implode(',', $_POST["sensors_input"]);
		}
		$csvSensor .= ".csv";
		

		$resultSensor = $Sonoff->blinxApiSensor($device, $csvSensor, $config);
	} else if ($activeTabIndex == 4){
		// output sensor
		if(isset($_POST[ "type" ])) {
			if(isset($_POST[ "type" ]) == "relay") {
				$config = [];
				if($_POST[ "port" ] == "default"){
					$config["device"] = "led";
				} else{
					$config["device"] = "Port".$_POST[ "port" ];
				}

				if($_POST[ "PortRelay" ] != -1){
					$config["action"] = $_POST[ "PortRelay" ];
				}

				$result = $Sonoff->blinxApiSensor($device, "br", $config);
			} else if(isset($_POST[ "type" ]) == "pwm") {
				$config = [];
				if($_POST[ "port" ] == "default"){
					$config["device"] = "buzzer";
				} else{
					$config["device"] = "Port".$_POST[ "port" ];
				}

				if($_POST[ "PortFreq" ] != -1){
					$config["freq"] = $_POST[ "PortFreq" ];
				}
				if($_POST[ "PortValue" ] != -1){
					$config["value"] = $_POST[ "PortValue" ];
				}
				if($_POST[ "PortPhase" ] != -1){
					$config["phase"] = $_POST[ "PortPhase" ];
				}

				$result = $Sonoff->blinxApiSensor($device, "bp", $config);
			}
		}
	} else if(isset($_POST[ "save" ])) {
        unset($_POST[ "save" ]);
        unset($_POST[ "tab-index" ]);
        $settings = $_POST;
        if(!isset($_POST[ "Password1" ]) || empty($settings[ "Password1" ])
            || $settings[ "Password1" ] == "") {
            unset($settings[ "Password1" ]);
        }
        if(!isset($settings[ "Password2" ]) || empty($settings[ "Password2" ])
            || $settings[ "Password2" ] == "") {
            unset($settings[ "Password2" ]);
        }
        if(isset($settings[ "IPAddress1" ]) && !empty($settings[ "IPAddress1" ])
            && $settings[ "IPAddress1" ] != "") {
            if($settings[ "IPAddress1" ] != "0.0.0.0") {
                if($device->ip == $settings[ "IPAddress1" ]) {
                    unset($settings[ "IPAddress1" ]);
                }
            }
        }

        $backlog = "Backlog ";
        foreach($settings as $settingKey => $settingVal) {
            $settingVal = trim($settingVal);
            if($settingVal == "") {
                continue;
            }
            $backlog .= $settingKey." ".$settingVal."; ";
        }
        $backlog = trim($backlog);

        $result = $Sonoff->saveConfig($device, $backlog);
        $msg    = __("MSG_CONFIG_SAVED", "DEVICE_CONFIG");
        $msg    .= "<br/> ".$backlog;
        sleep(count($settings));
    }
}

$status = $Sonoff->getAllStatus($device);

if(empty($status->ERROR)) {
    $status->statusNTP = $Sonoff->getNTPStatus($device);
    /*if(empty($status->StatusMQT)) {
        $status->StatusMQT = new stdClass();
    }
    $status->StatusMQT->FullTopic   = $Sonoff->getFullTopic($device);
    $status->StatusMQT->SwitchTopic = $Sonoff->getSwitchTopic($device);
    sleep(1);
    $status->StatusMQT->MqttRetry    = $Sonoff->getMqttRetry($device);
    $status->StatusMQT->SensorRetain = $Sonoff->getSensorRetain($device);
    sleep(1);
    $status->StatusMQT->TelePeriod = $Sonoff->getTelePeriod($device);
    $status->StatusMQT->Prefixe    = $Sonoff->getPrefixe($device);
    sleep(1);
    $status->StatusMQT->StateTexts = $Sonoff->getStateTexts($device);
    sleep(1);
    $status->StatusMQT->MqttFingerprint = $Sonoff->getMqttFingerprint($device);*/


    $status->StatusLOG->SetOptionDecoded = $Sonoff->decodeOptions($status->StatusLOG->SetOption[ 0 ]);
}


$statusSensor = $Sonoff->getStatusSensor($device);
//echo var_dump($statusSensor);

?>
<div class='row justify-content-sm-center'>
	<div class='col col-12 col-md-10 col-lg-10 col-xl-6'>
		<div class='row'>
			<div class='col col-12'>
				<h2 class='text-sm-center'>
					<?php echo __("CONFIG_HL", "DEVICE_CONFIG"); ?>: <?php echo implode(" | ", $device->names); ?>

				</h2>
			</div>
		</div>
		<div class='row'>
			<div class='col col-12 mb-5'>
				<div class='text-center'><!-- TODO blinx -->
					ID: <?php echo $device->id; ?>
					<a href='http://<?php echo $device->ip; ?>' target='_blank'><?php echo $device->ip; ?>  </a>
				</div>
			</div>
		</div>
		<div class='row'>
			<div class='col col-12'>
				<?php if(isset($msg) && $msg != ""): ?>
					<div class="alert alert-success alert-dismissible fade show mb-5" data-dismiss="alert" role="alert">
						<?php echo $msg; ?>
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
				<?php endif; ?>

				<?php if(isset($status->ERROR) && !empty($status->ERROR)): ?>
				<div class="alert alert-danger alert-dismissible fade show mb-5" role="alert">
					<?php echo __("ERROR_COULD_NOT_GET_DATA", "DEVICE_CONFIG"); ?><br/>
					<?php echo $status->ERROR; ?><br/><br/>
					<a href='#' class='reload'><?php echo __("PAGE_RELOAD"); ?></a>
					<a type="button" class="reload close" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</a>
				</div>

			</div>
		</div>
		<?php else: ?>
			<div class='row'>
				<div class='col col-12'>
					<ul class="nav nav-tabs" id="device_config" role="tablist">
						<li class="nav-item">
							<a class="nav-link <?php echo $activeTabIndex == 0 ? "active" : ""; ?>"
							   id="config_general_tab-tab"
							   data-toggle="tab"
							   href="#config_general_tab"
							   role="tab"
							   aria-controls="home"
							   aria-selected="true">
								<?php echo __("TAB_HL_GENERAL", "DEVICE_CONFIG"); ?>
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link <?php echo $activeTabIndex == 1 ? "active" : ""; ?>"
							   id="config_network_tab-tab"
							   data-toggle="tab"
							   href="#config_network_tab"
							   role="tab"
							   aria-controls="profile"
							   aria-selected="false">
								<?php echo __("TAB_HL_NETWORK", "DEVICE_CONFIG"); ?>
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link <?php echo $activeTabIndex == 2 ? "active" : ""; ?>"
							   id="config_sensor_config_tab-tab"
							   data-toggle="tab"
							   href="#config_sensor_config_tab"
							   role="tab"
							   aria-controls="profile"
							   aria-selected="false">
								<?php echo __("TAB_HL_SENSOR_CONFIG", "BLINX_ADD"); ?>
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link <?php echo $activeTabIndex == 3 ? "active" : ""; ?>"
							   id="config_sensor_input_tab-tab"
							   data-toggle="tab"
							   href="#config_sensor_input_tab"
							   role="tab"
							   aria-controls="profile"
							   aria-selected="false">
								<?php echo __("TAB_HL_SENSOR_INPUT", "BLINX_ADD"); ?>
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link <?php echo $activeTabIndex == 4 ? "active" : ""; ?>"
							   id="config_sensor_output_tab-tab"
							   data-toggle="tab"
							   href="#config_sensor_output_tab"
							   role="tab"
							   aria-controls="profile"
							   aria-selected="false">
								<?php echo __("TAB_HL_SENSOR_OUTPUT", "BLINX_ADD"); ?>
							</a>
						</li>

					</ul>
					<div class="tab-content mt-3" id="device_configContent">
						<div class="tab-pane fade <?php echo $activeTabIndex == 0 ? "show active" : ""; ?>"
						     id="config_general_tab"
						     role="tabpanel"
						     aria-labelledby="config_general_tab-tab">
							<?php include_once _PAGESDIR_."device_config_tabs/config_general_tab.php"; ?>
						</div>
						<div class="tab-pane fade <?php echo $activeTabIndex == 1 ? "show active" : ""; ?>"
						     id="config_network_tab"
						     role="tabpanel"
						     aria-labelledby="config_network_tab-tab">
							<?php include_once _PAGESDIR_."device_config_tabs/config_network_tab.php"; ?>
						</div>
						<div class="tab-pane fade <?php echo $activeTabIndex == 2 ? "show active" : ""; ?>"
							 id="config_sensor_config_tab"
							 role="tabpanel"
							 aria-labelledby="config_sensor_config_tab-tab">
							<?php include_once _PAGESDIR_ . "device_config_tabs/config_sensor_config_tab.php"; ?>
						</div>
						<div class="tab-pane fade <?php echo $activeTabIndex == 3 ? "show active" : ""; ?>"
							 id="config_sensor_input_tab"
							 role="tabpanel"
							 aria-labelledby="config_sensor_input_tab-tab">
							<?php include_once _PAGESDIR_ . "device_config_tabs/config_sensor_input_tab.php"; ?>
						</div>
						<div class="tab-pane fade <?php echo $activeTabIndex == 4 ? "show active" : ""; ?>"
							 id="config_sensor_output_tab"
							 role="tabpanel"
							 aria-labelledby="config_sensor_output_tab-tab">
							<?php include_once _PAGESDIR_ . "device_config_tabs/config_sensor_output_tab.php"; ?>
						</div>
					</div>
				</div>
			</div>
		<?php endif; ?>
	</div>
</div>

<script src="<?php echo $urlHelper->js("compiled/device_config"); ?>"></script>

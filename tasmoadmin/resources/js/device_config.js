var $_forms = {};
$(document).on("ready", function (e) {
  saveDefaultFormValues();
  console.log($_forms);

  $(".config-form").on("submit", function (e) {
    submitForm(e);
  });
});

$(document).ready(function () {
  initInputSensor();
});



function initInputSensor(){
  $("#select_all_input").change(function () {
    let status = this.checked;
    $("#input-list .input_checkbox:not(:disabled)").each(
      function () {
        this.checked = status;
      },
    );

    $(".select_all_input").each(function () {
      this.checked = status;
    });
  });

  $("#modeDisplay").change(function() {
    if(this.value == 0){
      $("#DisplayText").removeProp("disabled", "disabled").removeClass("disabled");
    } else {
      $("#DisplayText").prop("disabled", "disabled").addClass("disabled");
    }
  });
}

function saveDefaultFormValues() {
  $.each($(".config-form"), function (idx, form) {
    var formName = $(form).attr("name");
    $_forms[formName] = convertSerializedArrayToHash($(form).serializeArray());
  });
}

function submitForm(e) {
  var form = $(e.currentTarget);
  console.log("[DEVICE_CONFIG] " + "Submitted Form: " + form.attr("name"));

  var serialized = $("input:checkbox").map(function () {
    return { name: this.name, value: this.checked ? this.value : "false" };
  });

  var currentItems = convertSerializedArrayToHash(form.serializeArray());
  console.log(currentItems);
  var itemsToSubmit = hashDiff($_forms[form.attr("name")], currentItems);

  console.log(itemsToSubmit);
  if (!$.isEmptyObject(itemsToSubmit)) {
    $.each(
      form.find(":input:not([type=submit]):not([name=tab-index])"),
      function (idx, felem) {
        felem = $(felem);

        if (itemsToSubmit[felem.attr("name")] === undefined) {
          felem.attr("disabled", "disabled");
        }
      },
    );
    return true;
  } else {
    console.log("[DEVICE_CONFIG] " + "nothing to submit");
    e.stopPropagation();
    e.preventDefault();
    return false;
  }
}

function hashDiff(h1, h2) {
  var d = {};
  for (k in h2) {
    if (h1[k] !== h2[k]) {
      d[k] = h2[k];
    }
  }
  return d;
}

function convertSerializedArrayToHash(a) {
  var r = {};
  for (var i = 0; i < a.length; i++) {
    r[a[i].name] = a[i].value;
  }
  return r;
}

(function ($) {
  var _base_serializeArray = $.fn.serializeArray;
  $.fn.serializeArray = function () {
    var a = _base_serializeArray.apply(this);
    $.each(this.find("input"), function (i, e) {
      if (e.type == "checkbox") {
        e.checked
          ? (a[i].value = "true")
          : a.splice(i, 0, { name: e.name, value: "0" });
      }
    });
    return a;
  };
})(jQuery);

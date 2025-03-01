var $j = jQuery.noConflict();

$j(document).on("ready", function () {
  if ($j("div#butterbean-control-oh_hook_php")) {
    init_editor();

    $j(
      "input[type=radio][name=butterbean_oceanwp_mb_settings_setting_oh_hook_php]"
    ).change(function () {
      init_editor();
    });

    $j(
      "input[type=radio][name=butterbean_oceanwp_mb_settings_setting_oh_enable_hook]"
    ).change(function () {
      init_editor();
    });
  }
  if (
    $j("div#butterbean-control-oh_hook_cond_logic").length > 0 &&
    $j("div#butterbean-control-oh_hook_user_roles").length > 0
  ) {
    var hookId = $j("input[name='post_ID']").val();
    var activeCond = 0;
    var activeRoles = 0;
    if (
      $j(
        "input[name='butterbean_oceanwp_mb_settings_setting_oh_hook_cond_logic']"
      ).is(":checked")
    ) {
      activeCond = 1;
    }
    if (
      $j(
        "input[name='butterbean_oceanwp_mb_settings_setting_oh_hook_user_roles']"
      ).is(":checked")
    ) {
      activeRoles = 1;
    }
    var data = {
      "action": "get_hook_conditional_rules",
      "activeCond": activeCond,
      "activeRoles": activeRoles,
      "hookId": hookId,
    };
    //alert(data.toSource());
    $j.post(ajaxurl, data, function (response) {
      //alert('Got this from the server: ' + response);
      console.log(response);
      var obj = JSON.parse(response);
      if (obj.status) {
        $j("div#butterbean-control-oh_hook_cond_logic").after(obj.condHTML);
        $j("div#butterbean-control-oh_hook_user_roles").after(obj.rolesHTML);
      }
    });

    $j(document).on(
      "change",
      "input[name='butterbean_oceanwp_mb_settings_setting_oh_hook_cond_logic']",
      function () {
        var checkbox = $j(this);
        if (checkbox.is(":checked")) {
          $j("div.options-cond").show();
        } else {
          $j("div.options-cond").hide();
        }
      }
    );

    $j(document).on(
      "change",
      "input[name='butterbean_oceanwp_mb_settings_setting_oh_hook_user_roles']",
      function () {
        var checkbox = $j(this);
        if (checkbox.is(":checked")) {
          $j("div.options-roles").show();
        } else {
          $j("div.options-roles").hide();
        }
      }
    );

    // Remove Display
    $j(document).on("click", ".display-on-remove", function () {
      $j(this).closest(".dispaly-on").remove();
    });

    $j(document).on("click", ".hide-on-remove", function () {
      $j(this).closest(".hide-on").remove();
    });

    // Remove User Roles
    $j(document).on("click", ".roles-remove", function () {
      $j(this).closest(".roles-selector").remove();
    });
  }
});

/* ==============================================
ADD/REMOVE DISPLAY ON
============================================== */
function add_display_on() {
  var template = wp.template("dispaly-on-field");
  $j(".display-on-fields").append(template());
}

/* ==============================================
ADD/REMOVE HIDE ON
============================================== */
function add_hide_on() {
  var template = wp.template("hide-on-field");

  $j(".hide-on-fields").append(template());
}

/* ==============================================
ADD/REMOVE USER ROLES
============================================== */
function add_user_roles() {
  var template = wp.template("roles-field");
  $j(".roles-fields").append(template());
}

function remove_user_roles(obj) {
  $j(obj).closest(".roles-selector").remove();
}

/* ==============================================
Toggle editor and code editor
============================================== */
function init_editor() {
  var data = {
    "action": "oh_enable_php_editor",
  };

  $j.post(ajaxurl, data, function (response) {
    //alert('Got this from the server: ' + response);
    if (
      $j(
        "input[type=radio][name=butterbean_oceanwp_mb_settings_setting_oh_enable_hook]:checked"
      ).val() == "enable" &&
      $j(
        "input[type=radio][name=butterbean_oceanwp_mb_settings_setting_oh_hook_php]:checked"
      ).val() == "enable"
    ) {
      $j("body").addClass("ocean-hook-php-enabled");
    } else {
      $j("body").removeClass("ocean-hook-php-enabled");
    }
  });
}

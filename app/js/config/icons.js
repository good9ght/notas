angular.module('Notas')
.config(function($mdIconProvider) {
  $mdIconProvider
      .icon("material:add", "app/img/icons/ic_add_black_24px.svg",24)
      .icon("material:edit", "app/img/icons/ic_edit_black_24px.svg",24)
      .icon("material:delete_forever", "app/img/icons/ic_delete_forever_black_24px.svg",24)
      .icon("material:launch", "app/img/icons/ic_launch_black_24px.svg",24)
      .icon("material:exit_app", "app/img/icons/ic_exit_to_app_white_24px.svg",24)
      .icon("material:remove", "app/img/icons/ic_remove_white_24px.svg",24)
      .icon("material:close", "app/img/icons/ic_close_white_24px.svg",24);

  })
  .run(function($templateRequest) {

    var urls = [
      "app/img/icons/ic_add_black_24px.svg",
      "app/img/icons/ic_edit_black_24px.svg",
      "app/img/icons/ic_delete_forever_black_24px.svg",
      "app/img/icons/ic_launch_black_24px.svg",
      "app/img/icons/ic_exit_to_app_white_24px.svg",
      "app/img/icons/ic_remove_white_24px.svg",
      "app/img/icons/ic_close_white_24px.svg",
    ];

    angular.forEach(urls, function(url) {
      $templateRequest(url);
    });
});
